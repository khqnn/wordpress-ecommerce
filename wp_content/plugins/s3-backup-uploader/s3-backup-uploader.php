<?php
/**
 * Plugin Name: S3 Backup Uploader
 * Description: Monitors a local directory for backup files, uploads them to a timestamped folder in S3, and deletes old backup folders.
 * Version: 3.0
 * Author: Khaqan
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define a unique constant for this plugin's SDK loading.
if ( ! defined( 'S3BU_SDK_LOADED' ) ) {
    define( 'S3BU_SDK_LOADED', false );
}

// Only load the SDK if it hasn't been loaded by another plugin.
if ( ! defined( 'AWS_SDK_GLOBAL_LOADED' ) ) {
    $autoloader_paths = [
        WP_CONTENT_DIR . '/../vendor/autoload.php',          // WordPress root
        plugin_dir_path( __FILE__ ) . 'vendor/autoload.php', // inside plugin
    ];
    foreach ( $autoloader_paths as $path ) {
        if ( file_exists( $path ) ) {
            require_once $path;
            define( 'AWS_SDK_GLOBAL_LOADED', true );
            break;
        }
    }
}

define( 'S3BU_VERSION', '3.0.0' );
define( 'S3BU_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Add settings link on plugins page.
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 's3bu_add_action_links' );
function s3bu_add_action_links( $links ) {
    $settings_link = '<a href="' . admin_url( 'options-general.php?page=s3-backup-uploader' ) . '">' . __( 'Settings' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}

// Load settings page class.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-s3-backup-settings.php';

/**
 * Main plugin class.
 */
class S3_Backup_Uploader {

    private $s3_client;
    private $options;
    const LAST_RUN_OPTION = 's3bu_last_run';

    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    public function init() {
        $this->options = get_option( 's3bu_options', [] );

        // Check required options – show admin notice if missing, but don't halt everything.
        $required = [ 'aws_access_key', 'aws_secret_key', 'aws_region', 's3_bucket', 'local_path' ];
        $missing = [];
        foreach ( $required as $key ) {
            if ( empty( $this->options[ $key ] ) ) {
                $missing[] = $key;
            }
        }
        if ( ! empty( $missing ) && ( ! isset( $_GET['page'] ) || $_GET['page'] !== 's3-backup-uploader' ) ) {
            add_action( 'admin_notices', function() use ( $missing ) {
                echo '<div class="error"><p><strong>S3 Backup Uploader:</strong> Missing required settings: ' . implode( ', ', $missing ) . '. Please <a href="' . admin_url( 'options-general.php?page=s3-backup-uploader' ) . '">configure the plugin</a>.</p></div>';
            } );
        }

        // Hook the upload checker to run on every page load.
        add_action( 'init', [ $this, 'maybe_run_upload' ] );
    }

    /**
     * Initialize S3 client – only when needed.
     */
    private function init_s3_client() {
        if ( $this->s3_client ) {
            return;
        }

        // Ensure all required credentials are present.
        if ( empty( $this->options['aws_access_key'] ) || empty( $this->options['aws_secret_key'] ) || empty( $this->options['aws_region'] ) ) {
            throw new Exception( 'AWS credentials or region not set.' );
        }

        $s3_args = [
            'version'     => 'latest',
            'region'      => $this->options['aws_region'],
            'credentials' => [
                'key'    => $this->options['aws_access_key'],
                'secret' => $this->options['aws_secret_key'],
            ],
            'use_path_style_endpoint' => true,
            'signature_version'        => 'v4',
        ];
        if ( ! empty( $this->options['endpoint'] ) ) {
            $s3_args['endpoint'] = $this->options['endpoint'];
        }
        $this->s3_client = new Aws\S3\S3Client( $s3_args );
    }

    /**
     * Get the interval in seconds from saved options.
     */
    private function get_interval_seconds() {
        $interval_key = $this->options['interval'] ?? 'hourly';
        if ( $interval_key === 'custom' && ! empty( $this->options['custom_minutes'] ) ) {
            return absint( $this->options['custom_minutes'] ) * 60;
        }
        $schedules = wp_get_schedules();
        return isset( $schedules[ $interval_key ]['interval'] ) ? $schedules[ $interval_key ]['interval'] : HOUR_IN_SECONDS;
    }

    /**
     * Check if it's time to run the upload, and if so, run it.
     */
    public function maybe_run_upload() {
        // Only run if we have all required settings.
        if ( empty( $this->options['local_path'] ) || empty( $this->options['s3_bucket'] ) ) {
            return;
        }

        $last_run = get_option( self::LAST_RUN_OPTION, 0 );
        $interval = $this->get_interval_seconds();
        $now      = time();

        if ( ( $now - $last_run ) >= $interval ) {
            // Use a transient lock to prevent multiple processes from running simultaneously.
            if ( get_transient( 's3bu_running' ) ) {
                return;
            }
            set_transient( 's3bu_running', true, 5 * MINUTE_IN_SECONDS ); // lock for 5 minutes max

            // Run the upload.
            $this->upload_files_to_s3();

            // Update last run time.
            update_option( self::LAST_RUN_OPTION, $now );

            // Release lock.
            delete_transient( 's3bu_running' );
        }
    }

    /**
     * Resolve the local path: if absolute, return as-is; else prefix with WP_CONTENT_DIR.
     */
    private function resolve_local_path( $path ) {
        if ( empty( $path ) ) {
            return '';
        }
        if ( $path[0] === '/' || ( isset( $path[1] ) && $path[1] === ':' ) ) {
            return $path;
        }
        return trailingslashit( WP_CONTENT_DIR ) . ltrim( $path, '/' );
    }

    /**
     * Generate a timestamped folder name for this backup run.
     */
    private function get_timestamp_folder() {
        return 'backup_' . current_time( 'Y-m-d_H-i-s' );
    }

    /**
     * Build the full S3 key for a file, including timestamp folder.
     *
     * @param string $filename        The base filename.
     * @param string $timestamp_folder The timestamped folder name.
     * @return string The full S3 key.
     */
    private function build_s3_key( $filename, $timestamp_folder ) {
        $prefix = isset( $this->options['s3_path'] ) ? trim( $this->options['s3_path'], '/' ) : '';
        $parts = array_filter( [ $prefix, $timestamp_folder, $filename ] );
        return implode( '/', $parts );
    }

    /**
     * Get the base path (prefix) where all timestamp folders are stored.
     */
    private function get_base_path() {
        return isset( $this->options['s3_path'] ) ? trim( $this->options['s3_path'], '/' ) : '';
    }

    /**
     * Check if a file extension is allowed.
     */
    private function is_extension_allowed( $filename ) {
        if ( empty( $this->options['allowed_extensions'] ) ) {
            return true;
        }
        $ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
        $allowed = array_map( 'strtolower', array_map( 'trim', explode( ',', $this->options['allowed_extensions'] ) ) );
        return in_array( $ext, $allowed, true );
    }

    /**
     * Delete all objects in the bucket that are under the base path but not in the current timestamp folder.
     *
     * @param string $current_folder The current timestamp folder name.
     */
    private function delete_old_backup_folders( $current_folder ) {
        $base_path = $this->get_base_path();
        $prefix = $base_path ? $base_path . '/' : '';

        try {
            // List all objects under the base path.
            $objects = [];
            $continuation_token = null;

            do {
                $args = [
                    'Bucket' => $this->options['s3_bucket'],
                    'Prefix' => $prefix,
                ];
                if ( $continuation_token ) {
                    $args['ContinuationToken'] = $continuation_token;
                }

                $result = $this->s3_client->listObjectsV2( $args );

                if ( isset( $result['Contents'] ) ) {
                    foreach ( $result['Contents'] as $object ) {
                        $key = $object['Key'];
                        // Check if this object is in a different timestamp folder.
                        // The expected pattern is: base_path/backup_YYYY-MM-DD_HH-MM-SS/filename
                        // We'll check if the key contains a timestamp folder different from current_folder.
                        // Simple: if the key starts with $prefix . $current_folder . '/', it's current.
                        $current_key_start = $prefix . $current_folder . '/';
                        if ( strpos( $key, $current_key_start ) !== 0 ) {
                            $objects[] = [ 'Key' => $key ];
                        }
                    }
                }

                $continuation_token = isset( $result['NextContinuationToken'] ) ? $result['NextContinuationToken'] : null;
            } while ( $continuation_token );

            // Delete in batches of 1000.
            if ( ! empty( $objects ) ) {
                $chunks = array_chunk( $objects, 1000 );
                foreach ( $chunks as $chunk ) {
                    $this->s3_client->deleteObjects( [
                        'Bucket' => $this->options['s3_bucket'],
                        'Delete' => [ 'Objects' => $chunk ],
                    ] );
                }
                $this->log( 'Deleted ' . count( $objects ) . ' objects from old backup folders.' );
            }
        } catch ( Exception $e ) {
            $this->log_error( 'Error deleting old backup folders: ' . $e->getMessage() );
        }
    }

    /**
     * Main upload function – can be called manually or by the scheduler.
     */
    public function upload_files_to_s3() {
        $results = [
            'success' => [],
            'errors'  => [],
            'skipped' => [],
        ];

        // Refresh options in case they changed.
        $this->options = get_option( 's3bu_options', [] );

        $local_path = $this->resolve_local_path( $this->options['local_path'] );
        $local_path = trailingslashit( $local_path );

        if ( ! is_dir( $local_path ) ) {
            $this->log_error( "Directory does not exist: {$local_path}" );
            $results['errors'][] = "Directory does not exist: {$local_path}";
            return $results;
        }
        if ( ! is_readable( $local_path ) ) {
            $this->log_error( "Directory not readable: {$local_path}" );
            $results['errors'][] = "Directory not readable: {$local_path}";
            return $results;
        }

        // Initialize S3 client (will throw exception if credentials missing)
        try {
            $this->init_s3_client();
        } catch ( Exception $e ) {
            $this->log_error( 'S3 client init failed: ' . $e->getMessage() );
            $results['errors'][] = 'S3 client init failed: ' . $e->getMessage();
            return $results;
        }

        // Generate timestamp folder for this backup.
        $timestamp_folder = $this->get_timestamp_folder();
        $uploaded_files = 0;

        $files = scandir( $local_path );
        foreach ( $files as $file ) {
            if ( $file === '.' || $file === '..' ) {
                continue;
            }

            $file_path = $local_path . $file;
            if ( ! is_file( $file_path ) ) {
                continue;
            }

            if ( ! $this->is_extension_allowed( $file ) ) {
                $results['skipped'][] = "Skipped (extension not allowed): {$file}";
                continue;
            }

            $s3_key = $this->build_s3_key( $file, $timestamp_folder );

            try {
                $result = $this->s3_client->putObject( [
                    'Bucket'      => $this->options['s3_bucket'],
                    'Key'         => $s3_key,
                    'SourceFile'  => $file_path,
                    'ACL'         => 'public-read',
                    'ContentType' => wp_check_filetype( $file )['type'],
                ] );

                if ( isset( $result['ObjectURL'] ) ) {
                    unlink( $file_path );
                    $results['success'][] = "Uploaded: {$file} → s3://{$this->options['s3_bucket']}/{$s3_key} (deleted local)";
                    $uploaded_files++;
                } else {
                    $results['errors'][] = "Upload failed (no URL): {$file}";
                }
            } catch ( Exception $e ) {
                $results['errors'][] = "Failed to upload {$file}: " . $e->getMessage();
                $this->log_error( "S3 upload error for {$file}: " . $e->getMessage() );
            }
        }

        // If at least one file was uploaded, delete old backup folders.
        if ( $uploaded_files > 0 ) {
            $this->delete_old_backup_folders( $timestamp_folder );
            $results['success'][] = "Cleaned up old backup folders, keeping only: {$timestamp_folder}";
        }

        // If this was a manual run, we return results. For scheduled runs, just log.
        if ( wp_doing_ajax() || ( defined( 'DOING_CRON' ) && DOING_CRON ) ) {
            return $results;
        } else {
            foreach ( $results['success'] as $msg ) {
                $this->log( $msg );
            }
            foreach ( $results['errors'] as $msg ) {
                $this->log_error( $msg );
            }
            foreach ( $results['skipped'] as $msg ) {
                $this->log( $msg );
            }
        }

        return $results;
    }

    private function log( $message ) {
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( 'S3 Backup Uploader: ' . $message );
        }
    }

    private function log_error( $message ) {
        $this->log( 'ERROR: ' . $message );
    }
}

new S3_Backup_Uploader();
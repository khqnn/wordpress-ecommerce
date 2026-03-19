<?php
/**
 * Plugin Name: S3 Media Uploader
 * Description: Offloads media uploads to an S3‑compatible bucket using environment variables.
 * Version: 1.0
 * Author: Khaqan
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Basic plugin constants.
if ( ! defined( 'S3MU_VERSION' ) ) {
    define( 'S3MU_VERSION', '1.0.0' );
}

if ( ! defined( 'S3MU_PLUGIN_URL' ) ) {
    define( 'S3MU_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Add a "Settings" link to the plugin action links.
 */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 's3mu_add_action_links' );
function s3mu_add_action_links( $links ) {
    $settings_link = '<a href="' . admin_url( 'options-general.php?page=s3-media-upload' ) . '">' . __( 'Settings' ) . '</a>';
    // Add the link to the beginning of the array
    array_unshift( $links, $settings_link );
    return $links;
}

// Load settings page class.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-s3-settings.php';

/**
 * Main class for S3 offloading.
 */
class S3_Media_Upload {

    /**
     * @var Aws\S3\S3Client
     */
    private $s3_client;

    /**
     * @var string S3 bucket name.
     */
    private $bucket;

    /**
     * @var string Base URL for public access.
     */
    private $base_url;

    /**
     * @var string S3 region.
     */
    private $region;

    /**
     * @var string|null Custom endpoint.
     */
    private $endpoint;

    /**
     * @var array Attachment IDs that have been processed to avoid loops.
     */
    private $processed_attachments = [];

    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
     * Initialize the plugin: load SDK, read env vars, set hooks.
     */
    public function init() {
        // Load Composer autoloader (assumes it's installed in WordPress root or plugin).
        $autoloader_paths = [
            WP_CONTENT_DIR . '/../vendor/autoload.php',      // WordPress project root
            plugin_dir_path( __FILE__ ) . 'vendor/autoload.php', // inside the plugin
        ];
        $loaded = false;
        foreach ( $autoloader_paths as $path ) {
            if ( file_exists( $path ) ) {
                require_once $path;
                $loaded = true;
                break;
            }
        }

        if ( ! $loaded ) {
            add_action( 'admin_notices', function() {
                echo '<div class="error"><p>S3 Media Upload: AWS SDK not found. Please run <code>composer require aws/aws-sdk-php</code> in your WordPress root or plugin directory.</p></div>';
            } );
            return;
        }

        // Read options from settings page if available, with env vars as fallback.
        $options    = get_option( 's3mu_options', [] );
        $access_key = ! empty( $options['access_key'] ) ? $options['access_key'] : getenv( 'AWS_ACCESS_KEY_ID' );
        $secret_key = ! empty( $options['secret_key'] ) ? $options['secret_key'] : getenv( 'AWS_SECRET_ACCESS_KEY' );
        $this->region   = ! empty( $options['region'] ) ? $options['region'] : getenv( 'AWS_REGION' );
        $this->endpoint = ! empty( $options['endpoint'] ) ? $options['endpoint'] : getenv( 'AWS_ENDPOINT_URL' );
        $this->bucket   = ! empty( $options['bucket'] ) ? $options['bucket'] : getenv( 'S3_IMAGE_BUCKET' );
        $this->base_url = ! empty( $options['base_url'] ) ? $options['base_url'] : getenv( 'S3_FILE_URL' );

        // Basic validation.
        if ( ! $access_key || ! $secret_key || ! $this->region || ! $this->bucket || ! $this->base_url ) {
            add_action( 'admin_notices', function() {
                echo '<div class="error"><p>S3 Media Upload: Missing required environment variables (AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, AWS_REGION, S3_IMAGE_BUCKET, S3_FILE_URL).</p></div>';
            } );
            return;
        }

        // Create S3 client.
        $s3_args = [
            'version'     => 'latest',
            'region'      => $this->region,
            'credentials' => [
                'key'    => $access_key,
                'secret' => $secret_key,
            ],
            'use_path_style_endpoint' => true, // Required for Supabase and most S3‑compatible services.
            'signature_version'        => 'v4',
        ];
        if ( ! empty( $this->endpoint ) ) {
            $s3_args['endpoint'] = $this->endpoint;
        }
        $this->s3_client = new Aws\S3\S3Client( $s3_args );

        // Hook into WordPress.
        add_filter( 'wp_generate_attachment_metadata', [ $this, 'upload_to_s3' ], 10, 2 );
        add_action( 'delete_attachment', [ $this, 'delete_from_s3' ] );
        add_filter( 'wp_get_attachment_url', [ $this, 'rewrite_attachment_url' ], 10, 2 );
        add_filter( 'wp_calculate_image_srcset', [ $this, 'rewrite_srcset_urls' ], 10, 5 );
    }

    /**
     * Upload attachment files (original + all thumbnails) to S3.
     *
     * @param array $metadata      Attachment metadata.
     * @param int   $attachment_id Attachment ID.
     * @return array
     */
    public function upload_to_s3( $metadata, $attachment_id ) {
        // Avoid processing the same attachment twice.
        if ( in_array( $attachment_id, $this->processed_attachments, true ) ) {
            return $metadata;
        }
        $this->processed_attachments[] = $attachment_id;

        // Get the upload directory info.
        $upload_dir = wp_upload_dir();
        $basedir    = $upload_dir['basedir'];

        // Get attachment file path.
        $file_path = get_attached_file( $attachment_id );
        if ( ! $file_path || ! file_exists( $file_path ) ) {
            return $metadata;
        }

        // Determine the S3 key (relative path).
        $relative_path = str_replace( $basedir . '/', '', $file_path );

        // Upload original file.
        $upload_ok = $this->upload_file( $file_path, $relative_path );

        // Upload all thumbnail sizes.
        if ( isset( $metadata['sizes'] ) && is_array( $metadata['sizes'] ) ) {
            foreach ( $metadata['sizes'] as $size => $size_data ) {
                $size_file = dirname( $file_path ) . '/' . $size_data['file'];
                if ( file_exists( $size_file ) ) {
                    $size_relative_path = str_replace( $basedir . '/', '', $size_file );
                    if ( ! $this->upload_file( $size_file, $size_relative_path ) ) {
                        $upload_ok = false;
                    }
                }
            }
        }

        // Store the S3 base URL in post meta for easy retrieval.
        update_post_meta( $attachment_id, '_s3_base_url', $this->base_url );
        update_post_meta( $attachment_id, '_s3_key', $relative_path );

        // Remove local files after successful S3 upload so WordPress does not use local uploads.
        if ( $upload_ok ) {
            $this->delete_local_attachment_files( $file_path, $metadata );
        }

        return $metadata;
    }

    /**
     * Delete local attachment files (original + thumbnails) after they are on S3.
     * Keeps WordPress from serving or relying on local uploads for this attachment.
     *
     * @param string $file_path Full path to the main attachment file.
     * @param array  $metadata  Attachment metadata (with 'sizes').
     */
    private function delete_local_attachment_files( $file_path, $metadata ) {
        if ( ! $file_path || ! file_exists( $file_path ) ) {
            return;
        }
        $deleted = @unlink( $file_path );
        if ( $deleted ) {
            error_log( 'S3 Media Upload: Removed local file ' . $file_path );
        }
        if ( isset( $metadata['sizes'] ) && is_array( $metadata['sizes'] ) ) {
            $dir = dirname( $file_path );
            foreach ( $metadata['sizes'] as $size_data ) {
                if ( empty( $size_data['file'] ) ) {
                    continue;
                }
                $size_file = $dir . '/' . $size_data['file'];
                if ( file_exists( $size_file ) ) {
                    @unlink( $size_file );
                }
            }
        }
    }

    /**
     * Upload a single file to S3 with public read permissions.
     *
     * @param string $local_path  Full local path.
     * @param string $s3_key      Key in bucket (relative path).
     * @return bool
     */
    private function upload_file( $local_path, $s3_key ) {
        try {
            $this->s3_client->putObject( [
                'Bucket'      => $this->bucket,
                'Key'         => $s3_key,
                'SourceFile'  => $local_path,
                'ACL'         => 'public-read',  // Make file publicly accessible
                'ContentType' => wp_check_filetype( $local_path )['type'],
            ] );
            return true;
        } catch ( Exception $e ) {
            error_log( 'S3 upload error: ' . $e->getMessage() );
            return false;
        }
    }

    /**
     * Delete attachment files from S3 when attachment is deleted.
     *
     * @param int $attachment_id
     */
    public function delete_from_s3( $attachment_id ) {
        $metadata = wp_get_attachment_metadata( $attachment_id );
        if ( ! $metadata ) {
            return;
        }

        $upload_dir = wp_upload_dir();
        $basedir    = $upload_dir['basedir'];
        $file_path  = get_attached_file( $attachment_id );
        if ( ! $file_path ) {
            return;
        }
        $relative_path = str_replace( $basedir . '/', '', $file_path );

        // Build list of keys to delete (original + thumbnails).
        $keys = [ $relative_path ];
        if ( isset( $metadata['sizes'] ) && is_array( $metadata['sizes'] ) ) {
            foreach ( $metadata['sizes'] as $size_data ) {
                $size_file = dirname( $file_path ) . '/' . $size_data['file'];
                $keys[] = str_replace( $basedir . '/', '', $size_file );
            }
        }

        // Delete objects from S3.
        try {
            $this->s3_client->deleteObjects( [
                'Bucket'  => $this->bucket,
                'Delete'  => [
                    'Objects' => array_map( function( $key ) {
                        return [ 'Key' => $key ];
                    }, $keys ),
                ],
            ] );
        } catch ( Exception $e ) {
            error_log( 'S3 delete error: ' . $e->getMessage() );
        }
    }

    /**
     * Rewrite attachment URL to point to S3.
     *
     * @param string $url           Original local URL.
     * @param int    $attachment_id
     * @return string
     */
    public function rewrite_attachment_url( $url, $attachment_id ) {
        // Skip if no S3 base URL is stored.
        $s3_base = get_post_meta( $attachment_id, '_s3_base_url', true );
        $s3_key  = get_post_meta( $attachment_id, '_s3_key', true );
        if ( $s3_base && $s3_key ) {
            // For sub‑directories, we need the path relative to uploads.
            // The stored key already includes the uploads subpath, e.g. "2025/03/image.jpg".
            return trailingslashit( $s3_base ) . $s3_key;
        }
        return $url;
    }

    /**
     * Rewrite srcset URLs to use S3.
     *
     * @param array  $sources       Array of image sources.
     * @param array  $size_array    Requested size.
     * @param string $image_src     Original src.
     * @param array  $image_meta    Attachment metadata.
     * @param int    $attachment_id
     * @return array
     */
    public function rewrite_srcset_urls( $sources, $size_array, $image_src, $image_meta, $attachment_id ) {
        $s3_base = get_post_meta( $attachment_id, '_s3_base_url', true );
        if ( ! $s3_base ) {
            return $sources;
        }

        $upload_dir = wp_upload_dir();
        $baseurl    = $upload_dir['baseurl'];

        foreach ( $sources as $width => $source ) {
            // Replace the local base URL with the S3 base URL.
            $sources[ $width ]['url'] = str_replace( $baseurl, $s3_base, $source['url'] );
        }
        return $sources;
    }
}

// Instantiate the plugin and settings page.
new S3_Media_Upload();
new S3MU_Settings();
<?php
/**
 * Settings page for S3 Backup Uploader.
 */
class S3BU_Settings {

    const OPTION_NAME = 's3bu_options';

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
        add_action( 'admin_post_s3bu_run_now', [ $this, 'handle_manual_run' ] );
        add_action( 'admin_notices', [ $this, 'show_manual_run_results' ] );
    }

    public function add_settings_page() {
        add_options_page(
            'S3 Backup Uploader',
            'S3 Backup Uploader',
            'manage_options',
            's3-backup-uploader',
            [ $this, 'render_settings_page' ]
        );
    }

    public function render_settings_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        ?>
        <div class="wrap">
            <h1>S3 Backup Uploader Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 's3bu_settings_group' );
                do_settings_sections( 's3-backup-uploader' );
                submit_button();
                ?>
            </form>
            <hr>
            <h2>Manual Run</h2>
            <p>Click the button below to run the upload immediately.</p>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="s3bu_run_now">
                <?php wp_nonce_field( 's3bu_run_now', 's3bu_nonce' ); ?>
                <?php submit_button( 'Run Now', 'secondary', 'submit', false ); ?>
            </form>
        </div>

        <script>
        jQuery(document).ready(function($) {
            var $intervalSelect = $('select[name="<?php echo self::OPTION_NAME; ?>[interval]"]');
            var $customRow = $('#custom-minutes-row').closest('tr');

            function toggleCustomField() {
                if ($intervalSelect.val() === 'custom') {
                    $customRow.show();
                } else {
                    $customRow.hide();
                }
            }

            toggleCustomField();
            $intervalSelect.on('change', toggleCustomField);
        });
        </script>
        <?php
    }

    public function show_manual_run_results() {
        $results = get_transient( 's3bu_manual_results' );
        if ( $results ) {
            delete_transient( 's3bu_manual_results' );
            if ( ! empty( $results['success'] ) ) {
                echo '<div class="notice notice-success"><p><strong>Manual upload completed:</strong></p><ul>';
                foreach ( $results['success'] as $msg ) {
                    echo '<li>' . esc_html( $msg ) . '</li>';
                }
                echo '</ul></div>';
            }
            if ( ! empty( $results['errors'] ) ) {
                echo '<div class="notice notice-error"><p><strong>Errors during manual upload:</strong></p><ul>';
                foreach ( $results['errors'] as $msg ) {
                    echo '<li>' . esc_html( $msg ) . '</li>';
                }
                echo '</ul></div>';
            }
            if ( ! empty( $results['skipped'] ) ) {
                echo '<div class="notice notice-warning"><p><strong>Skipped files (extension not allowed):</strong></p><ul>';
                foreach ( $results['skipped'] as $msg ) {
                    echo '<li>' . esc_html( $msg ) . '</li>';
                }
                echo '</ul></div>';
            }
        }
    }

    public function register_settings() {
        register_setting(
            's3bu_settings_group',
            self::OPTION_NAME,
            [ $this, 'sanitize_options' ]
        );

        add_settings_section(
            's3bu_main_section',
            'AWS & Directory Settings',
            null,
            's3-backup-uploader'
        );

        $fields = [
            'aws_access_key' => 'AWS Access Key ID',
            'aws_secret_key' => 'AWS Secret Access Key',
            'aws_region'     => 'AWS Region',
            's3_bucket'      => 'S3 Bucket Name',
            's3_path'        => 'S3 Path Prefix (optional)',
            'endpoint'       => 'Custom Endpoint (optional)',
            'local_path'     => 'Local Directory Path',
            'allowed_extensions' => 'Allowed File Extensions (optional)',
            'interval'       => 'Backup Interval',
        ];

        foreach ( $fields as $field => $label ) {
            add_settings_field(
                $field,
                $label,
                [ $this, "render_{$field}_field" ],
                's3-backup-uploader',
                's3bu_main_section'
            );
        }

        add_settings_field(
            'custom_minutes',
            'Custom Minutes',
            [ $this, 'render_custom_minutes_field' ],
            's3-backup-uploader',
            's3bu_main_section'
        );
    }

    public function render_aws_access_key_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['aws_access_key'] ) ? $options['aws_access_key'] : '';
        echo '<input type="text" name="' . self::OPTION_NAME . '[aws_access_key]" value="' . esc_attr( $value ) . '" class="regular-text">';
    }

    public function render_aws_secret_key_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['aws_secret_key'] ) ? $options['aws_secret_key'] : '';
        echo '<input type="password" name="' . self::OPTION_NAME . '[aws_secret_key]" value="' . esc_attr( $value ) . '" class="regular-text">';
    }

    public function render_aws_region_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['aws_region'] ) ? $options['aws_region'] : '';
        echo '<input type="text" name="' . self::OPTION_NAME . '[aws_region]" value="' . esc_attr( $value ) . '" class="regular-text" placeholder="e.g. us-east-1">';
    }

    public function render_s3_bucket_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['s3_bucket'] ) ? $options['s3_bucket'] : '';
        echo '<input type="text" name="' . self::OPTION_NAME . '[s3_bucket]" value="' . esc_attr( $value ) . '" class="regular-text">';
    }

    public function render_s3_path_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['s3_path'] ) ? $options['s3_path'] : '';
        echo '<input type="text" name="' . self::OPTION_NAME . '[s3_path]" value="' . esc_attr( $value ) . '" class="regular-text" placeholder="backups/ or mysite/backups">';
        echo '<p class="description">Optional subfolder inside the bucket. Leave empty to upload to the bucket root. Do not start or end with a slash – we’ll add it automatically.</p>';
    }

    public function render_endpoint_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['endpoint'] ) ? $options['endpoint'] : '';
        echo '<input type="text" name="' . self::OPTION_NAME . '[endpoint]" value="' . esc_attr( $value ) . '" class="regular-text" placeholder="https://s3.example.com">';
        echo '<p class="description">Optional custom endpoint for S3-compatible services (e.g., MinIO, Supabase). Leave empty for AWS.</p>';
    }

    public function render_local_path_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['local_path'] ) ? $options['local_path'] : '';
        echo '<input type="text" name="' . self::OPTION_NAME . '[local_path]" value="' . esc_attr( $value ) . '" class="regular-text" placeholder="uploads/backups or /absolute/path">';
        echo '<p class="description">';
        echo 'Relative to <code>wp-content</code> (e.g., <code>uploads/backups</code>) or absolute path (starting with /). ';
        echo 'The resolved absolute path is shown below after saving.';
        echo '</p>';

        if ( ! empty( $value ) ) {
            $resolved = $this->resolve_local_path_helper( $value );
            echo '<p><strong>Resolved path:</strong> ' . esc_html( $resolved ) . '</p>';
            if ( is_dir( $resolved ) ) {
                $status = [];
                if ( is_readable( $resolved ) ) {
                    $status[] = 'Readable.';
                } else {
                    $status[] = '<span style="color:red">Not readable!</span>';
                }
                if ( is_writable( $resolved ) ) {
                    $status[] = 'Writable.';
                } else {
                    $status[] = '<span style="color:red">Not writable!</span>';
                }
                echo '<p><strong>Status:</strong> ' . implode( ' ', $status ) . '</p>';
            } else {
                echo '<p><span style="color:red">Directory does not exist.</span></p>';
            }
        }
    }

    private function resolve_local_path_helper( $path ) {
        if ( empty( $path ) ) {
            return '';
        }
        if ( $path[0] === '/' || ( isset( $path[1] ) && $path[1] === ':' ) ) {
            return $path;
        }
        return trailingslashit( WP_CONTENT_DIR ) . ltrim( $path, '/' );
    }

    public function render_allowed_extensions_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['allowed_extensions'] ) ? $options['allowed_extensions'] : '';
        echo '<input type="text" name="' . self::OPTION_NAME . '[allowed_extensions]" value="' . esc_attr( $value ) . '" class="regular-text" placeholder="zip,tar,gz,sql">';
        echo '<p class="description">Comma-separated list of file extensions to upload (e.g., <code>zip,tar,sql</code>). Leave empty to upload all files.</p>';
    }

    public function render_interval_field() {
        $options = get_option( self::OPTION_NAME );
        $current = isset( $options['interval'] ) ? $options['interval'] : 'hourly';
        $schedules = wp_get_schedules();
        ?>
        <select name="<?php echo self::OPTION_NAME; ?>[interval]">
            <?php foreach ( $schedules as $key => $schedule ) : ?>
                <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $current, $key ); ?>>
                    <?php echo esc_html( $schedule['display'] ); ?>
                </option>
            <?php endforeach; ?>
            <option value="custom" <?php selected( $current, 'custom' ); ?>>Custom (minutes)</option>
        </select>
        <p class="description">How often to check the directory and upload files.</p>
        <?php
    }

    public function render_custom_minutes_field() {
        $options = get_option( self::OPTION_NAME );
        $value = isset( $options['custom_minutes'] ) ? $options['custom_minutes'] : '';
        echo '<input type="number" id="custom-minutes-row" name="' . self::OPTION_NAME . '[custom_minutes]" value="' . esc_attr( $value ) . '" class="small-text" min="1" step="1"> minutes';
        echo '<p class="description">Only used when interval is set to "Custom". Enter a positive integer.</p>';
        echo '<style>#custom-minutes-row { display: none; }</style>';
    }

    public function sanitize_options( $input ) {
        $output = [];

        $output['aws_access_key'] = sanitize_text_field( $input['aws_access_key'] );
        $output['aws_secret_key'] = sanitize_text_field( $input['aws_secret_key'] );
        $output['aws_region']     = sanitize_text_field( $input['aws_region'] );
        $output['s3_bucket']      = sanitize_text_field( $input['s3_bucket'] );
        $output['s3_path']        = isset( $input['s3_path'] ) ? sanitize_text_field( $input['s3_path'] ) : '';
        $output['endpoint']       = isset( $input['endpoint'] ) ? sanitize_text_field( $input['endpoint'] ) : '';
        $output['local_path']     = sanitize_text_field( $input['local_path'] );
        $output['allowed_extensions'] = isset( $input['allowed_extensions'] ) ? sanitize_text_field( $input['allowed_extensions'] ) : '';
        $output['interval']       = sanitize_text_field( $input['interval'] );

        if ( $output['interval'] === 'custom' ) {
            $minutes = isset( $input['custom_minutes'] ) ? absint( $input['custom_minutes'] ) : 0;
            if ( $minutes < 1 ) {
                // add_settings_error( self::OPTION_NAME, 'invalid_minutes', 'Custom minutes must be at least 1.' );
                $minutes = 2;
            }
            $output['custom_minutes'] = $minutes;
        } else {
            $output['custom_minutes'] = '';
        }

        if ( ! empty( $output['local_path'] ) ) {
            $resolved = $this->resolve_local_path_helper( $output['local_path'] );
            if ( ! is_dir( $resolved ) ) {
                add_settings_error( self::OPTION_NAME, 'invalid_path', 'The local directory does not exist. Resolved path: ' . $resolved );
            } elseif ( ! is_readable( $resolved ) ) {
                add_settings_error( self::OPTION_NAME, 'invalid_path', 'The local directory is not readable. Resolved path: ' . $resolved );
            } elseif ( ! is_writable( $resolved ) ) {
                add_settings_error( self::OPTION_NAME, 'invalid_path', 'The local directory is not writable (needed to delete files after upload). Resolved path: ' . $resolved );
            }
        }

        return $output;
    }

    public function handle_manual_run() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Unauthorized' );
        }
        check_admin_referer( 's3bu_run_now', 's3bu_nonce' );

        $plugin = new S3_Backup_Uploader();
        $results = $plugin->upload_files_to_s3();

        set_transient( 's3bu_manual_results', $results, 60 );

        wp_redirect( add_query_arg( 's3bu_run', 'done', wp_get_referer() ) );
        exit;
    }
}

new S3BU_Settings();
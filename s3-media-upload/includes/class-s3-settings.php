<?php
/**
 * Settings page and AJAX test handler.
 */
class S3MU_Settings {

    private $options_group = 's3mu_settings';
    private $option_name   = 's3mu_options';

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
        add_action( 'wp_ajax_s3mu_test_connection', [ $this, 'ajax_test_connection' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
        add_action( 'admin_init', [ $this, 'handle_clean_local_uploads' ] );
        add_action( 'admin_notices', [ $this, 'clean_local_uploads_notice' ] );
    }

    public function add_settings_page() {
        add_options_page(
            __( 'S3 Media Upload Settings', 's3-media-upload' ),
            __( 'S3 Media Upload', 's3-media-upload' ),
            'manage_options',
            's3-media-upload',
            [ $this, 'render_settings_page' ]
        );
    }

    public function register_settings() {
        register_setting( $this->options_group, $this->option_name, [ $this, 'sanitize_options' ] );

        add_settings_section(
            's3mu_main',
            __( 'S3 Connection Settings', 's3-media-upload' ),
            null,
            's3-media-upload'
        );

        $fields = [
            'access_key' => 'Access Key ID',
            'secret_key' => 'Secret Access Key',
            'region'     => 'Region',
            'bucket'     => 'Bucket Name',
            'endpoint'   => 'Endpoint URL (optional, for S3-compatible services)',
            'base_url'   => 'Public Base URL',
        ];

        foreach ( $fields as $field => $label ) {
            add_settings_field(
                $field,
                __( $label, 's3-media-upload' ),
                [ $this, 'field_callback' ],
                's3-media-upload',
                's3mu_main',
                [ 'field' => $field, 'label' => $label ]
            );
        }
    }

    public function field_callback( $args ) {
        $options = get_option( $this->option_name );
        $field   = $args['field'];
        $value   = isset( $options[ $field ] ) ? $options[ $field ] : '';
        $type    = ( $field === 'secret_key' ) ? 'password' : 'text';
        ?>
        <input type="<?php echo esc_attr( $type ); ?>" 
               name="<?php echo esc_attr( $this->option_name . '[' . $field . ']' ); ?>" 
               value="<?php echo esc_attr( $value ); ?>" 
               class="regular-text" 
               autocomplete="off"
               data-s3mu-field="<?php echo esc_attr( $field ); ?>">
        <?php if ( $field === 'endpoint' ) : ?>
            <p class="description">Leave empty for standard AWS S3. For Supabase, use something like:<br> <code>https://project.supabase.co/storage/v1/s3</code></p>
        <?php elseif ( $field === 'base_url' ) : ?>
            <p class="description">Public URL where files are accessible, e.g. <code>https://bucket.s3.region.amazonaws.com</code> or <code>https://project.supabase.co/storage/v1/object/public/bucket</code></p>
        <?php endif; ?>
        <?php
    }

    public function sanitize_options( $input ) {
        $sanitized = [];
        $fields = [ 'access_key', 'secret_key', 'region', 'bucket', 'endpoint', 'base_url' ];
        foreach ( $fields as $field ) {
            if ( isset( $input[ $field ] ) ) {
                $sanitized[ $field ] = sanitize_text_field( $input[ $field ] );
            }
        }
        return $sanitized;
    }

    public function render_settings_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?php _e( 'S3 Media Upload Settings', 's3-media-upload' ); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( $this->options_group );
                do_settings_sections( 's3-media-upload' );
                submit_button();
                ?>
            </form>

            <hr>
            <h2><?php _e( 'Test Connection', 's3-media-upload' ); ?></h2>
            <p><?php _e( 'Click the button below to verify that the credentials and bucket are working.', 's3-media-upload' ); ?></p>
            <button type="button" id="s3mu-test-connection" class="button button-secondary">
                <?php _e( 'Test Connection', 's3-media-upload' ); ?>
            </button>
            <span id="s3mu-test-result" style="margin-left: 15px;"></span>
            <div id="s3mu-test-details" style="margin-top: 10px; padding: 10px; background: #f1f1f1; display: none;"></div>

            <hr>
            <h2><?php _e( 'Local uploads', 's3-media-upload' ); ?></h2>
            <p><?php _e( 'Remove local copies of media that are already on S3. This frees disk space; images will continue to load from S3. Only files for attachments that have been offloaded are deleted.', 's3-media-upload' ); ?></p>
            <?php
            $clean_nonce = wp_create_nonce( 's3mu_clean_local_uploads' );
            $clean_url   = add_query_arg( [ 's3mu_clean_local' => '1', '_wpnonce' => $clean_nonce ], admin_url( 'options-general.php?page=s3-media-upload' ) );
            ?>
            <a href="<?php echo esc_url( $clean_url ); ?>" class="button button-secondary" onclick="return confirm('<?php echo esc_js( __( 'Delete local files for all offloaded media? This cannot be undone.', 's3-media-upload' ) ); ?>');">
                <?php _e( 'Remove local copies of offloaded media', 's3-media-upload' ); ?>
            </a>
        </div>
        <?php
    }

    /**
     * Handle one-time cleanup: delete local files for attachments that are on S3.
     */
    public function handle_clean_local_uploads() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        if ( empty( $_GET['s3mu_clean_local'] ) || empty( $_GET['_wpnonce'] ) ) {
            return;
        }
        if ( ! wp_verify_nonce( $_GET['_wpnonce'], 's3mu_clean_local_uploads' ) ) {
            wp_die( __( 'Invalid request.', 's3-media-upload' ) );
        }
        $deleted = $this->clean_local_uploads_for_offloaded();
        $redirect = add_query_arg( 's3mu_cleaned', (int) $deleted, admin_url( 'options-general.php?page=s3-media-upload' ) );
        wp_safe_redirect( $redirect );
        exit;
    }

    /**
     * Delete local files for all attachments that have _s3_key (offloaded to S3).
     *
     * @return int Number of local files deleted.
     */
    public function clean_local_uploads_for_offloaded() {
        global $wpdb;
        $deleted_count = 0;
        $upload_dir    = wp_upload_dir();
        $basedir       = $upload_dir['basedir'];

        $ids = $wpdb->get_col(
            "SELECT p.ID FROM {$wpdb->posts} p
             INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_s3_key' AND pm.meta_value != ''
             WHERE p.post_type = 'attachment'"
        );
        if ( empty( $ids ) ) {
            return 0;
        }

        foreach ( $ids as $attachment_id ) {
            $file_path = get_attached_file( $attachment_id );
            if ( ! $file_path || ! file_exists( $file_path ) ) {
                continue;
            }
            $metadata = wp_get_attachment_metadata( $attachment_id );
            $dir      = dirname( $file_path );
            if ( @unlink( $file_path ) ) {
                $deleted_count++;
            }
            if ( isset( $metadata['sizes'] ) && is_array( $metadata['sizes'] ) ) {
                foreach ( $metadata['sizes'] as $size_data ) {
                    if ( empty( $size_data['file'] ) ) {
                        continue;
                    }
                    $size_file = $dir . '/' . $size_data['file'];
                    if ( file_exists( $size_file ) && @unlink( $size_file ) ) {
                        $deleted_count++;
                    }
                }
            }
        }

        return $deleted_count;
    }

    public function enqueue_admin_scripts( $hook ) {
        if ( 'settings_page_s3-media-upload' !== $hook ) {
            return;
        }
        wp_enqueue_script( 's3mu-admin', S3MU_PLUGIN_URL . 'assets/admin.js', [ 'jquery' ], S3MU_VERSION, true );
        wp_localize_script( 's3mu-admin', 's3mu_ajax', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 's3mu_test_connection' ),
        ] );
    }

    public function ajax_test_connection() {
        check_ajax_referer( 's3mu_test_connection', 'nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Unauthorized' );
        }

        // Get current saved options.
        $options = get_option( $this->option_name, [] );
        $access_key = isset( $options['access_key'] ) ? $options['access_key'] : '';
        $secret_key = isset( $options['secret_key'] ) ? $options['secret_key'] : '';
        $region     = isset( $options['region'] ) ? $options['region'] : '';
        $bucket     = isset( $options['bucket'] ) ? $options['bucket'] : '';
        $endpoint   = isset( $options['endpoint'] ) ? $options['endpoint'] : '';
        $base_url   = isset( $options['base_url'] ) ? $options['base_url'] : '';

        // Use posted values if available (so we can test unsaved settings).
        if ( isset( $_POST['access_key'] ) ) {
            $access_key = sanitize_text_field( $_POST['access_key'] );
        }
        if ( isset( $_POST['secret_key'] ) ) {
            $secret_key = sanitize_text_field( $_POST['secret_key'] );
        }
        if ( isset( $_POST['region'] ) ) {
            $region = sanitize_text_field( $_POST['region'] );
        }
        if ( isset( $_POST['bucket'] ) ) {
            $bucket = sanitize_text_field( $_POST['bucket'] );
        }
        if ( isset( $_POST['endpoint'] ) ) {
            $endpoint = sanitize_text_field( $_POST['endpoint'] );
        }
        if ( isset( $_POST['base_url'] ) ) {
            $base_url = sanitize_text_field( $_POST['base_url'] );
        }

        // Validate required fields.
        if ( empty( $access_key ) || empty( $secret_key ) || empty( $region ) || empty( $bucket ) ) {
            wp_send_json_error( 'Missing required fields: Access Key, Secret Key, Region, and Bucket are mandatory.' );
        }

        // Build S3 client.
        try {
            $args = [
                'version'     => 'latest',
                'region'      => $region,
                'credentials' => [
                    'key'    => $access_key,
                    'secret' => $secret_key,
                ],
                'use_path_style_endpoint' => true,
                'signature_version'        => 'v4',
            ];
            if ( ! empty( $endpoint ) ) {
                $args['endpoint'] = $endpoint;
            }
            $s3 = new Aws\S3\S3Client( $args );

            // Try to list objects in the bucket (limit 1).
            $result = $s3->listObjectsV2( [
                'Bucket'  => $bucket,
                'MaxKeys' => 1,
            ] );

            // If we get here, bucket exists and credentials work.
            $message = sprintf( 'Connection successful. Bucket "%s" is accessible.', $bucket );
            wp_send_json_success( $message );

        } catch ( Exception $e ) {
            wp_send_json_error( 'Connection failed: ' . $e->getMessage() );
        }
    }

    public function clean_local_uploads_notice() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        if ( isset( $_GET['s3mu_cleaned'] ) && $_GET['s3mu_cleaned'] !== '' ) {
            $n = (int) $_GET['s3mu_cleaned'];
            $msg = $n === 0
                ? __( 'No local files to remove (or they were already deleted).', 's3-media-upload' )
                : sprintf( _n( 'Removed %d local file.', 'Removed %d local files.', $n, 's3-media-upload' ), $n );
            echo '<div class="notice notice-success is-dismissible"><p>' . esc_html( $msg ) . '</p></div>';
        }
    }
}
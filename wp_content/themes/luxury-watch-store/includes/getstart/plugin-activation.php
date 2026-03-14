<?php
if ( ! class_exists( 'Luxury_Watch_Store_Plugin_Activation_WPElemento_Importer' ) ) {
    /**
     * Luxury_Watch_Store_Plugin_Activation_WPElemento_Importer initial setup
     *
     * @since 1.6.2
     */

    class Luxury_Watch_Store_Plugin_Activation_WPElemento_Importer {

        private static $luxury_watch_store_instance;
        public $luxury_watch_store_action_count;
        public $luxury_watch_store_recommended_actions;

        /** Initiator **/
        public static function get_instance() {
          if ( ! isset( self::$luxury_watch_store_instance) ) {
            self::$luxury_watch_store_instance = new self();
          }
          return self::$luxury_watch_store_instance;
        }

        /*  Constructor */
        public function __construct() {

            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

            // ---------- wpelementoimpoter Plugin Activation -------
            add_filter( 'luxury_watch_store_recommended_plugins', array($this, 'luxury_watch_store_recommended_elemento_importer_plugins_array') );

            $luxury_watch_store_actions                   = $this->luxury_watch_store_get_recommended_actions();
            $this->luxury_watch_store_action_count        = $luxury_watch_store_actions['count'];
            $this->luxury_watch_store_recommended_actions = $luxury_watch_store_actions['actions'];

            add_action( 'wp_ajax_create_pattern_setup_builder', array( $this, 'create_pattern_setup_builder' ) );
        }

        public function luxury_watch_store_recommended_elemento_importer_plugins_array($luxury_watch_store_plugins){
            $luxury_watch_store_plugins[] = array(
                    'name'     => esc_html__('WPElemento Importer', 'luxury-watch-store'),
                    'slug'     =>  'wpelemento-importer',
                    'function' => 'WPElemento_Importer_ThemeWhizzie',
                    'desc'     => esc_html__('We highly recommend installing the WPElemento Importer plugin for importing the demo content with Elementor.', 'luxury-watch-store'),               
            );
            return $luxury_watch_store_plugins;
        }

        public function enqueue_scripts() {
            wp_enqueue_script('updates');      
            wp_register_script( 'luxury-watch-store-plugin-activation-script', esc_url(get_template_directory_uri()) . '/includes/getstart/js/plugin-activation.js', array('jquery') );
            wp_localize_script('luxury-watch-store-plugin-activation-script', 'luxury_watch_store_plugin_activate_plugin',
                array(
                    'installing' => esc_html__('Installing', 'luxury-watch-store'),
                    'activating' => esc_html__('Activating', 'luxury-watch-store'),
                    'error' => esc_html__('Error', 'luxury-watch-store'),
                    'ajax_url' => esc_url(admin_url('admin-ajax.php')),
                    'wpelementoimpoter_admin_url' => esc_url(admin_url('admin.php?page=wpelemento-importer-tgmpa-install-plugins')),
                    'addon_admin_url' => esc_url(admin_url('admin.php?page=wpelementoimporter-wizard'))
                )
            );
            wp_enqueue_script( 'luxury-watch-store-plugin-activation-script' );

        }

        // --------- Plugin Actions ---------
        public function luxury_watch_store_get_recommended_actions() {

            $luxury_watch_store_act_count  = 0;
            $luxury_watch_store_actions_todo = get_option( 'recommending_actions', array());

            $luxury_watch_store_plugins = $this->luxury_watch_store_get_recommended_plugins();

            if ($luxury_watch_store_plugins) {
                foreach ($luxury_watch_store_plugins as $luxury_watch_store_key => $luxury_watch_store_plugin) {
                    $luxury_watch_store_action = array();
                    if (!isset($luxury_watch_store_plugin['slug'])) {
                        continue;
                    }

                    $luxury_watch_store_action['id']   = 'install_' . $luxury_watch_store_plugin['slug'];
                    $luxury_watch_store_action['desc'] = '';
                    if (isset($luxury_watch_store_plugin['desc'])) {
                        $luxury_watch_store_action['desc'] = $luxury_watch_store_plugin['desc'];
                    }

                    $luxury_watch_store_action['name'] = '';
                    if (isset($luxury_watch_store_plugin['name'])) {
                        $luxury_watch_store_action['title'] = $luxury_watch_store_plugin['name'];
                    }

                    $luxury_watch_store_link_and_is_done  = $this->luxury_watch_store_get_plugin_buttion($luxury_watch_store_plugin['slug'], $luxury_watch_store_plugin['name'], $luxury_watch_store_plugin['function']);
                    $luxury_watch_store_action['link']    = $luxury_watch_store_link_and_is_done['button'];
                    $luxury_watch_store_action['is_done'] = $luxury_watch_store_link_and_is_done['done'];
                    if (!$luxury_watch_store_action['is_done'] && (!isset($luxury_watch_store_actions_todo[$luxury_watch_store_action['id']]) || !$luxury_watch_store_actions_todo[$luxury_watch_store_action['id']])) {
                        $luxury_watch_store_act_count++;
                    }
                    $luxury_watch_store_recommended_actions[] = $luxury_watch_store_action;
                    $luxury_watch_store_actions_todo[]        = array('id' => $luxury_watch_store_action['id'], 'watch' => true);
                }
                return array('count' => $luxury_watch_store_act_count, 'actions' => $luxury_watch_store_recommended_actions);
            }

        }

        public function luxury_watch_store_get_recommended_plugins() {

            $luxury_watch_store_plugins = apply_filters('luxury_watch_store_recommended_plugins', array());
            return $luxury_watch_store_plugins;
        }

        public function luxury_watch_store_get_plugin_buttion($slug, $name, $function) {
                $luxury_watch_store_is_done      = false;
                $luxury_watch_store_button_html  = '';
                $luxury_watch_store_is_installed = $this->is_plugin_installed($slug);
                $luxury_watch_store_plugin_path  = $this->get_plugin_basename_from_slug($slug);
                $luxury_watch_store_is_activeted = (class_exists($function)) ? true : false;
                if (!$luxury_watch_store_is_installed) {
                    $luxury_watch_store_plugin_install_url = add_query_arg(
                        array(
                            'action' => 'install-plugin',
                            'plugin' => $slug,
                        ),
                        self_admin_url('update.php')
                    );
                    $luxury_watch_store_plugin_install_url = wp_nonce_url($luxury_watch_store_plugin_install_url, 'install-plugin_' . esc_attr($slug));
                    $luxury_watch_store_button_html        = sprintf('<a class="luxury-watch-store-plugin-install install-now button-secondary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($luxury_watch_store_plugin_install_url),
                        sprintf(esc_html__('Install %s Now', 'luxury-watch-store'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Install & Activate', 'luxury-watch-store')
                    );
                } elseif ($luxury_watch_store_is_installed && !$luxury_watch_store_is_activeted) {

                    $luxury_watch_store_plugin_activate_link = add_query_arg(
                        array(
                            'action'        => 'activate',
                            'plugin'        => rawurlencode($luxury_watch_store_plugin_path),
                            'plugin_status' => 'all',
                            'paged'         => '1',
                            '_wpnonce'      => wp_create_nonce('activate-plugin_' . $luxury_watch_store_plugin_path),
                        ), self_admin_url('plugins.php')
                    );

                    $luxury_watch_store_button_html = sprintf('<a class="luxury-watch-store-plugin-activate activate-now button-primary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($luxury_watch_store_plugin_activate_link),
                        sprintf(esc_html__('Activate %s Now', 'luxury-watch-store'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Activate', 'luxury-watch-store')
                    );
                } elseif ($luxury_watch_store_is_activeted) {
                    $luxury_watch_store_button_html = sprintf('<div class="action-link button disabled"><span class="dashicons dashicons-yes"></span> %s</div>', esc_html__('Active', 'luxury-watch-store'));
                    $luxury_watch_store_is_done     = true;
                }

                return array('done' => $luxury_watch_store_is_done, 'button' => $luxury_watch_store_button_html);
            }
        public function is_plugin_installed($slug) {
            $luxury_watch_store_installed_plugins = $this->get_installed_plugins(); // Retrieve a list of all installed plugins (WP cached).
            $luxury_watch_store_file_path         = $this->get_plugin_basename_from_slug($slug);
            return (!empty($luxury_watch_store_installed_plugins[$luxury_watch_store_file_path]));
        }
        public function get_plugin_basename_from_slug($slug) {
            $luxury_watch_store_keys = array_keys($this->get_installed_plugins());
            foreach ($luxury_watch_store_keys as $luxury_watch_store_key) {
                if (preg_match('|^' . $slug . '/|', $luxury_watch_store_key)) {
                    return $luxury_watch_store_key;
                }
            }
            return $slug;
        }

        public function get_installed_plugins() {

            if (!function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            return get_plugins();
        }
        public function create_pattern_setup_builder() {

            $edit_page = admin_url().'post-new.php?post_type=page&create_pattern=true';
            echo json_encode(['page_id'=>'','edit_page_url'=> $edit_page ]);

            exit;
        }

    }
}
/**
 * Kicking this off by calling 'get_instance()' method
 */
Luxury_Watch_Store_Plugin_Activation_WPElemento_Importer::get_instance();
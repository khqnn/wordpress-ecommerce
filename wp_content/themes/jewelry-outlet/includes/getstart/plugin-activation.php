<?php
if ( ! class_exists( 'Jewelry_Outlet_Plugin_Activation_WPElemento_Importer' ) ) {
    /**
     * Jewelry_Outlet_Plugin_Activation_WPElemento_Importer initial setup
     *
     * @since 1.6.2
     */

    class Jewelry_Outlet_Plugin_Activation_WPElemento_Importer {

        private static $jewelry_outlet_instance;
        public $jewelry_outlet_action_count;
        public $jewelry_outlet_recommended_actions;

        /** Initiator **/
        public static function get_instance() {
          if ( ! isset( self::$jewelry_outlet_instance) ) {
            self::$jewelry_outlet_instance = new self();
          }
          return self::$jewelry_outlet_instance;
        }

        /*  Constructor */
        public function __construct() {

            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

            // ---------- wpelementoimpoter Plugin Activation -------
            add_filter( 'jewelry_outlet_recommended_plugins', array($this, 'jewelry_outlet_recommended_elemento_importer_plugins_array') );

            $jewelry_outlet_actions                   = $this->jewelry_outlet_get_recommended_actions();
            $this->jewelry_outlet_action_count        = $jewelry_outlet_actions['count'];
            $this->jewelry_outlet_recommended_actions = $jewelry_outlet_actions['actions'];

            add_action( 'wp_ajax_create_pattern_setup_builder', array( $this, 'create_pattern_setup_builder' ) );
        }

        public function jewelry_outlet_recommended_elemento_importer_plugins_array($jewelry_outlet_plugins){
            $jewelry_outlet_plugins[] = array(
                    'name'     => esc_html__('WPElemento Importer', 'jewelry-outlet'),
                    'slug'     =>  'wpelemento-importer',
                    'function' => 'WPElemento_Importer_ThemeWhizzie',
                    'desc'     => esc_html__('We highly recommend installing the WPElemento Importer plugin for importing the demo content with Elementor.', 'jewelry-outlet'),               
            );
            return $jewelry_outlet_plugins;
        }

        public function enqueue_scripts() {
            wp_enqueue_script('updates');      
            wp_register_script( 'jewelry-outlet-plugin-activation-script', esc_url(get_template_directory_uri()) . '/includes/getstart/js/plugin-activation.js', array('jquery') );
            wp_localize_script('jewelry-outlet-plugin-activation-script', 'jewelry_outlet_plugin_activate_plugin',
                array(
                    'installing' => esc_html__('Installing', 'jewelry-outlet'),
                    'activating' => esc_html__('Activating', 'jewelry-outlet'),
                    'error' => esc_html__('Error', 'jewelry-outlet'),
                    'ajax_url' => esc_url(admin_url('admin-ajax.php')),
                    'wpelementoimpoter_admin_url' => esc_url(admin_url('admin.php?page=wpelemento-importer-tgmpa-install-plugins')),
                    'addon_admin_url' => esc_url(admin_url('admin.php?page=wpelementoimporter-wizard'))
                )
            );
            wp_enqueue_script( 'jewelry-outlet-plugin-activation-script' );

        }

        // --------- Plugin Actions ---------
        public function jewelry_outlet_get_recommended_actions() {

            $jewelry_outlet_act_count  = 0;
            $jewelry_outlet_actions_todo = get_option( 'recommending_actions', array());

            $jewelry_outlet_plugins = $this->jewelry_outlet_get_recommended_plugins();

            if ($jewelry_outlet_plugins) {
                foreach ($jewelry_outlet_plugins as $jewelry_outlet_key => $jewelry_outlet_plugin) {
                    $jewelry_outlet_action = array();
                    if (!isset($jewelry_outlet_plugin['slug'])) {
                        continue;
                    }

                    $jewelry_outlet_action['id']   = 'install_' . $jewelry_outlet_plugin['slug'];
                    $jewelry_outlet_action['desc'] = '';
                    if (isset($jewelry_outlet_plugin['desc'])) {
                        $jewelry_outlet_action['desc'] = $jewelry_outlet_plugin['desc'];
                    }

                    $jewelry_outlet_action['name'] = '';
                    if (isset($jewelry_outlet_plugin['name'])) {
                        $jewelry_outlet_action['title'] = $jewelry_outlet_plugin['name'];
                    }

                    $jewelry_outlet_link_and_is_done  = $this->jewelry_outlet_get_plugin_buttion($jewelry_outlet_plugin['slug'], $jewelry_outlet_plugin['name'], $jewelry_outlet_plugin['function']);
                    $jewelry_outlet_action['link']    = $jewelry_outlet_link_and_is_done['button'];
                    $jewelry_outlet_action['is_done'] = $jewelry_outlet_link_and_is_done['done'];
                    if (!$jewelry_outlet_action['is_done'] && (!isset($jewelry_outlet_actions_todo[$jewelry_outlet_action['id']]) || !$jewelry_outlet_actions_todo[$jewelry_outlet_action['id']])) {
                        $jewelry_outlet_act_count++;
                    }
                    $jewelry_outlet_recommended_actions[] = $jewelry_outlet_action;
                    $jewelry_outlet_actions_todo[]        = array('id' => $jewelry_outlet_action['id'], 'watch' => true);
                }
                return array('count' => $jewelry_outlet_act_count, 'actions' => $jewelry_outlet_recommended_actions);
            }

        }

        public function jewelry_outlet_get_recommended_plugins() {

            $jewelry_outlet_plugins = apply_filters('jewelry_outlet_recommended_plugins', array());
            return $jewelry_outlet_plugins;
        }

        public function jewelry_outlet_get_plugin_buttion($slug, $name, $function) {
                $jewelry_outlet_is_done      = false;
                $jewelry_outlet_button_html  = '';
                $jewelry_outlet_is_installed = $this->is_plugin_installed($slug);
                $jewelry_outlet_plugin_path  = $this->get_plugin_basename_from_slug($slug);
                $jewelry_outlet_is_activeted = (class_exists($function)) ? true : false;
                if (!$jewelry_outlet_is_installed) {
                    $jewelry_outlet_plugin_install_url = add_query_arg(
                        array(
                            'action' => 'install-plugin',
                            'plugin' => $slug,
                        ),
                        self_admin_url('update.php')
                    );
                    $jewelry_outlet_plugin_install_url = wp_nonce_url($jewelry_outlet_plugin_install_url, 'install-plugin_' . esc_attr($slug));
                    $jewelry_outlet_button_html        = sprintf('<a class="jewelry-outlet-plugin-install install-now button-secondary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($jewelry_outlet_plugin_install_url),
                        sprintf(esc_html__('Install %s Now', 'jewelry-outlet'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Install & Activate', 'jewelry-outlet')
                    );
                } elseif ($jewelry_outlet_is_installed && !$jewelry_outlet_is_activeted) {

                    $jewelry_outlet_plugin_activate_link = add_query_arg(
                        array(
                            'action'        => 'activate',
                            'plugin'        => rawurlencode($jewelry_outlet_plugin_path),
                            'plugin_status' => 'all',
                            'paged'         => '1',
                            '_wpnonce'      => wp_create_nonce('activate-plugin_' . $jewelry_outlet_plugin_path),
                        ), self_admin_url('plugins.php')
                    );

                    $jewelry_outlet_button_html = sprintf('<a class="jewelry-outlet-plugin-activate activate-now button-primary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($jewelry_outlet_plugin_activate_link),
                        sprintf(esc_html__('Activate %s Now', 'jewelry-outlet'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Activate', 'jewelry-outlet')
                    );
                } elseif ($jewelry_outlet_is_activeted) {
                    $jewelry_outlet_button_html = sprintf('<div class="action-link button disabled"><span class="dashicons dashicons-yes"></span> %s</div>', esc_html__('Active', 'jewelry-outlet'));
                    $jewelry_outlet_is_done     = true;
                }

                return array('done' => $jewelry_outlet_is_done, 'button' => $jewelry_outlet_button_html);
            }
        public function is_plugin_installed($slug) {
            $jewelry_outlet_installed_plugins = $this->get_installed_plugins(); // Retrieve a list of all installed plugins (WP cached).
            $jewelry_outlet_file_path         = $this->get_plugin_basename_from_slug($slug);
            return (!empty($jewelry_outlet_installed_plugins[$jewelry_outlet_file_path]));
        }
        public function get_plugin_basename_from_slug($slug) {
            $jewelry_outlet_keys = array_keys($this->get_installed_plugins());
            foreach ($jewelry_outlet_keys as $jewelry_outlet_key) {
                if (preg_match('|^' . $slug . '/|', $jewelry_outlet_key)) {
                    return $jewelry_outlet_key;
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
Jewelry_Outlet_Plugin_Activation_WPElemento_Importer::get_instance();
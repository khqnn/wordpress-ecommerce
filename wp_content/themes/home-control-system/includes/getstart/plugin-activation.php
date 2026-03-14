<?php
if ( ! class_exists( 'Home_Control_System_Plugin_Activation_WPElemento_Importer' ) ) {
    /**
     * Home_Control_System_Plugin_Activation_WPElemento_Importer initial setup
     *
     * @since 1.6.2
     */

    class Home_Control_System_Plugin_Activation_WPElemento_Importer {

        private static $home_control_system_instance;
        public $home_control_system_action_count;
        public $home_control_system_recommended_actions;

        /** Initiator **/
        public static function get_instance() {
          if ( ! isset( self::$home_control_system_instance) ) {
            self::$home_control_system_instance = new self();
          }
          return self::$home_control_system_instance;
        }

        /*  Constructor */
        public function __construct() {

            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

            // ---------- wpelementoimpoter Plugin Activation -------
            add_filter( 'home_control_system_recommended_plugins', array($this, 'home_control_system_recommended_elemento_importer_plugins_array') );

            $home_control_system_actions                   = $this->home_control_system_get_recommended_actions();
            $this->home_control_system_action_count        = $home_control_system_actions['count'];
            $this->home_control_system_recommended_actions = $home_control_system_actions['actions'];

            add_action( 'wp_ajax_create_pattern_setup_builder', array( $this, 'create_pattern_setup_builder' ) );
        }

        public function home_control_system_recommended_elemento_importer_plugins_array($home_control_system_plugins){
            $home_control_system_plugins[] = array(
                    'name'     => esc_html__('WPElemento Importer', 'home-control-system'),
                    'slug'     =>  'wpelemento-importer',
                    'function' => 'WPElemento_Importer_ThemeWhizzie',
                    'desc'     => esc_html__('We highly recommend installing the WPElemento Importer plugin for importing the demo content with Elementor.', 'home-control-system'),               
            );
            return $home_control_system_plugins;
        }

        public function enqueue_scripts() {
            wp_enqueue_script('updates');      
            wp_register_script( 'home-control-system-plugin-activation-script', esc_url(get_template_directory_uri()) . '/includes/getstart/js/plugin-activation.js', array('jquery') );
            wp_localize_script('home-control-system-plugin-activation-script', 'home_control_system_plugin_activate_plugin',
                array(
                    'installing' => esc_html__('Installing', 'home-control-system'),
                    'activating' => esc_html__('Activating', 'home-control-system'),
                    'error' => esc_html__('Error', 'home-control-system'),
                    'ajax_url' => esc_url(admin_url('admin-ajax.php')),
                    'wpelementoimpoter_admin_url' => esc_url(admin_url('admin.php?page=wpelemento-importer-tgmpa-install-plugins')),
                    'addon_admin_url' => esc_url(admin_url('admin.php?page=wpelementoimporter-wizard'))
                )
            );
            wp_enqueue_script( 'home-control-system-plugin-activation-script' );

        }

        // --------- Plugin Actions ---------
        public function home_control_system_get_recommended_actions() {

            $home_control_system_act_count  = 0;
            $home_control_system_actions_todo = get_option( 'recommending_actions', array());

            $home_control_system_plugins = $this->home_control_system_get_recommended_plugins();

            if ($home_control_system_plugins) {
                foreach ($home_control_system_plugins as $home_control_system_key => $home_control_system_plugin) {
                    $home_control_system_action = array();
                    if (!isset($home_control_system_plugin['slug'])) {
                        continue;
                    }

                    $home_control_system_action['id']   = 'install_' . $home_control_system_plugin['slug'];
                    $home_control_system_action['desc'] = '';
                    if (isset($home_control_system_plugin['desc'])) {
                        $home_control_system_action['desc'] = $home_control_system_plugin['desc'];
                    }

                    $home_control_system_action['name'] = '';
                    if (isset($home_control_system_plugin['name'])) {
                        $home_control_system_action['title'] = $home_control_system_plugin['name'];
                    }

                    $home_control_system_link_and_is_done  = $this->home_control_system_get_plugin_buttion($home_control_system_plugin['slug'], $home_control_system_plugin['name'], $home_control_system_plugin['function']);
                    $home_control_system_action['link']    = $home_control_system_link_and_is_done['button'];
                    $home_control_system_action['is_done'] = $home_control_system_link_and_is_done['done'];
                    if (!$home_control_system_action['is_done'] && (!isset($home_control_system_actions_todo[$home_control_system_action['id']]) || !$home_control_system_actions_todo[$home_control_system_action['id']])) {
                        $home_control_system_act_count++;
                    }
                    $home_control_system_recommended_actions[] = $home_control_system_action;
                    $home_control_system_actions_todo[]        = array('id' => $home_control_system_action['id'], 'watch' => true);
                }
                return array('count' => $home_control_system_act_count, 'actions' => $home_control_system_recommended_actions);
            }

        }

        public function home_control_system_get_recommended_plugins() {

            $home_control_system_plugins = apply_filters('home_control_system_recommended_plugins', array());
            return $home_control_system_plugins;
        }

        public function home_control_system_get_plugin_buttion($slug, $name, $function) {
                $home_control_system_is_done      = false;
                $home_control_system_button_html  = '';
                $home_control_system_is_installed = $this->is_plugin_installed($slug);
                $home_control_system_plugin_path  = $this->get_plugin_basename_from_slug($slug);
                $home_control_system_is_activeted = (class_exists($function)) ? true : false;
                if (!$home_control_system_is_installed) {
                    $home_control_system_plugin_install_url = add_query_arg(
                        array(
                            'action' => 'install-plugin',
                            'plugin' => $slug,
                        ),
                        self_admin_url('update.php')
                    );
                    $home_control_system_plugin_install_url = wp_nonce_url($home_control_system_plugin_install_url, 'install-plugin_' . esc_attr($slug));
                    $home_control_system_button_html        = sprintf('<a class="home-control-system-plugin-install install-now button-secondary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($home_control_system_plugin_install_url),
                        sprintf(esc_html__('Install %s Now', 'home-control-system'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Install & Activate', 'home-control-system')
                    );
                } elseif ($home_control_system_is_installed && !$home_control_system_is_activeted) {

                    $home_control_system_plugin_activate_link = add_query_arg(
                        array(
                            'action'        => 'activate',
                            'plugin'        => rawurlencode($home_control_system_plugin_path),
                            'plugin_status' => 'all',
                            'paged'         => '1',
                            '_wpnonce'      => wp_create_nonce('activate-plugin_' . $home_control_system_plugin_path),
                        ), self_admin_url('plugins.php')
                    );

                    $home_control_system_button_html = sprintf('<a class="home-control-system-plugin-activate activate-now button-primary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
                        esc_attr($slug),
                        esc_url($home_control_system_plugin_activate_link),
                        sprintf(esc_html__('Activate %s Now', 'home-control-system'), esc_html($name)),
                        esc_html($name),
                        esc_html__('Activate', 'home-control-system')
                    );
                } elseif ($home_control_system_is_activeted) {
                    $home_control_system_button_html = sprintf('<div class="action-link button disabled"><span class="dashicons dashicons-yes"></span> %s</div>', esc_html__('Active', 'home-control-system'));
                    $home_control_system_is_done     = true;
                }

                return array('done' => $home_control_system_is_done, 'button' => $home_control_system_button_html);
            }
        public function is_plugin_installed($slug) {
            $home_control_system_installed_plugins = $this->get_installed_plugins(); // Retrieve a list of all installed plugins (WP cached).
            $home_control_system_file_path         = $this->get_plugin_basename_from_slug($slug);
            return (!empty($home_control_system_installed_plugins[$home_control_system_file_path]));
        }
        public function get_plugin_basename_from_slug($slug) {
            $home_control_system_keys = array_keys($this->get_installed_plugins());
            foreach ($home_control_system_keys as $home_control_system_key) {
                if (preg_match('|^' . $slug . '/|', $home_control_system_key)) {
                    return $home_control_system_key;
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
Home_Control_System_Plugin_Activation_WPElemento_Importer::get_instance();
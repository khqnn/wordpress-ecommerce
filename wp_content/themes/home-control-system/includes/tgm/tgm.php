<?php
	
require get_template_directory() . '/includes/tgm/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function home_control_system_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'home-control-system' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'WPElemento Importer', 'home-control-system' ),
			'slug'             => 'wpelemento-importer',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Elementor', 'home-control-system' ),
			'slug'             => 'elementor',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'WooCommerce', 'home-control-system' ),
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'ShopLentor', 'home-control-system' ),
			'slug'             => 'woolentor-addons',
			'required'         => false,
			'force_activation' => false,
		)
	);
	
	$config = array();
	home_control_system_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'home_control_system_register_recommended_plugins' );

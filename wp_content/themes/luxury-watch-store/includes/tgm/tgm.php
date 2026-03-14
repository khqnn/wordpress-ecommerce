<?php
	
require get_template_directory() . '/includes/tgm/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function luxury_watch_store_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'luxury-watch-store' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'WPElemento Importer', 'luxury-watch-store' ),
			'slug'             => 'wpelemento-importer',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Elementor', 'luxury-watch-store' ),
			'slug'             => 'elementor',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Woocommerce', 'luxury-watch-store' ),
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'YITH WooCommerce Wishlist', 'luxury-watch-store' ),
			'slug'             => 'yith-woocommerce-wishlist',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'luxury_watch_store_register_recommended_plugins' );

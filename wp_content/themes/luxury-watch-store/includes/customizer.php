<?php

if ( class_exists("Kirki")){

	Kirki::add_config('theme_config_id', array(
		'capability'   =>  'edit_theme_options',
		'option_type'  =>  'theme_mod',
	));


	Kirki::add_field( 'theme_config_id', [
		'label'       => esc_html__( 'Logo Size','luxury-watch-store' ),
		'section'     => 'title_tagline',
		'priority'    => 9,
		'type'        => 'range',
		'settings'    => 'logo_size',
		'choices' => [
			'step'             => 5,
			'min'              => 0,
			'max'              => 100,
			'aria-valuemin'    => 0,
			'aria-valuemax'    => 100,
			'aria-valuenow'    => 50,
			'aria-orientation' => 'horizontal',
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_enable_logo_text',
		'section'     => 'title_tagline',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

  	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'luxury_watch_store_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'luxury-watch-store' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'luxury-watch-store' ),
			'off' => esc_html__( 'Disable', 'luxury-watch-store' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'luxury_watch_store_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'luxury-watch-store' ),
		'section'     => 'title_tagline',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'luxury-watch-store' ),
			'off' => esc_html__( 'Disable', 'luxury-watch-store' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_site_tittle_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Title Font Size', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_site_tittle_font_size',
		'type'        => 'number',
		'section'     => 'title_tagline',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.logo a'),
				'property' => 'font-size',
				'suffix' => 'px'
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_site_tagline_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Tagline Font Size', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_site_tagline_font_size',
		'type'        => 'number',
		'section'     => 'title_tagline',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.logo span'),
				'property' => 'font-size',
				'suffix' => 'px'
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_logo_settings_premium_features',
		'section'     => 'title_tagline',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Unlock More Features in the Premium Version!', 'luxury-watch-store' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Customizable Text Logo', 'luxury-watch-store' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Enhanced Typography Options', 'luxury-watch-store' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Priority Support', 'luxury-watch-store' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'luxury-watch-store' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/products/watch-store-wordpress-theme', 'luxury-watch-store' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'luxury-watch-store' ) .'</a></div>',
	) );


	// Theme color

	Kirki::add_section( 'luxury_watch_store_theme_color_setting', array(
		'title'    => __( 'Color Option', 'luxury-watch-store' ),
		'priority' => 10,
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_first_theme_color',
		'label'       => __( 'Theme First color', 'luxury-watch-store'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_theme_color_setting',
		'type'        => 'color',
		'default'     => '#FF7F4E',
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_second_theme_color',
		'label'       => __( 'Theme Second color', 'luxury-watch-store'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_theme_color_setting',
		'type'        => 'color',
		'default'     => '#000000',
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_third_theme_color',
		'label'       => __( 'Theme Third color', 'luxury-watch-store'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_theme_color_setting',
		'type'        => 'color',
		'default'     => '#FFF0E6',
	) );

	// TYPOGRAPHY SETTINGS

	Kirki::add_panel( 'luxury_watch_store_typography_panel', array(
		'priority' => 10,
		'title'    => __( 'Typography', 'luxury-watch-store' ),
	) );

	//Heading 1 Section

	Kirki::add_section( 'luxury_watch_store_h1_typography_setting', array(
		'title'    => __( 'Heading 1', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_h1_typography_heading',
		'section'     => 'luxury_watch_store_h1_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 1 Typography', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'luxury_watch_store_h1_typography_font',
		'section'   =>  'luxury_watch_store_h1_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Figtree', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  array('.header-image-box h1'),
				'suffix' => '!important'
			],
		],
	) );

	//Heading 2 Section

	Kirki::add_section( 'luxury_watch_store_h2_typography_setting', array(
		'title'    => __( 'Heading 2', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_h2_typography_heading',
		'section'     => 'luxury_watch_store_h2_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 2 Typography', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'luxury_watch_store_h2_typography_font',
		'section'   =>  'luxury_watch_store_h2_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Figtree', sans-serif",
			'font-size'       => '',
			'variant'       =>  '700',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h2'
			],
		],
	) );

	//Heading 3 Section

	Kirki::add_section( 'luxury_watch_store_h3_typography_setting', array(
		'title'    => __( 'Heading 3', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_h3_typography_heading',
		'section'     => 'luxury_watch_store_h3_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 3 Typography', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'luxury_watch_store_h3_typography_font',
		'section'   =>  'luxury_watch_store_h3_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Figtree', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h3',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 4 Section

	Kirki::add_section( 'luxury_watch_store_h4_typography_setting', array(
		'title'    => __( 'Heading 4', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_h4_typography_heading',
		'section'     => 'luxury_watch_store_h4_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 4 Typography', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'luxury_watch_store_h4_typography_font',
		'section'   =>  'luxury_watch_store_h4_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Figtree', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h4',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 5 Section

	Kirki::add_section( 'luxury_watch_store_h5_typography_setting', array(
		'title'    => __( 'Heading 5', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_h5_typography_heading',
		'section'     => 'luxury_watch_store_h5_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 5 Typography', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'luxury_watch_store_h5_typography_font',
		'section'   =>  'luxury_watch_store_h5_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Figtree', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h5',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 6 Section

	Kirki::add_section( 'luxury_watch_store_h6_typography_setting', array(
		'title'    => __( 'Heading 6', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_h6_typography_heading',
		'section'     => 'luxury_watch_store_h6_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 6 Typography', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'luxury_watch_store_h6_typography_font',
		'section'   =>  'luxury_watch_store_h6_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Figtree', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h6',
				'suffix' => '!important'
			],
		],
	) );

	//body Typography

	Kirki::add_section( 'luxury_watch_store_body_typography_setting', array(
		'title'    => __( 'Content Typography', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_body_typography_heading',
		'section'     => 'luxury_watch_store_body_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Content  Typography', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'luxury_watch_store_body_typography_font',
		'section'   =>  'luxury_watch_store_body_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Figtree', sans-serif",
			'variant'       =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   => 'body',
				'suffix' => '!important'
			],
		],
	) );

	//Theme Options Panel

	Kirki::add_panel( 'luxury_watch_store_theme_options_panel', array(
		'priority' => 10,
		'title'    => __( 'Theme Options', 'luxury-watch-store' ),
	) );

	// HEADER SECTION

	Kirki::add_section( 'luxury_watch_store_section_header',array(
		'title' => esc_html__( 'Header Settings', 'luxury-watch-store' ),
		'description'    => esc_html__( 'Here you can add header information.', 'luxury-watch-store' ),
		'panel' => 'luxury_watch_store_theme_options_panel',
		'tabs'  => [
			'header' => [
				'label' => esc_html__( 'Header', 'luxury-watch-store' ),
			],
			'menu'  => [
				'label' => esc_html__( 'Menu', 'luxury-watch-store' ),
			],
		],
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'menu',
		'settings'    => 'luxury_watch_store_menu_size_heading',
		'section'     => 'luxury_watch_store_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Font Size(px)', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_menu_size',
		'tab'      => 'menu',
		'label'       => __( 'Enter a value in pixels. Example:20px', 'luxury-watch-store' ),
		'type'        => 'text',
		'section'     => 'luxury_watch_store_section_header',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => 'font-size',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'menu',
		'settings'    => 'luxury_watch_store_menu_text_transform_heading',
		'section'     => 'luxury_watch_store_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Text Transform', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'menu',
		'settings'    => 'luxury_watch_store_menu_text_transform',
		'section'     => 'luxury_watch_store_section_header',
		'default'     => 'capitalize',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'luxury-watch-store' ),
			'uppercase' => esc_html__( 'Uppercase', 'luxury-watch-store' ),
			'lowercase' => esc_html__( 'Lowercase', 'luxury-watch-store' ),
			'capitalize' => esc_html__( 'Capitalize', 'luxury-watch-store' ),
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => ' text-transform',
			),
		),
	));


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'luxury_watch_store_cart_enable_setting_heading',
		'section'     => 'luxury_watch_store_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Cart Button', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header',
		'settings'    => 'luxury_watch_store_cart_enable_setting',
		'label'       => esc_html__( 'Enable or Disable Cart', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_section_header',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'luxury_watch_store_wishlist_enable_setting_heading',
		'section'     => 'luxury_watch_store_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Wishlist', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header',
		'settings'    => 'luxury_watch_store_wishlist_enable_setting',
		'label'       => esc_html__( 'Enable or Disable Wishlist', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_section_header',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'luxury_watch_store_logo_settings_premium_features_header',
		'section'     => 'luxury_watch_store_section_header',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Enhance your header design now!', 'luxury-watch-store' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Customize your header background color', 'luxury-watch-store' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Adjust icon and text font sizes', 'luxury-watch-store' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Explore enhanced typography options', 'luxury-watch-store' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'luxury-watch-store' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/products/watch-store-wordpress-theme', 'luxury-watch-store' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'luxury-watch-store' ) .'</a></div>',
	) );

	// WOOCOMMERCE SETTINGS

	Kirki::add_section( 'luxury_watch_store_woocommerce_settings', array(
		'title'          => esc_html__( 'Woocommerce Settings', 'luxury-watch-store' ),
		'description'    => esc_html__( 'Woocommerce Settings of themes', 'luxury-watch-store' ),
		'panel'    => 'woocommerce',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'luxury_watch_store_shop_page_sidebar',
		'label'       => esc_html__( 'Enable/Disable Shop Page Sidebar', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'     => 'false',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Shop Page Layouts', 'luxury-watch-store' ),
		'settings'    => 'luxury_watch_store_shop_page_layout',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'luxury-watch-store' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'luxury-watch-store' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'luxury_watch_store_shop_page_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'label'       => esc_html__( 'Products Per Row', 'luxury-watch-store' ),
		'settings'    => 'luxury_watch_store_products_per_row',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'     => '4',
		'priority'    => 10,
		'choices'     => [
			'2' => '2',
			'3' => '3',
			'4' => '4',
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'label'       => esc_html__( 'Products Per Page', 'luxury-watch-store' ),
		'settings'    => 'luxury_watch_store_products_per_page',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'     => '8',
		'priority'    => 10,
		'choices'  => [
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'luxury_watch_store_single_product_sidebar',
		'label'       => esc_html__( 'Enable / Disable Single Product Sidebar', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'     => 'true',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Single Product Layout', 'luxury-watch-store' ),
		'settings'    => 'luxury_watch_store_single_product_sidebar_layout',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'luxury-watch-store' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'luxury-watch-store' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'luxury_watch_store_single_product_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_products_button_border_radius_heading',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Products Button Border Radius', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'luxury_watch_store_products_button_border_radius',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
		'choices'  => [
					'min'  => 1,
					'max'  => 50,
					'step' => 1,
				],
		'output' => array(
			array(
				'element'  => array('.woocommerce ul.products li.product .button',' a.checkout-button.button.alt.wc-forward','.woocommerce #respond input#submit', '.woocommerce a.button', '.woocommerce button.button','.woocommerce input.button','.woocommerce #respond input#submit.alt','.woocommerce button.button.alt','.woocommerce input.button.alt'),
				'property' => 'border-radius',
				'units' => 'px',
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_sale_badge_position_heading',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Badge Position', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'luxury_watch_store_sale_badge_position',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'     => 'right',
		'choices'     => [
			'right' => esc_html__( 'Right', 'luxury-watch-store' ),
			'left' => esc_html__( 'Left', 'luxury-watch-store' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_products_sale_font_size_heading',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Font Size', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'text',
		'settings'    => 'luxury_watch_store_products_sale_font_size',
		'section'     => 'luxury_watch_store_woocommerce_settings',
		'priority'    => 10,
		'output' => array(
			array(
				'element'  => array('.woocommerce span.onsale','.woocommerce ul.products li.product .onsale'),
				'property' => 'font-size',
				'units' => 'px',
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
    'type'     => 'custom',
    'settings' => 'luxury_watch_store_show_product_featured_image_hover_heading',
    'section'  => 'luxury_watch_store_woocommerce_settings',
    'default'  => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1;">' . __( 'Product Featured Image Hover Effect', 'luxury-watch-store' ) . '</h3>',
    'priority' => 20,
   ] );

	Kirki::add_field( 'theme_config_id', [
    'type'     => 'select',
    'settings' => 'luxury_watch_store_product_featured_image_hover',
    'label'    => esc_html__( 'Product Featured Image Hover Effect', 'luxury-watch-store' ),
    'section'  => 'luxury_watch_store_woocommerce_settings',
    'default'  => 'none',
    'priority' => 30,
    'choices'  => [
        'none'      => esc_html__( 'None', 'luxury-watch-store' ),
        'zoom-in'   => esc_html__( 'Zoom In', 'luxury-watch-store' ),
        'zoom-out'  => esc_html__( 'Zoom Out', 'luxury-watch-store' ),
        'scale'     => esc_html__( 'Scale', 'luxury-watch-store' ),
        'grayscale' => esc_html__( 'Grayscale', 'luxury-watch-store' ),
        'blur'      => esc_html__( 'Blur', 'luxury-watch-store' ),
        'bright'    => esc_html__( 'Bright', 'luxury-watch-store' ),
        'sepia'     => esc_html__( 'Sepia', 'luxury-watch-store' ),
        'translate' => esc_html__( 'Translate', 'luxury-watch-store' ),
    ],
    ] );
	
	//ADDITIONAL SETTINGS

	Kirki::add_section( 'luxury_watch_store_additional_setting', array(
		'title'          => esc_html__( 'Additional Settings', 'luxury-watch-store' ),
		'description'    => esc_html__( 'Additional Settings of themes', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_theme_options_panel',
		'priority'       => 10,
		'tabs'  => [
			'general' => [
				'label' => esc_html__( 'General', 'luxury-watch-store' ),
			],
			'header-image'  => [
				'label' => esc_html__( 'Header Image', 'luxury-watch-store' ),
			],
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'luxury_watch_store_preloader_hide',
		'label'       => esc_html__( 'Here you can enable or disable your preloader.', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => false,
		'priority'    => 10,
		'tab'      => 'general',
	] );
 
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'luxury_watch_store_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => true ,
		'priority'    => 10,
		'tab'      => 'general',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_enable_sidebar_animation_heading',
		'section'     => 'luxury_watch_store_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Animation', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_enable_sidebar_animation',
		'label'       => esc_html__( 'Enable or Disable Sidebar Animation', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_enable_footer_animation',
		'label'       => esc_html__( 'Enable or Disable Footer Animation', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_enable_sidebar_sticky_heading',
		'section'     => 'luxury_watch_store_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sticky Sidebar', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_enable_sticky_sidebar',
		'label'       => esc_html__( 'Enable or Disable Sticky Sidebar', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_scroll_alignment_heading',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Scroll To Top Position', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'radio-buttonset',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_scroll_alignment',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => 'right',
		'choices'     => [
			'left' => esc_html__( 'left', 'luxury-watch-store' ),
			'center' => esc_html__( 'center', 'luxury-watch-store' ),
			'right' => esc_html__( 'right', 'luxury-watch-store' ),
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_scroller_border_radius_heading',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Scroll To Top Border Radius', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'slider',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_scroller_border_radius',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '50',
		'choices'     => [
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		],
		'output' => array(
			array(
				'element'  => '.scroll-up a',
				'property' => 'border-radius',
				'units' => 'px',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_cursor_outline_heading',
		'section'     => 'luxury_watch_store_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Dot Cursor', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_cursor_outline',
		'label'       => esc_html__( 'Enable or Disable Dot Cursor', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_progress_bar_heading',
		'section'     => 'luxury_watch_store_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_progress_bar',
		'label'       => esc_html__( 'Enable or Disable Progress Bar', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_progress_bar_position_heading',
		'section'     => 'luxury_watch_store_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar Position', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
		'active_callback'  => [
			[
				'setting'  => 'luxury_watch_store_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_progress_bar_position',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => 'top',
		'choices'     => [
			'top' => esc_html__( 'Top', 'luxury-watch-store' ),
			'bottom' => esc_html__( 'Bottom', 'luxury-watch-store' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'luxury_watch_store_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_progress_bar_color_heading',
		'section'     => 'luxury_watch_store_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar Color', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
		'active_callback'  => [
			[
				'setting'  => 'luxury_watch_store_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_progress_bar_color',
		'tab'      => 'general',
		'label'       => __( 'Color', 'luxury-watch-store' ),
		'type'        => 'color',
		'section'     => 'luxury_watch_store_additional_setting',
		'transport' => 'auto',
		'default'     => '#FF7F4E',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '#elemento-progress-bar',
				'property' => 'background-color',
			),
		),
		'active_callback'  => [
			[
				'setting'  => 'luxury_watch_store_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_single_page_layout_heading',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Page Layout', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'general',
		'settings'    => 'luxury_watch_store_single_page_layout',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => 'One Column',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'luxury-watch-store' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'luxury-watch-store' ),
			'One Column' => esc_html__( 'One Column', 'luxury-watch-store' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'luxury_watch_store_header_background_attachment_heading',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Attachment', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'header-image',
		'settings'    => 'luxury_watch_store_header_background_attachment',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => 'scroll',
		'choices'     => [
			'scroll' => esc_html__( 'Scroll', 'luxury-watch-store' ),
			'fixed' => esc_html__( 'Fixed', 'luxury-watch-store' ),
		],
		'output' => array(
			array(
				'element'  => '.header-image-box',
				'property' => 'background-attachment',
			),
		),
	 ) );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'luxury_watch_store_header_image_height_heading',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image height', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_header_image_height',
		'label'       => __( 'Image Height', 'luxury-watch-store' ),
		'description'    => esc_html__( 'Enter a value in pixels. Example:500px', 'luxury-watch-store' ),
		'type'        => 'text',
		'tab'      => 'header-image',
		'default'    => [
			'desktop' => '400px',
			'tablet'  => '350px',
			'mobile'  => '200px',
		],
		'responsive' => true,
		'section'     => 'luxury_watch_store_additional_setting',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.header-image-box'),
				'property' => 'height',
				'media_query' => [
					'desktop' => '@media (min-width: 1024px)',
					'tablet'  => '@media (min-width: 768px) and (max-width: 1023px)',
					'mobile'  => '@media (max-width: 767px)',
				],
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'luxury_watch_store_header_overlay_heading',
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Overlay', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_header_overlay_setting',
		'tab'      => 'header-image',
		'label'       => __( 'Overlay Color', 'luxury-watch-store' ),
		'type'        => 'color',
		'section'     => 'luxury_watch_store_additional_setting',
		'transport' => 'auto',
		'default'     => '#00000054',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '.header-image-box:before',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header-image',
		'settings'    => 'luxury_watch_store_header_page_title',
		'label'       => esc_html__( 'Enable / Disable Header Image Page Title.', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header-image',
		'settings'    => 'luxury_watch_store_header_breadcrumb',
		'label'       => esc_html__( 'Enable / Disable Header Image Breadcrumb.', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	// POST SECTION

	Kirki::add_section( 'luxury_watch_store_blog_post', array(
		'title'          => esc_html__( 'Post Settings', 'luxury-watch-store' ),
		'description'    => esc_html__( 'Here you can add post information.', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_theme_options_panel',
		'tabs'  => [
			'blog-post' => [
				'label' => esc_html__( 'Blog Post', 'luxury-watch-store' ),
			],
			'single-post'  => [
				'label' => esc_html__( 'Single Post', 'luxury-watch-store' ),
			],
		],
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_enable_post_animation_heading',
		'section'     => 'luxury_watch_store_blog_post',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Animation', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_enable_post_animation',
		'label'       => esc_html__( 'Enable or Disable Blog Post Animation', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_post_layout_heading',
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Layout', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_post_layout',
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'luxury-watch-store' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'luxury-watch-store' ),
			'One Column' => esc_html__( 'One Column', 'luxury-watch-store' ),
			'Three Columns' => esc_html__( 'Three Columns', 'luxury-watch-store' ),
			'Four Columns' => esc_html__( 'Four Columns', 'luxury-watch-store' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_date_hide',
		'label'       => esc_html__( 'Enable / Disable Post Date', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_author_hide',
		'label'       => esc_html__( 'Enable / Disable Post Author', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Post Comment', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_blog_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Post Image', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_length_setting_heading',
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Post Content Limit', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'tab'      => 'blog-post',
		'settings'    => 'luxury_watch_store_length_setting',
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '15',
		'priority'    => 10,
		'choices'  => [
					'min'  => -10,
					'max'  => 40,
		 			'step' => 1,
				],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'luxury_watch_store_single_post_date_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Date', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'luxury_watch_store_single_post_author_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Author', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'luxury_watch_store_single_post_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Comment', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Tag', 'luxury-watch-store' ),
		'settings'    => 'luxury_watch_store_single_post_tag',
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Category', 'luxury-watch-store' ),
		'settings'    => 'luxury_watch_store_single_post_category',
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'luxury_watch_store_single_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Single Post Image', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'single-post',
		'settings'    => 'luxury_watch_store_single_post_radius',
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Post Image Border Radius(px)', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_single_post_border_radius',
		'label'       => __( 'Enter a value in pixels. Example:15px', 'luxury-watch-store' ),
		'type'        => 'text',
		'tab'      => 'single-post',
		'section'     => 'luxury_watch_store_blog_post',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.post-img img'),
				'property' => 'border-radius',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
	'type'     => 'select',
	'tab'      => 'single-post',
	'settings' => 'luxury_watch_store_single_post_featured_image_hover',
	'label'    => esc_html__( 'Featured Image Hover Effect', 'luxury-watch-store' ),
	'section'  => 'luxury_watch_store_blog_post',
	'default'  => 'none',
	'priority' => 20,
	'choices'  => [
		'none'      => esc_html__( 'None', 'luxury-watch-store' ),
		'zoom-in'   => esc_html__( 'Zoom In', 'luxury-watch-store' ),
		'zoom-out'  => esc_html__( 'Zoom Out', 'luxury-watch-store' ),
		'scale'     => esc_html__( 'Scale', 'luxury-watch-store' ),
		'grayscale' => esc_html__( 'Grayscale', 'luxury-watch-store' ),
		'blur'      => esc_html__( 'Blur', 'luxury-watch-store' ),
		'bright'    => esc_html__( 'Bright', 'luxury-watch-store' ),
		'sepia'     => esc_html__( 'Sepia', 'luxury-watch-store' ),
		'translate' => esc_html__( 'Translate', 'luxury-watch-store' ),
	],
    ] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'single-post',
		'settings'    => 'luxury_watch_store_show_related_post_heading',
		'section'     => 'luxury_watch_store_blog_post',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Related post', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'luxury_watch_store_show_related_post',
		'label'       => esc_html__( 'Enable or Disable Related post', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_blog_post',
		'default'     => true,
		'priority'    => 10,
	] );

	// No Results Page Settings

	Kirki::add_section( 'luxury_watch_store_no_result_section', array(
		'title'          => esc_html__( '404 & No Results Page Settings', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_theme_options_panel',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_page_not_found_title_heading',
		'section'     => 'luxury_watch_store_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Title', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'luxury_watch_store_page_not_found_title',
		'section'  => 'luxury_watch_store_no_result_section',
		'default'  => esc_html__('404 Error!', 'luxury-watch-store'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_page_not_found_text_heading',
		'section'     => 'luxury_watch_store_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Text', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'luxury_watch_store_page_not_found_text',
		'section'  => 'luxury_watch_store_no_result_section',
		'default'  => esc_html__('The page you are looking for may have been moved, deleted, or possibly never existed.', 'luxury-watch-store'),
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'     => 'custom',
		'settings' => 'luxury_watch_store_page_not_found_line_break',
		'section'  => 'luxury_watch_store_no_result_section',
		'default'  => '<hr>',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_no_results_title_heading',
		'section'     => 'luxury_watch_store_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Title', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'luxury_watch_store_no_results_title',
		'section'  => 'luxury_watch_store_no_result_section',
		'default'  => esc_html__('Nothing Found', 'luxury-watch-store'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_no_results_content_heading',
		'section'     => 'luxury_watch_store_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Content', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'luxury_watch_store_no_results_content',
		'section'  => 'luxury_watch_store_no_result_section',
		'default'  => esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'luxury-watch-store'),
	] );
	
	// FOOTER SECTION

	Kirki::add_section( 'luxury_watch_store_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'luxury-watch-store' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'luxury-watch-store' ),
        'panel'    => 'luxury_watch_store_theme_options_panel',
		'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_show_footer_widget_heading',
		'section'     => 'luxury_watch_store_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'luxury_watch_store_show_footer_widget',
		'label'       => esc_html__( 'Footer Widget', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_footer_section',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'luxury_watch_store_show_footer_copyright',
		'label'       => esc_html__( 'Footer Copyright', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_footer_section',
		'default'     => '1',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_footer_text_heading',
		'section'     => 'luxury_watch_store_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'luxury_watch_store_footer_text',
		'section'  => 'luxury_watch_store_footer_section',
		'default'  => '',
		'priority' => 10,
	] );
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_footer_sticky_heading',
		'section'     => 'luxury_watch_store_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Sticky Copyright', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'luxury_watch_store_sticky_copyright_enable',
		'label'       => esc_html__( ' Sticky Copyright Section Enable / Disable', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_footer_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'luxury-watch-store' ),
			'off' => esc_html__( 'Disable', 'luxury-watch-store' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_footer_enable_heading',
		'section'     => 'luxury_watch_store_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'luxury_watch_store_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'luxury-watch-store' ),
			'off' => esc_html__( 'Disable', 'luxury-watch-store' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_footer_background_widget_heading',
		'section'     => 'luxury_watch_store_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Background', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id',
	[
		'settings'    => 'luxury_watch_store_footer_background_widget',
		'type'        => 'background',
		'section'     => 'luxury_watch_store_footer_section',
		'default'     => [
			'background-color'      => 'rgba(23,20,20,1)',
			'background-image'      => '',
			'background-repeat'     => 'no-repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => '.footer-widget',
			],
		],
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_footer_widget_alignment_heading',
		'section'     => 'luxury_watch_store_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Alignment', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'luxury_watch_store_footer_widget_alignment',
		'section'     => 'luxury_watch_store_footer_section',
		'default'     =>[
			'desktop' => 'left',
			'tablet'  => 'left',
			'mobile'  => 'center',
		],
		'responsive' => true,
		'label'       => __( 'Widget Alignment', 'luxury-watch-store' ),
		'transport' => 'auto',
		'choices'     => [
			'center' => esc_html__( 'center', 'luxury-watch-store' ),
			'right' => esc_html__( 'right', 'luxury-watch-store' ),
			'left' => esc_html__( 'left', 'luxury-watch-store' ),
		],
		'output' => array(
			array(
				'element'  => '.footer-area',
				'property' => 'text-align',
				'media_query' => [
					'desktop' => '@media (min-width: 1024px)',
					'tablet'  => '@media (min-width: 768px) and (max-width: 1023px)',
					'mobile'  => '@media (max-width: 767px)',
				],
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_footer_copright_color_heading',
		'section'     => 'luxury_watch_store_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Background Color', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_footer_copright_color',
		'type'        => 'color',
		'label'       => __( 'Background Color', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_footer_section',
		'transport' => 'auto',
		'default'     => '#FF7F4E',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '.footer-copyright',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_footer_copright_text_color_heading',
		'section'     => 'luxury_watch_store_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Text Color', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_footer_copright_text_color',
		'type'        => 'color',
		'label'       => __( 'Text Color', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_footer_section',
		'transport' => 'auto',
		'default'     => '#ffffff',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '.footer-copyright a', '.footer-copyright p'),
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_logo_settings_premium_features_footer',
		'section'     => 'luxury_watch_store_footer_section',
		'priority'    => 50,
		'default'     => '<h3 style="color: #2271b1; padding:5px 20px 5px 20px; background:#fff; margin:0;  box-shadow: 0 2px 4px rgba(0,0,0, .2); ">' . esc_html__( 'Elevate your footer with premium features:', 'luxury-watch-store' ) . '</h3><ul style="color: #121212; padding: 5px 20px 20px 30px; background:#fff; margin:0;" ><li style="list-style-type: square;" >' . esc_html__( 'Tailor your footer layout', 'luxury-watch-store' ) . '</li><li style="list-style-type: square;" >'.esc_html__( 'Integrate an email subscription form', 'luxury-watch-store' ) .'</li><li style="list-style-type: square;" >'.esc_html__( 'Personalize social media icons', 'luxury-watch-store' ) .'</li><li style="list-style-type: square;" >'.esc_html__( '....and Much More', 'luxury-watch-store' ) . '</li></ul><div style="background: #fff; padding: 0px 10px 10px 20px;"><a href="' . esc_url( __( 'https://www.wpelemento.com/products/watch-store-wordpress-theme', 'luxury-watch-store' ) ) . '" class="button button-primary" target="_blank">'. esc_html__( 'Upgrade for more', 'luxury-watch-store' ) .'</a></div>',
	) );

	// Footer Social Icons Section

	Kirki::add_section( 'luxury_watch_store_footer_social_media_section', array(
		'title'          => esc_html__( 'Footer Social Icons', 'luxury-watch-store' ),
		'panel'    => 'luxury_watch_store_theme_options_panel',
		'priority'       => 160,
	) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_footer_social_icon_hide_heading',
		'section'     => 'luxury_watch_store_footer_social_media_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable or Disable your Footer Social Icon', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'luxury_watch_store_footer_social_icon_hide',
		'label'       => esc_html__( 'Enable or Disable Social Icon.', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_footer_social_media_section',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'luxury_watch_store_enable_footer_socail_link_align_heading',
		'section'     => 'luxury_watch_store_footer_social_media_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Social Media Text Align', 'luxury-watch-store' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'luxury_watch_store_enable_footer_socail_link_align',
		'type'        => 'select',
		'priority'    => 10,
		'label'       => __( 'Text Align', 'luxury-watch-store' ),
		'section'     => 'luxury_watch_store_footer_social_media_section',
		'default'     => 'left',
		'choices'     => [
			'center' => esc_html__( 'center', 'luxury-watch-store' ),
			'right' => esc_html__( 'right', 'luxury-watch-store' ),
			'left' => esc_html__( 'left', 'luxury-watch-store' ),
		],
		'output' => array(
			array(
				'element'  => array( '.footer-links'),
				'property' => 'text-align',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'priority'    => 10,
		'settings'    => 'luxury_watch_store_enable_footer_socail_link',
		'section'     => 'luxury_watch_store_footer_social_media_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Social Media Link', 'luxury-watch-store' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'priority'    => 10,
		'section'     => 'luxury_watch_store_footer_social_media_section',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Footer Social Icons', 'luxury-watch-store' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'luxury-watch-store' ),
		'settings'     => 'luxury_watch_store_social_links_settings_footer',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'luxury-watch-store' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'luxury-watch-store' ). ' <a href="https://fontawesome.com/v6/search?ic=brands" target="_blank"><strong>' . esc_html__( 'View All', 'luxury-watch-store' ) . ' </strong></a>',
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'luxury-watch-store' ),
				'description' => esc_html__( 'Add the social icon url here.', 'luxury-watch-store' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 20
		],
	] );

	load_template( trailingslashit( get_template_directory() ) . '/includes/logo/logo-resizer.php' );
}

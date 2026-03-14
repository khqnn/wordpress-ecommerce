<?php

if ( class_exists("Kirki")){

	Kirki::add_config('theme_config_id', array(
		'capability'   =>  'edit_theme_options',
		'option_type'  =>  'theme_mod',
	));


	Kirki::add_field( 'theme_config_id', [
		'label'       => esc_html__( 'Logo Size','home-control-system' ),
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
		'settings'    => 'home_control_system_enable_logo_text',
		'section'     => 'title_tagline',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

  	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'home_control_system_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'home-control-system' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'home-control-system' ),
			'off' => esc_html__( 'Disable', 'home-control-system' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'home_control_system_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'home-control-system' ),
		'section'     => 'title_tagline',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'home-control-system' ),
			'off' => esc_html__( 'Disable', 'home-control-system' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_site_tittle_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Title Font Size', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_site_tittle_font_size',
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
		'settings'    => 'home_control_system_site_tagline_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Tagline Font Size', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_site_tagline_font_size',
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

	
	// Theme color

	Kirki::add_section( 'home_control_system_theme_color_setting', array(
		'title'    => __( 'Color Option', 'home-control-system' ),
		'priority' => 10,
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_first_theme_color',
		'label'       => __( 'Theme First color', 'home-control-system'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'home-control-system' ),
		'section'     => 'home_control_system_theme_color_setting',
		'type'        => 'color',
		'default'     => '#53015B',
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_second_theme_color',
		'label'       => __( 'Theme Second color', 'home-control-system'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'home-control-system' ),
		'section'     => 'home_control_system_theme_color_setting',
		'type'        => 'color',
		'default'     => '#2F2B2F',
	) );


	// TYPOGRAPHY SETTINGS

	Kirki::add_panel( 'home_control_system_typography_panel', array(
		'priority' => 10,
		'title'    => __( 'Typography', 'home-control-system' ),
	) );

	//Heading 1 Section

	Kirki::add_section( 'home_control_system_h1_typography_setting', array(
		'title'    => __( 'Heading 1', 'home-control-system' ),
		'panel'    => 'home_control_system_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_h1_typography_heading',
		'section'     => 'home_control_system_h1_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 1 Typography', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'home_control_system_h1_typography_font',
		'section'   =>  'home_control_system_h1_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Figtree', sans-serif",
			'variant'       =>  '400',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  array('.header-image-box h1 , h1'),
				'suffix' => '!important'
			],
		],

	) );

	//Heading 2 Section

	Kirki::add_section( 'home_control_system_h2_typography_setting', array(
		'title'    => __( 'Heading 2', 'home-control-system' ),
		'panel'    => 'home_control_system_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_h2_typography_heading',
		'section'     => 'home_control_system_h2_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 2 Typography', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'home_control_system_h2_typography_font',
		'section'   =>  'home_control_system_h2_typography_setting',
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

	Kirki::add_section( 'home_control_system_h3_typography_setting', array(
		'title'    => __( 'Heading 3', 'home-control-system' ),
		'panel'    => 'home_control_system_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_h3_typography_heading',
		'section'     => 'home_control_system_h3_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 3 Typography', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'home_control_system_h3_typography_font',
		'section'   =>  'home_control_system_h3_typography_setting',
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

	Kirki::add_section( 'home_control_system_h4_typography_setting', array(
		'title'    => __( 'Heading 4', 'home-control-system' ),
		'panel'    => 'home_control_system_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_h4_typography_heading',
		'section'     => 'home_control_system_h4_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 4 Typography', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'home_control_system_h4_typography_font',
		'section'   =>  'home_control_system_h4_typography_setting',
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

	Kirki::add_section( 'home_control_system_h5_typography_setting', array(
		'title'    => __( 'Heading 5', 'home-control-system' ),
		'panel'    => 'home_control_system_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_h5_typography_heading',
		'section'     => 'home_control_system_h5_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 5 Typography', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'home_control_system_h5_typography_font',
		'section'   =>  'home_control_system_h5_typography_setting',
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

	Kirki::add_section( 'home_control_system_h6_typography_setting', array(
		'title'    => __( 'Heading 6', 'home-control-system' ),
		'panel'    => 'home_control_system_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_h6_typography_heading',
		'section'     => 'home_control_system_h6_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 6 Typography', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'home_control_system_h6_typography_font',
		'section'   =>  'home_control_system_h6_typography_setting',
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

	Kirki::add_section( 'home_control_system_body_typography_setting', array(
		'title'    => __( 'Content Typography', 'home-control-system' ),
		'panel'    => 'home_control_system_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_body_typography_heading',
		'section'     => 'home_control_system_body_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Content  Typography', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'home_control_system_body_typography_font',
		'section'   =>  'home_control_system_body_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Roboto', sans-serif",
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

	Kirki::add_panel( 'home_control_system_theme_options_panel', array(
		'priority' => 10,
		'title'    => __( 'Theme Options', 'home-control-system' ),
	) );

	// HEADER SECTION

	Kirki::add_section( 'home_control_system_section_header',array(
		'title' => esc_html__( 'Header Settings', 'home-control-system' ),
		'description'    => esc_html__( 'Here you can add header information.', 'home-control-system' ),
		'panel' => 'home_control_system_theme_options_panel',
		'tabs'  => [
			'header' => [
				'label' => esc_html__( 'Header', 'home-control-system' ),
			],
			'menu'  => [
				'label' => esc_html__( 'Menu', 'home-control-system' ),
			],
		],
		'priority'       => 160,
	) );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'menu',
		'settings'    => 'home_control_system_menu_size_heading',
		'section'     => 'home_control_system_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Font Size(px)', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_menu_size',
		'tab'      => 'menu',
		'label'       => __( 'Enter a value in pixels. Example:20px', 'home-control-system' ),
		'type'        => 'text',
		'section'     => 'home_control_system_section_header',
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
		'settings'    => 'home_control_system_menu_text_transform_heading',
		'section'     => 'home_control_system_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Text Transform', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'menu',
		'settings'    => 'home_control_system_menu_text_transform',
		'section'     => 'home_control_system_section_header',
		'default'     => 'capitalize',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'home-control-system' ),
			'uppercase' => esc_html__( 'Uppercase', 'home-control-system' ),
			'lowercase' => esc_html__( 'Lowercase', 'home-control-system' ),
			'capitalize' => esc_html__( 'Capitalize', 'home-control-system' ),
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => ' text-transform',
			),
		),
	));

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'tab'      => 'header',
		'settings'    => 'home_control_system_sticky_header',
		'label'       => esc_html__( 'Enable/Disable Sticky Header', 'home-control-system' ),
		'section'     => 'home_control_system_section_header',
		'default'     => 0,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'home-control-system' ),
			'off' => esc_html__( 'Disable', 'home-control-system' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'home_control_system_phone_number_heading',
		'section'     => 'home_control_system_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Join Button', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'tab'      => 'header',
		'label'    =>  esc_html__( 'Text', 'home-control-system' ),
		'settings' => 'home_control_system_header_button_text',
		'section'  => 'home_control_system_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'url',
		'tab'      => 'header',
		'label'    =>  esc_html__( 'Link', 'home-control-system' ),
		'settings' => 'home_control_system_header_button_url',
		'section'  => 'home_control_system_section_header',
		'default'  => '',
	] );

	// WOOCOMMERCE SETTINGS

	Kirki::add_section( 'home_control_system_woocommerce_settings', array(
		'title'          => esc_html__( 'Woocommerce Settings', 'home-control-system' ),
		'description'    => esc_html__( 'Woocommerce Settings of themes', 'home-control-system' ),
		'panel'    => 'woocommerce',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'home_control_system_shop_page_sidebar',
		'label'       => esc_html__( 'Enable/Disable Shop Page Sidebar', 'home-control-system' ),
		'section'     => 'home_control_system_woocommerce_settings',
		'default'     => 'false',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Shop Page Layouts', 'home-control-system' ),
		'settings'    => 'home_control_system_shop_page_layout',
		'section'     => 'home_control_system_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'home-control-system' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'home-control-system' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'home_control_system_shop_page_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'label'       => esc_html__( 'Products Per Row', 'home-control-system' ),
		'settings'    => 'home_control_system_products_per_row',
		'section'     => 'home_control_system_woocommerce_settings',
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
		'label'       => esc_html__( 'Products Per Page', 'home-control-system' ),
		'settings'    => 'home_control_system_products_per_page',
		'section'     => 'home_control_system_woocommerce_settings',
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
		'settings'    => 'home_control_system_single_product_sidebar',
		'label'       => esc_html__( 'Enable / Disable Single Product Sidebar', 'home-control-system' ),
		'section'     => 'home_control_system_woocommerce_settings',
		'default'     => 'true',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Single Product Layout', 'home-control-system' ),
		'settings'    => 'home_control_system_single_product_sidebar_layout',
		'section'     => 'home_control_system_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'home-control-system' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'home-control-system' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'home_control_system_single_product_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_products_button_border_radius_heading',
		'section'     => 'home_control_system_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Products Button Border Radius', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'home_control_system_products_button_border_radius',
		'section'     => 'home_control_system_woocommerce_settings',
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
		'settings'    => 'home_control_system_sale_badge_position_heading',
		'section'     => 'home_control_system_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Badge Position', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'home_control_system_sale_badge_position',
		'section'     => 'home_control_system_woocommerce_settings',
		'default'     => 'right',
		'choices'     => [
			'right' => esc_html__( 'Right', 'home-control-system' ),
			'left' => esc_html__( 'Left', 'home-control-system' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_products_sale_font_size_heading',
		'section'     => 'home_control_system_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Font Size', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'text',
		'settings'    => 'home_control_system_products_sale_font_size',
		'section'     => 'home_control_system_woocommerce_settings',
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
    'settings' => 'home_control_system_show_product_featured_image_hover_heading',
    'section'  => 'home_control_system_woocommerce_settings',
    'default'  => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1;">' . __( 'Product Featured Image Hover Effect', 'home-control-system' ) . '</h3>',
    'priority' => 20,
   ] );

	Kirki::add_field( 'theme_config_id', [
    'type'     => 'select',
    'settings' => 'home_control_system_product_featured_image_hover',
    'label'    => esc_html__( 'Product Featured Image Hover Effect', 'home-control-system' ),
    'section'  => 'home_control_system_woocommerce_settings',
    'default'  => 'none',
    'priority' => 30,
    'choices'  => [
        'none'      => esc_html__( 'None', 'home-control-system' ),
        'zoom-in'   => esc_html__( 'Zoom In', 'home-control-system' ),
        'zoom-out'  => esc_html__( 'Zoom Out', 'home-control-system' ),
        'scale'     => esc_html__( 'Scale', 'home-control-system' ),
        'grayscale' => esc_html__( 'Grayscale', 'home-control-system' ),
        'blur'      => esc_html__( 'Blur', 'home-control-system' ),
        'bright'    => esc_html__( 'Bright', 'home-control-system' ),
        'sepia'     => esc_html__( 'Sepia', 'home-control-system' ),
        'translate' => esc_html__( 'Translate', 'home-control-system' ),
    ],
    ] );
	
	//ADDITIONAL SETTINGS

	Kirki::add_section( 'home_control_system_additional_setting', array(
		'title'          => esc_html__( 'Additional Settings', 'home-control-system' ),
		'description'    => esc_html__( 'Additional Settings of themes', 'home-control-system' ),
		'panel'    => 'home_control_system_theme_options_panel',
		'priority'       => 10,
		'tabs'  => [
			'general' => [
				'label' => esc_html__( 'General', 'home-control-system' ),
			],
			'header-image'  => [
				'label' => esc_html__( 'Header Image', 'home-control-system' ),
			],
		],
	) );
    Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'home_control_system_preloader_hide',
		'label'       => esc_html__( 'Here you can enable or disable your preloader.', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => false,
		'priority'    => 10,
		'tab'      => 'general',
	] );
    
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_preloader_type_heading',
		'section'     => 'home_control_system_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Select Preloader Type', 'home-control-system' ) . '</h3>',
	] );
	
	Kirki::add_field( 'theme_config_id', [
		'type'     => 'radio',
		'tab'      => 'general',
		'settings' => 'home_control_system_preloader_type',
		'section'  => 'home_control_system_additional_setting',
		'default'  => 'diamond',
		'choices'  => [
			'diamond' => esc_html__( 'Diamond', 'home-control-system' ),
			'orbit' => esc_html__( 'Orbit Pulse Loader', 'home-control-system' ),
			'liquid' => esc_html__( 'Liquid Glow Loader', 'home-control-system' ),
		],
    ] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_preloader_bg_image_heading',
		'section'     => 'home_control_system_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Preloader Background', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id',
	[
		'settings'    => 'home_control_system_preloader_bg_image',
		'tab'      => 'general',
		'type'        => 'background',
		'section'     => 'home_control_system_additional_setting',
		'default'     => [
			'background-color'      => 'rgba(255, 255, 255, 1)',
			'background-image'      => '',
			'background-repeat'     => 'no-repeat',
			'background-position'   => 'center center',
		],
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => '.preloader-types',
			],
		],
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'home_control_system_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => true ,
		'priority'    => 10,
		'tab'      => 'general',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_enable_sidebar_sticky_heading',
		'section'     => 'home_control_system_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sticky Sidebar', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'home_control_system_enable_sticky_sidebar',
		'label'       => esc_html__( 'Enable or Disable Sticky Sidebar', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_enable_sidebar_animation_heading',
		'section'     => 'home_control_system_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Animation', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'home_control_system_enable_sidebar_animation',
		'label'       => esc_html__( 'Enable or Disable Sidebar Animation', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'home_control_system_enable_footer_animation',
		'label'       => esc_html__( 'Enable or Disable Footer Animation', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => true,
		'priority'    => 10,
	] );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_scroll_alignment_heading',
		'section'     => 'home_control_system_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Scroll To Top Position', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'radio-buttonset',
		'tab'      => 'general',
		'settings'    => 'home_control_system_scroll_alignment',
		'section'     => 'home_control_system_additional_setting',
		'default'     => 'right',
		'choices'     => [
			'left' => esc_html__( 'left', 'home-control-system' ),
			'center' => esc_html__( 'center', 'home-control-system' ),
			'right' => esc_html__( 'right', 'home-control-system' ),
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_scroller_border_radius_heading',
		'section'     => 'home_control_system_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Scroll To Top Border Radius', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'slider',
		'tab'      => 'general',
		'settings'    => 'home_control_system_scroller_border_radius',
		'section'     => 'home_control_system_additional_setting',
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
		'settings'    => 'home_control_system_cursor_outline_heading',
		'section'     => 'home_control_system_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Dot Cursor', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'home_control_system_cursor_outline',
		'label'       => esc_html__( 'Enable or Disable Dot Cursor', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_progress_bar_heading',
		'section'     => 'home_control_system_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'home_control_system_progress_bar',
		'label'       => esc_html__( 'Enable or Disable Progress Bar', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_progress_bar_position_heading',
		'section'     => 'home_control_system_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar Position', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
		'active_callback'  => [
			[
				'setting'  => 'home_control_system_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'general',
		'settings'    => 'home_control_system_progress_bar_position',
		'section'     => 'home_control_system_additional_setting',
		'default'     => 'top',
		'choices'     => [
			'top' => esc_html__( 'Top', 'home-control-system' ),
			'bottom' => esc_html__( 'Bottom', 'home-control-system' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'home_control_system_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_progress_bar_color_heading',
		'section'     => 'home_control_system_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar Color', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
		'active_callback'  => [
			[
				'setting'  => 'home_control_system_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_progress_bar_color',
		'tab'      => 'general',
		'label'       => __( 'Color', 'home-control-system' ),
		'type'        => 'color',
		'section'     => 'home_control_system_additional_setting',
		'transport' => 'auto',
		'default'     => '#53015B',
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
				'setting'  => 'home_control_system_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'home_control_system_single_page_layout_heading',
		'section'     => 'home_control_system_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Page Layout', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'general',
		'settings'    => 'home_control_system_single_page_layout',
		'section'     => 'home_control_system_additional_setting',
		'default'     => 'One Column',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'home-control-system' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'home-control-system' ),
			'One Column' => esc_html__( 'One Column', 'home-control-system' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'home_control_system_header_background_attachment_heading',
		'section'     => 'home_control_system_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Attachment', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'header-image',
		'settings'    => 'home_control_system_header_background_attachment',
		'section'     => 'home_control_system_additional_setting',
		'default'     => 'scroll',
		'choices'     => [
			'scroll' => esc_html__( 'Scroll', 'home-control-system' ),
			'fixed' => esc_html__( 'Fixed', 'home-control-system' ),
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
		'settings'    => 'home_control_system_header_image_height_heading',
		'section'     => 'home_control_system_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image height', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_header_image_height',
		'label'       => __( 'Image Height', 'home-control-system' ),
		'description'    => esc_html__( 'Enter a value in pixels. Example:500px', 'home-control-system' ),
		'type'        => 'text',
		'tab'      => 'header-image',
		'default'    => [
			'desktop' => '450px',
			'tablet'  => '400px',
			'mobile'  => '200px',
		],
		'responsive' => true,
		'section'     => 'home_control_system_additional_setting',
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
		'settings'    => 'home_control_system_header_overlay_heading',
		'section'     => 'home_control_system_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Overlay', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_header_overlay_setting',
		'tab'      => 'header-image',
		'label'       => __( 'Overlay Color', 'home-control-system' ),
		'type'        => 'color',
		'section'     => 'home_control_system_additional_setting',
		'transport' => 'auto',
		'default'     => '#00000085',
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
		'settings'    => 'home_control_system_header_page_title',
		'label'       => esc_html__( 'Enable / Disable Header Image Page Title.', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header-image',
		'settings'    => 'home_control_system_header_breadcrumb',
		'label'       => esc_html__( 'Enable / Disable Header Image Breadcrumb.', 'home-control-system' ),
		'section'     => 'home_control_system_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	// POST SECTION

	Kirki::add_section( 'home_control_system_blog_post', array(
		'title'          => esc_html__( 'Post Settings', 'home-control-system' ),
		'description'    => esc_html__( 'Here you can add post information.', 'home-control-system' ),
		'panel'    => 'home_control_system_theme_options_panel',
		'tabs'  => [
			'blog-post' => [
				'label' => esc_html__( 'Blog Post', 'home-control-system' ),
			],
			'single-post'  => [
				'label' => esc_html__( 'Single Post', 'home-control-system' ),
			],
		],
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_enable_post_animation_heading',
		'section'     => 'home_control_system_blog_post',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Animation', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_enable_post_animation',
		'label'       => esc_html__( 'Enable or Disable Blog Post Animation', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_post_layout_heading',
		'section'     => 'home_control_system_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Layout', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_post_layout',
		'section'     => 'home_control_system_blog_post',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'home-control-system' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'home-control-system' ),
			'One Column' => esc_html__( 'One Column', 'home-control-system' ),
			'Three Columns' => esc_html__( 'Three Columns', 'home-control-system' ),
			'Four Columns' => esc_html__( 'Four Columns', 'home-control-system' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_date_hide',
		'label'       => esc_html__( 'Enable / Disable Post Date', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_author_hide',
		'label'       => esc_html__( 'Enable / Disable Post Author', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Post Comment', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_blog_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Post Image', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_length_setting_heading',
		'section'     => 'home_control_system_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Post Content Limit', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'tab'      => 'blog-post',
		'settings'    => 'home_control_system_length_setting',
		'section'     => 'home_control_system_blog_post',
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
		'settings'    => 'home_control_system_single_post_date_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Date', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'home_control_system_single_post_author_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Author', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'home_control_system_single_post_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Comment', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Tag', 'home-control-system' ),
		'settings'    => 'home_control_system_single_post_tag',
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Category', 'home-control-system' ),
		'settings'    => 'home_control_system_single_post_category',
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'home_control_system_single_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Single Post Image', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'single-post',
		'settings'    => 'home_control_system_single_post_radius',
		'section'     => 'home_control_system_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Post Image Border Radius(px)', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_single_post_border_radius',
		'label'       => __( 'Enter a value in pixels. Example:15px', 'home-control-system' ),
		'type'        => 'text',
		'tab'      => 'single-post',
		'section'     => 'home_control_system_blog_post',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.post-img img'),
				'property' => 'border-radius',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'single-post',
		'settings'    => 'home_control_system_show_related_post_heading',
		'section'     => 'home_control_system_blog_post',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Related post', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'home_control_system_show_related_post',
		'label'       => esc_html__( 'Enable or Disable Related post', 'home-control-system' ),
		'section'     => 'home_control_system_blog_post',
		'default'     => true,
		'priority'    => 10,
	] );

	// No Results Page Settings

	Kirki::add_section( 'home_control_system_no_result_section', array(
		'title'          => esc_html__( '404 & No Results Page Settings', 'home-control-system' ),
		'panel'    => 'home_control_system_theme_options_panel',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_page_not_found_title_heading',
		'section'     => 'home_control_system_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Title', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'home_control_system_page_not_found_title',
		'section'  => 'home_control_system_no_result_section',
		'default'  => esc_html__('404 Error!', 'home-control-system'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_page_not_found_text_heading',
		'section'     => 'home_control_system_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Text', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'home_control_system_page_not_found_text',
		'section'  => 'home_control_system_no_result_section',
		'default'  => esc_html__('The page you are looking for may have been moved, deleted, or possibly never existed.', 'home-control-system'),
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'     => 'custom',
		'settings' => 'home_control_system_page_not_found_line_break',
		'section'  => 'home_control_system_no_result_section',
		'default'  => '<hr>',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_no_results_title_heading',
		'section'     => 'home_control_system_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Title', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'home_control_system_no_results_title',
		'section'  => 'home_control_system_no_result_section',
		'default'  => esc_html__('Nothing Found', 'home-control-system'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_no_results_content_heading',
		'section'     => 'home_control_system_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Content', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'home_control_system_no_results_content',
		'section'  => 'home_control_system_no_result_section',
		'default'  => esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'home-control-system'),
	] );
	
	// FOOTER SECTION

	Kirki::add_section( 'home_control_system_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'home-control-system' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'home-control-system' ),
        'panel'    => 'home_control_system_theme_options_panel',
		'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_show_footer_widget_heading',
		'section'     => 'home_control_system_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'home_control_system_show_footer_widget',
		'label'       => esc_html__( 'Footer Widget', 'home-control-system' ),
		'section'     => 'home_control_system_footer_section',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'home_control_system_show_footer_copyright',
		'label'       => esc_html__( 'Footer Copyright', 'home-control-system' ),
		'section'     => 'home_control_system_footer_section',
		'default'     => '1',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_footer_text_heading',
		'section'     => 'home_control_system_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'home_control_system_footer_text',
		'section'  => 'home_control_system_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_footer_sticky_heading',
		'section'     => 'home_control_system_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Sticky Copyright', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'home_control_system_sticky_copyright_enable',
		'label'       => esc_html__( ' Sticky Copyright Section Enable / Disable', 'home-control-system' ),
		'section'     => 'home_control_system_footer_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'home-control-system' ),
			'off' => esc_html__( 'Disable', 'home-control-system' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_footer_enable_heading',
		'section'     => 'home_control_system_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'home_control_system_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'home-control-system' ),
		'section'     => 'home_control_system_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'home-control-system' ),
			'off' => esc_html__( 'Disable', 'home-control-system' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_footer_background_widget_heading',
		'section'     => 'home_control_system_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Background', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id',
	[
		'settings'    => 'home_control_system_footer_background_widget',
		'type'        => 'background',
		'section'     => 'home_control_system_footer_section',
		'default'     => [
			'background-color'      => '#121212',
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
		'settings'    => 'home_control_system_footer_widget_alignment_heading',
		'section'     => 'home_control_system_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Alignment', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'home_control_system_footer_widget_alignment',
		'section'     => 'home_control_system_footer_section',
		'default'     =>[
			'desktop' => 'left',
			'tablet'  => 'left',
			'mobile'  => 'center',
		],
		'responsive' => true,
		'label'       => __( 'Widget Alignment', 'home-control-system' ),
		'transport' => 'auto',
		'choices'     => [
			'center' => esc_html__( 'center', 'home-control-system' ),
			'right' => esc_html__( 'right', 'home-control-system' ),
			'left' => esc_html__( 'left', 'home-control-system' ),
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
		'settings'    => 'home_control_system_footer_copright_color_heading',
		'section'     => 'home_control_system_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Background Color', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_footer_copright_color',
		'type'        => 'color',
		'label'       => __( 'Background Color', 'home-control-system' ),
		'section'     => 'home_control_system_footer_section',
		'transport' => 'auto',
		'default'     => '#2F2B2F',
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
		'settings'    => 'home_control_system_footer_copright_text_color_heading',
		'section'     => 'home_control_system_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Text Color', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_footer_copright_text_color',
		'type'        => 'color',
		'label'       => __( 'Text Color', 'home-control-system' ),
		'section'     => 'home_control_system_footer_section',
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


	// Footer Social Icons Section

	Kirki::add_section( 'home_control_system_footer_social_media_section', array(
		'title'          => esc_html__( 'Footer Social Icons', 'home-control-system' ),
		'panel'    => 'home_control_system_theme_options_panel',
		'priority'       => 160,
	) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_footer_social_icon_hide_heading',
		'section'     => 'home_control_system_footer_social_media_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable or Disable your Footer Social Icon', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'home_control_system_footer_social_icon_hide',
		'label'       => esc_html__( 'Enable or Disable Social Icon.', 'home-control-system' ),
		'section'     => 'home_control_system_footer_social_media_section',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'home_control_system_enable_footer_socail_link_align_heading',
		'section'     => 'home_control_system_footer_social_media_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Social Media Text Align', 'home-control-system' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'home_control_system_enable_footer_socail_link_align',
		'type'        => 'select',
		'priority'    => 10,
		'label'       => __( 'Text Align', 'home-control-system' ),
		'section'     => 'home_control_system_footer_social_media_section',
		'default'     => 'left',
		'choices'     => [
			'center' => esc_html__( 'center', 'home-control-system' ),
			'right' => esc_html__( 'right', 'home-control-system' ),
			'left' => esc_html__( 'left', 'home-control-system' ),
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
		'settings'    => 'home_control_system_enable_footer_socail_link',
		'section'     => 'home_control_system_footer_social_media_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Social Media Link', 'home-control-system' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'priority'    => 10,
		'section'     => 'home_control_system_footer_social_media_section',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Footer Social Icons', 'home-control-system' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'home-control-system' ),
		'settings'     => 'home_control_system_social_links_settings_footer',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'home-control-system' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'home-control-system' ). ' <a href="https://fontawesome.com/v6/search?ic=brands" target="_blank"><strong>' . esc_html__( 'View All', 'home-control-system' ) . ' </strong></a>',
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'home-control-system' ),
				'description' => esc_html__( 'Add the social icon url here.', 'home-control-system' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 20
		],
	] );

	load_template( trailingslashit( get_template_directory() ) . '/includes/logo/logo-resizer.php' );
}

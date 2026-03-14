<?php

if ( class_exists("Kirki")){

	Kirki::add_config('theme_config_id', array(
		'capability'   =>  'edit_theme_options',
		'option_type'  =>  'theme_mod',
	));


	Kirki::add_field( 'theme_config_id', [
		'label'       => esc_html__( 'Logo Size','jewelry-outlet' ),
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
		'settings'    => 'jewelry_outlet_enable_logo_text',
		'section'     => 'title_tagline',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

  	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'jewelry_outlet_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'jewelry-outlet' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'jewelry_outlet_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'jewelry-outlet' ),
		'section'     => 'title_tagline',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_site_tittle_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Title Font Size', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_site_tittle_font_size',
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
		'settings'    => 'jewelry_outlet_site_tagline_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Tagline Font Size', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_site_tagline_font_size',
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

	Kirki::add_section( 'jewelry_outlet_theme_color_setting', array(
		'title'    => __( 'Color Option', 'jewelry-outlet' ),
		'priority' => 10,
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_first_theme_color',
		'label'       => __( 'Theme First color', 'jewelry-outlet'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_theme_color_setting',
		'type'        => 'color',
		'default'     => '#c29734',
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_second_theme_color',
		'label'       => __( 'Theme Second color', 'jewelry-outlet'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_theme_color_setting',
		'type'        => 'color',
		'default'     => '#222222',
	) );

	// TYPOGRAPHY SETTINGS

	Kirki::add_panel( 'jewelry_outlet_typography_panel', array(
		'priority' => 10,
		'title'    => __( 'Typography', 'jewelry-outlet' ),
	) );

	//Heading 1 Section

	Kirki::add_section( 'jewelry_outlet_h1_typography_setting', array(
		'title'    => __( 'Heading 1', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_h1_typography_heading',
		'section'     => 'jewelry_outlet_h1_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 1 Typography', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'jewelry_outlet_h1_typography_font',
		'section'   =>  'jewelry_outlet_h1_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Rubik', sans-serif",
			'variant'       =>  '700',
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

	Kirki::add_section( 'jewelry_outlet_h2_typography_setting', array(
		'title'    => __( 'Heading 2', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_h2_typography_heading',
		'section'     => 'jewelry_outlet_h2_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 2 Typography', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'jewelry_outlet_h2_typography_font',
		'section'   =>  'jewelry_outlet_h2_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Rubik', sans-serif",
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

	Kirki::add_section( 'jewelry_outlet_h3_typography_setting', array(
		'title'    => __( 'Heading 3', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_h3_typography_heading',
		'section'     => 'jewelry_outlet_h3_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 3 Typography', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'jewelry_outlet_h3_typography_font',
		'section'   =>  'jewelry_outlet_h3_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Rubik', sans-serif",
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

	Kirki::add_section( 'jewelry_outlet_h4_typography_setting', array(
		'title'    => __( 'Heading 4', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_h4_typography_heading',
		'section'     => 'jewelry_outlet_h4_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 4 Typography', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'jewelry_outlet_h4_typography_font',
		'section'   =>  'jewelry_outlet_h4_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Rubik', sans-serif",
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

	Kirki::add_section( 'jewelry_outlet_h5_typography_setting', array(
		'title'    => __( 'Heading 5', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_h5_typography_heading',
		'section'     => 'jewelry_outlet_h5_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 5 Typography', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'jewelry_outlet_h5_typography_font',
		'section'   =>  'jewelry_outlet_h5_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Rubik', sans-serif",
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

	Kirki::add_section( 'jewelry_outlet_h6_typography_setting', array(
		'title'    => __( 'Heading 6', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_h6_typography_heading',
		'section'     => 'jewelry_outlet_h6_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 6 Typography', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'jewelry_outlet_h6_typography_font',
		'section'   =>  'jewelry_outlet_h6_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Rubik', sans-serif",
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

	Kirki::add_section( 'jewelry_outlet_body_typography_setting', array(
		'title'    => __( 'Content Typography', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_body_typography_heading',
		'section'     => 'jewelry_outlet_body_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Content  Typography', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'jewelry_outlet_body_typography_font',
		'section'   =>  'jewelry_outlet_body_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Rubik', sans-serif",
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

	Kirki::add_panel( 'jewelry_outlet_theme_options_panel', array(
		'priority' => 10,
		'title'    => __( 'Theme Options', 'jewelry-outlet' ),
	) );

	// HEADER SECTION

	Kirki::add_section( 'jewelry_outlet_section_header',array(
		'title' => esc_html__( 'Header Settings', 'jewelry-outlet' ),
		'description'    => esc_html__( 'Here you can add header information.', 'jewelry-outlet' ),
		'panel' => 'jewelry_outlet_theme_options_panel',
		'tabs'  => [
			'header' => [
				'label' => esc_html__( 'Header', 'jewelry-outlet' ),
			],
			'menu'  => [
				'label' => esc_html__( 'Menu', 'jewelry-outlet' ),
			],
		],
		'priority'       => 160,
	) );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'menu',
		'settings'    => 'jewelry_outlet_menu_size_heading',
		'section'     => 'jewelry_outlet_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Font Size(px)', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_menu_size',
		'tab'      => 'menu',
		'label'       => __( 'Enter a value in pixels. Example:20px', 'jewelry-outlet' ),
		'type'        => 'text',
		'section'     => 'jewelry_outlet_section_header',
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
		'settings'    => 'jewelry_outlet_menu_text_transform_heading',
		'section'     => 'jewelry_outlet_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Text Transform', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'menu',
		'settings'    => 'jewelry_outlet_menu_text_transform',
		'section'     => 'jewelry_outlet_section_header',
		'default'     => 'capitalize',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'jewelry-outlet' ),
			'uppercase' => esc_html__( 'Uppercase', 'jewelry-outlet' ),
			'lowercase' => esc_html__( 'Lowercase', 'jewelry-outlet' ),
			'capitalize' => esc_html__( 'Capitalize', 'jewelry-outlet' ),
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
		'settings'    => 'jewelry_outlet_sticky_header_heading',
		'section'     => 'jewelry_outlet_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sticky Header', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'tab'      => 'header',
		'settings'    => 'jewelry_outlet_sticky_header',
		'section'     => 'jewelry_outlet_section_header',
		'default'     => 0,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'label'    =>  esc_html__( 'Add Topbar Text', 'jewelry-outlet' ),
		'type'     => 'text',
		'tab'      => 'header',
		'settings' => 'jewelry_outlet_header_toptxt',
		'section'  => 'jewelry_outlet_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'tab'      => 'header',
		'settings'    => 'jewelry_outlet_google_translator',
		'label'       => esc_html__( 'Language Translator', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_section_header',
		'default'     => 1,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'tab'      => 'header',
		'settings'    => 'jewelry_outlet_currency_switcher',
		'label'       => esc_html__( 'Currency Switcher', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_section_header',
		'default'     => 1,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'tab'      => 'header',
		'settings'    => 'jewelry_outlet_disable_search_icon',
		'label'       => esc_html__( 'Enable/Disable Search', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_section_header',
		'default'     => 'on',
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'tab'      => 'header',
		'settings'    => 'jewelry_outlet_cart_box_enable',
		'label'       => esc_html__( 'Enable/Disable Shopping Cart', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_section_header',
		'default'     => 'on',
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'jewelry_outlet_header_phone_number_heading',
		'section'     => 'jewelry_outlet_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Add Phone Number', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'tab'      => 'header',
		'label'    =>  esc_html__( 'Text', 'jewelry-outlet' ),
		'settings' => 'jewelry_outlet_header_phone_number_text',
		'section'  => 'jewelry_outlet_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'tab'      => 'header',
		'label'    =>  esc_html__( 'Phone Number', 'jewelry-outlet' ),
		'settings' => 'jewelry_outlet_header_phone_number',
		'section'  => 'jewelry_outlet_section_header',
		'default'  => '',
		'sanitize_callback' => 'jewelry_outlet_sanitize_phone_number',
	] );
	
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'jewelry_outlet_enable_socail_link',
		'section'     => 'jewelry_outlet_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'tab'      => 'header',
		'section'     => 'jewelry_outlet_section_header',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Social Icon', 'jewelry-outlet' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'jewelry-outlet' ),
		'settings'     => 'jewelry_outlet_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'jewelry-outlet' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'jewelry-outlet' ). ' <a href="https://fontawesome.com/search?o=r&m=free&f=brands" target="_blank"><strong>' . esc_html__( 'View All', 'jewelry-outlet' ) . ' </strong></a>',
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'jewelry-outlet' ),
				'description' => esc_html__( 'Add the social icon url here.', 'jewelry-outlet' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 20
		],
	] );


	// WOOCOMMERCE SETTINGS

	Kirki::add_section( 'jewelry_outlet_woocommerce_settings', array(
		'title'          => esc_html__( 'Woocommerce Settings', 'jewelry-outlet' ),
		'description'    => esc_html__( 'Woocommerce Settings of themes', 'jewelry-outlet' ),
		'panel'    => 'woocommerce',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'jewelry_outlet_shop_page_sidebar',
		'label'       => esc_html__( 'Enable/Disable Shop Page Sidebar', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_woocommerce_settings',
		'default'     => 'false',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Shop Page Layouts', 'jewelry-outlet' ),
		'settings'    => 'jewelry_outlet_shop_page_layout',
		'section'     => 'jewelry_outlet_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'jewelry-outlet' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'jewelry-outlet' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'jewelry_outlet_shop_page_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'label'       => esc_html__( 'Products Per Row', 'jewelry-outlet' ),
		'settings'    => 'jewelry_outlet_products_per_row',
		'section'     => 'jewelry_outlet_woocommerce_settings',
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
		'label'       => esc_html__( 'Products Per Page', 'jewelry-outlet' ),
		'settings'    => 'jewelry_outlet_products_per_page',
		'section'     => 'jewelry_outlet_woocommerce_settings',
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
		'settings'    => 'jewelry_outlet_single_product_sidebar',
		'label'       => esc_html__( 'Enable / Disable Single Product Sidebar', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_woocommerce_settings',
		'default'     => 'true',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Single Product Layout', 'jewelry-outlet' ),
		'settings'    => 'jewelry_outlet_single_product_sidebar_layout',
		'section'     => 'jewelry_outlet_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'jewelry-outlet' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'jewelry-outlet' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'jewelry_outlet_single_product_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_products_button_border_radius_heading',
		'section'     => 'jewelry_outlet_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Products Button Border Radius', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'jewelry_outlet_products_button_border_radius',
		'section'     => 'jewelry_outlet_woocommerce_settings',
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
		'settings'    => 'jewelry_outlet_sale_badge_position_heading',
		'section'     => 'jewelry_outlet_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Badge Position', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'jewelry_outlet_sale_badge_position',
		'section'     => 'jewelry_outlet_woocommerce_settings',
		'default'     => 'right',
		'choices'     => [
			'right' => esc_html__( 'Right', 'jewelry-outlet' ),
			'left' => esc_html__( 'Left', 'jewelry-outlet' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_products_sale_font_size_heading',
		'section'     => 'jewelry_outlet_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Font Size', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'text',
		'settings'    => 'jewelry_outlet_products_sale_font_size',
		'section'     => 'jewelry_outlet_woocommerce_settings',
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
    'settings' => 'jewelry_outlet_show_product_featured_image_hover_heading',
    'section'  => 'jewelry_outlet_woocommerce_settings',
    'default'  => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1;">' . __( 'Product Featured Image Hover Effect', 'jewelry-outlet' ) . '</h3>',
    'priority' => 20,
   ] );

	Kirki::add_field( 'theme_config_id', [
    'type'     => 'select',
    'settings' => 'jewelry_outlet_product_featured_image_hover',
    'label'    => esc_html__( 'Product Featured Image Hover Effect', 'jewelry-outlet' ),
    'section'  => 'jewelry_outlet_woocommerce_settings',
    'default'  => 'none',
    'priority' => 30,
    'choices'  => [
        'none'      => esc_html__( 'None', 'jewelry-outlet' ),
        'zoom-in'   => esc_html__( 'Zoom In', 'jewelry-outlet' ),
        'zoom-out'  => esc_html__( 'Zoom Out', 'jewelry-outlet' ),
        'scale'     => esc_html__( 'Scale', 'jewelry-outlet' ),
        'grayscale' => esc_html__( 'Grayscale', 'jewelry-outlet' ),
        'blur'      => esc_html__( 'Blur', 'jewelry-outlet' ),
        'bright'    => esc_html__( 'Bright', 'jewelry-outlet' ),
        'sepia'     => esc_html__( 'Sepia', 'jewelry-outlet' ),
        'translate' => esc_html__( 'Translate', 'jewelry-outlet' ),
    ],
    ] );
	
	//ADDITIONAL SETTINGS

	Kirki::add_section( 'jewelry_outlet_additional_setting', array(
		'title'          => esc_html__( 'Additional Settings', 'jewelry-outlet' ),
		'description'    => esc_html__( 'Additional Settings of themes', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_theme_options_panel',
		'priority'       => 10,
		'tabs'  => [
			'general' => [
				'label' => esc_html__( 'General', 'jewelry-outlet' ),
			],
			'header-image'  => [
				'label' => esc_html__( 'Header Image', 'jewelry-outlet' ),
			],
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'jewelry_outlet_preloader_hide',
		'label'       => esc_html__( 'Here you can enable or disable your preloader.', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => false,
		'priority'    => 10,
		'tab'      => 'general',
	] );
    
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_preloader_type_heading',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Select Preloader Type', 'jewelry-outlet' ) . '</h3>',
	] );
	
	Kirki::add_field( 'theme_config_id', [
		'type'     => 'radio',
		'tab'      => 'general',
		'settings' => 'jewelry_outlet_preloader_type',
		'section'  => 'jewelry_outlet_additional_setting',
		'default'  => 'diamond',
		'choices'  => [
			'diamond' => esc_html__( 'Diamond', 'jewelry-outlet' ),
			'orbit' => esc_html__( 'Orbit Pulse Loader', 'jewelry-outlet' ),
			'liquid' => esc_html__( 'Liquid Glow Loader', 'jewelry-outlet' ),
		],
    ] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_preloader_bg_image_heading',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Preloader Background', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id',
	[
		'settings'    => 'jewelry_outlet_preloader_bg_image',
		'tab'      => 'general',
		'type'        => 'background',
		'section'     => 'jewelry_outlet_additional_setting',
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
		'settings'    => 'jewelry_outlet_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => true ,
		'priority'    => 10,
		'tab'      => 'general',
	] );
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_enable_sidebar_animation_heading',
		'section'     => 'jewelry_outlet_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Animation', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_enable_sidebar_animation',
		'label'       => esc_html__( 'Enable or Disable Sidebar Animation', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_enable_footer_animation',
		'label'       => esc_html__( 'Enable or Disable Footer Animation', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => true,
		'priority'    => 10,
	] );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_scroll_alignment_heading',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Scroll To Top Position', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'radio-buttonset',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_scroll_alignment',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => 'right',
		'choices'     => [
			'left' => esc_html__( 'left', 'jewelry-outlet' ),
			'center' => esc_html__( 'center', 'jewelry-outlet' ),
			'right' => esc_html__( 'right', 'jewelry-outlet' ),
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_scroller_border_radius_heading',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Scroll To Top Border Radius', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'slider',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_scroller_border_radius',
		'section'     => 'jewelry_outlet_additional_setting',
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
		'settings'    => 'jewelry_outlet_cursor_outline_heading',
		'section'     => 'jewelry_outlet_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Dot Cursor', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_cursor_outline',
		'label'       => esc_html__( 'Enable or Disable Dot Cursor', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_progress_bar_heading',
		'section'     => 'jewelry_outlet_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_progress_bar',
		'label'       => esc_html__( 'Enable or Disable Progress Bar', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_progress_bar_position_heading',
		'section'     => 'jewelry_outlet_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar Position', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
		'active_callback'  => [
			[
				'setting'  => 'jewelry_outlet_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_progress_bar_position',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => 'top',
		'choices'     => [
			'top' => esc_html__( 'Top', 'jewelry-outlet' ),
			'bottom' => esc_html__( 'Bottom', 'jewelry-outlet' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'jewelry_outlet_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_progress_bar_color_heading',
		'section'     => 'jewelry_outlet_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar Color', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
		'active_callback'  => [
			[
				'setting'  => 'jewelry_outlet_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_progress_bar_color',
		'tab'      => 'general',
		'label'       => __( 'Color', 'jewelry-outlet' ),
		'type'        => 'color',
		'section'     => 'jewelry_outlet_additional_setting',
		'transport' => 'auto',
		'default'     => '#c29734',
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
				'setting'  => 'jewelry_outlet_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_single_page_layout_heading',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Page Layout', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'general',
		'settings'    => 'jewelry_outlet_single_page_layout',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => 'One Column',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'jewelry-outlet' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'jewelry-outlet' ),
			'One Column' => esc_html__( 'One Column', 'jewelry-outlet' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'jewelry_outlet_header_background_attachment_heading',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Attachment', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'header-image',
		'settings'    => 'jewelry_outlet_header_background_attachment',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => 'scroll',
		'choices'     => [
			'scroll' => esc_html__( 'Scroll', 'jewelry-outlet' ),
			'fixed' => esc_html__( 'Fixed', 'jewelry-outlet' ),
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
		'settings'    => 'jewelry_outlet_header_image_height_heading',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image height', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_header_image_height',
		'label'       => __( 'Image Height', 'jewelry-outlet' ),
		'description'    => esc_html__( 'Enter a value in pixels. Example:500px', 'jewelry-outlet' ),
		'type'        => 'text',
		'tab'      => 'header-image',
		'default'    => [
			'desktop' => '500px',
			'tablet'  => '400px',
			'mobile'  => '200px',
		],
		'responsive' => true,
		'section'     => 'jewelry_outlet_additional_setting',
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
		'settings'    => 'jewelry_outlet_header_overlay_heading',
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Overlay', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_header_overlay_setting',
		'tab'      => 'header-image',
		'label'       => __( 'Overlay Color', 'jewelry-outlet' ),
		'type'        => 'color',
		'section'     => 'jewelry_outlet_additional_setting',
		'transport' => 'auto',
		'default'     => '#00000052',
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
		'settings'    => 'jewelry_outlet_header_page_title',
		'label'       => esc_html__( 'Enable / Disable Header Image Page Title.', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header-image',
		'settings'    => 'jewelry_outlet_header_breadcrumb',
		'label'       => esc_html__( 'Enable / Disable Header Image Breadcrumb.', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	// POST SECTION

	Kirki::add_section( 'jewelry_outlet_blog_post', array(
		'title'          => esc_html__( 'Post Settings', 'jewelry-outlet' ),
		'description'    => esc_html__( 'Here you can add post information.', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_theme_options_panel',
		'tabs'  => [
			'blog-post' => [
				'label' => esc_html__( 'Blog Post', 'jewelry-outlet' ),
			],
			'single-post'  => [
				'label' => esc_html__( 'Single Post', 'jewelry-outlet' ),
			],
		],
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_enable_post_animation_heading',
		'section'     => 'jewelry_outlet_blog_post',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Animation', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_enable_post_animation',
		'label'       => esc_html__( 'Enable or Disable Blog Post Animation', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_post_layout_heading',
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Layout', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_post_layout',
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'jewelry-outlet' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'jewelry-outlet' ),
			'One Column' => esc_html__( 'One Column', 'jewelry-outlet' ),
			'Three Columns' => esc_html__( 'Three Columns', 'jewelry-outlet' ),
			'Four Columns' => esc_html__( 'Four Columns', 'jewelry-outlet' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_date_hide',
		'label'       => esc_html__( 'Enable / Disable Post Date', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_author_hide',
		'label'       => esc_html__( 'Enable / Disable Post Author', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Post Comment', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_blog_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Post Image', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_length_setting_heading',
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Post Content Limit', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'tab'      => 'blog-post',
		'settings'    => 'jewelry_outlet_length_setting',
		'section'     => 'jewelry_outlet_blog_post',
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
		'settings'    => 'jewelry_outlet_single_post_date_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Date', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'jewelry_outlet_single_post_author_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Author', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'jewelry_outlet_single_post_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Comment', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Tag', 'jewelry-outlet' ),
		'settings'    => 'jewelry_outlet_single_post_tag',
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Category', 'jewelry-outlet' ),
		'settings'    => 'jewelry_outlet_single_post_category',
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'jewelry_outlet_single_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Single Post Image', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'single-post',
		'settings'    => 'jewelry_outlet_single_post_radius',
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Post Image Border Radius(px)', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_single_post_border_radius',
		'label'       => __( 'Enter a value in pixels. Example:15px', 'jewelry-outlet' ),
		'type'        => 'text',
		'tab'      => 'single-post',
		'section'     => 'jewelry_outlet_blog_post',
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
		'settings'    => 'jewelry_outlet_show_related_post_heading',
		'section'     => 'jewelry_outlet_blog_post',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Related post', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'jewelry_outlet_show_related_post',
		'label'       => esc_html__( 'Enable or Disable Related post', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_blog_post',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
        'type'        => 'custom',
        'tab'         => 'single-post',
        'settings'    => 'jewelry_outlet_show_single_post_featured_image_hover_heading',
        'section'     => 'jewelry_outlet_blog_post',
        'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Featured Image Hover Effect', 'jewelry-outlet' ) . '</h3>',
        'priority'    => 10,
    ] );

    Kirki::add_field( 'theme_config_id', [
    'type'     => 'select',
    'tab'      => 'single-post',
    'settings' => 'jewelry_outlet_single_post_featured_image_hover',
    'label'    => esc_html__( 'Select Featured Image Hover Effect', 'jewelry-outlet' ),
    'section'  => 'jewelry_outlet_blog_post',
    'default'  => 'none',
    'priority' => 20,
    'choices'  => [
        'none'      => esc_html__( 'None', 'jewelry-outlet' ),
        'zoom-in'   => esc_html__( 'Zoom In', 'jewelry-outlet' ),
        'zoom-out'  => esc_html__( 'Zoom Out', 'jewelry-outlet' ),
        'scale'     => esc_html__( 'Scale', 'jewelry-outlet' ),
        'grayscale' => esc_html__( 'Grayscale', 'jewelry-outlet' ),
        'blur'      => esc_html__( 'Blur', 'jewelry-outlet' ),
        'bright'    => esc_html__( 'Bright', 'jewelry-outlet' ),
        'sepia'     => esc_html__( 'Sepia', 'jewelry-outlet' ),
        'translate' => esc_html__( 'Translate', 'jewelry-outlet' ),
    ],
    ] );

	// No Results Page Settings

	Kirki::add_section( 'jewelry_outlet_no_result_section', array(
		'title'          => esc_html__( '404 & No Results Page Settings', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_theme_options_panel',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_page_not_found_title_heading',
		'section'     => 'jewelry_outlet_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Title', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'jewelry_outlet_page_not_found_title',
		'section'  => 'jewelry_outlet_no_result_section',
		'default'  => esc_html__('404 Error!', 'jewelry-outlet'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_page_not_found_text_heading',
		'section'     => 'jewelry_outlet_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Text', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'jewelry_outlet_page_not_found_text',
		'section'  => 'jewelry_outlet_no_result_section',
		'default'  => esc_html__('The page you are looking for may have been moved, deleted, or possibly never existed.', 'jewelry-outlet'),
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'     => 'custom',
		'settings' => 'jewelry_outlet_page_not_found_line_break',
		'section'  => 'jewelry_outlet_no_result_section',
		'default'  => '<hr>',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_no_results_title_heading',
		'section'     => 'jewelry_outlet_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Title', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'jewelry_outlet_no_results_title',
		'section'  => 'jewelry_outlet_no_result_section',
		'default'  => esc_html__('Nothing Found', 'jewelry-outlet'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_no_results_content_heading',
		'section'     => 'jewelry_outlet_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Content', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'jewelry_outlet_no_results_content',
		'section'  => 'jewelry_outlet_no_result_section',
		'default'  => esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'jewelry-outlet'),
	] );
	
	// FOOTER SECTION

	Kirki::add_section( 'jewelry_outlet_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'jewelry-outlet' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'jewelry-outlet' ),
        'panel'    => 'jewelry_outlet_theme_options_panel',
		'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_show_footer_widget_heading',
		'section'     => 'jewelry_outlet_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'jewelry_outlet_show_footer_widget',
		'label'       => esc_html__( 'Footer Widget', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_footer_section',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'jewelry_outlet_show_footer_copyright',
		'label'       => esc_html__( 'Footer Copyright', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_footer_section',
		'default'     => '1',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_footer_text_heading',
		'section'     => 'jewelry_outlet_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'jewelry_outlet_footer_text',
		'section'  => 'jewelry_outlet_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_footer_sticky_heading',
		'section'     => 'jewelry_outlet_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Sticky Copyright', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'jewelry_outlet_sticky_copyright_enable',
		'label'       => esc_html__( ' Sticky Copyright Section Enable / Disable', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_footer_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_footer_enable_heading',
		'section'     => 'jewelry_outlet_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'jewelry_outlet_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'jewelry-outlet' ),
			'off' => esc_html__( 'Disable', 'jewelry-outlet' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_footer_background_widget_heading',
		'section'     => 'jewelry_outlet_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Background', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id',
	[
		'settings'    => 'jewelry_outlet_footer_background_widget',
		'type'        => 'background',
		'section'     => 'jewelry_outlet_footer_section',
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
		'settings'    => 'jewelry_outlet_footer_widget_alignment_heading',
		'section'     => 'jewelry_outlet_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Alignment', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'jewelry_outlet_footer_widget_alignment',
		'section'     => 'jewelry_outlet_footer_section',
		'default'     =>[
			'desktop' => 'left',
			'tablet'  => 'left',
			'mobile'  => 'center',
		],
		'responsive' => true,
		'label'       => __( 'Widget Alignment', 'jewelry-outlet' ),
		'transport' => 'auto',
		'choices'     => [
			'center' => esc_html__( 'center', 'jewelry-outlet' ),
			'right' => esc_html__( 'right', 'jewelry-outlet' ),
			'left' => esc_html__( 'left', 'jewelry-outlet' ),
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
		'settings'    => 'jewelry_outlet_footer_copright_color_heading',
		'section'     => 'jewelry_outlet_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Background Color', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_footer_copright_color',
		'type'        => 'color',
		'label'       => __( 'Background Color', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_footer_section',
		'transport' => 'auto',
		'default'     => '#222222',
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
		'settings'    => 'jewelry_outlet_footer_copright_text_color_heading',
		'section'     => 'jewelry_outlet_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Text Color', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_footer_copright_text_color',
		'type'        => 'color',
		'label'       => __( 'Text Color', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_footer_section',
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

	Kirki::add_section( 'jewelry_outlet_footer_social_media_section', array(
		'title'          => esc_html__( 'Footer Social Icons', 'jewelry-outlet' ),
		'panel'    => 'jewelry_outlet_theme_options_panel',
		'priority'       => 160,
	) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_footer_social_icon_hide_heading',
		'section'     => 'jewelry_outlet_footer_social_media_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable or Disable your Footer Social Icon', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'jewelry_outlet_footer_social_icon_hide',
		'label'       => esc_html__( 'Enable or Disable Social Icon.', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_footer_social_media_section',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'jewelry_outlet_enable_footer_socail_link_align_heading',
		'section'     => 'jewelry_outlet_footer_social_media_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Social Media Text Align', 'jewelry-outlet' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'jewelry_outlet_enable_footer_socail_link_align',
		'type'        => 'select',
		'priority'    => 10,
		'label'       => __( 'Text Align', 'jewelry-outlet' ),
		'section'     => 'jewelry_outlet_footer_social_media_section',
		'default'     => 'left',
		'choices'     => [
			'center' => esc_html__( 'center', 'jewelry-outlet' ),
			'right' => esc_html__( 'right', 'jewelry-outlet' ),
			'left' => esc_html__( 'left', 'jewelry-outlet' ),
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
		'settings'    => 'jewelry_outlet_enable_footer_socail_link',
		'section'     => 'jewelry_outlet_footer_social_media_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Social Media Link', 'jewelry-outlet' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'priority'    => 10,
		'section'     => 'jewelry_outlet_footer_social_media_section',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Footer Social Icons', 'jewelry-outlet' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'jewelry-outlet' ),
		'settings'     => 'jewelry_outlet_social_links_settings_footer',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'jewelry-outlet' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'jewelry-outlet' ). ' <a href="https://fontawesome.com/v6/search?ic=brands" target="_blank"><strong>' . esc_html__( 'View All', 'jewelry-outlet' ) . ' </strong></a>',
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'jewelry-outlet' ),
				'description' => esc_html__( 'Add the social icon url here.', 'jewelry-outlet' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 20
		],
	] );

	load_template( trailingslashit( get_template_directory() ) . '/includes/logo/logo-resizer.php' );
}

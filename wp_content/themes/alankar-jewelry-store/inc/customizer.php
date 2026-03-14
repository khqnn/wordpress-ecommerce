<?php
/**
 * Alankar Jewelry Store: Customizer
 *
 * @subpackage Alankar Jewelry Store
 * @since 1.0
 */

use WPTRT\Customize\Section\Luzuk_Alankar_Jewelry_Store_Button;

add_action( 'customize_register', function( $manager ) {

	$manager->register_section_type( Luzuk_Alankar_Jewelry_Store_Button::class );

	$manager->add_section(
		new Luzuk_Alankar_Jewelry_Store_Button( $manager, 'luzuk_alankar_jewelry_store_pro', [
			'title' => __( 'Alankar Jewelry Store Pro', 'alankar-jewelry-store' ),
			'priority' => 0,
			'button_text' => __( 'Go Pro', 'alankar-jewelry-store' ),
			'button_url'  => esc_url( 'https://www.luzuk.com/products/premium-wordpress-jewelry-store-theme/', 'alankar-jewelry-store')
		] )
	);

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'alankar-jewelry-store-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
		[ 'customize-controls' ],
		$version,
		true
	);

	wp_enqueue_style(
		'alankar-jewelry-store-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
		[ 'customize-controls' ],
 		$version
	);

} );

function luzuk_alankar_jewelry_store_customize_register( $wp_customize ) {

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_logo_size',array(
		'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_float'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_logo_size',array(
		'type' => 'range',
		'label' => __('Logo Size','alankar-jewelry-store'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_logo_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_logo_padding',array(
		'label' => __('Logo Margin','alankar-jewelry-store'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_logo_top_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_float'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_logo_top_padding',array(
		'type' => 'number',
		'description' => __('Top','alankar-jewelry-store'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_logo_bottom_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_float'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_logo_bottom_padding',array(
		'type' => 'number',
		'description' => __('Bottom','alankar-jewelry-store'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_logo_left_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_float'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_logo_left_padding',array(
		'type' => 'number',
		'description' => __('Left','alankar-jewelry-store'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_logo_right_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_float'
 	));
 	$wp_customize->add_control('luzuk_alankar_jewelry_store_logo_right_padding',array(
		'type' => 'number',
		'description' => __('Right','alankar-jewelry-store'),
		'section' => 'title_tagline',
    ));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_show_site_title',array(
		'default' => true,
		'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_checkbox'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_show_site_title',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Site Title','alankar-jewelry-store'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_site_title_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_site_title_color', array(
		'label' => 'Title Color',
		'section' => 'title_tagline',
	)));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_show_tagline',array(
		'default' => true,
		'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_checkbox'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_show_tagline',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Site Tagline','alankar-jewelry-store'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_site_tagline_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_site_tagline_color', array(
		'label' => 'Tagline Color',
		'section' => 'title_tagline',
	)));

	$wp_customize->add_panel( 'luzuk_alankar_jewelry_store_panel_id', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Settings', 'alankar-jewelry-store' ),
		'description' => __( 'Description of what this panel does.', 'alankar-jewelry-store' ),
	) );

	$wp_customize->add_section( 'luzuk_alankar_jewelry_store_theme_options_section', array(
    	'title'      => __( 'General Settings', 'alankar-jewelry-store' ),
		'priority'   => 30,
		'panel' => 'luzuk_alankar_jewelry_store_panel_id'
	) );

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_theme_options',array(
		'default' => 'One Column',
		'sanitize_callback' => 'luzuk_alankar_jewelry_store_sanitize_choices'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_theme_options',array(
		'type' => 'select',
		'label' => __('Blog Page Sidebar Layout','alankar-jewelry-store'),
		'section' => 'luzuk_alankar_jewelry_store_theme_options_section',
		'choices' => array(
		   'Left Sidebar' => __('Left Sidebar','alankar-jewelry-store'),
		   'Right Sidebar' => __('Right Sidebar','alankar-jewelry-store'),
		   'One Column' => __('One Column','alankar-jewelry-store'),
		   'Grid Layout' => __('Grid Layout','alankar-jewelry-store')
		),
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_single_post_sidebar',array(
		'default' => 'Right Sidebar',
		'sanitize_callback' => 'luzuk_alankar_jewelry_store_sanitize_choices'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_single_post_sidebar',array(
        'type' => 'select',
        'label' => __('Single Post Sidebar Layout','alankar-jewelry-store'),
        'section' => 'luzuk_alankar_jewelry_store_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','alankar-jewelry-store'),
            'Right Sidebar' => __('Right Sidebar','alankar-jewelry-store'),
            'One Column' => __('One Column','alankar-jewelry-store')
        ),
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_page_sidebar',array(
		'default' => 'One Column',
		'sanitize_callback' => 'luzuk_alankar_jewelry_store_sanitize_choices'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_page_sidebar',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','alankar-jewelry-store'),
        'section' => 'luzuk_alankar_jewelry_store_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','alankar-jewelry-store'),
            'Right Sidebar' => __('Right Sidebar','alankar-jewelry-store'),
            'One Column' => __('One Column','alankar-jewelry-store')
        ),
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_archive_page_sidebar',array(
		'default' => 'One Column',
		'sanitize_callback' => 'luzuk_alankar_jewelry_store_sanitize_choices'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_archive_page_sidebar',array(
        'type' => 'select',
        'label' => __('Archive & Search Page Sidebar Layout','alankar-jewelry-store'),
        'section' => 'luzuk_alankar_jewelry_store_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','alankar-jewelry-store'),
            'Right Sidebar' => __('Right Sidebar','alankar-jewelry-store'),
            'One Column' => __('One Column','alankar-jewelry-store'),
            'Grid Layout' => __('Grid Layout','alankar-jewelry-store')
        ),
	));
 
	//Header
	$wp_customize->add_section( 'luzuk_alankar_jewelry_store_header' , array(
    	'title'    => __( 'Header Settings', 'alankar-jewelry-store' ),
		'priority' => null,
		'panel' => 'luzuk_alankar_jewelry_store_panel_id'
	) );
	

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_header_locationtext',array(
    	'default' => 'Find a Store',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_header_locationtext',array(
	   	'type' => 'text',
	   	'label' => __('Location Text','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_header',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_twitterlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_alankar_jewelry_store_twitterlink',array(
	   	'type' => 'url',
	   	'label' => __('Twitter Icon Link','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_header',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_fblink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_alankar_jewelry_store_fblink',array(
	   	'type' => 'url',
	   	'label' => __('Facebook Icon Link','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_header',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_instagramlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_alankar_jewelry_store_instagramlink',array(
	   	'type' => 'url',
	   	'label' => __('Instagram Icon Link','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_header',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_youtubelink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_alankar_jewelry_store_youtubelink',array(
	   	'type' => 'url',
	   	'label' => __('Youtube Icon Link','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_header',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_header_phonenumber',array(
		'default' => '123-456-789',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_header_phonenumber',array(
	   	'type' => 'text',
	   	'label' => __('Phone Number','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_header',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_header_phonetext',array(
		'default' => 'Pickup your order for free',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_header_phonetext',array(
	   	'type' => 'text',
	   	'label' => __('Phone Text','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_header',
	));
	
	$wp_customize->add_setting('luzuk_alankar_jewelry_store_header_offertext',array(
		'default' => 'Sale 30% off',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_header_offertext',array(
	   	'type' => 'text',
	   	'label' => __('Offer Text','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_header',
	));
	
	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_addressicon_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_addressicon_col', array(
		'label' => 'Address Icon Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_addresstext_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_addresstext_col', array(
		'label' => 'Address Text Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_addresstexthvr_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_addresstexthvr_col', array(
		'label' => 'Address Text Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_socialicon_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_socialicon_col', array(
		'label' => 'Social Icon Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_socialiconhvr_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_socialiconhvr_col', array(
		'label' => 'Social Icon Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_searchbtntext_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_searchbtntext_col', array(
		'label' => 'Search Button Text Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_searchbtnbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_searchbtnbg_col', array(
		'label' => 'Search Button BG Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_searchbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_searchbg_col', array(
		'label' => 'Search BG Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));


	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_searchicon_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_searchicon_col', array(
		'label' => 'Search bar Icon & Text Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_searchiconbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_searchiconbg_col', array(
		'label' => 'Search bar Icon BG Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_headerphonenumber_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_headerphonenumber_col', array(
		'label' => 'Phone Number Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_headerphonetext_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_headerphonetext_col', array(
		'label' => 'Phone Text Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_headeraccicon_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_headeraccicon_col', array(
		'label' => 'Accounts Icon Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_headercarticon_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_headercarticon_col', array(
		'label' => 'Cart Icon Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_headercartnum_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_headercartnum_col', array(
		'label' => 'Cart Number Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_headercartnumbg_col', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_headercartnumbg_col', array(
		'label' => 'Cart Number BG Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_menu_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_menu_color', array(
		'label' => 'Menu Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_menubrdhover_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_menubrdhover_color', array(
		'label' => 'Menu Hover & Border Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));


	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_submenu_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_submenu_color', array(
		'label' => 'Submenu Text Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_submenubg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_submenubg_color', array(
		'label' => 'Submenu BG Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_saletext_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_saletext_color', array(
		'label' => 'Sale Text Color',
		'section' => 'luzuk_alankar_jewelry_store_header',
	)));



	//home page slider
	$wp_customize->add_section( 'luzuk_alankar_jewelry_store_slider_section' , array(
    	'title'    => __( 'Slider Settings', 'alankar-jewelry-store' ),
		'description'=> __('<b>Note :</b> Please Add Image in 750*700 Ratio.','alankar-jewelry-store'),
		'priority' => null,
		'panel' => 'luzuk_alankar_jewelry_store_panel_id'
	) );

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_slider_hide_show',array(
    	'default' => false,
    	'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_checkbox'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_slider_hide_show',array(
	   	'type' => 'checkbox',
	   	'label' => __('Show / Hide Slider','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_slider_section',
	));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_effect', array(
		'default'           => '',
		'sanitize_callback' => 'luzuk_alankar_jewelry_store_sanitize_choices'
	));
	$wp_customize->add_control( 'luzuk_alankar_jewelry_store_slider_effect', array(
		'label'    => __( 'Onload Transactions Effects', 'alankar-jewelry-store' ),
		'section'  => 'luzuk_alankar_jewelry_store_slider_section',
		'type'     => 'select',
		'choices'  => array(
			'bounceInLeft'  => __('bounceInLeft', 'alankar-jewelry-store'),
			'bounceInRight' => __('bounceInRight', 'alankar-jewelry-store'),
			'bounceInUp'    => __('bounceInUp', 'alankar-jewelry-store'),
			'bounceInDown'    => __('bounceInDown', 'alankar-jewelry-store'),
			'zoomIn'  => __('zoomIn', 'alankar-jewelry-store'),
			'zoomOut' => __('zoomOut', 'alankar-jewelry-store'),
			'fadeInDown'    => __('fadeInDown', 'alankar-jewelry-store'),
			'fadeInUp'    => __('fadeInUp', 'alankar-jewelry-store'),
			'fadeInLeft'  => __('fadeInLeft', 'alankar-jewelry-store'),
			'fadeInRight' => __('fadeInRight', 'alankar-jewelry-store'),
			'flip-up'    => __('flip-up', 'alankar-jewelry-store'),
			'none'    => __('none', 'alankar-jewelry-store')
		),
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'luzuk_alankar_jewelry_store_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'luzuk_alankar_jewelry_store_slider' . $count, array(
			'label' => __('Select Slider Image Page', 'alankar-jewelry-store' ),
			'section' => 'luzuk_alankar_jewelry_store_slider_section',
			'type' => 'dropdown-pages'
		));
	}

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_slider_excerpt_length',array(
		'default' => '15',
		'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_float'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_slider_excerpt_length',array(
		'type' => 'number',
		'label' => __('Description Excerpt Length','alankar-jewelry-store'),
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_sliderexplorecollectionbtnlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_alankar_jewelry_store_sliderexplorecollectionbtnlink',array(
	   	'type' => 'url',
	   	'label' => __('Explore Collection Button Link','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_slider_section',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_slidercontactusbtnlink',array(
    	'default' => '#',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('luzuk_alankar_jewelry_store_slidercontactusbtnlink',array(
	   	'type' => 'url',
	   	'label' => __('Contact Us Button Link','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_slider_section',
	));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_title_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_title_color', array(
		'label' => 'Title Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_description_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_description_color', array(
		'label' => 'Description Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_btn1text_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_btn1text_color', array(
		'label' => 'Button 1 Text Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_btn1bg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_btn1bg_color', array(
		'label' => 'Button 1 BG Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_btn1texthvr_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_btn1texthvr_color', array(
		'label' => 'Button 1 Text Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_btntext_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_btntext_color', array(
		'label' => 'Button 2 Text Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_btnbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_btnbg_color', array(
		'label' => 'Button 2 Border Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_btntexthrv_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_btntexthrv_color', array(
		'label' => 'Button 2 Text Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_slider_btnbghrv_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_slider_btnbghrv_color', array(
		'label' => 'Button 2 BG Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_slider_section',
	)));



	// categories Section
	$wp_customize->add_section('luzuk_alankar_jewelry_store_categories_section',array(
		'title'	=> __('Categories Settings','alankar-jewelry-store'),
		'description'=> __('<b>Note :</b> This section will appear below the Slider.','alankar-jewelry-store'),
		'panel' => 'luzuk_alankar_jewelry_store_panel_id',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_productcategory_subheading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_productcategory_subheading',array(
	   	'type' => 'text',
	   	'label' => __('Sub Heading','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_categories_section',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_productcategory_heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_productcategory_heading',array(
	   	'type' => 'text',
	   	'label' => __('Heading','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_categories_section',
	));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_categoriessubheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_categoriessubheading_color', array(
		'label' => 'Sub Heading Color',
		'section' => 'luzuk_alankar_jewelry_store_categories_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_categoriesheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_categoriesheading_color', array(
		'label' => 'Heading Color',
		'section' => 'luzuk_alankar_jewelry_store_categories_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_categoriesheadingborder_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_categoriesheadingborder_color', array(
		'label' => 'Heading Border Color',
		'section' => 'luzuk_alankar_jewelry_store_categories_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_categoriestitle_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_categoriestitle_color', array(
		'label' => 'Title Color',
		'section' => 'luzuk_alankar_jewelry_store_categories_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_categoriestitlehvr_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_categoriestitlehvr_color', array(
		'label' => 'Title Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_categories_section',
	)));



	// newarrivalproduct Section
	$wp_customize->add_section('luzuk_alankar_jewelry_store_newarrivalproduct_section',array(
		'title'	=> __('New Arrival Products Settings','alankar-jewelry-store'),
		'description'=> __('<b>Note :</b> This section will appear below the Categories.','alankar-jewelry-store'),
		'panel' => 'luzuk_alankar_jewelry_store_panel_id',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_newarrivalproducts_subheading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_newarrivalproducts_subheading',array(
	   	'type' => 'text',
	   	'label' => __('Sub Heading','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	));

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_newarrivalproducts_heading',array(
    	'default' => '',
    	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('luzuk_alankar_jewelry_store_newarrivalproducts_heading',array(
	   	'type' => 'text',
	   	'label' => __('Heading','alankar-jewelry-store'),
	   	'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	));
	
	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproductsubheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproductsubheading_color', array(
		'label' => 'Sub Heading Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproductheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproductheading_color', array(
		'label' => 'Heading Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproductbrdheading_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproductbrdheading_color', array(
		'label' => 'Heading Border Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproductcategory_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproductcategory_color', array(
		'label' => 'Category Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproducttitle_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproducttitle_color', array(
		'label' => 'Title Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproductprice_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproductprice_color', array(
		'label' => 'Price Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproductbtntext_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproductbtntext_color', array(
		'label' => 'Button Text Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproductbtnbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproductbtnbg_color', array(
		'label' => 'Button BG Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_newarrivalproductbtntexthvr_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_newarrivalproductbtntexthvr_color', array(
		'label' => 'Button Text Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_newarrivalproduct_section',
	)));



	//Footer
    $wp_customize->add_section( 'luzuk_alankar_jewelry_store_footer', array(
    	'title'  => __( 'Footer Settings', 'alankar-jewelry-store' ),
		'priority' => null,
		'panel' => 'luzuk_alankar_jewelry_store_panel_id'
	) );

	$wp_customize->add_setting('luzuk_alankar_jewelry_store_show_back_totop',array(
       'default' => true,
       'sanitize_callback'	=> 'luzuk_alankar_jewelry_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('luzuk_alankar_jewelry_store_show_back_totop',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Back to Top','alankar-jewelry-store'),
       'section' => 'luzuk_alankar_jewelry_store_footer'
    ));

    $wp_customize->add_setting('luzuk_alankar_jewelry_store_footer_copy',array(
		'default' => 'Alankar Jewelry Store WordPress Theme By Luzuk',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('luzuk_alankar_jewelry_store_footer_copy',array(
		'label'	=> __('Copyright Text','alankar-jewelry-store'),
		'section' => 'luzuk_alankar_jewelry_store_footer',
		'setting' => 'luzuk_alankar_jewelry_store_footer_copy',
		'type' => 'text'
	));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_footertext_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_footertext_color', array(
		'label' => 'Text Color',
		'section' => 'luzuk_alankar_jewelry_store_footer',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_footerbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_footerbg_color', array(
		'label' => 'BG Color',
		'section' => 'luzuk_alankar_jewelry_store_footer',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_footercopyright_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_footercopyright_color', array(
		'label' => 'Copyright Color',
		'section' => 'luzuk_alankar_jewelry_store_footer',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_footercopyrightbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_footercopyrightbg_color', array(
		'label' => 'Copyright BG Color',
		'section' => 'luzuk_alankar_jewelry_store_footer',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_footerscrolltotoptext_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_footerscrolltotoptext_color', array(
		'label' => 'Scroll To Top Text Color',
		'section' => 'luzuk_alankar_jewelry_store_footer',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_footerscrolltotopbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_footerscrolltotopbg_color', array(
		'label' => 'Scroll To Top BG Color',
		'section' => 'luzuk_alankar_jewelry_store_footer',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_footerscrolltotoptexthover_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_footerscrolltotoptexthover_color', array(
		'label' => 'Scroll To Top Text Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_footer',
	)));

	$wp_customize->add_setting( 'luzuk_alankar_jewelry_store_footerscrolltotophover_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luzuk_alankar_jewelry_store_footerscrolltotophover_color', array(
		'label' => 'Scroll To Top Hover Color',
		'section' => 'luzuk_alankar_jewelry_store_footer',
	)));




	

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'luzuk_alankar_jewelry_store_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'luzuk_alankar_jewelry_store_customize_partial_blogdescription',
	) );
}
add_action( 'customize_register', 'luzuk_alankar_jewelry_store_customize_register' );

function luzuk_alankar_jewelry_store_customize_partial_blogname() {
	bloginfo( 'name' );
}

function luzuk_alankar_jewelry_store_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if (class_exists('WP_Customize_Control')) {

   	class Luzuk_Alankar_Jewelry_Store_Fontawesome_Icon_Chooser extends WP_Customize_Control {

      	public $type = 'icon';

      	public function render_content() { ?>
	     	<label>
	            <span class="customize-control-title">
	               <?php echo esc_html($this->label); ?>
	            </span>

	            <?php if ($this->description) { ?>
	                <span class="description customize-control-description">
	                   <?php echo wp_kses_post($this->description); ?>
	                </span>
	            <?php } ?>

	            <div class="alankar-jewelry-store-selected-icon">
	                <i class="fa <?php echo esc_attr($this->value()); ?>"></i>
	                <span><i class="fa fa-angle-down"></i></span>
	            </div>

	            <ul class="alankar-jewelry-store-icon-list clearfix">
	                <?php
	                $luzuk_alankar_jewelry_store_font_awesome_icon_array = luzuk_alankar_jewelry_store_font_awesome_icon_array();
	                foreach ($luzuk_alankar_jewelry_store_font_awesome_icon_array as $luzuk_alankar_jewelry_store_font_awesome_icon) {
	                   $icon_class = $this->value() == $luzuk_alankar_jewelry_store_font_awesome_icon ? 'icon-active' : '';
	                   echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($luzuk_alankar_jewelry_store_font_awesome_icon) . '"></i></li>';
	                }
	                ?>
	            </ul>
	            <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
	        </label>
	        <?php
      	}
  	}
}
function luzuk_alankar_jewelry_store_customizer_script() {
   wp_enqueue_style( 'font-awesome-1', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css');
}
add_action( 'customize_controls_enqueue_scripts', 'luzuk_alankar_jewelry_store_customizer_script' );
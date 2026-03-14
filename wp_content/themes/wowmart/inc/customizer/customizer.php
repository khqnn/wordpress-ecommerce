<?php

/**
 * WowMart  Theme Customizer
 *
 * @package WowMart 
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer. 
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wowmart_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    //select sanitization function
    function wowmart_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }

    $theme_info = wp_get_theme();
    $theme_domain = $theme_info->get('TextDomain');
    if ($theme_domain == 'wowmart') {
        $topbar_default = '1';
        $blog_layout = 'fullwidth';
    } else {
        $topbar_default = '';
        $blog_layout = 'rightside';
    }

    // Typography section
    $wp_customize->add_section('wowmart_typography', array(
        'title' => __('WowMart Theme typography', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'description'     => __('You can setup WowMart  theme typography by these options.', 'wowmart'),
        'priority'       => 4,

    ));
    $wp_customize->add_setting('wowmart_theme_fonts', array(
        'default'       => 'Poppins',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_theme_font',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_theme_fonts_control', array(
        'label'      => __('Select theme body Font', 'wowmart'),
        'section'    => 'wowmart_typography',
        'settings'   => 'wowmart_theme_fonts',
        'type'       => 'select',
        'choices'    => array(
            'Poppins' => __('Poppins', 'wowmart'),
            'Noto Serif' => __('Noto Serif', 'wowmart'),
            'Roboto' => __('Roboto', 'wowmart'),
            'Open Sans' => __('Open Sans', 'wowmart'),
            'Lato' => __('Lato', 'wowmart'),
            'Montserrat' => __('Montserrat', 'wowmart'),
            'Crimson Text' => __('Crimson Text', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_font_size', array(
        'default' =>  '14',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_font_size_control', array(
        'label'      => __('Body font size', 'wowmart'),
        'description'     => __('Default body font size is 14px', 'wowmart'),
        'section'    => 'wowmart_typography',
        'settings'   => 'wowmart_font_size',
        'type'       => 'text',

    ));
    $wp_customize->add_setting('wowmart_font_line_height', array(
        'default' =>  '24',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_font_line_height_control', array(
        'label'      => __('Body font line height', 'wowmart'),
        'description'     => __('Default body line height is 24px', 'wowmart'),
        'section'    => 'wowmart_typography',
        'settings'   => 'wowmart_font_line_height',
        'type'       => 'text',

    ));
    $wp_customize->add_setting('wowmart_theme_font_head', array(
        'default'       => 'Montserrat',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_theme_head_font',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_theme_font_head_control', array(
        'label'      => __('Select theme header Font', 'wowmart'),
        'section'    => 'wowmart_typography',
        'settings'   => 'wowmart_theme_font_head',
        'type'       => 'select',
        'choices'    => array(
            'Poppins' => __('Poppins', 'wowmart'),
            'Noto Serif' => __('Noto Serif', 'wowmart'),
            'Roboto' => __('Roboto', 'wowmart'),
            'Open Sans' => __('Open Sans', 'wowmart'),
            'Lato' => __('Lato', 'wowmart'),
            'Montserrat' => __('Montserrat', 'wowmart'),
            'Crimson Text' => __('Crimson Text', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_font_weight_head', array(
        'default'       => '700',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_font_weight_head_control', array(
        'label'      => __('Site header font weight', 'wowmart'),
        'section'    => 'wowmart_typography',
        'settings'   => 'wowmart_font_weight_head',
        'type'       => 'select',
        'choices'    => array(
            '400' => __('Normal', 'wowmart'),
            '500' => __('Semi Bold', 'wowmart'),
            '700' => __('Bold', 'wowmart'),
            '900' => __('Extra Bold', 'wowmart'),
        ),
    ));
    /*End typography section*/

    // Add WowMart top header section
    $wp_customize->add_section('wowmart_topbar', array(
        'title' => __('WowMart Top bar', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The WowMart topbar options ', 'wowmart'),
        'priority'       => 5,

    ));
    $wp_customize->add_setting('wowmart_topbar_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  $topbar_default,
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_topbar_show', array(
        'label'      => __('Show header topbar? ', 'wowmart'),
        'description' => __('You can show or hide header topbar.', 'wowmart'),
        'section'    => 'wowmart_topbar',
        'settings'   => 'wowmart_topbar_show',
        'type'       => 'checkbox',

    ));
    // Shop by Department setting
    $wp_customize->add_setting('wowmart_topbar_department_show', array(
        'default'        => $topbar_default,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_checkbox',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_topbar_department_show', array(
        'label'      => __('Show Shop by Department', 'wowmart'),
        'description' => __('Show WooCommerce categories dropdown in topbar.', 'wowmart'),
        'section'    => 'wowmart_topbar',
        'settings'   => 'wowmart_topbar_department_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_topbar_mtext', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  esc_html__('Welcome to Our Website !', 'wowmart'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_topbar_mtext', array(
        'label'      => __('Welcome text', 'wowmart'),
        'description'     => esc_html__('Enter your website welcome text. Leave empty if you don\'t want the text.', 'wowmart'),
        'section'    => 'wowmart_topbar',
        'settings'   => 'wowmart_topbar_mtext',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('wowmart_topbar_menushow', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_topbar_menushow', array(
        'label'      => __('Show header topbar menu? ', 'wowmart'),
        'description' => __('You can show or hide topbar menu. You need to add menu from menu section for display menu.', 'wowmart'),
        'section'    => 'wowmart_topbar',
        'settings'   => 'wowmart_topbar_menushow',
        'type'       => 'checkbox',

    ));

    $wp_customize->add_setting('wowmart_topbar_search_item', array(
        'default'        => 'simple',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_topbar_search_item', array(
        'label'      => __('Select header topbar search type', 'wowmart'),
        'description' => __('You can show two different way or hide topbar search. ', 'wowmart'),
        'section'    => 'wowmart_topbar',
        'settings'   => 'wowmart_topbar_search_item',
        'type'       => 'select',
        'choices'    => array(
            'simple' => __('Simple Search', 'wowmart'),
            'popup' => __('Popup Search', 'wowmart'),
            'hide' => __('Hide Search', 'wowmart'),
        ),
    ));


    // Add setting
    $wp_customize->add_setting('wowmart_topbar_bg', array(
        'default' => '#ededed',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_topbar_bg',
            array(
                'label' => __('Topbar Background Color', 'wowmart'),
                'section' => 'wowmart_topbar'
            )
        )
    );
    // Add setting
    $wp_customize->add_setting('wowmart_topbar_color', array(
        'default' => '#000',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_topbar_color',
            array(
                'label' => __('Topbar text Color', 'wowmart'),
                'section' => 'wowmart_topbar'
            )
        )
    );
    // Add setting
    $wp_customize->add_setting('wowmart_topbar_hcolor', array(
        'default' => '#6b14fa',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_topbar_hcolor',
            array(
                'label' => __('Topbar link hover Color', 'wowmart'),
                'section' => 'wowmart_topbar'
            )
        )
    ); // topbar section end
    /*header image height*/

    /*
      * Logo position 
       */
    $wp_customize->add_setting('wowmart_himg_height', array(
        'default'        => 'fixed',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
        //  'priority'       => 20,
    ));
    $wp_customize->add_control('wowmart_himg_height', array(
        'label'      => __('Header image height', 'wowmart'),
        'section'    => 'header_image',
        'settings'   => 'wowmart_himg_height',
        'type'       => 'select',
        'choices'    => array(
            'fixed' => __('Fixed Height', 'wowmart'),
            'auto' => __('Auto Height', 'wowmart'),
            'amobile' => __('Auto height only small devices', 'wowmart'),
        ),
    ));

    //logo width
    $wp_customize->add_setting('wowmart_logo_width', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_logo_width_control', array(
        'label'      => __('Set Image Logo Width', 'wowmart'),
        'description'     => __('Set your site logo Width.', 'wowmart'),
        'section'    => 'title_tagline',
        'settings'   => 'wowmart_logo_width',
        'type'       => 'number',
        'priority'       => 6,

    ));
    $wp_customize->add_setting('wowmart_logo_height', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('wowmart_logo_height_control', array(
        'label'      => __('Set Image Logo height', 'wowmart'),
        'description'     => __('Set your site logo height. Leave empty for auto height.', 'wowmart'),
        'section'    => 'title_tagline',
        'settings'   => 'wowmart_logo_height',
        'type'       => 'number',
        'priority'       => 7,
    ));
    $wp_customize->add_setting('wowmart_tagline_bgshow', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_tagline_bgshow', array(
        'label'      => __('Show tagline background? ', 'wowmart'),
        'description' => __('You can show or hide header tagline background.', 'wowmart'),
        'section'    => 'title_tagline',
        'settings'   => 'wowmart_tagline_bgshow',
        'type'       => 'checkbox',

    ));
    $wp_customize->add_setting('wowmart_logo_fontsize', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_logo_fontsize', array(
        'label'      => __('Site Title Font Size', 'wowmart'),
        'description'     => __('Set your site title font size.', 'wowmart'),
        'section'    => 'title_tagline',
        'settings'   => 'wowmart_logo_fontsize',
        'type'       => 'number',

    ));
    $wp_customize->add_setting('wowmart_desc_fontsize', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('wowmart_desc_fontsize', array(
        'label'      => __('Set Site Tagline Font Size', 'wowmart'),
        'description'     => __('Set your site tabline font size.', 'wowmart'),
        'section'    => 'title_tagline',
        'settings'   => 'wowmart_desc_fontsize',
        'type'       => 'number',
    ));

    /*
      * Logo position 
       */
    $wp_customize->add_setting('wowmart_logo_position', array(
        'default'        => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
        //  'priority'       => 20,
    ));
    $wp_customize->add_control('wowmart_logo_position', array(
        'label'      => __('Select Logo Position', 'wowmart'),
        'section'    => 'title_tagline',
        'settings'   => 'wowmart_logo_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Logo left', 'wowmart'),
            'center' => __('Logo center', 'wowmart'),
            'right' => __('Logo right', 'wowmart'),
        ),
    ));


    // Header middle section
    $wp_customize->add_section('wowmart_main_header', array(
        'title' => __('WowMart Main Header', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The WowMart Main header ', 'wowmart'),
        'priority'       => 6,

    ));
    $wp_customize->add_setting('wowmart_mhead_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_mhead_show', array(
        'label'      => __('Show Main header? ', 'wowmart'),
        'description' => __('You can show or hide header main section. And can show logo in menu bar', 'wowmart'),
        'section'    => 'wowmart_main_header',
        'settings'   => 'wowmart_mhead_show',
        'type'       => 'checkbox',

    ));
    $wp_customize->add_setting('wowmart_mhead_menu_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_mhead_menu_show', array(
        'label'      => __('Show Main Header Menu? ', 'wowmart'),
        'description' => __('You can show or hide header main menu section.', 'wowmart'),
        'section'    => 'wowmart_main_header',
        'settings'   => 'wowmart_mhead_menu_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_mhead_height', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('wowmart_mhead_height', array(
        'label'      => __('Set header middle section height', 'wowmart'),
        'description'     => __('Set your header middle section height. Leave empty for auto height.', 'wowmart'),
        'section'    => 'wowmart_main_header',
        'settings'   => 'wowmart_mhead_height',
        'type'       => 'number',
    ));

    // Header middle section
    $wp_customize->add_section('wowmart_main_menu', array(
        'title' => __('WowMart Main Menu', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The WowMart main menu section. You need to add menu from WordPress menu setup for display the menu manu ', 'wowmart'),
        'priority'       => 6,

    ));
    $wp_customize->add_setting('wowmart_main_menu_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_main_menu_show', array(
        'label'      => __('Show Main Menu section? ', 'wowmart'),
        'description' => __('You can show or hide header main menu section.', 'wowmart'),
        'section'    => 'wowmart_main_menu',
        'settings'   => 'wowmart_main_menu_show',
        'type'       => 'checkbox',

    ));
    $wp_customize->add_setting('wowmart_menu_logo', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_menu_logo', array(
        'label'      => __('Show Logo in the Main Menu section? ', 'wowmart'),
        'description' => __('You can show logo in the header main menu section.', 'wowmart'),
        'section'    => 'wowmart_main_menu',
        'settings'   => 'wowmart_menu_logo',
        'type'       => 'checkbox',

    ));
    /*
      * menu position 
       */
    $wp_customize->add_setting('wowmart_menu_position', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
        //  'priority'       => 20,
    ));
    $wp_customize->add_control('wowmart_menu_position', array(
        'label'      => __('Select Menu Position', 'wowmart'),
        'section'    => 'wowmart_main_menu',
        'settings'   => 'wowmart_menu_position',
        'type'       => 'select',
        'choices'    => array(
            'flex-start' => __('Menu left', 'wowmart'),
            'center' => __('Menu center', 'wowmart'),
            'flex-end' => __('Menu right', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_menu_tbpadding', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('wowmart_menu_tbpadding', array(
        'label'      => __('Menu top bottom padding', 'wowmart'),
        'description'     => __('Add main menu top bottom padding.', 'wowmart'),
        'section'    => 'wowmart_main_menu',
        'settings'   => 'wowmart_menu_tbpadding',
        'type'       => 'number',
    ));
    $wp_customize->add_setting('wowmart_menu_fontsize', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('wowmart_menu_fontsize', array(
        'label'      => __('Menu item font size', 'wowmart'),
        'description'     => __('Set menu item font size. Font size set by px', 'wowmart'),
        'section'    => 'wowmart_main_menu',
        'settings'   => 'wowmart_menu_fontsize',
        'type'       => 'number',
    ));
    // Add setting
    $wp_customize->add_setting('wowmart_menu_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_menu_color',
            array(
                'label' => __('Menu font Color', 'wowmart'),
                'section' => 'wowmart_main_menu'
            )
        )
    );
    // Add setting
    $wp_customize->add_setting('wowmart_menubg_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_menubg_color',
            array(
                'label' => __('Menu Background Color', 'wowmart'),
                'section' => 'wowmart_main_menu'
            )
        )
    );
    // Add setting
    $wp_customize->add_setting('wowmart_menudropbg_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_menudropbg_color',
            array(
                'label' => __('Menu dropdown Background Color', 'wowmart'),
                'section' => 'wowmart_main_menu'
            )
        )
    );

    //color section custom options    

    // Add setting
    $wp_customize->add_setting('wowmart_titletag_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_titletag_bgcolor',
            array(
                'label' => __('Title tag background Color', 'wowmart'),
                'section' => 'colors'
            )
        )
    );
    $wp_customize->add_setting('wowmart_header_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
        'priority'       => 2,

    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_header_color',
            array(
                'label' => __('Header tag Font Color', 'wowmart'),
                'section' => 'colors'
            )
        )
    );
    $wp_customize->add_setting('wowmart_bodyfont_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_bodyfont_color',
            array(
                'label' => __('Body Font Color', 'wowmart'),
                'section' => 'colors'
            )
        )
    );
    $wp_customize->add_setting('wowmart_contentbg_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_contentbg_color',
            array(
                'label' => __('Content Background Color', 'wowmart'),
                'section' => 'colors'
            )
        )
    );
    $wp_customize->add_setting('wowmart_basic_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_basic_color',
            array(
                'label' => __('Theme Basic Color', 'wowmart'),
                'section' => 'colors'
            )
        )
    );
    //link color
    $wp_customize->add_setting('wowmart_link_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_link_color',
            array(
                'label' => __('Theme Link Color', 'wowmart'),
                'section' => 'colors'
            )
        )
    );
    //link hover color
    $wp_customize->add_setting('wowmart_linkhvr_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_linkhvr_color',
            array(
                'label' => __('Theme Link Hover Color', 'wowmart'),
                'section' => 'colors'
            )
        )
    );
    // Add WowMart blog section
    $wp_customize->add_section('wowmart_blog', array(
        'title' => __('WowMart Blog', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The WowMart theme blog options ', 'wowmart'),
        'priority'       => 60,

    ));
    $wp_customize->add_setting('wowmart_blog_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_blog_container', array(
        'label'      => __('Container type', 'wowmart'),
        'description' => __('You can set standard container or full width container. ', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_blog_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'wowmart'),
            'container-fluid' => __('Full width Container', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_blog_layout', array(
        'default'        => $blog_layout,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_blog_layout', array(
        'label'      => __('Select Blog Layout', 'wowmart'),
        'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_blog_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'wowmart'),
            'leftside' => __('Left Sidebar', 'wowmart'),
            'fullwidth' => __('Full Width', 'wowmart'),
        ),
    ));

    $wp_customize->add_setting('wowmart_blog_style', array(
        'default'        => 'grid',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_blog_style', array(
        'label'      => __('Select Blog Style', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'grid' => __('Grid Style', 'wowmart'),
            'style2' => __('List Style', 'wowmart'),
            'style3' => __('Classic Style', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_blog_readmore', array(
        'default' =>  esc_html__('Read More', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_blog_readmore', array(
        'label'      => __('Posts Read More Text', 'wowmart'),
        'description'     => __('You can change read more text by this settings', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_blog_readmore',
        'type'       => 'text',

    ));

    $wp_customize->add_setting('wowmart_blogdate', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_blogdate', array(
        'label'      => __('Show Posts Date? ', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_blogdate',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_blogauthor', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_blogauthor', array(
        'label'      => __('Show Posts Author? ', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_blogauthor',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_postcat', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_postcat', array(
        'label'      => __('Show Single Posts Categories? ', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_postcat',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_posttag', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_posttag', array(
        'label'      => __('Show Single Posts tags? ', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_posttag',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_post_comment', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_post_comment', array(
        'label'      => __('Show Single Posts comment? ', 'wowmart'),
        'section'    => 'wowmart_blog',
        'settings'   => 'wowmart_post_comment',
        'type'       => 'checkbox',
    ));

    // Add WowMart page section
    $wp_customize->add_section('wowmart_page', array(
        'title' => __('WowMart Page', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The WowMart theme Page options ', 'wowmart'),
        'priority'       => 70,

    ));
    $wp_customize->add_setting('wowmart_page_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_page_container', array(
        'label'      => __('Page Container type', 'wowmart'),
        'description' => __('You can set standard container or full width container for page. ', 'wowmart'),
        'section'    => 'wowmart_page',
        'settings'   => 'wowmart_page_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Page Container', 'wowmart'),
            'container-fluid' => __('Full width Page Container', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_page_layout', array(
        'default'        => 'fullwidth',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_page_layout', array(
        'label'      => __('Select Page Layout', 'wowmart'),
        'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'wowmart'),
        'section'    => 'wowmart_page',
        'settings'   => 'wowmart_page_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'wowmart'),
            'leftside' => __('Left Sidebar', 'wowmart'),
            'fullwidth' => __('Full Width', 'wowmart'),
        ),
    ));




    /*
* Footer setting section
*
*/
    // Add WowMart top header section
    $wp_customize->add_panel('wowmart_footer_panel', array(
        //  'priority'       => 75,
        'title'          => __('WowMart footer settings', 'wowmart'),
        'description'    => __('All WowMart theme footer settings in the panel', 'wowmart'),
    ));
    $wp_customize->add_section('wowmart_footer_top', array(
        'title' => __('WowMart Footer Top Settings', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The WowMart footer settings options ', 'wowmart'),
        'panel'    => 'wowmart_footer_panel',

    ));
    $wp_customize->add_setting('wowmart_topfooter_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_topfooter_show', array(
        'label'      => __('Show Top Footer? ', 'wowmart'),
        'description' => __('You can show or hide footer top section.The section only visible when you will set footer widget. ', 'wowmart'),
        'section'    => 'wowmart_footer_top',
        'settings'   => 'wowmart_topfooter_show',
        'type'       => 'checkbox',

    ));
    //link hover color
    $wp_customize->add_setting('wowmart_topfooter_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_topfooter_bgcolor',
            array(
                'label' => __('Footer top background color.', 'wowmart'),
                'section' => 'wowmart_footer_top'
            )
        )
    );
    //link hover color
    $wp_customize->add_setting('wowmart_tftitle_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_tftitle_color',
            array(
                'label' => __('Footer Top Widget Title Color.', 'wowmart'),
                'section' => 'wowmart_footer_top'
            )
        )
    );
    //link hover color
    $wp_customize->add_setting('wowmart_tftext_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_tftext_color',
            array(
                'label' => __('Footer Top Widget Text Color.', 'wowmart'),
                'section' => 'wowmart_footer_top'
            )
        )
    );
    //link hover color
    $wp_customize->add_setting('wowmart_tflink_hovercolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_tflink_hovercolor',
            array(
                'label' => __('Footer Top Widget Link hover Color.', 'wowmart'),
                'section' => 'wowmart_footer_top'
            )
        )
    );
    // Footer section
    $wp_customize->add_section('wowmart_footer', array(
        'title' => __('WowMart Footer Settings', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'description'     => __('The WowMart footer settings options ', 'wowmart'),
        'panel'    => 'wowmart_footer_panel',

    ));

    $wp_customize->add_setting('wowmart_footer_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_footer_bgcolor',
            array(
                'label' => __('Footer background color.', 'wowmart'),
                'section' => 'wowmart_footer'
            )
        )
    );
    $wp_customize->add_setting('wowmart_footer_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_footer_color',
            array(
                'label' => __('Footer text color.', 'wowmart'),
                'section' => 'wowmart_footer'
            )
        )
    );
    $wp_customize->add_setting('wowmart_footerlink_hcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_footerlink_hcolor',
            array(
                'label' => __('Footer Link Hover color.', 'wowmart'),
                'section' => 'wowmart_footer'
            )
        )
    );




    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'wowmart_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'wowmart_customize_partial_blogdescription',
            )
        );
    }
}
add_action('customize_register', 'wowmart_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wowmart_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wowmart_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wowmart_customize_preview_js()
{
    wp_enqueue_script('wowmart-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'wowmart_customize_preview_js');

<?php

/**
 * WowMart  Theme Customizer
 *
 * @package WowMart 
 */

if (!function_exists('wowmart_sanitize_image')) :
    function wowmart_sanitize_image($input)
    {
        /* default output */
        $output = '';
        /* check file type */
        $filetype = wp_check_filetype($input);
        $mime_type = $filetype['type'];
        /* only mime type "image" allowed */
        if (strpos($mime_type, 'image') !== false) {
            $output = $input;
        }
        return $output;
    }
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wowmart_woo_customize_register($wp_customize)
{

    //select sanitization function
    function wowmart_woo_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
    $theme_info = wp_get_theme();
    $theme_domain = $theme_info->get('TextDomain');
    if ($theme_domain == 'wowmart') {
        $shop_items = '4';
    } else {
        $shop_items = '3';
    }

    $wp_customize->add_section(
        'wowmart_general',
        array(
            'title'    => __('WowMart  General Settings', 'wowmart'),
            'priority' => 5,
            'panel'    => 'woocommerce',
        )
    );
    $wp_customize->add_setting('wowmart_head_cart_show', array(
        'default'        => 'all',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_head_cart_show', array(
        'label'      => __('Display Header Shopping Cart Icon', 'wowmart'),
        'description'     => __('You can show or hide shop cart icon.', 'wowmart'),
        'section'    => 'wowmart_general',
        'settings'   => 'wowmart_head_cart_show',
        'type'       => 'checkbox',
    ));

    $wp_customize->add_setting('wowmart_breadcrump_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  1,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('wowmart_breadcrump_show', array(
        'label'      => __('Display Shop Breadcrumb', 'wowmart'),
        'description'     => __('You can show or hide shop breadcrumb.', 'wowmart'),
        'section'    => 'wowmart_general',
        'settings'   => 'wowmart_breadcrump_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_breadcrump_position', array(
        'default'        => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_breadcrump_position', array(
        'label'      => __('Products Breadcrumb Position', 'wowmart'),
        'section'    => 'wowmart_general',
        'settings'   => 'wowmart_breadcrump_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'wowmart'),
            'center' => __('Center', 'wowmart'),
            'right' => __('Right', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_breadcrump_color', array(
        'default' => '#222',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_breadcrump_color',
            array(
                'label' => __('Breadcrump Text Color', 'wowmart'),
                'section' => 'wowmart_general'
            )
        )
    );
    $wp_customize->add_setting('wowmart_breadcrump_bgcolor', array(
        'default' => '#ededed',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_breadcrump_bgcolor',
            array(
                'label' => __('Breadcrump Background Color', 'wowmart'),
                'section' => 'wowmart_general'
            )
        )
    );


    $wp_customize->add_setting('wowmart_products_pagination', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_products_pagination', array(
        'label'      => __('Products Pagination Position', 'wowmart'),
        'section'    => 'wowmart_general',
        'settings'   => 'wowmart_products_pagination',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'wowmart'),
            'center' => __('Center', 'wowmart'),
            'right' => __('Right', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_pagitext_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_pagitext_color',
            array(
                'label' => __('Pagination Text Color', 'wowmart'),
                'section' => 'wowmart_general'
            )
        )
    );
    $wp_customize->add_setting('wowmart_pagibg_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_pagibg_color',
            array(
                'label' => __('Pagination Background Color', 'wowmart'),
                'section' => 'wowmart_general'
            )
        )
    );
    $wp_customize->add_section(
        'wowmart_shop_banner',
        array(
            'title'    => __('Shop Page Banner', 'wowmart'),
            'priority' => 6,
            'panel'    => 'woocommerce',
        )
    );
    $wp_customize->add_setting('wowmart_shopbanner_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       => '',
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',

    ));
    $wp_customize->add_control('wowmart_shopbanner_show', array(
        'label'      => __('Display Shop Page banner', 'wowmart'),
        'description'     => __('You can show or hide shop page banner.', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_shopbanner_show',
        'type'       => 'checkbox',
        'priority'       => 5,
    ));
    // Side menu profile image
    $wp_customize->add_setting('wowmart_shopb_img', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => wowmart_sanitize_image('wowmart_shopb_img'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'wowmart_shopb_img', array(
        'label' => __('Upload Shop Image', 'wowmart'),
        'description' => __('You can upload shop image by this option', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_shopb_img',
        'mime_type' => 'image',

    )));

    $wp_customize->add_setting('wowmart_banner_subtext', array(
        'default' =>  esc_html__('Modern eCommerce Solution', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_banner_subtext', array(
        'label'      => __('Shop Banner Subtitle', 'wowmart'),
        'description'     => __('Enter your shop banner subtitle. This appears above the main title.', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_banner_subtext',
        'type'       => 'text',

    ));

    $wp_customize->add_setting('wowmart_banner_title', array(
        'default' =>  esc_html__('Premium Shopping Experience', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_banner_title', array(
        'label'      => __('Shop Banner Title', 'wowmart'),
        'description'     => __('Enter your shop banner main title. This is the primary headline.', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_banner_title',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('wowmart_banner_desc', array(
        'default' =>  esc_html__('Discover exceptional quality products with our cutting-edge shopping platform. Enjoy seamless browsing, secure checkout, and outstanding customer service.', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_banner_desc', array(
        'label'      => __('Shop Banner Description', 'wowmart'),
        'description'     => __('Enter your shop banner description. This provides additional context about your store.', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_banner_desc',
        'type'       => 'textarea',
    ));
    $wp_customize->add_setting('wowmart_banner_btn', array(
        'default' =>  esc_html__('Shop Now', 'wowmart'),
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_banner_btn', array(
        'label'      => __('Shop Banner Button text', 'wowmart'),
        'description'     => __('Enter your shop banner button text.', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_banner_btn',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('wowmart_banner_url', array(
        'default' =>  '#',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_url',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_banner_url', array(
        'label'      => __('Shop Banner Button url', 'wowmart'),
        'description'     => __('Enter your shop banner button url. Leave empty if you don\'t want to use the button.', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_banner_url',
        'type'       => 'url',
    ));
    $wp_customize->add_setting('wowmart_bannerbtn_color', array(
        'default' => '#fff',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_bannerbtn_color',
            array(
                'label' => __('Button Color', 'wowmart'),
                'section' => 'wowmart_shop_banner'
            )
        )
    );
    $wp_customize->add_setting('wowmart_bannerbtn_bgcolor', array(
        'default' => '#bb0925',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_bannerbtn_bgcolor',
            array(
                'label' => __('Button Background Color', 'wowmart'),
                'section' => 'wowmart_shop_banner'
            )
        )
    );
    $wp_customize->add_setting('wowmart_text_position', array(
        'default'        => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_text_position', array(
        'label'      => __('Text Position', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_text_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'wowmart'),
            'center' => __('Center', 'wowmart'),
            'right' => __('Right', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_bannertext_color', array(
        'default' => '#fff',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_bannertext_color',
            array(
                'label' => __('Banner Text Color', 'wowmart'),
                'section' => 'wowmart_shop_banner'
            )
        )
    );
    $wp_customize->add_setting('wowmart_banner_overlay', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_banner_overlay', array(
        'label'      => __('Show banner overlay? ', 'wowmart'),
        'description' => __('You can show or hide banner overlay.', 'wowmart'),
        'section'    => 'wowmart_shop_banner',
        'settings'   => 'wowmart_banner_overlay',
        'type'       => 'checkbox',

    ));

    //End shop page banner

    $wp_customize->add_section(
        'wowmart_shop',
        array(
            'title'    => __('WowMart  Settings', 'wowmart'),
            'priority' => 6,
            'panel'    => 'woocommerce',
        )
    );


    $wp_customize->add_setting('wowmart_shop_container', array(
        'default'        => 'container',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_shop_container', array(
        'label'      => __('Shop Container type', 'wowmart'),
        'description' => __('You can set standard container or full width container for shop. ', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_shop_container',
        'type'       => 'select',
        'choices'    => array(
            'container' => __('Standard Container', 'wowmart'),
            'container-fluid' => __('Full width Container', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_shop_layout', array(
        'default'        => 'fullwidth',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_shop_layout', array(
        'label'      => __('Select Shop Layout', 'wowmart'),
        'description' => __('Right and Left sidebar only show when shop sidebar widget is available. ', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_shop_layout',
        'type'       => 'select',
        'choices'    => array(
            'rightside' => __('Right Sidebar', 'wowmart'),
            'leftside' => __('Left Sidebar', 'wowmart'),
            'fullwidth' => __('Full Width', 'wowmart'),
        ),
    ));


    $wp_customize->add_setting('wowmart_shop_title', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  esc_html__('Shop', 'wowmart'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_shop_title', array(
        'label'      => __('Shop Page Title', 'wowmart'),
        'description'     => esc_html__('Enter your shop page title. Leave empty if you don\'t want the title.', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_shop_title',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('wowmart_title_position', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_title_position', array(
        'label'      => __('Title Position', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_title_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'wowmart'),
            'center' => __('Center', 'wowmart'),
            'right' => __('Right', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_titlecolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_titlecolor',
            array(
                'label' => __('Shop Title Color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_ftwidget_position', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_ftwidget_position', array(
        'label'      => __('Shop Page Top Widget Position', 'wowmart'),
        'description'      => __('Set filter widget from widget section for fiilter shop page products. You can set posotion filiter items by this opiton.', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_ftwidget_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'wowmart'),
            'center' => __('Center', 'wowmart'),
            'right' => __('Right', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_ftwidget_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_ftwidget_color',
            array(
                'label' => __('Shop Top Widget Text Color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_ftwidget_hvcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_ftwidget_hvcolor',
            array(
                'label' => __('Shop Top Widget Text Hover Color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_ftwidget_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_ftwidget_bgcolor',
            array(
                'label' => __('Shop Top Widget Background Color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_resultcount', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_resultcount', array(
        'label'      => __('Show Result Count? ', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_resultcount',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_porder', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_porder', array(
        'label'      => __('Show Products Order? ', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_porder',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_shop_column', array(
        'default'        => $shop_items,
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_shop_column', array(
        'label'      => __('Set Product Per row', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_shop_column',
        'type'       => 'select',
        'choices'    => array(
            '5' => __('Five Products', 'wowmart'),
            '4' => __('Four Products', 'wowmart'),
            '3' => __('Three Products', 'wowmart'),
            '2' => __('Two Products', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_shop_style', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_woo_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_shop_style', array(
        'label'      => __('Select Products Style', 'wowmart'),
        'section'    => 'wowmart_shop',
        'settings'   => 'wowmart_shop_style',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Style One', 'wowmart'),
            '2' => __('Style Two', 'wowmart'),
        ),
    ));
    $wp_customize->add_setting('wowmart_product_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_product_bgcolor',
            array(
                'label' => __('Products Background Color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_ptitle_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_ptitle_color',
            array(
                'label' => __('Products Title Color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_prating_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_prating_color',
            array(
                'label' => __('Products Rating Color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_pprice_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_pprice_color',
            array(
                'label' => __('Products Price Color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_pbtn_bgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_pbtn_bgcolor',
            array(
                'label' => __('Products button background color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_pbtn_hvbgcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_pbtn_hvbgcolor',
            array(
                'label' => __('Products button hover background color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_pbtn_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_pbtn_color',
            array(
                'label' => __('Products button color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    $wp_customize->add_setting('wowmart_pbtn_hvcolor', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_pbtn_hvcolor',
            array(
                'label' => __('Products button hover color', 'wowmart'),
                'section' => 'wowmart_shop'
            )
        )
    );
    /*Single product page options*/
    $wp_customize->add_section(
        'wowmart_single_product',
        array(
            'title'    => __('Single Product Settings', 'wowmart'),
            'priority' => 10,
            'panel'    => 'woocommerce',
        )
    );
    $wp_customize->add_setting('wowmart_ptitle_fsize', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_ptitle_fsize', array(
        'label'      => __('Font Size', 'wowmart'),
        'description'     => __('Set single product title font size.', 'wowmart'),
        'section'    => 'wowmart_single_product',
        'settings'   => 'wowmart_ptitle_fsize',
        'type'       => 'number',

    ));
    $wp_customize->add_setting('wowmart_sptitle_color', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));
    // Add color control 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wowmart_sptitle_color',
            array(
                'label' => __('Title Color', 'wowmart'),
                'section' => 'wowmart_single_product'
            )
        )
    );
    $wp_customize->add_setting('wowmart_srating_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_srating_show', array(
        'label'      => __('Show Rating ', 'wowmart'),
        'description' => __('You can show or hide single product rating. Rating only show when rating available.', 'wowmart'),
        'section'    => 'wowmart_single_product',
        'settings'   => 'wowmart_srating_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_sdesc_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_sdesc_show', array(
        'label'      => __('Show Short description ', 'wowmart'),
        'description' => __('You can show or hide single product short description.', 'wowmart'),
        'section'    => 'wowmart_single_product',
        'settings'   => 'wowmart_sdesc_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_sku_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_sku_show', array(
        'label'      => __('Show SKU', 'wowmart'),
        'section'    => 'wowmart_single_product',
        'settings'   => 'wowmart_sku_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_spcat_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_spcat_show', array(
        'label'      => __('Show Categories ', 'wowmart'),
        'section'    => 'wowmart_single_product',
        'settings'   => 'wowmart_spcat_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_sptag_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_sptag_show', array(
        'label'      => __('Show Tags', 'wowmart'),
        'section'    => 'wowmart_single_product',
        'settings'   => 'wowmart_sptag_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_sptab_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_sptab_show', array(
        'label'      => __('Show Tab', 'wowmart'),
        'section'    => 'wowmart_single_product',
        'settings'   => 'wowmart_sptab_show',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('wowmart_sprelated_show', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_sprelated_show', array(
        'label'      => __('Show Related Products', 'wowmart'),
        'section'    => 'wowmart_single_product',
        'settings'   => 'wowmart_sprelated_show',
        'type'       => 'checkbox',
    ));
    /*Woocommerce checkout options*/
    $wp_customize->add_setting('wowmart_checkout_lastname', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_checkout_lastname', array(
        'label'      => __('Show Last Nama Field', 'wowmart'),
        'section'    => 'woocommerce_checkout',
        'settings'   => 'wowmart_checkout_lastname',
        'type'       => 'checkbox',
        'priority' => 5,
    ));
    $wp_customize->add_setting('wowmart_checkout_email', array(
        'default'        => 'required',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'wowmart_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('wowmart_checkout_email', array(
        'label'      => __('Email field', 'wowmart'),
        'section'    => 'woocommerce_checkout',
        'settings'   => 'wowmart_checkout_email',
        'type'       => 'select',
        'choices'    => array(
            'required' => __('Required', 'wowmart'),
            'optional' => __('Optional', 'wowmart'),
            'hide' => __('Hidden', 'wowmart'),
        ),
        'priority'       => 7,
    ));
    $wp_customize->add_setting('wowmart_checkout_postcode', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '1',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('wowmart_checkout_postcode', array(
        'label'      => __('Show Postcode / ZIP', 'wowmart'),
        'section'    => 'woocommerce_checkout',
        'settings'   => 'wowmart_checkout_postcode',
        'type'       => 'checkbox',
        'priority' => 7,
    ));
}
add_action('customize_register', 'wowmart_woo_customize_register');

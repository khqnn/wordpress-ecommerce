<?php

  $home_control_system_theme_custom_setting_css = '';

    // Global Color
    $home_control_system_first_theme_color = get_theme_mod('home_control_system_first_theme_color', '#53015B');
    $home_control_system_second_theme_color = get_theme_mod('home_control_system_second_theme_color', '#2F2B2F');

    $home_control_system_theme_custom_setting_css .=':root {';
        $home_control_system_theme_custom_setting_css .='--primary-theme-color: '.esc_attr($home_control_system_first_theme_color ).'!important;';
        $home_control_system_theme_custom_setting_css .='--secondary-theme-color: '.esc_attr($home_control_system_second_theme_color ).'!important;';
    $home_control_system_theme_custom_setting_css .='}';

	// Scroll to top alignment
	$home_control_system_scroll_alignment = get_theme_mod('home_control_system_scroll_alignment', 'right');

    if($home_control_system_scroll_alignment == 'right'){
        $home_control_system_theme_custom_setting_css .='.scroll-up{';
            $home_control_system_theme_custom_setting_css .='right: 30px;!important;';
			$home_control_system_theme_custom_setting_css .='left: auto;!important;';
        $home_control_system_theme_custom_setting_css .='}';
    }else if($home_control_system_scroll_alignment == 'center'){
        $home_control_system_theme_custom_setting_css .='.scroll-up{';
            $home_control_system_theme_custom_setting_css .='left: calc(50% - 10px) !important;';
        $home_control_system_theme_custom_setting_css .='}';
    }else if($home_control_system_scroll_alignment == 'left'){
        $home_control_system_theme_custom_setting_css .='.scroll-up{';
            $home_control_system_theme_custom_setting_css .='left: 30px;!important;';
			$home_control_system_theme_custom_setting_css .='right: auto;!important;';
        $home_control_system_theme_custom_setting_css .='}';
    }

    // Woocommerce Sale Position
    $home_control_system_sale_badge_position = get_theme_mod( 'home_control_system_sale_badge_position','right');
    if($home_control_system_sale_badge_position == 'left'){
        $home_control_system_theme_custom_setting_css .='.woocommerce ul.products li.product .onsale{';
            $home_control_system_theme_custom_setting_css .='left: 10px; right: auto;';
        $home_control_system_theme_custom_setting_css .='}';
    }else if($home_control_system_sale_badge_position == 'right'){
        $home_control_system_theme_custom_setting_css .='.woocommerce ul.products li.product .onsale{';
            $home_control_system_theme_custom_setting_css .='left: auto; right: 10px;';
        $home_control_system_theme_custom_setting_css .='}';
    }

    // Product Featured Image Hover Effect
    $home_control_system_show_featured = get_theme_mod('home_control_system_featured_image_hide_show', 1);
    $home_control_system_hover_effect = get_theme_mod('home_control_system_product_featured_image_hover','none');

    if ( $home_control_system_show_featured && $home_control_system_hover_effect !== 'none' ) {

    $home_control_system_theme_custom_setting_css .= '
    .product-img img{
        transition: all 0.4s ease;
    }';

    if ( $home_control_system_hover_effect === 'zoom-in' ) {
        $home_control_system_theme_custom_setting_css .= '
        .product-img:hover img{
            transform: scale(1.2);
        }';
    }

    if ( $home_control_system_hover_effect === 'zoom-out' ) {
        $home_control_system_theme_custom_setting_css .= '
        .product-img img{ transform: scale(1.2); }
        .product-img:hover img{ transform: scale(1); }';
    }

    if ( $home_control_system_hover_effect === 'grayscale' ) {
        $home_control_system_theme_custom_setting_css .= '
        .product-img img{ filter: grayscale(100%); }
        .product-img:hover img{ filter: grayscale(0); }';
    }

    if ( $home_control_system_hover_effect === 'sepia' ) {
        $home_control_system_theme_custom_setting_css .= '
        .product-img:hover img{ filter: sepia(100%); }';
    }

    if ( $home_control_system_hover_effect === 'blur' ) {
        $home_control_system_theme_custom_setting_css .= '
        .product-img:hover img{ filter: blur(3px); }';
    }

    if ( $home_control_system_hover_effect === 'bright' ) {
        $home_control_system_theme_custom_setting_css .= '
        .product-img:hover img{ filter: brightness(1.3); }';
    }

    if ( $home_control_system_hover_effect === 'translate' ) {
        $home_control_system_theme_custom_setting_css .= '
        .product-img:hover img{ transform: translateY(-10px); }';
    }

    if ( $home_control_system_hover_effect === 'scale' ) {
        $home_control_system_theme_custom_setting_css .= '
        .product-img:hover img{ transform: scale(1.1); }';
    }
}  

<?php

  $luxury_watch_store_theme_custom_setting_css = '';

    // Global Color
    $luxury_watch_store_first_theme_color = get_theme_mod('luxury_watch_store_first_theme_color', '#FF7F4E');
    $luxury_watch_store_second_theme_color = get_theme_mod('luxury_watch_store_second_theme_color', '#000000');
    $luxury_watch_store_third_theme_color = get_theme_mod('luxury_watch_store_third_theme_color', '#FFF0E6');

    $luxury_watch_store_theme_custom_setting_css .=':root {';
        $luxury_watch_store_theme_custom_setting_css .='--primary-theme-color: '.esc_attr($luxury_watch_store_first_theme_color ).'!important;';
        $luxury_watch_store_theme_custom_setting_css .='--secondary-theme-color: '.esc_attr($luxury_watch_store_second_theme_color ).'!important;';
        $luxury_watch_store_theme_custom_setting_css .='--tertiary-theme-color: '.esc_attr($luxury_watch_store_third_theme_color ).'!important;';
    $luxury_watch_store_theme_custom_setting_css .='}';

	// Scroll to top alignment
	$luxury_watch_store_scroll_alignment = get_theme_mod('luxury_watch_store_scroll_alignment', 'right');

    if($luxury_watch_store_scroll_alignment == 'right'){
        $luxury_watch_store_theme_custom_setting_css .='.scroll-up{';
            $luxury_watch_store_theme_custom_setting_css .='right: 30px;!important;';
			$luxury_watch_store_theme_custom_setting_css .='left: auto;!important;';
        $luxury_watch_store_theme_custom_setting_css .='}';
    }else if($luxury_watch_store_scroll_alignment == 'center'){
        $luxury_watch_store_theme_custom_setting_css .='.scroll-up{';
            $luxury_watch_store_theme_custom_setting_css .='left: calc(50% - 10px) !important;';
        $luxury_watch_store_theme_custom_setting_css .='}';
    }else if($luxury_watch_store_scroll_alignment == 'left'){
        $luxury_watch_store_theme_custom_setting_css .='.scroll-up{';
            $luxury_watch_store_theme_custom_setting_css .='left: 30px;!important;';
			$luxury_watch_store_theme_custom_setting_css .='right: auto;!important;';
        $luxury_watch_store_theme_custom_setting_css .='}';
    }

    // Woocommerce Sale Position
    $luxury_watch_store_sale_badge_position = get_theme_mod( 'luxury_watch_store_sale_badge_position','right');
    if($luxury_watch_store_sale_badge_position == 'left'){
        $luxury_watch_store_theme_custom_setting_css .='.woocommerce ul.products li.product .onsale{';
            $luxury_watch_store_theme_custom_setting_css .='left: 10px; right: auto;';
        $luxury_watch_store_theme_custom_setting_css .='}';
    }else if($luxury_watch_store_sale_badge_position == 'right'){
        $luxury_watch_store_theme_custom_setting_css .='.woocommerce ul.products li.product .onsale{';
            $luxury_watch_store_theme_custom_setting_css .='left: auto; right: 10px;';
        $luxury_watch_store_theme_custom_setting_css .='}';
    }

    // Featured Image Hover Effect
    $luxury_watch_store_show_featured = get_theme_mod('luxury_watch_store_featured_image_hide_show', 1);
    $luxury_watch_store_hover_effect = get_theme_mod('luxury_watch_store_single_post_featured_image_hover','none');

    if ( $luxury_watch_store_show_featured && $luxury_watch_store_hover_effect !== 'none' ) {

    $luxury_watch_store_theme_custom_setting_css .= '
    .post-img img{
        transition: all 0.4s ease;
    }';

    if ( $luxury_watch_store_hover_effect === 'zoom-in' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .post-img:hover img{
            transform: scale(1.2);
        }';
    }

    if ( $luxury_watch_store_hover_effect === 'zoom-out' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .post-img img{ transform: scale(1.2); }
        .post-img:hover img{ transform: scale(1); }';
    }

    if ( $luxury_watch_store_hover_effect === 'grayscale' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .post-img img{ filter: grayscale(100%); }
        .post-img:hover img{ filter: grayscale(0); }';
    }

    if ( $luxury_watch_store_hover_effect === 'sepia' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .post-img:hover img{ filter: sepia(100%); }';
    }

    if ( $luxury_watch_store_hover_effect === 'blur' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .post-img:hover img{ filter: blur(3px); }';
    }

    if ( $luxury_watch_store_hover_effect === 'bright' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .post-img:hover img{ filter: brightness(1.3); }';
    }

    if ( $luxury_watch_store_hover_effect === 'translate' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .post-img:hover img{ transform: translateY(-10px); }';
    }

    if ( $luxury_watch_store_hover_effect === 'scale' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .post-img:hover img{ transform: scale(1.1); }';
    }
}

// Product Featured Image Hover Effect
    $luxury_watch_store_show_featured = get_theme_mod('luxury_watch_store_featured_image_hide_show', 1);
    $luxury_watch_store_hover_effect = get_theme_mod('luxury_watch_store_product_featured_image_hover','none');

    if ( $luxury_watch_store_show_featured && $luxury_watch_store_hover_effect !== 'none' ) {

    $luxury_watch_store_theme_custom_setting_css .= '
    .product-img img{
        transition: all 0.4s ease;
    }';

    if ( $luxury_watch_store_hover_effect === 'zoom-in' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .product-img:hover img{
            transform: scale(1.2);
        }';
    }

    if ( $luxury_watch_store_hover_effect === 'zoom-out' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .product-img img{ transform: scale(1.2); }
        .product-img:hover img{ transform: scale(1); }';
    }

    if ( $luxury_watch_store_hover_effect === 'grayscale' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .product-img img{ filter: grayscale(100%); }
        .product-img:hover img{ filter: grayscale(0); }';
    }

    if ( $luxury_watch_store_hover_effect === 'sepia' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .product-img:hover img{ filter: sepia(100%); }';
    }

    if ( $luxury_watch_store_hover_effect === 'blur' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .product-img:hover img{ filter: blur(3px); }';
    }

    if ( $luxury_watch_store_hover_effect === 'bright' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .product-img:hover img{ filter: brightness(1.3); }';
    }

    if ( $luxury_watch_store_hover_effect === 'translate' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .product-img:hover img{ transform: translateY(-10px); }';
    }

    if ( $luxury_watch_store_hover_effect === 'scale' ) {
        $luxury_watch_store_theme_custom_setting_css .= '
        .product-img:hover img{ transform: scale(1.1); }';
    }
}   
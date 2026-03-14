<?php

  $jewelry_outlet_theme_custom_setting_css = '';

    // Global Color
    $jewelry_outlet_first_theme_color = get_theme_mod('jewelry_outlet_first_theme_color', '#c29734');
    $jewelry_outlet_second_theme_color = get_theme_mod('jewelry_outlet_second_theme_color', '#222222');

    $jewelry_outlet_theme_custom_setting_css .=':root {';
        $jewelry_outlet_theme_custom_setting_css .='--primary-theme-color: '.esc_attr($jewelry_outlet_first_theme_color ).'!important;';
        $jewelry_outlet_theme_custom_setting_css .='--secondary-theme-color: '.esc_attr($jewelry_outlet_second_theme_color ).'!important;';
    $jewelry_outlet_theme_custom_setting_css .='}';

	// Scroll to top alignment
	$jewelry_outlet_scroll_alignment = get_theme_mod('jewelry_outlet_scroll_alignment', 'right');

    if($jewelry_outlet_scroll_alignment == 'right'){
        $jewelry_outlet_theme_custom_setting_css .='.scroll-up{';
            $jewelry_outlet_theme_custom_setting_css .='right: 30px;!important;';
			$jewelry_outlet_theme_custom_setting_css .='left: auto;!important;';
        $jewelry_outlet_theme_custom_setting_css .='}';
    }else if($jewelry_outlet_scroll_alignment == 'center'){
        $jewelry_outlet_theme_custom_setting_css .='.scroll-up{';
            $jewelry_outlet_theme_custom_setting_css .='left: calc(50% - 10px) !important;';
        $jewelry_outlet_theme_custom_setting_css .='}';
    }else if($jewelry_outlet_scroll_alignment == 'left'){
        $jewelry_outlet_theme_custom_setting_css .='.scroll-up{';
            $jewelry_outlet_theme_custom_setting_css .='left: 30px;!important;';
			$jewelry_outlet_theme_custom_setting_css .='right: auto;!important;';
        $jewelry_outlet_theme_custom_setting_css .='}';
    }

    // Woocommerce Sale Position
    $jewelry_outlet_sale_badge_position = get_theme_mod( 'jewelry_outlet_sale_badge_position','right');
    if($jewelry_outlet_sale_badge_position == 'left'){
        $jewelry_outlet_theme_custom_setting_css .='.woocommerce ul.products li.product .onsale{';
            $jewelry_outlet_theme_custom_setting_css .='left: 10px; right: auto;';
        $jewelry_outlet_theme_custom_setting_css .='}';
    }else if($jewelry_outlet_sale_badge_position == 'right'){
        $jewelry_outlet_theme_custom_setting_css .='.woocommerce ul.products li.product .onsale{';
            $jewelry_outlet_theme_custom_setting_css .='left: auto; right: 10px;';
        $jewelry_outlet_theme_custom_setting_css .='}';
    }

    // Featured Image Hover Effect
    $jewelry_outlet_show_featured = get_theme_mod('jewelry_outlet_featured_image_hide_show', 1);
    $jewelry_outlet_hover_effect = get_theme_mod('jewelry_outlet_single_post_featured_image_hover','none');

    if ( $jewelry_outlet_show_featured && $jewelry_outlet_hover_effect !== 'none' ) {

    $jewelry_outlet_theme_custom_setting_css .= '
    .post-img img{
        transition: all 0.4s ease;
    }';

    if ( $jewelry_outlet_hover_effect === 'zoom-in' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .post-img:hover img{
            transform: scale(1.2);
        }';
    }

    if ( $jewelry_outlet_hover_effect === 'zoom-out' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .post-img img{ transform: scale(1.2); }
        .post-img:hover img{ transform: scale(1); }';
    }

    if ( $jewelry_outlet_hover_effect === 'grayscale' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .post-img img{ filter: grayscale(100%); }
        .post-img:hover img{ filter: grayscale(0); }';
    }

    if ( $jewelry_outlet_hover_effect === 'sepia' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .post-img:hover img{ filter: sepia(100%); }';
    }

    if ( $jewelry_outlet_hover_effect === 'blur' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .post-img:hover img{ filter: blur(3px); }';
    }

    if ( $jewelry_outlet_hover_effect === 'bright' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .post-img:hover img{ filter: brightness(1.3); }';
    }

    if ( $jewelry_outlet_hover_effect === 'translate' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .post-img:hover img{ transform: translateY(-10px); }';
    }

    if ( $jewelry_outlet_hover_effect === 'scale' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .post-img:hover img{ transform: scale(1.1); }';
    }
}

// Product Featured Image Hover Effect
    $jewelry_outlet_show_featured = get_theme_mod('jewelry_outlet_featured_image_hide_show', 1);
    $jewelry_outlet_hover_effect = get_theme_mod('jewelry_outlet_product_featured_image_hover','none');

    if ( $jewelry_outlet_show_featured && $jewelry_outlet_hover_effect !== 'none' ) {

    $jewelry_outlet_theme_custom_setting_css .= '
    .product-img img{
        transition: all 0.4s ease;
    }';

    if ( $jewelry_outlet_hover_effect === 'zoom-in' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .product-img:hover img{
            transform: scale(1.2);
        }';
    }

    if ( $jewelry_outlet_hover_effect === 'zoom-out' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .product-img img{ transform: scale(1.2); }
        .product-img:hover img{ transform: scale(1); }';
    }

    if ( $jewelry_outlet_hover_effect === 'grayscale' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .product-img img{ filter: grayscale(100%); }
        .product-img:hover img{ filter: grayscale(0); }';
    }

    if ( $jewelry_outlet_hover_effect === 'sepia' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .product-img:hover img{ filter: sepia(100%); }';
    }

    if ( $jewelry_outlet_hover_effect === 'blur' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .product-img:hover img{ filter: blur(3px); }';
    }

    if ( $jewelry_outlet_hover_effect === 'bright' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .product-img:hover img{ filter: brightness(1.3); }';
    }

    if ( $jewelry_outlet_hover_effect === 'translate' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .product-img:hover img{ transform: translateY(-10px); }';
    }

    if ( $jewelry_outlet_hover_effect === 'scale' ) {
        $jewelry_outlet_theme_custom_setting_css .= '
        .product-img:hover img{ transform: scale(1.1); }';
    }
}
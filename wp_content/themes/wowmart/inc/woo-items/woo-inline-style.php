<?php

/**
 * Add inline css 
 *
 * 
 */
if (!function_exists('wowmart_wooinline_css')) :
    function wowmart_wooinline_css()
    {

        $style = '';


        $wowmart_resultcount = get_theme_mod('wowmart_resultcount', 1);
        if (empty($wowmart_resultcount)) {
            $style .= 'p.woocommerce-result-count{display:none !important;}';
        }
        $wowmart_porder = get_theme_mod('wowmart_porder', 1);
        if (empty($wowmart_porder)) {
            $style .= '.woocommerce .woocommerce-ordering{display:none !important;}';
        }

        $wowmart_title_position = get_theme_mod('wowmart_title_position', 'center');
        if ($wowmart_title_position != 'left') {
            $style .= '.woocommerce .page-title,.woocommerce .term-description{text-align:' . $wowmart_title_position . ' !important;}';
        }
        $wowmart_titlecolor = get_theme_mod('wowmart_titlecolor');
        if ($wowmart_titlecolor) {
            $style .= '.woocommerce .page-title{color:' . $wowmart_titlecolor . ' !important;}';
        }
        $wowmart_product_bgcolor = get_theme_mod('wowmart_product_bgcolor');
        if ($wowmart_product_bgcolor) {
            $style .= '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{background:' . $wowmart_product_bgcolor . ' !important;}';
        }
        $wowmart_ptitle_color = get_theme_mod('wowmart_ptitle_color');
        if ($wowmart_ptitle_color) {
            $style .= '.woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3{color:' . $wowmart_ptitle_color . ' !important;}';
        }
        $wowmart_prating_color = get_theme_mod('wowmart_prating_color');
        if ($wowmart_prating_color) {
            $style .= '.woocommerce .star-rating span:before{color:' . $wowmart_prating_color . ' !important;}';
        }
        $wowmart_pprice_color = get_theme_mod('wowmart_pprice_color');
        if ($wowmart_pprice_color) {
            $style .= '.woocommerce ul.products li.product .price{color:' . $wowmart_pprice_color . ' !important;}';
        }
        $wowmart_pbtn_bgcolor = get_theme_mod('wowmart_pbtn_bgcolor');
        $wowmart_pbtn_color = get_theme_mod('wowmart_pbtn_color');
        if ($wowmart_pbtn_bgcolor || $wowmart_pbtn_color) {
            $style .= '.woocommerce a.button, .woocommerce a.added_to_cart, .woocommerce button.button,.woocommerce span.onsale{background:' . $wowmart_pbtn_bgcolor . ' !important;color:' . $wowmart_pbtn_color . ' !important}';
        }
        $wowmart_pbtn_hvbgcolor = get_theme_mod('wowmart_pbtn_hvbgcolor');
        $wowmart_pbtn_hvcolor = get_theme_mod('wowmart_pbtn_hvcolor');
        if ($wowmart_pbtn_hvbgcolor) {
            $style .= '.woocommerce a.button:hover, .woocommerce a.added_to_cart:hover, .woocommerce button.button:hover, .woocommerce input.button:hover a.added_to_cart.wc-forward{background:' . $wowmart_pbtn_hvbgcolor . ' !important;color:' . $wowmart_pbtn_hvcolor . ' !important}';
        }
        $wowmart_shopb_img = get_theme_mod('wowmart_shopb_img');

        if ($wowmart_shopb_img) {
            $wowmart_shopb_img_url = wp_get_attachment_image_src($wowmart_shopb_img, 'full');
            if ($wowmart_shopb_img_url) {
                $style .= '.wowmart-banner.bg-overlay{background:url(' . $wowmart_shopb_img_url[0] . ')}';
            }
        }
        $wowmart_bannertext_color = get_theme_mod('wowmart_bannertext_color', '#fff');
        if ($wowmart_bannertext_color != '#fff') {
            $style .= '.wowmart-banner .bbanner-text h1,.wowmart-banner .bbanner-text h4,.wowmart-banner .bbanner-text p, .banner-description{color:' . $wowmart_bannertext_color . ' !important}';
            $style .= '.banner-subtitle::after{background:' . $wowmart_bannertext_color . ' !important}';
        }
        $wowmart_bannerbtn_color = get_theme_mod('wowmart_bannerbtn_color', '#fff');
        if ($wowmart_bannerbtn_color != '#fff') {
            $style .= 'a.btn.xskit-btn{color:' . $wowmart_bannerbtn_color . ' !important}';
        }
        $wowmart_bannerbtn_bgcolor = get_theme_mod('wowmart_bannerbtn_bgcolor', '#bb0925');
        if ($wowmart_bannerbtn_bgcolor != '#bb0925') {
            $style .= 'a.btn.xskit-btn{background:' . $wowmart_bannerbtn_bgcolor . ' !important}';
        }
        $wowmart_products_pagination = get_theme_mod('wowmart_products_pagination', 'center');
        if ($wowmart_products_pagination != 'center') {
            $style .= '.woocommerce nav.woocommerce-pagination{text-align:' . $wowmart_products_pagination . '}';
        }
        $wowmart_ftwidget_color = get_theme_mod('wowmart_ftwidget_color');
        if ($wowmart_ftwidget_color) {
            $style .= '.wowmart-products-filter ul li, .wowmart-products-filter ul li a{color:' . $wowmart_ftwidget_color . '}';
        }
        $wowmart_ftwidget_bgcolor = get_theme_mod('wowmart_ftwidget_bgcolor');
        if ($wowmart_ftwidget_bgcolor) {
            $style .= '.wowmart-products-filter ul{background:' . $wowmart_ftwidget_bgcolor . ' !important}';
        }
        $wowmart_ftwidget_hvcolor = get_theme_mod('wowmart_ftwidget_hvcolor');
        if ($wowmart_ftwidget_hvcolor) {
            $style .= '.wowmart-products-filter ul li a:hover{color:' . $wowmart_ftwidget_hvcolor . '}';
        }
        $wowmart_breadcrump_color = get_theme_mod('wowmart_breadcrump_color');
        $wowmart_breadcrump_bgcolor = get_theme_mod('wowmart_breadcrump_bgcolor');
        if ($wowmart_breadcrump_color) {
            $style .= '.woocommerce .woocommerce-breadcrumb, .woocommerce .woocommerce-breadcrumb a{color:' . $wowmart_breadcrump_color . ' !important}';
        }
        if ($wowmart_breadcrump_bgcolor) {
            $style .= '.wowmart-wbreadcrump{background:' . $wowmart_breadcrump_bgcolor . ' !important}';
        }
        $wowmart_pagitext_color = get_theme_mod('wowmart_pagitext_color');
        $wowmart_pagibg_color = get_theme_mod('wowmart_pagibg_color');
        if ($wowmart_pagitext_color || $wowmart_pagibg_color) {
            $style .= '.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current{color:' . $wowmart_pagibg_color . ' !important;background:' . $wowmart_pagitext_color . ' !important}';
            $style .= '.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span{background:' . $wowmart_pagibg_color . ' !important;color:' . $wowmart_pagitext_color . ' !important}';
        }
        /*Single page style*/
        $wowmart_sptitle_color = get_theme_mod('wowmart_sptitle_color');
        if ($wowmart_sptitle_color) {
            $style .= '.single-product .product_title{color:' . $wowmart_sptitle_color . ' !important}';
        }
        $wowmart_ptitle_fsize = get_theme_mod('wowmart_ptitle_fsize');
        if ($wowmart_ptitle_fsize) {
            $style .= '.single-product .product_title{font-size:' . $wowmart_ptitle_fsize . 'px !important}';
        }
        $wowmart_srating_show = get_theme_mod('wowmart_srating_show', '1');
        if (empty($wowmart_srating_show)) {
            $style .= '.single-product .woocommerce-product-rating{display:none}';
        }
        $wowmart_sdesc_show = get_theme_mod('wowmart_sdesc_show', '1');
        if (empty($wowmart_sdesc_show)) {
            $style .= '.single-product .woocommerce-product-details__short-description{display:none}';
        }
        $wowmart_sku_show = get_theme_mod('wowmart_sku_show', '1');
        if (empty($wowmart_sku_show)) {
            $style .= '.single-product .sku_wrapper{display:none}';
        }
        $wowmart_spcat_show = get_theme_mod('wowmart_spcat_show', '1');
        if (empty($wowmart_spcat_show)) {
            $style .= '.single-product .posted_in{display:none}';
        }
        $wowmart_sptag_show = get_theme_mod('wowmart_sptag_show', '1');
        if (empty($wowmart_sptag_show)) {
            $style .= '.single-product .tagged_as{display:none}';
        }
        $wowmart_sptab_show = get_theme_mod('wowmart_sptab_show', '1');
        if (empty($wowmart_sptab_show)) {
            $style .= '.single-product .woocommerce-tabs{display:none}';
        }
        $wowmart_sprelated_show = get_theme_mod('wowmart_sprelated_show', '1');
        if (empty($wowmart_sprelated_show)) {
            $style .= '.single-product .related.products{display:none}';
        }





        wp_add_inline_style('wowmart-main', $style);
    }
    add_action('wp_enqueue_scripts', 'wowmart_wooinline_css');
endif;

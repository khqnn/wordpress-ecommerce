<?php

/**
 * Add inline css 
 *
 * 
 */
if (!function_exists('wowmart_inline_css')) :
  function wowmart_inline_css()
  {

    $style = '';

    // font settings
    $wowmart_theme_fonts = get_theme_mod('wowmart_theme_fonts', 'Poppins');
    $wowmart_font_size = get_theme_mod('wowmart_font_size', '14');
    $wowmart_font_line_height = get_theme_mod('wowmart_font_line_height', '24');
    $wowmart_theme_font_head = get_theme_mod('wowmart_theme_font_head', 'Montserrat');
    $wowmart_font_weight_head = get_theme_mod('wowmart_font_weight_head', '700');

    if ($wowmart_theme_fonts != 'Poppins') {
      $style .= 'body, p{font-family:\'' . esc_attr($wowmart_theme_fonts) . '\', sans-serif;}';
    }
    if ($wowmart_font_size != '14') {
      $style .= 'body, p{font-size:' . esc_attr($wowmart_font_size) . 'px;}';
    }
    if ($wowmart_font_line_height != '24') {
      $style .= 'body, p{line-height:' . esc_attr($wowmart_font_line_height) . 'px;}';
    }

    if ($wowmart_theme_font_head != 'Noto Serif') {
      $style .= 'h1,h1 a, h2,h2 a, h3,h3 a, h4,h4 a, h5, h6{font-family:\'' . esc_attr($wowmart_theme_font_head) . '\', sans-serif;}';
    }
    if ($wowmart_font_weight_head != '700') {
      $style .= 'h1, h2, h3, h4, h5, h6{font-weight:' . esc_attr($wowmart_font_weight_head) . ';}';
    }



    if (get_header_textcolor() != '#000000') {
      $style .= 'h1.site-title a,p.site-description{color:#' . esc_attr(get_header_textcolor()) . ';}';
    }

    $wowmart_titletag_bgcolor = get_theme_mod('wowmart_titletag_bgcolor');
    if ($wowmart_titletag_bgcolor) {
      $style .= 'p.site-description:before{background:' . esc_attr($wowmart_titletag_bgcolor) . ' !important;}';
    }

    $wowmart_tagline_bgshow = get_theme_mod('wowmart_tagline_bgshow');
    if (empty($wowmart_tagline_bgshow)) {
      $style .= 'p.site-description:before{display:none !important;}';
      $style .= '.headerlogo-text.text-left .site-description{padding:0;}';
    }

    //top bar settings  
    $wowmart_topbar_bg = get_theme_mod('wowmart_topbar_bg', '#ededed');
    $wowmart_topbar_color = get_theme_mod('wowmart_topbar_color', '#000');
    $wowmart_topbar_hcolor = get_theme_mod('wowmart_topbar_hcolor', '#6b14fa');

    if ($wowmart_topbar_bg != '#ededed') {
      $style .= '.wowmart-tophead.bg-light,#bessearch .search-submit{background-color:' . esc_attr($wowmart_topbar_bg) . '!important;}';
    }
    if ($wowmart_topbar_color != '#000') {
      $style .= '.wowmart-tophead, .wowmart-tophead a, .wowmart-tophead span, .wowmart-tophead input,.besearch-icon i, .besearch-icon a,#bessearch .search-submit{color:' . esc_attr($wowmart_topbar_color) . ';}';
    }
    if ($wowmart_topbar_hcolor != '#6b14fa') {
      $style .= '.wowmart-tophead a:hover,.besearch-icon a:hover i{color:' . esc_attr($wowmart_topbar_hcolor) . ';}';
    }

    // image logo width height
    $wowmart_logo_width = get_theme_mod('wowmart_logo_width');
    $wowmart_logo_height = get_theme_mod('wowmart_logo_height');
    if ($wowmart_logo_width) {
      $style .= '.site-branding.has-himg a img{width:' . esc_attr($wowmart_logo_width) . 'px;}';
    }
    if ($wowmart_logo_height) {
      $style .= '.site-branding.has-himg a img{height:' . esc_attr($wowmart_logo_height) . 'px;}';
    }

    // title and tagline font size
    $wowmart_mhead_height = get_theme_mod('wowmart_mhead_height');
    $wowmart_logo_fontsize = get_theme_mod('wowmart_logo_fontsize');
    $wowmart_desc_fontsize = get_theme_mod('wowmart_desc_fontsize');
    if ($wowmart_mhead_height) {
      $style .= '.site-branding, .wowmart-header-img img{height:' . esc_attr($wowmart_mhead_height) . 'px !important;}';
    }
    if ($wowmart_logo_fontsize) {
      $style .= 'h1.site-title a{font-size:' . esc_attr($wowmart_logo_fontsize) . 'px;}';
    }
    if ($wowmart_desc_fontsize) {
      $style .= 'p.site-description{font-size:' . esc_attr($wowmart_desc_fontsize) . 'px;}';
    }
    $wowmart_menu_position = get_theme_mod('wowmart_menu_position', 'center');
    if ($wowmart_menu_position) {
      $style .= '.main-navigation ul{justify-content:' . esc_attr($wowmart_menu_position) . ';}';
    }
    $wowmart_menu_tbpadding = get_theme_mod('wowmart_menu_tbpadding');
    if ($wowmart_menu_tbpadding) {
      $style .= '.wowmart-main-nav{padding:' . esc_attr($wowmart_menu_tbpadding) . 'px 0;}';
    }
    $wowmart_menu_fontsize = get_theme_mod('wowmart_menu_fontsize');
    if ($wowmart_menu_fontsize) {
      $style .= '.wowmart-main-nav ul li a{font-size:' . esc_attr($wowmart_menu_fontsize) . 'px;}';
    }
    $wowmart_menubg_color = get_theme_mod('wowmart_menubg_color');
    if ($wowmart_menubg_color) {
      $style .= '.wowmart-main-nav.bg-light,.menu-main-menu-container{background:' . esc_attr($wowmart_menubg_color) . '  !important;}';
      $style .= '.wowmart-main-nav ul li a{border-color:' . esc_attr($wowmart_menubg_color) . '  !important;}';
    }
    $wowmart_menudropbg_color = get_theme_mod('wowmart_menudropbg_color');
    if ($wowmart_menudropbg_color) {
      $style .= '.main-navigation ul ul{background:' . esc_attr($wowmart_menudropbg_color) . '  !important;}';
    }
    $wowmart_menu_color = get_theme_mod('wowmart_menu_color');
    if ($wowmart_menu_color) {
      $style .= '.wowmart-main-nav ul li a,.mini-toggle, .main-navigation .page_item_has_children:before, .main-navigation .menu-item-has-children:before{color:' . esc_attr($wowmart_menu_color) . '  !important;}';
    }

    //color section style
    $wowmart_header_color = get_theme_mod('wowmart_header_color');
    if ($wowmart_header_color) {
      $style .= 'h1,h2,h3,h4,h5,h6, h2.entry-title a, h2.entry-title{color:' . esc_attr($wowmart_header_color) . ';}';
    }
    $wowmart_bodyfont_color = get_theme_mod('wowmart_bodyfont_color');
    if ($wowmart_bodyfont_color) {
      $style .= 'body,body p{color:' . esc_attr($wowmart_bodyfont_color) . ';}';
    }
    $wowmart_contentbg_color = get_theme_mod('wowmart_contentbg_color');
    if ($wowmart_contentbg_color) {
      $style .= '.wowmart-btext, .widget-area .widget, .xskit-blog-grid, .site-footer, .archive-header, .search-header, .wowmart-page, .site-main .comment-navigation, .site-main .posts-navigation, .site-main .post-navigation, .site-footer, .xskit-blog-list, .xskit-single-list, .comments-area,.xskit-simple-list.hasimg{background-color:' . esc_attr($wowmart_contentbg_color) . ';}';
    }
    $wowmart_basic_color = get_theme_mod('wowmart_basic_color');
    if ($wowmart_basic_color) {
      $style .= '.entry-footer,h3.widget-title, h2.widget-title,.site-footer, .site-main .comment-navigation, .site-main .posts-navigation, .site-main .post-navigation,span.count.cart-contents,.widget .search-form input.search-submit:hover{background-color:' . esc_attr($wowmart_basic_color) . ';}';
      $style .= '.entry-meta, .entry-meta a,widget .search-form input.search-submit{color:' . esc_attr($wowmart_basic_color) . ';}';
      $style .= '.widget .search-form input.search-submit{border-color:' . esc_attr($wowmart_basic_color) . ';}';
    }
    $wowmart_link_color = get_theme_mod('wowmart_link_color');
    if ($wowmart_link_color) {
      $style .= 'a{color:' . esc_attr($wowmart_link_color) . ';}';
    }
    $wowmart_linkhvr_color = get_theme_mod('wowmart_linkhvr_color');
    if ($wowmart_linkhvr_color) {
      $style .= 'a:hover,a:visited{color:' . esc_attr($wowmart_linkhvr_color) . ';}';
    }
    $wowmart_topfooter_bgcolor = get_theme_mod('wowmart_topfooter_bgcolor');
    if ($wowmart_topfooter_bgcolor) {
      $style .= '.footer-top.bg-light{background:' . esc_attr($wowmart_topfooter_bgcolor) . '  !important;}';
    }
    $wowmart_tftitle_color = get_theme_mod('wowmart_tftitle_color');
    if ($wowmart_tftitle_color) {
      $style .= '.footer-widget .widget-title{color:' . esc_attr($wowmart_tftitle_color) . '  !important;}';
    }
    $wowmart_tftext_color = get_theme_mod('wowmart_tftext_color');
    if ($wowmart_tftext_color) {
      $style .= '.footer-widget, .footer-widget p, .footer-widget a, .footer-widget #wp-calendar caption, .footer-widget .search-form input.search-submit{color:' . esc_attr($wowmart_tftext_color) . '  !important;}';
    }
    $wowmart_tflink_hovercolor = get_theme_mod('wowmart_tflink_hovercolor');
    if ($wowmart_tflink_hovercolor) {
      $style .= '.footer-widget a:hover{color:' . esc_attr($wowmart_tflink_hovercolor) . '  !important;}';
    }
    $wowmart_footer_bgcolor = get_theme_mod('wowmart_footer_bgcolor');
    if ($wowmart_footer_bgcolor) {
      $style .= 'footer.site-footer{background:' . esc_attr($wowmart_footer_bgcolor) . '  !important;}';
    }
    $wowmart_footer_color = get_theme_mod('wowmart_footer_color');
    if ($wowmart_footer_color) {
      $style .= 'footer.site-footer,footer.site-footer a,footer.site-footer p{color:' . esc_attr($wowmart_footer_color) . '  !important;}';
    }
    $wowmart_footerlink_hcolor = get_theme_mod('wowmart_footerlink_hcolor');
    if ($wowmart_footerlink_hcolor) {
      $style .= 'footer.site-footer a:hover,footer.site-footer a:focus{color:' . esc_attr($wowmart_footerlink_hcolor) . '  !important;}';
    }



    wp_add_inline_style('wowmart-main', $style);
  }
  add_action('wp_enqueue_scripts', 'wowmart_inline_css');
endif;

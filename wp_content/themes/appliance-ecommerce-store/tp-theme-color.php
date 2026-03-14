<?php
	
	$appliance_ecommerce_store_tp_theme_css = '';

	// 1st color
	$appliance_ecommerce_store_tp_color_option_first = get_theme_mod('appliance_ecommerce_store_tp_color_option_first', '#0C8F02');
	if ($appliance_ecommerce_store_tp_color_option_first) {
		$appliance_ecommerce_store_tp_theme_css .= ':root {';
		$appliance_ecommerce_store_tp_theme_css .= '--color-primary1: ' . esc_attr($appliance_ecommerce_store_tp_color_option_first) . ';';
		$appliance_ecommerce_store_tp_theme_css .= '}';
	}

	// preloader
	$appliance_ecommerce_store_tp_preloader_color1_option = get_theme_mod('appliance_ecommerce_store_tp_preloader_color1_option');
	if($appliance_ecommerce_store_tp_preloader_color1_option != false){
	$appliance_ecommerce_store_tp_theme_css .='.center1{';
		$appliance_ecommerce_store_tp_theme_css .='border-color: '.esc_attr($appliance_ecommerce_store_tp_preloader_color1_option).' !important;';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}
	if($appliance_ecommerce_store_tp_preloader_color1_option != false){
	$appliance_ecommerce_store_tp_theme_css .='.center1 .ring::before{';
		$appliance_ecommerce_store_tp_theme_css .='background: '.esc_attr($appliance_ecommerce_store_tp_preloader_color1_option).' !important;';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	$appliance_ecommerce_store_tp_preloader_color2_option = get_theme_mod('appliance_ecommerce_store_tp_preloader_color2_option');

	if($appliance_ecommerce_store_tp_preloader_color2_option != false){
	$appliance_ecommerce_store_tp_theme_css .='.center2{';
		$appliance_ecommerce_store_tp_theme_css .='border-color: '.esc_attr($appliance_ecommerce_store_tp_preloader_color2_option).' !important;';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}
	if($appliance_ecommerce_store_tp_preloader_color2_option != false){
	$appliance_ecommerce_store_tp_theme_css .='.center2 .ring::before{';
		$appliance_ecommerce_store_tp_theme_css .='background: '.esc_attr($appliance_ecommerce_store_tp_preloader_color2_option).' !important;';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	$appliance_ecommerce_store_tp_preloader_bg_color_option = get_theme_mod('appliance_ecommerce_store_tp_preloader_bg_color_option');

	if($appliance_ecommerce_store_tp_preloader_bg_color_option != false){
	$appliance_ecommerce_store_tp_theme_css .='.loader{';
		$appliance_ecommerce_store_tp_theme_css .='background: '.esc_attr($appliance_ecommerce_store_tp_preloader_bg_color_option).';';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	$appliance_ecommerce_store_tp_footer_bg_color_option = get_theme_mod('appliance_ecommerce_store_tp_footer_bg_color_option');


	if($appliance_ecommerce_store_tp_footer_bg_color_option != false){
	$appliance_ecommerce_store_tp_theme_css .='#footer{';
		$appliance_ecommerce_store_tp_theme_css .='background: '.esc_attr($appliance_ecommerce_store_tp_footer_bg_color_option).';';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	// logo tagline color
	$appliance_ecommerce_store_site_tagline_color = get_theme_mod('appliance_ecommerce_store_site_tagline_color');

	if($appliance_ecommerce_store_site_tagline_color != false){
	$appliance_ecommerce_store_tp_theme_css .='.logo h1 a, .logo p a, .logo p.site-title a{';
	$appliance_ecommerce_store_tp_theme_css .='color: '.esc_attr($appliance_ecommerce_store_site_tagline_color).';';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	$appliance_ecommerce_store_logo_tagline_color = get_theme_mod('appliance_ecommerce_store_logo_tagline_color');
	if($appliance_ecommerce_store_logo_tagline_color != false){
	$appliance_ecommerce_store_tp_theme_css .='p.site-description{';
	$appliance_ecommerce_store_tp_theme_css .='color: '.esc_attr($appliance_ecommerce_store_logo_tagline_color).';';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	// footer widget title color
	$appliance_ecommerce_store_footer_widget_title_color = get_theme_mod('appliance_ecommerce_store_footer_widget_title_color');
	if($appliance_ecommerce_store_footer_widget_title_color != false){
	$appliance_ecommerce_store_tp_theme_css .='#footer h3, #footer h2.wp-block-heading{';
	$appliance_ecommerce_store_tp_theme_css .='color: '.esc_attr($appliance_ecommerce_store_footer_widget_title_color).';';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	// copyright text color
	$appliance_ecommerce_store_footer_copyright_text_color = get_theme_mod('appliance_ecommerce_store_footer_copyright_text_color');
	if($appliance_ecommerce_store_footer_copyright_text_color != false){
	$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p, #footer .site-info a {';
	$appliance_ecommerce_store_tp_theme_css .='color: '.esc_attr($appliance_ecommerce_store_footer_copyright_text_color).'!important;';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	// header image title color
	$appliance_ecommerce_store_header_image_title_text_color = get_theme_mod('appliance_ecommerce_store_header_image_title_text_color');
	if($appliance_ecommerce_store_header_image_title_text_color != false){
	$appliance_ecommerce_store_tp_theme_css .='.box-text h2{';
	$appliance_ecommerce_store_tp_theme_css .='color: '.esc_attr($appliance_ecommerce_store_header_image_title_text_color).';';
	$appliance_ecommerce_store_tp_theme_css .='}';
	}

	// menu color
	$appliance_ecommerce_store_menu_color = get_theme_mod('appliance_ecommerce_store_menu_color');
	if($appliance_ecommerce_store_menu_color != false){
	$appliance_ecommerce_store_tp_theme_css .='.main-navigation a{';
	$appliance_ecommerce_store_tp_theme_css .='color: '.esc_attr($appliance_ecommerce_store_menu_color).';';
	$appliance_ecommerce_store_tp_theme_css .='}';
}


//Footer Font Weight
$appliance_ecommerce_store_footer_copyright_title_font_weight = get_theme_mod( 'appliance_ecommerce_store_footer_copyright_title_font_weight','');
if($appliance_ecommerce_store_footer_copyright_title_font_weight == '100'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 100;';
$appliance_ecommerce_store_tp_theme_css .='}';
}else if($appliance_ecommerce_store_footer_copyright_title_font_weight == '200'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 200;';
$appliance_ecommerce_store_tp_theme_css .='}';
}else if($appliance_ecommerce_store_footer_copyright_title_font_weight == '300'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 300;';
$appliance_ecommerce_store_tp_theme_css .='}';
}else if($appliance_ecommerce_store_footer_copyright_title_font_weight == '400'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 400;';
$appliance_ecommerce_store_tp_theme_css .='}';
}else if($appliance_ecommerce_store_footer_copyright_title_font_weight == '500'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 500;';
$appliance_ecommerce_store_tp_theme_css .='}';
}else if($appliance_ecommerce_store_footer_copyright_title_font_weight == '600'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 600;';
$appliance_ecommerce_store_tp_theme_css .='}';
}else if($appliance_ecommerce_store_footer_copyright_title_font_weight == '700'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 700;';
$appliance_ecommerce_store_tp_theme_css .='}';
}else if($appliance_ecommerce_store_footer_copyright_title_font_weight == '800'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 800;';
$appliance_ecommerce_store_tp_theme_css .='}';
}else if($appliance_ecommerce_store_footer_copyright_title_font_weight == '900'){
$appliance_ecommerce_store_tp_theme_css .='#footer .site-info p {';
    $appliance_ecommerce_store_tp_theme_css .='font-weight: 900;';
$appliance_ecommerce_store_tp_theme_css .='}';
}
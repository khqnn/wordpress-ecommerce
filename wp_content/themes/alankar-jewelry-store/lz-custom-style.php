<?php 

	$luzuk_alankar_jewelry_store_custom_style = '';

	// Logo Size
	$luzuk_alankar_jewelry_store_logo_top_padding = get_theme_mod('luzuk_alankar_jewelry_store_logo_top_padding');
	$luzuk_alankar_jewelry_store_logo_bottom_padding = get_theme_mod('luzuk_alankar_jewelry_store_logo_bottom_padding');
	$luzuk_alankar_jewelry_store_logo_left_padding = get_theme_mod('luzuk_alankar_jewelry_store_logo_left_padding');
	$luzuk_alankar_jewelry_store_logo_right_padding = get_theme_mod('luzuk_alankar_jewelry_store_logo_right_padding');

	if( $luzuk_alankar_jewelry_store_logo_top_padding != '' || $luzuk_alankar_jewelry_store_logo_bottom_padding != '' || $luzuk_alankar_jewelry_store_logo_left_padding != '' || $luzuk_alankar_jewelry_store_logo_right_padding != ''){
		$luzuk_alankar_jewelry_store_custom_style .=' .logo {';
			$luzuk_alankar_jewelry_store_custom_style .=' padding-top: '.esc_attr($luzuk_alankar_jewelry_store_logo_top_padding).'px; padding-bottom: '.esc_attr($luzuk_alankar_jewelry_store_logo_bottom_padding).'px; padding-left: '.esc_attr($luzuk_alankar_jewelry_store_logo_left_padding).'px; padding-right: '.esc_attr($luzuk_alankar_jewelry_store_logo_right_padding).'px;';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_logo_size = get_theme_mod('luzuk_alankar_jewelry_store_logo_size');
	if( $luzuk_alankar_jewelry_store_logo_size != '') {
		if($luzuk_alankar_jewelry_store_logo_size == 100) {
			$luzuk_alankar_jewelry_store_custom_style .=' .custom-logo-link img {';
				$luzuk_alankar_jewelry_store_custom_style .=' width: 350px;';
			$luzuk_alankar_jewelry_store_custom_style .=' }';
		} else if($luzuk_alankar_jewelry_store_logo_size >= 10 && $luzuk_alankar_jewelry_store_logo_size < 100) {
			$luzuk_alankar_jewelry_store_custom_style .=' .custom-logo-link img {';
				$luzuk_alankar_jewelry_store_custom_style .=' width: '.esc_attr($luzuk_alankar_jewelry_store_logo_size).'%;';
			$luzuk_alankar_jewelry_store_custom_style .=' }';
		}
	}

	// Header Image
	$header_image_url = luzuk_alankar_jewelry_store_banner_image( $image_url = '' );
	if( $header_image_url != ''){
		$luzuk_alankar_jewelry_store_custom_style .=' #inner-pages-header {';
			$luzuk_alankar_jewelry_store_custom_style .=' background-image: url('. esc_url( $header_image_url ).') !important; background-size: cover; background-repeat: no-repeat; background-attachment: fixed;';
		$luzuk_alankar_jewelry_store_custom_style .=' }';

		$luzuk_alankar_jewelry_store_custom_style .='  #header .top-head {';
			$luzuk_alankar_jewelry_store_custom_style .=' background: none ';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	} else {
		$luzuk_alankar_jewelry_store_custom_style .=' #inner-pages-header {';
			$luzuk_alankar_jewelry_store_custom_style .=' background: radial-gradient(circle at center, rgba(0,0,0,0) 0%, #000000 100%); ';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_hide_show = get_theme_mod('luzuk_alankar_jewelry_store_slider_hide_show',false);
	if( $luzuk_alankar_jewelry_store_slider_hide_show == true){
		$luzuk_alankar_jewelry_store_custom_style .=' .page-template-custom-home-page #inner-pages-header {';
			$luzuk_alankar_jewelry_store_custom_style .=' display:none;';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}




	$luzuk_alankar_jewelry_store_addressicon_col = get_theme_mod('luzuk_alankar_jewelry_store_addressicon_col');
	if ( $luzuk_alankar_jewelry_store_addressicon_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .tphead .emph i {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_addressicon_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_addresstext_col = get_theme_mod('luzuk_alankar_jewelry_store_addresstext_col');
	if ( $luzuk_alankar_jewelry_store_addresstext_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .tphead .emph a {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_addresstext_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_addresstexthvr_col = get_theme_mod('luzuk_alankar_jewelry_store_addresstexthvr_col');
	if ( $luzuk_alankar_jewelry_store_addresstexthvr_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .tphead .emph a:hover {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_addresstexthvr_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_socialicon_col = get_theme_mod('luzuk_alankar_jewelry_store_socialicon_col');
	if ( $luzuk_alankar_jewelry_store_socialicon_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .s-media li a {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_socialicon_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_socialiconhvr_col = get_theme_mod('luzuk_alankar_jewelry_store_socialiconhvr_col');
	if ( $luzuk_alankar_jewelry_store_socialiconhvr_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .s-media li a:hover {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_socialiconhvr_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_searchbtntext_col = get_theme_mod('luzuk_alankar_jewelry_store_searchbtntext_col');
	if ( $luzuk_alankar_jewelry_store_searchbtntext_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .s-frm .search-submit {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_searchbtntext_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_searchbtnbg_col = get_theme_mod('luzuk_alankar_jewelry_store_searchbtnbg_col');
	if ( $luzuk_alankar_jewelry_store_searchbtnbg_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .='#header .s-frm .search-submit {';
			$luzuk_alankar_jewelry_store_custom_style .=' background:'.esc_attr($luzuk_alankar_jewelry_store_searchbtnbg_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_searchbg_col = get_theme_mod('luzuk_alankar_jewelry_store_searchbg_col');
	if ( $luzuk_alankar_jewelry_store_searchbg_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' input[type="search"] {';
			$luzuk_alankar_jewelry_store_custom_style .=' background:'.esc_attr($luzuk_alankar_jewelry_store_searchbg_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_searchicon_col = get_theme_mod('luzuk_alankar_jewelry_store_searchicon_col');
	if ( $luzuk_alankar_jewelry_store_searchicon_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .search_bar:after {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_searchicon_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_searchiconbg_col = get_theme_mod('luzuk_alankar_jewelry_store_searchiconbg_col');
	if ( $luzuk_alankar_jewelry_store_searchiconbg_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .search_bar:after {';
			$luzuk_alankar_jewelry_store_custom_style .=' background:'.esc_attr($luzuk_alankar_jewelry_store_searchiconbg_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_headerphonenumber_col = get_theme_mod('luzuk_alankar_jewelry_store_headerphonenumber_col');
	if ( $luzuk_alankar_jewelry_store_headerphonenumber_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .phonenumber,#header .phonenumber span {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_headerphonenumber_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_headerphonetext_col = get_theme_mod('luzuk_alankar_jewelry_store_headerphonetext_col');
	if ( $luzuk_alankar_jewelry_store_headerphonetext_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .phonenumber p {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_headerphonetext_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_headeraccicon_col = get_theme_mod('luzuk_alankar_jewelry_store_headeraccicon_col');
	if ( $luzuk_alankar_jewelry_store_headeraccicon_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .signinregisterinnbx i {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_headeraccicon_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_headercarticon_col = get_theme_mod('luzuk_alankar_jewelry_store_headercarticon_col');
	if ( $luzuk_alankar_jewelry_store_headercarticon_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .cart i {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_headercarticon_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_headercartnum_col = get_theme_mod('luzuk_alankar_jewelry_store_headercartnum_col');
	if ( $luzuk_alankar_jewelry_store_headercartnum_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .cartbtn .count {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_headercartnum_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_headercartnumbg_col = get_theme_mod('luzuk_alankar_jewelry_store_headercartnumbg_col');
	if ( $luzuk_alankar_jewelry_store_headercartnumbg_col != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #header .cartbtn .count {';
			$luzuk_alankar_jewelry_store_custom_style .=' background-color:'.esc_attr($luzuk_alankar_jewelry_store_headercartnumbg_col).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_menu_color = get_theme_mod('luzuk_alankar_jewelry_store_menu_color');
	if ( $luzuk_alankar_jewelry_store_menu_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .primary-menu a, .primary-menu li .icon{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_menu_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}


	$luzuk_alankar_jewelry_store_menubrdhover_color = get_theme_mod('luzuk_alankar_jewelry_store_menubrdhover_color');
	if ( $luzuk_alankar_jewelry_store_menubrdhover_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='.primary-menu li:hover .icon, .primary-menu li a:hover{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_menubrdhover_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_menubrdhover_color = get_theme_mod('luzuk_alankar_jewelry_store_menubrdhover_color');
	if ( $luzuk_alankar_jewelry_store_menubrdhover_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='.primary-menu li.current_page_item a:before, .current_page_item > a:before, .primary-menu li a:hover:before{';
			$luzuk_alankar_jewelry_store_custom_style .=' border-color:'.esc_attr($luzuk_alankar_jewelry_store_menubrdhover_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_submenu_color = get_theme_mod('luzuk_alankar_jewelry_store_submenu_color');
	if ( $luzuk_alankar_jewelry_store_submenu_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='.primary-menu ul a{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_submenu_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_submenubg_color = get_theme_mod('luzuk_alankar_jewelry_store_submenubg_color');
	if ( $luzuk_alankar_jewelry_store_submenubg_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='.primary-menu ul{';
			$luzuk_alankar_jewelry_store_custom_style .=' background:'.esc_attr($luzuk_alankar_jewelry_store_submenubg_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_saletext_color = get_theme_mod('luzuk_alankar_jewelry_store_saletext_color');
	if ( $luzuk_alankar_jewelry_store_saletext_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='#header .offertext i, #header .offertext b{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_saletext_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}


	//site title tagline
	$luzuk_alankar_jewelry_store_site_title_color = get_theme_mod('luzuk_alankar_jewelry_store_site_title_color');
	if ( $luzuk_alankar_jewelry_store_site_title_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' h1.site-title a, p.site-title a{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_site_title_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_site_tagline_color = get_theme_mod('luzuk_alankar_jewelry_store_site_tagline_color');
	if ( $luzuk_alankar_jewelry_store_site_tagline_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' p.site-description{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_site_tagline_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}
	
	//slider colors
	
	$luzuk_alankar_jewelry_store_slider_title_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_title_color');
	if ( $luzuk_alankar_jewelry_store_slider_title_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .content h2{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_slider_title_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_description_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_description_color');
	if ( $luzuk_alankar_jewelry_store_slider_description_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .content p{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_slider_description_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_btn1text_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_btn1text_color');
	if ( $luzuk_alankar_jewelry_store_slider_btn1text_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .sbtn1 {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_slider_btn1text_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_btn1bg_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_btn1bg_color');
	if ( $luzuk_alankar_jewelry_store_slider_btn1bg_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .sbtn1 {';
			$luzuk_alankar_jewelry_store_custom_style .=' background:'.esc_attr($luzuk_alankar_jewelry_store_slider_btn1bg_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_btn1texthvr_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_btn1texthvr_color');
	if ( $luzuk_alankar_jewelry_store_slider_btn1texthvr_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .sbtn1:hover {';
			$luzuk_alankar_jewelry_store_custom_style .=' background:'.esc_attr($luzuk_alankar_jewelry_store_slider_btn1texthvr_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_btntext_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_btntext_color');
	if ( $luzuk_alankar_jewelry_store_slider_btntext_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .sbtn2 {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_slider_btntext_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_btnbg_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_btnbg_color');
	if ( $luzuk_alankar_jewelry_store_slider_btnbg_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .sbtn2 {';
			$luzuk_alankar_jewelry_store_custom_style .=' border-color:'.esc_attr($luzuk_alankar_jewelry_store_slider_btnbg_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_btntexthrv_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_btntexthrv_color');
	if ( $luzuk_alankar_jewelry_store_slider_btntexthrv_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .sbtn2:hover {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_slider_btntexthrv_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_slider_btnbghrv_color = get_theme_mod('luzuk_alankar_jewelry_store_slider_btnbghrv_color');
	if ( $luzuk_alankar_jewelry_store_slider_btnbghrv_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #slider .sbtn2:hover {';
			$luzuk_alankar_jewelry_store_custom_style .=' background:'.esc_attr($luzuk_alankar_jewelry_store_slider_btnbghrv_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	

	//categories colors

	$luzuk_alankar_jewelry_store_categoriessubheading_color = get_theme_mod('luzuk_alankar_jewelry_store_categoriessubheading_color');
	if ( $luzuk_alankar_jewelry_store_categoriessubheading_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .productcategory-head .subheading {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_categoriessubheading_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_categoriesheading_color = get_theme_mod('luzuk_alankar_jewelry_store_categoriesheading_color');
	if ( $luzuk_alankar_jewelry_store_categoriesheading_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #productcategory-section .productcategory-head h3{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_categoriesheading_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_categoriesheadingborder_color = get_theme_mod('luzuk_alankar_jewelry_store_categoriesheadingborder_color');
	if ( $luzuk_alankar_jewelry_store_categoriesheadingborder_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .productcategory-head h3:after {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_categoriesheadingborder_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_categoriestitle_color = get_theme_mod('luzuk_alankar_jewelry_store_categoriestitle_color');
	if ( $luzuk_alankar_jewelry_store_categoriestitle_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #productcategory-section .pro-cat-content h5 a{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_categoriestitle_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_categoriestitlehvr_color = get_theme_mod('luzuk_alankar_jewelry_store_categoriestitlehvr_color');
	if ( $luzuk_alankar_jewelry_store_categoriestitlehvr_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #productcategory-section .pro-cat-img:hover .p-olay {';
			$luzuk_alankar_jewelry_store_custom_style .=' background-image: linear-gradient(180deg, transparent 1%, '.esc_attr($luzuk_alankar_jewelry_store_categoriestitlehvr_color).' 95%);';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}



	//newarrivalproduct colors
	$luzuk_alankar_jewelry_store_newarrivalproductsubheading_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproductsubheading_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproductsubheading_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .productcategory-head .subheading {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproductsubheading_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_newarrivalproductheading_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproductheading_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproductheading_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #newarrivalproducts-section .productcategory-head h3{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproductheading_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_newarrivalproductbrdheading_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproductbrdheading_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproductbrdheading_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .productcategory-head h3:after {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproductbrdheading_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_newarrivalproductcategory_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproductcategory_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproductcategory_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #newarrivalproducts-section .category-item {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproductcategory_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_newarrivalproducttitle_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproducttitle_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproducttitle_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #newarrivalproducts-section .pcontent h3 {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproducttitle_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_newarrivalproductprice_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproductprice_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproductprice_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='#newarrivalproducts-section .pcontent .s-price {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproductprice_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_newarrivalproductbtntext_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproductbtntext_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproductbtntext_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='#newarrivalproducts-section .pcontent .btn-rentadress a {';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproductbtntext_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_newarrivalproductbtnbg_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproductbtnbg_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproductbtnbg_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='#newarrivalproducts-section .pcontent .btn-rentadress a {';
			$luzuk_alankar_jewelry_store_custom_style .=' background:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproductbtnbg_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_newarrivalproductbtntexthvr_color = get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproductbtntexthvr_color');
	if ( $luzuk_alankar_jewelry_store_newarrivalproductbtntexthvr_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .='#newarrivalproducts-section .pcontent .btn-rentadress a:hover{';
			$luzuk_alankar_jewelry_store_custom_style .=' color:'.esc_attr($luzuk_alankar_jewelry_store_newarrivalproductbtntexthvr_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}



	//footer colors
	$luzuk_alankar_jewelry_store_footertext_color = get_theme_mod('luzuk_alankar_jewelry_store_footertext_color');
	if ( $luzuk_alankar_jewelry_store_footertext_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #colophon h1, #colophon h2, #colophon h3, #colophon h4, #colophon h5,
		 #colophon h6,#colophon,#colophon p,.site-footer a, .site-footer p, #colophon caption, .site-footer .widget_rss .rss-date,
		  .site-footer .widget_rss li cite {';
			$luzuk_alankar_jewelry_store_custom_style .=' color: '.esc_attr($luzuk_alankar_jewelry_store_footertext_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}	

	$luzuk_alankar_jewelry_store_footerbg_color = get_theme_mod('luzuk_alankar_jewelry_store_footerbg_color');
	if ( $luzuk_alankar_jewelry_store_footerbg_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .footer-overlay {';
			$luzuk_alankar_jewelry_store_custom_style .=' background: '.esc_attr($luzuk_alankar_jewelry_store_footerbg_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}


	$luzuk_alankar_jewelry_store_footercopyright_color = get_theme_mod('luzuk_alankar_jewelry_store_footercopyright_color');
	if ( $luzuk_alankar_jewelry_store_footercopyright_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' #colophon .site-info p {';
			$luzuk_alankar_jewelry_store_custom_style .=' color: '.esc_attr($luzuk_alankar_jewelry_store_footercopyright_color).' !important;';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_footercopyrightbg_color = get_theme_mod('luzuk_alankar_jewelry_store_footercopyrightbg_color');
	if ( $luzuk_alankar_jewelry_store_footercopyrightbg_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .site-info {';
			$luzuk_alankar_jewelry_store_custom_style .=' background: '.esc_attr($luzuk_alankar_jewelry_store_footercopyrightbg_color).' !important;';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_footerscrolltotoptext_color = get_theme_mod('luzuk_alankar_jewelry_store_footerscrolltotoptext_color');
	if ( $luzuk_alankar_jewelry_store_footerscrolltotoptext_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .back-to-top {';
			$luzuk_alankar_jewelry_store_custom_style .=' color: '.esc_attr($luzuk_alankar_jewelry_store_footerscrolltotoptext_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_footerscrolltotopbg_color = get_theme_mod('luzuk_alankar_jewelry_store_footerscrolltotopbg_color');
	if ( $luzuk_alankar_jewelry_store_footerscrolltotopbg_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .back-to-top {';
			$luzuk_alankar_jewelry_store_custom_style .=' background: '.esc_attr($luzuk_alankar_jewelry_store_footerscrolltotopbg_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_footerscrolltotoptexthover_color = get_theme_mod('luzuk_alankar_jewelry_store_footerscrolltotoptexthover_color');
	if ( $luzuk_alankar_jewelry_store_footerscrolltotoptexthover_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .back-to-top:hover .back-to-top-text {';
			$luzuk_alankar_jewelry_store_custom_style .=' color: '.esc_attr($luzuk_alankar_jewelry_store_footerscrolltotoptexthover_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}

	$luzuk_alankar_jewelry_store_footerscrolltotophover_color = get_theme_mod('luzuk_alankar_jewelry_store_footerscrolltotophover_color');
	if ( $luzuk_alankar_jewelry_store_footerscrolltotophover_color != '') {
		$luzuk_alankar_jewelry_store_custom_style .=' .back-to-top:hover::after {';
			$luzuk_alankar_jewelry_store_custom_style .=' background: '.esc_attr($luzuk_alankar_jewelry_store_footerscrolltotophover_color).';';
		$luzuk_alankar_jewelry_store_custom_style .=' }';
	}
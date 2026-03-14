<?php

class Whizzie {

	public function __construct() {
		$this->init();
	}

	public function init()
	{
	
	}

	public static function home_control_system_setup_widgets(){

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

	set_theme_mod( 'home_control_system_header_button_text', 'Book A Free Demo' );
	set_theme_mod( 'home_control_system_header_button_url', '#' );

	$home_control_system_product_image_gallery = array();
	$home_control_system_product_ids = array();

	$home_control_system_product_category= array(
		'Products'       => array(
			'Smart Smoke Detector',
			'Smart Ceiling Fan',
			'Smart Voice Assistants',
			'Smart Switch Panel',
		),
	);
	$home_control_system_k = 1;
	foreach ( $home_control_system_product_category as $home_control_system_product_cats => $home_control_system_products_name ) { 
	
	$content = 'This is sample product category';
	$home_control_system_parent_category	=	wp_insert_term(
	$home_control_system_product_cats, 
	'product_cat', 
		array(
		'description'=> $content,
		'slug' => str_replace( ' ', '-', $home_control_system_product_cats)
		)
	);

	$home_control_system_n=1;
	foreach ( $home_control_system_products_name as $key => $home_control_system_product_title ) {
	$content = '
		<div class="main_content">
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		</div>';

	$home_control_system_my_post = array(
		'post_title'    => wp_strip_all_tags( $home_control_system_product_title ),
		'post_content'  => $content,
		'post_status'   => 'publish',
		'post_type'     => 'product',
		'post_category' => [$home_control_system_parent_category['term_id']]
	);

	$home_control_system_uqpost_id = wp_insert_post($home_control_system_my_post);
	wp_set_object_terms( $home_control_system_uqpost_id, str_replace( ' ', '-', $home_control_system_product_cats), 'product_cat', true );

	$home_control_system_product_price = array('32.36','32.36','32.36','32.36','32.36');
	
	update_post_meta( $home_control_system_uqpost_id, '_price', $home_control_system_product_price[$home_control_system_n-1] );
	array_push( $home_control_system_product_ids,  $home_control_system_uqpost_id );

	$home_control_system_image_url = get_template_directory_uri().'/assets/images/product/'.$home_control_system_product_cats.'/' . str_replace(' ', '_', strtolower($home_control_system_product_title)).'.png';
	$home_control_system_image_name  = $home_control_system_product_title.'.png';
	$home_control_system_upload_dir = wp_upload_dir();
	
	$home_control_system_image_data = file_get_contents(esc_url($home_control_system_image_url));
	
	$unique_file_name = wp_unique_filename($home_control_system_upload_dir['path'], $home_control_system_image_name);
	
	$home_control_system_filename = basename($unique_file_name);

	if (wp_mkdir_p($home_control_system_upload_dir['path'])) {
	$home_control_system_file = $home_control_system_upload_dir['path'].'/'.$home_control_system_filename;
	} else {
	$home_control_system_file = $home_control_system_upload_dir['basedir'].'/'.$home_control_system_filename;
	}
	
	file_put_contents($home_control_system_file, $home_control_system_image_data);
	
	$wp_filetype = wp_check_filetype($home_control_system_filename, null);
	
	$attachment = array(
	'post_mime_type' => $wp_filetype['type'],
	'post_title'     => sanitize_file_name($home_control_system_filename),
	'post_type'      => 'product',
	'post_status'    => 'inherit',
	);

	$home_control_system_attach_id = wp_insert_attachment($attachment, $home_control_system_file, $home_control_system_uqpost_id);

	$attach_data = wp_generate_attachment_metadata($home_control_system_attach_id, $home_control_system_file);

	wp_update_attachment_metadata($home_control_system_attach_id, $attach_data);
	if ( count( $home_control_system_product_image_gallery ) < 3 ) {
		array_push( $home_control_system_product_image_gallery, $home_control_system_attach_id );
	}

	set_post_thumbnail($home_control_system_uqpost_id, $home_control_system_attach_id);
	++$home_control_system_n;
	}
	
	++$home_control_system_k;
	}
	
	$home_control_system_product_image_gallery = implode( ',', $home_control_system_product_image_gallery );
	foreach ( $home_control_system_product_ids as $home_control_system_product_id ) {
	update_post_meta( $home_control_system_product_id, 'home_control_system_product_image_gallery', $home_control_system_product_image_gallery );
	}

	/* Create Menu */
            $home_control_system_menuname  = 'Main Menus';
            $home_control_system_location  = 'main-menu';

            $home_control_system_menu = wp_get_nav_menu_object( $home_control_system_menuname );

            if ( ! $home_control_system_menu ) {
            $home_control_system_menu_id = wp_create_nav_menu( $home_control_system_menuname );

           // Home Page 
			wp_update_nav_menu_item( $home_control_system_menu_id, 0, array(
				'menu-item-title'     => __( 'Home', 'home-control-system' ),
				'menu-item-url'       => home_url( '/' ),
				'menu-item-type'      => 'custom',
				'menu-item-status'    => 'publish',
			) );

			// About Us Page 
			$home_control_system_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'About Us',
			'post_status' => 'publish',
			) );

			if ( $home_control_system_about_id ) {
			wp_update_nav_menu_item( $home_control_system_menu_id, 0, array(
			'menu-item-title'     => 'About Us',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $home_control_system_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}

			// Solution Page 
			$home_control_system_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'Solution',
			'post_status' => 'publish',
			) );

			if ( $home_control_system_about_id ) {
			wp_update_nav_menu_item( $home_control_system_menu_id, 0, array(
			'menu-item-title'     => 'Solution',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $home_control_system_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}

			// Packages Page 
			$home_control_system_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'Packages',
			'post_status' => 'publish',
			) );

			if ( $home_control_system_about_id ) {
			wp_update_nav_menu_item( $home_control_system_menu_id, 0, array(
			'menu-item-title'     => 'Packages',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $home_control_system_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}

			// Contact Us Page 
			$home_control_system_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'Contact Us',
			'post_status' => 'publish',
			) );

			if ( $home_control_system_about_id ) {
			wp_update_nav_menu_item( $home_control_system_menu_id, 0, array(
			'menu-item-title'     => 'contact Us',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $home_control_system_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}

            // Create Shop Page
                $home_control_system_about_title = 'Shop';
                $home_control_system_about_content = 'Lorem ipsum dolor sit amet...';

                $shop_page = get_page_by_path('shop');
                if ( !$shop_page ) {
                    $home_control_system_about = array(
                        'post_type'   => 'page',
                        'post_title'  => $home_control_system_about_title,
                        'post_content'=> $home_control_system_about_content,
                        'post_status' => 'publish',
                        'post_author' => 1,
                        'post_name'   => 'shop' 
                        );
                        $home_control_system_about_id = wp_insert_post($home_control_system_about);
                    } else {
                        $home_control_system_about_id = $shop_page->ID;
                    }

                    wp_update_nav_menu_item($home_control_system_menu_id, 0, array(
                        'menu-item-title'   => __('Shop', 'home-control-system'),
                        'menu-item-classes' => 'shop',
                        'menu-item-object-id' => $home_control_system_about_id,
                        'menu-item-object'  => 'page',
                        'menu-item-type'    => 'post_type',
                        'menu-item-status'  => 'publish'
                    ));
            
			/* Assign Menu Location */
			$home_control_system_locations = get_theme_mod( 'nav_menu_locations', array() );
			$home_control_system_locations[ $home_control_system_location ] = $home_control_system_menu_id;
			set_theme_mod( 'nav_menu_locations', $home_control_system_locations );
		}
    }
}
 
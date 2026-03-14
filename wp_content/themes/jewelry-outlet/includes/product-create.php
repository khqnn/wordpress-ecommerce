<?php

class Whizzie {

	public function __construct() {
		$this->init();
	}

	public function init()
	{
	
	}

	public static function jewelry_outlet_setup_widgets(){

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

	set_theme_mod('jewelry_outlet_social_links_settings', array(
		array(
			"link_text" => "fab fa-instagram",
			"link_url" => "www.instagram.com"
		),
		array(
			"link_text" => "fab fa-twitter",
			"link_url" => "www.twitter.com"
		),
		array(
			"link_text" => "fab fa-youtube",
			"link_url" => "www.youtube.com"
		),
		array(
			"link_text" => "fab fa-linkedin-in",
			"link_url" => "www.linkedin.com"
		)
	));
	
	set_theme_mod( 'jewelry_outlet_header_toptxt', 'Summer sales 15% off! Shop Now!' );
	set_theme_mod( 'jewelry_outlet_header_phone_number_text', 'Call Us' );
	set_theme_mod( 'jewelry_outlet_header_phone_number', '+1234567890' );

	$jewelry_outlet_categories = [
			"EARRINGS" => [
				"description" => "15% OFF",
				"image" => get_template_directory_uri() . '/assets/images/category1.png',
				"products" => [
					["title" => "Earrings", "price" => 2.99, "image" => get_template_directory_uri() . '/assets/images/product1.png']
				]
			],
			"BRACELATE" => [
				"description" => "15% OFF",
				"image" => get_template_directory_uri() . '/assets/images/category2.png',
				"products" => [
					["title" => "Bracelate", "price" => 5.99, "image" => get_template_directory_uri() . '/assets/images/product2.png']
				]
			],
			"NECKLACE" => [
				"description" => "15% OFF",
				"image" => get_template_directory_uri() . '/assets/images/category3.png',
				"products" => [
					["title" => "Necklace", "price" => 2.49, "image" => get_template_directory_uri() . '/assets/images/product3.png']
				]
			],
			"BROOCHES" => [
				"description" => "15% OFF",
				"image" => get_template_directory_uri() . '/assets/images/category4.png',
				"products" => [
					["title" => "Brooches", "price" => 3.99, "image" => get_template_directory_uri() . '/assets/images/product4.png']
				]
			]
		];

		$jewelry_outlet_default_description = "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...";

		foreach ($jewelry_outlet_categories as $jewelry_outlet_cat_name => $jewelry_outlet_cat_data) {
			// Create or get category
			$jewelry_outlet_term = term_exists($jewelry_outlet_cat_name, 'product_cat');
			if (!$jewelry_outlet_term) {
				$jewelry_outlet_term = wp_insert_term($jewelry_outlet_cat_name, 'product_cat', [
					'description' => $jewelry_outlet_cat_data['description']
				]);
			}
			if (is_wp_error($jewelry_outlet_term)) {
				error_log('Error creating category: ' . $jewelry_outlet_term->get_error_message());
				continue;
			}
			$jewelry_outlet_cat_id = (int) $jewelry_outlet_term['term_id'];

			// Add category thumbnail
			$jewelry_outlet_image_id = media_sideload_image($jewelry_outlet_cat_data['image'], 0, null, 'id');
			if (!is_wp_error($jewelry_outlet_image_id)) {
				update_term_meta($jewelry_outlet_cat_id, 'thumbnail_id', $jewelry_outlet_image_id);
			} else {
				error_log("Error loading category image for {$jewelry_outlet_cat_name}: " . $jewelry_outlet_image_id->get_error_message());
			}

			// Create products
			foreach ($jewelry_outlet_cat_data['products'] as $jewelry_outlet_prod) {
				if (!get_page_by_title($jewelry_outlet_prod['title'], OBJECT, 'product')) {
					$jewelry_outlet_post_id = wp_insert_post([
						'post_title' => $jewelry_outlet_prod['title'],
						'post_content' => $jewelry_outlet_default_description,
						'post_status' => 'publish',
						'post_type' => 'product'
					]);

					if (!is_wp_error($jewelry_outlet_post_id)) {
						// Set price
						update_post_meta($jewelry_outlet_post_id, '_regular_price', $jewelry_outlet_prod['price']);
						update_post_meta($jewelry_outlet_post_id, '_price', $jewelry_outlet_prod['price']);

						// Set type
						wp_set_object_terms($jewelry_outlet_post_id, 'simple', 'product_type');

						// Assign to category
						wp_set_object_terms($jewelry_outlet_post_id, [$jewelry_outlet_cat_name], 'product_cat');

						// Set featured image
						$jewelry_outlet_product_image_id = media_sideload_image($jewelry_outlet_prod['image'], $jewelry_outlet_post_id, null, 'id');
						if (!is_wp_error($jewelry_outlet_product_image_id)) {
							set_post_thumbnail($jewelry_outlet_post_id, $jewelry_outlet_product_image_id);
						} else {
							error_log("Product image error for {$jewelry_outlet_prod['title']}: " . $jewelry_outlet_product_image_id->get_error_message());
						}
					}
				}
			}
		}


	/* Create Menu */
            $jewelry_outlet_menuname  = 'Main Menus';
            $jewelry_outlet_location  = 'main-menu';

            $jewelry_outlet_menu = wp_get_nav_menu_object( $jewelry_outlet_menuname );

            if ( ! $jewelry_outlet_menu ) {
            $jewelry_outlet_menu_id = wp_create_nav_menu( $jewelry_outlet_menuname );

           // Home Page 
			wp_update_nav_menu_item( $jewelry_outlet_menu_id, 0, array(
				'menu-item-title'     => __( 'Home', 'jewelry-outlet' ),
				'menu-item-url'       => home_url( '/' ),
				'menu-item-type'      => 'custom',
				'menu-item-status'    => 'publish',
			) );

			// Collection Page 
			$jewelry_outlet_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'Collection',
			'post_status' => 'publish',
			) );

			if ( $jewelry_outlet_about_id ) {
			wp_update_nav_menu_item( $jewelry_outlet_menu_id, 0, array(
			'menu-item-title'     => 'Collection',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $jewelry_outlet_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}

			// Contact Us Page 
			$jewelry_outlet_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'Contact Us',
			'post_status' => 'publish',
			) );

			if ( $jewelry_outlet_about_id ) {
			wp_update_nav_menu_item( $jewelry_outlet_menu_id, 0, array(
			'menu-item-title'     => 'contact Us',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $jewelry_outlet_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}

			// About Us Page 
			$jewelry_outlet_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'About Us',
			'post_status' => 'publish',
			) );

			if ( $jewelry_outlet_about_id ) {
			wp_update_nav_menu_item( $jewelry_outlet_menu_id, 0, array(
			'menu-item-title'     => 'About Us',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $jewelry_outlet_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}

            // Create Shop Page
                $jewelry_outlet_about_title = 'Shop';
                $jewelry_outlet_about_content = 'Lorem ipsum dolor sit amet...';

                $shop_page = get_page_by_path('shop');
                if ( !$shop_page ) {
                    $jewelry_outlet_about = array(
                        'post_type'   => 'page',
                        'post_title'  => $jewelry_outlet_about_title,
                        'post_content'=> $jewelry_outlet_about_content,
                        'post_status' => 'publish',
                        'post_author' => 1,
                        'post_name'   => 'shop' 
                        );
                        $jewelry_outlet_about_id = wp_insert_post($jewelry_outlet_about);
                    } else {
                        $jewelry_outlet_about_id = $shop_page->ID;
                    }

                    wp_update_nav_menu_item($jewelry_outlet_menu_id, 0, array(
                        'menu-item-title'   => __('Shop', 'jewelry-outlet'),
                        'menu-item-classes' => 'shop',
                        'menu-item-object-id' => $jewelry_outlet_about_id,
                        'menu-item-object'  => 'page',
                        'menu-item-type'    => 'post_type',
                        'menu-item-status'  => 'publish'
                    ));
            
			/* Assign Menu Location */
			$jewelry_outlet_locations = get_theme_mod( 'nav_menu_locations', array() );
			$jewelry_outlet_locations[ $jewelry_outlet_location ] = $jewelry_outlet_menu_id;
			set_theme_mod( 'nav_menu_locations', $jewelry_outlet_locations );
		}
    }
}
 
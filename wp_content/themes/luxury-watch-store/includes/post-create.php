<?php

class Whizzie {

	public function __construct() {
		$this->init();
	}

	public function init()
	{
	
	}

	public static function luxury_watch_store_setup_widgets(){


		/* Create Menu */
            $luxury_watch_store_menuname  = 'Main menu';
            $luxury_watch_store_location  = 'main-menu';

            $luxury_watch_store_menu = wp_get_nav_menu_object( $luxury_watch_store_menuname );

            if ( ! $luxury_watch_store_menu ) {
            $luxury_watch_store_menu_id = wp_create_nav_menu( $luxury_watch_store_menuname );

           // Home Page 
			wp_update_nav_menu_item( $luxury_watch_store_menu_id, 0, array(
				'menu-item-title'     => __( 'Home', 'luxury-watch-store' ),
				'menu-item-url'       => home_url( '/' ),
				'menu-item-type'      => 'custom',
				'menu-item-status'    => 'publish',
			) );

			// About Us Page 
			$luxury_watch_store_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'About Us',
			'post_status' => 'publish',
			) );

			if ( $luxury_watch_store_about_id ) {
			wp_update_nav_menu_item( $luxury_watch_store_menu_id, 0, array(
			'menu-item-title'     => 'About Us',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $luxury_watch_store_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}


			// Contact Us Page 
			$luxury_watch_store_about_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_content' => 'We are committed to providing reliable, professional, and result-oriented solutions tailored to meet individual needs. Our goal is to empower people with the right guidance, knowledge, and support to help them make informed decisions for a better future. <br><br> Our mission is to deliver high-quality services with honesty, transparency, and dedication. We focus on understanding client requirements and offering practical solutions that create long-term value. <br><br> With a client-centric approach, experienced professionals, and a commitment to excellence, we ensure every individual receives the attention and guidance they deserve. We believe in building trust through quality service and consistent results.',
			'post_title'  => 'Contact Us',
			'post_status' => 'publish',
			) );

			if ( $luxury_watch_store_about_id ) {
			wp_update_nav_menu_item( $luxury_watch_store_menu_id, 0, array(
			'menu-item-title'     => 'Contact Us',
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $luxury_watch_store_about_id,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			) );
			}

			  // Create Shop Page
                $luxury_watch_store_about_title = 'Shop';
                $luxury_watch_store_about_content = 'Lorem ipsum dolor sit amet...';

                $shop_page = get_page_by_path('shop');
                if ( !$shop_page ) {
                    $luxury_watch_store_about = array(
                        'post_type'   => 'page',
                        'post_title'  => $luxury_watch_store_about_title,
                        'post_content'=> $luxury_watch_store_about_content,
                        'post_status' => 'publish',
                        'post_author' => 1,
                        'post_name'   => 'shop' 
                        );
                        $luxury_watch_store_about_id = wp_insert_post($luxury_watch_store_about);
                    } else {
                        $luxury_watch_store_about_id = $shop_page->ID;
                    }

                    wp_update_nav_menu_item($luxury_watch_store_menu_id, 0, array(
                        'menu-item-title'   => __('Shop', 'luxury-watch-store'),
                        'menu-item-classes' => 'shop',
                        'menu-item-object-id' => $luxury_watch_store_about_id,
                        'menu-item-object'  => 'page',
                        'menu-item-type'    => 'post_type',
                        'menu-item-status'  => 'publish'
                    ));

			/* Assign Menu Location */
			$luxury_watch_store_locations = get_theme_mod( 'nav_menu_locations', array() );
			$luxury_watch_store_locations[ $luxury_watch_store_location ] = $luxury_watch_store_menu_id;
			set_theme_mod( 'nav_menu_locations', $luxury_watch_store_locations );
		}
	}
}
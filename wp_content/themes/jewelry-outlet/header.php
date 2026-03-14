<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jewelry Outlet
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php echo esc_attr(get_bloginfo('html_type')); ?>; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) )
	{
		wp_body_open();
	}else{
		do_action('wp_body_open');
	}
?>
<?php 
if( get_theme_mod('jewelry_outlet_preloader_hide', false ) == true ){ 

	$jewelry_outlet_type = get_theme_mod('jewelry_outlet_preloader_type','diamond');
?>

<div class="frame">
	<div class="loader preloader-types">

		<?php if($jewelry_outlet_type == 'diamond'){ ?>

			<div class="preloader">
				<div class="diamond">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>

		<?php } elseif($jewelry_outlet_type == 'orbit'){ ?>

			<div class="orbit-loader">
				<div class="orbit-center"></div>
				<div class="orbit-ring">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>

		<?php } elseif($type == 'liquid'){ ?>

			<div class="liquid-loader">
				<div class="liquid-blob"></div>
			</div>

		<?php } ?>

	</div>
</div> 

<?php } ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'jewelry-outlet' ); ?></a>

<header id="site-navigation" class="header text-center text-md-start">
	<div class="upperheader">
		<div class="container">
			<div class="row">
				<div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 align-self-center">
					<?php $jewelry_outlet_settings = get_theme_mod( 'jewelry_outlet_social_links_settings' ); ?>
					<div class="social-links text-lg-start">
						<?php if ( is_array($jewelry_outlet_settings) || is_object($jewelry_outlet_settings) ){ ?>
							<?php foreach( $jewelry_outlet_settings as $jewelry_outlet_setting ) { ?>
								<a href="<?php echo esc_url( $jewelry_outlet_setting['link_url'] ); ?>" target="_blank">
									<i class="<?php echo esc_attr( $jewelry_outlet_setting['link_text'] ); ?> me-2"></i>
								</a>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<div class="col-xl-6 col-lg-5 col-md-4 col-sm-12 align-self-center">
					<?php if ( get_theme_mod('jewelry_outlet_header_toptxt') ) : ?>
						<p class="mb-0 adv-text"><?php echo esc_html( get_theme_mod('jewelry_outlet_header_toptxt' ) ); ?></p>
					<?php endif; ?>
				</div>
				<?php if ( get_theme_mod('jewelry_outlet_gtranslate', 'on' ) == 'on' ) : ?>
					<div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 align-self-center text-lg-end text-center">
						<?php if(class_exists('GTranslate')){ ?>
						   <div class="translate-lang">
							  <?php echo do_shortcode( '[gtranslate]' );?>
						    </div>
						<?php } ?>	
					</div>
				<?php endif; ?>
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 text-lg-end text-center align-self-center">
					<?php if( get_theme_mod( 'jewelry_outlet_currency_switcher', true) != '') { ?>
						<?php if(class_exists('woocommerce')){ ?>
							<div class="currency-box">
								<?php echo do_shortcode('[woocs show_flags=0 txt_type="desc" style=3]'); ?>
							</div>
						<?php } ?>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<div class="middleheader">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 align-self-center my-2">
					<div class="logo text-center text-md-start mb-3 mb-lg-0">
			    		<div class="logo-image">
			    			<?php the_custom_logo(); ?>
				    	</div>
				    	<div class="logo-content">
							<?php
								if ( get_theme_mod('jewelry_outlet_display_header_title', true) == true ) :
									echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
									echo esc_html(get_bloginfo('name'));
									echo '</a>';
								endif;
								if ( get_theme_mod('jewelry_outlet_display_header_text', false) == true ) :
									echo '<span>'. esc_html(get_bloginfo('description')) . '</span>';
								endif;
							?>
						</div>
					</div>
			   	</div>
				<div class="col-lg-6 col-md-5 col-sm-12 align-self-center">
					<?php if( get_theme_mod( 'jewelry_outlet_disable_search_icon', 'on' ) ){ ?>
						<div class="search-box d-flex justify-content-center justify-content-md-end">
							<?php if(class_exists('woocommerce')){
								get_product_search_form();
							} ?>
						</div>
					<?php } ?>
				</div>
			   	<div class="col-lg-3 col-md-4 col-sm-12 align-self-center text-lg-end py-4">
					<div class="cart">
						<?php if ( get_theme_mod('jewelry_outlet_cart_box_enable', 'on' ) == true ) : ?>
							<?php if ( class_exists( 'woocommerce' ) ) {?>
								<a class="cart-customlocation" href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'View Shopping Cart','jewelry-outlet' ); ?>"><i class="fa-solid fa-cart-shopping me-2"></i></a>
							<?php }?>
						<?php endif; ?>
					</div>
					<div class=" wish-list">
						<?php if(class_exists('woocommerce')){ ?>
							<?php if(defined('YITH_WCWL')){ ?>
								<div class="wishlist-icon">
									<a class="wishlist_view" href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>" title="<?php esc_attr_e('Wishlist','jewelry-outlet'); ?>"><i class="fas fa-heart me-2"></i></i></a>
								</div>
							<?php }?>
						<?php }?>
					</div>
					<div class=" my-account">
						<?php if(class_exists('woocommerce')){ ?>
							<?php if ( is_user_logged_in() ) { ?>
								<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','jewelry-outlet'); ?>"><i class="fas fa-user me-2"></i></a>
							<?php }
							else { ?>
								<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','jewelry-outlet'); ?>"><i class="fas fa-sign-in-alt me-2"></i></a>
							<?php } ?>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="topheader py-2 <?php if( get_theme_mod( 'jewelry_outlet_sticky_header',false) != '') { ?>sticky-header<?php } else { ?>close-sticky <?php } ?>">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 align-self-center pro-drop-btn">
					<?php if(class_exists('woocommerce')): ?>
					<div class=" position-relative product-button-width">
						<button class="product-btn"><?php esc_html_e('All Collection','jewelry-outlet'); ?><i class="fa-solid fa-caret-down ms-5"></i></button>
						<div class="product-cat">
							<?php
							$args = array(
								'orderby'    => 'title',
								'order'      => 'ASC',
								'hide_empty' => 0,
								'parent'  => 0
							);
							$jewelry_outlet_product_categories = get_terms( 'product_cat', $args );
							$jewelry_outlet_count = count($jewelry_outlet_product_categories);
							if ( $jewelry_outlet_count > 0 ){
								foreach ( $jewelry_outlet_product_categories as $jewelry_outlet_product_category ) {
									$jewelry_outlet_product_cat_id   = $jewelry_outlet_product_category->term_id;
									$cat_link = get_category_link( $jewelry_outlet_product_cat_id );
									if ($jewelry_outlet_product_category->category_parent == 0) { ?>
								<li class="drp_dwn_menu"><a href="<?php echo esc_url(get_term_link( $jewelry_outlet_product_category ) ); ?>">
								<?php
								}
								echo esc_html( $jewelry_outlet_product_category->name ); ?></a><i class="fas fa-chevron-right"></i></li>
							<?php } } ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="col-xl-7 col-lg-6 col-md-6 col-sm-3 col-3 align-self-center">
					<button class="menu-toggle py-0 mx-auto my-2" aria-controls="top-menu" aria-expanded="false" type="button">
						<span aria-hidden="true"><i class="fa-solid fa-bars"></i></span>
					</button>
					<nav id="main-menu" class="close-panal">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'main-menu',
								'container' => false
							));
						?>
						<button class="close-menu my-2 p-2" type="button">
							<span aria-hidden="true"><i class="fa fa-times"></i></span>
						</button>
					</nav>
				</div>
				<div class="col-xl-2 col-lg-3 col-md-3 col-sm-9 col-9 align-self-center phone-number text-center text-md-end">
					<?php if ( get_theme_mod('jewelry_outlet_header_phone_number') || get_theme_mod('jewelry_outlet_header_phone_number_text') ) : ?>
						<div class="row header-icon">
							<div class="col-lg-3 col-md-3 col-sm-2 col-2 align-self-center px-1 text-end">
								<a href="tel:<?php echo esc_attr( get_theme_mod('jewelry_outlet_header_phone_number' ) ); ?>"><i class="fa-solid fa-phone"></i></a>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-10 col-10 align-self-center px-1 header-icon-inner">
								<p class="mb-0 text-start"><?php echo esc_html( get_theme_mod('jewelry_outlet_header_phone_number_text' ) ); ?></p>
								<a class="text-start" href="tel:<?php echo esc_attr( get_theme_mod('jewelry_outlet_header_phone_number' ) ); ?>"><h6 class="mb-0"><?php echo esc_html( get_theme_mod('jewelry_outlet_header_phone_number' ) ); ?></h6></a>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
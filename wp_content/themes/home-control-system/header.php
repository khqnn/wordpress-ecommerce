<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Home Control System
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
if( get_theme_mod('home_control_system_preloader_hide', false ) == true ){ 

	$home_control_system_type = get_theme_mod('home_control_system_preloader_type','diamond');
?>
<div class="frame">
	<div class="loader preloader-types">

		<?php if($home_control_system_type == 'diamond'){ ?>

			<div class="preloader">
				<div class="diamond">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>

		<?php } elseif($home_control_system_type == 'orbit'){ ?>

			<div class="orbit-loader">
				<div class="orbit-center"></div>
				<div class="orbit-ring">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>

		<?php } elseif($home_control_system_type == 'liquid'){ ?>

			<div class="liquid-loader">
				<div class="liquid-blob"></div>
			</div>

		<?php } ?>

	</div>
</div>
<?php } ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'home-control-system' ); ?></a>

<header id="site-navigation" class="header <?php if( get_theme_mod( 'home_control_system_sticky_header',false) != '') { ?>sticky-header<?php } else { ?>close-sticky <?php } ?>">
	<div class="container py-3">
		<div class="row header-inner">
			<div class="col-xl-2 col-lg-2 col-md-2 col-9 align-self-center">
				<div class="logo text-start">
					<div class="logo-image text-start">
						<?php the_custom_logo(); ?>
					</div>
					<div class="logo-content text-start">
						<?php
							if ( get_theme_mod('home_control_system_display_header_title', true) == true ) :
								echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
								echo esc_attr(get_bloginfo('name'));
								echo '</a>';
							endif;
							if ( get_theme_mod('home_control_system_display_header_text', false) == true ) :
								echo '<span>'. esc_attr(get_bloginfo('description')) . '</span>';
							endif;
						?>
					</div>
				</div>
			</div>
			<div class="col-xl-7 col-lg-6 col-md-6 col-3 align-self-center">
				<button class="menu-toggle mx-auto" aria-controls="top-menu" aria-expanded="false" type="button">
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
			<div class="col-xl-3 col-lg-4 col-md-4 col-12 align-self-center px-sm-0 px-2 py-md-0 py-2">
				<div class="header-buttons d-flex justify-content-between justify-content-md-end gap-4 align-items-center">
					<div class="wislist-cart-search d-flex justify-content-between justify-content-md-end gap-2 align-items-center">
						<?php if(class_exists('woocommerce')){ ?>
							<?php if ( get_theme_mod('home_control_system_cart_enable_setting', true)) : ?>
								<div class="cart-icon"><a class="cart-customlocation" href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'View Shopping Cart','home-control-system' ); ?>"><i class="fa-solid fa-cart-shopping"></i></a></div>
							<?php endif; ?>
						<?php }?>
					</div>
					<?php if ( get_theme_mod('home_control_system_header_button_url')) : ?>
						<div class="join-btn">
							<a href="<?php echo esc_url( get_theme_mod('home_control_system_header_button_url' ) ); ?>"><?php echo esc_html( get_theme_mod('home_control_system_header_button_text') ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
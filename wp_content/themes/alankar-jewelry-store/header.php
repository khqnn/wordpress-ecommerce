<?php
/**
 * The header for our theme
 *
 * @subpackage Alankar Jewelry Store
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>

<script type="text/javascript">
		
var resizeElements;

$(document).ready(function() {

  // Set up common variables
  // --------------------------------------------------

  var bar = ".search_bar";
  var input = bar + " input[type='text']";
  var button = bar + " button[type='submit']";
  var dropdown = bar + " .search_dropdown";
  var dropdownLabel = dropdown + " > span";
  var dropdownList = dropdown + " ul";
  var dropdownListItems = dropdownList + " li";


  // Set up common functions
  // --------------------------------------------------

  resizeElements = function() {
    var barWidth = $(bar).outerWidth();

    var labelWidth = $(dropdownLabel).outerWidth();
    $(dropdown).width(labelWidth);

    var dropdownWidth = $(dropdown).outerWidth();
    var buttonWidth	= $(button).outerWidth();
    var inputWidth = barWidth - dropdownWidth - buttonWidth;
    var inputWidthPercent = inputWidth / barWidth * 100 + "%";

    $(input).css({ 'margin-left': dropdownWidth, 'width': inputWidthPercent });
  }

  function dropdownOn() {
    $(dropdownList).fadeIn(25);
    $(dropdown).addClass("active");
  }

  function dropdownOff() {
    $(dropdownList).fadeOut(25);
    $(dropdown).removeClass("active");
  }


  // Initialize initial resize of initial elements 
  // --------------------------------------------------
  resizeElements();


  // Toggle new dropdown menu on click
  // --------------------------------------------------

  $(dropdown).click(function(event) {
    if ($(dropdown).hasClass("active")) {
      dropdownOff();
    } else {
      dropdownOn();
    }

    event.stopPropagation();
    return false;
  });

  $("html").click(dropdownOff);


  // Activate new dropdown option and show tray if applicable
  // --------------------------------------------------

  $(dropdownListItems).click(function() {
    $(this).siblings("li.selected").removeClass("selected");
    $(this).addClass("selected");

    // Focus the input
    $(this).parents("form.search_bar:first").find("input[type=text]").focus();

    var labelText = $(this).text();
    $(dropdownLabel).text(labelText);

    resizeElements();

  });


  // Resize all elements when the window resizes
  // --------------------------------------------------

  $(window).resize(function() {
    resizeElements();
  });
});
</script>
</head>


<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<a class="screen-reader-text skip-link" href="#skip-content"><?php esc_html_e( 'Skip to content', 'alankar-jewelry-store' ); ?></a>
<div id="header">
	<div class="main-header">
		<div class="tphead">		
			<div class="container">
				<div class="row m-0">
					<div class="emph">			
						<a> <i class="fa fa-map-marker" aria-hidden="true"></i> <span><?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_header_locationtext','Find a Store')); ?> </span></a>
					</div>
					<div class="trsp">
						<div class="s-media">
							<li>
								<?php 
									$twitter_link = get_theme_mod('luzuk_alankar_jewelry_store_twitterlink', '#');
									if ($twitter_link) { 
									?>
										<a href="<?php echo esc_html($twitter_link); ?>">
											<i class="fab fa-twitter"></i>
										</a>
								<?php } ?>
							</li> 

							<li>
								<?php 
									$fb_link = get_theme_mod('luzuk_alankar_jewelry_store_fblink', '#');
									if ($fb_link) { 
									?>
										<a href="<?php echo esc_html($fb_link); ?>">
											<i class="fab fa-facebook-f"></i>
										</a>
								<?php } ?>
							</li>
							
							<li>
								<?php 
									$instagram_link = get_theme_mod('luzuk_alankar_jewelry_store_instagramlink', '#');
									if ($instagram_link) { 
									?>
										<a href="<?php echo esc_html($instagram_link); ?>">
											<i class="fab fa-instagram"></i>
										</a>
								<?php } ?>
							</li>
							<li>
								<?php 
									$youtube_link = get_theme_mod('luzuk_alankar_jewelry_store_youtubelink', '#');
									if ($youtube_link) { 
									?>
										<a href="<?php echo esc_html($youtube_link); ?>">
											<i class="fab fa-youtube"></i>
										</a>
								<?php } ?>
							</li>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="top-head">
			<div class="container">
				<div class="row m-0">			
					<div class="logo ">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php endif; ?>
						<?php if (get_theme_mod('luzuk_alankar_jewelry_store_show_site_title',true)) {?>
							<?php $blog_info = get_bloginfo( 'name' ); ?>
							<?php if ( ! empty( $blog_info ) ) : ?>
								<?php if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php endif; ?>
							<?php endif; ?>
						<?php }?>
						<?php if (get_theme_mod('luzuk_alankar_jewelry_store_show_tagline',true)) {?>
							<?php $description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo esc_html($description); ?></p>
							<?php endif; ?>
						<?php }?>
					</div>	
					
					<div class="m-head">
						<div class="s-frmbx">
							<div class="s-frm">
								<form class="search_bar huge">
									<?php get_search_form(); ?>
								</form>
							</div>
						</div>
					</div>	
	
					<div class="phonenumber">
						<i class="fa fa-phone"></i> <strong><?php echo esc_html('Hotline:','alankar-jewelry-store'); ?></strong>
						 <a href="tel:<?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_header_phonenumber', '123-456-789')); ?>">
							<span class="tooltiptext"><?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_header_phonenumber', '123-456-789')); ?></span>
						</a>
						<p><?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_header_phonetext', 'Pickup your order for free')); ?></p>
					</div>

					<div class="acc">
						<div class="row mks ">
							<div class="top-form">
								<button type="button" id="formButton"></button>       
								<form id="form1">
									<?php get_search_form(); ?>
								</form>
							</div>
							<div class="signinregister">
								<div class="signinregisterinnbx">
								<?php if ( class_exists( 'WooCommerce' ) ) { ?>
									<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
										<p> <i class="fas fa-user"></i></p>
									</a>
								<?php } ?>
								</div>
							</div>

							<div class="cartbtn">
								<?php if(class_exists('woocommerce')){ ?>
									<div class="cart">
										<div class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></div> 
										<a class="cart-contents" href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>"> <i class="fas fa-shopping-bag"></i>
										</a>
										<!-- <li class="cart_box">
											<span class="cart-value"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
										</li> -->
									</div>
								<?php }?>
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="m-div">
		<div class="container">
			<div class="row m-0">
				<div class="menu">
					<div class="header-inner section-inner">
						<div class="header-titles-wrapper">
							<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
								<span class="toggle-inner">
									<span class="toggle-icon">
										<i class="fas fa-bars"></i>
									</span>
									<!-- <span class="toggle-text"><//?php _e( 'Menu', 'alankar-jewelry-store' ); ?></span> -->
								</span>
							</button><!-- .nav-toggle -->
						</div><!-- .header-titles-wrapper -->

						<div class="header-navigation-wrapper">
							<?php
							if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
								?>
								<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'alankar-jewelry-store' ); ?>">
									<ul class="primary-menu reset-list-style">
										<?php
										if ( has_nav_menu( 'primary' ) ) {

											wp_nav_menu(
												array(
													'container'  => '',
													'items_wrap' => '%3$s',
													'theme_location' => 'primary',
												)
											);

										} elseif ( ! has_nav_menu( 'expanded' ) ) {

											wp_list_pages(
												array(
													'match_menu_classes' => true,
													'show_sub_menu_icons' => true,
													'title_li' => false,
													'walker'   => new Alankar_Jewelry_Store_Walker_Page(),
												)
											);

										}
										?>
									</ul>
								</nav><!-- .primary-menu-wrapper -->
							<?php } ?>
						</div><!-- .header-navigation-wrapper -->
					</div><!-- .header-inner -->
					<?php
						// Output the menu modal.
						get_template_part( '/inc/modal-menu' );
					?>
				</div>	
				<div class="offertext">
					<p>
						<i class="fas fa-fire"></i> <span><?php echo esc_html('Extra','alankar-jewelry-store'); ?></span>
						<b><?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_header_offertext', "Sale 30% off")); ?></b>
					</p>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>

<?php if(is_singular()) {?>
	<div id="inner-pages-header">
		<div class="header-overlay"></div>
	    <div class="header-content">
		    <div class="container"> 
		      	<h1><?php single_post_title(); ?></h1>
		      	<div class="innheader-border"></div>
		      	<div class="theme-breadcrumb mt-2">
					<?php luzuk_alankar_jewelry_store_breadcrumb();?>
				</div>
		    </div>
		</div>
	</div>
<?php } ?>
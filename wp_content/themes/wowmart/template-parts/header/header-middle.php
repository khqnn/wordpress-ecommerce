<?php

/**
 * Template part for displaying header middle
 *
 * @link https://wpthemespace.com/product/wowmart
 *
 * @package WowMart 
 */
$wowmart_logo_position = get_theme_mod('wowmart_logo_position', 'left');
$wowmart_himg_height = get_theme_mod('wowmart_himg_height', 'fixed');
$wowmart_head_cart_show = get_theme_mod('wowmart_head_cart_show', 1);
$wowmart_mhead_menu_show = get_theme_mod('wowmart_mhead_menu_show', 1);

?>
<div class="wowmart-header-middle">
	<div class="site-branding logo-<?php echo esc_attr($wowmart_logo_position); ?>">
		<div class="container py-3">
			<div class="row align-items-center g-3">
				<?php if (class_exists('WooCommerce') && $wowmart_head_cart_show) : ?>
					<div class="col-9 col-lg-4 col-lg-auto">
					<?php else : ?>
						<div class="col-12">
						<?php endif; ?>
						<div class="headerlogo-text text-<?php echo esc_attr($wowmart_logo_position); ?>">
							<?php the_custom_logo(); ?>
							<?php if (display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
								<?php
								$wowmart_description = get_bloginfo('description', 'display');
								if ($wowmart_description || is_customize_preview()) :
								?>
									<p class="site-description">
										<?php echo esc_html($wowmart_description); ?>
									</p>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						</div>

						<?php if ($wowmart_mhead_menu_show): ?>
							<div class="col-12 col-lg order-3 order-lg-2 wowmart-main-nav">
								<div class="wowmart-main-menu">
									<nav id="site-navigation" class="main-navigation">
										<?php
										if (has_nav_menu('main-menu')) {
											wp_nav_menu(
												array(
													'theme_location' => 'main-menu',
													'menu_id'        => 'primary-menu',
													'menu_class'     => 'wowmart-main-menu-container',
												)
											);
										} elseif (!has_nav_menu('expanded')) { ?>
											<ul id="primary-menu" class="menu nav-menu">
												<?php
												wp_list_pages(
													array(
														'match_menu_classes' => true,
														'show_sub_menu_icons' => true,
														'title_li' => false,
													)
												);
												?>
											</ul>
										<?php
										}
										?>
									</nav><!-- #site-navigation -->
								</div>
							</div>
						<?php endif; ?>

						<?php if (class_exists('WooCommerce') && $wowmart_head_cart_show) : ?>
							<div class="col-3 col-md-auto order-2 order-lg-3 ms-auto">
								<div class="hmiddle-right">
									<?php wowmart_woo_action_icons(); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
			</div><!-- .site-branding -->
		</div>
	</div>
</div>
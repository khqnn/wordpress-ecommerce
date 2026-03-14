<?php

/**
 * Template part for displaying header top bar
 *
 * @link https://wpthemespace.com/product/wowmart
 *
 * @package WowMart 
 */
$wowmart_topbar_mtext = get_theme_mod('wowmart_topbar_mtext', esc_html__('Welcome to Our Website !', 'wowmart'));
$wowmart_topbar_menushow = get_theme_mod('wowmart_topbar_menushow', 1);

$wowmart_topbar_search_item = get_theme_mod('wowmart_topbar_search_item', 'simple');


?>

<div class="wowmart-tophead bg-light text-dark <?php if ($wowmart_topbar_search_item == 'simple') : ?>has-search pt-1 pb-1<?php else : ?>pt-2 pb-2<?php endif; ?>">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-sm-auto mb-2 mb-sm-0">
				<?php if (class_exists('WooCommerce')) {
					wowmart_shop_by_department();
				} ?>
			</div>

			<?php if ($wowmart_topbar_mtext) : ?>
				<div class="col-12 col-sm-auto mb-2 mb-sm-0">
					<span class="bhtop-text pt-2"><?php echo esc_html($wowmart_topbar_mtext); ?></span>
				</div>
			<?php endif; ?>

			<?php if ($wowmart_topbar_search_item != 'hide' || ($wowmart_topbar_menushow && has_nav_menu('btop-menu'))) : ?>
				<div class="col-12 col-lg-auto ms-auto ml-auto">
					<div class="topmenu-serch bsearch-<?php echo esc_attr($wowmart_topbar_search_item); ?>">
						<?php if ($wowmart_topbar_menushow && has_nav_menu('btop-menu')) : ?>
							<div class="top-menu list-hide text-dark">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'btop-menu',
										'menu_id'        => 'btop-menu',
										'menu_class'     => 'btop-menu',
										'depth'          => 1,
										'fallback_cb'    => false,
									)
								);
								?>
							</div>
						<?php endif; ?>
						<?php if ($wowmart_topbar_search_item == 'simple') : ?>
							<div class="header-top-search">
								<?php get_search_form(); ?>
							</div>
						<?php endif; ?>
						<?php if ($wowmart_topbar_search_item == 'popup') : ?>
							<div class="besearch-icon">
								<a href="#" id="besearch"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<circle cx="11" cy="11" r="8"></circle>
										<path d="m21 21-4.35-4.35"></path>
									</svg></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>

<?php if ($wowmart_topbar_search_item == 'popup') : ?>
	<div id="bspopup" class="off">
		<div id="bessearch" class="open">
			<button data-widget="remove" id="removeClass" class="close" type="button">×</button>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>
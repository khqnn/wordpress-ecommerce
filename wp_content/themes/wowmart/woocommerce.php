<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wowmart
 */
$wowmart_breadcrump_show = get_theme_mod('wowmart_breadcrump_show', 1);
$wowmart_breadcrump_position = get_theme_mod('wowmart_breadcrump_position', 'left');
$wowmart_shopbanner_show = get_theme_mod('wowmart_shopbanner_show');
$wowmart_banner_subtext = get_theme_mod('wowmart_banner_subtext');
$wowmart_banner_title = get_theme_mod('wowmart_banner_title');
$wowmart_banner_desc = get_theme_mod('wowmart_banner_desc');
$wowmart_banner_btn = get_theme_mod('wowmart_banner_btn', esc_html__('Shop Now', 'wowmart'));
$wowmart_banner_url = get_theme_mod('wowmart_banner_url', '#');
$wowmart_text_position = get_theme_mod('wowmart_text_position', 'left');
$wowmart_banner_overlay = get_theme_mod('wowmart_banner_overlay');
$wowmart_shop_container = get_theme_mod('wowmart_shop_container', 'container');
$wowmart_shop_layout = get_theme_mod('wowmart_shop_layout', 'fullwidth');
$wowmart_shop_style = get_theme_mod('wowmart_shop_style', '1');
if (is_active_sidebar('shop-sidebar') && $wowmart_shop_layout != 'fullwidth') {
	$wowmart_column_set = 'col-lg-9';
} else {
	$wowmart_column_set = 'col-lg-12';
}
get_header();

?>
<?php if ($wowmart_shopbanner_show && is_shop()) : ?>
	<?php
	$has_banner_image = get_theme_mod('wowmart_shopb_img');
	$default_title = $wowmart_banner_title ? $wowmart_banner_title : esc_html__('Premium Shopping Experience', 'wowmart');
	$default_subtitle = $wowmart_banner_subtext ? $wowmart_banner_subtext : esc_html__('Modern eCommerce Solution', 'wowmart');
	$default_desc = $wowmart_banner_desc ? $wowmart_banner_desc : esc_html__('Discover exceptional quality products with our cutting-edge shopping platform. Enjoy seamless browsing, secure checkout, and outstanding customer service.', 'wowmart');
	$banner_class = $has_banner_image ? 'wowmart-banner bg-overlay has-image' : 'wowmart-banner default-banner';
	?>
	<div class="<?php echo esc_attr($banner_class); ?>">
		<div class="container">
			<div class="align-items-center h-100">
				<div class="bbanner-text text-<?php echo esc_attr($wowmart_text_position); ?>">
					<div class="banner-content">
						<?php if ($default_subtitle) : ?>
							<h4 class="banner-subtitle"><?php echo esc_html($default_subtitle); ?></h4>
						<?php endif; ?>

						<?php if ($default_title) : ?>
							<h1 class="banner-title"><?php echo esc_html($default_title); ?></h1>
						<?php endif; ?>

						<?php if ($default_desc) : ?>
							<div class="banner-description">
								<?php echo wp_kses_post($default_desc); ?>
							</div>
						<?php endif; ?>

						<?php if ($wowmart_banner_url) : ?>
							<div class="bsbanner-btn">
								<a href="<?php echo esc_url($wowmart_banner_url); ?>" class="btn btn-primary wowmart-btn">
									<?php echo esc_html($wowmart_banner_btn); ?>
									<svg class="btn-icon ms-2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
										<path d="M5 12h14m-7-7l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<?php if (!$has_banner_image) : ?>
					<div class="d-none d-lg-block">
						<div class="banner-graphic">
							<div class="graphic-elements">
								<div class="graphic-circle circle-1"></div>
								<div class="graphic-circle circle-2"></div>
								<div class="graphic-circle circle-3"></div>
								<div class="graphic-shape shape-1"></div>
								<div class="graphic-shape shape-2"></div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ($wowmart_banner_overlay && $has_banner_image) : ?>
			<div class="overlay-banner"></div>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php if ($wowmart_breadcrump_show && !(is_front_page() && is_shop())) : ?>
	<div class="wowmart-wbreadcrump text-<?php echo esc_attr($wowmart_breadcrump_position); ?>">
		<div class="<?php echo esc_attr($wowmart_shop_container); ?>">
			<?php woocommerce_breadcrumb(); ?>
		</div>
	</div>
<?php endif; ?>
<div class="<?php echo esc_attr($wowmart_shop_container); ?> mt-3 mb-5 pt-5 pb-3">
	<div class="row">
		<?php if (is_active_sidebar('shop-sidebar') && $wowmart_shop_layout == 'leftside') : ?>
			<div class="col-lg-3">
				<aside id="secondary" class="widget-area shop-sidebar">
					<?php dynamic_sidebar('shop-sidebar'); ?>
				</aside><!-- #secondary -->
			</div>
		<?php
		endif; ?>
		<div class="<?php echo esc_attr($wowmart_column_set); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main bstyle<?php echo esc_attr($wowmart_shop_style); ?>">

					<?php woocommerce_content(); ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- #primary -->
		<?php if (is_active_sidebar('shop-sidebar') && $wowmart_shop_layout == 'rightside') : ?>
			<div class="col-lg-3">
				<aside id="secondary" class="widget-area shop-sidebar">
					<?php dynamic_sidebar('shop-sidebar'); ?>
				</aside><!-- #secondary -->
			</div>
		<?php
		endif; ?>
	</div>
</div>
<?php
get_footer();

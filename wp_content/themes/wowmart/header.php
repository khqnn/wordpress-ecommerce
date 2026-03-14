<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WowMart 
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'wowmart'); ?></a>
		<?php
		$wowmart_topbar_show = get_theme_mod('wowmart_topbar_show', 1);
		$wowmart_mhead_show = get_theme_mod('wowmart_mhead_show', 1);
		$wowmart_main_menu_show = get_theme_mod('wowmart_main_menu_show');
 
		?>
		<header id="masthead" class="wowmart-header site-header">
			<?php if (has_header_image()) : ?>
				<div class="wowmart-headerimg-top">
					<?php the_header_image_tag(); ?>
				</div>
			<?php endif; ?>
			<?php
			do_action('wowmart_mobile_menu');

			if ($wowmart_topbar_show) {
				get_template_part('template-parts/header/header-top');
			}
			if ($wowmart_mhead_show) {
				get_template_part('template-parts/header/header-middle');
			}
			if ($wowmart_main_menu_show) {
				get_template_part('template-parts/header/header-main-menu');
			}


			?>


		</header><!-- #masthead -->
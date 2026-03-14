<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WowMart 
 */
$wowmart_topfooter_show = get_theme_mod('wowmart_topfooter_show', 1);

?>
<?php if (is_active_sidebar('footer-widget') && $wowmart_topfooter_show) : ?>
	<div class="footer-top mt-5 pb-5 pt-5 bg-light">
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar('footer-widget') ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<footer id="colophon" class="site-footer text-center">
	<div class="site-info finfo">
		<a href="<?php echo esc_url(esc_html__('https://wordpress.org/', 'wowmart')); ?>">
			<?php esc_html_e('Powered by WordPress', 'wowmart'); ?>
		</a>

		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf(esc_html__('Theme: %1$s by %2$s.', 'wowmart'), 'WowMart', '<a href="https://wpthemespace.com/product/wowmart/">wp theme space</a>');
		?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>

</html>
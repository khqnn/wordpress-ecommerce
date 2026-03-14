<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WowMart 
 */
$wowmart_blog_style = get_theme_mod('wowmart_blog_style', 'grid');
if ($wowmart_blog_style == 'grid' && !is_single()) :
	get_template_part('template-parts/content', 'grid');
else :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if (is_single() || is_sticky()) : ?>
			<?php get_template_part('template-parts/content', 'single'); ?>
		<?php else : ?>
			<?php get_template_part('template-parts/content', 'blog'); ?>
		<?php endif; ?>

	</article><!-- #post-<?php the_ID(); ?> -->
<?php endif; ?>
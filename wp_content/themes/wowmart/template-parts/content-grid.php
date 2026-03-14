<?php
/*
*
* The file for display blog content for WowMart theme
*
*/
$wowmart_blogdate = get_theme_mod('wowmart_blogdate', 1);
$wowmart_blogauthor = get_theme_mod('wowmart_blogauthor', 1);
$wowmart_blog_readmore = get_theme_mod('wowmart_blog_readmore', esc_html__('Read More', 'wowmart'));

// Get post categories
$categories = get_the_category();
$category_name = !empty($categories) ? $categories[0]->name : '';

?>
<div class="col-12 col-sm-6 col-lg-4 mb-4">
	<article class="blog-grid-card">
		<?php if (has_post_thumbnail()) : ?>
			<div class="blog-card-image">
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<?php wowmart_post_thumbnail(); ?>
				</a>
				<?php if ($category_name) : ?>
					<span class="blog-category-badge"><?php echo esc_html($category_name); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="blog-card-content">
			<div class="blog-card-header">
				<h2 class="blog-card-title">
					<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
				</h2>

				<div class="blog-card-excerpt">
					<?php the_excerpt(); ?>
				</div>
			</div>

			<div class="blog-card-footer">
				<div class="blog-card-meta">
					<?php if ($wowmart_blogauthor) : ?>
						<div class="blog-author">
							<?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
							<span class="author-name"><?php echo esc_html(get_the_author()); ?></span>
						</div>
					<?php endif; ?>
					<?php if ($wowmart_blogdate) : ?>
						<span class="blog-date-separator">•</span>
						<time class="blog-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
							<?php echo esc_html(get_the_date()); ?>
						</time>
					<?php endif; ?>
				</div>

				<a href="<?php echo esc_url(get_permalink()); ?>" class="blog-read-more" aria-label="<?php echo esc_attr(sprintf(__('Read more about %s', 'wowmart'), get_the_title())); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 16 16 12 12 8"></polyline>
						<line x1="8" y1="12" x2="16" y2="12"></line>
					</svg>
				</a>
			</div>
		</div>
	</article>
</div>
<?php
/*
*
* The file for display blog content for WowMart theme - List Style
*
*/
$wowmart_blog_style = get_theme_mod('wowmart_blog_style', 'grid');
$wowmart_blogdate = get_theme_mod('wowmart_blogdate', 1);
$wowmart_blogauthor = get_theme_mod('wowmart_blogauthor', 1);
$wowmart_postcat = get_theme_mod('wowmart_postcat', 1);
$wowmart_posttag = get_theme_mod('wowmart_posttag', 1);
$wowmart_post_comment = get_theme_mod('wowmart_post_comment', 1);

// Get post categories
$categories = get_the_category();
$category_name = !empty($categories) ? $categories[0]->name : '';

if ($wowmart_blog_style != 'style3') :
?>
	<article class="blog-list-card mb-4">
		<div class="row g-0">
			<?php if (has_post_thumbnail()) : ?>
				<div class="col-md-5">
					<div class="blog-list-image">
						<a href="<?php echo esc_url(get_permalink()); ?>">
							<?php wowmart_post_thumbnail(); ?>
						</a>
						<?php if ($category_name) : ?>
							<span class="blog-category-badge"><?php echo esc_html($category_name); ?></span>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-7">
				<?php else : ?>
					<div class="col-12">
					<?php endif; ?>
					<div class="blog-list-content">
						<div class="blog-list-header">
							<h2 class="blog-list-title">
								<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
							</h2>

							<div class="blog-list-excerpt">
								<?php the_excerpt(); ?>
							</div>
						</div>

						<div class="blog-list-footer">
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
					</div>
				</div>
	</article>
<?php else : ?>
	<div class="xskit-single-list">
		<header class="entry-header text-center mb-5">
			<?php
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

			if ('post' === get_post_type() && (!empty($wowmart_blogdate) || !empty($wowmart_blogauthor))) :
			?>
				<div class="entry-meta">
					<?php
					if ($wowmart_blogdate) {
						wowmart_posted_on();
					}
					if ($wowmart_blogauthor) {
						wowmart_posted_by();
					}
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php wowmart_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_excerpt();
			?>
		</div><!-- .entry-content -->
		<?php if (!empty($wowmart_postcat) || !empty($wowmart_posttag) || !empty($wowmart_post_comment)) : ?>
			<footer class="entry-footer">
				<?php wowmart_entry_footer($wowmart_postcat, $wowmart_posttag, $wowmart_post_comment); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>

	</div>
<?php endif; ?>
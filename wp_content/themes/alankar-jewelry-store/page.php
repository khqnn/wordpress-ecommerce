<?php
/**
 * The template for displaying all pages
 * @subpackage Alankar Jewelry Store
 * @since 1.0
 * @version 0.1
 */

get_header(); ?>

<?php do_action( 'luzuk_alankar_jewelry_store_above_header_page' ); ?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="skip-content" class="site-main" role="main">
			<?php
		    $luzuk_alankar_jewelry_store_page_sidebar = get_theme_mod( 'luzuk_alankar_jewelry_store_page_sidebar', 'One Column' );
		    if($luzuk_alankar_jewelry_store_page_sidebar == 'One Column'){ ?>
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/page/content', 'page' );

						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
				?>
			<?php }else if($luzuk_alankar_jewelry_store_page_sidebar == 'Left Sidebar'){ ?>
				<div class="row">
					<div class="">
						<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/page/content', 'page' );

								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>
					</div>
				</div>
			<?php }else if($luzuk_alankar_jewelry_store_page_sidebar == 'Right Sidebar'){ ?>
				<div class="row">
					<div class="">
						<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/page/content', 'page' );

								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>
					</div>
				</div>
			<?php } else {?>
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/page/content', 'page' );

						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
				?>
			<?php }?>
		</main>
	</div>
</div>

<?php do_action( 'luzuk_alankar_jewelry_store_above_footer_page' ); ?>

<?php get_footer();
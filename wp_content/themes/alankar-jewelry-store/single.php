<?php
/**
 * The template for displaying all single posts
 * @subpackage Alankar Jewelry Store
 * @since 1.0
 * @version 0.1
 */

get_header(); ?>

<div class="container">
	<div class="content-area">
		<main id="skip-content" class="site-main" role="main">
			<?php
		    $luzuk_alankar_jewelry_store_layout_option = get_theme_mod( 'luzuk_alankar_jewelry_store_single_post_sidebar', 'Right Sidebar' );
		    if($luzuk_alankar_jewelry_store_layout_option == 'Left Sidebar'){ ?>
		    	<div class="row">
			        <div class="content_area col-lg-8 col-md-8">
				    	<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'alankar-jewelry-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous Post', 'alankar-jewelry-store' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'alankar-jewelry-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next Post', 'alankar-jewelry-store' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
					<div class="clearfix"></div>
				</div>			
			<?php }else if($luzuk_alankar_jewelry_store_layout_option == 'Right Sidebar'){ ?>
				<div class="row">
					<div class="content_area col-lg-8 col-md-8">
						<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'alankar-jewelry-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous Post', 'alankar-jewelry-store' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'alankar-jewelry-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next Post', 'alankar-jewelry-store' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
				</div>
			<?php }else if($luzuk_alankar_jewelry_store_layout_option == 'One Column'){ ?>
					<div class="content_area">
						<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'alankar-jewelry-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous Post', 'alankar-jewelry-store' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'alankar-jewelry-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next Post', 'alankar-jewelry-store' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
			<?php }else { ?>
				<div class="row">
					<div class="content_area col-lg-8 col-md-8">
						<section id="post_section">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content-single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_post_navigation( array(
									'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'alankar-jewelry-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous Post', 'alankar-jewelry-store' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'alankar-jewelry-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next Post', 'alankar-jewelry-store' ) . '</span> ',
								) );

							endwhile; // End of the loop.
							?>
						</section>
					</div>
				</div>
			<?php } ?>
		</main>
	</div>
</div>

<?php get_footer();
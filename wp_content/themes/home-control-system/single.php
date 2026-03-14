<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Home Control System
 */

get_header(); ?>

<div class="header-image-box text-center">
  <div class="container">
    <?php if ( get_theme_mod('home_control_system_header_page_title' , true)) : ?>
        <h1 class="my-3"><?php the_title(); ?></h1>
    <?php endif; ?>
    <?php if ( get_theme_mod('home_control_system_header_breadcrumb' , true)) : ?>
      <div class="crumb-box mt-3">
        <?php home_control_system_the_breadcrumb(); ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<div id="content" class="mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <?php
          while ( have_posts() ) :

            the_post();
            get_template_part( 'template-parts/content', 'post');

            wp_link_pages(
              array(
                'before' => '<div class="home-control-system-pagination">',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>'
              )
            );

            comments_template();
            if(get_theme_mod('home_control_system_show_related_post', true )== true):
              get_template_part( 'template-parts/related-posts' );
            endif;
          endwhile;
        ?>
      </div>
      <div class="col-lg-4 col-md-4">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
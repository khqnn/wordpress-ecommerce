<?php
/**
* The template for displaying archive pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package the9-shop-store
*/
get_header();
$layout = the9_store_get_option('blog_layout');
/**
* Hook - container_wrap_start (priority 5)
* @hooked the9_store_container_wrap_start
*/
do_action('the9_store_container_wrap_start', esc_attr($layout));

if (have_posts()) :

    echo '<div id="masonry-grid" class="row grid">';

    while (have_posts()) :
        the_post();

        // Load template part for each post
        get_template_part('template-parts/content', 'loop');

    endwhile;

    echo '</div>';

    the_posts_navigation();

else :

    get_template_part('template-parts/content', 'none');

endif;

/**
 * Hook - container_wrap_end (priority 999)
 * @hooked the9_store_container_wrap_end
 */
do_action('the9_store_container_wrap_end', esc_attr($layout));

get_footer();
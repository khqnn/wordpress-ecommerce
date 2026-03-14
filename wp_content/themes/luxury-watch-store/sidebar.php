<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Luxury Watch Store
 */
?>

<div class="sidebar-area  <?php if( get_theme_mod('luxury_watch_store_enable_sticky_sidebar', false) == 1) { ?> sidebar-sticky <?php } else { ?> close-sticky <?php } ?>
   <?php echo esc_attr( get_theme_mod('luxury_watch_store_enable_sidebar_animation', true) ? 'zoomInRight wow' : '' ); ?>">
  <?php if ( ! dynamic_sidebar( 'luxury-watch-store-sidebar' ) ) : ?>
    <div role="complementary" aria-label="<?php echo esc_attr__( 'sidebar1', 'luxury-watch-store' ); ?>" id="Search" class="sidebar-widget">
      <h4 class="title" ><?php esc_html_e( 'Search', 'luxury-watch-store' ); ?></h4>
      <?php get_search_form(); ?>
    </div>
    <div role="complementary" aria-label="<?php echo esc_attr__( 'sidebar2', 'luxury-watch-store' ); ?>" id="archives" class="sidebar-widget">
      <h4 class="title" ><?php esc_html_e( 'Archives', 'luxury-watch-store' ); ?></h4>
      <ul>
          <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
      </ul>
    </div>
    <div role="complementary" aria-label="<?php echo esc_attr__( 'sidebar3', 'luxury-watch-store' ); ?>" id="meta" class="sidebar-widget">
      <h4 class="title"><?php esc_html_e( 'Meta', 'luxury-watch-store' ); ?></h4>
      <ul>
        <?php wp_register(); ?>
        <li><?php wp_loginout(); ?></li>
        <?php wp_meta(); ?>
      </ul>
    </div>
    <div role="complementary" aria-label="<?php echo esc_attr__( 'sidebar4', 'luxury-watch-store' ); ?>" id="tag-cloud" class="sidebar-widget">
      <h4 class="title" ><?php esc_html_e( 'Tag Cloud', 'luxury-watch-store' ); ?></h4>
      <?php wp_tag_cloud(); ?>
    </div>
  <?php endif; // end sidebar widget area ?>
</div>
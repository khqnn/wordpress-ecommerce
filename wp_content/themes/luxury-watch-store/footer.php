<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Luxury Watch Store
 */
?>

<footer class="footer-side">
  <?php if ( get_theme_mod( 'luxury_watch_store_show_footer_widget', true ) ) : ?>
    <div class="footer-widget">
      <div class="container">
        <?php
          // Check if any footer sidebar is active
          $luxury_watch_store_any_sidebar_active = false;
          for ( $luxury_watch_store_i = 1; $luxury_watch_store_i <= 4; $luxury_watch_store_i++ ) {
            if ( is_active_sidebar( "footer{$luxury_watch_store_i}-sidebar" ) ) {
              $luxury_watch_store_any_sidebar_active = true;
              break;
            }
          }
          // Count active for responsive column classes
          $luxury_watch_store_active_sidebars = 0;
          if ( $luxury_watch_store_any_sidebar_active ) {
            for ( $luxury_watch_store_i = 1; $luxury_watch_store_i <= 4; $luxury_watch_store_i++ ) {
              if ( is_active_sidebar( "footer{$luxury_watch_store_i}-sidebar" ) ) {
                $luxury_watch_store_active_sidebars++;
              }
            }
          }
          $luxury_watch_store_col_class = $luxury_watch_store_active_sidebars > 0 ? 'col-lg-' . (12 / $luxury_watch_store_active_sidebars) . ' col-md-6 col-sm-12' : 'col-lg-3 col-md-6 col-sm-12';
        ?>
        <div class="row pt-2 <?php echo esc_attr( get_theme_mod('luxury_watch_store_enable_footer_animation', true) ? 'zoomInUp wow' : '' ); ?>">
          <?php for ( $luxury_watch_store_i = 1; $luxury_watch_store_i <= 4; $luxury_watch_store_i++ ) : ?>
            <div class="footer-area <?php echo esc_attr($luxury_watch_store_col_class); ?>">
              <?php if ( $luxury_watch_store_any_sidebar_active && is_active_sidebar("footer{$luxury_watch_store_i}-sidebar") ) : ?>
                <?php dynamic_sidebar("footer{$luxury_watch_store_i}-sidebar"); ?>
              <?php elseif ( ! $luxury_watch_store_any_sidebar_active ) : ?>
                  <?php if ( $luxury_watch_store_i === 1 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer1', 'luxury-watch-store' ); ?>" id="Search" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Search', 'luxury-watch-store' ); ?></h4>
                      <?php get_search_form(); ?>
                    </aside>

                  <?php elseif ( $luxury_watch_store_i === 2 ) : ?>
                      <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer2', 'luxury-watch-store' ); ?>" id="archives" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Archives', 'luxury-watch-store' ); ?></h4>
                      <ul>
                          <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                      </ul>
                      </aside>
                  <?php elseif ( $luxury_watch_store_i === 3 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer3', 'luxury-watch-store' ); ?>" id="meta" class="sidebar-widget">
                      <h4 class="title"><?php esc_html_e( 'Meta', 'luxury-watch-store' ); ?></h4>
                      <ul>
                        <?php wp_register(); ?>
                        <li><?php wp_loginout(); ?></li>
                        <?php wp_meta(); ?>
                      </ul>
                    </aside>
                  <?php elseif ( $luxury_watch_store_i === 4 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer4', 'luxury-watch-store' ); ?>" id="categories" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Categories', 'luxury-watch-store' ); ?></h4>
                      <ul>
                          <?php wp_list_categories('title_li=');  ?>
                      </ul>
                    </aside>
                  <?php endif; ?>
              <?php endif; ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php if( get_theme_mod( 'luxury_watch_store_show_footer_copyright',true)) : ?>
    <div class="footer-copyright <?php if( get_theme_mod( 'luxury_watch_store_sticky_copyright_enable','off') == 'on') { ?>sticky-copyright<?php } else { ?>close-sticky <?php } ?>">
      <div class="container">
        <div class="row pt-2">
          <div class="col-lg-6 col-md-6 align-self-center">
            <p class="mb-0 py-3 text-center text-md-start">
              <?php
                if (!get_theme_mod('luxury_watch_store_footer_text') ) { ?>
                <a href="<?php echo esc_url(__('https://www.wpelemento.com/products/luxury-watch-store', 'luxury-watch-store' )); ?>" target="_blank">
                  <?php esc_html_e('Luxury Watch Store Theme','luxury-watch-store'); ?>
                </a>
                <?php } else {
                  echo esc_html(get_theme_mod('luxury_watch_store_footer_text'));
                }
              ?>
              <?php if ( get_theme_mod('luxury_watch_store_copyright_enable', true) == true ) : ?>
              <?php
                /* translators: %s: WP Elemento */
                printf( esc_html__( ' By %s', 'luxury-watch-store' ), 'WP Elemento' ); ?>
              <?php endif; ?>
            </p>
          </div>
          <div class="col-lg-6 col-md-6 align-self-center text-center text-md-end">
            <?php if ( get_theme_mod('luxury_watch_store_copyright_enable', true) == true ) : ?>
              <a href="<?php echo esc_url(__('https://wordpress.org','luxury-watch-store') ); ?>" rel="generator"><?php  /* translators: %s: WordPress */ printf( esc_html__( 'Proudly powered by %s', 'luxury-watch-store' ), 'WordPress' ); ?></a>
            <?php endif; ?>
          </div>
          <?php if(get_theme_mod('luxury_watch_store_footer_social_icon_hide', false )== true){ ?>
            <div class="row">
              <div class="col-12 align-self-center py-1">
                <div class="footer-links">
                  <?php $luxury_watch_store_settings_footer = get_theme_mod( 'luxury_watch_store_social_links_settings_footer' ); ?>
                  <?php if ( is_array($luxury_watch_store_settings_footer) || is_object($luxury_watch_store_settings_footer) ){ ?>
                    <?php foreach( $luxury_watch_store_settings_footer as $luxury_watch_store_setting_footer ) { ?>
                      <a href="<?php echo esc_url( $luxury_watch_store_setting_footer['link_url'] ); ?>" target="_blank">
                        <i class="<?php echo esc_attr( $luxury_watch_store_setting_footer['link_text'] ); ?> me-2"></i>
                      </a>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php if ( get_theme_mod('luxury_watch_store_scroll_enable_setting', true)== true) : ?>
    <div class="scroll-up">
      <a href="#tobottom"><i class="fas fa-angle-double-up"></i></a>
    </div>
  <?php endif; ?>
  <?php if(get_theme_mod('luxury_watch_store_progress_bar', false )== true): ?>
    <div id="elemento-progress-bar" class="theme-progress-bar <?php if( get_theme_mod( 'luxury_watch_store_progress_bar_position','top') == 'top') { ?> top <?php } else { ?> bottom <?php } ?>"></div>
  <?php endif; ?>
  <?php if(get_theme_mod('luxury_watch_store_cursor_outline', false )== true): ?>
    <!-- Custom cursor -->
    <div class="cursor-point-outline"></div>
    <div class="cursor-point"></div>
    <!-- .Custom cursor -->
  <?php endif; ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jewelry Outlet
 */
?>

<footer class="footer-side">
  <?php if ( get_theme_mod( 'jewelry_outlet_show_footer_widget', true ) ) : ?>
    <div class="footer-widget">
      <div class="container">
        <?php
          // Check if any footer sidebar is active
          $jewelry_outlet_any_sidebar_active = false;
          for ( $jewelry_outlet_i = 1; $jewelry_outlet_i <= 4; $jewelry_outlet_i++ ) {
            if ( is_active_sidebar( "footer{$jewelry_outlet_i}-sidebar" ) ) {
              $jewelry_outlet_any_sidebar_active = true;
              break;
            }
          }
          // Count active for responsive column classes
          $jewelry_outlet_active_sidebars = 0;
          if ( $jewelry_outlet_any_sidebar_active ) {
            for ( $jewelry_outlet_i = 1; $jewelry_outlet_i <= 4; $jewelry_outlet_i++ ) {
              if ( is_active_sidebar( "footer{$jewelry_outlet_i}-sidebar" ) ) {
                $jewelry_outlet_active_sidebars++;
              }
            }
          }
          $jewelry_outlet_col_class = $jewelry_outlet_active_sidebars > 0 ? 'col-lg-' . (12 / $jewelry_outlet_active_sidebars) . ' col-md-6 col-sm-12' : 'col-lg-3 col-md-6 col-sm-12';
        ?>
        <div class="row pt-2  <?php echo esc_attr( get_theme_mod('jewelry_outlet_enable_footer_animation', true) ? 'zoomInUp wow' : '' ); ?>">
          <?php for ( $jewelry_outlet_i = 1; $jewelry_outlet_i <= 4; $jewelry_outlet_i++ ) : ?>
            <div class="footer-area <?php echo esc_attr($jewelry_outlet_col_class); ?>">
              <?php if ( $jewelry_outlet_any_sidebar_active && is_active_sidebar("footer{$jewelry_outlet_i}-sidebar") ) : ?>
                <?php dynamic_sidebar("footer{$jewelry_outlet_i}-sidebar"); ?>
              <?php elseif ( ! $jewelry_outlet_any_sidebar_active ) : ?>
                  <?php if ( $jewelry_outlet_i === 1 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer1', 'jewelry-outlet' ); ?>" id="Search" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Search', 'jewelry-outlet' ); ?></h4>
                      <?php get_search_form(); ?>
                    </aside>

                  <?php elseif ( $jewelry_outlet_i === 2 ) : ?>
                      <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer2', 'jewelry-outlet' ); ?>" id="archives" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Archives', 'jewelry-outlet' ); ?></h4>
                      <ul>
                          <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                      </ul>
                      </aside>
                  <?php elseif ( $jewelry_outlet_i === 3 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer3', 'jewelry-outlet' ); ?>" id="meta" class="sidebar-widget">
                      <h4 class="title"><?php esc_html_e( 'Meta', 'jewelry-outlet' ); ?></h4>
                      <ul>
                        <?php wp_register(); ?>
                        <li><?php wp_loginout(); ?></li>
                        <?php wp_meta(); ?>
                      </ul>
                    </aside>
                  <?php elseif ( $jewelry_outlet_i === 4 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer4', 'jewelry-outlet' ); ?>" id="categories" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Categories', 'jewelry-outlet' ); ?></h4>
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
  <?php if( get_theme_mod( 'jewelry_outlet_show_footer_copyright',true)) : ?>
    <div class="footer-copyright <?php echo esc_attr(get_theme_mod( 'jewelry_outlet_sticky_copyright_enable', false ) ? 'sticky-copyright' : 'close-sticky');?>">
      <div class="container">
        <div class="row pt-2">
          <div class="col-lg-6 col-md-6 align-self-center">
            <p class="mb-0 py-3 text-center text-md-start">
              <?php
                if (!get_theme_mod('jewelry_outlet_footer_text') ) { ?>
                <a href="<?php echo esc_url(__('https://www.wpelemento.com/products/jewelry-outlet', 'jewelry-outlet' )); ?>" target="_blank">
                  <?php esc_html_e('Jewelry Outlet Theme','jewelry-outlet'); ?>
                </a>
                <?php } else {
                  echo esc_html(get_theme_mod('jewelry_outlet_footer_text'));
                }
              ?>
              <?php if ( get_theme_mod('jewelry_outlet_copyright_enable', true) == true ) : ?>
              <?php
                /* translators: %s: WP Elemento */
                printf( esc_html__( ' By %s', 'jewelry-outlet' ), 'WP Elemento' ); ?>
              <?php endif; ?>
            </p>
          </div>
          <div class="col-lg-6 col-md-6 align-self-center text-center text-md-end">
            <?php if ( get_theme_mod('jewelry_outlet_copyright_enable', true) == true ) : ?>
              <a href="<?php echo esc_url(__('https://wordpress.org','jewelry-outlet') ); ?>" rel="generator"><?php  /* translators: %s: WordPress */ printf( esc_html__( 'Proudly powered by %s', 'jewelry-outlet' ), 'WordPress' ); ?></a>
            <?php endif; ?>
          </div>
          <?php if(get_theme_mod('jewelry_outlet_footer_social_icon_hide', false )== true){ ?>
            <div class="row">
              <div class="col-12 align-self-center py-1">
                <div class="footer-links">
                  <?php $jewelry_outlet_settings_footer = get_theme_mod( 'jewelry_outlet_social_links_settings_footer' ); ?>
                  <?php if ( is_array($jewelry_outlet_settings_footer) || is_object($jewelry_outlet_settings_footer) ){ ?>
                    <?php foreach( $jewelry_outlet_settings_footer as $jewelry_outlet_setting_footer ) { ?>
                      <a href="<?php echo esc_url( $jewelry_outlet_setting_footer['link_url'] ); ?>" target="_blank">
                        <i class="<?php echo esc_attr( $jewelry_outlet_setting_footer['link_text'] ); ?> me-2"></i>
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
  <?php if ( get_theme_mod('jewelry_outlet_scroll_enable_setting', true)== true) : ?>
    <div class="scroll-up">
      <a href="#tobottom"><i class="fas fa-angle-double-up"></i></a>
    </div>
  <?php endif; ?>
  <?php if(get_theme_mod('jewelry_outlet_progress_bar', false )== true): ?>
    <div id="elemento-progress-bar" class="theme-progress-bar <?php if( get_theme_mod( 'jewelry_outlet_progress_bar_position','top') == 'top') { ?> top <?php } else { ?> bottom <?php } ?>"></div>
  <?php endif; ?>
  <?php if(get_theme_mod('jewelry_outlet_cursor_outline', false )== true): ?>
    <!-- Custom cursor -->
    <div class="cursor-point-outline"></div>
    <div class="cursor-point"></div>
    <!-- .Custom cursor -->
  <?php endif; ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>
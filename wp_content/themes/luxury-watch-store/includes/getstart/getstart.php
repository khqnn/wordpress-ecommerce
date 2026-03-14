<?php

function get_page_id_by_title($luxury_watch_store_pagename){
  $luxury_watch_store_args = array(
 'post_type' => 'page',
 'posts_per_page' => 1,
 'title' => $luxury_watch_store_pagename
  );
  $luxury_watch_store_query = new WP_Query( $luxury_watch_store_args );    $luxury_watch_store_page_id = '1';
 if (isset($luxury_watch_store_query->post->ID)) {
      $luxury_watch_store_page_id = $luxury_watch_store_query->post->ID;
  } return $luxury_watch_store_page_id;
}
//about theme info
add_action( 'admin_menu', 'luxury_watch_store_gettingstarted' );
function luxury_watch_store_gettingstarted() {
	add_theme_page( esc_html__('Luxury Watch Store', 'luxury-watch-store'), esc_html__('Luxury Watch Store', 'luxury-watch-store'), 'edit_theme_options', 'luxury_watch_store_about', 'luxury_watch_store_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function luxury_watch_store_admin_theme_style() {
	wp_enqueue_style('luxury-watch-store-custom-admin-style', esc_url(get_template_directory_uri()) . '/includes/getstart/getstart.css');
	wp_enqueue_script('luxury-watch-store-tabs', esc_url(get_template_directory_uri()) . '/includes/getstart/js/tab.js');
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Admin notice code START
	wp_register_script('luxury-watch-store-notice', esc_url(get_template_directory_uri()) . '/includes/getstart/js/notice.js', array('jquery'), time(), true);
	wp_enqueue_script('luxury-watch-store-notice');
	// Admin notice code END
}
add_action('admin_enqueue_scripts', 'luxury_watch_store_admin_theme_style');

// Changelog
if ( ! defined( 'LUXURY_WATCH_STORE_CHANGELOG_URL' ) ) {
    define( 'LUXURY_WATCH_STORE_CHANGELOG_URL', get_template_directory() . '/readme.txt' );
}

function luxury_watch_store_changelog_screen() {
	global $wp_filesystem;
	$luxury_watch_store_changelog_file = apply_filters( 'luxury_watch_store_changelog_file', LUXURY_WATCH_STORE_CHANGELOG_URL );

	if ( $luxury_watch_store_changelog_file && is_readable( $luxury_watch_store_changelog_file ) ) {
		WP_Filesystem();
		$luxury_watch_store_changelog = $wp_filesystem->get_contents( $luxury_watch_store_changelog_file );
		$luxury_watch_store_changelog_list = luxury_watch_store_parse_changelog( $luxury_watch_store_changelog );

		// ✅ wrapper + button add kiya gaya hai
		echo '<div id="luxury-watch-store-changelog-container">';
		echo wp_kses_post( $luxury_watch_store_changelog_list );
		echo '</div>';
		echo '<button id="luxury-watch-store-load-more" class="button button-primary" style="margin-top:15px;">Load More</button>';
	}
}

function luxury_watch_store_parse_changelog( $luxury_watch_store_content ) {
	$luxury_watch_store_content = explode ( '== ', $luxury_watch_store_content );
	$luxury_watch_store_changelog_isolated = '';

	foreach ( $luxury_watch_store_content as $key => $luxury_watch_store_value ) {
		if ( strpos( $luxury_watch_store_value, 'Changelog ==' ) === 0 ) {
	    	$luxury_watch_store_changelog_isolated = str_replace( 'Changelog ==', '', $luxury_watch_store_value );
	    }
	}

	$luxury_watch_store_changelog_array = explode( '= ', $luxury_watch_store_changelog_isolated );
	unset( $luxury_watch_store_changelog_array[0] );

	$luxury_watch_store_changelog = '<div class="changelog">';
	foreach ( $luxury_watch_store_changelog_array as $luxury_watch_store_value ) {
		$luxury_watch_store_value = preg_replace( '/\n+/', '</span><span>', $luxury_watch_store_value );
		$luxury_watch_store_value = '<div class="block-changelog"><span class="heading">= ' . $luxury_watch_store_value . '</span></div>';
		$luxury_watch_store_changelog .= str_replace( '<span></span>', '', $luxury_watch_store_value );
	}
	$luxury_watch_store_changelog .= '</div>';

	return wp_kses_post( $luxury_watch_store_changelog );
}

//guidline for about theme
function luxury_watch_store_mostrar_guide() { 
	//custom function about theme customizer
	$luxury_watch_store_return = add_query_arg( array()) ;
	$luxury_watch_store_theme = wp_get_theme( 'luxury-watch-store' );
	?>
<div class="container-getstarted">
		<div class="inner-side-content1">
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/includes/getstart/images/sticky-header-logo.png" />
			</div>
		    <div class="coupon-container-box-left">
			    <div class="iner-sidebar-pro-btn">
				    <span class="premium-btn"><a href="<?php echo esc_url( LUXURY_WATCH_STORE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium Theme', 'luxury-watch-store'); ?></a>
				    </span>
			    </div>
		    </div>
        </div>					
   <div class="top-head">
	    <div class="top-title">
		     <h2><?php esc_html_e( 'Luxury Watch Store', 'luxury-watch-store' ); ?></h2>
		     <h4><?php esc_html_e( 'Welcome to WP Elemento Theme!', 'luxury-watch-store' ); ?></h4>
		     <p><?php esc_html_e( 'Click on the quick start button to import the demo.', 'luxury-watch-store' ); ?></p>
			    <div class="iner-sidebar-pro-btn">
					<?php if(!class_exists('WPElemento_Importer_ThemeWhizzie')){
						$luxury_watch_store_plugin_ins = Luxury_Watch_Store_Plugin_Activation_WPElemento_Importer::get_instance();
						$luxury_watch_store_actions = $luxury_watch_store_plugin_ins->luxury_watch_store_recommended_actions;
					?>
					<div class="luxury-watch-store-recommended-plugins ">
						<div class="luxury-watch-store-action-list">
							<?php if ($luxury_watch_store_actions): foreach ($luxury_watch_store_actions as $luxury_watch_store_key => $luxury_watch_store_actionValue): ?>
									<div class="luxury-watch-store-action" id="<?php echo esc_attr($luxury_watch_store_actionValue['id']);?>">
										<div class="action-inner plugin-activation-redirect">
											<?php echo wp_kses_post($luxury_watch_store_actionValue['link']); ?>
										</div>
									</div>
								<?php endforeach;
							endif; ?>
						</div>
					</div>
				   <?php }else{ ?>
					<span class="quick-btn">
				    <?php if (isset($_GET['imported']) && $_GET['imported'] == 'true'): ?>
                        <a href="<?php echo esc_url( site_url() ); ?>" target="_blank"><?php esc_html_e('Visit Site', 'luxury-watch-store'); ?></a>
						<?php
						$luxury_watch_store_page_id = get_page_id_by_title('Home');
						?>
						<a href="<?php echo esc_url( admin_url('post.php?post=' . $luxury_watch_store_page_id . '&action=elementor') ); ?>" 
							target="_blank" class="elementor-edit-btn"><?php esc_html_e('Edit With Elementor', 'luxury-watch-store'); ?>
						</a>
                    <?php else: ?>
                        <a href="<?php echo esc_url( admin_url('admin.php?page=wpelementoimporter-wizard') ); ?>"><?php esc_html_e('Quick Start', 'luxury-watch-store'); ?></a>
                    <?php endif; ?>
					<?php } ?>
				   </span>
				    <span class="premium-btn"><a href="<?php echo esc_url( LUXURY_WATCH_STORE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium', 'luxury-watch-store'); ?></a>
				    </span>
				    <span class="demo-btn"><a href="<?php echo esc_url( LUXURY_WATCH_STORE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'luxury-watch-store'); ?></a>
				    </span>
				    <span class="doc-btn"><a href="<?php echo esc_url( LUXURY_WATCH_STORE_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Theme Bundle at $79', 'luxury-watch-store'); ?></a>
				    </span>
			    </div>
            </div>			
		<div class="inner-side-content">
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" />
			</div>
			<div class="top-right">
			  <span class="version"><?php esc_html_e( 'Version', 'luxury-watch-store' ); ?>: <?php echo esc_html($luxury_watch_store_theme['Version']);?></span>
		    </div>
		</div>
    </div>
    <div class="inner-cont">
	    <div class="tab-outer-box1">
		   <div class="tab-inner-box">
			   <div class= "bundle-box">
				    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/includes/getstart/images/bundle.png"/>
				    <h1><?php esc_html_e('ELEMENTOR WORDPRESS THEME BUNDLE', 'luxury-watch-store'); ?></h1>
			     <div>
				    <p class="product-price"><?php esc_html_e('Price:', 'luxury-watch-store'); ?>
                        <span class="regular-price"><?php esc_html_e('$1,999.00', 'luxury-watch-store'); ?></span>
                        <span class="sale-price"><?php esc_html_e('$79.00', 'luxury-watch-store'); ?></span>
                    </p>
					<p><?php esc_html_e('The Elementor WordPress Theme Bundle offers a stunning collection of 76+ Premium Elementor Themes', 'luxury-watch-store'); ?></p>
                 </div>
				</div> 
			    <div class="offer-box"> 
				    <div class="offer1-box">
                       <span class="off-text1"><a href="<?php echo esc_url( LUXURY_WATCH_STORE_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Buy Bundle at 20% Discount', 'luxury-watch-store'); ?></a></span>
				    </div> 
		        </div>
			</div>	
		</div>	
		<div class="tab-outer-box2">
			<div class="tab-outer-box-2-1">
			  <h3><?php esc_html_e( 'Customizer Setting', 'luxury-watch-store' ); ?></h3>
			  <div class="lite-theme-inner">
				<div>
					<h3><?php esc_html_e('Theme Customizer', 'luxury-watch-store'); ?></h3>
					<p><?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'luxury-watch-store'); ?></p>
					<div class="info-link">
					   <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Open customizer', 'luxury-watch-store'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Help Docs', 'luxury-watch-store'); ?></h3>
					<p><?php esc_html_e('The complete procedure to configure and manage a WordPress Website from the beginning is shown in this documentation .', 'luxury-watch-store'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( LUXURY_WATCH_STORE_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'luxury-watch-store'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Need Support?', 'luxury-watch-store'); ?></h3>
					<p><?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'luxury-watch-store'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( LUXURY_WATCH_STORE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'luxury-watch-store'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Reviews & Testimonials', 'luxury-watch-store'); ?></h3>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'luxury-watch-store'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( LUXURY_WATCH_STORE_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'luxury-watch-store'); ?></a>
					</div>
				</div>
            </div>	
		</div>
			<div class="tab-outer-box-2-2">
			  <h3><?php esc_html_e( 'Link to customizer', 'luxury-watch-store' ); ?></h3>
				<div class="first-row">
					<div class="row-box">
						<div class="row-box1">
							<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your Website logo','luxury-watch-store'); ?></a>
						</div>
						<div class="row-box2">
							<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Edit Your Menus','luxury-watch-store'); ?></a>
						</div>
					</div>
							
					<div class="row-box">
						<div class="row-box1">
							<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=header_image') ); ?>" target="_blank"><?php esc_html_e('Add Header Image','luxury-watch-store'); ?></a>
						</div>
						<div class="row-box2">
							<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Add Footer Widget','luxury-watch-store'); ?></a>
						</div>
					</div>
				</div>
            </div>	
			<div class="tab-outer-box-2-3">
				<h3><?php esc_html_e( 'Change log', 'luxury-watch-store' ); ?></h3>	
		     <?php luxury_watch_store_changelog_screen(); ?>
          </div>	
        </div>
    </div>
</div>	
<?php } ?>
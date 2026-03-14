<?php

function get_page_id_by_title($jewelry_outlet_pagename){
  $jewelry_outlet_args = array(
 'post_type' => 'page',
 'posts_per_page' => 1,
 'title' => $jewelry_outlet_pagename
  );
  $jewelry_outlet_query = new WP_Query( $jewelry_outlet_args );    $jewelry_outlet_page_id = '1';
 if (isset($jewelry_outlet_query->post->ID)) {
      $jewelry_outlet_page_id = $jewelry_outlet_query->post->ID;
  } return $jewelry_outlet_page_id;
}
//about theme info
add_action( 'admin_menu', 'jewelry_outlet_gettingstarted' );
function jewelry_outlet_gettingstarted() {
	add_theme_page( esc_html__('Jewelry Outlet', 'jewelry-outlet'), esc_html__('Jewelry Outlet', 'jewelry-outlet'), 'edit_theme_options', 'jewelry_outlet_about', 'jewelry_outlet_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function jewelry_outlet_admin_theme_style() {
	wp_enqueue_style('jewelry-outlet-custom-admin-style', esc_url(get_template_directory_uri()) . '/includes/getstart/getstart.css');
	wp_enqueue_script('jewelry-outlet-tabs', esc_url(get_template_directory_uri()) . '/includes/getstart/js/tab.js');
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Admin notice code START
	wp_register_script('jewelry-outlet-notice', esc_url(get_template_directory_uri()) . '/includes/getstart/js/notice.js', array('jquery'), time(), true);
	wp_enqueue_script('jewelry-outlet-notice');
	// Admin notice code END
}
add_action('admin_enqueue_scripts', 'jewelry_outlet_admin_theme_style');

// Changelog
if ( ! defined( 'JEWELRY_OUTLET_CHANGELOG_URL' ) ) {
    define( 'JEWELRY_OUTLET_CHANGELOG_URL', get_template_directory() . '/readme.txt' );
}

function jewelry_outlet_changelog_screen() {
	global $wp_filesystem;
	$jewelry_outlet_changelog_file = apply_filters( 'jewelry_outlet_changelog_file', JEWELRY_OUTLET_CHANGELOG_URL );

	if ( $jewelry_outlet_changelog_file && is_readable( $jewelry_outlet_changelog_file ) ) {
		WP_Filesystem();
		$jewelry_outlet_changelog = $wp_filesystem->get_contents( $jewelry_outlet_changelog_file );
		$jewelry_outlet_changelog_list = jewelry_outlet_parse_changelog( $jewelry_outlet_changelog );

		echo '<div id="jewelry-outlet-changelog-container">';
		echo wp_kses_post( $jewelry_outlet_changelog_list );
		echo '</div>';
		echo '<button id="jewelry-outlet-load-more" class="button button-primary" style="margin-top:15px;">Load More</button>';
	}
}

function jewelry_outlet_parse_changelog( $jewelry_outlet_content ) {
	$jewelry_outlet_content = explode ( '== ', $jewelry_outlet_content );
	$jewelry_outlet_changelog_isolated = '';

	foreach ( $jewelry_outlet_content as $key => $jewelry_outlet_value ) {
		if ( strpos( $jewelry_outlet_value, 'Changelog ==' ) === 0 ) {
	    	$jewelry_outlet_changelog_isolated = str_replace( 'Changelog ==', '', $jewelry_outlet_value );
	    }
	}

	$jewelry_outlet_changelog_array = explode( '= ', $jewelry_outlet_changelog_isolated );
	unset( $jewelry_outlet_changelog_array[0] );

	$jewelry_outlet_changelog = '<div class="changelog">';
	foreach ( $jewelry_outlet_changelog_array as $jewelry_outlet_value ) {
		$jewelry_outlet_value = preg_replace( '/\n+/', '</span><span>', $jewelry_outlet_value );
		$jewelry_outlet_value = '<div class="block-changelog"><span class="heading">= ' . $jewelry_outlet_value . '</span></div>';
		$jewelry_outlet_changelog .= str_replace( '<span></span>', '', $jewelry_outlet_value );
	}
	$jewelry_outlet_changelog .= '</div>';

	return wp_kses_post( $jewelry_outlet_changelog );
}

//guidline for about theme
function jewelry_outlet_mostrar_guide() { 
	//custom function about theme customizer
	$jewelry_outlet_return = add_query_arg( array()) ;
	$jewelry_outlet_theme = wp_get_theme( 'jewelry-outlet' );
	?>
<div class="container-getstarted">
		<div class="inner-side-content1">
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/includes/getstart/images/sticky-header-logo.png" />
			</div>
		    <div class="coupon-container-box-left">
			    <div class="iner-sidebar-pro-btn">
				    <span class="premium-btn"><a href="<?php echo esc_url( JEWELRY_OUTLET_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium Theme', 'jewelry-outlet'); ?></a>
				    </span>
			    </div>
		    </div>
        </div>					
   <div class="top-head">
	    <div class="top-title">
		     <h2><?php esc_html_e( 'Jewelry Outlet', 'jewelry-outlet' ); ?></h2>
		     <h4><?php esc_html_e( 'Welcome to WP Elemento Theme!', 'jewelry-outlet' ); ?></h4>
		     <p><?php esc_html_e( 'Click on the quick start button to import the demo.', 'jewelry-outlet' ); ?></p>
			    <div class="iner-sidebar-pro-btn">
					<?php if(!class_exists('WPElemento_Importer_ThemeWhizzie')){
						$jewelry_outlet_plugin_ins = Jewelry_Outlet_Plugin_Activation_WPElemento_Importer::get_instance();
						$jewelry_outlet_actions = $jewelry_outlet_plugin_ins->jewelry_outlet_recommended_actions;
					?>
					<div class="jewelry-outlet-recommended-plugins ">
						<div class="jewelry-outlet-action-list">
							<?php if ($jewelry_outlet_actions): foreach ($jewelry_outlet_actions as $jewelry_outlet_key => $jewelry_outlet_actionValue): ?>
									<div class="jewelry-outlet-action" id="<?php echo esc_attr($jewelry_outlet_actionValue['id']);?>">
										<div class="action-inner plugin-activation-redirect">
											<?php echo wp_kses_post($jewelry_outlet_actionValue['link']); ?>
										</div>
									</div>
								<?php endforeach;
							endif; ?>
						</div>
					</div>
				   <?php }else{ ?>
					<span class="quick-btn">
				    <?php if (isset($_GET['imported']) && $_GET['imported'] == 'true'): ?>
                        <a href="<?php echo esc_url( site_url() ); ?>" target="_blank"><?php esc_html_e('Visit Site', 'jewelry-outlet'); ?></a>
						<?php
						$jewelry_outlet_page_id = get_page_id_by_title('Home');
						?>
						<a href="<?php echo esc_url( admin_url('post.php?post=' . $jewelry_outlet_page_id . '&action=elementor') ); ?>" 
							target="_blank" class="elementor-edit-btn"><?php esc_html_e('Edit With Elementor', 'jewelry-outlet'); ?>
						</a>
                    <?php else: ?>
                        <a href="<?php echo esc_url( admin_url('admin.php?page=wpelementoimporter-wizard') ); ?>"><?php esc_html_e('Quick Start', 'jewelry-outlet'); ?></a>
                    <?php endif; ?>
					<?php } ?>
				   </span>
				    <span class="premium-btn"><a href="<?php echo esc_url( JEWELRY_OUTLET_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium', 'jewelry-outlet'); ?></a>
				    </span>
				    <span class="demo-btn"><a href="<?php echo esc_url( JEWELRY_OUTLET_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'jewelry-outlet'); ?></a>
				    </span>
				    <span class="doc-btn"><a href="<?php echo esc_url( JEWELRY_OUTLET_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Theme Bundle at $79', 'jewelry-outlet'); ?></a>
				    </span>
			    </div>
            </div>			
		<div class="inner-side-content">
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" />
			</div>
			<div class="top-right">
			  <span class="version"><?php esc_html_e( 'Version', 'jewelry-outlet' ); ?>: <?php echo esc_html($jewelry_outlet_theme['Version']);?></span>
		    </div>
		</div>
    </div>
    <div class="inner-cont">
	    <div class="tab-outer-box1">
		   <div class="tab-inner-box">
			   <div class= "bundle-box">
				    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/includes/getstart/images/bundle.png"/>
				    <h1><?php esc_html_e('ELEMENTOR WORDPRESS THEME BUNDLE', 'jewelry-outlet'); ?></h1>
			     <div>
				    <p class="product-price"><?php esc_html_e('Price:', 'jewelry-outlet'); ?>
                        <span class="regular-price"><?php esc_html_e('$1,999.00', 'jewelry-outlet'); ?></span>
                        <span class="sale-price"><?php esc_html_e('$79.00', 'jewelry-outlet'); ?></span>
                    </p>
					<p><?php esc_html_e('The Elementor WordPress Theme Bundle offers a stunning collection of 76+ Premium Elementor Themes', 'jewelry-outlet'); ?></p>
                 </div>
				</div> 
			    <div class="offer-box"> 
				    <div class="offer1-box">
                       <span class="off-text1"><a href="<?php echo esc_url( JEWELRY_OUTLET_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Buy Bundle at 20% Discount', 'jewelry-outlet'); ?></a></span>
				    </div> 
		        </div>
			</div>	
		</div>	
		<div class="tab-outer-box2">
			<div class="tab-outer-box-2-1">
			  <h3><?php esc_html_e( 'Customizer Setting', 'jewelry-outlet' ); ?></h3>
			  <div class="lite-theme-inner">
				<div>
					<h3><?php esc_html_e('Theme Customizer', 'jewelry-outlet'); ?></h3>
					<p><?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'jewelry-outlet'); ?></p>
					<div class="info-link">
					   <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Open customizer', 'jewelry-outlet'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Help Docs', 'jewelry-outlet'); ?></h3>
					<p><?php esc_html_e('The complete procedure to configure and manage a WordPress Website from the beginning is shown in this documentation .', 'jewelry-outlet'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( JEWELRY_OUTLET_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'jewelry-outlet'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Need Support?', 'jewelry-outlet'); ?></h3>
					<p><?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'jewelry-outlet'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( JEWELRY_OUTLET_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'jewelry-outlet'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Reviews & Testimonials', 'jewelry-outlet'); ?></h3>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'jewelry-outlet'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( JEWELRY_OUTLET_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'jewelry-outlet'); ?></a>
					</div>
				</div>
            </div>	
		</div>
			<div class="tab-outer-box-2-2">
			  <h3><?php esc_html_e( 'Link to customizer', 'jewelry-outlet' ); ?></h3>
				<div class="first-row">
					<div class="row-box">
						<div class="row-box1">
							<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your Website logo','jewelry-outlet'); ?></a>
						</div>
						<div class="row-box2">
							<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Edit Your Menus','jewelry-outlet'); ?></a>
						</div>
					</div>
							
					<div class="row-box">
						<div class="row-box1">
							<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=header_image') ); ?>" target="_blank"><?php esc_html_e('Add Header Image','jewelry-outlet'); ?></a>
						</div>
						<div class="row-box2">
							<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Add Footer Widget','jewelry-outlet'); ?></a>
						</div>
					</div>
				</div>
            </div>	
			<div class="tab-outer-box-2-3">
				<h3><?php esc_html_e( 'Change log', 'jewelry-outlet' ); ?></h3>	
		     <?php jewelry_outlet_changelog_screen(); ?>
          </div>	
        </div>
    </div>
</div>	
<?php } ?>
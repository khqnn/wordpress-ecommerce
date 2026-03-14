<?php

function get_page_id_by_title($home_control_system_pagename){
  $home_control_system_args = array(
 'post_type' => 'page',
 'posts_per_page' => 1,
 'title' => $home_control_system_pagename
  );
  $home_control_system_query = new WP_Query( $home_control_system_args );    $home_control_system_page_id = '1';
 if (isset($home_control_system_query->post->ID)) {
      $home_control_system_page_id = $home_control_system_query->post->ID;
  } return $home_control_system_page_id;
}
//about theme info
add_action( 'admin_menu', 'home_control_system_gettingstarted' );
function home_control_system_gettingstarted() {
	add_theme_page( esc_html__('Home Control System', 'home-control-system'), esc_html__('Home Control System', 'home-control-system'), 'edit_theme_options', 'home_control_system_about', 'home_control_system_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function home_control_system_admin_theme_style() {
	wp_enqueue_style('home-control-system-custom-admin-style', esc_url(get_template_directory_uri()) . '/includes/getstart/getstart.css');
	wp_enqueue_script('home-control-system-tabs', esc_url(get_template_directory_uri()) . '/includes/getstart/js/tab.js');
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Admin notice code START
	wp_register_script('home-control-system-notice', esc_url(get_template_directory_uri()) . '/includes/getstart/js/notice.js', array('jquery'), time(), true);
	wp_enqueue_script('home-control-system-notice');
	// Admin notice code END
}
add_action('admin_enqueue_scripts', 'home_control_system_admin_theme_style');

// Changelog
if ( ! defined( 'HOME_CONTROL_SYSTEM_CHANGELOG_URL' ) ) {
    define( 'HOME_CONTROL_SYSTEM_CHANGELOG_URL', get_template_directory() . '/readme.txt' );
}

function home_control_system_changelog_screen() {
	global $wp_filesystem;
	$home_control_system_changelog_file = apply_filters( 'home_control_system_changelog_file', HOME_CONTROL_SYSTEM_CHANGELOG_URL );

	if ( $home_control_system_changelog_file && is_readable( $home_control_system_changelog_file ) ) {
		WP_Filesystem();
		$home_control_system_changelog = $wp_filesystem->get_contents( $home_control_system_changelog_file );
		$home_control_system_changelog_list = home_control_system_parse_changelog( $home_control_system_changelog );

		// ✅ wrapper + button add kiya gaya hai
		echo '<div id="home-control-system-changelog-container">';
		echo wp_kses_post( $home_control_system_changelog_list );
		echo '</div>';
		echo '<button id="home-control-system-load-more" class="button button-primary" style="margin-top:15px;">Load More</button>';
	}
}

function home_control_system_parse_changelog( $home_control_system_content ) {
	$home_control_system_content = explode ( '== ', $home_control_system_content );
	$home_control_system_changelog_isolated = '';

	foreach ( $home_control_system_content as $key => $home_control_system_value ) {
		if ( strpos( $home_control_system_value, 'Changelog ==' ) === 0 ) {
	    	$home_control_system_changelog_isolated = str_replace( 'Changelog ==', '', $home_control_system_value );
	    }
	}

	$home_control_system_changelog_array = explode( '= ', $home_control_system_changelog_isolated );
	unset( $home_control_system_changelog_array[0] );

	$home_control_system_changelog = '<div class="changelog">';
	foreach ( $home_control_system_changelog_array as $home_control_system_value ) {
		$home_control_system_value = preg_replace( '/\n+/', '</span><span>', $home_control_system_value );
		$home_control_system_value = '<div class="block-changelog"><span class="heading">= ' . $home_control_system_value . '</span></div>';
		$home_control_system_changelog .= str_replace( '<span></span>', '', $home_control_system_value );
	}
	$home_control_system_changelog .= '</div>';

	return wp_kses_post( $home_control_system_changelog );
}

//guidline for about theme
function home_control_system_mostrar_guide() { 
	//custom function about theme customizer
	$home_control_system_return = add_query_arg( array()) ;
	$home_control_system_theme = wp_get_theme( 'home-control-system' );
	?>
<div class="container-getstarted">
		<div class="inner-side-content1">
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/includes/getstart/images/sticky-header-logo.png" />
			</div>
		    <div class="coupon-container-box-left">
			    <div class="iner-sidebar-pro-btn">
				    <span class="premium-btn"><a href="<?php echo esc_url( HOME_CONTROL_SYSTEM_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium Theme', 'home-control-system'); ?></a>
				    </span>
			    </div>
		    </div>
        </div>					
   <div class="top-head">
	    <div class="top-title">
		     <h2><?php esc_html_e( 'Home Control System', 'home-control-system' ); ?></h2>
		     <h4><?php esc_html_e( 'Welcome to WP Elemento Theme!', 'home-control-system' ); ?></h4>
		     <p><?php esc_html_e( 'Click on the quick start button to import the demo.', 'home-control-system' ); ?></p>
			    <div class="iner-sidebar-pro-btn">
					<?php if(!class_exists('WPElemento_Importer_ThemeWhizzie')){
						$home_control_system_plugin_ins = Home_Control_System_Plugin_Activation_WPElemento_Importer::get_instance();
						$home_control_system_actions = $home_control_system_plugin_ins->home_control_system_recommended_actions;
					?>
					<div class="home-control-system-recommended-plugins ">
						<div class="home-control-system-action-list">
							<?php if ($home_control_system_actions): foreach ($home_control_system_actions as $home_control_system_key => $home_control_system_actionValue): ?>
									<div class="home-control-system-action" id="<?php echo esc_attr($home_control_system_actionValue['id']);?>">
										<div class="action-inner plugin-activation-redirect">
											<?php echo wp_kses_post($home_control_system_actionValue['link']); ?>
										</div>
									</div>
								<?php endforeach;
							endif; ?>
						</div>
					</div>
				   <?php }else{ ?>
					<span class="quick-btn">
				    <?php if (isset($_GET['imported']) && $_GET['imported'] == 'true'): ?>
                        <a href="<?php echo esc_url( site_url() ); ?>" target="_blank"><?php esc_html_e('Visit Site', 'home-control-system'); ?></a>
						<?php
						$home_control_system_page_id = get_page_id_by_title('Home');
						?>
						<a href="<?php echo esc_url( admin_url('post.php?post=' . $home_control_system_page_id . '&action=elementor') ); ?>" 
							target="_blank" class="elementor-edit-btn"><?php esc_html_e('Edit With Elementor', 'home-control-system'); ?>
						</a>
                    <?php else: ?>
                        <a href="<?php echo esc_url( admin_url('admin.php?page=wpelementoimporter-wizard') ); ?>"><?php esc_html_e('Quick Start', 'home-control-system'); ?></a>
                    <?php endif; ?>
					<?php } ?>
				   </span>
				    <span class="premium-btn"><a href="<?php echo esc_url( HOME_CONTROL_SYSTEM_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium', 'home-control-system'); ?></a>
				    </span>
				    <span class="demo-btn"><a href="<?php echo esc_url( HOME_CONTROL_SYSTEM_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'home-control-system'); ?></a>
				    </span>
				    <span class="doc-btn"><a href="<?php echo esc_url( HOME_CONTROL_SYSTEM_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Theme Bundle at $79', 'home-control-system'); ?></a>
				    </span>
			    </div>
            </div>			
		<div class="inner-side-content">
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" />
			</div>
			<div class="top-right">
			  <span class="version"><?php esc_html_e( 'Version', 'home-control-system' ); ?>: <?php echo esc_html($home_control_system_theme['Version']);?></span>
		    </div>
		</div>
    </div>
    <div class="inner-cont">
	    <div class="tab-outer-box1">
		   <div class="tab-inner-box">
			   <div class= "bundle-box">
				    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/includes/getstart/images/bundle.png"/>
				    <h1><?php esc_html_e('ELEMENTOR WORDPRESS THEME BUNDLE', 'home-control-system'); ?></h1>
			     <div>
				    <p class="product-price"><?php esc_html_e('Price:', 'home-control-system'); ?>
                        <span class="regular-price"><?php esc_html_e('$1,999.00', 'home-control-system'); ?></span>
                        <span class="sale-price"><?php esc_html_e('$79.00', 'home-control-system'); ?></span>
                    </p>
					<p><?php esc_html_e('The Elementor WordPress Theme Bundle offers a stunning collection of 76+ Premium Elementor Themes', 'home-control-system'); ?></p>
                 </div>
				</div> 
			    <div class="offer-box"> 
				    <div class="offer1-box">
                       <span class="off-text1"><a href="<?php echo esc_url( HOME_CONTROL_SYSTEM_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Buy Bundle at 20% Discount', 'home-control-system'); ?></a></span>
				    </div> 
		        </div>
			</div>	
		</div>	
		<div class="tab-outer-box2">
			<div class="tab-outer-box-2-1">
			  <h3><?php esc_html_e( 'Customizer Setting', 'home-control-system' ); ?></h3>
			  <div class="lite-theme-inner">
				<div>
					<h3><?php esc_html_e('Theme Customizer', 'home-control-system'); ?></h3>
					<p><?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'home-control-system'); ?></p>
					<div class="info-link">
					   <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Open customizer', 'home-control-system'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Help Docs', 'home-control-system'); ?></h3>
					<p><?php esc_html_e('The complete procedure to configure and manage a WordPress Website from the beginning is shown in this documentation .', 'home-control-system'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( HOME_CONTROL_SYSTEM_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'home-control-system'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Need Support?', 'home-control-system'); ?></h3>
					<p><?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'home-control-system'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( HOME_CONTROL_SYSTEM_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'home-control-system'); ?></a>
					</div>
				</div>
				<div>
					<h3><?php esc_html_e('Reviews & Testimonials', 'home-control-system'); ?></h3>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'home-control-system'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( HOME_CONTROL_SYSTEM_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'home-control-system'); ?></a>
					</div>
				</div>
            </div>	
		</div>
			<div class="tab-outer-box-2-2">
			  <h3><?php esc_html_e( 'Link to customizer', 'home-control-system' ); ?></h3>
				<div class="first-row">
					<div class="row-box">
						<div class="row-box1">
							<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your Website logo','home-control-system'); ?></a>
						</div>
						<div class="row-box2">
							<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Edit Your Menus','home-control-system'); ?></a>
						</div>
					</div>
							
					<div class="row-box">
						<div class="row-box1">
							<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=header_image') ); ?>" target="_blank"><?php esc_html_e('Add Header Image','home-control-system'); ?></a>
						</div>
						<div class="row-box2">
							<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Add Footer Widget','home-control-system'); ?></a>
						</div>
					</div>
				</div>
            </div>	
			<div class="tab-outer-box-2-3">
				<h3><?php esc_html_e( 'Change log', 'home-control-system' ); ?></h3>	
		     <?php home_control_system_changelog_screen(); ?>
          </div>	
        </div>
    </div>
</div>	
<?php } ?>
<?php

/**
 * WowMart  functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WowMart 
 */
$wowmart_theme = wp_get_theme();
$wowmart_theme_version = $wowmart_theme->get('Version');
$wowmart_theme_domain = $wowmart_theme->get('TextDomain');
if (!defined('SHOP_TOOLKIT_VERSION')) {
	// Replace the version number of the theme on each release.
	define('SHOP_TOOLKIT_VERSION', $wowmart_theme_version);
}

if (!function_exists('wowmart_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wowmart_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WowMart , use a find and replace
		 * to change 'wowmart' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('wowmart', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'btop-menu' => esc_html__('Top Menu', 'wowmart'),
				'main-menu' => esc_html__('Main Menu', 'wowmart'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);


		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wowmart_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Load WooCommerce compatibility file.
		 */
		if (class_exists('WooCommerce')) {
			require get_template_directory() . '/inc/woo-items/woo-extra.php';
		}


	}
endif;
add_action('after_setup_theme', 'wowmart_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wowmart_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('wowmart_content_width', 1170);
}
add_action('after_setup_theme', 'wowmart_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wowmart_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'wowmart'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'wowmart'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Widget', 'wowmart'),
			'id'            => 'footer-widget',
			'description'   => esc_html__('Add Footer widgets here.', 'wowmart'),
			'before_widget' => '<div class="col-lg-3"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action('widgets_init', 'wowmart_widgets_init');


/**
 * WowMart Google fonts function - Google Fonts API v2
 */
if (!function_exists('wowmart_fonts_url')) :
	function wowmart_fonts_url()
	{
		$wowmart_theme_fonts = get_theme_mod('wowmart_theme_fonts', 'Poppins');
		$wowmart_theme_font_head = get_theme_mod('wowmart_theme_font_head', 'Montserrat');

		$fonts_url = '';
		$font_families = array();

		// Define font weights
		$font_weights = 'wght@300;400;500;600;700;800';

		// Add fonts with new API v2 format
		if ($wowmart_theme_fonts == $wowmart_theme_font_head) {
			$font_families[] = 'family=' . str_replace(' ', '+', $wowmart_theme_fonts) . ':' . $font_weights;
		} else {
			$font_families[] = 'family=' . str_replace(' ', '+', $wowmart_theme_fonts) . ':' . $font_weights;
			$font_families[] = 'family=' . str_replace(' ', '+', $wowmart_theme_font_head) . ':' . $font_weights;
		}

		// Build URL with Google Fonts API v2 format
		if (!empty($font_families)) {
			$fonts_url = 'https://fonts.googleapis.com/css2?' . implode('&', $font_families) . '&display=swap';
		}

		return esc_url_raw($fonts_url);
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function wowmart_scripts()
{

	$wowmart_blog_style = get_theme_mod('wowmart_blog_style', 'grid');

	wp_enqueue_style('wowmart-google-font', wowmart_fonts_url(), array(), null);
	wp_enqueue_style('wowmart-default', get_template_directory_uri() . '/assets/css/default.css', array(), SHOP_TOOLKIT_VERSION, 'all');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.2.0', 'all');
	wp_enqueue_style('wowmart-main', get_template_directory_uri() . '/assets/css/main.css', array(), SHOP_TOOLKIT_VERSION, 'all');
	wp_enqueue_style('wowmart-style', get_stylesheet_uri(), array(), SHOP_TOOLKIT_VERSION);

	wp_enqueue_script('jquery');

	wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.js', array('jquery'), '5.2.0', true);
	wp_enqueue_script('wowmart-mobile-menu', get_template_directory_uri() . '/assets/js/mobile-menu.js', array(), SHOP_TOOLKIT_VERSION, true);
	wp_enqueue_script('wowmart-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), SHOP_TOOLKIT_VERSION, true);
	if (is_home() && $wowmart_blog_style == 'grid' && !is_single()) {
		wp_enqueue_script('masonry');
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'wowmart_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * add inline style
 */
require get_template_directory() . '/inc/inline-style.php';

/**
 * Admin Documentation
 */
if($wowmart_theme_domain != 'wowmart-lite') {
	require get_template_directory() . '/inc/admin-documentation.php';
}


/**
 * Customizer additions.
 */

require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/customizer-helper.php';

/**
 * Recommend plugin 
 */
require get_template_directory() . '/libs/magical-plugin-activation/class-magical-plugin-activation.php';
require get_template_directory() . '/libs/magical-plugin-activation/plugin-recommendations.php'; 


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}




if (!function_exists('wowmart_is_not_woocommerce_activated')) {
	function wowmart_is_not_woocommerce_activated()
	{
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) return;
	}
}


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
add_filter('excerpt_more', 'wowmart_exerpt_empty_string', 999);
function wowmart_exerpt_empty_string($more)
{

	if (is_admin()) {
		return $more;
	}
	return '';
}
function wowmart_excerpt_length($length)
{
	if (is_admin()) {
		return $length;
	}
	return 20;
}
add_filter('excerpt_length', 'wowmart_excerpt_length', 999);



function wowmart_theme_domain(){
	 $theme_info = wp_get_theme();
    $theme_domain = $theme_info->get('TextDomain');
    if ($theme_domain == 'wowmart') {
        return true;
    } 
	return false;
}
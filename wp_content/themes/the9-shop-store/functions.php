<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
if ( ! function_exists( 'the9_pet_veterinary_theme_setup' ) ) :
/**
 * Child theme setup: Load translations, add theme support, and override defaults.
 *
 * @since 1.0.0
 * @return void
 */
function the9_shop_store_theme_setup() {

    // Make theme available for translation.
    load_theme_textdomain( 'the9-shop-store', get_stylesheet_directory() . '/languages' );

    // Add custom header support with default arguments.
    add_theme_support( 'custom-header', apply_filters( 'the9_pet_veterinary_custom_header_args', array(
        'default-image'      => get_stylesheet_directory_uri() . '/assets/images/custom-header.jpg',
        'default-text-color' => '000000',
        'width'              => 1000,
        'height'             => 350,
        'flex-height'        => true,
        'wp-head-callback'   => 'the9_store_header_style',
    ) ) );

    // Register default header images.
    register_default_headers( array(
        'default-image' => array(
            'url'           => '%s/assets/images/custom-header.jpg',
            'thumbnail_url' => '%s/assets/images/custom-header.jpg',
            'description'   => esc_html__( 'Default Header Image', 'the9-shop-store' ),
        ),
    ) );

    // Remove parent theme's starter content.
    remove_action( 'after_setup_theme', 'the9_store_customizer_starter_content' );
}
add_action( 'after_setup_theme', 'the9_shop_store_theme_setup' );
endif;

if ( ! function_exists( 'the9_shop_store_parent_css' ) ) :
/**
 * Enqueue the parent theme's main stylesheet for the child theme.
 *
 * Loads the parent theme's `style.css` along with its required
 * dependencies (Bootstrap, icons, animations, and common layout styles).
 * This ensures consistent design inheritance and proper styling order
 * when customizing the theme.
 *
 * @since 1.0.0
 * @return void
 */
function the9_shop_store_parent_css() {
    wp_enqueue_style(
        'the9_shop_store_parent',
        trailingslashit( get_template_directory_uri() ) . 'style.css',
        array( 'bootstrap', 'bi-icons', 'icofont', 'scrollbar', 'aos', 'the9-store-common' )
    );

    $custom_css = ':root {--primary-color:'.esc_attr( get_theme_mod('__primary_color','#000') ).'!important; --secondary-color: '.esc_attr( get_theme_mod('__secondary_color','#005EBD') ).'!important; --nav-h-color:'.esc_attr( get_theme_mod('__secondary_color','#005EBD') ).'!important;}';
        
    wp_add_inline_style( 'the9_shop_store_parent', $custom_css );

    wp_enqueue_script( 'masonry' );

    wp_enqueue_script( 'the9-shop-store-js', get_theme_file_uri( '/assets/the9-shop-store.js'), array(),  wp_get_theme()->get('Version'), true);
}
endif;

add_action( 'wp_enqueue_scripts', 'the9_shop_store_parent_css', 10 );



if ( ! function_exists( 'the9_shop_store_override_parent_hooks' ) ) :
/**
 * Unhooks selected actions from the parent theme to enable custom
 * header, content, and footer layouts within the child theme.
 *
 * This function removes default structural elements—such as header
 * layouts, navigation, hero sections, loop headings, and footer info—
 * allowing the child theme to inject its own replacements.
 *
 * @since 1.0.0
 * @return void
 */
function the9_shop_store_override_parent_hooks() {
    global $the9_store_header_layout, $the9_store_post_related, $the9_store_footer_layout;

    // Remove parent theme header elements
    remove_action('the9_store_site_header', array( $the9_store_header_layout, 'get_site_navigation' ), 40 );
    remove_action('the9_store_site_header', array( $the9_store_header_layout, 'site_hero_sections' ), 9999 );

    // Remove default loop heading
    remove_action( 'the9_store_site_content_type', array( $the9_store_post_related, 'site_loop_heading' ), 20 );
    remove_action( 'the9_store_loop_navigation', array( $the9_store_post_related,'site_loop_navigation' ) );

    remove_action( 'the9_store_site_footer', array( $the9_store_footer_layout, 'site_footer_info' ), 80 );
}
add_action( 'wp', 'the9_shop_store_override_parent_hooks', 10 );
endif;


if ( ! function_exists( 'the9_shop_store_override_navigation' ) ) :
add_action('the9_store_site_header', 'the9_shop_store_override_navigation', 40);
/**
 * Custom navigation markup used to replace the parent theme's default navigation.
 *
 * Outputs the full nav structure including responsive toggles, the `menu-1`
 * WordPress menu with the custom nav walker, and the mini-cart hook.
 * Developers: ensure the parent navigation hook is removed before using this.
 *
 * @since 1.0.0
 * @return void
 */
function the9_shop_store_override_navigation() {
    ?>
    <nav id="navbar" class="navbar-fill">
        <div class="container d-flex align-items-stretch">
            <?php do_action('the9_shop_store_nav_before');?>
            <button class="the9-store-responsive-navbar"><i class="bi bi-list"></i></button>
            <div id="aside-nav-wrapper" class="nav-wrap flex-grow-1">
                <button class="the9-store-navbar-close"><i class="bi bi-x-lg"></i></button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'depth'          => 3,
                    'menu_class'     => 'the9_store-main-menu navigation-menu',
                    'container'      => 'ul',
                    'walker'         => new the9_store_navwalker(),
                    'fallback_cb'    => 'the9_store_navwalker::fallback_2',
                ) );
                ?>
            </div>
            <?php do_action( 'the9_shop_store_nav_after' ); ?>
        </div>
    </nav>
    <?php
}
endif;

if ( ! function_exists( 'the9_shop_store_mini_cart' ) ) :
add_action( 'the9_shop_store_nav_after', 'the9_shop_store_mini_cart' );    
/**
 * Display the mini cart in the header.
 *
 * Shows the WooCommerce cart icon with dropdown widget if WooCommerce is active.
 *
 * @since 1.0.0
 * @return void
 */
function the9_shop_store_mini_cart() {
    if ( class_exists( 'WooCommerce' ) ) :
    ?>
    <div class="top-form-minicart box-icon-cart ml-auto d-flex align-items-center">
        <i class="icofont-cart"></i>
        <?php 
        the9_store_woocommerce_cart_link();
        $instance = array( 'title' => '' );
        echo '<div class="dropdown-box">';
        the_widget( 'WC_Widget_Cart', $instance );
        echo '</div>';
        ?>
    </div>
    <?php
    endif;
}
endif;


if ( ! function_exists( 'the9_shop_store_categories_menu' ) ) {
    add_action( 'the9_shop_store_nav_before', 'the9_shop_store_categories_menu' );
    /**
     * Output a mega menu of WooCommerce product categories.
     *
     * Generates a parent + child category list for the header menu when the
     * feature is enabled in theme options. Used to display a structured
     * product category dropdown for store navigation.
     *
     * @since 1.0.0
     * @return void
     */
    function the9_shop_store_categories_menu() {

        // Fetch top-level product categories
        $args = array(
            'orderby' => 'title',
            'order'   => 'ASC',
            'parent'  => 0,
            'taxonomy' => 'product_cat',
        );

        $product_categories = get_terms( $args );

        if ( empty( $product_categories ) || is_wp_error( $product_categories ) ) {
            return;
        }

        // Menu label text
        echo '<ul id="mega-menu" class="cat-menu-wrap flex-fill"><li class="btn-wrap">';
        echo '<button class="btn-mega"><span class="bar"></span><span>' . esc_html__( 'ALL CATEGORIES', 'the9-shop-store'). '</span></button>';
        echo '<ul class="sub-menu">';

        foreach ( $product_categories as $product_category ) {

            // Get subcategories
            $sub_args = array(
                'orderby' => 'title',
                'order'   => 'ASC',
                'parent'  => $product_category->term_id,
                'taxonomy' => 'product_cat',
            );

            $product_sub_categories = get_terms( $sub_args );

            echo '<li class="shopstore-cat-parent">';
            echo '<a href="' . esc_url( get_term_link( $product_category ) ) . '" title="' . esc_attr( $product_category->name ) . '">';
            echo '<span class="menu-title">' . esc_html( $product_category->name ) . '</span></a>';

            if ( ! empty( $product_sub_categories ) && ! is_wp_error( $product_sub_categories ) ) {
                echo '<ul class="children">';
                foreach ( $product_sub_categories as $term ) {
                    echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '" title="' . esc_attr( $term->name ) . '">';
                    echo '<span class="menu-title">' . esc_html( $term->name ) . '</span></a></li>';
                }
                echo '</ul>';
            }

            echo '</li>';
        }

        echo '</li></ul></ul>';
    }
}

if ( ! function_exists( 'the9_shop_store_modify_default_theme_options' ) ) :
    /**
     * Override The9 Store default theme options.
     *
     * @since 1.0.0
     * @param array $defaults Existing theme defaults.
     * @return array Modified defaults.
     */
    function the9_shop_store_modify_default_theme_options( $defaults ) {
        // Customize default values.
        $defaults['__primary_color']     = '#000';
        $defaults['__secondary_color']   = '#005EBD';
        $defaults['blog_layout']         = 'full-container';
        $defaults['single_post_layout']  = 'no-sidebar';

        return $defaults;
    }
    add_filter( 'the9_store_filter_default_theme_options', 'the9_shop_store_modify_default_theme_options' );
endif;

if ( ! function_exists( 'the9_shop_store_loop_heading' ) ) :

    /**
     * Display post title in loop.
     *
     * @since 1.0.0
     * @return void
     */
    function the9_shop_store_loop_heading() {

        // Skip on pages inside non-singular context.
        if ( is_page() || is_single() ) {
            return;
        }

        the_title(
            '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
            '</a></h3>'
        );
    }

    add_action( 'the9_store_site_content_type', 'the9_shop_store_loop_heading', 20 );

endif;


if ( ! function_exists( 'the9_shop_store_navigation' ) ) :

    add_action( 'the9_store_loop_navigation', 'the9_shop_store_navigation' );

    /**
     * Post Posts Loop Navigation
     * @since 1.0.0
     */
    function the9_shop_store_navigation( $type = '' ) {
        global $wp_query; // <-- add this line

        echo '<div class="pagination-custom" data-aos="fade-up">';
        the_posts_pagination( array(
            'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'format'    => '?paged=%#%', // fallback for plain permalinks
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $wp_query->max_num_pages,
            'type'      => 'list',
            'mid_size'  => 2,
            'prev_text' => esc_html__( 'Previous', 'the9-shop-store' ),
            'next_text' => esc_html__( 'Next', 'the9-shop-store' ),
            'screen_reader_text' => esc_html__( '&nbsp;', 'the9-shop-store' ),
        ) );
        echo '</div>';
    }

endif;


if ( ! function_exists( 'the9_shop_store_hero_sections' ) ) :
add_action('the9_store_site_header', 'the9_shop_store_hero_sections', 9999 );
/**
 * Hero Section Output
 *
 * Developer Note:
 * This function renders the hero/heading area for all page types.
 * It prioritizes the front-page slider widget area and falls back
 * to a static header image or dynamic page titles depending on the
 * current template (home, shop, category, archive, single, search, etc.).
 * The 404 page is intentionally skipped for cleaner layouts.
 */
function the9_shop_store_hero_sections() {

        if ( is_404() ) return;

        if ( is_front_page() && is_active_sidebar( 'slider' ) ) : 
            dynamic_sidebar( 'slider' );
        else: 
            $header_image = get_header_image();
        ?>
            <?php if( ! empty( $header_image ) ) : ?>
                <div id="static_header_banner" class="header-img" style="background-image: url(<?php echo esc_url( $header_image ); ?>); background-attachment: scroll; background-size: cover; background-position: center center;">
            <?php else: ?>
                <div id="static_header_banner">
            <?php endif; ?>

                <div class="content-text">
                    <div class="container">
                        <div class="site-header-text-wrap">
                            <?php 
                                if ( is_home() ) {

                                    if ( display_header_text() ) {
                                        echo '<h1 class="page-title-text home-page-title">' . esc_html(get_bloginfo( 'name' )) . '</h1>';
                                        echo '<p class="subtitle home-page-desc">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
                                    }

                                } elseif ( function_exists( 'is_shop' ) && is_shop() ) {
                                    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                                        $wc_title = woocommerce_page_title( false ); // Return title instead of echoing
                                        echo '<h1 class="page-title-text">' . esc_html( $wc_title ) . '</h1>';
                                    }
                                } elseif ( function_exists( 'is_product_category' ) && is_product_category() ) {

                                   echo '<h1 class="page-title-text">' . esc_html( woocommerce_page_title( false ) ) . '</h1>';
                                    echo '<p class="subtitle">';
                                    do_action( 'the9_store_archive_description' );
                                    echo '</p>';

                                } elseif ( is_singular() || ( function_exists( 'is_product' ) && is_product() ) ) {
                                    echo '<h1 class="page-title-text">' . single_post_title( '', false ) . '</h1>';

                                }elseif ( is_single() ) {
                                        
                                    echo '<h1 class="page-title-text">' . single_post_title( '', false ) . '</h1>';
                                    $meta = array( 'author', 'date', 'category', 'comments' );
                                    do_action('the9_store_meta_info',$meta);

                                }elseif ( is_archive() ) {

                                    the_archive_title( '<h1 class="page-title-text">', '</h1>' );
                                    the_archive_description( '<p class="archive-description subtitle">', '</p>' );

                                } elseif ( is_search() ) {

                                    echo '<h1 class="title">';
                                    printf( /* translators: %s: Search query */
                                        esc_html__( 'Search Results for: %s', 'the9-shop-store' ), 
                                        get_search_query() 
                                    );
                                    echo '</h1>';

                                } elseif ( is_404() ) {

                                    echo '<h1 class="display-1">';
                                    esc_html_e( 'Oops! That page can&rsquo;t be found.', 'the9-shop-store' );
                                    echo '</h1>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endif;
    }

endif;

if ( ! function_exists( 'the9_shop_store_site_footer_info' ) ) :

/**
 * Outputs the custom footer information for the site.
 *
 * @since 1.0.0
 * @return void
 */
function the9_shop_store_site_footer_info() {

    $text = '';
    $html = '<div class="site_info"><div class="container"><div class="row">';

    /* -----------------------------
     * LEFT COLUMN (COPYRIGHT)
     * ----------------------------- */
    $html .= '<div class="col-6">';

    if ( get_theme_mod( 'copyright_text' ) ) {
        $text .= esc_html( get_theme_mod( 'copyright_text' ) );
    } else {
        $text .= sprintf( // translators: 1: Current Year, 2: Blog Name
            esc_html__( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', 'the9-shop-store' ),
            date_i18n( _x( 'Y', 'copyright date format', 'the9-shop-store' ) ),
            esc_html( get_bloginfo( 'name' ) )
        );
    }

    // Allow filtering
    $html .= apply_filters( 'the9_store_footer_copywrite_filter', $text );

    /* -----------------------------
     * DEVELOPER CREDIT (WITH DOMAIN AUTO SELECT)
     * ----------------------------- */
    $host = parse_url( home_url(), PHP_URL_HOST );

    if ( substr( $host, -3 ) === '.de' ) {
        $dev_domain = 'https://de.athemeart.com/';
    } elseif ( substr( $host, -3 ) === '.pl' ) {
        $dev_domain = 'https://pl.athemeart.com/';
    } elseif ( substr( $host, -3 ) === '.es' ) {
        $dev_domain = 'https://es.athemeart.com/';
    } else {
        $dev_domain = 'https://athemeart.com/';
    }

    $html .= '<small class="dev_info">' . sprintf(
        esc_html__( ' %1$s by aThemeArt - Proudly powered by %2$s.', 'the9-shop-store' ),
        '<a href="' . esc_url( $dev_domain ) . '" target="_blank">' .
            esc_html_x( 'The9 theme', 'credit - theme', 'the9-shop-store' ) .
        '</a>',
        '<a href="https://wordpress.org" target="_blank" rel="nofollow">' .
            esc_html_x( 'WordPress', 'credit to CMS', 'the9-shop-store' ) .
        '</a>'
    ) . '</small>';

    $html .= '</div>'; // End col-6 left

    /* -----------------------------
     * RIGHT COLUMN (SOCIAL ICONS)
     * ----------------------------- */
    $html .= '<div class="col-6">';
    $html .= '<ul class="social-links text-end d-flex justify-content-end align-items-center">';

    // Facebook
    if ( the9_store_get_option( '__fb_pro_link' ) ) {
        $html .= '<li class="social-item-facebook"><a href="' . esc_url( the9_store_get_option( '__fb_pro_link' ) ) . '" target="_blank" rel="nofollow"><i class="icofont-facebook"></i></a></li>';
    }

    // Twitter
    if ( the9_store_get_option( '__tw_pro_link' ) ) {
        $html .= '<li class="social-item-twitter"><a href="' . esc_url( the9_store_get_option( '__tw_pro_link' ) ) . '" target="_blank" rel="nofollow"><i class="icofont-twitter"></i></a></li>';
    }

    // YouTube
    if ( the9_store_get_option( '__you_pro_link' ) ) {
        $html .= '<li class="social-item-youtube"><a href="' . esc_url( the9_store_get_option( '__you_pro_link' ) ) . '" target="_blank" rel="nofollow"><i class="icofont-youtube"></i></a></li>';
    }

    $html .= '</ul>';
    $html .= '</div>'; // End col-6 right

    $html .= '</div></div></div>'; // Close row, container, wrapper

    echo wp_kses( $html, the9_store_alowed_tags() );
}

add_action( 'the9_store_site_footer', 'the9_shop_store_site_footer_info', 80 );

endif;

if ( ! function_exists( 'the9_shop_store_custom_excerpt_length' ) ) :
/**
 * Set the custom excerpt length for the theme.
 *
 * This function modifies the default WordPress excerpt length globally.
 *
 * @since 1.0.0
 * @param int $length Current excerpt length.
 * @return int New excerpt length.
 */
function the9_shop_store_custom_excerpt_length( $length ) {
    return 20; // Change this number to set your preferred word limit
}
add_filter( 'excerpt_length', 'the9_shop_store_custom_excerpt_length', 999 );
endif;

if ( ! function_exists( 'the9_shop_store_preloader' ) ) :
/**
 * Displays a custom site preloader.
 *
 * This function outputs a preloader animation that appears
 * while the site content is loading. It includes a spinner
 * and loading text.
 *
 * @since 1.0.0
 * @return void
 */
function the9_shop_store_preloader() {
    ?>
    <div id="the9_preloader">
        <div class="preloader-animation">
            <div class="spinner"></div>
            <div class="loading-text">
                <?php echo esc_html__( 'Loading, please wait…', 'the9-shop-store' ); ?>
            </div>
        </div>
        <div class="loader">
            <?php for ( $i = 0; $i < 4; $i++ ) : ?>
                <div class="loader-section">
                    <div class="bg"></div>
                </div>
            <?php endfor; ?>
        </div> 
    </div>
    <?php
}
add_action( 'the9_store_site_footer', 'the9_shop_store_preloader', 999 );
endif;
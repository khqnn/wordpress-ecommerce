<?php
/**
 * WowMart Theme Documentation
 *
 * @package WowMart
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add documentation page to Appearance menu
 */
function wowmart_add_documentation_menu() {
    add_theme_page(
        esc_html__('Theme Documentation', 'wowmart'),
        esc_html__('Documentation', 'wowmart'),
        'edit_theme_options',
        'wowmart-documentation',
        'wowmart_documentation_page_callback'
    );
}
add_action('admin_menu', 'wowmart_add_documentation_menu');

/**
 * Enqueue admin styles for documentation page
 */
function wowmart_documentation_admin_styles($hook) {
    // Load only on our documentation page
    if ('appearance_page_wowmart-documentation' !== $hook) {
        return;
    }
    
    wp_enqueue_style(
        'wowmart-admin-documentation',
        get_template_directory_uri() . '/assets/css/admin-documentation.css',
        array(),
        SHOP_TOOLKIT_VERSION,
        'all'
    );
}
add_action('admin_enqueue_scripts', 'wowmart_documentation_admin_styles');

/**
 * Enqueue admin notices assets
 */
function wowmart_enqueue_admin_notices_assets() {
    // Only load on admin pages
    if (!is_admin()) {
        return;
    }
    
    // Enqueue CSS
    wp_enqueue_style(
        'wowmart-admin-notices',
        get_template_directory_uri() . '/assets/css/admin-notices.css',
        array(),
        SHOP_TOOLKIT_VERSION,
        'all'
    );
    
    // Enqueue JS
    wp_enqueue_script(
        'wowmart-admin-notices',
        get_template_directory_uri() . '/assets/js/admin-notices.js',
        array('jquery'),
        SHOP_TOOLKIT_VERSION,
        true
    );
    
    // Localize script with nonces
    wp_localize_script(
        'wowmart-admin-notices',
        'wowmartNoticeData',
        array(
            'docNonce' => wp_create_nonce('wowmart_dismiss_notice_nonce'),
            'proNonce' => wp_create_nonce('wowmart_dismiss_pro_notice_nonce'),
            'ajaxurl' => admin_url('admin-ajax.php')
        )
    );
}
add_action('admin_enqueue_scripts', 'wowmart_enqueue_admin_notices_assets');

/**
 * Display admin notice for documentation
 */
function wowmart_documentation_admin_notice() {
    // Check if user can manage theme options
    if (!current_user_can('edit_theme_options')) {
        return;
    }
    
    // Check if notice is dismissed
    $is_dismissed = get_option('wowmart_documentation_notice_dismissed', false);
    
    if ($is_dismissed) {
        return;
    }
    
    // Get current screen
    $screen = get_current_screen();
    
    // Don't show on the documentation page itself
    if (isset($screen->id) && $screen->id === 'appearance_page_wowmart-documentation') {
        return;
    }
    
    ?>
    <div class="notice notice-info is-dismissible wowmart-doc-notice" data-notice="wowmart-documentation">
        <h2><?php esc_html_e('Welcome to WowMart Theme! 🎉', 'wowmart'); ?></h2>
        <p>
            <?php esc_html_e('Thank you for choosing WowMart! Before you start building your amazing online store, we highly recommend reading the comprehensive documentation to get the most out of your theme.', 'wowmart'); ?>
        </p>
        <p>
            <a href="<?php echo esc_url(admin_url('themes.php?page=wowmart-documentation')); ?>" class="button button-primary">
                <?php esc_html_e('View Documentation', 'wowmart'); ?>
            </a>
            <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-secondary">
                <?php esc_html_e('Customize Theme', 'wowmart'); ?>
            </a>
        </p>
    </div>
    <?php
}
add_action('admin_notices', 'wowmart_documentation_admin_notice');

/**
 * Display pro upgrade admin notice
 */
function wowmart_pro_upgrade_admin_notice() {
    // Check if user can manage theme options
    if (!current_user_can('edit_theme_options')) {
        return;
    }
    
    // Check if notice is dismissed (7 days)
    $dismiss_time = get_option('wowmart_pro_notice_dismissed1', 0);
    $current_time = time();
    $seven_days = 7 * DAY_IN_SECONDS;
    
    if ($dismiss_time && ($current_time - $dismiss_time) < $seven_days) {
        return;
    }
    
    // Get current screen
    $screen = get_current_screen();
    
    // Don't show on the documentation page itself
    if (isset($screen->id) && $screen->id === 'appearance_page_wowmart-documentation') {
        return;
    }
    
    ?>
    <div class="notice is-dismissible wowmart-pro-notice">
        <div class="wowmart-pro-notice-content">
            <div class="wowmart-pro-notice-icon">
                🚀
            </div>
            <div class="wowmart-pro-notice-text">
                <h3>
                    <?php esc_html_e('Upgrade to WowMart Pro', 'wowmart'); ?>
                    <span class="wowmart-pro-badge"><?php esc_html_e('Premium', 'wowmart'); ?></span>
                </h3>
                <p>
                    <?php esc_html_e('Unlock powerful features: Ajax Filters, Live Search, Mobile Bottom Menu, Subscribe Popup, One-Click Demo Import with 6 premium designs, and priority support!', 'wowmart'); ?>
                </p>
                <p>
                    <?php esc_html_e('Transform your store into a conversion machine with advanced features that boost sales and enhance user experience!', 'wowmart'); ?>
                </p>
            </div>
        </div>
        <div class="wowmart-pro-notice-actions">
            <a href="<?php echo esc_url('https://wpthemespace.com/product/wowmart-pro/?add-to-cart=15679'); ?>" class="button button-primary" target="_blank" rel="noopener noreferrer">
                <?php esc_html_e('Upgrade to Pro', 'wowmart'); ?>
            </a>
            <a href="<?php echo esc_url('https://woo.wpthemespace.com/wowmart/'); ?>" class="button button-secondary" target="_blank" rel="noopener noreferrer">
                <?php esc_html_e('View Demo', 'wowmart'); ?>
            </a>
            <button type="button" class="button wowmart-dismiss-link" data-loading-text="<?php esc_attr_e('Dismissing...', 'wowmart'); ?>">
                <?php esc_html_e('Dismiss this notice', 'wowmart'); ?>
            </button>
        </div>
    </div>
    <?php
}
add_action('admin_notices', 'wowmart_pro_upgrade_admin_notice');

/**
 * Handle AJAX request to dismiss documentation notice
 */
function wowmart_dismiss_documentation_notice() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'wowmart_dismiss_notice_nonce')) {
        wp_send_json_error(esc_html__('Security check failed.', 'wowmart'));
        wp_die();
    }
    
    // Check user capabilities
    if (!current_user_can('edit_theme_options')) {
        wp_send_json_error(esc_html__('Insufficient permissions.', 'wowmart'));
        wp_die();
    }
    
    // Dismiss the notice
    update_option('wowmart_documentation_notice_dismissed', true);
    
    wp_send_json_success(esc_html__('Notice dismissed.', 'wowmart'));
    wp_die();
}
add_action('wp_ajax_wowmart_dismiss_documentation_notice', 'wowmart_dismiss_documentation_notice');

/**
 * Handle AJAX request to dismiss pro upgrade notice (7 days)
 */
function wowmart_dismiss_pro_notice() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'wowmart_dismiss_pro_notice_nonce')) {
        wp_send_json_error(esc_html__('Security check failed.', 'wowmart'));
        wp_die();
    }
    
    // Check user capabilities
    if (!current_user_can('edit_theme_options')) {
        wp_send_json_error(esc_html__('Insufficient permissions.', 'wowmart'));
        wp_die();
    }
    
    // Dismiss the notice for 7 days
    update_option('wowmart_pro_notice_dismissed1', time());
    
    wp_send_json_success(esc_html__('Notice dismissed for 7 days.', 'wowmart'));
    wp_die();
}
add_action('wp_ajax_wowmart_dismiss_pro_notice', 'wowmart_dismiss_pro_notice');

/**
 * Documentation page callback
 */
function wowmart_documentation_page_callback() {
    // Verify user capabilities
    if (!current_user_can('edit_theme_options')) {
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'wowmart'));
    }
    
    // Get theme info
    $theme = wp_get_theme();
    $theme_name = $theme->get('Name');
    $theme_version = $theme->get('Version');
    ?>
    
    <div class="wrap wowmart-documentation-wrap">
        <h1><?php echo esc_html(sprintf(__('%s Documentation', 'wowmart'), $theme_name)); ?></h1>
        
        <!-- Upgrade to Pro Banner -->
        <div class="wowmart-upgrade-banner">
            <div class="upgrade-banner-content">
                <div class="upgrade-banner-left">
                    <h2><?php esc_html_e('🚀 Upgrade to WowMart Pro', 'wowmart'); ?></h2>
                    <p><?php esc_html_e('Unlock powerful premium features and take your online store to the next level!', 'wowmart'); ?></p>
                </div>
                <div class="upgrade-banner-right">
                <a href="<?php echo esc_url('https://wpthemespace.com/product/wowmart-pro/?add-to-cart=15679'); ?>" class="button button-primary button-hero upgrade-button" target="_blank" rel="noopener noreferrer">
                        <?php esc_html_e('Upgrade to Pro Now', 'wowmart'); ?>
                    </a>
                </div>
            </div>
            
            <div class="upgrade-features">
                <h3><?php esc_html_e('Premium Features Include:', 'wowmart'); ?></h3>
                <div class="features-grid">
                    <div class="feature-item">
                        <span class="feature-icon">🔍</span>
                        <h4><?php esc_html_e('Ajax Live Search', 'wowmart'); ?></h4>
                        <p><?php esc_html_e('Real-time product search with instant results without page reload', 'wowmart'); ?></p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🎯</span>
                        <h4><?php esc_html_e('Ajax Product Filter', 'wowmart'); ?></h4>
                        <p><?php esc_html_e('Advanced filtering by price, categories, attributes without page refresh', 'wowmart'); ?></p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">📱</span>
                        <h4><?php esc_html_e('Mobile Filter Button', 'wowmart'); ?></h4>
                        <p><?php esc_html_e('Optimized mobile filter experience with sticky filter button', 'wowmart'); ?></p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🛒</span>
                        <h4><?php esc_html_e('Mobile Bottom Shop Menu', 'wowmart'); ?></h4>
                        <p><?php esc_html_e('Sticky bottom navigation menu for better mobile shopping experience', 'wowmart'); ?></p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">📧</span>
                        <h4><?php esc_html_e('Subscribe Popup', 'wowmart'); ?></h4>
                        <p><?php esc_html_e('Convert visitors into subscribers with elegant popup forms', 'wowmart'); ?></p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🎨</span>
                        <h4><?php esc_html_e('One-Click Demo Import', 'wowmart'); ?></h4>
                        <p><?php esc_html_e('6 different premium designs with one-click installation', 'wowmart'); ?></p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">💎</span>
                        <h4><?php esc_html_e('High-Quality Designs', 'wowmart'); ?></h4>
                        <p><?php esc_html_e('Premium professionally designed templates for various niches', 'wowmart'); ?></p>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🎯</span>
                        <h4><?php esc_html_e('Priority Support', 'wowmart'); ?></h4>
                        <p><?php esc_html_e('Get dedicated premium support from our expert team', 'wowmart'); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Documentation Content -->
        <div class="wowmart-documentation-content">
            
            <!-- Quick Start Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('🚀 Quick Start Guide', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <ol>
                        <li>
                            <strong><?php esc_html_e('Install WooCommerce:', 'wowmart'); ?></strong>
                            <p><?php esc_html_e('Go to Plugins → Add New, search for "WooCommerce", install and activate it.', 'wowmart'); ?></p>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Run WooCommerce Setup:', 'wowmart'); ?></strong>
                            <p><?php esc_html_e('Follow the WooCommerce setup wizard to configure your store settings, currency, and payment methods.', 'wowmart'); ?></p>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Set Your Logo:', 'wowmart'); ?></strong>
                            <p><?php esc_html_e('Navigate to Appearance → Customize → Site Identity → Logo to upload your brand logo.', 'wowmart'); ?></p>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Create Menus:', 'wowmart'); ?></strong>
                            <p><?php esc_html_e('Go to Appearance → Menus to create and assign menus to "Top Menu" and "Main Menu" locations.', 'wowmart'); ?></p>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Add Products:', 'wowmart'); ?></strong>
                            <p><?php esc_html_e('Start adding your products through Products → Add New in the WordPress dashboard.', 'wowmart'); ?></p>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- Theme Customization Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('🎨 Theme Customization', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <h3><?php esc_html_e('Accessing the Customizer', 'wowmart'); ?></h3>
                    <p><?php esc_html_e('Navigate to Appearance → Customize to access all theme options. Changes are previewed in real-time before publishing.', 'wowmart'); ?></p>
                    
                    <h3><?php esc_html_e('Available Customization Options:', 'wowmart'); ?></h3>
                    
                    <h4><?php esc_html_e('1. Site Identity', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Upload your site logo', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set site title and tagline', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Add site icon (favicon)', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('2. Typography', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Choose from 800+ Google Fonts', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set different fonts for body text and headings', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Default fonts: Poppins (body) and Montserrat (headings)', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('3. Colors', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Primary color for buttons and links', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Background colors', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Text colors', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Header and footer colors', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('4. Header Settings', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Enable/disable top header bar', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Add contact information', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Configure shopping cart display', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Customize search functionality', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('5. Blog Layout', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Choose between grid and list layout', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set excerpt length', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Show/hide post meta information', 'wowmart'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Menu Setup Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('📋 Menu Setup', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <p><?php esc_html_e('WowMart theme supports two menu locations:', 'wowmart'); ?></p>
                    
                    <h3><?php esc_html_e('Creating Menus:', 'wowmart'); ?></h3>
                    <ol>
                        <li><?php esc_html_e('Go to Appearance → Menus', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Create a new menu or select an existing one', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Add pages, products, categories, or custom links', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Drag and drop to reorder items', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Assign the menu to a location (Top Menu or Main Menu)', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Click "Save Menu"', 'wowmart'); ?></li>
                    </ol>
                    
                    <h3><?php esc_html_e('Menu Locations:', 'wowmart'); ?></h3>
                    <ul>
                        <li>
                            <strong><?php esc_html_e('Top Menu:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Appears at the very top of the header, ideal for utility links like "Contact", "About Us", or "My Account"', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Main Menu:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Primary navigation menu below the logo, perfect for product categories and main pages', 'wowmart'); ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Widget Areas Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('📦 Widget Areas', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <p><?php esc_html_e('Go to Appearance → Widgets to manage widget areas:', 'wowmart'); ?></p>
                    
                    <h3><?php esc_html_e('Available Widget Areas:', 'wowmart'); ?></h3>
                    <ul>
                        <li>
                            <strong><?php esc_html_e('Sidebar:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Appears on blog posts and pages with sidebar layout. Add search, categories, recent posts, or custom widgets.', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Footer Widget:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' 4-column footer area. Add contact info, navigation menus, recent products, or newsletter signup forms.', 'wowmart'); ?></span>
                        </li>
                    </ul>
                    
                    <h3><?php esc_html_e('Adding Widgets:', 'wowmart'); ?></h3>
                    <ol>
                        <li><?php esc_html_e('Navigate to Appearance → Widgets', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Select a widget from the left panel', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Drag it to the desired widget area', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Configure widget settings', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Click "Save" or "Done"', 'wowmart'); ?></li>
                    </ol>
                </div>
            </div>

            <!-- WooCommerce Setup Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('🛍️ WooCommerce Configuration', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <h3><?php esc_html_e('Essential WooCommerce Settings:', 'wowmart'); ?></h3>
                    
                    <h4><?php esc_html_e('1. General Settings', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Go to WooCommerce → Settings → General', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set your store location and currency', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Configure selling locations', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('2. Product Settings', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('WooCommerce → Settings → Products', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set shop and product page layouts', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Configure inventory options', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set product image dimensions', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('3. Shipping & Tax', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Configure shipping zones and methods', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set up tax rates if applicable', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('4. Payment Gateways', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Enable payment methods (PayPal, Stripe, etc.)', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Configure payment gateway settings', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Test payment processing', 'wowmart'); ?></li>
                    </ul>
                    
                    <h3><?php esc_html_e('Adding Products:', 'wowmart'); ?></h3>
                    <ol>
                        <li><?php esc_html_e('Go to Products → Add New', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Enter product name and description', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set product price (regular and sale price)', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Upload product images', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Assign product categories and tags', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Set inventory and shipping details', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Click "Publish"', 'wowmart'); ?></li>
                    </ol>
                </div>
            </div>

            <!-- Page Templates Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('📄 Page Templates', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <p><?php esc_html_e('WowMart includes specialized page templates:', 'wowmart'); ?></p>
                    
                    <h3><?php esc_html_e('Available Templates:', 'wowmart'); ?></h3>
                    <ul>
                        <li>
                            <strong><?php esc_html_e('Default Template:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Standard page layout with sidebar', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Full Width Template:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' No sidebar, content spans full width - perfect for landing pages', 'wowmart'); ?></span>
                        </li>
                    </ul>
                    
                    <h3><?php esc_html_e('Applying Templates:', 'wowmart'); ?></h3>
                    <ol>
                        <li><?php esc_html_e('Edit or create a page', 'wowmart'); ?></li>
                        <li><?php esc_html_e('In the right sidebar, find "Page Attributes"', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Select desired template from "Template" dropdown', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Update or publish the page', 'wowmart'); ?></li>
                    </ol>
                </div>
            </div>

            <!-- Performance Tips Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('⚡ Performance Optimization', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <h3><?php esc_html_e('Tips for Faster Loading:', 'wowmart'); ?></h3>
                    <ul>
                        <li>
                            <strong><?php esc_html_e('Optimize Images:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Compress images before uploading. Recommended plugins: Smush, ShortPixel, or Imagify', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Use Caching:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Install a caching plugin like WP Rocket, W3 Total Cache, or WP Super Cache', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Lazy Loading:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' WordPress 5.5+ includes native lazy loading for images', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Minimize Plugins:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Only use essential plugins. Deactivate and delete unused ones', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('CDN Usage:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Consider using a Content Delivery Network like Cloudflare', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Regular Updates:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Keep WordPress, theme, and plugins updated', 'wowmart'); ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Recommended Plugins Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('🔌 Recommended Plugins', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <h3><?php esc_html_e('Essential Plugins:', 'wowmart'); ?></h3>
                    <ul>
                        <li>
                            <strong><?php esc_html_e('WooCommerce:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Required for e-commerce functionality', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Contact Form 7:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Create and manage contact forms', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Yoast SEO:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Optimize your site for search engines', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Elementor:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Page builder for advanced customization', 'wowmart'); ?></span>
                        </li>
                    </ul>
                    
                    <h3><?php esc_html_e('WooCommerce Extensions:', 'wowmart'); ?></h3>
                    <ul>
                        <li><?php esc_html_e('WooCommerce Product Filter - Product filtering and sorting', 'wowmart'); ?></li>
                        <li><?php esc_html_e('WooCommerce Wishlist - Let customers save favorite products', 'wowmart'); ?></li>
                        <li><?php esc_html_e('WooCommerce Product Reviews - Enhanced review system', 'wowmart'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Troubleshooting Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('🔧 Troubleshooting', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <h3><?php esc_html_e('Common Issues & Solutions:', 'wowmart'); ?></h3>
                    
                    <h4><?php esc_html_e('Menu Not Displaying:', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Ensure you have created a menu under Appearance → Menus', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Check that menu is assigned to the correct location', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Verify menu items are added and saved', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('Logo Not Showing:', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Go to Appearance → Customize → Site Identity', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Click "Select logo" and upload your image', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Recommended logo size: 250x250 pixels', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('WooCommerce Pages Not Working:', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Go to WooCommerce → Status → Tools', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Click "Create default WooCommerce pages"', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Reset permalinks: Settings → Permalinks → Save Changes', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('Sidebar Not Appearing:', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Check if you are using the Full Width template', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Add widgets to Sidebar area in Appearance → Widgets', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Verify the page/post supports sidebar layout', 'wowmart'); ?></li>
                    </ul>
                    
                    <h4><?php esc_html_e('CSS/Style Changes Not Reflecting:', 'wowmart'); ?></h4>
                    <ul>
                        <li><?php esc_html_e('Clear your browser cache (Ctrl+F5 or Cmd+Shift+R)', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Clear WordPress cache if using a caching plugin', 'wowmart'); ?></li>
                        <li><?php esc_html_e('Check if a CDN is caching old files', 'wowmart'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Support Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('💬 Support & Resources', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <h3><?php esc_html_e('Getting Help:', 'wowmart'); ?></h3>
                    <ul>
                        <li>
                            <strong><?php esc_html_e('WordPress.org Support Forum:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Free community support for theme users', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Theme Documentation:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' You are viewing it now!', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('WordPress Codex:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' General WordPress documentation and tutorials', 'wowmart'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('WooCommerce Documentation:', 'wowmart'); ?></strong>
                            <span><?php esc_html_e(' Official WooCommerce setup and configuration guides', 'wowmart'); ?></span>
                        </li>
                    </ul>
                    
                    <h3><?php esc_html_e('Useful Links:', 'wowmart'); ?></h3>
                    <ul>
                        <li><a href="<?php echo esc_url('https://wpthemespace.com/product/wowmart/'); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e('Theme Homepage', 'wowmart'); ?></a></li>
                        <li><a href="<?php echo esc_url('https://wordpress.org/support/'); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e('WordPress Support', 'wowmart'); ?></a></li>
                        <li><a href="<?php echo esc_url('https://woocommerce.com/documentation/'); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e('WooCommerce Documentation', 'wowmart'); ?></a></li>
                    </ul>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="doc-section">
                <h2 class="doc-section-title"><?php esc_html_e('❓ Frequently Asked Questions', 'wowmart'); ?></h2>
                <div class="doc-content">
                    <h4><?php esc_html_e('Q: Is WooCommerce required for this theme?', 'wowmart'); ?></h4>
                    <p><?php esc_html_e('A: Yes, WooCommerce is required for e-commerce functionality. The theme can work without it but will not display product features.', 'wowmart'); ?></p>
                    
                    <h4><?php esc_html_e('Q: Can I use a page builder with this theme?', 'wowmart'); ?></h4>
                    <p><?php esc_html_e('A: Yes, the theme is compatible with popular page builders like Elementor, Beaver Builder, and Gutenberg block editor.', 'wowmart'); ?></p>
                    
                    <h4><?php esc_html_e('Q: Is the theme translation ready?', 'wowmart'); ?></h4>
                    <p><?php esc_html_e('A: Yes, the theme is fully translation ready. You can use plugins like WPML or Loco Translate to translate into any language.', 'wowmart'); ?></p>
                    
                    <h4><?php esc_html_e('Q: Can I customize colors and fonts?', 'wowmart'); ?></h4>
                    <p><?php esc_html_e('A: Absolutely! Go to Appearance → Customize to change colors, fonts, and other design elements.', 'wowmart'); ?></p>
                    
                    <h4><?php esc_html_e('Q: Will my site be mobile-friendly?', 'wowmart'); ?></h4>
                    <p><?php esc_html_e('A: Yes, WowMart is fully responsive and optimized for all devices including smartphones and tablets.', 'wowmart'); ?></p>
                    
                    <h4><?php esc_html_e('Q: How do I update the theme?', 'wowmart'); ?></h4>
                    <p><?php esc_html_e('A: Theme updates are available through the WordPress dashboard (Appearance → Themes). Always backup before updating.', 'wowmart'); ?></p>
                    
                    <h4><?php esc_html_e('Q: What\'s the difference between free and pro version?', 'wowmart'); ?></h4>
                    <p><?php esc_html_e('A: Pro version includes Ajax filters, live search, mobile bottom menu, subscribe popup, one-click demo import with 6 premium designs, and priority support.', 'wowmart'); ?></p>
                </div>
            </div>

            <!-- Theme Info Section -->
            <div class="doc-section doc-info-box">
                <h3><?php esc_html_e('Theme Information', 'wowmart'); ?></h3>
                <table class="theme-info-table">
                    <tr>
                        <td><strong><?php esc_html_e('Theme Name:', 'wowmart'); ?></strong></td>
                        <td><?php echo esc_html($theme_name); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Version:', 'wowmart'); ?></strong></td>
                        <td><?php echo esc_html($theme_version); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Author:', 'wowmart'); ?></strong></td>
                        <td><?php echo esc_html($theme->get('Author')); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('WordPress Version:', 'wowmart'); ?></strong></td>
                        <td><?php echo esc_html(get_bloginfo('version')); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('PHP Version:', 'wowmart'); ?></strong></td>
                        <td><?php echo esc_html(phpversion()); ?></td>
                    </tr>
                </table>
            </div>

        </div><!-- .wowmart-documentation-content -->
        
    </div><!-- .wrap -->
    
    <?php
}

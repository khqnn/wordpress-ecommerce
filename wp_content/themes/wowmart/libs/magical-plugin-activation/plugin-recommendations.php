<?php
/**
 * Magical Plugin Activation - Example Implementation
 * 
 * This file demonstrates how to integrate the Magical Plugin Activation toolkit
 * into your WordPress theme. This is a complete example showing various use cases
 * and implementation patterns.
 * 
 * @package magical_plugin_activation
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}


/**
 * STEP 2: Define your theme's required and recommended plugins
 * Use the main filter to define your complete plugin list
 */

function wowmart_pro_recommended_plugins($plugins) {
    $theme_plugins = array(
        
         // WordPress.org plugins
            'magical-products-display' => array(
                'name' => __('Magical Product', 'wowmart'),
                'slug' => 'magical-products-display',
                'file' => 'magical-products-display/magical-products-display.php',
                'description' => __('Display your products in a magical way with this addon.', 'wowmart'),
                'category' => 'Essential',
                'required' => false,
                'featured' => true,
                'is_local' => false
            ),
            'woocommerce' => array(
                'name' => __('Woocommerce', 'wowmart'),
                'slug' => 'woocommerce',
                'file' => 'woocommerce/woocommerce.php',
                'description' => __('The most popular eCommerce platform for WordPress.', 'wowmart'),
                'category' => 'Essential',
                'required' => false,
                'featured' => false,
                'is_local' => false
            ),
            'elementor' => array(
                'name' => __('Elementor', 'wowmart'),
                'slug' => 'elementor',
                'file' => 'elementor/elementor.php',
                'description' => __('Create beautiful pages with drag & drop page builder. Perfect for creating stunning layouts with your theme.', 'wowmart'),
                'category' => 'Page Builder',
                'required' => false,
                'featured' => false,
                'is_local' => false
            ),
            'magical-addons-for-elementor' => array(
                'name' => __('Magical Addons', 'wowmart'),
                'slug' => 'magical-addons-for-elementor',
                'file' => 'magical-addons-for-elementor/magical-addons-for-elementor.php',
                'description' => __('Enhance your site with a collection of magical addons for Elementor.', 'wowmart'),
                'category' => 'Essential',
                'required' => false,
                'featured' => true,
                'is_local' => false
            ),
            'magical-posts-display' => array(
                'name' => __('Magical Posts', 'wowmart'),
                'slug' => 'magical-posts-display',
                'file' => 'magical-posts-display/magical-posts-display.php',
                'description' => __('Enhance your site with a collection of magical Posts widgets for Elementor.', 'wowmart'),
                'category' => 'Essential',
                'required' => false,
                'featured' => false,
                'is_local' => false
            ),
            'magical-blocks' => array(
                'name' => __('Magical Posts', 'wowmart'),
                'slug' => 'magical-blocks',
                'file' => 'magical-blocks/magical-blocks.php',
                'description' => __('Enhance your site with a collection of magical Posts widgets for Elementor.', 'wowmart'),
                'category' => 'Essential',
                'required' => false,
                'featured' => false,
                'is_local' => false
            ),
           
        
    );

    return array_merge($plugins, $theme_plugins);
}
add_filter('magical_plugin_activation_recommended_plugins', 'wowmart_pro_recommended_plugins');


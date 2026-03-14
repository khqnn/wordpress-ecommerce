<?php 

function stylish_brand_shop_add_admin_menu() {
    add_menu_page(
        'Theme Settings', // Page title
        'Theme Settings', // Menu title
        'manage_options', // Capability
        'stylish-brand-shop-theme-settings', // Menu slug
        'stylish_brand_shop_settings_page' // Function to display the page
    );
}
add_action( 'admin_menu', 'stylish_brand_shop_add_admin_menu' );

function stylish_brand_shop_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Theme Settings', 'stylish-brand-shop' ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'stylish_brand_shop_settings_group' );
            do_settings_sections( 'stylish-brand-shop-theme-settings' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function stylish_brand_shop_register_settings() {
    register_setting( 'stylish_brand_shop_settings_group', 'stylish_brand_shop_enable_animations' );

    add_settings_section(
        'stylish_brand_shop_settings_section',
        __( 'Animation Settings', 'stylish-brand-shop' ),
        null,
        'stylish-brand-shop-theme-settings'
    );

    add_settings_field(
        'stylish_brand_shop_enable_animations',
        __( 'Enable Animations', 'stylish-brand-shop' ),
        'stylish_brand_shop_enable_animations_callback',
        'stylish-brand-shop-theme-settings',
        'stylish_brand_shop_settings_section'
    );
}
add_action( 'admin_init', 'stylish_brand_shop_register_settings' );

function stylish_brand_shop_enable_animations_callback() {
    $checked = get_option( 'stylish_brand_shop_enable_animations', true );
    ?>
    <input type="checkbox" name="stylish_brand_shop_enable_animations" value="1" <?php checked( 1, $checked ); ?> />
    <?php
}


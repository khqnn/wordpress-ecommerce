<?php
/*
*
* WowMart woocommerce related functions
*
*
*/
require get_template_directory() . '/inc/woo-items/customizer-woo.php';
require get_template_directory() . '/inc/woo-items/woo-inline-style.php';


if (!function_exists('wowmart_woocommerce_setup')) {
	function wowmart_woocommerce_setup()
	{
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');
	}
	add_action('after_setup_theme', 'wowmart_woocommerce_setup', 999);
}

if (!function_exists('wowmart_woocommerce_scripts')) {
	function wowmart_woocommerce_scripts()
	{
		wp_enqueue_style('wowmart-woocommerce-style', get_template_directory_uri() . '/assets/css/wowmart-woocommerce.css', array(), SHOP_TOOLKIT_VERSION, 'all');
		wp_enqueue_script('wowmart-number', get_template_directory_uri() . '/assets/js/number.js', array('jquery'), SHOP_TOOLKIT_VERSION, false);
		wp_enqueue_script('wowmart-cart-scripts', get_template_directory_uri() . '/assets/js/cart-scripts.js', array('jquery'), SHOP_TOOLKIT_VERSION, false);
	}
	add_action('wp_enqueue_scripts', 'wowmart_woocommerce_scripts');
}



if (!function_exists('wowmart_cart_count_icon_fragment')) {
	function wowmart_cart_count_icon_fragment($fragments)
	{
		ob_start();
		wowmart_cart_count_icon();
		$fragments['.cart-count-icon'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'wowmart_cart_count_icon_fragment');


if (!function_exists('wowmart_cart_count_icon')) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function wowmart_cart_count_icon()
	{
		$item_count_text = sprintf(
			/* translators: number of items in the mini cart. */
			_n('%d', '%d', WC()->cart->get_cart_contents_count(), 'wowmart'),
			WC()->cart->get_cart_contents_count()
		);
?>
		<a href="#" class="action-link cart-icon">
			<div class="action-icon cart-count-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<circle cx="8" cy="21" r="1"></circle>
					<circle cx="19" cy="21" r="1"></circle>
					<path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
				</svg>
				<span class="action-count cart-count count"><?php echo esc_html($item_count_text); ?></span>
			</div>
		</a>

	<?php
	}
}


if (!function_exists('wowmart_woowidgets_init')) {
	function wowmart_woowidgets_init()
	{
		register_sidebar(array(
			'name'          => esc_html__('Shop Sidebar', 'wowmart'),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__('Add shop widgets here.', 'wowmart'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar(array(
			'name'          => esc_html__('Shop Page Top Widget.', 'wowmart'),
			'id'            => 'top-filter',
			'description'   => esc_html__('Shop Page products fileter top widget.', 'wowmart'),
			'before_widget' => '<div id="%1$s" class="wowmart-top-filter %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="top-widget-title d-none">',
			'after_title'   => '</h3>',
		));
	}
	add_action('widgets_init', 'wowmart_woowidgets_init');
}

if (!function_exists('wowmart_body_wooclasses')) {
	function wowmart_body_wooclasses($classes)
	{

		if (!is_active_sidebar('shop-sidebar') && is_shop()) {
			$classes[] = 'no-shop-widget';
		}
		if (is_front_page() && is_shop()) {
			$classes[] = 'befront-shop';
		}

		return $classes;
	}
	add_filter('body_class', 'wowmart_body_wooclasses');
}


/**
 * Change number or products per row 
 */
add_filter('loop_shop_columns', 'wowmart_loop_columns', 999);
if (!function_exists('wowmart_loop_columns')) {
	function wowmart_loop_columns()
	{
		$wowmart_shop_column = get_theme_mod('wowmart_shop_column', '4');

		return $wowmart_shop_column;
	}
}

//add new div for product

function wowmart_before_shop_loop_div()
{
	$wowmart_shop_style = get_theme_mod('wowmart_shop_style', '1');

	echo '<div class="wowmart-poroduct style' . esc_attr($wowmart_shop_style) . '">';
}
add_action('woocommerce_before_shop_loop_item', 'wowmart_before_shop_loop_div', 5);

function wowmart_after_shop_loop_div()
{
	echo '</div">';
}
add_action('woocommerce_after_shop_loop_item', 'wowmart_after_shop_loop_div', 15);
// End div for product

function wowmart_woobody_classes($classes)
{

	if (is_shop()) {
		$classes[] = 'wowmart';
	}

	return $classes;
}
add_filter('body_class', 'wowmart_woobody_classes');

function wowmart_woocommerce_page_title($page_title)
{
	$wowmart_shop_title = get_theme_mod('wowmart_shop_title', esc_html__('Shop', 'wowmart'));
	if (is_shop()) {
		return $wowmart_shop_title;
	} else {
		return $page_title;
	}
}
add_filter('woocommerce_page_title', 'wowmart_woocommerce_page_title');


// add filter widget in shop page top 

function wowmart_woocommerce_before_shop_loop()
{
	// Custom filter bar
	wowmart_shop_filter_bar();

	// Legacy widget support
	if (is_active_sidebar('top-filter')) {
		$wowmart_ftwidget_position = get_theme_mod('wowmart_ftwidget_position', 'center');
	?>
		<div class="wowmart-products-filter bestopwid-<?php echo esc_attr($wowmart_ftwidget_position); ?>">
			<?php dynamic_sidebar('top-filter'); ?>
		</div>

	<?php
	}
}
add_action('woocommerce_before_shop_loop', 'wowmart_woocommerce_before_shop_loop', 15);

/**
 * Custom Shop Filter Bar
 * 
 * Displays a comprehensive product filtering interface with proper security measures:
 * - All GET parameters are sanitized using sanitize_text_field() and wp_unslash()
 * - Output is escaped using esc_html(), esc_attr(), and esc_url()
 * - All user-facing text is translatable using __() or esc_html__()
 * - Orderby parameter is validated against whitelist
 * - No nonce required as filters use GET parameters (URL-based, not form submission)
 * 
 * @since 1.0.0
 */
function wowmart_shop_filter_bar()
{
	if (!class_exists('WooCommerce')) {
		return;
	}

	global $wp_query;

	// Get current filters with proper sanitization
	$current_cat = isset($_GET['product_cat']) ? sanitize_text_field(wp_unslash($_GET['product_cat'])) : '';
	$current_color = isset($_GET['filter_color']) ? sanitize_text_field(wp_unslash($_GET['filter_color'])) : '';
	$current_stock = isset($_GET['filter_stock']) ? sanitize_text_field(wp_unslash($_GET['filter_stock'])) : '';

	// Validate orderby against allowed values
	$allowed_orderby = array('date', 'popularity', 'rating', 'price', 'price-desc', 'menu_order');
	$orderby_raw = isset($_GET['orderby']) ? sanitize_text_field(wp_unslash($_GET['orderby'])) : 'date';
	$orderby = in_array($orderby_raw, $allowed_orderby, true) ? $orderby_raw : 'date';

	// Get all product categories
	$categories = get_terms(array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
	));

	// Get color attribute terms
	$colors = get_terms(array(
		'taxonomy'   => 'pa_color',
		'hide_empty' => true,
	));

	$total_products = $wp_query->found_posts;
	?>
	<div class="wowmart-filter-bar">
		<div class="filter-bar-left">
			<div class="filter-group">
				<button class="filter-dropdown-toggle" data-filter="categories">
					<?php echo esc_html__('CATEGORIES', 'wowmart'); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<polyline points="6 9 12 15 18 9"></polyline>
					</svg>
				</button>
				<div class="filter-dropdown-menu">
					<?php if (!empty($categories) && !is_wp_error($categories)) : ?>
						<?php foreach ($categories as $category) : ?>
							<label class="filter-option">
								<input type="checkbox" name="product_cat" value="<?php echo esc_attr($category->slug); ?>" <?php checked($current_cat, $category->slug); ?>>
								<span><?php echo esc_html($category->name); ?></span>
							</label>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>

			<?php if (!empty($colors) && !is_wp_error($colors)) : ?>
				<div class="filter-group">
					<button class="filter-dropdown-toggle" data-filter="color">
						<?php echo esc_html__('COLOR', 'wowmart'); ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<polyline points="6 9 12 15 18 9"></polyline>
						</svg>
					</button>
					<div class="filter-dropdown-menu color-filter-menu">
						<?php
						// Define color hex values
						$color_map = array(
							'black' => '#000000',
							'blue' => '#0000FF',
							'red' => '#FF0000',
							'yellow' => '#FFFF00',
							'green' => '#008000',
							'white' => '#FFFFFF',
							'gray' => '#808080',
							'grey' => '#808080',
							'orange' => '#FFA500',
							'purple' => '#800080',
							'pink' => '#FFC0CB',
							'brown' => '#A52A2A',
						);

						foreach ($colors as $color) :
							$color_slug = strtolower($color->slug);
							$color_hex = isset($color_map[$color_slug]) ? $color_map[$color_slug] : '#cccccc';
						?>
							<label class="filter-option color-option">
								<input type="checkbox" name="filter_color" value="<?php echo esc_attr($color->slug); ?>" <?php checked($current_color, $color->slug); ?>>
								<span class="color-swatch" style="background-color: <?php echo esc_attr($color_hex); ?>;"></span>
								<span class="color-name"><?php echo esc_html($color->name); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="filter-group">
				<button class="filter-dropdown-toggle" data-filter="available">
					<?php echo esc_html__('AVAILABLE', 'wowmart'); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<polyline points="6 9 12 15 18 9"></polyline>
					</svg>
				</button>
				<div class="filter-dropdown-menu">
					<label class="filter-option">
						<input type="radio" name="filter_stock" value="instock" <?php checked($current_stock, 'instock'); ?>>
						<span><?php echo esc_html__('In Stock', 'wowmart'); ?></span>
					</label>
					<label class="filter-option">
						<input type="radio" name="filter_stock" value="outofstock" <?php checked($current_stock, 'outofstock'); ?>>
						<span><?php echo esc_html__('Out of Stock', 'wowmart'); ?></span>
					</label>
				</div>
			</div>

			<button class="reset-filters-btn" type="button">
				<?php echo esc_html__('RESET ALL FILTER', 'wowmart'); ?>
			</button>
		</div>

		<div class="filter-bar-right">
			<div class="results-count">
				<strong><?php echo esc_html($total_products); ?></strong> <?php echo esc_html__('RESULTS FOUND', 'wowmart'); ?>
			</div>

			<div class="sort-dropdown">
				<label><?php echo esc_html__('SORT BY :', 'wowmart'); ?></label>
				<select name="orderby" class="orderby">
					<option value="date" <?php selected($orderby, 'date'); ?>><?php echo esc_html__('NEWEST', 'wowmart'); ?></option>
					<option value="popularity" <?php selected($orderby, 'popularity'); ?>><?php echo esc_html__('POPULARITY', 'wowmart'); ?></option>
					<option value="rating" <?php selected($orderby, 'rating'); ?>><?php echo esc_html__('AVERAGE RATING', 'wowmart'); ?></option>
					<option value="price" <?php selected($orderby, 'price'); ?>><?php echo esc_html__('PRICE: LOW TO HIGH', 'wowmart'); ?></option>
					<option value="price-desc" <?php selected($orderby, 'price-desc'); ?>><?php echo esc_html__('PRICE: HIGH TO LOW', 'wowmart'); ?></option>
					<option value="menu_order" <?php selected($orderby, 'menu_order'); ?>><?php echo esc_html__('DEFAULT', 'wowmart'); ?></option>
				</select>
			</div>
		</div>
	</div>
<?php
}



/*Checkout page edit*/

/*
 Remove all possible fields
 */
function wowmart__remove_checkout_fields($fields)
{

	$wowmart_checkout_lastname = get_theme_mod('wowmart_checkout_lastname', 1);
	$wowmart_checkout_email = get_theme_mod('wowmart_checkout_email', 'required');
	$wowmart_checkout_postcode = get_theme_mod('wowmart_checkout_postcode', '1');

	if (empty($wowmart_checkout_lastname)) {
		unset($fields['billing']['billing_last_name']);
		$fields['billing']['billing_first_name']['label'] = esc_html__('Name', 'wowmart');
	}


	if ($wowmart_checkout_email == 'hide') {
		unset($fields['billing']['billing_email']);
	}
	if (empty($wowmart_checkout_postcode)) {
		unset($fields['billing']['billing_postcode']);
	}


	return $fields;
}
add_filter('woocommerce_checkout_fields', 'wowmart__remove_checkout_fields');

function wowmart__required_checkout_fields($fields)
{
	$wowmart_checkout_email = get_theme_mod('wowmart_checkout_email', 'required');

	if ($wowmart_checkout_email == 'optional') {
		$fields['billing_email']['required'] = false;
	}



	return $fields;
}
add_filter('woocommerce_billing_fields', 'wowmart__required_checkout_fields');


function wowmart_woo_action_icons()
{
?>
	<ul class="woo-action-icons">
		<li>
			<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php esc_attr_e('My Account', 'wowmart'); ?>" class=" action-link">
				<div class="action-icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
						<circle cx="12" cy="7" r="4"></circle>
					</svg>
				</div>
			</a>
		</li>
		<li>
			<?php wowmart_cart_count_icon(); ?>
			<div class="cart-panel">
				<div class="cart-panel-inside">
					<button class="panel-close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg></button>
					<?php
					// Check if the cart is empty
					if (WC()->cart->is_empty()) :
						wc_get_page_permalink('shop');
					?>
						<div class="cart-panel-body">
							<p><?php esc_html_e('Your cart is empty!', 'wowmart'); ?></p>
							<a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="cart-empty-link"><?php esc_html_e('Start Shopping', 'wowmart'); ?></a>
						</div>
					<?php else : ?>
						<h2 class="pchead"><?php echo esc_html('Your Cart', 'wowmart'); ?></h2>
						<div class="panel-cart-items">
						<?php
						$instance = array(
							'title' => '',
						);
						the_widget('WC_Widget_Cart', $instance);
					endif;
						?>
						</div>
				</div>
		</li>
	</ul>

	<?php
}


// Custom Product Card Layout Functions
// Remove default WooCommerce hooks
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Add custom hooks for new layout
add_action('woocommerce_before_shop_loop_item_title', 'wowmart_product_image_wrapper_open', 5);
add_action('woocommerce_before_shop_loop_item_title', 'wowmart_product_discount_badge', 7);
add_action('woocommerce_before_shop_loop_item_title', 'wowmart_product_image_wrapper_close', 15);
add_action('woocommerce_shop_loop_item_title', 'wowmart_product_content_wrapper_open', 5);
add_action('woocommerce_shop_loop_item_title', 'wowmart_product_brand_name', 7);
add_action('woocommerce_shop_loop_item_title', 'wowmart_product_title_link', 10);
add_action('woocommerce_after_shop_loop_item_title', 'wowmart_product_price_custom', 10);
add_action('woocommerce_after_shop_loop_item', 'wowmart_product_add_to_cart_button', 10);
add_action('woocommerce_after_shop_loop_item', 'wowmart_product_content_wrapper_close', 15);

// Product image wrapper
function wowmart_product_image_wrapper_open()
{
	echo '<div class="wowmart-product-image-wrapper">';
	echo '<a href="' . esc_url(get_permalink()) . '" class="wowmart-product-link">';
}

function wowmart_product_image_wrapper_close()
{
	echo '</a></div>';
}

// Discount badge
function wowmart_product_discount_badge()
{
	global $product;
	if ($product->is_on_sale()) {
		$regular_price = (float) $product->get_regular_price();
		$sale_price = (float) $product->get_sale_price();

		if ($regular_price > 0 && $sale_price > 0) {
			$percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
			echo '<span class="wowmart-discount-badge">-' . esc_html($percentage) . '%</span>';
		} else {
			echo '<span class="wowmart-discount-badge">' . esc_html__('Sale!', 'wowmart') . '</span>';
		}
	}
}

// Product content wrapper
function wowmart_product_content_wrapper_open()
{
	echo '<div class="wowmart-product-content">';
}

function wowmart_product_content_wrapper_close()
{
	echo '</div>';
}

// Product brand/category name
function wowmart_product_brand_name()
{
	global $product;
	$terms = get_the_terms($product->get_id(), 'product_cat');
	if ($terms && !is_wp_error($terms)) {
		$first_term = array_shift($terms);
		echo '<div class="wowmart-product-brand">' . esc_html($first_term->name) . '</div>';
	}
}

// Product title with link
function wowmart_product_title_link()
{
	echo '<h2 class="woocommerce-loop-product__title wowmart-product-title">';
	echo '<a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>';
	echo '</h2>';
}

// Custom price display
function wowmart_product_price_custom()
{
	global $product;
	echo '<div class="wowmart-product-price">';
	echo wp_kses_post($product->get_price_html());
	echo '</div>';
}

// Custom add to cart button
function wowmart_product_add_to_cart_button()
{
	global $product;

	echo '<div class="wowmart-product-button-wrapper">';

	if ($product->is_type('simple')) {
		$button_text = $product->is_purchasable() && $product->is_in_stock() ? __('Add to Cart', 'wowmart') : __('Read More', 'wowmart');

		$cart_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="cart-btn-icon"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>';

		echo sprintf(
			'<a href="%s" data-quantity="1" class="button wowmart-add-to-cart-btn product_type_%s %s" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s<span class="btn-text">%s</span></a>',
			esc_url($product->add_to_cart_url()),
			esc_attr($product->get_type()),
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button ajax_add_to_cart' : '',
			esc_attr($product->get_id()),
			esc_attr($product->get_sku()),
			esc_attr($product->add_to_cart_description()),
			$cart_icon,
			esc_html($button_text)
		);
	} else {
		woocommerce_template_loop_add_to_cart();
	}

	echo '</div>';
}


/**
 * Shop by Department Dropdown
 * 
 * Displays WooCommerce product categories in a dropdown menu with proper security:
 * - All output properly escaped (esc_html__, esc_url, esc_html, esc_attr)
 * - Category data retrieved from WordPress taxonomy system
 * - All text translatable for internationalization
 * - Accessibility attributes (aria-expanded) included
 * 
 * @since 1.0.0
 */
if (!function_exists('wowmart_shop_by_department')) {
	function wowmart_shop_by_department()
	{
		if (!class_exists('WooCommerce')) {
			return;
		}

		$department_show = get_theme_mod('wowmart_topbar_department_show', 1);

		if (!$department_show) {
			return;
		}

		$categories = get_terms(array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'parent'     => 0,
		));

		if (empty($categories) || is_wp_error($categories)) {
			return;
		}

	?>
		<div class="wowmart-department-menu">
			<button class="department-toggle" type="button" aria-expanded="false">
				<span class="department-icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="3" y1="6" x2="21" y2="6"></line>
						<line x1="3" y1="12" x2="21" y2="12"></line>
						<line x1="3" y1="18" x2="21" y2="18"></line>
					</svg>
				</span>
				<span class="department-text"><?php echo esc_html__('Shop by Department', 'wowmart'); ?></span>
				<span class="department-arrow">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<polyline points="6 9 12 15 18 9"></polyline>
					</svg>
				</span>
			</button>
			<div class="department-dropdown">
				<ul class="department-list">
					<?php foreach ($categories as $category) :
						$cat_link = get_term_link($category);
						$cat_image = get_term_meta($category->term_id, 'thumbnail_id', true);
					?>
						<li class="department-item">
							<a href="<?php echo esc_url($cat_link); ?>" class="department-link">
								<span class="cat-name"><?php echo esc_html($category->name); ?></span>
								<span class="cat-count">(<?php echo esc_html($category->count); ?>)</span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
<?php
	}
}

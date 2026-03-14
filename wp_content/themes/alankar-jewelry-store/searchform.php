<?php
/**
 * Template for displaying search forms in Alankar Jewelry Store
 *
 * @subpackage Alankar Jewelry Store
 * @since 1.0
 * @version 0.1
 */
?>

<?php $luzuk_alankar_jewelry_store_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e('Search for:','alankar-jewelry-store'); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder','alankar-jewelry-store' ); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
	</label>
	<button type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'submit button', 'alankar-jewelry-store' ); ?></button>
</form>
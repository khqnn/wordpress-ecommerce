<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @subpackage Alankar Jewelry Store
 * @since 1.0
 * @version 1.4
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'alankar-jewelry-store' ); ?></h2>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php
				/* translators: %s: Post editor URL. */
				printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'alankar-jewelry-store' ), esc_url( admin_url( 'post-new.php' ) ) );
				?>
			</p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'alankar-jewelry-store' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div>
</section>
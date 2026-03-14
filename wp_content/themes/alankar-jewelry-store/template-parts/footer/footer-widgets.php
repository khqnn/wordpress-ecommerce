<?php
/**
 * Displays footer widgets if assigned
 *
 * @subpackage Alankar Jewelry Store
 * @since 1.0
 * @version 1.4
 */

?>

<aside class="widget-area" role="complementary">
	<div class="row mr-0">
		<div class="widget-column footer-widget-1 col-lg-3 col-md-6">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
		<div class="widget-column footer-widget-2 col-lg-3 col-md-6">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>	
		<div class="widget-column footer-widget-3 col-lg-3 col-md-6">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>
		<div class="widget-column footer-widget-4 col-lg-3 col-md-6">
			<?php dynamic_sidebar( 'footer-4' ); ?>
		</div>
		<!-- <div class="widget-column footer-widget-5 col-lg-12 col-md-12">
			</?php dynamic_sidebar( 'footer-5' ); ?>
		</div> -->
	</div>
</aside>
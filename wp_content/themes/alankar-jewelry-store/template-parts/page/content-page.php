<?php
/**
 * Template part for displaying page content in page.php
 *
 * @subpackage Alankar Jewelry Store
 * @since 1.0
 * @version 0.1
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php luzuk_alankar_jewelry_store_edit_link( get_the_ID() ); ?>
	</header>
	<div class="entry-content">
		<?php if(has_post_thumbnail()) { ?>
	    	<?php the_post_thumbnail(); ?>
	    <?php }?>
		<p><?php the_content();?></p>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'alankar-jewelry-store' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article>
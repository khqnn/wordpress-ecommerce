<?php
	the_posts_pagination( array(
		'prev_text' => esc_html__( 'Previous page', 'home-control-system' ),
		'next_text' => esc_html__( 'Next page', 'home-control-system' ),
	) );
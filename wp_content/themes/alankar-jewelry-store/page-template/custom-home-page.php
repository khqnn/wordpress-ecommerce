<?php
/**
 * Template Name: Custom Home
 */
get_header(); ?>

<main id="skip-content" role="main">

	<?php do_action( 'luzuk_alankar_jewelry_store_above_slider' ); ?>

	<?php if( get_theme_mod('luzuk_alankar_jewelry_store_slider_hide_show') != ''){ ?>
	<section id="slider">	  
		
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			    <?php $luzuk_alankar_jewelry_store_slider_pages = array();
			    for ( $count = 1; $count <= 4; $count++ ) {
			        $mod = intval( get_theme_mod( 'luzuk_alankar_jewelry_store_slider'. $count ));
			        if ( 'page-none-selected' != $mod ) {
			          $luzuk_alankar_jewelry_store_slider_pages[] = $mod;
			        }
			    }
		      	if( !empty($luzuk_alankar_jewelry_store_slider_pages) ) :
			        $args = array(
			          	'post_type' => 'page',
			          	'post__in' => $luzuk_alankar_jewelry_store_slider_pages,
			          	'orderby' => 'post__in'
			        );
		        	$query = new WP_Query( $args );
		        if ( $query->have_posts() ) :
		          	$i = 1;
		    	?>   
		    	<div class="carousel-inner" role="listbox">
		    	<!-- <div class="container">    -->
				   
				      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
				        <div <?php if($i == 1){echo 'class="carousel-item fade-in-image active"';} else{ echo 'class="carousel-item fade-in-image"';}?>>										
							<div class="slideimg">
								<?php
									// Check if the post has a thumbnail
									if (has_post_thumbnail()) {
										// If post has thumbnail, display it
										?>
										<img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute(); ?>" />
										<?php
									} else {
										// If post does not have thumbnail, display default image
										?>
										<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/abt1.jpg'); ?>" alt="Default Image" />
										<?php
									}

								?>
								<div class="slider-overlay"></div>
							</div>
							<?php
								$luzuk_alankar_jewelry_store_slider_effect = get_theme_mod('luzuk_alankar_jewelry_store_slider_effect', '') 
							?>
							<div class="content <?php echo ($luzuk_alankar_jewelry_store_slider_effect); ?>">
								<!-- <h5></?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_slider_heading')); ?></h5> -->
								<h2><?php the_title(); ?></h2>
								<?php 
									$luzuk_alankar_jewelry_store_slider_excerpt_length = get_theme_mod('luzuk_alankar_jewelry_store_slider_excerpt_length','15');
								
									if( $luzuk_alankar_jewelry_store_slider_excerpt_length != ''){?>
									<p><?php $luzuk_alankar_jewelry_store_excerpt = get_the_excerpt(); echo esc_html( luzuk_alankar_jewelry_store_string_limit_words( $luzuk_alankar_jewelry_store_excerpt, esc_attr(get_theme_mod('luzuk_alankar_jewelry_store_slider_excerpt_length','15') ) )); ?></p>
								<?php } ?>

								<div class="read-btn">
									<a class="sbtn1" href="<?php echo esc_url(get_theme_mod('luzuk_alankar_jewelry_store_sliderexplorecollectionbtnlink')) ?>" >
										<?php _e( 'Explore Collection', 'alankar-jewelry-store' ); ?> 
									</a>

									<a class="sbtn2" href="<?php echo esc_url(get_theme_mod('luzuk_alankar_jewelry_store_slidercontactusbtnlink')) ?>" >
										<?php _e( 'Contact Us', 'alankar-jewelry-store' ); ?> 
									</a>
								</div>
							</div>						
							
				        </div>
				      	<?php $i++; endwhile; 
				      	wp_reset_postdata();?>
				    <!-- </div> -->
			    <?php else : ?>

			    	</div>
			    	<div class="no-postfound"></div>
	      		<?php endif;
			    endif;?>
			<div class="slidebtn">
			     <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">	
					<span class="carousel-control-prev-icon" aria-hidden="true">
					  <i class="fas fa-chevron-left"></i>
			      	</span>
			      	<span class="screen-reader-text"><//?php esc_html_e( 'Prev','alankar-jewelry-store' );?></span>
			    </a>
			    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true">
					  <i class="fas fa-chevron-right"></i>
			      	</span>
			      	<span class="screen-reader-text"><//?php esc_html_e( 'Next','alankar-jewelry-store' );?></span>
			    </a>
				
			</div>
			<ol class="carousel-indicators">
                    <?php for ($j = 0; $j < $i; $j++) : ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $j; ?>" class="<?php if ($j === 0) echo 'active'; ?>"></li>
                    <?php endfor; ?>
                </ol>
		  	<div class="clearfix"></div>
		</div> 
	</section>
	<?php }?>
	
	<?php do_action('luzuk_alankar_jewelry_store_below_slider'); ?>

	<section id="productcategory-section">
		<div class="S_headingbx">
			<div class="productcategory-head ">
				<div class="subheading"><?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_productcategory_subheading')); ?></div>
				<?php if(get_theme_mod('luzuk_alankar_jewelry_store_productcategory_heading') != ''){?>
					<h3><?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_productcategory_heading')); ?>
					</h3>
				<?php }?>
			</div>
		</div>
		<div class="container"> 
			<div class="p-sbox">			
				<?php if(class_exists('woocommerce')){ ?>
					<div class="category">
						<div class="pcbox">
							<div class="row mr-0">  
							<?php
							$args = array(
								'number'     => 6,  // Limit to 8 categories
								'orderby'    => 'title',
								'order'      => 'ASC',
								'hide_empty' => false
							);
							$product_categories = get_terms('product_cat', $args);

							$count = count($product_categories);
							$limit = 8; // Set limit to 8
							if ($count > 0) {
								$counter = 0;
								foreach ($product_categories as $product_category) {
									if ($counter >= $limit) break; // Stop loop after 8 categories
									$counter++;

									$image = esc_html(get_template_directory_uri()).'/assets/images/default.png'; // Set default image

									if (function_exists('get_term_meta')) {
										if (isset($product_category->term_id)) {
											// Get the thumbnail ID
											$thumbnail_id = get_term_meta($product_category->term_id, 'thumbnail_id', true);
											if ($thumbnail_id) {
												// Get the image URL for parent category
												$image = wp_get_attachment_url($thumbnail_id);
											}
										}
									}

									if (isset($product_category->name)) {
										echo '<div class=" cat-product hvr-float-shadow"> ';
										echo '<div class="pro-cat-img">   
												<a href="' . get_term_link($product_category) . '" data-hover="' . $product_category->name . '">
													<img src="' . $image . '" alt="" width="270" height="377" />
													<div class="p-olay"></div>
													<div class="pro-cat-content">
														<h5><a href="' . get_term_link($product_category) . '" data-hover="' . $product_category->name . '">
																' . $product_category->name . '
															</a>
														</h5>
													</div>
												</a>
											</div>';
										
										echo '</div>';
									}
								}
							}
							?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

				<?php }?>
			</div>
		</div>
	</section>

	<?php do_action('luzuk_alankar_jewelry_store_below_productcategory_section'); ?>

	<section id="newarrivalproducts-section">	 
		<div class="S_headingbx">
			<div class="productcategory-head ">
				<div class="subheading"><?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproducts_subheading')); ?></div>
				<?php if(get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproducts_heading') != ''){?>
					<h3><?php echo esc_html(get_theme_mod('luzuk_alankar_jewelry_store_newarrivalproducts_heading')); ?>
					</h3>
				<?php }?>
			</div>
		</div>
		<div class="container">
			<div class="newarrivalproductsbx">
				<div class="newarrivalproductsus-post-wrap">
					<div class="newarrivalproductsus-post-boxes row">
						<div class="row owl-carousel owl-theme mr-0">
							<?php
							if (function_exists('woocommerce_template_loop_add_to_cart') && function_exists('WC')) {
								// Query to fetch new arrival products
								$args = array(
									'post_type' => 'product',
									'posts_per_page' => 8,
									'orderby' =>'date',
									'order' => 'DESC',
									'meta_query' => array(
										array(
											'key' => '_stock_status',
											'value' => 'instock'
										)
									)
								);
								$loop = new WP_Query($args);
								if ($loop->have_posts()) {
									while ($loop->have_posts()) : $loop->the_post(); global $product;
										?>
										<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 item newarproductsbx wow zoomIn" data-wow-duration="1s">
											<div class="newarrivalproductsus-single">
												<div class="newarrivalproducts-box"> 
													<div class="hi-icon">
														<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
															<?php if (has_post_thumbnail($loop->post->ID)) {
																echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
															} else {
																echo '<img src="' . get_template_directory_uri() . '/images/default.png" alt="featured products" />';
															} ?>
															<div class="icnbx">
							                                    <a href="<?php the_permalink(); ?>" class="eye">
							                                        <i class="fa fa-eye"></i>
							                                    </a>
							                                </div>

														</a>
													</div>
												</div> 
												
												<div class="pcontent">
													<?php
							                            $categories = get_the_terms(get_the_ID(), 'product_cat');
							                            if ($categories && !is_wp_error($categories)) {
							                                echo '<div class="product-categories">';
							                                foreach ($categories as $category) {
							                                    echo '<span class="category-item">' . esc_html($category->name) . '</span>';
							                                }
							                                echo '</div>';
							                            }
							                        ?>
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">    
														<h3><?php the_title(); ?></h3>
													</a>
													<div class="product-rating">
						                                <?php 
						                                if (wc_review_ratings_enabled()) {
						                                    $avg   = $product->get_average_rating();
						                                    $count = $product->get_rating_count();

						                                    if ($count > 0) {
						                                        echo '<div class="custom-rating-stars">';

						                                        for ($i=1; $i<=5; $i++) {
						                                            echo $i <= $avg
						                                                ? "<span class='star full'>★</span>"
						                                                : "<span class='star empty'>☆</span>";
						                                        }

						                                        echo " <span class='rating-count'> ($count)</span>";
						                                        echo '</div>';
						                                    }
						                                }
						                                ?>
						                            </div>
													<div class="Pr_bx">
														<?php 
															if ( $product->is_on_sale() ) {
																echo '<span class="s-price">' . wc_price( $product->get_sale_price() ) . '</span>';
															} 
														?>
														<?php 
															if ( $product->is_on_sale() ) {
																echo '<span class="r-price">' . wc_price( $product->get_regular_price() ) . '</span>';
															} 
														?>
													</div>
													<div class="btn-rentadress">
														<a class="cart-contents" href="<?php the_permalink(); ?>"><?php echo esc_html('Add to Cart','alankar-jewelry-store'); ?> </a>
													</div>
													<div class="clear"></div>
												</div>             
											</div>
											<div class="clear"></div>
										</div>
									<?php endwhile;
								} else {
									// No new arrival products found
									echo '<div class="item">';
									echo '<p>No new arrival products found.</p>';
									echo '</div>';
								}
							}
							?>
						</div> 
						
					</div> 
				</div>
			</div>
			
		</div>
	</section>

	<?php do_action('luzuk_alankar_jewelry_store_below_newarrivalproducts_section'); ?>

	<div class="container">
	  	<?php while ( have_posts() ) : the_post(); ?>
	  		<div class="lz-content">
	        	<?php the_content(); ?>
	        </div>
	    <?php endwhile; // end of the loop. ?>
	</div>
</main>

<?php get_footer(); ?>
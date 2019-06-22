<?php
$center_title = $slide_title = $category = $slide_number  = $option = $color = $enabled_wishlist = $enabled_price = $enabled_add_cart  = $type_slide = $bg_color_full = $perview_slide = "";
extract(shortcode_atts(array(
    'center_title' => '',
    'slide_title' =>'',
    'slide_number' => '',
    'category' => '',
    'option' => '',
    'color' => '',
    'enabled_wishlist' => '',
    'enabled_add_cart' => '',
    'enabled_price' => '',
    'type_slide' => '',
    'bg_color_full' => '',
    'perview_slide' => ''
), $atts));
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
	if ($category){
		$category = get_term_by('slug',$category,'product_cat');
		if (is_object($category)){
			$category = $category->slug;
		}
	}
	$class_center = '';
	$class_deflection = '';
	$id_ran = rand(1, 99999);
	$type = '';
	$full_bg = '';
	if ($perview_slide == '') {
		$perview_slide = 5;
	}
	//Options slide
	if ($type_slide) {
		$type = 'box-dark';
	}
	if ($bg_color_full) {
		$full_bg = 'full-bg';
	}
	if ($center_title) {
		$class_center = 'book-center';
	}
	if ($option == 'horizontal') {
		$class_deflection = 'book-option2';
	?>
		<div class="feature-section <?php print($type); ?> <?php print($full_bg) ?>" style="background-color:<?php print($color); ?>">
			<div class="container">
				<div class="book-features">
						<div class="title-box <?php print($class_center); ?>"><span><?php print($slide_title); ?></span></div>

						<div class="swiper-container book-slider-feature book-slider-feature-<?php print($id_ran); ?> <?php print($class_deflection); ?>">
								<!-- Additional required wrapper -->

								<div class="swiper-wrapper">
								<?php
								if ($category != '') {
										$args = array(
												'post_type' => 'product',
												'posts_per_page' => $slide_number,
												'order' => 'DESC' ,
												'tax_query' => array(
													'relation' => 'OR',
													array(
															'taxonomy' => 'product_cat',
															'field' => 'slug',
															'terms' => $category
													),
										),
									);
							}
							else{
								$args = array(
												'post_type' => 'product',
												'posts_per_page' => $slide_number,
												'order' => 'DESC' ,
									);
							}
									$loop = new WP_Query( $args );

								?>


								<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>
										<?php
											global $product;
											$rating_count = $product->get_rating_count();
											$average = $product->get_average_rating();
											$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
											$style_product = '';
											if($none_book == 'on'){
												$style_product = 'none-book';
											}
										?>
											<div class="swiper-slide">

													<div class="book-item-slide">
														<div class="book-item <?php print($style_product) ?>">
															<div class="book-image">
																<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
															</div>
															<div class="book-actions">
																<div class="list-action">
																	<?php
																		if ($enabled_add_cart != 'No') {
																			do_action( 'woocommerce_after_shop_loop_item' );
																		}
																	?>
																	<?php
																		if ($enabled_wishlist != 'No') {
																			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
																		}
																	?>
																</div><!--End list-action-->
															</div>
														</div><!--End book-item-->
														<div class="book-info woocommerce">
															<?php if ( $rating_count > 0 ) : ?>
																<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'bebostore' ), $average ); ?>">
												<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
													<strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'bebostore' ), '<span>', '</span>' ); ?>
													<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'bebostore' ), '<span class="rating">' . $rating_count . '</span>' ); ?>
												</span>
											</div>
															<?php endif; ?>
															<span class="book-name"><a href="<?php echo esc_url(get_permalink($loop->post->ID)); ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?></a></span>
															<span class="book-author">
																	<?php
																			$author = get_field('field_book_author');
																	?>
																		<?php if( $author ): ?>
																				<?php esc_html_e('by:', 'bebostore'); ?>
																				<?php
																				if(count($author) == 1){
																				foreach( $author as $authors ): ?>

																						<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
																				<?php endforeach;
																					}
																				else{
																				?>
																				<?php $author_list = ''; ?>
																				<?php foreach( $author as $authors ): ?>
																					<?php
																						$author_list .= '<a href="'.esc_url(get_permalink( $authors->ID )).'" target="blank">';
																						$author_list .= get_the_title( $authors->ID );
																						$author_list .= '</a>,';
																					?>

																				<?php endforeach;
																				echo substr($author_list,0,-1);
																				} ?>
																		<?php endif; ?>
																</span>
															<?php
															if ($enabled_price != 'No') {
																$_price = $product->get_price();
															?>
																<span class="book-price">
																	<b>
																		<?php print wc_price($_price); ?>
																	</b>
																</span>
															<?php
															}
															?>

														</div><!--End book-info-->
													</div>
										</div>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								</div>
						</div><!--End swiper-wrapper-->
						<div class="btn-prev feature-button-prev-<?php echo esc_attr($id_ran)?>"></div>
						<div class="btn-next feature-button-next-<?php echo esc_attr($id_ran)?>"></div>
						<script>
							(function($) {
								"use strict";
								var bookFeatures_<?php print($id_ran); ?> = new Swiper('.book-slider-feature-<?php print($id_ran); ?>', {
									slidesPerView: <?php print($perview_slide); ?>,
									slidesPerGroup: <?php print($perview_slide); ?>,
									breakpoints: {
										320: {
											slidesPerView: 1,
											slidesPerGroup: 1,
										},
										// when window width is <= 480px
										480: {
											slidesPerView: <?php print($perview_slide - 3 > 0 ? $perview_slide - 3 : 1); ?>,
											slidesPerGroup: <?php print($perview_slide - 3 > 0 ? $perview_slide - 3 : 1); ?>
										},
										// when window width is <= 640px
										640: {
											slidesPerView: <?php print($perview_slide - 2 > 0 ? $perview_slide - 2 : 1); ?>,
											slidesPerGroup: <?php print($perview_slide - 2 > 0 ? $perview_slide - 2 : 1); ?>,
										},
										// when window width is <= 640px
										991: {
											slidesPerView: <?php print($perview_slide - 1 > 0 ? $perview_slide - 1 : 1); ?>,
											slidesPerGroup: <?php print($perview_slide - 1 > 0 ? $perview_slide - 1 : 1); ?>
										}
									},
									grabCursor:true,
									speed: 1000,
									navigation: {
										nextEl: '.feature-button-next-<?php echo esc_attr($id_ran)?>',
										prevEl: '.feature-button-prev-<?php echo esc_attr($id_ran)?>',
									},
								});
							})(jQuery);
						</script>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php
		if ($option == 'deflection') {
	?>

	<div class="feature-section <?php print($type); ?> <?php print($full_bg) ?>" style="background-color:<?php print($color); ?>">
		<div class="container">
		<div class="book-features">
			<div class="title-box <?php print($class_center); ?>"><span><?php print($slide_title); ?></span></div>

			<div class="swiper-container book-slider-feature book-slider-feature-<?php print($id_ran); ?> <?php print($class_deflection); ?>">
					<!-- Additional required wrapper -->

					<div class="swiper-wrapper">
					<?php
						if ($category != '') {
								$args = array(
										'post_type' => 'product',
										'posts_per_page' => $slide_number,
										'order' => 'DESC' ,
										'tax_query' => array(
											'relation' => 'OR',
											array(
													'taxonomy' => 'product_cat',
													'field' => 'slug',
													'terms' => $category
											),
								),
							);
					}
					else{
						$args = array(
										'post_type' => 'product',
										'posts_per_page' => $slide_number,
										'order' => 'DESC' ,
							);
					}
							$loop = new WP_Query( $args );

						?>

					<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>
							<?php
								global $product;
								$rating_count = $product->get_rating_count();
								$average = $product->get_average_rating();
								$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
								$style_product = '';
								if($none_book == 'on'){
									$style_product = 'none-book';
								}
							?>
								<div class="swiper-slide">

										<div class="book-item-slide">
											<div class="book-item <?php echo esc_attr($style_product) ?>">
												<div class="book-image">
													<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
												</div>
												<div class="book-actions">
													<div class="list-action">
														<?php
															if ($enabled_add_cart != 'No') {
																do_action( 'woocommerce_after_shop_loop_item' );
															}
														?>
														<?php
															if ($enabled_wishlist != 'No') {
																echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
															}
														?>
													</div><!--End list-action-->
												</div>
											</div><!--End book-item-->
											<div class="book-info woocommerce">
												<?php if ( $rating_count > 0 ) : ?>
													<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'bebostore' ), $average ); ?>">
									<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
										<strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'bebostore' ), '<span>', '</span>' ); ?>
										<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'bebostore' ), '<span class="rating">' . $rating_count . '</span>' ); ?>
									</span>
								</div>
												<?php endif; ?>
												<span class="book-name"><a href="<?php echo esc_url( get_permalink($loop->post->ID)); ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?></a></span>
												<span class="book-author">
													<?php
															$author = get_field('field_book_author');
													?>
														<?php if( $author ): ?>
																<?php esc_html_e('by:', 'bebostore'); ?>
																<?php
																if(count($author) == 1){
																foreach( $author as $authors ): ?>

																		<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
																<?php endforeach;
																	}
																else{
																?>
																<?php $author_list = ''; ?>
																<?php foreach( $author as $authors ): ?>
																	<?php
																		$author_list .= '<a href="'.esc_url(get_permalink( $authors->ID )).'" target="blank">';
																		$author_list .= get_the_title( $authors->ID );
																		$author_list .= '</a>,';
																	?>

																<?php endforeach;
																echo substr($author_list,0,-1);
																} ?>
														<?php endif; ?>
												</span>
									<?php
													if ($enabled_price != 'No') {
														$_price = $product->get_price();
													?>
														<span class="book-price">
															<b>
																<?php print wc_price($_price); ?>
															</b>
														</span>
													<?php
													}
											?>
											</div><!--End book-info-->
										</div>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
			</div><!--End swiper-wrapper-->
			<div class="btn-prev feature-button-prev-<?php echo esc_attr($id_ran)?>"></div>
			<div class="btn-next feature-button-next-<?php echo esc_attr($id_ran)?>"></div>
			<script>
				(function($) {
					"use strict";
					var bookFeatures_<?php print($id_ran); ?> = new Swiper('.book-slider-feature-<?php print($id_ran); ?>', {
						slidesPerView: <?php print($perview_slide); ?>,
						slidesPerGroup: <?php print($perview_slide); ?>,
						breakpoints: {
							320: {
								slidesPerView: 1,
								slidesPerGroup: 1,
							},
							// when window width is <= 480px
							480: {
								slidesPerView: <?php print($perview_slide - 3 > 0 ? $perview_slide - 3 : 1); ?>,
								slidesPerGroup: <?php print($perview_slide - 3 > 0 ? $perview_slide - 3 : 1); ?>
							},
							// when window width is <= 640px
							640: {
								slidesPerView: <?php print($perview_slide - 2 > 0 ? $perview_slide - 2 : 1); ?>,
								slidesPerGroup: <?php print($perview_slide - 2 > 0 ? $perview_slide - 2 : 1); ?>,
							},
							// when window width is <= 640px
							991: {
								slidesPerView: <?php print($perview_slide - 1 > 0 ? $perview_slide - 1 : 1); ?>,
								slidesPerGroup: <?php print($perview_slide - 1 > 0 ? $perview_slide - 1 : 1); ?>
							}
						},
						grabCursor:true,
						speed: 1000,
						navigation: {
							nextEl: '.feature-button-next-<?php echo esc_attr($id_ran)?>',
							prevEl: '.feature-button-prev-<?php echo esc_attr($id_ran)?>',
						},
					});

				})(jQuery);
			</script>
			</div>
		</div>
	</div>

	<?php } ?>
	<?php

	if ($option == 'zoom') {
	?>
	<section>
		<div class="hightlight-slider-section <?php print($type); ?> <?php print($full_bg) ?> sc-product-slider" style="background-color:<?php print($color); ?>">
			<div class="container">
				<div class="book-hightlight-slider">
					<?php if( !empty($slide_title) ) { ?>
					<div class="title-box <?php print($class_center); ?> title-"><span><?php print($slide_title); ?></span></div>
					<?php } ?>
					<div class="clearfix"></div>
					<div class="swiper-container book-slider-hightlight book-slider-hightlight-<?php print($id_ran); ?>">
							<!-- Additional required wrapper -->

							<div class="swiper-wrapper">
									<?php
										if ($category != '') {
												$args = array(
														'post_type' => 'product',
														'posts_per_page' => $slide_number,
														'order' => 'DESC' ,
														'tax_query' => array(
															'relation' => 'OR',
															array(
																	'taxonomy' => 'product_cat',
																	'field' => 'slug',
																	'terms' => $category
															),
												),
											);
									}
									else{
										$args = array(
														'post_type' => 'product',
														'posts_per_page' => $slide_number,
														'order' => 'DESC' ,
											);
									}
											$loop = new WP_Query( $args );

										?>

									<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>
											<?php
												global $product;
												$rating_count = $product->get_rating_count();
												$average = $product->get_average_rating();
												$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
												$style_product = '';
												if($none_book == 'on'){
													$style_product = 'none-book';
												}
											?>
												<div class="swiper-slide">

														<div class="book-item-slide">
															<div class="book-item <?php echo esc_attr($style_product); ?>">
																<div class="book-image">
																	<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
																</div>
																<div class="book-actions">
																	<div class="list-action">
																		<?php
																			if ($enabled_add_cart != 'No') {
																				do_action( 'woocommerce_after_shop_loop_item' );
																			}
																		?>
																		<?php
																			if ($enabled_wishlist != 'No') {
																				echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
																			}
																		?>
																	</div><!--End list-action-->
																</div>
															</div><!--End book-item-->
															<div class="book-info woocommerce">
																<?php if ( $rating_count > 0 ) : ?>
																	<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'bebostore' ), $average ); ?>">
													<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
														<strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'bebostore' ), '<span>', '</span>' ); ?>
														<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'bebostore' ), '<span class="rating">' . $rating_count . '</span>' ); ?>
													</span>
												</div>
																<?php endif; ?>
																<span class="book-name"><a href="<?php echo esc_url(get_permalink($loop->post->ID)); ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?></a></span>
																<span class="book-author">
																	<?php
																			$author = get_field('field_book_author');
																	?>
																		<?php if( $author ): ?>
																				<?php esc_html_e('by:', 'bebostore'); ?>
																				<?php
																				if(count($author) == 1){
																				foreach( $author as $authors ): ?>

																						<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
																				<?php endforeach;
																					}
																				else{
																				?>
																				<?php $author_list = ''; ?>
																				<?php foreach( $author as $authors ): ?>
																					<?php
																						$author_list .= '<a href="'.esc_url(get_permalink( $authors->ID )).'" target="blank">';
																						$author_list .= get_the_title( $authors->ID );
																						$author_list .= '</a>,';
																					?>

																				<?php endforeach;
																				echo substr($author_list,0,-1);
																				} ?>
																		<?php endif; ?>
																</span>
																<?php
																	if ($enabled_price != 'No') {
																		$_price = $product->get_price();
																	?>
																		<span class="book-price">
																			<b>
																				<?php print wc_price($_price); ?>
																			</b>
																		</span>
																	<?php
																	}
															?>
															</div><!--End book-info-->
														</div>
											</div>
										<?php endwhile; ?>
										<?php wp_reset_postdata(); ?>
									</div>
					</div><!--End .book-slider-feature-->
					<div class="btn-prev hightlight-button-prev-<?php echo esc_attr($id_ran)?>"></div>
						<div class="btn-next hightlight-button-next-<?php echo esc_attr($id_ran)?>"></div>
					<script>
						(function($) {
							"use strict";
							var bookHightlight_<?php print($id_ran); ?> = new Swiper('.book-slider-hightlight-<?php print($id_ran); ?>', {
								speed: 1000,
								paginationClickable: true,
									centeredSlides: true,
									slidesPerView: <?php print($perview_slide); ?>,
									breakpoints: {
										320: {
											slidesPerView: 1,
										},
										// when window width is <= 480px
										480: {
											slidesPerView: <?php print($perview_slide - 3 > 0 ? $perview_slide - 3 : 1); ?>,
										},
										// when window width is <= 640px
										640: {
											slidesPerView: <?php print($perview_slide - 2 > 0 ? $perview_slide - 2 : 1); ?>,
										},
										// when window width is <= 640px
										991: {
											slidesPerView: <?php print($perview_slide - 1 > 0 ? $perview_slide - 1 : 1); ?>,
										}
									},
									initialSlide: 2,
									loop:true,
									watchActiveIndex: false,
									speed: 1000,
									navigation: {
										nextEl: '.hightlight-button-next-<?php echo esc_attr($id_ran)?>',
										prevEl: '.hightlight-button-prev-<?php echo esc_attr($id_ran)?>',
									},
							});
						})(jQuery);
					</script>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>

	<?php
	if ($option == 'scroll') {
	$width = $slide_number*145;
	?>
		<div class="full-book-slide <?php print($type); ?> list-full" style="background-color:<?php print($color); ?>">
			<div class="book-list-full-feature">
				<div class="title-box <?php print($class_center); ?>"><span><?php print($slide_title); ?></span></div>
				<div class="swiper-container book-full-slider-feature book-full-slider-feature-<?php print($id_ran); ?> slider-with-scroll">
						<!-- Additional required wrapper -->
					<div class="swiper-scrollbar feature-scrollbar feature-scrollbar-<?php print($id_ran); ?>"></div>
						<div class="swiper-wrapper">
								<!-- Slides -->
							<?php
									if ($category != '') {
											$args = array(
													'post_type' => 'product',
													'posts_per_page' => $slide_number,
													'order' => 'DESC' ,
													'tax_query' => array(
														'relation' => 'OR',
														array(
																'taxonomy' => 'product_cat',
																'field' => 'slug',
																'terms' => $category
														),
											),
										);
								}
								else{
									$args = array(
													'post_type' => 'product',
													'posts_per_page' => $slide_number,
													'order' => 'DESC' ,
										);
								}
										$loop = new WP_Query( $args );
																		?>

									<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>
											<?php
												global $product;
												$rating_count = $product->get_rating_count();
												$average = $product->get_average_rating();
												$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
												$style_product = '';
												if($none_book == 'on'){
													$style_product = 'none-book';
												}
											?>
								<div class="swiper-slide" style="width:<?php print($width); ?>px;">

														<div class="book-item-slide">
															<div class="book-item <?php echo esc_attr($style_product) ?>">
																<div class="book-image">
																	<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
																</div>
																<div class="book-actions">
																	<div class="list-action">
																		<?php
																			if ($enabled_add_cart != 'No') {
																				do_action( 'woocommerce_after_shop_loop_item' );
																			}
																		?>
																		<?php
																			if ($enabled_wishlist != 'No') {
																				echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
																			}
																		?>
																	</div><!--End list-action-->
																</div>
															</div><!--End book-item-->
															<div class="book-info woocommerce">
																<?php if ( $rating_count > 0 ) : ?>
																	<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'bebostore' ), $average ); ?>">
													<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
														<strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'bebostore' ), '<span>', '</span>' ); ?>
														<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'bebostore' ), '<span class="rating">' . $rating_count . '</span>' ); ?>
													</span>
												</div>
																<?php endif; ?>
																<span class="book-name"><a href="<?php echo esc_url(get_permalink($loop->post->ID)); ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?></a></span>
																<span class="book-author">
																	<?php
																			$author = get_field('field_book_author');
																	?>
																		<?php if( $author ): ?>
																				<?php esc_html_e('by:', 'bebostore'); ?>
																				<?php
																				if(count($author) == 1){
																				foreach( $author as $authors ): ?>

																						<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
																				<?php endforeach;
																					}
																				else{
																				?>
																				<?php $author_list = ''; ?>
																				<?php foreach( $author as $authors ): ?>
																					<?php
																						$author_list .= '<a href="'.esc_url(get_permalink( $authors->ID )).'" target="blank">';
																						$author_list .= get_the_title( $authors->ID );
																						$author_list .= '</a>,';
																					?>

																				<?php endforeach;
																				echo substr($author_list,0,-1);
																				} ?>
																		<?php endif; ?>
																</span>
																<?php
																	if ($enabled_price != 'No') {
																		$_price = $product->get_price();
																	?>
																		<span class="book-price">
																			<b>
																				<?php print wc_price($_price); ?>
																			</b>
																		</span>
																	<?php
																	}
															?>
															</div><!--End book-info-->
														</div>
								</div><!--End swiper-slide-->

										<?php endwhile; ?>
										<?php wp_reset_postdata(); ?>
						</div><!--End swiper-wrapper-->

				</div><!--End .book-slider-feature-->
				<script>
					(function($) {
						"use strict";
						var bookFeatures_<?php print($id_ran); ?> = new Swiper('.book-full-slider-feature-<?php print($id_ran); ?>', {
							slidesPerView: <?php print($perview_slide); ?>,
							breakpoints: {
								320: {
									slidesPerView: 1,
								},
								// when window width is <= 480px
								480: {
									slidesPerView: <?php print($perview_slide - 3 > 0 ? $perview_slide - 3 : 1); ?>,
								},
								// when window width is <= 640px
								640: {
									slidesPerView: <?php print($perview_slide - 2 > 0 ? $perview_slide - 2 : 1); ?>,
								},
								// when window width is <= 640px
								991: {
									slidesPerView: <?php print($perview_slide - 1 > 0 ? $perview_slide - 1 : 1); ?>,
								}
							},
								scrollContainer: true,
								scrollbar: {
									el: '.feature-scrollbar-<?php print($id_ran); ?>',
									draggable: true,
								}
							});
					})(jQuery);
				</script>
			</div>
		</div><!--End full-book slide-->
	<?php } ?>
	<?php
	if ($option == 'two-line') {
	$width = ceil($slide_number/2)*290;
	?>
	<div class="full-book-slide list-full monthly-deal <?php print($type); ?>" style="background-color:<?php print($color); ?>">
		<div class="book-list-full-page">
			<div class="title-box <?php print($class_center); ?>"><span><?php print($slide_title); ?></span></div>
			<div class="swiper-container book-full-mothly-with-scroll book-full-mothly-with-scroll-<?php print($id_ran); ?> slider-with-scroll swiper-free-mode">
					<!-- Additional required wrapper -->
				<div class="swiper-scrollbar mothly-scrollbar" style="opacity: 0; transition-duration: 400ms;"></div>
					<div class="swiper-wrapper">
							<!-- Slides -->
						<?php
								if ($category != '') {
										$args = array(
												'post_type' => 'product',
												'posts_per_page' => $slide_number,
												'order' => 'DESC' ,
												'tax_query' => array(
													'relation' => 'OR',
													array(
															'taxonomy' => 'product_cat',
															'field' => 'slug',
															'terms' => $category
													),
										),
									);
							}
							else{
								$args = array(
												'post_type' => 'product',
												'posts_per_page' => $slide_number,
												'order' => 'DESC' ,
									);
							}
									$loop = new WP_Query( $args );
									$i = 2;

								?>
								<div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: <?php print($width); ?>px; height: 205px;">
								<div class="item-month-slide">
								<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>
										<?php
											global $product;
											$rating_count = $product->get_rating_count();
											$average = $product->get_average_rating();
											$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
											$style_product = '';
											if($none_book == 'on'){
												$style_product = 'none-book';
											}

										?>
													<div class="be-book-item">
										<div class="book-item <?php echo esc_attr($style_product) ?>">
											<div class="book-image">
												<a href="<?php echo esc_url(get_permalink($loop->post->ID)); ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
													<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="65px" height="115px" />'; ?>
												</a>
											</div>
										</div><!--End book-item-->
										<div class="book-info woocommerce">
											<span class="book-name"><a href="<?php echo esc_url(get_permalink($loop->post->ID)); ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?></a></span>
											<span class="book-author">
																	<?php
																			$author = get_field('field_book_author');
																	?>
																		<?php if( $author ): ?>
																				<?php esc_html_e('by:', 'bebostore'); ?>
																				<?php
																				if(count($author) == 1){
																				foreach( $author as $authors ): ?>

																						<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
																				<?php endforeach;
																					}
																				else{
																				?>
																				<?php $author_list = ''; ?>
																				<?php foreach( $author as $authors ): ?>
																					<?php
																						$author_list .= '<a href="'.esc_url(get_permalink( $authors->ID )).'" target="blank">';
																						$author_list .= get_the_title( $authors->ID );
																						$author_list .= '</a>,';
																					?>

																				<?php endforeach;
																				echo substr($author_list,0,-1);
																				} ?>
																		<?php endif; ?>
																</span>
											<?php
																	if ($enabled_price != 'No') {
																		$_price = $product->get_price();
																	?>
																		<span class="book-price">
																			<b>
																				<?php print wc_price($_price); ?>
																			</b>
																		</span>
																	<?php
																	}
															?>
										</div><!--End book-info-->
									</div>
												<div class="clearfix"></div>
											<?php if ($i%2 != 0) {?>
												</div>
											</div>
												<div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: <?php print($width); ?>px; height: 205px;">
												<div class="item-month-slide">
											<?php
												}
												$i++;
											?>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
							</div>
							</div><!--End swiper-slide-->
					</div><!--End swiper-wrapper-->

			</div><!--End .book-slider-feature-->
			<script>
				(function($) {
					"use strict";
					var monThyDeal_<?php print($id_ran); ?> = new Swiper('.book-full-mothly-with-scroll-<?php print($id_ran); ?>', {
						slidesPerView: <?php print($perview_slide); ?>,
						breakpoints: {
							320: {
								slidesPerView: 1,
							},
							// when window width is <= 480px
							480: {
								slidesPerView: <?php print($perview_slide - 3 > 0 ? $perview_slide - 3 : 1); ?>,
							},
							// when window width is <= 640px
							640: {
								slidesPerView: <?php print($perview_slide - 2 > 0 ? $perview_slide - 2 : 1); ?>,
							},
							// when window width is <= 640px
							991: {
								slidesPerView: <?php print($perview_slide - 1 > 0 ? $perview_slide - 1 : 1); ?>,
							}
						},
							scrollContainer: true,
							scrollbar: {
								el: '.mothly-scrollbar',
									draggable: true,
							}
						});
				})(jQuery);
			</script>
		</div>
	</div>
	<?php } ?>
	<?php if ($option == 'normal') {
	?>
	<div class="feature-section product-nomal <?php print($type); ?> <?php echo esc_attr($full_bg) ?>" style="background-color:<?php print($color); ?>">
		<div class="">
			<div class="title-box <?php print($class_center); ?>"><span><?php print($slide_title); ?></span></div>
			<div class="book-features">
				<?php
						if ($category != '') {
								$args = array(
										'post_type' => 'product',
										'posts_per_page' => $slide_number,
										'order' => 'DESC' ,
										'tax_query' => array(
											'relation' => 'OR',
											array(
													'taxonomy' => 'product_cat',
													'field' => 'slug',
													'terms' => $category
											),
								),
							);
					}
					else{
						$args = array(
										'post_type' => 'product',
										'posts_per_page' => $slide_number,
										'order' => 'DESC' ,
							);
					}
							$loop = new WP_Query( $args );

						?>

					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php
								global $product;
								$rating_count = $product->get_rating_count();
								$average = $product->get_average_rating();
								$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
								$style_product = '';
								if($none_book == 'on'){
									$style_product = 'none-book';
								}
							?>
										<div class="book-item-slide">
											<div class="book-item <?php echo esc_attr($style_product); ?>">
												<div class="book-image">
													<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
												</div>
												<div class="book-actions">
													<div class="list-action">
														<?php
															if ($enabled_add_cart != 'No') {
																do_action( 'woocommerce_after_shop_loop_item' );
															}
														?>
														<?php
															if ($enabled_wishlist != 'No') {
																echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
															}
														?>
													</div><!--End list-action-->
												</div>
											</div><!--End book-item-->
											<div class="book-info woocommerce">
												<?php if ( $rating_count > 0 ) : ?>
													<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'bebostore' ), $average ); ?>">
									<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
										<strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'bebostore' ), '<span>', '</span>' ); ?>
										<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'bebostore' ), '<span class="rating">' . $rating_count . '</span>' ); ?>
									</span>
								</div>
												<?php endif; ?>
												<span class="book-name"><a href="<?php echo esc_url(get_permalink($loop->post->ID)) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?></a></span>
												<span class="book-author">
													<?php
															$author = get_field('field_book_author');
													?>
														<?php if( $author ): ?>
																<?php esc_html_e('by:', 'bebostore'); ?>
																<?php
																if(count($author) == 1){
																foreach( $author as $authors ): ?>

																		<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
																<?php endforeach;
																	}
																else{
																?>
																<?php $author_list = ''; ?>
																<?php foreach( $author as $authors ): ?>
																	<?php
																		$author_list .= '<a href="'.esc_url(get_permalink( $authors->ID )).'" target="blank">';
																		$author_list .= get_the_title( $authors->ID );
																		$author_list .= '</a>,';
																	?>

																<?php endforeach;
																echo substr($author_list,0,-1);
																} ?>
														<?php endif; ?>
												</span>
												<?php
													if ($enabled_price != 'No') {
														$_price = $product->get_price();
													?>
														<span class="book-price">
															<b>
																<?php print wc_price($_price); ?>
															</b>
														</span>
													<?php
													}
											?>
											</div><!--End book-info-->
										</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
		</div>
		</div>
	</div>
	<?php } ?>
<?php endif; ?>
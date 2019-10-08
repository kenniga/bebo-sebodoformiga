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
		$category = get_term_by('slug',$category,'product_types');
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
	<?php } 
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

	<?php } 
	if ($option == 'zoom') {
		?>
		<section>
			<div class="hightlight-slider-section <?php print($type); ?> <?php print($full_bg) ?> sc-product-slider" style="background-color:<?php print($color); ?>">
				<div class="container">
					<div class="book-hightlight-slider row">
						<?php if( !empty($slide_title) ) { ?>
						<div class="title-box <?php print($class_center); ?> title-"><span><?php print($slide_title); ?></span></div>
						<?php } ?>
						<div class="clearfix"></div>
						<div class="swiper-container book-slider-hightlight book-slider-hightlight-<?php print($id_ran); ?> col-12">
							<!-- Additional required wrapper -->
							<div class="swiper-wrapper row flex-sm-nowrap">
								<?php
									if(isMobileDevice()){
										$slide_number = 6;
									}
									if ($category != '') {
										$args = array(
											'post_type' => 'product',
											'posts_per_page' => $slide_number,
											'order' => 'DESC' ,
											'tax_query' => array(
												'relation' => 'OR',
												array(
														'taxonomy' => 'product_types',
														'field' => 'slug',
														'terms' => $category
												),
											),
										);
									}
									else {
										$args = array(
											'post_type' => 'product',
											'posts_per_page' => $slide_number,
											'order' => 'DESC' ,
										);
									}
									
									$loop_products = get_posts( $args );

									if( $loop_products ): 

										foreach( $loop_products as $loop_product ): 
											
											$none_book = get_post_meta( $loop_product->ID,'_beautheme_product_none_book', TRUE);
											$style_product = '';
											if($none_book == 'on'){
												$style_product = 'none-book';
											}
											
											?>
											
											<div class="swiper-slide col-sm-auto col-6">
												<div class="book-item-slide">
													<div class="book-item <?php echo esc_attr($style_product); ?>">
														<div class="book-image">
															<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop_product->ID ), 'single-post-thumbnail' );?>
																<img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop_product->ID; ?>">
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
														<span class="book-name">
															<a href="<?php echo esc_url(get_permalink($loop_product->ID)); ?>" title="<?php echo esc_attr($loop_product->post_title ? $loop_product->post_title : $loop_product->ID); ?>">
																<?php echo $loop_product->post_title; ?>
															</a>
														</span>
														<span class="book-author">
															<?php
																$author = !empty(get_fields($loop_product->ID)['book_author']) ? get_fields($loop_product->ID)['book_author'] : '';
															?>
																<?php if( $author ): ?>
																	<?php esc_html_e('by:', 'bebostore'); ?>
																	<?php
																	if(count($author) == 1){
																		foreach( $author as $authors ): ?>
																			<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
																		<?php endforeach;
																	} else {
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
														</div><!--End book-info-->
													</div>
												</div>
											<?php
									
										 endforeach;
									
									endif; 
								?>

							</div>
						</div><!--End .book-slider-feature-->
						<div class="btn-prev hightlight-button-prev-<?php echo esc_attr($id_ran)?>"></div>
							<div class="btn-next hightlight-button-next-<?php echo esc_attr($id_ran)?>"></div>
						<script>
							(function($) {
								"use strict";

								var isMobile = false; //initiate as false
								// device detection
								if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
									|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
									isMobile = true;
								}
								if( !isMobile ) {
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
								}
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
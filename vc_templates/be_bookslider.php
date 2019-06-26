<?php
$products = $title_single = $flip = $enabled_price = "";
extract(shortcode_atts(array(
    'products' => '',
    'title_single' => '',
    'flip' => '',
    'enabled_price' => ''
), $atts));
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
	global $beau_option;
	if (isset($beau_option['disable_3d'])) {
	$disable_3d = $beau_option['disable_3d'];
	}
	?>
	<div class="best-seller-section-option2 woocommerce sc-single-book">

		<div class="container">
			<div class="title-box title-best">
				<span><?php print($title_single); ?></span>
			</div>
			<div class="swiper-bookslider">
				<div class="swiper-wrapper best-seller">
				<?php 
				
					$products = explode(", ",$products);
					// sebodo_debug($products);
					for ($i=0; $i < sizeof($products) ; $i++) { 
						$id_product = (int) $products[$i];
						$product = new WC_Product( $id_product );
						$title_product = get_the_title($id_product);
						$price = $product->get_price_html();
						// woo:3.x
						$categories = wc_get_product_category_list($product->get_id());
						// $categories = $product->get_categories();
						$product_description = get_post($id_product)->post_content;
						$rating_count = $product->get_rating_count();
						$average = $product->get_average_rating();
						$feat_image = wp_get_attachment_url( get_post_thumbnail_id($id_product) );
						$none_book = get_post_meta( $id_product,'_beautheme_product_none_book', TRUE);
						?>
						<div class="swiper-slide">
							<div class="book-bestseller">
								<div class="book-info bestseller-name col-md-4 col-sm-4 col-xs-12">
									<span class="book-name">
										<a href="<?php echo esc_url(get_permalink($id_product)); ?>"><?php print($title_product); ?></a>
									</span>
									<span class="book-author">
										<?php
										$author = get_field('field_book_author', $id_product);
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
											<?php foreach( $author as $authors ): ?>
												<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>,
											<?php endforeach; ?>
											<?php } ?>
										<?php endif; ?>
									</span>
									<span class="book-rate">
										<?php if ( $rating_count > 0 ) : ?>
											<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'bebostore' ), $average ); ?>">
												<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
													<strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'bebostore' ), '<span>', '</span>' ); ?>
													<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'bebostore' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
												</span>
											</div>
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
								<div class="book-hot col-md-4 col-sm-4 col-xs-12">
									<?php if ($disable_3d == 2): ?>
										<img src="<?php print($feat_image); ?>" alt="img-book"/>
									<?php endif ?>

									<?php if ($disable_3d != 2): ?>
										<ul id="bk-list" class="bk-list clearfix">
											<li>
												<div class="bk-book book-2 bk-bookdefault">
													<div class="list-action">
														<?php
															do_action( 'woocommerce_after_shop_loop_item' );
															echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
														?>
													</div>
													<div class="bk-front">
														<div class="bk-cover">
															<img src="<?php print($feat_image); ?>" alt="img-book"/>
														</div>
													</div>
													<div class="bk-back">
														<?php global $wp_query;
															$postid = $id_product;
															$posttype = 'product'; ?>

																<div class="page-header">
																<?php
																if (class_exists('MultiPostThumbnails')
																	&& MultiPostThumbnails::has_post_thumbnail($posttype, 'book-back-image', $postid)) :
																		MultiPostThumbnails::the_post_thumbnail($posttype, 'book-back-image', $postid, 'Page Header');
																	else : ?><img src="http://myblog.com/images/fallback-image.jpg" height="200" width="936" alt="San Francisco Skyline"/>
																<?php endif; ?>
																</div>

														<?php wp_reset_postdata(); ?>
													</div>
													<div class="bk-left">
														<h2>
															<span>
																<?php
																	$book_spine = get_field('book_spine', $id_product);
																	$author = get_field('field_book_author', $id_product);
																?>
																<?php
																if($book_spine != '') {
																	echo esc_attr($book_spine);
																} else {
																if( $author ): ?>
																	<?php
																		if(count($author) == 1){
																		foreach( $author as $authors ): ?>

																		<?php echo get_the_title( $authors->ID ); ?>
																	<?php endforeach;
																		}
																	else{
																	?>
																	<?php foreach( $author as $authors ): ?>
																		<?php echo get_the_title( $authors->ID ); ?>,
																	<?php endforeach; ?>
																	<?php } ?>
																<?php endif; ?>
																<?php } ?>
															</span>
														</h2>
													</div>
												</div>
												<div class="bk-info detail-book-action book-actions">
													<div class="list-action">
														<?php
															echo do_shortcode( '[add_to_cart id=' . $id_product . ']' );
															echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . $id_product . '"]' );
														?>
													</div>

												</div>
											</li>
										</ul>
									<?php endif ?>
								</div>

								<div class="book-description col-md-4 col-sm-4 col-xs-12">
									<div class="book-description-content">
										<span class="book-desc"><?php print(substr($product_description, 0, 200)); ?>...</span>
										<div class="clearfix"></div>
										<div class="book-tags">
											<!-- Woo: 3.x -->
											<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
										</div>
										<div class="swiper-button-prev d-none d-sm-inline-block">
											<i class="fa fa-chevron-left" aria-hidden="true"></i>
											Prev
										</div>
										<div class="swiper-button-next d-none d-sm-inline-block">
											Next 
											<i class="fa fa-chevron-right" aria-hidden="true"></i>
										</div>
									</div>

								</div>
							</div>
						</div>
						<?php
					} 
					wp_reset_postdata();

				?>
				</div>
				
			</div>
		</div>
	</div>

<?php endif; ?>
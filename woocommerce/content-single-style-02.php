<?php
	global $beau_option;
	if (isset($beau_option['disable_3d'])) {
		$disable_3d = $beau_option['disable_3d'];
	}
	$image_links  	= wp_get_attachment_image_url(get_post_thumbnail_id(),'woocommerce_single');

	$wishlist_setting = $beau_option['enabled-wishlist'];
	$show_price_setting = $beau_option['enabled-show-price'];
	$cart_setting = $beau_option['enabled-add-to-cart'];
	$disable_add_to_cart = get_field('disable_add_to_cart');
	$enable_affiliate = get_field('enable_affiliate');

	$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
	$style_product = '';
    if($none_book == 'on'){
    	$style_product = 'none-book';
    }
    $wishlist_left = '';
    if ($cart_setting == false) {
    	$wishlist_left = 'left-style';
    }
?>
<div itemscope  id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section>
		<div class="detail-book">
			<div class="book-detail-container">
				<div class="container">
					<div class="row">
						<div class="book-detail book-full-view col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-12">
									<div class="book-details-item">
										<?php if ($none_book != 'on'){ ?>
											<?php if ($disable_3d == 2): ?>
												<img src="<?php print($image_links); ?>" alt="img-book"/>
												<span class="disk"></span>
											<?php endif ?>

											<?php if ($disable_3d != 2): ?>
											<ul id="bk-list" class="bk-list clearfix">
												<li>
													<div class="bk-book book-2 bk-bookdefault">
														<div class="bk-front">
															<div class="bk-cover">
																<img src="<?php print($image_links); ?>" alt="img-book"/>
															</div>
														</div>
														<div class="bk-back">
															<?php if (class_exists('MultiPostThumbnails')) :
																MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'book-back-image', NULL,  'woocommerce_single');
															endif; ?>
														</div>
														<div class="bk-left">
															<h2>
																<span>
																	<?php
																		$book_spine = get_field('book_spine');
																		$author = get_field('field_book_author');
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
													<div class="bk-info detail-book-action">
													<?php
														if (isset($beau_option['flip-book'])) {
													?>
													<div class="flip-book">
													<button class="bk-bookback"><?php _e('Flip to back', 'bebostore');?></button>
													</div>
													<?php
														}
													?>

													</div>
												</li>
											</ul>
											<?php endif ?>
											<div class="woocommerce-product-gallery">
												<div class="woocommerce-product-gallery__wrapper">
													<?php do_action( 'woocommerce_product_thumbnails' ); ?>
												</div>
											</div>
										<?php } else { ?>
											<img src="<?php print($image_links); ?>" alt="img-book"/>
											<?php
										}
										?>
									</div>

								</div>

								<div class="book-item-detail col-md-6 col-sm-6 col-12">

									<?php
										$ISBN = get_post_meta( get_the_ID(), '_beautheme_product_ISBN', true );
										/**
										 * woocommerce_single_product_summary hook
										 *
										 * @hooked woocommerce_template_single_title - 5
										 * @hooked woocommerce_template_single_rating - 10
										 * @hooked woocommerce_template_single_price - 10
										 * @hooked woocommerce_template_single_excerpt - 20
										 * @hooked woocommerce_template_single_add_to_cart - 30
										 * @hooked woocommerce_template_single_meta - 40
										 * @hooked woocommerce_template_single_sharing - 50
										 */
										// echo woocommerce_template_single_meta();
										echo woocommerce_template_single_title();

									?>
									
									<?php if( $enable_affiliate == true ): ?>
										<div class="affiliate">
											<?php

												if ($show_price_setting != '1') {
													echo woocommerce_template_single_price();
												}
												if ($cart_setting != '1') {

													if($disable_add_to_cart != true){
														echo woocommerce_template_single_add_to_cart();
													}
													else {
													?>
														<div class="cart">
															<button class="button active"><?php esc_html_e('Add to cart','bebostore')?></button>
														</div>
													<?php
													}
												}
												if ($wishlist_setting == '2') {
												?>
													<div class="<?php print($wishlist_left) ?>">
														<?php
															echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
														?>
													</div>
												<?php
												}
											?>

											<ul class="affiliate-farm">
												<?php
												$retailers  = get_field('field_retailers');
												$count = count($retailers);
												if ($count > 0) {
													for ($i=0; $i < $count; $i++) {
														$item = $retailers[$i];
														$text_link_buy_retailer = $item['text_link_buy_retailer'];
														$product_url = $item['product_url'];
														$product_price = $item['product_price'];
														$name_url = explode('.', domain($product_url));
														$type_retailers = $item['type_retailers'];
														?>
														<?php
															$args = array(
																'post_type'=> 'retailers',
																'p' => $type_retailers
															);
															$loop = new WP_Query( $args);

														?>
														<?php while ( $loop->have_posts() ) : $loop->the_post();?>
															<?php
																$icon_retailer = get_field('icon_retailer');
															?>
														<?php
															endwhile;
															wp_reset_postdata();
														?>
															<li class="item-affiliate">
																<div class="icon">
																	<a href="<?php echo esc_attr($product_url) ?>">
																	<?php
																		if ($icon_retailer == '') {
																			echo esc_attr($name_url[0]);
																		}
																		else{
																		?>
																			<img src="<?php print($icon_retailer); ?>" alt="img-retailer"/>
																		<?php
																		}
																	?>
																	</a>
																</div>
																<span class="button-affiliate">
																	<?php
																		echo get_woocommerce_currency_symbol();
																		echo esc_attr($product_price) ;
																	?>
																</span>
															</li>
														<?php
													}
												}
												?>
											</ul>
											<span class="hidden-button"><a href="#"><?php esc_html_e('Hidden','bebostore')?></a></span>
										</div>
									<?php endif; ?>

									<?php if( $enable_affiliate != true ): ?>
										<div class="product-status">
										<?php
											if ($show_price_setting != '1') {
												echo woocommerce_template_single_price();
												echo wc_get_stock_html( $product ); // WPCS: XSS ok.
											}
											?>
										</div>
										<div class="row align-items-center mt-4">
										
										<?php

											if ($cart_setting != '1') {
												?>
												<?php
												if($disable_add_to_cart != true){
													echo woocommerce_template_single_add_to_cart();
												} else {
													?>
												<div class="cart">
													<button class="button active"><?php esc_html_e('Add to cart','bebostore')?></button>
												</div>
												<?php
												}
											}
											if ($wishlist_setting == '2') {
												?>
												<div class="col-12 text-right">
													<div class="single-button-wishlist">
														<?php
															echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
														?>
													</div>
												</div>
											<?php
											}
										?>
										</div>

									<?php endif; ?>
									<div class="row single-taxonomies-section">
										<div class="col-12">
											<?php
												$category_name_item = wc_get_product_category_list(
													get_the_ID( $product ),
													', ', 
													'<div class="category_as">' . _n( 'Categories:', 'Categories:', 'bebostore' ) . ' ', 
													'</div>'
												);
												print($category_name_item);
												$pinImage = $image_links;
											?>
										</div>
									</div>
									<div class="clearfix"></div>
									<?php
										$play_text = '';
										if ($product_type =="product_audio"){
											$play_text = __("Play audio","bebostore");
										}
										if ($product_type =="product_video"){
											$play_text = __("Play Video","bebostore");
										}
									?>
									<?php if ($product_type =="product_audio" || $product_type = "product_video") {?>
										<?php if ($play_text !="") {?>
										<div class="audio-iconplay"  data-toggle="modal" data-target="#preview-modal"><i class="fa fa-play"></i><a href="javascript:;" onclick="return false;"><?php echo esc_html($play_text); ?></a></div>
										<?php }?>
									<?php }?>

									<?php
									// This get media in with product using produc
										global  $wp_embed;
										$soundCloud_Url     = get_post_meta($post->ID, '_beautheme_product_with_soudcloud', TRUE);
										$video_EMbed        = get_post_meta($post->ID, '_beautheme_product_with_video', TRUE);
										$mp3Files           = get_field('field_files_mp3');
										if($soundCloud_Url) $mediaPlay      = $wp_embed->run_shortcode('[embed id="soundcloud-play" width="360" height="320"]'.$soundCloud_Url.'[/embed]');
										if($video_EMbed) $video_EMbed_play  = $wp_embed->run_shortcode('[embed width="780" height="440"]'.$video_EMbed.'[/embed]');
										if (function_exists('bebostore_findExtension')) {
											if (bebostore_findExtension($video_EMbed) == 'mp4') {
												$video_EMbed_play  = do_shortcode('[video width="780" height="440" mp4="'.$video_EMbed.'"] [/video]');
											}
										}
									?>
									<?php if($soundCloud_Url) printf('%s', $mediaPlay); ?>
									<?php
										if ($product_type =="product_audio" && $mp3Files) {
											$i=1;
										?>

										<script type="text/javascript">
											//<![CDATA[
											(function($){
												"use strict"
												$(document).ready(function($){

													jQuery("#singlebook_player").bind(jQuery.jPlayer.event.play, function (event)
													{
														var current = beauPlaylist.current, playlist = beauPlaylist.playlist;
														jQuery.each(playlist, function (index, obj){
															if (index == current){
																$('#jp-song-name').html(obj.title);
																$('#jp-article-name').html(obj.artist);
															}
														});
													});
													//Setup and defined a playlist
													var beauPlaylist = new jPlayerPlaylist({
														jPlayer: "#singlebook_player",
														cssSelectorAncestor: "#jp_container_2",

													}, [
														<?php if($mp3Files){
															foreach ($mp3Files as $key => $value) {
														?>
														{
															title:"<?php print($value['file_mp3_name']); ?>",
															mp3:"<?php print($value['file_mp3']) ?>",
														},
														<?php }
															}
														?>
													], {
														supplied: "oga, mp3",
														wmode: "window",
														useStateClassSkin: true,
														autoBlur: false,
														smoothPlayBar: true,
														keyEnabled: true
													});

													// Play list custom
													$('.item-play').click(function() {
														$('.item-play').find('i').removeClass('fa-pause').addClass('fa-play');
														if (!$(this).hasClass('active')) {
															var songI       = $(this).attr('data-song');
															var currEntPlay = $(this).find('i');
															$('.item-play').removeClass('active');
															$(this).addClass('active').find('i').removeClass('fa-play').addClass('fa-pause');
															beauPlaylist.play(songI);
															$('.audio-iconplay').find('i').removeClass('fa-play').addClass('fa-pause');
														}else{
															$(this).removeClass('active').find('i').removeClass('fa-pause').addClass('fa-play')
															$('.audio-iconplay').find('i').removeClass('fa-pause').addClass('fa-play');
															$("#singlebook_player").jPlayer("stop");
														}
													});

													$('.audio-iconplay').click(function(event) {
														var checkStatus =  $(this).find('i');
														if (checkStatus.hasClass('fa-play')) {
															checkStatus.removeClass('fa-play').addClass('fa-pause');
															$('.item-play:first-child').click();
														}else{
															checkStatus.removeClass('fa-pause').addClass('fa-play');
															$('.item-play').removeClass('active').find('i').removeClass('fa-pause').addClass('fa-play');
															$("#singlebook_player").jPlayer("stop");
														}
													});

													$('.jp-play').click(function(event) {
														// beauPlaylist.play();
														$('.list-playlist .item-play:first-child()').click();
													});

												});
											})(jQuery);
											//]]>
										</script>
										<div id="inspection"></div>
										<ul class="list-playlist">
											<?php
											foreach ($mp3Files as $key => $value) {
												$activeClass = "";
												if ($i ==1) {
													$songName  = $value['file_mp3_name'];
												}
												?>
												<li class="item-play <?php print ($activeClass); ?>" data-song="<?php echo esc_html($i-1);?>">
													<span class="list-play seed-play-<?php echo esc_html($i);?>">
														<span class="item-bar"></span>
													</span>
													<div class="clearfix"></div>
													<p class="audio-time"><i class="fa fa-play"></i><?php echo esc_html($value['file_mp3_time']);?></p>
													<p class="audio-name"><?php print($value['file_mp3_name']); ?></p>
												</li>
												<?php $i++;
											} ?>
										</ul>
									<?php } ?>
								</div><!-- .summary -->
							
							</div>
						</div>
					</div>
					<div class="row mt-5 mt-sm-auto">
						<div class="about-this-book">
							<div class="container">
								<div class="row heading-details">
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="heading-box">
											<h5>
												DETAILS
											</h5>
										</div>
									</div>
									<div class="col-lg-9 col-sm-6 col-12 d-none d-sm-block">
										<div class="heading-box">
											<h5>
												DESCRIPTION
											</h5>
										</div>
									</div>
								</div>
								<?php
									$author = get_field('field_book_author');
									$editorial = get_post_meta( get_the_ID(), '_beautheme_editorial_reviews', true );
									$author = get_field('field_book_author');
									$publisher = get_field('field_book_publisher');
									$overview = get_the_content();
								?>
								<div class="row details-content">
									<div class="col-lg-3 col-sm-6 col-12">
										<?php 

											$product_types = get_the_terms( get_the_ID(), 'product_types' );
											$product_types = $product_types[0]->slug;
											if( $product_types == 'book' ) {
												if( $publisher ): ?>
													<div id="desc-detail" class="book-desc-detail">
														<?php foreach( $publisher as $publisher ): ?>
															<?php
																$id_publisher = $publisher->ID;
																$publishing_year_item = get_post_meta( get_the_ID(), '_beautheme_publishing_year', true );
																$publishing_page = get_post_meta( get_the_ID(), '_beautheme_page_count', true );
																$ISBN = get_post_meta( get_the_ID(), '_beautheme_product_ISBN', true );

															?>
															<span class="detail-desc box-detail-desc">
																<div class="row">
																	<div class="col-6">
																		<strong>
																			<?php _e('Pages', 'bebostore'); ?>
																		</strong>
																	</div>
																	<div class="col-6">
																		<span>
																			<?php print($publishing_page) ?> Pages
																		</span>
																	</div>
																	<?php if ($ISBN != '') { ?>
																		<div class="col-6">
																			<strong>
																				ISBN
																			</strong>
																		</div>
																		<div class="col-6">
																			<span>
																				<?php print $ISBN; ?>
																			</span>
																		</div>
																	<?php } ?>
																	<?php if ($product->get_sku()!='') { ?>
																		<div class="col-6">
																			<strong>
																				SKU
																			</strong>
																		</div>
																		<div class="col-6">
																			<span>
																				<?php print ($product->get_sku());?>
																			</span>
																		</div>
																	<?php } ?>
																	<div class="col-6">
																		<strong>
																			<?php _e('Publisher', 'bebostore'); ?>
																		</strong>
																	</div>
																	<div class="col-6">
																		<span>
																			<?php echo get_the_title($id_publisher) ;?>
																		</span>
																	</div>
																	<div class="col-6">
																		<strong>
																			<?php _e('Publish Year', 'bebostore'); ?>
																		</strong>
																	</div>
																	<div class="col-6">
																		<span>
																			<?php print($publishing_year_item) ?>
																		</span>
																	</div>
																</div>
															</span>
														<?php endforeach; ?>
													</div>
												<?php endif;

											} elseif ( $product_types == 'audio-cd' || $product_types == 'cassette' || $product_types == 'vinyl' ) {
												?>
												<div id="desc-detail" class="book-desc-detail">
													<?php
														$artist = get_field('artist');
														$album = get_field('album');
														$labels = get_field('label');
														$original_release = get_field('original_release');
														$format = !empty(get_field('format')) ? get_field('format') : '';
														$condition = !empty(get_field('condition')) ? get_field('condition') : '';


													?>
													<span class="detail-desc box-detail-desc">
														<div class="row">
															<?php if ($artist != '') { ?>
															<div class="col-6">
																<strong>
																	<?php _e('Artist', 'bebostore'); ?>
																</strong>
															</div>
															<div class="col-6">
																<span>
																	<?php print($artist) ?>
																</span>
															</div>
															<?php } ?>
															<?php if ($album != '') { ?>
																<div class="col-6">
																	<strong>
																		<?php _e('Album', 'bebostore'); ?>
																	</strong>
																</div>
																<div class="col-6">
																	<span>
																	<?php print($album) ?>
																	</span>
																</div>
															<?php } ?>
															<?php if ($labels!='') { ?>
																<div class="col-6">
																	<strong>
																		<?php _e('Label', 'bebostore'); ?>
																	</strong>
																</div>
																<div class="col-6">
																	<span>
																	<?php print($labels) ?>
																	</span>
																</div>
															<?php } ?>
															<?php if ($original_release!='') { ?>
																<div class="col-6">
																	<strong>
																		<?php _e('Original Release', 'bebostore'); ?>
																	</strong>
																</div>
																<div class="col-6">
																	<span>
																		<?php print($original_release) ?>
																	</span>
																</div>
															<?php } ?>
															<?php if ($format!='') { ?>
																<div class="col-6">
																	<strong>
																		<?php _e('Format', 'bebostore'); ?>
																	</strong>
																</div>
																<div class="col-6">
																	<span>
																		<?php print($format) ?>
																	</span>
																</div>
															<?php } ?>
															<?php if ($condition!='') { ?>
																<div class="col-6">
																	<strong>
																		<?php _e('Condition', 'bebostore'); ?>
																	</strong>
																</div>
																<div class="col-6">
																	<span>
																		<?php print($condition) ?>
																	</span>
																</div>
															<?php } ?>
														</div>
													</span>
												</div>
												<?php
											} elseif ($product_types == 'vcd-dvd') {
												?>
													<div id="desc-detail" class="book-desc-detail">
														<?php
															$studio = get_field('studio');
															$original_release = get_field('original_release');
															$format = get_field('format');
															$length = get_field('length');
															$condition = !empty(get_field('condition')) ? get_field('condition') : '';


														?>
														<span class="detail-desc box-detail-desc">
															<div class="row">
																<?php if ($studio != '') { ?>
																<div class="col-6">
																	<strong>
																		<?php _e('Studio', 'bebostore'); ?>
																	</strong>
																</div>
																<div class="col-6">
																	<span>
																		<?php print($studio) ?>
																	</span>
																</div>
																<?php } ?>
																<?php if ($original_release != '') { ?>
																	<div class="col-6">
																		<strong>
																			<?php _e('Original Release', 'bebostore'); ?>
																		</strong>
																	</div>
																	<div class="col-6">
																		<span>
																		<?php print($original_release) ?>
																		</span>
																	</div>
																<?php } ?>
																<?php if ($format!='') { ?>
																	<div class="col-6">
																		<strong>
																			<?php _e('Format', 'bebostore'); ?>
																		</strong>
																	</div>
																	<div class="col-6">
																		<span>
																		<?php print($format) ?>
																		</span>
																	</div>
																<?php } ?>
																<?php if ($length!='') { ?>
																	<div class="col-6">
																		<strong>
																			<?php _e('Lengthe', 'bebostore'); ?>
																		</strong>
																	</div>
																	<div class="col-6">
																		<span>
																			<?php print($length) ?>
																		</span>
																	</div>
																<?php } ?>
																<?php if ($condition!='') { ?>
																	<div class="col-6">
																		<strong>
																			<?php _e('Condition', 'bebostore'); ?>
																		</strong>
																	</div>
																	<div class="col-6">
																		<span>
																			<?php print($condition) ?>
																		</span>
																	</div>
																<?php } ?>
															</div>
														</span>
												</div>
												<?php
											} else {
												?>
													<div id="desc-detail" class="book-desc-detail">
														<?php
															$item_type = get_field('item_type');
															$condition = !empty(get_field('condition')) ? get_field('condition') : '';


														?>
														<span class="detail-desc box-detail-desc">
															<div class="row">
																<?php if ($item_type != '') { ?>
																<div class="col-6">
																	<strong>
																		<?php _e('Item Type', 'bebostore'); ?>
																	</strong>
																</div>
																<div class="col-6">
																	<span>
																		<?php print($item_type) ?>
																	</span>
																</div>
																<?php } ?>
																<?php if ($condition!='') { ?>
																	<div class="col-6">
																		<strong>
																			<?php _e('Condition', 'bebostore'); ?>
																		</strong>
																	</div>
																	<div class="col-6">
																		<span>
																			<?php print($condition) ?>
																		</span>
																	</div>
																<?php } ?>
															</div>
														</span>
												</div>
												<?php
											}
										?>
										
									</div>
									<div class="col-lg-7 col-sm-6 col-12">
										<div class="heading-box d-block d-sm-none my-4 my-sm-auto">
											<h5>
												DESCRIPTION
											</h5>
										</div>
									<?php if( $author ): ?>
										<div id="meet-author" class="book-desc-detail">
											<div class="box-meet-author box-detail-desc">
												<?php foreach( $author as $authors ): ?>
													<?php
														$id_author 		= $authors->ID;
														$year_author 	= get_post_meta( $id_author, '_beautheme_year_job', true );
														$url_ava 		= get_post_meta( $id_author, '_beautheme_type_image', true );
														$url_fb = get_post_meta( $id_author, '_beautheme_author_facebook', true );
														$url_tt = get_post_meta( $id_author, '_beautheme_author_twitter', true );
														$url_google = get_post_meta( $id_author, '_beautheme_author_google', true );
														$url_instagram = get_post_meta( $id_author, '_beautheme_author_instagram', true );
														$url_pinterest = get_post_meta( $id_author, '_beautheme_author_pinterest', true );
														$url_behance = get_post_meta( $id_author, '_beautheme_author_behance', true );
														$url_youtube = get_post_meta( $id_author, '_beautheme_author_youtube', true );
														$url_linkedin = get_post_meta( $id_author, '_beautheme_author_linkedin', true );
													?>
														<div class="name-author">
															By <a href="<?php echo get_permalink( $id_author ); ?>" target="blank"><?php echo get_the_title( $id_author ); ?></a>
														</div>
													<div class="clearfix"></div>
												<?php endforeach; ?>
											</div><!--End box author-->
										</div>
									<?php endif; ?>
										<div class="description">
											<span class="book-desc">
												<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div><!--End about-this-book-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php if( $author ):
        $rand_id = rand(1000, 9999);
        $idauth  = "author_book_".$rand_id;

    ?>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		echo woocommerce_output_related_products();
	?>
	<?php endif; ?>
	
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->

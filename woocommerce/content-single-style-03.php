<?php
	global $beau_option;
	if (isset($beau_option['disable_3d'])) {
		$disable_3d = $beau_option['disable_3d'];
	}
	$image_links  	= wp_get_attachment_image_url(get_post_thumbnail_id(),'woocommerce_single');

	$wishlist_setting = $beau_option['enabled-wishlist'];
	$show_price_setting = $beau_option['enabled-show-price'];
	$cart_setting = $beau_option['enabled-add-to-cart'];
	$enable_affiliate = get_field('enable_affiliate');
	$disable_add_to_cart = get_field('disable_add_to_cart');

	$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
	$wishlist_left = '';
    if ($cart_setting == false) {
    	$wishlist_left = 'top-style';
    }
?>
<div itemscope  id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section>
		<div class="detail-book">
			<div class="container">
				<?php
					// get next and prev products

					function ShowLinkToProduct($post_id, $categories_as_array, $label) {
					    // get post according post id
					    $query_args = array( 'post__in' => array($post_id), 'posts_per_page' => 1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
					        array(
					            'taxonomy' => 'product_cat',
					            'field' => 'id',
					            'terms' => $categories_as_array
					        )));
					    $r_single = new WP_Query($query_args);
					    if ($r_single->have_posts()) {
					        $r_single->the_post();
					        global $product;
					        $none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
							$style_product = '';
						    if($none_book == 'on'){
						    	$style_product = 'none-book';
						    }
					    ?>
					    <div class="book-item-nextback book-<?php print ($label); ?>">
							<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
								<div class="book-item <?php echo esc_attr($style_product) ?>" datalink="<?php echo get_permalink();?>">
									<div class="book-image">
										<?php
											if (has_post_thumbnail())
												the_post_thumbnail();
											else echo '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_thumbnail_image_width').'" height="'.$woocommerce->get_image_size('shop_thumbnail_image_height').'" />';
										?>
									</div>
								</div><!--End book-item-->
								<div class="book-info">
									<span class="book-name"><?php echo get_the_title() ?></span>
								</div><!--End book-info-->
							</a>
						</div>
					    <?php
					        wp_reset_postdata();
					    }
					}

					if ( is_singular('product') ) {
					    global $post;

					    // get categories
					    $terms = wp_get_post_terms( $post->ID, 'product_cat' );
					    foreach ( $terms as $term ) $cats_array[] = $term->term_id;

					    // get all posts in current categories
					    $query_args = array('posts_per_page' => -1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
					        array(
					            'taxonomy' => 'product_cat',
					            'field' => 'id',
					            'terms' => $cats_array
					        )));
					    $r = new WP_Query($query_args);

					    // show next and prev only if we have 3 or more
					    if ($r->post_count > 2) {

					        $prev_product_id = -1;
					        $next_product_id = -1;

					        $found_product = false;
					        $i = 0;

					        $current_product_index = $i;
					        $current_product_id = get_the_ID();

					        if ($r->have_posts()) {
					            while ($r->have_posts()) {
					                $r->the_post();
					                $current_id = get_the_ID();

					                if ($current_id == $current_product_id) {
					                    $found_product = true;
					                    $current_product_index = $i;
					                }
					                $first_product_index = '';
					                $is_first = ($current_product_index == $first_product_index);

					                if ($is_first) {
					                    $prev_product_id = get_the_ID(); // if product is first then 'prev' = last product
					                } else {
					                    if (!$found_product && $current_id != $current_product_id) {
					                        $prev_product_id = get_the_ID();
					                    }
					                }

					                if ($i == 0) { // if product is last then 'next' = first product
					                    $next_product_id = get_the_ID();
					                }

					                if ($found_product && $i == $current_product_index + 1) {
					                    $next_product_id = get_the_ID();
					                }

					                $i++;
					            }

					            if ($prev_product_id != -1) { ShowLinkToProduct($prev_product_id, $cats_array, "next"); }
					            if ($next_product_id != -1) { ShowLinkToProduct($next_product_id, $cats_array, "prev"); }
					        }

					        wp_reset_postdata();
					    }
					}
					?>
				<div class="book-detail col-md-10 col-sm-10 col-xs-12 book-center style03">
					<div class="col-md-5 col-sm-5 col-sm-12">
						<div class="book-item-three">
							<?php if ($none_book != 'on'){ ?>
								<?php if ($disable_3d == 2): ?>
									<img src="<?php print($image_links); ?>" alt="img-book"/>
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
							<?php }
								else{
									?>
								<img src="<?php print($image_links); ?>" alt="img-book"/>
								<?php
								}
							?>
						</div>
						<?php if ( $product->is_on_sale() ) : ?>
							<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'bebostore' ) . '</span>', $post, $product ); ?>
						<?php endif; ?>
					</div>

					<div class="book-item-detail col-md-7 col-sm-7 col-xs-12">
						<?php
							$ISBN = get_post_meta( get_the_ID(), '_beautheme_product_ISBN', true );
							if ($ISBN != '') {
						?>
						<span class="sku_wrapper"><?php _e('ISBN: ', 'bebostore'); ?><span class="sku" itemprop="sku"><?php print($ISBN); ?></span></span>
						<?php
							}
							echo woocommerce_template_single_meta();
							echo woocommerce_template_single_title();
						?>
							<span class="by-book">

				                   <?php
				                   		$author = get_field('field_book_author');
				                   ?>
				                    <?php if( $author ): ?>
				                    	<?php _e('by:', 'bebostore'); ?>
				                    	<?php
				                    		if(count($author) == 1){
				                    		foreach( $author as $authors ): ?>

				                            <a href="<?php echo get_permalink( $authors->ID ); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
				                        <?php endforeach;
				                        	}
				                        else{
				                        ?>
				                        <?php foreach( $author as $authors ): ?>
				                            <a href="<?php echo get_permalink( $authors->ID ); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>,
				                        <?php endforeach; ?>
				                        <?php } ?>
				                    <?php endif; ?>
							</span>
						<?php
							//All details product
							$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

							echo woocommerce_template_single_rating();
						?>
						<span class="book-desc">
							<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
						</span>
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
							<div class="wishlist-cart<?php echo esc_attr($cart_setting); ?>">
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
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 tagged">
								<?php
									$product_tag = wc_get_product_tag_list(get_the_ID(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'bebostore' ) . ' ', '</span>' );
									print($product_tag);
									$pinImage = $image_links;

								?>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="beau-tags social-share">
									<ul class="social">
										<li class="title-social"><?php _e('Share:', 'bebostore'); ?></li>
										<li class="pinterest-cresta-share" id="pinterest-cresta"><a rel="nofollow" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo urlencode(get_permalink( $post->ID )) ?>&amp;media=<?php echo esc_attr($pinImage)?>&amp;description=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title( $post->ID ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8')?>" title="<?php _e('Share to Pinterest','bebostore')?>" onclick="window.open(this.href, 'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-pinterest"></i></a><span class="cresta-the-count" id="pinterest-count"><i class="cs c-icon-cresta-spinner animate-spin"></i></span></li>
										<li class="twitter-cresta-share" id="twitter-cresta"><a rel="nofollow" href="http://twitter.com/share?text=<?php echo htmlspecialchars(urlencode(html_entity_decode(the_title_attribute( 'echo=0' ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') ?>&amp;url=<?php echo  urlencode(get_permalink( $post->ID )) ?>" title="<?php _e('Share to Twitter','bebostore')?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-twitter"></i></a><span class="cresta-the-count" id="twitter-count"><i class="cs c-icon-cresta-spinner animate-spin"></i></span></li>
										<li class="facebook-cresta-share" id="facebook-cresta"><a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink( $post->ID )) ?>&amp;t=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title( $post->ID ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') ?>" title="<?php _e('Share to Facebook','bebostore')?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-facebook"></i></a><span class="cresta-the-count" id="facebook-count"><i class="cs c-icon-cresta-spinner animate-spin"></i></span></li>
										<li class="googleplus-cresta-share" id="googleplus-cresta"><a rel="nofollow" href="https://plus.google.com/share?url=<?php echo  urlencode(get_permalink( $post->ID )) ?>" title="<?php _e('Share to Google Plus','bebostore')?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;"><i class="fa fa-google-plus"></i></a><span class="cresta-the-count" id="googleplus-count"><i class="cs c-icon-cresta-spinner animate-spin"></i></span></li>
									</ul>
								</div>
							</div>
						</div>
                        <div class="clearfix"></div>

                         <?php
                            $play_text = $class = "";
                            if ($product_type == "product_audio"){
                                $play_text = __("Play audio","bebostore");
                            }
                            if ($product_type == "product_video"){
                                $play_text = __("Play Video","bebostore");
                            }
                        ?>
                        <?php if ($play_text !="") {?>
                          <div class="audio-iconplay"  data-toggle="modal" data-target="#preview-modal"><i class="fa fa-play"></i><a href="javascript:;" onclick="return false;"><?php echo esc_html($play_text); ?></a></div>
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
                                        var songI = $(this).attr('data-song');
                                        $('.item-play').removeClass('active').find('i').removeClass('fa-pause').addClass('fa-play');
                                        if (!$(this).hasClass('active')) {
                                            $(this).find('i').removeClass('fa-play').addClass('fa-pause');
                                            $(this).addClass('active');
                                        }else{
                                             $(this).removeClass('active').find('i').removeClass('fa-pause').addClass('fa-play');
                                        }
                                        beauPlaylist.play(songI);
                                    });

                                    $('.jp-play').click(function(event) {
                                         // beauPlaylist.play();
                                         $('.list-playlist .item-play:first-child()').click();
                                    });

                                });
                            })(jQuery)
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
                            <?php $i++;} ?>
                            </ul>
                        <?php } ?>
					</div><!-- .summary -->
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="about-this-book">
			<div class="container">
				<div class="book-tab col-md-8 col-sm-12 col-xs-12 book-center">
					<div class="title-box title-detail book-center"><span><?php _e('About This Book', 'bebostore'); ?></span></div>
					<div class="clearfix"></div>
					<div class="list-menu">
						<ul class="list-menu-tap">
							<?php
				           		$editorial = get_post_meta( get_the_ID(), '_beautheme_editorial_reviews', true );
				           		$author = get_field('field_book_author');
				           		$publisher = get_field('field_book_publisher');
				           		$overview = get_the_content();
				            ?>
				           		<?php if( $overview ): ?>
								<li class="over-view"><a href="#over-view"><?php _e('Overview', 'bebostore'); ?></a></li>
								<?php endif; ?>
								<?php if( $publisher ): ?>
								<li class="desc-detail"><a href="#desc-detail"><?php _e('Details', 'bebostore'); ?></a></li>
								<?php endif; ?>
								<li class="attributes"><a href="#attributes"><?php _e('Attributes', 'bebostore'); ?></a></li>
								<?php if( $author ): ?>
								<li class="beau-meet-author"><a href="#meet-author"><?php _e('Meet the Author', 'bebostore'); ?></a></li>
								<?php endif; ?>
								<li class="beboo-reviews"><a href="#beboo-reviews"><?php _e('Reviews', 'bebostore'); ?>(<?php print ($product->get_review_count()); ?>)</a></li>
						</ul>

					</div>
				</div><!--End left-detail-->
				<div class="clearfix"></div>
				<div class="right-detail content-tab col-md-8 col-sm-12 col-xs-12 book-center">
				<script>
					(function($) {
						"use strict";
						$('.list-menu-tap li').click(function(event) {
							var idToShow = $(this).find('a').attr('href');
							$('.list-menu-tap li').removeClass('tab-active');
							$(this).addClass('tab-active');
							$('.book-desc-detail').removeClass('book-tab-show');
							$(idToShow).addClass('book-tab-show');
							return false;
						});
					})(jQuery);
				</script>
					<?php if( $overview != ''): ?>
					<div id="over-view" class="book-desc-detail book-tab-show">

						<span class="detail-desc box-detail-desc">
							<?php print($overview) ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if( $publisher ): ?>
					<div id="desc-detail" class="book-desc-detail">
						<?php foreach( $publisher as $publisher ): ?>
		                	<?php
		                		$id_publisher = $publisher->ID;
		                		$publishing_year_item = get_post_meta( get_the_ID(), '_beautheme_publishing_year', true );
		                		$publishing_page = get_post_meta( get_the_ID(), '_beautheme_page_count', true );
		                		$editorial = get_post_meta( get_the_ID(), '_beautheme_editorial_reviews', true );
		                		$ISBN = get_post_meta( get_the_ID(), '_beautheme_product_ISBN', true );
		                	?>
							<span class="detail-desc box-detail-desc">
								<p>
									<?php if ($ISBN != '') { ?>
										<strong>ISBN</strong>: <?php print $ISBN; ?><br>
									<?php } ?>
									<?php if ($product->get_sku()!='') { ?>
										<strong>SKU</strong>: <?php print ($product->get_sku());?><br>
									<?php } ?>
									<strong><?php _e('Publisher', 'bebostore'); ?></strong>: <?php echo get_the_title($id_publisher) ;?><br>
									<strong><?php _e('Publish Date', 'bebostore'); ?></strong>: <?php print($publishing_year_item) ?><br>
									<strong><?php _e('Page Count', 'bebostore'); ?></strong>: <?php print($publishing_page) ?>
								</p>
							</span>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
					<?php if( $product->is_type('variable') ): ?>
					<div id="attributes" class="book-desc-detail">
						<span class="title-detail"><?php _e('Attributes', 'bebostore'); ?></span>
						<span class="detail-desc box-detail-desc">
                           <?php wc_display_product_attributes($product); ?>
						</span>
					</div>
					<?php endif; ?>
					<?php if( $author ): ?>
					<div id="meet-author" class="book-desc-detail">
						<span class="detail-desc box-detail-desc">
							<div class="box-meet-author box-detail-desc col-md-12 col-sm-12 col-xs-12">
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
								<div class="author-info">
									<div class="img-social">
										<img src="<?php echo esc_url($url_ava) ; ?>">
										<div class="clearfix"></div>
										<ul>
											<?php if( $url_fb ): ?>
												<li><a href="<?php echo esc_url($url_fb); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
											<?php endif; ?>

											<?php if( $url_tt ): ?>
											<li><a href="<?php echo esc_url($url_tt); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
											<?php endif; ?>

											<?php if( $url_google ): ?>
											<li><a href="<?php echo esc_url($url_google); ?>" target="_blank"><i class="fa fa-google"></i></a></li>
											<?php endif; ?>

											<?php if( $url_instagram ): ?>
											<li><a href="<?php echo esc_url($url_instagram); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
											<?php endif; ?>

											<?php if( $url_pinterest ): ?>
											<li><a href="<?php echo esc_url($url_pinterest); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
											<?php endif; ?>

											<?php if( $url_behance ): ?>
											<li><a href="<?php echo esc_url($url_behance); ?>" target="_blank"><i class="fa fa-behance"></i></a></li>
											<?php endif; ?>

											<?php if( $url_youtube ): ?>
											<li><a href="<?php echo esc_url($url_youtube); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
											<?php endif; ?>

											<?php if( $url_linkedin ): ?>
											<li><a href="<?php echo esc_url($url_linkedin); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
											<?php endif; ?>
										</ul>
									</div>
									<div class="desc-name">
										<div class="name-author">
											<span><?php _e('Author :', 'bebostore'); ?></span><a href="<?php echo get_permalink( $id_author ); ?>" target="blank"><?php echo get_the_title( $id_author ); ?></a>
										</div>
										<div class="year-author">
											<?php printf($year_author) ; ?>
										</div>
										<div class="desc-author"><?php echo get_post_field('post_content', $id_author); ?></div>
									</div>
								</div>
                                <div class="clearfix"></div>
							<?php endforeach; ?>
						</div><!--End box author-->
						</span>
					</div><!--End meet author-->
					<?php endif; ?>
					<div id="beboo-reviews" class="book-desc-detail">
						<?php echo woocommerce_output_product_data_tabs(); ?>
					</div>
				</div><!--End right-detail-->
			</div>
			<div class="container border">
				<div class="border-bottom"></div>
			</div>
		</div><!--End about-this-book-->
	</section>
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
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->

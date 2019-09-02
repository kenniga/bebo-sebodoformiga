<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>

<?php
	// The tax query
	$tax_query[] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'featured',
		'operator' => 'IN', // or 'NOT IN' to exclude feature products
	);

	// The query
	$query = new WP_Query( array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'orderby'             => $orderby,
		'order'               => $order == 'asc' ? 'asc' : 'desc',
		'tax_query'           => $tax_query // <===
	) );
		?>
	<div class="best-seller-section-option2 woocommerce sc-single-book shop-book-featured">
		<div class="shop-book-featured__wrapper">
			<div class="container">
				<div class="title-box title-best">
					<span>
						FEATURED
					</span>
				</div>
				<div class="swiper-bookslider">
					<div class="swiper-wrapper best-seller">
					<?php 
					
						$products = $query->posts;
						// sebodo_debug($products);
						for ($i=0; $i < sizeof($products) ; $i++) { 
							$id_product = (int) $products[$i]->ID;
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
											if( $author ): ?>
												<?php esc_html_e('By:', 'bebostore'); 
												if(count($author) == 1){
													foreach( $author as $authors ): ?>
														<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
													<?php 
													endforeach;
												}
												else {
													foreach( $author as $authors ): ?>
														<a href="<?php echo esc_url(get_permalink( $authors->ID )); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>,
													<?php endforeach; 
												} 
											endif; ?>
										</span>
										<span class="book-rate">
											<?php if ( $rating_count > 0 ) : ?>
												<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'bebostore' ), $average ); ?>">
													<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
														<strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'bebostore' ), '<span>', '</span>' ); ?>
														<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'bebostore' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
													</span>
												</div>
											<?php 
											endif; ?>
										</span>
										<?php
											$_price = $product->get_price();
											?>
												<span class="book-price">
													<b>
														<?php print wc_price($_price); ?>
													</b>
												</span>
											<?php
										?>

									</div><!--End book-info-->
									<div class="book-hot col-md-4 col-sm-4 col-xs-12">
										<ul id="bk-list" class="bk-list clearfix">
											<li>
												<div class="bk-book book-2 bk-bookdefault">
													<div class="bk-front">
														<div class="bk-cover">
															<img src="<?php print($feat_image); ?>" alt="img-book"/>
														</div>
													</div>
													<div class="bk-back">
														<?php 
															global $wp_query;
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
																				foreach( $author as $authors ):
																					echo get_the_title( $authors->ID );
																				endforeach;
																			}
																			else {
																				foreach( $author as $authors ): ?>
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
		<div class="stripe-up-img">
			<img src="<?php echo get_template_directory_uri();?>/asset/images/desktop-stripe-up.png" alt="">
		</div>
	</div>
	<?php wp_reset_postdata(); ?>

	<?php
	if (is_product_category()){

		global $wp_query;
		// get the query object
		$cat = $wp_query->get_queried_object();
		// get the thumbnail id user the term_id
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		if (function_exists('z_taxonomy_image_url')){
			$image = z_taxonomy_image_url($cat->term_id, NULL, TRUE);
		}
		// print the IMG HTML
		$term = get_term( $cat->term_id, 'product_cat' );
		$count_product = $term->count;

	?>

	<section class="header-page header-shop" style="background: url(<?php print ($image); ?>) no-repeat center center;background-size: cover;">
		<div class="container">
			<div class="title-page"><?php print($term->name); ?> <span>(<?php print ($count_product); ?>)</span></div>
		</div>

	</section>

	<?php 
	} else {
		if( is_shop() ) {
			$shop = get_option( 'woocommerce_shop_page_id' );
			$post_thumbnail_id = get_post_thumbnail_id($shop);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$page = get_post($shop);
			if( has_post_thumbnail( $shop ) ) {
	?>
	<section class="header-page header-shop" style="background: url(<?php echo ($post_thumbnail_url); ?>) no-repeat center center;background-size: cover;">
		<div class="container">
			<div class="title-page">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<?php woocommerce_page_title(); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
			}
		}
	} 
	if (is_search() && !have_posts()): ?>
	<div class="container">
		<h4><?php _e('No products were found matching your selection.','bebostore'); ?></h4>
	</div>
	<?php endif;
	global $beau_option;
	if (isset($beau_option['style-shop'])) {
		$options = $beau_option['style-shop'];
	}else{
		$options = 'shop-style-1';
	}
	if($options == 'shop-style-1') { 
		/**
		 * woocommerce_archive_description hook
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		
		 do_action( 'woocommerce_archive_description' );
		
		if ( have_posts() ) : ?>
			
			<section id="grid-list" class="side-bar">
				<div class="breadthums-navigation grid">
					<div class="container">
						<div class="navigation-listcat pull-left">
							<div class="title-subcat">
								<span class="subcategories-list"><i class="fa fa-bars"></i> <?php _e('All subject','bebostore'); ?></span>
							</div>
						</div>
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
					</div>
				</div>
				<div id="product-sidebar">
					<div class="sidebar-widget">
						<div class="container">
						<?php
				            if ( is_active_sidebar( 'sidebar-product' ) ){
				                if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-product') ) ;
				            }
				        ?>
				        </div>
					</div>
				</div>
			</section>

			<section>
				<div class="shop-left-bar">
					<div class="container">
						<div class="book-grid-full col-md-12 col-sm-12 col-xs-12">
							<div class="shop-list-book row">
								<div class="shop-list col-md-12-col-sm-12 col-xs-12">
									<div class="row">
										<ul class="products grid book-grid-full col-md-12-col-sm-12 col-xs-12">
											<?php woocommerce_product_subcategories(); ?>

											<?php while ( have_posts() ) : the_post(); ?>

												<?php wc_get_template_part( 'content', 'product' ); ?>

											<?php endwhile; // end of the loop. ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	} 
	
	if( $options == 'shop-style-2' ) { ?>
	<section class="page-product__title">
		<h4 style="font-size: 21px;padding-bottom: 27px;color: #0a0a0a;text-align: center" class="sebodo-underlined">PRODUCTS</h4>
	</section>
	<section class="type-tab">
	<?php
		
		$terms = get_terms( 'product_types' );
		echo '<ul class="product-type-tab">';
		
		foreach ( $terms as $term ) {
			$current_term_class = '';
		 
			// The $term is an object, so we don't need to specify the $taxonomy.
			$term_link = get_term_link( $term );
			
			// If there was an error, continue to the next term.
			if ( is_wp_error( $term_link ) ) {
				continue;
			}

			if( get_queried_object()->slug == $term->slug ) {
				$current_term_class = 'current-term';
				echo '<li class=" ' . $current_term_class . '"><span href="' . esc_url( $term_link ) . '">' . $term->name . '</span></li>';
			} else {
				echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';

			}
			
			// We successfully got a link. Print it out.
		}
		 
		echo '</ul>';
		
	?>
	</section>
	<section>
		<div class="container">
		<?php
			/**
			 * woocommerce_archive_description hook
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<section class="row">
				<div class="col-12">
					<div class="breadthums-navigation">
						<div class="breadthums">
	
							<?php
								/**
								 * woocommerce_before_main_content hook
								 *
								 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
								 * @hooked woocommerce_breadcrumb - 20
								 */
								echo woocommerce_breadcrumb();
							?>
						</div>
							
					</div>
					<div class="archive-tools">
						<?php
							/**
							 * woocommerce_before_shop_loop hook
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
							$form = '<form class="product-search" role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
									<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
									<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search by Title', 'woocommerce' ) . '" />
									<input type="hidden" name="post_type" value="product" />
							</form>';
							
							echo $form;
						?>
					</div>
				</div>
			</section>

			<section id="list" class="archive-content">
				<div class="shop-left-bar">
					<div class="container">
						<div class="row">
						<?php if( 
							!is_tax('product_types', 'book') &&
							!is_tax('product_types', 'cassette') && 
							!is_tax('product_types', 'audio-cd') && 
							!is_tax('product_types', 'vinyl')
							): 
							?>
							<?php sebodo_debug( !is_tax('product_types', 'book') ); ?>
							<?php sebodo_debug( !is_tax('product_types', 'cassette') ); ?>
							<?php sebodo_debug( !is_tax('product_types', 'audio-cd') ); ?>
							<?php sebodo_debug( !is_tax('product_types', 'vinyl') ); ?>
							<div class="right-sidebar left-bar col-md-3 col-sm-4 col-5 d-none d-sm-block">
								<div class="sidebar-widget">
									<?php
										if ( is_active_sidebar( 'sidebar-product' ) ){
											if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-product') ) ;
										}
									?>
								</div>
							</div>
									<?php endif; ?>
							<div class="<?php if(
								is_tax('product_types', 'book') ||
								is_tax('product_types', 'cassette') || 
								is_tax('product_types', 'audio-cd') || 
								is_tax('product_types', 'vinyl')  
							) { echo "col-md-9 col-sm-8"; }?> col-12">
								<div class="shop-list-book row">
									<div class="shop-list col-md-12-col-sm-12 col-12">
										<ul class="products book-grid row">
											<?php woocommerce_product_subcategories(); ?>

											<?php while ( have_posts() ) : the_post(); ?>

												<?php wc_get_template_part( 'content', 'product' ); ?>

											<?php endwhile; // end of the loop. ?>
										</ul>
									</div>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</section>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
    </div>
</section>
<?php } ?>
<?php get_footer( 'shop' ); ?>

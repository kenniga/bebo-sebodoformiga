<?php
get_header('none');
$disable_search = $beau_option['disable_search'];
?>
<section class="section-404">
	<div class="page-404">
		<div class="markup-404">
			<div class="info-page-404">
				<h1 class="title-page"><?php esc_html_e('404 not found-', 'bebostore'); ?></h1>
				<div class="desc-page-404"><?php esc_html_e('the resource requested could not be found on this server','bebostore'); ?></div>
				<div class="clearfix"></div>
				<?php if ($disable_search != '2'): ?>
					<div class="form-search">
						<form action="<?php echo esc_url(home_url( '/' ));?>" method="get" class="book-search-head">
							<i class="fa fa-search"></i>
							<input type="text" name="s" value="" placeholder="<?php esc_html_e('Search by title book...','bebostore'); ?>">
							<select name="search-by" class="custom-dropdown">
								<option value="0" selected><?php esc_html_e('All ','bebostore'); ?></option>
								<?php
									$args = array(
									    'orderby'    => 'title',
									    'order'      => 'ASC',
									    'hide_empty' => TRUE,
									);
									$product_categories = get_terms( 'product_cat', $args );
									$count = count($product_categories);
		                            $args = array(
		                                'orderby'   => 'title',
		                                'order'     => 'ASC',
		                                'hide_empty'          => FALSE,
		                            );
		                            $product_categories = get_terms( 'product_cat', $args );
		                            $count = count($product_categories);
		                           	if ( $count > 0 ){
						    			foreach ( $product_categories as $product_category ) {
											if (is_object($product_category) && $product_category->term_id){
												echo '<option value="' . $product_category->term_id . '">' . $product_category->name . '</option>';
											}
		                                }
		                           	}

		                        ?>
							</select>
						</form>
					</div><!--Left .pull-left-->
				<?php endif ?>
			</div>
		</div><!--End markup-404-->
	</div>
	<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): ?>
		<div class="cat-sugets">
			<div class="container">
				<?php
				$args = array(
				    'number'     => 4,
				    'orderby'    => 'title',
				    'order'      => 'ASC',
				    'hide_empty' => TRUE,
				);
				$product_categories = get_terms( 'product_cat', $args );
				$count = count($product_categories);
				?>
				<ul class="list-sugest">
				<?php
					if ( $count > 0 ){
					    foreach ( $product_categories as $product_category ) {
							if (function_exists('get_woocommerce_term_meta')) {
							$wthumbnail_id = get_woocommerce_term_meta( $product_category->term_id,'thumbnail_id', true );
							}else{
								$wthumbnail_id = "";
							}
							$wimage = wp_get_attachment_url( $wthumbnail_id );
							$category_link = get_term_link( $product_category->term_id, 'product_cat' );
							?>

							<li class="items-category">
								<?php if (!$wimage==''){?>
								<img class="cat-image" src="<?php print($wimage); ?>" alt="<?php print($product_category->name); ?>">
							<?php } ?>
								<a href="<?php echo esc_html($category_link) ?>">
									<div class="c-item">
										<span class="cat-title"><?php print($product_category->name); ?></span>
										<span class="cat-num">( <?php print($product_category->count); ?> )</span>
									</div>
								</a>
							</li>
							<?php
					    }
					}
				?>
				</ul>
			</div>
		</div><!--End cat-sugets-->
	<?php endif; ?>
</section>
<script>
	(function($) {
		"use strict";
		var elementHeight = parseInt($('.markup-404').height());
		jQuery(window).on('scroll',
			{
		    	previousTop: 0
			},
			function () {
			    var currentTop = $(window).scrollTop();
			    if (currentTop > 0) {

			    } else {

			    }
			    this.previousTop = currentTop;
			});
	})(jQuery);
</script>
<?php get_footer()?>
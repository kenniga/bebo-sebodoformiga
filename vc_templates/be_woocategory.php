<?php
$number = $option = "";
extract(shortcode_atts(array(
    'number' 			=> '',
    'option' 			=> '',
    'category_group' 		=> ''
), $atts));
$idRand = "procat_".rand(100,9999);
global $wp_query;
// get the query object
$cat = $wp_query->get_queried_object();
// get the thumbnail id user the term_id
$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
// get the image URL
$image = wp_get_attachment_url( $thumbnail_id );
// print the IMG HTML
$term = get_terms( 'pa_product-type' );
$product_cat_list = array();
if($product_cat != NULL) {
    $product_cat_list = explode(',', $product_cat);
}
$parsed_cats_array = vc_param_group_parse_atts($category_group);

?>
<?php
	if ($option == 'home-06') {
?>

<div id="<?php echo esc_html($idRand); ?>">
	<div class="container">
		<ul class="row sc-woocategory">
			<?php
				$args = array(
					'number'     => $number,
					'orderby'    => 'title',
					'include'	 =>  $product_cat_list,
					'order'      => 'ASC',
				);
				$product_categories = get_terms( 'pa_product-type', $args );
				$count = count($product_categories);
				$i = 1;
				?>
				<?php
				if ( $count > 0 ){
					foreach ( $parsed_cats_array as $item_category ) {
						$product_category = get_term_by('id', $item_category['product_cat'], 'product_types');
						$wimage = wp_get_attachment_url( $item_category['category_image'] );
					   $cat_height = '';
					   if ($i == 1 || $i == 4) {
						   $cat_height = 'col-md-5 col-5';
					   }
					   else {
						   $cat_height = 'col-md-7 col-7';
					   }
					   ?>
	
					   <li class="sc-woocategory__item <?php print($cat_height); ?>">
						<a href="<?php echo esc_url(get_term_link( $product_category)); ?>">
							<div class="category-image">
								<?php if (!$wimage==''){?>
									<img class="cat-image" src="<?php print($wimage); ?>" alt="cat-img">
								<?php } ?>
							</div>
						</a>
					</li>
					   <?php
					$i++;
					}
				}
				?>
		</ul>
	</div>
	<script>
		(function($) {
			"use strict";
				$(window).load(function() {
					/* Act on the event */
				  $('#<?php echo esc_js($idRand);;?> .cat-list-random').isotope({
				    itemSelector: '.cat-items',
				    masonry: {
				      columnWidth: 685
				    }
				});
			  });
		})(jQuery);
	</script>
</div><!--End category masonry-->
<?php } ?>
<?php
	if ($option == 'home-07') {
?>
	<?php
	global $beau_option;
	$top = '';

	$args = array(
	    'number'     => $number,
	    'orderby'    => 'title',
	    'include'	 =>  $product_cat_list,
	    'order'      => 'ASC',
	);
	$product_categories = get_terms( 'product_cat', $args );
	$count = count($product_categories); ?>
	<ul class="list-full-categories" id="list-cat-scroll" style="<?php print($top); ?>">
	<?php
	$i = 1;
	if ( $count > 0 ){
	    foreach ( $product_categories as $product_category ) {
	    $wthumbnail_id = get_woocommerce_term_meta( $product_category->term_id,'thumbnail_id', true );
   		$wimage = wp_get_attachment_url( $wthumbnail_id );
	   	?>
	   	<li class="items-category" id="items-category-home<?php print($i)?>">
	   	<?php if (!$wimage==''){?>
			<img class="cat-image" src="<?php print($wimage); ?>" alt="cat-img">
		<?php } ?>
			<a href="<?php echo esc_url(get_term_link( $product_category)); ?>">
				<div>
					<span class="cat-title"><?php print($product_category->name); ?></span>
					<span class="cat-num">( <?php print($product_category->count); ?> )</span>
				</div>
			</a>
		</li>
	   	<?php
	    $i++;
	    }
	}
	?>
	</ul>
<?php
	}
?>

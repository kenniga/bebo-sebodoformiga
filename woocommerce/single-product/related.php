<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;
if ( empty( $product ) || ! $product->exists() ) {
	return;
}
$related = wc_get_related_products(get_the_ID($product));
if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 4,
	'orderby'              => 'date',
	'post__in'             => $related,
	'post__not_in'         => get_the_ID($product)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;
global $beau_option;
if ($beau_option['style-shop-details']) {
    $options = $beau_option['style-shop-details'];
}else{
    $options = "shop-style-1";
}

$wishlist_setting = $beau_option['enabled-wishlist'];
$cart_setting = $beau_option['enabled-add-to-cart'];
$show_price_setting = $beau_option['enabled-show-price'];
if ( $products->have_posts() ) : ?>
<div class="feature-section feature-option2">
	<div class="container">
		<?php if($options == 'shop-style-3') { ?>
		<div class="book-features no-border">
		<?php } ?>
			<div class="row related products">
				<div class="title-box col-12">
					<span>
						<?php _e( 'New Arrivals', 'bebostore' ); ?>
					</span>
				</div>
				<?php woocommerce_product_loop_start(); ?>

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
			</div>
		<?php if($options == 'shop-style-3') { ?>
		</div>
		<?php } ?>
	</div>
</div>
<?php endif;

wp_reset_postdata();

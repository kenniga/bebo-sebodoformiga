<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>
<section>
	<div class="shopping-cart">
		<div class="container">
		<div class="main-cart">
			<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>
				<div class="title-page"><?php _e('Shopping cart','bebostore'); ?></div>
				<table class="shop_table cart col-md-8 col-sm-8 col-xs-12" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name col-sm-6 col-md-6 col-xs-4"><?php _e( 'Product name', 'bebostore' ); ?></th>
							<th class="product-price col-sm-2 col-md-2 col-xs-2"><?php _e( 'Price', 'bebostore' ); ?></th>
							<th class="product-quantity col-sm-2 col-md-2 col-xs-4"><?php _e( 'Quantity', 'bebostore' ); ?></th>
							<th class="product-subtotal col-sm-2 col-md-2 col-xs-2"><?php _e( 'Total', 'bebostore' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								?>
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

									<td class="product-thumbnail col-sm-6 col-md-6 col-xs-4">
										<div class="book-item">
											<div class="book-image">
											<?php
												$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

												if ( ! $_product->is_visible() ) {
													print ($thumbnail);
												} else {
													printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
												}
											?>
											</div>
										</div>
										<span class="product-info-name">
										<?php
											if ( ! $_product->is_visible() ) {
												echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
											} else {
												echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
											}
										?>
										<span class="by-author">
										<?php _e('by:', 'bebostore'); ?>
						                   <?php
						                   		$author = get_field('field_book_author',$product_id);
						                   ?>
						                    <?php if( $author ): ?>
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
						                </span>
										<?php
											// Meta data
											echo wc_get_formatted_cart_item_data( $cart_item );

											// Backorder notification
											if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>' ) );
											}
										?>
										</span>
									</td>

									<td class="product-price col-sm-2 col-md-2 col-xs-2">
										<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										?>
									</td>

									<td class="product-quantity col-sm-2 col-md-2 col-xs-2">
										<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
													'min_value'   => '0'
												), $_product, false );
											}

											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
										?>

										<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">'.__('Remove', 'bebostore').'</a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												__( 'Remove this item', 'bebostore' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
										?>

									</td>

									<td class="product-subtotal col-sm-2 col-md-2 col-xs-2">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
										?>
									</td>
								</tr>
								<?php
							}
						}

						?>
					</tbody>
					<tfoot>
						<tr>
							<td class="amount-total-text col-md-10 col-sm-10 col-xs-10 pull-left" colspan="3"><?php _e('Grand total', 'bebostore') ;?></td>
							<td class="amount amount-center col-md-2 col-sm-2 col-xs-2 pull-left"><?php echo WC()->cart->get_cart_total(); ?></td>
						</tr>
						<tr>
							<td colspan="4">
								<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
								<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'bebostore' ); ?>" />
								<?php do_action( 'woocommerce_cart_actions' ); ?>

								<?php wp_nonce_field( 'woocommerce-cart' ); ?>
							</td>
						</tr>
					</tfoot>
				</table>
				<div class="info-cart col-md-3 col-sm-3 col-xs-12 pull-right">
					<div class="box-info-cart">
						<div class="title-box-cart">
							<?php $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) ); ?>
							<a href="<?php print ($shop_page_url); ?>"><?php _e('Keep shopping', 'bebostore'); ?> <i class="fa fa-angle-right"></i></a>
						</div>
						<div class="content-box-cart box-half">
							<?php
							do_action( 'woocommerce_cart_collaterals' );

							?>
						</div>

						<div class="footer-box-cart box-half">
							<?php if ( WC()->cart->coupons_enabled() ) { ?>
								<div class="coupon-cart">

									<label for="coupon_code"><?php _e( 'Enter coupon code', 'bebostore' ); ?>:</label> </div>
									<div class="input-coup-on">
										<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'bebostore' ); ?>" />
										<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'bebostore' ); ?>" />
									</div>
									<?php do_action( 'woocommerce_cart_coupon' ); ?>

							<?php } ?>
						</div>
					</div>
				</div>
			</form>
		</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</div>
</div>
</section>
<?php do_action( 'woocommerce_after_cart' ); ?>

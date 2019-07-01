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
				<div class="title-page">
					<h4 style="font-size: 21px;padding-bottom: 27px;color: #0a0a0a;text-align: center;text-transform: uppercase;" class="sebodo-underlined">
						<?php _e('Shopping cart','bebostore'); ?>
					</h4>
				</div>
				<table class="shop_table cart col-12" cellspacing="0">
					<thead>
						<tr>
							<th class="col-sm-2 col-md-2 col-xs-4"><?php _e( 'Item name', 'bebostore' ); ?></th>
							<th class="col-sm-4 col-md-4 col-xs-4"><?php _e( 'Description', 'bebostore' ); ?></th>
							<th class="product-price col-sm-2 col-md-2 col-xs-2"><?php _e( 'Price', 'bebostore' ); ?></th>
							<th class="product-quantity col-sm-1 col-md-1 col-xs-4"><?php _e( 'Qty', 'bebostore' ); ?></th>
							<th class="product-subtotal col-sm-2 col-md-2 col-xs-2"><?php _e( 'Total', 'bebostore' ); ?></th>
							<th class="product-subtotal col-sm-1 col-md-1 col-xs-1"></th>
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
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item row align-items-center', $cart_item, $cart_item_key ) ); ?>">

									<td class="product-thumbnail col-sm-2 col-md-2 col-2">
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
									</td>
									<td class="product-name col-sm-4 col-md-4 col-4">
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

									<td class="product-quantity col-sm-1 col-md-1 col-xs-1">
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

									</td>

									<td class="product-subtotal col-sm-2 col-md-2 col-xs-2">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
										?>
									</td>
									<td class="product-remove col-sm-1 col-md-1 col-2">
									<?php
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
											'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">'.__('x', 'bebostore').'</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											__( 'Remove this item', 'bebostore' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										), $cart_item_key );
									?>
									</td>
								</tr>
								<?php
							}
						}

						?>
					</tbody>
					<tfoot class="cart_totals  <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
						<?php
							do_action( 'woocommerce_cart_collaterals' );

							?>
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
				<div class="info-cart col-12">
					<div class="box-info-cart">
						<div class="title-box-cart">
							<?php $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) ); ?>
							<a href="<?php print ($shop_page_url); ?>"><?php _e('Keep shopping', 'bebostore'); ?> <i class="fa fa-angle-right"></i></a>
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

<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<tr class="cart_item row align-items-center">
	<td class="amount-total-text col-sm-6 col-md-6 col-6">
		<?php _e( 'Subtotal', 'bebostore' ); ?>
	</td>
	<td class="product-price col-sm-2 offset-md-2 col-md-4 col-6 text-sm-center text-right">
		<?php wc_cart_totals_subtotal_html(); ?>
	</td>
	<td class="product-coupon col-sm-4 offset-md-8 col-md-4 col-12">
		<?php if ( WC()->cart->coupons_enabled() ) { ?>
			<div class="coupon-cart">

				<div class="input-coup-on">
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'bebostore' ); ?>" />
					<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'bebostore' ); ?>" />
				</div>
				<?php do_action( 'woocommerce_cart_coupon' ); ?>

		<?php } ?>
	</td>
</tr>
<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
	<tr class="cart_item row align-items-center cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
		<td class="col-sm-6 col-md-6 col-6">
			<?php wc_cart_totals_coupon_label( $coupon ); ?>
		</td>
		<td class="col-sm-2 col-md-2 col-6 text-sm-center text-right">
			<?php wc_cart_totals_coupon_html( $coupon ); ?>
		</td>
	</tr>
<?php endforeach; ?>

<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

	<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

	<?php wc_cart_totals_shipping_html(); ?>

	<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

<?php elseif ( WC()->cart->needs_shipping() ) : ?>

	<tr class="shipping">
		<td><?php _e( 'Shipping', 'bebostore' ); ?></td>
		<td><?php woocommerce_shipping_calculator(); ?></td>
	</tr>

<?php endif; ?>
<tr class="cart_totals total-cart-preview row align-items-center">
	<td class="col-sm-6 col-md-6 col-8">
		<?php _e( 'GRAND TOTAL', 'bebostore' ); ?>
	</td>
	<td class="col-sm-2 col-md-4 offset-md-2 col-4 text-sm-center text-right">
		<?php wc_cart_totals_order_total_html(); ?>
	</td>
</tr>
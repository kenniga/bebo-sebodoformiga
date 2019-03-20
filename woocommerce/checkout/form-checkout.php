<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );
$order_button_text = '';
// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'bebostore' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : WC()->cart->get_cart_url();
?>
<section>
	<div class="shopping-cart">
		<div class="container">
			<div class="title-page"><?php _e('Check out', 'bebostore'); ?></div><!--End title-page-->
			<div class="clearfix"></div>
			<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">
				<div class="box-check-out">
				<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

					<div class="col2-set" id="customer_details">
						<div class="billing-address pull-left col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>
						</div>

						<div class="shipping-address pull-left col-lg-offset-1 col-md-offset-1 col-sd-offset-1 col-md-3 col-sm-3 col-xs-12">
							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						</div>

						<div class="shipping-method pull-right col-md-4 col-sm-4 col-xs-12">
							<div class="title-box-checkout"><?php _e( 'PAYMENT METHOD', 'bebostore' ); ?></div>
							<div style="clear:both;"></div>
							<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

							<div id="order_review" class="woocommerce-checkout-review-order">
								<?php if ( ! is_ajax() ) : ?>
									<?php do_action( 'woocommerce_review_order_before_payment' ); ?>
								<?php endif; ?>

								<div id="payment" class="woocommerce-checkout-payment">
									<?php if ( WC()->cart->needs_payment() ) : ?>
									<ul class="payment_methods methods">
										<?php
											if ( ! empty( $available_gateways ) ) {
												foreach ( $available_gateways as $gateway ) {
													wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
												}
											} else {
												if ( ! WC()->customer->get_billing_country() ) {
													$no_gateways_message = __( 'Please fill in your details above to see available payment methods.', 'bebostore' );
												} else {
													$no_gateways_message = __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'bebostore' );
												}

												echo '<li>' . apply_filters( 'woocommerce_no_available_payment_methods_message', $no_gateways_message ) . '</li>';
											}
										?>
									</ul>
									<?php endif; ?>

									<div class="form-row place-order">

										<noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'bebostore' ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'bebostore' ); ?>" /></noscript>

										<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

										<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

										<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

										<?php if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) : ?>
											<p class="form-row terms">
												<label for="terms" class="checkbox"><?php printf( __( 'I&rsquo;ve read and accept the <a href="%s" target="_blank">terms &amp; conditions</a>', 'bebostore' ), esc_url( wc_get_page_permalink( 'terms' ) ) ); ?></label>
												<input type="checkbox" class="input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" />
											</p>
										<?php endif; ?>

										<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

									</div>

									<div class="clear"></div>
								</div>

								<?php if ( ! is_ajax() ) : ?>
									<?php do_action( 'woocommerce_review_order_after_payment' ); ?>
								<?php endif; ?>
							</div>

							<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
						</div>
					</div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<?php endif; ?>
				</div>
				<div class="order-check-out">
					<h3 id="order_review_heading"><?php _e( 'Your order', 'bebostore' ); ?></h3>

					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>
					
					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				</div>
			</form>
		</div>
	</div>
</section>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

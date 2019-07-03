<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">
	
	<div class="customer-details-title">
		<h4 style="font-size: 25px;padding-bottom: 27px;color: #F4F6DD;text-align: center;text-transform: uppercase;display: inline-block;margin-bottom: 30px;" class="sebodo-underlined">
			<?php _e( 'Customer details', 'woocommerce' ); ?>					
		</h4>
	</div>
	<div class="row">
		<div class="col-sm-8 col-12 mx-auto">
			<?php if ( $show_shipping ) : ?>
		
			<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses row">
				<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-6">
		
			<?php endif; ?>
		
			<h4 class="woocommerce-column__title"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h4>
		
			<address>
				<?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>
		
				<?php if ( $order->get_billing_phone() ) : ?>
					<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
				<?php endif; ?>
		
				<?php if ( $order->get_billing_email() ) : ?>
					<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
				<?php endif; ?>
			</address>
		
			<?php if ( $show_shipping ) : ?>
		
				</div><!-- /.col-1 -->
		
				<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-6">
					<h4 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>
					<address>
						<?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'woocommerce' ) ) ); ?>
					</address>
				</div><!-- /.col-2 -->
		
			</section><!-- /.col2-set -->
		
			<?php endif; ?>
		
			<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

			<div class="to-shop-wrapper">
				<a href="<?php echo $shop_page_url ?>" class="to-shop">
					Continue Shopping
					<i class="fa fa-chevron-right"></i>
				</a>
			</div>
		</div>
	</div>

</section>

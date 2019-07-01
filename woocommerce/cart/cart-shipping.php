<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
$is_checkout_page = is_checkout();
$shipping_method_class	  = $is_checkout_page ? 'offset-md-1 col-sm-5 col-3 text-sm-center text-right' : 'col-sm-2 col-md-2 col-2' ;
?>

<tr class="woocommerce-shipping-totals shipping row align-items-center">
	<td class="col-sm-2 col-md-2 col-4"><?php echo wp_kses_post( $package_name ); ?></td>
	<?php if ( $available_methods ) : ?>
	<td class="col-sm-4 col-md-4 col-5"	 data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php if ( is_cart() ) : ?>
			<p class="woocommerce-shipping-destination">
				<?php
				if ( $formatted_destination ) {
					// Translators: $s shipping destination.
					printf( esc_html__( 'Estimate for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
					$calculator_text = __( 'Change address', 'woocommerce' );
				} else {
					echo esc_html__( 'This is only an estimate. Prices will be updated during checkout.', 'woocommerce' );
				}
				?>
			</p>
		<?php endif; ?>
	</td>
	<td class="<?php esc_attr_e($shipping_method_class) ?>">
		<ul id="shipping_method" class="woocommerce-shipping-methods">
			<?php foreach ( $available_methods as $method ) : ?>
				<li>
					<?php
					if ( 1 < count( $available_methods ) ) {
						printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
					} else {
						printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
					}
					printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
					do_action( 'woocommerce_after_shipping_rate', $method, $index );
					?>
				</li>
			<?php endforeach; ?>
		</ul>
	</td>
	<?php
	elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
		esc_html_e( 'Enter your address to view shipping options.', 'woocommerce' );

	elseif ( ! is_cart() ) :
	?>
		<td class="col-sm-4 col-md-4 col-xs-4"	 data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php
		echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping methods available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) );
		echo '</td>';

	else :
		// Translators: $s shipping destination.
	?>
		<td class="col-sm-4 col-md-4 col-xs-4"	 data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php
		echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
		$calculator_text = __( 'Enter a different address', 'woocommerce' );
		if ( $show_shipping_calculator ) {
			woocommerce_shipping_calculator( $calculator_text );
		}
		echo '</td>';

	endif;
	?>

	<?php if ( $show_package_details ) : ?>
		<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
	<?php endif; ?>
	<?php if( !( is_checkout() ) ) : ?>
		<td class="col-sm-2 col-md-2 col-2"></td>
	<?php endif; ?>
</tr>

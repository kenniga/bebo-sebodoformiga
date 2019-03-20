<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	print ($wrap_before);

	foreach ( $breadcrumb as $key => $crumb ) {

		print ($before);

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo '<span>' .esc_html( $crumb[0] ). '</span>';
		}

		print ($after);

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '/';
		}

	}

	print ($wrap_after);

}
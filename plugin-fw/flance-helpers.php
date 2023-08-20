<?php
if ( ! function_exists( 'flance_woocommerce_template_single_add_to_cart' ) ) {

	/**
	 * Trigger the single product add to cart action.
	 */
	function flance_woocommerce_template_single_add_to_cart() {
		global $product;
		echo 'woocommerce_' . $product->get_type() . '_add_to_cart';
		do_action( 'flance_woocommerce_' . $product->get_type() . '_add_to_cart' );
	}
}


if ( ! function_exists( 'flance_woocommerce_simple_add_to_cart' ) ) {

	/**
	 * Output the simple product add to cart area.
	 */
	function flance_woocommerce_simple_add_to_cart() {
		wc_get_template( 'single-product/save/simple.php', array(), '', FLANCE_WCQV_DIR . 'templates/' );
	}
}

add_action( 'flance_woocommerce_simple_add_to_cart', 'flance_woocommerce_simple_add_to_cart', 30 );


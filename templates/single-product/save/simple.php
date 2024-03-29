<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;
global $product;
if ( ! $product->is_purchasable() ) {
	return;
}
echo wc_get_stock_html( $product ); // WPCS: XSS ok.
if ( $product->is_in_stock() ) : ?>

	<?php //do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form  action="" method="post" enctype='multipart/form-data'>
		<?php
		do_action( 'flance_woocommerce_before_add_to_cart_button' ); ?>

		<?php
		//do_action( 'woocommerce_before_add_to_cart_quantity' );
		?>
		<input type="hidden" id="flance-qty" name="quantity" value="1" inputmode="numeric">
		<button type="button" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button single-button-save button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
			Save
		</button>


	</form>


<?php endif; ?>

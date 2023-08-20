<?php

$product = wc_get_product( $product_id );
if ( $product ) {
	$product_name  = $product->get_name();
	$product_price = $product->get_price();
} else {
	$product_name  = 'Product Not Found';
	$product_price = '';
}

 $currency_symbol = get_woocommerce_currency_symbol();

?>

	<div class="wpc-inner-addon-container wpc-addon wpc-addon-testa" data-product-name="<?php echo esc_attr( $product_name ); ?>">
		<label for="wpc_addon-<?php echo esc_attr( $product_name ); ?>" class="wpc-addon-name" data-addon-name="<?php echo esc_attr( $product_name ); ?>"><?php echo esc_html( $product_name ); ?></label>

		<div class="wpc-addon-wrap wpc-addon-checkbox-wrap wpc-addon-<?php echo esc_attr( $product_id ); ?>-<?php echo esc_attr( $product_name ); ?>-2-0">
			<label>
				<input type="checkbox" class="wpc-addon-field wpc-addon-checkbox yith-wcqv-button-checkbox" name="wpc_addon-<?php echo esc_attr( $product_id ); ?>-<?php echo esc_attr( $product_name ); ?>[]" value="red"
					   data-price-type="quantity_based"
					   data-price="<?php echo esc_attr( $product_price ); ?>"
					   data-label="red"
					   data-product_id="<?php echo esc_attr( $product_id ); ?>">
				<span class="wpc-veriation-attribute">
                    <?php echo esc_attr( $product_name ); ?> (+<span class="woocommerce-Price-amount amount"><bdi>
							<span class="woocommerce-Price-currencySymbol">
								<?php echo esc_html($currency_symbol); ?>
							</span>
							<?php echo esc_html( $product_price ); ?>
						</bdi>
					</span>)
                </span>
			</label>
		</div>
		 <div class="stm-loader"></div>
	</div>
<?php


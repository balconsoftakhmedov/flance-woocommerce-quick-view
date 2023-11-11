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

	<div class="wpc-addon wpc-addon-testa wpc-addon-item-block" data-product-name="<?php echo esc_attr( $product_name ); ?>">
		<?php /*<label for="wpc_addon-<?php echo esc_attr( $product_name ); ?>" class="wpc-addon-name" data-addon-name="<?php echo esc_attr( $product_name ); ?>"><?php echo esc_html( $product_name ); ?></label> */?>
<?php


		$wpc_addons = array_filter( (array) $product->get_meta( '_wpc_pro_pao_data' ) );
$class_modal = '';
 if (!empty($wpc_addons)) $class_modal = 'yith-wcqv-button-checkbox' ?>
		<div class="wpc-addon-wrap wpc-addon-checkbox-wrap wpc-addon-<?php echo esc_attr( $product_id ); ?>-<?php echo esc_attr( $product_name ); ?>-2-0">
			<label>
				<input type="checkbox" class="wpc-addon-field stm-parent wpc-addon-checkbox <?php echo  $class_modal ?>" name="wpc_addon-<?php echo esc_attr( $product_id ); ?>-<?php echo esc_attr( $product_name ); ?>[]" value="red"
					   data-price-type="quantity_based"
					   data-price="<?php echo esc_attr( $product_price ); ?>"
					   data-label="<?php echo esc_attr( $product_name ); ?>"
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


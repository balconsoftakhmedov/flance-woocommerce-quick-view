<?php
/**
 * Premium tab array
 *
 * @author  FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Woocommerce Product Child Options
 * @version 1.1.1
 */

defined( 'FLANCE_WCQV' ) || exit; // Exit if accessed directly.

return array(
	'premium' => array(
		'home' => array(
			'type'   => 'custom_tab',
			'action' => 'flance_quick_view_premium',
		),
	),
);

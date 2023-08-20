<?php
/**
 * Premium tab array
 *
 * @author  FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Quick View
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

<?php
/**
 * Settings tab array
 *
 * @author  FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Child Options
 * @version 1.1.1
 */

defined( 'FLANCE_WCQV' ) || exit; // Exit if accessed directly.

$settings = array(

	'settings' => array(

		'style-options'            => array(
			'title' => __( 'Style Options', 'flance-woocommerce-quick-view' ),
			'desc'  => '',
			'type'  => 'title',
			'id'    => 'yith-wcqv-style-options',
		),

		'background-color-modal'   => array(
			'name'      => __( 'Modal Window Background Color', 'flance-woocommerce-quick-view' ),
			'type'      => 'yith-field',
			'yith-type' => 'colorpicker',
			'desc'      => '',
			'id'        => 'yith-wcqv-background-modal',
			'default'   => '#ffffff',
		),

		'close-button-color'       => array(
			'name'      => __( 'Closing Button Color', 'flance-woocommerce-quick-view' ),
			'type'      => 'yith-field',
			'yith-type' => 'colorpicker',
			'desc'      => '',
			'id'        => 'yith-wcqv-close-color',
			'default'   => '#cdcdcd',
		),

		'close-button-color-hover' => array(
			'name'      => __( 'Closing Button Hover Color', 'flance-woocommerce-quick-view' ),
			'type'      => 'yith-field',
			'yith-type' => 'colorpicker',
			'desc'      => '',
			'id'        => 'yith-wcqv-close-color-hover',
			'default'   => '#ff0000',
		),

		'style-options-end'        => array(
			'type' => 'sectionend',
			'id'   => 'yith-wcqv-style-options',
		),


	),
);

return apply_filters( 'flance_wcqv_panel_settings_options', $settings );

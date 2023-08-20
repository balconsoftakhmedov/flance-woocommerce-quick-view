<?php
/**
 * Template for displaying the ajax-products field
 *
 * @var array $field The field.
 * @package FLANCE\PluginFramework\Templates\Fields
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

list ( $data ) = flance_plugin_fw_extract( $field, 'data' );

$field['type'] = 'ajax-posts';
$field_data    = array(
	'post_type'            => 'shop_order',
	'placeholder'          => __( 'Search for an order...', 'yith-plugin-fw' ),
	'action'               => 'flance_plugin_fw_json_search_orders',
	'minimum_input_length' => 1,
);
if ( ! ! $data ) {
	$field_data = wp_parse_args( $data, $field_data );
}

$field['data'] = $field_data;

flance_plugin_fw_get_field( $field, true );

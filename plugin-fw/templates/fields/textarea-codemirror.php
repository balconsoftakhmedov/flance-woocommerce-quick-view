<?php
/**
 * Template for displaying the textarea-codemirror field
 *
 * @var array $field The field.
 * @package FLANCE\PluginFramework\Templates\Fields
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

list ( $field_id, $class, $name, $value, $custom_attributes, $data, $settings ) = flance_plugin_fw_extract( $field, 'id', 'class', 'name', 'value', 'custom_attributes', 'data', 'settings' );

$default_settings = array(
	'type' => 'text/javascript',
);
$settings         = isset( $settings ) ? $settings : array();
$settings         = wp_parse_args( $settings, $default_settings );
$settings         = wp_enqueue_code_editor( $settings );

$class = isset( $class ) ? $class : 'codemirror';
?>
<textarea id="<?php echo esc_attr( $field_id ); ?>"
		name="<?php echo esc_attr( $name ); ?>"
		class="<?php echo esc_attr( $class ); ?>"
		rows="8" cols="50"
		data-settings="<?php echo esc_attr( wp_json_encode( $settings ) ); ?>"
	<?php flance_plugin_fw_html_attributes_to_string( $custom_attributes, true ); ?>
	<?php flance_plugin_fw_html_data_to_string( $data, true ); ?>
><?php echo esc_textarea( $value ); ?></textarea>

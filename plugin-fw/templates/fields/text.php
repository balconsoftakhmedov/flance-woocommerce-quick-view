<?php
/**
 * Template for displaying the text field
 *
 * @var array $field The field.
 * @package FLANCE\PluginFramework\Templates\Fields
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

list ( $field_id, $class, $name, $value, $std, $custom_attributes, $data ) = flance_plugin_fw_extract( $field, 'id', 'class', 'name', 'value', 'std', 'custom_attributes', 'data' );

$class = isset( $class ) ? $class : 'yith-plugin-fw-text-input';
?>
<input type="text"
		id="<?php echo esc_attr( $field_id ); ?>"
		name="<?php echo esc_attr( $name ); ?>"
		class="<?php echo esc_attr( $class ); ?>"
		value="<?php echo esc_attr( $value ); ?>"

	<?php if ( isset( $std ) ) : ?>
		data-std="<?php echo esc_attr( $std ); ?>"
	<?php endif; ?>

	<?php flance_plugin_fw_html_attributes_to_string( $custom_attributes, true ); ?>
	<?php flance_plugin_fw_html_data_to_string( $data, true ); ?>
/>



<?php
/**
 * The Template for displaying the panel
 *
 * @var YIT_Plugin_Panel $panel
 * @var string           $content_id
 * @package    FLANCE\PluginFramework\Templates
 */

defined( 'ABSPATH' ) || exit;

$content_id = $content_id ?? '';

$collapsed_class = get_user_setting( 'yithFwSidebarFold', 'o' ) === 'f' ? 'yith-plugin-fw__panel__sidebar--collapsed' : '';
?>
<div class="yith-plugin-fw__panel">
	<div class="yith-plugin-fw__panel__sidebar <?php echo esc_attr( $collapsed_class ); ?>">
		<?php
		$panel->print_sidebar_header();
		?>
	</div>
	<div id="<?php echo esc_attr( $content_id ); ?>" class="yith-plugin-fw__panel__content">
		<?php $panel->render_panel_content_page(); ?>
	</div>
</div>

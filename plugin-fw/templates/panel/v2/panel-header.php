<?php
/**
 * The Template for displaying the Header in panels.
 *
 * @var string $title
 * @var bool   $is_free
 * @var string $rate_url
 * @package    FLANCE\PluginFramework\Templates
 */

defined( 'ABSPATH' ) || exit;
?>
<?php if ( $is_free && $rate_url ) : ?>
	<div class="yith-plugin-fw-rate">
		<?php
		printf(
			'<strong>%s</strong> %s <a href="%s" target="_blank"><u>%s</u> <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>  %s',
			esc_html__( 'We need your support', 'yith-plugin-fw' ),
			esc_html__( 'to keep updating and improving the plugin. Please,', 'yith-plugin-fw' ),
			esc_url( $rate_url ),
			esc_html__( 'help us by leaving a good review', 'yith-plugin-fw' ),
			esc_html__( ':) Thanks!', 'yith-plugin-fw' )
		);
		?>
	</div>
<?php endif ?>
<div id="yith-plugin-fw__panel__notices"></div>

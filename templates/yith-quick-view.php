<?php
/**
 * Quick view bone.
 *
 * @author  FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Woocommerce Product Child Options
 * @version 1.0.0
 */

defined( 'FLANCE_WCQV' ) || exit; // Exit if accessed directly.

?>

<div id="yith-quick-view-modal">
	<div class="yith-quick-view-overlay"></div>
	<div class="yith-wcqv-wrapper">
		<div class="yith-wcqv-main">
			<div class="yith-wcqv-head">
				<a href="#" id="yith-quick-view-close" class="yith-wcqv-close">X</a>
			</div>
			<div id="yith-quick-view-content" class="woocommerce single-product"></div>
		</div>
	</div>
</div>
<?php

<?php
/**
 * Quick view content.
 *
 * @author  FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Woocommerce Product Child Options
 * @version 1.0.0
 */

defined( 'FLANCE_WCQV' ) || exit; // Exit if accessed directly.

while ( have_posts() ) :
	the_post();
	?>

	<div class="product">

		<div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>
			<div class="summary entry-summary">
				<div class="summary-content">
					<?php do_action( 'flance_wcqv_product_summary' ); ?>
				</div>
			</div>

		</div>

	</div>
	<?php
endwhile; // end of the loop.

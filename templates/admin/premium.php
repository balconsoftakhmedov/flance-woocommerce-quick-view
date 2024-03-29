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
	<style>
		.section {
			overflow-x: hidden;
		}

		.section {
			margin-left: -20px;
			margin-right: -20px;
			font-family: "Raleway", san-serif;
		}

		.section h1 {
			text-align: center;
			text-transform: uppercase;
			color: #808a97;
			font-size: 35px;
			font-weight: 700;
			line-height: normal;
			display: inline-block;
			width: 100%;
			margin: 50px 0 0;
		}

		.section:nth-child(even) {
			background-color: #fff;
		}

		.section:nth-child(odd) {
			background-color: #f1f1f1;
		}

		.section .section-title img {
			display: table-cell;
			vertical-align: middle;
			width: auto;
			margin-right: 15px;
		}

		.section h2,
		.section h3 {
			display: inline-block;
			vertical-align: middle;
			padding: 0;
			font-size: 24px;
			font-weight: 700;
			color: #808a97;
			text-transform: uppercase;
		}

		.section .section-title h2 {
			display: table-cell;
			vertical-align: middle;
			line-height: 27px;
			border: none;
		}

		.section-title {
			display: table;
		}

		.section h3 {
			font-size: 14px;
			line-height: 28px;
			margin-bottom: 0;
			display: block;
		}

		.section p {
			font-size: 13px;
			margin: 25px 0;
		}

		.section ul li {
			margin-bottom: 4px;
		}

		.landing-container {
			max-width: 750px;
			margin-left: auto;
			margin-right: auto;
			padding: 50px 0 30px;
		}

		.landing-container:after {
			display: block;
			clear: both;
			content: '';
		}

		.landing-container .col-1,
		.landing-container .col-2 {
			float: left;
			box-sizing: border-box;
			padding: 0 15px;
		}

		.landing-container .col-1 img {
			width: 100%;
		}

		.landing-container .col-1 {
			width: 55%;
		}

		.landing-container .col-2 {
			width: 45%;
		}

		.premium-cta {
			background-color: #808a97;
			color: #fff;
			border-radius: 6px;
			padding: 20px 15px;
		}

		.premium-cta:after {
			content: '';
			display: block;
			clear: both;
		}

		.premium-cta p {
			margin: 7px 0;
			font-size: 14px;
			font-weight: 500;
			display: inline-block;
			width: 60%;
		}

		.premium-cta a.button {
			border-radius: 6px;
			height: 60px;
			float: right;
			background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/upgrade.png) #ff643f no-repeat 13px 13px;
			border-color: #ff643f;
			box-shadow: none;
			outline: none;
			color: #fff;
			position: relative;
			padding: 9px 50px 9px 70px;
		}

		.premium-cta a.button:hover,
		.premium-cta a.button:active,
		.premium-cta a.button:focus {
			color: #fff;
			background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/upgrade.png) #971d00 no-repeat 13px 13px;
			border-color: #971d00;
			box-shadow: none;
			outline: none;
		}

		.premium-cta a.button:focus {
			top: 1px;
		}

		.premium-cta a.button span {
			line-height: 13px;
		}

		.premium-cta a.button .highlight {
			display: block;
			font-size: 20px;
			font-weight: 700;
			line-height: 20px;
		}

		.premium-cta .highlight {
			text-transform: uppercase;
			background: none;
			font-weight: 800;
			color: #fff;
		}

		@media (max-width: 768px) {
			.section {
				margin: 0
			}

			.premium-cta p {
				width: 100%;
			}

			.premium-cta {
				text-align: center;
			}

			.premium-cta a.button {
				float: none;
			}

			.section .section-title h2 {
				display: block;
				margin-top: 15px;
			}
		}

		@media (max-width: 480px) {
			.wrap {
				margin-right: 0;
			}

			.section {
				margin: 0;
			}

			.landing-container .col-1,
			.landing-container .col-2 {
				width: 100%;
				padding: 0 15px;
			}

			.section-odd .col-1 {
				float: left;
				margin-right: -100%;
			}

			.section-odd .col-2 {
				float: right;
				margin-top: 100%;
			}

			.section-even .landing-container .col-1 {
				margin-bottom: 26px;
			}
		}

		@media (max-width: 320px) {
			.premium-cta a.button {
				padding: 9px 20px 9px 70px;
			}

			.section .section-title img {
				display: none;
			}
		}
	</style>
	<div class="landing">
		<div class="section section-cta section-odd">
			<div class="landing-container">
				<div class="premium-cta">
					<p>
						<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'Upgrade to %1$spremium version%2$s of %1$sFLANCE WooCommerce Woocommerce Product Child Options%2$s to benefit from all features!', 'flance-woocommerce-quick-view' ), '<span class="highlight">', '</span>' );
						?>
					</p>
					<a href="<?php echo esc_url( FLANCE_WCQV_Admin()->get_premium_landing_uri() ); ?>" target="_blank"
						class="premium-cta-button button btn">
						<span class="highlight"><?php esc_html_e( 'UPGRADE', 'flance-woocommerce-quick-view' ); ?></span>
						<span><?php esc_html_e( 'to the premium version', 'flance-woocommerce-quick-view' ); ?></span>
					</a>
				</div>
			</div>
		</div>
		<div class="section section-even clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/01-bg.png) no-repeat #fff; background-position: 85% 75%">
			<h1><?php esc_html_e( 'Premium Features', 'flance-woocommerce-quick-view' ); ?></h1>
			<div class="landing-container">
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/01.png"
						alt="<?php esc_html_e( 'Button type', 'flance-woocommerce-quick-view' ); ?>"/>
				</div>
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/01-icon.png" alt="Review Title"/>
						<h2><?php esc_html_e( 'BUTTON TYPE', 'flance-woocommerce-quick-view' ); ?></h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'Choose between the button or a custom icon to access the %1$sWoocommerce Product Child Options%2$s: you can choose to place it after the "Add To Cart" button or inside the thumbnail of the product.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
			</div>
		</div>
		<div class="section section-odd clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/02-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
			<div class="landing-container">
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/02-icon.png"
							alt="<?php esc_html_e( 'Product Navigation', 'flance-woocommerce-quick-view' ); ?>"/>
						<h2><?php esc_html_e( 'Product Navigation', 'flance-woocommerce-quick-view' ); ?> </h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'The navigation in the "Woocommerce Product Child Options" allows browsing among %1$sproducts%2$s displayed in it. The navigation arrows show on mousehover the image of the next/previous product.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/02.png"
						alt="<?php esc_html_e( 'Product Navigation', 'flance-woocommerce-quick-view' ); ?>"/>
				</div>
			</div>
		</div>
		<div class="section section-even clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/03-bg.png) no-repeat #fff; background-position: 85% 100%">
			<div class="landing-container">
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/03.png" alt="Icon 03"/>
				</div>
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/03-icon.png"
							alt="<?php esc_html_e( 'Content to display', 'flance-woocommerce-quick-view' ); ?>"/>
						<h2><?php esc_html_e( 'Content to display', 'flance-woocommerce-quick-view' ); ?></h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'The display of the product information in the "Woocommerce Product Child Options" are managed by %1$sadministrators%2$s who can decide whether to show everything or only a part of it.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
			</div>
		</div>
		<div class="section section-odd clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/07-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
			<div class="landing-container">
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/07-icon.png" alt="icon 04"/>
						<h2><?php esc_html_e( 'Woocommerce Product Child Options Type', 'flance-woocommerce-quick-view' ); ?> </h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'Quick view has two different displaying modes: the first one opens it as a %1$smodal window%2$s, the other one opens it in the page itself with a %1$scascading effect%2$s above content page.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/07.png"
						alt="<?php esc_html_e( 'Quick view type', 'flance-woocommerce-quick-view' ); ?>"/>
				</div>
			</div>
		</div>
		<div class="section section-even clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/08-bg.png) no-repeat #fff; background-position: 85% 100%">
			<div class="landing-container">
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/08.png" alt="View details"/>
				</div>
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/08-icon.png"
							alt="Vote the review"/>
						<h2><?php esc_html_e( '"View details" button', 'flance-woocommerce-quick-view' ); ?></h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'An additional button that allows users to access product detail page directly from quick view window just with a click of the mouse.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
			</div>
		</div>
		<div class="section section-odd clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/04-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
			<div class="landing-container">
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/04-icon.png" alt="Number"/>
						<h2><?php esc_html_e( 'Type of product images', 'flance-woocommerce-quick-view' ); ?></h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'Each product can have more than one image: choose whether to hide or show them with the %1$sslider%2$s effect or in the classic %1$sWooCommerce%2$s display.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/04.png" alt="Icon 04"/>
				</div>
			</div>
		</div>
		<div class="section section-even clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/05-bg.png) no-repeat #fff; background-position: 85% 100%">
			<div class="landing-container">
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/05.png" alt="Share"/>
				</div>
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/05-icon.png" alt="icon 05"/>
						<h2><?php esc_html_e( 'SHARE', 'flance-woocommerce-quick-view' ); ?></h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( '%1$sWoocommerce Product Child Options is also social-friendly!%2$s Activating this option, you will be able to share the Woocommerce Product Child Options on Facebook, Twitter, Pinterest, Google+, or sending an email.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
			</div>
		</div>
		<div class="section section-odd clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/06-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
			<div class="landing-container">
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/06-icon.png" alt="Icon 06"/>
						<h2><?php esc_html_e( 'Style Options', 'flance-woocommerce-quick-view' ); ?></h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'A rich option panel to change the colors of the %1$s"Woocommerce Product Child Options"%2$s button and of everything that is within the modal window generated.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/06.png"
						alt="<?php esc_html_e( 'Style Options', 'flance-woocommerce-quick-view' ); ?>"/>
				</div>
			</div>
		</div>
		<div class="section section-even clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/09-bg.png) no-repeat #fff; background-position: 85% 100%">
			<div class="landing-container">
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/09.png" alt=""/>
				</div>
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/09-icon.png" alt="icon 09"/>
						<h2><?php esc_html_e( 'SHORTCODE', 'flance-woocommerce-quick-view' ); ?></h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'The shortcode of plugin is a $1$srapid$2$s and $1$seasy$2$s solution: you can add a button in any spot of the page to allow your users to see the quick view of a specific product in your store.', 'flance-woocommerce-quick-view' ), '<b>', '</b>' );
					?>
					</p>
				</div>
			</div>
		</div>
		<div class="section section-odd clear"
			style="background: url(<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/09-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
			<div class="landing-container">
				<div class="col-2">
					<div class="section-title">
						<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/09-icon.png" alt="Icon 10"/>
						<h2><?php esc_html_e( 'Compatibility with other FLANCE\'s plugins', 'flance-woocommerce-quick-view' ); ?></h2>
					</div>
					<p>
					<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'Thanks to the compatibility with %1$sFLANCE WooCommerce Zoom Magnifier, FLANCE WooCommerce Badge Management%2$s and %1$sFLANCE WooCommerce Wishlist%2$s, you will be free to enrich further the content of your quick view.%3$s Zoom the product image, show a badge, or add the button to open the quick view in all products available in your users\' wishlists. With FLANCE\'s plugins you make the difference.', 'flance-woocommerce-quick-view' ), '<b>', '</b>', '<br>' );
					?>
					</p>
				</div>
				<div class="col-1">
					<img src="<?php echo esc_url( FLANCE_WCQV_ASSETS_URL ); ?>/image/10.png" alt=""/>
				</div>
			</div>
		</div>
		<div class="section section-cta section-odd">
			<div class="landing-container">
				<div class="premium-cta">
					<p>
						<?php
						// translators: placeholders are used to add html tags.
						echo sprintf( esc_html__( 'Upgrade to %1$spremium version%2$s of %1$sFLANCE WooCommerce Woocommerce Product Child Options%2$s to benefit from all features!', 'ywqa' ), '<span class="highlight">', '</span>' );
						?>
					</p>
					<a href="<?php echo esc_url( FLANCE_WCQV_Admin()->get_premium_landing_uri() ); ?>" target="_blank"
						class="premium-cta-button button btn">
						<span class="highlight"><?php esc_html_e( 'UPGRADE', 'flance-woocommerce-quick-view' ); ?></span>
						<span><?php esc_html_e( 'to the premium version', 'flance-woocommerce-quick-view' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
<?php

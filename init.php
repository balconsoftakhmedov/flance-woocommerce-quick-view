<?php
/**
 * Plugin Name: Flance WooCommerce Woocommerce Product Child Options for advanced options
 * Plugin URI: https://flance.info
 * Description:
 * Version: 3.1.0
 * Author: flance
 * Author URI: https://flance.info/
 * Text Domain: flance-woocommerce-quick-view
 * Domain Path: /languages/
 * WC requires at least: 7.8
 * WC tested up to: 8.0
 *
 * @author  flance
 * @package Flance WooCommerce Woocommerce Product Child Options
 * @version 1.1.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

/**
 * Message if WooCommerce is not installed.
 *
 * @since 1.0.0
 * @return void
 */
function flance_wcqv_install_woocommerce_admin_notice() {
	?>
	<div class="error">
		<p><?php esc_html_e( 'FLANCE WooCommerce Woocommerce Product Child Options is enabled but not effective. It requires WooCommerce in order to work.', 'flance-woocommerce-quick-view' ); ?></p>
	</div>
	<?php
}

/**
 * Message if Premium plugin is installed.
 *
 * @since 1.0.0
 * @return void
 */
function flance_wcqv_install_free_admin_notice() {
	?>
	<div class="error">
		<p><?php esc_html_e( 'You can\'t activate the free version of FLANCE WooCommerce Woocommerce Product Child Options while you are using the premium one.', 'flance-woocommerce-quick-view' ); ?></p>
	</div>
	<?php
}

if ( ! function_exists( 'flance_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'flance_plugin_registration_hook' );


if ( ! defined( 'FLANCE_WCQV_VERSION' ) ) {
	define( 'FLANCE_WCQV_VERSION', '1.30.0' );
}

if ( ! defined( 'FLANCE_WCQV_FREE_INIT' ) ) {
	define( 'FLANCE_WCQV_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'FLANCE_WCQV_INIT' ) ) {
	define( 'FLANCE_WCQV_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'FLANCE_WCQV' ) ) {
	define( 'FLANCE_WCQV', true );
}

if ( ! defined( 'FLANCE_WCQV_FILE' ) ) {
	define( 'FLANCE_WCQV_FILE', __FILE__ );
}

if ( ! defined( 'FLANCE_WCQV_URL' ) ) {
	define( 'FLANCE_WCQV_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'FLANCE_WCQV_DIR' ) ) {
	define( 'FLANCE_WCQV_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'FLANCE_WCQV_TEMPLATE_PATH' ) ) {
	define( 'FLANCE_WCQV_TEMPLATE_PATH', FLANCE_WCQV_DIR . 'templates' );
}

if ( ! defined( 'FLANCE_WCQV_ASSETS_URL' ) ) {
	define( 'FLANCE_WCQV_ASSETS_URL', FLANCE_WCQV_URL . 'assets' );
}

if ( ! defined( 'FLANCE_WCQV_SLUG' ) ) {
	define( 'FLANCE_WCQV_SLUG', 'flance-woocommerce-quick-view' );
}

/* Plugin Framework Version Check */
if ( ! function_exists( 'yit_maybe_plugin_fw_loader' ) && file_exists( FLANCE_WCQV_DIR . 'plugin-fw/init.php' ) ) {
	require_once FLANCE_WCQV_DIR . 'plugin-fw/init.php';
}
yit_maybe_plugin_fw_loader( FLANCE_WCQV_DIR );

/**
 * Init.
 *
 * @since 1.0.0
 * @return void
 */
function flance_wcqv_init() {

	load_plugin_textdomain( 'flance-woocommerce-quick-view', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	// Load required classes and functions.
	require_once 'includes/class.yith-wcqv.php';
	// Let's start the game!
	FLANCE_WCQV();
}

add_action( 'flance_wcqv_init', 'flance_wcqv_init' );

/**
 * Install.
 *
 * @since 1.0.0
 * @return void
 */
function flance_wcqv_install() {

	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'flance_wcqv_install_woocommerce_admin_notice' );
	} elseif ( defined( 'FLANCE_WCQV_PREMIUM' ) ) {
		add_action( 'admin_notices', 'flance_wcqv_install_free_admin_notice' );
		deactivate_plugins( plugin_basename( __FILE__ ) );
	} else {
		do_action( 'flance_wcqv_init' );
	}
}

add_action( 'plugins_loaded', 'flance_wcqv_install', 11 );

add_action( 'before_woocommerce_init', 'flance_wcqv_declare_hpos_compatibility' );

/**
 * Declare HPOS compatibility
 *
 * @return void
 * @since  1.23.0
 */

if( ! function_exists( 'flance_wcqv_declare_hpos_compatibility' ) ){
	function flance_wcqv_declare_hpos_compatibility() {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
	}
}


require_once 'plugin-fw/product-addons_helpers.php';
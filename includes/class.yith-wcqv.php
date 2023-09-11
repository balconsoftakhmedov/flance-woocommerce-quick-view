<?php
/**
 * Main class
 *
 * @author  FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Woocommerce Product Child Options
 * @version 1.0.0
 */

defined( 'FLANCE_WCQV' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'FLANCE_WCQV' ) ) {
	/**
	 * FLANCE WooCommerce Woocommerce Product Child Options
	 *
	 * @since 1.0.0
	 */
	class FLANCE_WCQV {

		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 * @var FLANCE_WCQV
		 */
		protected static $instance;

		/**
		 * Plugin version
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $version = FLANCE_WCQV_VERSION;

		/**
		 * Plugin object
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $obj = null;

		/**
		 * Returns single instance of the class
		 *
		 * @since 1.0.0
		 * @return FLANCE_WCQV
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function __construct() {

			// Load Plugin Framework.
			add_action( 'after_setup_theme', array( $this, 'plugin_fw_loader' ), 1 );

			if ( $this->can_load() ) {
				if ( $this->is_admin() ) {
					require_once 'class.yith-wcqv-admin.php';
					FLANCE_WCQV_Admin();
				}
				if ( $this->load_frontend() ) {
					require_once 'class.yith-wcqv-frontend.php';
					FLANCE_WCQV_Frontend();
				}
			}
		}

		/**
		 * Check if the plugin can load. Exit if is WooCommerce AJAX.
		 *
		 * @since  1.5
		 * @return boolean
		 */
		public function can_load() {
			$action = array(
				'woocommerce_get_refreshed_fragments',
				'woocommerce_apply_coupon',
				'woocommerce_remove_coupon',
				'woocommerce_update_shipping_method',
				'woocommerce_update_order_review',
				'woocommerce_add_to_cart',
				'woocommerce_checkout',
			);

			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $action, true ) ) {
				return false;
			}

			return true;
		}

		/**
		 * Check if context is admin
		 *
		 * @since  1.2.0
		 * @return boolean
		 */
		public function is_admin() {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['context'] ) && 'frontend' === $_REQUEST['context'] );
			return apply_filters( 'flance_wcqv_is_admin', is_admin() && ! $is_ajax );
		}

		/**
		 * Check if load or not frontend
		 *
		 * @since  1.2.0
		 * @return boolean
		 */
		public function load_frontend() {
			$enable           = get_option( 'yith-wcqv-enable', 'yes' ) === 'yes';
			$enable_on_mobile = get_option( 'yith-wcqv-enable-mobile', 'yes' ) === 'yes';
			$is_mobile        = wp_is_mobile();

			return apply_filters( 'flance_wcqv_load_frontend', ( ! $is_mobile && $enable ) || ( $is_mobile && $enable_on_mobile ) );
		}


		/**
		 * Load Plugin Framework
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function plugin_fw_loader() {
			if ( ! defined( 'YIT_CORE_PLUGIN' ) ) {
				global $plugin_fw_data;
				if ( ! empty( $plugin_fw_data ) ) {
					$plugin_fw_file = array_shift( $plugin_fw_data );
					require_once $plugin_fw_file;
				}
			}
		}
	}
}

/**
 * Unique access to instance of FLANCE_WCQV class
 *
 * @since 1.0.0
 * @return FLANCE_WCQV
 */
function FLANCE_WCQV() { // phpcs:ignore
	return FLANCE_WCQV::get_instance();
}

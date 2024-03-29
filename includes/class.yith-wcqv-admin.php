<?php
/**
 * Admin class
 *
 * @author  FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Woocommerce Product Child Options
 * @version 1.1.1
 */

defined( 'FLANCE_WCQV' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'FLANCE_WCQV_Admin' ) ) {
	/**
	 * Admin class.
	 * The class manage all the admin behaviors.
	 *
	 * @since 1.0.0
	 */
	class FLANCE_WCQV_Admin {

		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 * @var FLANCE_WCQV_Admin
		 */
		protected static $instance;

		/**
		 * Plugin options
		 *
		 * @since  1.0.0
		 * @var array
		 * @access public
		 */
		public $options = array();

		/**
		 * Plugin version
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $version = FLANCE_WCQV_VERSION;

		/**
		 * Panel Object
		 *
		 * @since 1.0.0
		 * @var object $panel
		 */
		protected $panel;

		/**
		 * Premium tab template file name
		 *
		 * @since 1.0.0
		 * @var string $premium
		 */
		protected $premium = 'premium.php';

		/**
		 * Premium version landing link
		 *
		 * @since 1.0.0
		 * @var string
		 */
		protected $premium_landing = 'https://flance.info/';

		/**
		 * Woocommerce Product Child Options panel page
		 *
		 * @since 1.0.0
		 * @var string
		 */
		protected $panel_page = 'flance_wcqv_panel';

		/**
		 * Returns single instance of the class
		 *
		 * @since 1.0.0
		 * @return FLANCE_WCQV_Admin
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
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {

			// Add panel options.
			add_action( 'admin_menu', array( $this, 'register_panel' ), 5 );

			// Add action links.
			add_filter( 'plugin_action_links_' . plugin_basename( FLANCE_WCQV_DIR . '/' . basename( FLANCE_WCQV_FILE ) ), array( $this, 'action_links' ) );
			add_filter( 'flance_show_plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 5 );



			// FLANCE WCQV Loaded!
			do_action( 'flance_wcqv_loaded' );

		}


		/**
		 * Add the action links to plugin admin page
		 *
		 * @since    1.0
		 * @param array $links An array og plugin links.
		 *
		 * @return   array
		 * @use      plugin_action_links_{$plugin_file_name}
		 */
		public function action_links( $links ) {
			$links = flance_add_action_links( $links, $this->panel_page, false );
			return $links;
		}

		/**
		 * Add a panel under FLANCE Plugins tab
		 *
		 * @since    1.0
		 * @use      /Yit_Plugin_Panel class
		 * @return   void
		 * @see      plugin-fw/lib/yit-plugin-panel.php
		 */
		public function register_panel() {

			if ( ! empty( $this->panel ) ) {
				return;
			}

			$admin_tabs = array(
				'settings' => __( 'Settings', 'flance-woocommerce-quick-view' )

			);

			$args = array(
				'create_menu_page' => true,
				'parent_slug'      => '',
				'page_title'       => 'FLANCE WooCommerce Woocommerce Product Child Options',
				'menu_title'       => 'Woocommerce Product Child Options',
				'capability'       => 'manage_options',
				'parent'           => '',
				'parent_page'      => 'flance_plugin_panel',
				'page'             => $this->panel_page,
				'admin-tabs'       => $admin_tabs,
				'options-path'     => FLANCE_WCQV_DIR . '/plugin-options',
				'class'            => flance_set_wrapper_class(),
				'plugin_slug'      => FLANCE_WCQV_SLUG,
				'is_free'          => true,
			);

			/* === Fixed: not updated theme  === */
			if ( ! class_exists( 'YIT_Plugin_Panel_WooCommerce' ) ) {
				require_once 'plugin-fw/lib/yit-plugin-panel-wc.php';
			}

			$this->panel = new YIT_Plugin_Panel_WooCommerce( $args );
		}

		/**
		 * Premium Tab Template
		 *
		 * Load the premium tab template on admin page
		 *
		 * @since    1.0
		 * @return   void
		 */
		public function premium_tab() {
			$premium_tab_template = FLANCE_WCQV_TEMPLATE_PATH . '/admin/' . $this->premium;
			if ( file_exists( $premium_tab_template ) ) {
				include_once $premium_tab_template;
			}

		}

		/**
		 * Plugin Row Meta
		 *
		 * @since    1.0
		 * @use      plugin_row_meta
		 * @param array    $new_row_meta_args An array of plugin row meta.
		 * @param string[] $plugin_meta       An array of the plugin's metadata,
		 *                                    including the version, author,
		 *                                    author URI, and plugin URI.
		 * @param string   $plugin_file       Path to the plugin file relative to the plugins directory.
		 * @param array    $plugin_data       An array of plugin data.
		 * @param string   $status            Status of the plugin. Defaults are 'All', 'Active',
		 *                                    'Inactive', 'Recently Activated', 'Upgrade', 'Must-Use',
		 *                                    'Drop-ins', 'Search', 'Paused'.
		 *
		 * @return array
		 */
		public function plugin_row_meta( $new_row_meta_args, $plugin_meta, $plugin_file, $plugin_data, $status ) {
			if ( defined( 'FLANCE_WCQV_INIT' ) && FLANCE_WCQV_INIT === $plugin_file ) {
				$new_row_meta_args['slug'] = FLANCE_WCQV_SLUG;

				if ( defined( 'FLANCE_WCQV_PREMIUM' ) ) {
					$new_row_meta_args['is_premium'] = true;
				}
			}
			return $new_row_meta_args;
		}

		/**
		 * Get the premium landing uri
		 *
		 * @since   1.0.0
		 * @return  string The premium landing link
		 */
		public function get_premium_landing_uri() {
			return apply_filters( 'flance_plugin_fw_premium_landing_uri', $this->premium_landing, FLANCE_WCQV_SLUG );
		}

	}
}
/**
 * Unique access to instance of FLANCE_WCQV_Admin class
 *
 * @since 1.0.0
 * @return FLANCE_WCQV_Admin
 */
function FLANCE_WCQV_Admin() { // phpcs:ignore
	return FLANCE_WCQV_Admin::get_instance();
}

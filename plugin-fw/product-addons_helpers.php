<?php

final class Wpcafe_Pro_Custom {

	/**
	 * Instance of self
	 *
	 * @since 1.3.9
	 *
	 * @var Wpcafe_Pro
	 */
	private static $instance = null;

	/**
	 * Initializes the Wpcafe_Pro() class
	 *
	 * Checks for an existing Wpcafe_Pro() instance
	 * and if it doesn't find one, creates it.
	 */
	public static function init() {

		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Instance of Wpcafe
	 */
	private function __construct() {
		add_action( 'plugins_loaded', [ $this, 'initialize_modules' ], 10000 );
	}


	/**
	 * Initialize Modules
	 *
	 * @since 1.3.9
	 */
	public function initialize_modules() {

		spl_autoload_register( [$this, 'stm_my_autoloader'] );
		\WpCafe_Pro\Core\Modules\Product_Addons_Advanced\Frontend\Hooks::instance()->init();
		\WpCafe_Pro\Core\Modules\Product_Addons_Advanced\Admin\Hooks::instance()->init();
	}


	public function stm_my_autoloader( $class_name ) {
		$namespace = 'WpCafe';
		if ( 0 !== strpos( $class_name, $namespace ) ) {
			return;
		}
		$current_file_dir = dirname( __FILE__ );
		$base_dir         = $current_file_dir . '/product-addons-advanced/';
		$file_name        = strtolower(
			preg_replace(
				[ '/\b' . $namespace . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
				[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
				$class_name
			)
		);
		// Compile our path from the corosponding location.
		$file_path = plugin_dir_path( __FILE__ ) . $file_name . '.php';
		if ( file_exists( $file_path ) ) {
			require_once $file_path;
		}
	}

	/**
	 * Assets Directory Url
	 *
	 * @return void
	 */
	public static function assets_url() {
		return trailingslashit( self::plugin_url() . 'assets' );
	}

	/**
	 * Assets Folder Directory Path
	 *
	 * @return void
	 * @since 1.3.9
	 *
	 */
	public static function assets_dir() {
		return trailingslashit( self::plugin_dir() . 'assets' );
	}

	/**
	 * Plugin Core File Directory Url
	 *
	 * @return void
	 * @since 1.3.9
	 *
	 */
	public static function core_url() {
		return trailingslashit( self::plugin_url() . 'core' );
	}

	/**
	 * Plugin Core File Directory Path
	 *
	 * @return void
	 * @since 1.3.9
	 *
	 */
	public static function core_dir() {
		return trailingslashit( self::plugin_dir() . 'core' );
	}

	/**
	 * Plugin Url
	 *
	 * @return void
	 * @since 1.3.9
	 *
	 */
	public static function plugin_url() {
		return trailingslashit( plugin_dir_url( self::plugin_file() ).'wp-cafe-pro' );
	}

	/**
	 * Plugin Directory Path.
	 *
	 * @return void
	 * @since 1.3.9
	 *
	 */
	public static function plugin_dir() {
		return trailingslashit( plugin_dir_path( self::plugin_file() ).'wp-cafe-pro' );
	}

	/**
	 * Plugins Basename
	 *
	 * @since 1.3.9
	 */
	public static function plugins_basename() {
		return plugin_basename( self::plugin_file() );
	}

	/**
	 * Plugin File
	 *
	 * @return void
	 * @since 1.3.9
	 *
	 */
	public static function plugin_file() {
		return __FILE__;
	}
}


/**
 * Load Wpcafe Addon when all plugins are loaded
 *
 * @return Wpcafe
 */
function wpcafe_pro_custom() {
	return Wpcafe_Pro_Custom::init();
}

// Let's Go...
wpcafe_pro_custom();

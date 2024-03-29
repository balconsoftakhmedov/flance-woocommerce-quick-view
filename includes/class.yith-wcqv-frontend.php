<?php
/**
 * Frontend class
 *
 * @author  FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Woocommerce Product Child Options
 * @version 1.1.1
 */

defined( 'FLANCE_WCQV' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'FLANCE_WCQV_Frontend' ) ) {
	/**
	 * Admin class.
	 * The class manage all the Frontend behaviors.
	 *
	 * @since 1.0.0
	 */
	class FLANCE_WCQV_Frontend {

		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 * @var FLANCE_WCQV_Frontend
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
		 * Returns single instance of the class
		 *
		 * @since 1.0.0
		 * @return FLANCE_WCQV_Frontend
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

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );

			// Enqueue gift card script.
			if ( defined( 'FLANCE_YWGC_FILE' ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_gift_card_script' ) );
			}

			// Quick view AJAX.
			add_action( 'wp_ajax_flance_load_product_quick_view', array( $this, 'flance_load_product_quick_view_ajax' ) );
			add_action( 'wp_ajax_nopriv_flance_load_product_quick_view', array( $this, 'flance_load_product_quick_view_ajax' ) );

			// Load modal template.
			add_action( 'wp_footer', array( $this, 'flance_quick_view' ) );

			// Load action for product template.
			$this->flance_quick_view_action_template();
			// Add quick view button.
			//add_action( 'init', array( $this, 'add_button' ) );

			add_shortcode( 'flance_quick_view', array( $this, 'quick_view_shortcode' ) );
			add_filter( 'woocommerce_add_to_cart_form_action', array( $this, 'avoid_redirect_to_single_page' ), 10, 1 );
		}

		/**
		 * Enqueue styles and scripts
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function enqueue_styles_scripts() {

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '';

			wp_register_script( 'yith-wcqv-frontend', FLANCE_WCQV_ASSETS_URL . '/js/frontend' . $suffix . '.js', array( 'jquery' ), time(), true );
			wp_enqueue_script( 'yith-wcqv-frontend' );
			wp_enqueue_style( 'yith-quick-view', FLANCE_WCQV_ASSETS_URL . '/css/yith-quick-view.css', array(), $this->version );

			$background_modal  = get_option( 'yith-wcqv-background-modal', '#ffffff' );
			$close_color       = get_option( 'yith-wcqv-close-color', '#cdcdcd' );
			$close_color_hover = get_option( 'yith-wcqv-close-color-hover', '#ff0000' );

			$inline_style = "
				#yith-quick-view-modal .yith-wcqv-main{background:{$background_modal};}
				#yith-quick-view-close{color:{$close_color};}
				#yith-quick-view-close:hover{color:{$close_color_hover};}";

			wp_add_inline_style( 'yith-quick-view', $inline_style );
		}


		/**
		 * Enqueue scripts for FLANCE WooCommerce Gift Cards
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function enqueue_gift_card_script() {
			if ( ! wp_script_is( 'ywgc-frontend' ) && apply_filters( 'flance_load_gift_card_script_pages_for_quick_view', is_shop() ) && version_compare( FLANCE_YWGC_VERSION, '3.0.0', '<' ) ) {
				wp_register_script( 'ywgc-frontend', FLANCE_YWGC_URL . 'assets/js/' . yit_load_js_file( 'ywgc-frontend.js' ), array( 'jquery', 'woocommerce' ), FLANCE_YWGC_VERSION, true );
				wp_enqueue_script( 'ywgc-frontend' );
			} elseif ( ! wp_script_is( 'ywgc-frontend' ) && apply_filters( 'flance_load_gift_card_script_pages_for_quick_view', is_shop() ) ) {
				wp_register_script( 'ywgc-frontend', FLANCE_YWGC_URL . 'assets/js/' . yit_load_js_file( 'ywgc-frontend.js' ), array( 'jquery', 'woocommerce', 'jquery-ui-datepicker', 'accounting' ), FLANCE_YWGC_VERSION, true );

				wp_localize_script(
					'ywgc-frontend',
					'ywgc_data',
					array(
						'loader'        => apply_filters( 'flance_gift_cards_loader', FLANCE_YWGC_ASSETS_URL . '/images/loading.gif' ),
						'ajax_url'      => admin_url( 'admin-ajax.php' ),
						'wc_ajax_url'   => WC_AJAX::get_endpoint( '%%endpoint%%' ),
						'notice_target' => apply_filters( 'flance_ywgc_gift_card_notice_target', 'div.woocommerce' ),
					)
				);

				wp_enqueue_script( 'ywgc-frontend' );
			}
		}

		/**
		 * Add quick view button hooks
		 *
		 * @since 1.5.0
		 * @return void
		 */
		public function add_button() {
			if ( $this->is_proteo_add_to_cart_hover() ) {
				add_action( 'flance_proteo_products_loop_add_to_cart_actions', array( $this, 'flance_add_quick_view_button' ), 55 );
			} elseif ( flance_plugin_fw_wc_is_using_block_template_in_product_catalogue() ) {
				add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'wc_block_add_button_after_add_to_cart' ), 10, 2 );
			} else {
				add_action( 'woocommerce_after_shop_loop_item', array( $this, 'flance_add_quick_view_button' ), 15 );
			}

			//add_action( 'flance_wcwl_table_after_product_name', array( $this, 'add_quick_view_button_wishlist' ), 15 );
		}


		/**
		 * Check if current theme is FLANCE Proteo and if the add to cart button is visible on image hover
		 *
		 * @since 1.6.7
		 * @return boolean
		 */
		public function is_proteo_add_to_cart_hover() {
			return defined( 'FLANCE_PROTEO_VERSION' ) && 'hover' === get_theme_mod( 'flance_proteo_products_loop_add_to_cart_position', 'classic' );
		}

		/**
		 * Add quick view button in wc product loop
		 *
		 * @access public
		 * @since  1.0.0
		 * @param integer|string $product_id The product id.
		 * @param string         $label      The button label.
		 * @param boolean        $return     True to return, false to echo.
		 * @return string|void
		 */
		public function flance_add_quick_view_button( $product_id = 0, $label = '', $return = false ) {

			global $product;

			if ( ! $product_id && $product instanceof WC_Product ) {
				$product_id = $product->get_id();
			}

			if ( ! apply_filters( 'flance_wcqv_show_quick_view_button', true, $product_id ) ) {
				return;
			}

			$button = '';
			if ( $product_id ) {
				if ( ! $label ) {
					$label = $this->get_button_label();
				}

				$button = '<a href="#" class="button yith-wcqv-button" data-product_id="' . esc_attr( $product_id ) . '">' . $label . '</a>';


			$button = $this->stm_view($product_id);
			$button = apply_filters( 'flance_add_quick_view_button_html', $button, $label, $product );
			}

			if ( $return ) {
				return $button;
			}

			echo $button;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		public function stm_view($product_id) {
			ob_start();
			// load template file via WooCommerce template function
			$button =  wc_get_template( 'single-product/checkbox.php', array('product_id' =>$product_id  ), '', FLANCE_WCQV_DIR . 'templates/' );

			return ob_get_clean();
		}
		/**
		 * Add quick view button in wishlist
		 *
		 * @since 1.5.1
		 * @param FLANCE_WCWL_Wishlist_Item $item THe wishlist item.
		 * @return string|void
		 */
		public function add_quick_view_button_wishlist( $item ) {
			if ( $item instanceof FLANCE_WCWL_Wishlist_Item ) {
				$this->flance_add_quick_view_button( $item->get_product_id() );
			}
		}

		/**
		 * Enqueue scripts and pass variable to js used in quick view
		 *
		 * @access public
		 * @since  1.0.0
		 * @return bool
		 */
		public function flance_woocommerce_quick_view() {

			wp_enqueue_script( 'wc-add-to-cart-variation' );
			if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {
				if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
					wp_enqueue_script( 'zoom' );
				}
				if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
					wp_enqueue_script( 'photoswipe-ui-default' );
					wp_enqueue_style( 'photoswipe-default-skin' );
					if ( has_action( 'wp_footer', 'woocommerce_photoswipe' ) === false ) {
						add_action( 'wp_footer', 'woocommerce_photoswipe', 15 );
					}
				}
				wp_enqueue_script( 'wc-single-product' );
			}

			// Enqueue WC Color and Label Variations style and script.
			wp_enqueue_script( 'flance_wccl_frontend' );
			wp_enqueue_style( 'flance_wccl_frontend' );

			// Allow user to load custom style and scripts!
			do_action( 'flance_quick_view_custom_style_scripts' );

			wp_localize_script(
				'yith-wcqv-frontend',
				'flance_qv',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php', 'relative' ),
					'loader'  => apply_filters( 'flance_quick_view_loader_gif', FLANCE_WCQV_ASSETS_URL . '/image/qv-loader.gif' ),
					'lang'    => defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '',
				)
			);

			return true;
		}

		/**
		 * Ajax action to load product in quick view
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function flance_load_product_quick_view_ajax() {
			// phpcs:disable WordPress.Security.NonceVerification.Recommended
			if ( ! isset( $_REQUEST['product_id'] ) ) {
				die();
			}

			global $sitepress;

			$product_id = intval( $_REQUEST['product_id'] );
			$attributes = array();

			/**
			 * WPML Suppot:  Localize Ajax Call
			 */
			$lang = isset( $_REQUEST['lang'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['lang'] ) ) : '';
			if ( defined( 'ICL_LANGUAGE_CODE' ) && $lang && isset( $sitepress ) ) {
				$sitepress->switch_lang( $lang, true );
			}

			// Set the main wp query for the product.
			wp( 'p=' . $product_id . '&post_type=product' );

			// Remove product thumbnails gallery.
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
			// Change template for variable products.
			if ( isset( $GLOBALS['flance_wccl'] ) ) {
				$GLOBALS['flance_wccl']->obj = new FLANCE_WCCL_Frontend();
				$GLOBALS['flance_wccl']->obj->override();
			} elseif ( defined( 'FLANCE_WCCL_PREMIUM' ) && FLANCE_WCCL_PREMIUM && class_exists( 'FLANCE_WCCL_Frontend' ) ) {
				$attributes = FLANCE_WCCL_Frontend()->create_attributes_json( $product_id, true );
			}
						ob_start();
			wc_get_template( 'yith-quick-view-content.php', array(), '', FLANCE_WCQV_DIR . 'templates/' );
			$html = ob_get_contents();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			ob_end_clean();

			wp_send_json(
				array(
					'html'      => $html,
					'prod_attr' => $attributes,
				)
			);

			die();
			// phpcs:enable WordPress.Security.NonceVerification.Recommended
		}

		/**
		 * Load quick view template
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function flance_quick_view() {
			$this->flance_woocommerce_quick_view();
			wc_get_template( 'yith-quick-view.php', array(), '', FLANCE_WCQV_DIR . 'templates/' );
		}

		/**
		 * Load wc action for quick view product template
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function flance_quick_view_action_template() {

			// Image.
		//	add_action( 'flance_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );
		//	add_action( 'flance_wcqv_product_image', 'woocommerce_show_product_images', 20 );

			// Summary.
		//	add_action( 'flance_wcqv_product_summary', 'woocommerce_template_single_title', 5 );

		//	add_action( 'flance_wcqv_product_summary', 'woocommerce_template_single_price', 15 );

			add_action( 'flance_wcqv_product_summary', 'flance_woocommerce_template_single_add_to_cart', 25 );

		}

		/**
		 * Get Woocommerce Product Child Options button label
		 *
		 * @since  1.2.0
		 * @return string
		 */
		public function get_button_label() {
			$label = get_option( 'yith-wcqv-button-label' );
			$label = call_user_func( '__', $label, 'flance-woocommerce-quick-view' );

			return apply_filters( 'flance_wcqv_button_label', esc_html( $label ) );
		}

		/**
		 * Woocommerce Product Child Options shortcode button
		 *
		 * @access public
		 * @since  1.0.7
		 * @param array $atts An array of shortcode attributes.
		 * @return string
		 */
		public function quick_view_shortcode( $atts ) {


			$atts = shortcode_atts(
				array(
					'product_id' => 0,
					'label'      => '',
				),
				$atts
			);

			extract( $atts ); // phpcs:ignore

			return $this->flance_add_quick_view_button( intval( $product_id ), $label, true );
		}

		/**
		 * Check if is quick view
		 *
		 * @access public
		 * @since  1.3.1
		 * @return bool
		 */
		public function flance_is_quick_view() {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) && 'flance_load_product_quick_view' === $_REQUEST['action'] );
		}

		/**
		 * Avoid redirect to single product page on add to cart action in quick view
		 *
		 * @since  1.3.1
		 * @param string $value The redirect url value.
		 * @return string
		 */
		public function avoid_redirect_to_single_page( $value ) {
			if ( $this->flance_is_quick_view() ) {
				return '';
			}
			return $value;
		}


		/**
		 * Add quick view button after add to cart button in case Woo Blocks are used.
		 *
		 * @param string     $add_to_cart Add to cart HTML.
		 * @param WC_Product $product Global product.
		 *
		 * @return string
		 */
		public function wc_block_add_button_after_add_to_cart( $add_to_cart, $product ) {
			ob_start();
			echo '<div style="text-align: center">';
			$this->flance_add_quick_view_button( $product->get_id() );
			echo '</div>';
			$button = ob_get_clean();
			return $add_to_cart . $button;
		}
	}
}
/**
 * Unique access to instance of FLANCE_WCQV_Frontend class
 *
 * @since 1.0.0
 * @return FLANCE_WCQV_Frontend
 */
function FLANCE_WCQV_Frontend() { // phpcs:ignore
	return FLANCE_WCQV_Frontend::get_instance();
}

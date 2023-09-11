/**
 * frontend.js
 *
 * @author FLANCE <plugins@yithemes.com>
 * @package FLANCE WooCommerce Quick View
 * @version 1.0.0
 */

jQuery(document).ready(function ($) {
	"use strict";

	if (typeof flance_qv === 'undefined') {
		return;
	}

	var qv_modal = $(document).find('#yith-quick-view-modal'),
		qv_overlay = qv_modal.find('.yith-quick-view-overlay'),
		qv_content = qv_modal.find('#yith-quick-view-content'),
		qv_close = qv_modal.find('#yith-quick-view-close'),
		qv_wrapper = qv_modal.find('.yith-wcqv-wrapper'),
		qv_wrapper_w = qv_wrapper.width(),
		qv_wrapper_h = qv_wrapper.height(),
		center_modal = function () {

			var window_w = $(window).width(),
				window_h = $(window).height(),
				width = ((window_w - 60) > qv_wrapper_w) ? qv_wrapper_w : (window_w - 60),
				height = ((window_h - 120) > qv_wrapper_h) ? qv_wrapper_h : (window_h - 120);

			qv_wrapper.css({
				'left': ((window_w / 2) - (width / 2)),
				'top': ((window_h / 2) - (height / 2)),
				'width': width + 'px',
				'height': height + 'px'
			});
		};


	/*==================
	 *MAIN BUTTON OPEN
	 ==================*/

	$.fn.flance_quick_view = function () {

		$(document).off('click', '.yith-wcqv-button').on('click', '.yith-wcqv-button', function (e) {
			e.preventDefault();

			var t = $(this),
				product_id = t.data('product_id'),
				is_blocked = false;

			if (typeof flance_qv.loader !== 'undefined') {
				is_blocked = true;
				t.block({
					message: null,
					overlayCSS: {
						background: '#fff url(' + flance_qv.loader + ') no-repeat center',
						opacity: 0.5,
						cursor: 'none'
					}
				});

				if (!qv_modal.hasClass('loading')) {
					qv_modal.addClass('loading');
				}

				// stop loader
				$(document).trigger('qv_loading');
			}
			ajax_call(t, product_id, is_blocked);
		});
		$(document).off('click', '.yith-wcqv-button-checkbox').on('click', '.yith-wcqv-button-checkbox', function (e) {

			var t = $(this),
				product_id = t.data('product_id'),
				is_blocked = false;

			if (!t.prop('checked')) {
				t.attr('data-json', '[]');
				return;
			}
			t.closest('.wpc-inner-addon-container').addClass('stm-loading');
			if (typeof flance_qv.loader !== 'undefined') {
				is_blocked = true;
				t.block({
					message: null,
					overlayCSS: {
						background: '#fff url(' + flance_qv.loader + ') no-repeat center',
						opacity: 0.5,
						cursor: 'none'
					}
				});

				if (!qv_modal.hasClass('loading')) {
					qv_modal.addClass('loading');
				}

				// stop loader
				$(document).trigger('qv_loading');
			}
			ajax_call(t, product_id, is_blocked);
		});

		var close_qv = function () {
			qv_modal.removeClass('open').removeClass('loading');
			$('.wpc-inner-addon-container').removeClass('stm-loading');
			setTimeout(function () {
				qv_content.html('');
			}, 1000);
		};
		$(document).off('click', '.single-button-save').on('click', '.single-button-save', function (e) {


				var proceed_cart_action = true;

		$('.wpc-addons-container').find('.wpc-addon-required-block').each(function () {
			var current_block = this;
			var field_type    = $(current_block).data('field_type');

			if(field_type == 'dropdown') {
				if ($(current_block).find('option:selected').val() == '') {
					proceed_cart_action = false;
					$(current_block).parent().addClass('wpc-addon-field-error');
				} else {
					$(current_block).parent().removeClass('wpc-addon-field-error');
				}
			} else if(field_type == 'text') {
				if ($.trim($(current_block).find('input[type=text]').val()).length == 0) {
					$(current_block).parent().addClass('wpc-addon-field-error');
				} else {
					$(current_block).parent().removeClass('wpc-addon-field-error');
				}
			} else {
				if ($(current_block).find('input:checked').length == 0) {
					proceed_cart_action = false;
					$(current_block).parent().addClass('wpc-addon-field-error');

					// add required attribute to each item
					$(current_block).find('input').each(function () {
						$(this).attr('required', true);
					});
				} else {
					$(current_block).parent().removeClass('wpc-addon-field-error');
					$(current_block).find('input').each(function () {
						$(this).attr('required', false);
					});
				}
			}
		});

			if (proceed_cart_action) {
				var form = $(this).closest('form');
				var selectedInputs = form.find('input[type="radio"]:checked, input[type="checkbox"]:checked');
				let product_id = $(this).data('product_id');
				// Create an object to store the collected input values
				var collectedValues = [];
				var jsonData = [];
				selectedInputs.each(function () {
					var input = $(this);
					var price = input.data('price');
					let value = input.val();
					let inputName = input.attr('name');
					collectedValues.push(price);
					var inputJsonData = {
						field_name: inputName,
						field_value: value,
						field_price: price
					};

					jsonData.push(inputJsonData);
				});


				var addedValues = 0;
				$.each(collectedValues, function (name, value) {
					if (collectedValues.length > 0) {
						addedValues += value;
					} else {
						addedValues = value;
					}
				});


				var jsonString = JSON.stringify(jsonData);
				let set_el = $('body').find('.wpc-addon-field[data-product_id="' + product_id + '"]');

				set_el.attr('data-json', jsonString);

				set_el.trigger('change');
				console.log('Added Values:', addedValues);
				close_qv();
			}
		});

	};

	/*================
	 * MAIN AJAX CALL
	 ================*/

	var ajax_call = function (t, product_id, is_blocked) {

		$.ajax({
			url: flance_qv.ajaxurl,
			data: {
				action: 'flance_load_product_quick_view',
				product_id: product_id,
				lang: flance_qv.lang,
				context: 'frontend',
			},
			dataType: 'json',
			type: 'POST',
			success: function (data) {

				qv_content.html(data.html);

				// Variation Form
				var form_variation = qv_content.find('.variations_form');
				form_variation.each(function () {
					$(this).wc_variation_form();
					// add Color and Label Integration
					if (typeof $.fn.flance_wccl !== 'undefined') {
						$(this).flance_wccl();
					} else if (typeof $.flance_wccl != 'undefined' && data.prod_attr) {

						$.flance_wccl(data.prod_attr);
					}
				});

				form_variation.trigger('check_variations');
				form_variation.trigger('reset_image');

				if (typeof $.fn.wc_product_gallery !== 'undefined') {
					qv_content.find('.woocommerce-product-gallery').each(function () {
						$(this).wc_product_gallery();
					});
				}

				if (!qv_modal.hasClass('open')) {
					qv_modal.removeClass('loading').addClass('open');
					if (is_blocked)
						t.unblock();
				}

				// stop loader
				$(document).trigger('qv_loader_stop');

			}
		});
	};

	/*===================
	 * CLOSE QUICK VIEW
	 ===================*/

	var close_modal_qv = function () {

		// Close box by click overlay
		qv_overlay.on('click', function (e) {
			close_qv();
		});
		// Close box with esc key
		$(document).keyup(function (e) {
			if (e.keyCode === 27)
				close_qv();
		});
		// Close box by click close button
		qv_close.on('click', function (e) {
			e.preventDefault();
			close_qv();
		});

		var close_qv = function () {
			qv_modal.removeClass('open').removeClass('loading');
			$('.wpc-inner-addon-container').removeClass('stm-loading');
			setTimeout(function () {
				qv_content.html('');
			}, 1000);
		}
	};

	close_modal_qv();


	center_modal();
	$(window).on('resize', center_modal);

	// START
	$.fn.flance_quick_view();

	$(document).on('flance_infs_adding_elem yith-wcan-ajax-filtered', function () {
		// RESTART
		$.fn.flance_quick_view();
	});

});
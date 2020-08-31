<?php
add_filter('woocommerce_checkout_fields', 'glossier_checkout_fields');
function glossier_checkout_fields($fields) {
  unset($fields['billing']['billing_company']);
  $fields['billing']['billing_address_2']['label'] = __('Квартира');
  $fields['order']['order_comments']['label'] = 'Вы можете добавить комментарий к своему заказу';
  return $fields;
}

add_filter('woocommerce_form_field_args','glossier_form_field_args',90,3);

function glossier_form_field_args( $args, $key, $value = null ) {
  if ($args['type'] != 'textarea') {
    $args['label_class'] = ['col-sm-5'];
    $args['class'][] = 'row justify-content-between';
  }
  if ($args['type'] == 'textarea') {
    $args['label_class'] = ['container'];
    $args['input_class'] = ['form-control'];
  }
  return $args;
}

add_filter('woocommerce_form_field', 'glossier_form_field', 80, 4);
function glossier_form_field($field, $key, $args, $value) {
  if ($args['type'] != 'textarea') {
    $replacements = [
      '<p' => '<div',
      '</p' => '</div',
      'woocommerce-input-wrapper' => 'woocommerce-inpu-wrapper col-sm-6',
    ];
    foreach ($replacements as $search => $replacement) {
      $field = str_replace($search, $replacement, $field);
    }
  }
  
  
  return $field;
}


function glossier_cart_totals_shipping_method_label($method) {
  $label     = $method->get_label();
	$has_cost  = 0 < $method->cost;
	$hide_cost = ! $has_cost && in_array( $method->get_method_id(), array( 'free_shipping', 'local_pickup' ), true );

		if ( WC()->cart->display_prices_including_tax() ) {
			$label .= ': ' . wc_price( $method->cost + $method->get_shipping_tax() );
			if ( $method->get_shipping_tax() > 0 && ! wc_prices_include_tax() ) {
				$label .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
			}
		} else {
			$label .= ': ' . wc_price( $method->cost );
			if ( $method->get_shipping_tax() > 0 && wc_prices_include_tax() ) {
				$label .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
			}
		}

	return apply_filters( 'woocommerce_cart_shipping_method_full_label', $label, $method );
}

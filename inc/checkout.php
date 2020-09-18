<?php

function tarte_add_quantity($product_title, $cart_item, $cart_item_key) {
  /* Checkout page check */
  if (  is_checkout() ) {
    /* Get Cart of the user */
    $cart     = WC()->cart->get_cart();
    foreach ( $cart as $cart_key => $cart_value ){
      if ( $cart_key == $cart_item_key ){
        $product_id = $cart_item['product_id'];
        $_product   = $cart_item['data'] ;

        /* Step 1 : Add delete icon */
        $remove = sprintf(
          '<a href="%s" class="btn btn-danger remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-close"></i></a>',
          esc_url( WC()->cart->get_remove_url( $cart_key ) ),
          __( 'Remove this item', 'woocommerce' ),
          esc_attr( $product_id ),
          esc_attr( $_product->get_sku() )
        );

        $image = wp_get_attachment_image(get_post_thumbnail_ID($_product->get_ID())); 
        /* Step 2 : Add product name */
        $return_value = '<div class="product-name-container"><span class="product_name">' . $image . $product_title . '</span>' ;

        /* Step 3 : Add quantity selector */
        if ( $_product->is_sold_individually() ) {
          $return_value .= sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_key );
        } else {
          $return_value .= '<div class="checkout-qty">';
          $return_value .= woocommerce_quantity_input( array(
            'input_name'  => "cart[{$cart_key}][qty]",
            'input_value' => $cart_item['quantity'],
            'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
            'min_value'   => '1'
          ), $_product, false );

          $return_value .= $remove . '</div></div>';
        }
        return $return_value;
      }
    }
  }else{
    /*
     * It will return the product name on the cart page.
     * As the filter used on checkout and cart are same.
     */
    $_product   = $cart_item['data'] ;
    $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
    if ( ! $product_permalink ) {
      $return_value = $_product->get_title() . '';
    } else {
      $return_value = sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title());
    }
    return $return_value;
  }
}
add_filter('woocommerce_cart_item_name', 'tarte_add_quantity', 10, 3);

function remove_quantity_text( $cart_item, $cart_item_key ) {
   $product_quantity = 'aaa';
   return null;
}

add_filter ('woocommerce_checkout_cart_item_quantity', 'remove_quantity_text', 10, 2 );


add_action( 'wp_ajax_update_order_review', 'update_order_review');
add_action( 'wp_ajax_nopriv_update_order_review', 'update_order_review');
function update_order_review() {
  $values = array();
  parse_str($_POST['post_data'], $values);
  $cart = $values['cart'];
  foreach ( $cart as $cart_key => $cart_value ){
      WC()->cart->set_quantity( $cart_key, $cart_value['qty'], false );
      WC()->cart->calculate_totals();
      woocommerce_cart_totals();
  }
  wp_die();
}

add_filter('woocommerce_update_order_review_fragments', 'tarte_update_order_review_fragments');
function tarte_update_order_review_fragments($fragments) {
  $fragments['.shopping-cart-count'] = '<div class="shopping-cart-count">' . WC()->cart->cart_contents_count . '</div>';
  return $fragments;
}

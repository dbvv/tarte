<?php

add_filter('woocommerce_add_to_cart_fragments', 'tarte_add_to_cart_fragments');
function tarte_add_to_cart_fragments($fragments) {
  global $woocommerce;

  $fragments['div.shopping-cart-count'] =  '<div class="shopping-cart-count">' . $woocommerce->cart->cart_contents_count . '</div>';

  // add to cart template
  return $fragments;
}

add_action('woocommerce_before_cart', 'tarte_before_cart');
function tarte_before_cart() {
  echo '<div class="row">';
  echo '<div class="col-sm-12 col-md-8" id="cart-table">';
}

add_action('woocommerce_after_cart', 'tarte_after_cart');
function tarte_after_cart() {
  echo '<div> <!-- end .row -->';
}

add_action('woocommerce_before_cart_table', 'tarte_before_cart_table');
function tarte_before_cart_table() {
}

add_action('woocommerce_after_cart_table', 'tarte_after_cart_table');
function tarte_after_cart_table() {
  echo '</div>';
  echo '<div class="col-sm-4" id="cart-summary">';
}

add_action('woocommerce_after_cart_totals', 'tarte_after_cart_total');
function tarte_after_cart_total() {
  echo '<div>';
}

add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_add_to_cart_text');
add_filter('woocommerce_product_add_to_cart_text', 'woocommerce_custom_add_to_cart_text');
 
function woocommerce_custom_add_to_cart_text() {
    return __('Добавить в корзину', 'woocommerce');
}

add_filter ( 'wc_add_to_cart_message', 'wc_add_to_cart_message_filter', 10, 2 );
function wc_add_to_cart_message_filter($message, $product_id = null) {
    $titles[] = get_the_title( $product_id );

    $titles = array_filter( $titles );
    $added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

    $message = sprintf( '%s <a href="%s" class="button">%s</a>',
                    esc_html( $added_text ),
                    esc_url( wc_get_page_permalink( 'checkout' ) ),
                    esc_html__( 'View cart', 'woocommerce' ));

    return $message;
}

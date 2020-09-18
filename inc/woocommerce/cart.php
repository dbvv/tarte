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

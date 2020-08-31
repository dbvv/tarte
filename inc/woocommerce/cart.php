<?php

add_filter('woocommerce_add_to_cart_fragments', 'glossier_add_to_cart_fragments');
function glossier_add_to_cart_fragments($fragments) {
  global $woocommerce;

  $fragments['div.shopping-cart-count'] =  '<div class="shopping-cart-count">' . $woocommerce->cart->cart_contents_count . '</div>';

  // add to cart template
  return $fragments;
}

add_action('woocommerce_before_cart', 'glossier_before_cart');
function glossier_before_cart() {
  echo '<div class="row">';
  echo '<div class="col-sm-12 col-md-8" id="cart-table">';
}

add_action('woocommerce_after_cart', 'glossier_after_cart');
function glossier_after_cart() {
  echo '<div> <!-- end .row -->';
}

add_action('woocommerce_before_cart_table', 'glossier_before_cart_table');
function glossier_before_cart_table() {
}

add_action('woocommerce_after_cart_table', 'glossier_after_cart_table');
function glossier_after_cart_table() {
  echo '</div>';
  echo '<div class="col-sm-4" id="cart-summary">';
}

add_action('woocommerce_after_cart_totals', 'glossier_after_cart_total');
function glossier_after_cart_total() {
  echo '<div>';
}

add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_add_to_cart_text');
add_filter('woocommerce_product_add_to_cart_text', 'woocommerce_custom_add_to_cart_text');
 
function woocommerce_custom_add_to_cart_text() {
    return __('Добавить в корзину', 'woocommerce');
}

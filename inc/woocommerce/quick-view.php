<?php

remove_action( 'wcqv_product_data', 'woocommerce_template_single_title');
remove_action( 'wcqv_product_data', 'woocommerce_template_single_rating' );
remove_action( 'wcqv_product_data', 'woocommerce_template_single_price');
remove_action( 'wcqv_product_data', 'woocommerce_template_single_excerpt');
remove_action( 'wcqv_product_data', 'woocommerce_template_single_add_to_cart');
remove_action( 'wcqv_product_data', 'woocommerce_template_single_meta' );

add_action( 'wcqv_product_data', 'woocommerce_template_single_title', 10);
add_action( 'wcqv_product_data', 'woocommerce_template_single_meta', 20 );
add_action( 'wcqv_product_data', 'woocommerce_template_single_rating', 30 );
add_action( 'wcqv_product_data', 'woocommerce_template_single_price', 40);
add_action( 'wcqv_product_data', 'woocommerce_template_single_excerpt', 50);
add_action( 'wcqv_product_data', 'woocommerce_template_single_add_to_cart', 60);

add_action('wcqv_product_data', 'tarte_quick_view_show_product_link', 65);
function tarte_quick_view_show_product_link() {
  global $product;
  $link = get_permalink($product->get_id());
  $title = __('Смотреть подробную информацию');
  echo "<a class='product-page-link' href='$link'>$title</a>";
}



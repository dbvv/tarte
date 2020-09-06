<?php

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

add_action('template_redirect', 'glossier_remove_qty');
function glossier_remove_qty() {
  remove_action( 'woocommerce_after_shop_loop_item', 'qib_quantity_field_archive', 11 );						
  remove_action( 'woocommerce_after_shop_loop_item', 'qib_quantity_field_archive', 9 );						
  remove_action( 'woocommerce_after_shop_loop_item', 'qib_quantity_field_archive' );						
}

add_action('woocommerce_after_shop_loop_item_title', 'glossier_add_hr_after_title', 3);
function glossier_add_hr_after_title() {
  echo '<hr/>';
}

add_action('woocommerce_before_main_content', 'glossier_product_category_promo');
function glossier_product_category_promo() {
  if (is_product_category()) {
    $queried = get_queried_object();
    $promo = carbon_get_term_meta($queried->term_id, 'product_cat_promo_image');
    $promo_text = carbon_get_term_meta($queried->term_id, 'promo_text');
    if ($promo) {
      echo '<div class="container text-center"><img class="product-cat-promo" src="' . wp_get_attachment_image_url($promo, 'full') . '"/>' . $promo_text . '</div>';
    }
  }
}

add_action('woocommerce_before_shop_loop_item_title', 'glossier_shop_loop_image_container', 5);
function glossier_shop_loop_image_container() {
  echo '<div class="product-image-container">';
}

add_action('woocommerce_before_shop_loop_item_title', 'glossier_shop_loop_image_container_end', 15);
function glossier_shop_loop_image_container_end() {
  echo '</div>';
}


//add_filter( 'woocommerce_currency_symbol', 'my_custom_currency_symbol', 90, 2 );
function my_custom_currency_symbol( $symbol, $currency ) {
  if ($currency === 'RUB') {
    $symbol = 'руб.';
  }
  return $symbol;
}

add_action('woocommerce_before_main_content', 'tarte_main_content', 5);
function tarte_main_content() {
  if (is_product_category()) {
    $category = get_queried_object();
    $archive_title = carbon_get_term_meta($category->term_id, 'archive_title');
    $archive_pattern = carbon_get_term_meta($category->term_id, 'archive_pattern');
    if ($archive_title) {
      $html = '<div class="archive-muster-title">' . $archive_title . '</div>';
      echo $html;
    }
  }
}

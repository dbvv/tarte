<div class="frontpage-carousel-products container">
    <a class="frontpage-carousel-products__title" href="<?php echo carbon_get_theme_option('front_page_exclusive_title_link'); ?>"><?php echo carbon_get_theme_option('front_page_exclusive_title'); ?></a>
<?php
woocommerce_product_loop_start();
$products = carbon_get_theme_option('front_page_exclusive');
foreach ($products as $product_field) {
  $post_object = get_post((int)$product_field['product']);
  setup_postdata($GLOBALS['post'] =& $post_object);
  echo wc_get_template_part('content', 'product');
  unset($GLOBALS['product']);
}
wp_reset_postdata();
woocommerce_product_loop_end();
?>
</div>

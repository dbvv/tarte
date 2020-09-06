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





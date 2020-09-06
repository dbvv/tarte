<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    $container = Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_tab(__('Main'), array(
            Field::make( 'text', 'header_notice', __('Notice in header') ),
        ))
        ->add_tab(__('Footer'), [
          Field::make('rich_text', 'footer_notice', __('Footer notice')),
          Field::make('rich_text', 'footer_text', __('Footer text')),
          Field::make("text", 'copyright_text', __('Copyright text')),
          Field::make('select', 'privacy_policy_page', 'Privacy policy')->add_options('glossier_get_pages'),
          Field::make('rich_text', 'about_info', __('About info')),
        ])
        ->add_tab(__('Socials'), [
          Field::make('text', 'social_facebook', __('Facebook')),
          Field::make('text', 'social_pinterest', __('Pinterest')),
          Field::make('text', 'social_instagram', __('Instagram')),
          Field::make('text', 'social_vk', __('Vk')),
        ])
        ;

    $term_meta = Container::make('term_meta', __('Product category properties'))
      ->where('term_taxonomy', 'product_cat')
      ->add_fields([
        Field::make('text', 'archive_title', __('Archive title')),
        Field::make('image', 'archive_pattern', __('Archve pattern')),
        //Field::make('rich_text', 'promo_text', __('Promo text')),
        //Field::make('image', 'product_cat_promo_image', 'Product category promo image'),
        Field::make('text', 'short_title', __('Short title')),
        Field::make('text', 'min_price', __('Min price')),
      ]);

    $product = Container::make('post_meta', __('Product specific settings'))
        ->where('post_type', 'product')
        ->add_tab(__('Media'), [
          Field::make('image', 'product_hover_image', __('Product hover image')),
        ])
        ->add_tab(__('Tabs'), [
          Field::make('rich_text', 'product_info', __('Product info')),
          Field::make('rich_text', 'product_refund_return_policy', __('Return and refund policy')),
          Field::make('rich_text', 'product_shipping_info', __('Shipping info')),

          //Field::make('rich_text', 'product_hover', __('Нанесение')),
          //Field::make('rich_text', 'product_volume', __("Объем")),
          //Field::make('rich_text', 'product_consist', __('Состав')),
          //Field::make('rich_text', 'product_features', __('Особенности')),
          //Field::make('rich_text', 'product_clinic', __('Клинические испытания')),
        ]);
    $front_page = Container::make('theme_options', __('Front page'))
      ->set_page_parent($container)
      ->add_fields([
        Field::make('text', 'front_page_first_screen_link', __('Front page first screen link')),
        Field::make('text', 'front_page_first_screen_header', __('First screen header'))->set_default_value('Встречайте Бестселлер!'),
        Field::make('text', 'front_page_first_screen_text', __('First screen text'))->set_default_value('Поколение G - это новый вид помады, которая создаёт эффект натуральных матовых губ без пятен.'),
        Field::make('image', 'front_page_first_screen_mobile_image', __('First screen mobile image'))
        ->set_value_type('url'),
        Field::make('complex', 'front_page_categories', __('front page categories'))
        ->add_fields([
          Field::make('select', 'category', __('Category'))
            ->set_options('glossier_product_cat_select'),
            ]),
        Field::make('select', 'sale_page_link', __('Sales page'))
            ->set_options('glossier_pages_select'),
        Field::make('select', 'image_product_link', __('Image product link'))->set_options('glossier_product_select'),
        Field::make("rich_text", 'image_product_content', __('Image product content')),
        Field::make('image', 'image_product_left', __('Product image left'))->set_value_type('url'),
        Field::make('image', 'image_product_right', __('Product image right'))->set_value_type('url'),
      ]);
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( get_stylesheet_directory() .  '/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

function glossier_get_pages() {
  $pages = [];
  $query = get_pages();
  foreach ($query as $q) {
    $pages[$q->ID] = $q->post_title;
  }
  return $pages;
}

add_filter('mime_types', 'glossier_allowed_mime_types');
function glossier_allowed_mime_types($mimes) {
  $mimes['webp'] = 'image/webp';
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

function glossier_product_cat_select() {
  $arr = [];
  $query = get_categories([
    'taxonomy' => 'product_cat',
  ]);
  foreach ($query as $cat) {
    $arr[$cat->term_id] = $cat->name;
  }
  return $arr;
}

function glossier_pages_select() {
  $arr = [];
  $pages = get_pages();
  foreach ($pages as $page) {
    $arr[$page->ID] = $page->post_title;
  }
  return $arr;
}

function glossier_product_select() {
  $arr = [];
  $products = get_posts(['post_type' => 'product', 'posts_per_page' => -1]);
  foreach ($products as $product) {
    $arr[$product->ID] = $product->post_title;
  }
  return $arr;
}

add_filter('term_link', 'glossier_term_link', 90, 3);
function glossier_term_link($termlink, $term, $taxonomy) {
  return str_replace('./', '', $termlink);
}
add_filter('request', function( $vars ) {
    global $wpdb;
    if( ! empty( $vars['pagename'] ) || ! empty( $vars['category_name'] ) || ! empty( $vars['name'] ) || ! empty( $vars['attachment'] )  || !empty($vars['error'])) {
        $slug = ! empty( $vars['pagename'] ) ? $vars['pagename'] : ( ! empty( $vars['name'] ) ? $vars['name'] : ( !empty( $vars['category_name'] ) ? $vars['category_name'] : $vars['attachment'] ) );
        if (isset($vars['error']) && $vars['error'] == "404") {
          $arr = explode('/', trim($_SERVER['REQUEST_URI']));
          if ($arr[count($arr) - 1] == '') {
            unset($arr[count($arr) - 1]);
          }
          $slug = $arr[count($arr) - 1];
        }
        $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s" ,array( $slug )));
        if( $exists ){
            $old_vars = $vars;
            $vars = array('product_cat' => $slug );
            if ( !empty( $old_vars['paged'] ) || !empty( $old_vars['page'] ) )
                $vars['paged'] = ! empty( $old_vars['paged'] ) ? $old_vars['paged'] : $old_vars['page'];
            if ( !empty( $old_vars['orderby'] ) )
                    $vars['orderby'] = $old_vars['orderby'];
                if ( !empty( $old_vars['order'] ) )
                    $vars['order'] = $old_vars['order'];    
        }
    }
    return $vars;
});



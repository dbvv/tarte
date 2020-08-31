<?php

$categories = carbon_get_theme_option('front_page_categories');
$sale_page = carbon_get_theme_option('sale_page_link');
$sale_page_link = get_permalink($sale_page);

if (count($categories) > 0) {
  echo '<div class="categories-block container">';
  echo '<div class="row">';

  echo '<div class="col-md-8">';
  foreach ($categories as $cat_id) {
    $category = get_term($cat_id['category']);
    $short_title = carbon_get_term_meta($cat_id['category'], 'short_title');
    $min_price = carbon_get_term_meta($cat_id['category'], 'min_price');
    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
    $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
?>
    <div class="category category-<?php echo $cat_id['category']; ?>">
        <div class="category-content">
            <div class="category-title"><?php echo $category->name; ?></div>
            <p class="category-short-title"><?php echo $short_title; ?></p>
            <p class="category-price"><?php echo $min_price; ?></p>
            <a class="btn btn-primary btn-lg" href="<?php echo get_term_link($category->term_id); ?>"><?php echo __('В каталог') ?></a>
        </div>
        <div class="category-image"><img src="<?php echo $thumbnail_url; ?>" alt=""></div>
    </div>
<?php 
  }
  echo '</div> <!-- end .col-md-8 -->';
?>
  <a href="<?php echo $sale_page_link; ?>" class="on-sale col-md-4">
        <div class="onsale-content">
            <p>Скидки</p>
            <p>-30%</p>
        </div>
    </a>
<?php
  echo '</div> <!-- end .row -->';
  echo '</div> <!-- end .categories-block-->';
}


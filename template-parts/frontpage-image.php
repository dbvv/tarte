<?php

$product_link = carbon_get_theme_option('image_product_link');
$product_text = carbon_get_theme_option('image_product_content');
$product_image_left = carbon_get_theme_option('image_product_right');
$product_image_right = carbon_get_theme_option('image_product_left');


?>

<div class="frontpage-image">
  <div class="">
    <div class="row justify-content-between front-page-row" style="align-items: stretch; align-content: stretch;">
      <div class="col-sm-12 col-md-3 product-image-left" >
      <img src="<?php echo $product_image_left; ?>" alt="" >
      </div>
      <div class="col-sm-12 col-md-4 text-center image-content">
        <?php echo $product_text; ?>
        <br>
        <a href="<?php echo $product_link; ?>" style="width: 300px;" class="btn btn-primary btn-lg">Купить сейчас</a>
      </div>
      <div class="product-image-right col-sm-12 col-md-3">
        <img  src="<?php echo $product_image_right; ?>" alt=""></div>
    </div>
  </div>
</div>

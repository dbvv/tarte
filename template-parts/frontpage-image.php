<?php

$product_link = carbon_get_theme_option('image_product_link');
$product_text = carbon_get_theme_option('image_product_content');
$product_image_left = carbon_get_theme_option('image_product_left');
$product_image_left_mobile = carbon_get_theme_option('image_product_left_mobile');
$product_image_right = carbon_get_theme_option('image_product_right');
$product_image_right_mobile = carbon_get_theme_option('image_product_right_mobile');
?>

<div class="frontpage-image">
    <div class="row justify-content-between front-page-row" style="align-items: stretch; align-content: stretch;">
      <div class="d-none d-sm-flex col-sm-12 col-md-4 product-image-left" >
        <img src="<?php echo $product_image_left; ?>" alt="" >
      </div>
       <div class="col-12 d-sm-none" >
        <img src="<?php echo $product_image_left_mobile; ?>" alt="" >
      </div>

      <div class="col-sm-12 col-md-4 text-center image-content">
        <?php echo $product_text; ?>
        <br>
      </div>

      <!-- Right image -->
      <div class="d-none d-sm-flex product-image-right col-sm-12 col-md-4">
        <img src="<?php echo $product_image_right; ?>" alt="">
      </div>
      <div class="col-12 d-sm-none">
        <img src="<?php echo $product_image_right_mobile; ?>" alt="">
      </div>

    </div>
</div>

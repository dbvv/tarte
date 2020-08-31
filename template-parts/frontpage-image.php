<?php

$product_link = carbon_get_theme_option('image_product_link');
$product_text = carbon_get_theme_option('image_product_content');
$product_image_left = carbon_get_theme_option('image_product_right');
$product_image_right = carbon_get_theme_option('image_product_left');


?>

<div class="frontpage-image">
    <svg preserveAspectRatio="xMidYMid meet" id="sun" data-bbox="24 20 152 160" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="24 20 152 160" data-type="color" role="img">
        <g>
            <path d="M142.383 100c0 23.436-18.976 42.434-42.383 42.434-23.407 0-42.383-18.998-42.383-42.434 0-23.436 18.976-42.434 42.383-42.434 23.407 0 42.383 18.998 42.383 42.434z" fill="#FDCE09" data-color="1"></path>
            <path fill="#FDCE09" d="M80.658 52.615L53.031 35.279l7.936 31.675a51.174 51.174 0 0119.691-14.339z" data-color="1"></path>
            <path fill="#FDCE09" d="M150.955 103.764a50.817 50.817 0 01-7.519 23.171l-.004.023L176 124.724l-25.04-20.974-.005.014z" data-color="1"></path>
            <path fill="#FDCE09" d="M100 48.798c4.197 0 8.263.563 12.168 1.521h.013L100 20 87.818 50.319h.013c3.906-.958 7.972-1.521 12.169-1.521z" data-color="1"></path>
            <path fill="#FDCE09" d="M143.432 73.045l.004.016a50.82 50.82 0 017.514 23.171l.018.02L176 75.276l-32.568-2.231z" data-color="1"></path>
            <path fill="#FDCE09" d="M139.038 66.956l7.932-31.679-27.628 17.337a51.285 51.285 0 0119.696 14.342z" data-color="1"></path>
            <path fill="#FDCE09" d="M49.045 96.238a50.873 50.873 0 017.519-23.175l.004-.018L24 75.281 49.04 96.25l.005-.012z" data-color="1"></path>
            <path fill="#FDCE09" d="M100 151.209c-4.205 0-8.272-.565-12.178-1.521h-.013L100 180l12.182-30.321c-3.91.965-7.976 1.53-12.182 1.53z" data-color="1"></path>
            <path fill="#FDCE09" d="M119.342 147.385l27.628 17.335-7.936-31.673a51.23 51.23 0 01-19.692 14.338z" data-color="1"></path>
            <path fill="#FDCE09" d="M56.564 126.943a50.84 50.84 0 01-7.515-23.171l-.018-.023L24 124.726l32.568 2.227-.004-.01z" data-color="1"></path>
            <path fill="#FDCE09" d="M60.962 133.048l-7.932 31.673 27.623-17.335a51.34 51.34 0 01-19.691-14.338z" data-color="1"></path>
        </g>
      </svg>
  <div class="container-fluid">
    <div class="row justify-content-center" style="align-items: stretch; align-content: stretch;">
      <div class="col-sm-12 col-md-4 product-image-left" style="background: #e6e9ea; height: auto;">
      <img src="<?php echo $product_image_left; ?>" alt="" style="transform: scale(1.1); margin-top: 50px;">
      </div>
      <div class="col-sm-12 col-md-4 text-center image-content">
        <?php echo $product_text; ?>
        <br>
        <a href="<?php echo $product_link; ?>" style="width: 300px;" class="btn btn-primary btn-lg">Купить сейчас</a>
      </div>
      <div style=" background: #E6E9EA; height: auto;" class="product-image-right col-sm-12 col-md-4">
        <img style="margin-top: -170px; transform: scale(1.2);" src="<?php echo $product_image_right; ?>" alt=""></div>
    </div>
  </div>
</div>

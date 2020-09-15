<div class="jumbotron">
  <div class="container-fluid">
    <div class="row">
      <div class="col-4 col-sm-5 jumbotron-content">
        <p class="jumbotron_title"><?php echo carbon_get_theme_option('front_page_jumbotron_title'); ?></p>
        <p class="jumbotron_brand"><?php echo carbon_get_theme_option('front_page_jumbotron_brand'); ?></p>
        <a class="jumbotron_link" href="<?php echo carbon_get_theme_option('front_page_jumbotron_link'); ?>"><?php echo __('К покупкам'); ?></a>
      </div>
      <div class="col-8 col-sm-7">
        <img src="<?php echo wp_get_attachment_image_url(carbon_get_theme_option('front_page_image'), 'full'); ?>" alt="">
      </div>
    </div>
  </div>

</div>

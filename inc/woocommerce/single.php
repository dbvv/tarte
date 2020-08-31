<?php
add_filter('woocommerce_product_tabs', 'glossier_product_tabs');
function glossier_product_tabs($tabs) {
  unset($tabs['additional_information']);
  //dd($tabs);
  return $tabs;
}

// woocommerce_product_description_tab

add_action('woocommerce_after_add_to_cart_form', 'glossier_product_accordeon', 20);
function glossier_product_accordeon() {
  global $product;
  $options = [
    'hover' => __('Нанесение'),
    'volume' => __('Объем'),
    'consist' => __('Состав'),
    'features' => __('Особенности'),
    'clinic' => __('Клинические испытания'),
  ];
  $html = '<div class="accordion" id="accordionExample">';

  foreach ($options as $key => $option)  {
    $content = carbon_get_post_meta($product->get_id(), 'product_' . $key);

    if ($content) {
      $html .= '<div class="card">
        <div class="card-header" id="heading-' . $key . '">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-' . $key . '" aria-expanded="false" aria-controls="collapse-' . $key . '">' . $option . '</button>
            </h2>
        </div>
        <div id="collapse-' . $key . '" class="collapse" aria-labelledby="heading' . $key . '" data-parent="#accordionExample">
            <div class="card-body">' . $content . '</div>
        </div>
      </div>';
    }
  }

  $html .= '</div>';
  echo $html;
}

add_filter('woocommerce_dropdown_variation_attribute_options_args', 'glossier_dropdown_filter');
function glossier_dropdown_filter($options)
{
  $options['class'] = 'form-control';
  return $options;
}

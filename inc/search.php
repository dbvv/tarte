<?php

add_filter('wp_ajax_glossier_search', 'glossier_search');
add_filter('wp_ajax_nopriv_glossier_search', 'glossier_search');
function glossier_search() {
  if (!isset($_POST['search'])) {
    return;
  }
  $search = $_POST['search'];
  $args = [
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    's' => $search,
  ];
  $searchResults = new WP_Query($args);
  $GLOBALS['searchResults'] = $searchResults;
  ob_start();
  echo get_template_part('template-parts/search', 'results');
  $response = ob_get_contents();
  ob_end_clean();
  echo $response;
  exit();
}

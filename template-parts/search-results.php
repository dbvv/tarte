<?php

global $searchResults;

if ($searchResults):
  if (count($searchResults->get_posts()) > 0) {
    foreach ($searchResults->get_posts() as $post) {
      echo '<a href="' . get_permalink($post->ID) . '" class="search-result">';
      echo get_the_post_thumbnail($post->ID);
      echo $post->post_title;
      echo '</a>';
    }
  } else {
    echo '<p>' . __('Ничего не найдено') . '</p>';
  }

else:
  echo "No results";
endif;

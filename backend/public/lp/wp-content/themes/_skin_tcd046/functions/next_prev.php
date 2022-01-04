<?php

function next_prev_post_link() {

  $prev_post = get_adjacent_post(false, '', true);
  $next_post = get_adjacent_post(false, '', false);
  $url = get_bloginfo('template_url');

  if ($prev_post) {
    echo "<div class='prev_post'><a href='" . get_permalink($prev_post->ID) . "' title='" . esc_attr(get_the_title($prev_post->ID)) . "' data-mobile-title='" . esc_attr__('Prev post', 'tcd-w') . "'><span class='title'>" . esc_attr(get_the_title($prev_post->ID)) . "</span></a></div>\n";
  };

  if ($next_post) {
    echo "<div class='next_post'><a href='" . get_permalink($next_post->ID) . "' title='" . esc_attr(get_the_title($next_post->ID)) . "' data-mobile-title='" . esc_attr__('Next post', 'tcd-w') . "'><span class='title'>" . esc_attr(get_the_title($next_post->ID)) . "</span></a></div>\n";
  };

}


// add class to posts_nav_link()
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="next"';
}
function posts_link_attributes_2() {
    return 'class="prev"';
}


?>
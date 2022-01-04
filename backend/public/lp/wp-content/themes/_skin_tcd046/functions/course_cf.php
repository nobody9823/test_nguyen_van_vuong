<?php

function tcd_course_meta_box() {
  add_meta_box(
    'course_meta_box',//ID of meta box
    __('Course setting', 'tcd-w'),//label
    'show_tcd_course_meta_box',//callback function
    'course',// post type
    'normal',// context
    'high'// priority
  );
  add_meta_box(
    'course_banner_meta_box',//ID of meta box
    __('Course banner setting', 'tcd-w'),//label
    'show_tcd_course_banner_meta_box',//callback function
    'course',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'tcd_course_meta_box');

function show_tcd_course_meta_box() {
  global $post;

  echo '<input type="hidden" name="course_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  echo '<dl class="ml_custom_fields">';

  $meta_key = 'header_title';
  echo '<dt class="label"><label for="' , $meta_key , '">' , __('Header title', 'tcd-w') , '</label></dt>';
  echo '<dd class="content">';
  echo '<input type="text" name="' , $meta_key , '" id="' , $meta_key , '" value="' , esc_attr(get_post_meta($post->ID, $meta_key, true)) , '" class="widefat" />';
  echo '</dd>';

  $meta_key = 'header_subtitle';
  echo '<dt class="label"><label for="' , $meta_key , '">' , __('Header subtitle', 'tcd-w') , '</label></dt>';
  echo '<dd class="content">';
  echo '<input type="text" name="' , $meta_key , '" id="' , $meta_key , '" value="' , esc_attr(get_post_meta($post->ID, $meta_key, true)) , '" class="widefat" />';
  echo '</dd>';

  $meta_key = 'header_image';
  echo '<dt class="label"><label for="' , $meta_key , '">' , __('Header image', 'tcd-w') , '</label></dt>';
  echo '<dd class="content">';
  echo '<p class="desc">' , __('Register image for content header.<br />Recommend image size. Width:800px Height:210px', 'tcd-w') , '</p>';
  mlcf_media_form($meta_key, null);
  echo '</dd>';

  echo '</dl>'."\n";
}

function show_tcd_course_banner_meta_box() {
  global $post;

  echo '<input type="hidden" name="course_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  echo '<dl class="ml_custom_fields">';

  $meta_key = 'banner_image';
  echo '<dt class="label"><label>' , __('Banner image', 'tcd-w') , '</label></dt>';
  echo '<dd class="content"><p class="desc">' , __('Register image for archive page and front page.<br />Recommend image size. Width:380px Height:210px', 'tcd-w') , '</p>';
  mlcf_media_form($meta_key, __('Image', 'tcd-w'));
  echo '</dd>';

  $meta_key = 'banner_title';
  echo '<dt class="label"><label for="' , $meta_key , '">' , __('Banner title', 'tcd-w') , '</label></dt>';
  echo '<dd class="content"><p class="desc">' , __('Title for Banner image.', 'tcd-w') , '</p>';
  echo '<input type="text" name="' , $meta_key , '" id="' , $meta_key , '" value="' , esc_attr(get_post_meta($post->ID, $meta_key, true)) , '"  class="widefat" />';
  echo '</dd>';

  $meta_key = 'banner_subtitle';
  echo '<dt class="label"><label for="' , $meta_key , '">' , __('Banner subtitle', 'tcd-w') , '</label></dt>';
  echo '<dd class="content"><p class="desc">' , __('Subtitle for Banner image.', 'tcd-w') , '</p>';
  echo '<input type="text" name="' , $meta_key , '" id="' , $meta_key , '" value="' , esc_attr(get_post_meta($post->ID, $meta_key, true)) , '"  class="widefat" />';
  echo '</dd>';

  $meta_key = 'banner_desc';
  echo '<dt class="label"><label for="' , $meta_key , '">' , __('Banner description', 'tcd-w') , '</label></dt>';
  echo '<dd class="content"><p class="desc">' , __('Description for Banner image.', 'tcd-w') , '</p>';
  echo '<textarea name="' , $meta_key , '" id="' , $meta_key , '" class="widefat" rows="4">' , esc_textarea(get_post_meta($post->ID, $meta_key, true)) , '</textarea>';
  echo '</dd>';
}

function save_course_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['course_meta_box_nonce']) || !wp_verify_nonce($_POST['course_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'header_image', 'header_title', 'header_subtitle',
    'banner_image', 'banner_title', 'banner_subtitle', 'banner_desc'
  );
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }
}
add_action('save_post_course', 'save_course_meta_box');


<?php

function tcd_course_front_meta_box() {
  add_meta_box(
    'course_front_meta_box', // ID of meta box
    __( 'Front page display', 'tcd-w' ), // label
    'show_tcd_course_front_meta_box', // callback function
    'course', // post type
    'side'
  );
}
add_action('add_meta_boxes', 'tcd_course_front_meta_box');

function show_tcd_course_front_meta_box() {
  global $post;
  $banner_show_front_page = get_post_meta($post->ID,'banner_show_front_page', true);
?>
<input type="hidden" name="course_front_meta_box_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>">
<ul>
  <li><label><input type="checkbox" name="banner_show_front_page" value="1" <?php checked( $banner_show_front_page, '1' ); ?>><?php _e( 'Display on the front page', 'tcd-w' ); ?></label></li>
</ul>
<?php
}

function save_course_front_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['course_front_meta_box_nonce']) || !wp_verify_nonce($_POST['course_front_meta_box_nonce'], basename(__FILE__))) {
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
  $cf_keys = array('banner_show_front_page');
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
add_action('save_post_course', 'save_course_front_meta_box');


<?php


// ブログ記事 ----------------------------------------------------------
function manage_posts_columns($columns) {
  $columns['recommend_post'] = __('Recommend post', 'tcd-w');
  $columns['new_post_thumb'] = __('Featured Image', 'tcd-w');
  return $columns;
}
function add_column($column_name, $post_id) {
  switch($column_name){
    case 'new_post_thumb':
      $post_thumbnail_id = get_post_thumbnail_id($post_id);
      if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
        if (!empty($post_thumbnail_img[0])) {
          echo '<img width="70" src="' . $post_thumbnail_img[0] . '" />';
        }
      }
      break;
    case 'recommend_post':
      if(get_post_meta($post_id, 'recommend_post', true)) {  _e('Recommend post1<br />', 'tcd-w'); };
      if(get_post_meta($post_id, 'recommend_post2', true)) {  _e('Recommend post2', 'tcd-w'); };
      break;
  }
}
add_filter( 'manage_post_posts_columns', 'manage_posts_columns' );
add_action( 'manage_post_posts_custom_column', 'add_column', 10, 2 );


// お知らせ・キャンペーン・お客様の声・スタッフ -----------------------------------------------------------
function add_thumbnail_column_for_news($columns){
  $columns['new_post_thumb'] = __('Featured Image', 'tcd-w');
  return $columns;
}
function display_thumbnail_column_for_news($column_name, $post_id){
  switch($column_name){
    case 'new_post_thumb':
      $post_thumbnail_id = get_post_thumbnail_id($post_id);
      if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
        if (!empty($post_thumbnail_img[0])) {
          echo '<img width="70" src="' . $post_thumbnail_img[0] . '" />';
        }
      }
      break;
  }
}
add_filter('manage_news_posts_columns', 'add_thumbnail_column_for_news', 5);
add_action('manage_news_posts_custom_column', 'display_thumbnail_column_for_news', 5, 2);
add_filter('manage_campaign_posts_columns', 'add_thumbnail_column_for_news', 5);
add_action('manage_campaign_posts_custom_column', 'display_thumbnail_column_for_news', 5, 2);
add_filter('manage_voice_posts_columns', 'add_thumbnail_column_for_news', 5);
add_action('manage_voice_posts_custom_column', 'display_thumbnail_column_for_news', 5, 2);
add_filter('manage_staff_posts_columns', 'add_thumbnail_column_for_news', 5);
add_action('manage_staff_posts_custom_column', 'display_thumbnail_column_for_news', 5, 2);



// コース -----------------------------------------------------------
function add_thumbnail_column_for_course($columns){
  $columns['banner_image'] = __('Banner image', 'tcd-w');
  return $columns;
}
function display_thumbnail_column_for_course($column_name, $post_id){
  switch($column_name){
    case 'banner_image':
      $post_thumbnail_id =get_post_meta($post_id, 'banner_image', true);
      if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
        if (!empty($post_thumbnail_img[0])) {
          echo '<img src="' . $post_thumbnail_img[0] . '" style="max-width:100%;" />';
        }
      }
      break;
  }
}
add_filter('manage_course_posts_columns', 'add_thumbnail_column_for_course', 5);
add_action('manage_course_posts_custom_column', 'display_thumbnail_column_for_course', 5, 2);


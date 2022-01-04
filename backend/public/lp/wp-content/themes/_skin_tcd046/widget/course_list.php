<?php

// Start class widget //
class tcdw_course_list_widget extends WP_Widget {

 // Constructor //
 function __construct() {
   parent::__construct(
     'tcdw_course_list_widget',// ID
     __( 'Course list (tcd ver)', 'tcd-w' ),
     array(
       'classname' => 'tcdw_course_list_widget',
       'description' => __('Displays course list.', 'tcd-w')
     )
   );
 }

 // Widget output //
 function widget($args, $instance) {
  // Extract Args //
  extract( $args );

  $title = apply_filters('widget_title', $instance['title']); // the widget title

  $get_posts_args = array(
    'posts_per_page'   => -1,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'course'
  );

  if (!empty($instance['course_category'])) {
    $get_posts_args['tax_query'] = array(
      array(
        'taxonomy' => 'course_category',
        'field'    => 'id',
        'terms'    => $instance['course_category'],
      )
    );
  }

  $course_posts = get_posts($get_posts_args);
  if (empty($course_posts)) return;

  // Before widget //
  echo $before_widget;

  // Title of widget //
  if ( $title ) { echo $before_title . $title . $after_title; }

  // Widget output //
  echo "\n".'<ul class="course_list">'."\n";
  foreach($course_posts as $course_post) {

    $banner_image = null;
    $banner_image_id = get_post_meta($course_post->ID, 'banner_image', true);
    if (!$banner_image_id) {
      $banner_image_id = get_post_meta($course_post->ID, 'header_image', true);
    }
    if (!$banner_image_id) {
      $banner_image_id = get_post_thumbnail_id($course_post->ID);
    }
    if ($banner_image_id) {
      $banner_image = wp_get_attachment_image_src($banner_image_id, 'size3');
    }
    if (!empty($banner_image[0])) {
      $banner_image_src = $banner_image[0];
    } else {
      $banner_image_src = get_template_directory_uri().'/img/common/no_image3.gif';
    }

    $banner_title = get_post_meta($course_post->ID, 'banner_title', true);
    if (!$banner_title) {
      $banner_title = $course_post->post_title;
    }

    echo '<li>';
    echo '<a class="image" href="'.get_permalink($course_post).'" title="'.esc_attr($banner_title).'">';
    echo '<img src="'.esc_attr($banner_image_src).'" alt="" />';
    echo '<div class="caption"><span class="caption_hover_slide">'.esc_html($banner_title).'</span></div>';
    echo '</a>';
    echo '</li>'."\n";
  }

  echo '</ul>'."\n";

  // After widget //
  echo $after_widget;

 } // end function widget

 // Update Settings //
 function update($new_instance, $old_instance) {
  $instance = $old_instance;
  $instance['title'] = strip_tags($new_instance['title']);
  $instance['course_category'] = $new_instance['course_category'];
  return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
  $defaults = array( 'title' => '', 'course_category' => '');
  $instance = wp_parse_args( (array) $instance, $defaults );
?>
<p>
 <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tcd-w'); ?></label>
 <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
</p>
<p>
 <label for="<?php echo $this->get_field_id('course_category'); ?>"><?php _e('Course Category:', 'tcd-w'); ?></label>
 <?php
    wp_dropdown_categories(array(
      'show_option_all'    => __('ALL', 'tcd-w'),
      'orderby'            => 'ID', 
      'order'              => 'ASC',
      'hide_empty'         => false, 
      'echo'               => 1,
      'selected'           => $instance['course_category'],
      'hierarchical'       => 1, 
      'name'               => $this->get_field_name('course_category'),
      'id'                 => $this->get_field_id('course_category'),
      'taxonomy'           => 'course_category',
      'class'              => 'widefat'
    ));
 ?>
</p>
<?php
 } // end function form
}

// End class widget
add_action('widgets_init', function(){register_widget('tcdw_course_list_widget');});
?>

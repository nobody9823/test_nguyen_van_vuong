<?php

// Start class widget //
class tcdw_staff_list_widget extends WP_Widget {

 // Constructor //
 function __construct() {
   parent::__construct(
     'tcdw_staff_list_widget',// ID
     __( 'Staff list (tcd ver)', 'tcd-w' ),
     array(
       'classname' => 'tcdw_staff_list_widget',
       'description' => __('Displays staff list.', 'tcd-w')
     )
   );
 }

 // Widget output //
 function widget($args, $instance) {
  // Extract Args //
  extract( $args );

  $title = apply_filters('widget_title', $instance['title']); // the widget title
  $post_num = $instance['post_num'];

  $args = array(
    'posts_per_page'   => $post_num,
    'post_type'        => 'staff'
  );

  $staff_posts = new WP_Query($args);

  // Before widget //
  echo $before_widget;
?>
<?php
  // Title of widget //
  if ( $title ) { echo $before_title . $title; ?>
  <?php if (!empty($instance['show_archive'])) { ?>
  <a class="archive_link" href="<?php echo get_post_type_archive_link('staff'); ?>"><?php _e('Archive page', 'tcd-w'); ?></a>
  <?php }; ?>
<?php echo $after_title; }; ?>

<?php
  // Widget output //
  echo "\n".'<ol class="staff_list">'."\n";

  if($staff_posts->have_posts()){
    while ($staff_posts->have_posts()) :
      $staff_posts->the_post();
      $staff_name = trim(get_post_meta($staff_posts->post->ID, 'staff_name', true));
      if (!$staff_name) $staff_name = get_the_title();
      $headline = get_post_meta($staff_posts->post->ID, 'headline', true);
      $headline = str_replace(array("\r\n", "\r", "\n"), '', esc_html($headline));
      $headline = mb_substr($headline, 0, 23 ,"utf-8");
      if(mb_strlen($headline,"utf-8") > 22) {
        $headline = $headline . '...';
      } else {
      };
?>
      <li>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php if (!empty($instance['show_thumbnail'])) { ?>
        <div class="image">
        <?php if(has_post_thumbnail()){the_post_thumbnail('size6');}else{echo '<img src="' . get_template_directory_uri() . '/img/common/no_image1.gif" alt="" />';} ?>
        </div>
        <?php }; ?>
        <?php if (!empty($instance['show_name'])) { ?>
        <h4 class="staff_name"><?php echo esc_html($staff_name); ?></h4>
        <?php }; ?>
        <?php if (!empty($instance['show_headline'])) { ?>
        <p class="staff_title"><?php echo $headline; ?></p>
        <?php }; ?>
      </a>
      </li>
   <?php endwhile;
    wp_reset_query();
  } else {
    echo '<li class="no_post">'._e('There is no registered post.', 'tcd-w').'</li>';
  }

  echo '</ol>'."\n";

  // After widget //
  echo $after_widget;

 } // end function widget

 // Update Settings //
 function update($new_instance, $old_instance) {
  $instance['title'] = strip_tags($new_instance['title']);
  $instance['post_num'] = $new_instance['post_num'];
  $instance['show_name'] = $new_instance['show_name'];
  $instance['show_headline'] = $new_instance['show_headline'];
  $instance['show_thumbnail'] = $new_instance['show_thumbnail'];
  $instance['show_archive'] = $new_instance['show_archive'];
  return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
  $defaults = array(
    'title' => '',
    'post_num' => '6',
    'show_date' => '1',
    'show_name' => '1',
    'show_headline' => '1',
    'show_thumbnail' => '1',
    'show_archive' => '1'
    );
  $instance = wp_parse_args( (array) $instance, $defaults );
?>
<p>
 <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tcd-w'); ?></label>
 <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_num'); ?>"><?php _e('Number of post:', 'tcd-w'); ?></label>
  <select id="<?php echo $this->get_field_id('post_num'); ?>" name="<?php echo $this->get_field_name('post_num'); ?>" class="widefat">
    <option value="-1" <?php selected('-1', $instance['post_num']); ?>><?php _e('All', 'tcd-w'); ?></option>
    <option value="2" <?php selected('2', $instance['post_num']); ?>>2</option>
    <option value="4" <?php selected('4', $instance['post_num']); ?>>4</option>
    <option value="6" <?php selected('6', $instance['post_num']); ?>>6</option>
    <option value="8" <?php selected('8', $instance['post_num']); ?>>8</option>
    <option value="10" <?php selected('10', $instance['post_num']); ?>>10</option>
  </select>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_name'); ?>" name="<?php echo $this->get_field_name('show_name'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_name']); ?> />
  <label for="<?php echo $this->get_field_id('show_name'); ?>"><?php _e('Display staff name', 'tcd-w'); ?></label>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_headline'); ?>" name="<?php echo $this->get_field_name('show_headline'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_headline']); ?> />
  <label for="<?php echo $this->get_field_id('show_headline'); ?>"><?php _e('Display staff introduction title', 'tcd-w'); ?></label>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_thumbnail']); ?> />
  <label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Display staff thumnail', 'tcd-w'); ?></label>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_archive'); ?>" name="<?php echo $this->get_field_name('show_archive'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_archive']); ?> />
  <label for="<?php echo $this->get_field_id('show_archive'); ?>"><?php _e('Display archive link', 'tcd-w'); ?></label>
</p>
<?php
 } // end function form
}

// End class widget
add_action('widgets_init', function(){register_widget('tcdw_staff_list_widget');});
?>

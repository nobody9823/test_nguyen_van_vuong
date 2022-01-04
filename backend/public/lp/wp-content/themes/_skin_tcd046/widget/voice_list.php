<?php

// Start class widget //
class tcdw_voice_list_widget extends WP_Widget {

 // Constructor //
 function __construct() {
   parent::__construct(
     'tcdw_voice_list_widget',// ID
     __( 'Voice list (tcd ver)', 'tcd-w' ),
     array(
       'classname' => 'tcdw_voice_list_widget',
       'description' => __('Displays voice list.', 'tcd-w')
     )
   );
 }

 // Widget output //
 function widget($args, $instance) {
  // Extract Args //
  extract( $args );

  $title = apply_filters('widget_title', $instance['title']); // the widget title
  $post_num = $instance['post_num'];
  $post_order = $instance['post_order'];
  if ($post_order=='date2') {
    $order = 'ASC';
  } else {
    $order = 'DESC';
  }
  if ($post_order=='date1' || $post_order=='date2') {
    $post_order = 'date';
  }

  $args = array(
    'posts_per_page'   => $post_num,
    'orderby'          => $post_order,
    'order'            => $order,
    'post_type'        => 'voice'
  );

  $voice_posts = new WP_Query($args);

  // Before widget //
  echo $before_widget;
?>
<?php
  // Title of widget //
  if ( $title ) { echo $before_title . $title; ?>
  <?php if (!empty($instance['show_archive'])) { ?>
  <a class="archive_link" href="<?php echo get_post_type_archive_link('voice'); ?>"><?php _e('Archive page', 'tcd-w'); ?></a>
  <?php }; ?>
<?php echo $after_title; }; ?>

<?php
  // Widget output //
  echo "\n".'<ol class="voice_list">'."\n";

  if($voice_posts->have_posts()){
    while ($voice_posts->have_posts()) :
      $voice_posts->the_post();
      $voice_user = get_post_meta($voice_posts->post->ID, 'voice_user', true);
      $voice_user_info = get_post_meta($voice_posts->post->ID, 'voice_user_info', true);
      $desc = get_post_meta($voice_posts->post->ID, 'desc', true);
      $desc = str_replace(array("\r\n", "\r", "\n"), '', esc_html($desc));
      $desc = mb_substr($desc, 0, 23 ,"utf-8");
      if(mb_strlen($desc,"utf-8") > 22) {
        $desc = $desc . '...';
      } else {
      };
?>
      <li class="clearfix">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php if (!empty($instance['show_thumbnail'])) { ?>
        <div class="image">
        <?php if(has_post_thumbnail()){the_post_thumbnail('size6');}else{echo '<img src="' . get_template_directory_uri() . '/img/common/no_image1.gif" alt="" />';} ?>
        </div>
        <?php }; ?>
        <div class="voice_info">
        <?php
          if (!empty($instance['show_name']) && !empty($instance['show_age'])) {
            echo '<h4 class="voice_name">'.esc_html($voice_user).'<span>('.esc_html($voice_user_info).')</span></h4>'."\n";
          } elseif (!empty($instance['show_name'])) {
            echo '<h4 class="voice_name">'.esc_html($voice_user).'</h4>'."\n";
          } elseif (!empty($instance['show_age'])) {
            echo '<h4 class="voice_name">'.esc_html($voice_user_info).'</h4>'."\n";
          }
        ?>
        <?php if (!empty($instance['show_desc'])) { ?>
        <p class="voice_desc"><?php echo $desc; ?></p>
        <?php }; ?>
        </div>
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
  $instance['post_num'] = $new_instance['post_num'];
  $instance['post_order'] = $new_instance['post_order'];
  $instance['show_name'] = $new_instance['show_name'];
  $instance['show_age'] = $new_instance['show_age'];
  $instance['show_desc'] = $new_instance['show_desc'];
  $instance['show_thumbnail'] = $new_instance['show_thumbnail'];
  $instance['show_archive'] = $new_instance['show_archive'];
  return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
  $defaults = array(
    'title' => '',
    'post_num' => '5',
    'post_order' => 'date1',
    'show_name' => '1',
    'show_age' => '1',
    'show_desc' => '1',
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
    <option value="1" <?php selected('1', $instance['post_num']); ?>>1</option>
    <option value="2" <?php selected('2', $instance['post_num']); ?>>2</option>
    <option value="3" <?php selected('3', $instance['post_num']); ?>>3</option>
    <option value="4" <?php selected('4', $instance['post_num']); ?>>4</option>
    <option value="5" <?php selected('5', $instance['post_num']); ?>>5</option>
    <option value="6" <?php selected('6', $instance['post_num']); ?>>6</option>
    <option value="7" <?php selected('7', $instance['post_num']); ?>>7</option>
    <option value="8" <?php selected('8', $instance['post_num']); ?>>8</option>
    <option value="9" <?php selected('9', $instance['post_num']); ?>>9</option>
    <option value="10" <?php selected('10', $instance['post_num']); ?>>10</option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_order'); ?>"><?php _e('Post order:', 'tcd-w'); ?></label>
  <select id="<?php echo $this->get_field_id('post_order'); ?>" name="<?php echo $this->get_field_name('post_order'); ?>" class="widefat">
    <option value="date1" <?php selected('date1', $instance['post_order']); ?>><?php _e('Date (DESC)', 'tcd-w'); ?></option>
    <option value="date2" <?php selected('date2', $instance['post_order']); ?>><?php _e('Date (ASC)', 'tcd-w'); ?></option>
    <option value="rand" <?php selected('rand', $instance['post_order']); ?>><?php _e('Random', 'tcd-w'); ?></option>
  </select>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_name'); ?>" name="<?php echo $this->get_field_name('show_name'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_name']); ?> />
  <label for="<?php echo $this->get_field_id('show_name'); ?>"><?php _e('Display customer name', 'tcd-w'); ?></label>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_age'); ?>" name="<?php echo $this->get_field_name('show_age'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_age']); ?> />
  <label for="<?php echo $this->get_field_id('show_age'); ?>"><?php _e('Display customer age', 'tcd-w'); ?></label>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_desc'); ?>" name="<?php echo $this->get_field_name('show_desc'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_desc']); ?> />
  <label for="<?php echo $this->get_field_id('show_desc'); ?>"><?php _e('Display customer voice', 'tcd-w'); ?></label>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_thumbnail']); ?> />
  <label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Display voice thumnail', 'tcd-w'); ?></label>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_archive'); ?>" name="<?php echo $this->get_field_name('show_archive'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_archive']); ?> />
  <label for="<?php echo $this->get_field_id('show_archive'); ?>"><?php _e('Display archive link', 'tcd-w'); ?></label>
</p>
<?php
 } // end function form
}

// End class widget
add_action('widgets_init', function(){register_widget('tcdw_voice_list_widget');});
?>

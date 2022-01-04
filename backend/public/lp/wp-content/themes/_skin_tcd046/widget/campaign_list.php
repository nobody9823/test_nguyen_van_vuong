<?php

// Start class widget //
class tcdw_campaign_list_widget extends WP_Widget {

 // Constructor //
 function __construct() {
   parent::__construct(
     'tcdw_campaign_list_widget',// ID
     __( 'Campaign list (tcd ver)', 'tcd-w' ),
     array(
       'classname' => 'tcdw_campaign_list_widget',
       'description' => __('Displays campaign list.', 'tcd-w')
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
    'post_type'        => 'campaign'
  );

  $campaign_posts = new WP_Query($args);

  // Before widget //
  echo $before_widget;
?>
<?php
  // Title of widget //
  if ( $title ) { echo $before_title . $title; ?>
  <?php if (!empty($instance['show_archive'])) { ?>
  <a class="archive_link" href="<?php echo get_post_type_archive_link('campaign'); ?>"><?php _e('Archive page', 'tcd-w'); ?></a>
  <?php }; ?>
<?php echo $after_title; }; ?>

<?php
  // Widget output //
  echo "\n".'<ol class="campaign_list">'."\n";

  if($campaign_posts->have_posts()){
    while ($campaign_posts->have_posts()) :
      $campaign_posts->the_post();
?>
      <li>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="image">
        <?php if(has_post_thumbnail()){the_post_thumbnail('size4');}else{echo '<img src="' . get_template_directory_uri() . '/img/common/no_image4.gif" alt="" />';} ?>
        </div>
        <?php if (!empty($instance['show_date'])) { ?>
        <p class="date"><?php the_time('Y.m.d'); ?></p>
        <?php }; ?>
        <h4 class="title"><?php if ( is_mobile() ) { trim_title(20); } else { trim_title(28); }; ?></h4>
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
  $instance['post_order'] = $new_instance['post_order'];
  $instance['show_date'] = $new_instance['show_date'];
  $instance['show_archive'] = $new_instance['show_archive'];
  return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
  $defaults = array(
    'title' => '',
    'post_num' => '6',
    'post_order' => 'date1',
    'show_date' => '1',
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
    <option value="2" <?php selected('2', $instance['post_num']); ?>>2</option>
    <option value="4" <?php selected('4', $instance['post_num']); ?>>4</option>
    <option value="6" <?php selected('6', $instance['post_num']); ?>>6</option>
    <option value="8" <?php selected('8', $instance['post_num']); ?>>8</option>
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
  <input id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_date']); ?> />
  <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Display date', 'tcd-w'); ?></label>
</p>
<p>
  <input id="<?php echo $this->get_field_id('show_archive'); ?>" name="<?php echo $this->get_field_name('show_archive'); ?>" type="checkbox" value="1" <?php checked('1', $instance['show_archive']); ?> />
  <label for="<?php echo $this->get_field_id('show_archive'); ?>"><?php _e('Display archive link', 'tcd-w'); ?></label>
</p>
<?php
 } // end function form
}

// End class widget
add_action('widgets_init', function(){register_widget('tcdw_campaign_list_widget');});
?>

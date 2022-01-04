<?php


 // Start class widget //
 class tcdw_category_list_widget extends WP_Widget {

 // Constructor //
 function __construct() {
   parent::__construct(
     'tcdw_category_list_widget',// ID
     __( 'Category list (tcd ver)', 'tcd-w' ),
     array(
       'classname' => 'tcdw_category_list_widget',
       'description' => __('Displays designed category list.', 'tcd-w')
     )
   );
 }

 // Extract Args //
 function widget($args, $instance) {
  extract( $args );
   $title = apply_filters('widget_title', $instance['title']); // the widget title
   $exclude_cat_num = $instance['exclude_cat_num']; // category id to exclude
   $count = ! empty( $instance['count'] ) ? 1 : 0;

   // Before widget //
   echo $before_widget;

   // Title of widget //
   if ( $title ) { echo $before_title . $title . $after_title; }

   // Widget output //

$args = array(
  'exclude'   => $exclude_cat_num,
  'show_count' => $count,
  'title_li'     => '',
  'hierarchical' => 1,
  'echo' => 0
);

?>
<ul class="collapse_category_list">
 <?php
      $categories = wp_list_categories($args);
      if ($count) {
        $categories = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="count">\\1</span></a>', $categories);
      }
      echo $categories;
 ?>
</ul>
<?php

   // After widget //
   echo $after_widget;

} // end function widget


 // Update Settings //
 function update($new_instance, $old_instance) {
  $instance = $old_instance;
  $instance['title'] = strip_tags($new_instance['title']);
  $instance['exclude_cat_num'] = $new_instance['exclude_cat_num'];
  $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
  return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
  $defaults = array( 'title' => __('Category list', 'tcd-w'), 'exclude_cat_num' => '', 'count' => '');
  $instance = wp_parse_args( (array) $instance, $defaults );
  $count = isset($instance['count']) ? (bool) $instance['count'] : false;
?>
<p>
 <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tcd-w'); ?></label>
 <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
 <label for="<?php echo $this->get_field_id('exclude_cat_num'); ?>"><?php _e('Categories To Exclude:', 'tcd-w'); ?></label>
 <input class="widefat" id="<?php echo $this->get_field_id('exclude_cat_num'); ?>" name="<?php echo $this->get_field_name('exclude_cat_num'); ?>" type="text" value="<?php echo $instance['exclude_cat_num']; ?>" />
 <span><?php _e('Enter a comma-seperated list of category ID numbers, example 2,4,10<br />(Don\'t enter comma for last number).', 'tcd-w'); ?></span>
</p>
<p>
 <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
 <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts', 'tcd-w'); ?></label></p>

<?php
 } // end function form
}

// End class widget
add_action('widgets_init', function(){register_widget('tcdw_category_list_widget');});
?>

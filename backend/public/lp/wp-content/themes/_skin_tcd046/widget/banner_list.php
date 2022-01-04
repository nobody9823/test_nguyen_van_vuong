<?php

class tcdw_banner_list_widget extends WP_Widget {

  private $banner_count = 10;

  function __construct() {
    parent::__construct(
      'tcdw_banner_list_widget',// ID
      __( 'Banner list (tcd ver)', 'tcd-w' ),
      array(
        'classname' => 'tcdw_banner_list_widget',
        'description' => __('Displays banner list.', 'tcd-w')
      )
    );
  }

  function widget($args, $instance) {
    extract($args);

    $title = apply_filters('widget_title', $instance['title']);

    $output = '';

    $cnt = 0;
    for($i = 1; $i <= $this->banner_count; $i++) {
      if (!empty($instance['banner_image'.$i])) {
        $banner_title = trim($instance['banner_title'.$i]);
        $banner_url = $instance['banner_url'.$i];
        $banner_target_blank = $instance['banner_target_blank'.$i];
        $banner_image_id = $instance['banner_image'.$i];
        $banner_image = null;
        if ($banner_image_id) {
          $banner_image = wp_get_attachment_image_src($banner_image_id, 'full');
        }

        if (!empty($banner_image[0])) {
          $output .= '<li>';
          if ($banner_url && $banner_target_blank) {
            $output .= '<a class="image" href="'.$banner_url.'" target="_blank">';
          } elseif ($banner_url) {
            $output .= '<a class="image" href="'.$banner_url.'">';
          } else {
            $output .= '<div class="image">';
          }
          $output .= '<img src="'.$banner_image[0].'" alt="" />';
          if ($banner_title) {
              $output .= '<div class="caption caption_hover_slide">'.esc_html($banner_title).'</div>';
          }
          if ($banner_url) {
            $output .= '</a>';
          } else {
            $output .= '</div>';
          }
          $output .= '</li>'."\n";
        }
      }
    }

    if (!$output) return;

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ($title) { echo $before_title . $title . $after_title; }

    if ($instance['desc']) { echo '<div class="desc">'.wpautop($instance['desc']).'</div>'; }

    echo "\n".'<ul class="banner_list">'."\n".$output.'</ul>'."\n";

    // After widget //
    echo $after_widget;

  }

  // Update Settings //
  function update($new_instance, $old_instance) {
   $instance = $old_instance;
   $instance['title'] = strip_tags($new_instance['title']);
   $instance['desc'] = strip_tags($new_instance['desc']);

    for($i = 1; $i <= $this->banner_count; $i++) {
      $instance['banner_title'.$i] = strip_tags($new_instance['banner_title'.$i]);
      $instance['banner_url'.$i] = strip_tags($new_instance['banner_url'.$i]);
      $instance['banner_target_blank'.$i] = strip_tags($new_instance['banner_target_blank'.$i]);
      $instance['banner_image'.$i] = strip_tags($new_instance['banner_image'.$i]);
    }
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array( 'title' => '', 'desc' => '');
    for($i = 1; $i <= $this->banner_count; $i++) {
      $defaults['banner_title'.$i] = '';
      $defaults['banner_url'.$i] = '';
      $defaults['banner_image'.$i] = '';
      $defaults['banner_target_blank'.$i] = '';
    }
    $instance = wp_parse_args( (array) $instance, $defaults );
?>

<div class="tcd_toggle_widget_box_wrap">
  <p>
   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tcd-w'); ?></label>
   <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
  </p>
  <p>
   <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description:', 'tcd-w'); ?></label>
   <textarea id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" rows="4" class="widefat"><?php echo esc_textarea($instance['desc']); ?></textarea>
  </p>

<?php for($i = 1; $i <= $this->banner_count; $i++): ?>

  <h3 class="tcd_toggle_widget_headline"><?php _e('Banner','tcd-w'); ?><?php echo $i; ?></h3>
  <div class="tcd_toggle_widget_box">
    <div class="tcd_toggle_widget_box_inner">
      <h5><label for="<?php echo $this->get_field_id('banner_title'.$i); ?>"><?php _e('Banner title:', 'tcd-w'); ?></label></h5>
      <input  type="text"id="<?php echo $this->get_field_id('banner_title'.$i); ?>" name="<?php echo $this->get_field_name('banner_title'.$i); ?>" value="<?php echo $instance['banner_title'.$i]; ?>" class="widefat" />
    </div>
    <div class="tcd_toggle_widget_box_inner">
      <h5><label for="<?php echo $this->get_field_id('banner_url'.$i); ?>"><?php _e('Banner url:', 'tcd-w'); ?></label></h5>
      <input type="text" id="<?php echo $this->get_field_id('banner_url'.$i); ?>" name="<?php echo $this->get_field_name('banner_url'.$i); ?>" value="<?php echo $instance['banner_url'.$i]; ?>" class="widefat" style="margin-bottom:10px;" />
      <br />
      <input type="hidden" name="<?php echo $this->get_field_name('banner_target_blank'.$i); ?>" value="0"/>
      <label><input id="<?php echo $this->get_field_id('banner_target_blank'.$i); ?>" name="<?php echo $this->get_field_name('banner_target_blank'.$i); ?>" type="checkbox" value="1" <?php checked( '1', $instance['banner_title'.$i] ); ?> /> <?php _e('Open link in new window', 'tcd-w');  ?></label>
    </div>
    <div class="tcd_toggle_widget_box_inner">
      <h5><label for="<?php echo $this->get_field_id('banner_image'.$i); ?>"><?php _e('Banner image:', 'tcd-w'); ?></label></h5>
      <div class="widget_media_upload cf cf_media_field hide-if-no-js <?php echo $this->get_field_id('banner_image'.$i); ?>">
        <input type="hidden" value="<?php echo $instance['banner_image'.$i]; ?>" id="<?php echo $this->get_field_id('banner_image'.$i); ?>" name="<?php echo $this->get_field_name('banner_image'.$i); ?>" class="cf_media_id">
        <div class="preview_field"><?php if($instance['banner_image'.$i]){ echo wp_get_attachment_image($instance['banner_image'.$i], 'medium'); }; ?></div>
        <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$instance['banner_image'.$i]){ echo 'hidden'; }; ?>">
        </div>
      </div>
      <p class="description"><?php _e('Recommend image size. Width:300px, Height:165px', 'tcd-w');  ?></p>
    </div>
  </div>
<?php endfor; ?>

</div>

<?php
  }// end Widget Control Panel
}// end class


// init the widget
add_action('widgets_init', function(){register_widget('tcdw_banner_list_widget');});



?>

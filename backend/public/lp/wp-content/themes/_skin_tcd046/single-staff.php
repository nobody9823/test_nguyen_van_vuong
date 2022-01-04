<?php
get_header();
$options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

<div id="left_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post();

      $staff_name = trim(get_post_meta($post->ID, 'staff_name', true));
      if (!$staff_name) $staff_name = get_the_title();
      $staff_position = get_post_meta($post->ID, 'staff_position', true);
      $staff_facebook_url = get_post_meta($post->ID, 'staff_facebook_url', true);
      $staff_twitter_url = get_post_meta($post->ID, 'staff_twitter_url', true);
      $staff_insta_url = get_post_meta($post->ID, 'staff_insta_url', true);
      $staff_table = get_post_meta($post->ID, 'staff_table', true);
      $headline = get_post_meta($post->ID, 'headline', true);
      $desc = get_post_meta($post->ID, 'desc', true);
      $user_id = (int) get_post_meta($post->ID, 'user_id', true);

      $_staff_table = '';
      if ($staff_position) {
        $_staff_table .= '<tr><td colspan="2">'.esc_html($staff_position).'</td></tr>';
      }
      if (!empty($staff_table['headline'][0])) {
        foreach( array_keys( $staff_table['headline'] ) as $repeater_index ) {
          if ( isset( $staff_table['headline'][$repeater_index] ) ) {
            $row_headline = esc_html($staff_table['headline'][$repeater_index]);
          } else {
            $row_headline = '';
          }
          if ( isset( $staff_table['desc'][$repeater_index] ) ) {
            $row_desc = $staff_table['desc'][$repeater_index];
            // 自動リンク
            if (strpos($row_desc, 'http') !== false) {
              $row_desc = strip_tags($row_desc, '<a>');
              $pattern = '/(href=")?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
              $row_desc = preg_replace_callback($pattern, function($matches) {
                // 既にリンクの場合はそのまま
                if (isset($matches[1])) return $matches[0];
                return '<a href="'.esc_attr($matches[0]).'">'.esc_html($matches[0]).'</a>';
              }, $row_desc);
            } else {
              $row_desc = esc_html($row_desc);
            }
          } else {
            $row_desc = '';
          }
          if ($row_headline && $row_desc) {
            $_staff_table .= '<tr><th>'.$row_headline.'</th><td>'.$row_desc.'</td></tr>';
          } elseif ($row_headline) {
            $_staff_table .= '<tr><th colspan="2">'.$row_headline.'</th></tr>';
          } elseif ($row_desc) {
            $_staff_table .= '<tr><td colspan="2">'.$row_desc.'</td></tr>';
          }
        }
      }
      if ($_staff_table) {
        $_staff_table = '<table>'.$_staff_table.'</table>'."\n";
      }
 ?>

 <div id="article">
  <h2 class="headline headline_bg_l"><?php
    if ($options['staff_archive_headline'] && $options['staff_archive_headline_sub']) {
      echo esc_html($options['staff_archive_headline']);
      echo '<span>'.esc_html($options['staff_archive_headline_sub']).'</span>';
    } elseif ($options['staff_archive_headline_sub']) {
      echo esc_html($options['staff_archive_headline_sub']);
    } else {
      echo esc_html($options['staff_archive_headline']);
    }
  ?></h2>

  <div class="post_content">
   <div class="staff_info<?php if (has_post_thumbnail()) echo ' has_image'; ?> clearfix">
    <?php if (has_post_thumbnail()) { ?>
    <div class="staff_image">
     <?php the_post_thumbnail('size6'); ?>
    </div>
    <?php } ?>
    <div class="staff_detail">
     <h3 class="staff_name"><?php echo esc_html($staff_name); ?></h3>
     <?php if ($staff_facebook_url || $staff_twitter_url || $staff_insta_url) : ?>
     <ul class="staff_social_link">
      <?php if ($staff_twitter_url) : ?><li class="twitter"><a href="<?php echo esc_attr($staff_twitter_url); ?>" target="_blank"><span>Twitter</span></a></li><?php endif; ?>
      <?php if ($staff_facebook_url) : ?><li class="facebook"><a href="<?php echo esc_attr($staff_facebook_url); ?>" target="_blank"><span>Facebook</span></a></li><?php endif; ?>
      <?php if ($staff_insta_url) : ?><li class="insta"><a href="<?php echo esc_attr($staff_insta_url); ?>" target="_blank"><span>Instagram</span></a></li><?php endif; ?>
     </ul>
     <?php endif; ?>
     <?php echo $_staff_table; ?>
    </div>
   </div>
   <?php if ($headline) { ?><h3 id="post_title" class="rich_font"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($headline)); ?></h3><?php } ?>
   <?php if ($desc) { ?><p><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($desc)); ?></p><?php } ?>
   <?php the_content(); ?>
  </div>

 <?php
      // related post *******************************************************************************
      if ($options['staff_show_related_post'] && $user_id > 0) :
        $args = array('author' => $user_id, 'showposts'=> $options['staff_related_post_num'], 'orderby' => 'rand');
        $my_query = new WP_Query($args);
        $i = 1;
        if ($my_query->have_posts()) {
 ?>
 <div id="related_post">
  <h3 class="headline headline_bg"><?php echo esc_html($staff_name.' | '.$options['staff_related_post_headline']); ?></h3>
  <ol class="clearfix">
   <?php while ($my_query->have_posts()) { $my_query->the_post(); ?>
   <li>
    <a href="<?php the_permalink() ?>">
     <div class="image">
      <?php if (has_post_thumbnail()) { the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.gif" alt="" title="" />'; }; ?>
     </div>
     <h4 class="title"><?php trim_title(30); ?></h4>
    </a>
   </li>
   <?php } wp_reset_postdata(); ?>
  </ol>
 </div>
 <?php } ?>
 <?php endif; ?>

  <div id="previous_next_post2">
   <?php
     $prev_post = get_adjacent_post(false, '', true);
     $next_post = get_adjacent_post(false, '', false);
     if ($options['staff_archive_headline_sub']) {
       $staff_archive_headline = esc_html($options['staff_archive_headline_sub']);
     } elseif ($options['staff_archive_headline']) {
       $staff_archive_headline = esc_html($options['staff_archive_headline']);
     } else {
       $staff_archive_headline = __('Staff', 'tcd-d');
     }
     if ($prev_post) {
        echo '<a href="'.get_permalink($prev_post->ID).'"class="prev_post">'.sprintf(__('Prev staff', 'tcd-w'), $staff_archive_headline)."</a>\n";
     }
     if ($next_post) {
        echo '<a href="'.get_permalink($next_post->ID).'"class="next_post">'.sprintf(__('Next staff', 'tcd-w'), $staff_archive_headline)."</a>\n";
     }
   ?>
  </div>

 </div><!-- END #article -->

 <?php endwhile; endif; ?>

</div><!-- END #left_col -->

<?php if( !is_mobile() || is_no_responsive() ) { ?>

 <?php if(is_active_sidebar('staff_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('staff_widget'); ?>
 </div>
 <?php } ?>

<?php } else { ?>

 <?php if(is_active_sidebar('staff_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('staff_widget_mobile'); ?>
 </div>
 <?php } ?>

<?php } ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>

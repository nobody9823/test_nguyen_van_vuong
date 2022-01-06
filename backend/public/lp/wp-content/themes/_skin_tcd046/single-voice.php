<?php
get_header();
$options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

<div id="left_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post();

      $headline = get_post_meta($post->ID, 'headline', true);
      $desc = get_post_meta($post->ID, 'desc', true);
      $voice_user = get_post_meta($post->ID, 'voice_user', true);
      $voice_user_info = get_post_meta($post->ID, 'voice_user_info', true);
      $voice_user_table = get_post_meta($post->ID, 'voice_user_table', true);
      $interview = get_post_meta($post->ID, 'interview', true);
      $course_desc = get_post_meta($post->ID, 'course_desc', true);
      $course_url = get_post_meta($post->ID, 'course_url', true);
      $course_button = get_post_meta($post->ID, 'course_button', true);

      $_voice_user_table = '';
      if (!empty($voice_user_table['headline'][0])) {
        foreach( array_keys( $voice_user_table['headline'] ) as $repeater_index ) {
          if ( isset( $voice_user_table['headline'][$repeater_index] ) ) {
            $row_headline = esc_html($voice_user_table['headline'][$repeater_index]);
          } else {
            $row_headline = '';
          }
          if ( isset( $voice_user_table['desc'][$repeater_index] ) ) {
            $row_desc = $voice_user_table['desc'][$repeater_index];
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
            $_voice_user_table .= '<tr><th>'.$row_headline.'</th><td>'.$row_desc.'</td></tr>';
          } elseif ($row_headline) {
            $_voice_user_table .= '<tr><th colspan="2">'.$row_headline.'</th></tr>';
          } elseif ($row_desc) {
            $_voice_user_table .= '<tr><td colspan="2">'.$row_desc.'</td></tr>';
          }
        }
      }
      if ($_voice_user_table) {
        $_voice_user_table = '<table>'.$_voice_user_table.'</table>'."\n";
      }

      $_interview = '';
      if (!empty($interview['question'][0])) {
        foreach( array_keys( $interview['question'] ) as $repeater_index ) {
          if ( isset( $interview['question'][$repeater_index] ) ) {
            $row_question = esc_html($interview['question'][$repeater_index]);
          } else {
            $row_question = '';
          }
          if ( isset( $interview['answer'][$repeater_index] ) ) {
            $row_answer = $interview['answer'][$repeater_index];
            // 自動リンク
            if (strpos($row_answer, 'http') !== false) {
              $row_answer = strip_tags($row_answer, '<a>');
              $pattern = '/(href=")?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
              $row_answer = preg_replace_callback($pattern, function($matches) {
                // 既にリンクの場合はそのまま
                if (isset($matches[1])) return $matches[0];
                return '<a href="'.esc_attr($matches[0]).'">'.esc_html($matches[0]).'</a>';
              }, $row_answer);
            } else {
              $row_answer = esc_html($row_answer);
            }
          } else {
            $row_answer = '';
          }
          if ($row_question) {
            $_interview .= '<dt>'.str_replace(array("\r\n", "\r", "\n"), '<br />', $row_question).'</dt>';
          }
          if ($row_answer) {
            $_interview .= '<dd>'.str_replace(array("\r\n", "\r", "\n"), '<br />', $row_answer).'</dd>';
          }
        }
      }
      if ($_interview) {
        $_interview = '<dl class="interview">'.$_interview.'</dl>'."\n";
      }
 ?>

 <div id="article">
  <h2 class="headline headline_bg_l"><?php
    if ($options['voice_archive_headline'] && $options['voice_archive_headline_sub']) {
      echo esc_html($options['voice_archive_headline']);
      echo '<span>'.esc_html($options['voice_archive_headline_sub']).'</span>';
    } elseif ($options['voice_archive_headline_sub']) {
      echo esc_html($options['voice_archive_headline_sub']);
    } else {
      echo esc_html($options['voice_archive_headline']);
    }
  ?></h2>

  <div class="post_content">
   <div class="voice_header">
    <?php if ($headline) { ?><h3 id="post_title" class="rich_font"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($headline)); ?></h3><?php } ?>
    <?php if ($desc) { ?><p><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($desc)); ?></p><?php } ?>
    <div class="voice_info<?php if (has_post_thumbnail()) echo ' has_image'; ?> clearfix">
     <?php if (has_post_thumbnail()) { ?>
     <div class="voice_image">
      <?php the_post_thumbnail('size6'); ?>
     </div>
     <?php } ?>
     <div class="voice_user">
      <?php
        if ($voice_user && $voice_user_info) {
          echo '<h3 class="voice_name headline_bg">'.esc_html($voice_user).'<span>('.esc_html($voice_user_info).')</span></h3>'."\n";
        } elseif ($voice_user) {
          echo '<h3 class="voice_name headline_bg">'.esc_html($voice_user).'</h3>'."\n";
        } elseif ($voice_user_info) {
          echo '<h3 class="voice_name headline_bg">'.esc_html($voice_user_info).'</h3>'."\n";
        }
      ?>
      <?php echo $_voice_user_table; ?>
     </div>
    </div>
   </div>
   <?php echo $_interview; ?>
   <?php if ($course_desc || $course_url) { ?>
   <div class="voice_course">
    <?php if ($course_desc) { ?><p><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($course_desc)); ?></p><?php } ?>
    <?php if ($course_url) { ?><p class="course_button"><a href="<?php echo esc_attr($course_url); ?>"><?php echo esc_html($course_button ? $course_button : $course_url); ?></a></p><?php } ?>
   </div>
   <?php } ?>
  </div>

  <div id="previous_next_post2">
   <a href="<?php echo get_post_type_archive_link('voice'); ?>" class="back"><?php
     if ($options['voice_archive_headline_sub']) {
       echo esc_html($options['voice_archive_headline_sub']);
     } elseif ($options['voice_archive_headline']) {
       echo esc_html($options['voice_archive_headline']);
     } else {
       _e('Back', 'tcd-d');
     }
   ?></a>
  </div>

 </div><!-- END #article -->

 <?php endwhile; endif; ?>

</div><!-- END #left_col -->

<?php if( !is_mobile() || is_no_responsive() ) { ?>

 <?php if(is_active_sidebar('voice_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('voice_widget'); ?>
 </div>
 <?php } ?>

<?php } else { ?>

 <?php if(is_active_sidebar('voice_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('voice_widget_mobile'); ?>
 </div>
 <?php } ?>

<?php } ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>

<?php
     get_header();
     $options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

<div id="left_col">

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

 <?php if ( have_posts() ) : ?>
 <ol id="voice_list">
  <?php while ( have_posts() ) : the_post(); ?>
  <li class="clearfix<?php if (has_post_thumbnail()) echo ' has_post_thumbnail'; ?>">
   <?php if (has_post_thumbnail()) { ?>
   <div class="voice_image">
    <?php the_post_thumbnail('size1'); ?>
   </div>
   <?php } ?>
   <div class="info">
    <?php
      $voice_user = get_post_meta($post->ID, 'voice_user', true);
      $voice_user_info = get_post_meta($post->ID, 'voice_user_info', true);
      $desc = trim(get_post_meta($post->ID, 'desc', true));
      $archive_button = get_post_meta($post->ID, 'archive_button', true);
      if ($voice_user && $voice_user_info) {
        echo '<h3 class="voice_name">'.esc_html($voice_user).'<span>('.esc_html($voice_user_info).')</span></h3>'."\n";
      } elseif ($voice_user) {
        echo '<h3 class="voice_name">'.esc_html($voice_user).'</h3>'."\n";
      } elseif ($voice_user_info) {
        echo '<h3 class="voice_name">'.esc_html($voice_user_info).'</h3>'."\n";
      }
      if ($desc) {
        echo '<p>'.str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($desc)).'</p>'."\n";
      }
      if ($archive_button) {
        echo '<p class="voice_button"><a href="'.get_permalink().'">'.esc_html($archive_button).'</a></p>'."\n";
      }
    ?>
   </div>
  </li>
  <?php endwhile; ?>
 </ol><!-- END #voice_list -->
 <?php endif; ?>

 <?php get_template_part('navigation'); ?>

</div><!-- END #left_col -->

<?php if( !is_mobile() || is_no_responsive() ) { ?>

 <?php if(is_active_sidebar('voice_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('voice_widget'); ?>
 </div>
 <?php }; ?>

<?php } else { ?>

 <?php if(is_active_sidebar('voice_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('voice_widget_mobile'); ?>
 </div>
 <?php }; ?>

<?php }; ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>
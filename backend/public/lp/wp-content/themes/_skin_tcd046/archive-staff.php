<?php
     get_header();
     $options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

<div id="left_col">

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

 <?php if ( have_posts() ) : ?>
 <ol id="staff_list">
  <?php while ( have_posts() ) : the_post(); ?>
  <li class="clearfix<?php if (has_post_thumbnail()) echo ' has_post_thumbnail'; ?>">
   <a href="<?php the_permalink() ?>">
    <?php if (has_post_thumbnail()) { ?>
    <div class="image">
     <?php the_post_thumbnail('size6'); ?>
    </div>
    <?php } ?>
    <div class="info">
     <?php
       $staff_name = trim(get_post_meta($post->ID, 'staff_name', true));
       if (!$staff_name) $staff_name = get_the_title();
       $staff_position = get_post_meta($post->ID, 'staff_position', true);
       $headline = get_post_meta($post->ID, 'headline', true);
       if ($staff_name) {
         echo '<h3 class="staff_name">'.esc_html($staff_name).'</h3>'."\n";
       }
       if ($staff_position) {
         echo '<span class="staff_position">'.esc_html($staff_position).'</span>'."\n";
       }
       if ($headline) {
         echo '<p>'.str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($headline)).'</p>'."\n";
       }
     ?>
    </div>
   </a>
  </li>
  <?php endwhile; ?>
 </ol><!-- END #staff_list -->
 <?php endif; ?>

</div><!-- END #left_col -->

<?php if( !is_mobile() || is_no_responsive() ) { ?>

 <?php if(is_active_sidebar('staff_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('staff_widget'); ?>
 </div>
 <?php }; ?>

<?php } else { ?>

 <?php if(is_active_sidebar('staff_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('staff_widget_mobile'); ?>
 </div>
 <?php }; ?>

<?php }; ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>
<?php
     get_header();
     $options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

<div id="left_col">

 <?php if ( have_posts() ) : ?>
 <div id="recent_news">
  <h2 class="headline headline_bg_l"><?php
    if ($options['news_archive_headline'] && $options['news_archive_headline_sub']) {
      echo esc_html($options['news_archive_headline']);
      echo '<span>'.esc_html($options['news_archive_headline_sub']).'</span>';
    } elseif ($options['news_archive_headline_sub']) {
      echo esc_html($options['news_archive_headline_sub']);
    } else {
      echo esc_html($options['news_archive_headline']);
    }
  ?></h2>
  <ol>
   <?php while ( have_posts() ) : the_post(); ?>
   <li<?php if (has_post_thumbnail()) echo ' class="has_post_thumbnail"'; ?>>
    <a href="<?php the_permalink() ?>">
     <?php if (has_post_thumbnail()) { ?>
     <div class="image">
      <?php the_post_thumbnail('size2'); ?>
     </div>
     <?php } ?>
     <div class="info">
      <?php if ($options['show_date_news']){ ?><p class="date"><?php the_time('Y.m.d'); ?></p><?php } ?>
      <h3 class="title"><?php the_title(); ?></h3>
     </div>
    </a>
   </li>
   <?php endwhile; ?>
  </ol>
 </div><!-- END #recent_news -->
 <?php endif; ?>

 <?php get_template_part('navigation'); ?>

</div><!-- END #left_col -->

<?php if( !is_mobile() || is_no_responsive() ) { ?>

 <?php if(is_active_sidebar('news_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('news_widget'); ?>
 </div>
 <?php }; ?>

<?php } else { ?>

 <?php if(is_active_sidebar('news_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('news_widget_mobile'); ?>
 </div>
 <?php }; ?>

<?php }; ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>
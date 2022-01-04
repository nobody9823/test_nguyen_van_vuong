<?php
     get_header();
     $options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

<div id="left_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <div id="article">

  <?php if ($options['show_date_news']){ ?>
  <ul id="post_meta_top" class="clearfix">
   <li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
  </ul>
  <?php }; ?>

  <h2 id="post_title" class="rich_font"><?php the_title(); ?></h2>

  <?php if($options['show_sns_top_news']) { ?>
  <div class="single_share clearfix" id="single_share_top">
   <?php get_template_part('sns-btn-top'); ?>
  </div>
  <?php }; ?>

  <?php if(has_post_thumbnail() && $page=='1') { ?>
  <div id="post_image">
   <?php the_post_thumbnail('post-thumbnail'); ?>
  </div>
  <?php }; ?>

  <div class="post_content clearfix">
   <?php the_content(__('Read more', 'tcd-w')); ?>
   <?php custom_wp_link_pages(); ?>
  </div>

  <?php if($options['show_sns_btm_news']) { ?>
  <div class="single_share clearfix" id="single_share_bottom">
   <?php get_template_part('sns-btn-btm'); ?>
  </div>
  <?php }; ?>

  <?php if ($options['show_next_post_news']) : ?>
  <div id="previous_next_post" class="clearfix">
   <?php next_prev_post_link(); ?>
  </div>
  <?php endif; ?>

 </div><!-- END #article -->

 <?php endwhile; endif; ?>

 <?php
      // recent post *******************************************************************************
      if ($options['show_recent_news']) {
        $args = array('post__not_in' => array($post->ID), 'post_type' => 'news', 'showposts' => $options['recent_news_num']);
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {
 ?>
 <div id="recent_news">
  <h3 class="headline headline_bg"><?php echo esc_html($options['recent_news_headline']); ?><a href="<?php echo get_post_type_archive_link('news'); ?>"><?php echo esc_html($options['recent_news_link_text']); ?></a></h3>
  <ol>
   <?php while ($my_query->have_posts()) { $my_query->the_post(); ?>
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
   <?php }; wp_reset_postdata(); ?>
  </ol>
 </div>
 <?php }; }; ?>

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

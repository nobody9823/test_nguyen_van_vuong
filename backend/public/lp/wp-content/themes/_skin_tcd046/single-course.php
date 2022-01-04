<?php
     get_header();
     $options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

<div id="left_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post();

    $metas = get_post_meta($post->ID);

    if (!empty($metas['header_image'][0])) {
      $header_image = wp_get_attachment_image($metas['header_image'][0], 'post-thumbnails', false,  array('class' => ''));
    }
 ?>

 <div id="article">

  <?php if (!empty($header_image[0]) || !empty($metas['header_title'][0]) || !empty($metas['header_subtitle'][0])) { ?>
  <div class="content_header">
     <?php if (!empty($metas['header_title'][0]) || !empty($metas['header_subtitle'][0])) { ?>
    <h2 class="headline headline_bg_l"><?php
      if (!empty($metas['header_title'][0])) {
        echo esc_html($metas['header_title'][0]);
      }
      if (!empty($metas['header_subtitle'][0])) {
        echo '<span>'.esc_html($metas['header_subtitle'][0]).'</span>';
      }
    ?></h2>
   <?php } ?>
   <?php if (!empty($header_image)) echo $header_image; ?>
  </div>
  <?php } ?>

  <div class="post_content course_content clearfix">

   <?php
    the_content(__('Read more', 'tcd-w'));
    custom_wp_link_pages();
   ?>

  </div>

 </div><!-- END #article -->

 <?php endwhile; endif; ?>

</div><!-- END #left_col -->

<?php if( !is_mobile() || is_no_responsive() ) { ?>

 <?php if(is_active_sidebar('course_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('course_widget'); ?>
 </div>
 <?php }; ?>

<?php } else { ?>

 <?php if(is_active_sidebar('course_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('course_widget_mobile'); ?>
 </div>
 <?php }; ?>

<?php }; ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>
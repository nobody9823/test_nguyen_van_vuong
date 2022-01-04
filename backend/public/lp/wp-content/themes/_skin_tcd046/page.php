<?php
    get_header();

    $page_tcd_template_type = get_post_meta($post->ID, 'page_tcd_template_type', true);
    $display_side_content = get_post_meta($post->ID, 'display_side_content', true);

    $image_id = get_post_meta($post->ID, 'page_image', true);
    if ($image_id) {
      $image = wp_get_attachment_image_src( $image_id, 'full' );
    }
    $headline = get_post_meta($post->ID, 'page_headline', true);
    if (empty($headline)) {
      $headline = get_the_title();
    }
    $font_size = esc_html(get_post_meta($post->ID, 'page_headline_font_size', true));
    $font_color = esc_html(get_post_meta($post->ID, 'page_headline_color', true));
    $shadow1 = esc_html(get_post_meta($post->ID, 'page_headline_shadow1', true));
    $shadow2 = esc_html(get_post_meta($post->ID, 'page_headline_shadow2', true));
    $shadow3 = esc_html(get_post_meta($post->ID, 'page_headline_shadow3', true));
    $shadow4 = esc_html(get_post_meta($post->ID, 'page_headline_shadow4', true));
    if (empty($font_size)) { $font_size = 40; }
    if (empty($font_color)) { $font_color = 'FFFFFF'; }
    if (empty($shadow1)) { $shadow1 = 0; }
    if (empty($shadow2)) { $shadow2 = 0; }
    if (empty($shadow3)) { $shadow3 = 0; }
    if (empty($shadow4)) { $shadow4 = '333333'; }

    $metas = get_post_meta($post->ID);

    if (!empty($metas['header_image'][0])) {
      $header_image = wp_get_attachment_image($metas['header_image'][0], 'post-thumbnails', false,  array('class' => ''));
    }
?>
<?php if (!empty($image[0])) { ?>
<div id="header_image">
 <div class="caption" style="text-shadow:<?php echo $shadow1; ?>px <?php echo $shadow2; ?>px <?php echo $shadow3; ?>px #<?php echo $shadow4; ?>; color:#<?php echo $font_color; ?>; ">
  <p class="headline rich_font" style="font-size:<?php echo $font_size; ?>px;"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($headline)); ?></p>
 </div>
 <img src="<?php echo $image[0]; ?>" title="" alt="" />
</div>
<?php } ?>

<?php get_template_part('breadcrumb'); ?>


<div id="main_col" class="clearfix">

 <?php if ($display_side_content == 'show') { ?>
 <div id="left_col">
 <?php } ?>


 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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

  <div class="post_content clearfix">
   <?php the_content(__('Read more', 'tcd-w')); ?>
   <?php custom_wp_link_pages(); ?>
  </div>

 </div><!-- END #article -->

 <?php endwhile; endif; ?>

 <?php if ($display_side_content == 'show') { ?>
 </div><!-- END #left_col -->
 <?php } ?>

 <?php if ($display_side_content == 'show') { ?>
 <?php if (!is_mobile() || is_no_responsive()) { ?>

 <?php if (is_active_sidebar('page_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('page_widget'); ?>
 </div>
 <?php } ?>

 <?php } else { ?>

 <?php if (is_active_sidebar('page_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('page_widget_mobile'); ?>
 </div>
 <?php } ?>

 <?php } ?>
 <?php } ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>
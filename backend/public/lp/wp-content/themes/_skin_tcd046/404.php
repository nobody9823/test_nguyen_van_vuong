<?php
    get_header();
    $options = get_desing_plus_option();

    $image = null;
    if (!empty($options['header_image_404'])) {
      $image = wp_get_attachment_image_src($options['header_image_404'], 'full');
    }
    if (!empty($image[0])) {
      $title = $options['header_txt_404'];
      $sub_title = $options['header_sub_txt_404'];
      if (!is_mobile()) {
        $title_font_size = ( ! empty( $options['header_txt_size_404'] ) ) ? $options['header_txt_size_404'] : 38;
        $sub_title_font_size = ( ! empty( $options['header_sub_title_size_404'] ) ) ? $options['header_sub_title_size_404'] : 16;
      } else {
        $title_font_size = ( ! empty( $options['header_txt_size_404'] ) ) ? $options['header_txt_size_404'] : 28;
        $sub_title_font_size = ( ! empty( $options['header_sub_title_size_404'] ) ) ? $options['header_sub_title_size_404'] : 14;
      }
      $font_color = ( ! empty( $options['header_txt_color_404'] ) ) ? $options['header_txt_color_404'] : 'ffffff';
      $shadow1 = ( ! empty( $options['dropshadow_404_h'] ) ) ? $options['dropshadow_404_h'] : 2;
      $shadow2 = ( ! empty( $options['dropshadow_404_v']) ) ? $options['dropshadow_404_v'] : 2;
      $shadow3 = ( ! empty( $options['dropshadow_404_b'] ) ) ? $options['dropshadow_404_b'] : 2;
      $shadow4 = ( ! empty( $options['dropshadow_404_c'] ) ) ? $options['dropshadow_404_c'] : '888888';
?>
<div id="header_image">
<?php   if ($title || $sub_title) { ?>
 <div class="caption" style="text-shadow:<?php echo $shadow1; ?>px <?php echo $shadow2; ?>px <?php echo $shadow3; ?>px #<?php echo $shadow4; ?>; color:#<?php echo $font_color; ?>; ">
<?php if ($title) { ?>
  <p class="headline rich_font" style="font-size:<?php echo $title_font_size; ?>px;"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($title)); ?></p>
<?php } ?>
<?php if ($sub_title) { ?>
  <p class="" style="font-size:<?php echo $sub_title_font_size; ?>px;"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($sub_title)); ?></p>
<?php } ?>
 </div>
<?php   } ?>
 <img src="<?php echo $image[0]; ?>" title="" alt="" />
</div>
<?php } ?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col">

  <div class="post_content clearfix">
   <p style="margin:50px 0;"><?php _e("Sorry, but you are looking for something that isn't here.","tcd-w"); ?></p>
  </div>

</div><!-- END #main_col -->

<?php get_footer(); ?>

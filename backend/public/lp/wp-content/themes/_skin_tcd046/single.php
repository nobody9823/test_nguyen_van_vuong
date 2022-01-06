<?php
     get_header();
     $options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

<div id="left_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <div id="article">

  <ul id="post_meta_top" class="meta clearfix">
   <?php
      if ($options['show_category']) {
        $categories = get_the_category();
        if ($categories) {
          echo '<li class="category">';

          foreach ($categories as $category) {
            // カテゴリーカラー
            $cat_meta = get_option('taxonomy_'.$category->term_id);
            if (!empty($cat_meta['category_color'])) {
              $category_color = ' style="background-color:rgba('.implode(',', hex2rgb($cat_meta['category_color'])).',0.8);"';
            } else {
              $category_color = '';
            }

            echo '<a href="'.get_category_link($category->term_id).'"'.$category_color.'>'.esc_html($category->name).'</a>';
          }

          echo '</li>';
        }
      }
   ?>
   <?php if ($options['show_date']){ ?><li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li><?php }; ?>
  </ul>

  <h2 id="post_title" class="rich_font"><?php the_title(); ?></h2>

  <?php if($options['show_sns_top']) { ?>
  <div class="single_share clearfix" id="single_share_top">
   <?php get_template_part('sns-btn-top'); ?>
  </div>
  <?php }; ?>

  <?php if(has_post_thumbnail() && $page=='1') { ?>
  <?php if($options['show_thumbnail']) { ?>
  <div id="post_image">
   <?php the_post_thumbnail('post-thumbnail'); ?>
  </div>
  <?php }; ?>
  <?php }; ?>

  <?php
       // banner 2 
       if(!is_mobile()) {
         if( $options['single_ad_code5'] || $options['single_ad_image5'] || $options['single_ad_code6'] || $options['single_ad_image6'] ) {
  ?>
  <div id="single_banner_area_bottom" class="clearfix<?php if( !$options['single_ad_code6'] && !$options['single_ad_image6'] ) { echo ' one_banner'; }; ?>">
   <?php if ($options['single_ad_code5']) { ?>
   <div class="single_banner single_banner_left">
    <?php echo $options['single_ad_code5']; ?>
   </div>
   <?php } else { ?>
   <?php $single_image5 = wp_get_attachment_image_src( $options['single_ad_image5'], 'full' ); ?>
   <div class="single_banner single_banner_left">
    <a href="<?php esc_attr_e( $options['single_ad_url5'] ); ?>" target="_blank"><img src="<?php echo $single_image5[0]; ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
   <?php if ($options['single_ad_code6']) { ?>
   <div class="single_banner single_banner_right">
    <?php echo $options['single_ad_code6']; ?>
   </div>
   <?php } else { ?>
   <?php $single_image6 = wp_get_attachment_image_src( $options['single_ad_image6'], 'full' ); ?>
   <div class="single_banner single_banner_right">
    <a href="<?php esc_attr_e( $options['single_ad_url6'] ); ?>" target="_blank"><img src="<?php echo $single_image6[0]; ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
  </div><!-- END #single_banner_area_bottom -->
  <?php }; ?>
  <?php } else { // if is mobile device ?>
  <?php if( $options['single_mobile_ad_code1'] || $options['single_mobile_ad_image1'] ) { ?>
  <div id="single_banner_area_bottom" class="clearfix one_banner">
   <?php if ($options['single_mobile_ad_code1']) { ?>
   <div class="single_banner single_banner_left">
    <?php echo $options['single_mobile_ad_code1']; ?>
   </div>
   <?php } else { ?>
   <?php $single_image1 = wp_get_attachment_image_src( $options['single_mobile_ad_image1'], 'full' ); ?>
   <div class="single_banner single_banner_left">
    <a href="<?php esc_attr_e( $options['single_mobile_ad_url1'] ); ?>" target="_blank"><img src="<?php echo $single_image1[0]; ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
  </div><!-- END #single_banner_area -->
  <?php
         }; // end mobile banner
       };
  ?>

  <div class="post_content clearfix">
   <?php the_content(__('Read more', 'tcd-w')); ?>
   <?php custom_wp_link_pages(); ?>
  </div>

  <?php if($options['show_sns_btm']) { ?>
  <div class="single_share clearfix" id="single_share_bottom">
   <?php get_template_part('sns-btn-btm'); ?>
  </div>
  <?php }; ?>

  <?php if ($options['show_author'] || $options['show_category'] || $options['show_tag'] || $options['show_comment']) { ?>
  <ul id="post_meta_bottom" class="clearfix">
   <?php if ($options['show_author']) : ?><li class="post_author"><?php _e("Author","tcd-w"); ?>: <?php if (function_exists('coauthors_posts_links')) { coauthors_posts_links(', ',', ','','',true); } else { the_author_posts_link(); }; ?></li><?php endif; ?>
   <?php if ($options['show_category']){ ?><li class="post_category"><?php the_category(', '); ?></li><?php }; ?>
   <?php if ($options['show_tag']): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
   <?php if ($options['show_comment']) : if (comments_open()){ ?><li class="post_comment"><?php _e("Comment","tcd-w"); ?>: <a href="#comment_headline"><?php comments_number( '0','1','%' ); ?></a></li><?php }; endif; ?>
  </ul>
  <?php }; ?>

  <?php if ($options['show_next_post']) : ?>
  <div id="previous_next_post" class="clearfix">
   <?php next_prev_post_link(); ?>
  </div>
  <?php endif; ?>

 </div><!-- END #article -->

 <?php
      // banner1 ------------------------------------------------------------------------------------------------------------------------
      if(!is_mobile()) {
        if( $options['single_ad_code1'] || $options['single_ad_image1'] || $options['single_ad_code2'] || $options['single_ad_image2'] ) {
 ?>
 <div id="single_banner_area" class="clearfix<?php if( !$options['single_ad_code2'] && !$options['single_ad_image2'] ) { echo ' one_banner'; }; ?>">
  <?php if ($options['single_ad_code1']) { ?>
  <div class="single_banner single_banner_left">
    <?php echo $options['single_ad_code1']; ?>
   </div>
  <?php } else { ?>
  <?php $single_image1 = wp_get_attachment_image_src( $options['single_ad_image1'], 'full' ); ?>
   <div class="single_banner single_banner_left">
    <a href="<?php esc_attr_e( $options['single_ad_url1'] ); ?>" target="_blank"><img src="<?php echo $single_image1[0]; ?>" alt="" title="" /></a>
   </div>
  <?php }; ?>
  <?php if ($options['single_ad_code2']) { ?>
   <div class="single_banner single_banner_right">
    <?php echo $options['single_ad_code2']; ?>
   </div>
  <?php } else { ?>
  <?php $single_image2 = wp_get_attachment_image_src( $options['single_ad_image2'], 'full' ); ?>
   <div class="single_banner single_banner_right">
    <a href="<?php esc_attr_e( $options['single_ad_url2'] ); ?>" target="_blank"><img src="<?php echo $single_image2[0]; ?>" alt="" title="" /></a>
   </div>
  <?php }; ?>
 </div><!-- END #single_banner_area -->
 <?php }; ?>
 <?php } else { // if is mobile device ?>
 <?php if( $options['single_mobile_ad_code2'] || $options['single_mobile_ad_image2'] ) { ?>
 <div id="single_banner_area" class="clearfix one_banner">
  <?php if ($options['single_mobile_ad_code2']) { ?>
   <div class="single_banner single_banner_left">
    <?php echo $options['single_mobile_ad_code2']; ?>
   </div>
  <?php } else { ?>
  <?php $single_image2 = wp_get_attachment_image_src( $options['single_mobile_ad_image2'], 'full' ); ?>
   <div class="single_banner single_banner_left">
    <a href="<?php esc_attr_e( $options['single_mobile_ad_url2'] ); ?>" target="_blank"><img src="<?php echo $single_image2[0]; ?>" alt="" title="" /></a>
   </div>
  <?php }; ?>
 </div><!-- END #single_banner_area -->
 <?php
        }; // end mobile banner
      };
 ?>

 <?php endwhile; endif; ?>

 <?php
      // related post *******************************************************************************
      if ($options['show_related_post']) :
       $categories = get_the_category($post->ID);
       if ($categories) {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
        $args=array('category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=> $options['related_post_num'], 'orderby' => 'rand');
        $my_query = new WP_Query($args);
        $i = 1;
        if ($my_query->have_posts()) {
 ?>
 <div id="related_post">
  <h3 class="headline headline_bg"><?php echo esc_html( $options['related_post_headline'] ); ?></h3>
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
   <?php $i++; }; wp_reset_postdata(); ?>
  </ol>
 </div>
 <?php }; }; ?>
 <?php endif; ?>

 <?php if ($options['show_comment']) : if (function_exists('wp_list_comments')) { comments_template('', true); } else { comments_template(); }; endif; ?>


</div><!-- END #left_col -->

<?php if( !is_mobile() || is_no_responsive() ) { ?>

 <?php if(is_active_sidebar('post_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('post_widget'); ?>
 </div>
 <?php }; ?>

<?php } else { ?>

 <?php if(is_active_sidebar('post_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('post_widget_mobile'); ?>
 </div>
 <?php }; ?>

<?php }; ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>

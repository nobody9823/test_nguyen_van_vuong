<?php
    get_header();
    $options = get_desing_plus_option();

    // 全カテゴリー取得
    $course_categories = get_terms('course_category', array('parent' => 0));
    //$course_categories = false;

    // カテゴリーデフォルト表示
    if (is_tax('course_category')) {
      $active_course_category = get_queried_object();
    } elseif (!empty($course_categories[0])) {
      $active_course_category = $course_categories[0];
    }
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col" class="clearfix">

 <div id="left_col">

  <h2 class="headline headline_bg_l"><?php
    if ($options['course_archive_headline'] && $options['course_archive_headline_sub']) {
      echo esc_html($options['course_archive_headline']);
      echo '<span>'.esc_html($options['course_archive_headline_sub']).'</span>';
    } elseif ($options['course_archive_headline_sub']) {
      echo esc_html($options['course_archive_headline_sub']);
    } else {
      echo esc_html($options['course_archive_headline']);
    }
  ?></h2>
  
<?php if ($course_categories) : // カテゴリーあり ?>

  <ul class="course_categories">
<?php
        foreach ($course_categories as $key => $course_category) {
          echo '<li>';
          if (is_tax('course_category')) {
            echo '<a href="'.get_term_link($course_category, 'course_category').'"';
          } else {
            echo '<a href="#course_category-'.esc_attr($course_category->term_id).'"';
          }
          if (!empty($active_course_category->term_id) && $active_course_category->term_id == $course_category->term_id) {
            echo ' class="active"';
          }
          echo ' data-cat-id="'.esc_attr($course_category->term_id).'">'.esc_html($course_category->name).'</a></li>';
        }
?>
  </ul>

<?php
        foreach ($course_categories as $key => $course_category) :
          $course_query = new WP_Query(array(
            'posts_per_page'   => -1,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'course',
            'tax_query'        => array(
              array(
                'taxonomy' => 'course_category',
                'field'    => 'id',
                'terms'    => $course_category->term_id,
              )
            )
          ));

          if ($course_query->have_posts()) :
            $course_category_meta = get_option('taxonomy_'.$course_category->term_id);
?>

  <div class="course_category course_category-<?php echo esc_attr($course_category->term_id); ?>">
   <h3 class="headline course_category_headline"><?php
            if (!empty($course_category_meta['name2'])) {
              echo esc_html($course_category_meta['name2']);
              echo '<span>'.esc_html($course_category->name).'</span>';
            } else {
              echo esc_html($course_category->name);
            }
   ?></h3>
   <ol class="course_list">
<?php
            while ($course_query->have_posts()) :
              $course_query->the_post();
              $banner_image = null;
              $banner_image_id = get_post_meta($post->ID, 'banner_image', true);
              if (!$banner_image_id) {
                $banner_image_id = get_post_meta($post->ID, 'header_image', true);
              }
              if (!$banner_image_id) {
                $banner_image_id = get_post_thumbnail_id();
              }
              if ($banner_image_id) {
                $banner_image = wp_get_attachment_image_src($banner_image_id, 'size3');
              }
              if (!empty($banner_image[0])) {
                 $banner_image_src = $banner_image[0];
              } else {
                 $banner_image_src = get_template_directory_uri().'/img/common/no_image3.gif';
              }

              $banner_title = get_post_meta($post->ID, 'banner_title', true);
              if (!$banner_title) {
                $banner_title = $post->post_title;
              }

              $banner_subtitle = get_post_meta($post->ID, 'banner_subtitle', true);
              $banner_desc = get_post_meta($post->ID, 'banner_desc', true);
?>

   <li class="course">
    <a class="image_wrapper" href="<?php the_permalink(); ?>" title="<?php echo esc_attr($banner_title); ?>">
     <div class="image">
      <img src="<?php echo esc_attr($banner_image_src); ?>" alt="" />
     </div>
     <div class="info">
      <h3 class="headline"><?php echo esc_html($banner_title); ?><?php
        if ($banner_subtitle) {
          echo '<span>'.esc_html($banner_subtitle).'</span>'; 
        }
      ?></h3>
      <?php if ($banner_desc) { ?><div class="desc"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($banner_desc)); ?></div><?php } ?>
     </div>
    </a>
   </li>

<?php
            endwhile;
          wp_reset_postdata();
?>

   </ol>
  </div>

<?php     else : ?>

  <p class="no_post"><?php _e('There is no registered post.','tcd-w'); ?></p>

<?php
          endif;
        endforeach;

      elseif (have_posts()) : // カテゴリーなし
?>

  <div class="course_category">
   <ol class="course_list">
<?php
        while (have_posts()) :
          the_post();
          $banner_image = null;
          $banner_image_id = get_post_meta($post->ID, 'banner_image', true);
          if (!$banner_image_id) {
            $banner_image_id = get_post_meta($post->ID, 'header_image', true);
          }
          if (!$banner_image_id) {
            $banner_image_id = get_post_thumbnail_id();
          }
          if ($banner_image_id) {
            $banner_image = wp_get_attachment_image_src($banner_image_id, 'size3');
          }
          if (!empty($banner_image[0])) {
             $banner_image_src = $banner_image[0];
          } else {
             $banner_image_src = get_template_directory_uri().'/img/common/no_image3.gif';
          }

          $banner_title = get_post_meta($post->ID, 'banner_title', true);
          if (!$banner_title) {
            $banner_title = $post->post_title;
          }

          $banner_subtitle = get_post_meta($post->ID, 'banner_subtitle', true);
          $banner_desc = get_post_meta($post->ID, 'banner_desc', true);
?>

   <li class="course">
    <a class="image_wrapper" href="<?php the_permalink(); ?>" title="<?php echo esc_attr($banner_title); ?>">
     <div class="image">
      <img src="<?php echo esc_attr($banner_image_src); ?>" alt="" />
     </div>
     <div class="info">
      <h3 class="headline"><?php echo esc_html($banner_title); ?><?php
        if ($banner_subtitle) {
          echo '<span>'.esc_html($banner_subtitle).'</span>'; 
        }
      ?></h3>
      <?php if ($banner_desc) { ?><div class="desc"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($banner_desc)); ?></div><?php } ?>
     </div>
    </a>
   </li>

<?php   endwhile; ?>

   </ol>
  </div>

<?php else : ?>

  <p class="no_post"><?php _e('There is no registered post.','tcd-w'); ?></p>

<?php endif; ?>

 </div><!-- END #left_col -->

<?php if( !is_mobile() || is_no_responsive() ) { ?>

 <?php if(is_active_sidebar('course_widget')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('course_widget'); ?>
 </div>
 <?php }; ?>

<?php } else { ?>

 <?php if (is_active_sidebar('course_widget_mobile')) { ?>
 <div id="side_col">
  <?php dynamic_sidebar('course_widget_mobile'); ?>
 </div>
 <?php }; ?>

<?php }; ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>

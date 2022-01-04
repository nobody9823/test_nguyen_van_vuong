<?php
    $options = get_desing_plus_option();

    global $header_slider;
    $header_slider = array();

    for ($i = 1; $i <= 5; $i++) {
      if (empty($options['slider_content_type'.$i])) continue;
      $image = null;

      // 画像
      if ($options['slider_content_type'.$i] == 'type1') {
        if (!is_mobile()) {
          $image = wp_get_attachment_image_src($options['slider_image'.$i], 'size5');
        } else {
          $image = wp_get_attachment_image_src($options['slider_image_mobile'.$i], 'size5');
        }
        if (!empty($image[0])) {
          if (!$header_slider) {
            $header_slider[$i]['first_slide'] = true;
            $header_slider['autoplay'] = true;
          }
          $header_slider[$i]['content_type'] = 'type1';
          $header_slider[$i]['image'] = $image;
          if (!empty($header_slider['count']['image'])) {
            $header_slider['count']['image']++;
          } else {
            $header_slider['count']['image'] = 1;
          }
        }

      // 動画
      } elseif ($options['slider_content_type'.$i] == 'type2') {
        if ($options['slider_video'.$i]) {
          if (!$header_slider) {
            $header_slider[$i]['first_slide'] = true;
            if (!wp_is_mobile()) {
              $header_slider['autoplay'] = false;
            } else {
              $header_slider['autoplay'] = true;
            }
          }
          $header_slider[$i]['content_type'] = 'type2';
          $header_slider[$i]['video'] = $video_url = wp_get_attachment_url($options['slider_video'.$i]);
          if (!empty($header_slider['count']['video'])) {
            $header_slider['count']['video']++;
          } else {
            $header_slider['count']['video'] = 1;
          }

          if ($options['slider_video_image'.$i]) {
            $header_slider[$i]['image'] = wp_get_attachment_image_src($options['slider_video_image'.$i], 'size5');
         }
        }

      // Youtube
      } elseif ($options['slider_content_type'.$i] == 'type3') {
        if ($options['slider_youtube_url'.$i]) {
          if (!$header_slider) {
            $header_slider[$i]['first_slide'] = true;
            if (!wp_is_mobile()) {
              $header_slider['autoplay'] = false;
            } else {
              $header_slider['autoplay'] = true;
            }
          }
          $header_slider[$i]['content_type'] = 'type3';
          $header_slider[$i]['youtube_url'] = $options['slider_youtube_url'.$i];
          if (!empty($header_slider['count']['youtube'])) {
            $header_slider['count']['youtube']++;
          } else {
            $header_slider['count']['youtube'] = 1;
          }

          if ($options['slider_youtube_image'.$i]) {
            $header_slider[$i]['image'] = wp_get_attachment_image_src($options['slider_youtube_image'.$i], 'size5');
          }
        }
      }
    }

    // 営業日コンテンツ
    // 必要なページビルダーCSSを読み込むようにする
    if ( $options['show_index_business_day'] == 1 &&
      $options['index_business_day_postid'] &&
      $options['index_business_day_num'] &&
      function_exists( 'page_builder_widget_business_day_sctipts_styles' ) &&
      function_exists( 'the_page_builder_business_day' )
    ) {
      page_builder_widget_business_day_sctipts_styles(true);
    }

    get_header();
?>

<?php
    // スライダー
    if ($header_slider) :
?>
<div id="header_slider">
<?php
      foreach ($header_slider as $i => $slider) {
        if (empty($slider['content_type'])) continue;
?>
<?php
        $url = $options['slider_url'.$i];
        $target = $options['slider_target'.$i];

        if ($options['use_slider_caption'.$i] == 1) {
          ob_start();
?>
  <div class="caption">
   <?php
          if ($options['slider_headline'.$i]) {
            echo '<p class="headline rich_font">'.str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($options['slider_headline'.$i])).'</p>';
          }
          if ($options['slider_caption'.$i]) {
            echo '<p class="catchphrase rich_font">'.str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($options['slider_caption'.$i])).'</p>';
          }
?>
<?php     if ($options['show_slider_caption_button'.$i] == 1 && $url) { ?>
   <a class="button" href="<?php echo esc_url($url); ?>"<?php if ($target == 1) { echo ' target="_blank"'; } ?>><?php echo esc_html($options['slider_caption_button'.$i]); ?></a>
<?php     } elseif ($options['show_slider_caption_button'.$i] == 1) { ?>
   <div class="button"><?php echo esc_html($options['slider_caption_button'.$i]); ?></div>
<?php     } ?>
  </div><!-- END .caption -->
<?php
          $slider_caption = ob_get_clean();
        } else {
          $slider_caption = '';
        }

        // 画像
        if ($slider['content_type'] == 'type1' && !empty($slider['image'][0])) {
?>
 <div class="item item<?php echo $i; ?> item-<?php echo esc_attr($slider['content_type']); ?>" data-item="<?php echo $i; ?>">
<?php    echo $slider_caption; ?>
<?php    if ($url) { ?>
  <a class="overlay" href="<?php echo esc_url($url); ?>"<?php if ($target == 1) { echo ' target="_blank"'; } ?>>
   <span><img src="<?php echo esc_attr($slider['image'][0]); ?>" alt="" title="" /></span>
  </a>
<?php     } else { ?>
  <div class="overlay">
   <span><img src="<?php echo esc_attr($slider['image'][0]); ?>" alt="" title="" /></span>
  </div>
<?php     } ?>
 </div><!-- END .item -->
<?php

        // 動画
        } elseif ($slider['content_type'] == 'type2') {
          if (!wp_is_mobile() && !empty($slider['video'])) { // if is pc
?>
 <div class="item item<?php echo $i; ?> item-<?php echo esc_attr($slider['content_type']); ?>" data-item="<?php echo $i; ?>">
<?php       echo $slider_caption; ?>
<?php       if ($url) { ?>
  <a class="overlay" href="<?php echo esc_url($url); ?>"<?php if ($target == 1) { echo ' target="_blank"'; } ?>><span></span></a>
<?php       } else { ?>
  <div class="overlay"><span></span></div>
<?php       } ?>
  <div class="slider_video_wrapper">
   <div id="slider_video_<?php echo $i; ?>" class="slider_video_container slider_video"></div>
  </div>
 </div><!-- END .item -->
<?php
          } elseif (!empty($slider['image'][0])) { // if is mobile device
?>
 <div class="item item<?php echo $i; ?> item-<?php echo esc_attr($slider['content_type']); ?>" data-item="<?php echo $i; ?>">
<?php       echo $slider_caption; ?>
<?php       if ($url) { ?>
  <a class="overlay" href="<?php echo esc_url($url); ?>"<?php if ($target == 1) { echo ' target="_blank"'; } ?>>
   <span><img src="<?php echo esc_attr($slider['image'][0]); ?>" alt="" title="" /></span>
  </a>
<?php       } else { ?>
  <div class="overlay">
   <span><img src="<?php echo esc_attr($slider['image'][0]); ?>" alt="" title="" /></span>
  </div>
<?php       } ?>
 </div><!-- END .item -->
<?php
          }

        // youtube
        } elseif ($slider['content_type'] == 'type3') {
          if (!wp_is_mobile() && !empty($slider['youtube_url'])) { // if is pc
?>
 <div class="item item<?php echo $i; ?> item-<?php echo esc_attr($slider['content_type']); ?>" data-item="<?php echo $i; ?>">
<?php       echo $slider_caption; ?>
<?php       if ($url) { ?>
  <a class="overlay" href="<?php echo esc_url($url); ?>"<?php if ($target == 1) { echo ' target="_blank"'; } ?>><span></span></a>
<?php       } else { ?>
  <div class="overlay"><span></span></div>
<?php       } ?>
  <div class="slider_video_wrapper">
   <div id="slider_video_<?php echo $i; ?>" class="slider_video_container slider_youtube"></div>
   <div id="slider_youtube_<?php echo $i; ?>" class="player youtube_video_player" data-property="{videoURL:'<?php echo esc_attr($slider['youtube_url']); ?>',containment:'#slider_video_<?php echo $i; ?>',showControls:false,startAt:0,mute:false,autoPlay:<?php if (!empty($slider['first_slide'])) { echo 'true'; } else { echo 'false'; } ?>,loop:false,opacity:1,ratio:'16/9'}"></div>
  </div>
 </div><!-- END .item -->
<?php
          } elseif (!empty($slider['image'][0])) { // if is mobile device
?>
 <div class="item item<?php echo $i; ?> item-<?php echo esc_attr($slider['content_type']); ?>" data-item="<?php echo $i; ?>">
<?php       echo $slider_caption; ?>
<?php       if ($url) { ?>
  <a class="overlay" href="<?php echo esc_url($url); ?>"<?php if ($target == 1) { echo ' target="_blank"'; } ?>>
   <span><img src="<?php echo esc_attr($slider['image'][0]); ?>" alt="" title="" /></span>
  </a>
<?php       } else { ?>
  <div class="overlay">
   <span><img src="<?php echo esc_attr($slider['image'][0]); ?>" alt="" title="" /></span>
  </div>
<?php       } ?>
 </div><!-- END .item -->
<?php
          }
        }
      }
?>
</div><!-- END #header_slider -->
<?php endif; ?>

<div id="main_col" class="clearfix">

<?php
       if ($options['show_index_topics_content'] == 1) {
        $args = array('post_type' => array(), 'ignore_sticky_posts' => 1, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $options['index_topics_num']);
        if ($options['show_index_topics_news'] == 1) {
          $args['post_type'][] = 'news';
        }
        if ($options['show_index_topics_campaign'] == 1) {
          $args['post_type'][] = 'campaign';
        }
        if ($options['show_index_topics_blog'] == 1) {
          $args['post_type'][] = 'post';
        }

        if ($args['post_type']) {
          $post_list = get_posts($args);
          if ($post_list) {
?>
<div id="index_topics">
 <h2 class="headline"><?php echo esc_html($options['index_topics_headline']); ?></h2>
 <div class="newsticker">
  <ol class="newsticker-list">
<?php       foreach ($post_list as $post) : setup_postdata($post); ?>
   <li class="newsticker-item">
    <a href="<?php echo the_permalink(); ?>"><span><?php if ($options['show_date_index_topics']) { ?><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time><?php } ?><?php the_title(); ?></span></a>
   </li>
<?php     endforeach; wp_reset_postdata(); ?>
  </ol>
 </div>
</div>
<?php
          }
        }
      }
?>


<?php
      // content1 
      if ($options['show_index_content1'] == 1) {
        $index_content1_columns = 0;
        for ($i = 1; $i <= 3; $i++) {
          if ($options['index_content1_image'.$i]) {
            $image = wp_get_attachment_image_src($options['index_content1_image'.$i], 'full');
            if (!empty($image[0])) {
              $options['index_content1_image_src'.$i] = $image[0];
              $index_content1_columns++;
            }
          }
        }

        if ($index_content1_columns) {
?>
 <div id="index_content1" class="columns-<?php echo $index_content1_columns; ?>">
<?php
          for ($i = 1; $i <= 3; $i++) :
            if (!empty($options['index_content1_image_src'.$i])) {
?>

  <div class="box box<?php echo $i; ?>">
   <?php if ($options['index_content1_url'.$i]) { ?><a class="<?php if (!empty($options['index_content1_image_src'.$i])) { echo 'image'; } else { echo 'noimage'; } ?>" href="<?php echo esc_attr($options['index_content1_url'.$i]); ?>"<?php if (!empty($options['index_content1_target'.$i])) echo ' target="_blank"'; ?>><?php } else { ?><div class="<?php if (!empty($options['index_content1_image_src'.$i])) { echo 'image'; } else { echo 'noimage'; } ?>"><?php } ?>
    <?php if (!empty($options['index_content1_image_src'.$i])) { ?><img src="<?php echo esc_attr($options['index_content1_image_src'.$i]); ?>" title="" alt="" /><?php } ?>
    <?php if ($options['index_content1_headline'.$i] || $options['index_content1_desc'.$i]) { ?>
    <div class="caption">
     <?php if ($options['index_content1_headline'.$i]) { ?><h2 class="headline"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($options['index_content1_headline'.$i])); ?></h2><?php } ?>
     <?php if ($options['index_content1_desc'.$i]) { ?>
     <div class="desc">
      <?php echo wpautop($options['index_content1_desc'.$i]); ?>
     </div>
     <?php } ?>
    </div>
    <?php } ?>
   <?php if ($options['index_content1_url'.$i]) { ?></a><?php } else { ?></div><?php } ?>
  </div>

<?php
            }
          endfor;
        }
?>
 </div><!-- END #index_content1 -->
<?php } ?>


<?php
      // content2
      if ($options['show_index_content2'] == 1 && $options['index_content2_headline'] && $options['index_content2_desc']) {
?>
 <div id="index_content2">
  <?php if ($options['index_content2_headline']) { ?><h2 class="headline rich_font" ><?php echo str_replace(array("\r\n", "\r", "\n"), '<br />', esc_html($options['index_content2_headline'])); ?></h2><?php } ?>
  <?php if ($options['index_content2_desc']) { ?><div class="desc"><?php echo wpautop($options['index_content2_desc']); ?></div><?php } ?>
 </div><!-- END #index_content2 -->
<?php } ?>
<?php
      // course content 
      if ($options['show_index_course_content'] == 1) {
        $args = array('post_type' => 'course', 'ignore_sticky_posts' => 1, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => -1, 'meta_key' => 'banner_show_front_page', 'meta_value_num' => 1);
        $post_list = get_posts($args);
        if ($post_list) {
?>
 <div id="index_course">
  <ol>
<?php
          foreach ($post_list as $post) :
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
?>

   <li class="course">
    <a class="image" href="<?php the_permalink() ?>" title="<?php echo esc_attr($banner_title); ?>">
     <img src="<?php echo esc_attr($banner_image_src); ?>" alt="" />
     <div class="caption"><span class="caption_hover_slide"><?php echo esc_html($banner_title); ?></span></div>
    </a>
   </li>

<?php
          endforeach;
?>
  </ol>
 </div><!-- END #index_course -->
<?php
        }
      }
?>


<?php
      // news/campaign content
      if ($options['show_index_news_content'] == 1 || $options['show_index_campaign_content'] == 1) {
?>
 <div id="index_news"<?php if ($options['show_index_news_content'] == 1 && $options['show_index_campaign_content'] == 1) echo ' class="columns-2"'; ?>>

<?php   if ($options['show_index_news_content'] == 1) { ?>
  <div class="index_news index_news_news">
   <h2 class="headline headline_bg_l"><?php echo esc_html($options['index_news_headline']); ?><?php if ($options['show_index_news_button']) { ?><a href="<?php echo get_post_type_archive_link('news'); ?>"><?php echo esc_html($options['index_news_button']); ?></a><?php } ?></h2>

<?php
          $args = array('post_type' => 'news', 'ignore_sticky_posts' => 1, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $options['index_news_num']);
          $post_list = get_posts($args);
          if ($post_list) {
?>
   <ol>

<?php       foreach ($post_list as $post) : setup_postdata($post); ?>

    <li<?php if (!$options['show_date_news']){ echo ' class="no_date"'; } ?>>
    <?php if ($options['show_date_news']){ ?><p class="date"><?php the_time('Y.m.d'); ?></p><?php } ?>
     <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </li>

<?php       endforeach; wp_reset_postdata(); ?>
   </ol>
<?php     } ?>

  </div>
<?php   } ?>

<?php   if ($options['show_index_campaign_content'] == 1) { ?>
  <div class="index_news index_news_campaign">
   <h2 class="headline headline_bg_l"><?php echo esc_html($options['index_campaign_headline']); ?><?php if ($options['show_index_campaign_button']) { ?><a href="<?php echo get_post_type_archive_link('campaign'); ?>"><?php echo esc_html($options['index_campaign_button']); ?></a><?php } ?></h2>

<?php
          $args = array('post_type' => 'campaign', 'ignore_sticky_posts' => 1, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $options['index_campaign_num']);
          $post_list = get_posts($args);
          if ($post_list) {
?>
   <ol>

<?php       foreach ($post_list as $post) : setup_postdata($post); ?>

    <li<?php if (!$options['show_date_campaign']){ echo ' class="no_date"'; } ?>>
     <?php if ($options['show_date_campaign']){ ?><p class="date"><?php the_time('Y.m.d'); ?></p><?php } ?>
     <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </li>

<?php       endforeach; wp_reset_postdata(); ?>
   </ol>
<?php     } ?>

  </div>
<?php   } ?>

 </div><!-- END #index_news -->
<?php } ?>


<?php
      // voice content
      if ($options['show_index_voice_content'] == 1) {
?>
 <div id="index_voice">
   <h2 class="headline headline_bg_l">
    <?php echo esc_html($options['index_voice_headline']); ?>
    <span><?php echo esc_html($options['index_voice_headline_sub']); ?></span>
<?php   if ($options['show_index_voice_button'] == 1) { ?>
    <a href="<?php echo get_post_type_archive_link('voice'); ?>"><?php echo esc_html($options['index_voice_button']); ?></a>
<?php   } ?>
   </h2>
<?php
        $args = array('post_type' => 'voice', 'ignore_sticky_posts' => 1, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $options['index_voice_num']);
        $post_list = get_posts($args);
        if ($post_list) {
?>
   <ol>

<?php     foreach ($post_list as $post) : setup_postdata($post); ?>

    <li class="clearfix<?php if (has_post_thumbnail()) echo ' has_post_thumbnail'; ?>">
     <a href="<?php
       if (get_post_meta($post->ID, 'archive_button', true)) {
         the_permalink();
       } else {
         echo get_post_type_archive_link('voice');
       }
     ?>">
      <?php if (has_post_thumbnail()) { ?><div class="image"><?php the_post_thumbnail('size1'); ?></div><?php } ?>
      <div class="info">
       <?php
         $voice_user = get_post_meta($post->ID, 'voice_user', true);
         $voice_user_info = get_post_meta($post->ID, 'voice_user_info', true);
         $desc = trim(get_post_meta($post->ID, 'desc', true));
         if ($voice_user && $voice_user_info) {
           echo '<h3 class="voice_name">'.esc_html($voice_user).'<span>('.esc_html($voice_user_info).')</span></h3>'."\n";
         } elseif ($voice_user) {
           echo '<h3 class="voice_name">'.esc_html($voice_user).'</h3>'."\n";
         } elseif ($voice_user_info) {
           echo '<h3 class="voice_name">'.esc_html($voice_user_info).'</h3>'."\n";
         }
         if ($desc) {
           echo '<p>'.esc_html(mb_strimwidth(str_replace(array("\r\n", "\r", "\n"), ' ', $desc), 0, 158, '…')).'</p>'."\n";
         }
       ?>
      </div>
     </a>
    </li>

<?php       endforeach; wp_reset_postdata(); ?>
   </ol>
<?php     } ?>
 </div><!-- END #index_voice -->
<?php } ?>

<?php
      // blog content
      if ($options['show_index_blog_content'] == 1) {
?>
 <div id="index_blog">
  <h2 class="headline clearfix">
   <?php echo esc_html($options['index_blog_headline']); ?>
<?php   if ($options['show_index_blog_button'] == 1 && get_option('page_for_posts')) { ?>
   <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="index_blog_button headline_bg"><span><?php echo esc_html($options['index_blog_button']); ?></span></a>
<?php   } ?>
  </h2>
<?php
        $args = array('post_type' => 'post', 'ignore_sticky_posts' => 1, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $options['index_blog_num']);
        $post_list = get_posts($args);
        if ($post_list) {
?>
  <ol id="index_blog_list" class="clearfix">
<?php
          foreach ($post_list as $post) :
            setup_postdata($post);

            if ($options['show_category']) {
              $category = false;
              if (is_category()) {
                $category = get_queried_object();
              } else {
                $categories = get_the_category();
                if ($categories) {
                  $category = array_shift($categories);
                }
              }
              if (!empty($category->term_id)) {
                // カテゴリーカラー
                $cat_meta = get_option('taxonomy_'.$category->term_id);
                if (!empty($cat_meta['category_color'])) {
                  $category_color = ' style="background-color:#'.$cat_meta['category_color'].';"';
                } else {
                  $category_color = '';
                }
              }
            }
?>

   <li>
    <a href="<?php the_permalink() ?>">
     <div class="image">
      <?php if (has_post_thumbnail()) { the_post_thumbnail('size4'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.gif" alt="" title="" />'; } ?>
     </div>
     <div class="info">
      <h3 class="title"><?php trim_title(38); ?></h3>
      <?php if ($options['show_date'] || $options['show_category']){ ?>
      <ul class="meta clearfix">
       <?php if ($options['show_category']) { ?><li class="category"><span title="<?php echo esc_attr($category->name); ?>" data-href="<?php echo get_category_link($category->term_id); ?>"<?php echo $category_color; ?>><?php echo esc_html($category->name); ?></span></li><?php } ?>
       <?php if ($options['show_date']){ ?><li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li><?php } ?>
      </ul>
      <?php } ?>
     </div>
    </a>
   </li>

<?php     endforeach; wp_reset_postdata(); ?>
  </ol>
<?php   } ?>

 </div><!-- END #index_blog -->
<?php } ?>

<?php
      // 営業日コンテンツ
      if ( $options['show_index_business_day'] == 1 &&
        $options['index_business_day_postid'] &&
        $options['index_business_day_num'] &&
        function_exists( 'page_builder_widget_business_day_sctipts_styles' ) &&
        function_exists( 'the_page_builder_business_day' )
      ) {
?>
 <div id="index_business_day">
<?php
        the_page_builder_business_day($options['index_business_day_postid'], $options['index_business_day_num']);
?>
 </div><!-- END #index_business_day -->
<?php } ?>

</div><!-- END #main_col -->

<?php get_footer(); ?>

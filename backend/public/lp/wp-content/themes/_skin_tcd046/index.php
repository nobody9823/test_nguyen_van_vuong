<?php
     get_header();
     $options = get_desing_plus_option();
?>

<?php get_template_part('breadcrumb'); ?>

<div id="main_col">

 <div id="left_col">

  <?php if (is_category()) { ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php echo single_cat_title('', false); ?></h2>

  <?php } elseif(is_tag()) { ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php echo single_tag_title('', false); ?></h2>

  <?php } elseif (is_search()) { ?>
  <?php if ( have_posts() ) : ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php printf(__('Search results for - %s', 'tcd-w'), get_search_query()); ?></h2>
  <?php else: ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php _e('Search result','tcd-w'); ?></h2>
  <?php endif; ?>

  <?php } elseif (is_day()) { ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php printf(__('Archive for &#8216; %s &#8217;', 'tcd-w'), get_the_time(__('F jS, Y', 'tcd-w'))); ?></h2>

  <?php } elseif (is_month()) { ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php printf(__('Archive for &#8216; %s &#8217;', 'tcd-w'), get_the_time(__('F, Y', 'tcd-w'))); ?></h2>

  <?php } elseif (is_year()) { ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php printf(__('Archive for &#8216; %s &#8217;', 'tcd-w'), get_the_time(__('Y', 'tcd-w'))); ?></h2>

  <?php } elseif (is_author()) { ?>
  <?php global $wp_query; $curauth = $wp_query->get_queried_object(); //get the author info ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php printf(__('Archive for the &#8216; %s &#8217;', 'tcd-w'), $curauth->display_name ); ?></h2>

  <?php } elseif(is_home()) { ?>
  <h2 id="archive_headline" class="headline headline_bg_l"><?php
    if ($options['blog_archive_headline'] && $options['blog_archive_headline_sub']) {
      echo esc_html($options['blog_archive_headline']);
      echo '<span>'.esc_html($options['blog_archive_headline_sub']).'</span>';
    } elseif ($options['blog_archive_headline_sub']) {
      echo esc_html($options['blog_archive_headline_sub']);
    } else {
      echo esc_html($options['blog_archive_headline']);
    }
  ?></h2>

  <?php }; ?>

  <div id="archive_wrapper">
   <?php if ( have_posts() ) : ?>
   <ol id="post_list">
    <?php while ( have_posts() ) : the_post(); ?>
    <li class="article">
     <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      <div class="image">
       <?php if(has_post_thumbnail()) { the_post_thumbnail('size4'); } else { ?><img src="<?php echo bloginfo('template_url'); ?>/img/common/no_image4.gif" title="" alt="" /><?php }; ?>
      </div>
      <div class="info">
       <h3 class="title"><?php trim_title(38); ?></h3>
       <?php if ($options['show_date'] || $options['show_category']){ ?>
       <ul class="meta clearfix">
        <?php
          if (has_category() && $options['show_category']) {
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

              echo '<li class="category">';
              echo '<span title="'.esc_attr($category->name).'" data-href="'.get_category_link($category->term_id).'"'.$category_color.'>'.esc_html($category->name).'</span>';
              echo '</li>';
            }
          }
        ?>
        <?php if ($options['show_date']){ ?><li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li><?php }; ?>
       </ul>
       <?php }; ?>
      </div>
     </a>
    </li>
    <?php endwhile; ?>
   </ol><!-- END #post_list -->
   <?php else: ?>
   <p class="no_post"><?php _e('There is no registered post.','tcd-w'); ?></p>
   <?php endif; ?>

   <?php get_template_part('navigation'); ?>

 </div><!-- END #left_col -->

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
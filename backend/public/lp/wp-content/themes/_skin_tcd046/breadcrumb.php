<?php
$options = get_desing_plus_option();

$bread_crumb_blog = '<li>'.$options['blog_breadcrumb_headline'].'</li>';
if (get_option('show_on_front') == 'page' && get_option('page_for_posts')) {
  $bread_crumb_blog_post = get_post(get_option('page_for_posts'));
  if (!empty($bread_crumb_blog_post->post_status) && $bread_crumb_blog_post->post_status == 'publish') {
    $bread_crumb_blog = '<li><a href="'.get_permalink($bread_crumb_blog_post).'">'.esc_html($options['blog_breadcrumb_headline']).'</a></li>';
  }
}
?>
<div id="bread_crumb">

<ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1" /></li>

<?php if(is_post_type_archive('news')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo esc_html($options['news_breadcrumb_headline']); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_post_type_archive('campaign')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo esc_html($options['campaign_breadcrumb_headline']); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_post_type_archive('course')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo esc_html($options['course_breadcrumb_headline']); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_post_type_archive('voice')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo esc_html($options['voice_breadcrumb_headline']); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_post_type_archive('staff')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo esc_html($options['staff_breadcrumb_headline']); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_tax('course_category')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_post_type_archive_link('course'); ?>"><span itemprop="name"><?php echo esc_html($options['course_breadcrumb_headline']); ?></span></a><meta itemprop="position" content="2" /></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo single_cat_title('', false); ?></span><meta itemprop="position" content="3" /></li>

<?php } elseif (is_category()) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_permalink( get_option('page_for_posts') ); ?>"><span itemprop="name"><?php echo esc_html($options['blog_breadcrumb_headline']) ?></span></a><meta itemprop="position" content="2" /></li>
 <?php $cat = get_queried_object(); ?>
 <?php if($cat -> parent != 0): ?>
 <?php $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' )); ?>
 <?php foreach($ancestors as $ancestor): ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_category_link($ancestor); ?>"><span itemprop="name"><?php echo get_cat_name($ancestor); ?></span></a><meta itemprop="position" content="3" /></li>
 <?php endforeach; ?>
 <?php endif; ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo $cat -> cat_name; ?></span><meta itemprop="position" content="4" /></li>

<?php } elseif(is_tag()) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo single_tag_title('', false); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_day()) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo get_the_time(__('F jS, Y', 'tcd-w')); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_month()) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo get_the_time(__('F, Y', 'tcd-w')); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_year()) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo get_the_time(__('Y', 'tcd-w')); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_author()) { global $wp_query; $curauth = $wp_query->get_queried_object(); //get the author info ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo $curauth->display_name; ?></span><meta itemprop="position" content="2" /></li>

<?php
      } elseif(is_home()) {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php echo esc_html($options['blog_breadcrumb_headline']); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_search()) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php _e("Search Result","tcd-w"); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_404()) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php _e("Sorry, but you are looking for something that isn't here.","tcd-w"); ?></span><meta itemprop="position" content="2" /></li>

<?php } elseif(is_singular('news')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_post_type_archive_link('news'); ?>"><span itemprop="name"><?php echo esc_html($options['news_breadcrumb_headline']); ?></span></a><meta itemprop="position" content="2" /></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php the_title(); ?></span><meta itemprop="position" content="3" /></li>

<?php } elseif(is_singular('campaign')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_post_type_archive_link('campaign'); ?>"><span itemprop="name"><?php echo esc_html($options['campaign_breadcrumb_headline']); ?></span></a><meta itemprop="position" content="2" /></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php the_title(); ?></span><meta itemprop="position" content="3" /></li>

<?php } elseif(is_singular('course')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_post_type_archive_link('course'); ?>"><span itemprop="name"><?php echo esc_html($options['course_breadcrumb_headline']); ?></span></a><meta itemprop="position" content="2" /></li>
 <?php echo get_the_term_list( get_the_ID(), 'course_category', '<li>', ', ', '</li>' ); ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php the_title(); ?></span><meta itemprop="position" content="3" /></li>

<?php } elseif(is_singular('voice')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_post_type_archive_link('voice'); ?>"><span itemprop="name"><?php echo esc_html($options['voice_breadcrumb_headline']); ?></span></a><meta itemprop="position" content="2" /></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php the_title(); ?></span><meta itemprop="position" content="3" /></li>

<?php } elseif(is_singular('staff')) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_post_type_archive_link('staff'); ?>"><span itemprop="name"><?php echo esc_html($options['staff_breadcrumb_headline']); ?></span></a><meta itemprop="position" content="2" /></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php the_title(); ?></span><meta itemprop="position" content="3" /></li>

<?php
      } elseif(is_single()) {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_permalink( get_option('page_for_posts') ); ?>"><span itemprop="name"><?php echo esc_html($options['blog_breadcrumb_headline']) ?></span></a><meta itemprop="position" content="2" /></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
  <?php
    $categories=get_the_category();
    $count=1;
    foreach ($categories as $category) {
  ?>
  <a itemprop="item" href="<?php echo get_category_link($category->term_id) ?>"><span itemprop="name"><?php echo $category->name ?></span><?php if($count!=count($categories)) echo ',' ?></a>
  <?php $count++; ?>
  <?php } ?>
 <meta itemprop="position" content="3" /></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php the_title(); ?></span><meta itemprop="position" content="4" /></li>

<?php } elseif(is_page()) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="last"><span itemprop="name"><?php the_title(); ?></span><meta itemprop="position" content="2" /></li>

<?php }; ?>
</ul>
</div>

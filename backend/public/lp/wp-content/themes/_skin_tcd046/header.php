<?php $options = get_desing_plus_option(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="description" content="<?php seo_description(); ?>">
<?php if($options['use_ogp']) { ogp(); }; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php if ( $options['favicon'] ) : ?>
<link rel="shortcut icon" href="<?php echo $options['favicon']; ?>">
<?php endif; ?>
<?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all'); wp_enqueue_script( 'jquery' ); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>

<?php if ($options['use_load_icon']) { ?>
<div id="site_loader_overlay">
 <div id="site_loader_animation">
<?php   if ($options['load_icon'] == 'type3') { ?>
  <i></i><i></i><i></i><i></i>
<?php   } ?>
 </div>
</div>
<div id="site_wrap">
<?php } ?>

 <div id="header" class="clearfix">
  <div class="header_inner">
   <div id="header_logo">
    <?php header_logo(); header_logo_fix(); ?>
   </div>

   <?php if (has_nav_menu('global-menu')) { ?>
   <a href="#" class="menu_button"><span><?php _e('menu', 'tcd-w'); ?></span></a>
   <div id="global_menu">
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
   </div>
   <?php }; ?>
  </div>
 </div><!-- END #header -->

 <div id="main_contents" class="clearfix">


<?php
function og_image($n) {
	global $post;
	$options = get_desing_plus_option();
	$myArray = array();
	if ( is_single() && has_post_thumbnail()) {
		$post_thumbnail_id = get_post_thumbnail_id($post->ID);
		$image = wp_get_attachment_image_src( $post_thumbnail_id, 'full');
		list($myArray[0], $myArray[1], $myArray[2]) = $image;
		echo esc_attr($myArray[$n]);
	} else {
		if($options['ogp_image']){
			$image = wp_get_attachment_image_src( $options['ogp_image'], 'full');
			list($myArray[0], $myArray[1], $myArray[2]) = $image;
			echo esc_attr($myArray[$n]);
		}else{
			$myArray[0] = get_bloginfo('template_url') . '/img/common/no_image2.gif';
			$myArray[1] = 380;
			$myArray[2] = 230;
			echo esc_attr($myArray[$n]);
		}
	};
}
function twitter_image() {
	global $post;
	$options = get_desing_plus_option();
	if ( is_single() && has_post_thumbnail()) {
		$post_thumbnail_id = get_post_thumbnail_id($post->ID);
		$image = wp_get_attachment_image_src( $post_thumbnail_id, 'size2');
		list($src, $width, $height) = $image;
		echo esc_attr($src);
	} else {
		if($options['ogp_image']){
			$image = wp_get_attachment_image_src( $options['ogp_image'], 'size2');
			list($src, $width, $height) = $image;
			echo esc_attr($src);
		}else{
			echo get_bloginfo('template_url') . '/img/common/no_image2.gif';
		}
	};
}
?>
<?php
function ogp() {
 $options = get_desing_plus_option();
 global $post;
?>
<?php if(is_singular()) { ?>
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http' ) . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>">
<?php if(is_front_page()){ ?>
<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
<?php }else{ ?>
<meta property="og:title" content="<?php the_title(); ?>" />
<?php }; ?>
<meta property="og:description" content="<?php seo_description(); ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<meta property="og:image" content='<?php og_image(0); ?>'>
<meta property="og:image:secure_url" content="<?php og_image(0); ?>" /> 
<meta property="og:image:width" content="<?php og_image(1); ?>" /> 
<meta property="og:image:height" content="<?php og_image(2); ?>" />
<?php if($options['fb_app_id']) { ?>
<meta property="fb:app_id" content="<?php echo esc_attr( $options['fb_app_id'] ); ?>">
<?php }; ?>
<?php if($options['use_twitter_card']) { ?>
<meta name="twitter:card" content="summary" />
<?php if($options['twitter_account_name']) { ?>
<meta name="twitter:site" content="@<?php echo $options['twitter_account_name']; ?>" />
<?php }; ?>
<?php if($options['twitter_account_name']) { ?>
<meta name="twitter:creator" content="@<?php echo $options['twitter_account_name']; ?>" />
<?php }; ?>
<meta name="twitter:title" content="<?php the_title(); ?>" />
<meta name="twitter:description" content="<?php seo_description(); ?>" />
<meta name="twitter:image:src" content='<?php twitter_image(); ?>' />
<?php }; ?>
<?php }else{ ?>
<meta property="og:type" content="blog" />
<meta property="og:url" content="<?php echo ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http' ) . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>">
<?php if(is_home()){ ?>
<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
<?php }elseif(is_post_type_archive('course')){ ?>
<meta property="og:title" content="<?php echo $options['course_breadcrumb_headline'] . ' | ' .get_bloginfo('name'); ?>" />
<?php }elseif(is_post_type_archive('news')){ ?>
<meta property="og:title" content="<?php echo $options['news_breadcrumb_headline'] . ' | ' .get_bloginfo('name'); ?>" />
<?php }elseif(is_post_type_archive('campaign')){ ?>
<meta property="og:title" content="<?php echo $options['campaign_breadcrumb_headline'] . ' | ' .get_bloginfo('name'); ?>" />
<?php }elseif(is_post_type_archive('voice')){ ?>
<meta property="og:title" content="<?php echo $options['voice_breadcrumb_headline'] . ' | ' .get_bloginfo('name'); ?>" />
<?php }elseif(is_post_type_archive('staff')){ ?>
<meta property="og:title" content="<?php echo $options['staff_breadcrumb_headline'] . ' | ' .get_bloginfo('name'); ?>" />
<?php }elseif(is_archive()){ ?>
<meta property="og:title" content="<?php echo get_the_archive_title(); ?>" />
<?php }else{ ?>
<meta property="og:title" content="<?php the_title(); ?>" />
<?php }; ?>
<meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<meta property="og:image" content='<?php og_image(0); ?>'>
<meta property="og:image:secure_url" content="<?php og_image(0); ?>" /> 
<meta property="og:image:width" content="<?php og_image(1); ?>" /> 
<meta property="og:image:height" content="<?php og_image(2); ?>" />
<?php if($options['fb_app_id']) { ?>
<meta property="fb:app_id" content="<?php echo esc_attr( $options['fb_app_id'] ); ?>">
<?php }; ?>
<?php if($options['use_twitter_card']) { ?>
<meta name="twitter:card" content="summary" />
<?php if($options['twitter_account_name']) { ?>
<meta name="twitter:site" content="@<?php echo $options['twitter_account_name']; ?>" />
<?php }; ?>
<?php if($options['twitter_account_name']) { ?>
<meta name="twitter:creator" content="@<?php echo $options['twitter_account_name']; ?>" />
<?php }; ?>
<meta name="twitter:title" content="<?php echo get_bloginfo('name'); ?>" />
<meta name="twitter:description" content="<?php echo get_bloginfo('description'); ?>" />
<?php }; ?>
<?php }; ?>
<?php }; ?>

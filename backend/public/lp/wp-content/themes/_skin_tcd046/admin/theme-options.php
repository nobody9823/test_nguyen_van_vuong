<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * オプション初期値
 * @var array 
 */
global $dp_default_options;
$dp_default_options = array(
//basic
	'pickedcolor1' => 'E3D0C3',
	'pickedcolor2' => 'C2AA99',
	'pickedcolor3' => 'E8CAB7',
	'content_link_color' => 'C2AA99',
	'favicon' => '',
	'font_type' => 'type1',
	'headline_font_type' => 'type3',
	'hover_type' => 'type1',
	'hover1_zoom' => '1.2',
	'hover2_direct' => 'type1',
	'hover2_opacity' => '0.5',
	'hover2_bgcolor' => 'C2AA99',
	'hover3_opacity' => '0.5',
	'hover3_bgcolor' => 'C2AA99',
	'responsive' => 'yes',
	'use_emoji' => 1,
	'css_code' => '',
	'custom_head' => '',
	'use_ogp' => 0,
	'fb_admin_id' => '',
	'fb_app_id' => '',
	'ogp_image' => '',
	'use_twitter_card' => 0,
	'twitter_account_name' => '',
	'column_float' => 0,
	'use_load_icon' => '',
	'load_time' => '3000',
	'load_icon' => 'type1',
	'header_image_404' => '',
	'header_txt_404' => '',
	'header_sub_txt_404' => '',
	'header_txt_size_404' => 38,
	'header_sub_txt_size_404' => 16,
	'header_txt_size_404_mobile' => 28,
	'header_sub_txt_size_404_mobile' => 14,
	'header_txt_color_404' => 'FFFFFF',
	'dropshadow_404_h' => 2,
	'dropshadow_404_v' => 2,
	'dropshadow_404_b' => 2,
	'dropshadow_404_c' => '888888',

  // Google Map
	'gmap_api_key' => '',
	'gmap_marker_type' => 'type1',
	'gmap_custom_marker_type' => 'type1',
	'gmap_marker_text' => '',
	'gmap_marker_color' => '#ffffff',
	'gmap_marker_img' => '',
	'gmap_marker_bg' => '#000000',

//logo
	'logo_font_size' => 24,
	'logo_font_size_fix' => 20,
	'logo_font_size_mobile' => 18,
	'logo_font_size_mobile_fix' => 18,
	'logo_font_size_footer' => 24,
	'header_logo_image' => false,
	'header_logo_image_fix' => false,
	'header_logo_image_mobile' => false,
	'header_logo_image_mobile_fix' => false,
	'footer_logo_image' => false,
	'header_logo_retina' => '',
	'header_logo_retina_fix' => '',
	'header_logo_retina_mobile' => '',
	'header_logo_retina_mobile_fix' => '',
	'footer_logo_retina' => '',
// index header slider
	'show_index_slider' => 0,
	'slider_content_type1' => 'type1',
	'slider_content_type2' => 'type1',
	'slider_content_type3' => 'type1',
	'slider_content_type4' => 'type1',
	'slider_content_type5' => 'type1',
	'slider_image1' => false,
	'slider_image2' => false,
	'slider_image3' => false,
	'slider_image4' => false,
	'slider_image5' => false,
	'slider_image_mobile1' => false,
	'slider_image_mobile2' => false,
	'slider_image_mobile3' => false,
	'slider_image_mobile4' => false,
	'slider_image_mobile5' => false,
	'slider_url1' => '',
	'slider_url2' => '',
	'slider_url3' => '',
	'slider_url4' => '',
	'slider_url5' => '',
	'slider_target1' => '',
	'slider_target2' => '',
	'slider_target3' => '',
	'slider_target4' => '',
	'slider_target5' => '',
	'use_slider_overlay1' => '',
	'use_slider_overlay2' => '',
	'use_slider_overlay3' => '',
	'use_slider_overlay4' => '',
	'use_slider_overlay5' => '',
	'slider_overlay1' => 'FFFFFF',
	'slider_overlay2' => 'FFFFFF',
	'slider_overlay3' => 'FFFFFF',
	'slider_overlay4' => 'FFFFFF',
	'slider_overlay5' => 'FFFFFF',
	'slider_overlay_opacity1' => '0.5',
	'slider_overlay_opacity2' => '0.5',
	'slider_overlay_opacity3' => '0.5',
	'slider_overlay_opacity4' => '0.5',
	'slider_overlay_opacity5' => '0.5',
	'use_slider_caption1' => '',
	'use_slider_caption2' => '',
	'use_slider_caption3' => '',
	'use_slider_caption4' => '',
	'use_slider_caption5' => '',
	'slider_headline1' => '',
	'slider_headline2' => '',
	'slider_headline3' => '',
	'slider_headline4' => '',
	'slider_headline5' => '',
	'slider_headline_font_size1' => '38',
	'slider_headline_font_size2' => '38',
	'slider_headline_font_size3' => '38',
	'slider_headline_font_size4' => '38',
	'slider_headline_font_size5' => '38',
	'slider_headline_font_size_mobile1' => '28',
	'slider_headline_font_size_mobile2' => '28',
	'slider_headline_font_size_mobile3' => '28',
	'slider_headline_font_size_mobile4' => '28',
	'slider_headline_font_size_mobile5' => '28',
	'slider_headline_color1' => '000000',
	'slider_headline_color2' => '000000',
	'slider_headline_color3' => '000000',
	'slider_headline_color4' => '000000',
	'slider_headline_color5' => '000000',
	'slider_headline_shadow_a1' => 0,
	'slider_headline_shadow_b1' => 0,
	'slider_headline_shadow_c1' => 4,
	'slider_headline_shadow_a2' => 0,
	'slider_headline_shadow_b2' => 0,
	'slider_headline_shadow_c2' => 4,
	'slider_headline_shadow_a3' => 0,
	'slider_headline_shadow_b3' => 0,
	'slider_headline_shadow_c3' => 4,
	'slider_headline_shadow_a4' => 0,
	'slider_headline_shadow_b4' => 0,
	'slider_headline_shadow_c4' => 4,
	'slider_headline_shadow_a5' => 0,
	'slider_headline_shadow_b5' => 0,
	'slider_headline_shadow_c5' => 4,
	'slider_headline_shadow_color1' => 'FFFFFF',
	'slider_headline_shadow_color2' => 'FFFFFF',
	'slider_headline_shadow_color3' => 'FFFFFF',
	'slider_headline_shadow_color4' => 'FFFFFF',
	'slider_headline_shadow_color5' => 'FFFFFF',
	'slider_caption1' => '',
	'slider_caption2' => '',
	'slider_caption3' => '',
	'slider_caption4' => '',
	'slider_caption5' => '',
	'slider_caption_font_size1' => '22',
	'slider_caption_font_size2' => '22',
	'slider_caption_font_size3' => '22',
	'slider_caption_font_size4' => '22',
	'slider_caption_font_size5' => '22',
	'slider_caption_font_size_mobile1' => '20',
	'slider_caption_font_size_mobile2' => '20',
	'slider_caption_font_size_mobile3' => '20',
	'slider_caption_font_size_mobile4' => '20',
	'slider_caption_font_size_mobile5' => '20',
	'slider_caption_color1' => '000000',
	'slider_caption_color2' => '000000',
	'slider_caption_color3' => '000000',
	'slider_caption_color4' => '000000',
	'slider_caption_color5' => '000000',
	'slider_caption_shadow_a1' => 0,
	'slider_caption_shadow_b1' => 0,
	'slider_caption_shadow_c1' => 4,
	'slider_caption_shadow_a2' => 0,
	'slider_caption_shadow_b2' => 0,
	'slider_caption_shadow_c2' => 4,
	'slider_caption_shadow_a3' => 0,
	'slider_caption_shadow_b3' => 0,
	'slider_caption_shadow_c3' => 4,
	'slider_caption_shadow_a4' => 0,
	'slider_caption_shadow_b4' => 0,
	'slider_caption_shadow_c4' => 4,
	'slider_caption_shadow_a5' => 0,
	'slider_caption_shadow_b5' => 0,
	'slider_caption_shadow_c5' => 4,
	'slider_caption_shadow_color1' => 'FFFFFF',
	'slider_caption_shadow_color2' => 'FFFFFF',
	'slider_caption_shadow_color3' => 'FFFFFF',
	'slider_caption_shadow_color4' => 'FFFFFF',
	'slider_caption_shadow_color5' => 'FFFFFF',
	'show_slider_caption_button1' => '',
	'show_slider_caption_button2' => '',
	'show_slider_caption_button3' => '',
	'show_slider_caption_button4' => '',
	'show_slider_caption_button5' => '',
	'slider_caption_button1' => '',
	'slider_caption_button2' => '',
	'slider_caption_button3' => '',
	'slider_caption_button4' => '',
	'slider_caption_button5' => '',
	'slider_button_color1' => '000000',
	'slider_button_color2' => '000000',
	'slider_button_color3' => '000000',
 	'slider_button_color4' => '000000',
 	'slider_button_color5' => '000000',
	'slider_button_bg_color1' => 'FFFFFF',
	'slider_button_bg_color2' => 'FFFFFF',
	'slider_button_bg_color3' => 'FFFFFF',
	'slider_button_bg_color4' => 'FFFFFF',
	'slider_button_bg_color5' => 'FFFFFF',
	'slider_button_bg_opaciry1' => '0.8',
	'slider_button_bg_opaciry2' => '0.8',
	'slider_button_bg_opaciry3' => '0.8',
	'slider_button_bg_opaciry4' => '0.8',
	'slider_button_bg_opaciry5' => '0.8',
	'slider_button_border_color1' => '000000',
	'slider_button_border_color2' => '000000',
	'slider_button_border_color3' => '000000',
	'slider_button_border_color4' => '000000',
	'slider_button_border_color5' => '000000',
	'slider_button_color_hover1' => 'FFFFFF',
	'slider_button_color_hover2' => 'FFFFFF',
	'slider_button_color_hover3' => 'FFFFFF',
	'slider_button_color_hover4' => 'FFFFFF',
	'slider_button_color_hover5' => 'FFFFFF',
	'slider_button_bg_color_hover1' => '000000',
	'slider_button_bg_color_hover2' => '000000',
	'slider_button_bg_color_hover3' => '000000',
	'slider_button_bg_color_hover4' => '000000',
	'slider_button_bg_color_hover5' => '000000',
	'slider_button_bg_opaciry_hover1' => '0.8',
	'slider_button_bg_opaciry_hover2' => '0.8',
	'slider_button_bg_opaciry_hover3' => '0.8',
	'slider_button_bg_opaciry_hover4' => '0.8',
	'slider_button_bg_opaciry_hover5' => '0.8',
	'slider_button_border_color_hover1' => '000000',
	'slider_button_border_color_hover2' => '000000',
	'slider_button_border_color_hover3' => '000000',
	'slider_button_border_color_hover4' => '000000',
	'slider_button_border_color_hover5' => '000000',
	'slider_video1' => '',
	'slider_video2' => '',
	'slider_video3' => '',
	'slider_video4' => '',
	'slider_video5' => '',
	'slider_video_image1' => '',
	'slider_video_image2' => '',
	'slider_video_image3' => '',
	'slider_video_image4' => '',
	'slider_video_image5' => '',
	'slider_youtube_url1' => '',
	'slider_youtube_url2' => '',
	'slider_youtube_url3' => '',
	'slider_youtube_url4' => '',
	'slider_youtube_url5' => '',
	'slider_youtube_image1' => '',
	'slider_youtube_image2' => '',
	'slider_youtube_image3' => '',
	'slider_youtube_image4' => '',
	'slider_youtube_image5' => '',
	'slider_time' => '7000',
// index topics
	'show_index_topics_content' => 0,
	'index_topics_headline' => __('Topics', 'tcd-w'),
	'show_date_index_topics' => 0,
	'show_index_topics_news' => 1,
	'show_index_topics_campaign' => 0,
	'show_index_topics_blog' => 0,
	'index_topics_num' => 5,
	'index_topics_bg_opacity' => '0.8',
// index content1
	'show_index_content1' => 0,
	'index_content1_headline1' => '',
	'index_content1_headline_font_size1' => '26',
	'index_content1_desc1' => '',
	'index_content1_desc_font_size1' => '14',
	'index_content1_image1' => false,
	'index_content1_url1' => '',
	'index_content1_target1' => '',
	'index_content1_headline2' => '',
	'index_content1_headline_font_size2' => '26',
	'index_content1_desc2' => '',
	'index_content1_desc_font_size2' => '14',
	'index_content1_image2' => false,
	'index_content1_url2' => '',
	'index_content1_target2' => '',
	'index_content1_headline3' => '',
	'index_content1_headline_font_size3' => '26',
	'index_content1_desc3' => '',
	'index_content1_desc_font_size3' => '14',
	'index_content1_image3' => false,
	'index_content1_url3' => '',
	'index_content1_target3' => '',
// index content2
	'show_index_content2' => 0,
	'index_content2_headline' => '',
	'index_content2_headline_font_size' => '38',
	'index_content2_headline_color' => 'C2AA99',
	'index_content2_desc' => '',
	'index_content2_desc_font_size' => '14',
// index course
	'show_index_course_content' => 0,
// index news
	'show_index_news_content' => 0,
	'index_news_headline' => __('News' , 'tcd-w'),
	'show_index_news_button' => 0,
	'index_news_button' => __('News archive', 'tcd-w'),
	'index_news_num' => 5,
// index campaign
	'show_index_campaign_content' => 0,
	'index_campaign_headline' => __('Campaign' , 'tcd-w'),
	'show_index_campaign_button' => 0,
	'index_campaign_button' => __('Campaign archive', 'tcd-w'),
	'index_campaign_num' => 5,
// index voice
	'show_index_voice_content' => 0,
	'index_voice_headline' => __('Voice', 'tcd-w'),
	'index_voice_headline_sub' => '',
	'index_voice_num' => 4,
	'show_index_voice_button' => 0,
	'index_voice_button' => __('Voice archive', 'tcd-w'),
// index blog
	'show_index_blog_content' => 0,
	'index_blog_headline' => __('Blog', 'tcd-w'),
	'index_blog_num' => 6,
	'show_index_blog_button' => 0,
	'index_blog_button' => __('Blog archive', 'tcd-w'),
// index business day
	'show_index_business_day' => 0,
	'index_business_day_postid' => '',
	'index_business_day_num' => 1,
// blog content
	'blog_archive_headline' => __('Blog', 'tcd-w'),
	'blog_archive_headline_sub' => '',
	'blog_breadcrumb_headline' => __('Blog', 'tcd-w'),
// post page
	'title_font_size' => '36',
	'content_font_size' => '14',
	'title_font_size_mobile' => '20',
	'content_font_size_mobile' => '14',
	'show_date' => 1,
	'show_category' => 1,
	'show_tag' => 1,
	'show_comment' => 1,
	'show_author' => 1,
	'show_trackback' => 1,
	'show_related_post' => 1,
	'show_next_post' => 1,
	'show_thumbnail' => 1,
	'related_post_headline' => __('Related posts', 'tcd-w'),
	'related_post_num' => 6,
// share button
	'show_sns_top' => 1,
	'show_sns_btm' => 1,
	'sns_type_top' => 'type1',
	'sns_type_btm' => 'type1',
	'show_twitter_top' => 1,
	'show_fblike_top' => 1,
	'show_fbshare_top' => 1,
	'show_google_top' => 1,
	'show_hatena_top' => 1,
	'show_pocket_top' => 1,
	'show_feedly_top' => 1,
	'show_rss_top' => 1,
	'show_pinterest_top' => 1,
	'show_twitter_btm' => 1,
	'show_fblike_btm' => 1,
	'show_fbshare_btm' => 1,
	'show_google_btm' => 1,
	'show_hatena_btm' => 1,
	'show_pocket_btm' => 1,
	'show_feedly_btm' => 1,
	'show_rss_btm' => 1,
	'show_pinterest_btm' => 1,
	'twitter_info' => '',
// post page banner
	'single_ad_code1' => '',
	'single_ad_image1' => false,
	'single_ad_url1' => '',
	'single_ad_code2' => '',
	'single_ad_image2' => false,
	'single_ad_url2' => '',
	'single_ad_code3' => '',
	'single_ad_image3' => false,
	'single_ad_url3' => '',
	'single_ad_code4' => '',
	'single_ad_image4' => false,
	'single_ad_url4' => '',
	'single_ad_code5' => '',
	'single_ad_image5' => false,
	'single_ad_url5' => '',
	'single_ad_code6' => '',
	'single_ad_image6' => false,
	'single_ad_url6' => '',
	'single_mobile_ad_code1' => '',
	'single_mobile_ad_image1' => false,
	'single_mobile_ad_url1' => '',
	'single_mobile_ad_code2' => '',
	'single_mobile_ad_image2' => false,
	'single_mobile_ad_url2' => '',
// news content
	'news_archive_headline' => __('News' , 'tcd-w'),
	'news_archive_headline_sub' => '',
	'news_breadcrumb_headline' => __('News', 'tcd-w'),
	'show_next_post_news' => 1,
	'show_sns_top_news' => 1,
	'show_sns_btm_news' => 1,
	'show_date_news' => 1,
	'show_recent_news' => 1,
	'recent_news_headline' => __('Recent news', 'tcd-w'),
	'recent_news_num' => 5,
	'recent_news_link_text' => __('News archive', 'tcd-w'),
// campaign content
	'campaign_archive_headline' => __('Campaign' , 'tcd-w'),
	'campaign_archive_headline_sub' => '',
	'campaign_breadcrumb_headline' => __('Campaign', 'tcd-w'),
	'show_next_post_campaign' => 1,
	'show_sns_top_campaign' => 1,
	'show_sns_btm_campaign' => 1,
	'show_date_campaign' => 1,
	'show_recent_campaign' => 1,
	'recent_campaign_headline' => __('Recent campaign', 'tcd-w'),
	'recent_campaign_num' => 5,
	'recent_campaign_link_text' => __('Campaign archive', 'tcd-w'),
// course
	'course_archive_headline' => __('Course' , 'tcd-w'),
	'course_archive_headline_sub' => '',
	'course_breadcrumb_headline' => __('Course', 'tcd-w'),
// voice
	'voice_archive_headline' => __('Voice' , 'tcd-w'),
	'voice_archive_headline_sub' => '',
	'voice_breadcrumb_headline' => __('Voice', 'tcd-w'),
// staff
	'staff_archive_headline' => __('Staff' , 'tcd-w'),
	'staff_archive_headline_sub' => '',
	'staff_breadcrumb_headline' => __('Staff', 'tcd-w'),
	'staff_show_related_post' => 1,
	'staff_related_post_num' => 6,
	'staff_related_post_headline' => __('Blog', 'tcd-w'),
// header
	'header_fix' => 'type1',
	'mobile_header_fix' => 'type1',
	'header_fix_background_opacity' => '0.8',
// footer
	'footer_address' => '',
	'footer_phonenumber' => '',
	'footer_shopname' => '',
	'twitter_url' => '',
	'facebook_url' => '',
	'insta_url' => '',
	'show_rss' => 1,
// フッターの固定メニュー
	//'show_footer_bar' => 1,
	'footer_bar_display' => 'type3',
	'footer_bar_tp' => 0.8,
	'footer_bar_bg' => 'FFFFFF',
	'footer_bar_border' => 'DDDDDD',
	'footer_bar_color' => '000000',
	'footer_bar_btns' => array(
		array(
			'type' => 'type1',
			'label' => '',
			'url' => '',
			'number' => '',
			'target' => 0,
			'icon' => 'file-text'
		)
	)
);

/**
 * Design Plusのオプションを返す
 * @global array $dp_default_options
 * @return array 
 */
function get_desing_plus_option(){
  global $dp_default_options;
  return shortcode_atts($dp_default_options, get_option('dp_options', array()));
}


// 登録
function theme_options_init(){
 register_setting( 'design_plus_options', 'dp_options', 'theme_options_validate' );
}


// ロード
function theme_options_add_page() {
 add_theme_page( __( 'Theme Options', 'tcd-w' ), __( 'TCD Theme Options', 'tcd-w' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

// hover effect
global $hover_type_options;
$hover_type_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Zoom', 'tcd-w' )),
 'type2' => array('value' => 'type2','label' => __( 'Slide', 'tcd-w' )),
 'type3' => array('value' => 'type3','label' => __( 'Fade', 'tcd-w' ))
);
global $hover2_direct_options;
$hover2_direct_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Left to Right', 'tcd-w' )),
 'type2' => array('value' => 'type2','label' => __( 'Right to Left', 'tcd-w' ))
);


//フォントタイプ
global $font_type_options;
$font_type_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Meiryo', 'tcd-w' )),
 'type2' => array('value' => 'type2','label' => __( 'YuGothic', 'tcd-w' )),
 'type3' => array('value' => 'type3','label' => __( 'YuMincho', 'tcd-w' ))
);
global $headline_font_type_options;
$headline_font_type_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Meiryo', 'tcd-w' )),
 'type2' => array('value' => 'type2','label' => __( 'YuGothic', 'tcd-w' )),
 'type3' => array('value' => 'type3','label' => __( 'YuMincho', 'tcd-w' ))
);


// お知らせの数
global $news_num_options;
$news_num_options = array(
 '1' => array('value' => '1','label' => '1'),
 '2' => array('value' => '2','label' => '2'),
 '3' => array('value' => '3','label' => '3'),
 '4' => array('value' => '4','label' => '4'),
 '5' => array('value' => '5','label' => '5'),
 '6' => array('value' => '6','label' => '6'),
 '7' => array('value' => '7','label' => '7'),
 '8' => array('value' => '8','label' => '8'),
 '9' => array('value' => '9','label' => '9'),
 '10' => array('value' => '10','label' => '10'),
);


// ブログの数
global $blog_num_options;
$blog_num_options = array(
 '3' => array('value' => '3','label' => '3'),
 '6' => array('value' => '6','label' => '6'),
 '9' => array('value' => '9','label' => '9'),
 '12' => array('value' => '12','label' => '12'),
 '15' => array('value' => '15','label' => '15')
);


// ヘッダーの固定設定
global $header_fix_options;
$header_fix_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Normal header', 'tcd-w' )),
 'type2' => array('value' => 'type2','label' => __( 'Fix at top after page scroll', 'tcd-w' )),
);


// ソーシャルボタンの設定
// 記事上ボタンタイプ
global $sns_type_top_options;
$sns_type_top_options = array(
'type1' => array( 'value' => 'type1', 'label' => __( 'style1', 'tcd-w' )),
'type2' => array( 'value' => 'type2', 'label' => __( 'style2', 'tcd-w' )),
'type3' => array( 'value' => 'type3', 'label' => __( 'style3', 'tcd-w' )),
'type4' => array( 'value' => 'type4', 'label' => __( 'style4', 'tcd-w' )),
'type5' => array( 'value' => 'type5', 'label' => __( 'style5', 'tcd-w' ))
);
// 記事下ボタンタイプ
global $sns_type_btm_options;
$sns_type_btm_options = array(
'type1' => array( 'value' => 'type1', 'label' => __( 'style1', 'tcd-w' )),
'type2' => array( 'value' => 'type2', 'label' => __( 'style2', 'tcd-w' )),
'type3' => array( 'value' => 'type3', 'label' => __( 'style3', 'tcd-w' )),
'type4' => array( 'value' => 'type4', 'label' => __( 'style4', 'tcd-w' )),
'type5' => array( 'value' => 'type5', 'label' => __( 'style5', 'tcd-w' ))
);


// レスポンシブの設定
global $responsive_options;
$responsive_options = array(
 'yes' => array('value' => 'yes','label' => __( 'Use responsive design', 'tcd-w' )),
 'no' => array('value' => 'no','label' => __( 'Do not use responsive design', 'tcd-w' ))
);


// ローディングアイコンの最大表示時間の設定
global $load_time_options;
$load_time_options = array(
 '3000' => array('value' => '3000','label' => __( '3 second', 'tcd-w' )),
 '4000' => array('value' => '4000','label' => __( '4 second', 'tcd-w' )),
 '5000' => array('value' => '5000','label' => __( '5 second', 'tcd-w' )),
 '6000' => array('value' => '6000','label' => __( '6 second', 'tcd-w' )),
 '7000' => array('value' => '7000','label' => __( '7 second', 'tcd-w' )),
 '8000' => array('value' => '8000','label' => __( '8 second', 'tcd-w' )),
 '9000' => array('value' => '9000','label' => __( '9 second', 'tcd-w' )),
 '10000' => array('value' => '10000','label' => __( '10 second', 'tcd-w' )),
);


// ローディングアイコンの種類の設定
global $load_icon_type;
$load_icon_type = array(
 'type1' => array('value' => 'type1','label' => __( 'Circle', 'tcd-w' )),
 'type2' => array('value' => 'type2','label' => __( 'Square', 'tcd-w' )),
 'type3' => array('value' => 'type3','label' => __( 'Dot', 'tcd-w' ))
);


// スライダーコンテンツの設定
global $slider_content_type_options;
$slider_content_type_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Display image', 'tcd-w' )),
 'type2' => array('value' => 'type2','label' => __( 'Display video', 'tcd-w' )),
 'type3' => array('value' => 'type3','label' => __( 'Display youtube', 'tcd-w' ))
);


// スライダーのタイミングの設定
global $slider_time_options;
$slider_time_options = array(
 '5000' => array('value' => '5000','label' => __( '5 second', 'tcd-w' )),
 '6000' => array('value' => '6000','label' => __( '6 second', 'tcd-w' )),
 '7000' => array('value' => '7000','label' => __( '7 second', 'tcd-w' )),
 '8000' => array('value' => '8000','label' => __( '8 second', 'tcd-w' )),
 '9000' => array('value' => '9000','label' => __( '9 second', 'tcd-w' )),
 '10000' => array('value' => '10000','label' => __( '10 second', 'tcd-w' )),
);


// フッターの固定メニュー 表示タイプ
global $footer_bar_display_options;
$footer_bar_display_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Fade In', 'tcd-w' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Slide In', 'tcd-w' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Hide', 'tcd-w' ))
);

// フッターの固定メニュー ボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Default', 'tcd-w' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Share', 'tcd-w' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Telephone', 'tcd-w' ))
);

// フッターの固定メニューのアイコン
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
 'file-text' => array('value' => 'file-text', 'label' => __( 'Document', 'tcd-w' )),
 'share-alt' => array('value' => 'share-alt', 'label' => __( 'Share', 'tcd-w' )),
 'phone' => array('value' => 'phone', 'label' => __( 'Telephone', 'tcd-w' )),
 'envelope' => array('value' => 'envelope', 'label' => __( 'Envelope', 'tcd-w' )),
 'tag' => array('value' => 'tag', 'label' => __( 'Tag', 'tcd-w' )),
 'pencil' => array('value' => 'pencil', 'label' => __( 'Pencil', 'tcd-w' ))
);


// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use default marker', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Use custom marker', 'tcd-w' ) )
);
global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Text', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image', 'tcd-w' ) )
);


// テーマオプション画面の作成
function theme_options_do_page() {
 global $load_time_options, $load_icon_type, $hover_type_options, $hover2_direct_options, $font_type_options, $headline_font_type_options, $responsive_options, $slider_content_type_options, $slider_time_options, $blog_num_options, $news_num_options, $header_fix_options, $sns_type_top_options, $sns_type_btm_options, $dp_upload_error, $footer_bar_icon_options, $footer_bar_button_options, $footer_bar_display_options, $gmap_marker_type_options, $gmap_custom_marker_type_options;
    $options = get_desing_plus_option();

 if ( ! isset( $_REQUEST['settings-updated'] ) )
  $_REQUEST['settings-updated'] = false;

?>

<div class="wrap">

 <?php echo "<h2>" . __( 'TCD Theme Options', 'tcd-w' ) . "</h2>"; ?>

 <?php // 更新時のメッセージ
       if ( false !== $_REQUEST['settings-updated'] ) :
 ?>
 <div class="updated fade"><p><strong><?php _e('Updated', 'tcd-w'); ?></strong></p></div>
 <?php endif; ?>
 
 <?php /* ファイルアップロード時のメッセージ */ if(!empty($dp_upload_error['message'])): ?>
  <?php if($dp_upload_error['error']): ?>
   <div id="error" class="error"><p><?php echo $dp_upload_error['message']; ?></p></div>
  <?php else: ?>
   <div id="message" class="updated fade"><p><?php echo $dp_upload_error['message']; ?></p></div>
  <?php endif; ?>
 <?php endif; ?>

 <div id="my_theme_option" class="cf">

  <div id="my_theme_left">
   <ul id="theme_tab" class="cf">
    <li><a href="#tab-content1"><?php _e('Basic', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content2"><?php _e('Logo', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content3"><?php _e('Index', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content4"><?php _e('Blog', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content5"><?php _e('News', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content6"><?php _e('Campaign', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content7"><?php _e('Course', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content8"><?php _e('Voice', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content9"><?php _e('Staff', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content10"><?php _e('Header', 'tcd-w'); ?></a></li>
    <li><a href="#tab-content11"><?php _e('Footer', 'tcd-w'); ?></a></li>
   </ul>
  </div>

  <div id="my_theme_right">

  <form method="post" action="options.php" enctype="multipart/form-data">

  <?php settings_fields( 'design_plus_options' ); ?>

  <div id="tab-panel">

  <!-- #tab-content1 基本設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content1">

   <?php // サイトカラー ?>
   <div id="color_pattern">
    <div class="theme_option_field cf">
     <h3 class="theme_option_headline"><?php _e('Color setting', 'tcd-w'); ?></h3>
     <h4 class="theme_option_headline2"><?php _e('Primary color setting', 'tcd-w'); ?></h4>
     <input type="text" id="pickedcolor1" class="color" name="dp_options[pickedcolor1]" value="<?php echo esc_attr( $options['pickedcolor1'] ); ?>" />
     <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('pickedcolor1').color.fromString('E3D0C3')">
     <h4 class="theme_option_headline2"><?php _e('Secondary color setting', 'tcd-w'); ?></h4>
     <input type="text" id="pickedcolor2" class="color" name="dp_options[pickedcolor2]" value="<?php echo esc_attr( $options['pickedcolor2'] ); ?>" />
     <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('pickedcolor2').color.fromString('C2AA99')">
     <h4 class="theme_option_headline2"><?php _e('Thirdly color setting', 'tcd-w'); ?></h4>
     <input type="text" id="pickedcolor3" class="color" name="dp_options[pickedcolor3]" value="<?php echo esc_attr( $options['pickedcolor3'] ); ?>" />
     <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('pickedcolor3').color.fromString('E8CAB7')">
     <h4 class="theme_option_headline2"><?php _e('Link text color in the article', 'tcd-w'); ?></h4>
     <input type="text" id="content_link_color" class="color" name="dp_options[content_link_color]" value="<?php echo esc_attr( $options['content_link_color'] ); ?>" />
     <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('content_link_color').color.fromString('C2AA99')">
     <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
    </div>
   </div>

   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Favicon setup', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Setting for the favicon displayed at browser address bar or tab.', 'tcd-w' ); ?></p>
    <div class="theme_option_input">
     <h4><?php _e( 'Favicon file', 'tcd-w' ); ?><?php _e( ' (Recommended size: width:16px, height:16px)', 'tcd-w' ); ?></h4>
     <p><?php _e( 'You can use .ico, .png or .gif file, and we recommed you to use .ico file.', 'tcd-w' ); ?></p>
     <div class="image_box cf">
      <div class="upload_banner_button_area">
       <div class="hide"><input type="text" size="36" name="dp_options[favicon]" value="<?php echo esc_attr( $options['favicon'] ); ?>"></div>
       <input type="file" name="favicon_file" id="favicon_file">
       <input type="submit" class="button-ml" value="<?php _e( 'Save Image', 'tcd-w' ); ?>">
      </div>
      <?php if ( $options['favicon'] ) : ?>
      <div class="uploaded_banner_image">
       <img src="<?php echo esc_attr( $options['favicon'] ); ?>" alt="">
      </div>
      <?php if ( dp_is_uploaded_img( $options['favicon'] ) ) : ?>
      <div class="delete_uploaded_banner_image">
       <a href="<?php echo wp_nonce_url( admin_url( 'themes.php?page=theme_options'), 'dp_delete_favicon' ); ?>" class="button-ml" onclick="if(!confirm('<?php _e( 'Are you sure to delete this image?', 'tcd-w' ); ?>')) return false;"><?php _e( 'Delete Image', 'tcd-w' ); ?></a>
      </div>
      <?php endif; ?>
      <?php endif; ?>
     </div>
     <input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
   </div>

   <?php // フォントの種類 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Font type', 'tcd-w'); ?></h3>
    <p><?php _e('Please set the font type of all text except for headline.', 'tcd-w'); ?></p>
    <fieldset class="cf select_type2">
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $font_type_options as $option ) {
          $font_type_setting = $options['font_type'];
            if ( '' != $font_type_setting ) {
              if ( $options['font_type'] == $option['value'] ) {
                $checked = "checked=\"checked\"";
              } else {
                $checked = '';
              }
           }
     ?>
     <label class="description">
      <input type="radio" name="dp_options[font_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
      <?php echo $option['label']; ?>
     </label>
     <?php } ?>
    </fieldset>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // フォントの種類 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Font type of headline', 'tcd-w'); ?></h3>
    <fieldset class="cf select_type2">
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $headline_font_type_options as $option ) {
          $headline_font_type_setting = $options['headline_font_type'];
            if ( '' != $headline_font_type_setting ) {
              if ( $options['headline_font_type'] == $option['value'] ) {
                $checked = "checked=\"checked\"";
              } else {
                $checked = '';
              }
           }
     ?>
     <label class="description">
      <input type="radio" name="dp_options[headline_font_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
      <?php echo $option['label']; ?>
     </label>
     <?php } ?>
    </fieldset>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  <?php // hover effect ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Hover effect', 'tcd-w'); ?></h3>
    <h4 class="theme_option_headline2"><?php _e('Hover effect type', 'tcd-w'); ?></h4>
    <p><?php _e('Please set the hover effect for thumbnail images.', 'tcd-w'); ?></p>
    <fieldset class="cf select_type2">
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $hover_type_options as $option ) {
          $hover_type_setting = $options['hover_type'];
            if ( '' != $hover_type_setting ) {
              if ( $options['hover_type'] == $option['value'] ) {
                $checked = "checked=\"checked\"";
              } else {
                $checked = '';
              }
           }
     ?>
     
     <input style="display:inline; margin: 5px 5px 5px 0;" type="radio" id="tab-<?php echo $option['value']; ?>" name="dp_options[hover_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
     <label style="display:inline;" class="description" for="tab-<?php echo $option['value']; ?>"><?php echo $option['label']; ?></label><br>
     
     <?php } ?>
    <div class="tab-box">
      <div id="tabView1">
        <h4 class="theme_option_headline2"><?php _e('Settings for Zoom effect', 'tcd-w'); ?></h4>
        <p><?php _e('Please set the rate of magnification.', 'tcd-w'); ?></p>
        <input id="dp_options[hover1_zoom]" class="hankaku" style="width:45px;" type="text" name="dp_options[hover1_zoom]" value="<?php echo esc_attr( $options['hover1_zoom'] ); ?>" />
        <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div>
      <div id="tabView2">
        <h4 class="theme_option_headline2"><?php _e('Settings for Slide effect', 'tcd-w'); ?></h4>
        <p><?php _e('Please set the direction of slide.', 'tcd-w'); ?></p>
        <fieldset class="cf select_type2">
         <?php
              if ( ! isset( $checked ) )
              $checked = '';
              foreach ( $hover2_direct_options as $option ) {
              $hover2_direct_setting = $options['hover2_direct'];
                if ( '' != $hover2_direct_setting ) {
                  if ( $options['hover2_direct'] == $option['value'] ) {
                    $checked = "checked=\"checked\"";
                  } else {
                    $checked = '';
                  }
               }
         ?>
         <label class="description" style="display:inline-block;margin-right:15px;">
          <input type="radio" name="dp_options[hover2_direct]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
          <?php echo $option['label']; ?>
         </label>
         <?php } ?>
        </fieldset>
        <p><?php _e('Please set the opacity. (0 - 1.0, e.g. 0.7)', 'tcd-w'); ?></p>
        <input id="dp_options[hover2_opacity]" class="hankaku" style="width:45px;" type="text" name="dp_options[hover2_opacity]" value="<?php echo esc_attr( $options['hover2_opacity'] ); ?>" />
        <p><?php _e('Please set the background color.', 'tcd-w'); ?></p>
        <input type="text" id="hover2_bgcolor" class="color" name="dp_options[hover2_bgcolor]" value="<?php echo esc_attr( $options['hover2_bgcolor'] ); ?>" />
        <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('hover2_bgcolor').color.fromString('C2AA99')">
        <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div>
      <div id="tabView3">
        <h4 class="theme_option_headline2"><?php _e('Settings for Fade effect', 'tcd-w'); ?></h4>
        <p><?php _e('Please set the opacity. (0 - 1.0, e.g. 0.7)', 'tcd-w'); ?></p>
        <input id="dp_options[hover3_opacity]" class="hankaku" style="width:45px;" type="text" name="dp_options[hover3_opacity]" value="<?php echo esc_attr( $options['hover3_opacity'] ); ?>" />
        <p><?php _e('Please set the background color.', 'tcd-w'); ?></p>
        <input type="text" id="hover3_bgcolor" class="color" name="dp_options[hover3_bgcolor]" value="<?php echo esc_attr( $options['hover3_bgcolor'] ); ?>" />
        <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('hover3_bgcolor').color.fromString('C2AA99')">
        <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div>
    </div>
    </fieldset>
   </div>

    <?php // Use OGP tag ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Facebook OGP setting', 'tcd-w');  ?></h3>
    <p><?php _e( 'OGP is a mechanism for correctly conveying page information.', 'tcd-w' ); ?></p>
    <div class="theme_option_input">
  		<p><label><input id="dp_options[use_ogp]" name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( '1', $options['use_ogp'] ); ?>><?php _e( 'Use OGP', 'tcd-w' );  ?></label></p>
        <p><?php _e( 'To use Facebook OGP please set your app ID.', 'tcd-w' ); ?></p>
  		<p><?php _e( 'Your app ID', 'tcd-w' );  ?> <input class="regular-text" type="text" name="dp_options[fb_app_id]" value="<?php esc_attr_e( $options['fb_app_id'] ); ?>"></p>
    </div>
    <h4 class="theme_option_headline2"><?php _e( 'OGP image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'This image is displayed for OGP if the page does not have a thumbnail.', 'tcd-w' ); ?></p>
    <p><?php _e( 'Recommend image size. Width:1200px, Height:630px', 'tcd-w' ); ?></p>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js">
      <input type="hidden" value="<?php echo esc_attr( $options['ogp_image'] ); ?>" id="ogp_image" name="dp_options[ogp_image]" class="cf_media_id">
      <div class="preview_field"><?php if ( $options['ogp_image'] ) { echo wp_get_attachment_image( $options['ogp_image'], 'medium'); } ?></div>
       <div class="button_area">
        <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
       <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ogp_image'] ) { echo 'hidden'; } ?>">
      </div>
     </div>
    </div>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // Use twitter card ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Twitter Cards setting', 'tcd-w'); ?></h3>
    <div class="theme_option_input">
     <p><label><input id="dp_options[use_twitter_card]" name="dp_options[use_twitter_card]" type="checkbox" value="1" <?php checked( '1', $options['use_twitter_card'] ); ?> /> <?php _e('Use Twitter Cards', 'tcd-w'); ?></label></p>
     <p><?php _e('Your Twitter account name (exclude @ mark)', 'tcd-w'); ?> <input id="dp_options[twitter_account_name]" class="regular-text" type="text" name="dp_options[twitter_account_name]" value="<?php echo esc_attr( $options['twitter_account_name'] ); ?>" /></p>
     <p><a href="http://design-plus1.com/tcd-w/2016/11/twitter-cards.html" target="_blank"><?php _e( 'Information about Twitter Cards.', 'tcd-w' ); ?></a></p>
    </div>
     <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 絵文字の設定 ?>
   <div class="theme_option_field cf">
       <h3 class="theme_option_headline"><?php _e('Emoji setup', 'tcd-w'); ?></h3>
       <p><?php _e('We recommend to checkoff this option if you dont use any Emoji in your post content.', 'tcd-w'); ?></p>
       <p><label><input id="dp_options[use_emoji]" name="dp_options[use_emoji]" type="checkbox" value="1" <?php checked( '1', $options['use_emoji'] ); ?> /> <?php _e('Use emoji', 'tcd-w'); ?></label></p>
   <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // レスポンシブ設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Responsive design setting', 'tcd-w'); ?></h3>
    <fieldset class="cf select_type2">
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $responsive_options as $option ) {
          $responsive_setting = $options['responsive'];
            if ( '' != $responsive_setting ) {
              if ( $options['responsive'] == $option['value'] ) {
                $checked = "checked=\"checked\"";
              } else {
                $checked = '';
              }
           }
     ?>
     <label class="description">
      <input type="radio" name="dp_options[responsive]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
      <?php echo $option['label']; ?>
     </label>
     <?php } ?>
    </fieldset>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // sidebar ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Sidebar', 'tcd-w'); ?></h3>
    <p><?php _e('This theme will display the sidebar to right column, but put the check bellow if you want to display to left.', 'tcd-w'); ?></p>
    <p><label><input id="dp_options[column_float]" name="dp_options[column_float]" type="checkbox" value="1" <?php checked( '1', $options['column_float'] ); ?> /> <?php _e('Display the sidebar to left column', 'tcd-w'); ?></label></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // ローディング画面の設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Loading screen setting', 'tcd-w');  ?></h3>
    <p><label><input id="dp_options[use_load_icon]" name="dp_options[use_load_icon]" type="checkbox" value="1" <?php checked( '1', $options['use_load_icon'] ); ?> /> <?php _e('Use load icon.', 'tcd-w');  ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Type of loader', 'tcd-w');  ?></h4>
    <select  id="load_icon_type" name="dp_options[load_icon]">
     <?php
          foreach ( $load_icon_type as $option ) :
            if ( $options['load_icon'] == $option['value']) {
              $selected = 'selected="selected"';
            } else {
              $selected = '';
            }
            echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $option['label'] . '</option>' ."\n";
          endforeach;
     ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e('Maximum display time', 'tcd-w');  ?></h4>
    <p><?php _e('Please set the maximum display time of the loading screen.<br />Even if all the content is not loaded, loading screen will disappear automatically after a lapse of time you have set at follwing.', 'tcd-w'); ?></p>
    <select name="dp_options[load_time]">
     <?php
          foreach ( $load_time_options as $option ) :
          $label = $option['label'];
          $selected = '';
          if ( $options['load_time'] == $option['value']) {
            $selected = 'selected="selected"';
          } else {
            $selected = '';
          }
          echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
          endforeach;
     ?>
    </select>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // ユーザーCSS用の自由記入欄 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Free input area for user definition CSS.', 'tcd-w'); ?></h3>
    <p><?php _e('Code example:<br /><strong>.example { font-size:12px; }</strong>', 'tcd-w'); ?></p>
    <textarea id="dp_options[css_code]" class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // custom head/script ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Free input area for user definition scripts.', 'tcd-w' ); ?></h3>
    <p><?php esc_html_e( 'Custom Script will output the end of the <head> tag. Please insert scripts (i.e. Google Analytics script), including <script>tag.', 'tcd-w' ); ?></p>
    <textarea id="dp_options[custom_head]" class="large-text" cols="50" rows="10" name="dp_options[custom_head]"><?php echo esc_textarea( $options['custom_head'] ); ?></textarea>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 404 ページ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Settings for 404 page', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Header image', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommend image size. Width:1150px, Height:650px', 'tcd-w' ); ?></p>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js header_image_404">
      <input type="hidden" value="<?php echo esc_attr( $options['header_image_404'] ); ?>" id="header_image_404" name="dp_options[header_image_404]" class="cf_media_id">
      <div class="preview_field"><?php if ( $options['header_image_404'] ) { echo wp_get_attachment_image( $options['header_image_404'], 'medium' ); } ?></div>
      <div class="button_area">
       <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
       <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['header_image_404'] ) { echo 'hidden'; } ?>">
      </div>
     </div>
    </div>
    <h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
    <textarea id="dp_options[header_txt_404]" class="large-text" cols="50" rows="2" name="dp_options[header_txt_404]"><?php echo esc_textarea( $options['header_txt_404'] ); ?></textarea>
    <h4 class="theme_option_headline2"><?php _e( 'Font size of headline', 'tcd-w' ); ?></h4>
    <p><input id="dp_options[header_txt_size_404]" class="font_size hankaku" type="text" name="dp_options[header_txt_size_404]" value="<?php echo esc_attr( $options['header_txt_size_404'] ); ?>"><span>px</span></p>
    <h4 class="theme_option_headline2"><?php _e( 'Font size of headline for mobile device', 'tcd-w' ); ?></h4>
    <p><input id="dp_options[header_txt_size_404_mobile]" class="font_size hankaku" type="text" name="dp_options[header_txt_size_404_mobile]" value="<?php echo esc_attr( $options['header_txt_size_404_mobile'] ); ?>"><span>px</span></p>
    <h4 class="theme_option_headline2"><?php _e( 'Font color of headline', 'tcd-w' ); ?></h4>
    <input type="text" id="header_txt_color_404" class="color" name="dp_options[header_txt_color_404]" value="<?php esc_attr_e( $options['header_txt_color_404'] ); ?>">
    <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e( 'Default color', 'tcd-w' ); ?>" onClick="document.getElementById('header_txt_color_404').color.fromString('FFFFFF')">
    <h4 class="theme_option_headline2"><?php _e( 'Dropshadow of headline', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Enter "0" if you don\'t want to use dropshadow.', 'tcd-w' ); ?></p>
    <ul class="headline_option">
     <li><label><?php _e( 'Dropshadow position (left)', 'tcd-w'); ?></label><input id="dp_options[dropshadow_404_h]" class="font_size hankaku" type="text" name="dp_options[dropshadow_404_h]" value="<?php echo esc_attr( $options['dropshadow_404_h'] ); ?>"><span>px</span></li>
     <li><label><?php _e( 'Dropshadow position (top)', 'tcd-w'); ?></label><input id="dp_options[dropshadow_404_v]" class="font_size hankaku" type="text" name="dp_options[dropshadow_404_v]" value="<?php echo esc_attr( $options['dropshadow_404_v'] ); ?>"><span>px</span></li>
     <li><label><?php _e( 'Dropshadow size', 'tcd-w' ); ?></label><input id="dp_options[dropshadow_404_b]" class="font_size hankaku" type="text" name="dp_options[dropshadow_404_b]" value="<?php echo esc_attr( $options['dropshadow_404_b'] ); ?>"><span>px</span></li>
     <li><label><?php _e( 'Dropshadow color', 'tcd-w' ); ?></label><input type="text" id="dropshadow_404_c" class="color" name="dp_options[dropshadow_404_c]" value="<?php echo esc_attr( $options['dropshadow_404_c'] ); ?>"><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e( 'Default color', 'tcd-w'); ?>" onClick="document.getElementById('dropshadow_404_c').color.fromString('FFFFFF')"></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
    <textarea id="dp_options[header_sub_txt_404]" class="large-text" cols="50" rows="2" name="dp_options[header_sub_txt_404]"><?php echo esc_textarea( $options['header_sub_txt_404'] ); ?></textarea>
    <h4 class="theme_option_headline2"><?php _e( 'Font size of sub title', 'tcd-w' ); ?></h4>
    <p><input id="dp_options[header_sub_txt_size_404]" class="font_size hankaku" type="text" name="dp_options[header_sub_txt_size_404]" value="<?php echo esc_attr( $options['header_sub_txt_size_404'] ); ?>"><span>px</span></p>
    <h4 class="theme_option_headline2"><?php _e( 'Font size of sub title for mobile device', 'tcd-w' ); ?></h4>
    <p><input id="dp_options[header_sub_txt_size_404_mobile]" class="font_size hankaku" type="text" name="dp_options[header_sub_txt_size_404_mobile]" value="<?php echo esc_attr( $options['header_sub_txt_size_404_mobile'] ); ?>"><span>px</span></p>
    <input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
   </div>

   <?php // Google Map ----------------------------------------- ?>
   <div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Google Maps settings', 'tcd-w' );  ?></h3>
     <h4 class="theme_option_headline2"><?php _e( 'API key', 'tcd-w' ); ?></h4>
     <input type="text" class="regular-text" name="dp_options[gmap_api_key]" value="<?php echo esc_attr( $options['gmap_api_key'] ); ?>">
     <h4 class="theme_option_headline2"><?php _e( 'Marker type', 'tcd-w' ); ?></h4>
     <?php foreach ( $gmap_marker_type_options as $option ) : ?>
     <p><label id="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>"><input type="radio" name="dp_options[gmap_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['gmap_marker_type'] ); ?>> <?php echo esc_html_e( $option['label'] ); ?></label></p>
     <?php endforeach; ?>
     <div id="gmap_marker_type2_area" style="<?php if($options['gmap_marker_type'] == 'type1'){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Custom marker type', 'tcd-w' ); ?></h4>
      <?php foreach ( $gmap_custom_marker_type_options as $option ) : ?>
      <p><label id="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>"><input type="radio" name="dp_options[gmap_custom_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['gmap_custom_marker_type'] ); ?>> <?php echo esc_html_e( $option['label'] ); ?></label></p>
      <?php endforeach; ?>
      <div id="gmap_custom_marker_type1_area" style="<?php if ( $options['gmap_custom_marker_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker text', 'tcd-w' ); ?></h4>
       <input type="text" name="dp_options[gmap_marker_text]" value="<?php echo esc_attr( $options['gmap_marker_text'] ); ?>" class="regular-text">
       <p><label><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" id="gmap_marker_color" class="color" name="dp_options[gmap_marker_color]" value="<?php echo esc_attr( $options['gmap_marker_color'] ); ?>"><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e( 'Default color', 'tcd-w'); ?>" onClick="document.getElementById('gmap_marker_color').color.fromString('FFFFFF')"></p>
      </div>
      <div id="gmap_custom_marker_type2_area" style="<?php if ( $options['gmap_custom_marker_type'] == 'type1') { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Custom marker image', 'tcd-w' ); ?></h4>
       <p><?php _e( 'Recommended size: width:60px, height:20px', 'tcd-w' ); ?></p>
       <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js gmap_marker_img">
         <input type="hidden" value="<?php echo esc_attr( $options['gmap_marker_img'] ); ?>" id="gmap_marker_img" name="dp_options[gmap_marker_img]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['gmap_marker_img'] ) { echo wp_get_attachment_image($options['gmap_marker_img'], 'medium' ); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['gmap_marker_img'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
      </div>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'Marker style', 'tcd-w' ); ?></h4>
     <p><label><?php _e( 'Background color', 'tcd-w' ); ?></label><input type="text" id="gmap_marker_bg" class="color" name="dp_options[gmap_marker_bg]" value="<?php echo esc_attr( $options['gmap_marker_bg'] ); ?>"><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e( 'Default color', 'tcd-w'); ?>" onClick="document.getElementById('gmap_marker_bg').color.fromString('000000')"></p>
    <input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
   </div><!-- END .theme_option_field -->

  </div><!-- END #tab-content1 -->




  <!-- #tab-content2 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content2">

   <?php // ヘッダーのロゴ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header logo', 'tcd-w'); ?></h3>
    <div<?php if(!empty($options['header_logo_image'])) { echo ' style="display:none;"'; }; ?>>
    <h4 class="theme_option_headline2"><?php _e('Font size for text logo', 'tcd-w'); ?></h4>
    <input id="dp_options[logo_font_size]" class="font_size hankaku" type="text" name="dp_options[logo_font_size]" value="<?php echo esc_attr( $options['logo_font_size'] ); ?>" /><span>px</span>
    </div>
    <h4 class="theme_option_headline2"><?php _e('Image for logo', 'tcd-w'); ?></h4>
    <p><?php _e('If the image is not registered, text will be displayed instead.','tcd-w'); ?></p>
    <p><?php _e('Recommended size, Width:125px Height:30px (maximum height:80px)', 'tcd-w'); ?></p>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js header_logo_image">
      <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image'] ); ?>" id="header_logo_image" name="dp_options[header_logo_image]" class="cf_media_id">
      <div class="preview_field"><?php if($options['header_logo_image']){ echo wp_get_attachment_image($options['header_logo_image'], 'full'); }; ?></div>
      <div class="buttton_area">
       <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
       <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image']){ echo 'hidden'; }; ?>">
      </div>
     </div>
    </div>
    <h5 class="theme_option_headline3"><?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?></h5>
    <p><label><input id="dp_options[header_logo_retina]" name="dp_options[header_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // ヘッダーのロゴ（固定ヘッダー用） ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header logo for fixed header', 'tcd-w');  ?></h3>
    <div<?php if(!empty($options['header_logo_image_fix'])) { echo ' style="display:none;"'; }; ?>>
    <h4 class="theme_option_headline2"><?php _e('Font size for text logo', 'tcd-w');  ?></h4>
    <input id="dp_options[logo_font_size_fix]" class="font_size hankaku" type="text" name="dp_options[logo_font_size_fix]" value="<?php esc_attr_e( $options['logo_font_size_fix'] ); ?>" /><span>px</span>
    </div>
    <h4 class="theme_option_headline2"><?php _e('Image for logo', 'tcd-w');  ?></h4>
    <p><?php _e('If the image is not registered, text will be displayed instead.','tcd-w'); ?></p>
    <p><?php _e('Recommended size, Width:125px Height:30px (maximum height:80px), and we recommend you to use the background transparent PNG image.', 'tcd-w'); ?></p>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js header_logo_image_fix">
      <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image_fix'] ); ?>" id="header_logo_image_fix" name="dp_options[header_logo_image_fix]" class="cf_media_id">
      <div class="preview_field"><?php if($options['header_logo_image_fix']){ echo wp_get_attachment_image($options['header_logo_image_fix'], 'full'); }; ?></div>
      <div class="buttton_area">
       <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
       <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image_fix']){ echo 'hidden'; }; ?>">
      </div>
     </div>
    </div>
    <h5 class="theme_option_headline3"><?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?></h5>
    <p><label><input id="dp_options[header_logo_retina_fix]" name="dp_options[header_logo_retina_fix]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina_fix'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // ヘッダーのロゴ（モバイル用） ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header logo for mobile device', 'tcd-w'); ?></h3>
    <div<?php if(!empty($options['header_logo_image_mobile'])) { echo ' style="display:none;"'; }; ?>>
    <h4 class="theme_option_headline2"><?php _e('Font size for text logo', 'tcd-w'); ?></h4>
    <input id="dp_options[logo_font_size_mobile]" class="font_size hankaku" type="text" name="dp_options[logo_font_size_mobile]" value="<?php echo esc_attr( $options['logo_font_size_mobile'] ); ?>" /><span>px</span>
    </div>
    <h4 class="theme_option_headline2"><?php _e('Image for logo', 'tcd-w'); ?></h4>
    <p><?php _e('If the image is not registered, text will be displayed instead.','tcd-w'); ?></p>
    <p><?php _e('Recommended size, Width:125px Height:30px (maximum height:50px)', 'tcd-w'); ?></p>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js header_logo_image_mobile">
      <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image_mobile'] ); ?>" id="header_logo_image_mobile" name="dp_options[header_logo_image_mobile]" class="cf_media_id">
      <div class="preview_field"><?php if($options['header_logo_image_mobile']){ echo wp_get_attachment_image($options['header_logo_image_mobile'], 'full'); }; ?></div>
      <div class="buttton_area">
       <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
       <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image_mobile']){ echo 'hidden'; }; ?>">
      </div>
     </div>
    </div>
    <h5 class="theme_option_headline3"><?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?></h5>
    <p><label><input id="dp_options[header_logo_retina_mobile]" name="dp_options[header_logo_retina_mobile]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina_mobile'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // ヘッダーのロゴ（モバイル固定ヘッダー用） ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header logo for fixed header for mobile device', 'tcd-w'); ?></h3>
    <div<?php if(!empty($options['header_logo_image_mobile_fix'])) { echo ' style="display:none;"'; }; ?>>
    <h4 class="theme_option_headline2"><?php _e('Font size for text logo', 'tcd-w'); ?></h4>
    <input id="dp_options[logo_font_size_mobile_fix]" class="font_size hankaku" type="text" name="dp_options[logo_font_size_mobile_fix]" value="<?php echo esc_attr( $options['logo_font_size_mobile_fix'] ); ?>" /><span>px</span>
    </div>
    <h4 class="theme_option_headline2"><?php _e('Image for logo', 'tcd-w'); ?></h4>
    <p><?php _e('If the image is not registered, text will be displayed instead.','tcd-w'); ?></p>
    <p><?php _e('Recommended size, Width:125px Height:30px (maximum height:50px)', 'tcd-w'); ?></p>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js header_logo_image_mobile">
      <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image_mobile_fix'] ); ?>" id="header_logo_image_mobile_fix" name="dp_options[header_logo_image_mobile_fix]" class="cf_media_id">
      <div class="preview_field"><?php if($options['header_logo_image_mobile_fix']){ echo wp_get_attachment_image($options['header_logo_image_mobile_fix'], 'full'); }; ?></div>
      <div class="buttton_area">
       <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
       <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image_mobile_fix']){ echo 'hidden'; }; ?>">
      </div>
     </div>
    </div>
    <h5 class="theme_option_headline3"><?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?></h5>
    <p><label><input id="dp_options[header_logo_retina_mobile_fix]" name="dp_options[header_logo_retina_mobile_fix]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina_mobile_fix'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // フッターのロゴ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Footer logo', 'tcd-w'); ?></h3>
    <div<?php if(!empty($options['footer_logo_image'])) { echo ' style="display:none;"'; }; ?>>
    <h4 class="theme_option_headline2"><?php _e('Font size for text logo', 'tcd-w'); ?></h4>
    <input id="dp_options[logo_font_size_footer]" class="font_size hankaku" type="text" name="dp_options[logo_font_size_footer]" value="<?php echo esc_attr( $options['logo_font_size_footer'] ); ?>" /><span>px</span>
    </div>
    <h4 class="theme_option_headline2"><?php _e('Image for logo', 'tcd-w'); ?></h4>
    <p><?php _e('If the image is not registered, text will be displayed instead.','tcd-w'); ?></p>
    <p><?php _e('Recommended size, Width:125px Height:30px, and we recommend you to use the background transparent PNG image.', 'tcd-w'); ?></p>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js footer_logo_image">
      <input type="hidden" value="<?php echo esc_attr( $options['footer_logo_image'] ); ?>" id="footer_logo_image" name="dp_options[footer_logo_image]" class="cf_media_id">
      <div class="preview_field"><?php if($options['footer_logo_image']){ echo wp_get_attachment_image($options['footer_logo_image'], 'full'); }; ?></div>
      <div class="buttton_area">
       <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
       <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_logo_image']){ echo 'hidden'; }; ?>">
      </div>
     </div>
    </div>
    <h5 class="theme_option_headline3"><?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?></h5>
    <p><label><input id="dp_options[footer_logo_retina]" name="dp_options[footer_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['footer_logo_retina'] ); ?> /> <?php _e('Use retina display logo image', 'tcd-w');  ?></label></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  </div><!-- END #tab-content2 -->




  <!-- #tab-content3 トップページ　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content3">

   <?php // ヘッダースライダー -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header slider setting', 'tcd-w');  ?></h3>
    <p><?php _e('You can register 5 images/videos.', 'tcd-w');  ?></p>

    <?php for($i = 1; $i <= 5; $i++): ?>
    <div class="sub_box cf">
     <h3 class="theme_option_subbox_headline"><?php printf(__('Slider%s setting', 'tcd-w'),$i);  ?></h3>
     <div class="sub_box_content">
      <h4 class="theme_option_headline2"><?php _e('Slider content setting', 'tcd-w');  ?></h4>
      <fieldset class="cf select_type2 slider_content_type">
       <?php
         foreach ( $slider_content_type_options as $option ) {
           if ( $options['slider_content_type'.$i] == $option['value'] ) {
             $checked = "checked=\"checked\"";
           } else {
             $checked = '';
           }
       ?>
       <label><input type="radio" name="dp_options[slider_content_type<?php echo $i; ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> /><?php echo $option['label']; ?></label>
       <?php } ?>
      </fieldset>

      <div class="slider_content_type1" style="<?php if($options['slider_content_type'.$i] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e('Slider image', 'tcd-w');  ?></h4>
       <p><?php _e('Recommend image size. Width:1150px, Height:650px', 'tcd-w');  ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js slider_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['slider_image'.$i] ); ?>" id="slider_image<?php echo $i; ?>" name="dp_options[slider_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['slider_image'.$i]){ echo wp_get_attachment_image($options['slider_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['slider_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Slider image for mobile', 'tcd-w');  ?></h4>
       <p><?php _e('Recommend image size. Width:700px, Height:400px', 'tcd-w');  ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js slider_image_mobile<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['slider_image_mobile'.$i] ); ?>" id="slider_image_mobile<?php echo $i; ?>" name="dp_options[slider_image_mobile<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['slider_image_mobile'.$i]){ echo wp_get_attachment_image($options['slider_image_mobile'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['slider_image_mobile'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

      </div><!-- END .slider_content_type1 -->

      <div class="slider_content_type2" style="<?php if($options['slider_content_type'.$i] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e('Video file', 'tcd-w');  ?></h4>
       <div class="image_box cf">
        <div class="cf cf_video_field hide-if-no-js slider_video">
         <input type="hidden" value="<?php echo esc_attr( $options['slider_video'.$i] ); ?>" id="slider_video<?php echo $i; ?>" name="dp_options[slider_video<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['slider_video'.$i] && wp_get_attachment_url($options['slider_video'.$i])){ echo '<p class="media_url">'.wp_get_attachment_url($options['slider_video'.$i]).'</p>'; } ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Video', 'tcd-w'); ?>" class="cfvf-select-video button">
          <input type="button" value="<?php _e('Remove Video', 'tcd-w'); ?>" class="cfvf-delete-video button <?php if(!$options['slider_video'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
       <p><?php _e( 'This image will be displayed instead of video in smartphone.<br /> Also this image will be displayed in the browser which video is not supported.', 'tcd-w' ); ?></p>
       <p><?php _e('Recommend image size. Width:1150px, Height:650px', 'tcd-w');  ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js slider_video_image">
         <input type="hidden" value="<?php echo esc_attr( $options['slider_video_image'.$i] ); ?>" id="slider_video_image<?php echo $i; ?>" name="dp_options[slider_video_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['slider_video_image'.$i]){ echo wp_get_attachment_image($options['slider_video_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['slider_video_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </div><!-- END .slider_content_type2 -->

      <div class="slider_content_type3" style="<?php if($options['slider_content_type'.$i] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e('Youtube url', 'tcd-w');  ?></h4>
       <p><input id="dp_options[slider_youtube_url<?php echo $i; ?>]" type="text" name="dp_options[slider_youtube_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_youtube_url'.$i] ); ?>" class="large-text" /></p>
       <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
       <p><?php _e( 'This image will be displayed instead of Youtube video in smartphone.', 'tcd-w' ); ?></p>
       <p><?php _e('Recommend image size. Width:1150px, Height:650px', 'tcd-w');  ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js slider_youtube_image">
         <input type="hidden" value="<?php echo esc_attr( $options['slider_youtube_image'.$i] ); ?>" id="slider_youtube_image<?php echo $i; ?>" name="dp_options[slider_youtube_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['slider_youtube_image'.$i]){ echo wp_get_attachment_image($options['slider_youtube_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['slider_youtube_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </div><!-- END .slider_content_type3 -->

      <h4 class="theme_option_headline2"><?php _e('Overlay setting', 'tcd-w');  ?></h4>
      <p class="use_slider_overlay"><label><input id="dp_options[use_slider_overlay<?php echo $i; ?>]" name="dp_options[use_slider_overlay<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['use_slider_overlay'.$i] ); ?> /> <?php _e('Use overlay on image.', 'tcd-w');  ?></label></p>
      <div class="slider_overlay_setting"<?php if( $options['use_slider_overlay'.$i] == 1 ) { echo ' style="display:block;"'; }; ?>>
       <h4 class="theme_option_headline2"><?php _e('Overlay color', 'tcd-w');  ?></h4>
       <p>
        <input type="text" id="slider_overlay<?php echo $i; ?>" class="color" name="dp_options[slider_overlay<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_overlay'.$i] ); ?>" />
        <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_overlay<?php echo $i; ?>').color.fromString('FFFFFF')">
       </p>
       <h4 class="theme_option_headline2"><?php _e('Overlay color transparency', 'tcd-w');  ?></h4>
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       <p><input id="dp_options[slider_overlay_opacity<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_overlay_opacity'.$i] ); ?>" /></p>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Link URL', 'tcd-w');  ?></h4>
      <p><?php _e('Leave this field blank if you don\'t want to use link at image.', 'tcd-w');  ?></p>
      <input id="dp_options[slider_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[slider_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_url'.$i] ); ?>" />
      <p><label><input id="dp_options[slider_target<?php echo $i; ?>]" name="dp_options[slider_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['slider_target'.$i] ); ?> /> <?php _e('Open link in new window', 'tcd-w');  ?></label></p>

      <h4 class="theme_option_headline2"><?php _e('Caption setting', 'tcd-w');  ?></h4>
      <p class="use_slider_caption"><label><input id="dp_options[use_slider_caption<?php echo $i; ?>]" name="dp_options[use_slider_caption<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['use_slider_caption'.$i] ); ?> /> <?php _e('Display caption.', 'tcd-w');  ?></label></p>
      <div class="slider_caption_setting"<?php if( $options['use_slider_caption'.$i] == 1 ) { echo ' style="display:block;"'; }; ?>>
       <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
       <textarea id="dp_options[slider_headline<?php echo $i; ?>]" class="large-text" cols="50" rows="2" name="dp_options[slider_headline<?php echo $i; ?>]"><?php echo esc_textarea( $options['slider_headline'.$i] ); ?></textarea>
       <ul class="headline_option">
        <li><label><?php _e('Font size', 'tcd-w');  ?></label><input id="dp_options[slider_headline_font_size<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_headline_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_headline_font_size'.$i] ); ?>" /><span>px</span></li>
        <li><label><?php _e('Font size for mobile', 'tcd-w');  ?></label><input id="dp_options[slider_headline_font_size_mobile<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_headline_font_size_mobile<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_headline_font_size_mobile'.$i] ); ?>" /><span>px</span></li>
        <li>
         <label><?php _e('Font color', 'tcd-w');  ?></label>
         <input type="text" id="slider_headline_color<?php echo $i; ?>" class="color" name="dp_options[slider_headline_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_headline_color'.$i] ); ?>" />
         <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_headline_color<?php echo $i; ?>').color.fromString('000000')">
        </li>
        <li><label><?php _e('Dropshadow position (left)', 'tcd-w');  ?></label><input id="dp_options[slider_headline_shadow_a<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_headline_shadow_a<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_headline_shadow_a'.$i] ); ?>" /><span>px</span></li>
        <li><label><?php _e('Dropshadow position (top)', 'tcd-w');  ?></label><input id="dp_options[slider_headline_shadow_b<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_headline_shadow_b<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_headline_shadow_b'.$i] ); ?>" /><span>px</span></li>
        <li><label><?php _e('Dropshadow size', 'tcd-w');  ?></label><input id="dp_options[slider_headline_shadow_c<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_headline_shadow_c<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_headline_shadow_c'.$i] ); ?>" /><span>px</span></li>
        <li><label><?php _e('Dropshadow color', 'tcd-w');  ?></label><input type="text" id="slider_headline_shadow_color<?php echo $i; ?>" class="color" name="dp_options[slider_headline_shadow_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_headline_shadow_color'.$i] ); ?>" /><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_headline_shadow_color<?php echo $i; ?>').color.fromString('ffffff')"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
       <textarea id="dp_options[slider_caption<?php echo $i; ?>]" class="large-text" cols="50" rows="2" name="dp_options[slider_caption<?php echo $i; ?>]"><?php echo esc_textarea( $options['slider_caption'.$i] ); ?></textarea>
       <ul class="headline_option">
        <li><label><?php _e('Font size', 'tcd-w');  ?></label><input id="dp_options[slider_caption_font_size<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_caption_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_caption_font_size'.$i] ); ?>" /><span>px</span></li>
        <li><label><?php _e('Font size for mobile', 'tcd-w');  ?></label><input id="dp_options[slider_caption_font_size_mobile<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_caption_font_size_mobile<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_caption_font_size_mobile'.$i] ); ?>" /><span>px</span></li>
        <li>
         <label><?php _e('Font color', 'tcd-w');  ?></label>
         <input type="text" id="slider_caption_color<?php echo $i; ?>" class="color" name="dp_options[slider_caption_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_caption_color'.$i] ); ?>" />
         <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_caption_color<?php echo $i; ?>').color.fromString('000000')">
        </li>
        <li><label><?php _e('Dropshadow position (left)', 'tcd-w');  ?></label><input id="dp_options[slider_caption_shadow_a<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_caption_shadow_a<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_caption_shadow_a'.$i] ); ?>" /><span>px</span></li>
        <li><label><?php _e('Dropshadow position (top)', 'tcd-w');  ?></label><input id="dp_options[slider_caption_shadow_b<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_caption_shadow_b<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_caption_shadow_b'.$i] ); ?>" /><span>px</span></li>
        <li><label><?php _e('Dropshadow size', 'tcd-w');  ?></label><input id="dp_options[slider_caption_shadow_c<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_caption_shadow_c<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_caption_shadow_c'.$i] ); ?>" /><span>px</span></li>
        <li><label><?php _e('Dropshadow color', 'tcd-w');  ?></label><input type="text" id="slider_caption_shadow_color<?php echo $i; ?>" class="color" name="dp_options[slider_caption_shadow_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_caption_shadow_color'.$i] ); ?>" /><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_caption_shadow_color<?php echo $i; ?>').color.fromString('ffffff')"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
       <p class="show_slider_caption_button"><label><input id="dp_options[show_slider_caption_button<?php echo $i; ?>]" name="dp_options[show_slider_caption_button<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['show_slider_caption_button'.$i] ); ?> /> <?php _e('Display button.', 'tcd-w');  ?></label></p>
       <div class="slider_caption_button_setting"<?php if( $options['show_slider_caption_button'.$i] == 1 ) { echo ' style="display:block;"'; }; ?>>
        <h4 class="theme_option_headline2"><?php _e('Label of button', 'tcd-w');  ?></h4>
        <input id="dp_options[slider_caption_button<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[slider_caption_button<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_caption_button'.$i] ); ?>" />
        <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
        <ul class="headline_option">
         <li><label><?php _e('Font color', 'tcd-w');  ?></label><input type="text" id="slider_button_color<?php echo $i; ?>" class="color" name="dp_options[slider_button_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_button_color'.$i] ); ?>" /><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_button_color<?php echo $i; ?>').color.fromString('000000')"></li>
         <li><label><?php _e('Background color', 'tcd-w');  ?></label><input type="text" id="slider_button_bg_color<?php echo $i; ?>" class="color" name="dp_options[slider_button_bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_button_bg_color'.$i] ); ?>" /><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_button_bg_color<?php echo $i; ?>').color.fromString('FFFFFF')"></li>
         <li><label><?php _e('Background color transparency', 'tcd-w');  ?></label><input id="dp_options[slider_button_bg_opaciry<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_button_bg_opaciry<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_button_bg_opaciry'.$i] ); ?>" /></li>
         <li><label><?php _e('Border color', 'tcd-w');  ?></label><input type="text" id="slider_button_border_color<?php echo $i; ?>" class="color" name="dp_options[slider_button_border_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_button_border_color'.$i] ); ?>" /><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_button_border_color<?php echo $i; ?>').color.fromString('000000')"></li>
         <li><label><?php _e('Font hover color', 'tcd-w');  ?></label><input type="text" id="slider_button_color_hover<?php echo $i; ?>" class="color" name="dp_options[slider_button_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_button_color_hover'.$i] ); ?>" /><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_button_color_hover<?php echo $i; ?>').color.fromString('FFFFFF')"></li>
         <li><label><?php _e('Background hover color', 'tcd-w');  ?></label><input type="text" id="slider_button_bg_color_hover<?php echo $i; ?>" class="color" name="dp_options[slider_button_bg_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_button_bg_color_hover'.$i] ); ?>" /><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_button_bg_color_hover<?php echo $i; ?>').color.fromString('000000')"></li>
         <li><label><?php _e('Background hover color transparency', 'tcd-w');  ?></label><input id="dp_options[slider_button_bg_opaciry_hover<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[slider_button_bg_opaciry_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_button_bg_opaciry_hover'.$i] ); ?>" /></li>
         <li><label><?php _e('Border hover color', 'tcd-w');  ?></label><input type="text" id="slider_button_border_color_hover<?php echo $i; ?>" class="color" name="dp_options[slider_button_border_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['slider_button_border_color_hover'.$i] ); ?>" /><input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('slider_button_border_color_hover<?php echo $i; ?>').color.fromString('000000')"></li>
        </ul>
       </div>
      </div>

      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />     </div><!-- END .sub_box_content -->
    </div><!-- END .sub_box -->
    <?php endfor; ?>

    <h4 class="theme_option_headline2"><?php _e('Slider speed setting', 'tcd-w');  ?></h4>
    <select name="dp_options[slider_time]">
     <?php
          foreach ( $slider_time_options as $option ) :
            $label = $option['label'];
            $selected = '';
            if ( $options['slider_time'] == $option['value']) {
              $selected = 'selected="selected"';
            } else {
              $selected = '';
            }
            echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
          endforeach;
     ?>
    </select>
    <p><?php _e('Movie and Youtube does not perform automatic slide until playback ends.', 'tcd-w');  ?></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // トピックス ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Topics content', 'tcd-w'); ?></h3>
    <p><label><input id="dp_options[show_index_topics_content]" name="dp_options[show_index_topics_content]" type="checkbox" value="1" <?php checked( '1', $options['show_index_topics_content'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h4>
    <input id="dp_options[index_topics_headline]" class="large-text" type="text" name="dp_options[index_topics_headline]" value="<?php echo esc_attr( $options['index_topics_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w'); ?></h4>
    <ul>
     <li><label><input id="dp_options[show_date_index_topics]" name="dp_options[show_date_index_topics]" type="checkbox" value="1" <?php checked( '1', $options['show_date_index_topics'] ); ?> /> <?php _e('Display date', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_index_topics_news]" name="dp_options[show_index_topics_news]" type="checkbox" value="1" <?php checked( '1', $options['show_index_topics_news'] ); ?> /> <?php _e('Display news', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_index_topics_campaign]" name="dp_options[show_index_topics_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_index_topics_campaign'] ); ?> /> <?php _e('Display campaign', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_index_topics_blog]" name="dp_options[show_index_topics_blog]" type="checkbox" value="1" <?php checked( '1', $options['show_index_topics_blog'] ); ?> /> <?php _e('Display blog', 'tcd-w'); ?></label></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e('Post number', 'tcd-w'); ?></h4>
    <select name="dp_options[index_topics_num]">
     <?php
       foreach ( $news_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['index_topics_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e('Opacity of background', 'tcd-w'); ?></h4>
    <input id="dp_options[index_topics_bg_opacity]" class="font_size hankaku" type="text" name="dp_options[index_topics_bg_opacity]" value="<?php echo esc_attr( $options['index_topics_bg_opacity'] ); ?>" />
    <p><?php _e('Please enter the number 0 - 1.0. (e.g. 0.8)', 'tcd-w'); ?></p>
    <p><?php _e('The background color set in the third color of the basic setting item is applied.', 'tcd-w'); ?></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // コンテンツ１ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Content', 'tcd-w'); ?>1</h3>
    <p><label><input id="dp_options[show_index_content1]" name="dp_options[show_index_content1]" type="checkbox" value="1" <?php checked( '1', $options['show_index_content1'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <?php for($i = 1; $i <= 3; $i++): ?>
    <div class="sub_box cf">
     <h3 class="theme_option_subbox_headline"><?php printf(__('Box%s setting', 'tcd-w'),$i); ?></h3>
     <div class="sub_box_content">
      <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h4>
      <input id="dp_options[index_content1_headline<?php echo $i; ?>]" class="large-text" type="text" name="dp_options[index_content1_headline<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_content1_headline'.$i] ); ?>" />
      <p>
       <?php _e('Font size', 'tcd-w'); ?>
       <input id="dp_options[index_content1_headline_font_size<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[index_content1_headline_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_content1_headline_font_size'.$i] ); ?>" /><span>px</span>
      </p>
      <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h4>
      <textarea id="dp_options[index_content1_desc<?php echo $i; ?>]" class="large-text" cols="50" rows="3" name="dp_options[index_content1_desc<?php echo $i; ?>]"><?php echo esc_textarea( $options['index_content1_desc'.$i] ); ?></textarea>
      <p>
       <?php _e('Font size', 'tcd-w'); ?>
       <input id="dp_options[index_content1_desc_font_size<?php echo $i; ?>]" class="font_size hankaku" type="text" name="dp_options[index_content1_desc_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_content1_desc_font_size'.$i] ); ?>" /><span>px</span>
      </p>
      <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w'); ?></h4>
      <p><?php _e('Recommend image size. Width:370px, Height:210px', 'tcd-w'); ?></p>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js index_content1_image<?php echo $i; ?>">
        <input type="hidden" value="<?php echo esc_attr( $options['index_content1_image'.$i] ); ?>" id="index_content1_image<?php echo $i; ?>" name="dp_options[index_content1_image<?php echo $i; ?>]" class="cf_media_id">
        <div class="preview_field"><?php if($options['index_content1_image'.$i]){ echo wp_get_attachment_image($options['index_content1_image'.$i], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['index_content1_image'.$i]){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Link URL', 'tcd-w'); ?></h4>
      <input id="dp_options[index_content1_url<?php echo $i; ?>]" class="large-text" type="text" name="dp_options[index_content1_url<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_content1_url'.$i] ); ?>" />
      <label><input  id="dp_options[index_content1_target<?php echo $i; ?>]" name="dp_options[index_content1_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['index_content1_target'.$i], 1 ); ?>><?php _e( 'Open with new window', 'tcd-w' ); ?></label>
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div><!-- END .sub_box_content -->
    </div><!-- END .sub_box -->
    <?php endfor; ?>
   </div>

   <?php // コンテンツ２ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Content', 'tcd-w'); ?>2</h3>
    <p><label><input id="dp_options[show_index_content2]" name="dp_options[show_index_content2]" type="checkbox" value="1" <?php checked( '1', $options['show_index_content2'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h4>
    <textarea id="dp_options[index_content2_headline]" class="large-text" cols="50" rows="2" name="dp_options[index_content2_headline]"><?php echo esc_textarea( $options['index_content2_headline'] ); ?></textarea>
    <p>
     <?php _e('Font size', 'tcd-w'); ?>
     <input id="dp_options[index_content2_headline_font_size]" class="font_size hankaku" type="text" name="dp_options[index_content2_headline_font_size]" value="<?php echo esc_attr( $options['index_content2_headline_font_size'] ); ?>" /><span>px</span>
     <br />
     <?php _e('Font color', 'tcd-w'); ?>
     <input type="text" id="index_content2_headline_color" class="color" name="dp_options[index_content2_headline_color]" value="<?php echo esc_attr( $options['index_content2_headline_color'] ); ?>" />
     <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('index_content2_headline_color').color.fromString('C2AA99')">
    </p>
    <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h4>
    <textarea id="dp_options[index_content2_desc]" class="large-text" cols="50" rows="3" name="dp_options[index_content2_desc]"><?php echo esc_textarea( $options['index_content2_desc'] ); ?></textarea>
    <p><?php _e('Font size', 'tcd-w'); ?> <input id="dp_options[index_content2_desc_font_size]" class="font_size hankaku" type="text" name="dp_options[index_content2_desc_font_size]" value="<?php echo esc_attr( $options['index_content2_desc_font_size'] ); ?>" /><span>px</span></p>
    <input style="margin-bottom:30px;" type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // コースコンテンツ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Course content', 'tcd-w'); ?></h3>
    <p><label><input id="dp_options[show_index_course_content]" name="dp_options[show_index_course_content]" type="checkbox" value="1" <?php checked( '1', $options['show_index_course_content'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <p><?php _e('From the course edit, perform "Setting to display on top page".', 'tcd-w'); ?></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // お知らせコンテンツ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('News content', 'tcd-w'); ?></h3>
    <p><label><input id="dp_options[show_index_news_content]" name="dp_options[show_index_news_content]" type="checkbox" value="1" <?php checked( '1', $options['show_index_news_content'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h4>
    <input id="dp_options[index_news_headline]" class="large-text" type="text" name="dp_options[index_news_headline]" value="<?php echo esc_attr( $options['index_news_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Post number', 'tcd-w'); ?></h4>
    <select name="dp_options[index_news_num]">
     <?php
       foreach ( $news_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['index_news_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e('Button for news archive page', 'tcd-w'); ?></h4>
    <p><label><input id="dp_options[show_index_news_button]" name="dp_options[show_index_news_button]" type="checkbox" value="1" <?php checked( '1', $options['show_index_news_button'] ); ?> /> <?php _e('Display button for news archive page', 'tcd-w'); ?></label></p>
    <h5 class="theme_option_headline3"><?php _e('Label for this button', 'tcd-w'); ?></h5>
    <input id="dp_options[index_news_button]" class="regular-text" type="text" name="dp_options[index_news_button]" value="<?php echo esc_attr( $options['index_news_button'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // キャンペーンコンテンツ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Campaign content', 'tcd-w'); ?></h3>
    <p><label><input id="dp_options[show_index_campaign_content]" name="dp_options[show_index_campaign_content]" type="checkbox" value="1" <?php checked( '1', $options['show_index_campaign_content'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h4>
    <input id="dp_options[index_campaign_headline]" class="large-text" type="text" name="dp_options[index_campaign_headline]" value="<?php echo esc_attr( $options['index_campaign_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Post number', 'tcd-w'); ?></h4>
    <select name="dp_options[index_campaign_num]">
     <?php
       foreach ( $news_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['index_campaign_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e('Button for campaign archive page', 'tcd-w'); ?></h4>
    <p><label><input id="dp_options[show_index_campaign_button]" name="dp_options[show_index_campaign_button]" type="checkbox" value="1" <?php checked( '1', $options['show_index_campaign_button'] ); ?> /> <?php _e('Display button for campaign archive page', 'tcd-w'); ?></label></p>
    <h5 class="theme_option_headline3"><?php _e('Label for this button', 'tcd-w'); ?></h5>
    <input id="dp_options[index_campaign_button]" class="regular-text" type="text" name="dp_options[index_campaign_button]" value="<?php echo esc_attr( $options['index_campaign_button'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // お客様の声コンテンツ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Voice content', 'tcd-w'); ?></h3>
    <p><label><input id="dp_options[show_index_voice_content]" name="dp_options[show_index_voice_content]" type="checkbox" value="1" <?php checked( '1', $options['show_index_voice_content'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h4>
    <input id="dp_options[index_voice_headline]" class="large-text" type="text" name="dp_options[index_voice_headline]" value="<?php echo esc_attr( $options['index_voice_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Sub headline', 'tcd-w'); ?></h4>
    <input id="dp_options[index_voice_headline_sub]" class="large-text" type="text" name="dp_options[index_voice_headline_sub]" value="<?php echo esc_attr( $options['index_voice_headline_sub'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Number of voice', 'tcd-w'); ?></h4>
    <select name="dp_options[index_voice_num]">
     <?php
       foreach ( $news_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['index_voice_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e('Button for voice archive page', 'tcd-w'); ?></h4>
    <p><label><input id="dp_options[show_index_voice_button]" name="dp_options[show_index_voice_button]" type="checkbox" value="1" <?php checked( '1', $options['show_index_voice_button'] ); ?> /> <?php _e('Display button for voice archive page', 'tcd-w'); ?></label></p>
    <h5 class="theme_option_headline3"><?php _e('Label for this button', 'tcd-w'); ?></h5>
    <input id="dp_options[index_voice_button]" class="regular-text" type="text" name="dp_options[index_voice_button]" value="<?php echo esc_attr( $options['index_voice_button'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // ブログコンテンツ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Blog content', 'tcd-w'); ?></h3>
    <p><label><input id="dp_options[show_index_blog_content]" name="dp_options[show_index_blog_content]" type="checkbox" value="1" <?php checked( '1', $options['show_index_blog_content'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h4>
    <input id="dp_options[index_blog_headline]" class="large-text" type="text" name="dp_options[index_blog_headline]" value="<?php echo esc_attr( $options['index_blog_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Number of blog', 'tcd-w'); ?></h4>
    <select name="dp_options[index_blog_num]">
     <?php
       foreach ( $blog_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['index_blog_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e('Button for blog archive page', 'tcd-w'); ?></h4>
    <p><label><input id="dp_options[show_index_blog_button]" name="dp_options[show_index_blog_button]" type="checkbox" value="1" <?php checked( '1', $options['show_index_blog_button'] ); ?> /> <?php _e('Display button for blog archive page', 'tcd-w'); ?></label></p>
    <h5 class="theme_option_headline3"><?php _e('Label for this button', 'tcd-w'); ?></h5>
    <input id="dp_options[index_blog_button]" class="regular-text" type="text" name="dp_options[index_blog_button]" value="<?php echo esc_attr( $options['index_blog_button'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 営業日コンテンツ ----------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Business day content', 'tcd-w'); ?></h3>
    <p><label><input id="dp_options[show_index_business_day]" name="dp_options[show_index_business_day]" type="checkbox" value="1" <?php checked( '1', $options['show_index_business_day'] ); ?> /> <?php _e('Display this content at top page', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Page ID', 'tcd-w');  ?></h4>
    <input type="text" id="dp_options[index_business_day_postid]"name="dp_options[index_business_day_postid]" value="<?php echo esc_attr( $options['index_business_day_postid'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Select the table to display', 'tcd-w');  ?></h4>
    <p><?php _e( 'If there are multiple business day table, please specify the number of tables to display.', 'tcd-w' ); ?></p>
    <input type="number" id="dp_options[index_business_day_num]"name="dp_options[index_business_day_num]" value="<?php echo esc_attr( $options['index_business_day_num'] ); ?>" min="1" step="1" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  </div><!-- END #tab-content3 -->




  <!-- #tab-content4 ブログコンテンツ　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content4">
   <?php // アーカイブページの設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Archive page setting', 'tcd-w'); ?></h3>
    <h4 class="theme_option_headline2"><?php _e('Archive page headline', 'tcd-w'); ?></h4>
    <input id="dp_options[blog_archive_headline]" class="regular-text" type="text" name="dp_options[blog_archive_headline]" value="<?php echo esc_attr( $options['blog_archive_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Archive page subtitle', 'tcd-w'); ?></h4>
    <input id="dp_options[blog_archive_headline_sub]" class="regular-text" type="text" name="dp_options[blog_archive_headline_sub]" value="<?php echo esc_attr( $options['blog_archive_headline_sub'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // フォントサイズ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Font size for post page', 'tcd-w'); ?></h3>
    <p><?php _e('Settings for font size of text in post page', 'tcd-w'); ?></p>
    <h4 class="theme_option_headline2"><?php _e('Font size of post title', 'tcd-w'); ?></h4>
    <input id="dp_options[title_font_size]" class="font_size hankaku" type="text" name="dp_options[title_font_size]" value="<?php echo esc_attr( $options['title_font_size'] ); ?>" /><span>px</span>
    <h4 class="theme_option_headline2"><?php _e('Font size of post contents', 'tcd-w'); ?></h4>
    <input id="dp_options[content_font_size]" class="font_size hankaku" type="text" name="dp_options[content_font_size]" value="<?php echo esc_attr( $options['content_font_size'] ); ?>" /><span>px</span>
    <h4 class="theme_option_headline2"><?php _e('Font size of post title for mobie', 'tcd-w'); ?></h4>
    <input id="dp_options[title_font_size_mobile]" class="font_size hankaku" type="text" name="dp_options[title_font_size_mobile]" value="<?php echo esc_attr( $options['title_font_size_mobile'] ); ?>" /><span>px</span>
    <h4 class="theme_option_headline2"><?php _e('Font size of post contents for mobile', 'tcd-w'); ?></h4>
    <input id="dp_options[content_font_size_mobile]" class="font_size hankaku" type="text" name="dp_options[content_font_size_mobile]" value="<?php echo esc_attr( $options['content_font_size_mobile'] ); ?>" /><span>px</span>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 投稿者名・タグ・コメント ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
    <p><?php _e('Settings for miscs', 'tcd-w'); ?></p>
    <h4 class="theme_option_headline2"><?php _e('Text for breadcrumb', 'tcd-w'); ?></h4>
    <input id="dp_options[blog_breadcrumb_headline]" class="regular-text" type="text" name="dp_options[blog_breadcrumb_headline]" value="<?php echo esc_attr( $options['blog_breadcrumb_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Settings for front page, archive page and post page', 'tcd-w'); ?></h4>
    <ul>
     <li><label><input id="dp_options[show_date]" name="dp_options[show_date]" type="checkbox" value="1" <?php checked( '1', $options['show_date'] ); ?> /> <?php _e('Display date', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_category]" name="dp_options[show_category]" type="checkbox" value="1" <?php checked( '1', $options['show_category'] ); ?> /> <?php _e('Display category', 'tcd-w'); ?></label></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e('Settings for post page', 'tcd-w'); ?></h4>
    <ul>
     <li><label><input id="dp_options[show_tag]" name="dp_options[show_tag]" type="checkbox" value="1" <?php checked( '1', $options['show_tag'] ); ?> /> <?php _e('Display tags', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_author]" name="dp_options[show_author]" type="checkbox" value="1" <?php checked( '1', $options['show_author'] ); ?> /> <?php _e('Display author', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_thumbnail]" name="dp_options[show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $options['show_thumbnail'] ); ?> /> <?php _e('Display thumbnail', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_next_post]" name="dp_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post'] ); ?> /> <?php _e('Display next previous post link', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_comment]" name="dp_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_comment'] ); ?> /> <?php _e('Display comment', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_trackback]" name="dp_options[show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['show_trackback'] ); ?> /> <?php _e('Display trackbacks', 'tcd-w'); ?></label></li>
    </ul>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 関連記事の設定  ------------------------------------------------------------------ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Related posts setting', 'tcd-w'); ?></h3>
    <p><?php _e('Related posts will be displayed at the bottom of post page.','tcd-w'); ?></p>
    <p><label><input id="dp_options[show_related_post]" name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( '1', $options['show_related_post'] ); ?> /> <?php _e('Display related post', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline of related posts', 'tcd-w'); ?></h4>
    <input id="dp_options[related_post_headline]" class="regular-text" type="text" name="dp_options[related_post_headline]" value="<?php echo esc_attr( $options['related_post_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Number of related posts', 'tcd-w'); ?></h4>
    <select name="dp_options[related_post_num]">
     <?php
       foreach ( $blog_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['related_post_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
   </div>

   <?php // NEWソーシャルボタン  ------------------------------------------------------------------ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Social button Setup', 'tcd-w'); ?></h3>
    <p><?php _e('Settings for social buttons displayed at post page', 'tcd-w'); ?></p>
    <div class="theme_option_input">
     <h4 class="theme_option_headline2"><?php _e('Set of articles top buttons', 'tcd-w'); ?></h4>
     <label><input id="dp_options[show_sns_top]" name="dp_options[show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_top'] ); ?> /> <?php _e('Buttons to the article top', 'tcd-w'); ?></label>
     <h4 class="theme_option_headline2"><?php _e('Type of button on article top', 'tcd-w'); ?></h4>
     <fieldset class="cf">
      <ul class="cf">
       <?php
         foreach ( $sns_type_top_options as $option ) {
           if ( $options['sns_type_top'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
           } else {
             $checked = '';
           }
       ?>
       <li>
        <label>
         <input type="radio" name="dp_options[sns_type_top]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
         <?php _e($option['label'], 'tcd-w'); ?>
        </label>
       </li>
       <?php
         }
       ?>
      </ul>
     </fieldset>
     <h4 class="theme_option_headline2"><?php _e('Select the social button to show on article top', 'tcd-w'); ?></h4>
     <ul>
      <li><label><input id="dp_options[show_twitter_top]" name="dp_options[show_twitter_top]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_top'] ); ?> /> <?php _e('Display twitter button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_fblike_top]" name="dp_options[show_fblike_top]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_top'] ); ?> /> <?php _e('Display facebook like button -Button type 5 (Default button) only', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_fbshare_top]" name="dp_options[show_fbshare_top]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_top'] ); ?> /> <?php _e('Display facebook share button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_google_top]" name="dp_options[show_google_top]" type="checkbox" value="1" <?php checked( '1', $options['show_google_top'] ); ?> /> <?php _e('Display google+ button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_hatena_top]" name="dp_options[show_hatena_top]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_top'] ); ?> /> <?php _e('Display hatena button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_pocket_top]" name="dp_options[show_pocket_top]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_top'] ); ?> /> <?php _e('Display pocket button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_feedly_top]" name="dp_options[show_feedly_top]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_top'] ); ?> /> <?php _e('Display feedly button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_rss_top]" name="dp_options[show_rss_top]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_top'] ); ?> /> <?php _e('Display rss button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_pinterest_top]" name="dp_options[show_pinterest_top]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_top'] ); ?> /> <?php _e('Display pinterest button', 'tcd-w'); ?></label></li>
     </ul>

     <hr />

     <h4 class="theme_option_headline2"><?php _e('Set of articles bottom buttons', 'tcd-w'); ?></h4>
     <label><input id="dp_options[show_sns_btm]" name="dp_options[show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm'] ); ?> /> <?php _e('Buttons to the article bottom', 'tcd-w'); ?></label>
     <h4 class="theme_option_headline2"><?php _e('Type of button on article bottom', 'tcd-w'); ?></h4>
     <fieldset class="cf">
      <ul class="cf">
       <?php
         foreach ( $sns_type_btm_options as $option ) {
           if ( $options['sns_type_btm'] == $option['value'] ) {
            $checked = "checked=\"checked\"";
           } else {
            $checked = '';
           }
       ?>
       <li>
        <label>
         <input type="radio" name="dp_options[sns_type_btm]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
         <?php _e($option['label'], 'tcd-w'); ?>
        </label>
       </li>
       <?php
         }
       ?>
      </ul>
     </fieldset>

     <h4 class="theme_option_headline2"><?php _e('Select the social button to show on article bottom', 'tcd-w'); ?></h4>
     <ul>
      <li><label><input id="dp_options[show_twitter_btm]" name="dp_options[show_twitter_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_twitter_btm'] ); ?> /> <?php _e('Display twitter button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_fblike_btm]" name="dp_options[show_fblike_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fblike_btm'] ); ?> /> <?php _e('Display facebook like button-Button type 5 (Default button) only', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_fbshare_btm]" name="dp_options[show_fbshare_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_fbshare_btm'] ); ?> /> <?php _e('Display facebook share button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_google_btm]" name="dp_options[show_google_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_google_btm'] ); ?> /> <?php _e('Display google+ button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_hatena_btm]" name="dp_options[show_hatena_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_hatena_btm'] ); ?> /> <?php _e('Display hatena button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_pocket_btm]" name="dp_options[show_pocket_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pocket_btm'] ); ?> /> <?php _e('Display pocket button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_feedly_btm]" name="dp_options[show_feedly_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_feedly_btm'] ); ?> /> <?php _e('Display feedly button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_rss_btm]" name="dp_options[show_rss_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_rss_btm'] ); ?> /> <?php _e('Display rss button', 'tcd-w'); ?></label></li>
      <li><label><input id="dp_options[show_pinterest_btm]" name="dp_options[show_pinterest_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_pinterest_btm'] ); ?> /> <?php _e('Display pinterest button', 'tcd-w'); ?></label></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Setting for the twitter button', 'tcd-w'); ?></h4>
     <label style="margin-top:20px;"><?php _e('Set of twitter account. (ex.designplus)', 'tcd-w'); ?></label>
     <input style="display:block; margin:.6em 0 1em;" id="dp_options[twitter_info]" class="regular-text" type="text" name="dp_options[twitter_info]" value="<?php echo esc_attr( $options['twitter_info'] ); ?>" />
    </div>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  <?php // 広告の登録1 -------------------------------------------------------------------------------------------- ?>
  <div class="theme_option_field cf">
   <h3 class="theme_option_headline"><?php _e('Single page banner setup', 'tcd-w'); ?>1</h3>
   <p><?php _e('This banner will be displayed next to the title of the page.', 'tcd-w'); ?></p>
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Left banner', 'tcd-w'); ?></h3>
    <div class="sub_box_content">
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w'); ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w'); ?></p>
      <textarea id="dp_options[single_ad_code5]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code5]"><?php echo esc_textarea( $options['single_ad_code5'] ); ?></textarea>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w'); ?></p>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); _e('Recommend size. Width:300px Height:250px', 'tcd-w'); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js single_ad_image5">
        <input type="hidden" value="<?php echo esc_attr( $options['single_ad_image5'] ); ?>" id="single_ad_image5" name="dp_options[single_ad_image5]" class="cf_media_id">
        <div class="preview_field"><?php if($options['single_ad_image5']){ echo wp_get_attachment_image($options['single_ad_image5'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_ad_image5']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w'); ?></h4>
      <input id="dp_options[single_ad_url5]" class="large-text" type="text" name="dp_options[single_ad_url5]" value="<?php echo esc_attr( $options['single_ad_url5'] ); ?>" />
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Right banner', 'tcd-w'); ?></h3>
    <div class="sub_box_content">
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w'); ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w'); ?></p>
      <textarea id="dp_options[single_ad_code6]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code6]"><?php echo esc_textarea( $options['single_ad_code6'] ); ?></textarea>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w'); ?></p>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); _e('Recommend size. Width:300px Height:250px', 'tcd-w'); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js single_ad_image6">
        <input type="hidden" value="<?php echo esc_attr( $options['single_ad_image6'] ); ?>" id="single_ad_image6" name="dp_options[single_ad_image6]" class="cf_media_id">
        <div class="preview_field"><?php if($options['single_ad_image6']){ echo wp_get_attachment_image($options['single_ad_image6'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_ad_image6']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w'); ?></h4>
      <input id="dp_options[single_ad_url6]" class="large-text" type="text" name="dp_options[single_ad_url6]" value="<?php echo esc_attr( $options['single_ad_url6'] ); ?>" />
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
  </div><!-- END .theme_option_field -->

  <?php // 広告の登録2 -------------------------------------------------------------------------------------------- ?>
  <div class="theme_option_field cf">
   <h3 class="theme_option_headline"><?php _e('Single page banner setup', 'tcd-w'); ?>2</h3>
   <p><?php _e('This banner will be displayed under contents.', 'tcd-w'); ?></p>
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Left banner', 'tcd-w'); ?></h3>
    <div class="sub_box_content">
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w'); ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w'); ?></p>
      <textarea id="dp_options[single_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code1]"><?php echo esc_textarea( $options['single_ad_code1'] ); ?></textarea>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w'); ?></p>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); _e('Recommend size. Width:300px Height:250px', 'tcd-w'); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js single_ad_image1">
        <input type="hidden" value="<?php echo esc_attr( $options['single_ad_image1'] ); ?>" id="single_ad_image" name="dp_options[single_ad_image1]" class="cf_media_id">
        <div class="preview_field"><?php if($options['single_ad_image1']){ echo wp_get_attachment_image($options['single_ad_image1'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_ad_image1']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w'); ?></h4>
      <input id="dp_options[single_ad_url1]" class="large-text" type="text" name="dp_options[single_ad_url1]" value="<?php echo esc_attr( $options['single_ad_url1'] ); ?>" />
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Right banner', 'tcd-w'); ?></h3>
    <div class="sub_box_content">
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w'); ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w'); ?></p>
      <textarea id="dp_options[single_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code2]"><?php echo esc_textarea( $options['single_ad_code2'] ); ?></textarea>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w'); ?></p>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); _e('Recommend size. Width:300px Height:250px', 'tcd-w'); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js single_ad_image2">
        <input type="hidden" value="<?php echo esc_attr( $options['single_ad_image2'] ); ?>" id="single_ad_image2" name="dp_options[single_ad_image2]" class="cf_media_id">
        <div class="preview_field"><?php if($options['single_ad_image2']){ echo wp_get_attachment_image($options['single_ad_image2'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_ad_image2']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w'); ?></h4>
      <input id="dp_options[single_ad_url2]" class="large-text" type="text" name="dp_options[single_ad_url2]" value="<?php echo esc_attr( $options['single_ad_url2'] ); ?>" />
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
  </div><!-- END .theme_option_field -->

  <?php // 広告の登録3 -------------------------------------------------------------------------------------------- ?>
  <div class="theme_option_field cf">
   <h3 class="theme_option_headline"><?php _e('Single page banner setup', 'tcd-w'); ?>3</h3>
   <p><?php _e('Please copy and paste the short code inside the content to show this banner.', 'tcd-w'); ?></p>
   <p><?php _e('Short code', 'tcd-w'); ?> : <input type="text" readonly="readonly" value="[s_ad]" /></p>
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Left banner', 'tcd-w'); ?></h3>
    <div class="sub_box_content">
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w'); ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w'); ?></p>
      <textarea id="dp_options[single_ad_code3]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code3]"><?php echo esc_textarea( $options['single_ad_code3'] ); ?></textarea>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w'); ?></p>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); _e('Recommend size. Width:300px Height:250px', 'tcd-w'); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js single_ad_image3">
        <input type="hidden" value="<?php echo esc_attr( $options['single_ad_image3'] ); ?>" id="single_ad_image3" name="dp_options[single_ad_image3]" class="cf_media_id">
        <div class="preview_field"><?php if($options['single_ad_image3']){ echo wp_get_attachment_image($options['single_ad_image3'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_ad_image3']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w'); ?></h4>
      <input id="dp_options[single_ad_url3]" class="large-text" type="text" name="dp_options[single_ad_url3]" value="<?php echo esc_attr( $options['single_ad_url3'] ); ?>" />
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Right banner', 'tcd-w'); ?></h3>
    <div class="sub_box_content">
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w'); ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w'); ?></p>
      <textarea id="dp_options[single_ad_code4]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code4]"><?php echo esc_textarea( $options['single_ad_code4'] ); ?></textarea>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w'); ?></p>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); _e('Recommend size. Width:300px Height:250px', 'tcd-w'); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js single_ad_image4">
        <input type="hidden" value="<?php echo esc_attr( $options['single_ad_image4'] ); ?>" id="single_ad_image4" name="dp_options[single_ad_image4]" class="cf_media_id">
        <div class="preview_field"><?php if($options['single_ad_image4']){ echo wp_get_attachment_image($options['single_ad_image4'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_ad_image4']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w'); ?></h4>
      <input id="dp_options[single_ad_url4]" class="large-text" type="text" name="dp_options[single_ad_url4]" value="<?php echo esc_attr( $options['single_ad_url4'] ); ?>" />
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
  </div><!-- END .theme_option_field -->

  <?php // スマホ専用広告の登録 -------------------------------------------------------------------------------------------- ?>
  <div class="theme_option_field cf">
   <h3 class="theme_option_headline"><?php _e('Mobile device banner setup', 'tcd-w');  ?></h3>
   <p><?php _e('This banner will be displayed on mobile device.', 'tcd-w');  ?></p>
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Top banner', 'tcd-w');  ?></h3>
    <div class="sub_box_content">
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <textarea id="dp_options[single_mobile_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[single_mobile_ad_code1]"><?php echo esc_textarea( $options['single_mobile_ad_code1'] ); ?></textarea>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js single_mobile_ad_image1">
        <input type="hidden" value="<?php echo esc_attr( $options['single_mobile_ad_image1'] ); ?>" id="single_mobile_ad_image" name="dp_options[single_mobile_ad_image1]" class="cf_media_id">
        <div class="preview_field"><?php if($options['single_mobile_ad_image1']){ echo wp_get_attachment_image($options['single_mobile_ad_image1'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_mobile_ad_image1']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <input id="dp_options[single_mobile_ad_url1]" class="regular-text" type="text" name="dp_options[single_mobile_ad_url1]" value="<?php echo esc_attr( $options['single_mobile_ad_url1'] ); ?>" />
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Bottom banner', 'tcd-w');  ?></h3>
    <div class="sub_box_content">
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <textarea id="dp_options[single_mobile_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[single_mobile_ad_code2]"><?php echo esc_textarea( $options['single_mobile_ad_code2'] ); ?></textarea>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js single_mobile_ad_image2">
        <input type="hidden" value="<?php echo esc_attr( $options['single_mobile_ad_image2'] ); ?>" id="single_mobile_ad_image2" name="dp_options[single_mobile_ad_image2]" class="cf_media_id">
        <div class="preview_field"><?php if($options['single_mobile_ad_image2']){ echo wp_get_attachment_image($options['single_mobile_ad_image2'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_mobile_ad_image2']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>
     <div class="theme_option_content">
      <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <input id="dp_options[single_mobile_ad_url2]" class="regular-text" type="text" name="dp_options[single_mobile_ad_url2]" value="<?php echo esc_attr( $options['single_mobile_ad_url2'] ); ?>" />
      <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
     </div>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
  </div><!-- END .theme_option_field -->

  </div><!-- END #tab-content4 -->




  <!-- #tab-content5 お知らせコンテンツ　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content5">
   <?php // アーカイブページの設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Archive page setting', 'tcd-w'); ?></h3>
    <h4 class="theme_option_headline2"><?php _e('Archive page headline', 'tcd-w'); ?></h4>
    <input id="dp_options[news_archive_headline]" class="regular-text" type="text" name="dp_options[news_archive_headline]" value="<?php echo esc_attr( $options['news_archive_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Archive page subtitle', 'tcd-w'); ?></h4>
    <input id="dp_options[news_archive_headline_sub]" class="regular-text" type="text" name="dp_options[news_archive_headline_sub]" value="<?php echo esc_attr( $options['news_archive_headline_sub'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 項目の表示設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
    <p><?php _e('Settings for miscs', 'tcd-w'); ?></p>
    <h4 class="theme_option_headline2"><?php _e('Text for breadcrumb', 'tcd-w'); ?></h4>
    <input id="dp_options[news_breadcrumb_headline]" class="regular-text" type="text" name="dp_options[news_breadcrumb_headline]" value="<?php echo esc_attr( $options['news_breadcrumb_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Settings for front page, archive page and post page', 'tcd-w'); ?></h4>
    <ul>
     <li><label><input id="dp_options[show_date_news]" name="dp_options[show_date_news]" type="checkbox" value="1" <?php checked( '1', $options['show_date_news'] ); ?> /> <?php _e('Display date', 'tcd-w'); ?></label></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e('Settings for post page', 'tcd-w'); ?></h4>
    <ul>
     <li><label><input id="dp_options[show_sns_top_news]" name="dp_options[show_sns_top_news]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_top_news'] ); ?> /> <?php _e('Display share button under post title', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_sns_btm_news]" name="dp_options[show_sns_btm_news]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm_news'] ); ?> /> <?php _e('Display share button under post content', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_next_post_news]" name="dp_options[show_next_post_news]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post_news'] ); ?> /> <?php _e('Display next previous post link', 'tcd-w'); ?></label></li>
    </ul>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 最新のお知らせの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Recent news setting', 'tcd-w'); ?></h3>
    <p><?php _e('Recent news will be displayed at the bottom of news post page.','tcd-w'); ?></p>
    <p><label><input id="dp_options[show_recent_news]" name="dp_options[show_recent_news]" type="checkbox" value="1" <?php checked( '1', $options['show_recent_news'] ); ?> /> <?php _e('Display reccent news list', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline for Recent news', 'tcd-w'); ?></h4>
    <input id="dp_options[recent_news_headline]" class="regular-text" type="text" name="dp_options[recent_news_headline]" value="<?php echo esc_attr( $options['recent_news_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Archive link text', 'tcd-w'); ?></h4>
    <input id="dp_options[recent_news_link_text]" class="regular-text" type="text" name="dp_options[recent_news_link_text]" value="<?php echo esc_attr( $options['recent_news_link_text'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Post number', 'tcd-w'); ?></h4>
    <select name="dp_options[recent_news_num]">
     <?php
       foreach ( $news_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['recent_news_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  </div><!-- END #tab-content5 -->




  <!-- #tab-content6 キャンペーン　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content6">

   <?php // アーカイブページの設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Archive page setting', 'tcd-w'); ?></h3>
    <h4 class="theme_option_headline2"><?php _e('Archive page headline', 'tcd-w'); ?></h4>
    <input id="dp_options[campaign_archive_headline]" class="regular-text" type="text" name="dp_options[campaign_archive_headline]" value="<?php echo esc_attr( $options['campaign_archive_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Archive page subtitle', 'tcd-w'); ?></h4>
    <input id="dp_options[campaign_archive_headline_sub]" class="regular-text" type="text" name="dp_options[campaign_archive_headline_sub]" value="<?php echo esc_attr( $options['campaign_archive_headline_sub'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 項目の表示設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
    <p><?php _e('Settings for miscs', 'tcd-w'); ?></p>
    <h4 class="theme_option_headline2"><?php _e('Text for breadcrumb', 'tcd-w'); ?></h4>
    <input id="dp_options[campaign_breadcrumb_headline]" class="regular-text" type="text" name="dp_options[campaign_breadcrumb_headline]" value="<?php echo esc_attr( $options['campaign_breadcrumb_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Settings for front page, archive page and post page', 'tcd-w'); ?></h4>
    <ul>
     <li><label><input id="dp_options[show_date_campaign]" name="dp_options[show_date_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_date_campaign'] ); ?> /> <?php _e('Display date', 'tcd-w'); ?></label></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e('Settings for post page', 'tcd-w'); ?></h4>
    <ul>
     <li><label><input id="dp_options[show_sns_top_campaign]" name="dp_options[show_sns_top_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_top_campaign'] ); ?> /> <?php _e('Display share button under post title', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_sns_btm_campaign]" name="dp_options[show_sns_btm_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm_campaign'] ); ?> /> <?php _e('Display share button under post content', 'tcd-w'); ?></label></li>
     <li><label><input id="dp_options[show_next_post_campaign]" name="dp_options[show_next_post_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post_campaign'] ); ?> /> <?php _e('Display next previous post link', 'tcd-w'); ?></label></li>
    </ul>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 最新のお知らせの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Recent campaign setting', 'tcd-w'); ?></h3>
    <p><?php _e('Recent campaign will be displayed at the bottom of campaign post page.','tcd-w'); ?></p>
    <p><label><input id="dp_options[show_recent_campaign]" name="dp_options[show_recent_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_recent_campaign'] ); ?> /> <?php _e('Display reccent campaign list', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Headline for Recent campaign', 'tcd-w'); ?></h4>
    <input id="dp_options[recent_campaign_headline]" class="regular-text" type="text" name="dp_options[recent_campaign_headline]" value="<?php echo esc_attr( $options['recent_campaign_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Archive link text', 'tcd-w'); ?></h4>
    <input id="dp_options[recent_campaign_link_text]" class="regular-text" type="text" name="dp_options[recent_campaign_link_text]" value="<?php echo esc_attr( $options['recent_campaign_link_text'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Post number', 'tcd-w'); ?></h4>
    <select name="dp_options[recent_campaign_num]">
     <?php
       foreach ( $news_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['recent_news_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  </div><!-- END #tab-content6 -->




  <!-- #tab-content7 コース　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content7">

   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display name setting', 'tcd-w'); ?></h3>
    <h4 class="theme_option_headline2"><?php _e('Archive page headline', 'tcd-w'); ?></h4>
    <input id="dp_options[course_archive_headline]" class="regular-text" type="text" name="dp_options[course_archive_headline]" value="<?php echo esc_attr( $options['course_archive_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Archive page subtitle', 'tcd-w'); ?></h4>
    <input id="dp_options[course_archive_headline_sub]" class="regular-text" type="text" name="dp_options[course_archive_headline_sub]" value="<?php echo esc_attr( $options['course_archive_headline_sub'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Text for breadcrumb', 'tcd-w'); ?></h4>
    <input id="dp_options[course_breadcrumb_headline]" class="regular-text" type="text" name="dp_options[course_breadcrumb_headline]" value="<?php echo esc_attr( $options['course_breadcrumb_headline'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  </div><!-- END #tab-content7 -->




  <!-- #tab-content8 お客様の声　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content8">

   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display name setting', 'tcd-w'); ?></h3>
    <h4 class="theme_option_headline2"><?php _e('Archive page headline', 'tcd-w'); ?></h4>
    <input id="dp_options[voice_archive_headline]" class="regular-text" type="text" name="dp_options[voice_archive_headline]" value="<?php echo esc_attr( $options['voice_archive_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Archive page subtitle', 'tcd-w'); ?></h4>
    <input id="dp_options[voice_archive_headline_sub]" class="regular-text" type="text" name="dp_options[voice_archive_headline_sub]" value="<?php echo esc_attr( $options['voice_archive_headline_sub'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Text for breadcrumb', 'tcd-w'); ?></h4>
    <input id="dp_options[voice_breadcrumb_headline]" class="regular-text" type="text" name="dp_options[voice_breadcrumb_headline]" value="<?php echo esc_attr( $options['voice_breadcrumb_headline'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  </div><!-- END #tab-content8 -->





  <!-- #tab-content9 スタッフ　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content9">

   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display name setting', 'tcd-w'); ?></h3>
    <h4 class="theme_option_headline2"><?php _e('Archive page headline', 'tcd-w'); ?></h4>
    <input id="dp_options[staff_archive_headline]" class="regular-text" type="text" name="dp_options[staff_archive_headline]" value="<?php echo esc_attr( $options['staff_archive_headline'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Archive page subtitle', 'tcd-w'); ?></h4>
    <input id="dp_options[staff_archive_headline_sub]" class="regular-text" type="text" name="dp_options[staff_archive_headline_sub]" value="<?php echo esc_attr( $options['staff_archive_headline_sub'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Text for breadcrumb', 'tcd-w'); ?></h4>
    <input id="dp_options[staff_breadcrumb_headline]" class="regular-text" type="text" name="dp_options[staff_breadcrumb_headline]" value="<?php echo esc_attr( $options['staff_breadcrumb_headline'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // 関連記事の設定  ------------------------------------------------------------------ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Staff blog setting', 'tcd-w'); ?></h3>
    <p><?php _e('Staff blog will be displayed at the bottom of post page.','tcd-w'); ?></p>
    <p><label><input id="dp_options[staff_show_related_post]" name="dp_options[staff_show_related_post]" type="checkbox" value="1" <?php checked( '1', $options['staff_show_related_post'] ); ?> /> <?php _e('Display related post', 'tcd-w'); ?></label></p>
    <h4 class="theme_option_headline2"><?php _e('Number of staff blog posts', 'tcd-w'); ?></h4>
    <select name="dp_options[staff_related_post_num]">
     <?php
       foreach ( $blog_num_options as $option ) :
         $label = esc_html( $option['label'] );
         if ( $options['staff_related_post_num'] == $option['value'] ) {
         $selected = 'selected="selected"';
         } else {
           $selected = '';
         }
         echo '<option style="padding-right: 10px;" value="' . esc_attr( $option['value'] ) . '" ' . $selected . '>' . $label . '</option>' ."\n";
       endforeach;
     ?>
    </select>
    <h4 class="theme_option_headline2"><?php _e('Staff blog headline', 'tcd-w'); ?></h4>
    <p><?php _e('Displayed in the form of "Staff Name: Headline".','tcd-w'); ?></p>
    <input id="dp_options[staff_related_post_headline]" class="regular-text" type="text" name="dp_options[staff_related_post_headline]" value="<?php echo esc_attr( $options['staff_related_post_headline'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  </div><!-- END #tab-content9 -->





  <!-- #tab-content10 ヘッダー　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content10">

   <?php // ヘッダーの固定設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header position', 'tcd-w'); ?></h3>
    <fieldset class="cf select_type2">
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $header_fix_options as $option ) {
          $header_fix_setting = $options['header_fix'];
            if ( '' != $header_fix_setting ) {
              if ( $options['header_fix'] == $option['value'] ) {
                $checked = "checked=\"checked\"";
              } else {
                $checked = '';
              }
           }
     ?>
     <label class="description">
      <input type="radio" name="dp_options[header_fix]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
      <?php echo $option['label']; ?>
     </label>
     <?php } ?>
    </fieldset>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // スマホヘッダーの固定設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header position for mobile device', 'tcd-w'); ?></h3>
    <fieldset class="cf select_type2">
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $header_fix_options as $option ) {
          $header_fix_setting = $options['mobile_header_fix'];
            if ( '' != $header_fix_setting ) {
              if ( $options['mobile_header_fix'] == $option['value'] ) {
                $checked = "checked=\"checked\"";
              } else {
                $checked = '';
              }
           }
     ?>
     <label class="description">
      <input type="radio" name="dp_options[mobile_header_fix]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
      <?php echo $option['label']; ?>
     </label>
     <?php } ?>
    </fieldset>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // Color設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Color of header', 'tcd-w');  ?></h3>
    <p><?php _e('The background color set in the third color of the basic setting item is applied.', 'tcd-w'); ?></p>
    <h4 class="theme_option_headline2"><?php _e('Opacity of background', 'tcd-w'); ?></h4>
    <p><?php _e('Please set it only when fixed header display is set. Please enter the number 0 - 1.0. (e.g. 0.8)', 'tcd-w'); ?></p>
    <input id="dp_options[header_fix_background_opacity]" class="font_size hankaku" type="text" name="dp_options[header_fix_background_opacity]" value="<?php echo esc_attr( $options['header_fix_background_opacity'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

  </div><!-- END #tab-content10 -->




  <!-- #tab-content11 フッター　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■  -->
  <div id="tab-content11">

   <?php // 住所 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Footer address and telephone number', 'tcd-w'); ?></h3>
    <h4 class="theme_option_headline2"><?php _e('Shop name', 'tcd-w'); ?></h4>
    <input id="dp_options[footer_shopname]" class="large-text" type="text" name="dp_options[footer_shopname]" value="<?php echo esc_attr( $options['footer_shopname'] ); ?>" />
    <h4 class="theme_option_headline2"><?php _e('Address', 'tcd-w'); ?></h4>
    <textarea class="large-text" name="dp_options[footer_address]" rows="2"><?php echo esc_textarea( $options['footer_address'] ); ?></textarea>
    <h4 class="theme_option_headline2"><?php _e('Phone number', 'tcd-w'); ?></h4>
    <input id="dp_options[footer_phonenumber]" class="large-text" type="text" name="dp_options[footer_phonenumber]" value="<?php echo esc_attr( $options['footer_phonenumber'] ); ?>" />
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // SNSボタン ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('SNS button setting', 'tcd-w'); ?></h3>
    <p><?php _e('Enter url of your twitter, facebook and instagram page. If it is blank SNS button will not be shown.', 'tcd-w'); ?></p>
    <ul>
     <li>
      <label style="display:inline-block; min-width:140px;"><?php _e('your twitter URL', 'tcd-w'); ?></label>
      <input id="dp_options[twitter_url]" class="regular-text" type="text" name="dp_options[twitter_url]" value="<?php echo esc_attr( $options['twitter_url'] ); ?>" />
     </li>
     <li>
      <label style="display:inline-block; min-width:140px;"><?php _e('your facebook URL', 'tcd-w'); ?></label>
      <input id="dp_options[facebook_url]" class="regular-text" type="text" name="dp_options[facebook_url]" value="<?php echo esc_attr( $options['facebook_url'] ); ?>" />
     </li>
     <li>
      <label style="display:inline-block; min-width:140px;"><?php _e('your instagram URL', 'tcd-w'); ?></label>
      <input id="dp_options[insta_url]" class="regular-text" type="text" name="dp_options[insta_url]" value="<?php echo esc_attr( $options['insta_url'] ); ?>" />
     </li>
    </ul>
    <hr />
    <p><label><input id="dp_options[show_rss]" name="dp_options[show_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_rss'] ); ?> /> <?php _e('Display RSS button', 'tcd-w'); ?></label></p>
    <input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
   </div>

   <?php // フッターバーの設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Setting of the footer bar for smart phone', 'tcd-w' ); ?></h3>
    <p><?php _e( 'Please set the footer bar which is displayed with smart phone.', 'tcd-w' ); ?>

    <h4 class="theme_option_headline2"><?php _e('Display type of the footer bar', 'tcd-w'); ?></h4>
    <fieldset class="cf select_type2">
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $footer_bar_display_options as $option ) {
          $footer_bar_display_setting = $options['footer_bar_display'];
            if ( '' != $footer_bar_display_setting ) {
              if ( $options['footer_bar_display'] == $option['value'] ) {
                $checked = "checked=\"checked\"";
              } else {
                $checked = '';
              }
           }
     ?>
     <label class="description">
      <input type="radio" name="dp_options[footer_bar_display]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
      <?php echo $option['label']; ?>
     </label>
     <?php } ?>
    </fieldset>

    <h4 class="theme_option_headline2"><?php _e('Settings for the appearance of the footer bar', 'tcd-w'); ?></h4>
    <p>
     <?php _e('Background color', 'tcd-w'); ?>
     <input type="text" id="footer_bar_bg" class="color" name="dp_options[footer_bar_bg]" value="<?php echo esc_attr( $options['footer_bar_bg'] ); ?>" />
     <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('footer_bar_bg').color.fromString('FFFFFF')">
	</p>
    <p>
     <?php _e('Border color', 'tcd-w'); ?>
     <input type="text" id="footer_bar_border" class="color" name="dp_options[footer_bar_border]" value="<?php echo esc_attr( $options['footer_bar_border'] ); ?>" />
     <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('footer_bar_border').color.fromString('DDDDDD')">
	</p>
    <p>
     <?php _e('Font color', 'tcd-w'); ?>
     <input type="text" id="footer_bar_color" class="color" name="dp_options[footer_bar_color]" value="<?php echo esc_attr( $options['footer_bar_color'] ); ?>" />
     <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w'); ?>" onClick="document.getElementById('footer_bar_color').color.fromString('000000')">
	</p>
	<p>
     <?php _e('Opacity of background', 'tcd-w'); ?>
     <input id="dp_options[footer_bar_tp]" class="font_size hankaku" type="text" name="dp_options[footer_bar_tp]" value="<?php echo esc_attr( $options['footer_bar_tp'] ); ?>" /><br>
     <?php _e('Please enter the number 0 - 1.0. (e.g. 0.8)', 'tcd-w'); ?>
	</p>

    <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-w'); ?></h4>
   	<p><?php _e( 'You can display the button with icon in footer bar. (We recommend you to set max 4 buttons.)', 'tcd-w' ); ?><br><?php _e( 'You can select button types below.', 'tcd-w' ); ?></p>
    <table class="table-border">
     <tr>
      <th><?php _e( 'Default', 'tcd-w' ); ?></th>
      <td><?php _e( 'You can set link URL.', 'tcd-w' ); ?></td>
     </tr>
     <tr>
      <th><?php _e( 'Share', 'tcd-w' ); ?></th>
      <td><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-w' ); ?></td>
     </tr>
     <tr>
      <th><?php _e( 'Telephone', 'tcd-w' ); ?></th>
      <td><?php _e( 'You can call this number.', 'tcd-w' ); ?></td>
     </tr>
    </table>
    <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-w' ); ?></p>
    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
<?php
    if ( $options['footer_bar_btns'] ) :
      foreach ( $options['footer_bar_btns'] as $key => $value ) :  
?>
      <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
       <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
       <div class="sub_box_content">
        <p class="footer-bar-target" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><label><input name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
        <table class="table-repeater">
         <tr class="footer-bar-type">
          <th><label><?php _e( 'Button type', 'tcd-w' ); ?></label></th>
          <td>

           <select name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </td>
         </tr>
         <tr>
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]"><?php _e( 'Button label', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]" class="regular-text repeater-label" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></td>
         </tr>
         <tr class="footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>">
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]"><?php _e( 'Link URL', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]" class="regular-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></td>
         </tr>
         <tr class="footer-bar-number" style="<?php if ( $value['type'] !== 'type3' ) { echo 'display: none;'; } ?>">
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]"><?php _e( 'Phone number', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]" class="regular-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>"></td>
         </tr>
         <tr>
          <th><?php _e( 'Button icon', 'tcd-w' ); ?></th>
          <td>
           <?php foreach( $footer_bar_icon_options as $option ) : ?>
           <p><label><input type="radio" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr( $option['value'] ); ?>"></span><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
           <?php endforeach; ?>
          </td>
         </tr>
        </table>
        <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
       </div>
      </div>
<?php
      endforeach;
    endif;

    $key = 'addindex';
    ob_start();
?>
      <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <p class="footer-bar-target"><label><input name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1"><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
        <table class="table-repeater">
         <tr class="footer-bar-type">
          <th><label><?php _e( 'Button type', 'tcd-w' ); ?></label></th>
          <td>
           <select name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>"><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </td>
         </tr>
         <tr>
          <th><label for="dp_options[repeater_footer_bar_btn<?php echo esc_attr( $key ); ?>_label]"><?php _e( 'Button label', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]" class="regular-text repeater-label" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></td>
         </tr>
         <tr class="footer-bar-url">
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]"><?php _e( 'Link URL', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]" class="regular-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value=""></td>
         </tr>
         <tr class="footer-bar-number" style="display: none;">
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]"><?php _e( 'Phone number', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]" class="regular-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value=""></td>
         </tr>
         <tr>
          <th><?php _e( 'Button icon', 'tcd-w' ); ?></th>
          <td>
           <?php foreach( $footer_bar_icon_options as $option ) : ?>
           <p><label><input type="radio" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr( $option['value'] ); ?>"<?php if ( 'file-text' == $option['value'] ) { echo ' checked="checked"'; } ?>><span class="icon icon-<?php echo esc_attr( $option['value'] ); ?>"></span><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
           <?php endforeach; ?>
          </td>
         </tr>
        </table>
        <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
       </div>
      </div>
<?php
    $clone = ob_get_clean();
?>
     </div>
     <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
    </div>
    <input type="submit" class="button-ml" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>"> 
   </div><!-- END .theme_option_field -->

  </div><!-- END #tab-content11 -->


  </div><!-- END #tab-panel -->

  </form>

  </div><!-- END #my_theme_right -->

 </div><!-- END #my_theme_option -->

</div><!-- END #wrap -->

<?php

 }


/**
 * チェック ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function theme_options_validate( $input ) {

 global $load_time_options, $load_icon_type, $hover_type_options, $hover2_direct_options, $font_type_options, $headline_font_type_options, $responsive_options, $slider_content_type_options, $slider_time_options, $blog_num_options, $news_num_options, $header_fix_options, $sns_type_top_options, $sns_type_btm_options, $dp_upload_error, $footer_bar_icon_options, $footer_bar_button_options, $footer_bar_display_options, $gmap_marker_type_options, $gmap_custom_marker_type_options;

 //色の設定
 $input['pickedcolor1'] = wp_filter_nohtml_kses( $input['pickedcolor1'] );
 $input['pickedcolor2'] = wp_filter_nohtml_kses( $input['pickedcolor2'] );
 $input['pickedcolor3'] = wp_filter_nohtml_kses( $input['pickedcolor3'] );
 $input['content_link_color'] = wp_filter_nohtml_kses( $input['content_link_color'] );

 // ファビコン
 $input['favicon'] = wp_filter_nohtml_kses( $input['favicon'] );

	if ( isset( $_FILES['favicon_file'] ) ) {
		// 画像のアップロードに問題はないか
		if ( $_FILES['favicon_file']['error'] === 0 ) {
			$name = sanitize_file_name( $_FILES['favicon_file']['name'] );
			// ファイル形式をチェック
			if ( ! preg_match( '/\.(png|ico|gif)$/i', $name ) ) {
				add_settings_error( 'design_plus_options', 'dp_uploader', sprintf( __( 'You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w' ), $name ), 'error' );
			} else {
				// ディレクトリの存在をチェック
				if ( ( ( file_exists( dp_logo_basedir() ) && is_dir( dp_logo_basedir() ) && is_writable( dp_logo_basedir() ) ) || @mkdir( dp_logo_basedir() ) ) && move_uploaded_file( $_FILES['favicon_file']['tmp_name'], dp_logo_basedir() . DIRECTORY_SEPARATOR . $name ) ) {
					$input['favicon'] = dp_logo_baseurl() . '/'. $name;
				} else {
					add_settings_error( 'default', 'dp_uploader', sprintf( __( 'Directory %s is not writable. Please check permission.', 'tcd-w' ), dp_logo_basedir() ), 'error' );
				}
			}
		} elseif ( $_FILES['favicon_file']['error'] !== UPLOAD_ERR_NO_FILE ) {
			add_settings_error( 'default', 'dp_uploader', _dp_get_upload_err_msg( $_FILES['favicon_file']['error'] ), 'error' );
		}
	}

 //フォントの種類
 if ( ! isset( $input['font_type'] ) )
  $input['font_type'] = null;
 if ( ! array_key_exists( $input['font_type'], $font_type_options ) )
  $input['font_type'] = null;
 if ( ! isset( $input['headline_font_type'] ) )
  $input['headline_font_type'] = null;
 if ( ! array_key_exists( $input['headline_font_type'], $headline_font_type_options ) )
  $input['headline_font_type'] = null;

 //hover effect
 if ( ! isset( $input['hover_type'] ) )
  $input['hover_type'] = null;
 if ( ! array_key_exists( $input['hover_type'], $hover_type_options ) )
  $input['hover_type'] = null;

 // hover1
 $input['hover1_zoom'] = wp_filter_nohtml_kses( $input['hover1_zoom'] );
 // hover2
 if ( ! isset( $input['hover2_direct'] ) )
  $input['hover2_direct'] = null;
 if ( ! array_key_exists( $input['hover2_direct'], $hover2_direct_options ) )
  $input['hover2_direct'] = null;
 $input['hover2_opacity'] = wp_filter_nohtml_kses( $input['hover2_opacity'] );
 $input['hover2_bgcolor'] = wp_filter_nohtml_kses( $input['hover2_bgcolor'] );
 // hover3
 $input['hover3_opacity'] = wp_filter_nohtml_kses( $input['hover3_opacity'] );
 $input['hover3_bgcolor'] = wp_filter_nohtml_kses( $input['hover3_bgcolor'] );

 //OGPタグ関連
 if ( ! isset( $input['use_ogp'] ) )
  $input['use_ogp'] = null;
 $input['use_ogp'] = ( !empty($input['use_ogp']) == 1 ? 1 : 0 );
 $input['fb_admin_id'] = wp_filter_nohtml_kses( $input['fb_admin_id'] );
 $input['fb_app_id'] = wp_filter_nohtml_kses( $input['fb_app_id'] );
 $input['ogp_image'] = wp_filter_nohtml_kses( $input['ogp_image'] );
 if ( ! isset( $input['use_twitter_card'] ) )
  $input['use_twitter_card'] = null;
 $input['use_twitter_card'] = ( !empty($input['use_twitter_card']) == 1 ? 1 : 0 );
 $input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );

 //オリジナルスタイルの設定
 $input['css_code'] = $input['css_code'];

 //オリジナルスタイルの設定
 $input['custom_head'] = $input['custom_head'];

 //レスポンシブの設定
 if ( ! isset( $input['responsive'] ) )
  $input['responsive'] = null;
 if ( ! array_key_exists( $input['responsive'], $responsive_options ) )
  $input['responsive'] = null;

 //sidebarの設定
 if ( ! isset( $input['column_float'] ) )
  $input['column_float'] = null;
 $input['column_float'] = ( $input['column_float'] == 1 ? 1 : 0 );

 //絵文字の設定
 if ( ! isset( $input['use_emoji'] ) )
  $input['use_emoji'] = null;
 $input['use_emoji'] = ( $input['use_emoji'] == 1 ? 1 : 0 );

 //ロードアイコンの設定
 if ( ! isset( $input['use_load_icon'] ) )
  $input['use_load_icon'] = null;
 $input['use_load_icon'] = ( $input['use_load_icon'] == 1 ? 1 : 0 );
 if ( ! isset( $input['load_time'] ) )
  $input['load_time'] = null;
 if ( ! array_key_exists( $input['load_time'], $load_time_options ) )
  $input['load_time'] = null;
 if ( ! isset( $input['load_icon'] ) )
  $input['load_icon'] = null;
 if ( ! array_key_exists( $input['load_icon'], $load_icon_type ) )
  $input['load_icon'] = 'type1';

 // 404 ページ
 $input['header_image_404'] = wp_filter_nohtml_kses( $input['header_image_404'] );
 $input['header_txt_404'] = wp_filter_nohtml_kses( $input['header_txt_404'] );
 $input['header_sub_txt_404'] = wp_filter_nohtml_kses( $input['header_sub_txt_404'] );
 $input['header_txt_size_404'] = wp_filter_nohtml_kses( $input['header_txt_size_404'] );
 $input['header_sub_txt_size_404'] = wp_filter_nohtml_kses( $input['header_sub_txt_size_404'] );
 $input['header_txt_size_404_mobile'] = wp_filter_nohtml_kses( $input['header_txt_size_404_mobile'] );
 $input['header_sub_txt_size_404_mobile'] = wp_filter_nohtml_kses( $input['header_sub_txt_size_404_mobile'] );
 $input['header_txt_color_404'] = wp_filter_nohtml_kses( $input['header_txt_color_404'] );
 $input['dropshadow_404_h'] = wp_filter_nohtml_kses( $input['dropshadow_404_h'] );
 $input['dropshadow_404_v'] = wp_filter_nohtml_kses( $input['dropshadow_404_v'] );
 $input['dropshadow_404_b'] = wp_filter_nohtml_kses( $input['dropshadow_404_b'] );
 $input['dropshadow_404_c'] = wp_filter_nohtml_kses( $input['dropshadow_404_c'] );

// Google Maps 
$input['gmap_api_key'] = wp_filter_nohtml_kses( $input['gmap_api_key'] );
if ( ! isset( $input['gmap_marker_type'] ) || ! array_key_exists( $input['gmap_marker_type'], $gmap_marker_type_options ) )
	$input['gmap_marker_type'] = $dp_default_options['gmap_marker_type'];
if ( ! isset( $input['gmap_custom_marker_type'] ) || ! array_key_exists( $input['gmap_custom_marker_type'], $gmap_custom_marker_type_options ) )
	$input['gmap_custom_marker_type'] = $dp_default_options['gmap_custom_marker_type'];
$input['gmap_marker_text'] = wp_filter_nohtml_kses( $input['gmap_marker_text'] );
$input['gmap_marker_color'] = '#'.wp_filter_nohtml_kses( $input['gmap_marker_color'] );
$input['gmap_marker_img'] = wp_filter_nohtml_kses( $input['gmap_marker_img'] );
$input['gmap_marker_bg'] = '#'.wp_filter_nohtml_kses( $input['gmap_marker_bg'] );

 //ロゴ
 $input['logo_font_size'] = wp_filter_nohtml_kses( $input['logo_font_size'] );
 $input['logo_font_size_fix'] = wp_filter_nohtml_kses( $input['logo_font_size_fix'] );
 $input['logo_font_size_mobile'] = wp_filter_nohtml_kses( $input['logo_font_size_mobile'] );
 $input['logo_font_size_mobile_fix'] = wp_filter_nohtml_kses( $input['logo_font_size_mobile_fix'] );
 $input['logo_font_size_footer'] = wp_filter_nohtml_kses( $input['logo_font_size_footer'] );
 $input['header_logo_image'] = wp_filter_nohtml_kses( $input['header_logo_image'] );
 $input['header_logo_image_fix'] = wp_filter_nohtml_kses( $input['header_logo_image_fix'] );
 $input['header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['header_logo_image_mobile'] );
 $input['header_logo_image_mobile_fix'] = wp_filter_nohtml_kses( $input['header_logo_image_mobile_fix'] );
 $input['footer_logo_image'] = wp_filter_nohtml_kses( $input['footer_logo_image'] );
 if ( ! isset( $input['header_logo_retina'] ) )
  $input['header_logo_retina'] = null;
 $input['header_logo_retina'] = ( $input['header_logo_retina'] == 1 ? 1 : 0 );
 if ( ! isset( $input['header_logo_retina_fix'] ) )
  $input['header_logo_retina_fix'] = null;
 $input['header_logo_retina_fix'] = ( $input['header_logo_retina_fix'] == 1 ? 1 : 0 );
 if ( ! isset( $input['header_logo_retina_mobile'] ) )
  $input['header_logo_retina_mobile'] = null;
 $input['header_logo_retina_mobile'] = ( $input['header_logo_retina_mobile'] == 1 ? 1 : 0 );
 if ( ! isset( $input['header_logo_retina_mobile_fix'] ) )
  $input['header_logo_retina_mobile_fix'] = null;
 $input['header_logo_retina_mobile_fix'] = ( $input['header_logo_retina_mobile_fix'] == 1 ? 1 : 0 );
 if ( ! isset( $input['footer_logo_retina'] ) )
  $input['footer_logo_retina'] = null;
 $input['footer_logo_retina'] = ( $input['footer_logo_retina'] == 1 ? 1 : 0 );

 //トップページのスライダー
 if ( ! isset( $input['show_index_slider'] ) )
  $input['show_index_slider'] = null;
 $input['show_index_slider'] = ( $input['show_index_slider'] == 1 ? 1 : 0 );

 for ($i = 1; $i <= 5; $i++) {
  if (isset($input['slider_content_type'.$i]) && array_key_exists($input['slider_content_type'.$i], $slider_content_type_options)) {
   $input['slider_content_type'.$i] = $input['slider_content_type'.$i];
  } else {
   $input['slider_content_type'.$i] = 'type1';
  }
  $input['slider_image'.$i] = wp_filter_nohtml_kses( $input['slider_image'.$i] );
  $input['slider_image_mobile'.$i] = wp_filter_nohtml_kses( $input['slider_image_mobile'.$i] );
  $input['slider_url'.$i] = wp_filter_nohtml_kses( $input['slider_url'.$i] );
  if ( ! isset( $input['slider_target'.$i] ) )
   $input['slider_target'.$i] = null;
  $input['slider_target'.$i] = ( $input['slider_target'.$i] == 1 ? 1 : 0 );
  $input['slider_overlay'.$i] = wp_filter_nohtml_kses( $input['slider_overlay'.$i] );
  if ( ! isset( $input['use_slider_overlay'.$i] ) )
   $input['use_slider_overlay'.$i] = null;
  $input['use_slider_overlay'.$i] = ( $input['use_slider_overlay'.$i] == 1 ? 1 : 0 );
  $input['slider_overlay_opacity'.$i] = wp_filter_nohtml_kses( $input['slider_overlay_opacity'.$i] );
  if ( ! isset( $input['use_slider_caption'.$i] ) )
   $input['use_slider_caption'.$i] = null;
  $input['use_slider_caption'.$i] = ( $input['use_slider_caption'.$i] == 1 ? 1 : 0 );
  $input['slider_headline'.$i] = wp_filter_nohtml_kses( $input['slider_headline'.$i] );
  $input['slider_headline_font_size'.$i] = wp_filter_nohtml_kses( $input['slider_headline_font_size'.$i] );
  $input['slider_headline_font_size_mobile'.$i] = wp_filter_nohtml_kses( $input['slider_headline_font_size_mobile'.$i] );
  $input['slider_headline_color'.$i] = wp_filter_nohtml_kses( $input['slider_headline_color'.$i] );
  $input['slider_headline_shadow_a'.$i] = wp_filter_nohtml_kses( $input['slider_headline_shadow_a'.$i] );
  $input['slider_headline_shadow_b'.$i] = wp_filter_nohtml_kses( $input['slider_headline_shadow_b'.$i] );
  $input['slider_headline_shadow_c'.$i] = wp_filter_nohtml_kses( $input['slider_headline_shadow_c'.$i] );
  $input['slider_headline_shadow_color'.$i] = wp_filter_nohtml_kses( $input['slider_headline_shadow_color'.$i] );
  $input['slider_caption'.$i] = wp_filter_nohtml_kses( $input['slider_caption'.$i] );
  $input['slider_caption_font_size'.$i] = wp_filter_nohtml_kses( $input['slider_caption_font_size'.$i] );
  $input['slider_caption_font_size_mobile'.$i] = wp_filter_nohtml_kses( $input['slider_caption_font_size_mobile'.$i] );
  $input['slider_caption_color'.$i] = wp_filter_nohtml_kses( $input['slider_caption_color'.$i] );
  $input['slider_caption_shadow_a'.$i] = wp_filter_nohtml_kses( $input['slider_caption_shadow_a'.$i] );
  $input['slider_caption_shadow_b'.$i] = wp_filter_nohtml_kses( $input['slider_caption_shadow_b'.$i] );
  $input['slider_caption_shadow_c'.$i] = wp_filter_nohtml_kses( $input['slider_caption_shadow_c'.$i] );
  $input['slider_caption_shadow_color'.$i] = wp_filter_nohtml_kses( $input['slider_caption_shadow_color'.$i] );
  if ( ! isset( $input['show_slider_caption_button'.$i] ) )
   $input['show_slider_caption_button'.$i] = null;
  $input['show_slider_caption_button'.$i] = ( $input['show_slider_caption_button'.$i] == 1 ? 1 : 0 );
  $input['slider_caption_button'.$i] = wp_filter_nohtml_kses( $input['slider_caption_button'.$i] );
  $input['slider_button_color'.$i] = wp_filter_nohtml_kses( $input['slider_button_color'.$i] );
  $input['slider_button_bg_color'.$i] = wp_filter_nohtml_kses( $input['slider_button_bg_color'.$i] );
  $input['slider_button_bg_opaciry'.$i] = wp_filter_nohtml_kses( $input['slider_button_bg_opaciry'.$i] );
  $input['slider_button_border_color'.$i] = wp_filter_nohtml_kses( $input['slider_button_border_color'.$i] );
  $input['slider_button_color_hover'.$i] = wp_filter_nohtml_kses( $input['slider_button_color_hover'.$i] );
  $input['slider_button_bg_color_hover'.$i] = wp_filter_nohtml_kses( $input['slider_button_bg_color_hover'.$i] );
  $input['slider_button_bg_opaciry_hover'.$i] = wp_filter_nohtml_kses( $input['slider_button_bg_opaciry_hover'.$i] );
  $input['slider_button_border_color_hover'.$i] = wp_filter_nohtml_kses( $input['slider_button_border_color_hover'.$i] );
  $input['slider_video'.$i] = wp_filter_nohtml_kses( $input['slider_video'.$i] );
  $input['slider_video_image'.$i] = wp_filter_nohtml_kses( $input['slider_video_image'.$i] );
  $input['slider_youtube_url'.$i] = wp_filter_nohtml_kses( $input['slider_youtube_url'.$i] );
  $input['slider_youtube_image'.$i] = wp_filter_nohtml_kses( $input['slider_youtube_image'.$i] );
 }
 if ( ! isset( $input['slider_time'] ) )
  $input['slider_time'] = null;
 if ( ! array_key_exists( $input['slider_time'], $slider_time_options ) )
  $input['slider_time'] = null;

 // トップページトピックス
 if ( ! isset( $input['show_index_topics_content'] ) )
  $input['show_index_topics_content'] = null;
 $input['show_index_topics_content'] = ( $input['show_index_topics_content'] == 1 ? 1 : 0 );
 $input['index_topics_headline'] = wp_filter_nohtml_kses( $input['index_topics_headline'] );
 if ( ! isset( $input['show_date_index_topics'] ) )
  $input['show_date_index_topics'] = null;
 $input['show_date_index_topics'] = ( $input['show_date_index_topics'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_index_topics_news'] ) )
  $input['show_index_topics_news'] = null;
 $input['show_index_topics_news'] = ( $input['show_index_topics_news'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_index_topics_campaign'] ) )
  $input['show_index_topics_campaign'] = null;
 $input['show_index_topics_campaign'] = ( $input['show_index_topics_campaign'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_index_topics_blog'] ) )
  $input['show_index_topics_blog'] = null;
 $input['show_index_topics_blog'] = ( $input['show_index_topics_blog'] == 1 ? 1 : 0 );
 $input['index_topics_num'] = intval( $input['index_topics_num'] );
 $input['index_topics_bg_opacity'] = wp_filter_nohtml_kses( $input['index_topics_bg_opacity'] );

 //トップページコンテンツ1
 if ( ! isset( $input['show_index_content1'] ) )
  $input['show_index_content1'] = null;
 $input['show_index_content1'] = ( $input['show_index_content1'] == 1 ? 1 : 0 );
 $input['index_content1_headline1'] = wp_filter_nohtml_kses( $input['index_content1_headline1'] );
 $input['index_content1_headline_font_size1'] = wp_filter_nohtml_kses( $input['index_content1_headline_font_size1'] );
 $input['index_content1_desc1'] = $input['index_content1_desc1'];
 $input['index_content1_desc_font_size1'] = wp_filter_nohtml_kses( $input['index_content1_desc_font_size1'] );
 $input['index_content1_image1'] = wp_filter_nohtml_kses( $input['index_content1_image1'] );
 $input['index_content1_url1'] = wp_filter_nohtml_kses( $input['index_content1_url1'] );
 if ( ! isset( $input['index_content1_target1'] ) )
  $input['index_content1_target1'] = null;
 $input['index_content1_target1'] = ( $input['index_content1_target1'] == 1 ? 1 : 0 );
 $input['index_content1_headline2'] = wp_filter_nohtml_kses( $input['index_content1_headline2'] );
 $input['index_content1_headline_font_size2'] = wp_filter_nohtml_kses( $input['index_content1_headline_font_size2'] );
 $input['index_content1_desc2'] = $input['index_content1_desc2'];
 $input['index_content1_desc_font_size2'] = wp_filter_nohtml_kses( $input['index_content1_desc_font_size2'] );
 $input['index_content1_image2'] = wp_filter_nohtml_kses( $input['index_content1_image2'] );
 $input['index_content1_url2'] = wp_filter_nohtml_kses( $input['index_content1_url2'] );
 if ( ! isset( $input['index_content1_target2'] ) )
  $input['index_content1_target2'] = null;
 $input['index_content1_target2'] = ( $input['index_content1_target2'] == 1 ? 1 : 0 );
 $input['index_content1_headline3'] = wp_filter_nohtml_kses( $input['index_content1_headline3'] );
 $input['index_content1_headline_font_size3'] = wp_filter_nohtml_kses( $input['index_content1_headline_font_size3'] );
 $input['index_content1_desc3'] = $input['index_content1_desc3'];
 $input['index_content1_desc_font_size3'] = wp_filter_nohtml_kses( $input['index_content1_desc_font_size3'] );
 $input['index_content1_image3'] = wp_filter_nohtml_kses( $input['index_content1_image3'] );
 $input['index_content1_url3'] = wp_filter_nohtml_kses( $input['index_content1_url3'] );
 if ( ! isset( $input['index_content1_target3'] ) )
  $input['index_content1_target3'] = null;
 $input['index_content1_target3'] = ( $input['index_content1_target3'] == 1 ? 1 : 0 );

 //トップページコンテンツ2
 if ( ! isset( $input['show_index_content2'] ) )
  $input['show_index_content2'] = null;
 $input['show_index_content2'] = ( $input['show_index_content2'] == 1 ? 1 : 0 );
 $input['index_content2_headline'] = wp_filter_nohtml_kses( $input['index_content2_headline'] );
 $input['index_content2_headline_font_size'] = wp_filter_nohtml_kses( $input['index_content2_headline_font_size'] );
 $input['index_content2_headline_color'] = wp_filter_nohtml_kses( $input['index_content2_headline_color'] );
 $input['index_content2_desc'] = $input['index_content2_desc'];
 $input['index_content2_desc_font_size'] = wp_filter_nohtml_kses( $input['index_content2_desc_font_size'] );

 //トップページのコース
 if ( ! isset( $input['show_index_course_content'] ) )
  $input['show_index_course_content'] = null;
 $input['show_index_course_content'] = ( $input['show_index_course_content'] == 1 ? 1 : 0 );

 //トップページのお知らせ
 if ( ! isset( $input['show_index_news_content'] ) )
  $input['show_index_news_content'] = null;
 $input['show_index_news_content'] = ( $input['show_index_news_content'] == 1 ? 1 : 0 );
 $input['index_news_headline'] = wp_filter_nohtml_kses( $input['index_news_headline'] );
 if ( ! isset( $input['show_index_news_button'] ) )
  $input['show_index_news_button'] = null;
 $input['show_index_news_button'] = ( $input['show_index_news_button'] == 1 ? 1 : 0 );
 $input['index_news_button'] = wp_filter_nohtml_kses( $input['index_news_button'] );
 $input['index_news_num'] = intval( $input['index_news_num'] );

 //トップページのキャンペーン
 if ( ! isset( $input['show_index_campaign_content'] ) )
  $input['show_index_campaign_content'] = null;
 $input['show_index_campaign_content'] = ( $input['show_index_campaign_content'] == 1 ? 1 : 0 );
 $input['index_campaign_headline'] = wp_filter_nohtml_kses( $input['index_campaign_headline'] );
 if ( ! isset( $input['show_index_campaign_button'] ) )
  $input['show_index_campaign_button'] = null;
 $input['show_index_campaign_button'] = ( $input['show_index_campaign_button'] == 1 ? 1 : 0 );
 $input['index_campaign_button'] = wp_filter_nohtml_kses( $input['index_campaign_button'] );
 $input['index_campaign_num'] = intval( $input['index_campaign_num'] );

 //トップページのお客様の声
 if ( ! isset( $input['show_index_voice_content'] ) )
  $input['show_index_voice_content'] = null;
 $input['show_index_voice_content'] = ( $input['show_index_voice_content'] == 1 ? 1 : 0 );
 $input['index_voice_headline'] = wp_filter_nohtml_kses( $input['index_voice_headline'] );
 $input['index_voice_headline_sub'] = wp_filter_nohtml_kses( $input['index_voice_headline_sub'] );
 $input['index_voice_num'] = intval( $input['index_voice_num'] );
 if ( ! isset( $input['show_index_voice_button'] ) )
  $input['show_index_voice_button'] = null;
 $input['show_index_voice_button'] = ( $input['show_index_voice_button'] == 1 ? 1 : 0 );
 $input['index_voice_button'] = wp_filter_nohtml_kses( $input['index_voice_button'] );

 //トップページのブログ
 if ( ! isset( $input['show_index_blog_content'] ) )
  $input['show_index_blog_content'] = null;
 $input['show_index_blog_content'] = ( $input['show_index_blog_content'] == 1 ? 1 : 0 );
 $input['index_blog_headline'] = wp_filter_nohtml_kses( $input['index_blog_headline'] );
 $input['index_blog_num'] = intval( $input['index_blog_num'] );
 if ( ! isset( $input['show_index_blog_button'] ) )
  $input['show_index_blog_button'] = null;
 $input['show_index_blog_button'] = ( $input['show_index_blog_button'] == 1 ? 1 : 0 );
 $input['index_blog_button'] = wp_filter_nohtml_kses( $input['index_blog_button'] );

 //トップページの営業日
 $input['show_index_business_day'] = ( ! empty( $input['show_index_business_day'] ) ) ? 1 : 0;

// $input['index_business_day_postid'] = ( ! empty( $input['show_index_business_day'] ) ) ? intval( $input['index_business_day_postid'] ) : '';
 $input['index_business_day_postid'] = absint( $input['index_business_day_postid'] );
 if (!$input['index_business_day_postid']) $input['index_business_day_postid'] = '';
 $input['index_business_day_num'] = intval( $input['index_business_day_num'] );

 //ブログアーカイブページの設定
 $input['blog_archive_headline'] = wp_filter_nohtml_kses( $input['blog_archive_headline'] );
 $input['blog_archive_headline_sub'] = wp_filter_nohtml_kses( $input['blog_archive_headline_sub'] );
 $input['blog_breadcrumb_headline'] = wp_filter_nohtml_kses( $input['blog_breadcrumb_headline'] );

 //ブログ記事ページのフォントサイズ
 $input['title_font_size'] = wp_filter_nohtml_kses( $input['title_font_size'] );
 $input['content_font_size'] = wp_filter_nohtml_kses( $input['content_font_size'] );
 $input['title_font_size_mobile'] = wp_filter_nohtml_kses( $input['title_font_size_mobile'] );
 $input['content_font_size_mobile'] = wp_filter_nohtml_kses( $input['content_font_size_mobile'] );

 //ブログ記事ページの表示設定
 if ( ! isset( $input['show_date'] ) )
  $input['show_date'] = null;
 $input['show_date'] = ( $input['show_date'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_category'] ) )
  $input['show_category'] = null;
 $input['show_category'] = ( $input['show_category'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_tag'] ) )
  $input['show_tag'] = null;
 $input['show_tag'] = ( $input['show_tag'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_comment'] ) )
  $input['show_comment'] = null;
 $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_trackback'] ) )
  $input['show_trackback'] = null;
 $input['show_trackback'] = ( $input['show_trackback'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_related_post'] ) )
  $input['show_related_post'] = null;
 $input['show_related_post'] = ( $input['show_related_post'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_next_post'] ) )
  $input['show_next_post'] = null;
 $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_thumbnail'] ) )
  $input['show_thumbnail'] = null;
 $input['show_thumbnail'] = ( $input['show_thumbnail'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_author'] ) )
  $input['show_author'] = null;
 $input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );
 $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
 $input['related_post_num'] = intval( $input['related_post_num'] );

 //ソーシャルボタンの表示設定
 if ( ! isset( $input['sns_type_top'] ) )
  $input['sns_type_top'] = null;
 if ( ! array_key_exists( $input['sns_type_top'], $sns_type_top_options ) )
  $input['sns_type_top'] = null;
 if ( ! isset( $input['show_sns_top'] ) )
  $input['show_sns_top'] = null;
 $input['show_sns_top'] = ( $input['show_sns_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_twitter_top'] ) )
  $input['show_twitter_top'] = null;
 $input['show_twitter_top'] = ( $input['show_twitter_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_fblike_top'] ) )
  $input['show_fblike_top'] = null;
 $input['show_fblike_top'] = ( $input['show_fblike_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_fbshare_top'] ) )
  $input['show_fbshare_top'] = null;
 $input['show_fbshare_top'] = ( $input['show_fbshare_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_google_top'] ) )
  $input['show_google_top'] = null;
 $input['show_google_top'] = ( $input['show_google_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_hatena_top'] ) )
  $input['show_hatena_top'] = null;
 $input['show_hatena_top'] = ( $input['show_hatena_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_pocket_top'] ) )
  $input['show_pocket_top'] = null;
 $input['show_pocket_top'] = ( $input['show_pocket_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_feedly_top'] ) )
  $input['show_feedly_top'] = null;
 $input['show_feedly_top'] = ( $input['show_feedly_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_rss_top'] ) )
  $input['show_rss_top'] = null;
 $input['show_rss_top'] = ( $input['show_rss_top'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_pinterest_top'] ) )
  $input['show_pinterest_top'] = null;
 $input['show_pinterest_top'] = ( $input['show_pinterest_top'] == 1 ? 1 : 0 );

 if ( ! isset( $input['sns_type_btm'] ) )
  $input['sns_type_btm'] = null;
 if ( ! array_key_exists( $input['sns_type_btm'], $sns_type_btm_options ) )
  $input['sns_type_btm'] = null;
 if ( ! isset( $input['show_sns_btm'] ) )
  $input['show_sns_btm'] = null;
 $input['show_sns_btm'] = ( $input['show_sns_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_twitter_btm'] ) )
  $input['show_twitter_btm'] = null;
 $input['show_twitter_btm'] = ( $input['show_twitter_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_fblike_btm'] ) )
  $input['show_fblike_btm'] = null;
 $input['show_fblike_btm'] = ( $input['show_fblike_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_fbshare_btm'] ) )
  $input['show_fbshare_btm'] = null;
 $input['show_fbshare_btm'] = ( $input['show_fbshare_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_google_btm'] ) )
  $input['show_google_btm'] = null;
 $input['show_google_btm'] = ( $input['show_google_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_hatena_btm'] ) )
  $input['show_hatena_btm'] = null;
 $input['show_hatena_btm'] = ( $input['show_hatena_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_pocket_btm'] ) )
  $input['show_pocket_btm'] = null;
 $input['show_pocket_btm'] = ( $input['show_pocket_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_feedly_btm'] ) )
  $input['show_feedly_btm'] = null;
 $input['show_feedly_btm'] = ( $input['show_feedly_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_rss_btm'] ) )
  $input['show_rss_btm'] = null;
 $input['show_rss_btm'] = ( $input['show_rss_btm'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_pinterest_btm'] ) )
  $input['show_pinterest_btm'] = null;
 $input['show_pinterest_btm'] = ( $input['show_pinterest_btm'] == 1 ? 1 : 0 );
 $input['twitter_info'] = wp_filter_nohtml_kses( $input['twitter_info'] );

 //ブログ記事ページのバナー広告
 $input['single_ad_code1'] = $input['single_ad_code1'];
 $input['single_ad_image1'] = wp_filter_nohtml_kses( $input['single_ad_image1'] );
 $input['single_ad_url1'] = wp_filter_nohtml_kses( $input['single_ad_url1'] );
 $input['single_ad_code2'] = $input['single_ad_code2'];
 $input['single_ad_image2'] = wp_filter_nohtml_kses( $input['single_ad_image2'] );
 $input['single_ad_url2'] = wp_filter_nohtml_kses( $input['single_ad_url2'] );
 $input['single_ad_code3'] = $input['single_ad_code3'];
 $input['single_ad_image3'] = wp_filter_nohtml_kses( $input['single_ad_image3'] );
 $input['single_ad_url3'] = wp_filter_nohtml_kses( $input['single_ad_url3'] );
 $input['single_ad_code4'] = $input['single_ad_code4'];
 $input['single_ad_image4'] = wp_filter_nohtml_kses( $input['single_ad_image4'] );
 $input['single_ad_url4'] = wp_filter_nohtml_kses( $input['single_ad_url4'] );
 $input['single_ad_code5'] = $input['single_ad_code5'];
 $input['single_ad_image5'] = wp_filter_nohtml_kses( $input['single_ad_image5'] );
 $input['single_ad_url5'] = wp_filter_nohtml_kses( $input['single_ad_url5'] );
 $input['single_ad_code6'] = $input['single_ad_code6'];
 $input['single_ad_image6'] = wp_filter_nohtml_kses( $input['single_ad_image6'] );
 $input['single_ad_url6'] = wp_filter_nohtml_kses( $input['single_ad_url6'] );
 $input['single_mobile_ad_code1'] = $input['single_mobile_ad_code1'];
 $input['single_mobile_ad_image1'] = wp_filter_nohtml_kses( $input['single_mobile_ad_image1'] );
 $input['single_mobile_ad_url1'] = wp_filter_nohtml_kses( $input['single_mobile_ad_url1'] );
 $input['single_mobile_ad_code2'] = $input['single_mobile_ad_code2'];
 $input['single_mobile_ad_image2'] = wp_filter_nohtml_kses( $input['single_mobile_ad_image2'] );
 $input['single_mobile_ad_url2'] = wp_filter_nohtml_kses( $input['single_mobile_ad_url2'] );

 // お知らせの設定
 $input['news_archive_headline'] = wp_filter_nohtml_kses( $input['news_archive_headline'] );
 $input['news_archive_headline_sub'] = wp_filter_nohtml_kses( $input['news_archive_headline_sub'] );
 if(!isset($input['news_breadcrumb_headline'])||$input['news_breadcrumb_headline']==''){
 	$input['news_breadcrumb_headline'] = __('News', 'tcd-w');
 };
 $input['news_breadcrumb_headline'] = wp_filter_nohtml_kses( $input['news_breadcrumb_headline'] );


 if ( ! isset( $input['show_sns_top_news'] ) )
  $input['show_sns_top_news'] = null;
 $input['show_sns_top_news'] = ( $input['show_sns_top_news'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_sns_btm_news'] ) )
  $input['show_sns_btm_news'] = null;
 $input['show_sns_btm_news'] = ( $input['show_sns_btm_news'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_next_post_news'] ) )
  $input['show_next_post_news'] = null;
 $input['show_next_post_news'] = ( $input['show_next_post_news'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_date_news'] ) )
  $input['show_date_news'] = null;
 $input['show_date_news'] = ( $input['show_date_news'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_recent_news'] ) )
  $input['show_recent_news'] = null;
 $input['show_recent_news'] = ( $input['show_recent_news'] == 1 ? 1 : 0 );
 $input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
 $input['recent_news_num'] = intval( $input['recent_news_num'] );
 $input['recent_news_link_text'] = wp_filter_nohtml_kses( $input['recent_news_link_text'] );

 // campaignの設定
 $input['campaign_archive_headline'] = wp_filter_nohtml_kses( $input['campaign_archive_headline'] );
 $input['campaign_archive_headline_sub'] = wp_filter_nohtml_kses( $input['campaign_archive_headline_sub'] );
 if(!isset($input['campaign_breadcrumb_headline'])||$input['campaign_breadcrumb_headline']==''){
 	$input['campaign_breadcrumb_headline'] = __('Campaign', 'tcd-w');
 };
 $input['campaign_breadcrumb_headline'] = wp_filter_nohtml_kses( $input['campaign_breadcrumb_headline'] );

 if ( ! isset( $input['show_sns_top_campaign'] ) )
  $input['show_sns_top_campaign'] = null;
 $input['show_sns_top_campaign'] = ( $input['show_sns_top_campaign'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_sns_btm_campaign'] ) )
  $input['show_sns_btm_campaign'] = null;
 $input['show_sns_btm_campaign'] = ( $input['show_sns_btm_campaign'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_next_post_campaign'] ) )
  $input['show_next_post_campaign'] = null;
 $input['show_next_post_campaign'] = ( $input['show_next_post_campaign'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_date_campaign'] ) )
  $input['show_date_campaign'] = null;
 $input['show_date_campaign'] = ( $input['show_date_campaign'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_recent_campaign'] ) )
  $input['show_recent_campaign'] = null;
 $input['show_recent_campaign'] = ( $input['show_recent_campaign'] == 1 ? 1 : 0 );
 $input['recent_campaign_headline'] = wp_filter_nohtml_kses( $input['recent_campaign_headline'] );
 $input['recent_campaign_num'] = intval( $input['recent_campaign_num'] );
 $input['recent_campaign_link_text'] = wp_filter_nohtml_kses( $input['recent_campaign_link_text'] );
 // コースの設定
 $input['course_archive_headline'] = wp_filter_nohtml_kses( $input['course_archive_headline'] );
 $input['course_archive_headline_sub'] = wp_filter_nohtml_kses( $input['course_archive_headline_sub'] );
 if(!isset($input['course_breadcrumb_headline'])||$input['course_breadcrumb_headline']==''){
 	$input['course_breadcrumb_headline'] = __('Course', 'tcd-w');
 };
 $input['course_breadcrumb_headline'] = wp_filter_nohtml_kses( $input['course_breadcrumb_headline'] );

 if ( ! isset( $input['staff_show_related_post'] ) )
  $input['staff_show_related_post'] = null;
 $input['staff_show_related_post'] = ( $input['staff_show_related_post'] == 1 ? 1 : 0 );
 $input['staff_related_post_num'] = intval( $input['staff_related_post_num'] );
 $input['staff_related_post_headline'] = wp_filter_nohtml_kses( $input['staff_related_post_headline'] );

 // お客様の声の設定
 $input['voice_archive_headline'] = wp_filter_nohtml_kses( $input['voice_archive_headline'] );
 $input['voice_archive_headline_sub'] = wp_filter_nohtml_kses( $input['voice_archive_headline_sub'] );
 if(!isset($input['voice_breadcrumb_headline'])||$input['voice_breadcrumb_headline']==''){
 	$input['voice_breadcrumb_headline'] = __('Voice', 'tcd-w');
 };
 $input['voice_breadcrumb_headline'] = wp_filter_nohtml_kses( $input['voice_breadcrumb_headline'] );

 // スタッフコースの設定
 $input['staff_archive_headline'] = wp_filter_nohtml_kses( $input['staff_archive_headline'] );
 $input['staff_archive_headline_sub'] = wp_filter_nohtml_kses( $input['staff_archive_headline_sub'] );
 if(!isset($input['staff_breadcrumb_headline'])||$input['staff_breadcrumb_headline']==''){
 	$input['staff_breadcrumb_headline'] = __('Staff', 'tcd-w');
 };
 $input['staff_breadcrumb_headline'] = wp_filter_nohtml_kses( $input['staff_breadcrumb_headline'] );

 // ヘッダーの設定
 $input['header_fix'] = wp_filter_nohtml_kses( $input['header_fix'] );
 $input['mobile_header_fix'] = wp_filter_nohtml_kses( $input['mobile_header_fix'] );
 $input['header_fix_background_opacity'] = wp_filter_nohtml_kses( $input['header_fix_background_opacity'] );

 // フッターの設定
 $input['footer_address'] = wp_filter_nohtml_kses( $input['footer_address'] );
 $input['footer_phonenumber'] = wp_filter_nohtml_kses( $input['footer_phonenumber'] );
 $input['footer_shopname'] = wp_filter_nohtml_kses( $input['footer_shopname'] );
 $input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
 $input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );
 $input['insta_url'] = wp_filter_nohtml_kses( $input['insta_url'] );
 if ( ! isset( $input['show_rss'] ) )
  $input['show_rss'] = null;
 $input['show_rss'] = ( $input['show_rss'] == 1 ? 1 : 0 );

 // スマホ用固定フッターバーの設定
 if ( ! array_key_exists( $input['footer_bar_display'], $footer_bar_display_options ) )
  $input['footer_bar_display'] = 'type3';
 $input['footer_bar_bg'] = wp_filter_nohtml_kses( $input['footer_bar_bg'] );
 $input['footer_bar_border'] = wp_filter_nohtml_kses( $input['footer_bar_border'] );
 $input['footer_bar_color'] = wp_filter_nohtml_kses( $input['footer_bar_color'] );
 $input['footer_bar_tp'] = wp_filter_nohtml_kses( $input['footer_bar_tp'] );

 //if ( ! isset( $input['show_footer_bar'] ) ) $input['show_footer_bar'] = null;
 //$input['show_footer_bar'] = ( $input['show_footer_bar'] == 1 ? 1 : 0 );
 $footer_bar_btns = array();
 if ( isset( $input['repeater_footer_bar_btns'] ) ):
	 foreach ( (array)$input['repeater_footer_bar_btns'] as $key => $value ) {
	  $footer_bar_btns[] = array(
	   'type' => ( isset( $input['repeater_footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['repeater_footer_bar_btns'][$key]['type'] : 'type1',
	   'label' => isset( $input['repeater_footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['label'] ) : '',
	   'url' => isset( $input['repeater_footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['url'] ) : '',
	   'number' => isset( $input['repeater_footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['number'] ) : '',
	   'target' => ! empty( $input['repeater_footer_bar_btns'][$key]['target'] ) ? 1 : 0,
	   'icon' => ( isset( $input['repeater_footer_bar_btns'][$key]['icon'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['icon'], $footer_bar_icon_options ) ) ? $input['repeater_footer_bar_btns'][$key]['icon'] : 'file-text'
	  );
	 }
 endif;
 $input['footer_bar_btns'] = $footer_bar_btns;

 return $input;
}


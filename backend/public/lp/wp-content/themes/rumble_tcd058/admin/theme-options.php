<?php
// 設定項目と無害化用コールバックを登録
function theme_options_init() {
	register_setting(
		'design_plus_options',
		'dp_options',
		'theme_options_validate'
	);
}
add_action( 'admin_init', 'theme_options_init' );

// 外観メニューにサブメニューを登録
function theme_options_add_page() {
	add_theme_page(
		__( 'TCD Theme Options', 'tcd-w' ),
		__( 'TCD Theme Options', 'tcd-w' ),
		'edit_theme_options',
		'theme_options',
		'theme_options_do_page'
	);
}
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * オプション初期値
 * @var array
 */
global $dp_default_options;
$dp_default_options = array(

	/**
	 * 基本設定
	 */
	// 色の設定
	'primary_color' => '#000000',
	'secondary_color' => '#f7f7f7',
	'content_link_color' => '#000000',

	// ファビコンの設定
	'favicon' => '',

	// フォントタイプ
	'font_type' => 'type1',

	// 大見出しのフォントタイプ
	'headline_font_type' => 'type1',

	// 絵文字の設定
	'use_emoji' => 0,

	// クイックタグの設定
	'use_quicktags' => 1,

	// レスポンシブデザインの設定
	'responsive' => 'yes',

	// レイアウトの設定
	'layout' => 'type2',
	'layout_mobile' => 'type2',

	// ロード画面の設定
	'use_load_icon' => 1,
	'load_icon' => 'type1',
	'load_time' => 3,
	'load_color1' => '#000000',
	'load_color2' => '#999999',

	// ホバーエフェクトの設定
	'hover_type' => 'type1',
	'hover1_zoom' => 1.2,
	'hover1_rotate' => 1,
	'hover1_opacity' => 1,
	'hover1_bgcolor' => '#000000',
	'hover2_direct' => 'type1',
	'hover2_opacity' => 0.5,
	'hover2_bgcolor' => '#000000',
	'hover3_opacity' => 0.5,
	'hover3_bgcolor' => '#000000',

	// SNSボタンの設定
	'facebook_url' => '#',
	'twitter_url' => '#',
	'youtube_url' => '#',
	'instagram_url' => '#',
	'pinterest_url' => '#',
	'contact_url' => '#',
	'show_facebook_header' => 1,
	'show_twitter_header' => 1,
	'show_youtube_header' => 0,
	'show_instagram_header' => 1,
	'show_pinterest_header' => 1,
	'show_contact_header' => 0,
	'show_rss_header' => 1,
	'show_twitter_footer' => 1,
	'show_facebook_footer' => 1,
	'show_youtube_footer' => 0,
	'show_instagram_footer' => 1,
	'show_pinterest_footer' => 1,
	'show_contact_footer' => 0,
	'show_rss_footer' => 1,

	// Facebook OGPの設定
	'use_ogp' => 0,
	'fb_app_id' => '',
	'ogp_image' => '',

	// Twitter Cardsの設定
	'use_twitter_card' => 0,
	'twitter_account_name' => '',

	// ソーシャルボタンの表示設定
	'sns_type_top' => 'type1',
	'show_twitter_top' => 1,
	'show_fblike_top' => 1,
	'show_fbshare_top' => 1,
	'show_hatena_top' => 1,
	'show_pocket_top' => 1,
	'show_feedly_top' => 1,
	'show_rss_top' => 1,
	'show_pinterest_top' => 1,
	'sns_type_btm' => 'type1',
	'show_twitter_btm' => 1,
	'show_fblike_btm' => 1,
	'show_fbshare_btm' => 1,
	'show_hatena_btm' => 1,
	'show_pocket_btm' => 1,
	'show_feedly_btm' => 1,
	'show_rss_btm' => 1,
	'show_pinterest_btm' => 1,
	'twitter_info' => '',

	// Google Map
	'gmap_api_key' => '',
	'gmap_marker_type' => 'type1',
	'gmap_custom_marker_type' => 'type1',
	'gmap_marker_text' => '',
	'gmap_marker_color' => '#ffffff',
	'gmap_marker_img' => '',
	'gmap_marker_bg' => '#000000',

	// カスタムCSS
	'css_code' => '',

	// カスタムスクリプト
	'custom_head' => '',

	/**
	 * ロゴ
	 */
	// ヘッダーのロゴ
	'use_logo_image' => 'no',
	'logo_font_size' => 32,
	'header_logo_image' => '',
	'header_logo_image_retina' => '',

	// ヘッダーのロゴ（スマホ用）
	'logo_font_size_mobile' => 24,
	'header_logo_image_mobile' => '',
	'header_logo_image_mobile_retina' => '',

	// フッターのロゴ
	'footer_logo_font_size' => 32,
	'footer_logo_image' => false,
	'footer_logo_image_retina' => '',

	// ヘッダーのロゴ（スマホ用）
	'footer_logo_font_size_mobile' => 24,
	'footer_logo_image_mobile' => false,
	'footer_logo_image_mobile_retina' => '',

	/**
	 * トップページ
	 */
	// ヘッダーコンテンツの設定
	'header_content_type' => 'type1',
	'post_slider_division' => 3,
	'media_slider_division' => 3,
	'header_blog_list_type' => 'type5',
	'header_blog_category' => 0,
	'header_blog_slide_num' => 3,
	'header_blog_post_order' => 'date1',
	'header_blog_title_font_size' => 18,
	'header_blog_title_font_size_mobile' => 18,
	'show_header_blog_category' => 1,
	'show_header_blog_author' => 0,
	'show_header_blog_date' => 1,
	'show_header_blog_views' => 0,
	'show_header_blog_native_ad' => 0,
	'header_blog_native_ad_position' => 5,
	'slide_time' => '7000',

	// カルーセルスライダーの設定
	'show_header_carousel' => 1,
	'header_carousel_list_type' => 'type5',
	'header_carousel_category' => 0,
	'header_carousel_slide_num' => 3,
	'header_carousel_post_order' => 'date1',
	'header_carousel_title_font_size' => 16,
	'header_carousel_title_font_size_mobile' => 14,
	'show_header_carousel_date' => 1,
	'show_header_carousel_views' => 0,
	'show_header_carousel_native_ad' => 0,
	'header_carousel_native_ad_position' => 5,
	'header_carousel_slide_time' => '7000',
	'header_carousel_bg_color' => '#f3f3f3',

	// コンテンツビルダー
	'contents_builder' => array(
		array(
			'cb_content_select' => 'blog',
			'cb_display' => 1,
			'cb_headline' => __( 'Recent blog', 'tcd-w' ),
			'cb_list_type' => 'all',
			'cb_category' => 1,
			'cb_order' => 'date',
			'cb_post_num' => 3,
			'cb_title_font_size' => 16,
			'cb_title_font_size_mobile' => 14,
			'cb_show_category' => 1,
			'cb_show_author' => 0,
			'cb_show_date' => 1,
			'cb_show_views' => 0,
			'cb_show_native_ad' => 0,
			'cb_native_ad_position' => 3,
			'cb_show_archive_link' => 0,
			'cb_archive_link_text' => __( 'Blog archive', 'tcd-w' )
		),
		array(
			'cb_content_select' => 'news',
			'cb_display' => 0,
			'cb_headline' => __( 'News', 'tcd-w' ),
			'cb_order' => 'date',
			'cb_post_num' => 3,
			'cb_show_category' => 0,
			'cb_show_date' => 1,
			'cb_show_views' => 0,
			'cb_show_archive_link' => 0,
			'cb_archive_link_text' => __( 'News archive', 'tcd-w' )
		),
		array(
			'cb_content_select' => 'ad',
			'cb_display' => 1,
			'cb_ad_code1' => '',
			'cb_ad_image1' => '',
			'cb_ad_url1' => '#',
			'cb_ad_code2' => '',
			'cb_ad_image2' => '',
			'cb_ad_url2' => '#',
		)
	),

	/**
	 * ブログ
	 */
	// ブログの設定
	'blog_breadcrumb_label' => __( 'BLOG', 'tcd-w' ),

	// アーカイブスライダーの設定
	'archive_slider' => 'type1',
	'archive_slider_image1' => '',
	'archive_slider_headline1' => '',
	'archive_slider_url1' => '',
	'archive_slider_target1' => '',
	'archive_slider_image2' => '',
	'archive_slider_headline2' => '',
	'archive_slider_url2' => '',
	'archive_slider_target2' => '',
	'archive_slider_image3' => '',
	'archive_slider_headline3' => '',
	'archive_slider_url3' => '',
	'archive_slider_target3' => '',
	'archive_slider_image4' => '',
	'archive_slider_headline4' => '',
	'archive_slider_url4' => '',
	'archive_slider_target4' => '',
	'archive_slider_image5' => '',
	'archive_slider_headline5' => '',
	'archive_slider_url5' => '',
	'archive_slider_target5' => '',
	'archive_slider_list_type' => 'type1',
	'archive_slider_category' => 0,
	'archive_slider_order' => '',
	'archive_slider_num' => 3,
	'archive_slider_post_ids' => '',
	'show_archive_slider_category' => 0,
	'show_archive_slider_author' => 0,
	'show_archive_slider_date' => 1,
	'show_archive_slider_views' => 0,
	'show_archive_slider_native_ad' => 0,
	'archive_slider_native_ad_position' => 3,

	// アーカイブページ ネイティブ広告の設定
	'show_archive_native_ad' => 0,
	'archive_native_ad_position' => 5,

	// アーカイブの広告設定
	'archive_ad_code1' => '',
	'archive_ad_image1' => false,
	'archive_ad_url1' => '',
	'archive_ad_code2' => '',
	'archive_ad_image2' => false,
	'archive_ad_url2' => '',
	'archive_ad_position' => 5,

	// 記事詳細ページの設定
	'title_font_size' => 24,
	'title_font_size_mobile' => 18,
	'title_color' => '#000000',
	'content_font_size' => 16,
	'content_font_size_mobile' => 14,
	'content_color' => '#666666',
	'single_display_side_content' => 'type1',
	'page_link' => 'type1',

	// 表示設定
	'show_thumbnail' => 1,
	'show_views' => 0,
	'show_date' => 1,
	'show_category' => 1,
	'show_tag' => 1,
	'show_archive_author' => 0,
	'show_author' => 1,
	'show_author_views' => 0,
	'show_sns_top' => 1,
	'show_sns_btm' => 1,
	'show_next_post' => 1,
	'show_comment' => 1,
	'show_trackback' => 1,

	// 関連記事の設定
	'show_related_post' => 1,
	'related_post_headline' => __( 'Related posts', 'tcd-w' ),
	'related_post_num' => 8,
	'show_related_post_native_ad' => 0,
	'related_post_native_ad_position' => 5,

	// 記事詳細の広告設定1
	'single_ad_code1' => '',
	'single_ad_image1' => false,
	'single_ad_url1' => '',
	'single_ad_code2' => '',
	'single_ad_image2' => false,
	'single_ad_url2' => '',

	// 記事詳細の広告設定2
	'single_ad_code3' => '',
	'single_ad_image3' => false,
	'single_ad_url3' => '',
	'single_ad_code4' => '',
	'single_ad_image4' => false,
	'single_ad_url4' => '',

	// スマートフォン専用の広告
	'single_mobile_ad_code1' => '',
	'single_mobile_ad_image1' => false,
	'single_mobile_ad_url1' => '',

	/**
	 * News
	 */
	 // お知らせの設定
	'news_breadcrumb_label' => __( 'News', 'tcd-w' ),
	'news_slug' => 'news',

	// お知らせページの設定
	'news_title_font_size' => 24,
	'news_title_font_size_mobile' => 18,
	'news_title_color' => '#000000',
	'news_content_font_size' => 16,
	'news_content_font_size_mobile' => 14,
	'news_content_color' => '#666666',

	// 表示設定
	'show_date_news' => 1,
	'show_views_news' => 0,
	'show_thumbnail_news' => 1,
	'show_next_post_news' => 1,
	'show_sns_top_news' => 1,
	'show_sns_btm_news' => 1,

	// 最新のお知らせの設定
	'show_recent_news' => 1,
	'recent_news_headline' => __('Recent news', 'tcd-w'),
	'recent_news_num' => 5,
	'recent_news_link_text' => __('News archive', 'tcd-w'),

	/**
	 * ヘッダー
	 */
	// ヘッダーバーの表示位置
	'header_fix' => 'type2',

	// ヘッダーバーの表示位置（スマホ）
	'mobile_header_fix' => 'type2',

	// ヘッダーバーの色の設定
	'header_bg' => '#ffffff',
	'header_opacity' => 0.8,
	'header_font_color' => '#000000',

	// ヘッダートップ
	'header_top' => 'type2',

	// ヘッダー検索
	'show_header_search' => 1,

	// グローバルメニュー設定
	'submenu_color' => '#ffffff',
	'submenu_color_hover' => '#ffffff',
	'submenu_bg_color' => '#000000',
	'submenu_bg_color_hover' => '#999999',

	// グローバルメニュー表示設定
	'megamenu' => array(),

	// ヘッダー広告設定
	'header_ad_code1' => '',
	'header_ad_image1' => false,
	'header_ad_url1' => '#',
	'header_ad_code2' => '',
	'header_ad_image2' => false,
	'header_ad_url2' => '#',

	/**
	 * フッター
	 */
	// ブログコンテンツの設定
	'show_footer_blog_top' => 1,
	'show_footer_blog' => 1,
	'footer_blog_list_type' => 'type5',
	'footer_blog_category' => 0,
	'footer_blog_num' => 10,
	'footer_blog_post_order' => 'date1',
	'show_footer_blog_category' => 1,
	'show_footer_blog_native_ad' => 0,
	'footer_blog_native_ad_position' => 4,
	'footer_blog_slide_time' => '7000',

	// フッターウィジェット
	'footer_widget_bg_color' => '#f3f3f3',

	// スマホ用固定フッターバーの設定
	'footer_bar_display' => 'type3',
	'footer_bar_tp' => 0.8,
	'footer_bar_bg' => '#ffffff',
	'footer_bar_border' => '#dddddd',
	'footer_bar_color' => '#000000',
	'footer_bar_btns' => array(
		array(
			'type' => 'type1',
			'label' => '',
			'url' => '',
			'number' => '',
			'target' => 0,
			'icon' => 'file-text'
		)
	),

	/**
	 * 404 ページ
	 */
	'image_404' => '',
	'overlay_404' => '#000000',
	'overlay_opacity_404' => 0.2,
	'catchphrase_404' => __( '404 Not Found', 'tcd-w' ),
'desc_404' => __( 'The page you were looking for could not be found', 'tcd-w' ),
	'catchphrase_font_size_404' => 30,
	'desc_font_size_404' => 14,
	'color_404' => '#ffffff',
	'shadow1_404' => 0,
	'shadow2_404' => 0,
	'shadow3_404' => 0,
	'shadow_color_404' => '#999999',

	/**
	 * ネイティブ広告
	 */
	'native_ad_label_font_size' => 11,
	'native_ad_label_text_color' => '#ffffff',
	'native_ad_label_bg_color' => '#999999',

	/**
	 * ページ保護
	 */
	'pw_label' => '',
	'pw_align' => 'type1',
	'pw_name1' => '',
	'pw_name2' => '',
	'pw_name3' => '',
	'pw_name4' => '',
	'pw_name5' => '',
	'pw_btn_display1' => '',
	'pw_btn_display2' => '',
	'pw_btn_display3' => '',
	'pw_btn_display4' => '',
	'pw_btn_display5' => '',
	'pw_btn_label1' => '',
	'pw_btn_label2' => '',
	'pw_btn_label3' => '',
	'pw_btn_label4' => '',
	'pw_btn_label5' => '',
	'pw_btn_url1' => '',
	'pw_btn_url2' => '',
	'pw_btn_url3' => '',
	'pw_btn_url4' => '',
	'pw_btn_url5' => '',
	'pw_btn_target1' => 0,
	'pw_btn_target2' => 0,
	'pw_btn_target3' => 0,
	'pw_btn_target4' => 0,
	'pw_btn_target5' => 0,
	'pw_editor1' => '',
	'pw_editor2' => '',
	'pw_editor3' => '',
	'pw_editor4' => '',
	'pw_editor5' => ''
);

// オプション初期値ループ項目
for ( $i = 1; $i <= 3; $i++ ) {
	$dp_default_options['slider_media_type' . $i] = 'type1';
	$dp_default_options['slider_video' . $i] = '';
	$dp_default_options['slider_video_image' . $i] = '';
	$dp_default_options['slider_youtube_url' . $i] = '';
	$dp_default_options['slider_youtube_image' . $i] = '';
}
for ( $i = 1; $i <= 9; $i++ ) {
	$dp_default_options['display_slider_headline' . $i] = 0;
	$dp_default_options['slider_headline' . $i] = '';
	$dp_default_options['slider_headline_font_size' . $i] = 32;
	$dp_default_options['slider_headline_font_size_mobile' . $i] = 28;
	$dp_default_options['slider_desc' . $i] = '';
	$dp_default_options['slider_desc_font_size' . $i] = 16;
	$dp_default_options['slider_desc_font_size_mobile' . $i] = 14;
	$dp_default_options['slider_font_color' . $i] = '#ffffff';
	$dp_default_options['slider' . $i . '_shadow1'] = 0;
	$dp_default_options['slider' . $i . '_shadow2'] = 0;
	$dp_default_options['slider' . $i . '_shadow3'] = 0;
	$dp_default_options['slider' . $i . '_shadow_color'] = '#999999';
	$dp_default_options['display_slider_overlay' . $i] = 0;
	$dp_default_options['slider_overlay_color' . $i] = '#000000';
	$dp_default_options['slider_overlay_opacity' . $i] = 0.5;
	$dp_default_options['display_slider_button' . $i] = 0;
	$dp_default_options['slider_button_label' . $i] = '';
	$dp_default_options['slider_button_font_color' . $i] = '#ffffff';
	$dp_default_options['slider_button_bg_color' . $i] = '#000000';
	$dp_default_options['slider_button_font_color_hover' . $i] = '#ffffff';
	$dp_default_options['slider_button_bg_color_hover' . $i] = '#000000';
	$dp_default_options['slider_url' . $i] = '';
	$dp_default_options['slider_target' . $i] = 0;
	$dp_default_options['slider_image' . $i] = '';
}
for ( $i = 1; $i <= 6; $i++ ) {
	$dp_default_options['native_ad_title' . $i] = '';
	$dp_default_options['native_ad_label' . $i] = __( 'PR', 'tcd-w' );
	$dp_default_options['native_ad_sponsor' . $i] = '';
	$dp_default_options['native_ad_desc' . $i] = '';
	$dp_default_options['native_ad_image' . $i] = '';
	$dp_default_options['native_ad_url' . $i] = '';
	$dp_default_options['native_ad_target' . $i] = '';
}

/**
 * Design Plus のオプションを返す
 *
 * @global array $dp_default_options
 * @return array
 */
function get_design_plus_option() {
	global $dp_default_options;
	return shortcode_atts( $dp_default_options, get_option( 'dp_options', array() ) );
}

// フォントタイプ
global $font_type_options;
$font_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Meiryo', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'YuGothic', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'YuMincho', 'tcd-w' )
	)
);

// 大見出しのフォントタイプ
global $headline_font_type_options;
$headline_font_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Meiryo', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'YuGothic', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'YuMincho', 'tcd-w' )
	)
);

// レスポンシブデザインの設定
global $responsive_options;
$responsive_options = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Use responsive design', 'tcd-w' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'Do not use responsive design', 'tcd-w' )
	)
);

// レイアウトの設定
global $layout_options;
$layout_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Main content, Sidebar A, Sidebar B', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/layout_type1.png'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Main content, Sidebar B, Sidebar A', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/layout_type2.png'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Sidebar A, Main content, Sidebar B', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/layout_type3.png'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Sidebar A, Sidebar B, Main content', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/layout_type4.png'
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'Sidebar B, Main content, Sidebar A', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/layout_type5.png'
	),
	'type6' => array(
		'value' => 'type6',
		'label' => __( 'Sidebar B, Sidebar A, Main content', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/layout_type6.png'
	)
);

// モバイルレイアウトの設定
global $layout_mobile_options;
$layout_mobile_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Main content, Sidebar A, Sidebar B', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/layout_mobile_type1.png'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Main content, Sidebar B, Sidebar A', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/layout_mobile_type2.png'
	),
);

// ローディングアイコンの種類の設定
global $load_icon_options;
$load_icon_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Circle', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Square', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Dot', 'tcd-w' )
	)
);

// ロード画面の設定
global $load_time_options;
for ( $i = 3; $i <= 10; $i++ ) {
	$load_time_options[$i * 1000] = array( 'value' => $i * 1000, 'label' => $i );
}

// ホバーエフェクトの設定
global $hover_type_options;
$hover_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Zoom', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Slide', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Fade', 'tcd-w' )
	)
);
global $hover2_direct_options;
$hover2_direct_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Left to Right', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Right to Left', 'tcd-w' )
	)
);

// ロゴに画像を使うか否か
global $logo_type_options;
$logo_type_options = array(
	'no' => array(
		'value' => 'no',
		'label' => __( 'Use text for logo', 'tcd-w' )
	),
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Use image for logo', 'tcd-w' )
	)
);

// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Use default marker', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Use custom marker', 'tcd-w' )
	)
);
global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Text', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Image', 'tcd-w' )
	)
);

// ヘッダーコンテンツの設定
global $header_content_type_options;
$header_content_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Posts slider', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Image/Video slider', 'tcd-w' )
	)
);

// 記事スライダー分割の設定
global $post_slider_division_options;
$post_slider_division_options = array(
	3 => array(
		'value' => 3,
		'label' => __( 'Three divisions ', 'tcd-w' )
	),
	4 => array(
		'value' => 4,
		'label' => __( 'Four divisions ', 'tcd-w' )
	)
);

// 画像スライダー分割の設定
global $media_slider_division_options;
$media_slider_division_options = array(
	1 => array(
		'value' => 1,
		'label' => __( 'No division ', 'tcd-w' )
	),
	2 => array(
		'value' => 2,
		'label' => __( 'Two divisions ', 'tcd-w' )
	),
	3 => array(
		'value' => 3,
		'label' => __( 'Three divisions ', 'tcd-w' )
	)
);


// 画像スライダーメディアの設定
global $media_slider_media_type_options;
$media_slider_media_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Image', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Video', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Youtube', 'tcd-w' )
	)
);

// ヘッダーバーの表示位置
global $header_fix_options;
$header_fix_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Normal header', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Fix at top after page scroll', 'tcd-w' )
	)
);

// ヘッダートップ
global $header_top_options;
$header_top_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Display header menu', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Display site description', 'tcd-w' )
	)
);

// 記事タイプ
global $list_type_options;
$list_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Category', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Recommend post', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Recommend post2', 'tcd-w' )
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Pickup post', 'tcd-w' )
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'All posts', 'tcd-w' )
	)
);

// アーカイブスライダー
global $archive_slider_options;
$archive_slider_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Image slider', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Posts slider', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Hide slider', 'tcd-w' )
	)
);

// アーカイブスライダー記事タイプ
global $archive_slider_list_type_options;
$archive_slider_list_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'All posts', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Category', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Recommend post', 'tcd-w' )
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Recommend post2', 'tcd-w' )
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'Pickup post', 'tcd-w' )
	),
	'type6' => array(
		'value' => 'type6',
		'label' => __( 'Input post ids', 'tcd-w' )
	)
);

// サイドコンテンツ
global $display_side_content_options;
$display_side_content_options = array(
	'type1' => array(
		'label' => __( 'Display sidebar A and sidebar B', 'tcd-w' ),
		'value' => 'type1'
	),
	'type2' => array(
		'label' => __( 'Display sidebar A', 'tcd-w' ),
		'value' => 'type2'
	),
	'type3' => array(
		'label' => __( 'Display sidebar B', 'tcd-w' ),
		'value' => 'type3'
	)
);

// ページナビ
global $page_link_options;
$page_link_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Page numbers', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Read more button', 'tcd-w' ),
	)
);

// フッターブログコンテンツの数
global $footer_blog_num_options;
for ( $i = 1; $i <= 5; $i++ ) {
	$footer_blog_num_options[$i * 5] = array( 'value' => $i * 5, 'label' => $i * 5 );
}

// ブログ表示順
global $post_order_options;
$post_order_options = array(
	'date1' => array(
		'value' => 'date1',
		'label' => __( 'Date (DESC)', 'tcd-w' )
	),
	'date2' => array(
		'value' => 'date2',
		'label' => __( 'Date (ASC)', 'tcd-w' )
	),
	'rand' => array(
		'value' => 'rand',
		'label' => __( 'Random', 'tcd-w' )
	)
);

// スライダーが切り替わるスピード
global $slide_time_options;
for ( $i = 3; $i <= 15; $i++ ) {
	$slide_time_options[$i * 1000] = array( 'value' => $i * 1000, 'label' => $i );
}

// 記事上ボタンタイプ
global $sns_type_top_options;
$sns_type_top_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'style1', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'style2', 'tcd-w' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'style3', 'tcd-w' )
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'style4', 'tcd-w' )
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'style5', 'tcd-w' )
	)
);

// 記事下ボタンタイプ
global $sns_type_btm_options;
$sns_type_btm_options = $sns_type_top_options;

// フッターの固定メニュー 表示タイプ
global $footer_bar_display_options;
$footer_bar_display_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Fade In', 'tcd-w' ) ),
	'type2' => array( 'value' => 'type2', 'label' => __( 'Slide In', 'tcd-w' ) ),
	'type3' => array( 'value' => 'type3', 'label' => __( 'Hide', 'tcd-w' ) )
);

// フッターバーボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
	'type1' => array( 'value' => 'type1', 'label' => __( 'Default', 'tcd-w' ) ),
	'type2' => array( 'value' => 'type2', 'label' => __( 'Share', 'tcd-w' ) ),
	'type3' => array( 'value' => 'type3', 'label' => __( 'Telephone', 'tcd-w' ) )
);

// フッターバーボタンのアイコン
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
	'file-text' => array(
		'value' => 'file-text',
		'label' => __( 'Document', 'tcd-w' )
	),
	'share-alt' => array(
		'value' => 'share-alt',
		'label' => __( 'Share', 'tcd-w' )
	),
	'phone' => array(
		'value' => 'phone',
		'label' => __( 'Telephone', 'tcd-w' )
	),
	'envelope' => array(
		'value' => 'envelope',
		'label' => __( 'Envelope', 'tcd-w' )
	),
	'tag' => array(
		'value' => 'tag',
		'label' => __( 'Tag', 'tcd-w' )
	),
	'pencil' => array(
		'value' => 'pencil',
		'label' => __( 'Pencil', 'tcd-w' )
	)
);

// 保護ページalign
global $pw_align_options;
$pw_align_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Align left', 'tcd-w' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Align center', 'tcd-w' )
	)
);

// メガメニュー
global $megamenu_options;
$megamenu_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Dropdown menu', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/megamenu1.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Mega menu A', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/megamenu2.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Mega menu B', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/megamenu3.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Mega menu C', 'tcd-w' ),
		'image' => get_template_directory_uri() . '/admin/img/megamenu4.jpg'
	)
);

// テーマオプション画面の作成
function theme_options_do_page() {

	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$tabs = array(
		// 基本設定
		array(
			'label' => __( 'Basic', 'tcd-w' ),
			'template_part' => 'admin/inc/basic',
		),
		// ロゴの設定
		array(
			'label' => __( 'Logo', 'tcd-w' ),
			'template_part' => 'admin/inc/logo',
		),
		// トップページ
		array(
			'label' => __( 'Index', 'tcd-w' ),
			'template_part' => 'admin/inc/top',
		),
		// ブログ
		array(
			'label' => __( 'Blog', 'tcd-w' ),
			'template_part' => 'admin/inc/blog',
		),
		// News
		array(
			'label' => __( 'News', 'tcd-w' ),
			'template_part' => 'admin/inc/news',
		),
		// ヘッダー
		array(
			'label' => __( 'Header', 'tcd-w' ),
			'template_part' => 'admin/inc/header',
		),
		// フッター
		array(
			'label' => __( 'Footer', 'tcd-w' ),
			'template_part' => 'admin/inc/footer',
		),
		// 404 ページ
		array(
			'label' => __( '404 page', 'tcd-w' ),
			'template_part' => 'admin/inc/404',
		),
		// ネイティブ広告
		array(
			'label' => __( 'Native advertisement', 'tcd-w' ),
			'template_part' => 'admin/inc/native_ad',
		),
		// ページ保護
		array(
			'label' => __( 'Password protected pages', 'tcd-w' ),
			'template_part' => 'admin/inc/password',
		),
		// Tools
		array(
			'label' => __( 'Tools', 'tcd-w' ),
			'template_part' => 'admin/inc/tools',
		)
	);

?>
<div class="wrap">
	<h2><?php _e( 'TCD Theme Options', 'tcd-w' ); ?></h2>
<?php
	// 更新時のメッセージ
	if ( ! empty( $_REQUEST['settings-updated'] ) ) :
?>
	<div class="updated fade">
		<p><strong><?php _e( 'Updated', 'tcd-w' ); ?></strong></p>
	</div>
<?php
	endif;

	// Toolsメッセージ
	theme_options_tools_notices();
?>
	<div id="tcd_theme_option" class="cf">
		<div id="tcd_theme_left">
			<ul id="theme_tab" class="cf">
<?php
	foreach ( $tabs as $key => $tab ):
?>
				<li><a href="#tab-content<?php echo esc_attr( $key + 1 ); ?>"><?php echo esc_html( $tab['label'] ); ?></a></li>
<?php
	endforeach;
?>
			</ul>
		</div>
		<div id="tcd_theme_right">
			<form method="post" action="options.php" enctype="multipart/form-data">
<?php
	settings_fields( 'design_plus_options' );
?>
				<div id="tab-panel">
<?php
	foreach ( $tabs as $key => $tab ):
?>
					<div id="#tab-content<?php echo esc_attr( $key + 1 ); ?>">
<?php
		if ( !empty( $tab['template_part'] ) ) :
			get_template_part( $tab['template_part'] );
		endif;
?>
					</div>
<?php
	endforeach;
?>
				</div><!-- END #tab-panel -->
			</form>
			<div id="saved_data"></div>
			<div id="saving_data" style="display:none;"><p><?php _e('Now saving...', 'tcd-w'); ?></p></div>
		</div><!-- END #tcd_theme_right -->
	</div><!-- END #tcd_theme_option -->
</div><!-- END #wrap -->
<?php
}

/**
 * チェック
 */
function theme_options_validate( $input ) {
	global $dp_default_options, $font_type_options, $headline_font_type_options, $responsive_options, $layout_options, $layout_mobile_options, $load_icon_options, $load_time_options, $logo_type_options, $hover_type_options, $hover2_direct_options, $sns_type_top_options, $sns_type_btm_options, $gmap_marker_type_options, $gmap_custom_marker_type_options, $header_content_type_options, $post_slider_division_options, $media_slider_division_options, $media_slider_media_type_options, $header_fix_options, $header_top_options, $list_type_options, $archive_slider_options, $archive_slider_list_type_options, $post_order_options, $display_side_content_options, $page_link_options, $footer_blog_num_options, $slide_time_options, $footer_bar_display_options, $footer_bar_icon_options, $footer_bar_button_options, $pw_align_options, $megamenu_options;

	// 色の設定
	$input['primary_color'] = wp_filter_nohtml_kses( $input['primary_color'] );
	$input['secondary_color'] = wp_filter_nohtml_kses( $input['secondary_color'] );
	$input['content_link_color'] = wp_filter_nohtml_kses( $input['content_link_color'] );

	// ファビコン
	$input['favicon'] = wp_filter_nohtml_kses( $input['favicon'] );

	// フォントの種類
	if ( ! isset( $input['font_type'] ) || ! array_key_exists( $input['font_type'], $font_type_options ) )
		$input['font_type'] = $dp_default_options['font_type'];

	// 大見出しのフォントタイプ
	if ( ! isset( $input['headline_font_type'] ) || ! array_key_exists( $input['headline_font_type'], $headline_font_type_options ) )
		$input['headline_font_type'] = $dp_default_options['headline_font_type'];

	// 絵文字の設定
	$input['use_emoji'] = ! empty( $input['use_emoji'] ) ? 1 : 0;

	// クイックタグの設定
	$input['use_quicktags'] = ! empty( $input['use_quicktags'] ) ? 1 : 0;
	// レスポンシブの設定
	if ( ! isset( $input['responsive'] ) || ! array_key_exists( $input['responsive'], $responsive_options ) )
		$input['responsive'] = $dp_default_options['responsive'];

	// レイアウトの設定
	if ( ! isset( $input['layout'] ) || ! array_key_exists( $input['layout'], $layout_options ) )
		$input['layout'] = $dp_default_options['layout'];
	if ( ! isset( $input['layout_mobile'] ) || ! array_key_exists( $input['layout_mobile'], $layout_mobile_options ) )
		$input['layout_mobile'] = $dp_default_options['layout_mobile'];

	// ロード画面の設定
	$input['use_load_icon'] = ! empty( $input['use_load_icon'] ) ? 1 : 0;
	if ( ! isset( $input['load_icon'] ) || ! array_key_exists( $input['load_icon'], $load_icon_options ) )
		$input['load_icon'] = $dp_default_options['load_icon'];
	if ( ! isset( $input['load_time'] ) || ! array_key_exists( $input['load_time'], $load_time_options ) )
		$input['load_time'] = $dp_default_options['load_time'];
	$input['load_color1'] = wp_filter_nohtml_kses( $input['load_color1'] );
	$input['load_color2'] = wp_filter_nohtml_kses( $input['load_color2'] );

	// ホバーエフェクトの設定
	if ( ! isset( $input['hover_type'] ) || ! array_key_exists( $input['hover_type'], $hover_type_options ) )
		$input['hover_type'] = $dp_default_options['hover_type'];
	$input['hover1_zoom'] = wp_filter_nohtml_kses( $input['hover1_zoom'] );
	$input['hover1_rotate'] = ! empty( $input['hover1_rotate'] ) ? 1 : 0;
	$input['hover1_opacity'] = wp_filter_nohtml_kses( $input['hover1_opacity'] );
	$input['hover1_bgcolor'] = wp_filter_nohtml_kses( $input['hover1_bgcolor'] );
	if ( ! isset( $input['hover2_direct'] ) || ! array_key_exists( $input['hover2_direct'], $hover2_direct_options ) )
		$input['hover2_direct'] = $dp_default_options['hover2_direct'];
	$input['hover2_opacity'] = wp_filter_nohtml_kses( $input['hover2_opacity'] );
	$input['hover2_bgcolor'] = wp_filter_nohtml_kses( $input['hover2_bgcolor'] );
	$input['hover3_opacity'] = wp_filter_nohtml_kses( $input['hover3_opacity'] );
	$input['hover3_bgcolor'] = wp_filter_nohtml_kses( $input['hover3_bgcolor'] );

	// SNSボタンの設定
	$input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );
	$input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
	$input['youtube_url'] = wp_filter_nohtml_kses( $input['youtube_url'] );
	$input['instagram_url'] = wp_filter_nohtml_kses( $input['instagram_url'] );
	$input['pinterest_url'] = wp_filter_nohtml_kses( $input['pinterest_url'] );
	$input['contact_url'] = wp_filter_nohtml_kses( $input['contact_url'] );
	$input['show_facebook_header'] = ! empty( $input['show_facebook_header'] ) ? 1 : 0;
	$input['show_twitter_header'] = ! empty( $input['show_twitter_header'] ) ? 1 : 0;
	$input['show_youtube_header'] = ! empty( $input['show_youtube_header'] ) ? 1 : 0;
	$input['show_instagram_header'] = ! empty( $input['show_instagram_header'] ) ? 1 : 0;
	$input['show_pinterest_header'] = ! empty( $input['show_pinterest_header'] ) ? 1 : 0;
	$input['show_contact_header'] = ! empty( $input['show_contact_header'] ) ? 1 : 0;
	$input['show_rss_header'] = ! empty( $input['show_rss_header'] ) ? 1 : 0;
	$input['show_facebook_footer'] = ! empty( $input['show_facebook_footer'] ) ? 1 : 0;
	$input['show_twitter_footer'] = ! empty( $input['show_twitter_footer'] ) ? 1 : 0;
	$input['show_youtube_footer'] = ! empty( $input['show_youtube_footer'] ) ? 1 : 0;
	$input['show_instagram_footer'] = ! empty( $input['show_instagram_footer'] ) ? 1 : 0;
	$input['show_pinterest_footer'] = ! empty( $input['show_pinterest_footer'] ) ? 1 : 0;
	$input['show_contact_footer'] = ! empty( $input['show_contact_footer'] ) ? 1 : 0;
	$input['show_rss_footer'] = ! empty( $input['show_rss_footer'] ) ? 1 : 0;

	// Facebook OGPの設定
	$input['use_ogp'] = ! empty( $input['use_ogp'] ) ? 1 : 0;
	$input['fb_app_id'] = wp_filter_nohtml_kses( $input['fb_app_id'] );
	$input['ogp_image'] = wp_filter_nohtml_kses( $input['ogp_image'] );

	// Twitter Cardsの設定
	$input['use_twitter_card'] = ! empty( $input['use_twitter_card'] ) ? 1 : 0;
	$input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );

	// ソーシャルボタンの表示設定
	if ( ! isset( $input['sns_type_top'] ) || ! array_key_exists( $input['sns_type_top'], $sns_type_top_options ) )
		$input['sns_type_top'] = $dp_default_options['sns_type_top'];
	$input['show_sns_top'] = ! empty( $input['show_sns_top'] ) ? 1 : 0;
	$input['show_twitter_top'] = ! empty( $input['show_twitter_top'] ) ? 1 : 0;
	$input['show_fblike_top'] = ! empty( $input['show_fblike_top'] ) ? 1 : 0;
	$input['show_fbshare_top'] = ! empty( $input['show_fbshare_top'] ) ? 1 : 0;
	$input['show_hatena_top'] = ! empty( $input['show_hatena_top'] ) ? 1 : 0;
	$input['show_pocket_top'] = ! empty( $input['show_pocket_top'] ) ? 1 : 0;
	$input['show_feedly_top'] = ! empty( $input['show_feedly_top'] ) ? 1 : 0;
	$input['show_rss_top'] = ! empty( $input['show_rss_top'] ) ? 1 : 0;
	$input['show_pinterest_top'] = ! empty( $input['show_pinterest_top'] ) ? 1 : 0;

	if ( ! isset( $input['sns_type_btm'] ) || ! array_key_exists( $input['sns_type_btm'], $sns_type_btm_options ) )
		$input['sns_type_btm'] = $dp_default_options['sns_type_btm'];
	$input['show_sns_btm'] = ! empty( $input['show_sns_btm'] ) ? 1 : 0;
	$input['show_twitter_btm'] = ! empty( $input['show_twitter_btm'] ) ? 1 : 0;
	$input['show_fblike_btm'] = ! empty( $input['show_fblike_btm'] ) ? 1 : 0;
	$input['show_fbshare_btm'] = ! empty( $input['show_fbshare_btm'] ) ? 1 : 0;
	$input['show_hatena_btm'] = ! empty( $input['show_hatena_btm'] ) ? 1 : 0;
	$input['show_pocket_btm'] = ! empty( $input['show_pocket_btm'] ) ? 1 : 0;
	$input['show_feedly_btm'] = ! empty( $input['show_feedly_btm'] ) ? 1 : 0;
	$input['show_rss_btm'] = ! empty( $input['show_rss_btm'] ) ? 1 : 0;
	$input['show_pinterest_btm'] = ! empty( $input['show_pinterest_btm'] ) ? 1 : 0;

	// Google Maps
	$input['gmap_api_key'] = wp_filter_nohtml_kses( $input['gmap_api_key'] );
	if ( ! isset( $input['gmap_marker_type'] ) || ! array_key_exists( $input['gmap_marker_type'], $gmap_marker_type_options ) )
		$input['gmap_marker_type'] = $dp_default_options['gmap_marker_type'];
	if ( ! isset( $input['gmap_custom_marker_type'] ) || ! array_key_exists( $input['gmap_custom_marker_type'], $gmap_custom_marker_type_options ) )
		$input['gmap_custom_marker_type'] = $dp_default_options['gmap_custom_marker_type'];
	$input['gmap_marker_text'] = wp_filter_nohtml_kses( $input['gmap_marker_text'] );
	$input['gmap_marker_color'] = wp_filter_nohtml_kses( $input['gmap_marker_color'] );
	$input['gmap_marker_img'] = wp_filter_nohtml_kses( $input['gmap_marker_img'] );
	$input['gmap_marker_bg'] = wp_filter_nohtml_kses( $input['gmap_marker_bg'] );

	// オリジナルスタイルの設定
	$input['css_code'] = $input['css_code'];

	// Custom head/script
	$input['custom_head'] = $input['custom_head'];

	// ロゴのタイプ
	if ( ! isset( $input['use_logo_image'] ) || ! array_key_exists( $input['use_logo_image'], $logo_type_options ) )
		$input['use_logo_image'] = $dp_default_options['use_logo_image'];
	// ヘッダーのロゴ
	$input['logo_font_size'] = wp_filter_nohtml_kses( $input['logo_font_size'] );
	$input['header_logo_image'] = wp_filter_nohtml_kses( $input['header_logo_image'] );
	$input['header_logo_image_retina'] = ! empty( $input['header_logo_image_retina'] ) ? 1 : 0;

	// ヘッダーのロゴ（スマホ用）
	$input['logo_font_size_mobile'] = wp_filter_nohtml_kses( $input['logo_font_size_mobile'] );
	$input['header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['header_logo_image_mobile'] );
	$input['header_logo_image_mobile_retina'] = ! empty( $input['header_logo_image_mobile_retina'] ) ? 1 : 0;

	// フッターのロゴ
	$input['footer_logo_font_size'] = wp_filter_nohtml_kses( $input['footer_logo_font_size'] );
	$input['footer_logo_font_size_mobile'] = wp_filter_nohtml_kses( $input['footer_logo_font_size_mobile'] );
	$input['footer_logo_image'] = wp_filter_nohtml_kses( $input['footer_logo_image'] );
	$input['footer_logo_image_retina'] = ! empty( $input['footer_logo_image_retina'] ) ? 1 : 0;

	/**
	 * トップページ
	 */
	// ヘッダーコンテンツの設定
	if ( ! isset( $input['header_content_type'] ) || ! array_key_exists( $input['header_content_type'], $header_content_type_options ) )
		$input['header_content_type'] = $dp_default_options['header_content_type'];
	if ( ! isset( $input['post_slider_division'] ) || ! array_key_exists( $input['post_slider_division'], $post_slider_division_options ) )
		$input['post_slider_division'] = $dp_default_options['post_slider_division'];
	$input['post_slider_division'] = intval( $input['post_slider_division'] );
	if ( ! isset( $input['media_slider_division'] ) || ! array_key_exists( $input['media_slider_division'], $media_slider_division_options ) )
		$input['media_slider_division'] = $dp_default_options['media_slider_division'];
	$input['media_slider_division'] = intval( $input['media_slider_division'] );
	if ( ! isset( $input['header_blog_list_type'] ) || ! array_key_exists( $input['header_blog_list_type'], $list_type_options ) )
		$input['header_blog_list_type'] = $dp_default_options['header_blog_list_type'];
	$input['header_blog_category'] = intval( $input['header_blog_category'] );
	$input['header_blog_slide_num'] = intval( $input['header_blog_slide_num'] );
	if ( ! isset( $input['header_blog_post_order'] ) || ! array_key_exists( $input['header_blog_post_order'], $post_order_options ) )
		$input['header_blog_post_order'] = $dp_default_options['header_blog_post_order'];
	$input['header_blog_title_font_size'] = intval( $input['header_blog_title_font_size'] );
	$input['header_blog_title_font_size_mobile'] = intval( $input['header_blog_title_font_size_mobile'] );
	$input['show_header_blog_category'] = ! empty( $input['show_header_blog_category'] ) ? 1 : 0;
	$input['show_header_blog_author'] = ! empty( $input['show_header_blog_author'] ) ? 1 : 0;
	$input['show_header_blog_date'] = ! empty( $input['show_header_blog_date'] ) ? 1 : 0;
	$input['show_header_blog_views'] = ! empty( $input['show_header_blog_views'] ) ? 1 : 0;
	$input['show_header_blog_native_ad'] = ! empty( $input['show_header_blog_native_ad'] ) ? 1 : 0;
	$input['header_blog_native_ad_position'] = intval( $input['header_blog_native_ad_position'] );

	for ( $i = 1; $i <= 3; $i++ ) {
		if ( ! isset( $input['slider_media_type' . $i] ) || ! array_key_exists( $input['slider_media_type' . $i], $media_slider_media_type_options ) )
			$input['slider_media_type' . $i] = $dp_default_options['slider_media_type' . $i];
		$input['slider_video' . $i] = wp_filter_nohtml_kses( $input['slider_video' . $i] );
		$input['slider_video_image' . $i] = wp_filter_nohtml_kses( $input['slider_video_image' . $i] );
		$input['slider_youtube_url' . $i] = wp_filter_nohtml_kses( $input['slider_youtube_url' . $i] );
		$input['slider_youtube_image' . $i] = wp_filter_nohtml_kses( $input['slider_youtube_image' . $i] );
	}

	for ( $i = 1; $i <= 9; $i++ ) {
		$input['display_slider_headline' . $i] = ! empty( $input['display_slider_headline' . $i] ) ? 1 : 0;
		$input['slider_headline' . $i] = wp_filter_nohtml_kses( $input['slider_headline' . $i] );
		$input['slider_headline_font_size' . $i] = intval( $input['slider_headline_font_size' . $i] );
		$input['slider_headline_font_size_mobile' . $i] = intval( $input['slider_headline_font_size_mobile' . $i] );
		$input['slider_desc' . $i] = wp_filter_nohtml_kses( $input['slider_desc' . $i] );
		$input['slider_desc_font_size' . $i] = intval( $input['slider_desc_font_size' . $i] );
		$input['slider_desc_font_size_mobile' . $i] = intval( $input['slider_desc_font_size_mobile' . $i] );
		$input['slider_font_color' . $i] = wp_filter_nohtml_kses( $input['slider_font_color' . $i] );
		$input['slider' . $i . '_shadow1'] = intval( $input['slider' . $i . '_shadow1'] );
		$input['slider' . $i . '_shadow2'] = intval( $input['slider' . $i . '_shadow2'] );
		$input['slider' . $i . '_shadow3'] = intval( $input['slider' . $i . '_shadow3'] );
		$input['slider' . $i . '_shadow_color'] = wp_filter_nohtml_kses( $input['slider' . $i . '_shadow_color'] );
		$input['display_slider_overlay' . $i] = ! empty( $input['display_slider_overlay' . $i] ) ? 1 : 0;
		$input['slider_overlay_color' . $i] = wp_filter_nohtml_kses( $input['slider_overlay_color' . $i] );
		$input['slider_overlay_opacity' . $i] = wp_filter_nohtml_kses( $input['slider_overlay_opacity' . $i] );
		$input['display_slider_button' . $i] = ! empty( $input['display_slider_button' . $i] ) ? 1 : 0;
		$input['slider_button_label' . $i] = wp_filter_nohtml_kses( $input['slider_button_label' . $i] );
		$input['slider_button_font_color' . $i] = wp_filter_nohtml_kses( $input['slider_button_font_color' . $i] );
		$input['slider_button_bg_color' . $i] = wp_filter_nohtml_kses( $input['slider_button_bg_color' . $i] );
		$input['slider_button_font_color_hover' . $i] = wp_filter_nohtml_kses( $input['slider_button_font_color_hover' . $i] );
		$input['slider_button_bg_color_hover' . $i] = wp_filter_nohtml_kses( $input['slider_button_bg_color_hover' . $i] );
		$input['slider_url' . $i] = wp_filter_nohtml_kses( $input['slider_url' . $i] );
		$input['slider_target' . $i] = ! empty( $input['slider_target' . $i] ) ? 1 : 0;
		$input['slider_image' . $i] = wp_filter_nohtml_kses( $input['slider_image' . $i] );
	}
	if ( ! isset( $input['slide_time'] ) || ! array_key_exists( $input['slide_time'], $slide_time_options ) )
		$input['slide_time'] = $dp_default_options['slide_time'];

	// カルーセルスライダーの設定
	$input['show_header_carousel'] = ! empty( $input['show_header_carousel'] ) ? 1 : 0;
	if ( ! isset( $input['header_carousel_list_type'] ) || ! array_key_exists( $input['header_carousel_list_type'], $list_type_options ) )
		$input['header_carousel_list_type'] = $dp_default_options['header_carousel_list_type'];
	$input['header_carousel_category'] = intval( $input['header_carousel_category'] );
	$input['header_carousel_slide_num'] = intval( $input['header_carousel_slide_num'] );
	if ( ! isset( $input['header_carousel_post_order'] ) || ! array_key_exists( $input['header_carousel_post_order'], $post_order_options ) )
		$input['header_carousel_post_order'] = $dp_default_options['header_carousel_post_order'];
	$input['header_carousel_title_font_size'] = intval( $input['header_carousel_title_font_size'] );
	$input['header_carousel_title_font_size_mobile'] = intval( $input['header_carousel_title_font_size_mobile'] );
	$input['show_header_carousel_date'] = ! empty( $input['show_header_carousel_date'] ) ? 1 : 0;
	$input['show_header_carousel_views'] = ! empty( $input['show_header_carousel_views'] ) ? 1 : 0;
	$input['show_header_carousel_native_ad'] = ! empty( $input['show_header_carousel_native_ad'] ) ? 1 : 0;
	$input['header_carousel_native_ad_position'] = intval( $input['header_carousel_native_ad_position'] );
	if ( ! isset( $input['header_carousel_slide_time'] ) || ! array_key_exists( $input['header_carousel_slide_time'], $slide_time_options ) )
		$input['header_carousel_slide_time'] = $dp_default_options['header_carousel_slide_time'];
	$input['header_carousel_bg_color'] = wp_filter_nohtml_kses( $input['header_carousel_bg_color'] );

	/**
	 * ブログ
	 */
	 // ブログの設定
	$input['blog_breadcrumb_label'] = wp_filter_nohtml_kses( $input['blog_breadcrumb_label'] );

	// アーカイブスライダーの設定
	if ( ! isset( $input['archive_slider'] ) || ! array_key_exists( $input['archive_slider'], $archive_slider_options ) )
		$input['archive_slider'] = $dp_default_options['archive_slider'];
	if ( ! isset( $input['archive_slider_list_type'] ) || ! array_key_exists( $input['archive_slider_list_type'], $archive_slider_list_type_options ) )
		$input['archive_slider_list_type'] = $dp_default_options['archive_slider_list_type'];
	if ( ! isset( $input['archive_slider_order'] ) || ! array_key_exists( $input['archive_slider_order'], $post_order_options ) )
		$input['archive_slider_order'] = $dp_default_options['archive_slider_order'];
	$input['archive_slider_category'] = intval( $input['archive_slider_category'] );
	$input['archive_slider_num'] = intval( $input['archive_slider_num'] );
	$input['archive_slider_post_ids'] = wp_filter_nohtml_kses( $input['archive_slider_post_ids'] );
	$input['show_archive_slider_category'] = ! empty( $input['show_archive_slider_category'] ) ? 1 : 0;
	$input['show_archive_slider_author'] = ! empty( $input['show_archive_slider_author'] ) ? 1 : 0;
	$input['show_archive_slider_date'] = ! empty( $input['show_archive_slider_date'] ) ? 1 : 0;
	$input['show_archive_slider_views'] = ! empty( $input['show_archive_slider_views'] ) ? 1 : 0;
	$input['show_archive_slider_native_ad'] = ! empty( $input['show_archive_slider_native_ad'] ) ? 1 : 0;
	$input['archive_slider_native_ad_position'] = intval( $input['archive_slider_native_ad_position'] );

	for ( $i = 1; $i <= 5; $i++ ) {
		$input['archive_slider_image' . $i] = wp_filter_nohtml_kses( $input['archive_slider_image' . $i] );
		$input['archive_slider_headline' . $i] = wp_filter_nohtml_kses( $input['archive_slider_headline' . $i] );
		$input['archive_slider_url' . $i] = wp_filter_nohtml_kses( $input['archive_slider_url' . $i] );
		$input['archive_slider_target' . $i] = ! empty( $input['archive_slider_target' . $i] ) ? 1 : 0;
	}

	// アーカイブページ ネイティブ広告の設定
	$input['show_archive_native_ad'] = ! empty( $input['show_archive_native_ad'] ) ? 1 : 0;
	$input['archive_native_ad_position'] = intval( $input['archive_native_ad_position'] );

	// アーカイブページの広告設定
	for ( $i = 1; $i <= 2; $i++ ) {
		$input['archive_ad_code' . $i] = $input['archive_ad_code' . $i];
		$input['archive_ad_image' . $i] = wp_filter_nohtml_kses( $input['archive_ad_image' . $i] );
		$input['archive_ad_url' . $i] = wp_filter_nohtml_kses( $input['archive_ad_url' . $i] );
	}
	$input['archive_ad_position'] = intval( $input['archive_ad_position'] );

	// 記事詳細ページの設定
	$input['title_font_size'] = intval( $input['title_font_size'] );
	$input['title_font_size_mobile'] = intval( $input['title_font_size_mobile'] );
	$input['title_color'] = wp_filter_nohtml_kses( $input['title_color'] );
	$input['content_font_size'] = intval( $input['content_font_size'] );
	$input['content_font_size_mobile'] = intval( $input['content_font_size_mobile'] );
	$input['content_color'] = wp_filter_nohtml_kses( $input['content_color'] );

	if ( ! isset( $input['single_display_side_content'] ) || ! array_key_exists( $input['single_display_side_content'], $display_side_content_options ) )
		$input['single_display_side_content'] = $dp_default_options['single_display_side_content'];
	if ( ! isset( $input['page_link'] ) || ! array_key_exists( $input['page_link'], $page_link_options ) )
		$input['page_link'] = $dp_default_options['page_link'];

	// 表示設定
	$input['show_thumbnail'] = ! empty( $input['show_thumbnail'] ) ? 1 : 0;
	$input['show_views'] = ! empty( $input['show_views'] ) ? 1 : 0;
	$input['show_date'] = ! empty( $input['show_date'] ) ? 1 : 0;
	$input['show_category'] = ! empty( $input['show_category'] ) ? 1 : 0;
	$input['show_tag'] = ! empty( $input['show_tag'] ) ? 1 : 0;
	$input['show_archive_author'] = ! empty( $input['show_archive_author'] ) ? 1 : 0;
	$input['show_author'] = ! empty( $input['show_author'] ) ? 1 : 0;
	$input['show_author_views'] = ! empty( $input['show_author_views'] ) ? 1 : 0;
	$input['show_next_post'] = ! empty( $input['show_next_post'] ) ? 1 : 0;
	$input['show_comment'] = ! empty( $input['show_comment'] ) ? 1 : 0;
	$input['show_trackback'] = ! empty( $input['show_trackback'] ) ? 1 : 0;

	// 関連記事の設定
	$input['show_related_post'] = ! empty( $input['show_related_post'] ) ? 1 : 0;
	$input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
	$input['related_post_num'] = intval( $input['related_post_num'] );
	$input['show_related_post_native_ad'] = ! empty( $input['show_related_post_native_ad'] ) ? 1 : 0;
	$input['related_post_native_ad_position'] = intval( $input['related_post_native_ad_position'] );

	// 記事ページの広告設定1, 2
	for ( $i = 1; $i <= 4; $i++ ) {
		$input['single_ad_code' . $i] = $input['single_ad_code' . $i];
		$input['single_ad_image' . $i] = wp_filter_nohtml_kses( $input['single_ad_image' . $i] );
		$input['single_ad_url' . $i] = wp_filter_nohtml_kses( $input['single_ad_url' . $i] );
	}

	// スマートフォン専用の広告
	$input['single_mobile_ad_code1'] = $input['single_mobile_ad_code1'];
	$input['single_mobile_ad_image1'] = wp_filter_nohtml_kses( $input['single_mobile_ad_image1'] );
	$input['single_mobile_ad_url1'] = wp_filter_nohtml_kses( $input['single_mobile_ad_url1'] );

	 // お知らせの設定
	$input['news_breadcrumb_label'] = wp_filter_nohtml_kses( $input['news_breadcrumb_label'] );
	if ( ! $input['news_breadcrumb_label'] )
		$input['news_breadcrumb_label'] = $dp_default_options['news_breadcrumb_label'];
	if ( $input['news_slug'] )
		$input['news_slug'] = trim( $input['news_slug'] );
	if ( ! $input['news_slug'] )
		$input['news_slug'] = $dp_default_options['news_slug'];
	$input['news_slug'] = sanitize_title( $input['news_slug'] );

	// お知らせページの設定
	$input['news_title_font_size'] = intval( $input['news_title_font_size'] );
	$input['news_title_font_size_mobile'] = intval( $input['news_title_font_size_mobile'] );
	$input['news_title_color'] = wp_filter_nohtml_kses( $input['news_title_color'] );
	$input['news_content_font_size'] = intval( $input['news_content_font_size'] );
	$input['news_content_font_size_mobile'] = intval( $input['news_content_font_size_mobile'] );
	$input['news_content_color'] = wp_filter_nohtml_kses( $input['news_content_color'] );

	// 表示設定
	$input['show_date_news'] = ! empty( $input['show_date_news'] ) ? 1 : 0;
	$input['show_views_news'] = ! empty( $input['show_views_news'] ) ? 1 : 0;
	$input['show_thumbnail_news'] = ! empty( $input['show_thumbnail_news'] ) ? 1 : 0;
	$input['show_next_post_news'] = ! empty( $input['show_next_post_news'] ) ? 1 : 0;
	$input['show_sns_top_news'] = ! empty( $input['show_sns_top_news'] ) ? 1 : 0;
	$input['show_sns_btm_news'] = ! empty( $input['show_sns_btm_news'] ) ? 1 : 0;

	// 最新のお知らせの設定
	$input['show_recent_news'] = ! empty( $input['show_recent_news'] ) ? 1 : 0;
	$input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
	$input['recent_news_num'] = intval( $input['recent_news_num'] );

	$input['recent_news_link_text'] = wp_filter_nohtml_kses( $input['recent_news_link_text'] );

	// ヘッダーバーの表示位置
	if ( ! isset( $input['header_fix'] ) || ! array_key_exists( $input['header_fix'], $header_fix_options ) )
		$input['header_fix'] = $dp_default_options['header_fix'];

	// ヘッダーバーの表示位置（スマホ）
	if ( ! isset( $input['mobile_header_fix'] ) || ! array_key_exists( $input['mobile_header_fix'], $header_fix_options ) )
		$input['mobile_header_fix'] = $dp_default_options['mobile_header_fix'];

	// ヘッダーバーの色の設定
	$input['header_bg'] = wp_filter_nohtml_kses( $input['header_bg'] );
	$input['header_opacity'] = wp_filter_nohtml_kses( $input['header_opacity'] );
	$input['header_font_color'] = wp_filter_nohtml_kses( $input['header_font_color'] );

	// ヘッダートップ
	if ( ! isset( $input['header_top'] ) || ! array_key_exists( $input['header_top'], $header_top_options ) )
		$input['header_top'] = $dp_default_options['header_top'];

	// ヘッダー検索
	$input['show_header_search'] = wp_filter_nohtml_kses( $input['show_header_search'] );

	// グローバルメニュー設定
	$input['submenu_color'] = wp_filter_nohtml_kses( $input['submenu_color'] );
	$input['submenu_color_hover'] = wp_filter_nohtml_kses( $input['submenu_color_hover'] );
	$input['submenu_bg_color'] = wp_filter_nohtml_kses( $input['submenu_bg_color'] );
	$input['submenu_bg_color_hover'] = wp_filter_nohtml_kses( $input['submenu_bg_color_hover'] );

	// ヘッダー広告設定
	$input['header_ad_code1'] = $input['header_ad_code1'];
	$input['header_ad_image1'] = wp_filter_nohtml_kses( $input['header_ad_image1'] );
	$input['header_ad_url1'] = wp_filter_nohtml_kses( $input['header_ad_url1'] );
	$input['header_ad_code2'] = $input['header_ad_code2'];
	$input['header_ad_image2'] = wp_filter_nohtml_kses( $input['header_ad_image2'] );
	$input['header_ad_url2'] = wp_filter_nohtml_kses( $input['header_ad_url2'] );

	// フッターブログコンテンツの設定
	$input['show_footer_blog_top'] = ! empty( $input['show_footer_blog_top'] ) ? 1 : 0;
	$input['show_footer_blog'] = ! empty( $input['show_footer_blog'] ) ? 1 : 0;
	if ( ! isset( $input['footer_blog_list_type'] ) || ! array_key_exists( $input['footer_blog_list_type'], $list_type_options ) )
		$input['footer_blog_list_type'] = $dp_default_options['footer_blog_list_type'];
	$input['footer_blog_category'] = intval( $input['footer_blog_category'] );
	if ( ! isset( $input['footer_blog_num'] ) || ! array_key_exists( $input['footer_blog_num'], $footer_blog_num_options ) )
		$input['footer_blog_num'] = $dp_default_options['footer_blog_num'];
	if ( ! isset( $input['footer_blog_post_order'] ) || ! array_key_exists( $input['footer_blog_post_order'], $post_order_options ) )
		$input['footer_blog_post_order'] = $dp_default_options['footer_blog_post_order'];
	$input['show_footer_blog_category'] = ! empty( $input['show_footer_blog_category'] ) ? 1 : 0;
	$input['show_footer_blog_native_ad'] = ! empty( $input['show_footer_blog_native_ad'] ) ? 1 : 0;
	$input['footer_blog_native_ad_position'] = intval( $input['footer_blog_native_ad_position'] );
	if ( ! isset( $input['footer_blog_slide_time'] ) || ! array_key_exists( $input['footer_blog_slide_time'], $slide_time_options ) )
		$input['footer_blog_slide_time'] = $dp_default_options['footer_blog_slide_time'];

	// フッターウィジェット
	$input['footer_widget_bg_color'] = wp_filter_nohtml_kses( $input['footer_widget_bg_color'] );

	// スマホ用固定フッターバーの設定
	if ( ! array_key_exists( $input['footer_bar_display'], $footer_bar_display_options ) ) $input['footer_bar_display'] = 'type3';
	$input['footer_bar_bg'] = wp_filter_nohtml_kses( $input['footer_bar_bg'] );
	$input['footer_bar_border'] = wp_filter_nohtml_kses( $input['footer_bar_border'] );
	$input['footer_bar_color'] = wp_filter_nohtml_kses( $input['footer_bar_color'] );
	$input['footer_bar_tp'] = wp_filter_nohtml_kses( $input['footer_bar_tp'] );
	$footer_bar_btns = array();
	if ( empty( $input['repeater_footer_bar_btns'] ) && ! empty( $input['footer_bar_btns'] ) && is_array( $input['footer_bar_btns'] ) ) {
		$input['repeater_footer_bar_btns'] = $input['footer_bar_btns'];
	}
	if ( isset( $input['repeater_footer_bar_btns'] ) ) {
		foreach ( $input['repeater_footer_bar_btns'] as $key => $value ) {
			$footer_bar_btns[] = array(
				'type' => ( isset( $input['repeater_footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['repeater_footer_bar_btns'][$key]['type'] : 'type1',
				'label' => isset( $input['repeater_footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['label'] ) : '',
				'url' => isset( $input['repeater_footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['url'] ) : '',
				'number' => isset( $input['repeater_footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['number'] ) : '',
				'target' => ! empty( $input['repeater_footer_bar_btns'][$key]['target'] ) ? 1 : 0,
				'icon' => ( isset( $input['repeater_footer_bar_btns'][$key]['icon'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['icon'], $footer_bar_icon_options ) ) ? $input['repeater_footer_bar_btns'][$key]['icon'] : 'file-text'
			);
		}
		unset( $input['repeater_footer_bar_btns'] );
	}
	$input['footer_bar_btns'] = $footer_bar_btns;

	// 404 ページ
	$input['image_404'] = wp_filter_nohtml_kses( $input['image_404'] );
	$input['overlay_404'] = wp_filter_nohtml_kses( $input['overlay_404'] );
	$input['overlay_opacity_404'] = wp_filter_nohtml_kses( $input['overlay_opacity_404'] );
	$input['catchphrase_404'] = wp_filter_nohtml_kses( $input['catchphrase_404'] );
	$input['desc_404'] = wp_filter_nohtml_kses( $input['desc_404'] );
	$input['catchphrase_font_size_404'] = wp_filter_nohtml_kses( $input['catchphrase_font_size_404'] );
	$input['desc_font_size_404'] = wp_filter_nohtml_kses( $input['desc_font_size_404'] );
	$input['color_404'] = wp_filter_nohtml_kses( $input['color_404'] );
	$input['shadow1_404'] = wp_filter_nohtml_kses( $input['shadow1_404'] );
	$input['shadow2_404'] = wp_filter_nohtml_kses( $input['shadow2_404'] );
	$input['shadow3_404'] = wp_filter_nohtml_kses( $input['shadow3_404'] );
	$input['shadow_color_404'] = wp_filter_nohtml_kses( $input['shadow_color_404'] );

	// ネイティブ広告
	$input['native_ad_label_font_size'] = intval( $input['native_ad_label_font_size'] );
	$input['native_ad_label_text_color'] = wp_filter_nohtml_kses( $input['native_ad_label_text_color'] );
	$input['native_ad_label_bg_color'] = wp_filter_nohtml_kses( $input['native_ad_label_bg_color'] );

	for ( $i = 1; $i <= 6; $i++ ) {
		$input['native_ad_title' . $i] = wp_filter_nohtml_kses( $input['native_ad_title'.$i] );
		$input['native_ad_label' . $i] = wp_filter_nohtml_kses( $input['native_ad_label'.$i] );
		$input['native_ad_sponsor' . $i] = wp_filter_nohtml_kses( $input['native_ad_sponsor'.$i] );
		$input['native_ad_desc' . $i] = wp_filter_nohtml_kses( $input['native_ad_desc'.$i] );
		$input['native_ad_image' . $i] = wp_filter_nohtml_kses( $input['native_ad_image'.$i] );
		$input['native_ad_url' . $i] = wp_filter_nohtml_kses( $input['native_ad_url'.$i] );
		$input['native_ad_target' . $i] = ! empty( $input['native_ad_target' . $i] ) ? 1 : 0;
	}

	// 保護ページ
	$input['pw_label'] = wp_filter_nohtml_kses( $input['pw_label'] );
	if ( ! isset( $input['pw_align'] ) || ! array_key_exists( $input['pw_align'], $pw_align_options ) )
		$input['pw_align'] = $dp_default_options['pw_align'];
	for ( $i = 1; $i <= 5; $i++ ) {
		$input['pw_name' . $i] = wp_filter_nohtml_kses( $input['pw_name' . $i] );
		$input['pw_btn_display' . $i] = ! empty( $input['pw_btn_display' . $i] ) ? 1 : 0;
		$input['pw_btn_label' . $i] = wp_filter_nohtml_kses( $input['pw_btn_label' . $i] );
		$input['pw_btn_url' . $i] = wp_filter_nohtml_kses( $input['pw_btn_url' . $i] );
		$input['pw_btn_target' . $i] = ! empty( $input['pw_btn_target' . $i] ) ? 1 : 0;
		$input['pw_editor' . $i] = $input['pw_editor' . $i];
	}

	// コンテンツビルダー
	$input = cb_validate( $input );

	// スラッグ変更チェック
	$dp_options = get_design_plus_option();
	$is_slug_change = false;

	// news
	if ( $dp_options['news_slug'] !== $input['news_slug'] ) {
		register_post_type( $input['news_slug'], array(
			'label' => $input['news_slug'],
			'public' => true,
			'has_archive' => true,
			'hierarchical' => false
		) );
		$is_slug_change = true;
	}

	if ( $is_slug_change ) {
		flush_rewrite_rules( false );
	}

	return $input;
}

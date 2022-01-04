<?php


// 言語ファイル --------------------------------------------------------------------------------
load_textdomain('tcd-w', dirname(__FILE__).'/languages/' . get_locale() . '.mo');


// hook wp_head --------------------------------------------------------------------------------
require get_template_directory() . '/functions/head.php';


// テーマオプション --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/theme-options.php' );


// 更新通知 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/update_notifier.php' );


// Javascriptの読み込み -----------------------------------------------------------------------
function widget_admin_scripts() {
  wp_enqueue_script('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_style('imgareaselect');
  wp_enqueue_style('jquery-ui-draggable');
  wp_enqueue_script('ml-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1.0.0', true);
  wp_enqueue_script('dp-image-manager', get_template_directory_uri().'/admin/js/image-manager.js', '', '1.0.0', true);
  wp_enqueue_script('jscolor', get_template_directory_uri().'/admin/js/jscolor.js', '', '1.0.0', true);
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/js/jquery.cookieTab.js', '', '1.0.0', true);
  wp_enqueue_script('my_script', get_template_directory_uri().'/admin/js/my_script.js', '', '1.4.0', true);
	wp_enqueue_media();//画像アップロード用
?>
<script type="text/javascript">
  var cfmf_text = { title:'<?php _e('Please Select Image', 'tcd-w'); ?>', button:'<?php _e('Use this Image', 'tcd-w'); ?>' };
  var cfvf_text = { title:'<?php _e('Please Select Video', 'tcd-w'); ?>', button:'<?php _e('Use this Video', 'tcd-w'); ?>' };
</script>
<?php
  wp_enqueue_script('cf-media-field', get_template_directory_uri().'/admin/js/cf-media-field.js', '', '1.0.0', true); //画像アップロード用
}
add_action('admin_print_scripts', 'widget_admin_scripts');


// スタイルシートの読み込み -----------------------------------------------------------------------
function my_admin_styles() {
    wp_enqueue_style('thickbox');
    wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/style.css');
    wp_enqueue_style('my_admin_css', get_template_directory_uri() .'/admin/css/my_admin.css');
}
add_action('admin_print_styles', 'my_admin_styles');


// ビジュアルエディタ用スタイルシートの読み込み --------------------------------------------------------------------------------
function wpdocs_theme_add_editor_styles() {
  add_editor_style('editor-style-02.css');//管理画面用のスタイルシートを変更した場合は、ファイルの名前と番号を変える （キャッシュ対策）
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


// ページビルダー --------------------------------------------------------------------------------
require get_template_directory() . '/pagebuilder/pagebuilder.php';


// おすすめ記事 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/recommend.php';


// meta title meta description  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/seo.php' );


// 管理画面の記事一覧、クイック編集 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/admin_column.php';
require get_template_directory() . '/functions/quick_edit.php';


// ページ用カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/page_cf.php';
require get_template_directory() . '/functions/page_cf2.php';


// カテゴリー・プログラムカテゴリー用カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/category.php';


// コース用カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/course_cf.php';
require get_template_directory() . '/functions/course_cf2.php';


// お客様の声用カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/voice_cf.php';


// スタッフ用カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/staff_cf.php';


// カスタムCSS --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_css.php';


// ビジュアルエディタにクイックタグを追加 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_editor.php';


// ショートコード --------------------------------------------------------------------------------
require get_template_directory() . '/functions/short_code.php';


// ウィジェット ------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/widget/ad.php' );
require_once ( dirname(__FILE__) . '/widget/styled_post_list1.php' );
require_once ( dirname(__FILE__) . '/widget/google_search.php' );
require_once ( dirname(__FILE__) . '/widget/category_list.php' );
require_once ( dirname(__FILE__) . '/widget/archive_list.php' );
require_once ( dirname(__FILE__) . '/widget/course_list.php' );
require_once ( dirname(__FILE__) . '/widget/banner_list.php' );
require_once ( dirname(__FILE__) . '/widget/campaign_list.php' );
require_once ( dirname(__FILE__) . '/widget/news_list.php' );
require_once ( dirname(__FILE__) . '/widget/staff_list.php' );
require_once ( dirname(__FILE__) . '/widget/voice_list.php' );


// カスタムページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/custom_page_link.php' );


// OGP tag  -------------------------------------------------------------------------------------------
require get_template_directory() . '/functions/ogp.php';


// 次のページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/next_prev.php' );


//ロゴ用関数 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/logo.php' );


// ビジュアルエディタに表(テーブル)の機能を追加 -----------------------------------------------
function mce_external_plugins_table($plugins) {
    $plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

// tinymceのtableボタンにclass属性プルダウンメニューを追加
function mce_buttons_table($buttons) {
    $buttons[] = 'table';
    return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function bootstrap_classes_tinymce($settings) {
  $styles = array(
    array('title' => __('Default style', 'tcd-w'), 'value' => ''),
    array('title' => __('No border', 'tcd-w'), 'value' => 'table_no_border'),
    array('title' => __('Display only horizontal border', 'tcd-w'), 'value' => 'table_border_horizontal')
  );
  $settings['table_class_list'] = json_encode($styles);
  return $settings;
}
add_filter('tiny_mce_before_init', 'bootstrap_classes_tinymce');


// ユーザーエージェントを判定するための関数---------------------------------------------------------------------
function is_mobile() {

 //タブレットも含める場合はwp_is_mobile()

 $match = 0;

 $ua = array(
   'iPhone', // iPhone
   'iPod', // iPod touch
   'Android.*Mobile', // 1.5+ Android *** Only mobile
   'Windows.*Phone', // *** Windows Phone
   'dream', // Pre 1.5 Android
   'CUPCAKE', // 1.5+ Android
   'BlackBerry', // BlackBerry
   'BB10', // BlackBerry10
   'webOS', // Palm Pre Experimental
   'incognito', // Other iPhone browser
   'webmate' // Other iPhone browser
 );

 $pattern = '/' . implode( '|', $ua ) . '/i';
 $match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

 if ( $match === 1 ) {
   return TRUE;
 } else {
   return FALSE;
 }

}


// レスポンシブOFF機能を判定するための関数---------------------------------------------------------------------
function is_no_responsive() {

 $options = get_desing_plus_option();
 $use_responsive = $options['responsive'];

 if ( $use_responsive == 'no' ) {
   return TRUE;
 } else {
   return FALSE;
 }

}


// スクリプトのバージョン管理 ----------------------------------------------------------------------------------------------
function version_num() {

 if (function_exists('wp_get_theme')) {
   $theme_data = wp_get_theme();
 } else {
   $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
 };

 $current_version = $theme_data['Version'];

 return $current_version;

};


// ウィジェットの設定 ------------------------------------------------------------------------------
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Post side widget', 'tcd-w'),
        'id' => 'post_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Page side widget', 'tcd-w'),
        'id' => 'page_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('News side widget', 'tcd-w'),
        'id' => 'news_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Campaign side widget', 'tcd-w'),
        'id' => 'campaign_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Course side widget', 'tcd-w'),
        'id' => 'course_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Voice side widget', 'tcd-w'),
        'id' => 'voice_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Staff side widget', 'tcd-w'),
        'id' => 'staff_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget footer_widget %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="footer_headline">',
        'after_title' => "</h3>",
        'name' => __('Footer widget', 'tcd-w'),
        'id' => 'footer_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Post side widget (mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'post_widget_mobile'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Page side widget (mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'page_widget_mobile'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('News side widget (mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'news_widget_mobile'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Campaign side widget (mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'campaign_widget_mobile'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Course side widget (mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'course_widget_mobile'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Voice side widget (mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'voice_widget_mobile'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline"><span>',
        'after_title' => "</span></h3>",
        'name' => __('Staff side widget (mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'staff_widget_mobile'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="widget footer_widget %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="footer_headline">',
        'after_title' => "</h3>",
        'name' => __('Footer widget (mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'footer_widget_mobile'
    ));
}

// オリジナルの抜粋記事 --------------------------------------------------------------------------------
function new_excerpt($a) {

 if(has_excerpt()) { 

   $base_content = get_the_excerpt();
   $base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");

 } else {

   $base_content = get_the_content();
   $base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
   $base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
   $base_content = preg_replace('/\[.+\]/','', $base_content);
   $base_content = strip_tags($base_content);
   $trim_content = mb_substr($base_content, 0, $a,"utf-8");
   $trim_content = str_replace(']]>', ']]&gt;', $trim_content);
   $trim_content = str_replace(array("\r\n", "\r", "\n" , "&nbsp;"), "", $trim_content);
   $trim_content = htmlspecialchars($trim_content);

 };

 echo $trim_content . '…';

};

//抜粋からPタグを取り除く
remove_filter( 'the_excerpt', 'wpautop' );


// 記事タイトルの文字数制限 --------------------------------------------------------------------------------
function trim_title($num) {
 $base_title = get_the_title();
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strlen($trim_title,"utf-8");
 if($count_title > $num-1) {
  echo $trim_title . '…';
 } else {
  echo $trim_title;
 };
};


// タイトルをエンコード --------------------------------------------------------------------------------
function get_encoded_title($title){
  return urlencode(mb_convert_encoding($title, "UTF-8"));
}


// カテゴリーを1つだけ表示する --------------------------------------------------------------------------------
function show_one_category() {
  $category = get_the_category();

  if ($category) {
    // 最初のカテゴリーだけを表示
    $category = array_shift($category);
  }

  if (!empty($category->term_id)) {
    // カテゴリーカスタムフィールド
    $term_meta = get_option('taxonomy_'.$category->term_id, array());

    echo '<li class="category category2"';

    // カテゴリーカラー
    if (!empty($term_meta['category_color'])) {
      echo ' style="background-color:rgba('.implode(',', hex2rgb($term_meta['category_color'])).',0.8);"';
    } 

    echo '><a href="'.get_category_link($category->term_id).'">'.esc_html($category->name).'</a></li>';
  }
}


// セルフピンバックを禁止する -------------------------------------------------------------------------------------
function no_self_ping( &$links ) {
  $home = home_url();
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );


// RSS用のフィードを追加 ---------------------------------------------------------------------------------------------------
add_theme_support( 'automatic-feed-links' );


//　ヘッダーから余分なMETA情報を削除 --------------------------------------------------------------------
remove_action( 'wp_head', 'wp_generator' ); 
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );


// 固定ページからアイキャッチ用meta boxを削除 -----------------------------------------------------------
function remove_image_metabox_from_page() {
  remove_meta_box( 'postimagediv', 'page', 'side' );
}
add_action( 'do_meta_boxes' , 'remove_image_metabox_from_page' );


// インラインスタイルを取り除く --------------------------------------------------------------------------------
function remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

function remove_adminbar_inline_style() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_adminbar_inline_style');


//　サムネイルの設定 --------------------------------------------------------------------------------
if (function_exists('add_theme_support')) {
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size( 800, 0, false );
  add_image_size( 'size1', 150, 150, true ); // styled_post_list1ウィジェットで利用 画質対策で100x100の1.5倍
  add_image_size( 'size2', 270, 174, true ); // ニュース一覧・関連記事で利用 画質対策で225x145の1.2倍
  add_image_size( 'size3', 456, 252, true ); // コースバナーで利用 画質対策で380x210の1.2倍
  add_image_size( 'size4', 456, 296, true ); // 記事一覧・トップページで利用 画質対策で380x245の1.2倍
  add_image_size( 'size5', 1150, 0, false ); // トップページスライダーで利用
  add_image_size( 'size6', 200, 200, true ); // スタッフ一覧詳細・お客様の声詳細で利用
  add_image_size( 'size8', 800, 0, false ); // ページビルダーのスライダーで利用
}

// 各サムネイル画像生成時の品質を82→90に
function custom_wp_editor_set_quality($quality, $mime_type) {
	return 90;
}
add_filter('wp_editor_set_quality', 'custom_wp_editor_set_quality', 10, 2);


// カスタムメニューの設定 --------------------------------------------------------------------------------
if(function_exists('register_nav_menu')) {
  register_nav_menu( 'global-menu', __( 'Global menu', 'tcd-w' ) );
}


// ページナビ用 --------------------------------------------------------------------------------
function show_posts_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
};


// 絵文字を消す ------------------------------------------------------------------
function disable_emoji() {
     $options = get_desing_plus_option();
     if($options['use_emoji'] == 0) {
       remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
       remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
       remove_action( 'wp_print_styles', 'print_emoji_styles' );
       remove_action( 'admin_print_styles', 'print_emoji_styles' );    
       remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
       remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );    
       remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
     };
}
add_action( 'init', 'disable_emoji' );


// bodyタグにclassを追加 --------------------------------------------------------------------------------
function ml_body_classes($classes) {
    global $wp_query, $post;
    $options = get_desing_plus_option();

    if($options['header_fix'] == 'type2') {
        $classes[] = 'fix_top';
    }

    if ($options['mobile_header_fix'] == 'type2') {
      $classes[] = 'mobile_fix_top';
    }

    if (is_mobile()) {
      $classes[] = 'mobile_device';
      if ($options['footer_bar_display'] == 'type1' || $options['footer_bar_display'] == 'type2') {
        $classes[] = 'mobile_footer_bar';
      }
    }

    if (is_front_page() && $options['show_index_topics_content']) {
      $classes[] = 'show_index_topics';
    }

    return array_unique($classes);
};
add_filter('body_class','ml_body_classes');


// RGBをHEXに変換 ------------------------------------------------------------------
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}



if ( function_exists('register_post_type') ) {
 // カスタム投稿　「お知らせ」を追加 ----------------------------------------------------------------
 $options = get_desing_plus_option();
 $labels = array(
  //'name' => __('News', 'tcd-w'),
  'name' => $options['news_breadcrumb_headline'],
  'singular_name' => __('News', 'tcd-w'),
  'add_new' => __('Add New', 'tcd-w'),
  'add_new_item' => __('Add New Item', 'tcd-w'),
  'edit_item' => __('Edit', 'tcd-w'),
  'new_item' => __('New item', 'tcd-w'),
  'view_item' => __('View Item', 'tcd-w'),
  'search_items' => __('Search Items', 'tcd-w'),
  'not_found' => __('Not Found', 'tcd-w'),
  'not_found_in_trash' => __('Not found in trash', 'tcd-w'), 
  'parent_item_colon' => ''
 );

 register_post_type('news', array(
  'label' => __('News', 'tcd-w'),
  'labels' => $labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array('title', 'editor', 'thumbnail')
 ));

 // カスタム投稿　「キャンペーン」を追加 ----------------------------------------------------------------
 $labels = array(
  //'name' => __('Campaign', 'tcd-w'),
  'name' => $options['campaign_breadcrumb_headline'],
  'singular_name' => __('Campaign', 'tcd-w'),
  'add_new' => __('Add New', 'tcd-w'),
  'add_new_item' => __('Add New Item', 'tcd-w'),
  'edit_item' => __('Edit', 'tcd-w'),
  'new_item' => __('New item', 'tcd-w'),
  'view_item' => __('View Item', 'tcd-w'),
  'search_items' => __('Search Items', 'tcd-w'),
  'not_found' => __('Not Found', 'tcd-w'),
  'not_found_in_trash' => __('Not found in trash', 'tcd-w'), 
  'parent_item_colon' => ''
 );

 register_post_type('campaign', array(
  'label' => __('Campaign', 'tcd-w'),
  'labels' => $labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array('title', 'editor', 'thumbnail')
 ));

 // カスタム投稿　「コース」を追加 ----------------------------------------------------------------
 $labels = array(
  //'name' => __('Course', 'tcd-w'),
  'name' => $options['course_breadcrumb_headline'],
  'singular_name' => __('Course', 'tcd-w'),
  'add_new' => __('Add New', 'tcd-w'),
  'add_new_item' => __('Add New Item', 'tcd-w'),
  'edit_item' => __('Edit', 'tcd-w'),
  'new_item' => __('New item', 'tcd-w'),
  'view_item' => __('View Item', 'tcd-w'),
  'search_items' => __('Search Items', 'tcd-w'),
  'not_found' => __('Not Found', 'tcd-w'),
  'not_found_in_trash' => __('Not found in trash', 'tcd-w'), 
  'parent_item_colon' => ''
 );

 register_post_type('course', array(
  'label' => __('Course', 'tcd-w'),
  'labels' => $labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array('title', 'editor')
 ));

  // コースカテゴリーの追加
  $args_course_category = array(
    'label' => __('Course Category', 'tcd-w'),
    'labels' => array(
      'name' => __('Course Category', 'tcd-w'),
      'singular_name' => __('Course Category', 'tcd-w'),
      'search_items' => __('Search Category', 'tcd-w'),
      'popular_items' => __('Popular Category', 'tcd-w'),
      'all_items' => __('All Category', 'tcd-w'),
      'parent_item' => __('Parent Category', 'tcd-w'),
      'edit_item' => __('Edit Category', 'tcd-w'),
      'update_item' => __('Update Category', 'tcd-w'),
      'add_new_item' => __('Add New Category', 'tcd-w'),
      'new_item_name' => __('Name Of New Category', 'tcd-w'),
    ),
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'hierarchical' => true,
    'rewrite' => array('hierarchical' => false),
  );
  register_taxonomy('course_category', 'course', $args_course_category);

  // コースカテゴリーのURLをコースURL+ハッシュに変更
  function course_category_term_link($termlink, $term, $taxonomy) {
    if ($taxonomy == 'course_category') {
      return get_post_type_archive_link('course').'#course_category-'.$term->term_id;
    }
    return $termlink;
  }
  add_filter('term_link', 'course_category_term_link', 11, 3);

// カスタム投稿　「お客様の声」を追加 ----------------------------------------------------------------
 $labels = array(
  //'name' => __('Voice', 'tcd-w'),
  'name' => $options['voice_breadcrumb_headline'],
  'singular_name' => __('Voice', 'tcd-w'),
  'add_new' => __('Add New', 'tcd-w'),
  'add_new_item' => __('Add New Item', 'tcd-w'),
  'edit_item' => __('Edit', 'tcd-w'),
  'new_item' => __('New item', 'tcd-w'),
  'view_item' => __('View Item', 'tcd-w'),
  'search_items' => __('Search Items', 'tcd-w'),
  'not_found' => __('Not Found', 'tcd-w'),
  'not_found_in_trash' => __('Not found in trash', 'tcd-w'), 
  'parent_item_colon' => ''
 );

 register_post_type('voice', array(
  'label' => __('Voice', 'tcd-w'),
  'labels' => $labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array('title', 'thumbnail')
 ));

// カスタム投稿　「スタッフ」を追加 ----------------------------------------------------------------
 $labels = array(
  //'name' => __('Staff', 'tcd-w'),
  'name' => $options['staff_breadcrumb_headline'],
  'singular_name' => __('Staff', 'tcd-w'),
  'add_new' => __('Add New', 'tcd-w'),
  'add_new_item' => __('Add New Item', 'tcd-w'),
  'edit_item' => __('Edit', 'tcd-w'),
  'new_item' => __('New item', 'tcd-w'),
  'view_item' => __('View Item', 'tcd-w'),
  'search_items' => __('Search Items', 'tcd-w'),
  'not_found' => __('Not Found', 'tcd-w'),
  'not_found_in_trash' => __('Not found in trash', 'tcd-w'), 
  'parent_item_colon' => ''
 );

 register_post_type('staff', array(
  'label' => __('Staff', 'tcd-w'),
  'labels' => $labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array('title', 'editor', 'thumbnail')
 ));

  // staff一覧は全件表示
  function pre_get_posts_staff($wp_query) {
    if ( ! is_admin() && $wp_query->is_main_query() && $wp_query->is_post_type_archive( 'staff' ) ) {
      $wp_query->set( 'posts_per_page', -1 );
    }
  }
  add_filter( 'pre_get_posts', 'pre_get_posts_staff' );
}

// 管理画面 メニュー項目編集
function tcd2017_admin_menu() {
	global $menu, $submenu;

	// メディアの場所を10→14（固定ページの上）に
	if (isset($menu[10][0]) && $menu[10][2] == 'upload.php') {
		$menu[14] = $menu[10];
		unset($menu[10]);
	}
}
add_action('admin_menu', 'tcd2017_admin_menu');



// カードリンクパーツ --------------------------------------------------------------------------------------
add_image_size( 'size-card', 150, 150, true );

function get_the_custom_excerpt($content, $length) {
  $length = ($length ? $length : 70);//デフォルトの長さを指定する
  $content =  preg_replace('/<!--more-->.+/is',"",$content); //moreタグ以降削除
  $content =  strip_shortcodes($content);//ショートコード削除
  $content =  strip_tags($content);//タグの除去
  $content =  str_replace("&nbsp;","",$content);//特殊文字の削除（今回はスペースのみ）
  $content =  mb_substr($content,0,$length);//文字列を指定した長さで切り取る
  return $content.'...';
}
 
//カードリンクショートコード
function clink_scode($atts) {
  extract(shortcode_atts(array(
    'url'=>"",
    'title'=>"",
    'excerpt'=>""
    ),$atts));

  $id = url_to_postid($url);//URLから投稿IDを取得
  $post = get_post($id);//IDから投稿情報の取得
  $date = mysql2date('Y.m.d', $post->post_date);//投稿日の取得

  $img_width ="120";//画像サイズの幅指定
  $img_height = "120";//画像サイズの高さ指定
  $no_image = get_template_directory_uri().'/img/common/no_image1.gif';

  //抜粋を取得
  if(empty($excerpt)){
    if($post->post_excerpt){
      $excerpt = get_the_custom_excerpt($post->post_excerpt , 145);
    }else{
      $excerpt = get_the_custom_excerpt($post->post_content , 145);
    }
  }

  //タイトルを取得
  if(empty($title)){
    $title = esc_html(get_the_title($id));
  }
  //アイキャッチ画像を取得 
  if(has_post_thumbnail($id)) {
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($id),'size-card');
    $img_tag = "<img src='" . $img[0] . "' alt='{$title}' width=" . $img_width . " height=" . $img_height . " />";
  } else {
    $img_tag ='<img src="'.$no_image.'" alt="" width="'.$img_width.'" height="'.$img_height.'" />';
  }

  $clink ='<div class="cardlink"><a href="'. $url .'"><div class="cardlink_thumbnail">'. $img_tag .'</a></div><div class="cardlink_content"><span class="timestamp">'.$date.'</span><div class="cardlink_title"><a href="'. $url .'">'. $title .' </a></div><div class="cardlink_excerpt">' . $excerpt . '</div></div><div class="cardlink_footer"></div></div>';

  return $clink;
}
add_shortcode("clink", "clink_scode");


/**
* ロゴ画像を保存しているディレクトリ名を返す 
* @return string
*/
function dp_logo_basedir() {
	$dir = wp_upload_dir();
	return $dir['basedir'] . DIRECTORY_SEPARATOR . 'tcd-w';
}

/**
* ロゴ画像を保存しているディレクトリのURLを返す
* @return string
*/
function dp_logo_baseurl() {
  $dir = wp_upload_dir();
  $dir_url = $dir['baseurl'];
  if(is_ssl()){
    $dir_url_str = str_replace('http:', 'https:', $dir_url);
  }else{
    $dir_url_str = $dir_url;
  }
  return $dir_url_str.'/tcd-w';
}

/**
 * アップロードされたロゴか否か
 * @param string $url
 * @return boolean 
 */
function dp_is_uploaded_img( $url ) {
  $dp_logo_baseurl = str_replace( array( 'https://', 'http://' ), '', dp_logo_baseurl() );
  $url = str_replace( array( 'https://', 'http://' ), '', $url );
  return false !== strpos( $url, $dp_logo_baseurl );
}

/**
 * ロゴ画像を削除する
 * @return void
 */
function _dp_delete_image(){
  if(isset($_REQUEST['page'], $_REQUEST['_wpnonce']) && !isset($_REQUEST['settings-updated']) && $_REQUEST['page'] == 'theme_options'){
    $options = get_desing_plus_option();

    if(wp_verify_nonce($_REQUEST['_wpnonce'], 'dp_delete_favicon')){
      $file = basename($options['favicon']);
      if(file_exists(dp_logo_basedir().DIRECTORY_SEPARATOR.$file) && @unlink(dp_logo_basedir().DIRECTORY_SEPARATOR.$file)){
        $options['favicon'] = '';
        update_option('dp_options', $options);
        add_action('admin_notices', '_dp_delete_message_sucess');
      }else{
        add_action('admin_notices', '_dp_delete_message_error');
      }
    }

  }
}
add_action('admin_init', '_dp_delete_image');

/**
 * ロゴ画像の削除失敗メッセージ 
 */
function _dp_delete_message_error(){
  echo '<div id="message" class="error"><p>'.sprintf(__('Failed to delete image. Please check permisson of %s. All files must be writable.', 'tcd-w'), dp_logo_basedir()).'</p></div>';
}

/**
 * ロゴ画像の削除成功メッセージ 
 */
function _dp_delete_message_sucess(){
  echo '<div id="message" class="updated fade"><p>'.__('Images are successfully deleted.', 'tcd-w').'</p></div>';
}

/**
 * アップロードエラーのメッセージを表示する
 * @param int $error_code
 * @return string 
 */
function _dp_get_upload_err_msg( $error_code ) {
	switch ( $error_code ) {
		case UPLOAD_ERR_INI_SIZE:
			return __( 'Uploaded file size is larger than limit set in php.ini.', 'tcd-w' );
			break;
		case UPLOAD_ERR_FORM_SIZE:
			return __( 'Uploaded file size is larget than post file size.', 'tcd-w' );
			break;
		case UPLOAD_ERR_PARTIAL:
			return  __(	'The file has been uploaded only partially. Connection error may have occured', 'tcd-w' );
			break;
		case UPLOAD_ERR_NO_FILE:
			return  __(	'Uploaded file size is too large.', 'tcd-w' );
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			return  __(	'No temporary directory exists. Please check PHP Setting is valid.', 'tcd-w' );
			break;
		case UPLOAD_ERR_CANT_WRITE:
			return  __(	'Failed to write to disk. OS file setting or something is wrong.', 'tcd-w' );
			break;
		case UPLOAD_ERR_EXTENSION:
			return  __(	'PHP extension module stops uploading. Check PHP setting.', 'tcd-w' );
			break;
		default:
			return  __(	'Upload failed. Sorry, but reasons cannot be detected.', 'tcd-w' );
			break;
	}
}


// カスタムコメント --------------------------------------------------------------------------------------

if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}


function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta clearfix">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>
  
    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif;  $options = get_option('tcd-w_options'); ?>
     </li>
     <li class="comment-date"><?php echo get_comment_time(__('F jS, Y', 'tcd-w')); if ($options['time_stamp']) : echo get_comment_time(__(' g:ia', 'tcd-w')); endif; ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) { 
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','tcd-w').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-w'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-w'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'tcd-w'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'tcd-w'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content post_content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'tcd-w'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php
}
?>
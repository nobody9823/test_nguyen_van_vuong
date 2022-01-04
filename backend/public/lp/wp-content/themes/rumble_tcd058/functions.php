<?php

/**
 * Translation
 */
load_theme_textdomain( 'tcd-w', get_template_directory() . '/languages' );

/**
 * Theme setup
 */
function rumble_setup() {

	// Post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Title tag
	add_theme_support( 'title-tag' );

	// Image sizes
	add_image_size( 'size1', 300, 300, true );
	add_image_size( 'size2', 600, 420, true );
	add_image_size( 'size3', 600, 600, true );
	add_image_size( 'size4', 900, 900, true );
	add_image_size( 'size5', 1200, 0, true );
	add_image_size( 'size6', 1450, 600, true );
	add_image_size( 'size-card', 120, 120, true ); // カードリンクパーツ用

	// imgタグのsrcsetを未使用に
	add_filter( 'wp_calculate_image_srcset', '__return_false' );

	// Menu
	register_nav_menus( array(
		'header' => __( 'Header menu', 'tcd-w' ),
		'global' => __( 'Global menu', 'tcd-w' ),
		'footer' => __( 'Footer menu', 'tcd-w' )
	) );

}
add_action( 'after_setup_theme', 'rumble_setup' );

/**
 * Theme init
 */
function rumble_init() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// Emoji
	if ( 0 == $dp_options['use_emoji'] ) {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}

	// カスタム投稿 お知らせ
	register_post_type( $dp_options['news_slug'], array(
		'label' => $dp_options['news_breadcrumb_label'],
		'labels' => array(
			'name' => $dp_options['news_breadcrumb_label'],
			'singular_name' => $dp_options['news_breadcrumb_label'],
			'add_new' => __( 'Add New', 'tcd-w' ),
			'add_new_item' => __( 'Add New Item', 'tcd-w' ),
			'edit_item' => __( 'Edit', 'tcd-w' ),
			'new_item' => __( 'New item', 'tcd-w' ),
			'view_item' => __( 'View Item', 'tcd-w' ),
			'search_items' => __( 'Search Items', 'tcd-w' ),
			'not_found' => __( 'Not Found', 'tcd-w' ),
			'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
			'parent_item_colon' => ''
		),
		'public' => true,
		'publicly_queryable' => true,
		'menu_position' => 5,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	) );
}
add_action( 'init', 'rumble_init' );

/**
 * Theme scripts and style
 */
function rumble_scripts() {

	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// slick読み込みフラグ
	$slick_load = false;

	if ( is_front_page() ) {
		$slick_load = true;
		wp_enqueue_script( 'rumble-front-page', get_template_directory_uri() . '/js/front-page.js', array( 'jquery' ), version_num(), true );
	} elseif ( $dp_options['show_footer_blog'] ) {
		$slick_load = true;
	} elseif ( is_category() ) {
		$term_meta = get_option( 'taxonomy_' . get_query_var( 'cat' ), array() );
		if ( ! empty( $term_meta['archive_slider'] ) ) {
			$slick_load = true;
		}
	}

	// 共通
	wp_enqueue_style( 'rumble-style', get_stylesheet_uri(), array(), version_num() );
	wp_enqueue_script( 'rumble-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), version_num(), true );

	// slick
	if ( $slick_load ) {
		wp_enqueue_script( 'rumble-slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), version_num(), true );
		wp_enqueue_style( 'rumble-slick', get_template_directory_uri() . '/css/slick.min.css' );

		// ページビルダーのslick.js,slick.cssを読み込まないように
		add_filter( 'page_builder_slick_enqueue_script', '__return_false' );
		add_filter( 'page_builder_slick_enqueue_style', '__return_false' );
	}

	// レスポンシブ
	if ( ! is_no_responsive() ) {
		wp_enqueue_style( 'rumble-responsive', get_template_directory_uri() . '/responsive.css', array( 'rumble-style' ), version_num() );
		if ( is_mobile() && 'type3' !== $dp_options['footer_bar_display'] ) {
			wp_enqueue_style( 'rumble-footer-bar', get_template_directory_uri() . '/css/footer-bar.css', false, version_num() );
			wp_enqueue_script( 'rumble-footer-bar', get_template_directory_uri() . '/js/footer-bar.js', array( 'jquery' ), version_num(), true );
		}
	}

	// ヘッダースクロール
	if ( 'type2' == $dp_options['header_fix'] || 'type2' == $dp_options['mobile_header_fix'] ) {
		wp_enqueue_script( 'rumble-header-fix', get_template_directory_uri() . '/js/header-fix.js', array( 'jquery' ), version_num(), true );
	}

	// アドミンバーのインラインスタイルを出力しない
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'wp_enqueue_scripts', 'rumble_scripts' );

function rumble_admin_scripts() {

	// 管理画面共通
	wp_enqueue_style( 'tcd_admin_css', get_template_directory_uri() . '/admin/css/tcd_admin.css', array(), version_num() );
	wp_enqueue_script( 'tcd_script', get_template_directory_uri() . '/admin/js/tcd_script.js', array(), version_num() );
	wp_localize_script( 'tcd_script', 'TCD_MESSAGES', array(
		'ajaxSubmitSuccess' => __( 'Settings Saved Successfully', 'tcd-w' ),
		'ajaxSubmitError' => __( 'Can not save data. Please try again.', 'tcd-w' )
	) );

	// 画像アップロードで使用
	wp_enqueue_script( 'cf-media-field', get_template_directory_uri() . '/admin/js/cf-media-field.js', array( 'media-upload' ), version_num() );
	wp_localize_script( 'cf-media-field', 'cfmf_text', array(
		'image_title' => __( 'Please Select Image', 'tcd-w' ),
		'image_button' => __( 'Use this Image', 'tcd-w' ),
		'video_title' => __( 'Please Select Video', 'tcd-w' ),
		'video_button' => __( 'Use this Video', 'tcd-w' )
	) );

	// メディアアップローダーAPIを利用するための処理
	wp_enqueue_media();

	// ウィジェットで使用
	wp_enqueue_script( 'rumble-widget-script', get_template_directory_uri() . '/admin/js/widget.js', array( 'jquery' ), version_num() );

	// テーマオプションのタブで使用
	wp_enqueue_script( 'jquery.cookieTab', get_template_directory_uri() . '/admin/js/jquery.cookieTab.js', array(), version_num() );

	// テーマオプションのAJAX保存で使用
	wp_enqueue_script( 'jquery-form' );

	// フッターバー
	wp_enqueue_style( 'rumble-admin-footer-bar', get_template_directory_uri() . '/admin/css/footer-bar.css', array(), version_num() );
	wp_enqueue_script( 'rumble-admin-footer-bar', get_template_directory_uri() . '/admin/js/footer-bar.js', array(), version_num() );

	// WPカラーピッカー
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'rumble_admin_scripts' );

// Editor style
function rumble_add_editor_styles() {
	add_editor_style( 'admin/css/editor-style-02.css' );
}
add_action( 'admin_init', 'rumble_add_editor_styles' );

// 各サムネイル画像生成時の品質を82→90に
function rumble_wp_editor_set_quality( $quality, $mime_type ) {
	return 90;
}
add_filter( 'wp_editor_set_quality', 'rumble_wp_editor_set_quality', 10, 2 );

// Widget area
function rumble_widgets_init() {

	// Common sidebar A widget
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Common sidebar A widget', 'tcd-w' ),
        'description' => __('Widgets set in this widget area are displayed as "basic widget" in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-w'),
		'id' => 'common_side_widget'
	) );

	// Index sidebar A widget
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Index sidebar A widget', 'tcd-w' ),
		'id' => 'index_side_widget'
	) );

	// Archive sidebar A widget
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Archive sidebar A widget', 'tcd-w' ),
		'id' => 'archive_side_widget'
	) );

	// Post sidebar A widget
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Post sidebar A widget', 'tcd-w' ),
		'id' => 'post_side_widget'
	) );

	// News sidebar A widget
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'News sidebar A widget', 'tcd-w' ),
		'id' => 'news_side_widget'
	) );

	// Page sidebar A widget
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Page sidebar A widget', 'tcd-w' ),
		'id' => 'page_side_widget'
	) );

	// Sidebar B
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Sidebar B widget', 'tcd-w' ),
		'id' => 'side_b_widget'
	) );

	// Footer
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Footer widget', 'tcd-w' ),
		'id' => 'footer_widget'
	) );

	// Index sidebar A widget (mobile)
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Index sidebar A widget (mobile)', 'tcd-w' ),
		'id' => 'index_side_widget_mobile'
	) );

	// Archive sidebar A widget (mobile)
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Archive sidebar A widget (mobile)', 'tcd-w' ),
		'id' => 'archive_side_widget_mobile'
	) );

	// Post sidebar A widget (mobile)
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Post sidebar A widget (mobile)', 'tcd-w' ),
		'id' => 'post_side_widget_mobile'
	) );

	// News sidebar A widget (mobile)
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'News sidebar A widget (mobile)', 'tcd-w' ),
		'id' => 'news_side_widget_mobile'
	) );

	// Page sidebar A widget (mobile)
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Page sidebar A widget (mobile)', 'tcd-w' ),
		'id' => 'page_side_widget_mobile'
	) );

	// Sidebar B (mobile)
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Sidebar B widget (mobile)', 'tcd-w' ),
		'id' => 'side_b_widget_mobile'
	) );

	// Footer (mobile)
	register_sidebar( array(
		'before_widget' => '<div class="p-widget %2$s" id="%1$s">' . "\n",
		'after_widget' => "</div>\n",
		'before_title' => '<h2 class="p-widget__title">',
		'after_title' => '</h2>' . "\n",
		'name' => __( 'Footer widget (mobile)', 'tcd-w' ),
		'id' => 'footer_widget_mobile'
	) );

}
add_action( 'widgets_init', 'rumble_widgets_init' );

/**
 * get active sidebars
 */
function get_active_sidebars() {
	global $post, $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$active_sidebars = array(
		'sidebar_a' => false,
		'sidebar_b' => false,
		'column_layout_class' => null
	);
	$sidebars_a = array();

	// sidebar a
	if ( is_page() ) {
		$display_side_content = $post->display_side_content;
		if ( ! $display_side_content || ! in_array( $display_side_content, array( 'type1', 'type2', 'type3', 'hide' ) ) ) {
			$display_side_content = 'type1';
		}
	} elseif ( is_singular( 'post' ) ) {
		$display_side_content = $post->display_side_content;
		if ( ! $display_side_content ) {
			$display_side_content = $dp_options['single_display_side_content'];
		}
	}

	if ( is_front_page() ) {
		if ( is_mobile() ) {
			$sidebars_a[] = 'index_side_widget_mobile';
			$sidebars_a[] = 'archive_side_widget_mobile';
			$sidebars_a[] = 'common_side_widget';
		} else {
			$sidebars_a[] = 'index_side_widget';
			$sidebars_a[] = 'archive_side_widget';
			$sidebars_a[] = 'common_side_widget';
		}

	} elseif ( is_post_type_archive( $dp_options['news_slug'] ) || is_singular( $dp_options['news_slug'] ) ) {
		if ( is_mobile() ) {
			$sidebars_a[] = 'news_side_widget_mobile';
			$sidebars_a[] = 'common_side_widget';
		} else {
			$sidebars_a[] = 'common_side_widget';
			$sidebars_a[] = 'news_side_widget';
		}

	} elseif ( is_home() || is_archive() ) {
		if ( is_mobile() ) {
			$sidebars_a[] = 'archive_side_widget_mobile';
			$sidebars_a[] = 'common_side_widget';
		} else {
			$sidebars_a[] = 'archive_side_widget';
			$sidebars_a[] = 'common_side_widget';
		}

	} elseif ( is_page() ) {
		if ( in_array( $display_side_content, array( 'type1', 'type2' ) ) ) {
			if ( is_mobile() ) {
				$sidebars_a[] = 'page_side_widget_mobile';
				$sidebars_a[] = 'common_side_widget';
			} else {
				$sidebars_a[] = 'page_side_widget';
				$sidebars_a[] = 'common_side_widget';
			}
		}

	} elseif ( is_singular() ) {
		if ( in_array( $display_side_content, array( 'type1', 'type2' ) ) ) {
			if ( is_mobile() ) {
				$sidebars_a[] = 'post_side_widget_mobile';
				$sidebars_a[] = 'common_side_widget';
			} else {
				$sidebars_a[] = 'post_side_widget';
				$sidebars_a[] = 'common_side_widget';
			}
		}
	} else {
		$sidebars_a[] = 'common_side_widget';
	}

	if ( ! empty( $sidebars_a ) ) {
		foreach ( $sidebars_a as $sidebar ) {
			if ( is_active_sidebar( $sidebar ) ) {
				$active_sidebars['sidebar_a'] = $sidebar;
				break;
			}
		}
	}

	// sidebar b
	if ( is_mobile() ) {
		$sidebar_b = 'side_b_widget_mobile';
	} else {
		$sidebar_b = 'side_b_widget';
	}

	if ( is_page() || is_singular( 'post' ) ) {
		if ( ! in_array( $display_side_content, array( 'type1', 'type3' ) ) ) {
			$sidebar_b = false;
		}
	}

	if ( $sidebar_b && is_active_sidebar( $sidebar_b ) ) {
		$active_sidebars['sidebar_b'] = $sidebar_b;
	}

	// column layout class
	if ( $active_sidebars['sidebar_a'] && $active_sidebars['sidebar_b'] ) {
		$active_sidebars['column_layout_class'] = 'l-3columns l-layout-' . $dp_options['layout'];
	} elseif ( $active_sidebars['sidebar_a'] ) {
		$active_sidebars['column_layout_class'] = 'l-2columns l-2columns-a l-layout-' . $dp_options['layout'];
	} elseif ( $active_sidebars['sidebar_b'] ) {
		$active_sidebars['column_layout_class'] = 'l-2columns l-2columns-b l-layout-' . $dp_options['layout'];
	}

	return $active_sidebars;
}

/**
 * body class
 */
function rumble_body_classes( $classes ) {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	if ( ! is_no_responsive() ) {
		$classes[] = 'is-responsive';
	}

	if ( $dp_options['header_fix'] == 'type2' ) {
		$classes[] = 'l-header__fix';
	}

	if ( ! is_no_responsive() && $dp_options['mobile_header_fix'] == 'type2' ) {
		$classes[] = 'l-header__fix--mobile';
	}

	return array_unique( $classes );
}
add_filter( 'body_class', 'rumble_body_classes' );

/**
 * Excerpt
 */
function custom_excerpt_length( $length = null ) {
	return 64;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_more( $more = null ) {
	return '...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

/**
 * Remove wpautop from the excerpt
 */
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Customize archive title
 */
function rumble_archive_title( $title ) {
	global $author, $post;
	if ( is_author() ) {
		$title = get_the_author_meta( 'display_name', $author );
	} elseif ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	} elseif ( is_day() ) {
		$title = get_the_time( __( 'F jS, Y', 'tcd-w' ), $post );
	} elseif ( is_month() ) {
		$title = get_the_time( __( 'F, Y', 'tcd-w' ), $post );
	} elseif ( is_year() ) {
		$title = get_the_time( __( 'Y', 'tcd-w' ), $post );
	} elseif ( is_search() ) {
		$title = __( 'Search result', 'tcd-w' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'rumble_archive_title', 10 );

/**
 * ビジュアルエディタに表(テーブル)の機能を追加
 */
function mce_external_plugins_table( $plugins ) {
	$plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
	return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

/**
 * tinymceのtableボタンにclass属性プルダウンメニューを追加
 */
function mce_buttons_table( $buttons ) {
	$buttons[] = 'table';
	return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function table_classes_tinymce( $settings ) {
	$styles = array(
		array( 'title' => __( 'Default style', 'tcd-w' ), 'value' => '' ),
		array( 'title' => __( 'No border', 'tcd-w' ), 'value' => 'table_no_border' ),
		array( 'title' => __( 'Display only horizontal border', 'tcd-w' ), 'value' => 'table_border_horizontal' )
	);
	$settings['table_class_list'] = json_encode( $styles );
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'table_classes_tinymce' );

/**
 * ビジュアルエディタにページ分割ボタンを追加
 */
function add_nextpage_buttons( $buttons ) {
	array_push( $buttons, 'wp_page' );
	return $buttons;
}
add_filter( 'mce_buttons', 'add_nextpage_buttons' );

/**
 * Translate Hex to RGB
 */
function hex2rgb( $hex ) {

	$hex = str_replace( '#', '', $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}

	$rgb = array( $r, $g, $b );

	return $rgb;
}

/**
 * ユーザーエージェントを判定するための関数
 */
function is_mobile() {
	static $is_mobile = null;

	if ( $is_mobile !== null ) {
		return $is_mobile;
	}

	// タブレットも含める場合は wp_is_mobile()
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

	if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
		$is_mobile = false;
	} elseif ( preg_match( '/' . implode( '|', $ua ) . '/i', $_SERVER['HTTP_USER_AGENT'] ) ) {
		$is_mobile = true;
	} else {
		$is_mobile = false;
	}

	return $is_mobile;
}

/**
 * レスポンシブOFF機能を判定するための関数
 */
function is_no_responsive() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();
	return $dp_options['responsive'] == 'no' ? true : false;
}

/**
 * スクリプトのバージョン管理
 */
function version_num() {
	static $theme_version = null;

	if ( $theme_version !== null ) {
		return $theme_version;
	}

	if ( function_exists( 'wp_get_theme' ) ) {
		$theme_data = wp_get_theme();
	} else {
		$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
	}

	if ( isset( $theme_data['Version'] ) ) {
		$theme_version = $theme_data['Version'];
	} else {
		$theme_version = '';
	}

	return $theme_version;
}

/**
 * カードリンクパーツ
 */
function get_the_custom_excerpt( $content, $length ) {
	$length = $length ? $length : 70; // デフォルトの長さを指定する
	$content = preg_replace( '/<!--more-->.+/is', '', $content ); // moreタグ以降削除
	$content = strip_shortcodes( $content ); // ショートコード削除
	$content = strip_tags( $content ); // タグの除去
	$content = str_replace( '&nbsp;', '', $content ); // 特殊文字の削除（今回はスペースのみ）
	$content = mb_substr( $content, 0, $length ); // 文字列を指定した長さで切り取る
	return $content.'...';
}

/**
 * カードリンクショートコード
 */
function clink_scode( $atts ) {
	extract( shortcode_atts( array( 'url' => '', 'title' => '', 'excerpt' => '' ), $atts ) );
	$id = url_to_postid( $url ); // URLから投稿IDを取得
	if ( ! $url || ! $id ) return false;

	$post = get_post( $id ); // IDから投稿情報の取得
	$date = mysql2date( 'Y.m.d', $post->post_date ); // 投稿日の取得
	$img_width = 120; // 画像サイズの幅指定
	$img_height = 120; // 画像サイズの高さ指定
	$no_image = get_template_directory_uri() . '/img/common/no-image-300x300.gif';

	// 抜粋を取得
	if ( empty( $excerpt ) ) {
		if ( $post->post_excerpt ) {
			$excerpt = get_the_custom_excerpt( $post->post_excerpt, 115 );
		} else {
			$excerpt = get_the_custom_excerpt( $post->post_content , 115 );
		}
	}

	// タイトルを取得
	if ( empty( $title ) ) {
		$title = strip_tags( get_the_title( $id ) );
	}

	// アイキャッチ画像を取得
	if ( has_post_thumbnail( $id ) ) {
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'size-card' );
		$img_tag = '<img src="' . $img[0] . '" alt="' . $title . '" width="' . $img[1] . '" height="' . $img[2] . '">';
	} else {
		$img_tag ='<img src="' . $no_image . '" alt="" width="' . $img_width . '" height="' . $img_height . '">';
	}

	$clink = '<div class="cardlink"><a href="' . esc_url( $url ) . '"><div class="cardlink_thumbnail">' . $img_tag . '</div></a><div class="cardlink_content"><span class="cardlink_timestamp">' . esc_html( $date ) . '</span><div class="cardlink_title"><a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a></div><div class="cardlink_excerpt">' . esc_html( $excerpt ) . '</div></div><div class="cardlink_footer"></div></div>';

	return $clink;
}
add_shortcode( 'clink', 'clink_scode' );

/**
 * カスタムコメント
 */
function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if ( ! $commentcount ) {
		$commentcount = 0;
	}
?>
<li id="comment-<?php comment_ID(); ?>" class="c-comment__list-item comment">
	<div class="c-comment__item-header u-clearfix">
		<div class="c-comment__item-meta u-clearfix">
<?php
	if ( function_exists( 'get_avatar' ) && get_option( 'show_avatars' ) ) {
		echo get_avatar( $comment, 35, '', false, array( 'class' => 'c-comment__item-avatar' ) );
	}
	if ( get_comment_author_url() ) {
		echo '<a id="commentauthor-' . get_comment_ID() . '" class="c-comment__item-author" rel="nofollow">' . get_comment_author() . '</a>' . "\n";
	} else {
		echo '<span id="commentauthor-' . get_comment_ID() . '" class="c-comment__item-author">' . get_comment_author() . '</span>' . "\n";
	}
?>
			<time class="c-comment__item-date" datetime="<?php comment_time( 'c' ); ?>"><?php comment_time( __( 'F jS, Y', 'tcd-w' ) ); ?></time>
		</div>
		<ul class="c-comment__item-act">
<?php
	if ( 1 == get_option( 'thread_comments' ) ) :
?>
			<li><?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __( 'REPLY', 'tcd-w' ) . '' ) ) ); ?></li>
<?php
	else :
?>
			<li><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'js-comment__textarea');"><?php _e( 'REPLY', 'tcd-w' ); ?></a></li>
<?php
	endif;
?>
		<li><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'js-comment__textarea');"><?php _e( 'QUOTE', 'tcd-w' ); ?></a></li>
		<?php edit_comment_link( __( 'EDIT', 'tcd-w' ), '<li>', '</li>'); ?>
		</ul>
	</div>
	<div id="comment-content-<?php comment_ID() ?>" class="c-comment__item-body">
<?php
	if ( 0 == $comment->comment_approved ) {
		echo '<span class="c-comment__item-note">' . __( 'Your comment is awaiting moderation.', 'tcd-w' ) . '</span>' . "\n";
	} else {
		comment_text();
	}
?>
	</div>
<?php
}

// Theme options
require get_template_directory() . '/admin/theme-options.php';
require get_template_directory() . '/admin/theme-options-tools.php';

// Contents Builder
require get_template_directory() . '/admin/contents-builder.php';

// Co-Authors Plus
require get_template_directory() . '/functions/co-authors-plus/co-authors-plus.php';

// Simple Local Avatars
require get_template_directory() . '/functions/simple-local-avatars/simple-local-avatars.php';

// Add custom columns
require get_template_directory() . '/functions/admin_column.php';

// Category custom fields
require get_template_directory() . '/functions/category.php';

// Custom CSS
require get_template_directory() . '/functions/custom_css.php';

// Add quicktags to the visual editor
require get_template_directory() . '/functions/custom_editor.php';

// hook wp_head
require get_template_directory() . '/functions/head.php';

// Mega menu
require get_template_directory() . '/functions/megamenu.php';

// Native advertisement
require get_template_directory() . '/functions/native_ad.php';

// OGP
require get_template_directory() . '/functions/ogp.php';

// Recommend post
require get_template_directory() . '/functions/recommend.php';

// Page builder
require get_template_directory() . '/pagebuilder/pagebuilder.php';

// Post custom fields
require get_template_directory() . '/functions/post_cf.php';

// Page custom fields
require get_template_directory() . '/functions/page_cf.php';
require get_template_directory() . '/functions/page_cf2.php';
require get_template_directory() . '/functions/page_ranking_cf.php';
require get_template_directory() . '/functions/page_authors_cf.php';

// Password protected pages
require get_template_directory() . '/functions/password_form.php';

// Show custom fields in quick edit
require get_template_directory() . '/functions/quick_edit.php';

// Meta title and description
require get_template_directory() . '/functions/seo.php';

// Shortcode
require get_template_directory() . '/functions/short_code.php';

// Views
require get_template_directory() . '/functions/views.php';

// User profile
require get_template_directory() . '/functions/user_profile.php';

// Update notifier
require get_template_directory() . '/functions/update_notifier.php';

// Widgets
require get_template_directory() . '/widget/ad.php';
require get_template_directory() . '/widget/archive_list.php';
require get_template_directory() . '/widget/category_list.php';
require get_template_directory() . '/widget/google_search.php';
require get_template_directory() . '/widget/styled_post_list1.php';
require get_template_directory() . '/widget/ranking_list.php';

// 検索結果から固定ページを除外する
function SearchFilter($query) {
	if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
	$query->set( 'post_type', 'post' );
	}
	}
	add_action( 'pre_get_posts','SearchFilter' );


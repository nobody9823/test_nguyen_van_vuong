<?php

/**
 * アクセス数メタボックス追加
 */
function add_views_meta_box() {
	add_meta_box(
		'views',
		__( 'Views', 'tcd-w' ),
		'show_views_meta_box',
		array( 'post', 'page' ),
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'add_views_meta_box' );

/**
 * アクセス数メタボックス表示
 */
function show_views_meta_box() {
	global $post;
?>
<input type="hidden" name="views_meta_box_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>" />
<p>
	<input type="number" name="_views" value="<?php echo intval( get_post_meta( $post->ID, '_views', true ) ); ?>" class="large-text" readonly="readonly" />
	<label><input type="checkbox" name="edit_views" value="1" /><?php _e( 'Edit views', 'tcd-w' ); ?></label>
</p>
<script>
jQuery(function($){
	$(':checkbox[name="edit_views"]').change(function(){
		if (this.checked) {
			$(this).closest('.inside').find('input[name="_views"]').removeAttr('readonly');
		} else {
			$(this).closest('.inside').find('input[name="_views"]').attr('readonly', 'readonly');
		}
	});
});
</script>
<?php
}

/**
 * アクセス数メタボックス保存
 */
function save_views_meta_box( $post_id ) {
	// verify nonce
	if ( ! isset( $_POST['views_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['views_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// save
	if ( ! empty( $_POST['edit_views'] ) && isset( $_POST['_views'] ) ) {
		update_post_meta( $post_id, '_views', intval( $_POST['_views'] ) );
	}

	return $post_id;
}
add_action( 'save_post', 'save_views_meta_box' );

/**
 * クイック編集に項目を追加
 */
function views_quick_edit_custom_box( $column_name, $post_type ) {
	// 1度だけ出力させる
	static $print_nonce = true;
	if ( $print_nonce ) {
		$print_nonce = false;
?>
<input type="hidden" name="views_meta_box_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>" />
<fieldset class="inline-edit-col-right">
	<div class="inline-edit-col column-views">
		<div class="inline-edit-group">
			<label class="inline-edit-views" style="float:left;margin-right:1em;">
				<span class="title"><?php _e( 'Views', 'tcd-w' ); ?></span>
				<span class="input-text-wrap"><input type="number" name="_views" value="" readonly="readonly" style="width:6em;" />
			</label>
			<label class="inline-edit-views" style="padding-top:0.2em;">
				<input type="checkbox" name="edit_views" value="1" /> <?php _e( 'Edit views', 'tcd-w' ); ?>
			</label>
		</div>
	</div>
</fieldset>
<?php
	}
}
add_action( 'quick_edit_custom_box', 'views_quick_edit_custom_box', 20, 2 );

/**
 * クイック編集用でフォームに差し込む値
 * get_inline_dataにはフィルターがないためpost_row_actionsで処理
 * quick_edit.php内の処理より後に実行し、$actions['custom_quick_edit_values']に追記すること
 */
function views_custom_quick_edit_values( $actions, $post ) {
	if ( ! isset( $actions['custom_quick_edit_values'] ) ) {
		$actions['custom_quick_edit_values'] = '';
	}
	$actions['custom_quick_edit_values'] .= '<div class="hidden"><div class="_views">' . esc_html( intval( get_post_meta( $post->ID, '_views', true ) ) ) . '</div></div>';
	return $actions;
}
add_action( 'post_row_actions', 'views_custom_quick_edit_values', 100, 2 );
add_action( 'page_row_actions', 'views_custom_quick_edit_values', 100, 2 );

/**
 * クイック編集用js
 * 別途quick_edit.phpのjs出力が必要
 */
function views_quick_edit_js() {
?>
<script>
jQuery(function($){
	$(':checkbox[name="edit_views"]').change(function(){
		if (this.checked) {
			$(this).closest('.column-views').find('input[name="_views"]').removeAttr('readonly');
		} else {
			$(this).closest('.column-views').find('input[name="_views"]').attr('readonly', 'readonly');
		}
	});
});
</script>
<?php
}
add_action( 'admin_footer-edit.php', 'views_quick_edit_js' );

/**
 * 一覧カラムinit
 */
function views_admin_column_init() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	add_filter( 'manage_post_posts_columns', 'cf_views_posts_columns', 20 );
	add_filter( 'manage_' . $dp_options['news_slug'] . '_posts_columns', 'cf_views_posts_columns', 20 );
	add_filter( 'manage_page_posts_columns', 'cf_views_posts_columns', 20 );
	add_action( 'manage_posts_custom_column', 'cf_views_posts_custom_column', 20, 2 );
	add_action( 'manage_pages_custom_column', 'cf_views_posts_custom_column', 20, 2 );
	add_filter( 'manage_edit-post_sortable_columns', 'cf_views_sortable_columns', 20 );
	add_filter( 'manage_edit-page_sortable_columns', 'cf_views_sortable_columns', 20 );
	add_action( 'parse_query', 'cf_views_sortable_columns_query', 20 );
}
add_action( 'admin_init', 'views_admin_column_init' );

/**
 * 一覧カラム追加
 */
function cf_views_posts_columns( $columns ){
	$columns['views'] = __( 'Views', 'tcd-w' );
	return $columns;
}

/**
 * 一覧カラム表示
 */
function cf_views_posts_custom_column( $column_name, $post_id ){
	if ( 'views' === $column_name ) {
		echo intval( get_post_meta( $post_id, '_views', true ) );
	}
}

/**
 * 一覧ソートカラム
 */
function cf_views_sortable_columns( $sortable_columns ) {
	$sortable_columns['views'] = 'views';
	return $sortable_columns;
}

/**
 * ソートクエリー
 */
function cf_views_sortable_columns_query( $wp_query ) {
	// 管理画面のメインクエリー以外は終了
	if ( ! is_admin() || ! $wp_query->is_main_query() ) return;

	// アクセス数ソート
	if ( isset( $_REQUEST['orderby'] ) && 'views' === $_REQUEST['orderby'] ) {
		$wp_query->set( 'orderby', 'meta_value_num' );
		$wp_query->set( 'meta_key', '_views' );
	}
}

/**
 * キャッシュ系プラグイン対策でajaxでのアクセス数カウントアップ用js出力
 */
function views_wp_footer() {
	if ( is_singular() || is_front_page() || is_home() ) {
		wp_reset_query();
		$queried_object = get_queried_object();
		if ( ! empty( $queried_object->ID ) ) {
?>
<script>
jQuery(function($) {
	jQuery.post('<?php echo admin_url( 'admin-ajax.php' ); ?>',{ action: 'views_count_up', post_id: <?php echo (int) $queried_object->ID; ?>, nonce: '<?php echo wp_create_nonce( 'views_count_up' ); ?>'});
});
</script>
<?php
		}
	}
}
add_action( 'wp_footer', 'views_wp_footer', 20 );

/**
 * ajaxでのアクセス数カウントアップ
 */
function ajax_views_count_up() {
	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) return;

	if ( isset( $_POST['nonce'], $_POST['post_id'] ) && wp_verify_nonce( $_POST['nonce'], 'views_count_up' ) ) {
		$post_id = (int) $_POST['post_id'];
		if ( 0 < $post_id && in_array( get_post_status( $post_id ), array( 'publish', 'private' ) ) ) {
			update_post_meta( $post_id, '_views', intval( get_post_meta( $post_id, '_views', true ) ) + 1 );
			echo 'Done';
		} else {
			echo 'Failure';
		}
		exit();
	}
}
add_action( 'wp_ajax_views_count_up', 'ajax_views_count_up' );
add_action( 'wp_ajax_nopriv_views_count_up', 'ajax_views_count_up' );



// 投稿者の記事の合計ビュー数を取得
function get_author_views( $user_id ) {
	global $wpdb;

	$user_id = (int) $user_id;
	if ( 0 >= $user_id ) return 0;
	$user = get_user_by( 'id', $user_id );
	if ( ! $user ) return 0;

	// 記事ID配列取得
	$sql = "SELECT DISTINCT tr.object_id FROM $wpdb->terms AS t
		INNER JOIN $wpdb->term_taxonomy AS tt ON tt.term_id = t.term_id
		INNER JOIN $wpdb->term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
		WHERE tt.taxonomy = 'author' AND t.slug = %s
		ORDER BY tr.object_id ASC";
	$arr_post_ids = $wpdb->get_col( $wpdb->prepare( $sql, 'cap-' . $user->user_nicename ), 0, ARRAY_A );
	if ( ! $arr_post_ids ) return 0;

	// 記事IDで絞り込み記事ビュー数_viewの合計値を取得
	$str_post_ids = implode( ',', $arr_post_ids );
	$sql = "SELECT SUM(pm.meta_value+0) FROM $wpdb->posts AS p
		INNER JOIN $wpdb->postmeta AS pm ON pm.post_id = p.ID
		WHERE p.post_type = 'post' AND p.post_status = 'publish'
		AND (p.post_author = $user_id OR p.ID IN ($str_post_ids))
		AND pm.meta_key = '_views'";
	$author_views = $wpdb->get_var( $sql );

	return (int) $author_views;
}

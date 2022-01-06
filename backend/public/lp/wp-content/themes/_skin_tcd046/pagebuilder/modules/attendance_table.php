<?php

/**
 * ページビルダーウィジェット登録
 */
add_page_builder_widget(array(
	'id' => 'pb-widget-attendance_table',
	'form' => 'form_page_builder_widget_attendance_table',
	'form_rightbar' => 'form_rightbar_page_builder_widget_attendance_table',
	'save' => 'save_page_builder_repeater',
	'display' => 'display_page_builder_widget_attendance_table',
    'title' => __('Attendance_table', 'tcd-w'),
	'description' => '',
	'additional_class' => 'pb-repeater-widget',
	'priority' => 53
));

/**
 * フォーム
 */
function form_page_builder_widget_attendance_table($values = array()) {
	// 最大カラム数
	$max_column_num = 10;

	// デフォルト値
	$default_values = array(
		'widget_index' => '',
		'headline' => '',
		'mark_checked' => __('○', 'tcd-w'),
		'mark_unchecked' => __('×', 'tcd-w'),
		'column_num' => 7,
		'repeater' => array()
	);

	// 曜日
	$weekdays = array(
		__('SUN', 'tcd-w'),
		__('MON', 'tcd-w'),
		__('TUE', 'tcd-w'),
		__('WED', 'tcd-w'),
		__('THU', 'tcd-w'),
		__('FRI', 'tcd-w'),
		__('SAT', 'tcd-w'),
	);

	for($i = 1; $i <= $max_column_num; $i++) {
		if ($i < 7) {
			$default_values['column_headline'.$i] = $weekdays[$i];
		} elseif ($i == 7) {
			$default_values['column_headline'.$i] = $weekdays[0];
		} else {
			$default_values['column_headline'.$i] = __('Column', 'tcd-w').$i;
		}
		$default_values['column_headline_color'.$i] = '#666666';
		$default_values['column_headline_bg'.$i] = '#FFFFFF';
	}

	$default_values = apply_filters('page_builder_widget_attendance_table_default_values', $default_values, 'form');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);

	if (isset($values['column_num'])) {
		$values['column_num'] = (int) $values['column_num'];
	}

	if (empty($values['column_num']) || $values['column_num'] < 1 || $values['column_num'] > $max_column_num) {
		if (isset($default_values['column_num']) && is_numeric($default_values['column_num'])) {
			$values['column_num'] = (int) $default_values['column_num'];
		} else {
			$values['column_num'] = 3;
		}
	}
?>

<div class="form-field">
	<h4><?php _e('Title', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" />
</div>
<div class="form-field">
    <h4><?php _e('Number of comparison columns', 'tcd-w'); ?></h4>
	<select name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][column_num]" class="column_num">
<?php
	for($i = 1; $i <= $max_column_num; $i++) {
		if ($i === $values['column_num']) {
			$selected = ' selected="selected"';
		} else {
			$selected = '';
		}
		echo '		<option value="'.esc_attr($i).'"'.$selected.'>'.esc_html($i).'</option>'."\n";
	}
?>
	 </select>
</div>
<?php
	for($i = 1; $i <= $max_column_num; $i++) {
		if ($i <= $values['column_num']) {
			$style = '';
		} else {
			$style = ' style="display:none;"';
		}
?>
<div class="form-field column-filter" data-column="<?php echo esc_attr($i); ?>"<?php echo $style; ?>>
	<h4><?php _e('列', 'tcd-w'); echo ' '.esc_html($i).' '; _e('Headline', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][column_headline<?php echo esc_attr($i); ?>]" value="<?php echo esc_attr($values['column_headline'.$i]); ?>" class="column_headline" />
	<table style="margin-top:5px;">
		<tr>
			<td><?php _e('Font color', 'tcd-w'); ?></td>
			<td>
				<input type="text" id="pb_attendance_table-<?php echo esc_attr($values['widget_index']); ?>-column_headline_color<?php echo esc_attr($i); ?>" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][column_headline_color<?php echo esc_attr($i); ?>]" value="<?php echo esc_attr($values['column_headline_color'.$i]); ?>" class="pb-input-narrow pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_values['column_headline_color'.$i]); ?>" />
			</td>
		</tr>
		<tr>
			<td><?php _e('Background color', 'tcd-w'); ?></td>
			<td>
				<input type="text" id="pb_attendance_table-<?php echo esc_attr($values['widget_index']); ?>-column_headline_bg<?php echo esc_attr($i); ?>" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][column_headline_bg<?php echo esc_attr($i); ?>]" value="<?php echo esc_attr($values['column_headline_bg'.$i]); ?>" class="pb-input-narrow pb-wp-color-picker" data-default-color="<?php echo esc_attr($default_values['column_headline_bg'.$i]); ?>" />
			</td>
		</tr>
	</table>
</div>
<?php
	}
?>
<div class="form-field">
    <h4><?php _e('Display mark at check (ex.○)', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][mark_checked]" value="<?php echo esc_attr($values['mark_checked']); ?>" />
</div>
<div class="form-field">
    <h4><?php _e('Display mark when unchecked (ex.×)', 'tcd-w'); ?></h4>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][mark_unchecked]" value="<?php echo esc_attr($values['mark_unchecked']); ?>" />
</div>

<?php
	// リピーター行の並び
	$repeater_indexes = array();
	if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
		$repeater_indexes = $values['repeater_index'];

		// リピーター行データが無ければ削除
		foreach($repeater_indexes as $key => $repeater_index) {
			if (empty($values['repeater'][$repeater_index])) {
				unset($repeater_indexes[$key]);
			}
		}
	} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
		$repeater_indexes = array_keys($values['repeater']);
	}

	// リピーター行 最大インデックス
	$repeater_index_max = 0;
	if ($repeater_indexes) {
		$repeater_indexes = array_map('intval', $repeater_indexes);
		$repeater_index_max = max($repeater_indexes);
	}

	echo '<div class="pb_repeater_wrap" data-rows="'.$repeater_index_max.'">'."\n";
	echo '	<div class="pb_repeater_sortable">'."\n";

	// リピーター行あり
	if ($repeater_indexes) {
		// リピーター行ループ
		foreach($repeater_indexes as $repeater_index) {
			// リピーター行データあり
			if (!empty($values['repeater'][$repeater_index])) {
				$values['repeater_index'] = $repeater_index;
				// リピーター行出力
				form_page_builder_widget_attendance_table_repeater_row(
					$values,
					$values['repeater'][$repeater_index]
				);
			}
		}
	}

	echo '	</div>'."\n"; // .pb_repeater_sortable

	// 項目の追加ボタン
	echo '<div class="form-field">';
	echo '<a href="#" class="pb_add_repeater button-primary">'.__('Add item', 'tcd-w').'</a>';
	echo '</div>'."\n";

	// 追加ボタン時に差し込むHTML
	echo '<div class="add_pb_repeater_clone hidden" style="display:none">'."\n";

	// 行出力
	$values['repeater_index'] = 'pb_repeater_add_index';
	form_page_builder_widget_attendance_table_repeater_row(
		$values,
		array(
			'repeater_label' => __('New item', 'tcd-w')
		)
	);

	echo '</div>'."\n"; // .add_pb_repeater_clone

	echo '</div>'."\n"; // .pb_repeater_wrap
}

/**
 * リピーター行出力
 */
function form_page_builder_widget_attendance_table_repeater_row($values = array(), $row_values = array()) {
	// 最大カラム数
	$max_column_num = 10;

	// デフォルト値に入力値をマージ
	$values = array_merge(
		array(
			'widget_index' => '',
			'repeater_index' => ''
		),
		(array) $values
	);

	// 行デフォルト値
	$default_row_values = array(
		'repeater_label' => '',
		'day' => '',
	);

	for($i = 1; $i <= $max_column_num; $i++) {
		$default_row_values['column_check'.$i] = '';
		$default_row_values['column_note'.$i] = '';
	}

	$default_row_values = apply_filters('page_builder_widget_attendance_table_default_row_values', $default_row_values);

	// 行デフォルト値に行の値をマージ
	$row_values = array_merge(
		$default_row_values,
		(array) $row_values
	);

	// リピーター表示名
	if (!$row_values['repeater_label'] && $row_values['day']) {
		$row_values['repeater_label'] = $row_values['day'];
	} elseif (!$row_values['repeater_label']) {
		$row_values['repeater_label'] = __('New item', 'tcd-w');
	}
?>

<div id="pb_attendance_table-<?php echo esc_attr($values['widget_index'].'-'.$values['repeater_index']); ?>" class="pb_repeater pb_repeater-<?php echo esc_attr($values['repeater_index']); ?>">
	<input type="hidden" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater_index][]" value="<?php echo esc_attr($values['repeater_index']); ?>" />
	<ul class="pb_repeater_button pb_repeater_cf">
		<li><span class="pb_repeater_move"><?php _e('Move', 'tcd-w'); ?></span></li>
		<li><span class="pb_repeater_delete" data-confirm="<?php _e('Are you sure you want to delete this item?', 'tcd-w'); ?>"><?php _e('Delete', 'tcd-w'); ?></span></li>
	</ul>
	<div class="pb_repeater_content">
		<h3 class="pb_repeater_headline"><span class="index_label"><?php echo esc_attr($row_values['repeater_label']); ?></span><a href="#"><?php _e('Open', 'tcd-w'); ?></a></h3>
		<div class="pb_repeater_field">
			<div class="form-field">
				<h4><?php _e('Item name', 'tcd-w'); ?></h4>
				<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][day]" value="<?php echo esc_attr($row_values['day']); ?>" class="index_label" />
			</div>
			<div class="form-field">
                <h4><?php _e('Attendance setting', 'tcd-w'); ?></h4>
				<table class="pb_attendance_table">
					<thead>
						<tr>
                            <th><?php _e('Column name', 'tcd-w'); ?></th>
							<th class="check-column"><?php _e('チェック', 'tcd-w'); ?></th>
							<th><?php _e('NB', 'tcd-w'); ?></th>
						</tr>
<?php
	for($i = 1; $i <= $max_column_num; $i++) {
		if ($i <= $values['column_num']) {
			$style = '';
		} else {
			$style = ' style="display:none;"';
		}

?>
					<tbody>
						<tr class="column-filter" data-column="<?php echo esc_attr($i); ?>"<?php echo $style; ?>>
							<td class="column_headline-<?php echo esc_attr($i); ?>"><?php echo esc_html($values['column_headline'.$i]); ?></td>
							<td class="check-column">
								<input type="hidden" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][column_check<?php echo esc_attr($i); ?>]" value="" />
								<label><input type="checkbox" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][column_check<?php echo esc_attr($i); ?>]" value="1"<?php if ($row_values['column_check'.$i]) echo ' checked="checked"'; ?> /></label>
							</td>
							<td><input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][repeater][<?php echo esc_attr($values['repeater_index']); ?>][column_note<?php echo esc_attr($i); ?>]" value="<?php echo esc_attr($row_values['column_note'.$i]); ?>" /></td>
						</tr>
<?php
	}
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
}

/**
 * フォーム 右サイドバー
 */
function form_rightbar_page_builder_widget_attendance_table($values = array()) {
	// デフォルト値
	$default_values = apply_filters('page_builder_widget_attendance_table_default_values', array(
		'widget_index' => '',
		'margin_bottom' => 30,
		'margin_bottom_mobile' => 30
	), 'form_rightbar');

	// デフォルト値に入力値をマージ
	$values = array_merge($default_values, (array) $values);
?>

<h3><?php _e('Margin setting', 'tcd-w'); ?></h3>
<div class="form-field">
	<label><?php _e('Margin bottom', 'tcd-w'); ?></label>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][margin_bottom]" value="<?php echo esc_attr($values['margin_bottom']); ?>" class="pb-input-narrow hankaku" /> px
	<p class="pb-description"><?php esc_html_e('Space below the content.<br />Default is 30px.', 'tcd-w'); ?></p>
</div>
<div class="form-field">
	<label><?php _e('Margin bottom for mobile', 'tcd-w'); ?></label>
	<input type="text" name="pagebuilder[widget][<?php echo esc_attr($values['widget_index']); ?>][margin_bottom_mobile]" value="<?php echo esc_attr($values['margin_bottom_mobile']); ?>" class="pb-input-narrow hankaku" /> px
	<p class="pb-description"><?php esc_html_e('Space below the content.<br />Default is 30px.', 'tcd-w'); ?></p>
</div>

<?php
}

/**
 * フロント出力
 */
function display_page_builder_widget_attendance_table($values = array(), $widget_index = null) {
	// 最大カラム数
	$max_column_num = 10;

	// リピーター行の並び
	if (!empty($values['repeater_index']) && is_array($values['repeater_index'])) {
		$repeater_indexes = $values['repeater_index'];

		// リピーター行ループし、行データが無ければ削除
		foreach($repeater_indexes as $key => $repeater_index) {
			if (empty($values['repeater'][$repeater_index])) {
				unset($repeater_indexes[$key]);
			}
		}
	} elseif (!empty($values['repeater']) && is_array($values['repeater'])) {
		$repeater_indexes = array_keys($values['repeater']);
	}

	// リピーター行がなければ終了
	if (empty($repeater_indexes)) return;

	// スタイル変数
	$str_style = array();
	$arr_style = array(
		'title' => array()
	);

	//テーマオプション カラー反映
	if (function_exists('get_desing_plus_option')) {
		$options = get_desing_plus_option();

		$title_bg_theme_option_key = apply_filters('page_builder_attendance_table_title_bg_theme_option_key', 'pickedcolor1');
		if (!empty($options[$title_bg_theme_option_key])) {
			$arr_style['title']['color'] = '#FFFFFF';
			$arr_style['title']['background'] = '#'.$options[$title_bg_theme_option_key];
		}
	}

	// スタイル配列からスタイル文字列生成
	foreach(array_keys($arr_style) as $style_key) {
		// スタイル配列フィルター
		$arr_style[$style_key] = apply_filters('page_builder_attendance_table_style_array_'.$style_key, $arr_style[$style_key]);

		if ($arr_style[$style_key] && is_array($arr_style[$style_key])) {
			foreach($arr_style[$style_key] as $key => $value) {
				// スタイルフィルター
				$value = apply_filters('page_builder_attendance_table_style_'.$style_key.'_'.$key, $value);
				if (!$value || (!is_string($value) && !is_numeric($value))) continue;

				$value = trim($value);
				if (!is_numeric($key) && $value) {
					if (!empty($str_style[$style_key])) {
						$str_style[$style_key] .= ' '.$key.':'.$value.';';
					} else {
						$str_style[$style_key] = $key.':'.$value.';';
					}
				}
			}
		}
	}

	if (!empty($values['headline'])) {
?>
<h3 class="pb_attendance_table_title"<?php if (!empty($str_style['title'])) echo ' style="'.esc_attr($str_style['title']).'"'; ?>><?php echo esc_html($values['headline']); ?></h3>
<?php
	}
?>
<table class="pb_attendance_table">
  <thead>
    <tr>
      <th class="empty">&nbsp;</th>
<?php
	for($i = 1; $i <= $max_column_num; $i++) {
		if ($i > $values['column_num']) {
			break;
		}
?>
      <th style="color:<?php echo esc_attr($values['column_headline_color'.$i]); ?>; background-color:<?php echo esc_attr($values['column_headline_bg'.$i]); ?>;"><?php echo esc_html($values['column_headline'.$i]); ?></th>
<?php
	}
?>
    </tr>
  </thead>
  <tbody>
<?php
	foreach($repeater_indexes as $repeater_index) {
		$repeater_values = $values['repeater'][$repeater_index];
?>
    <tr>
      <th><?php echo esc_html($repeater_values['day']); ?></th>
<?php
		for($i = 1; $i <= $max_column_num; $i++) {
			if ($i > $values['column_num']) {
				break;
			}

			if (!empty($repeater_values['column_check'.$i])) {
				$td = esc_html($values['mark_checked']);
			} else {
				$td = esc_html($values['mark_unchecked']);
			}

			if ($repeater_values['column_note'.$i]) {
				$td .= ' <small>'.esc_html($repeater_values['column_note'.$i]).'</small>';
			}
?>
      <td><?php echo $td;; ?></td>
<?php
		}
?>
    </tr>
<?php
	}
?>
  </tbody>
</table>
<?php
}

/**
 * 管理画面用js・css
 */
function page_builder_attendance_table_admin_scripts() {
	wp_enqueue_script('page_builder-attendance_table', get_template_directory_uri().'/pagebuilder/assets/admin/js/attendance_table.js', array('jquery'), PAGE_BUILDER_VERSION, true);
}
add_action('page_builder_admin_styles', 'page_builder_attendance_table_admin_scripts', 12);

function page_builder_attendance_table_admin_styles() {
	wp_enqueue_style('page_builder-attendance_table', get_template_directory_uri().'/pagebuilder/assets/admin/css/attendance_table.css', false, PAGE_BUILDER_VERSION);
}
add_action('page_builder_admin_styles', 'page_builder_attendance_table_admin_styles', 12);

/**
 * フロント用css
 */
function page_builder_widget_attendance_table_styles() {
	wp_enqueue_style('page_builder-attendance_table', get_template_directory_uri().'/pagebuilder/assets/css/attendance_table.css', false, PAGE_BUILDER_VERSION);
}

function page_builder_widget_attendance_table_sctipts_styles($arg = null) {
	// wpフック時には第1引数にWPクラスが渡るので注意
	if ($arg === true || (is_singular() && is_page_builder() && page_builder_has_widget('pb-widget-attendance_table'))) {
		add_action('wp_enqueue_scripts', 'page_builder_widget_attendance_table_styles', 11);
	}
}
add_action('wp', 'page_builder_widget_attendance_table_sctipts_styles');

/**
 * 記事ID指定で任意の箇所に機能比較表を表示する関数
 *
 * @param int $post_id    Optional. 記事ID 未指定の場合は現在の記事
 * @param int $widget_num Optional. 左上から数えて何番目の機能比較表を表示するか
 */
function the_page_builder_attendance_table($post_id = null, $widget_num = 1) {
	$widget_num = (int) $widget_num;
	if ($widget_num < 1) return;

	// 該当記事で使用している機能比較表を左上から数えた順の配列取得
	$post_widgets = get_page_builder_post_widgets($post_id, 'pb-widget-attendance_table');

	if ($post_widgets) {
		$cnt = 0;
		foreach($post_widgets as $post_widget) {
			// 順番が一致すれば出力
			if (++$cnt === $widget_num) {
				if (isset($post_widget['widget_value'], $post_widget['widget_index'])) {
					display_page_builder_widget_attendance_table($post_widget['widget_value'], $post_widget['widget_index']);
				}
				break;
			}
		}
	}
}


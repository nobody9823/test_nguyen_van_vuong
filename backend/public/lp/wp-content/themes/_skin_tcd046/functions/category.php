<?php


// カテゴリー追加用入力欄を出力 -------------------------------------------------------
add_action ( 'category_add_form_fields', 'category_add_extra_category_fields');
function category_add_extra_category_fields() {
	$options = get_desing_plus_option();
	if (!empty($options['pickedcolor1'])) {
		$default_category_color = $options['pickedcolor1'];
	} else {
		$default_category_color = 'E3D0C3';
	}
?>
<div class="form-field category_color-wrap">
  <label for="category_color"><?php _e("Category color", "tcd-w"); ?></label>
  <input type="text" id="category_color" class="color" name="term_meta[category_color]" value="<?php echo esc_attr($default_category_color); ?>" style="width:6em;" />
  <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('category_color').color.fromString('<?php echo esc_attr($default_category_color); ?>')">
</div>
<?php
}


// カテゴリー編集用入力欄を出力 -------------------------------------------------------
add_action ( 'category_edit_form_fields', 'category_edit_extra_category_fields');
function category_edit_extra_category_fields( $tag ) {
	$t_id = $tag->term_id;
	$term_meta = get_option("taxonomy_{$t_id}", array());
	if (!empty($options['pickedcolor1'])) {
		$default_category_color = $options['pickedcolor1'];
	} else {
		$default_category_color = 'E3D0C3';
	}
?>
<tr class="form-field">
  <th><label for="category_color"><?php _e("Category color", "tcd-w"); ?></label></th>
  <td>
    <input type="text" id="category_color" class="color" name="term_meta[category_color]" value="<?php if (isset($term_meta['category_color'])) { echo esc_attr($term_meta['category_color']); } else { echo esc_attr($default_category_color); } ?>" style="width:6em;" />
    <input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="<?php _e('Default color', 'tcd-w');  ?>" onClick="document.getElementById('category_color').color.fromString('<?php echo esc_attr($default_category_color); ?>')">
  </td>
</tr>
<?php
}


// コースカテゴリー追加用入力欄を出力 -------------------------------------------------------
add_action ( 'course_category_add_form_fields', 'course_category_add_extra_category_fields');
function course_category_add_extra_category_fields() {
?>
<div class="form-field category_copy-wrap">
  <label for="category_copy"><?php _e("Category copy", "tcd-w"); ?></label>
  <input type="text" id="category_copy" name="term_meta[name2]" value="" />
  <p class="description"><?php _e("It is displayed next to the category name on the course archive page.", "tcd-w"); ?></p>
</div>
<?php
}


// コースカテゴリー編集用入力欄を出力 -------------------------------------------------------
add_action ( 'course_category_edit_form_fields', 'course_category_edit_extra_category_fields');
function course_category_edit_extra_category_fields( $tag ) {
	$t_id = $tag->term_id;
	$term_meta = get_option("taxonomy_{$t_id}", array());
?>
<tr class="form-field">
 <th><label for="category_name2"><?php _e("Category copy", "tcd-w"); ?></label></th>
 <td>
  <input type="text" id="category_name2" name="term_meta[name2]" value="<?php if (isset($term_meta['name2'])) echo esc_attr($term_meta['name2']); ?>" />
  <p class="description"><?php _e("It is displayed next to the category name on the course archive page.", "tcd-w"); ?></p>
 </td>
</tr>
<?php
}


// データを保存 -------------------------------------------------------
add_action ( 'created_course_category', 'category_save_extra_category_fileds');
add_action ( 'edited_course_category', 'category_save_extra_category_fileds');
add_action ( 'created_category', 'category_save_extra_category_fileds');
add_action ( 'edited_category', 'category_save_extra_category_fileds');
function category_save_extra_category_fileds( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$term_meta = get_option( "taxonomy_{$term_id}", array() );
		$cat_keys = array_keys($_POST['term_meta']);
		foreach ($cat_keys as $key){
			if (isset($_POST['term_meta'][$key])){
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		update_option( "taxonomy_{$term_id}", $term_meta );
	}
}



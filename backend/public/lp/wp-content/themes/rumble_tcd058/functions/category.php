<?php

// カテゴリー追加用入力欄を出力 -------------------------------------------------------
function category_add_extra_category_fields() {
?>
<div class="form-field category-color-wrap">
	<label for="category-color"><?php _e( 'Category color', 'tcd-w' ); ?></label>
	<input type="text" id="category-color" name="term_meta[color]" value="#999999" data-default-color="#999999" class="c-color-picker">
</div>
<div class="form-field category-image_megamenu-wrap">
	<label for="category-image_megamenu"><?php _e( 'Category image for Mega menu A', 'tcd-w' ); ?></label>
	<p class="description"><?php _e( 'Recommend image size. Width:195px, Height:137px', 'tcd-w' ); ?></p>
	<div class="image_box cf">
		<div class="cf cf_media_field hide-if-no-js">
			<input type="hidden" value="" id="category-image_megamenu" name="term_meta[image_megamenu]" class="cf_media_id">
			<div class="preview_field"></div>
			<div class="button_area">
				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
			</div>
		</div>
	</div>
</div>
<div class="category-desc_font_size-wrap" style="margin: 1em 0;">
	<label><?php _e( 'Font size of category description', 'tcd-w' ); ?></label>
	<input type="number" class="small-text" name="term_meta[desc_font_size]" value="16" min="1">
</div>
<div class="category-desc_font_size_mobile-wrap" style="margin: 1em 0;">
	<label><?php _e( 'Font size of category description for mobile', 'tcd-w' ); ?></label>
	<input type="number" class="small-text" name="term_meta[desc_font_size_mobile]" value="14" min="1">
</div>
<div class="form-field category-archive_large-wrap">
	<label><?php _e( 'Display setting', 'tcd-w' ); ?></label>
	<label><input id="archive_large" name="dp_options[archive_large]" type="checkbox" value="1"> <?php _e( 'Display the first two articles larger', 'tcd-w' ); ?></label>
</div>
<?php
}
add_action( 'category_add_form_fields', 'category_add_extra_category_fields' );

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function category_edit_extra_category_fields( $term ) {
	global $archive_slider_options, $archive_slider_list_type_options, $post_order_options;

	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'color' => '#999999',
		'image_megamenu' => null,
		'desc_font_size' => 16,
		'desc_font_size_mobile' => 14,
		'archive_large' => '',
		'archive_slider' => '',
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
		'archive_slider_native_ad_position' => 3
	), $term_meta );
?>
<tr class="form-field">
	<th><label for="category_color"><?php _e( 'Category color', 'tcd-w' ); ?></label></th>
	<td><input type="text" id="category_color" name="term_meta[color]" value="<?php echo esc_attr( $term_meta['color'] ); ?>" data-default-color="#999999" class="c-color-picker"></td>
</tr>
<tr class="form-field">
	<th><label for="category-image_megamenu"><?php _e( 'Category image for Mega menu A', 'tcd-w' ); ?></label></th>
	<td>
	<p class="description"><?php _e( 'Recommend image size. Width:195px, Height:137px', 'tcd-w' ); ?></p>
		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js">
				<input type="hidden" value="<?php if ( $term_meta['image_megamenu'] ) echo esc_attr( $term_meta['image_megamenu'] ); ?>" id="category_image_megamenu" name="term_meta[image_megamenu]" class="cf_media_id">
				<div class="preview_field"><?php if ( $term_meta['image_megamenu'] ) echo wp_get_attachment_image( $term_meta['image_megamenu'], 'medium'); ?></div>
				<div class="button_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['image_megamenu'] ) echo 'hidden'; ?>">
				</div>
			</div>
		</div>
	</td>
</tr>
<tr>
	<th><?php _e( 'Font size of category description', 'tcd-w' ); ?></th>
	<td><input type="number" class="small-text" name="term_meta[desc_font_size]" value="<?php echo esc_attr( $term_meta['desc_font_size'] ); ?>" min="1"></td>
</tr>
<tr>
	<th><?php _e( 'Font size of category description for mobile', 'tcd-w' ); ?></th>
	<td><input type="number" class="small-text" name="term_meta[desc_font_size_mobile]" value="<?php echo esc_attr( $term_meta['desc_font_size_mobile'] ); ?>" min="1"></td>
</tr>
<tr class="form-field">
	<th><?php _e( 'Display setting', 'tcd-w' ); ?></th>
	<td>
		<input name="term_meta[archive_large]" type="hidden" value="">
		<label><input name="term_meta[archive_large]" type="checkbox" value="1" <?php checked( 1, $term_meta['archive_large'] ); ?>> <?php _e( 'Display the first two articles larger', 'tcd-w' ); ?></label>
	</td>
</tr>
<tr class="form-field">
	<th><label for="archive_slider"><?php _e( 'Slider type', 'tcd-w' ); ?></label></th>
	<td>
		<ul id="js-archive_slider">
			<li><label><input type="radio" name="term_meta[archive_slider]" value="" <?php checked( $term_meta['archive_slider'], '' ); ?>><?php _e( 'Use theme option setting.', 'tcd-w' ); ?></label></li>
<?php
	foreach ( $archive_slider_options as $option ) :
?>
			<li><label><input type="radio" name="term_meta[archive_slider]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $term_meta['archive_slider'], $option['value'] ); ?>><?php echo $option['label']; ?></label>
<?php
	endforeach;
?>
		</ul>
	</td>
</tr>
<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
<tr class="form-field archive_slider-type1 hidden">
	<th><?php _e( 'Image', 'tcd-w' ); echo $i; ?></th>
	<td>
		<p class="description"><?php _e( 'Recommend image size. Width:640px, Height:450px', 'tcd-w' ); ?></p>
		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js">
				<input type="hidden" value="<?php if ( $term_meta['archive_slider_image' . $i] ) echo esc_attr( $term_meta['archive_slider_image' . $i] ); ?>" id="archive_slider_image<?php echo $i; ?>" name="term_meta[archive_slider_image<?php echo $i; ?>]" class="cf_media_id">
				<div class="preview_field"><?php if ( $term_meta['archive_slider_image' . $i] ) echo wp_get_attachment_image( $term_meta['archive_slider_image' . $i], 'medium'); ?></div>
				<div class="button_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['archive_slider_image' . $i] ) echo 'hidden'; ?>">
				</div>
			</div>
		</div>
		<div><strong><label><?php _e( 'Catchphrase', 'tcd-w' ); echo $i; ?></label></strong></div>
		<p><input type="text" class="large-text" name="term_meta[archive_slider_headline<?php echo $i; ?>]" value="<?php echo esc_attr( $term_meta['archive_slider_headline' . $i] ); ?>"></p>
		<div><strong><label><?php _e( 'Link URL', 'tcd-w' ); echo $i; ?></label></strong></div>
		<p><input type="text" class="large-text" name="term_meta[archive_slider_url<?php echo $i; ?>]" value="<?php echo esc_attr( $term_meta['archive_slider_url' . $i] ); ?>"></p>
		<p><label><input name="term_meta[archive_slider_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( 1, $term_meta['archive_slider_target' . $i] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
	</td>
</tr>
<?php endfor; ?>
<tr class="form-field archive_slider-type2 hidden">
	<th><label for="type2_num"><?php _e( 'Type of posts to slider', 'tcd-w' ); ?></label></th>
	<td>
		<ul id="js-archive_slider_list_type">
<?php
	foreach ( $archive_slider_list_type_options as $option ) :
?>
			<li><label><input type="radio" name="term_meta[archive_slider_list_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $term_meta['archive_slider_list_type'], $option['value'] ); ?>><?php echo $option['label']; ?></label>
<?php
		if ( 'type2' == $option['value'] ) :
			echo '&nbsp;&nbsp;';
			wp_dropdown_categories( array(
				'class' => '',
				'echo' => 1,
				'hide_empty' => 0,
				'hierarchical' => 1,
				'id' => 'archive_slider_category',
				'name' => 'term_meta[archive_slider_category]',
				'selected' => $term_meta['archive_slider_category'],
				'show_count' => 0,
				'value_field' => 'term_id'
			) );
		elseif ( 'type6' == $option['value'] ) :
?>
				<p><input type="text" class="regular-text" name="term_meta[archive_slider_post_ids]" value="<?php echo esc_attr( $term_meta['archive_slider_post_ids'] ); ?>"><br>
				<span class="description"><?php _e( 'Enter a comma-seperated list of post ID numbers, example 2,4,10', 'tcd-w' ); ?></span></p>

<?php
		endif;
?>
			</li>
<?php
	endforeach;
?>
		</fieldset>
	</td>
</tr>
<tr class="archive_slider-type2 hide-archive_slider_list_type-type6 hidden">
	<th><label for="type2_num"><?php _e( 'Number of posts to slider', 'tcd-w' ); ?></label></th>
	<td>
		<input type="number" class="small-text" name="term_meta[archive_slider_num]" value="<?php echo esc_attr( $term_meta['archive_slider_num'] ); ?>" min="1" max="5">
	</td>
</tr>
<tr class="form-field archive_slider-type2 hide-archive_slider_list_type-type6 hidden">
	<th><label for="type2_num"><?php _e( 'Post order to slider', 'tcd-w' ); ?></label></th>
	<td>
		<select name="term_meta[archive_slider_order]">
			<?php foreach ( $post_order_options as $option ) : ?>
			<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $term_meta['archive_slider_order'] ); ?>><?php echo $option['label']; ?></option>
			<?php endforeach; ?>
		</select>
	</td>
</tr>
<tr class="form-field archive_slider-type2 hidden">
	<th><?php _e( 'Slider display setting to slider', 'tcd-w' ); ?></th>
	<td>
		<ul>
			<li>
				<input name="term_meta[show_archive_slider_category]" type="hidden" value="">
				<label><input name="term_meta[show_archive_slider_category]" type="checkbox" value="1" <?php checked( 1, $term_meta['show_archive_slider_category'] ); ?>> <?php _e( 'Display category for archive slider', 'tcd-w' ); ?></label>
			</li>
			<li>
				<input name="term_meta[show_archive_slider_author]" type="hidden" value="">
				<label><input name="term_meta[show_archive_slider_author]" type="checkbox" value="1" <?php checked( 1, $term_meta['show_archive_slider_author'] ); ?>> <?php _e( 'Display author for archive slider', 'tcd-w' ); ?></label>
			</li>
			<li>
				<input name="term_meta[show_archive_slider_date]" type="hidden" value="">
				<label><input name="term_meta[show_archive_slider_date]" type="checkbox" value="1" <?php checked( 1, $term_meta['show_archive_slider_date'] ); ?>> <?php _e( 'Display date for archive slider', 'tcd-w' ); ?></label>
			</li>
			<li>
				<input name="term_meta[show_archive_slider_views]" type="hidden" value="">
				<label><input name="term_meta[show_archive_slider_views]" type="checkbox" value="1" <?php checked( 1, $term_meta['show_archive_slider_views'] ); ?>> <?php _e( 'Display views for archive slider', 'tcd-w' ); ?></label>
			</li>
		</ul>
	</td>
</tr>
<tr class="form-field archive_slider-type2 hidden">
	<th><?php _e( 'Native advertisement setting to slider', 'tcd-w' ); ?></th>
	<td>
		<input name="term_meta[show_archive_slider_native_ad]" type="hidden" value="">
		<label><input name="term_meta[show_archive_slider_native_ad]" type="checkbox" value="1" <?php checked( 1, $term_meta['show_archive_slider_native_ad'] ); ?>> <?php _e( 'Display native advertisement', 'tcd-w' ); ?></label>
	</td>
</tr>
<tr class="archive_slider-type2 hidden">
	<th><label for="type2_num"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></label></th>
	<td>
		<input type="number" class="small-text" name="term_meta[archive_slider_native_ad_position]" value="<?php echo esc_attr( $term_meta['archive_slider_native_ad_position'] ); ?>" min="1">
	</td>
</tr>
<?php
}
add_action( 'category_edit_form_fields', 'category_edit_extra_category_fields' );

// データを保存 -------------------------------------------------------
function category_save_extra_category_fileds( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$term_meta = get_option( "taxonomy_{$term_id}", array() );
		$meta_keys = array(
			'color',
			'image_megamenu',
			'desc_font_size',
			'desc_font_size_mobile',
			'archive_large',
			'archive_slider',
			'archive_slider_image1',
			'archive_slider_headline1',
			'archive_slider_url1',
			'archive_slider_target1',
			'archive_slider_image2',
			'archive_slider_headline2',
			'archive_slider_url2',
			'archive_slider_target2',
			'archive_slider_image3',
			'archive_slider_headline3',
			'archive_slider_url3',
			'archive_slider_target3',
			'archive_slider_image4',
			'archive_slider_headline4',
			'archive_slider_url4',
			'archive_slider_target4',
			'archive_slider_image5',
			'archive_slider_headline5',
			'archive_slider_url5',
			'archive_slider_target5',
			'archive_slider_list_type',
			'archive_slider_category',
			'archive_slider_order',
			'archive_slider_num',
			'archive_slider_post_ids',
			'show_archive_slider_category',
			'show_archive_slider_author',
			'show_archive_slider_date',
			'show_archive_slider_views',
			'show_archive_slider_native_ad',
			'archive_slider_native_ad_position'
		);
		foreach ( $meta_keys as $key ) {
			if ( isset( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}

		update_option( "taxonomy_{$term_id}", $term_meta );
	}
}
add_action( 'created_category', 'category_save_extra_category_fileds' );
add_action( 'edited_category', 'category_save_extra_category_fileds' );

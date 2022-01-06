<?php

/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function cb_get_contents() {
	global $dp_options;		// $dp_optionsは保存時にWPが使用するため使えない
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	return array(
		'blog' => array(
			'name' => 'blog',
			'label' => __( 'Recent blog', 'tcd-w' ),
			'default' => array(
				'cb_display' => 0,
				'cb_headline' => __( 'Recent blog', 'tcd-w' ),
				'cb_list_type' => 'all',
				'cb_category' => 0,
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
			'cb_list_type_options' => array(
				'all' => __( 'All posts', 'tcd-w' ),
				'category' => __( 'Category', 'tcd-w' ),
				'recommend_post' => __( 'Recommend post', 'tcd-w' ),
				'recommend_post2' => __( 'Recommend post2', 'tcd-w' ),
				'pickup_post' => __( 'Pickup post', 'tcd-w' )
			),
			'cb_order_options' => array(
				'date' => __( 'Date (DESC)', 'tcd-w' ),
				'date2' => __( 'Date (ASC)', 'tcd-w' ),
				'random' => __( 'Random', 'tcd-w' )
			)
		),
		'category' => array(
			'name' => 'category',
			'label' => __( 'Category blog', 'tcd-w' ),
			'default' => array(
				'cb_display' => 0,
				'cb_headline' => '',
				'cb_headline2' => '',
				'cb_layout' => 1,
				'cb_list_type' => 'category',
				'cb_list_type2' => 'category',
				'cb_category' => 0,
				'cb_category2' => 0,
				'cb_order' => 'date',
				'cb_order2' => 'date',
				'cb_post_num' => 4,
				'cb_post_num2' => 4,
				'cb_title_font_size' => 14,
				'cb_title_font_size2' => 14,
				'cb_title_font_size_mobile' => 14,
				'cb_title_font_size_mobile2' => 14,
				'cb_show_category' => 0,
				'cb_show_category2' => 0,
				'cb_show_author' => 0,
				'cb_show_author2' => 0,
				'cb_show_date' => 1,
				'cb_show_date2' => 1,
				'cb_show_views' => 0,
				'cb_show_views2' => 0,
				'cb_show_archive_link' => 0,
				'cb_show_archive_link2' => 0,
				'cb_archive_link_text' => __( 'Category archive', 'tcd-w' ),
				'cb_archive_link_text2' => __( 'Category archive', 'tcd-w' )
			),
			'cb_layout_options' => array(
				1 => __( 'One column', 'tcd-w' ),
				2 => __( 'Two columns', 'tcd-w' )
			),
			'cb_list_type_options' => array(
				'all' => __( 'All posts', 'tcd-w' ),
				'category' => __( 'Category', 'tcd-w' ),
				'recommend_post' => __( 'Recommend post', 'tcd-w' ),
				'recommend_post2' => __( 'Recommend post2', 'tcd-w' ),
				'pickup_post' => __( 'Pickup post', 'tcd-w' ),
			),
			'cb_order_options' => array(
				'date' => __( 'Date (DESC)', 'tcd-w' ),
				'date2' => __( 'Date (ASC)', 'tcd-w' ),
				'random' => __( 'Random', 'tcd-w' )
			)
		),
		'news' => array(
			'name' => 'news',
			'label' => __( 'News', 'tcd-w' ),
			'default' => array(
				'cb_display' => 0,
				'cb_headline' => __( 'News', 'tcd-w' ),
				'cb_order' => 'date',
				'cb_post_num' => 3,
				'cb_show_date' => 0,
				'cb_show_views' => 0,
				'cb_show_archive_link' => 0,
				'cb_archive_link_text' => __( 'News archive', 'tcd-w' )
			),
			'cb_order_options' => array(
				'date' => __( 'Date (DESC)', 'tcd-w' ),
				'date2' => __( 'Date (ASC)', 'tcd-w' ),
				'random' => __( 'Random', 'tcd-w' )
			),
			'cb_post_num_options' => array(
				3 => 3,
				6 => 6,
				9 => 9,
				12 => 12,
				15 => 15
			)
		),
		'ad' => array(
			'name' => 'ad',
			'label' => __( 'Advertisement', 'tcd-w' ),
			'default' => array(
				'cb_display' => 0,
				'cb_ad_code1' => '',
				'cb_ad_image1' => '',
				'cb_ad_url1' => '',
				'cb_ad_code2' => '',
				'cb_ad_image2' => '',
				'cb_ad_url2' => ''
			)
		),
		'wysiwyg' => array(
			'name' => 'wysiwyg',
			'label' => __( 'Free space', 'tcd-w' ),
			'default' => array(
				'cb_display' => 0,
				'cb_wysiwyg_editor' => ''
			)
		)
	);
}

/**
 * コンテンツビルダー js/css
 */
function cb_admin_scripts() {
	wp_enqueue_style( 'tcd-cb', get_template_directory_uri() . '/admin/css/contents-builder.css', array(), version_num() );
	wp_enqueue_script( 'tcd-cb', get_template_directory_uri() . '/admin/js/contents-builder.js', array( 'jquery-ui-sortable' ), version_num(), true);
	wp_enqueue_style( 'editor-buttons' );
}
add_action( 'admin_print_scripts-appearance_page_theme_options', 'cb_admin_scripts' );

/**
 * コンテンツビルダー入力設定
 */
function cb_inputs() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_desing_plus_option();
?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Contents Builder', 'tcd-w' ); ?></h3>
		<div class="theme_option_message"><?php echo __( '<p>You can build contents freely with this function.</p><p>FIRST STEP: Click Add content button.<br>SECOND STEP: Select content from dropdown menu to show on each column.</p><p>You can change row by dragging MOVE button and you can delete row by clicking DELETE button.</p>', 'tcd-w' ); ?></div>

		<div id="contents_builder_wrap">
			<div id="contents_builder" data-delete-confirm="<?php _e( 'Are you sure you want to delete this content?', 'tcd-w' ); ?>">
<?php
	if ( ! empty( $dp_options['contents_builder'] ) ) :
		foreach ( $dp_options['contents_builder'] as $key => $content ) :
			$cb_index = 'cb_' . ( $key + 1 );
?>
				<div class="cb_row">
					<ul class="cb_button cf">
						<li><span class="cb_move"><?php echo __( 'Move', 'tcd-w' ); ?></span></li>
						<li><span class="cb_delete"><?php echo __( 'Delete', 'tcd-w' ); ?></span></li>
					</ul>
					<div class="cb_column_area cf">
						<div class="cb_column">
							<input type="hidden" value="<?php echo $cb_index; ?>" class="cb_index">
							<?php the_cb_content_select( $cb_index, $content['cb_content_select'] ); ?>
							<?php if ( ! empty( $content['cb_content_select'] ) ) the_cb_content_setting( $cb_index, $content['cb_content_select'], $content ); ?>
						</div>
					</div><!-- END .cb_column_area -->
				</div><!-- END .cb_row -->
<?php
		endforeach;
	endif;
?>
			</div><!-- END #contents_builder -->
			<div id="cb_add_row_buttton_area">
				<input type="button" value="<?php echo __( 'Add content', 'tcd-w' ); ?>" class="button-secondary add_row">
			</div>
			<p><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>"></p>
		</div><!-- END #contents_builder_wrap -->

<?php
	// コンテンツビルダー追加用 非表示
	$cb_index = 'cb_cloneindex';
?>
		<div id="contents_builder-clone" class="hidden">
			<div class="cb_row">
				<ul class="cb_button cf">
					<li><span class="cb_move"><?php echo __( 'Move', 'tcd-w' ); ?></span></li>
					<li><span class="cb_delete"><?php echo __( 'Delete', 'tcd-w' ); ?></span></li>
				</ul>
				<div class="cb_column_area cf">
					<div class="cb_column">
						<input type="hidden" class="cb_index" value="cb_cloneindex">
						<?php the_cb_content_select( $cb_index ); ?>
					</div>
				</div><!-- END .cb_column_area -->
			</div><!-- END .cb_row -->
<?php
	foreach ( cb_get_contents() as $key => $value ) :
		the_cb_content_setting( 'cb_cloneindex', $key );
	endforeach;
?>
		</div><!-- END #contents_builder-clone.hidden -->
	</div>
<?php
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function the_cb_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = cb_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="dp_options[contents_builder][' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
	$out .= '<option value="">' . __( 'Choose the content', 'tcd-w' ) . '</option>';

	foreach ( $cb_contents as $key => $value ) {
		$out .= '<option value="' . esc_attr( $key ) . '"' . selected( $key, $selected, false ) . '>' . esc_html( $value['label'] ) . '</option>';
	}

	$out .= '</select>';

	echo $out;
}

/**
 * コンテンツビルダー用 コンテンツ設定
 */
function the_cb_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_desing_plus_option();

	$cb_contents = cb_get_contents();

	// 不明なコンテンツの場合は終了
	if ( ! $cb_content_select || ! isset( $cb_contents[$cb_content_select] ) ) return false;

	// コンテンツデフォルト値に入力値をマージ
	if ( isset( $cb_contents[$cb_content_select]['default'] ) ) {
		$value = array_merge( (array) $cb_contents[$cb_content_select]['default'], $value );
	}
?>
	<div class="cb_content_wrap cf cb_content-<?php echo esc_attr( $cb_content_select ); ?>">

<?php
	// 最新ブログ記事一覧
	if ( 'blog' == $cb_content_select ) :
?>
		<h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
		<div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_display]" type="checkbox" value="1" <?php checked( $value['cb_display'], 1 ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
			<?php if ( preg_match( '/^cb_\d+$/', $cb_index ) ) : ?>
			<div class="theme_option_message">
				<p><?php _e( 'To make it a link to jump to this content, set a href attribute to the ID below.', 'tcd-w' ); ?></p>
				<p><?php _e( 'ID:', 'tcd-w' ); ?> <input type="text" readonly="readonly" value="<?php echo $cb_index; ?>"></p>
			</div>
			<?php endif; ?>

			<h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
			<input type="text" class="regular-text change_content_headline" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_headline]" value="<?php echo esc_attr( $value['cb_headline'] ); ?>">

<?php
		if ( ! empty( $cb_contents[$cb_content_select]['cb_list_type_options'] ) ) :
?>
			<h4 class="theme_option_headline2"><?php _e( 'Post type', 'tcd-w' ); ?></h4>
			<ul class="cb_list_type-radios">
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_list_type_options'] as $k => $v ) :
				echo '<li><label><input type="radio" name="dp_options[contents_builder][' . $cb_index . '][cb_list_type]" value="' . esc_attr( $k ) . '" ' . checked( $value['cb_list_type'], $k, false ) . '> '. esc_html( $v ) . '</label>';
				if ( 'category' == $k ) :
					echo '&nbsp;&nbsp;';
					wp_dropdown_categories( array(
						'class' => '',
						'echo' => 1,
						'hide_empty' => 0,
						'hierarchical' => 1,
						'id' => '',
						'name' => 'dp_options[contents_builder][' . $cb_index . '][cb_category]',
						'selected' => $value['cb_category'],
						'show_count' => 0,
						'value_field' => 'term_id'
					) );
				endif;
				echo '</li>';
			endforeach;
?>
			</ul>
			<p class="description"><?php _e( 'Recommended posts and Pickup posts can be set from post edit screen / quick edit.', 'tcd-w' ); ?></p>
<?php
		endif;

		if ( ! empty( $cb_contents[$cb_content_select]['cb_order_options'] ) ) :
?>
				<h4 class="theme_option_headline2"><?php _e( 'Display order', 'tcd-w' ); ?></h4>
				<ul>
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_order_options'] as $k => $v ) :
				echo '<li><label><input type="radio" name="dp_options[contents_builder][' . $cb_index . '][cb_order]" value="' . esc_attr( $k ) . '" ' . checked( $value['cb_order'], $k, false ) . '> '. esc_html( $v ) . '</label></li>';
			endforeach;
?>
				</ul>
<?php
		endif;
?>
			<h4 class="theme_option_headline2"><?php _e( 'Post number', 'tcd-w' ); ?></h4>
			<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_post_num]" value="<?php echo esc_attr( $value['cb_post_num'] ); ?>" min="1">
			<h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
			<ul>
				<li>
					<label><?php _e( 'Title font size', 'tcd-w' ); ?></label>
					<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_title_font_size]" value="<?php echo esc_attr( $value['cb_title_font_size'] ); ?>" min="1"> px
				</li>
				<li>
					<label><?php _e( 'Title font size for mobile', 'tcd-w' ); ?></label>
					<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_title_font_size_mobile]" value="<?php echo esc_attr( $value['cb_title_font_size_mobile'] ); ?>" min="1"> px
				</li>
				<li>
					<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_category]" type="hidden" value="">
					<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_category]" type="checkbox" value="1" <?php checked( $value['cb_show_category'], 1 ); ?>><?php _e( 'Display category', 'tcd-w' ); ?></label>
				</li>
				<li>
					<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_author]" type="hidden" value="">
					<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_author]" type="checkbox" value="1" <?php checked( $value['cb_show_author'], 1 ); ?>><?php _e( 'Display author', 'tcd-w' ); ?></label>
				</li>
				<li>
					<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_date]" type="hidden" value="">
					<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_date]" type="checkbox" value="1" <?php checked( $value['cb_show_date'], 1 ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label>
				</li>
				<li>
					<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_views]" type="hidden" value="">
					<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_views]" type="checkbox" value="1" <?php checked( $value['cb_show_views'], 1 ); ?>><?php _e( 'Display views', 'tcd-w' ); ?></label>
				</li>
			</ul>
			<h4 class="theme_option_headline2"><?php _e( 'Native advertisement setting', 'tcd-w' ); ?></h4>
			<div class="theme_option_message">
				<p><?php _e( 'Display ads that are registered in native advertisement settings.', 'tcd-w' ); ?></p>
			</div>
			<p>
				<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_native_ad]" type="hidden" value="">
				<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_native_ad]" type="checkbox" value="1" <?php checked( $value['cb_show_native_ad'], 1 ); ?>><?php _e( 'Display native advertisement', 'tcd-w' ); ?></label>
			</p>
			<h4 class="theme_option_headline2"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></h4>
			<div class="theme_option_message">
				<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
			</div>
			<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_native_ad_position]" value="<?php echo esc_attr( $value['cb_native_ad_position'] ); ?>" min="1">
			<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_archive_link]" type="checkbox" value="1" <?php checked( $value['cb_show_archive_link'], 1 ); ?>><?php _e( 'Display archive link', 'tcd-w' ); ?></label></p>
			<h4 class="theme_option_headline2"><?php _e( 'Archive link label', 'tcd-w' ); ?></h4>
			<input type="text" class="regular-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_archive_link_text]" value="<?php echo esc_attr( $value['cb_archive_link_text'] ); ?>">

			<ul class="cb_content_button cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>"></li>
				<li><a href="#" class="button-secondary close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
			</ul>
		</div>

<?php
	// カテゴリー記事一覧
	elseif ( 'category' == $cb_content_select ) :
?>
		<h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
		<div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_display]" type="checkbox" value="1" <?php checked( $value['cb_display'], 1 ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
			<?php if ( preg_match( '/^cb_\d+$/', $cb_index ) ) : ?>
			<div class="theme_option_message">
				<p><?php _e( 'To make it a link to jump to this content, set a href attribute to the ID below.', 'tcd-w' ); ?></p>
				<p><?php _e( 'ID:', 'tcd-w' ); ?> <input type="text" readonly="readonly" value="<?php echo $cb_index; ?>"></p>
			</div>
			<?php endif; ?>

<?php
		if ( ! empty( $cb_contents[$cb_content_select]['cb_layout_options'] ) ) :
?>
			<h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-w' ); ?></h4>
			<ul class="cb_layout-radios">
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_layout_options'] as $k => $v ) :
				echo '<li><label><input type="radio" name="dp_options[contents_builder][' . $cb_index . '][cb_layout]" value="' . esc_attr( $k ) . '" ' . checked( $value['cb_layout'], $k, false ) . '> '. esc_html( $v ) . '</label></li>';
			endforeach;
?>
			</ul>
<?php
		endif;
?>

			<div class="sub_box cf" style="margin-top: 30px;">
				<h3 class="theme_option_subbox_headline"><?php printf( __( 'Column%d', 'tcd-w' ), 1 ) ; ?></h3>
				<div class="sub_box_content">
					<h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
					<input type="text" class="regular-text change_content_headline" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_headline]" value="<?php echo esc_attr( $value['cb_headline'] ); ?>">
<?php
		if ( ! empty( $cb_contents[$cb_content_select]['cb_list_type_options'] ) ) :
?>
					<h4 class="theme_option_headline2"><?php _e( 'Post type', 'tcd-w' ); ?></h4>
					<ul class="cb_list_type-radios">
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_list_type_options'] as $k => $v ) :
				echo '<li><label><input type="radio" name="dp_options[contents_builder][' . $cb_index . '][cb_list_type]" value="' . esc_attr( $k ) . '" ' . checked( $value['cb_list_type'], $k, false ) . '> '. esc_html( $v ) . '</label>';
				if ( 'category' == $k ) :
					echo '&nbsp;&nbsp;';
					wp_dropdown_categories( array(
						'class' => '',
						'echo' => 1,
						'hide_empty' => 0,
						'hierarchical' => 1,
						'id' => '',
						'name' => 'dp_options[contents_builder][' . $cb_index . '][cb_category]',
						'selected' => $value['cb_category'],
						'show_count' => 0,
						'value_field' => 'term_id'
					) );
				endif;
				echo '</li>';
			endforeach;
?>
					</ul>
					<p class="description"><?php _e( 'Recommended posts and Pickup posts can be set from post edit screen / quick edit.', 'tcd-w' ); ?></p>
<?php
		endif;

		if ( ! empty( $cb_contents[$cb_content_select]['cb_order_options'] ) ) :
?>
					<h4 class="theme_option_headline2"><?php _e( 'Display order', 'tcd-w' ); ?></h4>
					<ul>
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_order_options'] as $k => $v ) :
				echo '<li><label><input type="radio" name="dp_options[contents_builder][' . $cb_index . '][cb_order]" value="' . esc_attr( $k ) . '" ' . checked( $value['cb_order'], $k, false ) . '> '. esc_html( $v ) . '</label></li>';
			endforeach;
?>
					</ul>
<?php
		endif;
?>
					<h4 class="theme_option_headline2"><?php _e( 'Post number', 'tcd-w' ); ?></h4>
					<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_post_num]" value="<?php echo esc_attr( $value['cb_post_num'] ); ?>" min="1">
					<h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
					<ul>
						<li>
							<label><?php _e( 'Title font size', 'tcd-w' ); ?></label>
							<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_title_font_size]" value="<?php echo esc_attr( $value['cb_title_font_size'] ); ?>" min="1"> px
						</li>
						<li>
							<label><?php _e( 'Title font size for mobile', 'tcd-w' ); ?></label>
							<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_title_font_size_mobile]" value="<?php echo esc_attr( $value['cb_title_font_size_mobile'] ); ?>" min="1"> px
						</li>
						<li>
							<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_category]" type="hidden" value="">
							<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_category]" type="checkbox" value="1" <?php checked( $value['cb_show_category'], 1 ); ?>><?php _e( 'Display category', 'tcd-w' ); ?></label>
						</li>
						<li>
							<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_author]" type="hidden" value="">
							<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_author]" type="checkbox" value="1" <?php checked( $value['cb_show_author'], 1 ); ?>><?php _e( 'Display author', 'tcd-w' ); ?></label>
						</li>
						<li>
							<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_date]" type="hidden" value="">
							<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_date]" type="checkbox" value="1" <?php checked( $value['cb_show_date'], 1 ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label>
						</li>
						<li>
							<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_views]" type="hidden" value="">
							<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_views]" type="checkbox" value="1" <?php checked( $value['cb_show_views'], 1 ); ?>><?php _e( 'Display views', 'tcd-w' ); ?></label>
						</li>
					</ul>
					<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
					<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_archive_link]" type="checkbox" value="1" <?php checked( $value['cb_show_archive_link'], 1 ); ?>><?php _e( 'Display archive link', 'tcd-w' ); ?></label></p>
					<h4 class="theme_option_headline2"><?php _e( 'Archive link label', 'tcd-w' ); ?></h4>
					<input type="text" class="regular-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_archive_link_text]" value="<?php echo esc_attr( $value['cb_archive_link_text'] ); ?>">

				</div>
			</div>

			<div class="cb_layout-content-2"<?php if ( 2 != $value['cb_layout'] ) echo ' style="display: none;"'; ?>>
				<div class="sub_box cf">
					<h3 class="theme_option_subbox_headline"><?php printf( __( 'Column%d', 'tcd-w' ), 2 ) ; ?></h3>
					<div class="sub_box_content">
						<h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
						<input type="text" class="regular-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_headline2]" value="<?php echo esc_attr( $value['cb_headline2'] ); ?>">
<?php
		if ( ! empty( $cb_contents[$cb_content_select]['cb_list_type_options'] ) ) :
?>
						<h4 class="theme_option_headline2"><?php _e( 'Post type', 'tcd-w' ); ?></h4>
						<ul class="cb_list_type-radios">
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_list_type_options'] as $k => $v ) :
				echo '<li><label><input type="radio" name="dp_options[contents_builder][' . $cb_index . '][cb_list_type2]" value="' . esc_attr( $k ) . '" ' . checked( $value['cb_list_type2'], $k, false ) . '> '. esc_html( $v ) . '</label>';
				if ( 'category' == $k ) :
					echo '&nbsp;&nbsp;';
					wp_dropdown_categories( array(
						'class' => '',
						'echo' => 1,
						'hide_empty' => 0,
						'hierarchical' => 1,
						'id' => '',
						'name' => 'dp_options[contents_builder][' . $cb_index . '][cb_category2]',
						'selected' => $value['cb_category2'],
						'show_count' => 0,
						'value_field' => 'term_id'
					) );
				endif;
				echo '</li>';
			endforeach;
?>
						</ul>
						<p class="description"><?php _e( 'Recommended posts and Pickup posts can be set from post edit screen / quick edit.', 'tcd-w' ); ?></p>
<?php
		endif;

		if ( ! empty( $cb_contents[$cb_content_select]['cb_order_options'] ) ) :
?>
						<h4 class="theme_option_headline2"><?php _e( 'Display order', 'tcd-w' ); ?></h4>
						<ul>
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_order_options'] as $k => $v ) :
				echo '<li><label><input type="radio" name="dp_options[contents_builder][' . $cb_index . '][cb_order2]" value="' . esc_attr( $k ) . '" ' . checked( $value['cb_order2'], $k, false ) . '> '. esc_html( $v ) . '</label></li>';
			endforeach;
?>
						</ul>
<?php
		endif;
?>
						<h4 class="theme_option_headline2"><?php _e( 'Post number', 'tcd-w' ); ?></h4>
						<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_post_num2]" value="<?php echo esc_attr( $value['cb_post_num2'] ); ?>" min="1">
						<h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
						<ul>
							<li>
								<label><?php _e( 'Title font size', 'tcd-w' ); ?></label>
								<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_title_font_size2]" value="<?php echo esc_attr( $value['cb_title_font_size2'] ); ?>" min="1"> px
							</li>
							<li>
								<label><?php _e( 'Title font size for mobile', 'tcd-w' ); ?></label>
								<input type="number" class="small-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_title_font_size_mobile2]" value="<?php echo esc_attr( $value['cb_title_font_size_mobile2'] ); ?>" min="1"> px
							</li>
							<li>
								<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_category2]" type="hidden" value="">
								<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_category2]" type="checkbox" value="1" <?php checked( $value['cb_show_category2'], 1 ); ?>><?php _e( 'Display category', 'tcd-w' ); ?></label>
							</li>
							<li>
								<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_author2]" type="hidden" value="">
								<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_author2]" type="checkbox" value="1" <?php checked( $value['cb_show_author2'], 1 ); ?>><?php _e( 'Display author', 'tcd-w' ); ?></label>
							</li>
							<li>
								<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_date2]" type="hidden" value="">
								<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_date2]" type="checkbox" value="1" <?php checked( $value['cb_show_date2'], 1 ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label>
							</li>
							<li>
								<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_views2]" type="hidden" value="">
								<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_views2]" type="checkbox" value="1" <?php checked( $value['cb_show_views2'], 1 ); ?>><?php _e( 'Display views', 'tcd-w' ); ?></label>
							</li>
						</ul>
						<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
						<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_archive_link2]" type="checkbox" value="1" <?php checked( $value['cb_show_archive_link2'], 1 ); ?>><?php _e( 'Display archive link', 'tcd-w' ); ?></label></p>
						<h4 class="theme_option_headline2"><?php _e( 'Archive link label', 'tcd-w' ); ?></h4>
						<input type="text" class="regular-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_archive_link_text2]" value="<?php echo esc_attr( $value['cb_archive_link_text2'] ); ?>">
					</div>
				</div>
			</div>

			<ul class="cb_content_button cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>"></li>
				<li><a href="#" class="button-secondary close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
			</ul>
		</div>

<?php
	// おしらせ
	elseif ( 'news' == $cb_content_select ) :
?>
		<h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
		<div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_display]" type="checkbox" value="1" <?php checked( $value['cb_display'], 1 ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
			<?php if ( preg_match( '/^cb_\d+$/', $cb_index ) ) : ?>
			<div class="theme_option_message">
				<p><?php _e( 'To make it a link to jump to this content, set a href attribute to the ID below.', 'tcd-w' ); ?></p>
				<p><?php _e( 'ID:', 'tcd-w' ); ?> <input type="text" readonly="readonly" value="<?php echo $cb_index; ?>"></p>
			</div>
			<?php endif; ?>

			<h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
			<input type="text" class="regular-text change_content_headline" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_headline]" value="<?php echo esc_attr( $value['cb_headline'] ); ?>">

<?php
		if ( ! empty( $cb_contents[$cb_content_select]['cb_order_options'] ) ) :
?>
				<h4 class="theme_option_headline2"><?php _e( 'Display order', 'tcd-w' ); ?></h4>
				<ul>
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_order_options'] as $k => $v ) :
				echo '<li><label><input type="radio" name="dp_options[contents_builder][' . $cb_index . '][cb_order]" value="' . esc_attr( $k ) . '" ' . checked( $value['cb_order'], $k, false ) . '> '. esc_html( $v ) . '</label></li>';
			endforeach;
?>
				</ul>
<?php
		endif;

		if ( ! empty( $cb_contents[$cb_content_select]['cb_post_num_options'] ) ) :
?>
			<h4 class="theme_option_headline2"><?php _e( 'Post number', 'tcd-w' ); ?></h4>
			<select name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_post_num]">
<?php
			foreach ( $cb_contents[$cb_content_select]['cb_post_num_options'] as $k => $v ) :
				if ( $value['cb_post_num'] == $k ) {
					$selected = 'selected="selected"';
				} else {
					$selected = '';
				}
				echo '<option value="' . esc_attr( $k ) . '"' . selected( $value['cb_post_num'], $k, false ) . '>'. esc_html( $v ) . '</option>';
			endforeach;
?>
			</select>
<?php
		endif;
?>
			<h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
			<ul>
				<li>
					<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_category]" type="hidden" value="">
					<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_date]" type="checkbox" value="1" <?php checked( $value['cb_show_date'], 1 ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label>
				</li>
				<li>
					<input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_category]" type="hidden" value="">
					<label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_views]" type="checkbox" value="1" <?php checked( $value['cb_show_views'], 1 ); ?>><?php _e( 'Display views', 'tcd-w' ); ?></label>
				</li>
			</ul>
			<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_show_archive_link]" type="checkbox" value="1" <?php checked( $value['cb_show_archive_link'], 1 ); ?>><?php _e( 'Display archive link', 'tcd-w' ); ?></label></p>
			<h4 class="theme_option_headline2"><?php _e( 'Archive link label', 'tcd-w' ); ?></h4>
			<input type="text" class="regular-text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_archive_link_text]" value="<?php echo esc_attr( $value['cb_archive_link_text'] ); ?>">

			<ul class="cb_content_button cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>"></li>
				<li><a href="#" class="button-secondary close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
			</ul>
		</div>

<?php
	// 広告
	elseif ( 'ad' == $cb_content_select ) :
?>
		<h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
		<div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_display]" type="checkbox" value="1" <?php checked( $value['cb_display'], 1 ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
			<?php if ( preg_match( '/^cb_\d+$/', $cb_index ) ) : ?>
			<div class="theme_option_message">
				<p><?php _e( 'To make it a link to jump to this content, set a href attribute to the ID below.', 'tcd-w' ); ?></p>
				<p><?php _e( 'ID:', 'tcd-w' ); ?> <input type="text" readonly="readonly" value="<?php echo $cb_index; ?>"></p>
			</div>
			<?php endif; ?>

			<div class="sub_box cf">
				<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
				<div class="sub_box_content">
					<div class="theme_option_content">
						<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
						<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
						<textarea class="large-text" cols="50" rows="10" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_ad_code1]"><?php echo esc_textarea( $value['cb_ad_code1'] ); ?></textarea>
					</div>
					<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
					<div class="theme_option_content">
						<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
						<div class="image_box cf">
							<div class="cf cf_media_field hide-if-no-js cb_ad_image1">
								<input type="hidden" value="<?php echo esc_attr( $value['cb_ad_image1'] ); ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_ad_image1]" class="cf_media_id">
								<div class="preview_field"><?php if ( $value['cb_ad_image1'] ) { echo wp_get_attachment_image( $value['cb_ad_image1'], 'medium' ); } ?></div>
								<div class="button_area">
									<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
									<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $value['cb_ad_image1'] ) { echo 'hidden'; } ?>">
								</div>
							</div>
						</div>
						<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
						<input class="regular-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_ad_url1]" value="<?php echo esc_attr( $value['cb_ad_url1'] ); ?>">
					</div>
				</div>
			</div>
			<div class="sub_box cf">
				<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
				<div class="sub_box_content">
					<div class="theme_option_content">
						<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
						<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
						<textarea class="large-text" cols="50" rows="10" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_ad_code2]"><?php echo esc_textarea( $value['cb_ad_code2'] ); ?></textarea>
					</div>
					<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
					<div class="theme_option_content">
						<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
						<div class="image_box cf">
							<div class="cf cf_media_field hide-if-no-js cb_ad_image2">
								<input type="hidden" value="<?php echo esc_attr( $value['cb_ad_image2'] ); ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_ad_image2]" class="cf_media_id">
								<div class="preview_field"><?php if ( $value['cb_ad_image2'] ) { echo wp_get_attachment_image( $value['cb_ad_image2'], 'medium' ); } ?></div>
								<div class="button_area">
									<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
									<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $value['cb_ad_image2'] ) { echo 'hidden'; } ?>">
								</div>
							</div>
						</div>
						<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
						<input class="regular-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_ad_url2]" value="<?php echo esc_attr( $value['cb_ad_url2'] ); ?>">
					</div>
				</div>
			</div>

			<ul class="cb_content_button cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>"></li>
				<li><a href="#" class="button-secondary close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
			</ul>
		</div>

<?php
	// フリーススペース
	elseif ( 'wysiwyg' == $cb_content_select ) :
?>
		<h3 class="cb_content_headline"><?php _e( 'WYSIWYG editor', 'tcd-w' ); ?><span></span></h3>
		<div class="cb_content">
			<p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][cb_display]" type="checkbox" value="1" <?php checked( $value['cb_display'], 1 ); ?>><?php _e( 'Display this content at top page', 'tcd-w' ); ?></label></p>
			<?php if ( preg_match( '/^cb_\d+$/', $cb_index ) ) : ?>
			<div class="theme_option_message">
				<p><?php _e( 'To make it a link to jump to this content, set a href attribute to the ID below.', 'tcd-w' ); ?></p>
				<p><?php _e( 'ID:', 'tcd-w' ); ?> <input type="text" readonly="readonly" value="<?php echo $cb_index; ?>"></p>
			</div>
			<?php endif; ?>
			<?php wp_editor( $value['cb_wysiwyg_editor'], 'cb_wysiwyg_editor-' . $cb_index, array( 'textarea_name' => 'dp_options[contents_builder][' . $cb_index . '][cb_wysiwyg_editor]', 'textarea_rows' => 10, 'editor_class' => 'change_content_headline' ) ); ?>

			<ul class="cb_content_button cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>"></li>
				<li><a href="#" class="button-secondary close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
			</ul>
		</div>
<?php
	else :
?>
		<h3 class="cb_content_headline"><?php echo esc_html( $cb_content_select ); ?></h3>
		<div class="cb_content">
			<ul class="cb_content_button cf">
				<li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>"></li>
				<li><a href="#" class="button-secondary close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
			</ul>
		</div>
<?php
	endif;
?>
	</div><!-- END .cb_content_wrap -->
<?php
}

/**
 * コンテンツビルダー用 保存整形
 */
function cb_validate( $input = array() ) {
	if ( ! empty( $input['contents_builder'] ) ) {
		$cb_contents = cb_get_contents();
		$cb_data = array();

		foreach ( $input['contents_builder'] as $key => $value ) {
			// クローン用はスルー
			if ( in_array( $key, array( 'cb_cloneindex', 'cb_cloneindex2' ), true ) ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

			// 最新ブログ記事一覧
			if ( 'blog' == $value['cb_content_select'] ) {
				$value['cb_display'] = ( $value['cb_display'] == 1 ) ? 1 : 0;
				$value['cb_headline'] = wp_filter_nohtml_kses( $value['cb_headline'] );
				$value['cb_category'] = intval( $value['cb_category'] );
				$value['cb_post_num'] = intval( $value['cb_post_num'] );
				$value['cb_title_font_size'] = intval( $value['cb_title_font_size'] );
				$value['cb_title_font_size_mobile'] = intval( $value['cb_title_font_size_mobile'] );
				$value['cb_show_category'] = ( $value['cb_show_category'] == 1 ) ? 1 : 0;
				$value['cb_show_author'] = ( $value['cb_show_author'] == 1 ) ? 1 : 0;
				$value['cb_show_date'] = ( $value['cb_show_date'] == 1 ) ? 1 : 0;
				$value['cb_show_views'] = ( $value['cb_show_views'] == 1 ) ? 1 : 0;
				$value['cb_show_native_ad'] = ( $value['cb_show_native_ad'] == 1 ) ? 1 : 0;
				$value['cb_native_ad_position'] = intval( $value['cb_native_ad_position'] );
				$value['cb_show_archive_link'] = ( $value['cb_show_archive_link'] == 1 ) ? 1 : 0;
				$value['cb_archive_link_text'] = wp_filter_nohtml_kses( $value['cb_archive_link_text'] );

				if ( ! empty( $value['cb_list_type'] ) && ! isset( $cb_contents[$value['cb_content_select']]['cb_list_type_options'][$value['cb_list_type']] ) ) {
					$value['cb_list_type'] = null;
				}
				if ( empty( $value['cb_list_type'] ) && isset( $cb_contents[$value['cb_content_select']]['default']['cb_list_type'] ) ) {
					$value['cb_list_type'] = $cb_contents[$value['cb_content_select']]['default']['cb_list_type'];
				}

				if ( ! empty( $value['cb_order'] ) && ! isset( $cb_contents[$value['cb_content_select']]['cb_order_options'][$value['cb_order']] ) ) {
					$value['cb_order'] = null;
				}
				if ( empty( $value['cb_order'] ) && isset( $cb_contents[$value['cb_content_select']]['default']['cb_order'] ) ) {
					$value['cb_order'] = $cb_contents[$value['cb_content_select']]['default']['cb_order'];
				}

			// カテゴリーブログ記事一覧
			} elseif ( 'category' == $value['cb_content_select'] ) {
				$value['cb_display'] = ( $value['cb_display'] == 1 ) ? 1 : 0;
				$value['cb_headline'] = wp_filter_nohtml_kses( $value['cb_headline'] );

				if ( ! empty( $value['cb_layout'] ) && ! isset( $cb_contents[$value['cb_content_select']]['cb_layout_options'][$value['cb_layout']] ) ) {
					$value['cb_layout'] = null;
				}
				if ( empty( $value['cb_layout'] ) && isset( $cb_contents[$value['cb_content_select']]['default']['cb_layout'] ) ) {
					$value['cb_layout'] = $cb_contents[$value['cb_content_select']]['default']['cb_layout'];
				}

				foreach ( array( '', 2 ) as $i ) {
					$value['cb_headline' . $i] = wp_filter_nohtml_kses( $value['cb_headline' . $i] );
					$value['cb_category' . $i] = intval( $value['cb_category' . $i] );
					$value['cb_post_num' . $i] = intval( $value['cb_post_num' . $i] );
					$value['cb_title_font_size' . $i] = intval( $value['cb_title_font_size' . $i] );
					$value['cb_title_font_size_mobile' . $i] = intval( $value['cb_title_font_size_mobile' . $i] );
					$value['cb_show_category' . $i] = ( $value['cb_show_category' . $i] == 1 ) ? 1 : 0;
					$value['cb_show_author' . $i] = ( $value['cb_show_author' . $i] == 1 ) ? 1 : 0;
					$value['cb_show_date' . $i] = ( $value['cb_show_date' . $i] == 1 ) ? 1 : 0;
					$value['cb_show_views' . $i] = ( $value['cb_show_views' . $i] == 1 ) ? 1 : 0;
					$value['cb_show_archive_link' . $i] = ( $value['cb_show_archive_link' . $i] == 1 ) ? 1 : 0;
					$value['cb_archive_link_text' . $i] = wp_filter_nohtml_kses( $value['cb_archive_link_text' . $i] );

					if ( ! empty( $value['cb_list_type' . $i] ) && ! isset( $cb_contents[$value['cb_content_select']]['cb_list_type_options'][$value['cb_list_type' . $i]] ) ) {
						$value['cb_list_type' . $i] = null;
					}
					if ( empty( $value['cb_list_type' . $i] ) && isset( $cb_contents[$value['cb_content_select']]['default']['cb_list_type' . $i] ) ) {
						$value['cb_list_type' . $i] = $cb_contents[$value['cb_content_select']]['default']['cb_list_type' . $i];
					}

					if ( ! empty( $value['cb_order' . $i] ) && ! isset( $cb_contents[$value['cb_content_select']]['cb_order_options'][$value['cb_order' . $i]] ) ) {
						$value['cb_order' . $i] = null;
					}
					if ( empty( $value['cb_order' . $i] ) && isset( $cb_contents[$value['cb_content_select']]['default']['cb_order' . $i] ) ) {
						$value['cb_order' . $i] = $cb_contents[$value['cb_content_select']]['default']['cb_order' . $i];
					}
				}

			// お知らせ
			} elseif ( 'news' == $value['cb_content_select'] ) {
				$value['cb_display'] = ( $value['cb_display'] == 1 ) ? 1 : 0;
				$value['cb_headline'] = wp_filter_nohtml_kses( $value['cb_headline'] );
				$value['cb_show_date'] = ( $value['cb_show_date'] == 1 ) ? 1 : 0;
				$value['cb_show_views'] = ( $value['cb_show_views'] == 1 ) ? 1 : 0;
				$value['cb_show_archive_link'] = ( $value['cb_show_archive_link'] == 1 ) ? 1 : 0;
				$value['cb_archive_link_text'] = wp_filter_nohtml_kses( $value['cb_archive_link_text'] );

				if ( ! empty( $value['cb_order'] ) && ! isset( $cb_contents[$value['cb_content_select']]['cb_order_options'][$value['cb_order']] ) ) {
					$value['cb_order'] = null;
				}
				if ( empty( $value['cb_order'] ) && isset( $cb_contents[$value['cb_content_select']]['default']['cb_order'] ) ) {
					$value['cb_order'] = $cb_contents[$value['cb_content_select']]['default']['cb_order'];
				}

				$value['cb_post_num'] = intval( $value['cb_post_num'] );
				if ( ! empty( $value['cb_post_num'] ) && ! isset( $cb_contents[$value['cb_content_select']]['cb_post_num_options'][$value['cb_post_num']] ) ) {
					$value['cb_post_num'] = null;
				}
				if ( empty( $value['cb_post_num'] ) && isset( $cb_contents[$value['cb_content_select']]['default']['cb_post_num'] ) ) {
					$value['cb_post_num'] = $cb_contents[$value['cb_content_select']]['default']['cb_post_num'];
				}

			// 広告
			} elseif ( 'ad' == $value['cb_content_select'] ) {
				$value['cb_display'] = ( $value['cb_display'] == 1 ) ? 1 : 0;

				for ( $i = 1; $i <= 2; $i++ ) {
					$value['cb_ad_code' . $i] = $value['cb_ad_code' . $i];
					$value['cb_ad_image' . $i] = wp_filter_nohtml_kses( $value['cb_ad_image' . $i] );
					$value['cb_ad_url' . $i] = wp_filter_nohtml_kses( $value['cb_ad_url' . $i] );
				}

			// フリースペース
			} elseif ( 'wysiwyg' == $value['cb_content_select'] ) {
				$value['cb_display'] = ( $value['cb_display'] == 1 ) ? 1 : 0;
			}

			$cb_data[] = $value;
		}

		$input['contents_builder'] = $cb_data;
	}

	return $input;
}

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function cb_tiny_mce_before_init( $mceInit, $editor_id ) {
	if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
		$mceInit['wp_skip_init'] = true;
	}
	return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'cb_tiny_mce_before_init', 10, 2 );

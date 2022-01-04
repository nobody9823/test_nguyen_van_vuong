<?php
global $dp_options, $dp_default_options, $archive_slider_options, $archive_slider_list_type_options, $post_order_options, $display_side_content_options, $page_link_options;
if ( ! $dp_options ) $dp_options = get_design_plus_option();
?>
<?php // ブログの設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Blog setting', 'tcd-w' ); ?></h3>
	<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb label', 'tcd-w' ); ?></h4>
	<input class="regular-text" name="dp_options[blog_breadcrumb_label]" type="text" value="<?php echo esc_attr( $dp_options['blog_breadcrumb_label'] ); ?>">
	<input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
</div>
<?php // アーカイブスライダーの設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Archive slider setting', 'tcd-w' ); ?></h3>
	<h4 class="theme_option_headline2"><?php _e( 'Archive slider type', 'tcd-w' ); ?></h4>
	<fieldset id="js-archive_slider" class="cf select_type2" style="margin-bottom: 30px;">
		<?php foreach ( $archive_slider_options as $option ) : ?>
		<label><input type="radio" name="dp_options[archive_slider]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['archive_slider'], $option['value'] ); ?>><?php echo $option['label']; ?></label>
		<?php endforeach; ?>
	</fieldset>
	<div class="archive_slider-type1"<?php if ( 'type1' != $dp_options['archive_slider'] ) echo ' style="display: none;"'; ?>>
		<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		<div class="sub_box cf">
			<h3 class="theme_option_subbox_headline"><?php printf( __( 'Slider%s setting', 'tcd-w' ), $i ); ?></h3>
			<div class="sub_box_content">
				<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
				<p><?php _e( 'Recommend image size. Width:640px, height:450px', 'tcd-w' ); ?></p>
				<div class="image_box cf">
					<div class="cf cf_media_field hide-if-no-js archive_slider_image<?php echo esc_attr( $i ); ?>">
						<input type="hidden" value="<?php echo esc_attr( $dp_options['archive_slider_image' . $i] ); ?>" name="dp_options[archive_slider_image<?php echo esc_attr( $i ); ?>]" class="cf_media_id">
						<div class="preview_field"><?php if ( $dp_options['archive_slider_image' . $i] ) { echo wp_get_attachment_image( $dp_options['archive_slider_image' . $i], 'medium' ); } ?></div>
						<div class="button_area">
							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['archive_slider_image' . $i] ) { echo 'hidden'; } ?>">
						</div>
					</div>
				</div>
				<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
				<input class="large-text" name="dp_options[archive_slider_headline<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['archive_slider_headline' . $i] ); ?>">
				<h4 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[archive_slider_url<?php echo esc_attr( $i ); ?>]" value="<?php echo esc_attr( $dp_options['archive_slider_url' . $i] ); ?>">
				<p><label><input name="dp_options[archive_slider_target<?php echo esc_attr( $i ); ?>]" type="checkbox" value="1" <?php checked( 1, $dp_options['archive_slider_target' . $i] ); ?>><?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
				<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div>
		<?php endfor; ?>
	</div>
	<div class="archive_slider-type2"<?php if ( 'type2' != $dp_options['archive_slider'] ) echo ' style="display: none;"'; ?>>
		<h4 class="theme_option_headline2"><?php _e( 'Type of posts', 'tcd-w' ); ?></h4>
		<fieldset id="js-archive_slider_list_type"  class="cf select_type2">
			<?php foreach ( $archive_slider_list_type_options as $option ) : ?>
			<label><input type="radio" name="dp_options[archive_slider_list_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['archive_slider_list_type'], $option['value'] ); ?>>
				<?php
					echo $option['label'];

					if ( 'type2' == $option['value'] ) :
						echo '&nbsp;&nbsp;';
						wp_dropdown_categories( array(
							'class' => '',
							'echo' => 1,
							'hide_empty' => 0,
							'hierarchical' => 1,
							'id' => 'archive_slider_category',
							'name' => 'dp_options[archive_slider_category]',
							'selected' => $dp_options['archive_slider_category'],
							'show_count' => 0,
							'value_field' => 'term_id'
						) );
					elseif ( 'type6' == $option['value'] ) :
?>
				<p><input type="text" class="regular-text" name="dp_options[archive_slider_post_ids]" value="<?php echo esc_attr( $dp_options['archive_slider_post_ids'] ); ?>"><br>
				<span class="description"><?php _e( 'Enter a comma-seperated list of post ID numbers, example 2,4,10', 'tcd-w' ); ?></span></p>
				<?php
						endif;
				?></label>
			<?php endforeach; ?>
		</fieldset>
		<div class="hide-archive_slider_list_type-type6"<?php if ( 'type6' == $dp_options['archive_slider_list_type'] ) echo ' style="display: none;"'; ?>>
			<h4 class="theme_option_headline2"><?php _e( 'Number of posts', 'tcd-w' ); ?></h4>
			<input type="number" class="small-text" name="dp_options[archive_slider_num]" value="<?php echo esc_attr( $dp_options['archive_slider_num'] ); ?>" min="1" max="5">
			<h4 class="theme_option_headline2"><?php _e( 'Post order', 'tcd-w' ); ?></h4>
			<select name="dp_options[archive_slider_order]">
				<?php foreach ( $post_order_options as $option ) : ?>
				<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['archive_slider_order'] ); ?>><?php echo $option['label']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
		<p><label><input name="dp_options[show_archive_slider_category]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_archive_slider_category'] ); ?>> <?php _e( 'Display Category for archive slider', 'tcd-w' ); ?></label></p>
		<p><label><input name="dp_options[show_archive_slider_author]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_archive_slider_author'] ); ?>> <?php _e( 'Display author for archive slider', 'tcd-w' ); ?></label></p>
		<p><label><input name="dp_options[show_archive_slider_date]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_archive_slider_date'] ); ?>> <?php _e( 'Display date for archive slider', 'tcd-w' ); ?></label></p>
		<p><label><input name="dp_options[show_archive_slider_views]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_archive_slider_views'] ); ?>> <?php _e( 'Display views for archive slider', 'tcd-w' ); ?></label></p>
		<h4 class="theme_option_headline2"><?php _e( 'Native advertisement setting', 'tcd-w' ); ?></h4>
		<div class="theme_option_message">
			<p><?php _e( 'Display ads that are registered in native advertisement settings.', 'tcd-w' ); ?></p>
		</div>
		<p><label><input name="dp_options[show_archive_slider_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['show_archive_slider_native_ad'], 1 ); ?>><?php _e( 'Display native advertisement', 'tcd-w' ); ?></label></p>
		<h4 class="theme_option_headline2"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></h4>
		<div class="theme_option_message">
			<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
		</div>
		<input class="small-text" name="dp_options[archive_slider_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['archive_slider_native_ad_position'] ); ?>" min="1">
	</div>
	<input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
</div>
<?php // アーカイブページ ネイティブ広告の設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Native advertisement setting for archive page', 'tcd-w' ); ?></h3>
	<h4 class="theme_option_headline2"><?php _e( 'Native advertisement setting', 'tcd-w' ); ?></h4>
	<div class="theme_option_message">
		<p><?php _e( 'Display ads that are registered in native advertisement settings.', 'tcd-w' ); ?></p>
	</div>
	<p><label><input name="dp_options[show_archive_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['show_archive_native_ad'], 1 ); ?>><?php _e( 'Display native advertisement for archive page', 'tcd-w' ); ?></label></p>
	<h4 class="theme_option_headline2"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></h4>
	<div class="theme_option_message">
		<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
	</div>
	<input class="small-text" name="dp_options[archive_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['archive_native_ad_position'] ); ?>" min="1">
	<input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
</div>
<?php // アーカイブページの広告設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Archive page banner setup', 'tcd-w' ); ?></h3>
	<p><?php _e( 'This banner will be displayed among archive.', 'tcd-w' ); ?></p>
	<div class="sub_box cf">
		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
		<div class="sub_box_content">
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
				<textarea class="large-text" cols="50" rows="10" name="dp_options[archive_ad_code1]"><?php echo esc_textarea( $dp_options['archive_ad_code1'] ); ?></textarea>
			</div>
			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
				<div class="image_box cf">
					<div class="cf cf_media_field hide-if-no-js archive_ad_image1">
						<input type="hidden" value="<?php echo esc_attr( $dp_options['archive_ad_image1'] ); ?>" name="dp_options[archive_ad_image1]" class="cf_media_id">
						<div class="preview_field"><?php if ( $dp_options['archive_ad_image1'] ) { echo wp_get_attachment_image( $dp_options['archive_ad_image1'], 'medium' ); } ?></div>
						<div class="button_area">
							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['archive_ad_image1'] ) { echo 'hidden'; } ?>">
						</div>
					</div>
				</div>
				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[archive_ad_url1]" value="<?php echo esc_attr( $dp_options['archive_ad_url1'] ); ?>">
				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div>
	</div><!-- END .sub_box -->
	<div class="sub_box cf">
		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
		<div class="sub_box_content">
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
				<textarea class="large-text" cols="50" rows="10" name="dp_options[archive_ad_code2]"><?php echo esc_textarea( $dp_options['archive_ad_code2'] ); ?></textarea>
			</div>
			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
				<div class="image_box cf">
					<div class="cf cf_media_field hide-if-no-js archive_ad_image2">
						<input type="hidden" value="<?php echo esc_attr( $dp_options['archive_ad_image2'] ); ?>" name="dp_options[archive_ad_image2]" class="cf_media_id">
						<div class="preview_field"><?php if ( $dp_options['archive_ad_image2'] ) { echo wp_get_attachment_image( $dp_options['archive_ad_image2'], 'medium' ); } ?></div>
						<div class="button_area">
							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['archive_ad_image2'] ) { echo 'hidden'; } ?>">
						</div>
					</div>
				</div>
				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[archive_ad_url2]" value="<?php echo esc_attr( $dp_options['archive_ad_url2'] ); ?>">
				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div>
	</div><!-- END .sub_box -->
	<h4 class="theme_option_headline2"><?php _e( 'Position of advertisement', 'tcd-w' ); ?></h4>
	<div class="theme_option_message">
      <p><?php _e( 'The advertisement for the archive page is displayed only once under the number of articles set here.', 'tcd-w' ); ?></p>
	</div>
	<input class="small-text" type="number" name="dp_options[archive_ad_position]" value="<?php echo esc_attr( $dp_options['archive_ad_position'] ); ?>" min="1">
	<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
</div><!-- END .theme_option_field -->
<?php // 記事詳細ページの設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Blog title / contents setting', 'tcd-w' ); ?></h3>
	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title', 'tcd-w' ); ?></h4>
	<input type="number" class="small-text" name="dp_options[title_font_size]" value="<?php echo esc_attr( $dp_options['title_font_size'] ); ?>" min="0"><span>px</span>
	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title for mobile', 'tcd-w' ); ?></h4>
	<input type="number" class="small-text" name="dp_options[title_font_size_mobile]" value="<?php echo esc_attr( $dp_options['title_font_size_mobile'] ); ?>" min="0"><span>px</span>
	<h4 class="theme_option_headline2"><?php _e( 'Post title color', 'tcd-w' ); ?></h4>
	<input class="c-color-picker" name="dp_options[title_color]" type="text" value="<?php echo esc_attr( $dp_options['title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['title_color'] ); ?>">
	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
	<input type="number" class="small-text" name="dp_options[content_font_size]" value="<?php echo esc_attr( $dp_options['content_font_size'] ); ?>" min="0"><span>px</span>
	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents for mobile', 'tcd-w' ); ?></h4>
	<input type="number" class="small-text" name="dp_options[content_font_size_mobile]" value="<?php echo esc_attr( $dp_options['content_font_size_mobile'] ); ?>" min="0"><span>px</span>
	<h4 class="theme_option_headline2"><?php _e( 'Post contents color', 'tcd-w' ); ?></h4>
	<input class="c-color-picker" name="dp_options[content_color]" type="text" value="<?php echo esc_attr( $dp_options['content_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['content_color'] ); ?>">
	<h4 class="theme_option_headline2"><?php _e( 'Display side content', 'tcd-w' ); ?></h4>
	<fieldset class="cf select_type2">
		<?php foreach ( $display_side_content_options as $option ) : ?>
		<label><input type="radio" name="dp_options[single_display_side_content]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['single_display_side_content'] ); ?>><?php echo $option['label']; ?></label>
		<?php endforeach; ?>
	</fieldset>
	<h4 class="theme_option_headline2"><?php _e( 'Pages link setting', 'tcd-w' ); ?></h4>
	<fieldset class="cf select_type2">
		<?php foreach ( $page_link_options as $option ) : ?>
		<label><input type="radio" name="dp_options[page_link]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['page_link'] ); ?>><?php echo $option['label']; ?></label>
		<?php endforeach; ?>
	</fieldset>
	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
</div>
<?php // 表示設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Display setting', 'tcd-w' ); ?></h3>
	<ul>
		<li><label><input name="dp_options[show_thumbnail]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_thumbnail'] ); ?>><?php _e( 'Display thumbnail', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_views]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_views'] ); ?>><?php _e( 'Display views', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_date]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_date'] ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_category]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_category'] ); ?>><?php _e( 'Display category', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_tag]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_tag'] ); ?>><?php _e( 'Display tags', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_archive_author]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_archive_author'] ); ?>><?php _e( 'Display author for archive page', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_author]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_author'] ); ?>><?php _e( 'Display author', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_author_views]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_author_views'] ); ?>><?php _e( 'Display author views', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_sns_top]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_sns_top'] ); ?>><?php _e( 'Buttons to the article top', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_sns_btm]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_sns_btm'] ); ?>><?php _e( 'Buttons to the article bottom', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_next_post]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_next_post'] ); ?>><?php _e( 'Display next previous post link', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_comment]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_comment'] ); ?>><?php _e( 'Display comment', 'tcd-w' ); ?></label></li>
		<li><label><input name="dp_options[show_trackback]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_trackback'] ); ?>><?php _e( 'Display trackbacks', 'tcd-w' ); ?></label></li>
	</ul>
	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
</div>
<?php // 関連記事の設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e('Related posts setting', 'tcd-w'); ?></h3>
	<p><?php _e('Related posts will be displayed at the bottom of Pickup posts.','tcd-w'); ?></p>
	<p><label><input name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_related_post'] ); ?>> <?php _e('Display related post', 'tcd-w'); ?></label></p>
	<h4 class="theme_option_headline2"><?php _e('Headline of related posts', 'tcd-w'); ?></h4>
	<input class="regular-text" type="text" name="dp_options[related_post_headline]" value="<?php echo esc_attr( $dp_options['related_post_headline'] ); ?>">
	<h4 class="theme_option_headline2"><?php _e('Number of related posts', 'tcd-w'); ?></h4>
	<input type="number" class="small-text" name="dp_options[related_post_num]" value="<?php echo esc_attr( $dp_options['related_post_num'] ); ?>" min="1">
	<h4 class="theme_option_headline2"><?php _e('Native advertisement setting', 'tcd-w'); ?></h4>
	<div class="theme_option_message">
		<p><?php _e( 'Display ads that are registered in native advertisement settings.', 'tcd-w' ); ?></p>
	</div>
	<p><label><input name="dp_options[show_related_post_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['show_related_post_native_ad'], 1 ); ?>><?php _e( 'Display native advertisement', 'tcd-w' ); ?></label></p>
	<h4 class="theme_option_headline2"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></h4>
	<div class="theme_option_message">
		<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
	</div>
	<input class="small-text" name="dp_options[related_post_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['related_post_native_ad_position'] ); ?>" min="1">
	<input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
</div>
<?php // 広告の登録1 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Single page banner setup', 'tcd-w' ); ?>1</h3>
	<p><?php _e( 'This banner will be displayed under contents.', 'tcd-w' ); ?></p>
	<div class="sub_box cf">
		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
		<div class="sub_box_content">
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
				<textarea class="large-text" cols="50" rows="10" name="dp_options[single_ad_code1]"><?php echo esc_textarea( $dp_options['single_ad_code1'] ); ?></textarea>
			</div>
			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
				<div class="image_box cf">
					<div class="cf cf_media_field hide-if-no-js single_ad_image1">
						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image1'] ); ?>" name="dp_options[single_ad_image1]" class="cf_media_id">
						<div class="preview_field"><?php if ( $dp_options['single_ad_image1'] ) { echo wp_get_attachment_image( $dp_options['single_ad_image1'], 'medium' ); } ?></div>
						<div class="button_area">
							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image1'] ) { echo 'hidden'; } ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[single_ad_url1]" value="<?php echo esc_attr( $dp_options['single_ad_url1'] ); ?>">
				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div>
	</div><!-- END .sub_box -->
	<div class="sub_box cf">
		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
		<div class="sub_box_content">
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
				<textarea class="large-text" cols="50" rows="10" name="dp_options[single_ad_code2]"><?php echo esc_textarea( $dp_options['single_ad_code2'] ); ?></textarea>
			</div>
			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
				<div class="image_box cf">
					<div class="cf cf_media_field hide-if-no-js single_ad_image2">
						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image2'] ); ?>" name="dp_options[single_ad_image2]" class="cf_media_id">
						<div class="preview_field"><?php if ( $dp_options['single_ad_image2'] ) { echo wp_get_attachment_image( $dp_options['single_ad_image2'], 'medium' ); } ?></div>
						<div class="button_area">
							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image2'] ) { echo 'hidden'; } ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[single_ad_url2]" value="<?php echo esc_attr( $dp_options['single_ad_url2'] ); ?>">
				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div>
	</div><!-- END .sub_box -->
</div><!-- END .theme_option_field -->
<?php // 記事詳細の広告設定2 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Single page banner setup', 'tcd-w' ); ?>2</h3>
	<p><?php _e( 'Please copy and paste the short code inside the content to show this banner.', 'tcd-w' ); ?></p>
	<p><?php _e( 'Short code', 'tcd-w' ); ?> : <input type="text" readonly="readonly" value="[s_ad]"></p>
	<div class="sub_box cf">
		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
		<div class="sub_box_content">
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
				<textarea class="large-text" cols="50" rows="10" name="dp_options[single_ad_code3]"><?php echo esc_textarea( $dp_options['single_ad_code3'] ); ?></textarea>
			</div>
			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
				<div class="image_box cf">
					<div class="cf cf_media_field hide-if-no-js single_ad_image3">
						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image3'] ); ?>" name="dp_options[single_ad_image3]" class="cf_media_id">
						<div class="preview_field"><?php if ( $dp_options['single_ad_image3'] ) { echo wp_get_attachment_image( $dp_options['single_ad_image3'], 'medium' ); } ?></div>
						<div class="button_area">
							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image3'] ) { echo 'hidden'; } ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[single_ad_url3]" value="<?php echo esc_attr( $dp_options['single_ad_url3'] ); ?>">
				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div>
	</div><!-- END .sub_box -->
	<div class="sub_box cf">
		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
		<div class="sub_box_content">
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
				<textarea class="large-text" cols="50" rows="10" name="dp_options[single_ad_code4]"><?php echo esc_textarea( $dp_options['single_ad_code4'] ); ?></textarea>
			</div>
			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
				<div class="image_box cf">
					<div class="cf cf_media_field hide-if-no-js single_ad_image4">
						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image4'] ); ?>" name="dp_options[single_ad_image4]" class="cf_media_id">
						<div class="preview_field"><?php if ( $dp_options['single_ad_image4'] ) { echo wp_get_attachment_image( $dp_options['single_ad_image4'], 'medium' ); } ?></div>
						<div class="button_area">
							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image4'] ) { echo 'hidden'; } ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="theme_option_content">
				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[single_ad_url4]" value="<?php echo esc_attr( $dp_options['single_ad_url4'] ); ?>">
				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div>
	</div><!-- END .sub_box -->
</div><!-- END .theme_option_field -->
<?php // スマホ専用広告の登録 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Mobile device banner setup', 'tcd-w' ); ?></h3>
	<p><?php _e( 'This banner will be displayed on mobile device.', 'tcd-w' ); ?></p>
	<div class="theme_option_content">
		<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
		<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
		<textarea class="large-text" cols="50" rows="10" name="dp_options[single_mobile_ad_code1]"><?php echo esc_textarea( $dp_options['single_mobile_ad_code1'] ); ?></textarea>
	</div>
	<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );?></p>
	<div class="theme_option_content">
		<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); ?></h4>
		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js single_mobile_ad_image1">
				<input type="hidden" value="<?php echo esc_attr( $dp_options['single_mobile_ad_image1'] ); ?>" name="dp_options[single_mobile_ad_image1]" class="cf_media_id">
				<div class="preview_field"><?php if ( $dp_options['single_mobile_ad_image1'] ) { echo wp_get_attachment_image( $dp_options['single_mobile_ad_image1'], 'medium' ); } ?></div>
				<div class="buttton_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_mobile_ad_image1'] ) { echo 'hidden'; } ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="theme_option_content">
		<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
		<input class="regular-text" type="text" name="dp_options[single_mobile_ad_url1]" value="<?php echo esc_attr( $dp_options['single_mobile_ad_url1'] ); ?>">
		<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div>

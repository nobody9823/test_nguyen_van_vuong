<?php
global $dp_options, $dp_default_options, $header_content_type_options, $post_slider_division_options, $media_slider_division_options, $media_slider_media_type_options, $slide_time_options, $list_type_options, $post_order_options;
if ( ! $dp_options ) $dp_options = get_design_plus_option();
?>
<?php // ヘッダーコンテンツの設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Header content setting', 'tcd-w' ); ?></h3>
	<h4 class="theme_option_headline2"><?php _e( 'Header content type', 'tcd-w' ); ?></h4>
	<fieldset class="cf select_type2 header_content_type_radios">
		<?php foreach ( $header_content_type_options as $option ) : ?>
		<p><label><input type="radio" name="dp_options[header_content_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['header_content_type'], $option['value'] ); ?>><?php echo $option['label']; ?></label></p>
		<?php endforeach; ?>
	</fieldset>
	<div class="header_content-type1" style="<?php if ( $dp_options['header_content_type'] == 'type1' ) { echo 'display:block;'; } else { echo 'display:none;'; } ?>">
		<h4 class="theme_option_headline2"><?php _e( 'Number of divisions per slide', 'tcd-w' ); ?></h4>
		<fieldset class="cf select_type2">
			<?php foreach ( $post_slider_division_options as $option ) : ?>
			<label><input type="radio" name="dp_options[post_slider_division]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['post_slider_division'], $option['value'] ); ?>><?php echo $option['label']; ?></label>
			<?php endforeach; ?>
		</fieldset>
		<h4 class="theme_option_headline2"><?php _e( 'Type of posts', 'tcd-w' ); ?></h4>
		<fieldset class="cf select_type2">
			<?php foreach ( $list_type_options as $option ) : ?>
			<label><input type="radio" name="dp_options[header_blog_list_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['header_blog_list_type'], $option['value'] ); ?>><?php echo $option['label']; ?><?php
				if ( 'type1' == $option['value'] ) :
					echo '&nbsp;&nbsp;';
					wp_dropdown_categories( array(
						'class' => '',
						'echo' => 1,
						'hide_empty' => 0,
						'hierarchical' => 1,
						'id' => 'header_blog_category',
						'name' => 'dp_options[header_blog_category]',
						'selected' => $dp_options['header_blog_category'],
						'show_count' => 0,
						'value_field' => 'term_id'
					) );
				endif;
			?></label>
			<?php endforeach; ?>
		</fieldset>
		<h4 class="theme_option_headline2"><?php _e( 'Number of slides', 'tcd-w' ); ?></h4>
		<input type="number" class="small-text" name="dp_options[header_blog_slide_num]" value="<?php echo esc_attr( $dp_options['header_blog_slide_num'] ); ?>" min="1">
		<h4 class="theme_option_headline2"><?php _e( 'Post order', 'tcd-w' ); ?></h4>
		<select name="dp_options[header_blog_post_order]">
			<?php foreach ( $post_order_options as $option ) : ?>
			<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_blog_post_order'] ); ?>><?php echo $option['label']; ?></option>
			<?php endforeach; ?>
		</select>
		<h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
		<p><?php _e( 'Title font size', 'tcd-w' ); ?> <input type="number" class="small-text" name="dp_options[header_blog_title_font_size]" value="<?php echo esc_attr( $dp_options['header_blog_title_font_size'] ); ?>" min="1"> px </p>
		<p><?php _e( 'Title font size for mobile', 'tcd-w' ); ?> <input type="number" class="small-text" name="dp_options[header_blog_title_font_size_mobile]" value="<?php echo esc_attr( $dp_options['header_blog_title_font_size_mobile'] ); ?>" min="1"> px</p>
		<p><label><input name="dp_options[show_header_blog_category]" type="checkbox" value="1" <?php checked( $dp_options['show_header_blog_category'], 1 ); ?>><?php _e( 'Display category', 'tcd-w' ); ?></label></p>
		<p><label><input name="dp_options[show_header_blog_author]" type="checkbox" value="1" <?php checked( $dp_options['show_header_blog_author'], 1 ); ?>><?php _e( 'Display author', 'tcd-w' ); ?></label></p>
		<p><label><input name="dp_options[show_header_blog_date]" type="checkbox" value="1" <?php checked( $dp_options['show_header_blog_date'], 1 ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></p>
		<p><label><input name="dp_options[show_header_blog_views]" type="checkbox" value="1" <?php checked( $dp_options['show_header_blog_views'], 1 ); ?>><?php _e( 'Display views', 'tcd-w' ); ?></label></p>
		<h4 class="theme_option_headline2"><?php _e( 'Native advertisement setting', 'tcd-w' ); ?></h4>
		<div class="theme_option_message">
			<p><?php _e( 'Display ads that are registered in native advertisement settings.', 'tcd-w' ); ?></p>
		</div>
		<p><label><input name="dp_options[show_header_blog_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['show_header_blog_native_ad'], 1 ); ?>><?php _e( 'Display native advertisement', 'tcd-w' ); ?></label></p>
		<h4 class="theme_option_headline2"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></h4>
		<div class="theme_option_message">
			<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
		</div>
		<input type="number" class="small-text" name="dp_options[header_blog_native_ad_position]" value="<?php echo esc_attr( $dp_options['header_blog_native_ad_position'] ); ?>" min="1">
	</div>
	<div class="header_content-type2" style="<?php echo $dp_options['header_content_type'] == 'type2' ? 'display:block;' : 'display:none;'; ?>">
		<h4 class="theme_option_headline2"><?php _e( 'Number of divisions per slide', 'tcd-w' ); ?></h4>
		<fieldset class="cf select_type2 media_slider_division_radios" style="margin-bottom: 30px;">
			<?php foreach ( $media_slider_division_options as $option ) : ?>
			<label><input type="radio" name="dp_options[media_slider_division]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['media_slider_division'], $option['value'] ); ?>><?php echo $option['label']; ?></label>
			<?php endforeach; ?>
		</fieldset>
		<?php for ( $i = 1; $i <= 9; $i++ ) : ?>
		<div class="sub_box cf"<?php if ( $i > $dp_options['media_slider_division'] * 3 ) echo ' style="display: none;"'; ?>>
			<h3 class="theme_option_subbox_headline"><?php printf( __( 'Slider%s setting', 'tcd-w' ), $i ); ?></h3>
			<div class="sub_box_content">
				<?php if ( $i <= 3 ) : ?>
				<h4 class="theme_option_headline2 media_slider_division-1"><?php _e( 'Media type', 'tcd-w' ); ?></h4>
				<fieldset class="cf select_type2 slider_media_type_radios media_slider_division-1">
					<?php foreach ( $media_slider_media_type_options as $option ) : ?>
					<label><input type="radio" name="dp_options[slider_media_type<?php echo esc_attr( $i ); ?>]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['slider_media_type' . $i], $option['value'] ); ?>><?php echo $option['label']; ?></label>
					<?php endforeach; ?>
				</fieldset>
				<div class="slider_media-type1"<?php if ( 'type1' != $dp_options['slider_media_type' . $i] ) echo ' style="display: none;"'; ?>>
					<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
					<p class="media_slider_division-1"<?php if ( 'type1' != $dp_options['media_slider_division'] ) echo ' style="display: none;"'; ?>><?php _e( 'Recommend image size. Width:1450px or more, Height:600px or more', 'tcd-w' ); ?></p>
					<p class="media_slider_division-2 media_slider_division-3"<?php if ( 'type1' == $dp_options['media_slider_division'] ) echo ' style="display: none;"'; ?>><?php _e( 'Recommend image size. Width:600px, height:600px', 'tcd-w' ); ?></p>
					<div class="image_box cf">
						<div class="cf cf_media_field hide-if-no-js slider_image<?php echo esc_attr( $i ); ?>">
							<input type="hidden" value="<?php echo esc_attr( $dp_options['slider_image' . $i] ); ?>" name="dp_options[slider_image<?php echo esc_attr( $i ); ?>]" class="cf_media_id">
							<div class="preview_field"><?php if ( $dp_options['slider_image' . $i] ) { echo wp_get_attachment_image( $dp_options['slider_image' . $i], 'medium' ); } ?></div>
							<div class="button_area">
								<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
								<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['slider_image' . $i] ) { echo 'hidden'; } ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="slider_media-type2"<?php if ( 'type2' != $dp_options['slider_media_type' . $i] ) echo ' style="display: none;"'; ?>>
					<h4 class="theme_option_headline2"><?php _e( 'Video setting', 'tcd-w' ); ?></h4>
					<p><?php _e( 'Please upload MP4 format file.', 'tcd-w' ); ?></p>
					<div class="image_box cf">
						<div class="cf cf_video_field hide-if-no-js slider_video<?php echo esc_attr( $i ); ?>">
							<input type="hidden" value="<?php echo esc_attr( $dp_options['slider_video' . $i] ); ?>" name="dp_options[slider_video<?php echo esc_attr( $i ); ?>]" class="cf_media_id">
							<div class="preview_field"><?php if ( $dp_options['slider_video' . $i] && wp_get_attachment_url( $dp_options['slider_video' . $i] ) ) { echo '<p class="media_url">' . wp_get_attachment_url( $dp_options['slider_video' . $i] ) . '</p>'; } ?></div>
							<div class="buttton_area">
								<input type="button" value="<?php _e( 'Select Video', 'tcd-w' ); ?>" class="cfvf-select-video button">
								<input type="button" value="<?php _e( 'Remove Video', 'tcd-w' ); ?>" class="cfvf-delete-video button <?php if ( ! $dp_options['slider_video' . $i] ) { echo 'hidden'; } ?>">
							</div>
						</div>
					</div>
					<h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
					<p><?php _e( 'This image will be displayed instead of video in smartphone.<br /> Also this image will be displayed in the browser which MP4 video is not supported.', 'tcd-w' ); ?></p>
					<p><?php _e( 'Recommend image size. Width:1450px or more, Height:600px or more', 'tcd-w' ); ?></p>
					<div class="image_box cf">
						<div class="cf cf_media_field hide-if-no-js slider_video_image<?php echo esc_attr( $i ); ?>">
							<input type="hidden" value="<?php echo esc_attr( $dp_options['slider_video_image' . $i] ); ?>" name="dp_options[slider_video_image<?php echo esc_attr( $i ); ?>]" class="cf_media_id">
							<div class="preview_field"><?php if ( $dp_options['slider_video_image' . $i] ) { echo wp_get_attachment_image( $dp_options['slider_video_image' . $i], 'medium' ); } ?></div>
							<div class="button_area">
								<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
								<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['slider_video_image' . $i] ) { echo 'hidden'; } ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="slider_media-type3"<?php if ( 'type3' != $dp_options['slider_media_type' . $i] ) echo ' style="display: none;"'; ?>>
					<h4 class="theme_option_headline2"><?php _e( 'Youtube setting', 'tcd-w' ); ?></h4>
					<p><?php _e( 'Please enter Youtube URL.', 'tcd-w' ); ?></p>
					<input class="regular-text" type="text" name="dp_options[slider_youtube_url<?php echo esc_attr( $i ); ?>]" value="<?php echo esc_attr( $dp_options['slider_youtube_url' . $i] ); ?>">
					<h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
					<p><?php _e( 'This image will be displayed instead of Youtube video in smartphone.', 'tcd-w' ); ?></p>
					<p><?php _e( 'Recommend image size. Width:1450px or more, Height:600px or more', 'tcd-w' ); ?></p>
					<div class="image_box cf">
						<div class="cf cf_media_field hide-if-no-js slider_youtube_image<?php echo esc_attr( $i ); ?>">
							<input type="hidden" value="<?php echo esc_attr( $dp_options['slider_youtube_image' . $i] ); ?>" name="dp_options[slider_youtube_image<?php echo esc_attr( $i ); ?>]" class="cf_media_id">
							<div class="preview_field"><?php if ( $dp_options['slider_youtube_image' . $i] ) { echo wp_get_attachment_image( $dp_options['slider_youtube_image' . $i], 'medium' ); } ?></div>
							<div class="button_area">
								<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
								<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['slider_youtube_image' . $i] ) { echo 'hidden'; } ?>">
							</div>
						</div>
					</div>
				</div>
				<?php else : ?>
				<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
				<p class="media_slider_division-1"<?php if ( 'type1' != $dp_options['media_slider_division'] ) echo ' style="display: none;"'; ?>><?php _e( 'Recommend image size. Width:1450px or more, Height:600px or more', 'tcd-w' ); ?></p>
				<p class="media_slider_division-2 media_slider_division-3"<?php if ( 'type1' == $dp_options['media_slider_division'] ) echo ' style="display: none;"'; ?>><?php _e( 'Recommend image size. Width:600px, height:600px', 'tcd-w' ); ?></p>
				<div class="image_box cf">
					<div class="cf cf_media_field hide-if-no-js slider_image<?php echo esc_attr( $i ); ?>">
						<input type="hidden" value="<?php echo esc_attr( $dp_options['slider_image' . $i] ); ?>" name="dp_options[slider_image<?php echo esc_attr( $i ); ?>]" class="cf_media_id">
						<div class="preview_field"><?php if ( $dp_options['slider_image' . $i] ) { echo wp_get_attachment_image( $dp_options['slider_image' . $i], 'medium' ); } ?></div>
						<div class="button_area">
							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['slider_image' . $i] ) { echo 'hidden'; } ?>">
						</div>
					</div>
				</div>
				<?php endif; ?>
				<h4 class="theme_option_headline2"><?php _e( 'Catchphrase / Description', 'tcd-w' ); ?></h4>
				<p class="display_slider_headline"><label><input type="checkbox" name="dp_options[display_slider_headline<?php echo $i; ?>]" value="1" <?php checked( $dp_options['display_slider_headline' . $i], 1 ); ?>><?php _e( 'Display catchphrase', 'tcd-w' ); ?></label></p>
				<div<?php if ( ! $dp_options['display_slider_headline' . $i] ) echo ' style="display: none;"' ?>>
					<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
					<textarea rows="2" class="large-text" name="dp_options[slider_headline<?php echo $i; ?>]"><?php echo esc_textarea( $dp_options['slider_headline' . $i] ); ?></textarea>
					<p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="small-text" name="dp_options[slider_headline_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['slider_headline_font_size' . $i] ); ?>" min="1"> <span>px</span></p>
					<p><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" class="small-text" name="dp_options[slider_headline_font_size_mobile<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['slider_headline_font_size_mobile' . $i] ); ?>" min="1"> <span>px</span></p>
					<h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
					<textarea rows="4" class="large-text" name="dp_options[slider_desc<?php echo $i; ?>]"><?php echo esc_textarea( $dp_options['slider_desc' . $i] ); ?></textarea>
					<p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="small-text" name="dp_options[slider_desc_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['slider_desc_font_size' . $i] ); ?>" min="1"> <span>px</span></p>
					<p><?php _e( 'Font size for mobile', 'tcd-w' ); ?> <input type="number" class="small-text" name="dp_options[slider_desc_font_size_mobile<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['slider_desc_font_size_mobile' . $i] ); ?>" min="1"> <span>px</span></p>
					<h4 class="theme_option_headline2"><?php _e( 'Font color', 'tcd-w' ); ?></h4>
					<input class="c-color-picker" name="dp_options[slider_font_color<?php echo $i; ?>]" type="text" value="<?php echo esc_attr( $dp_options['slider_font_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['slider_font_color' . $i] ); ?>">
					<h4 class="theme_option_headline2"><?php _e( 'Dropshadow', 'tcd-w' ); ?></h4>
					<table>
						<tr>
							<td><label><?php _e( 'Dropshadow position (left)', 'tcd-w' ); ?></label></td>
							<td><input type="number" class="small-text" name="dp_options[slider<?php echo $i; ?>_shadow1]" value="<?php echo esc_attr( $dp_options['slider' . $i . '_shadow1'] ); ?>" min="0"><span>px</span></td>
						</tr>
						<tr>
							<td><label><?php _e( 'Dropshadow position (top)', 'tcd-w' ); ?></label></td>
							<td><input type="number" class="small-text" name="dp_options[slider<?php echo $i; ?>_shadow2]" value="<?php echo esc_attr( $dp_options['slider' . $i . '_shadow2'] ); ?>" min="0"><span>px</span></td>
						</tr>
						<tr>
							<td><label><?php _e( 'Dropshadow size', 'tcd-w' ); ?></label></td>
							<td><input type="number" class="small-text" name="dp_options[slider<?php echo $i; ?>_shadow3]" value="<?php echo esc_attr( $dp_options['slider' . $i . '_shadow3'] ); ?>" min="0"><span>px</span></td>
						</tr>
						<tr>
							<td><?php _e( 'Dropshadow color', 'tcd-w' ); ?></td>
							<td><input class="c-color-picker" name="dp_options[slider<?php echo $i; ?>_shadow_color]" type="text" value="<?php echo esc_attr( $dp_options['slider' . $i . '_shadow_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['slider' . $i . '_shadow_color'] ); ?>"></td>
						</tr>
					</table>
				</div>
				<h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
				<p class="display_slider_overlay"><label><input type="checkbox" name="dp_options[display_slider_overlay<?php echo $i; ?>]" value="1" <?php checked( $dp_options['display_slider_overlay' . $i], 1 ); ?>><?php _e( 'Display overlay', 'tcd-w' ); ?></label></p>
				<div<?php if ( ! $dp_options['display_slider_overlay' . $i] ) echo ' style="display: none;"' ?>>
					<h4 class="theme_option_headline2"><?php _e( 'Color of overlay', 'tcd-w' ); ?></h4>
					<input class="c-color-picker" name="dp_options[slider_overlay_color<?php echo $i; ?>]" type="text" value="<?php echo esc_attr( $dp_options['slider_overlay_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['slider_overlay_color' . $i] ); ?>">
					<p><?php _e( 'Please enter the number 0 - 1.0. (e.g. 0.5)', 'tcd-w' ); ?></p>
					<input type="number" class="small-text" name="dp_options[slider_overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['slider_overlay_opacity' . $i] ); ?>" min="0" max="1" step="0.1">
				</div>
				<h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
				<p class="display_slider_button"><label><input type="checkbox" name="dp_options[display_slider_button<?php echo $i; ?>]" value="1" <?php checked( $dp_options['display_slider_button' . $i], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
				<div<?php if ( ! $dp_options['display_slider_button' . $i] ) echo ' style="display: none;"' ?>>
					<h4 class="theme_option_headline2"><?php _e( 'Button setting', 'tcd-w' ); ?></h4>
					<table>
						<tr>
							<td><label for="dp_options[slider_button_label<?php echo $i; ?>]"><?php _e( 'Button label', 'tcd-w' ); ?></label></td>
							<td><input type="text" id="dp_options[slider_button_label<?php echo $i; ?>]" name="dp_options[slider_button_label<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['slider_button_label' . $i] ); ?>"></td>
						</tr>
						<tr>
							<td><label><?php _e( 'Font color', 'tcd-w' ); ?></label></td>
							<td><input class="c-color-picker" name="dp_options[slider_button_font_color<?php echo $i; ?>]" type="text" value="<?php echo esc_attr( $dp_options['slider_button_font_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['slider_button_font_color' . $i] ); ?>"></td>
						</tr>
						<tr>
							<td><label><?php _e( 'Background color', 'tcd-w' ); ?></label></td>
							<td><input class="c-color-picker" name="dp_options[slider_button_bg_color<?php echo $i; ?>]" type="text" value="<?php echo esc_attr( $dp_options['slider_button_bg_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['slider_button_bg_color' . $i] ); ?>"></td>
						</tr>
						<tr>
							<td><label><?php _e( 'Font hover color', 'tcd-w' ); ?></label></td>
							<td><input class="c-color-picker" name="dp_options[slider_button_font_color_hover<?php echo $i; ?>]" type="text" value="<?php echo esc_attr( $dp_options['slider_button_font_color_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['slider_button_font_color_hover' . $i] ); ?>"></td>
						</tr>
						<tr>
							<td><label><?php _e( 'Background hover color', 'tcd-w' ); ?></label></td>
							<td><input class="c-color-picker" name="dp_options[slider_button_bg_color_hover<?php echo $i; ?>]" type="text" value="<?php echo esc_attr( $dp_options['slider_button_bg_color_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['slider_button_bg_color_hover' . $i] ); ?>"></td>
						</tr>
					</table>
				</div>
				<h4 class="theme_option_headline2"><?php _e( 'Link URL', 'tcd-w' ); ?></h4>
				<input class="regular-text" type="text" name="dp_options[slider_url<?php echo esc_attr( $i ); ?>]" value="<?php echo esc_attr( $dp_options['slider_url' . $i] ); ?>">
				<p><label><input name="dp_options[slider_target<?php echo esc_attr( $i ); ?>]" type="checkbox" value="1" <?php checked( 1, $dp_options['slider_target' . $i] ); ?>><?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
				<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
			</div>
		</div>
		<?php endfor; ?>
	</div>
	<h4 class="theme_option_headline2"><?php _e( 'Slide speed', 'tcd-w' ); ?></h4>
	<select name="dp_options[slide_time]">
		<?php foreach ( $slide_time_options as $option ) : ?>
		<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['slide_time'] ); ?>><?php echo esc_html( $option['label'] ); ?><?php _e( ' seconds', 'tcd-w' ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
</div>
<?php // カルーセルスライダーの設定 ?>
<div class="theme_option_field cf">
	<h3 class="theme_option_headline"><?php _e( 'Carousel slider setting', 'tcd-w' ); ?></h3>
	<p><label><input name="dp_options[show_header_carousel]" type="checkbox" value="1" <?php checked( 1, $dp_options['show_header_carousel'] ); ?>><?php _e( 'Display Carousel slider', 'tcd-w' ); ?></label></p>
	<h4 class="theme_option_headline2"><?php _e( 'Type of posts', 'tcd-w' ); ?></h4>
	<fieldset class="cf select_type2">
		<?php foreach ( $list_type_options as $option ) : ?>
		<label><input type="radio" name="dp_options[header_carousel_list_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $dp_options['header_carousel_list_type'], $option['value'] ); ?>><?php echo $option['label']; ?><?php
			if ( 'type1' == $option['value'] ) :
				echo '&nbsp;&nbsp;';
				wp_dropdown_categories( array(
					'class' => '',
					'echo' => 1,
					'hide_empty' => 0,
					'hierarchical' => 1,
					'id' => 'header_carousel_category',
					'name' => 'dp_options[header_carousel_category]',
					'selected' => $dp_options['header_carousel_category'],
					'show_count' => 0,
					'value_field' => 'term_id'
				) );
			endif;
		?></label>
		<?php endforeach; ?>
	</fieldset>
	<h4 class="theme_option_headline2"><?php _e( 'Number of slides', 'tcd-w' ); ?></h4>
	<input type="number" class="small-text" name="dp_options[header_carousel_slide_num]" value="<?php echo esc_attr( $dp_options['header_carousel_slide_num'] ); ?>" min="1">
	<h4 class="theme_option_headline2"><?php _e( 'Post order', 'tcd-w' ); ?></h4>
	<select name="dp_options[header_carousel_post_order]">
		<?php foreach ( $post_order_options as $option ) : ?>
		<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_carousel_post_order'] ); ?>><?php echo $option['label']; ?></option>
		<?php endforeach; ?>
	</select>
	<h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
	<p><?php _e( 'Title font size', 'tcd-w' ); ?> <input type="number" class="small-text" name="dp_options[header_carousel_title_font_size]" value="<?php echo esc_attr( $dp_options['header_carousel_title_font_size'] ); ?>" min="1"> px </p>
	<p><?php _e( 'Title font size for mobile', 'tcd-w' ); ?> <input type="number" class="small-text" name="dp_options[header_carousel_title_font_size_mobile]" value="<?php echo esc_attr( $dp_options['header_carousel_title_font_size_mobile'] ); ?>" min="1"> px </p>
	<p><label><input name="dp_options[show_header_carousel_date]" type="checkbox" value="1" <?php checked( $dp_options['show_header_carousel_date'], 1 ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></p>
	<p><label><input name="dp_options[show_header_carousel_views]" type="checkbox" value="1" <?php checked( $dp_options['show_header_carousel_views'], 1 ); ?>><?php _e( 'Display views', 'tcd-w' ); ?></label></p>
	<h4 class="theme_option_headline2"><?php _e( 'Native advertisement setting', 'tcd-w' ); ?></h4>
	<div class="theme_option_message">
		<p><?php _e( 'Display ads that are registered in native advertisement settings.', 'tcd-w' ); ?></p>
	</div>
	<p><label><input name="dp_options[show_header_carousel_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['show_header_carousel_native_ad'], 1 ); ?>><?php _e( 'Display native advertisement', 'tcd-w' ); ?></label></p>
	<h4 class="theme_option_headline2"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></h4>
	<div class="theme_option_message">
		<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
	</div>
	<input type="number" class="small-text" name="dp_options[header_carousel_native_ad_position]" value="<?php echo esc_attr( $dp_options['header_carousel_native_ad_position'] ); ?>" min="1">
	<h4 class="theme_option_headline2"><?php _e( 'Slide speed', 'tcd-w' ); ?></h4>
	<select name="dp_options[header_carousel_slide_time]">
		<?php foreach ( $slide_time_options as $option ) : ?>
		<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_carousel_slide_time'] ); ?>><?php echo esc_html( $option['label'] ); ?><?php _e( ' seconds', 'tcd-w' ); ?></option>
		<?php endforeach; ?>
	</select>
	<h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
	<input class="c-color-picker" name="dp_options[header_carousel_bg_color]" type="text" value="<?php echo esc_attr( $dp_options['header_carousel_bg_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_carousel_bg_color'] ); ?>">
	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
</div>
<?php
// コンテンツビルダー
cb_inputs();
?>

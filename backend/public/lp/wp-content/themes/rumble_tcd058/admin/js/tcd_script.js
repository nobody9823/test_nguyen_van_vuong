jQuery(function($){

	// ローカライズメッセージ未設定時
	if (!window.TCD_MESSAGES) {
		TCD_MESSAGES = {
			ajaxSubmitSuccess: 'Settings Saved Successfully',
			ajaxSubmitError: 'Can not save data. Please try again.'
		};
	}

	// テーマオプション AJAX保存
	$('#tcd_theme_option').on('click', '.ajax_button', function() {
		var $button = $('.button-ml');
		$('#saveMessage').hide();
		$('#saving_data').show();
		if (window.tinyMCE) {
			tinyMCE.triggerSave(); // tinymceを利用しているフィールドのデータを保存
		}
		$('#tcd_theme_option form').ajaxSubmit({
			beforeSend: function() {
				$button.attr('disabled', true); // ボタンを無効化し、二重送信を防止
			},
			complete: function() {
				$button.attr('disabled', false);; // ボタンを有効化し、再送信を許可
			},
			success: function(){
				$('#saving_data').hide();
				$('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
				$('#saveMessage').append('<p>' + TCD_MESSAGES.ajaxSubmitSuccess + '</p>').show();
				setTimeout(function() {
					$('#saveMessage:not(:hidden, :animated)').fadeOut();
				}, 3000);
			},
			error: function() {
				$('#saving_data').hide();
				alert(TCD_MESSAGES.ajaxSubmitError);
			},
			timeout: 10000
		});
		return false;
	});
	$('#tcd_theme_option').on('click', '#saveMessage', function(){
		$('#saveMessage:not(:hidden, :animated)').fadeOut(300);
	});

	// アコーディオンの開閉
	$('.theme_option_field').on('click', '.theme_option_subbox_headline', function(){
		$(this).closest('.sub_box').toggleClass('active');
		return false;
	});

	// theme option tab
	$('#tcd_theme_option').cookieTab({
		tabMenuElm: '#theme_tab',
		tabPanelElm: '#tab-panel'
	});

	// ロゴに画像を使うかテキストを使うか選択
	$('#logo_type_select :radio').change(function(){
		if (this.checked) {
			if (this.value == 'yes') {
				$('.logo_text_area').hide();
				$('.logo_image_area').show();
			} else {
				$('.logo_text_area').show();
				$('.logo_image_area').hide();
			}
		}
	});

	// ヘッダーコンテンツのタイプ
	$('.header_content_type_radios :radio').change(function() {
		if (this.checked) {
			var $closest = $(this).closest('.theme_option_field');
			$closest.find('[class*=header_content-type]').hide();
			$closest.find('.header_content-'+ this.value).show();
		}
	}).trigger('change');

	// 画像スライダー スライド分割ラジオ
	$('.media_slider_division_radios :radio').change(function() {
		if (this.checked) {
			var $closest = $(this).closest('.theme_option_field');
			$closest.find('.sub_box').hide().filter(':lt('+this.value*3+')').show();

			$closest.find('[class*=media_slider_division-]').hide();
			$closest.find('.media_slider_division-'+ this.value).show();

			if (this.value != 1) {
				// スライドメディアタイプラジオを画像に強制変更
				$closest.find('.slider_media_type_radios :radio[value="type1"]').attr('checked', 'checked').trigger('change');
			}
		}
	}).trigger('change');

	// 画像スライダー スライドメディアタイプラジオ
	$('.slider_media_type_radios :radio').change(function() {
		if (this.checked) {
			$(this).closest('.sub_box').find('[class*=slider_media-type]').hide();
			$(this).closest('.sub_box').find('.slider_media-'+ this.value).show();
		}
	}).trigger('change');

	// 画像スライダー キャッチフレーズ表示
	$('.display_slider_headline input:checkbox').change(function(event) {
		if (this.checked) {
			$(this).closest('.display_slider_headline').next().show();
		} else {
			$(this).closest('.display_slider_headline').next().hide();
		}
	}).trigger('change');

	// 画像スライダー オーバーレイ表示
	$('.display_slider_overlay input:checkbox').change(function(event) {
		if (this.checked) {
			$(this).closest('.display_slider_overlay').next().show();
		} else {
			$(this).closest('.display_slider_overlay').next().hide();
		}
	}).trigger('change');

	// 画像スライダー ボタン表示
	$('.display_slider_button input:checkbox').change(function(event) {
		if (this.checked) {
			$(this).closest('.display_slider_button').next().show();
		} else {
			$(this).closest('.display_slider_button').next().hide();
		}
	}).trigger('change');

	// WordPress Color Picker
	$('.c-color-picker').wpColorPicker();

	// load color 2
	$('#js-load_icon').change(function() {
		if ('type2' === this.value) {
			$('.js-load_color2').show();
		} else {
			$('.js-load_color2').hide();
		}
	}).trigger('change');

	// Googleマップ
	$('#gmap_marker_type_button_type2').click(function () {
		$('#gmap_marker_type2_area').show();
	});
	$('#gmap_marker_type_button_type1').click(function () {
		$('#gmap_marker_type2_area').hide();
	});
	$('#gmap_custom_marker_type_button_type1').click(function () {
		$('#gmap_custom_marker_type1_area').show();
		$('#gmap_custom_marker_type2_area').hide();
	});
	$('#gmap_custom_marker_type_button_type2').click(function () {
		$('#gmap_custom_marker_type1_area').hide();
		$('#gmap_custom_marker_type2_area').show();
	});

	// メガメニューBの場合のみネイティブ広告表示設定
	$('.js-megamenu').change(function() {
		if ('type3' === $(this).val()) {
			$(this).siblings('label').show();
		} else {
			$(this).siblings('label').hide();
		}
	}).trigger('change');

	// Archive slider list type
	$('#js-archive_slider_list_type :radio').change(function() {
		if (this.checked) {
			$('[class*=hide-archive_slider_list_type-type]').show();
			$('.hide-archive_slider_list_type-'+ this.value).hide();
		}
	}).trigger('change');

	// Archive slider type
	$('#js-archive_slider :radio').change(function() {
		if (this.checked) {
			$('[class*=archive_slider-type]').hide();
			$('.archive_slider-'+ this.value).show();
		}
	}).trigger('change');
});

jQuery(function($) {

	$(window).on('scroll', function() {
		// ヘッダーを固定する
		if ($(this).scrollTop() > 300) {
			$('#js-header').addClass('is-header-fixed');

			// グローバルナビゲーション PC レスポンシブOFF+固定ヘッダー
			// 横スクロールでposition:fixedの要素も横スクロールさせる
			if (!$('body').hasClass('is-responsive')) {
				$('#js-header .l-header__bar, .p-megamenu').css('left', $(this).scrollLeft() * -1);
			}
		} else {
			$('#js-header').removeClass('is-header-fixed');
			if (!$('body').hasClass('is-responsive')) {
				$('#js-header .l-header__bar, .p-megamenu').css('left', 0);
			}
		}
	});

});

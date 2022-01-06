jQuery(document).ready(function($){

	if ($('.pb-modal-edit-widget.pb-widget-attendance_table').size() == 0) return;

	// 列数変更
	$(document).on('change', '.pb-modal-edit-widget.pb-widget-attendance_table select.column_num', function(){
		var column_num = parseInt($(this).val());
		$(this).closest('.pb-modal-edit-widget').find('.column-filter').each(function(){
			if ($(this).attr('data-column') <= column_num) {
				if ($(this).is(':hidden')) {
					$(this).slideDown('fast');
				}
			} else {
				$(this).hide();
			}
		});
	});

	// 列見出し変更
	$(document).on('change keyup', '.pb-modal-edit-widget.pb-widget-attendance_table input.column_headline', function(){
		var column = parseInt($(this).closest('.column-filter').attr('data-column')) || 0;
		if (column) {
			$(this).closest('.pb-modal-edit-widget').find('.column_headline-' + column).text($(this).val());
		}
	});

});
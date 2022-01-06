jQuery(document).ready(function($){

  // アコーディオンの開閉
  $('.sub_box').on('click', '.theme_option_subbox_headline', function(){
    $(this).parents('.sub_box').toggleClass('active');
    return false;
  });

  // slider content type
  $(".slider_content_type :radio").change(function(){
    var $parent = $(this).parents('.sub_box');
    if ($(this).val() == 'type1') {
      $parent.find('.slider_content_type2, .slider_content_type3').hide();
      $parent.find('.slider_content_type1').show();
    } else if ($(this).val() == 'type2') {
      $parent.find('.slider_content_type1, .slider_content_type3').hide();
      $parent.find('.slider_content_type2').show();
    } else if ($(this).val() == 'type3') {
      $parent.find('.slider_content_type1, .slider_content_type2').hide();
      $parent.find('.slider_content_type3').show();
    }
  });

  // slider overlay
  $(".use_slider_overlay input:checkbox").click(function(event) {
   if ($(this).is(":checked")) {
    $(this).parents('.use_slider_overlay').next().show();
   } else {
    $(this).parents('.use_slider_overlay').next().hide();
   }
  });

  // slider caption
  $(".use_slider_caption input:checkbox").click(function(event) {
   if ($(this).is(":checked")) {
    $(this).parents('.use_slider_caption').next().show();
   } else {
    $(this).parents('.use_slider_caption').next().hide();
   }
  });

  // slider button
  $(".show_slider_caption_button input:checkbox").click(function(event) {
   if ($(this).is(":checked")) {
    $(this).parents('.show_slider_caption_button').next().show();
   } else {
    $(this).parents('.show_slider_caption_button').next().hide();
   }
  });

  // Googleマップ
  $("#gmap_marker_type_button_type2").click(function () {
    $("#gmap_marker_type2_area").show();
  });
  $("#gmap_marker_type_button_type1").click(function () {
    $("#gmap_marker_type2_area").hide();
  });
  $("#gmap_custom_marker_type_button_type1").click(function () {
    $("#gmap_custom_marker_type1_area").show();
    $("#gmap_custom_marker_type2_area").hide();
  });
  $("#gmap_custom_marker_type_button_type2").click(function () {
    $("#gmap_custom_marker_type1_area").hide();
    $("#gmap_custom_marker_type2_area").show();
  });

  // theme option tab
  $('#my_theme_option').cookieTab({
   tabMenuElm: '#theme_tab',
   tabPanelElm: '#tab-panel'
  });

  // custom field simple repeater add row
  $(".cf_simple_repeater_container a.button-add-row").click(function(){
    var clone = $(this).attr("data-clone");
    var $parent = $(this).closest(".cf_simple_repeater_container");
    if (clone && $parent.length) {
      $parent.find("table.cf_simple_repeater tbody").append(clone);
    }
    return false;
  });

  // custom field simple repeater delete row
  $("table.cf_simple_repeater").on("click", ".button-delete-row", function(){
    var del = true;
    var confirm_message = $(this).closest("table.cf_simple_repeater").attr("data-delete-confirm");
    if (confirm_message) {
      del = confirm(confirm_message);
    }
    if (del) {
      $(this).closest("tr").remove();
    }
    return false;
  });

  // custom field simple repeater sortable
  $('table.cf_simple_repeater-sortable tbody').sortable({
    handle: ".col-delete",
    helper: "clone",
    forceHelperSize: true,
    forcePlaceholderSize: true,
    distance: 10,
    start: function(event, ui) {
      $(ui.placeholder).height($(ui.helper).height());
    }
  });

  // フッターの固定メニュー --------------------------------------------------------------
  // アコーディオンの開閉
  $(".repeater").on("click", ".theme_option_subbox_headline", function() {
    $(this).parents(".sub_box").toggleClass("active");
    return false;
  });

  // ボタンの並び替え
  $(".sortable").sortable({
    placeholder: ".sortable-placeholder",
    helper: "clone",
    forceHelperSize: true,
    forcePlaceholderSize: true
  });

  // 新しいアイテムを追加する
  $(".repeater-wrapper").each(function() {
    var next_index = $(this).find(".repeater-item").last().index();
    $(this).find(".button-add-row").click(function() {
      var clone = $(this).attr("data-clone");
      var $parent = $(this).closest(".repeater-wrapper");
      if (clone && $parent.size()) { 
        next_index++;
        clone = clone.replace(/addindex/g, next_index);
        $parent.find(".repeater").append(clone.replace(/addindex/g, next_index));
      }
      return false;
    });
  });

  // アイテムを削除する
  $(".repeater").on("click", ".button-delete-row", function() {
    var del = true;
    var confirm_message = $(this).closest(".repeater").attr("data-delete-confirm");
    if (confirm_message) {
      del = confirm(confirm_message);
    }
    if (del) {
      $(this).closest(".repeater-item").remove();
    }
    return false;
  });

  // ボタンのタイプによって、表示フィールドを切り替える
  $(".repeater").each(function() {
    $(this).on("change", ".footer-bar-type select", function() {
      var sub_box = $(this).parents(".sub_box");
      var target = sub_box.find(".footer-bar-target");
      var url = sub_box.find(".footer-bar-url");
      var number = sub_box.find(".footer-bar-number");
      switch ($(this).val()) {
        case "type1" :
          target.show();
          url.show();
          number.hide();
          break;
        case "type2" :
          target.hide();
          url.hide();
          number.hide();
          break;
        case "type3" :
          target.hide();
          url.hide();
          number.show();
        break;
      }
    });
  });

  // リピーター ボタン名
  $(document).on('change keyup', '.repeater .repeater-label', function(){
    $(this).closest('.repeater-item').find('.theme_option_subbox_headline').text($(this).val());
  });

});
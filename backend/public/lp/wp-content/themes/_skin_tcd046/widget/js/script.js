jQuery(document).ready(function($) {
  if($('body').hasClass('widgets-php')) {

    $(document).on('click', '.ml_ad_widget_headline', function(){
      $(this).toggleClass('active');
      $(this).next('.ml_ad_widget_box').toggleClass('open');
    });

    $(document).on('click', '.tcd_toggle_widget_headline', function(){
      $(this).toggleClass('active');
      $(this).next('.tcd_toggle_widget_box').toggleClass('open');
    });

  }
});
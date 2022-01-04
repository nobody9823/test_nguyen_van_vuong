jQuery(document).ready(function($){

  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $("a.target_blank").attr("target","_blank");

  $("#return_top a").click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, "easeOutExpo");
    return false;
  });

  //return top button
  var topBtn = $("#return_top");
  $(window).scroll(function () {
    var scrTop = $(this).scrollTop();
    if (scrTop > 100) {
      topBtn.stop().fadeIn("slow");
    } else {
      topBtn.stop().fadeOut();
    }
  });

  // blog archive category hover
  $("#post_list a span[data-href]").hover(
    function() {
      var $a = $(this).closest("a");
      $a.attr("data-href", $a.attr("href"));
      if ($(this).attr("data-href")) {
        $a.attr("href", $(this).attr("data-href"));
      }
    },
    function() {
      var $a = $(this).closest("a");
      $a.attr("href", $a.attr("data-href"));
    }
  );

  //category widget
  $(".collapse_category_list li").hover(
    function(){
      $(">ul:not(:animated)",this).slideDown("fast");
      $(this).addClass("active");
    },
    function(){
       $(">ul",this).slideUp("fast");
       $(this).removeClass("active");
    }
  );

  //comment tab
  $("#trackback_switch").click(function(){
    $("#comment_switch").removeClass("comment_switch_active");
    $(this).addClass("comment_switch_active");
    $("#comment_area").animate({opacity: "hide"}, 0);
    $("#trackback_area").animate({opacity: "show"}, 1000);
    return false;
  });

  $("#comment_switch").click(function(){
    $("#trackback_switch").removeClass("comment_switch_active");
    $(this).addClass("comment_switch_active");
    $("#trackback_area").animate({opacity: "hide"}, 0);
    $("#comment_area").animate({opacity: "show"}, 1000);
    return false;
  });

  // mobile toggle global nav
  $(".menu_button").on("click", function(){
    if($(this).hasClass("active")) {
      $(this).removeClass("active");
      $("#header").removeClass("active");
      $("#global_menu").hide();
      return false;
    } else {
      $(this).addClass("active");
      $("#header").addClass("active");
      $("#global_menu").show();
      return false;
    };
  });

  // mobile global nav toggle children
  $("#global_menu li > ul").parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
  $("#global_menu .child_menu_button").on("click", function() {
    if($(this).parent().hasClass("open")) {
      $(this).parent().removeClass("open");
      return false;
    } else {
      $(this).parent().addClass("open");
      return false;
    };
  });

  // index content1
  if ($("#index_content1 .caption").length) {
    $(window).bind("resize orientationchange", function(){
      $("#index_content1 .caption").each(function(){
        var $caption = $(this);
        var $headline = $(this).find(".headline");
        var $desc = $(this).find(".desc");
        $headline.removeAttr("style");
        $desc.removeAttr("style");

        var body_width = $("body").width();
        var headline_font_size = parseFloat($headline.css("fontSize"));
        var desc_font_size = parseFloat($desc.css("fontSize"));
        var desc_line_height = parseFloat($desc.css("lineHeight"));
        if (body_width >= 768 && body_width < 1280) {
          var rasio = $("#index_content1").width() / 1150;
          $headline.css("fontSize", headline_font_size * rasio + "px")
          desc_font_size = desc_font_size * rasio;
          desc_line_height = desc_line_height * rasio;
          $desc.css({
            fontSize: desc_font_size + "px",
            lineHeight: desc_line_height + "px",
          });
        } else if (body_width < 375) {
          var rasio = $("#index_content1").width() / 331;
          $headline.css("fontSize", headline_font_size * rasio + "px")
          desc_font_size = desc_font_size * rasio;
          desc_line_height = desc_line_height * rasio;
          $desc.css({
            fontSize: desc_font_size + "px",
            lineHeight: desc_line_height + "px",
          });
        }

        var remain_height = $caption.innerHeight() - $desc.position().top;
        var desc_line_height_offset = 0;
        if (desc_line_height > desc_font_size) {
          desc_line_height_offset = (desc_line_height - desc_font_size) / 2;
        }
        if ($desc.height() > remain_height && desc_line_height > 0) {
          for (var i=1; i<=100; i++) {
            if (i*desc_line_height - desc_line_height_offset > remain_height) {
              $desc.css({
                maxHeight: (i-1) * desc_line_height + "px",
                overflow: "hidden",
              });
              break;
            }
          }
        }
      });
    });
  }
});
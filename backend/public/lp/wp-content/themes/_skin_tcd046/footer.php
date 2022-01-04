<?php global $header_slider, $template; $options = get_desing_plus_option(); ?>

 </div><!-- END #main_contents -->

 <?php if (!is_mobile() || is_no_responsive()) { ?>
 <?php if (is_active_sidebar('footer_widget')) { ?>

 <div id="footer_widget">
  <div class="footer_inner">
   <?php dynamic_sidebar('footer_widget'); ?>
  </div>
 </div>

 <?php } ?>
 <?php } else { ?>
 <?php if (is_active_sidebar('footer_widget_mobile')) { ?>

 <div id="footer_widget">
  <div class="footer_inner">
   <?php dynamic_sidebar('footer_widget_mobile'); ?>
  </div>
 </div>

 <?php } ?>
 <?php } ?>

 <div id="footer_top">
  <div class="footer_inner">

   <!-- footer logo -->
   <div id="footer_logo">
    <?php footer_logo(); ?>
   </div>

   <?php if ($options['footer_shopname']||$options['footer_address']||$options['footer_phonenumber']){ ?>
   <p id="footer_address">
    <?php if ($options['footer_shopname']){ ?><span class="mr10"><?php echo esc_html($options['footer_shopname']); ?></span><?php } ?>
    <?php if ($options['footer_address']){ echo is_mobile() ? nl2br( esc_html($options['footer_address']) ) : esc_html($options['footer_address']); } ?>
    <?php if ($options['footer_phonenumber']){ ?><span class="ml10"><?php echo esc_html($options['footer_phonenumber']); ?></span><?php } ?>
   </p>
   <?php } ?>

   <?php if ($options['show_rss'] || $options['twitter_url'] || $options['facebook_url'] || $options['insta_url']) { ?>
   <!-- social button -->
   <ul class="clearfix" id="footer_social_link">
    <?php if ($options['twitter_url']) : ?>
    <li class="twitter"><a href="<?php echo esc_url($options['twitter_url']); ?>" target="_blank">Twitter</a></li>
    <?php endif; ?>
    <?php if ($options['facebook_url']) : ?>
    <li class="facebook"><a href="<?php echo esc_url($options['facebook_url']); ?>" target="_blank">Facebook</a></li>
    <?php endif; ?>
    <?php if ($options['insta_url']) : ?>
    <li class="insta"><a href="<?php echo esc_url($options['insta_url']); ?>" target="_blank">Instagram</a></li>
    <?php endif; ?>
    <?php if ($options['show_rss']) : ?>
    <li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank">RSS</a></li>
    <?php endif; ?>
   </ul>
   <?php } ?>

  </div><!-- END #footer_top_inner -->
 </div><!-- END #footer_top -->

 <div id="footer_bottom">
  <div class="footer_inner">

   <p id="copyright"><span><?php _e('Copyright ', 'tcd-w'); ?></span>&copy; <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. All Rights Reserved.</p>

   <div id="return_top">
    <a href="#body"><span><?php _e('PAGE TOP', 'tcd-w'); ?></span></a>
   </div><!-- END #return_top -->

  </div><!-- END #footer_bottom_inner -->
 </div><!-- END #footer_bottom -->

<?php
      // footer menu for mobile device
      if( is_mobile() ) get_template_part('footer-bar');
?>

<?php if ($options['use_load_icon']) { ?>
</div><!-- #site_wrap -->
<?php } ?>

<script>

<?php if(is_mobile()) { ?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
<?php } ?>

jQuery(document).ready(function($){

<?php
      // トップページ スライダー
      if (is_front_page() && $header_slider) {
        $has_init_function = 'init_slider';
?>
  var init_slider = function(){
<?php if (!empty($header_slider['count']['video']) || !empty($header_slider['count']['youtube'])) { ?>
    $('#header_slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
      if ($('#header_slider .item').eq(currentSlide).find('.slider_video video').length) {
        $('#header_slider .item').eq(currentSlide).find('.slider_video video').get(0).pause();
      } else if ($('#header_slider .item').eq(currentSlide).find('.youtube_video_player').length) {
        $('#header_slider .item').eq(currentSlide).find('.youtube_video_player').YTPPause();
      }
    });

    $('#header_slider').on('afterChange', function(event, slick, currentSlide){
      if ($('#header_slider .item').eq(currentSlide).find('.slider_video video').length) {
        $('#header_slider .item').eq(currentSlide).find('.slider_video video').get(0).play();
        $('#header_slider').slick('slickPause');
      } else if ($('#header_slider .item').eq(currentSlide).find('.youtube_video_player').length) {
        $('#header_slider .item').eq(currentSlide).find('.youtube_video_player').YTPPlay();
        $('#header_slider').slick('slickPause');
      } else {
        $('#header_slider').slick('slickPlay');
      }
    });

<?php
        foreach ($header_slider as $i => $slider) {
          if (empty($slider['content_type'])) continue;

          // 動画
          if ($slider['content_type'] == 'type2' && !wp_is_mobile() && !empty($slider['video'])) {
?>
    $('#slider_video_<?php echo $i; ?>').vegas({
      timer: false,
      slides: [
        { <?php if (!empty($slider['image'][0])) { ?>src: '<?php echo esc_attr($slider['image'][0]); ?>',<?php } ?>
          video: {
            src: [ '<?php echo esc_attr($slider['video']); ?>'], loop: false, mute: true
          },
        }
      ],
      init: function(globalSettings){
        $('#slider_video_<?php echo $i; ?>').css('height', '100%');

        var video_timer = setInterval(function(){
          if ($('#slider_video_<?php echo $i; ?>').find('video').length) {
            clearTimeout(video_timer);
            var video = $('#slider_video_<?php echo $i; ?>').find('video').get(0);
            <?php if (!empty($slider['first_slide'])) { echo 'video.play();'; } ?>

            video.onended = function(e) {
              setTimeout(function(){
                $('#header_slider').slick('slickNext');
                $('#header_slider').slick('slickPlay');
                setTimeout(function(){
                  video.currentTime = 0;
                }, 500);
              }, 1000);
            }
          }
        } ,50);
      }
    });

<?php
          // Youtube
          } elseif ($slider['content_type'] == 'type3' && !wp_is_mobile() && !empty($slider['youtube_url'])) {
?>
     $('#slider_youtube_<?php echo $i; ?>').YTPlayer();
     $('#slider_youtube_<?php echo $i; ?>').on('YTPEnd',function(e){
       setTimeout(function(){
         $('#header_slider').slick('slickNext');
         $('#header_slider').slick('slickPlay');
       }, 1000);
     });

<?php
          }
        }
      }
?>

    $('#header_slider .item:first').addClass('first_active');

    $('#header_slider').slick({
      infinite: true,
      dots: true,
      arrows: true,
      prevArrow: '<button type="button" class="slick-prev">&#xe90f;</button>',
      nextArrow: '<button type="button" class="slick-next">&#xe910;</button>',
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: true,
      autoplay: <?php if (!empty($header_slider['autoplay'])) { echo 'true'; } else { echo 'false'; } ?>,
      fade: true,
      speed: 1000,
      autoplaySpeed: <?php if ($options['slider_time'] && is_numeric($options['slider_time'])) { echo intval($options['slider_time']); } else { echo 7000; } ?>
    });

    $('#header_slider').on('afterChange', function(event, slick, currentSlide){
      $('#header_slider .first_active').removeClass('first_active');
    });
  };

<?php
      // blog archive
      } elseif (is_home() || is_search() || basename($template) === 'index.php') {
        $has_init_function = 'init_list';
?>
  $('#post_list .article').css('opacity', 0);
  var init_list = function(){
    $('#post_list').imagesLoaded(function(){
      $('#post_list .article').each(function(i){
        var self = this;
        setTimeout(function(){
          $(self).animate({ opacity: 1 }, 150);
        }, i*150);
      });
    });
  };

<?php
      // course archive
      } elseif (is_post_type_archive('course') || is_tax('course_category')) {
        $has_init_function = 'init_list';
?>
  $('.course_category').hide();
  var init_list = function(){
    if (!$('.course_categories').length) {
      show_delaied_list('.course_category');
      return;
    }

    $('.course_categories a').click(function(){
      if ($(this).hasClass('active')) return false;
      $('.course_categories a.active').removeClass('active');
      $(this).addClass('active');
      $('.course_category').hide();
      show_delaied_list('.course_category-' + $(this).attr('data-cat-id'));
      return false;
    });

    var hash_catid = location.hash.match(/course_category\-(\d+)/i);
    if (hash_catid) {
      if ($('.course_categories a[data-cat-id=' + hash_catid[1] + ']').length) {
        $('.course_categories a.active').removeClass('active');
        $('.course_categories a[data-cat-id=' + hash_catid[1] + ']').addClass('active');
        show_delaied_list('.course_category-' + hash_catid[1]);
        return;
      }
    }

    if ($('.course_categories a.active').length) {
      show_delaied_list('.course_category-' + $('.course_categories a.active').attr('data-cat-id'));
    }
  };

  var show_delaied_list = function(el){
    $(el).find('.course').css('opacity', 0)
    $(el).show();
    $(el).find('.course').each(function(i){
      var self = this;
      setTimeout(function(){
        $(self).animate({ opacity: 1 }, 200);
      }, i*200);
    });
  };
<?php } ?>

<?php if ($options['use_load_icon']) { ?>
  function after_load() {
    $('#site_loader_animation').delay(300).fadeOut(600);
    $('#site_loader_overlay').delay(600).fadeOut(900<?php if (!empty($has_init_function)) echo ', '.$has_init_function; ?>);
    $('#site_wrap').css('display', 'block');

    $(window).trigger('resize');
  }

  $(window).load(function () {
    after_load();
  });

  setTimeout(function(){
    if( $('#site_loader_overlay').not(':animated').is(':visible') ) {
      after_load();
    }
  }, <?php if($options['load_time']) { echo esc_html($options['load_time']); } else { echo '7000'; }; ?>);

<?php } else { ?>
<?php
        if (!empty($has_init_function)) {
          echo $has_init_function.'();';
        }
?>
<?php } ?>

});
</script>

<?php if (is_singular(array('post', 'news', 'campaign'))) { ?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php } ?>

<?php if( is_mobile() ) { ?>
<?php if($options['footer_bar_display'] == 'type1') { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
<?php }elseif($options['footer_bar_display'] == 'type2'){ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar2.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>

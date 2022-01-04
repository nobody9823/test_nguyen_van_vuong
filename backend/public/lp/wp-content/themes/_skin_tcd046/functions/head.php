<?php
function tcd_head() {
  global $header_slider;
  $options = get_desing_plus_option();
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
<?php if( !is_no_responsive() ) { ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">
<?php } ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>
<?php if($options['header_fix'] == 'type2' || $options['mobile_header_fix'] == 'type2') { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix.js?ver=<?php echo version_num(); ?>"></script>
<?php } ?>

<style type="text/css">
<?php
     if (strtoupper(get_locale()) == 'JA') {
       if($options['font_type'] == 'type1') {
?>
body, input, textarea { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php  } elseif($options['font_type'] == 'type2') { ?>
body, input, textarea { font-family: "Segoe UI", Verdana, "游ゴシック", YuGothic, "Hiragino Kaku Gothic ProN", Meiryo, sans-serif; }
<?php  } else { ?>
body, input, textarea { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php
       }
       if($options['headline_font_type'] == 'type1') {
?>
.rich_font { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; font-weight: normal; }
<?php  } elseif($options['headline_font_type'] == 'type2') { ?>
.rich_font { font-family: "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight: 100;
}
<?php  } else { ?>
.rich_font { font-weight:500; font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php
       }
     }
?>

#header .logo { font-size:<?php echo esc_html($options['logo_font_size']); ?>px; }
.fix_top.header_fix #header .logo { font-size:<?php echo esc_html($options['logo_font_size_fix']); ?>px; }
#footer_logo .logo { font-size:<?php echo esc_html($options['logo_font_size_footer']); ?>px; }
<?php if($options['header_logo_retina'] == 1) { ?>
 #logo_image img { width:50%; height:50%; max-height: none; }
<?php } ?>
<?php if($options['header_logo_retina_fix'] == 1) { ?>
  #logo_image_fixed img { width:50%; height:50%; max-height: none; }
<?php } ?>
<?php if($options['footer_logo_retina'] == 1) { ?>
#footer_logo img { width:50%; height:50%; }
<?php } ?>
#post_title { font-size:<?php echo esc_html($options['title_font_size']); ?>px; }
body, .post_content { font-size:<?php echo esc_html($options['content_font_size']); ?>px; }

<?php if (!is_no_responsive()) { ?>
@media screen and (max-width:991px) {
  #header .logo { font-size:<?php echo esc_html($options['logo_font_size_mobile']); ?>px; }
  .mobile_fix_top.header_fix #header .logo { font-size:<?php echo esc_html($options['logo_font_size_mobile_fix']); ?>px; }
<?php if($options['header_logo_retina_mobile'] == 1) { ?>
  #logo_image img { width:50%; height:50%; max-height: none; }
<?php } ?>
<?php if($options['header_logo_retina_mobile_fix'] == 1) { ?>
  #logo_image_fixed img { width:50%; height:50%; max-height: none; }
<?php } ?>
  #post_title { font-size:<?php echo esc_html($options['title_font_size_mobile']); ?>px; }
  body, .post_content { font-size:<?php echo esc_html($options['content_font_size_mobile']); ?>px; }
}
<?php } ?>

<?php if($options['column_float']){ ?>
#left_col { float:right; }
#side_col { float:left; }
<?php } ?>

<?php
      // ローディングアイコン
      if($options['use_load_icon']){ 
        $hex_color1 = implode(',', hex2rgb($options['pickedcolor1']));
        $hex_color2 = implode(',', hex2rgb($options['pickedcolor2']));
?>
#site_wrap { display:none; }
#site_loader_overlay {
  background: #fff;
  opacity: 1;
  position: fixed;
  top: 0px;
  left: 0px;
  width: 100%;
  height: 100%;
  width: 100vw;
  height: 100vh;
  z-index: 99999;
}
<?php   if($options['load_icon'] == 'type2'){ ?>
#site_loader_animation {
  margin: -27.5px 0 0 -27.5px;
  width: 55px;
  height: 55px;
  position: fixed;
  top: 50%;
  left: 50%;
}
#site_loader_animation:before {
  position: absolute;
  bottom: 0;
  left: 0;
  display: block;
  width: 15px;
  height: 15px;
  content: '';
  box-shadow: 20px 0 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px 0 rgba(<?php echo $hex_color1; ?>, 1), 20px -20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px -20px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 0);
  animation: loading-square-loader 5.4s linear forwards infinite;
}
#site_loader_animation:after {
  position: absolute;
  bottom: 10px;
  left: 0;
  display: block;
  width: 15px;
  height: 15px;
  background-color: rgba(<?php echo $hex_color2; ?>, 1);
  opacity: 0;
  content: '';
  animation: loading-square-base 5.4s linear forwards infinite;
}
@-webkit-keyframes loading-square-base {
  0% { bottom: 10px; opacity: 0; }
  5%, 50% { bottom: 0; opacity: 1; }
  55%, 100% { bottom: -10px; opacity: 0; }
}
@keyframes loading-square-base {
  0% { bottom: 10px; opacity: 0; }
  5%, 50% { bottom: 0; opacity: 1; }
  55%, 100% { bottom: -10px; opacity: 0; }
}
@-webkit-keyframes loading-square-loader {
  0% { box-shadow: 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px 0 rgba(<?php echo $hex_color1; ?>, 0), 0 -20px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  5% { box-shadow: 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px 0 rgba(<?php echo $hex_color1; ?>, 0), 0 -20px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  10% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -20px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  15% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -30px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  20% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -30px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  25% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -30px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  30% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -50px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  35% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -50px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  40% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -50px rgba(242, 205, 123, 0); }
  45%, 55% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  60% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  65% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  70% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  75% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  80% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  85% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -30px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  90% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -30px rgba(<?php echo $hex_color1; ?>, 0), 20px -30px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  95%, 100% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -30px rgba(<?php echo $hex_color1; ?>, 0), 20px -30px rgba(<?php echo $hex_color1; ?>, 0), 40px -30px rgba(<?php echo $hex_color2; ?>, 0); }
}
@keyframes loading-square-loader {
  0% { box-shadow: 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px 0 rgba(<?php echo $hex_color1; ?>, 0), 0 -20px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  5% { box-shadow: 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px 0 rgba(<?php echo $hex_color1; ?>, 0), 0 -20px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  10% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -20px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  15% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -30px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  20% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -30px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  25% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -30px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  30% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -50px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  35% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -50px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(242, 205, 123, 0); }
  40% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -50px rgba(242, 205, 123, 0); }
  45%, 55% { box-shadow: 20px 0 rgba(<?php echo $hex_color1; ?>, 1), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  60% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 0 rgba(<?php echo $hex_color1; ?>, 1), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  65% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -20px rgba(<?php echo $hex_color1; ?>, 1), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  70% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -20px rgba(<?php echo $hex_color1; ?>, 1), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  75% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -20px rgba(<?php echo $hex_color1; ?>, 1), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  80% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -40px rgba(<?php echo $hex_color1; ?>, 1), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  85% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -30px rgba(<?php echo $hex_color1; ?>, 0), 20px -40px rgba(<?php echo $hex_color1; ?>, 1), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  90% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -30px rgba(<?php echo $hex_color1; ?>, 0), 20px -30px rgba(<?php echo $hex_color1; ?>, 0), 40px -40px rgba(<?php echo $hex_color2; ?>, 1); }
  95%, 100% { box-shadow: 20px 10px rgba(<?php echo $hex_color1; ?>, 0), 40px 10px rgba(<?php echo $hex_color1; ?>, 0), 0 -10px rgba(<?php echo $hex_color1; ?>, 0), 20px -10px rgba(<?php echo $hex_color1; ?>, 0), 40px -10px rgba(<?php echo $hex_color1; ?>, 0), 0 -30px rgba(<?php echo $hex_color1; ?>, 0), 20px -30px rgba(<?php echo $hex_color1; ?>, 0), 40px -30px rgba(<?php echo $hex_color2; ?>, 0); }
}
<?php   } elseif($options['load_icon'] == 'type3'){ ?>
#site_loader_animation {
  width: 100%;
  min-width: 160px;
  font-size: 16px;
  text-align: center;
  position: fixed;
  top: 50%;
  left: 0;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: alpha(opacity=0);
  -webkit-animation: loading-dots-fadein .5s linear forwards;
  -moz-animation: loading-dots-fadein .5s linear forwards;
  -o-animation: loading-dots-fadein .5s linear forwards;
  -ms-animation: loading-dots-fadein .5s linear forwards;
  animation: loading-dots-fadein .5s linear forwards;
}
#site_loader_animation i {
  width: .5em;
  height: .5em;
  display: inline-block;
  vertical-align: middle;
  background: #e0e0e0;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  margin: 0 .25em;
  background: #<?php echo $options['pickedcolor1']; ?>;
  -webkit-animation: loading-dots-middle-dots .5s linear infinite;
  -moz-animation: loading-dots-middle-dots .5s linear infinite;
  -ms-animation: loading-dots-middle-dots .5s linear infinite;
  -o-animation: loading-dots-middle-dots .5s linear infinite;
  animation: loading-dots-middle-dots .5s linear infinite;
}
#site_loader_animation i:first-child {
  -webkit-animation: loading-dots-first-dot .5s infinite;
  -moz-animation: loading-dots-first-dot .5s linear infinite;
  -ms-animation: loading-dots-first-dot .5s linear infinite;
  -o-animation: loading-dots-first-dot .5s linear infinite;
  animation: loading-dots-first-dot .5s linear infinite;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transform: translate(-1em);
  -moz-transform: translate(-1em);
  -ms-transform: translate(-1em);
  -o-transform: translate(-1em);
  transform: translate(-1em);
}
#site_loader_animation i:last-child {
  -webkit-animation: loading-dots-last-dot .5s linear infinite;
  -moz-animation: loading-dots-last-dot .5s linear infinite;
  -ms-animation: loading-dots-last-dot .5s linear infinite;
  -o-animation: loading-dots-last-dot .5s linear infinite;
  animation: loading-dots-last-dot .5s linear infinite;
}
@-webkit-keyframes loading-dots-fadein{100%{opacity:1;-ms-filter:none;filter:none}}
@-moz-keyframes loading-dots-fadein{100%{opacity:1;-ms-filter:none;filter:none}}
@-o-keyframes loading-dots-fadein{100%{opacity:1;-ms-filter:none;filter:none}}
@keyframes loading-dots-fadein{100%{opacity:1;-ms-filter:none;filter:none}}
@-webkit-keyframes loading-dots-first-dot{100%{-webkit-transform:translate(1em);-moz-transform:translate(1em);-o-transform:translate(1em);-ms-transform:translate(1em);transform:translate(1em);opacity:1;-ms-filter:none;filter:none}}
@-moz-keyframes loading-dots-first-dot{100%{-webkit-transform:translate(1em);-moz-transform:translate(1em);-o-transform:translate(1em);-ms-transform:translate(1em);transform:translate(1em);opacity:1;-ms-filter:none;filter:none}}
@-o-keyframes loading-dots-first-dot{100%{-webkit-transform:translate(1em);-moz-transform:translate(1em);-o-transform:translate(1em);-ms-transform:translate(1em);transform:translate(1em);opacity:1;-ms-filter:none;filter:none}}
@keyframes loading-dots-first-dot{100%{-webkit-transform:translate(1em);-moz-transform:translate(1em);-o-transform:translate(1em);-ms-transform:translate(1em);transform:translate(1em);opacity:1;-ms-filter:none;filter:none}}
@-webkit-keyframes loading-dots-middle-dots{100%{-webkit-transform:translate(1em);-moz-transform:translate(1em);-o-transform:translate(1em);-ms-transform:translate(1em);transform:translate(1em)}}
@-moz-keyframes loading-dots-middle-dots{100%{-webkit-transform:translate(1em);-moz-transform:translate(1em);-o-transform:translate(1em);-ms-transform:translate(1em);transform:translate(1em)}}
@-o-keyframes loading-dots-middle-dots{100%{-webkit-transform:translate(1em);-moz-transform:translate(1em);-o-transform:translate(1em);-ms-transform:translate(1em);transform:translate(1em)}}
@keyframes loading-dots-middle-dots{100%{-webkit-transform:translate(1em);-moz-transform:translate(1em);-o-transform:translate(1em);-ms-transform:translate(1em);transform:translate(1em)}}
@-webkit-keyframes loading-dots-last-dot{100%{-webkit-transform:translate(2em);-moz-transform:translate(2em);-o-transform:translate(2em);-ms-transform:translate(2em);transform:translate(2em);opacity:0;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";filter:alpha(opacity=0)}}
@-moz-keyframes loading-dots-last-dot{100%{-webkit-transform:translate(2em);-moz-transform:translate(2em);-o-transform:translate(2em);-ms-transform:translate(2em);transform:translate(2em);opacity:0;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";filter:alpha(opacity=0)}}
@-o-keyframes loading-dots-last-dot{100%{-webkit-transform:translate(2em);-moz-transform:translate(2em);-o-transform:translate(2em);-ms-transform:translate(2em);transform:translate(2em);opacity:0;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";filter:alpha(opacity=0)}}
@keyframes loading-dots-last-dot{100%{-webkit-transform:translate(2em);-moz-transform:translate(2em);-o-transform:translate(2em);-ms-transform:translate(2em);transform:translate(2em);opacity:0;-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";filter:alpha(opacity=0)}}
<?php   } else { ?>
#site_loader_animation {
  margin: -33px 0 0 -33px;
  width: 60px;
  height: 60px;
  font-size: 10px;
  text-indent: -9999em;
  position: fixed;
  top: 50%;
  left: 50%;
  border: 3px solid rgba(<?php echo $hex_color1; ?>,0.2);
  border-top-color: #<?php echo $options['pickedcolor1']; ?>;
  border-radius: 50%;
  -webkit-animation: loading-circle 1.1s infinite linear;
  animation: loading-circle 1.1s infinite linear;
}
@-webkit-keyframes loading-circle {
  0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
@keyframes loading-circle {
  0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg);
  }
}
<?php   } ?>
<?php } ?>


<?php if($options['hover_type']=="type1"){ ?>
.image {
overflow: hidden;
-webkit-transition: 0.35s;
-moz-transition: 0.35s;
-ms-transition: 0.35s;
transition: 0.35s;
}
.image img {
-webkit-transform: scale(1);
-webkit-transition-property: opacity, scale, -webkit-transform;
-webkit-transition: 0.35s;
-moz-transform: scale(1);
-moz-transition-property: opacity, scale, -moz-transform;
-moz-transition: 0.35s;
-ms-transform: scale(1);
-ms-transition-property: opacity, scale, -ms-transform;
-ms-transition: 0.35s;
-o-transform: scale(1);
-o-transition-property: opacity, scale, -o-transform;
-o-transition: 0.35s;
transform: scale(1);
transition-property: opacity, scale, -webkit-transform;
transition: 0.35s;
-webkit-backface-visibility:hidden; backface-visibility:hidden;
}
.image:hover img, a:hover .image img {
 -webkit-transform: scale(<?php echo $options['hover1_zoom']; ?>); -moz-transform: scale(<?php echo $options['hover1_zoom']; ?>); -ms-transform: scale(<?php echo $options['hover1_zoom']; ?>); -o-transform: scale(<?php echo $options['hover1_zoom']; ?>); transform: scale(<?php echo $options['hover1_zoom']; ?>);
}
<?php }elseif($options['hover_type']=="type2"){ ?>
<?php
  if ($options['hover2_direct'] == 'type2') {
    $hover2_direct1 = '7.5px';
    $hover2_direct2 = '-7.5px';
  } else {
    $hover2_direct1 = '-7.5px';
    $hover2_direct2 = '7.5px';
  }
?>
.image {
overflow: hidden;
-webkit-transition: 0.35s;
-moz-transition: 0.35s;
-ms-transition: 0.35s;
transition: 0.35s;
}
.image img {
-webkit-backface-visibility: hidden;
backface-visibility: hidden;
-webkit-transform: scale(1.2) translateX(<?php echo $hover2_direct1; ?>);
-webkit-transition-property: opacity, translateX;
-webkit-transition: 0.35s;
-moz-transform: scale(1.2) translateX(<?php echo $hover2_direct1; ?>);
-moz-transition-property: opacity, translateX;
-moz-transition: 0.35s;
-ms-transform: scale(1.2) translateX(<?php echo $hover2_direct1; ?>);
-ms-transition-property: opacity, translateX;
-ms-transition: 0.35s;
-o-transform: scale(1.2) translateX(<?php echo $hover2_direct1; ?>);
-o-transition-property: opacity, translateX;
-o-transition: 0.35s;
transform: scale(1.2) translateX(<?php echo $hover2_direct1; ?>);
transition-property: opacity, translateX;
transition: 0.35s;
}
.image:hover img, a:hover .image img {
opacity: <?php echo $options['hover2_opacity']; ?>;
-webkit-transform: scale(1.2) translateX(<?php echo $hover2_direct2; ?>);
-moz-transform: scale(1.2) translateX(<?php echo $hover2_direct2; ?>);
-ms-transform: scale(1.2) translateX(<?php echo $hover2_direct2; ?>);
-o-transform: scale(1.2) translateX(<?php echo $hover2_direct2; ?>);
transform: scale(1.2) translateX(<?php echo $hover2_direct2; ?>);
}
.image:hover, a:hover .image {
background: #<?php echo $options['hover2_bgcolor']; ?>;
}
<?php }elseif($options['hover_type']=="type3"){ ?>
.image {
-webkit-transition: .5s;
-moz-transition: .5s;
-ms-transition: .5s;
transition: .5s;
}
.image img {
-webkit-backface-visibility: hidden;
backface-visibility: hidden;
-webkit-transition-property: opacity;
-webkit-transition: .5s;
-moz-transition-property: opacity;
-moz-transition: .5s;
-ms-transition-property: opacity;
-ms-transition: .5s;
-o-transition-property: opacity;
-o-transition: .5s;
transition-property: opacity;
transition: .5s;
}
.image:hover img, a:hover .image img {
opacity: <?php echo $options['hover3_opacity']; ?>;
}
.image:hover, a:hover .image {
background: #<?php echo $options['hover3_bgcolor']; ?>;
}
<?php } ?>

.headline_bg_l, .headline_bg, ul.meta .category span, .page_navi a:hover, .page_navi span.current, .page_navi p.back a:hover,
#post_pagination p, #post_pagination a:hover, #previous_next_post2 a:hover, .single-news #post_meta_top .date, .single-campaign #post_meta_top .date, ol#voice_list .info .voice_button a:hover, .voice_user .voice_name, .voice_course .course_button a, .side_headline, #footer_top,
#comment_header ul li a:hover, #comment_header ul li.comment_switch_active a, #comment_header #comment_closed p, #submit_comment
{ background-color:#<?php echo esc_html($options['pickedcolor1']); ?>; }

.page_navi a:hover, .page_navi span.current, #post_pagination p, #comment_header ul li.comment_switch_active a, #comment_header #comment_closed p, #guest_info input:focus, #comment_textarea textarea:focus
{ border-color:#<?php echo esc_html($options['pickedcolor1']); ?>; }

#comment_header ul li.comment_switch_active a:after, #comment_header #comment_closed p:after
{ border-color:#<?php echo esc_html($options['pickedcolor1']); ?> transparent transparent transparent; }

a:hover, #global_menu > ul > li > a:hover, #bread_crumb li a, #bread_crumb li.home a:hover:before, ul.meta .date, .footer_headline, .footer_widget a:hover,
#post_title, #previous_next_post a:hover, #previous_next_post a:hover:before, #previous_next_post a:hover:after,
#recent_news .info .date, .course_category .course_category_headline, .course_category .info .headline, ol#voice_list .info .voice_name, dl.interview dt, .voice_course .course_button a:hover, ol#staff_list .info .staff_name, .staff_info .staff_detail .staff_name, .staff_info .staff_detail .staff_social_link li a:hover:before,
.styled_post_list1 .date, .collapse_category_list li a:hover, .tcdw_course_list_widget .course_list li .image, .side_widget.tcdw_banner_list_widget .side_headline, ul.banner_list li .image,
#index_content1 .caption .headline, #index_course li .image, #index_news .date, #index_voice li .info .voice_name, #index_blog .headline, .table.pb_pricemenu td.menu, .side_widget .campaign_list .date, .side_widget .news_list .date, .side_widget .staff_list .staff_name, .side_widget .voice_list .voice_name
{ color:#<?php echo esc_html($options['pickedcolor2']); ?>; }

#footer_bottom, a.index_blog_button:hover, .widget_search #search-btn input:hover, .widget_search #searchsubmit:hover, .widget.google_search #searchsubmit:hover, #submit_comment:hover, #header_slider .slick-dots li button:hover, #header_slider .slick-dots li.slick-active button
{ background-color:#<?php echo esc_html($options['pickedcolor2']); ?>; }

.post_content a { color:#<?php echo esc_html($options['content_link_color']); ?>; }

<?php
      $hex_color1 = implode(",", hex2rgb($options['pickedcolor1']));
?>
#archive_wrapper, #related_post ol { background-color:rgba(<?php echo $hex_color1; ?>,0.15); }
#index_course li.noimage .image, .course_category .noimage .imagebox, .tcdw_course_list_widget .course_list li.noimage .image { background:rgba(<?php echo $hex_color1; ?>,0.3); }

<?php
      $hex_color3 = implode(",", hex2rgb($options['pickedcolor3']));
?>
#index_blog, #footer_widget, .course_categories li a.active, .course_categories li a:hover, .styled_post_list1_tabs li { background-color:rgba(<?php echo $hex_color3; ?>,0.15); }
#index_topics { background:rgba(<?php echo $hex_color3; ?>,<?php echo esc_html($options['index_topics_bg_opacity']); ?>); }
#header { border-top-color:rgba(<?php echo $hex_color3; ?>,0.8); }

@media screen and (min-width:992px) {
  .fix_top.header_fix #header { background-color:rgba(<?php echo $hex_color3; ?>,<?php echo $options['header_fix_background_opacity'] ?>); }
  #global_menu ul ul a { background-color:#<?php echo esc_html($options['pickedcolor1']); ?>; }
  #global_menu ul ul a:hover { background-color:#<?php echo esc_html($options['pickedcolor2']); ?>; }
}
<?php if (!is_no_responsive()) { ?>
@media screen and (max-width:991px) {
  a.menu_button.active { background:rgba(<?php echo $hex_color3; ?>,0.8); };
  .mobile_fix_top.header_fix #header { background-color:rgba(<?php echo $hex_color3; ?>,<?php echo $options['header_fix_background_opacity'] ?>); }
  #global_menu { background-color:#<?php echo esc_html($options['pickedcolor1']); ?>; }
  #global_menu a:hover { background-color:#<?php echo esc_html($options['pickedcolor2']); ?>; }
}
<?php } ?>
@media screen and (max-width:991px) {
  .mobile_fix_top.header_fix #header { background-color:rgba(<?php echo $hex_color3; ?>,<?php echo $options['header_fix_background_opacity'] ?>); }
}
<?php if (is_front_page()) { ?>
#index_content1 .box1 .caption { font-size:<?php echo esc_html($options['index_content1_desc_font_size1']); ?>px; }
#index_content1 .box1 .caption .headline { font-size:<?php echo esc_html($options['index_content1_headline_font_size1']); ?>px; }
#index_content1 .box2 .caption { font-size:<?php echo esc_html($options['index_content1_desc_font_size2']); ?>px; }
#index_content1 .box2 .caption .headline { font-size:<?php echo esc_html($options['index_content1_headline_font_size2']); ?>px; }
#index_content1 .box3 .caption { font-size:<?php echo esc_html($options['index_content1_desc_font_size3']); ?>px; }
#index_content1 .box3 .caption .headline { font-size:<?php echo esc_html($options['index_content1_headline_font_size3']); ?>px; }
#index_content2 .headline { font-size:<?php echo esc_html($options['index_content2_headline_font_size']); ?>px; color:#<?php echo esc_html($options['index_content2_headline_color']); ?>; }
#index_content2 .desc { font-size:<?php echo esc_html($options['index_content2_desc_font_size']); ?>px; }
<?php   if (!is_no_responsive()) { ?>
@media screen and (max-width:767px) {
  #index_content1 .box .caption { font-size:12px; }
  #index_content1 .box .caption .headline { font-size:20px; }
  #index_content2 .headline { font-size:<?php echo esc_html($options['title_font_size_mobile']); ?>px; }
  #index_content2 .desc { font-size:<?php echo esc_html($options['content_font_size_mobile']); ?>px; }
}
<?php   } ?>

<?php
        if ($header_slider) {
          foreach ($header_slider as $i => $slider) {
            if (!is_int($i)) continue;
            $font_size = $options['slider_headline_font_size'.$i];
            $font_color = $options['slider_headline_color'.$i];
            $shadow1 = $options['slider_headline_shadow_a'.$i];
            $shadow2 = $options['slider_headline_shadow_b'.$i];
            $shadow3 = $options['slider_headline_shadow_c'.$i];
            $shadow4 = $options['slider_headline_shadow_color'.$i];
            echo "#header_slider .item{$i} .caption .headline { font-size:{$font_size}px; text-shadow:{$shadow1}px {$shadow2}px {$shadow3}px #{$shadow4}; color:#{$font_color} }\n";

            $font_size = $options['slider_caption_font_size'.$i];
            $font_color = $options['slider_caption_color'.$i];
            $shadow1 = $options['slider_caption_shadow_a'.$i];
            $shadow2 = $options['slider_caption_shadow_b'.$i];
            $shadow3 = $options['slider_caption_shadow_c'.$i];
            $shadow4 = $options['slider_caption_shadow_color'.$i];
            echo "#header_slider .item{$i} .caption .catchphrase { font-size:{$font_size}px; text-shadow:{$shadow1}px {$shadow2}px {$shadow3}px #{$shadow4}; color:#{$font_color} }\n";

            $overlay_color_base = hex2rgb($options['slider_overlay'.$i]);
            $overlay_color = implode(',', $overlay_color_base);
            $overlay_opacity = $options['slider_overlay_opacity'.$i];
            $use_overlay = $options['use_slider_overlay'.$i];
            $use_button = $options['show_slider_caption_button'.$i];

            if ($use_overlay == 1) {
              echo "#header_slider .item{$i} .overlay span:before { background-color:rgba({$overlay_color},{$overlay_opacity}); }\n";
            }

            if ($use_button == 1) {
              $text_color = $options['slider_button_color'.$i];
              $text_color_hover = $options['slider_button_color_hover'.$i];
              $bg_color = implode(',', hex2rgb($options['slider_button_bg_color'.$i])).','.$options['slider_button_bg_opaciry'.$i];
              $bg_color_hover = implode(',', hex2rgb($options['slider_button_bg_color_hover'.$i])).','.$options['slider_button_bg_opaciry_hover'.$i];
              $border_color = $options['slider_button_border_color'.$i];
              $border_color_hover = $options['slider_button_border_color_hover'.$i];

              echo "#header_slider .item{$i} .button { background-color:rgba({$bg_color}); color:#{$text_color}; border-color:#{$border_color}; }\n";
              echo "#header_slider .item{$i} .button:hover { background-color:rgba({$bg_color_hover}); color:#{$text_color_hover}; border-color:#{$border_color_hover}; }\n";
            }

            if (!is_no_responsive()) {
              echo "@media screen and (max-width:991px) {\n";
              echo "  #header_slider .item{$i} .caption .headline { font-size:".$options['slider_headline_font_size_mobile'.$i]."px; }\n";
              echo "  #header_slider .item{$i} .caption .catchphrase { font-size:".$options['slider_caption_font_size_mobile'.$i]."px; }\n";
              echo "}\n";
            }
          }
        }
?>
<?php } ?>

<?php if($options['css_code']) { echo $options['css_code']; } ?>

<?php if(is_mobile()):
  if($options['footer_bar_display'] == 'type1' || $options['footer_bar_display'] == 'type2'):
?>
.dp-footer-bar{
  background: <?php echo 'rgba('.implode(',', hex2rgb($options['footer_bar_bg'])).', '.esc_html($options['footer_bar_tp']).');'; ?>
  border-top: solid 1px #<?php echo esc_html($options['footer_bar_border']); ?>;
  color: #<?php echo esc_html($options['footer_bar_color']); ?>;
  display: flex;
  flex-wrap: wrap;
}
.dp-footer-bar a{
  color: #<?php echo esc_html($options['footer_bar_color']); ?>;
}
.dp-footer-bar-item + .dp-footer-bar-item{
  border-left: solid 1px #<?php echo esc_html($options['footer_bar_border']); ?>;
}

<?php endif; endif; ?>
</style>

<?php if (is_front_page()) { ?>
<?php   if ($header_slider) { ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/slick.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js?ver=<?php echo version_num(); ?>"></script>
<?php     if (!empty($header_slider['count']['video'])) { ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/vegas.min.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/vegas.min.js?ver=<?php echo version_num(); ?>"></script>
<?php     } ?>
<?php     if (!empty($header_slider['count']['youtube'])) { ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.mb.YTPlayer.min.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mb.YTPlayer.min.js?ver=<?php echo version_num(); ?>"></script>
<?php     } ?>
<?php   } ?>
<?php   if ($options['show_index_topics_content'] == 1) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.newsticker.js?ver=<?php echo version_num(); ?>"></script>
<?php   } ?>
<?php } elseif (is_home() || is_search() || (is_archive() && !is_post_type_archive(array('course', 'news', 'campaign')))) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/imagesloaded.pkgd.min.js?ver=<?php echo version_num(); ?>"></script>
<?php } ?>
<?php
}
add_action("wp_head", "tcd_head");
// Custom head/script
function tcd_custom_head() {
  $options = get_design_plus_option();

  if ( $options['custom_head'] ) {
    echo $options['custom_head'] . "\n";
  }
}
add_action( 'wp_head', 'tcd_custom_head', 9999 );
?>

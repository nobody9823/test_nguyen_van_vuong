<?php

//ヘッダーロゴ　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function header_logo(){

  $options = get_desing_plus_option();
  $logo_image = wp_get_attachment_image_src( $options['header_logo_image'], 'full' );
  $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile'], 'full' );
  $title = esc_attr(get_bloginfo('name'));
  $url = home_url();

  if(!is_mobile() || is_no_responsive()) { //if is pc
    if(!empty($logo_image)){
?>
<div id="logo_image">
 <h1 class="logo">
  <a href="<?php echo $url; ?>/" title="<?php echo $title; ?>" data-label="<?php echo $title; ?>"><img class="h_logo" src="<?php echo $logo_image[0]; ?>?<?php echo time(); ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" /></a>
 </h1>
</div>
<?php
    } else {
?>
<div id="logo_text">
 <h1 class="logo"><a href="<?php echo $url; ?>/"><?php echo $title; ?></a></h1>
</div>
<?php
    };
  } else { //if is mobile device
    if(!empty($logo_image_mobile)){
?>
<div id="logo_image">
 <h1 class="logo">
  <a href="<?php echo $url; ?>/" title="<?php echo $title; ?>"><img class="m_logo" src="<?php echo $logo_image_mobile[0]; ?>?<?php echo time(); ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" /></a>
 </h1>
</div>
<?php
    } else {
?>
<div id="logo_text">
 <h1 class="logo"><a href="<?php echo $url; ?>/"><?php echo $title; ?></a></h1>
</div>
<?php
    };
  };

}


//ヘッダーロゴ（固定ヘッダー用）　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function header_logo_fix(){

  $options = get_desing_plus_option();
  $logo_image = wp_get_attachment_image_src( $options['header_logo_image_fix'], 'full' );
  $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile_fix'], 'full' );
  $title = esc_attr(get_bloginfo('name'));
  $url = home_url();
  if(!is_mobile() || is_no_responsive()) { //if is pc
    if(!empty($logo_image)){
?>
<div id="logo_image_fixed">
 <p class="logo"><a href="<?php echo $url; ?>/" title="<?php echo $title; ?>"><img class="s_logo" src="<?php echo $logo_image[0]; ?>?<?php echo time(); ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" /></a></p>
</div>
<?php
    } else {
?>
<div id="logo_text_fixed">
 <p class="logo"><a href="<?php echo $url; ?>/" title="<?php echo $title; ?>"><?php echo $title; ?></a></p>
</div>
<?php
    };
  } else { //if is mobile device
    if(!empty($logo_image_mobile)){
?>
<div id="logo_image_fixed">
 <p class="logo"><a href="<?php echo $url; ?>/" title="<?php echo $title; ?>"><img class="s_logo" src="<?php echo $logo_image_mobile[0]; ?>?<?php echo time(); ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" /></a></p>
</div>
<?php
    } else {
?>
<div id="logo_text_fixed">
 <p class="logo"><a href="<?php echo $url; ?>/" title="<?php echo $title; ?>"><?php echo $title; ?></a></p>
</div>
<?php
    };
  };

}


//フッターロゴ　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function footer_logo(){

  $options = get_desing_plus_option();
  $logo_image = wp_get_attachment_image_src( $options['footer_logo_image'], 'full' );
  $title = esc_attr(get_bloginfo('name'));
  $url = home_url();

    if(!empty($logo_image)){
?>
<div class="logo_area">
 <p class="logo"><a href="<?php echo $url; ?>/" title="<?php echo $title; ?>"><img class="f_logo" src="<?php echo $logo_image[0]; ?>?<?php echo time(); ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" /></a></p>
</div>
<?php
    } else {
?>
<div class="logo_area">
 <p class="logo"><a href="<?php echo $url; ?>/"><?php echo $title; ?></a></p>
</div>
<?php
    };

}

?>
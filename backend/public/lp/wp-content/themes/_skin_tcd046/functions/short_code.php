<?php

function theme_option_single_banner() {

	$options = get_desing_plus_option();


    if( $options['single_ad_code3'] || $options['single_ad_image3'] || $options['single_ad_code4'] || $options['single_ad_image4'] ) {

      $html = '';

      if( !$options['single_ad_code4'] && !$options['single_ad_image4'] ) {
        $html .= '<div id="single_banner_area2" class="clearfix one_banner">' . "\n";
      } else {
        $html .= '<div id="single_banner_area2" class="clearfix">' . "\n";
      }

      if ($options['single_ad_code3']) {
        $html .= '<div class="single_banner single_banner_left">' . "\n";
        $html .= $options['single_ad_code3'] . "\n";
        $html .= '</div>' . "\n";
      } else {
        $single_image3 = wp_get_attachment_image_src( $options['single_ad_image3'], 'full' );
        $html .= '<div class="single_banner single_banner_left">' . "\n";
        $html .= '<a href="' . $options['single_ad_url3'] . '" target="_blank"><img src="' . $single_image3[0] . '" alt="" title="" /></a>' . "\n";
        $html .= '</div>' . "\n";
      }

      if ($options['single_ad_code4']) {
        $html .= '<div class="single_banner single_banner_right">' . "\n";
        $html .= $options['single_ad_code4'] . "\n";
        $html .= '</div>' . "\n";
      } else {
        $single_image4 = wp_get_attachment_image_src( $options['single_ad_image4'], 'full' );
        $html .= '<div class="single_banner single_banner_right">' . "\n";
        $html .= '<a href="' . $options['single_ad_url4'] . '" target="_blank"><img src="' . $single_image4[0] . '" alt="" title="" /></a>' . "\n";
        $html .= '</div>' . "\n";
      }

      $html .= '</div>' . "\n";

      return $html;

    };


}
add_shortcode('s_ad', 'theme_option_single_banner');

?>
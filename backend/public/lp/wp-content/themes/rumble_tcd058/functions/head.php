<?php
function tcd_head() {
	global $dp_options, $post;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();
	$primary_color_hex = esc_html( implode( ', ', hex2rgb( $dp_options['primary_color'] ) ) );
	$load_color1_hex = esc_html( implode( ', ', hex2rgb( $dp_options['load_color1'] ) ) ); // keyframe の記述が長くなるため、ここでエスケープ
	$load_color2_hex = esc_html( implode( ', ', hex2rgb( $dp_options['load_color2'] ) ) ); // keyframe の記述が長くなるため、ここでエスケープ
?>
<?php if ( $dp_options['favicon'] && $url = wp_get_attachment_url( $dp_options['favicon'] ) ) : ?>
<link rel="shortcut icon" href="<?php echo esc_attr( $url ); ?>">
<?php endif; ?>
<style>
<?php /* Primary color */ ?>
.p-tabbar__item.is-active, .p-tabbar__item.is-active a, .p-index-carousel .slick-arrow:hover { color: <?php echo esc_html( $dp_options['primary_color'] ); ?>; }
.p-copyright, .p-tabbar, .p-headline, .p-cb__item-archive-link__button, .p-page-links a:hover, .p-page-links > span, .p-pager__item a:hover, .p-pager__item .current, .p-entry__next-page__link:hover, .p-widget .searchform::after, .p-widget-search .p-widget-search__submit, .p-widget-list__item-rank, .c-comment__form-submit:hover, c-comment__password-protected, .slick-arrow, .c-pw__btn--register, .c-pw__btn { background-color: <?php echo esc_html( $dp_options['primary_color'] ); ?>; }
.p-page-links a:hover, .p-page-links > span, .p-pager__item a:hover, .p-pager__item .current, .p-author-archive .p-headline, .p-cb__item-header { border-color: <?php echo esc_html( $dp_options['primary_color'] ); ?>; }
.c-comment__tab-item.is-active a, .c-comment__tab-item a:hover, .c-comment__tab-item.is-active p { background-color: rgba(<?php echo $primary_color_hex; ?>, 0.7); }
.c-comment__tab-item.is-active a:after, .c-comment__tab-item.is-active p:after { border-top-color: rgba(<?php echo $primary_color_hex; ?>, 0.7); }
<?php /* Secondary color */ ?>
.p-author__box, .p-entry-news__header, .p-page-links a, .p-pager__item a, .p-pager__item span { background-color: <?php echo esc_html( $dp_options['secondary_color'] ); ?>; }
<?php /* Link color of post contents */ ?>
.p-entry__body a { color: <?php echo esc_html( $dp_options['content_link_color'] ); ?>; }
<?php /* Global menu */ ?>
.p-megamenu__bg, .p-global-nav .sub-menu, .p-megamenu__bg .p-float-native-ad-label__small { background-color: <?php echo esc_html( $dp_options['submenu_bg_color'] ); ?>; }
.p-megamenu a, .p-global-nav .sub-menu a { color: <?php echo esc_html( $dp_options['submenu_color'] ); ?> !important; }
.p-megamenu a:hover, .p-megamenu li.is-active > a, .p-global-nav .sub-menu a:hover, .p-global-nav .sub-menu .current-menu-item > a { background-color: <?php echo esc_html( $dp_options['submenu_bg_color_hover'] ); ?>; color: <?php echo esc_html( $dp_options['submenu_color_hover'] ); ?> !important; }
.p-megamenu > ul, .p-global-nav > li.menu-item-has-children > .sub-menu { border-color: <?php echo esc_html( $dp_options['submenu_bg_color_hover'] ); ?>; }
<?php /* Native ad */ ?>
.p-native-ad-label, .p-float-native-ad-label, .p-float-native-ad-label__small, .p-article__native-ad-label { background-color: <?php echo esc_html( $dp_options['native_ad_label_bg_color'] ); ?>; color: <?php echo esc_html( $dp_options['native_ad_label_text_color'] ); ?>; font-size: <?php echo esc_html( $dp_options['native_ad_label_font_size'] ); ?>px; }
<?php
/* Category description */
if ( is_category() ) :
	$category = get_queried_object();
elseif ( is_singular( 'post' ) ) :
	$categories = get_the_category();
	if ( $categories ) :
		$category = array_shift( $categories );
	endif;
endif;
if ( ! empty( $category ) ) :
	$term_meta = get_option( 'taxonomy_' . $category->term_id, array() );
	if ( ! empty( $term_meta['desc_font_size'] ) ) :
		echo '.p-header-band__item-desc { font-size: ' . esc_html( $term_meta['desc_font_size'] ) . 'px; }' . "\n";
	endif;
	if ( ! is_no_responsive() && ! empty( $term_meta['desc_font_size_mobile'] ) ) :
		echo '@media only screen and (max-width: 991px) { .p-header-band__item-desc { font-size: ' . esc_html( $term_meta['desc_font_size_mobile'] ) . 'px; } }' . "\n";
	endif;
endif;

/* Category color */
$categories = get_categories( array(
	'orderby' => 'ID',
	'order' => 'ASC',
	'hide_empty' => 0,
	'hierarchical' => 0,
	'taxonomy' => 'category',
	'pad_counts' => false
) );
if ( $categories && ! is_wp_error( $categories ) ) {
	foreach ( $categories as $category ) {
		$term_meta = get_option( 'taxonomy_' . $category->term_id, array() );
		if ( empty( $term_meta['color'] ) ) {
			$term_meta['color'] = '#999999';
		}
		echo '.cat-item-' . esc_html( $category->term_id ) . ' > a, .cat-item-' . esc_html( $category->term_id ) . ' .toggle-children, .p-global-nav > li.menu-term-id-' . esc_html( $category->term_id ) . ':hover > a, .p-global-nav > li.menu-term-id-' . esc_html( $category->term_id ) . '.current-menu-item > a { color: ' . esc_html( $term_meta['color'] ) . "; }\n";
		echo '.p-megamenu-term-id-' . esc_html( $category->term_id ) . ' a:hover, .p-megamenu-term-id-' . esc_html( $category->term_id ) . ' .p-megamenu__current a, .p-megamenu-term-id-' . esc_html( $category->term_id ) . ' li.is-active > a, .p-global-nav li.menu-term-id-' . esc_html( $category->term_id ) . ' > .sub-menu > li > a:hover, .p-global-nav li.menu-term-id-' . esc_html( $category->term_id ) . ' > .sub-menu > .current-menu-item > a { background-color: ' . esc_html( $term_meta['color'] ) . "; }\n";
		echo '.p-category-item--' . esc_html( $category->term_id ) . ' { background-color: ' . esc_html( $term_meta['color'] ) . " !important; }\n";
		echo '.p-megamenu-term-id-' . esc_html( $category->term_id ) . ' > ul, .p-global-nav > li.menu-term-id-' . esc_html( $category->term_id ) . ' > .sub-menu { border-color: ' . esc_html( $term_meta['color'] ) . "; }\n";
	}
}
?>
<?php /* font type */ ?>
<?php if ( 'type1' == $dp_options['font_type'] ) : ?>
body { font-family: Verdana, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif; }
<?php elseif ( 'type2' == $dp_options['font_type'] ) : ?>
body { font-family: "Segoe UI", Verdana, "游ゴシック", YuGothic, "Hiragino Kaku Gothic ProN", Meiryo, sans-serif; }
<?php else : ?>
body { font-family: "Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif; }
<?php endif; ?>
<?php /* headline font type */ ?>
.p-logo, .p-entry__title, .p-headline, .p-page-header__title, .p-index-slider__item-catch, .p-widget__title, .p-cb__item-headline {
<?php if ( 'type1' == $dp_options['headline_font_type'] ) : ?>
font-family: Segoe UI, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif;
<?php elseif ( 'type2' == $dp_options['headline_font_type'] ) : ?>
font-family: "Segoe UI", Verdana, "游ゴシック", YuGothic, "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
<?php else : ?>
font-family: "Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif;
<?php endif; ?>
}
<?php /* load */ ?>
<?php if ( 'type1' == $dp_options['load_icon'] ) : ?>
.c-load--type1 { border: 3px solid rgba(<?php echo esc_html( $load_color2_hex ); ?>, 0.2); border-top-color: <?php echo esc_html( $dp_options['load_color1'] ); ?>; }
<?php elseif ( 'type2' == $dp_options['load_icon'] ) : ?>
@-webkit-keyframes loading-square-loader {
	0% { box-shadow: 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 0), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	5% { box-shadow: 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 0), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	10% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	15% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -24px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	20% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -24px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	25% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -24px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	30% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -50px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	35% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -50px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	40% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -50px rgba(242, 205, 123, 0); }
	45%, 55% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	60% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	65% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	70% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	75% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	80% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	85% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -24px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	90% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -24px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -24px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	95%, 100% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -24px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -24px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -24px rgba(<?php echo $load_color1_hex; ?>, 0); }
}
@keyframes loading-square-loader {
	0% { box-shadow: 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 0), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	5% { box-shadow: 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 0), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	10% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	15% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -24px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	20% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -24px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	25% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -24px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	30% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -50px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	35% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -50px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(242, 205, 123, 0); }
	40% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -50px rgba(242, 205, 123, 0); }
	45%, 55% { box-shadow: 16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	60% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	65% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -16px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	70% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	75% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -16px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	80% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	85% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -24px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	90% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -24px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -24px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 1); }
	95%, 100% { box-shadow: 16px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px 8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -8px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -8px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -24px rgba(<?php echo $load_color2_hex; ?>, 0), 16px -24px rgba(<?php echo $load_color2_hex; ?>, 0), 32px -24px rgba(<?php echo $load_color1_hex; ?>, 0); }
}
.c-load--type2:before { box-shadow: 16px 0 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px 0 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 16px -16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 32px -16px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -32px rgba(<?php echo $load_color2_hex; ?>, 1), 16px -32px rgba(<?php echo $load_color2_hex; ?>, 1), 32px -32px rgba(<?php echo $load_color1_hex; ?>, 0); }
.c-load--type2:after { background-color: rgba(<?php echo $load_color1_hex; ?>, 1); }
<?php elseif ( 'type3' == $dp_options['load_icon'] ) : ?>
.c-load--type3 i { background: <?php echo esc_html( $dp_options['load_color1'] ); ?>; }
<?php endif; ?>
<?php /* hover effect */ ?>
<?php if ( $dp_options['hover1_rotate'] ) : ?>
.p-hover-effect--type1:hover img { -webkit-transform: scale(<?php echo esc_html( $dp_options['hover1_zoom'] ); ?>) rotate(2deg); transform: scale(<?php echo esc_html( $dp_options['hover1_zoom'] ); ?>) rotate(2deg); }
<?php else : ?>
.p-hover-effect--type1:hover img { -webkit-transform: scale(<?php echo esc_html( $dp_options['hover1_zoom'] ); ?>); transform: scale(<?php echo esc_html( $dp_options['hover1_zoom'] ); ?>); }
<?php endif; ?>
<?php if ( 'type1' == $dp_options['hover2_direct'] ) : ?>
.p-hover-effect--type2 img { margin-left: -8px; }
.p-hover-effect--type2:hover img { margin-left: 8px; }
<?php else : ?>
.p-hover-effect--type2 img { margin-left: 8px; }
.p-hover-effect--type2:hover img { margin-left: -8px; }
<?php endif; ?>
<?php if ( 1 > $dp_options['hover1_opacity'] ) : ?>
.p-hover-effect--type1:hover .p-hover-effect__image { background: <?php echo esc_html( $dp_options['hover1_bgcolor'] ); ?>; }
.p-hover-effect--type1:hover img { opacity: <?php echo esc_html( $dp_options['hover1_opacity'] ); ?>; }
<?php endif; ?>
.p-hover-effect--type2:hover .p-hover-effect__image { background: <?php echo esc_html( $dp_options['hover2_bgcolor'] ); ?>; }
.p-hover-effect--type2:hover img { opacity: <?php echo esc_html( $dp_options['hover2_opacity'] ); ?> }
.p-hover-effect--type3:hover .p-hover-effect__image { background: <?php echo esc_html( $dp_options['hover3_bgcolor'] ); ?>; }
.p-hover-effect--type3:hover img { opacity: <?php echo esc_html( $dp_options['hover3_opacity'] ); ?>; }
<?php /* Page header */ ?>
<?php if ( is_404() ) : ?>
.p-page-header::before { background: rgba(<?php echo esc_html( implode( ', ', hex2rgb( $dp_options['overlay_404'] ) ) ); ?>, <?php echo esc_html( $dp_options['overlay_opacity_404'] ); ?>) }
<?php elseif ( is_page() && ! is_front_page() ) : // フロントページも固定ページのため、条件から除く ?>
<?php if(isset($post->page_overlay_opacity)){ $opacity = $post->page_overlay_opacity; }else{ $opacity = 0; } ?>
.p-page-header::before { background: rgba(<?php echo esc_html( implode( ', ', hex2rgb( $post->page_overlay ) ) ); ?>, <?php echo esc_html( $opacity ); ?>) }
<?php endif; ?>
<?php /* Entry */ ?>
.p-entry__title { font-size: <?php echo esc_html( $dp_options['title_font_size'] ); ?>px; }
.p-entry__title, .p-article__title { color: <?php echo esc_html( $dp_options['title_color'] ); ?> }
.p-entry__body { font-size: <?php echo esc_html( $dp_options['content_font_size'] ); ?>px; }
.p-entry__body, .p-author__desc, .p-blog-archive__item-excerpt { color: <?php echo esc_html( $dp_options['content_color'] ); ?>; }
<?php if ( is_page() && $post->content_font_size ) { ?>
body.page .p-entry__body { font-size: <?php echo esc_html( $post->content_font_size ); ?>px; }
<?php } ?>
<?php /* News */ ?>
.p-entry-news__title { font-size: <?php echo esc_html( $dp_options['news_title_font_size'] ); ?>px; }
.p-entry-news__title, .p-article-news__title { color: <?php echo esc_html( $dp_options['news_title_color'] ); ?> }
.p-entry-news__body { color: <?php echo esc_html( $dp_options['news_content_color'] ); ?>; font-size: <?php echo esc_html( $dp_options['news_content_font_size'] ); ?>px; }
<?php /* Header */ ?>
body.l-header__fix .is-header-fixed .l-header__bar { background: rgba(<?php echo esc_html( implode( ', ', hex2rgb( $dp_options['header_bg'] ) ) ); ?>, <?php echo esc_html( $dp_options['header_opacity'] ); ?>); }
.l-header a, .p-global-nav > li > a { color: <?php echo esc_html( $dp_options['header_font_color'] ); ?>; }
<?php /* logo */ ?>
.p-logo__header--text a { font-size: <?php echo esc_html( $dp_options['logo_font_size'] ); ?>px; }
.p-logo__footer--text a { font-size: <?php echo esc_html( $dp_options['footer_logo_font_size'] ); ?>px; }
<?php /* Footer bar */ ?>
<?php if ( is_mobile() && ( 'type1' === $dp_options['footer_bar_display'] || 'type2' === $dp_options['footer_bar_display'] ) ) : ?>
.c-footer-bar { background: rgba(<?php echo implode( ',', hex2rgb( $dp_options['footer_bar_bg'] ) ) . ', ' . esc_html( $dp_options['footer_bar_tp'] ); ?>); border-top: 1px solid <?php echo esc_html( $dp_options['footer_bar_border'] ); ?>; color:<?php echo esc_html( $dp_options['footer_bar_color'] ); ?>; }
.c-footer-bar a { color: <?php echo esc_html( $dp_options['footer_bar_color'] ); ?>; }
.c-footer-bar__item + .c-footer-bar__item { border-left: 1px solid <?php echo esc_html( $dp_options['footer_bar_border'] ); ?>; }
<?php endif; ?>
<?php /* Responsive */ ?>
<?php if ( ! is_no_responsive() ) : ?>
@media only screen and (max-width: 991px) {
	.l-header__bar--mobile { background-color: rgba(<?php echo esc_html( implode( ', ', hex2rgb( $dp_options['header_bg'] ) ) ); ?>, <?php echo esc_html( $dp_options['header_opacity'] ); ?>); }
	.p-logo__header--mobile.p-logo__header--text a { font-size: <?php echo esc_html( $dp_options['logo_font_size_mobile'] ); ?>px; }
	.p-global-nav { background-color: rgba(<?php echo implode( ',', hex2rgb( $dp_options['submenu_bg_color'] ) ) . ', ' . esc_html( $dp_options['header_opacity'] ) ?>); }
	.p-global-nav a, .p-global-nav .sub-menu a, .p-global-nav .menu-item-has-children > a > span::before { color: <?php echo esc_html( $dp_options['submenu_color'] ); ?> !important; }
	.p-logo__footer--mobile.p-logo__footer--text a { font-size: <?php echo esc_html( $dp_options['footer_logo_font_size_mobile'] ); ?>px; }
	.p-entry__title { font-size: <?php echo esc_html( $dp_options['title_font_size_mobile'] ); ?>px; }
	.p-entry__body { font-size: <?php echo esc_html( $dp_options['content_font_size_mobile'] ); ?>px; }
	.p-entry-news__title { font-size: <?php echo esc_html( $dp_options['news_title_font_size_mobile'] ); ?>px; }
	.p-entry-news__body { font-size: <?php echo esc_html( $dp_options['news_content_font_size_mobile'] ); ?>px; }
<?php	if ( is_page() && $post->content_font_size_mobile ) { ?>
	body.page .p-entry__body { font-size: <?php echo esc_html( $post->content_font_size_mobile ); ?>px; }
<?php	} ?>
}
<?php if ( 'type2' == $dp_options['load_icon'] ) : ?>
@media only screen and (max-width: 767px) {
	@-webkit-keyframes loading-square-loader {
		0% { box-shadow: 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 0), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		5% { box-shadow: 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 0), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		10% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		15% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -15px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		20% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -15px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		25% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -15px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		30% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -50px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		35% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -50px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		40% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -50px rgba(242, 205, 123, 0); }
		45%, 55% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		60% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		65% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		70% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		75% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		80% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		85% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -15px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		90% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -15px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -15px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		95%, 100% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -15px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -15px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -15px rgba(<?php echo $load_color1_hex; ?>, 0); }
	}
	@keyframes loading-square-loader {
		0% { box-shadow: 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 0), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		5% { box-shadow: 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 0), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		10% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		15% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -15px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		20% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -15px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		25% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -15px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		30% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -50px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		35% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -50px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(242, 205, 123, 0); }
		40% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -50px rgba(242, 205, 123, 0); }
		45%, 55% { box-shadow: 10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		60% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		65% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -10px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		70% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		75% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -10px rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		80% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		85% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -15px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		90% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -15px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -15px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 1); }
		95%, 100% { box-shadow: 10px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px 5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -5px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -5px rgba(<?php echo $load_color2_hex; ?>, 0), 0 -15px rgba(<?php echo $load_color2_hex; ?>, 0), 10px -15px rgba(<?php echo $load_color2_hex; ?>, 0), 20px -15px rgba(<?php echo $load_color1_hex; ?>, 0); }
	}
	.c-load--type2:before { box-shadow: 10px 0 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px 0 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 10px -10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 20px -10px 0 rgba(<?php echo $load_color2_hex; ?>, 1), 0 -20px rgba(<?php echo $load_color2_hex; ?>, 1), 10px -20px rgba(<?php echo $load_color2_hex; ?>, 1), 20px -20px rgba(<?php echo $load_color1_hex; ?>, 0); }
}
<?php endif; ?>
<?php endif; ?>
<?php
if ( is_front_page() ) {
	$css = array();
	$css_mobile = array();

	// image slider caption
	if ( 'type2' == $dp_options['header_content_type'] ) {
		for ( $i = 1; $i <= 3 * $dp_options['media_slider_division']; $i++ ) {
			$slider_shadow1 = $dp_options['slider' . $i . '_shadow1'];
			$slider_shadow2 = $dp_options['slider' . $i . '_shadow2'];
			$slider_shadow3 = $dp_options['slider' . $i . '_shadow3'];
			$slider_shadow4 = $dp_options['slider' . $i . '_shadow_color'];

			// video
			if ( 1 == $dp_options['media_slider_division'] && 'type2' == $dp_options['slider_media_type' . $i] ) {
				if ( ! wp_is_mobile() && ! $dp_options['slider_video' . $i] ) {
					continue;
				} elseif ( ! $dp_options['slider_video_image' . $i] ) {
					continue;
				}

			// youtube
			} elseif ( 1 == $dp_options['media_slider_division'] && 'type3' == $dp_options['slider_media_type' . $i] ) {
				if ( ! wp_is_mobile() && ! $dp_options['slider_youtube_url' . $i] ) {
					continue;
				} elseif ( ! $dp_options['slider_youtube_image' . $i] ) {
					continue;
				}

			// image
			} elseif ( ! $dp_options['slider_image' . $i] ) {
					continue;
			}

			if ( $dp_options['display_slider_headline' . $i] && $dp_options['slider_headline' . $i] ) {
				$css[] = '.p-index-slider__item--' . $i .' .p-index-slider__item-catch { color: ' . esc_attr( $dp_options['slider_font_color' . $i] ) . '; font-size: ' . esc_attr( $dp_options['slider_headline_font_size' . $i] ) . 'px; text-shadow: ' . esc_attr( $slider_shadow1 ) . 'px ' . esc_attr( $slider_shadow2 ) . 'px ' . esc_attr( $slider_shadow3 ) . 'px ' . esc_attr( $slider_shadow4 ) . '; }';
				$css_mobile[] = '.p-index-slider__item--' . $i .' .p-index-slider__item-catch { font-size: ' . esc_attr( $dp_options['slider_headline_font_size_mobile' . $i] ) . 'px; }';
			}
			if ( $dp_options['display_slider_headline' . $i] && $dp_options['slider_desc' . $i] ) {
				$css[] = '.p-index-slider__item--' . $i .' .p-index-slider__item-desc { color: ' . esc_attr( $dp_options['slider_font_color' . $i] ) . '; font-size: ' . esc_attr( $dp_options['slider_desc_font_size' . $i] ) . 'px; text-shadow: ' . esc_attr( $slider_shadow1 ) . 'px ' . esc_attr( $slider_shadow2 ) . 'px ' . esc_attr( $slider_shadow3 ) . 'px ' . esc_attr( $slider_shadow4 ) . '; }';
				$css_mobile[] = '.p-index-slider__item--' . $i .' .p-index-slider__item-desc { font-size: ' . esc_attr( $dp_options['slider_desc_font_size_mobile' . $i] ) . 'px; }';
			}
			if ( $dp_options['display_slider_button' . $i] && $dp_options['slider_button_label' . $i] ) {
				$css[] = '.p-index-slider__item--' . $i .' .p-index-slider__item-button { background-color: ' . esc_attr( $dp_options['slider_button_bg_color' . $i] ) . '; color: ' . esc_attr( $dp_options['slider_button_font_color' . $i] ) . '; }';
				$css[] = '.p-index-slider__item--' . $i .' .p-index-slider__item-button:hover { background-color: ' . esc_attr( $dp_options['slider_button_bg_color_hover' . $i] ) . '; color: ' . esc_attr( $dp_options['slider_button_font_color_hover' . $i] ) . '; }';
			}
		}
	} else {
		$css[] = '.p-header-blog__item-info .p-header-blog__item-title { font-size: ' . esc_attr( $dp_options['header_blog_title_font_size'] ) . 'px; }';
		$css_mobile[] = '.p-header-blog__item-info .p-header-blog__item-title { font-size: ' . esc_attr( $dp_options['header_blog_title_font_size_mobile'] ) . 'px; }';
	}

	// カルーセル
	if ( $dp_options['show_header_carousel'] ) {
		$css[] = '.p-index-carousel__item-title { font-size: ' . esc_attr( $dp_options['header_carousel_title_font_size'] ) . 'px; }';
		$css_mobile[] = '.p-index-carousel__item-title { font-size: ' . esc_attr( $dp_options['header_carousel_title_font_size_mobile'] ) . 'px; }';
	}

	// コンテンツビルダー
	if ( ! empty( $dp_options['contents_builder'] ) ) {
		foreach ( $dp_options['contents_builder'] as $key => $cb_content ) {
			$cb_index = 'cb_' . $key;
			if ( empty( $cb_content['cb_content_select'] ) || empty( $cb_content['cb_display'] ) ) continue;

			// 最新ブログ記事一覧
			if ( 'blog' == $cb_content['cb_content_select'] ) {
				$css[] = '#{$cb_index} .p-blog-archive__item-title { font-size: ' . esc_attr( $cb_content['cb_title_font_size'] ) . 'px; }';
				$css_mobile[] = '#{$cb_index} .p-blog-archive__item-title { font-size: ' . esc_attr( $cb_content['cb_title_font_size_mobile'] ) . 'px; }';

			// カテゴリー記事一覧
			} elseif ( 'category' == $cb_content['cb_content_select'] ) {
				if ( 2 == $cb_content['cb_layout'] ) {
					$css[] = '#{$cb_index} .p-cb-column--1 .p-index-blog__item-title { font-size: ' . esc_attr( $cb_content['cb_title_font_size'] ) . 'px; }';
					$css_mobile[] = '#{$cb_index} .p-cb-column--1 .p-index-blog__item-title { font-size: ' . esc_attr( $cb_content['cb_title_font_size_mobile'] ) . 'px; }';
					$css[] = '#{$cb_index} .p-cb-column--2 .p-index-blog__item-title { font-size: ' . esc_attr( $cb_content['cb_title_font_size2'] ) . 'px; }';
					$css_mobile[] = '#{$cb_index} .p-cb-column--2 .p-index-blog__item-title { font-size: ' . esc_attr( $cb_content['cb_title_font_size_mobile2'] ) . 'px; }';
				} else {
					$css[] = '#{$cb_index} .p-index-blog__item-title { font-size: ' . esc_attr( $cb_content['cb_title_font_size'] ) . 'px; }';
					$css_mobile[] = '#{$cb_index} .p-index-blog__item-title { font-size: ' . esc_attr( $cb_content['cb_title_font_size_mobile'] ) . 'px; }';
				}
			}
		}
	}

	if ( $css ) {
		echo implode( "\n", $css ) . "\n";
	}
	if ( $css_mobile && ! is_no_responsive() ) {
		echo "@media only screen and (max-width: 991px) {\n";
		echo "  " . implode( "\n  ", $css_mobile ) . "\n";
		echo "}\n";
	}
}
?>
<?php /* Custom CSS */ ?>
<?php if ( $dp_options['css_code'] ) { echo $dp_options['css_code']; } ?>
</style>
<?php
}
add_action( 'wp_head', 'tcd_head' );

// Custom head/script
function tcd_custom_head() {
  $options = get_design_plus_option();

  if ( $options['custom_head'] ) {
    echo $options['custom_head'] . "\n";
  }
}
add_action( 'wp_head', 'tcd_custom_head', 9999 );
?>

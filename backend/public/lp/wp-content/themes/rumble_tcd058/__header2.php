<?php
global $dp_options, $tcd_megamenu;
if ( ! $dp_options ) $dp_options = get_design_plus_option();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head <?php if ( $dp_options['use_ogp'] ) { echo 'prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"'; } ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="description" content="<?php seo_description(); ?>">
<meta name="viewport" content="width=<?php echo is_no_responsive() ? '1280' : 'device-width'; ?>">
<?php include('../inc/link.php'); ?>

<?php if ( $dp_options['use_ogp'] ) { ogp(); } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php include('../inc/link_body.php'); ?>

<?php if ( $dp_options['use_load_icon'] ) : ?>
<div id="site_loader_overlay">
	<div id="site_loader_animation" class="c-load--<?php echo esc_attr( $dp_options['load_icon'] ); ?>">
		<?php if ( 'type3' === $dp_options['load_icon'] ) : ?>
		<i></i><i></i><i></i><i></i>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<div id="site_wrap">
	<header id="js-header" class="l-header<?php if ( $dp_options['show_header_search'] && get_query_var('s') ) echo ' is-header-search-active'; ?>">
<?php
if( is_front_page() || is_home() || is_archive() ){ $thisTag = 'h1'; }else{ $thisTag = 'div'; }
if ( ! is_no_responsive() ) :
	if ( 'yes' == $dp_options['use_logo_image'] && $image = wp_get_attachment_image_src( $dp_options['header_logo_image_mobile'], 'full' ) ) :
?>
		<div class="p-header__logo--mobile l-header__bar--mobile">
			<div class="p-logo p-logo__header--mobile<?php if ( $dp_options['header_logo_image_mobile_retina'] ) echo ' p-logo__header--retina'; ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $image[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"<?php if ( $dp_options['header_logo_image_mobile_retina'] ) echo ' width="' . floor( $image[1] / 2 ) . '"'; ?>></a>
			</div>
			<!-- <a href="#" id="js-menu-button" class="p-menu-button c-menu-button"></a> -->
						<!-- 追加 -->
			<!-- <button type="button" class="menu-btn c-menu-button"> -->
			<!-- <a href="#" id="js-menu-button" class="s-gnav-btn p-menu-button c-menu-button"></a> -->
			<div class="s-gnav-btn p-menu-button c-menu-button"></div>
    <!-- </button> -->
    <div class="s-gnav">
      <!-- <div class="s-gnav_item">ビジネスシーン</div>
      <div class="s-gnav_item">ライフスタイル</div>
      <div class="s-gnav_item">スーツファッション</div>
      <div class="s-gnav_item">フォーマル</div>
      <div class="s-gnav_item">雑貨、グッズ</div>
      <div class="s-gnav_item">修理メンテナンス</div> -->
			<?php
				wp_nav_menu( array(
					'menu' => 'mobile menu corporate'
					) );
					?>
			<?php
				wp_nav_menu( array(
					'menu' => 'mobile menu'
					) );
					?>
					<div class="s-gnav-search">
						<?php get_search_form(); ?>
					</div>

    </div>

<script>
document.querySelector('.s-gnav-btn').addEventListener('click', function(){
document.querySelector('.s-gnav').classList.toggle('is-active');
}
);
</script>
<!--  -->
		</div>
		<?php
	else :
		?>
		<div class="p-header__logo--mobile l-header__bar--mobile">
			<div class="p-logo p-logo__header--mobile p-logo__header--text">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</div>
			<a href="#" id="js-menu-button" class="p-menu-button c-menu-button"></a>
		</div>
<?php
	endif;
endif;

// ヘッダーソーシャルボタン
$sns_html = '';
foreach ( array( 'facebook', 'twitter', 'youtube', 'instagram', 'pinterest', 'contact' ) as $value ) :
	if ( !empty( $dp_options[$value . '_url'] ) && !empty( $dp_options['show_' . $value . '_header'] ) ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--' . $value . '"><a href="' . esc_attr( $dp_options[$value . '_url'] ) . '" target="_blank"></a></li>';
	endif;
endforeach;
if ( $dp_options['show_rss_header'] ) :
	$sns_html .= '<li class="p-social-nav__item p-social-nav__item--rss"><a href="' . get_bloginfo( 'rss2_url' ) . '" target="_blank"></a></li>';
endif;

if ( ( 'type1' == $dp_options['header_top'] && has_nav_menu( 'header' ) ) || ( 'type2' == $dp_options['header_top'] && get_bloginfo( 'description' ) ) || $sns_html || $dp_options['show_header_search'] ) :
?>
		<div class="p-header__top u-clearfix">
			<div class="l-inner">
<?php
	if ( 'type1' == $dp_options['header_top'] && has_nav_menu( 'header' ) ) :
		wp_nav_menu( array(
			'container' => 'nav',
			'menu_class' => 'p-header-nav',
			'theme_location' => 'header',
			'link_after' => '<span></span>',
			'depth' => 1
		) );
		echo "\n";
	elseif ( 'type2' == $dp_options['header_top'] && get_bloginfo( 'description' ) ) :
		echo "\t\t\t\t" . '<div class="p-header-description">' . get_bloginfo( 'description' ) . '</div>' . "\n";
	endif;

	if ( $dp_options['show_header_search'] || $sns_html ) :
?>
				<div class="u-right">
<?php
		if ( $sns_html ) :
?>
					<ul class="p-social-nav"><?php echo $sns_html; ?></ul>
<?php
		endif;

		if ( $dp_options['show_header_search'] ) :
?>
					<div class="p-header-search">
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
							<input type="text" name="s" value="<?php echo esc_attr( get_query_var( 's' ) ); ?>" class="p-header-search__input" placeholder="SEARCH">
						</form>
						<a href="#" id="js-search-button" class="p-search-button c-search-button"></a>
					</div>
<?php
		endif;
?>
				</div>
<?php
	endif;
?>
			</div>
		</div>
<?php
endif;

// ヘッダー広告
$header_ad_html = '';
if ( $dp_options['header_ad_code1'] || ( $dp_options['header_ad_image1'] && $header_ad_image1 = wp_get_attachment_image_src( $dp_options['header_ad_image1'], 'full' ) ) ) :
	if ( $dp_options['header_ad_code1'] ) :
		$header_ad_html .= "\t\t\t\t" . '<div class="p-header__ad">' . $dp_options['header_ad_code1'] . '</div>' . "\n";
	elseif ( $header_ad_image1 ) :
		$header_ad_html .= "\t\t\t\t" . '<div class="p-header__ad"><a href="' . esc_url( $dp_options['header_ad_url1'] ) . '" target="_blank"><img src="' . esc_attr( $header_ad_image1[0] ) . '" alt=""></a></div>' . "\n";
	endif;
endif;
if ( $dp_options['header_ad_code2'] || ( $dp_options['header_ad_image2'] && $header_ad_image2 = wp_get_attachment_image_src( $dp_options['header_ad_image2'], 'full' ) ) ) :
	if ( $dp_options['header_ad_code2'] ) :
		$header_ad_html .= "\t\t\t\t" . '<div class="p-header__ad">' . $dp_options['header_ad_code2'] . '</div>' . "\n";
	elseif ( $header_ad_image2 ) :
		$header_ad_html .= "\t\t\t\t" . '<div class="p-header__ad"><a href="' . esc_url( $dp_options['header_ad_url2'] ) . '" target="_blank"><img src="' . esc_attr( $header_ad_image2[0] ) . '" alt=""></a></div>' . "\n";
	endif;
endif;
?>
		<div class="p-header__logo<?php if ( $header_ad_html ) echo ' has-ad'; ?>">
			<div class="l-inner">
<?php
if ( 'yes' == $dp_options['use_logo_image'] && $image = wp_get_attachment_image_src( $dp_options['header_logo_image'], 'full' ) ) :
?>
				<<?php echo $thisTag; ?> class="p-logo p-logo__header<?php if ( $dp_options['header_logo_image_retina'] ) { echo ' p-logo__header--retina'; } ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $image[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"<?php if ( $dp_options['header_logo_image_retina'] ) echo ' width="' . floor( $image[1] / 2 ) . '"'; ?>></a>
					<!-- 追加 -->
					<nav class="gnav">
					<?php
					wp_nav_menu( array(
						'menu' => 'corporate menu'
					) );
					?>
					</nav>
					<!--  -->
					</<?php echo $thisTag; ?>>
<?php
else :
?>
				<<?php echo $thisTag; ?> class="p-logo p-logo__header p-logo__header--text">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				</<?php echo $thisTag; ?>>
<?php
endif;

if ( $header_ad_html ) :
	echo $header_ad_html;
endif;
?>
			</div>
		</div>
<?php
if ( has_nav_menu( 'global' ) ) :
	$nav = wp_nav_menu( array(
		'container' => 'nav',
		'container_class' => 'p-header__gnav l-header__bar',
		'menu_class' => 'l-inner p-global-nav u-clearfix',
		'menu_id' => 'js-global-nav',
		'theme_location' => 'global',
		'link_after' => '<span></span>',
		'echo' => 0
	) );
	if ( $dp_options['show_header_search'] ) :
		$nav_replace = "$0\n";
		$nav_replace .= '<li class="p-header-search--mobile">';
		$nav_replace .= '<form action="' . esc_url( home_url( '/' ) ) . '" method="get">';
		$nav_replace .= '<input type="text" name="s" value="' . esc_attr( get_query_var( 's' ) ) . '" class="p-header-search__input" placeholder="SEARCH">';
		$nav_replace .= '<input type="submit" value="&#xe915;" class="p-header-search__submit">';
		$nav_replace .= '</form>';
		$nav_replace .= "</li>\n";
		$nav = preg_replace('/<ul.*?js-global-nav.*?>/', $nav_replace, $nav);
	endif;
	echo $nav . "\n";
endif;

if ( $tcd_megamenu ) :
	foreach ( $tcd_megamenu as $menu_id => $value ) :
		if ( empty( $value['categories'] ) ) continue;
?>
		<div id="p-megamenu--<?php echo esc_attr( $menu_id ) ?>" class="p-megamenu p-megamenu--<?php echo esc_attr( $value['type'] ); ?><?php
			if ( ! empty( $value['item']->object_id ) && 'taxonomy' === $value['item']->type && 'category' === $value['item']->object ) :
				echo ' p-megamenu-parent-category p-megamenu-term-id-' . esc_attr( $value['item']->object_id );
			endif;
		?>">
			<ul class="l-inner p-megamenu__bg">
<?php
		$cnt = 0;
		foreach ( $value['categories'] as $menu ) :
			$category = get_term_by( 'id', $menu->object_id, 'category' );
			if ( empty( $category->term_id ) ) continue;

			if ( 'type2' === $value['type'] ) :
				$term_meta = get_option( 'taxonomy_' . $category->term_id );
				$image_src = null;
				$li_class = array();
				if ( ! empty( $term_meta['image_megamenu'] ) ) :
					$image_src = wp_get_attachment_image_src( $term_meta['image_megamenu'], 'size3' );
				endif;
				if ( ! $image_src && ! empty( $term_meta['image'] ) ) :
					$image_src = wp_get_attachment_image_src( $term_meta['image'], 'size3' );
				endif;
				if ( ! empty( $image_src[0] ) ) :
					$image_src = $image_src[0];
				else :
					$image_src = get_template_directory_uri() . '/img/no-image-600x420.gif';
				endif;
				if ( is_category( $category->slug ) ) :
					$li_class[] = 'p-megamenu__current';
				endif;
				if (count($value['categories']) - $cnt <= count($value['categories']) % 5 ) :
					$li_class[] = 'p-megamenu__last-row';
				endif;
				if ( $li_class ) :
					$li_class = ' class="' . implode( ' ', $li_class ) . '"';
				else :
					$li_class = '';
				endif;
?>
				<li<?php echo $li_class; ?>><a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo get_category_link( $category->term_id ); ?>"><div class="p-megamenu__image p-hover-effect__image js-object-fit-cover"><img src="<?php echo esc_attr( $image_src ); ?>" alt=""></div><?php echo esc_html( $category->name ); ?></a></li>
<?php
			elseif ( 'type3' === $value['type'] ) :
				// ネイティブ広告
				if ( ! empty( $dp_options['megamenu']['show_native_ad'] ) && in_array( $menu_id, $dp_options['megamenu']['show_native_ad'] ) ) :
					$native_ad = get_native_ad();
				else :
					$native_ad = false;
				endif;

				$megamenu_posts = get_posts( array(
					'cat' => $category->term_id,
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $native_ad ? 3 : 4
				) );
?>
				<li<?php if ( ! $cnt ) echo ' class="is-active"'; ?>>
					<a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></a>
<?php
				if ( $megamenu_posts || $native_ad ) :
?>
					<ul class="sub-menu p-megamenu__bg">
<?php
					if ( $megamenu_posts ) :
						foreach ( $megamenu_posts as $megamenu_post ) :
							if ( has_post_thumbnail( $megamenu_post->ID ) ) :
								$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $megamenu_post->ID ), 'size3' );
							else :
								$image_src = null;
							endif;
							if ( ! empty( $image_src[0] ) ) :
								$image_src = $image_src[0];
							else :
								$image_src = get_template_directory_uri() . '/img/no-image-600x420.gif';
							endif;
?>
						<li><a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo get_permalink( $megamenu_post ); ?>"><div class="p-megamenu__image p-hover-effect__image js-object-fit-cover"><img src="<?php echo esc_attr( $image_src ); ?>" alt=""></div><?php echo mb_strimwidth( strip_tags( get_the_title( $megamenu_post ) ), 0, 50, '...' ); ?></a></li>
<?php
						endforeach;
					endif;

					// ネイティブ広告
					if ( $native_ad ) :
						if ( ! empty( $native_ad['native_ad_image'] ) ) :
							$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size2' );
						else :
							$image_src = null;
						endif;
						if ( ! empty( $image_src[0] ) ) :
							$image_src = $image_src[0];
						else :
							$image_src = get_template_directory_uri() . '/img/no-image-600x420.gif';
						endif;
?>
						<li><a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>" targer="_blank"><div class="p-megamenu__image p-hover-effect__image"><img src="<?php echo esc_attr( $image_src ); ?>" alt=""><?php if ( $native_ad['native_ad_label'] ) : ?><div class="p-float-native-ad-label__small"><?php echo esc_html( $native_ad['native_ad_label'] ); ?></div><?php endif; ?></div>
						<?php echo esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, 50, '...' ) ); ?></a></li>
<?php
					endif;
?>
					</ul>
<?php
				endif;
?>
				</li>
<?php
			elseif ( 'type4' === $value['type'] ) :
?>
				<li<?php if ( is_category( $category->slug ) ) echo ' class="p-megamenu__current"'; ?>><a class="p-megamenu__hover" href="<?php echo get_category_link( $category->term_id ); ?>"><span><?php echo esc_html( $category->name ); ?></span></a></li>
<?php
			endif;
			$cnt++;
		endforeach;
?>
			</ul>
		</div>
<?php
	endforeach;
endif;
?>
	</header>

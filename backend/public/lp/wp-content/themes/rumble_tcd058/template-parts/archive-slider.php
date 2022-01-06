<?php
global $dp_options, $post;
if ( ! $dp_options ) $dp_options = get_design_plus_option();

$archive_slider_setting = array();
$archive_slides = array();

if ( is_category() ) :
	$term_meta = get_option( 'taxonomy_' . get_query_var( 'cat' ), array() );
	$term_meta = array_merge( array(
		'color' => '#999999',
		'image_megamenu' => null,
		'desc_font_size' => 16,
		'desc_font_size_mobile' => 14,
		'archive_large' => '',
		'archive_slider' => '',
		'archive_slider_image1' => '',
		'archive_slider_headline1' => '',
		'archive_slider_url1' => '',
		'archive_slider_target1' => '',
		'archive_slider_image2' => '',
		'archive_slider_headline2' => '',
		'archive_slider_url2' => '',
		'archive_slider_target2' => '',
		'archive_slider_image3' => '',
		'archive_slider_headline3' => '',
		'archive_slider_url3' => '',
		'archive_slider_target3' => '',
		'archive_slider_image4' => '',
		'archive_slider_headline4' => '',
		'archive_slider_url4' => '',
		'archive_slider_target4' => '',
		'archive_slider_image5' => '',
		'archive_slider_headline5' => '',
		'archive_slider_url5' => '',
		'archive_slider_target5' => '',
		'archive_slider_list_type' => 'type1',
		'archive_slider_category' => 0,
		'archive_slider_order' => '',
		'archive_slider_num' => 3,
		'archive_slider_post_ids' => '',
		'show_archive_slider_category' => 0,
		'show_archive_slider_author' => 0,
		'show_archive_slider_date' => 1,
		'show_archive_slider_views' => 0,
		'show_archive_slider_native_ad' => 0,
		'archive_slider_native_ad_position' => 3
	), $term_meta );
endif;

if ( ! empty( $term_meta['archive_slider'] ) ) :
	$archive_slider_setting = $term_meta;
else :
	$archive_slider_setting = $dp_options;
endif;

if ( ! empty( $archive_slider_setting['archive_slider'] ) ) :
	$show_archive_slider_category = $archive_slider_setting['show_archive_slider_category'];
	$show_archive_slider_author = $archive_slider_setting['show_archive_slider_author'];
	$show_archive_slider_date = $archive_slider_setting['show_archive_slider_date'];
	$show_archive_slider_views = $archive_slider_setting['show_archive_slider_views'];

	if ( 'type1' == $archive_slider_setting['archive_slider'] ) :
		for ( $i = 1; $i <= 5; $i++ ) :
			$archive_slider_image = wp_get_attachment_image_src( $archive_slider_setting['archive_slider_image' . $i], 'size2');
			if ( ! empty( $archive_slider_image[0] ) ) :
				$archive_slides[] = array(
					'image' => $archive_slider_image[0],
					'title' => $archive_slider_setting['archive_slider_headline' . $i],
					'url' => $archive_slider_setting['archive_slider_url' . $i] ? $archive_slider_setting['archive_slider_url' . $i] : '#',
					'target' => $archive_slider_setting['archive_slider_target' . $i]
				);
			endif;
		endfor;
	elseif ( 'type2' == $archive_slider_setting['archive_slider'] ) :
		// 記事ID指定
		if ( 'type6' == $archive_slider_setting['archive_slider_list_type'] ) :
			foreach ( explode( ',', $archive_slider_setting['archive_slider_post_ids'] ) as $post_id ) :
				$post_id = trim( $post_id );
				if ( ! $post_id || $post_id <= 0 ) continue;
				$archive_slide = get_post( $post_id );
				if ( $archive_slide && 'publish' == $archive_slide->post_status ) :
					$archive_slides[] = $archive_slide;
				endif;
			endforeach;
			if ( $archive_slides && 'random' == $archive_slider_setting['archive_slider_order'] ) :
				shuffle( $archive_slides );
			endif;
		else :
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $archive_slider_setting['archive_slider_num'],
				'ignore_sticky_posts' => true
			);

			if ( 'type2' == $archive_slider_setting['archive_slider_list_type'] && $archive_slider_setting['archive_slider_category'] ) :
				$archive_slider_category = get_category( $archive_slider_setting['archive_slider_category'] );
				if ( ! empty( $archive_slider_category ) && ! is_wp_error( $archive_slider_category ) ) :
					$args['cat'] = $archive_slider_category->term_id;
				else :
					$archive_slider_category = null;
				endif;
			elseif ( 'type3' == $archive_slider_setting['archive_slider_list_type'] ) :
				$args['meta_key'] = 'recommend_post';
				$args['meta_value'] = 'on';
			elseif ( 'type4' == $archive_slider_setting['archive_slider_list_type'] ) :
				$args['meta_key'] = 'recommend_post2';
				$args['meta_value'] = 'on';
			elseif ( 'type5' == $archive_slider_setting['archive_slider_list_type'] ) :
				$args['meta_key'] = 'pickup_post';
				$args['meta_value'] = 'on';
			endif;

			if ( 'rand' == $archive_slider_setting['archive_slider_order'] ) :
				$args['orderby'] = 'rand';
			elseif ( 'date2' == $archive_slider_setting['archive_slider_order'] ) :
				$args['orderby'] = 'date';
				$args['order'] = 'ASC';
			else :
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
			endif;

			$archive_slides = get_posts( $args );
		endif;
	endif;
endif;

if ( $archive_slides ) :
?>
			<div id="js-archive-slider" class="p-archive-slider p-article-slider">
<?php
	$post_count = 0;
	$post_count_with_ad = 0;

	foreach ( $archive_slides as $archive_slide ) :
		$post_count++;
		$post_count_with_ad++;

		if ( is_a( $archive_slide, 'WP_Post' ) ) :
			$catlist_float = array();
			if ( $archive_slider_setting['show_archive_slider_category'] ) :
				// 選択カテゴリーあり
				if ( ! empty( $archive_slider_category ) ) :
					$catlist_float[] = '<span class="p-category-item--' . esc_attr( $archive_slider_category->term_id ) . '" data-url="' . get_category_link( $archive_slider_category ) . '">' . esc_html( $archive_slider_category->name ) . '</span>';
				else :
					$categories = get_the_category( $archive_slide->ID );
					if ( $categories && ! is_wp_error( $categories ) ) :
						foreach ( $categories as $category ) :
							$catlist_float[] = '<span class="p-category-item--' . esc_attr( $category->term_id ) . '" data-url="' . get_category_link( $category ) . '">' . esc_html( $category->name ) . '</span>';
							break;
						endforeach;
					endif;
				endif;
			endif;
?>
				<div class="p-archive-slider__item p-article-slider__item">
					<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo get_permalink( $archive_slide ); ?>">

<?php
			echo "\t\t\t\t\t\t";
			echo '<div class="p-article-slider__item-thumbnail p-hover-effect__image js-object-fit-cover">';

			if ( has_post_thumbnail( $archive_slide ) ) :
				echo get_the_post_thumbnail( $archive_slide, 'size2' );
			else :
				echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x420.gif" alt="">';
			endif;

			if ( $catlist_float ) :
				echo '<div class="p-float-category">' . implode( ', ', $catlist_float ) . '</div>' . "\n";
			endif;

			echo "</div>\n";
?>
						<div class="p-article-slider__item-info">
							<h3 class="p-article-slider__item-title p-article__title"><?php echo mb_strimwidth( strip_tags( get_the_title( $archive_slide ) ), 0, is_mobile() ? 50 : 72, '...' ); ?></h3>
<?php
			if ( $archive_slider_setting['show_archive_slider_author'] || $archive_slider_setting['show_archive_slider_date'] || $archive_slider_setting['show_archive_slider_views'] ) :
				echo "\t\t\t\t\t\t\t";
				echo '<p class="p-article-slider__item-meta p-article__meta">';
				if ( $archive_slider_setting['show_archive_slider_author'] ) :
					the_archive_author( $archive_slide );
				endif;
				if ( $archive_slider_setting['show_archive_slider_date'] ) :
					echo '<time class="p-article__date" datetime="' . get_the_time( 'Y-m-d', $archive_slide ) . '">' . get_the_time( 'Y.m.d', $archive_slide ) . '</time>';
				endif;
				if ( $archive_slider_setting['show_archive_slider_views'] ) :
					echo '<span class="p-article__views">' . number_format( intval( $archive_slide->_views ) ) . ' views</span>';
				endif;
				echo "</p>\n";
			endif;
?>
						</div>
					</a>
				</div>
<?php
		elseif ( is_array( $archive_slide ) ) :
?>
				<div class="p-archive-slider__item p-article-slider__item">
					<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $archive_slide['url'] ); ?>"<?php if ( $archive_slide['target'] ) echo ' target="_blank"' ?>>
						<div class="p-article-slider__item-thumbnail js-object-fit-cover">
							<img src="<?php echo esc_attr( $archive_slide['image'] ); ?>" alt="">
						</div>
<?php
			if ( ! empty ( $archive_slide['title'] ) ) :
?>
						<div class="p-article-slider__item-info">
							<h3 class="p-article-slider__item-title p-article__title"><?php echo esc_html( $archive_slide['title'] ); ?></h3>
						</div>
<?php
			endif;
?>
					</a>
				</div>
<?php
		endif;

		// ネイティブ広告
		if ( 'type2' == $archive_slider_setting['archive_slider'] && $archive_slider_setting['show_archive_slider_native_ad'] && 0 === $post_count % $archive_slider_setting['archive_slider_native_ad_position'] ) :
			$native_ad = get_native_ad();
			if ( $native_ad ) :
				$post_count_with_ad++;
?>
				<div class="p-archive-slider__item p-article-slider__item">
					<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>"  href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
<?php
				echo "\t\t\t\t\t\t";
				echo '<div class="p-article-slider__item-thumbnail p-hover-effect__image js-object-fit-cover">';
				if ( $native_ad['native_ad_image'] ) :
					$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size2' );
				else :
					$image_src = null;
				endif;
				if ( ! empty( $image_src[0] ) ) :
					echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

				else :
					echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x420.gif" alt="">';
				endif;
				echo "</div>\n";
?>
						<div class="p-article-slider__item-info">
<?php
				if ( $native_ad['native_ad_title'] ) :
					echo "\t\t\t\t\t\t\t";
					echo '<h3 class="p-article-slider__item-title p-article__title">' . esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, is_mobile() ? 50 : 72, '...' ) ) . '</h3>' . "\n";
				endif;

				if ( $native_ad['native_ad_sponsor'] || $native_ad['native_ad_label'] ) :
					echo "\t\t\t\t\t\t\t";
					echo '<p class="p-blog-archive__item-meta p-article__meta">';

					if ( $native_ad['native_ad_sponsor'] ) :
						echo '<span class="p-article__native-ad-sponsor">' . esc_html( $native_ad['native_ad_sponsor'] ) . '</span>';
					endif;

					if ( $native_ad['native_ad_label'] ) :
						echo '<span class="p-article__native-ad-label">' .  esc_html( $native_ad['native_ad_label'] ) . '</span>';
					endif;

					echo '</p>' . "\n";
				endif;
?>
						</div>
					</a>
				</div>
<?php
			endif;
		endif;
	endforeach;
?>
			</div>
<?php
endif;

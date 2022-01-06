<?php
global $dp_options, $post;
if ( ! $dp_options ) $dp_options = get_design_plus_option();

// 画像スライダー
if ( 'type2' == $dp_options['header_content_type'] ) :
	$display_slides = 0;
	for ( $i = 1; $i <= 3 * $dp_options['media_slider_division']; $i++ ) :
		$slider_media = null;
		$slider_media_type = null;

		// video
		if ( 1 == $dp_options['media_slider_division'] && 'type2' == $dp_options['slider_media_type' . $i] && $dp_options['slider_video' . $i] ) :
			if ( ! wp_is_mobile() ) : // if is pc
				$slider_media = wp_get_attachment_url( $dp_options['slider_video' . $i] );
				if ( empty( $slider_media ) ) continue;
				$slider_media_type = 'type2';
			else : // if is mobile device
				$slider_image = wp_get_attachment_image_src( $dp_options['slider_video_image' . $i], 'full' );
				if ( empty( $slider_image[0] ) ) continue;
				$slider_media = $slider_image[0];
			endif;

		// youtube
		elseif ( 1 == $dp_options['media_slider_division'] && 'type3' == $dp_options['slider_media_type' . $i] && $dp_options['slider_youtube_url' . $i] ) :
			if ( ! wp_is_mobile() ) : // if is pc
				// parse youtube video id
				// https://stackoverflow.com/questions/2936467/parse-youtube-video-id-using-preg-match
				if ( ! preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $dp_options['slider_youtube_url' . $i], $matches ) ) continue;
				$slider_media = $matches[1];
				$slider_media_type = 'type3';
			else : // if is mobile device
				$slider_image = wp_get_attachment_image_src( $dp_options['slider_youtube_image' . $i], 'full' );
				if ( empty( $slider_image[0] ) ) continue;
				$slider_media = $slider_image[0];
			endif;

		// image
		else :
			$slider_image = wp_get_attachment_image_src( $dp_options['slider_image' . $i], 'size6' );
			if ( empty( $slider_image[0] ) ) continue;
			$slider_media = $slider_image[0];
		endif;

		$slider_overlay_color = $dp_options['slider_overlay_color' . $i] ? $dp_options['slider_overlay_color' . $i] : '#000000';
		$slider_overlay_opacity = isset( $dp_options['slider_overlay_opacity' . $i] ) ? $dp_options['slider_overlay_opacity' . $i] : 0.5;

		if ( ( $dp_options['display_slider_headline' . $i] && ( $dp_options['slider_headline' . $i] || $dp_options['slider_desc' . $i] ) ) || ( $dp_options['display_slider_button' . $i] && $dp_options['slider_button_label' . $i] ) ) :
			$show_slider_content = true;
		else :
			$show_slider_content = false;
		endif;

		$display_slides++;
		if ( 1 == $display_slides ) :
?>
	<div id="js-index-slider" class="p-index-slider p-index-slider--type2" data-slide-time="<?php echo esc_attr( $dp_options['slide_time'] ); ?>" data-division="<?php echo esc_attr( $dp_options['media_slider_division'] ); ?>">
<?php
		endif;
?>
		<div class="p-index-slider__item p-index-slider__item--<?php echo $i; ?><?php if ( $slider_media_type ) echo ' p-index-slider__item--' . esc_attr( $slider_media_type ); ?>">
			<div class="p-index-slider__item-inner">
<?php
		if ( $show_slider_content ) :
?>
				<div class="p-index-slider__item-content">
<?php
			if ( $dp_options['slider_headline' . $i] ) :
?>
					<div class="l-inner p-index-slider__item-catch"><?php echo str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $dp_options['slider_headline' . $i] ) ); ?></div>
<?php
			endif;
			if ( $dp_options['slider_desc' . $i] ) :
?>
					<div class="l-inner p-index-slider__item-desc"><?php echo str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $dp_options['slider_desc' . $i] ) ); ?></div>
<?php
			endif;
			if ( $dp_options['display_slider_button' . $i] && $dp_options['slider_button_label' . $i] ) :
				if ( $dp_options['slider_url' . $i] ) :
?>
					<div class="l-inner"><a class="p-index-slider__item-button p-button" href="<?php echo esc_url( $dp_options['slider_url' . $i] ); ?>"<?php if ( $dp_options['slider_target' . $i] ) echo ' target="_blank"'; ?>><?php echo esc_html( $dp_options['slider_button_label' . $i] ); ?></a></div>
<?php
				else :
?>
					<div class="l-inner p-index-slider__item-button p-button"><?php echo esc_html( $dp_options['slider_button_label' . $i] ); ?></a></div>
<?php
				endif;
			endif;
?>
				</div>
<?php
		endif;

		// video
		if ( 'type2' == $slider_media_type ) :
?>
				<video class="p-index-slider__item-video" muted autoplay>
					<source src="<?php echo esc_attr( $slider_media ); ?>">
				</video>
<?php
			if ( $dp_options['slider_url' . $i] && ( ! $dp_options['display_slider_button' . $i] || ! $dp_options['slider_button_label' . $i] ) ) :
?>
				<a class="p-index-slider__item-overlay" href="<?php echo esc_url( $dp_options['slider_url' . $i] ); ?>"<?php
				if ( $dp_options['slider_target' . $i] ) :
					echo ' target="_blank"';
				endif;
				if ( $dp_options['display_slider_overlay' . $i] && 0 < $slider_overlay_opacity ) :
					echo ' style="background: rgba(' . esc_attr( implode( ', ', hex2rgb( $slider_overlay_color ) ) ) . ', ' . esc_attr( $slider_overlay_opacity ) . ');"';
				endif;
				?>></a>
<?php
			endif;

		// youtube
		elseif ( 'type3' == $slider_media_type ) :
?>
				<iframe id="js-index-slider__item-youtube--<?php echo $i; ?>" class="p-index-slider__item-youtube" src="https://www.youtube.com/embed/<?php echo esc_attr( $slider_media ); ?>?enablejsapi=1&amp;origin=<?php echo esc_url( ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] ); ?>&amp;mute=1&amp;autoplay=0&amp;controls=0&amp;fs=0&amp;iv_load_policy=3&amp;loop=0&amp;showinfo=0&amp;rel=0" frameborder="0"></iframe>
<?php
			if ( $dp_options['slider_url' . $i] && ( ! $dp_options['display_slider_button' . $i] || ! $dp_options['slider_button_label' . $i] ) ) :
?>
				<a class="p-index-slider__item-overlay" href="<?php echo esc_url( $dp_options['slider_url' . $i] ); ?>"<?php
				if ( $dp_options['slider_target' . $i] ) :
					echo ' target="_blank"';
				endif;
				if ( $dp_options['display_slider_overlay' . $i] && 0 < $slider_overlay_opacity ) :
					echo ' style="background: rgba(' . esc_attr( implode( ', ', hex2rgb( $slider_overlay_color ) ) ) . ', ' . esc_attr( $slider_overlay_opacity ) . ');"';
				endif;
				?>></a>
<?php
			endif;

		// image
		else :
			if ( $dp_options['slider_url' . $i] && ( ! $dp_options['display_slider_button' . $i] || ! $dp_options['slider_button_label' . $i] ) ) :
?>
				<a class="p-index-slider__item-image" href="<?php echo esc_url( $dp_options['slider_url' . $i] ); ?>"<?php if ( $dp_options['slider_target' . $i] ) echo ' target="_blank"'; ?>><img src="<?php echo esc_attr( $slider_media ); ?>" alt=""></a>
<?php
			else :
?>
				<div class="p-index-slider__item-image js-object-fit-cover"><img src="<?php echo esc_attr( $slider_media ); ?>" alt=""></div>
<?php
			endif;
			if ( $dp_options['display_slider_overlay' . $i] && 0 < $slider_overlay_opacity ) :
?>
				<div class="p-index-slider__item-overlay" style="background: rgba(<?php echo esc_attr( implode( ', ', hex2rgb( $slider_overlay_color ) ) ) ?>, <?php echo esc_attr( $slider_overlay_opacity ); ?>);"></div>
<?php
			endif;
		endif;
?>
			</div>
		</div>
<?php
	endfor;

	if ( $display_slides ) :
?>
	</div>
<?php
	endif;

// 記事スライダー
else :
	$header_blog_category = null;
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'posts_per_page' => $dp_options['post_slider_division'] * $dp_options['header_blog_slide_num'],
		'ignore_sticky_posts' => true
	);
	if ( 'type2' == $dp_options['header_blog_list_type'] ) :
		$args['meta_key'] = 'recommend_post';
		$args['meta_value'] = 'on';
	elseif ( 'type3' == $dp_options['header_blog_list_type'] ) :
		$args['meta_key'] = 'recommend_post2';
		$args['meta_value'] = 'on';
	elseif ( 'type4' == $dp_options['header_blog_list_type'] ) :
		$args['meta_key'] = 'pickup_post';
		$args['meta_value'] = 'on';
	elseif ( 'type5' == $dp_options['header_blog_list_type'] ) :
	elseif ( $dp_options['header_blog_category'] ) :
		$header_blog_category = get_category( $dp_options['header_blog_category'] );
	endif;
	if ( ! empty( $header_blog_category ) && ! is_wp_error( $header_blog_category ) ) :
		$args['cat'] = $header_blog_category->term_id;
	else :
		$header_blog_category = null;
	endif;
	if ( 'rand' == $dp_options['header_blog_post_order'] ) :
		$args['orderby'] = 'rand';
	elseif ( 'date2' == $dp_options['header_blog_post_order'] ) :
		$args['orderby'] = 'date';
		$args['order'] = 'ASC';
	else :
		$args['orderby'] = 'date';
		$args['order'] = 'DESC';
	endif;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
?>
	<div id="js-index-slider" class="p-index-slider p-index-slider--type1 p-header-blog p-article-slider" data-slide-time="<?php echo esc_attr( $dp_options['slide_time'] ); ?>" data-division="<?php echo esc_attr( $dp_options['post_slider_division'] ); ?>">
<?php
		$post_count = 0;
		$post_count_with_ad = 0;

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$post_count++;
			$post_count_with_ad++;

			$catlist_float = array();
			if ( $dp_options['show_header_blog_category'] ) :
				// 選択カテゴリーを表示
				if ( $header_blog_category ) :
					$catlist_float[] = '<span class="p-category-item--' . esc_attr( $header_blog_category->term_id ) . '" data-url="' . get_category_link( $header_blog_category ) . '">' . esc_html( $header_blog_category->name ) . '</span>';
				else :
					$categories = get_the_category();
					if ( $categories && ! is_wp_error( $categories ) ) :
						foreach( $categories as $category ) :
							$catlist_float[] = '<span class="p-category-item--' . esc_attr( $category->term_id ) . '" data-url="' . get_category_link( $category ) . '">' . esc_html( $category->name ) . '</span>';
							break;
						endforeach;
					endif;
				endif;
			endif;
?>
		<article class="p-header-blog__item p-article-slider__item">
			<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
<?php
			echo "\t\t\t\t";
			echo '<div class="p-header-blog__item-thumbnail p-article-slider__item-thumbnail p-hover-effect__image js-object-fit-cover">';
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'size4' );
			else :
				echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x600.gif" alt="">';
			endif;
			echo "</div>\n";
?>
				<div class="p-header-blog__item-info p-article-slider__item-info">
<?php
			if ( $catlist_float ) :
				echo "\t\t\t\t\t";
				echo '<div class="p-header-blog__item-category p-category-label">' . implode( ', ', $catlist_float ) . '</div>';
				echo "\n";
			endif;
?>
					<h3 class="p-header-blog__item-title p-article-slider__item-title p-article__title"><?php echo mb_strimwidth( strip_tags( get_the_title() ), 0, 80, '...' ); ?></h3>
<?php
			if ( $dp_options['show_header_blog_author'] || $dp_options['show_header_blog_date'] || $dp_options['show_header_blog_views'] ) :
				echo "\t\t\t\t\t";
				echo '<p class="p-header-blog__item-meta p-article__meta">';
				if ( $dp_options['show_header_blog_author'] ) :
					the_archive_author();
				endif;
				if ( $dp_options['show_header_blog_date'] ) :
					echo '<time class="p-article__date" datetime="' . get_the_time( 'Y-m-d' ) . '">' . get_the_time( 'Y.m.d' ) . '</time>';
				endif;
				if ( $dp_options['show_header_blog_views'] ) :
					echo '<span class="p-article__views">' . number_format( intval( $post->_views ) ) . ' views</span>';
				endif;
				echo "</p>\n";
			endif;
?>
				</div>
			</a>
		</article>
<?php
			// ネイティブ広告
			if ( $dp_options['show_header_blog_native_ad'] && 0 === $post_count % $dp_options['header_blog_native_ad_position'] ) :
				$native_ad = get_native_ad();
				if ( $native_ad ) :
					$post_count_with_ad++;
?>
		<article class="p-header-blog__item p-article-slider__item">
			<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
<?php
			echo "\t\t\t\t";
			echo '<div class="p-header-blog__item-thumbnail p-article-slider__item-thumbnail p-hover-effect__image js-object-fit-cover">';
					if ( $native_ad['native_ad_image'] ) :
						$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size4' );
					else :
						$image_src = null;
					endif;
					if ( ! empty( $image_src[0] ) ) :
						echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

					else :
						echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x600.gif" alt="">';
					endif;
			echo "</div>\n";
?>
				<div class="p-header-blog__item-info p-article-slider__item-info">
<?php
					if ( $native_ad['native_ad_title'] ) :
						echo "\t\t\t\t\t";
						echo '<h3 class="p-header-blog__item-title p-article-slider__item-title p-article__title">' . esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, 80, '...' ) ) . '</h3>' . "\n";
					endif;

					if ( $native_ad['native_ad_sponsor'] || $native_ad['native_ad_label'] ) :
						echo "\t\t\t\t\t";
						echo '<p class="p-header-blog__item-meta p-article__meta">';

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
		</article>
<?php
				endif;
			endif;

			if ( $post_count_with_ad >= $dp_options['post_slider_division'] * $dp_options['header_blog_slide_num'] ) :
				break;
			endif;
		endwhile;
		wp_reset_postdata();
?>
	</div>
<?php
	endif;
endif;

// カルーセル
if ( $dp_options['show_header_carousel'] ) :
	$header_carousel_category = null;
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'posts_per_page' => 3 * $dp_options['header_carousel_slide_num'],
		'ignore_sticky_posts' => true
	);
	if ( 'type2' == $dp_options['header_carousel_list_type'] ) :
		$args['meta_key'] = 'recommend_post';
		$args['meta_value'] = 'on';
	elseif ( 'type3' == $dp_options['header_carousel_list_type'] ) :
		$args['meta_key'] = 'recommend_post2';
		$args['meta_value'] = 'on';
	elseif ( 'type4' == $dp_options['header_carousel_list_type'] ) :
		$args['meta_key'] = 'pickup_post';
		$args['meta_value'] = 'on';
	elseif ( 'type5' == $dp_options['header_carousel_list_type'] ) :
	elseif ( $dp_options['header_carousel_category'] ) :
		$header_carousel_category = get_category( $dp_options['header_carousel_category'] );
	endif;
	if ( ! empty( $header_carousel_category ) && ! is_wp_error( $header_carousel_category ) ) :
		$args['cat'] = $header_carousel_category->term_id;
	else :
		$header_carousel_category = null;
	endif;
	if ( 'rand' == $dp_options['header_carousel_post_order'] ) :
		$args['orderby'] = 'rand';
	elseif ( 'date2' == $dp_options['header_carousel_post_order'] ) :
		$args['orderby'] = 'date';
		$args['order'] = 'ASC';
	else :
		$args['orderby'] = 'date';
		$args['order'] = 'DESC';
	endif;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
?>
	<div class="p-index-carousel" style="background: <?php echo esc_attr( $dp_options['header_carousel_bg_color'] ); ?>">
		<div class="l-inner">
			<div id="js-index-carousel" class="p-index-carousel__inner p-article-slider" data-slide-time="<?php echo esc_attr( $dp_options['header_carousel_slide_time'] ); ?>" data-division="<?php echo esc_attr( $dp_options['post_slider_division'] ); ?>">
<?php
		$post_count = 0;
		$post_count_with_ad = 0;

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$post_count++;
			$post_count_with_ad++;
?>
				<article class="p-index-carousel__item p-article-slider__item u-clearfix">
					<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
<?php
			echo "\t\t\t\t\t\t";
			echo '<div class="p-index-carousel__item-thumbnail">';
			echo '<div class="p-index-carousel__item-thumbnail__inner p-article-slider__item-thumbnail p-hover-effect__image js-object-fit-cover">';
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'size1' );
			else :
				echo '<img src="' . get_template_directory_uri() . '/img/no-image-300x300.gif" alt="">';
			endif;
			echo "</div></div>\n";
?>
						<div class="p-index-carousel__item-info">
							<h3 class="p-index-carousel__item-title p-article__title"><?php echo mb_strimwidth( strip_tags( get_the_title() ), 0, 64, '...' ); ?></h3>
<?php
			if ( $dp_options['show_header_carousel_date'] || $dp_options['show_header_carousel_views'] ) :
				echo "\t\t\t\t\t\t\t";
				echo '<p class="p-index-carousel__item-meta p-article__meta">';
				if ( $dp_options['show_header_carousel_date'] ) :
					echo '<time class="p-article__date" datetime="' . get_the_time( 'Y-m-d' ) . '">' . get_the_time( 'Y.m.d' ) . '</time>';
				endif;
				if ( $dp_options['show_header_carousel_views'] ) :
					echo '<span class="p-article__views">' . number_format( intval( $post->_views ) ) . ' views</span>';
				endif;
				echo "</p>\n";
			endif;
?>
						</div>
					</a>
				</article>
<?php
			// ネイティブ広告
			if ( $dp_options['show_header_carousel_native_ad'] && 0 === $post_count % $dp_options['header_carousel_native_ad_position'] ) :
				$native_ad = get_native_ad();
				if ( $native_ad ) :
					$post_count_with_ad++;
?>
				<article class="p-index-carousel__item p-article-slider__item u-clearfix">
					<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
<?php
					echo "\t\t\t\t\t\t";
					echo '<div class="p-index-carousel__item-thumbnail">';
					echo '<div class="p-index-carousel__item-thumbnail__inner p-article-slider__item-thumbnail p-hover-effect__image js-object-fit-cover">';
					if ( $native_ad['native_ad_image'] ) :
						$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size1' );
					else :
						$image_src = null;
					endif;
					if ( ! empty( $image_src[0] ) ) :
						echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

					else :
						echo '<img src="' . get_template_directory_uri() . '/img/no-image-300x300.gif" alt="">';
					endif;
					echo "</div></div>\n";
?>
						<div class="p-index-carousel__item-info">
<?php
					if ( $native_ad['native_ad_title'] ) :
						echo "\t\t\t\t\t\t\t";
						echo '<h3 class="p-index-carousel__item-title p-article__title">' . esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, 64, '...' ) ) . '</h3>' . "\n";
					endif;

					if ( $native_ad['native_ad_sponsor'] || $native_ad['native_ad_label'] ) :
						echo "\t\t\t\t\t\t\t";
						echo '<p class="p-index-carousel__item-meta p-article__meta">';

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
				</article>
<?php
				endif;
			endif;

			if ( $post_count_with_ad >= 3 * $dp_options['header_carousel_slide_num'] ) :
				break;
			endif;
		endwhile;
		wp_reset_postdata();
?>
			</div>
		</div>
	</div>
<?php
	endif;
endif;

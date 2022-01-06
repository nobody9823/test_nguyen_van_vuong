<?php
global $dp_options, $cb_query, $cb_content, $cb_content, $cb_category;

if ( $cb_query->have_posts() ) :
	// 念のためここで使う設定をマージ
	$cb_content += array(
		// articleクラス
		'large_article_class' => 'p-index-blog__large-item u-clearfix',
		'article_class' => 'p-index-blog__item u-clearfix',

		// itemクラス
		'item_class' => 'p-index-blog__item',

		// 大きく表示する数
		'show_large_item_num' => 0,

		// サムネイルサイズ
		'large_thumbnail_size' => 'size2',
		'thumbnail_size' => 'size2',

		// タイトルバイト数
		'large_title_bytes' => 60,
		'large_title_bytes_mobile' => 60,
		'title_bytes' => 60,
		'title_bytes_mobile' => 60,

		// 抜粋表示
		'show_excerpt' => 0,

		// ネイティブ広告
		'cb_show_native_ad' => 0,
		'cb_native_ad_position' => 4,

		// 追加インデント
		'add_indent' => 0
	);

	if ( $cb_content['add_indent'] > 0 ) :
		ob_start();
	endif;

	$post_count = 0;
	$post_count_with_ad = 0;

	while ( $cb_query->have_posts() ) :
		$cb_query->the_post();
		$post_count++;
		$post_count_with_ad++;

		$catlist_float = array();
		if ( $cb_content['cb_show_category'] ) :
			// 選択カテゴリーを表示
			if ( $cb_category ) :
				$catlist_float[] = '<span class="p-category-item--' . esc_attr( $cb_category->term_id ) . '" data-url="' . get_category_link( $cb_category ) . '">' . esc_html( $cb_category->name ) . '</span>';
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

		// 大きく表示フラグ
		if ( $cb_content['show_large_item_num'] && $cb_content['show_large_item_num'] >= $post_count_with_ad ) :
			$is_large_item = true;
			$thumbnail_size = $cb_content['large_thumbnail_size'];
			$title_bytes = $cb_content['large_title_bytes'];
			$title_bytes_mobile = $cb_content['large_title_bytes_mobile'];
		else :
			$is_large_item = false;
			$thumbnail_size = $cb_content['thumbnail_size'];
			$title_bytes = $cb_content['title_bytes'];
			$title_bytes_mobile = $cb_content['title_bytes_mobile'];
		endif;
?>
					<article class="<?php echo esc_attr( $is_large_item ? $cb_content['large_article_class'] : $cb_content['article_class'] ); ?>">
						<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
							<div class="<?php echo esc_attr( $cb_content['item_class'] ); ?>-thumbnail p-hover-effect__image js-object-fit-cover">
								<div class="<?php echo esc_attr( $cb_content['item_class'] ); ?>-thumbnail_inner">
<?php
		echo "\t\t\t\t\t\t\t\t\t";
		if ( 'size1' == $thumbnail_size ) :
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'size1' );
			else :
				echo '<img src="' . get_template_directory_uri() . '/img/no-image-300x300.gif" alt="">';
			endif;
		elseif ( 'size3' == $thumbnail_size ) :
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'size3' );
			else :
				echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x600.gif" alt="">';
			endif;
		else :
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'size2' );
			else :
				echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x420.gif" alt="">';
			endif;
		endif;
		echo "\n";

		if ( $catlist_float ) :
			echo "\t\t\t\t\t\t\t\t\t";
			echo '<div class="p-float-category">' . implode( ', ', $catlist_float ) . '</div>' . "\n";
		endif;
?>
								</div>
							</div>
							<div class="<?php echo esc_attr( $cb_content['item_class'] ); ?>-info">
								<h2 class="<?php echo esc_attr( $cb_content['item_class'] ); ?>-title p-article__title"><?php
									echo mb_strimwidth( get_the_title(), 0, is_mobile() ? $title_bytes_mobile : $title_bytes, '...' );
								?></h2>
<?php
		if ( $cb_content['show_excerpt'] ) :
?>
								<p class="<?php echo esc_attr( $cb_content['item_class'] ); ?>-excerpt u-hidden-xs"><?php echo tcd_the_excerpt(); ?></p>
<?php
		endif;

		if ( $cb_content['cb_show_author'] || $cb_content['cb_show_date'] || $cb_content['cb_show_views'] ) :
			echo "\t\t\t\t\t\t\t\t";
			echo '<p class="' . esc_attr( $cb_content['item_class'] ) . '-meta p-article__meta">';
			if ( $cb_content['cb_show_author'] ) :
				the_archive_author();
			endif;
			if ( $cb_content['cb_show_date'] ) :
				echo '<time class="p-article__date" datetime="' . get_the_time( 'Y-m-d' ) . '">' . get_the_time( 'Y.m.d' ) . '</time>';
			endif;
			if ( $cb_content['cb_show_views'] ) :
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
		if ( $cb_content['cb_show_native_ad'] && 0 === $post_count % absint( $cb_content['cb_native_ad_position'] ) ) :
			$native_ad = get_native_ad();
			if ( $native_ad ) :
				$post_count_with_ad++;

				// 大きく表示フラグ
				if ( $cb_content['show_large_item_num'] && $cb_content['show_large_item_num'] >= $post_count_with_ad ) :
					$is_large_item = true;
					$thumbnail_size = $cb_content['large_thumbnail_size'];
					$title_bytes = $cb_content['large_title_bytes'];
					$title_bytes_mobile = $cb_content['large_title_bytes_mobile'];
				else :
					$is_large_item = false;
					$thumbnail_size = $cb_content['thumbnail_size'];
					$title_bytes = $cb_content['title_bytes'];
					$title_bytes_mobile = $cb_content['title_bytes_mobile'];
				endif;
?>
					<article class="<?php echo esc_attr( $is_large_item ? $cb_content['large_article_class'] : $cb_content['article_class'] ); ?>">
						<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
							<div class="<?php echo esc_attr( $cb_content['item_class'] ); ?>-thumbnail p-hover-effect__image js-object-fit-cover">
								<div class="<?php echo esc_attr( $cb_content['item_class'] ); ?>-thumbnail_inner">
<?php
				$image_src = null;
				echo "\t\t\t\t\t\t\t\t\t";
				if ( 'size1' == $thumbnail_size ) :
					if ( $native_ad['native_ad_image'] ) :
						$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size1' );
					endif;
					if ( ! empty( $image_src[0] ) ) :
						echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

					else :
						echo '<img src="' . get_template_directory_uri() . '/img/no-image-300x300.gif" alt="">';
					endif;

				elseif ( 'size3' == $thumbnail_size ) :
					if ( $native_ad['native_ad_image'] ) :
						$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size3' );
					endif;
					if ( ! empty( $image_src[0] ) ) :
						echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

					else :
						echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x600.gif" alt="">';
					endif;
				else :
					if ( $native_ad['native_ad_image'] ) :
						$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size2' );
					endif;
					if ( ! empty( $image_src[0] ) ) :
						echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

					else :
						echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x420.gif" alt="">';
					endif;
				endif;
				echo "\n";

				if ( $cb_content['cb_show_category'] && $native_ad['native_ad_label'] ) :
					echo "\t\t\t\t\t\t\t\t\t";
					echo '<div class="p-float-native-ad-label">' .  esc_html( $native_ad['native_ad_label'] ) . '</div>' . "\n";
				endif;
?>
								</div>
							</div>
							<div class="<?php echo esc_attr( $cb_content['item_class'] ); ?>-info">
<?php
				if ( $native_ad['native_ad_title'] ) :
					echo "\t\t\t\t\t\t\t\t";
					echo '<h2 class="' . esc_attr( $cb_content['item_class'] ) . '-title p-article__title">';
					echo esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, is_mobile() ? $title_bytes_mobile : $title_bytes, '...' ) );
					echo '</h2>' . "\n";
				endif;

				if ( $cb_content['show_excerpt'] && $native_ad['native_ad_desc'] ) :
					echo "\t\t\t\t\t\t\t\t";
					echo '<p class="' . esc_attr( $cb_content['item_class'] ) . '-excerpt u-hidden-xs">';
					echo str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( mb_strimwidth( trim( $native_ad['native_ad_desc'] ), 0, 160, '...' ) ) );
					echo '</p>' . "\n";
				endif;

				if ( $native_ad['native_ad_sponsor'] || ( ! $cb_content['cb_show_category'] && $native_ad['native_ad_label'] ) ) :
					echo "\t\t\t\t\t\t\t\t";
					echo '<p class="' . esc_attr( $cb_content['item_class'] ) . '-meta p-article__meta">';

					if ( $native_ad['native_ad_sponsor'] ) :
						echo '<span class="p-article__native-ad-sponsor">' . esc_html( $native_ad['native_ad_sponsor'] ) . '</span>';
					endif;

					if ( ! $cb_content['cb_show_category'] && $native_ad['native_ad_label'] ) :
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

	endwhile;

	if ( $cb_content['add_indent'] > 0 ) :
		$_html = ob_get_clean();
		if ( $_html ) :
			echo str_repeat( "\t", $cb_content['add_indent'] ) . str_replace( "\n", "\n" . str_repeat( "\t", $cb_content['add_indent'] ), $_html );
		endif;

		$_html = null;
		unset( $_html );
	endif;

endif;

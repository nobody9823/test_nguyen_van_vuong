<?php
$dp_options = get_design_plus_option();
$active_sidebars = get_active_sidebars();
get_header();
?>
<main class="l-main">
<?php
get_template_part( 'template-parts/index-slider' );

if ( $active_sidebars['column_layout_class'] ) :
?>
	<div class="l-inner <?php echo esc_attr( $active_sidebars['column_layout_class'] ); ?>">
		<div class="l-primary">
<?php
else :
?>
	<div class="l-inner">
<?php
endif;

// コンテンツビルダー
if ( ! empty( $dp_options['contents_builder'] ) ) :
	foreach ( $dp_options['contents_builder'] as $key => $cb_content ) :
		$cb_index = 'cb_' . $key;
		if ( empty( $cb_content['cb_content_select'] ) || empty( $cb_content['cb_display'] ) ) continue;

		// 最新ブログ記事一覧
		if ( 'blog' == $cb_content['cb_content_select'] ) :
			$cb_color = null;
			$cb_category = null;
			$cb_archive_url = null;

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $cb_content['cb_post_num'],
				'ignore_sticky_posts' => true
			);

			if ( 'recommend_post' == $cb_content['cb_list_type'] ) :
				$args['meta_key'] = 'recommend_post';
				$args['meta_value'] = 'on';
			elseif ( 'recommend_post2' == $cb_content['cb_list_type'] ) :
				$args['meta_key'] = 'recommend_post2';
				$args['meta_value'] = 'on';
			elseif ( 'pickup_post' == $cb_content['cb_list_type'] ) :
				$args['meta_key'] = 'pickup_post';
				$args['meta_value'] = 'on';
			elseif ( 'category' == $cb_content['cb_list_type'] && $cb_content['cb_category'] ) :
				$cb_category = get_category( $cb_content['cb_category'] );
			endif;
			if ( $cb_category && ! is_wp_error( $cb_category ) ) :
				$args['cat'] = $cb_category->term_id;
				$term_meta = get_option( 'taxonomy_' . $cb_category->term_id, array() );
				if ( ! empty( $term_meta['color'] ) ) :
					$cb_color = $term_meta['color'];
				endif;
			else :
				$cb_category = null;
			endif;

			if ( 'random' == $cb_content['cb_order'] ) :
				$args['orderby'] = 'rand';
			elseif ( 'date2' == $cb_content['cb_order'] ) :
				$args['orderby'] = 'date';
				$args['order'] = 'ASC';
			else :
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
			endif;

			if ( $cb_content['cb_show_archive_link'] && $cb_content['cb_archive_link_text'] ) :
				if ( $cb_category ) :
					$cb_archive_url = get_category_link( $cb_category );
				elseif ( 'all' == $cb_content['cb_list_type'] ) :
					$cb_archive_url = get_post_type_archive_link( 'post' );
				endif;
			endif;

			$cb_query = new WP_Query( $args );
			if ( $cb_query->have_posts() ) :
?>
			<div id="cb_<?php echo esc_attr( $key + 1 ); ?>" class="p-cb__item p-cb__item--<?php echo esc_attr( $cb_content['cb_content_select'] ); ?>">
<?php
				if ( $cb_content['cb_headline'] || $cb_archive_url ) :
?>
				<div class="p-cb__item-header p-cb__item-header__has-border p-cb__item-header__has-button u-clearfix"<?php if ( $cb_color ) echo ' style="border-color: ' . esc_attr( $cb_color ) . ';"'; ?>>
<?php
					if ( $cb_content['cb_headline'] ) :
?>
					<h2 class="p-cb__item-headline"><?php echo esc_html( $cb_content['cb_headline'] ); ?></h2>
<?php
					endif;
					if ( $cb_archive_url ) :
?>
					<a class="p-cb__item-archive-link p-cb__item-archive-link__button" href="<?php echo esc_url( $cb_archive_url ); ?>"<?php if ( $cb_color ) echo ' style="background-color: ' . esc_attr( $cb_color ) . ';"'; ?>><?php echo esc_html( $cb_content['cb_archive_link_text'] ); ?></a>
<?php
					endif;
?>
				</div>
<?php
				endif;
?>
				<div class="p-index-blog p-index-blog--type1">
<?php
					// articleクラス
					$cb_content['large_article_class'] = 'p-blog-archive__large-item';
					$cb_content['article_class'] = 'p-blog-archive__item u-clearfix';

					// itemクラス
					$cb_content['item_class'] = 'p-blog-archive__item';

					// サムネイルサイズ
					$cb_content['thumbnail_size'] = 'size2';

					// タイトルバイト数
					$cb_content['title_bytes'] = 72;
					$cb_content['title_bytes_mobile'] = 59;

					// 抜粋表示
					$cb_content['show_excerpt'] = 1;

					get_template_part( 'template-parts/index-cb-articles' );
?>
				</div>
			</div>
<?php
			endif;

		// カテゴリー記事一覧
		elseif ( 'category' == $cb_content['cb_content_select'] ) :
			// カラム1
			$cb_color = null;
			$cb_category = null;
			$cb_archive_url = null;

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $cb_content['cb_post_num'],
				'ignore_sticky_posts' => true
			);

			if ( 'recommend_post' == $cb_content['cb_list_type'] ) :
				$args['meta_key'] = 'recommend_post';
				$args['meta_value'] = 'on';
			elseif ( 'recommend_post2' == $cb_content['cb_list_type'] ) :
				$args['meta_key'] = 'recommend_post2';
				$args['meta_value'] = 'on';
			elseif ( 'pickup_post' == $cb_content['cb_list_type'] ) :
				$args['meta_key'] = 'pickup_post';
				$args['meta_value'] = 'on';
			elseif ( 'category' == $cb_content['cb_list_type'] && $cb_content['cb_category'] ) :
				$cb_category = get_category( $cb_content['cb_category'] );
			endif;
			if ( $cb_category && ! is_wp_error( $cb_category ) ) :
				$args['cat'] = $cb_category->term_id;
				$term_meta = get_option( 'taxonomy_' . $cb_category->term_id, array() );
				if ( ! empty( $term_meta['color'] ) ) :
					$cb_color = $term_meta['color'];
				endif;
			else :
				$cb_category = null;
			endif;

			if ( 'random' == $cb_content['cb_order'] ) :
				$args['orderby'] = 'rand';
			elseif ( 'date2' == $cb_content['cb_order'] ) :
				$args['orderby'] = 'date';
				$args['order'] = 'ASC';
			else :
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
			endif;

			if ( $cb_content['cb_show_archive_link'] && $cb_content['cb_archive_link_text'] ) :
				if ( $cb_category ) :
					$cb_archive_url = get_category_link( $cb_category );
				elseif ( 'all' == $cb_content['cb_list_type'] ) :
					$cb_archive_url = get_post_type_archive_link( 'post' );
				endif;
			endif;

			// 2カラム
			if ( 2 == $cb_content['cb_layout'] ) :
				// カラム2
				$cb_color2 = null;
				$cb_category2 = null;
				$cb_archive_url2 = null;

				$args2 = array(
					'post_type' => 'post',
					'posts_per_page' => $cb_content['cb_post_num2'],
					'ignore_sticky_posts' => true
				);

				if ( 'recommend_post' == $cb_content['cb_list_type2'] ) :
					$args2['meta_key'] = 'recommend_post';
					$args2['meta_value'] = 'on';
				elseif ( 'recommend_post2' == $cb_content['cb_list_type2'] ) :
					$args2['meta_key'] = 'recommend_post2';
					$args2['meta_value'] = 'on';
				elseif ( 'pickup_post' == $cb_content['cb_list_type2'] ) :
					$args2['meta_key'] = 'pickup_post';
					$args2['meta_value'] = 'on';
				elseif ( 'category' == $cb_content['cb_list_type2'] && $cb_content['cb_category2'] ) :
					$cb_category2 = get_category( $cb_content['cb_category2'] );
				endif;
				if ( $cb_category2 && ! is_wp_error( $cb_category2 ) ) :
					$args2['cat'] = $cb_category2->term_id;
					$term_meta = get_option( 'taxonomy_' . $cb_category2->term_id, array() );
					if ( ! empty( $term_meta['color'] ) ) :
						$cb_color2 = $term_meta['color'];
					endif;
				else :
					$cb_category2 = null;
				endif;

				if ( 'random' == $cb_content['cb_order2'] ) :
					$args2['orderby'] = 'rand';
				elseif ( 'date2' == $cb_content['cb_order2'] ) :
					$args2['orderby'] = 'date';
					$args2['order'] = 'ASC';
				else :
					$args2['orderby'] = 'date';
					$args2['order'] = 'DESC';
				endif;

				if ( $cb_content['cb_show_archive_link2'] && $cb_content['cb_archive_link_text2'] ) :
					if ( $cb_category2 ) :
						$cb_archive_url2 = get_category_link( $cb_category2 );
					elseif ( 'all' == $cb_content['cb_list_type2'] ) :
						$cb_archive_url2 = get_post_type_archive_link( 'post' );
					endif;
				endif;

				$cb_query = new WP_Query( $args );
				$cb_query2 = new WP_Query( $args2 );

				if ( $cb_query->have_posts() || $cb_query2->have_posts() ) :
?>
			<div id="cb_<?php echo esc_attr( $key + 1 ); ?>" class="p-cb__item p-cb__item--<?php echo esc_attr( $cb_content['cb_content_select'] ); ?> p-cb-2columns u-clearfix">
<?php
					// カラム1
					if ( $cb_query->have_posts() ) :
?>
				<div class="p-cb-column p-cb-column--1">
<?php
						if ( $cb_content['cb_headline'] || $cb_archive_url ) :
?>
					<div class="p-cb__item-header p-cb__item-header__has-border u-clearfix"<?php if ( $cb_color ) echo ' style="border-color: ' . esc_attr( $cb_color ) . ';"'; ?>>
<?php
							if ( $cb_content['cb_headline'] ) :
?>
						<h2 class="p-cb__item-headline"><?php echo esc_html( $cb_content['cb_headline'] ); ?></h2>
<?php
							endif;
							if ( $cb_archive_url ) :
?>
						<a class="p-cb__item-archive-link" href="<?php echo esc_url( $cb_archive_url ); ?>"><?php echo esc_html( $cb_content['cb_archive_link_text'] ); ?></a>
<?php
							endif;
?>
					</div>
<?php
						endif;
?>
					<div class="p-index-blog p-index-blog--type3">
<?php
						// 大きく表示する数
						$cb_content['show_large_item_num'] = 1;

						// サムネイルサイズ
						$cb_content['large_thumbnail_size'] = 'size2';
						$cb_content['thumbnail_size'] = 'size1';

						// タイトルバイト数
						$cb_content['large_title_bytes'] = 84;
						$cb_content['large_title_bytes_mobile'] = 60;
						$cb_content['title_bytes'] = 72;
						$cb_content['title_bytes_mobile'] = 72;

						// 追加インデント
						$cb_content['add_indent'] = 1;

						get_template_part( 'template-parts/index-cb-articles' );
?>
					</div>
				</div>
<?php
					endif;

					// カラム2
					if ( $cb_query2->have_posts() ) :
?>
				<div class="p-cb-column p-cb-column--2">
<?php
						if ( $cb_content['cb_headline2'] || $cb_archive_url2 ) :
?>
					<div class="p-cb__item-header p-cb__item-header__has-border u-clearfix"<?php if ( $cb_color2 ) echo ' style="border-color: ' . esc_attr( $cb_color2 ) . ';"'; ?>>
<?php
							if ( $cb_content['cb_headline2'] ) :
?>
						<h2 class="p-cb__item-headline"><?php echo esc_html( $cb_content['cb_headline2'] ); ?></h2>
<?php
							endif;
							if ( $cb_archive_url2 ) :
?>
						<a class="p-cb__item-archive-link" href="<?php echo esc_url( $cb_archive_url2 ); ?>"><?php echo esc_html( $cb_content['cb_archive_link_text2'] ); ?></a>
<?php
							endif;
?>
					</div>
<?php
						endif;
?>
					<div class="p-index-blog p-index-blog--type3">
<?php
						// index-cb-articles.phpに渡す変数に代入
						$cb_query = $cb_query2;
						$cb_category = $cb_category2;
						$cb_content['cb_show_category'] = $cb_content['cb_show_category2'];
						$cb_content['cb_show_author'] = $cb_content['cb_show_author2'];
						$cb_content['cb_show_date'] = $cb_content['cb_show_date2'];
						$cb_content['cb_show_views'] = $cb_content['cb_show_views2'];

						// 大きく表示する数
						$cb_content['show_large_item_num'] = 1;

						// サムネイルサイズ
						$cb_content['large_thumbnail_size'] = 'size2';
						$cb_content['thumbnail_size'] = 'size1';

						// タイトルバイト数
						$cb_content['large_title_bytes'] = 84;
						$cb_content['large_title_bytes_mobile'] = 60;
						$cb_content['title_bytes'] = 72;
						$cb_content['title_bytes_mobile'] = 72;

						// 追加インデント
						$cb_content['add_indent'] = 1;

						get_template_part( 'template-parts/index-cb-articles' );
?>
					</div>
				</div>
<?php
					endif;
?>
			</div>
<?php
				endif;
			else :
				$cb_query = new WP_Query( $args );
				if ( $cb_query->have_posts() ) :
?>
			<div id="cb_<?php echo esc_attr( $key + 1 ); ?>" class="p-cb__item p-cb__item--<?php echo esc_attr( $cb_content['cb_content_select'] ); ?>">
<?php
					if ( $cb_content['cb_headline'] || $cb_archive_url ) :
?>
				<div class="p-cb__item-header p-cb__item-header__has-border u-clearfix"<?php if ( $cb_color ) echo ' style="border-color: ' . esc_attr( $cb_color ) . ';"'; ?>>
<?php
						if ( $cb_content['cb_headline'] ) :
?>
					<h2 class="p-cb__item-headline"><?php echo esc_html( $cb_content['cb_headline'] ); ?></h2>
<?php
						endif;
						if ( $cb_archive_url ) :
?>
					<a class="p-cb__item-archive-link" href="<?php echo esc_url( $cb_archive_url ); ?>"><?php echo esc_html( $cb_content['cb_archive_link_text'] ); ?></a>
<?php
						endif;
?>
				</div>
<?php
					endif;
?>
				<div class="p-index-blog p-index-blog--type2 u-clearfix">
<?php
					// 大きく表示する数
					$cb_content['show_large_item_num'] = 1;

					// サムネイルサイズ
					$cb_content['large_thumbnail_size'] = 'size3';
					$cb_content['thumbnail_size'] = 'size2';

					// タイトルバイト数
					$cb_content['large_title_bytes'] = 84;
					$cb_content['large_title_bytes_mobile'] = 80;
					$cb_content['title_bytes'] = 66;
					$cb_content['title_bytes_mobile'] = 72;

					get_template_part( 'template-parts/index-cb-articles' );
?>
				</div>
			</div>
<?php
				endif;
			endif;

		// お知らせ
		elseif ( 'news' == $cb_content['cb_content_select'] ) :
			$cb_archive_url = null;
			$args = array(
				'post_type' => $dp_options['news_slug'],
				'posts_per_page' => $cb_content['cb_post_num'],
				'ignore_sticky_posts' => true
			);

			if ( 'random' == $cb_content['cb_order']) :
				$args['orderby'] = 'rand';
			elseif ( 'date2' == $cb_content['cb_order'] ) :
				$args['orderby'] = 'date';
				$args['order'] = 'ASC';
			else :
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
			endif;

			if ( $cb_content['cb_show_archive_link'] && $cb_content['cb_archive_link_text'] ) :
				$cb_archive_url = get_post_type_archive_link( $dp_options['news_slug'] );
			endif;

			$cb_query = new WP_Query( $args );
			if ( $cb_query->have_posts() ) :
?>
			<div id="cb_<?php echo esc_attr( $key + 1 ); ?>" class="p-cb__item p-cb__item--<?php echo esc_attr( $cb_content['cb_content_select'] ); ?>">
<?php
				if ( $cb_content['cb_headline'] || $cb_archive_url ) :
?>
				<div class="p-cb__item-header u-clearfix">
<?php
					if ( $cb_content['cb_headline'] ) :
?>
					<h2 class="p-cb__item-headline"><?php echo esc_html( $cb_content['cb_headline'] ); ?></h2>
<?php
					endif;
					if ( $cb_archive_url ) :
?>
					<a class="p-cb__item-archive-link" href="<?php echo esc_url( $cb_archive_url ); ?>"><?php echo esc_html( $cb_content['cb_archive_link_text'] ); ?></a>
<?php
					endif;
?>
				</div>
<?php
				endif;
?>
				<div class="p-index-news u-clearfix">
<?php
				while ( $cb_query->have_posts() ) :
					$cb_query->the_post();
?>
					<article class="p-index-news__item">
						<a href="<?php the_permalink(); ?>">
							<h3 class="p-index-news__item-title p-article-news__title p-article__title"><?php echo mb_strimwidth( get_the_title(), 0, is_mobile() ? 70 : 66, '...' ); ?></h3>
<?php
					if ( $cb_content['cb_show_date'] || $cb_content['cb_show_views'] ) :
?>
							<p class="p-index-news__item-meta p-article__meta">
<?php
						if ( $cb_content['cb_show_date'] ) :
?>
								<time class="p-article__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
<?php
						endif;
						if ( $cb_content['cb_show_views'] ) :
?>
								<span class="p-article__views"><?php echo number_format( intval( $post->_views ) ); ?> views</span>
<?php
						endif;
?>
							</p>
<?php
					endif;
?>
						</a>
					</article>
<?php
				endwhile;
?>
				</div>
			</div>
<?php
			endif;

		// 広告
		elseif ( 'ad' == $cb_content['cb_content_select'] ) :
			$cb_ad_image1 = null;
			$cb_ad_image2 = null;

			if ( $cb_content['cb_ad_image1'] ) :
				$cb_ad_image1 = wp_get_attachment_image_src( $cb_content['cb_ad_image1'], 'full' );
			endif;
			if ( $cb_content['cb_ad_image2'] ) :
				$cb_ad_image2 = wp_get_attachment_image_src( $cb_content['cb_ad_image2'], 'full' );
			endif;

			if ( $cb_content['cb_ad_code1'] || $cb_ad_image1 || $cb_content['cb_ad_code2'] || $cb_ad_image2 ) :
				echo "\t\t\t" . '<div id="cb_' . esc_attr( $key + 1 ) . '" class="p-cb__item p-cb__item--' . esc_attr( $cb_content['cb_content_select'] ) . '">' . "\n";
				echo "\t\t\t\t" . '<div class="p-index-ad p-ad">' . "\n";

				if ( $cb_content['cb_ad_code1'] ) :
					echo "\t\t\t\t\t";
					echo '<div class="p-index-ad__item p-ad__item">' . $cb_content['cb_ad_code1'] . '</div>';
				elseif ( $cb_ad_image1 ) :
					echo "\t\t\t\t\t";
					echo '<div class="p-index-ad__item p-ad__item"><a href="' . esc_url( $cb_content['cb_ad_url1'] ) . '" target="_blank"><img src="' . esc_attr( $cb_ad_image1[0] ) . '" alt=""></a></div>';
				endif;

				if ( $cb_content['cb_ad_code2'] ) :
					echo "\t\t\t\t\t";
					echo '<div class="p-index-ad__item p-ad__item">' . $cb_content['cb_ad_code2'] . '</div>';
				elseif ( $cb_ad_image2 ) :
					echo "\t\t\t\t\t";
					echo '<div class="p-index-ad__item p-ad__item"><a href="' . esc_url( $cb_content['cb_ad_url2'] ) . '" target="_blank"><img src="' . esc_attr( $cb_ad_image2[0] ) . '" alt=""></a></div>';
				endif;

				echo "\t\t\t\t" . '</div>' . "\n";
				echo "\t\t\t" . '</div>' . "\n";
			endif;

		// フリースペース
		elseif ( 'wysiwyg' == $cb_content['cb_content_select'] ) :
			$cb_wysiwyg_editor = apply_filters( 'the_content', $cb_content['cb_wysiwyg_editor'] );
			if ( $cb_wysiwyg_editor ) :
?>
			<div id="cb_<?php echo esc_attr( $key + 1 ); ?>" class="p-cb__item p-cb__item--<?php echo esc_attr($cb_content['cb_content_select']); ?>">
				<div class="p-entry__body">
				<?php echo $cb_wysiwyg_editor; ?>
				</div>
			</div>
<?php
			endif;
		endif;

	endforeach;

	wp_reset_postdata();
endif;

if ( $active_sidebars['column_layout_class'] ) :
?>
		</div>
<?php
	get_sidebar();
?>
	</div>
<?php
else :
?>
	</div>
<?php
endif;
?>
</main>
<?php get_footer(); ?>

<?php

/**
 * Template Name: Ranking
 */

$active_sidebars = get_active_sidebars();
get_header();
?>
<main class="l-main">
<?php
get_template_part( 'template-parts/page-header' );
get_template_part( 'template-parts/breadcrumb' );

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

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

		if ( has_post_thumbnail() || $post->post_content || post_password_required() ) :
?>
			<article class="p-entry">
				<div class="p-entry__inner">
<?php
			if ( has_post_thumbnail() ) :
				echo "\t\t\t\t\t<div class=\"p-entry__thumbnail\">";
				the_post_thumbnail( 'size5' );
				echo "</div>\n";
			endif;

			if ( $post->post_content || post_password_required() ) :
?>
					<div class="p-entry__body">
<?php
				the_content();

				if ( ! post_password_required() ) :
					wp_link_pages( array(
						'before' => '<div class="p-page-links">',
						'after' => '</div>',
						'link_before' => '<span>',
						'link_after' => '</span>'
					) );
				endif;
?>
					</div>
<?php
			endif;
?>
				</div>
			</article>
<?php
		endif;
	endwhile;

	if ( ! post_password_required() ) :
		$_post = $post;

		$query_args = array(
			'post_type' => 'post',
			'posts_per_page' => is_numeric( $_post->rank_post_num ) ? absint( $_post->rank_post_num ) : 10,
			'ignore_sticky_posts' => 1,
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'meta_key' => '_views'
		);

		if ( $_post->rank_category ) :
			$rank_category = get_category( $_post->rank_category );
			if ( ! empty( $rank_category ) && ! is_wp_error( $rank_category ) ) :
				$query_args['cat'] = $rank_category->term_id;
			else :
				$rank_category = null;
			endif;
		endif;

		$the_query = new WP_Query( $query_args );

		if ( $the_query->have_posts() ) :
?>
			<div class="p-ranking-list u-clearfix">
<?php
			$rank = 0;
			$post_count = 0;
			$post_count_with_ad = 0;

			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$rank++;
				$post_count++;
				$post_count_with_ad++;

				$catlist_float = array();
				if ( $_post->rank_show_category && has_category() ) :
					// 選択カテゴリーあり
					if ( ! empty( $rank_category ) ) :
						$catlist_float[] = '<span class="p-category-item--' . esc_attr( $rank_category->term_id ) . '" data-url="' . get_category_link( $rank_category ) . '">' . esc_html( $rank_category->name ) . '</span>';
					else :
						$categories = get_the_category();
						if ( $categories && ! is_wp_error( $categories ) ) :
							foreach ( $categories as $category ) :
								$catlist_float[] = '<span class="p-category-item--' . esc_attr( $category->term_id ) . '" data-url="' . get_category_link( $category ) . '">' . esc_html( $category->name ) . '</span>';							break;
							endforeach;
						endif;
					endif;
				endif;
?>
				<article class="<?php
					if ( 1 == $post_count_with_ad ) :
						echo 'p-blog-archive__full-item';
					elseif ( 2 == $post_count_with_ad ) :
						echo 'p-blog-archive__large-item p-blog-archive__large-item__left';
					elseif ( 3 == $post_count_with_ad ) :
						echo 'p-blog-archive__large-item p-blog-archive__large-item__right';
					else :
						echo 'p-blog-ranking__item p-blog-archive__item u-clearfix';
					endif;
				?>">
					<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
						<div class="p-blog-archive__item-thumbnail p-hover-effect__image js-object-fit-cover">
							<div class="p-blog-archive__item-thumbnail_inner">
								<span class="p-blog-archive__item-rank"><?php echo $rank; ?></span>
<?php
				echo "\t\t\t\t\t\t\t\t";
				if ( 3 <= $post_count_with_ad ) :
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
					echo "\t\t\t\t\t\t\t\t";
					echo '<div class="p-float-category p-float-category__has-rank">' . implode( ', ', $catlist_float ) . '</div>' . "\n";
				endif;
?>
							</div>
						</div>
						<div class="p-blog-archive__item-info">
							<h2 class="p-blog-archive__item-title p-article__title"><?php echo mb_strimwidth( get_the_title(), 0, is_mobile() ? 62 : 72, '...' ); ?></h2>
							<p class="p-blog-archive__item-excerpt u-hidden-xs"><?php echo tcd_the_excerpt(); ?></p>
<?php
				if ( $_post->rank_show_author || $_post->rank_show_date || $_post->rank_show_views ) :
					echo "\t\t\t\t\t\t\t";
					echo '<p class="p-blog-archive__item-meta p-article__meta">';
					if ( $_post->rank_show_author ) :
						the_archive_author();
					endif;
					if ( $_post->rank_show_date ) :
						echo '<time class="p-article__date" datetime="' . get_the_time( 'Y-m-d' ) . '">' . get_the_time( 'Y.m.d' ) . '</time>';
					endif;
					if ( $_post->rank_show_views ) :
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
				if ( $_post->show_native_ad && 0 === $post_count % absint( $_post->native_ad_position ) ) :
					$native_ad = get_native_ad();
					if ( $native_ad ) :
						$post_count_with_ad++;
?>
				<article class="<?php
						if ( 1 == $post_count_with_ad ) :
							echo 'p-blog-archive__full-item';
						elseif ( 2 == $post_count_with_ad ) :
							echo 'p-blog-archive__large-item p-blog-archive__large-item__left';
						elseif ( 3 == $post_count_with_ad ) :
							echo 'p-blog-archive__large-item p-blog-archive__large-item__right';
						else :
							echo 'p-blog-ranking__item p-blog-archive__item u-clearfix';
						endif;
				?>">
					<a class="p-native-ad__link p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
						<div class="p-blog-archive__item-thumbnail p-hover-effect__image js-object-fit-cover">
							<div class="p-blog-archive__item-thumbnail_inner">
<?php
						$image_src = null;
						echo "\t\t\t\t\t\t\t\t";
						if ( 3 <= $post_count_with_ad ) :
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

						if ( $_post->rank_show_category && $native_ad['native_ad_label'] ) :
							echo "\t\t\t\t\t\t\t\t";
							echo '<div class="p-float-native-ad-label">' .  esc_html( $native_ad['native_ad_label'] ) . '</div>' . "\n";
						endif;
?>
							</div>
						</div>
						<div class="p-blog-archive__item-info">
<?php
						if ( $native_ad['native_ad_title'] ) :
							echo "\t\t\t\t\t\t\t";
							echo '<h2 class="p-blog-archive__item-title p-article__title">' . esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, is_mobile() ? 50 : 72, '...' ) ) . '</h2>' . "\n";
						endif;

						if ( $native_ad['native_ad_desc'] ) :
							echo "\t\t\t\t\t\t\t";
							echo '<p class="p-blog-archive__item-excerpt u-hidden-xs">';
							echo str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( mb_strimwidth( trim( $native_ad['native_ad_desc'] ), 0, 160, '...' ) ) );
							echo '</p>' . "\n";
						endif;

						if ( $native_ad['native_ad_sponsor'] || ( ! $_post->rank_show_category && $native_ad['native_ad_label'] ) ) :
							echo "\t\t\t\t\t\t\t";
							echo '<p class="p-header-blog__item-meta p-article__meta">';

							if ( $native_ad['native_ad_sponsor'] ) :
								echo '<span class="p-article__native-ad-sponsor">' . esc_html( $native_ad['native_ad_sponsor'] ) . '</span>';
							endif;

							if ( ! $_post->rank_show_category && $native_ad['native_ad_label'] ) :
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
			wp_reset_postdata();
?>
			</div>
<?php
		endif;
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
endif;
?>
</main>
<?php get_footer(); ?>

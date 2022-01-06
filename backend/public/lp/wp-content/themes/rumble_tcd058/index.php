<?php
$dp_options = get_design_plus_option();

if ( is_post_type_archive( $dp_options['news_slug'] ) ) :
	get_template_part( 'archive-news' );
	return;
endif;

$active_sidebars = get_active_sidebars();
get_header();
?>
<main class="l-main">
<?php
get_template_part( 'template-parts/page-header' );
get_template_part( 'template-parts/breadcrumb' );

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

if ( is_category() ) :
	$term_meta = get_option( 'taxonomy_' . get_query_var( 'cat' ), array() );
endif;

get_template_part( 'template-parts/archive-slider' );

if ( have_posts() ) :
?>
			<div class="p-blog-archive u-clearfix">
<?php
	$post_count = 0;
	$post_count_with_ad = 0;

	while ( have_posts() ) :
		the_post();
		$post_count++;
		$post_count_with_ad++;

		$catlist_float = array();
		if ( ! is_category() && $dp_options['show_category'] && has_category() ) :
			$categories = get_the_category();
			if ( $categories && ! is_wp_error( $categories ) ) :
				foreach ( $categories as $category ) :
					$catlist_float[] = '<span class="p-category-item--' . esc_attr( $category->term_id ) . '" data-url="' . get_category_link( $category ) . '">' . esc_html( $category->name ) . '</span>';
					break;
				endforeach;
			endif;
		endif;

		// 大きく表示フラグ
		if ( $post_count_with_ad <= 2 && ! empty( $term_meta['archive_large'] ) ) :
			$is_large_item = true;
		else :
			$is_large_item = false;
		endif;
?>
				<article class="<?php echo $is_large_item ? 'p-blog-archive__large-item' : 'p-blog-archive__item u-clearfix'; ?>">
					<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
						<div class="p-blog-archive__item-thumbnail p-hover-effect__image js-object-fit-cover">
							<div class="p-blog-archive__item-thumbnail_inner">
<?php
		echo "\t\t\t\t\t\t\t\t";
		if ( $is_large_item ) :
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
			echo '<div class="p-float-category">' . implode( ', ', $catlist_float ) . '</div>' . "\n";
		endif;
?>
							</div>
						</div>
						<div class="p-blog-archive__item-info">
							<h2 class="p-blog-archive__item-title p-article__title"><?php echo mb_strimwidth( get_the_title(), 0, is_mobile() ? 50 : 72, '...' ); ?></h2>
							<p class="p-blog-archive__item-excerpt u-hidden-xs"><?php echo tcd_the_excerpt(); ?></p>
<?php
		if ( $dp_options['show_archive_author'] || $dp_options['show_date'] || $dp_options['show_views'] ) :
			echo "\t\t\t\t\t\t\t";
			echo '<p class="p-blog-archive__item-meta p-article__meta">';
			if ( $dp_options['show_archive_author'] ) :
				the_archive_author();
			endif;
			if ( $dp_options['show_date'] ) :
				echo '<time class="p-article__date" datetime="' . get_the_time( 'Y-m-d' ) . '">' . get_the_time( 'Y.m.d' ) . '</time>';
			endif;
			if ( $dp_options['show_views'] ) :
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
		if ( $dp_options['show_archive_native_ad'] && 0 === $post_count % $dp_options['archive_native_ad_position'] ) :
			$native_ad = get_native_ad();
			if ( $native_ad ) :
				$post_count_with_ad++;

				// 大きく表示フラグ
				if ( $post_count_with_ad <= 2 && ! empty( $term_meta['archive_large'] ) ) :
					$is_large_item = true;
				else :
					$is_large_item = false;
				endif;

?>
				<article class="<?php echo $is_large_item ? 'p-blog-archive__large-item' : 'p-blog-archive__item u-clearfix'; ?>">
					<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
						<div class="p-blog-archive__item-thumbnail p-hover-effect__image js-object-fit-cover">
							<div class="p-blog-archive__item-thumbnail_inner">
<?php
				$image_src = null;
				echo "\t\t\t\t\t\t\t\t";
				if ( $is_large_item ) :
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

				if ( ! is_category() && $dp_options['show_category'] && $native_ad['native_ad_label'] ) :
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

				if ( $native_ad['native_ad_sponsor'] || ( $native_ad['native_ad_label'] && ( is_category() || ! $dp_options['show_category'] ) ) ) :
					echo "\t\t\t\t\t\t\t";
					echo '<p class="p-blog-archive__item-meta p-article__meta">';

					if ( $native_ad['native_ad_sponsor'] ) :
						echo '<span class="p-article__native-ad-sponsor">' . esc_html( $native_ad['native_ad_sponsor'] ) . '</span>';
					endif;

					if ( $native_ad['native_ad_label'] && ( is_category() || ! $dp_options['show_category'] ) ) :
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

		// アーカイブ広告
		if ( $post_count === $dp_options['archive_ad_position'] ) :
			if ( $dp_options['archive_ad_code1'] || $dp_options['archive_ad_image1'] || $dp_options['archive_ad_code2'] || $dp_options['archive_ad_image2'] ) :
				echo '<div class="p-archive-ad p-ad">' . "\n";
				if ( $dp_options['archive_ad_code1'] ) :
					echo '<div class="p-archive-ad__item p-ad__item">' . $dp_options['archive_ad_code1'] . '</div>';
				elseif ( $dp_options['archive_ad_image1'] ) :
					$ad_image = wp_get_attachment_image_src( $dp_options['archive_ad_image1'], 'full' );
					if ( $ad_image ) :
						echo '<div class="p-archive-ad__item p-ad__item"><a href="' . esc_url( $dp_options['archive_ad_url1'] ) . '" target="_blank"><img src="' . esc_attr( $ad_image[0] ) . '" alt=""></a></div>';
					endif;
				endif;
				if ( $dp_options['archive_ad_code2'] ) :
					echo '<div class="p-archive-ad__item p-ad__item">' . $dp_options['archive_ad_code2'] . '</div>';
				elseif ( $dp_options['archive_ad_image2'] ) :
					$ad_image = wp_get_attachment_image_src( $dp_options['archive_ad_image2'], 'full' );
					if ( $ad_image ) :
						echo '<div class="p-archive-ad__item p-ad__item"><a href="' . esc_url( $dp_options['archive_ad_url2'] ) . '" target="_blank"><img src="' . esc_attr( $ad_image[0] ) . '" alt=""></a></div>';
					endif;
				endif;
				echo '</div>' . "\n";
			endif;
		endif;
	endwhile;
?>
			</div>
<?php
	$paginate_links = paginate_links( array(
		'current' => max( 1, get_query_var( 'paged' ) ),
		'next_text' => '&#xe910;',
		'prev_text' => '&#xe90f;',
		'total' => $wp_query->max_num_pages,
		'type' => 'array',
	) );
	if ( $paginate_links ) :
?>
			<ul class="p-pager">
<?php
		foreach ( $paginate_links as $paginate_link ) :
?>
				<li class="p-pager__item"><?php echo $paginate_link; ?></li>
<?php
		endforeach;
?>
			</ul>
<?php
	endif;
else :
?>
			<p class="no_post"><?php _e( 'There is no registered post.', 'tcd-w' );  ?></p>
<?php
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

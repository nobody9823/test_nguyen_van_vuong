<?php
$dp_options = get_design_plus_option();
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

$author = get_queried_object();
if ( $author->show_author ) :
	$sns_html = '';
	if ( $author->user_url ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--url"><a href="' . esc_attr( $author->user_url ) . '" target="_blank"></a></li>';
	endif;
	if ( $author->facebook_url ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--facebook"><a href="' . esc_attr( $author->facebook_url ) . '" target="_blank"></a></li>';
	endif;
	if ( $author->twitter_url ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--twitter"><a href="' . esc_attr( $author->twitter_url ) . '" target="_blank"></a></li>';
	endif;
	if ( $author->instagram_url ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--instagram"><a href="' . esc_attr( $author->instagram_url ) . '" target="_blank"></a></li>';
	endif;
	if ( $author->pinterest_url ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--pinterest"><a href="' . esc_attr( $author->pinterest_url ) . '" target="_blank"></a></li>';
	endif;
	if ( $author->youtube_url ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--youtube"><a href="' . esc_attr( $author->youtube_url ) . '" target="_blank"></a></li>';
	endif;
	if ( $author->contact_url ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--contact"><a href="' . esc_attr( $author->contact_url ) . '" target="_blank"></a></li>';
	endif;
?>
			<section class="p-author">
				<h2 class="p-headline"><?php echo esc_html( $author->display_name ); ?></h2>
				<div class="p-author__box u-clearfix">
					<div class="p-author__thumbnail js-object-fit-cover">
						<?php echo get_avatar( $author->ID, 200 ); ?>
					</div>
					<div class="p-author__info">
<?php
	if ( $dp_options['show_author_views'] ) :
?>
						<div class="p-author__views p-article__views"><?php echo number_format( get_author_views( $author->ID ) ); ?> views</div>
<?php
	endif;

	if ( $author->description ) :
?>
						<div class="p-author__desc">
<?php
	// URL自動リンク
	$pattern = '/(href=")?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
	$desc = preg_replace_callback( $pattern, function( $matches ) {
		// 既にリンクの場合はそのまま
		if ( isset( $matches[1] ) ) return $matches[0];
		return "<a href=\"{$matches[0]}\" target=\"_blank\">{$matches[0]}</a>";
	}, $author->description );
	echo wpautop( trim( $desc ) );
?>
						</div>
<?php
	endif;

	if ( $sns_html ) :
?>
						<ul class="p-social-nav"><?php echo $sns_html; ?></ul>
<?php
	endif;
?>
					</div>
				</div>
			</section>
<?php
endif;

if ( have_posts() ) :
?>
			<section class="p-author-archive p-blog-archive u-clearfix">
				<h3 class="p-headline"><?php printf( __( 'Archive for %s', 'tcd-w' ), esc_html( $author->display_name ) ); ?></h3>
				<div class="p-author-archive__items">
<?php
	while ( have_posts() ) :
		the_post();

		$catlist_float = array();
		$catlist_meta = array();
		if ( $dp_options['show_category'] ) :
			$categories = get_the_category();
			if ( $categories && ! is_wp_error( $categories ) ) :
				foreach ( $categories as $category ) :
					if (!$catlist_float) :
						$catlist_float[] = '<span class="p-category-item--' . esc_attr( $category->term_id ) . '" data-url="' . get_category_link( $category ) . '">' . esc_html( $category->name ) . '</span>';
						break;
					endif;
				endforeach;
			endif;
		endif;
?>
					<article class="p-blog-archive__item u-clearfix">
						<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
							<div class="p-blog-archive__item-thumbnail p-hover-effect__image js-object-fit-cover">
								<div class="p-blog-archive__item-thumbnail_inner">
<?php
		echo "\t\t\t\t\t\t\t\t\t";
		if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'size2' );
		else :
			echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x420.gif" alt="">';
		endif;
		echo "\n";

		if ( $catlist_float ) :
			echo "\t\t\t\t\t\t\t\t\t";
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
			echo "\t\t\t\t\t\t\t\t";
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
?>
			</section>
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

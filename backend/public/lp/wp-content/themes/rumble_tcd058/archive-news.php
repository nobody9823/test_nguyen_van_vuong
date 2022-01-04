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

if ( have_posts() ) :
?>
			<div class="p-archive-news">
<?php
	while ( have_posts() ) :
		the_post();
?>
				<article class="p-archive-news__item">
					<a href="<?php the_permalink(); ?>">
						<h3 class="p-archive-news__title p-article-news__title p-article__title"><?php echo mb_strimwidth( get_the_title(), 0, is_mobile() ? 72 : 140, '...' ); ?></h3>
<?php
					if ( $dp_options['show_date_news'] || $dp_options['show_views_news'] ) :
?>
						<p class="p-archive-news__meta p-article__meta">
<?php
						if ( $dp_options['show_date_news'] ) :
?>
							<time class="p-article__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
<?php
						endif;
						if ( $dp_options['show_views_news'] ) :
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
			<ul class="p-pager p-pager-news">
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

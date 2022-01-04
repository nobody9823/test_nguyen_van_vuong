<?php
$dp_options = get_design_plus_option();
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
<?php
		endif;
?>
		<article class="p-entry p-entry-news <?php echo $active_sidebars['column_layout_class'] ? 'l-primary' : 'l-inner'; ?>">
			<div class="p-entry__inner">
<?php
		if ( $dp_options['show_thumbnail_news'] && has_post_thumbnail() ) :
?>
				<div class="p-entry__thumbnail"><?php the_post_thumbnail( 'size5' ); ?></div>
<?php
		endif;
?>
				<div class="p-entry__header p-entry-news__header">
					<h1 class="p-entry__title p-entry-news__title"><?php the_title(); ?></h1>
<?php
		if ( $dp_options['show_date_news'] || $dp_options['show_views_news'] ) :
?>
					<ul class="p-entry__meta-top u-clearfix">
<?php
			if ( $dp_options['show_date_news'] ) :
?>
						<li class="p-entry__date p-article__date"><time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time></li>
<?php
			endif;
			if ( $dp_options['show_views_news'] ) :
?>
						<li class="p-entry__views p-article__views"><?php echo number_format( intval( $post->_views ) ); ?> views</li>
<?php
			endif;
?>
					</ul>
<?php
		endif;
?>
				</div>
<?php
		if ( $dp_options['show_sns_top_news'] ) :
			get_template_part( 'template-parts/sns-btn-top' );
		endif;
?>
				<div class="p-entry__body p-entry-news__body">
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
		if ( $dp_options['show_sns_btm_news'] ) :
			get_template_part( 'template-parts/sns-btn-btm' );
		endif;

		$previous_post = get_previous_post();
		$next_post = get_next_post();
		if ( $dp_options['show_next_post_news'] && ( $previous_post || $next_post ) ) :
?>
				<ul class="p-entry__nav c-entry-nav">
<?php
			if ( $previous_post ) :
?>
					<li class="c-entry-nav__item c-entry-nav__item--prev">
						<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-w' ); ?>"><span class="u-hidden-sm"><?php echo esc_html( mb_strimwidth( strip_tags( $previous_post->post_title ), 0, 64, '...' ) ); ?></span></a>
					</li>
<?php
			else :
?>
					<li class="c-entry-nav__item c-entry-nav__item--empty"></li>
<?php
			endif;
			if ( $next_post ) :
?>
					<li class="c-entry-nav__item c-entry-nav__item--next">
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-w' ); ?>"><span class="u-hidden-sm"><?php echo esc_html( mb_strimwidth( strip_tags( $next_post->post_title ), 0, 64, '...' ) ); ?></span></a>
					</li>
<?php
			else :
?>
					<li class="c-entry-nav__item c-entry-nav__item--empty"></li>
<?php
			endif;
?>
				</ul>
<?php
		endif;
?>
			</div>
<?php
		if ( $dp_options['show_recent_news'] ) :
			$args = array(
				'post_type' => $dp_options['news_slug'],
				'post_status' => 'publish',
				'post__not_in' => array( $post->ID ),
				'posts_per_page' => $dp_options['recent_news_num']
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) :
?>
			<section class="p-entry__recent-news">
<?php
				if ( $dp_options['recent_news_headline'] ) :
?>
					<h2 class="p-headline"><?php
						echo esc_html( $dp_options['recent_news_headline'] );
						if ( $dp_options['recent_news_link_text'] ) :
							echo '<a class="p-headline__link" href="' . esc_attr( get_post_type_archive_link( $dp_options['news_slug'] ) ) . '">' . esc_html( $dp_options['recent_news_link_text'] ) . '</a>';
						endif;
					?></h2>
<?php
				endif;
?>
				<div class="p-archive-news">
<?php
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
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
				wp_reset_postdata();
?>
				</div>
			</section>
<?php
			endif;
		endif;
?>
		</article>
<?php
	endwhile;
endif;

if ( $active_sidebars['column_layout_class'] ) :
	get_sidebar();
?>
	</div>
<?php
endif;
?>
</main>
<?php get_footer(); ?>
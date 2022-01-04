<?php

/**
 * Template Name: Author list
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
					$link_pages = wp_link_pages( array(
						'before' => '<div class="p-page-links">',
						'after' => '</div>',
						'link_before' => '<span>',
						'link_after' => '</span>',
						'echo' => 0
					) );
					if ( get_query_var( 'paged' ) > 1 ) :
						if ( preg_match_all( '/ href="(.+?)"/', $link_pages, $matches ) ) :
							foreach ( $matches[1] as $key => $value ) :
								if ( get_option('permalink_structure' ) ) :
									$paged_url = user_trailingslashit( untrailingslashit( $value ) . '/page/' . get_query_var( 'paged' ) );
								else :
									$paged_url = add_query_arg( 'paged', get_query_var( 'paged' ), html_entity_decode( $value ) );
									$paged_url = str_replace( '&', '&#038;', $paged_url );
								endif;
								$paged_href = str_replace( $value, $paged_url, $matches[0][$key] );
								$link_pages = str_replace( $matches[0][$key], $paged_href, $link_pages );
							endforeach;
						endif;
					endif;
					echo $link_pages . "\n";
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
		// ページングに総投稿者数が必要なためここで全投稿者取得
		$authors = get_users( array(
			'meta_key' => 'show_author',
			'meta_value' => '1',
			'meta_compare' => '=',
			'orderby' => 'display_name',
			'order' => 'ASC',
			'who' => 'authors'
		) );

		if ( $authors ) :
			$authors_num = is_numeric( $post->authors_num ) ? absint( $post->authors_num ) : 5;
			$authors_current_page = max( 1, get_query_var( 'paged' ) );
			$authors_max_page = ceil( count( $authors ) / $authors_num );
			if ( $authors_current_page > $authors_max_page ) :
				$authors_current_page = $authors_max_page;
			endif;
			$authors_start = ( $authors_current_page - 1 ) * $authors_num + 1;
			$authors_end = $authors_current_page * $authors_num;

			$cnt = 0;
			foreach ( $authors as $author ) :
				$cnt++;
				if ( $authors_start > $cnt || $authors_end < $cnt ) continue;
				if ( ! $author->show_author ) continue;

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
			<div class="p-author">
				<h2 class="p-headline"><?php echo esc_html( $author->display_name ); ?><a class="p-headline__link" href="<?php echo get_author_posts_url( $author->ID ); ?>"><?php echo _e( 'Post list', 'tcd-w' ); ?></a></h2>
				<div class="p-author__box u-clearfix">
					<a class="p-author__thumbnail p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo get_author_posts_url( $author->ID ); ?>">
						<div class="p-author__thumbnail__inner p-hover-effect__image js-object-fit-cover"><?php echo get_avatar( $author->ID, 200 ); ?></div>
					</a>
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
			</div>
<?php
			endforeach;

			$paginate_links = paginate_links( array(
				'current' => $authors_current_page,
				'next_text' => '&#xe910;',
				'prev_text' => '&#xe90f;',
				'total' => $authors_max_page,
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

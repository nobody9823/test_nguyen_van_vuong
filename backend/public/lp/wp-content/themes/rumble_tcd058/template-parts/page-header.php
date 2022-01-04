<?php
global $post, $dp_options;
if ( ! $dp_options ) $dp_options = get_design_plus_option();

$signage = $catchphrase = $desc = null;

if ( is_404() ) :
	$signage = wp_get_attachment_url( $dp_options['image_404'] );
	$catchphrase = trim( $dp_options['catchphrase_404'] );
	$desc = trim( $dp_options['desc_404'] );
	$catchphrase_font_size = $dp_options['catchphrase_font_size_404'] ? $dp_options['catchphrase_font_size_404'] : 30;
	$desc_font_size = $dp_options['desc_font_size_404'] ? $dp_options['desc_font_size_404'] : 14;
	$color = $dp_options['color_404'] ? $dp_options['color_404'] : '#FFFFFF';
	$shadow1 = ( ! empty( $dp_options['shadow1_404'] ) ) ? $dp_options['shadow1_404'] : 0;
	$shadow2 = ( ! empty( $dp_options['shadow2_404'] ) ) ? $dp_options['shadow2_404'] : 0;
	$shadow3 = ( ! empty( $dp_options['shadow3_404'] ) ) ? $dp_options['shadow3_404'] : 0;
	$shadow4 = $dp_options['shadow_color_404'];
elseif ( is_page() ) :
	$signage = wp_get_attachment_url( $post->page_header_image );
	$catchphrase = trim( $post->page_headline );
	$catchphrase_font_size = $post->page_headline_font_size ? $post->page_headline_font_size : 30;
	$desc = trim( $post->page_desc );
	$desc_font_size = $post->page_desc_font_size ? $post->page_desc_font_size : 14;
	$color = $post->page_headline_color;
	$shadow1 = ( ! empty( $post->page_headline_shadow1 ) ) ? $post->page_headline_shadow1 : 0;
	$shadow2 = ( ! empty( $post->page_headline_shadow2 ) ) ? $post->page_headline_shadow2 : 0;
	$shadow3 = ( ! empty( $post->page_headline_shadow3 ) ) ? $post->page_headline_shadow3 : 0;
	$shadow4 = $post->page_headline_shadow4;
endif;

if ( $signage || $catchphrase || $desc ) :
?>
	<header id="js-page-header" class="p-page-header"<?php if ( !empty( $signage ) ) echo ' style="background-image: url(' . esc_attr( $signage ) . ');"'; ?>>
		<div class="p-page-header__inner l-inner" style="text-shadow: <?php echo esc_attr( $shadow1 ); ?>px <?php echo esc_attr( $shadow2 ); ?>px <?php echo esc_attr( $shadow3 ); ?>px <?php echo esc_attr( $shadow4 ); ?>">
<?php
	if ( $catchphrase ) :
?>
			<h1 class="p-page-header__title" style="color: <?php echo esc_attr( $color ); ?>; font-size: <?php echo esc_attr( $catchphrase_font_size ); ?>px;"><?php echo esc_html( $catchphrase ); ?></h1>
<?php
	endif;
	if ( $desc ) :
?>
			<p class="p-page-header__desc" style="color: <?php echo esc_attr( $color ); ?>; font-size: <?php echo esc_attr( $desc_font_size ); ?>px;"><?php echo str_replace( array( "\r\n", "\r", "\n" ), '<br>', esc_html( $desc ) ); ?></p>
<?php
	endif;
?>
		</div>
	</header>
<?php
else:
	$items = array();
	$band_bg = null;

	if ( is_home() && $dp_options['blog_breadcrumb_label'] ) :
		$items[] = $dp_options['blog_breadcrumb_label'];
	elseif ( is_post_type_archive( $dp_options['news_slug'] ) || is_singular( $dp_options['news_slug'] ) ) :
		$items[] = $dp_options['news_breadcrumb_label'];
	elseif ( is_author() ) :
		$authors_page = get_authors_page();
		if ( $authors_page ) :
			$items[] = strip_tags( $authors_page->post_title );
		else :
			$items[] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
		endif;
	elseif ( is_category() ) :
		$queried_object = get_queried_object();
		if ( ! empty( $queried_object->term_id ) ) :
			$items[] = array(
				'name' => $queried_object->name,
				'url' => get_category_link( $queried_object )
			);

			if ( $queried_object->description ) :
				$items[] = array(
					'name' => $queried_object->description,
					'is_desc' => true
				);
			endif;

			$term_meta = get_option( 'taxonomy_' . $queried_object->term_id, array() );
			if ( ! empty( $term_meta['color'] ) ) :
				$band_bg = $term_meta['color'];
			endif;
		endif;
	elseif ( is_tag() ) :
		$items[] = single_tag_title( '', false );
	elseif ( is_search() ) :
		$items[] = __( 'Search result', 'tcd-w' );
	elseif ( is_year() ) :
		$items[] = get_the_time( __( 'Y', 'tcd-w' ), $post );
	elseif ( is_month() ) :
		$items[] = get_the_time( __( 'F, Y', 'tcd-w' ), $post );
	elseif ( is_day() ) :
		$items[] = get_the_time( __( 'F jS, Y', 'tcd-w' ), $post );
	elseif ( is_page() ) :
		$items[] = strip_tags( get_the_title( $post->ID ) );
	elseif ( is_singular( 'post' ) ) :
		$categories = get_the_category();
		if ( $categories ) :
			$category = array_shift( $categories );

			$items[] = array(
				'name' => $category->name,
				'url' => get_category_link( $category )
			);

			if ( $category->description ) :
				$items[] = array(
					'name' => $category->description,
					'is_desc' => true
				);
			endif;

			$term_meta = get_option( 'taxonomy_' . $category->term_id, array() );
			if ( ! empty( $term_meta['color'] ) ) :
				$band_bg = $term_meta['color'];
			endif;
		endif;
	endif;

	if ( $items ) :
?>
	<div class="p-header-band"<?php if ( $band_bg ) echo ' style="background-color: ' . esc_attr( $band_bg ) . '"'; ?>>
		<ul class="p-header-band__inner l-inner u-clearfix">
<?php
		$is_first = true;
		foreach( $items as $item ) :
			$item_class = 'p-header-band__item';
			$a_style = '';
			if ( is_string( $item ) ) :
				$item = array( 'name' => $item );
			endif;
			if ( ! empty( $item['is_desc'] ) ) :
				$item_class .= ' p-header-band__item-desc';
			endif;
			if ( $is_first ) :
				$item_class .= ' is-active';
				$is_first = false;
				if ( $band_bg ) :
					$a_style = ' style="color: ' . esc_attr( $band_bg ) . '"';
				endif;
			endif;
			if ( ! empty( $item['name'] ) && ! empty( $item['url'] ) ) :
				echo "\t\t\t<li class=\"{$item_class}\"><a href=\"" . esc_attr( $item['url'] ) . "\"{$a_style}>" . esc_html( $item['name'] ) . "</a></li>\n";
			elseif ( ! empty( $item['name'] ) ) :
				echo "\t\t\t<li class=\"{$item_class}\"><span>" . esc_html( $item['name'] ) . "</span></li>\n";
			endif;
		endforeach;
?>

		</ul>
	</div>
<?php
	endif;

endif;

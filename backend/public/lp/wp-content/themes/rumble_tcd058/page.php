<?php
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
		<article class="p-entry <?php echo $active_sidebars['column_layout_class'] ? 'l-primary' : 'l-inner'; ?>">
			<div class="p-entry__inner">
<?php
		if ( has_post_thumbnail() ) :
			echo "\t\t\t\t<div class=\"p-entry__thumbnail\">";
			the_post_thumbnail( 'size5' );
			echo "</div>\n";
		endif;
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
			</div>
		</article>
<?php
	endwhile;

	if ( $active_sidebars['column_layout_class'] ) :
		get_sidebar();
?>
	</div>
<?php
	endif;
endif;
?>
</main>
<?php get_footer(); ?>

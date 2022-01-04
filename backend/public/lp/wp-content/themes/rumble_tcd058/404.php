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
<?php
endif;
?>

		<div class="p-entry <?php echo $active_sidebars['column_layout_class'] ? 'l-primary' : 'l-inner'; ?>">
			<p><?php _e( "Sorry, but you are looking for something that isn't here.", 'tcd-w' ); ?></p>
		</div>
<?php
if ( $active_sidebars['column_layout_class'] ) :
	get_sidebar();
?>
	</div>
<?php
endif;
?>
</main>
<?php get_footer(); ?>

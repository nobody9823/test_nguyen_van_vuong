<?php
global $active_sidebars, $dp_options;
if ( ! $dp_options ) $dp_options = get_design_plus_option();
if ( ! $active_sidebars ) $active_sidebars = get_active_sidebars();

if ( 'type2' == $dp_options['layout_mobile'] ) :
	if ( $active_sidebars['sidebar_b'] ) :
?>
		<aside class="p-sidebar p-sidebar-b l-tertiary">
			<div class="p-sidebar__inner l-tertiary__inner">
<?php
		dynamic_sidebar( $active_sidebars['sidebar_b'] );
?>
			</div>
		</aside>
<?php
	endif;

	if ( $active_sidebars['sidebar_a'] ) :
?>
		<aside class="p-sidebar p-sidebar-a l-secondary">
			<div class="p-sidebar__inner l-secondary__inner">
<?php
		dynamic_sidebar( $active_sidebars['sidebar_a'] );
?>
			</div>
		</aside>
<?php
	endif;
else :
	if ( $active_sidebars['sidebar_a'] ) :
?>
		<aside class="p-sidebar p-sidebar-a l-secondary">
			<div class="p-sidebar__inner l-secondary__inner">
<?php
		dynamic_sidebar( $active_sidebars['sidebar_a'] );
?>
			</div>
		</aside>
<?php
	endif;

	if ( $active_sidebars['sidebar_b'] ) :
?>
		<aside class="p-sidebar p-sidebar-b l-tertiary">
			<div class="p-sidebar__inner l-tertiary__inner">
<?php
		dynamic_sidebar( $active_sidebars['sidebar_b'] );
?>
			</div>
		</aside>
<?php
	endif;
endif;

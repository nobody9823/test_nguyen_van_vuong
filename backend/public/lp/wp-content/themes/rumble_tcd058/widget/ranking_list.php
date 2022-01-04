<?php

class Ranking_List_Widget extends WP_Widget {

	private $default_instance = array();

	function __construct() {
		// デフォルト設定
		$this->default_instance = array(
			'title' => '',
			'post_num' => 5,
			'category' => 0,
			'show_views' => 0,
			'show_native_ad' => 0,
			'link_text' => '',
			'link_url' => '',
			'link_target_blank' => 0
		);

		parent::__construct(
			'ranking_list_widget',// ID
			__( 'Ranking list (tcd ver)', 'tcd-w' ),
			array(
				'classname' => 'ranking_list_widget',
				'description' => __( 'Displays access ranking list.', 'tcd-w' )
			)
		);
	}

	function widget( $args, $instance ) {
		global $dp_options;
		if ( ! $dp_options ) $dp_options = get_design_plus_option();

		$instance = wp_parse_args( (array) $instance, $this->default_instance );

		extract($args);

		$instance['post_num'] = absint( $instance['post_num'] );
		if ( ! $instance['post_num'] ) return;

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$query_args = array(
			'post_type' => 'post',
			'posts_per_page' => $instance['post_num'],
			'ignore_sticky_posts' => 1,
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'meta_key' => '_views'
		);
		if ( $instance['category'] ) {
			$query_args['cat'] = $instance['category'];
		}

		$widget_query = new WP_Query( $query_args );

		// ネイティブ広告
		if ( ! empty( $instance['show_native_ad'] ) ) {
			$native_ad = get_native_ad();
		} else {
			$native_ad = false;
		}
?>
<ol class="p-widget-list p-widget-list__ranking">
<?php
		if ( $widget_query->have_posts() || $native_ad ) :
			global $post;
			$rank = 0;
			if ( $widget_query->have_posts() ) :
				while ( $widget_query->have_posts() ) :
					$widget_query->the_post();
					$rank++;

					$catlist_float = array();
					if ( has_category() ) :
						$categories = get_the_category();
						if ( $categories && ! is_wp_error( $categories ) ) :
							foreach( $categories as $category ) :
								$catlist_float[] = '<span class="p-category-item--' . esc_attr( $category->term_id ) . '" data-url="' . get_category_link( $category ) . '">' . esc_html( $category->name ) . '</span>';
								break;
							endforeach;
						endif;
					endif;
?>
	<li class="p-widget-list__item u-clearfix">
		<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink() ?>">
			<span class="p-widget-list__item-rank"><?php echo $rank; ?></span>
			<div class="p-category-label"><?php
				if ( $catlist_float ) :
					echo implode( ', ', $catlist_float );
				else :
					echo '<span>&nbsp;</span>';
				endif;
			?></div>
			<h3 class="p-widget-list__item-title p-article__title"><?php echo mb_strimwidth( strip_tags( get_the_title() ), 0, is_mobile() ? 64 : 72, '...' ); ?></h3>
<?php
					if ( $instance['show_views'] ) :
?>
			<div class="p-widget-list__item-meta p-article__meta"><?php
						if ( $instance['show_views'] ) :
				?><span class="p-article__views"><?php echo number_format( intval( get_post_meta( get_the_ID(), '_views', true ) ) ); ?> views</span><?php
						endif;
			?></div>
<?php
					endif;
?>
		</a>
	</li>
<?php
				endwhile;
				wp_reset_postdata();
			endif;

			// ネイティブ広告
			if ( $native_ad ) :
?>
	<li class="p-widget-list__item u-clearfix">
		<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
<?php
				if ( $native_ad['native_ad_label'] ) :
?>
			<div class="p-native-ad-label"><?php echo esc_html( $native_ad['native_ad_label'] ); ?></div>
<?php
				endif;
?>
			<h3 class="p-widget-list__item-title p-article__title"><?php echo esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, is_mobile() ? 64 : 72, '...' ) ); ?></h3>
		</a>
	</li>
<?php
			endif;
		else :
?>
	<li class="no_post"><?php _e( 'There is no registered post.', 'tcd-w' ); ?></li>
<?php
		endif;
?>
</ol>
<?php
		if ( $instance['link_text'] && $instance['link_url'] ) :
?>
<p class="p-widget__ranking-link"><a href="<?php echo esc_attr( $instance['link_url'] ); ?>"<?php if ( $instance['link_target_blank'] ) echo ' target="_blank"'; ?>><?php echo esc_html( $instance['link_text'] ); ?></a></p>
<?php
		endif;

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $this->default_instance;
		$instance['title'] = wp_filter_nohtml_kses( $new_instance['title'] );
		$instance['post_num'] = absint( $new_instance['post_num'] );
		$instance['category'] = absint( $new_instance['category'] );
		$instance['show_views'] = ! empty( $new_instance['show_views'] ) ? 1 : 0;
		$instance['show_native_ad'] = ! empty( $new_instance['show_native_ad'] ) ? 1 : 0;
		$instance['link_text'] = wp_filter_nohtml_kses( $new_instance['link_text'] );
		$instance['link_url'] = wp_filter_nohtml_kses( $new_instance['link_url'] );
		$instance['link_target_blank'] = ! empty( $new_instance['link_target_blank'] ) ? 1 : 0;
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->default_instance );
		$instance['post_num'] = absint( $instance['post_num'] );
		$instance['category'] = absint( $instance['category'] );
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tcd-w' ); ?></label>
			<input class="large-text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_num' ); ?>"><?php _e( 'Number of ranks:', 'tcd-w' ); ?></label>
			<input class="large-text" id="<?php echo $this->get_field_id( 'post_num' ); ?>" name="<?php echo $this->get_field_name( 'post_num' ); ?>" type="number" value="<?php echo esc_attr( $instance['post_num'] ); ?>" min="1">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'tcd-w' ); ?></label>
<?php
		wp_dropdown_categories( array(
			'class' => 'widefat',
			'echo' => 1,
			'hide_empty' => 0,
			'hierarchical' => 1,
			'id' => $this->get_field_id( 'category' ),
			'name' => $this->get_field_name( 'category' ),
			'selected' => $instance['category'],
			'show_count' => 0,
			'show_option_all' => __( 'All categories', 'tcd-w' ),
			'value_field' => 'term_id'
		) );
?>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'show_views' ); ?>" name="<?php echo $this->get_field_name( 'show_views' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_views'], '1' ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_views' ); ?>"><?php _e( 'Display views', 'tcd-w' ); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'show_native_ad' ); ?>" name="<?php echo $this->get_field_name( 'show_native_ad' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_native_ad'], '1' ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_native_ad' ); ?>"><?php _e( 'Display native advertisement', 'tcd-w' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php _e( 'Link text:', 'tcd-w' ); ?></label>
			<input class="large-text" id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" type="text" value="<?php echo esc_attr( $instance['link_text'] ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php _e( 'Link url:', 'tcd-w' ); ?></label>
			<input class="large-text" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['link_url'] ); ?>">
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'link_target_blank' ); ?>" name="<?php echo $this->get_field_name( 'link_target_blank' ); ?>" type="checkbox" value="1" <?php checked( $instance['link_target_blank'], '1' ); ?>>
			<label for="<?php echo $this->get_field_id( 'link_target_blank' ); ?>"><?php _e( 'Open link in new window', 'tcd-w' ); ?></label>
		</p>
<?php
	}
}

function register_ranking_list_widget() {
	register_widget( 'Ranking_List_Widget' );
}
add_action( 'widgets_init', 'register_ranking_list_widget' );

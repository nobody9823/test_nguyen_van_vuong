<?php
/**
 * Styled post list (tcd ver)
 */
class Styled_Post_List1_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'styled_post_list1_widget', // ID
			__( 'Styled post list (tcd ver)', 'tcd-w' ), // Name
			array(
				'classname' => 'styled_post_list1_widget',
				'description' => __( 'Displays styled post list.', 'tcd-w' )
			)
		);
	}

	function widget( $args, $instance ) {
		global $dp_options;
		if ( ! $dp_options ) $dp_options = get_design_plus_option();

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$list_style = isset( $instance['list_style'] ) ? $instance['list_style'] : 'type1';
		$list_type = isset( $instance['list_type'] ) ? $instance['list_type'] : 'recent_post';
		$post_num = isset( $instance['post_num'] ) ?  absint( $instance['post_num'] ) : 3;
		$post_order = isset( $instance['post_order'] ) ? $instance['post_order'] : 'date1';
		$show_category = isset( $instance['show_category'] ) ? $instance['show_category'] : 1;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : 0;
		$show_native_ad = isset( $instance['show_native_ad'] ) ? $instance['show_native_ad'] : 0;
		$native_ad_position = isset( $instance['native_ad_position'] ) ? absint( $instance['native_ad_position'] ) : 3;

		if ( ! in_array( $list_style, array( 'type1', 'type2', 'type3' ) ) ) {
			$list_style = 'type1';
		}

		if ( 'date2' == $post_order ) {
			$order = 'ASC';
		} else {
			$order = 'DESC';
		}
		if ( $post_order == 'date1' || $post_order == 'date2' ) {
			$post_order = 'date';
		}

		// Full widthの場合固定値上書き
		if ( 'type1' == $list_style ) {
			$show_native_ad = 0;
		}

		if ( 'recent_post' == $list_type ) {
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $post_num,
				'ignore_sticky_posts' => 1,
				'orderby' => $post_order,
				'order' => $order
			);
		} else {
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $post_num,
				'ignore_sticky_posts' => 1,
				'orderby' => $post_order,
				'order' => $order,
				'meta_key' => $list_type,
				'meta_value' => 'on'
			);
		}

		$widget_query = new WP_Query( $args );

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo '<ul class="p-widget-list p-widget-list__' . esc_attr( $list_style ) . '">' . "\n";

		if ( $widget_query->have_posts() ) :
			global $post;
			$post_count = 0;
			$post_count_with_ad = 0;

			// Full widthでランダム以外の場合ランダム化して1件に
			if ( 'type1' == $list_style && 'rand' != $post_order && $widget_query->post_count > 1 ) {
				$rand_key = mt_rand( 0, $widget_query->post_count - 1 );
				if ( isset( $widget_query->posts[$rand_key] ) ) {
					$widget_query->post = $widget_query->posts[$rand_key];
				} else {
					shuffle( $widget_query->posts );
					$widget_query->post = array_shift( $widget_query->posts );
				}
				$widget_query->posts = array( $widget_query->post );
				$widget_query->post_count = 1;
			}

			while ( $widget_query->have_posts() ) :
				$widget_query->the_post();
				$post_count++;
				$post_count_with_ad++;

				if ( 'type3' == $list_style ) :
					$catlist_meta = array();
					if ( $show_category && has_category() ) :
						$categories = get_the_category();
						if ( $categories && ! is_wp_error( $categories ) ) :
							foreach( $categories as $category ) :
								$catlist_meta[] = '<a class="p-article__meta-link" class="" href="' . get_category_link( $category ) . '">' . esc_html( $category->name ) . '</a>';
							endforeach;
						endif;
					endif;
?>
	<li class="p-widget-list__item">
		<a href="<?php the_permalink() ?>">
			<h3 class="p-widget-list__item-title p-article__title"><?php echo mb_strimwidth( strip_tags( get_the_title() ), 0, is_mobile() ? 80 : 84, '...' ); ?></h3>
		</a>
<?php
					if ( $catlist_meta || $show_date ) :
?>
		<p class="p-widget-list__item-meta p-article__meta"><?php
						if ( $catlist_meta ) :
			?><span class="p-widget-list__item-category p-article__category"><?php echo implode( ', ', $catlist_meta ); ?></span><?php
						endif;
						if ( $show_date ) :
			?><time class="p-widget-list__item-date p-article__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time><?php
						endif;
		?></p>
<?php
					endif;
?>
	</li>
<?php
				else :
					$catlist_float = array();
					if ( $show_category && has_category() ) :
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
			<div class="p-widget-list__item-thumbnail p-hover-effect__image js-object-fit-cover"><?php
					if ( 'type2' == $list_style ) :
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'size1' );
						else :
							echo '<img src="' . get_template_directory_uri() . '/img/no-image-300x300.gif" alt="">';
						endif;
					else :
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'size2' );
						else :
							echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x420.gif" alt="">';
						endif;
					endif;

					if ( $catlist_float ) :
						echo '<div class="p-float-category">' . implode( ', ', $catlist_float ) . '</div>';
					endif;
			?></div>
			<div class="p-widget-list__item-info">
				<h3 class="p-widget-list__item-title p-article__title"><?php
					if ( 'type2' == $list_style ) :
						echo mb_strimwidth( strip_tags( get_the_title() ), 0, 72, '...' );
					else :
						echo mb_strimwidth( strip_tags( get_the_title() ), 0, is_mobile() ? 100 : 92, '...' );
					endif;
				?></h3>
<?php
					if ( $show_date ) :
?>
				<p class="p-widget-list__item-meta p-article__meta"><time class="p-widget-list__item-date p-article__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time></p>
<?php
					endif;
?>
			</div>
		</a>
	</li>
<?php
				endif;

				// ネイティブ広告
				if ( $show_native_ad && 0 === $post_count % $native_ad_position ) :
					$native_ad = get_native_ad();
					if ( $native_ad ) :
						$post_count_with_ad++;
?>
	<li class="p-widget-list__item u-clearfix">
		<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
<?php
						if ( 'type3' != $list_style ) :
?>
			<div class="p-widget-list__item-thumbnail p-hover-effect__image js-object-fit-cover"><?php
							$image_src = null;
							if ( 'type2' == $list_style ) :
								if ( $native_ad['native_ad_image'] ) :
									$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size1' );
								endif;
								if ( ! empty( $image_src[0] ) ) :
									echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

								else :
									echo '<img src="' . get_template_directory_uri() . '/img/no-image-300x300.gif" alt="">';
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

							if ( $show_category && $native_ad['native_ad_label'] ) :
								echo '<div class="p-float-native-ad-label">' .  esc_html( $native_ad['native_ad_label'] ) . '</div>';
							endif;
			?></div>
<?php
						endif;
?>
			<div class="p-widget-list__item-info">
				<h3 class="p-widget-list__item-title p-article__title"><?php
						if ( 'type3' == $list_style ) :
							echo esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, 84, '...' ) );
						elseif ( 'type2' == $list_style ) :
							echo esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, 72, '...' ) );
						else :
							echo esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, is_mobile() ? 80 : 96, '...' ) );
						endif;
				?></h3>
<?php
						if ( 'type3' == $list_style ) :
							if ( $native_ad['native_ad_sponsor'] || $native_ad['native_ad_label'] ) :
								echo "\t\t\t\t";
								echo '<p class="p-widget-list__item-meta p-article__meta">';

								if ( $native_ad['native_ad_sponsor'] ) :
									echo '<span class="p-article__native-ad-sponsor">' . esc_html( $native_ad['native_ad_sponsor'] ) . '</span>';
								endif;

								if ( $native_ad['native_ad_label'] ) :
									echo '<span class="p-article__native-ad-label">' .  esc_html( $native_ad['native_ad_label'] ) . '</span>';
								endif;

								echo '</p>' . "\n";
							endif;
						elseif ( $native_ad['native_ad_sponsor'] || ( ! $show_category && $native_ad['native_ad_label'] ) ) :
							echo "\t\t\t\t";
							echo '<p class="p-widget-list__item-meta p-article__meta">';

							if ( $native_ad['native_ad_sponsor'] ) :
								echo '<span class="p-article__native-ad-sponsor">' . esc_html( $native_ad['native_ad_sponsor'] ) . '</span>';
							endif;

							if ( ! $show_category && $native_ad['native_ad_label'] ) :
								echo '<span class="p-article__native-ad-label">' .  esc_html( $native_ad['native_ad_label'] ) . '</span>';
							endif;

							echo '</p>' . "\n";
						endif;
?>
			</div>
		</a>
	</li>
<?php
					endif;
				endif;
			endwhile;
			wp_reset_postdata();
		else :
?>
			<li class="no_post"><?php _e( 'There is no registered post.', 'tcd-w' ); ?></li>
<?php
		endif;

		echo "</ul>\n";

		echo $after_widget;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$list_style = isset( $instance['list_style'] ) ? $instance['list_style'] : 'type1';
		$list_type = isset( $instance['list_type'] ) ? $instance['list_type'] : 'recent_post';
		$post_num = isset( $instance['post_num'] ) ?  absint( $instance['post_num'] ) : 3;
		$post_order = isset( $instance['post_order'] ) ? $instance['post_order'] : 'date1';
		$show_category = isset( $instance['show_category'] ) ? $instance['show_category'] : 1;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : 0;
		$show_native_ad = isset( $instance['show_native_ad'] ) ? $instance['show_native_ad'] : 0;
		$native_ad_position = isset( $instance['native_ad_position'] ) ?  absint( $instance['native_ad_position'] ) : 3;
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tcd-w' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'list_style' ); ?>"><?php _e( 'Thumbnail type:', 'tcd-w' ); ?></label>
			<select class="widefat js-styled_post_list1-list_style" id="<?php echo $this->get_field_id( 'list_style' ); ?>" name="<?php echo $this->get_field_name( 'list_style' ); ?>">
				<option value="type1" <?php selected( $list_style, 'type1' ); ?>><?php _e( 'Full width', 'tcd-w' ); ?></option>
				<option value="type2" <?php selected( $list_style, 'type2' ); ?>><?php _e( 'Square', 'tcd-w' ); ?></option>
				<option value="type3" <?php selected( $list_style, 'type3' ); ?>><?php _e( 'Title only', 'tcd-w' ); ?></option>
			</select>
		</p>
		<div class="description styled_post_list1-list_style-type1<?php echo 'type1' == $list_style ? '' : ' hidden'; ?>" style="padding: 0;"><?php _e( 'One item is randomly displayed from the following conditions.', 'tcd-w' ); ?></div>
		<p>
			<label for="<?php echo $this->get_field_id( 'list_type' ); ?>"><?php _e( 'Post type:', 'tcd-w' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'list_type' ); ?>" name="<?php echo $this->get_field_name( 'list_type' ); ?>">
				<option value="recent_post" <?php selected( $list_type, 'recent_post' ); ?>><?php _e( 'Recent post', 'tcd-w' ); ?></option>
				<option value="recommend_post" <?php selected( $list_type, 'recommend_post' ); ?>><?php _e( 'Recommend post', 'tcd-w' ); ?></option>
				<option value="recommend_post2" <?php selected( $list_type, 'recommend_post2' ); ?>><?php _e( 'Recommend post2', 'tcd-w' ); ?></option>
				<option value="pickup_post" <?php selected( $list_type, 'pickup_post' ); ?>><?php _e( 'Pickup post', 'tcd-w' ); ?></option>
			</select>
		</p>
		<p class="styled_post_list1-list_style-type2 styled_post_list1-list_style-type3 styled_post_list1-list_style-type1-date1 styled_post_list1-list_style-type1-date2<?php echo 'type1' != $list_style || 'rand' != $post_order ? '' : ' hidden'; ?>">
			<span class="styled_post_list1-list_style-type2 styled_post_list1-list_style-type3<?php echo 'type1' == $list_style ? ' hidden' : ''; ?>">
				<label for="<?php echo $this->get_field_id( 'post_num' ); ?>"><?php _e( 'Number of post:', 'tcd-w' ); ?></label>
			</span>
			<span class="styled_post_list1-list_style-type1-date1 styled_post_list1-list_style-type1-date2<?php echo 'type1' == $list_style && ( 'date1' == $post_order || 'date2' == $post_order ) ? '' : ' hidden'; ?>">
				<label for="<?php echo $this->get_field_id( 'post_num' ); ?>"><?php _e( 'Number of random post:', 'tcd-w' ); ?></label>
			</span>
			<input class="large-text" id="<?php echo $this->get_field_id( 'post_num' ); ?>" name="<?php echo $this->get_field_name( 'post_num' ); ?>" type="number" value="<?php echo esc_attr( $post_num ); ?>" min="1">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e( 'Post order:', 'tcd-w' ); ?></label>
			<select class="widefat js-styled_post_list1-post_order" id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' ); ?>">
				<option value="date1" <?php selected( $post_order, 'date1' ); ?>><?php _e( 'Date (DESC)', 'tcd-w' ); ?></option>
				<option value="date2" <?php selected( $post_order, 'date2' ); ?>><?php _e( 'Date (ASC)', 'tcd-w' ); ?></option>
				<option value="rand" <?php selected( $post_order, 'rand' ); ?>><?php _e( 'Random', 'tcd-w' ); ?></option>
			</select>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $show_category, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display category', 'tcd-w' ); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" type="checkbox" value="1" <?php checked( $show_date, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display date', 'tcd-w' ); ?></label>
		</p>
		<p class="styled_post_list1-list_style-type2 styled_post_list1-list_style-type3<?php echo 'type1' == $list_style ? ' hidden' : ''; ?>">
			<input id="<?php echo $this->get_field_id( 'show_native_ad' ); ?>" name="<?php echo $this->get_field_name( 'show_native_ad' ); ?>" type="checkbox" value="1" <?php checked( $show_native_ad, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_native_ad' ); ?>"><?php _e( 'Display native advertisement', 'tcd-w' ); ?></label>
		</p>
		<p class="styled_post_list1-list_style-type2 styled_post_list1-list_style-type3<?php echo 'type1' == $list_style ? ' hidden' : ''; ?>">
			<label for="<?php echo $this->get_field_id( 'native_ad_position' ); ?>"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></label>
			<input class="small-text" id="<?php echo $this->get_field_id( 'native_ad_position' ); ?>" name="<?php echo $this->get_field_name( 'native_ad_position' ); ?>" type="number" value="<?php echo esc_attr( $native_ad_position ); ?>" min="1">
		</p>
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['list_style'] = strip_tags( $new_instance['list_style'] );
		$instance['list_type'] = strip_tags( $new_instance['list_type'] );
		$instance['post_num'] =  absint( $new_instance['post_num'] );
		$instance['post_order'] = strip_tags( $new_instance['post_order'] );
		$instance['show_date'] = ! empty( $new_instance['show_date'] ) ? 1 : 0;
		$instance['show_category'] = ! empty( $new_instance['show_category'] ) ? 1 : 0;
		$instance['show_native_ad'] = ! empty( $new_instance['show_native_ad'] ) ? 1 : 0;
		$instance['native_ad_position'] =  absint( $new_instance['native_ad_position'] );
		return $instance;
	}
}

function register_styled_post_list1_widget() {
	register_widget( 'Styled_Post_List1_Widget' );
}
add_action( 'widgets_init', 'register_styled_post_list1_widget' );

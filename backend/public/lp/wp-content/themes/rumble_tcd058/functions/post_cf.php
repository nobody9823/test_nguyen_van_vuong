<?php

function tcd_post_meta_box() {
	add_meta_box(
		'tcd_post_meta_box' ,// ID of meta box
		__( 'Post setting', 'tcd-w' ), // label
		'show_tcd_post_meta_box', // callback function
		'post', // post type
		'normal', // context
		'high' // priority
	);
}
add_action( 'add_meta_boxes', 'tcd_post_meta_box', 10 );

function show_tcd_post_meta_box() {
	global $post;

	// サイドコンテンツの設定
	$display_side_content = array(
		'name' => __( 'Display side content', 'tcd-w' ),
		'id' => 'display_side_content',
		'type' => 'radio',
		'std' => '',
		'options' => array(
			array(
				'name' => __( 'Use theme option setting', 'tcd-w' ),
				'value' => ''
			),
			array(
				'name' => __( 'Display sidebar A and sidebar B', 'tcd-w' ),
				'value' => 'type1'
			),
			array(
				'name' => __( 'Display sidebar A', 'tcd-w' ),
				'value' => 'type2'
			),
			array(
				'name' => __( 'Display sidebar B', 'tcd-w' ),
				'value' => 'type3'
			)
		)
	);
	$display_side_content_meta = $post->display_side_content;
	if ( ! $display_side_content_meta ) {
		$display_side_content_meta = $display_side_content['std'];
	}

	// ページナビゲーション設定
	$page_link = array(
		'name' => __( 'Pages link setting', 'tcd-w' ),
		'id' => 'page_link',
		'type' => 'radio',
		'std' => '',
		'options' => array(
			array(
				'name' => __( 'Use theme option setting', 'tcd-w' ),
				'value' => ''
			),
			array(
				'name' => __( 'Page numbers', 'tcd-w' ),
				'value' => 'type1'
			),
			array(
				'name' => __( 'Read more button', 'tcd-w' ),
				'value' => 'type2'
			)
		)
	);
	$page_link_meta = $post->page_link;
	if ( ! $page_link_meta ) {
		$page_link_meta = $page_link['std'];
	}

	echo '<input type="hidden" name="tcd_post_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />' . "\n";

	echo '<dl class="tcd_custom_fields">' . "\n";

	// サイドコンテンツの選択
	echo '<dt class="label"><label for="' . esc_attr( $display_side_content['id'] ) . '">' . esc_html( $display_side_content['name'] ). '</label></dt>';
	echo '<dd class="content"><ul class="radio side_content cf">';
	foreach ( $display_side_content['options'] as $display_side_content_option ) {
		echo '<li><label><input type="radio" id ="side_content-' . esc_attr( $display_side_content_option['value'] ) . '" name="' . $display_side_content['id'] . '" value="' . esc_attr( $display_side_content_option['value'] ) . '"' . checked( $display_side_content_meta, $display_side_content_option['value'] , false ) . ' />' . esc_html( $display_side_content_option['name'] ). '</label></li>';
	}
	echo '</ul></dd>';

	// ページナビゲーション設定
	echo '<dt class="label"><label for="' . esc_attr( $page_link['id'] ). '">' . esc_html( $page_link['name'] ) . '</label></dt>';
	echo '<dd class="content">';
	echo '<p class="desc">' . __( 'Please set the page navigation display method of page split display by & lt;! - nextpage - & gt;', 'tcd-w' ) . '</p>';
	echo '<ul class="radio page_link cf">';
	foreach ( $page_link['options'] as $page_link_option ) {
		echo '<li><label><input type="radio" id ="page_link-' . esc_attr( $page_link_option['value'] ) . '" name="' . $page_link['id'] . '" value="' . esc_attr( $page_link_option['value'] ) . '"' . checked( $page_link_meta, $page_link_option['value'] , false ) . ' />' . esc_html( $page_link_option['name'] ) . '</label></li>';
	}
	echo '</ul></dd>' . "\n";

	echo '</dl>' . "\n";
}

function save_tcd_post_meta_box( $post_id ) {

	// verify nonce
	if ( ! isset( $_POST['tcd_post_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['tcd_post_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
	}

	// save or delete
	$cf_keys = array(
		'display_side_content',
		'page_link'
	);
	foreach ( $cf_keys as $cf_key ) {
		$old = get_post_meta( $post_id, $cf_key, true );
		$new = isset( $_POST[$cf_key] ) ? $_POST[$cf_key] : '';

		if ( $new && $new != $old ) {
			update_post_meta( $post_id, $cf_key, $new );
		} elseif ( ! $new && $old ) {
			delete_post_meta( $post_id, $cf_key, $old );
		}
	}

}
add_action( 'save_post', 'save_tcd_post_meta_box' );

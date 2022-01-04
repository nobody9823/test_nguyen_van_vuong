<?php
function tcd_staff_meta_box() {
	add_meta_box(
		'staff_meta_box', // ID of meta box
		__( 'Staff setting', 'tcd-w' ), // label
		'show_tcd_staff_meta_box', // callback function
		'staff', // post type
		'normal', // context
		'high' // priority
	);
}
add_action( 'add_meta_boxes', 'tcd_staff_meta_box' );

function show_tcd_staff_meta_box( $post ) {
	wp_nonce_field( 'save_staff_meta_box', 'staff_meta_box_nonce' );

	echo '<dl class="ml_custom_fields">' . "\n";
	render_tcd_custom_fields_inputs( get_tcd_staff_fields() );
	echo "</dl>\n";
}

function save_staff_meta_box( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['staff_meta_box_nonce'] ) ) return;

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['staff_meta_box_nonce'], 'save_staff_meta_box' ) ) {
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
	$cf_keys = array();
	$fields = get_tcd_staff_fields();
	if ( ! $fields ) return $post_id;

	foreach( $fields as $field ) {
		if ( ! empty( $field['id'] ) ) {
			$cf_keys[] = $field['id'];
		}
	}

	foreach ( $cf_keys as $cf_key ) {
		$new = ( isset( $_POST[$cf_key] ) ) ? $_POST[$cf_key] : '';
		update_post_meta( $post_id, $cf_key, $new );
	}
}
add_action( 'save_post', 'save_staff_meta_box' );

/* フィールド配列を返す */
function get_tcd_staff_fields() {
	$staff_fields = array(
		array(
			'id' => 'staff_name',
			'name' => __( 'Staff name', 'tcd-w' ),
			'desc' => __( 'If empty the title will be used.', 'tcd-w' ),
			'type' => 'text',
		),
		array(
			'id' => 'staff_position',
			'name' => __( 'Official position, title etc.', 'tcd-w' ),
			'type' => 'text',
		),
		array(
			'id' => 'staff_facebook_url',
			'name' => __( 'Staff Facebook URL', 'tcd-w' ),
			'type' => 'text',
		),
		array(
			'id' => 'staff_twitter_url',
			'name' => __( 'Staff Twitter URL', 'tcd-w' ),
			'type' => 'text',
		),
		array(
			'id' => 'staff_insta_url',
			'name' => __( 'Staff Instagram URL', 'tcd-w' ),
			'type' => 'text',
		),
		array(
			'id' => 'staff_table',
			'name' => __( 'Staff infomation', 'tcd-w' ),
			'desc' => __( 'Please add the item from \"Add new\" and set display contents.', 'tcd-w' ),
			'type' => 'simple_repeater',
		),
		array(
			'id' => 'headline',
			'name' => __( 'Staff introduction title', 'tcd-w' ),
			'desc' => __( 'Displayed on the archive page and article page.', 'tcd-w' ),
			'type' => 'textarea',
			'rows' => '2'
		),
		array(
			'id' => 'desc',
			'name' => __( 'Staff introduction', 'tcd-w' ),
			'type' => 'textarea',
			'rows' => '4'
		),
		array(
			'id' => 'user_id',
			'name' => __( 'WordPress User', 'tcd-w' ),
			'desc' => __( 'The post list the selected user is displayed on the staff main page.', 'tcd-w' ),
			'type' => 'wp_dropdown_users',
		)
	);

	return $staff_fields;
}

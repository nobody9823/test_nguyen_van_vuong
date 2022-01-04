<?php
function tcd_voice_meta_box() {
	add_meta_box(
		'voice_meta_box', // ID of meta box
		__( 'Voice setting', 'tcd-w' ), // label
		'show_tcd_voice_meta_box', // callback function
		'voice', // post type
		'normal', // context
		'high' // priority
	);
}
add_action( 'add_meta_boxes', 'tcd_voice_meta_box' );

function show_tcd_voice_meta_box( $post ) {
	wp_nonce_field( 'save_voice_meta_box', 'voice_meta_box_nonce' );

	echo '<dl class="ml_custom_fields">' . "\n";
	render_tcd_custom_fields_inputs( get_tcd_voice_fields() );
	echo "</dl>\n";
}

function save_voice_meta_box( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['voice_meta_box_nonce'] ) ) return;

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['voice_meta_box_nonce'], 'save_voice_meta_box' ) ) {
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
	$fields = get_tcd_voice_fields();
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
add_action( 'save_post', 'save_voice_meta_box' );

// フィールド配列を返す
function get_tcd_voice_fields() {
	$voice_fields = array(
		array(
			'id' => 'archive_button',
			'name' => __( 'Article page link button label', 'tcd-w' ),
			'desc' => __( 'link from the archive page to the article page, please input the character to be displayed on the link button displayed in the list. If it is empty it will not be linked to the detail page.', 'tcd-w' ),
			'type' => 'text',
			'std' => __( 'Interview', 'tcd-w' )
		),
		array(
			'id' => 'headline',
			'name' => __( 'Customer voice title', 'tcd-w' ),
			'type' => 'textarea',
			'rows' => '2'
		),
		array(
			'id' => 'desc',
			'name' => __( 'Customer voice', 'tcd-w' ),
			'desc' => __( 'Displayed on the archive page and article page.', 'tcd-w' ),
			'type' => 'textarea',
			'rows' => '4'
		),
		array(
			'id' => 'voice_user',
			'name' => __( 'Customer name', 'tcd-w' ),
			'type' => 'text',
		),
		array(
			'id' => 'voice_user_info',
			'name' => __( 'Customer age, occupation, etc.', 'tcd-w' ),
			'desc' => __( 'It will appear after the name. Example: "Women" "26-year-old employee" etc.', 'tcd-w' ),
			'type' => 'text',
		),
		array(
			'id' => 'voice_user_table',
			'name' => __( 'Customer Information', 'tcd-w' ),
			'desc' => __( 'Please add the item from "Add new" and set display contents.', 'tcd-w' ),
			'type' => 'simple_repeater',
		),
		array(
			'id' => 'interview',
			'name' => __( 'interview', 'tcd-w' ),
			'desc' => __( 'Please add the item from "Add new" and set display contents. You can change the order by dragging each item.', 'tcd-w' ),
			'type' => 'interview',
		),
		array(
			'id' => 'course_desc',
			'name' => __( 'Menu introductory text', 'tcd-w' ),
			'type' => 'textarea',
			'rows' => '4'
		),
		array(
			'id' => 'course_url',
			'name' => __( 'Menu introduction link button URL', 'tcd-w' ),
			'type' => 'text'
		),
		array(
			'id' => 'course_button',
			'name' => __( 'Menu introduction link button label', 'tcd-w' ),
			'type' => 'text'
		)
	);

	return $voice_fields;
}

/*
 * フィールド入力フォームを出力
 */
function render_tcd_custom_fields_inputs( $fields = null, $type = null ) {
	global $post;
	$meta_values = get_post_meta( $post->ID );

	foreach( $fields as $field ) {
		if ( empty( $field['type'] ) ) $field['type'] = 'text';

		if ( isset( $meta_values[$field['id']][0] ) ) {
			$meta_value = $meta_values[$field['id']][0];
		} elseif ( ! empty( $field['std'] ) ) {
			$meta_value = $field['std'];
		} else {
			$meta_value = '';
		}

		if ( in_array( $field['type'], array( 'textarea', 'text', 'password', 'number', 'email', 'url', 'tel', 'date', 'select' ) ) && empty( $field['class'] ) ) {
			$field['class'] = 'widefat';
		} elseif ( ! isset( $field['class'] ) ) {
			$field['class'] = '';
		}

		$add_attr = '';
		if ( ! empty( $field['placeholder'] ) ) {
			$add_attr .= ' placeholder="' . esc_attr( $field['placeholder'] ) . '"';
		}
		if ( ! empty( $field['attribute'] ) ) {
			if ( is_array( $field['attribute'] ) ) {
				foreach ( $field['attribute'] as $key => $value ) {
					if ( is_int( $key ) ) {
						$add_attr .= ' ' . $value;
					} elseif ( is_string( $value ) ) {
						$add_attr .= ' ' . $key . '="' . esc_attr( $value ) . '"';
					}
				}
			} elseif ( is_string( $field['attribute'] ) ) {
				$add_attr .= ' ' . trim( $field['attribute'] );
			}
		}

		switch ( $field['type'] ) {
			case 'textarea' :
				echo '<dt class="label"><label for="' . esc_attr( $field['id'] ) . '">' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				$rows = 0;
				if ( ! empty( $field['rows'] ) ) {
					$rows = absint( $field['rows'] );
				}
				if ( $rows < 1 ) {
					$rows = 4;
				}
				echo '<textarea name="' . esc_attr( $field['id'] ). '" id="' . esc_attr( $field['id'] ) . '" cols="60" rows="' . $rows . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr . '>' . esc_textarea( $meta_value ) . '</textarea>';
				echo '</dd>' . "\n";
				break;

			case 'px' :
				echo '<dt class="label"><label for="' . esc_attr( $field['id'] ) . '">' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				echo '<input type="number" name="' . esc_attr( $field['id'] ) . '" id="' . esc_attr( $field['id'] ) . '" size="8" value="' . esc_attr( $meta_value ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr . ' />px';
				echo '</dd>' . "\n";
				break;

			case 'color' :
				echo '<dt class="label"><label>' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				echo '<input type="text" id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['id'] ). '" value="' . esc_attr( $meta_value ) . '" size="8" class="color" />';
				echo '<input type="button" style="margin:0 0 0 5px;" class="button-secondary" value="' . __( 'Default color', 'tcd-w' ) . '" onClick="document.getElementById(\'' . esc_attr( $field['id'] ) . '\').color.fromString(\'' . esc_attr( $field['std'] ) . '\')" />';
				echo '</dd>' . "\n";
				break;

			case 'image' :
				echo '<dt class="label"><label>' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				mlcf_media_form( $field['id'], $field['name'] );
				echo '</dd>' . "\n";
				break;

			case 'select':
				echo '<dt class="label"><label>' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				if ( ! empty( $field['options'] ) && is_array( $field['options'] ) ) {
					echo '<select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['id'] ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr . '>';
					echo '<option value=""></option>';
					foreach ( $field['options'] as $field_option ) {
						$selected = '';
						if ( isset( $field_option['name'] ) && isset( $field_option['value'] ) ) {
							if ( $field_option['value'] == $meta_value ) {
								$selected .= ' selected="selected"';
							}
							echo '<option value="' . esc_attr( $field_option['value'] ) . '"' . $selected . '>' . esc_html( $field_option['name'] ) . '</option>';
						} elseif ( isset( $field_option['name'] ) ) {
							if ( $field_option['name'] == $meta_value ) {
								$selected = ' selected="selected"';
							}
							echo '<option value="' . esc_attr( $field_option['name'] ) . '"' . $selected . '>' . esc_html( $field_option['name'] ) . '</option>';
						} elseif ( isset( $field_option['value'] ) ) {
							if ( $field_option['value'] == $meta_value ) {
								$selected = ' selected="selected"';
							}
							echo '<option value="' . esc_attr( $field_option['value'] ) . '"' . $selected . '>' . esc_html( $field_option['value'] ) . '</option>';
						} elseif ( is_string( $field_option ) ) {
							if ( $field_option == $meta_value ) {
								$selected = ' selected="selected"';
							}
							echo '<option value="' . esc_attr( $field_option ) . '"' . $selected . '>' . esc_html( $field_option ) . '</option>';
						}
					}
					echo '</select>';
				}
				echo '</dd>' . "\n";
				break;

			case 'radio':
				echo '<dt class="label"><label>' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				if ( ! empty( $field['options'] ) && is_array( $field['options'] ) ) {
					echo '<ul>';
					foreach ( $field['options'] as $field_option_key => $field_option ) {
						$label_class = '';
						$checked = '';
						if ( isset( $field_option['name'] ) && isset( $field_option['value'] ) ) {
							if ( $field_option['value'] == $meta_value ) {
								$label_class = ' class="active"';
								$checked = ' checked="checked"';
							}
							echo '<li><label' . $label_class . '><input type="radio" id="' . esc_attr( $field['id'] . '_' . $field_option_key ) . '" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field_option['value'] ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr.$checked . ' />' . esc_html( $field_option['name'] ) . '</label></li>';
						} elseif ( isset( $field_option['name'] ) ) {
							if ( $field_option['name'] == $meta_value ) {
								$label_class = ' class="active"';
								$checked = ' checked="checked"';
							}
							echo '<li><label' . $label_class . '><input type="radio" id="' . esc_attr( $field['id'] . '_' . $field_option_key ) . '" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field_option['name'] ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr.$checked . ' />' . esc_html( $field_option['name'] ) . '</label></li>';
						} elseif ( isset( $field_option['value'] ) ) {
							if ( $field_option['value'] == $meta_value ) {
								$label_class = ' class="active"';
								$checked = ' checked="checked"';
							}
							echo '<li><label' . $label_class . '><input type="radio" id="' . esc_attr( $field['id'] . '_' . $field_option_key ) . '" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field_option['value'] ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr.$checked . ' />' . esc_html( $field_option['value'] ) . '</label></li>';
						} elseif ( is_string( $field_option ) ) {
							if ( $field_option == $meta_value ) {
								$label_class = ' class="active"';
								$checked = ' checked="checked"';
							}
							echo '<li><label' . $label_class . '><input type="radio" id="' . esc_attr( $field['id'] . '_' . $field_option_key ) . '" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field_option ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr.$checked . ' />' . esc_html( $field_option ) . '</label></li>';
						}
					}
					echo '</ul>';
				}
				echo '</dd>' . "\n";
				break;

			case 'checkbox':
			case 'checkboxes':
				echo '<dt class="label"><label>' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				if ( !empty( $field['options'] ) && is_array( $field['options'] ) ) {
					$field_input_name = $field['id'];
					if ( $field['type'] == 'checkboxes' || count( $field['options'] ) > 1 ) {
						$field_input_name .= '[]';
					}

					echo '<ul>';
					foreach ( $field['options'] as $field_option_key => $field_option ) {
						$label_class = '';
						$checked = '';
						if ( isset( $field_option['name'] ) && isset( $field_option['value'] ) ) {
							if ( $meta_value && in_array( $field_option['value'], (array) $meta_value ) ) {
								$label_class = ' class="active"';
								$checked = ' checked="checked"';
							}
							echo '<li><label' . $label_class . '><input type="checkbox" id="' . esc_attr( $field['id'] . '_' . $field_option_key ) . '" name="' . esc_attr( $field_input_name ) . '" value="' . esc_attr( $field_option['value'] ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr.$checked . ' />' . esc_html( $field_option['name'] ) . '</label></li>';
						} elseif ( isset( $field_option['name'] ) ) {
							if ( $meta_value && in_array( $field_option['name'], (array) $meta_value ) ) {
								$label_class = ' class="active"';
								$checked = ' checked="checked"';
							}
							echo '<li><label' . $label_class . '><input type="checkbox" id="' . esc_attr( $field['id'] . '_' . $field_option_key ) . '" name="' . esc_attr( $field_input_name ) . '" value="' . esc_attr( $field_option['name'] ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr.$checked . ' />' . esc_html( $field_option['name'] ) . '</label></li>';
						} elseif ( isset( $field_option['value'] ) ) {
							if ( $meta_value && in_array( $field_option['value'], (array) $meta_value ) ) {
								$label_class = ' class="active"';
								$checked = ' checked="checked"';
							}
							echo '<li><label' . $label_class . '><input type="checkbox" id="' . esc_attr( $field['id'] . '_' . $field_option_key ) . '" name="' . esc_attr( $field_input_name ) . '" value="' . esc_attr( $field_option['value'] ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr.$checked . ' />' . esc_html( $field_option['value'] ) . '</label></li>';
						} elseif ( is_string( $field_option ) ) {
							if ( $meta_value && in_array( $field_option, (array) $meta_value ) ) {
								$label_class = ' class="active"';
								$checked = ' checked="checked"';
							}
							echo '<li><label' . $label_class . '><input type="checkbox" id="' . esc_attr( $field['id'] . '_' . $field_option_key ) . '" name="' . esc_attr( $field_input_name ) . '" value="' . esc_attr( $field_option ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr.$checked . ' />' . esc_html( $field_option ) . '</label></li>';
						}
					}
					echo '</ul>';
				}
				echo '</dd>' . "\n";
				break;

			case 'simple_repeater':
				echo '<dt class="label"><label>' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content cf_simple_repeater_container">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}

				// 行テンプレート
				$clone = '<tr>';
				$clone .= '<td><input type="text" name="' . esc_attr( $field['id']) . '[headline][]" size="10" value="" class="widefat" /></td>';
				$clone .= '<td><input type="text" name="' . esc_attr( $field['id'] ) . '[desc][]" size="30" value="" class="widefat" /></td>';
				$clone .= '<td class="col-delete"><a href="#" class="button button-secondary button-delete-row">' . __( 'Delete', 'tcd-w' ) . '</a></td>';
				$clone .= '</tr>';

				echo '<table class="cf_simple_repeater" data-delete-confirm="' . __( 'Delete?', 'tcd-w') . '">' . "\n";
				echo '<thead>' . "\n";
				echo '<tr>';
				echo '<th class="col-headline">' . __( 'Headline', 'tcd-w' ) . '</th>';
				echo '<th class="col-desc">' . __( 'Details', 'tcd-w' ) . '</th>';
				echo '<th class="col-delete"></th>';
				echo '</tr>' . "\n";
				echo '</thead>' . "\n";
				echo '<tbody>' . "\n";

				$meta_value = maybe_unserialize( $meta_value );

				if ( isset( $meta_value['headline'][0] ) ) {
					foreach( array_keys( $meta_value['headline'] ) as $repeater_index ) {
						if ( isset( $meta_value['headline'][$repeater_index] ) ) {
							$row_headline = $meta_value['headline'][$repeater_index];
						} else {
							$row_headline = '';
						}
						if ( isset( $meta_value['desc'][$repeater_index] ) ) {
							$row_desc = $meta_value['desc'][$repeater_index];
						} else {
							$row_desc = '';
						}

						echo '<tr>';
						echo '<td><input type="text" name="' . esc_attr( $field['id'] ) . '[headline][]" size="10" value="' . esc_attr( $row_headline ) . '" class="widefat" /></td>';
						echo '<td><input type="text" name="' . esc_attr( $field['id'] ) . '[desc][]" size="30" value="' . esc_attr( $row_desc ) . '" class="widefat" /></td>';
						echo '<td class="col-delete"><a href="#" class="button button-secondary button-delete-row">' . __( 'Delete', 'tcd-w' ) . '</a></td>';
						echo '</tr>' . "\n";
					}
				} else {
					echo $clone."\n";
				}

				echo '</tbody>' . "\n";
				echo '<tfoot class="hide hidden">' . "\n";
				echo '</tbody>' . "\n";
				echo '</table>' . "\n";

				echo '<a href="#" class="button button-secondary button-add-row" data-clone="' . esc_attr( $clone ) . '">' . __( 'Add row', 'tcd-w' ) . '</a>';

				echo '</dd>' . "\n";
				break;

			case 'interview':
				echo '<dt class="label"><label>' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content cf_simple_repeater_container interview_repeater">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}

				// 行テンプレート
				$clone = '<tr>';
				$clone .= '<td><label>' . __( 'Question:', 'tcd-w' ) . '<textarea name="' . esc_attr( $field['id'] ) . '[question][]" cols="40" rows="2" class="widefat"></textarea></label>';
				$clone .= '<label>' . __( 'Answer:', 'tcd-w' ) . '<textarea name="' . esc_attr( $field['id'] ) . '[answer][]" cols="40" rows="5" class="widefat"></textarea></label></td>';
				$clone .= '<td class="col-delete"><a href="#" class="button button-secondary button-delete-row">' . __( 'Delete', 'tcd-w' ) . '</a></td>';
				$clone .= '</tr>';

				echo '<table class="cf_simple_repeater cf_simple_repeater-sortable" data-delete-confirm="' . __( 'Delete?', 'tcd-w') . '">' . "\n";
				echo '<thead>' . "\n";
				echo '<tr>';
				echo '<th class="col-qa">' . __( 'Question / Answer', 'tcd-w' ) . '</th>';
				echo '<th class="col-delete"></th>';
				echo '</tr>' . "\n";
				echo '</thead>' . "\n";
				echo '<tbody>' . "\n";

				$meta_value = maybe_unserialize( $meta_value );

				if ( isset( $meta_value['question'][0] ) ) {
					foreach( array_keys( $meta_value['question'] ) as $repeater_index ) {
						if ( isset( $meta_value['question'][$repeater_index] ) ) {
							$row_question = $meta_value['question'][$repeater_index];
						} else {
							$row_question = '';
						}
						if ( isset( $meta_value['answer'][$repeater_index] ) ) {
							$row_answer = $meta_value['answer'][$repeater_index];
						} else {
							$row_answer = '';
						}

						echo '<tr>';
						echo '<td><label>' . __( 'Question:', 'tcd-w' ) . '<textarea name="' . esc_attr( $field['id'] ) . '[question][]" cols="40" rows="2" class="widefat">' . esc_textarea( $row_question ) . '</textarea></label>';
						echo '<label>' . __( 'Answer:', 'tcd-w' ) . '<textarea name="' . esc_attr( $field['id'] ) . '[answer][]" cols="40" rows="5" class="widefat">' . esc_textarea( $row_answer ) . '</textarea></label></td>';
						echo '<td class="col-delete"><a href="#" class="button button-secondary button-delete-row">' . __( 'Delete', 'tcd-w' ) . '</a></td>';
						echo '</tr>' . "\n";
					}
				} else {
					echo $clone."\n";
				}

				echo '</tbody>' . "\n";
				echo '<tfoot class="hide hidden">' . "\n";
				echo '</tbody>' . "\n";
				echo '</table>' . "\n";

				echo '<a href="#" class="button button-secondary button-add-row" data-clone="' . esc_attr( $clone ) . '">' . __( 'Add row', 'tcd-w' ) . '</a>';

				echo '</dd>' . "\n";
				break;

			case 'wp_dropdown_users':
				echo '<dt class="label"><label for="' . esc_attr( $field['id'] ) . '">' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				wp_dropdown_users( array(
					'show_option_all'         => __( 'Select a user', 'tcd-w' ),
					'orderby'                 => 'display_name',
					'order'                   => 'ASC',
					'show'                    => 'display_name',
					'echo'                    => true,
					'selected'                => $meta_value,
					'include_selected'        => true,
					'name'                    => $field['id'],
					'class'                   => ! empty( $field['class'] ) ? $field['class'] : 'widefat'
				) );
				echo '</dd>' . "\n";
				break;

			case 'hidden':
				echo '<input type="hidden" id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['id'] ) . '" class="' . $field['class'] . '" value="' . esc_attr( $meta_value ) . '"' . $add_attr . ' />';
				break;

			default :
				echo '<dt class="label"><label for="' . esc_attr( $field['id'] ) . '">' . esc_html( $field['name'] ) . '</label></dt>';
				echo '<dd class="content">';
				if ( ! empty( $field['desc'] ) ) {
					echo '<p class="desc">' . $field['desc'] . '</p>';
				}
				echo '<input type="' . esc_attr( $field['type'] ) . '" name="' . esc_attr( $field['id'] ) . '" id="' . esc_attr( $field['id'] ) . '" size="40" value="' . esc_attr( $meta_value ) . '" class="' . esc_attr( $field['class'] ) . '"' . $add_attr . ' />';
				echo '</dd>' . "\n";
				break;
		}
	}
}

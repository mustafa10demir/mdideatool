<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Add Ideas Ajax Function
 * @return void
 */
function imt_add_ideas_post() {
	check_ajax_referer( 'imt_nonce' );

	if ( ! function_exists( 'wp_handle_upload' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}
	$uploaded_file = $_FILES['file'];
	if ( $uploaded_file['type'] == "application/pdf" || $uploaded_file['type'] == "image/jpeg" || $uploaded_file['type'] == "image/png" || $uploaded_file['type'] == "application/msword" ) {
		$upload_overrides = array( 'test_form' => false );
		$move_file        = wp_handle_upload( $uploaded_file, $upload_overrides );
		$ideas            = array(
			'post_title'   => sanitize_text_field( $_POST['title'] ),
			'post_excerpt' => sanitize_text_field( $_POST['exp'] ),
			'tax_input'    => array( "ideas_category" => sanitize_text_field( $_POST['cat'] ) ),
			'meta_input'   => array( "_imt_attachment" => $move_file['url'] ),
			'post_type'    => IMT_PLUGIN_POST_TYPE,
			'post_status'  => 'pending',
		);
		$post_id = wp_insert_post( $ideas );
		update_post_meta($post_id, '_imt_score_count', 0);

	} else {
		header('HTTP/1.1 500 Internal Server Booboo');
		header('Content-Type: application/json; charset=UTF-8');
		die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
	}
	wp_die();
}

add_action( 'wp_ajax_imt_add_ideas', 'imt_add_ideas_post' );
<?php

/**
 * Add Ideas Ajax Function
 * @return void
 */
function imt_add_ideas_post() {
	check_ajax_referer( 'imt_nonce' );

	if ( ! function_exists( 'wp_handle_upload' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}
	// echo $_FILES["upload"]["name"];
	$uploaded_file    = $_FILES['file'];
	$upload_overrides = array( 'test_form' => false );
	$move_file        = wp_handle_upload( $uploaded_file, $upload_overrides );

	$my_post = array(
		'post_title'   => sanitize_text_field( $_POST['title'] ),
		'post_excerpt' => sanitize_text_field( $_POST['exp'] ),
		'tax_input'    => array( "ideas_category" => sanitize_text_field( $_POST['cat'] ) ),
		'meta_input'   => array( "_imt_attachment" => $move_file['url'] ),
		'post_type'    => IMT_PLUGIN_POST_TYPE,
		'post_status'  => 'pending',
	);
	wp_insert_post( $my_post );
	wp_die();
}

add_action( 'wp_ajax_imt_add_ideas', 'imt_add_ideas_post' );
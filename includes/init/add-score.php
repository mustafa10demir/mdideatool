<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Add Score User Id Ajax Function
 * @return void
 */
function imt_add_score() {
	check_ajax_referer( 'imt_nonce' );
	$post_id   = sanitize_text_field( $_POST['postID'] );
	$user_id   = get_current_user_id();
	$get_score = json_decode( get_post_meta( $post_id, '_imt_score', true ) );
	if ( is_array( $get_score ) ) {
		$get_score_key = array_search( $user_id, $get_score );
		if ( $get_score_key === false ) {
			$get_score[] = $user_id;
		} else {
			unset( $get_score[ $get_score_key ] );
		}
		update_post_meta( $post_id, '_imt_score', json_encode( $get_score ) );
	} else {
		update_post_meta( $post_id, '_imt_score', json_encode( [ $user_id ] ) );
	}
	imt_score_count($post_id);
	wp_die();
}
add_action( 'wp_ajax_imt_add_score', 'imt_add_score' );

/**
 * @param $post_id
 *
 * @return void
 */
function imt_score_count($post_id){
	$get_score = json_decode( get_post_meta( $post_id, '_imt_score', true ) );
	if ( is_array( $get_score ) ) {
		$score = count( $get_score );
		if ( is_user_logged_in() ) {
			if ( array_search( get_current_user_id(), $get_score ) !== false ) {
				$is_score = true;
			} else {
				$is_score = false;
			}
		}
	} else {
		$score = 0;
	}
	update_post_meta($post_id, '_imt_score_count', $score);
}
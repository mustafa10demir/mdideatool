<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Add Score Ajax Function
 * @return void
 */
function imt_add_score() {
	check_ajax_referer( 'imt_nonce' );

	$score     = sanitize_text_field( $_POST['score'] );
	$post_id   = sanitize_text_field( $_POST['postID'] );
	$get_score = get_post_meta( $post_id, '_imt_score', true ) ?? 0;
	$score     += $get_score;
	update_post_meta( $post_id, '_imt_score', $score );
	$imt_score_user = get_post_meta( $post_id, '_imt_score_user', true );
	if ( $imt_score_user ) {
		$imt_score_user .= ',' . get_the_author_meta( 'ID' );
	} else {
		$imt_score_user = get_the_author_meta( 'ID' );
	}
	update_post_meta( $post_id, '_imt_score_user', $imt_score_user );

	wp_die();
}
imt_add_score();
add_action( 'wp_ajax_imt_add_score', '_imt_add_score' );
<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

$attachment = get_post_meta( get_the_ID(), '_imt_attachment', true );
$get_score  = json_decode( get_post_meta( get_the_ID(), '_imt_score', true ) );
$is_score   = false;
if ( is_array( $get_score ) ) {
	$score = count( $get_score );
	if ( is_user_logged_in() ) {
		if ( array_search( get_current_user_id(), $get_score ) !== false ) {
			$is_score = true;
		}
	}
} else {
	$score = 0;
}

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


$current_time = new DateTime(current_time('d/m/Y'));
$post_time = new DateTime(get_the_time('d/m/Y'));
$last_time = $post_time->modify('+1 day');

if ($last_time < $current_time){
	$like_time = false;
} else {
	$like_time = true;
}
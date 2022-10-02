<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * @return void
 */
function imt_more_post_ajax() {
	check_ajax_referer( 'imt_nonce' );

	$page = sanitize_text_field( $_POST['pageNumber'] );
	$cat  = sanitize_text_field( $_POST['cat'] );
	if ( $cat == 0 ) {
		$cat = [];
	} else {
		$cat = array(
			array(
				'taxonomy' => 'ideas_category',
				'field'    => 'id',
				'terms'    => $cat,
			),
		);
	}
	header( "Content-Type: text/html" );
	$args = array(
		'suppress_filters' => true,
		'post_type'        => array( IMT_PLUGIN_POST_TYPE ),
		'post_status'      => 'publish',
		'paged'            => $page,
		'tax_query'        => $cat,
	);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) {
		while ( $loop->have_posts() ) {
			$loop->the_post();
			include IMT_PLUGIN_DIR . '/templates/view/ideas-box.php';
		}
	}
	wp_reset_postdata();
	wp_die();
}

add_action( 'wp_ajax_imt_more_post_ajax', 'imt_more_post_ajax' );

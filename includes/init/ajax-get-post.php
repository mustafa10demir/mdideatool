<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * @return void
 */
function imt_more_post_ajax() {
	check_ajax_referer( 'imt_nonce' );

	$page  = sanitize_text_field( $_POST['pageNumber'] );
	$cat   = sanitize_text_field( $_POST['cat'] );
	$order = [];
	if ( $cat == 0 ) {
		$cat = [];
	} else {
		$cat = [
			[
				'taxonomy' => 'ideas_category',
				'field'    => 'id',
				'terms'    => $cat,
			],
		];
	}

	if ( isset( $_POST['order'] ) ) {
		if ( $_POST['order'] == 3 ) {
			$order = [
				'orderby'  => 'meta_value_num',
				'meta_key' => '_imt_score_count',
			];
		} else if($_POST['order'] == 2) {
			$order = [
				'order' => 'ASC'
			];
		}
	}

	header( "Content-Type: text/html" );
	$args = array(
		'suppress_filters' => true,
		'post_type'        => array( IMT_PLUGIN_POST_TYPE ),
		'post_status'      => 'publish',
		'paged'            => $page,
		'tax_query'        => $cat,
	);
	$args = array_merge_recursive($args, $order);
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

add_action('wp_ajax_nopriv_imt_more_post_ajax', 'imt_more_post_ajax');
add_action('wp_ajax_imt_more_post_ajax', 'imt_more_post_ajax' );

<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'imtAddMetaBox' ) ) :

	class imtAddMetaBox {
		/**
		 * Hook listeners
		 */
		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );
		}

		/**
		 * Add Meta Box and Settings
		 *
		 * @param $post_type
		 *
		 * @return void
		 */
		public function add_meta_box( $post_type ) {
			if ( $post_type == IMT_PLUGIN_POST_TYPE ) {
				add_meta_box(
					'imt_attachment',
					__( 'Attachment', 'md-idea-tool' ),
					array( $this, 'attachment_meta_box_content' ),
					$post_type,
					'side',
					'low'
				);
				add_meta_box(
					'imt_score',
					__( 'Score', 'md-idea-tool' ),
					array( $this, 'score_meta_box_content' ),
					$post_type,
					'side',
					'low'
				);
			}
		}

		/**
		 * Save meta box, score and attachment
		 * for the future
		 *
		 * @param $post_id
		 *
		 * @return void
		 */
		public function save( $post_id ) {
			$types = [ 'imt_attachment', 'imt_score' ];
			if ( $_POST ) {
				foreach ( $types as $type ) {
					$data = sanitize_text_field( $_POST[ $type ] );
					update_post_meta( $post_id, '_' . $type, $data );
				}
			}
		}

		/**
		 * Meta Box Input Form
		 *
		 * @param $post
		 *
		 * @return void
		 */
		public function attachment_meta_box_content( $post ) {
			// Use get_post_meta to retrieve an existing value from the database.
			$value = get_post_meta( $post->ID, '_imt_attachment', true );
			echo '<a href="' . $value . '" target="_blank">' . $value . '</a>';
		}

		/**
		 * Meta Box Input Form
		 *
		 * @param $post
		 *
		 * @return void
		 */
		public function score_meta_box_content( $post ) {
			// Use get_post_meta to retrieve an existing value from the database.
			$get_score = json_decode( get_post_meta( $post->ID, '_imt_score', true ) );
			if ( is_array( $get_score ) ) {
				$score = count( $get_score );
			} else {
				$score = 0;
			}
			echo '<h2>' . $score . '</h2>';
		}
	}
endif;
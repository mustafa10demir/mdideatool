<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'imtAddEnqueue' ) ) :
	class imtAddEnqueue {
		public function addEnqueue( $page ) {
			wp_enqueue_style( 'imt-bootstrap',
				IMT_PLUGIN_TEMPLATES . '/css/bootstrap.min.css',
				array(),
				IMT_PLUGIN_VERSION,
				'all' );
			wp_enqueue_style( 'imt-swiper',
				IMT_PLUGIN_TEMPLATES . '/css/swiper-bundle.min.css',
				array(),
				rand( 0, 100 ),
				'all' );
			wp_enqueue_style( 'imt-archive',
				IMT_PLUGIN_TEMPLATES . '/css/ideatool-' . $page . '.css',
				array(),
				rand( 0, 100 )
			//TODO IMT_PLUGIN_VERSION
			);
			wp_enqueue_script( 'imt-bootstrap',
				IMT_PLUGIN_TEMPLATES . '/js/bootstrap.min.js',
				array( 'jquery' ),
				IMT_PLUGIN_VERSION );
			wp_enqueue_script( 'imt-swiper',
				IMT_PLUGIN_TEMPLATES . '/js/swiper-bundle.min.js',
				array( 'jquery' ),
				IMT_PLUGIN_VERSION );
			wp_enqueue_script( 'imt-script',
				IMT_PLUGIN_TEMPLATES . '/js/ideatool-' . $page . '.js',
				array( 'jquery' ),
				rand( 0, 100 )
			// TODO IMT_PLUGIN_VERSION
			);
			wp_localize_script(
				'imt-script',
				'ajax_posts_imt',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'imt_nonce' ),
					'success'    => __('Successfully Sent', 'md-idea-tool'),
				)
			);
		}
	}
endif;
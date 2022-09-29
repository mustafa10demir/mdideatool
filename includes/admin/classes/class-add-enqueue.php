<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'imtAddEnqueue' ) ) :
	class imtAddEnqueue {
		public function addEnqueue( $page ) {
			wp_enqueue_style( 'imt-bootstrap',
				'https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css',
				array(),
				IMT_PLUGIN_VERSION,
				'all' );
			wp_enqueue_style( 'imt-archive',
				IMT_PLUGIN_TEMPLATES . '/css/ideatool-' . $page . '.css',
				array(),
				rand(0,100)
			//TODO IMT_PLUGIN_VERSION
			);
			wp_enqueue_script( 'custom-popper',
				'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
				array( 'jquery' ),
				IMT_PLUGIN_VERSION );
			wp_enqueue_script( 'custom-bootstrap',
				'https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js',
				array( 'jquery' ),
				IMT_PLUGIN_VERSION );
			wp_enqueue_script( 'custom-script',
				IMT_PLUGIN_TEMPLATES . '/js/ideatool-' . $page . '.js',
				array( 'jquery' ),
			rand(0,100)
			// TODO IMT_PLUGIN_VERSION
			);
		}
	}
endif;
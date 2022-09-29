<?php
/**
 * Setup Plugins
 * @return void
 */
function imt_custom_post_type() {
	/**
	 * Add plugin Languages
	 */
	load_plugin_textdomain( 'md-idea-tool', false, IMT_PLUGIN_DIR . '/languages' );

	/**
	 * Add Idea Custom Post Type | Meta Box | Category
	 */
	$labels = array(
		'name'               => __( 'Ideas', 'md-idea-tool' ),
		'singular_name'      => __( 'Ideas', 'md-idea-tool' ),
		'menu_name'          => __( 'Ideas', 'md-idea-tool' ),
		'name_admin_bar'     => __( 'Ideas', 'md-idea-tool' ),
		'add_new'            => __( 'Add New', 'md-idea-tool' ),
		'add_new_item'       => __( 'Add New Idea', 'md-idea-tool' ),
		'new_item'           => __( 'New Idea', 'md-idea-tool' ),
		'edit_item'          => __( 'Edit Idea', 'md-idea-tool' ),
		'view_item'          => __( 'View Idea', 'md-idea-tool' ),
		'all_items'          => __( 'All Ideas', 'md-idea-tool' ),
		'search_items'       => __( 'Search Ideas', 'md-idea-tool' ),
		'not_found'          => __( 'No ideas found.', 'md-idea-tool' ),
		'not_found_in_trash' => __( 'No ideas found in Trash.', 'md-idea-tool' ),
		'archives'           => __( 'Idea archives', 'md-idea-tool' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => __( 'ideas', 'md-idea-tool' ) ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'author', 'excerpt', 'comments' ),
		'menu_icon'          => 'dashicons-buddicons-groups',
	);
	register_post_type( IMT_PLUGIN_POST_TYPE, $args );
	register_taxonomy( 'ideas_category',
		__( 'ideas', 'md-idea-tool' ),
		array(
			'hierarchical'  => true,
			'label'         => __( 'Ideas Category', 'md-idea-tool' ),
			'singular_name' => __( 'Category', 'md-idea-tool' ),
			"rewrite"       => true,
			"query_var"     => true,
		) );
}

add_action( 'init', 'imt_custom_post_type' );

/**
 * Add Ideas Archive Page | Add CSS&JS File custom archive page
 *
 * @param $archive_template
 *
 * @return mixed|string
 */
function imt_get_custom_post_type_archive( $archive_template ) {
	global $post;
	if ( is_post_type_archive( IMT_PLUGIN_POST_TYPE ) ) {
		$enqueue = new imtAddEnqueue();
		$enqueue->addEnqueue( 'archive' );
		$archive_template = IMT_PLUGIN_DIR . '/templates/archive-ideas.php';
	}

	return $archive_template;
}

add_filter( 'archive_template', 'imt_get_custom_post_type_archive' );

/**
 * Add Ideas Single Page
 *
 * @param $archive_template
 *
 * @return mixed|string
 */
function imt_get_custom_post_type_single( $archive_template ) {
	global $post;
	if ( $post->post_type == IMT_PLUGIN_POST_TYPE ) {
		$enqueue = new imtAddEnqueue();
		$enqueue->addEnqueue( 'single' );
		$archive_template = IMT_PLUGIN_DIR . '/templates/single-ideas.php';
	}

	return $archive_template;
}

add_filter( 'single_template', 'imt_get_custom_post_type_single' );


/**
 * Calls the class on the meta box.
 */
function imt_call_AddMetaBox() {
	new imtAddMetaBox();
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'imt_call_AddMetaBox' );
	add_action( 'load-post-new.php', 'imt_call_AddMetaBox' );
}

/**
 * Add Settings Sub Menu
 * @return void
 */
function imt_add_submenu_settings() {
	add_submenu_page(
		'edit.php?post_type=' . __( 'ideas', 'md-idea-tool' ),
		__( 'Settings', 'md-idea-tool' ),
		__( 'Settings', 'md-idea-tool' ),
		'manage_options',
		'imt-settings',
		'imt_settings_template'
	);
}

add_action( 'admin_menu', 'imt_add_submenu_settings' );
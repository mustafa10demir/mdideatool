<?php
get_header();

function imt_get_gategories($hide_empty){
	return get_categories( array(
		'type'     => 'post',
		'taxonomy' => 'ideas_category',
		'hide_empty'      => $hide_empty
	) );
}

$categories = imt_get_gategories(false);
$categoriesNotNull = imt_get_gategories(true);

require_once IMT_PLUGIN_DIR . '/templates/view/category.php';
if (is_user_logged_in()){
	require_once IMT_PLUGIN_DIR . '/templates/view/form.php';
} else {
	require_once IMT_PLUGIN_DIR . '/templates/view/login.php';
}

echo '<div id="imt-ideas-container">';
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		include IMT_PLUGIN_DIR . '/templates/view/ideas-box.php';
	endwhile; endif;
echo '</div>';
get_footer();

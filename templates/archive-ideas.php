<?php
get_header();

if (isset($_POST['title'] )) {
	require_once IMT_PLUGIN_DIR . '/includes/init/insert-ideas.php';
}

$categories = get_categories( array(
	'type'     => 'post',
	'taxonomy' => 'ideas_category',
) );

require_once IMT_PLUGIN_DIR . '/templates/view/category.php';
if (is_user_logged_in()){
	require_once IMT_PLUGIN_DIR . '/templates/view/form.php';
} else {
	require_once IMT_PLUGIN_DIR . '/templates/view/login.php';
}


if ( have_posts() ) : while ( have_posts() ) : the_post();
	echo '<div class="entry-content container">';
	require_once IMT_PLUGIN_DIR . '/templates/view/ideas-box.php';
	echo '</div>';
endwhile; endif;

get_footer();

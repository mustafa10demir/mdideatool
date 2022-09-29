<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Ideas Settings Page Save And Form
 * @return void
 */
function imt_settings_template() {
	if (isset($_POST['hours'])){
		update_option('imt_deadline_hours', sanitize_text_field($_POST['hours']));
	}
	$hours = get_option('imt_deadline_hours', 24);
    require_once IMT_PLUGIN_DIR. '/includes/admin/templates/settings.php';
}
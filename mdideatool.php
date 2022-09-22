<?php
/**
 * Plugin Name:       Idea Management Tool
 * Plugin URI:        https://www.wpsoft.co/
 * Description:       Idea Management Tool
 * Version:           1.0.0
 * Author:            Mustafa Demir
 * Author URI:        https://www.wpsoft.co/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       md-idea-tool
 * Domain Path:       /languages
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

define( 'MDIMT_PLUGIN', __FILE__ );

define( 'MDIMT_PLUGIN_BASENAME', plugin_basename( MDIMT_PLUGIN ) );

define( 'MDIMT_PLUGIN_DIR', untrailingslashit( dirname( MDIMT_PLUGIN ) ) );

require_once MDIMT_PLUGIN_DIR. '/includes/includes.php' ;
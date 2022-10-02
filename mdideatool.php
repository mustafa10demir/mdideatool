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

define( 'IMT_PLUGIN', __FILE__ );

define( 'IMT_PLUGIN_POST_TYPE', 'ideas' );

define( 'IMT_PLUGIN_BASENAME', plugin_basename( IMT_PLUGIN ) );

define( 'IMT_PLUGIN_DIR', untrailingslashit( dirname( IMT_PLUGIN ) ) );

define('IMT_PLUGIN_VERSION', '1.0.0');

define('IMT_PLUGIN_TEMPLATES', plugins_url( '/templates', __FILE__ ));

require_once IMT_PLUGIN_DIR. '/includes/includes.php' ;


$score     = 1;
$post_id   = 330;
$get_score = get_post_meta( $post_id, '_imt_score', true );
if (!$get_score){
	$get_score = 0;
}
$score     += $get_score;
update_post_meta( $post_id, 'imt_score', $score );
$imt_score_user = get_post_meta( $post_id, '_imt_score_user', true );
if ( $imt_score_user ) {
	$imt_score_user .= ',' . get_the_author_meta( 'ID' );
} else {
	$imt_score_user = get_the_author_meta( 'ID' );
}
update_post_meta( $post_id, 'imt_score_user', $imt_score_user );
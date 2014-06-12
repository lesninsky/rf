<?php
/*
	Extension Name: Extensions server
	Extension URI:
	Version: 0.8
	Description: Find new extensions and add-ons for the Runway framework.
	Author:
	Author URI:
	Text Domain:
	Domain Path:
	Network:
	Site Wide Only:
*/

// Settings
$fields = array(
	'var' => array(),
	'array' => array()
);

$default = array();

global $settingshortname;

$settings = array(
	'name' => 'Server',
	'alias' => 'server',
	'option_key' => $settingshortname.'extensions-server',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'downloads',
	'menu_permissions' => 'administrator',
	'file' => __FILE__,
);

global $server, $Server_Admin;

// Required components
include 'object.php';

$server = new Server_Settings_Object( $settings );

// Load admin components
if ( is_admin() ) {
	include 'settings-object.php';
	$Server_Admin = new Server_Admin( $settings );
}

do_action( 'extensions_server_is_load' );

// Setup a custom button in the title
function title_button_upload_exts( $title ) {
	if ( $_GET['page'] == 'server' ) {
		$title .= ' <a href="admin.php?page=server&navigation=add-extension" class="add-new-h2">'. __( 'Upload New', FRAMEWORK_TEXT ) .'</a> <a href="admin.php?page=directory" class="add-new-h2">'. __( 'Search Directory', FRAMEWORK_TEXT ) .'</a>';
	}
	return $title;
}
add_filter( 'framework_admin_title', 'title_button_upload_exts' );

add_action('add_report', 'extensions_server_report');

function extensions_server_report($reports_object){
	$upload_dir = wp_upload_dir( );
	$downloads_dir = $upload_dir['basedir'].'/downloads-directory';
	$reports_object->assign_report(array(
		'source' => 'Extensions Server',
		'report_key' => 'download_dir_exists',
		'path' => $downloads_dir,
		'success_message' => 'Downlads directory ('.$downloads_dir.') is exists.',
		'fail_message' => 'Downlads directory ('.$downloads_dir.') is not exists.',
	), 'FILE_EXISTS' );

	$reports_object->assign_report(array(
		'source' => 'Extensions Server',
		'report_key' => 'download_dir_writable',
		'path' => $downloads_dir,
		'success_message' => 'Downlads directory ('.$downloads_dir.') is writable.',
		'fail_message' => 'Downlads directory ('.$downloads_dir.') is not writable.',
	), 'IS_WRITABLE' );	

	$sources_dir = $upload_dir['basedir'].'/downloads-sources/';
	$reports_object->assign_report(array(
		'source' => 'Extensions Server',
		'report_key' => 'download_sources_dir_exists',
		'path' => $sources_dir,
		'success_message' => 'Sources directory ('.$sources_dir.') is exists.',
		'fail_message' => 'Sources directory ('.$sources_dir.') is not exists.',
	), 'FILE_EXISTS' );

	$reports_object->assign_report(array(
		'source' => 'Extensions Server',
		'report_key' => 'download_sources_dir_writable',
		'path' => $sources_dir,
		'success_message' => 'Sources directory ('.$sources_dir.') is writable.',
		'fail_message' => 'Sources directory ('.$sources_dir.') is not writable.',
	), 'IS_WRITABLE' );	
}

?>

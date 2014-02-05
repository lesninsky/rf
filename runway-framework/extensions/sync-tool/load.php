<?php
/*
	Extension Name: Sync tool
	Extension URI:
	Version: 0.7.1
	Description:  
	Author: Parallelus
	Author URI: http://para.llel.us
*/

// Reset
if ( 0 ) update_option( 'sync-tool', array() );

// Settings

$fields = array(
	'var' => array( 'menu_url', 'menu_name', 'page_name', 'menu_permissions', 'slug', 'function' ),
	'array' => array()
);

$default = array();

$settings = array(
	'name' => 'Sync tool',
	'option_key' => $shortname.'sync-tool',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'settings',
	'menu_permissions' => 'administrator',
	'file' => __FILE__,
	'js' => array(		
		FRAMEWORK_URL.'extensions/sync-tool/js/sync-tool-connections.js',
		'jquery-ui-core',
		'jquery-ui-dialog',
		// FRAMEWORK_URL.'framework/js/jquery.tmpl.min.js',		
		// FRAMEWORK_URL.'framework/js/jquery-ui.min.js',        
		// FRAMEWORK_URL.'framework/js/jquery-1.8.3.min.js',
	),
	'css' => array(		
		// FRAMEWORK_URL.'framework/css/smoothness/jquery-ui-1.8.23.custom.css',
		FRAMEWORK_URL.'extensions/sync-tool/css/style.css',
	),
);
global $sync_tool_admin, $sync_tool;

include 'object.php';
$sync_tool = new Sync_Tool_Object( $settings );

// Load admin components
if ( is_admin() ) {	
	include 'settings-object.php';
	$sync_tool_admin = new Sync_Tool_Admin_Object( $settings );
}

?>

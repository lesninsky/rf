<?php
/*
	Extension Name: Admin Menu Editor
	Extension URI:
	Version: 0.8
	Description: Manage your admin menus. Edit the WordPress admin, organize existing menus, create custom theme menus. The settings are exported with your theme allowing you to modify the appearance of your theme admin..
	Author: Parallelus
	Author URI: http://para.llel.us
	Text Domain:
	Domain Path:
	Network:
	Site Wide Only:
*/

// Reset
if ( 0 ) update_option( 'admin_dashboard', array() );

// Settings

$fields = array(
	'var' => array( 'menu_url', 'menu_name', 'page_name', 'menu_permissions', 'slug', 'function' ),
	'array' => array()
);

$default = array();

$settings = array(
	'name' => 'Admin Menu',
	'option_key' => $shortname.'admin-menu-editor',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'framework-options',
	//'menu_permissions' => 5,
	'file' => __FILE__,
	'js' => array(
		FRAMEWORK_URL.'extensions/admin-menu-editor/js/menu-nav.custom.dev.js',
		FRAMEWORK_URL.'framework/js/jquery.tmpl.min.js',
		'jquery',
		'utils',
		'jquery-ui-core',
		'jquery-ui-widget',
		'jquery-ui-mouse',
		'jquery-ui-sortable',
		'jquery-ui-draggable',
		'jquery-ui-dialog',
		'jquery-ui-position',
	),
	'css' => array(
		FRAMEWORK_URL.'framework/css/smoothness/jquery-ui-1.8.23.custom.css',
		FRAMEWORK_URL.'extensions/admin-menu-editor/css/style.css',
	)
);
global $admin_Dashboard_Admin, $admin_dashboard_settings, $extm;

// Required components
include $extm->extensions_dir.'admin-menu-editor/object.php';

$admin_dashboard_settings = new Admin_Dashboard_Settings_Object( $settings );
// Load admin components
if ( is_admin() ) {
	include $extm->extensions_dir.'admin-menu-editor/settings-object.php';
	$admin_Dashboard_Admin = new Admin_Dashboard_Admin_Object( $settings );
}

?>

<?php
/*	Extension Name: Custom Branding
	Extension URI:
	Version: 0.7.1
	Description:  Custom Branding - This extension will allow a user to change the branding of the admin to their own logo or name.
	Author: Parallelus
	Author URI: http://para.llel.us
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
	'name' => __('Custom Branding', 'framework'),
	'option_key' => $shortname.'custom-branding',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'settings',
	'menu_permissions' => 'administrator',
	'file' => __FILE__,
	'js' => array(
		FRAMEWORK_URL.'framework/js/jquery.tmpl.min.js',
		FRAMEWORK_URL.'extensions/custom-branding/js/nav-menu.js',
		FRAMEWORK_URL.'extensions/custom-branding/js/login-register-branding.js',
		FRAMEWORK_URL.'extensions/custom-branding/js/admin-bar-branding.js',
		FRAMEWORK_URL.'extensions/custom-branding/js/other-branding.js',		
		'jquery',
		'utils',
		'jquery-ui-core',
		'jquery-ui-widget',
		'jquery-ui-mouse',
		'jquery-ui-sortable',
		'jquery-ui-draggable',
		'jquery-ui-dialog',
		'jquery-ui-position'
	),
	'css' => array(
		FRAMEWORK_URL.'extensions/custom-branding/css/style.css',
//		FRAMEWORK_URL.'framework/js/farbtastic/farbtastic.css',
//		FRAMEWORK_URL.'framework/css/smoothness/jquery-ui-1.8.23.custom.css',
	),
);
global $custom_branding_settings, $admin_custom_branding, $extm;

$handle = opendir(get_template_directory() . '/data-types');
include_once(get_template_directory() . '/data-types/data-type.php');
while ( false !== ($entry = readdir($handle))) {
	if($entry != '.' && $entry != '..' && $entry != 'data-type.php'){
		include_once(get_template_directory() . '/data-types/'.$entry);
	}		
}
// include $extm->extensions_dir.'custom-branding/data-types-extends.php';
// Required components
include $extm->extensions_dir.'custom-branding/object.php';

$custom_branding_settings = new Custom_Branding_Settings_Object( $settings );

// Load admin components
if ( is_admin() ) {
	include $extm->extensions_dir.'custom-branding/settings-object.php';
	$admin_custom_branding = new Custom_Branding_Admin_Object( $settings );
}

?>

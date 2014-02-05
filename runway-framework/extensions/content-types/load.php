<?php
/*
    Extension Name: Content types
    Extension URI:
    Version: 0.8.1
    Description: Content types
    Author:
    Author URI:
    Text Domain:
    Domain Path:
    Network:
    Site Wide Only:
*/

// Reset
if (0) update_option('content_types', array());

// Settings
$fields = array(
		'var' => array(),
		'array' => array()
);
$default = array();

$settings = array(
	'name' => 'Content Types', 
	'option_key' => $shortname.'content_types',
	'fields' => $fields,
	'default' => $default,
	'parent_menu' => 'framework-options',
	//'menu_permissions' => 5,
	'file' => __FILE__,
	'js' => array(
		'jquery',
		'jquery-ui-core',
		'jquery-ui-dialog',
		'wp-color-picker',
		'formsbuilder',
		FRAMEWORK_URL.'framework/js/jquery.tmpl.min.js',
		FRAMEWORK_URL.'extensions/content-types/js/fields.js',
	),
	'css' => array(
		'formsbuilder-style',
	)
);

// Required components
include('object.php');
global $content_types_settings, $content_types_admin;
$content_types_settings = new Content_Types_Settings_Object($settings);

// Load admin components
if (is_admin()) {	
	include('settings-object.php');
	$content_types_admin = new Content_Types_Admin_Object($settings);
}

function title_buttons_add_new( $title ) {
	$page = (isset($_GET['page'])) ? $_GET['page'] : 'content-types';
	$navigation = (isset($_GET['navigation'])) ? $_GET['navigation'] : '';

	if( $page == 'content-types'&& $navigation == 'taxonomies' ){
		$title .= ' <a href="?page=content-types&navigation=add-taxonomy" class="add-new-h2">'. __( 'Add New Taxonomy', FRAMEWORK_TEXT ) .'</a>';		
	}
	elseif( $page == 'content-types'&& $navigation == 'fields' ){
		$title .= ' <a href="?page=content-types&navigation=add-field" class="add-new-h2">'. __( 'Add New Field', FRAMEWORK_TEXT ) .'</a>';				
	}

	elseif ($page == 'content-types' && ($navigation == 'add-inputs' || $navigation == 'delete-input')) {
		$title .= ' <a href="?page=content-types&navigation=add-input-field&alias='.$_REQUEST['alias'].'" class="add-new-h2">'. __( 'Add New Input', FRAMEWORK_TEXT ) .'</a>';
	}
	elseif ( $page == 'content-types' && $navigation == '') {
		$title .= ' <a href="?page=content-types&navigation=add-post-type" class="add-new-h2">'. __( 'Add New Content Type', FRAMEWORK_TEXT ) .'</a>';
	}
	
	return $title;
}
add_filter( 'framework_admin_title', 'title_buttons_add_new' );
?>

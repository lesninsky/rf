<?php 
/*
	Extension Name: Sidebar Polls
	Version: 0.9
	Description: Polls, an example of making a custom Runway extension.
	Author: Parallelus
	Author URI: http://para.llel.us  
*/

$settings = array(
	'name' => 'Sidebar Polls',                   // The extension name
	'option_key' => $shortname.'sidebar_polls',  // The key, a unique database ID 
	'parent_menu' => 'settings',                 // Extension parent menu
	'file' => __FILE__,                          // The path to the load.php file
);

// Required components
include('object.php');
$poll_object = new Poll_Object($settings);


// Load admin components
if (is_admin()) {   
	include('settings-object.php');
	$poll_admin_object = new Poll_Admin_Object($settings);
}

?>
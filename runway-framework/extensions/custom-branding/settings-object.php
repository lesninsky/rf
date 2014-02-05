<?php

class Custom_Branding_Admin_Object extends Runway_Admin_Object {

	public $admin_bar_use_default, $custom_branding_options, $ext_path;
	public $dashboard_body, $option_key;

	function __construct($settings) {
		parent::__construct($settings);

		$this->option_key = $settings['option_key'];
		$this->ext_path = FRAMEWORK_DIR.'extensions/custom-branding/';
		$this->custom_branding_options = get_option( $this->option_key );
		if ( empty( $this->custom_branding_options ) ) {
			$this->custom_branding_options['use_default'] = true;
		}		
		// Register actions
		add_action( 'wp_before_admin_bar_render', array( $this, 'admin_bar_init' ) );
		add_action( 'wp_before_admin_bar_render', array( $this, 'admin_bar_render' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'login_style' ) );
		add_action( 'register_form', array( $this, 'register_form_custom_fields' ) );
		add_filter( 'registration_errors', array( $this, 'registration_errors_custom_fields' ) );
		add_action( 'user_register', array( $this, 'register_user_custom_fields' ) );
		add_action( 'show_user_profile', array( $this, 'custom_fields_in_profile' ));
		add_action( 'edit_user_profile', array( $this, 'custom_fields_in_profile' ));
		// add_action( 'personal_options_update', array( $this, 'save_custom_user_profile_fields' ));
		// add_action( 'edit_user_profile_update', array( $this, 'save_custom_user_profile_fields' ));
		add_filter( 'admin_footer_text', array( $this, 'custom_footer_admin'));

		// Register Ajax actions
		add_action( 'wp_ajax_add_adminbar_item', array( $this, 'admin_bar_add_item' ) );
		add_action( 'wp_ajax_adminbar_use_default', array( $this, 'admin_bar_use_default_state' ) );
		add_action( 'wp_ajax_adminbar_del_item', array( $this, 'admin_bar_del_item' ) );
		add_action( 'wp_ajax_set_login_page_logo_settings', array( $this, 'set_login_page_logo_settings' ) );
		add_action( 'wp_ajax_add_reset_register_fields', array( $this, 'add_reset_register_fields' ) );
		// add_action( 'wp_ajax_add_custom_register_field', array( $this, 'update_custom_register_field' ) );
		// add_action( 'wp_ajax_remove_custom_register_field', array( $this, 'remove_custom_register_field' ) );		
		// add_action( 'wp_ajax_get_custom_field', array( $this, 'get_custom_field' ) );		
		add_action( 'wp_ajax_get_admin_bar_items', array( $this, 'get_admin_bar_items' ) );	
		add_action( 'wp_ajax_update_admin_bar_menu', array( $this, 'update_admin_bar_menu' ) );		
		add_action( 'wp_ajax_set_new_footer', array( $this, 'set_new_footer' ) );		
	}	

	function set_new_footer(){
		$footer = $_POST['footer'];		
		$this->custom_branding_options['footer'] = stripslashes( $footer );
		update_option( $this->option_key, $this->custom_branding_options );		
		die();
	}	

	// Custom WordPress Footer
	function custom_footer_admin () {
		if(!empty($this->custom_branding_options['footer']))
			echo $this->custom_branding_options['footer'];
	}	

	function update_admin_bar_menu(){
		$items = $_POST['admin_bar'];
		$this->custom_branding_options['items'] = $items;
		update_option( $this->option_key, $this->custom_branding_options );
		out($items);
		die();
	}

	function get_admin_bar_items(){
		echo json_encode( stripslashes_deep($this->custom_branding_options['items']) );
		die();
	}

	function get_custom_field(){
		$slug = $_POST['slug'];
		$this->custom_branding_options['custom-reg-fields'][$slug]['slug'] = $slug;
		echo json_encode($this->custom_branding_options['custom-reg-fields'][$slug]);
		die();
	}

	function save_custom_user_profile_fields($user_id){
		foreach ($this->custom_branding_options['custom-reg-fields'] as $key => $value) {
			update_user_meta($user_id, $key, $_POST[$key]);
		}
	}

	function custom_fields_in_profile($user){
		if(!empty($this->custom_branding_options['fields'])){
			foreach ($this->custom_branding_options['fields'] as $field_data) {
				$class_name = ucfirst(str_replace('-', '_', $field_data['type'])).'_usermeta';
				$field_object = new $class_name('custom-branding', (object)$field_data);
				$field_object->render_content();
				out($class_name);
			}
		}
	}

	function remove_custom_register_field(){
		// TODO: remove custom field from register page
		die();
	}

	function update_custom_register_field($field = array()) {
		if(!empty($field)){
			$this->custom_branding_options['fields'][$field['alias']] = $field;
			update_option($this->option_key, $this->custom_branding_options);
		}
	}

	function add_reset_register_fields() {
		$field = $_POST['field'];
		$add = $_POST['add'];
		$reset = $_POST['reset'];
		if ( $add == true ) {
			$this->custom_branding_options['default-profile-fields'][] = $field;
			array_unique( $this->custom_branding_options['default-profile-fields'] );
			update_option( $this->option_key, $this->custom_branding_options );
		}
		elseif ( $reset == true ) {
			foreach ( $this->custom_branding_options['default-profile-fields'] as $key => $value ) {
				if ( $this->custom_branding_options['default-profile-fields'][$key] == $field ) {
					unset( $this->custom_branding_options['default-profile-fields'][$key] );
					update_option( $this->option_key, $this->custom_branding_options );
				}
			}
		}
		out($this->custom_branding_options);
		die();
	}

	function registration_errors_custom_fields( $errors ) {
		extract( $_POST );
		if ( isset( $first_name ) && $first_name == '' ) {
			$errors->add( 'first_name', __( '<b>ERROR:</b> Incorect field First Name' ) );
		}

		if ( isset( $last_name ) && $last_name == '' ) {
			$errors->add( 'last_name', __( '<b>ERROR:</b> Incorect field Last Name' ) );
		}

		if ( isset( $website ) && $website == '' ) {
			$errors->add( 'website', __( '<b>ERROR:</b> Incorect field Website' ) );
		}

		if ( isset( $aim ) && $aim == '' ) {
			$errors->add( 'aim', __( '<b>ERROR:</b> Incorect field AIM' ) );
		}

		if ( isset( $yahoo ) && $yahoo == '' ) {
			$errors->add( 'yahoo', __( '<b>ERROR:</b> Incorect field Yahoo IM' ) );
		}

		if ( isset( $jabber ) && $jabber == '' ) {
			$errors->add( 'jabber', __( '<b>ERROR:</b> Incorect field Jabber / Google Talk' ) );
		}

		// TODO: Add error messages on custom fields

		return $errors;
	}

	function register_user_custom_fields( $user_id ) {
		extract( $_POST );
		$user_data['ID'] = $user_id;

		if ( isset( $first_name ) && $first_name != '' ) {
			$user_data['first_name'] = $first_name;
		}

		if ( isset( $last_name ) && $last_name != '' ) {
			$user_data['last_name'] = $last_name;
		}

		if ( isset( $website ) && $website != '' ) {
			$user_data['user_url'] = $website;
		}

		if ( isset( $aim ) && $aim != '' ) {
			$user_data['aim'] = $aim;
		}

		if ( isset( $yahoo ) && $yahoo != '' ) {
			$user_data['yim'] = $yahoo;
		}

		if ( isset( $jabber ) && $jabber != '' ) {
			$user_data['jabber'] = $jabber;
		}
		wp_update_user( $user_data );

		// TODO: Set values to custom register fields
		// foreach ($this->custom_branding_options['custom-reg-fields'] as $key => $value) {			
		// 	update_user_meta($user_id, $key, $_POST[$key]);
		// }		
	}

	function register_form_custom_fields() {
		foreach ( $this->custom_branding_options['default-profile-fields'] as $key => $value ) {
			include_once $this->ext_path.'fiedls-tpls/default-profile-fields/'.$value.'.php';
		}

		// TODO: include custom register fields in register form
		// foreach ($this->custom_branding_options['custom-reg-fields'] as $key => $value) {
		// 	include $this->ext_path.'css/fields-css.php';
		// 	include $this->ext_path.'fiedls-tpls/custom-fields/'.$value['field-type'].'.php';
		// }
	}

	function set_login_page_logo_settings() {
		$this->custom_branding_options['logo_styles'] = array(
			'background_url' => $_POST['logo_url'],
			'background_size_h' => $_POST['backg_h'],
			'background_size_w' => $_POST['backg_w'],
			'background_position' => $_POST['backg_pos'],
			'logo_h' => $_POST['logo_h'],
			'logo_w' => $_POST['logo_w'],
		);

		update_option( $this->option_key, $this->custom_branding_options );

		die();
	}

	// Use your own external URL logo link
	function login_style() {
		if( isset( $this->custom_branding_options['logo_styles'] ) ) {
			extract( (array)$this->custom_branding_options['logo_styles'] );
			$background_size_h .= 'px';
			$background_size_w .= 'px';
			$logo_h .= 'px';
			$logo_w .= 'px';
		}

		echo '<style type="text/css" media="screen">';
		echo "#login h1 a{
			background-image:url($background_url);
			background-size: $background_size_w $background_size_h;
			background-position: $background_position;
			width: $logo_w;
			height: $logo_h;
		}";
		echo '</style>';
	}

	function admin_bar_init() {
		global $wp_admin_bar;
		if ( !empty( $this->custom_branding_options['default_admin_bar'] ) ) {
			$admin_bar_default = $wp_admin_bar->get_nodes();
			foreach ( $admin_bar_default as $key => $value ) {
				$admin_bar_default[$key] = (array)$admin_bar_default[$key];
				$admin_bar_default[$key]['default'] = true;
			}
			$this->custom_branding_options['default_admin_bar'] = $admin_bar_default;
			update_option( $this->option_key, $this->custom_branding_options );
		}
	}

	function admin_bar_del_item() {
		$item_id = $_POST['item_id'];
		foreach ( $this->custom_branding_options['items'] as $key => $value ) {
			if ( $value['id'] == $item_id ) {
				unset( $this->custom_branding_options['items'][$key] );
			}
			if ( $value['parent'] == $item_id ) {
				unset( $this->custom_branding_options['items'][$key] );
			}
		}
		update_option( $this->option_key, $this->custom_branding_options );
		die();
	}

	function admin_bar_use_default_state() {
		global $wp_admin_bar;
		$state = $_POST['use_default'];
		if ( $state == 0 ) {
			$this->custom_branding_options['use_default'] = false;
		}
		elseif ( $state == 1 ) {
			$this->custom_branding_options['use_default'] = true;
		}
		update_option( $this->option_key, $this->custom_branding_options );
		die();
	}

	function admin_bar_add_item() {
		global $wp_admin_bar;

		$title = $_POST['title'];
		$href = $_POST['href'];
		$icon = $_POST['icon_url'];
		$icon_h = $_POST['icon_h'];
		$icon_w = $_POST['icon_w'];
		$item_id = $_POST['id'];
		$parent_item = $_POST['parent'];
		
		$edit_id = '';

		foreach ($this->custom_branding_options['items'] as $id => $item) {
			if(trim($item['id']) == trim($item_id)){
				$edit_id = $id;
			}
		}		

		if($edit_id !== ''){
			$this->custom_branding_options['items'][$edit_id] = array(
				'icon' => $icon,
				'icon_h' => $icon_h,
				'icon_w' => $icon_w,
				'parent' => $parent_item,
				'id' => $item_id,
				'title' => __( $title ),
				'href' => $href,
			);
		}
		else{
			$this->custom_branding_options['items'][] = array(
				'icon' => $icon,
				'icon_h' => $icon_h,
				'icon_w' => $icon_w,
				'parent' => $parent_item,
				'id' => $item_id,
				'title' => __( $title ),
				'href' => $href,
			);	
		}
		update_option( $this->option_key, $this->custom_branding_options );
		die();
	}

	function admin_bar_render() {
		global $wp_admin_bar;
		if ( $this->custom_branding_options['use_default'] != 1 ) {
			$this->hide_default_admin_bar_items();
		}
		if ( !empty( $this->custom_branding_options['items'] ) ) {
			$this->custom_branding_options['items'] = stripslashes_deep( $this->custom_branding_options['items'] );
			foreach ( $this->custom_branding_options['items'] as $key => $value ) {
				// render admin bar from custom branding options array
				if ( isset($value['icon']) && $value['icon'] != '' ) {
					$value['title'] = '<img src ="'.$value['icon'].'" style = "width:'.$value['icon_w'].'px; height:'.$value['icon_h'].'px;" />'.$value['title'];
				}
				$wp_admin_bar->add_menu( $value );
			}
		}
		else {
			$wp_admin_bar->add_menu (
				array (
					'parent' => '',
					'id' => 'new_media',
					'title' => __( 'Edit admin bar' ),
					'href' => admin_url( 'options-general.php?page=custom-branding' ),
				)
			);
		}
	}

	function hide_default_admin_bar_items() {
		global $wp_admin_bar;
		foreach ( $wp_admin_bar->get_nodes() as $key => $value ) {
			$wp_admin_bar->remove_menu( $key );
		}
	}

	// Add hooks & crooks
	function add_actions() {
		add_action( 'init', array( $this, 'init' ) );		
	}	

	function init() {

		if ( isset( $_REQUEST['navigation'] ) && !empty( $_REQUEST['navigation'] ) ) {
			global $admin_custom_branding;
			$admin_custom_branding->navigation = $_REQUEST['navigation'];
		}
	}

	function after_settings_init() {
		/* nothing */
	}

	function validate_sumbission() {        
					
		return true;
		
	}
	
	function load_objects() {
		
	}

}
?>
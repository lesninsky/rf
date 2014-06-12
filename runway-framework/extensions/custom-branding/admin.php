<div class="nav-tabs">
	<h2 class="nav-tab-wrapper tab-controlls" style="padding-top: 9px;">	
		<a href="<?php echo $this->self_url(); ?>" class="nav-tab <?php if($this->navigation == '') {echo "nav-tab-active";} ?>"><?php echo __('Admin Bar', 'framework'); ?></a>
		<a href="<?php echo $this->self_url('login-register'); ?>" class="nav-tab <?php if($this->navigation == 'login-register') {echo "nav-tab-active";} ?>"><?php echo __('Login/Register', 'framework'); ?></a>
		<a href="<?php echo $this->self_url('footer'); ?>" class="nav-tab <?php if($this->navigation == 'footer') {echo "nav-tab-active";} ?>"><?php echo __('Footer', 'framework'); ?></a>
	</h2>
</div>

<div class="tab-layout">

<?php
global $custom_branding_settings, $admin_custom_branding, $extm;
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if($action != ''){
	switch ($action) {
		case 'add_new_custom_field':{
			$type = $_POST['field-type-select'];
			$title = $_POST['title'];
			$titleCaption = $_POST['titleCaption'];
			$alias = $_POST['alias'];

			unset($_POST['title']);
			unset($_POST['titleCaption']);
			unset($_POST['alias']);
			unset($_POST['field-type-select']);
			$new_field = array(
				'type' => $type,
				'title' => rf__($title),
				'titleCaption' => rf__($titleCaption),
				'alias' => $alias,
				'data' => $_POST
			);

			$admin_custom_branding->update_custom_register_field($new_field);

		} break;		
	}
}

switch ( $admin_custom_branding->navigation ) {
	case 'login-register':{
		$data_types = array();
		$handle = opendir(get_template_directory() . '/data-types');
		include_once(get_template_directory() . '/data-types/data-type.php');
		while ( false !== ($entry = readdir($handle))) {
			if($entry != '.' && $entry != '..' && $entry != 'data-type.php'){
				include_once(get_template_directory() . '/data-types/' . $entry);
				$tmp = explode('.', $entry);
				$tmp = $tmp[0];
				$tmp = str_replace('-', '_', $tmp);
				$data_types[] = ucfirst($tmp);			
			}		
		}


		foreach ($data_types as $data_type_class) {
			$data_type_object = new $data_type_class($_REQUEST['page'], null);
			$data_type_object->render_settings();
		}

		$background_url = isset($admin_custom_branding->custom_branding_options['logo_styles']['background_url']) ? 
			$admin_custom_branding->custom_branding_options['logo_styles']['background_url'] : '';
		$background_size_w = isset($admin_custom_branding->custom_branding_options['logo_styles']['background_size_w']) ?
			$admin_custom_branding->custom_branding_options['logo_styles']['background_size_w'] : '';
		$background_size_h = isset($admin_custom_branding->custom_branding_options['logo_styles']['background_size_h']) ?
			$admin_custom_branding->custom_branding_options['logo_styles']['background_size_h'] : '';
		$background_position = isset($admin_custom_branding->custom_branding_options['logo_styles']['background_position']) ?
			$admin_custom_branding->custom_branding_options['logo_styles']['background_position'] : '';
		$logo_w = isset($admin_custom_branding->custom_branding_options['logo_styles']['logo_w']) ?
			$admin_custom_branding->custom_branding_options['logo_styles']['logo_w'] : '';
		$logo_h = isset($admin_custom_branding->custom_branding_options['logo_styles']['logo_h']) ? 
			$admin_custom_branding->custom_branding_options['logo_styles']['logo_h'] : '';

		if( isset( $admin_custom_branding->custom_branding_options['fields'] ) )
			$fields = $admin_custom_branding->custom_branding_options['fields'];

		include_once 'views/login-register-branding.php';
	} break;

	case 'footer':{
		include_once 'views/other-branding.php';
	} break;

	default:{
		include_once 'views/admin-bar-branding.php';
	} break;
}
?>
</div>
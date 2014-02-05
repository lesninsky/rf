
<?php

class Theme_Updater_Admin_Object extends Runway_Admin_Object {

	public $theme_update_notise;

	public function __construct($settings) {

		parent::__construct($settings);

		// register the custom stylesheet header
		add_filter('upgrader_source_selection', array( $this, 'upgrader_source_selection_filter'), 10, 3);
		add_action('http_request_args', array( $this, 'no_ssl_http_request_args' ), 10, 2);
		add_action( 'admin_init', array ( $this, 'theme_upgrader_stylesheet' ) );
		add_filter('site_transient_update_themes', array( $this, 'transient_update_themes_filter') );

		add_action( 'admin_notices', array( $this, 'show_theme_update_notise' ) );
	}

	function show_theme_update_notise() {
		if( $this->theme_update_notise )
			echo '<div class="updated"><p>'.$this->theme_update_notise.'</p></div>';
	}

 	function transient_update_themes_filter($data) {
		global $wp_version;

		if(function_exists('wp_get_themes')) $installed_themes = wp_get_themes( );
		else $installed_themes = wp_get_themes( );
	 	foreach ( (array) $installed_themes as $theme_title => $_theme ) {
			
			// Get theme headers : 
			$stylecss = ABSPATH . 'wp-content/themes/'.$_theme->stylesheet.'/style.css';

			if(file_exists($stylecss) ) {
				$theme_info = file_get_contents( $stylecss );

				$start = strpos( $theme_info, 'Github Theme URI' );

				$gtu = '';
				if($start > 0) {
					$end = strpos( $theme_info, PHP_EOL, $start );
					$gtu = substr($theme_info, $start, $end - $start);
				}
			}

			// If Github Theme URI is not defined
			if( empty( $gtu ) ) {
				continue;
			}else {
				$theme = array(
					'Github Theme URI' => $gtu,
					'Stylesheet'       => $_theme->stylesheet,
					'Version'          => $_theme->version
				);
			}

			$theme_key = $theme['Stylesheet'];
		
			// Add Github Theme Updater to return $data and hook into admin
			remove_action( "after_theme_row_" . $theme['Stylesheet'], array( $this, 'wp_theme_update_row') );
			add_action( "after_theme_row_" . $theme['Stylesheet'], array($this, 'github_theme_update_row', 11, 2 ) );

			// Grab Github Tags
			preg_match(
				'/http(s)?:\/\/github.com\/(?<username>[\w-]+)\/(?<repo>[\w-]+)$/',
				$theme['Github Theme URI'],
				$matches);
			if(!isset($matches['username']) or !isset($matches['repo'])){

				$data->response[$theme_key]['error'] = 'Incorrect github project url.  Format should be (no trailing slash): <code style="background:#FFFBE4;">https://github.com/&lt;username&gt;/&lt;repo&gt;</code>';
				$this->theme_update_notise = 'Incorrect github project url.  Format should be (no trailing slash): <code style="background:#FFFBE4;">https://github.com/&lt;username&gt;/&lt;repo&gt;</code>';
				continue;
			}
			//$url = sprintf('https://api.github.com/repos/%s/%s/tags', urlencode($matches['username']), urlencode($matches['repo']));
			$url = sprintf('https://api.github.com/repos/%s/%s/tags', urlencode($matches['username']), urlencode($matches['repo']));
			$response = get_transient(md5($url)); // Note: WP transients fail if key is long than 45 characters

			if(empty($response)){
				//$raw_response = wp_remote_get($url.'?client_id=32f8d23c218dc0f96e03&client_secret=f5d8b08a732576490b10733aed874941e5c356da', array('sslverify' => false, 'timeout' => 10));
				$raw_response = wp_remote_get($url.'?client_id=b8abf38417bea7b6a2ee&client_secret=d697637ba79e1b055dadd4f5dd404fe147e85add', array('sslverify' => false, 'timeout' => 10));
out($raw_response);
				if ( is_wp_error( $raw_response ) ){
					$data->response[$theme_key]['error'] = "Error response from " . $url;
					$this->theme_update_notise = "Error response from " . $url;
					continue;
				}
				$response = json_decode($raw_response['body']);
out($response);
				if(isset($response->message)){
					if(is_array($response->message)){
						$errors = '';
						foreach ( $response->message as $error) {
							$errors .= ' ' . $error;
						}
					} else {
						$errors = print_r($response->message, true);
					}
					$data->response[$theme_key]['error'] = sprintf('While <a href="%s">fetching tags</a> api error</a>: <span class="error">%s</span>', $url, $errors);
					$this->theme_update_notise = sprintf('While <a href="%s">fetching tags</a> api error</a>: <span class="error">%s</span>', $url, $errors);
					continue;
				}
				
				if(count($response) == 0){
					$data->response[$theme_key]['error'] = "Github theme does not have any tags";
					$this->theme_update_notise = "Github theme does not have any tags";
					continue;
				}
				
				//set cache, just 60 seconds
				set_transient(md5($url), $response, 30);
			}
			
			// Sort and get latest tag
			$tags = array_map(create_function('$t', 'return $t->name;'), $response);
			usort($tags, "version_compare");
			
			
			// check for rollback
			if(isset($_GET['rollback'])){
				$data->response[$theme_key]['package'] = 
					$theme['Github Theme URI'] . '/zipball/' . urlencode($_GET['rollback']);
				continue;
			}
			
			
			// check and generate download link
			$newest_tag = array_pop($tags);
			if(version_compare($theme['Version'],  $newest_tag, '>=')){
				// up-to-date!
				$data->up_to_date[$theme_key]['rollback'] = $tags;
				continue;
			}
			
			
			// new update available, add to $data
			$download_link = $theme['Github Theme URI'] . '/zipball/' . $newest_tag;
			$update = array();
			$update['new_version'] = $newest_tag;
			$update['url']         = $theme['Github Theme URI'];
			$update['package']     = $download_link;
			$data->response[$theme_key] = $update;
			
		}	
		
	 	return $data;
	}


	function upgrader_source_selection_filter($source, $remote_source=NULL, $upgrader=NULL) {
		/*
			Github delivers zip files as <Username>-<TagName>-<Hash>.zip
			must rename this zip file to the accurate theme folder
		*/
		$upgrader->skin->feedback("Executing upgrader_source_selection_filter function...");
		if(isset($upgrader->skin->theme)) 
			$correct_theme_name = $upgrader->skin->theme;
		elseif(isset($upgrader->skin->theme_info->stylesheet))
			$correct_theme_name = $upgrader->skin->theme_info->stylesheet;
		elseif(isset($upgrader->skin->theme_info->template))
			$correct_theme_name = $upgrader->skin->theme_info->template;
		else 
			$upgrader->skin->feedback('Theme name not found. Unable to rename downloaded theme.');
				
		if(isset($source, $remote_source, $correct_theme_name)){				
			$corrected_source = $remote_source . '/' . $correct_theme_name . '/';
			if(@rename($source, $corrected_source)){
				$upgrader->skin->feedback("Renamed theme folder successfully.");
				return $corrected_source;
			} else {
				$upgrader->skin->feedback("**Unable to rename downloaded theme.");
				return new WP_Error();
			}
		}
		else
			$upgrader->skin->feedback('**Source or Remote Source is unavailable.');
			
		return $source;
	}

	/*
	   Function to address the issue that users in a standalone WordPress installation
	   were receiving SSL errors and were unable to install themes.
	   https://github.com/UCF/Theme-Updater/issues/3
	*/

	function no_ssl_http_request_args($args, $url) {
		$args['sslverify'] = false;
		return $args;
	}

	function theme_upgrader_stylesheet() {
		//$style_url  = WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/admin-style.css';
		$style_url  = '/css/admin-style.css';
		wp_register_style('theme_updater_style', $style_url);
		wp_enqueue_style( 'theme_updater_style');
	}

}
?>

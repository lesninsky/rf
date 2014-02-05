<?php

// Poll admin object (loaded on admin only)
class Poll_Admin_Object extends Runway_Admin_Object{

	// Add actions
	function add_actions() {
		// Init action
		add_action( 'init', array( $this, 'init' ) );
	}

	function init() {

		// Get the saved poll data
		$this->poll_list = get_option( $this->option_key );

		// Get the navigation parameter
		if ( isset( $_REQUEST['navigation'] ) && !empty( $_REQUEST['navigation'] ) ) {
			$this->navigation = $_REQUEST['navigation'];
		}

		// Get the action parameter
		if ( isset( $_REQUEST['action'] ) && !empty( $_REQUEST['action'] ) ) {
			$this->action = $_REQUEST['action'];
		}

	}

	// Update poll data
	public function update_poll( $options = array() ) {

		if ( !empty( $options ) ) {
			$this->poll_list[$options['alias']] = $options;
			update_option( $this->option_key, $this->poll_list );
		}
	}

	// Delete poll
	public function delete_poll( $alias = null ) {
		if ( $alias != null && isset( $this->poll_list[$alias] ) ) {
			unset( $this->poll_list[$alias] );
			update_option( $this->option_key, $this->poll_list );
		}
	}

}


// "Add New" button in admin page title
function poll_title_buttons_add_new( $title ) {
	$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : '';
	$navigation = ( isset( $_GET['navigation'] ) ) ? $_GET['navigation'] : '';
	$add_new    = 'add_poll';

	if ( $page == 'widget-polls'  && $navigation != $add_new) {
		$title .= ' <a href="?page='.$page.'&navigation='.$add_new.'" class="add-new-h2">'. __( 'Add New', 'framework' ) .'</a>';
	}

	return $title;
}
add_filter( 'framework_admin_title', 'poll_title_buttons_add_new' );

?>
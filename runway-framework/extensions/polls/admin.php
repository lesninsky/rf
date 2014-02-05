<?php

// Get some variables
$poll_name     = ( isset( $_REQUEST['name'] ) && !empty( $_REQUEST['name'] ) ) ? $_REQUEST['name'] : '';
$alias         = ( isset( $_REQUEST['alias'] ) && !empty( $_REQUEST['alias'] ) ) ? $_REQUEST['alias'] : sanitize_title( $poll_name );
$poll_variants = ( isset( $_REQUEST['variants'] ) && !empty( $_REQUEST['variants'] ) ) ? $_REQUEST['variants'] : '';
$poll_answers  = ( isset( $this->poll_list[$alias]['answers'] ) ) ? $this->poll_list[$alias]['answers'] : array();
$options       = ( isset( $_POST ) ) ? $_POST : array();

// Additional actions of our extension
switch ( $this->action ) {
	case 'update_poll':
		if ( !empty( $poll_name ) && !empty( $poll_variants ) ) {

			$options['alias'] = $alias;
			$answers = $poll_answers;
			
			foreach ( $options['variants'] as $key => $value ) {
				if ( !isset( $answers[$key] ) ) {
					$answers[$key] = 0;
				}
			}

			$options['answers'] = $answers;
			$this->update_poll( $options );
		}
		break;

	default:
		// nothing to do
	break;
}

// Managing of extension's navigation
switch ( $this->navigation ) {
	case 'add_poll':
		include 'views/poll-form.php';
		break;

	case 'edit_poll':
		include 'views/poll-form.php';
		break;

	case 'delete_poll':
		$this->delete_poll( $alias );
		include 'views/admin-home.php';
		break;

	case 'show_results':
		include 'views/show-results.php';
		break;

	default:
		include 'views/admin-home.php';
		break;
}

?>
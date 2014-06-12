<?php

// Poll object (loaded on admin and public)
class Poll_Object extends Runway_Object{

	public $poll_list, $option_key;

	public function __construct( $settings ) {
		parent::__construct( $settings );

		$this->option_key = $settings['option_key'];
		$this->poll_list = get_option( $this->option_key );

		add_action( 'widgets_init', array( $this, 'poll_widget_register' ) ); // function to load my widget
	}

	// Vote function
	public function vote( $poll = null, $vote = null ) {
		if ( $poll != null && $vote != null ) {
			$this->poll_list[$poll]['answers'][$vote]++;
			update_option( $this->option_key, $this->poll_list );
		}
	}

	// Register poll widget
	public function poll_widget_register() {
		register_widget( 'Poll_Widget' );
	}

}


// Poll widget
class Poll_Widget extends WP_Widget {

	function __construct() {

		// Widget setup
		$widget_ops = array( 'classname' => 'poll-widget', 'description' => __('Description to my poll widget', 'framework') );
		$this->WP_Widget( 'poll', __('Poll Widget', 'framework'), $widget_ops );

		// Handle the voting
		add_action( 'init', array( $this, 'user_poll' ) );
	}

	function user_poll() {
		global $poll_object, $just_voted;
		$just_voted = false;
		if ( isset( $_POST['poll_result'] ) && isset( $_POST['widget_alias'] ) ) {
			if ( !isset( $_COOKIE[$_POST['widget_alias']] ) ) {
				$poll_object->vote( $_POST['widget_alias'], $_POST['poll_result'] );
				setcookie( $_POST['widget_alias'], 1, time()+1209600 );
				$just_voted = $_POST['widget_alias'];
			}
		}
	}

	function widget( $args, $instance ) {
		global $poll_object, $just_voted;

		$poll =  ( isset( $instance['poll'] ) ) ? esc_attr( $instance['poll'] ) : 'none';
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		echo $before_title;
		echo ( $poll != 'none' ) ? $poll_object->poll_list[$poll]['name'] : __( 'Poll', 'framework' );
		echo $after_title;

		if ( !isset( $_COOKIE[$poll] ) && $just_voted != $poll ) {
			?>
			<form action="http://<?php echo  $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>" method="post">
				<?php

				if ( $poll != 'none' ) {
					foreach ( $poll_object->poll_list[$poll]['variants'] as $key => $value ): ?>
						<div>
							<label for="variant-<?php echo $key; ?>">
								<input type="radio" name="poll_result" id="variant-<?php echo $key; ?>" value="<?php echo $key; ?>">
								<?php echo $value; ?>
							</label>
						</div><br>
						<?php 
					endforeach; ?>
					
					<input type="hidden" name="widget_alias" value="<?php echo $poll; ?>">
					<?php
				} else {
					_e( 'Please, select a poll in widget settings.', 'framework' );
				}
				?>
				<input type="submit" value="<?php _e( 'Vote', 'framework' ); ?>">
			</form>
			<?php
		} else {
			if ( count( $poll_object->poll_list[$poll]['variants'] ) > 1 ) {
				echo "<ul style='list-style: none;'>";
				foreach ( $poll_object->poll_list[$poll]['variants'] as $key => $value ) {
					$answers = $poll_object->poll_list[$poll]['answers'];
					$count   = $answers[$key];
					$percent = (array_sum($answers)) ? $count / array_sum($answers) * 100 : 0;
					echo '<li>';
					echo '<div><b>'.$value.'</b>: &nbsp;'.$count.' '. __( 'votes', 'framework' ) .'</div>';
					echo '<div style="width:100%;border:1px solid #aaa;"><div style="height:8px;background-color:#ccc;width:'.$percent.'%"></div></div>';
					echo '</li>';
				}
				echo "</ul>";
			}
		}

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$updated_instance = $new_instance;
		return $updated_instance;
	}

	function form( $instance ) {
		global $poll_object;

		$poll = ( isset( $instance['poll'] ) ) ? esc_attr( $instance['poll'] ) : 'none';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'poll' ); ?>">
				<?php _e( 'Select The Poll:' ); ?> <br>
				<select id="<?php echo $this->get_field_id( 'poll' ); ?>" name="<?php echo $this->get_field_name( 'poll' ); ?>" >
					<option value="none" <?php echo ( $poll == 'none' ) ? 'selected="true"' : ''; ?>><?php echo __('None', 'framework'); ?></option>
					<?php foreach ( $poll_object->poll_list as $key => $value ): ?>
						<option value="<?php echo $value['alias']; ?>" <?php echo ( $poll == $value['alias'] ) ? 'selected="true"' : ''; ?>><?php echo $value['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</p>
		<?php
	}

}

?>
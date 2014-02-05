<style type="text/css">
	#first_name {
		background:#FBFBFB none repeat scroll 0 0;
		border:1px solid #E5E5E5;
		font-size:24px;
		margin-bottom:16px;
		margin-right:6px;
		margin-top:2px;
		padding:3px;
		width:97%;
	}
</style>	

<div width="100%">
	<p>
		<label style="display: block; margin-bottom: 5px;"><?php echo __( 'First Name', 'First Name' ); ?>
			<input type="text" name="first_name" id="first_name" class="input" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" size="20" tabindex="26" />
		</label>
	</p>
</div>
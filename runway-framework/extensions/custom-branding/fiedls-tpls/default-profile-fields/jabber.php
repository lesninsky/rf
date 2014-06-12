<style type="text/css">
	#jabber {
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
		<label style="display: block; margin-bottom: 5px;"><?php echo __( 'Jabber / Google Talk', 'Jabber / Google Talk' ); ?>
			<input type="text" name="jabber" id="jabber" class="input" value="<?php echo isset($_POST['jabber']) ? $_POST['jaber'] : ''; ?>" size="20" tabindex="26" />
		</label>
	</p>
</div>
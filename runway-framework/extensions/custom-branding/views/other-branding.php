<div class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="<?php echo __('Click to toggle', 'framework'); ?>"><br></div>
		<h3 class="hndle"><span><?php echo __('Wordpress footer', 'framework'); ?></span></h3>
		<div class="inside" >
			<input type="text" id="custom-foter" value = "<?php echo isset( $admin_custom_branding->custom_branding_options['footer'] )? $admin_custom_branding->custom_branding_options['footer'] : ''; ?>" />
			<input type="button" value="<?php echo __('Set New Footer', 'framework'); ?>" id="set-new-footer" /><br>
		</div>
	</div>
</div>
<div class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Access key</span></h3>
		<div class="inside">			
			<span>Access key: <?php echo $sync_tool_admin->get_key(); ?></span>			
			<form method="post">
				<input type="hidden" name="action" value="create-new-key" />
				<input type="submit" class="button" value="Create new key">				
			</form>
		</div>
	</div>
</div>
<?php 
	$is_import = isset( $sync_tool_admin->server_settings['permissions']['import'] );
	$is_export = isset( $sync_tool_admin->server_settings['permissions']['export'] );
?>
<div class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Permissions on Export</span></h3>
			<form method="post">
				<input type="checkbox" name="import-permissions-list[]" <?php if( $is_import && in_array('extensions', $sync_tool_admin->server_settings['permissions']['import'])) { echo 'checked="true"'; } ?> value="extensions" id="import-extensions"><label for="import-extensions">Export extensions</label><br>			
				<input type="checkbox" name="import-permissions-list[]" <?php if( $is_import && in_array('posts', $sync_tool_admin->server_settings['permissions']['import'])) { echo 'checked="true"'; } ?> value="posts" id="import-posts"><label for="import-posts">Export posts</label><br>
				<input type="checkbox" name="import-permissions-list[]" <?php if( $is_import && in_array('categories', $sync_tool_admin->server_settings['permissions']['import'])) { echo 'checked="true"'; } ?> value="categories" id="import-categories"><label for="import-categories">Export categories</label><br>
				<input type="checkbox" name="import-permissions-list[]" <?php if( $is_import && in_array('tags', $sync_tool_admin->server_settings['permissions']['import'])) { echo 'checked="true"'; } ?> value="tags" id="import-tags"><label for="import-tags">Export tags</label><br>
				<input type="checkbox" name="import-permissions-list[]" <?php if( $is_import && in_array('users', $sync_tool_admin->server_settings['permissions']['import'])) { echo 'checked="true"'; } ?> value="users" id="import-users"><label for="import-users">Export users</label><br>
				<input type="checkbox" name="import-permissions-list[]" <?php if( $is_import && in_array('plugins', $sync_tool_admin->server_settings['permissions']['import'])) { echo 'checked="true"'; } ?> value="plugins" id="import-plugins"><label for="import-plugins">Export plugins</label><br><br>
				<input type="hidden" name="action" value="set-permissions-on-import" />
				<input type="submit" class="button" value="Set Permissions">				
			</form>
		</div>
	</div>
</div>

<div class="meta-box-sortables metabox-holder">
	<div class="postbox"> 
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Permissions on Import</span></h3>
			<form method="post">
				<input type="checkbox" name="export-permissions-list[]" <?php if( $is_export && in_array('extensions', $sync_tool_admin->server_settings['permissions']['export'])) { echo 'checked="true"'; } ?> value="extensions" id="export-extensions"><label for="export-extensions">Import extensions</label><br>			
				<input type="checkbox" name="export-permissions-list[]" <?php if( $is_export && in_array('posts', $sync_tool_admin->server_settings['permissions']['export'])) { echo 'checked="true"'; } ?> value="posts" id="export-posts"><label for="export-posts">Import posts</label><br>
				<input type="checkbox" name="export-permissions-list[]" <?php if( $is_export && in_array('categories', $sync_tool_admin->server_settings['permissions']['export'])) { echo 'checked="true"'; } ?> value="categories" id="export-categories"><label for="export-categories">Import categories</label><br>
				<input type="checkbox" name="export-permissions-list[]" <?php if( $is_export && in_array('tags', $sync_tool_admin->server_settings['permissions']['export'])) { echo 'checked="true"'; } ?> value="tags" id="export-tags"><label for="export-tags">Import tags</label><br>
				<input type="checkbox" name="export-permissions-list[]" <?php if( $is_export && in_array('users', $sync_tool_admin->server_settings['permissions']['export'])) { echo 'checked="true"'; } ?> value="users" id="export-users"><label for="export-users">Import users</label><br><br>
				<input type="hidden" name="action" value="set-permissions-on-export" />
				<input type="submit" class="button" value="Set Permissions">				
			</form>
		</div>
	</div>
</div>
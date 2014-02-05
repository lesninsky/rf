<?php
	if(in_array('extensions', $permissions_on_server['import']) && in_array('extensions', $permissions_on_server['export'])):
	// out($server_data->extensions_data);
	// out($diff_exten1sions);
?>
<script type="text/javascript">
jQuery.noConflict();
(function($) {
  $(function() {
  		
  });
})(jQuery);
</script>
<?php if(!empty($diff_extensions['same_extensions'])): ?>
<div id="data-from-server" class="meta-box-sortables metabox-holder">
<div class="postbox">
	<div class="handlediv" title="Click to toggle"><br></div>
	<h3 class="hndle"><span>Same Extensions</span></h3>
	<div class="inside" id="data-from-server-inside">						
	<table class="wp-list-table widefat plugins" id="data-list">
		<thead>
			<tr>
				<th id="name" class="manage-column column-name">Local Extensions</th>
				<th id="name" class="manage-column column-name" style="text-align:center;">Import/Export All Data</th>
				<th id="description" class="manage-column column-description">Server Extensions</th>
			</tr>
		</thead>
		<tbody id="the-list">
			<?php foreach ((array)$diff_extensions['same_extensions'] as $extension => $extension_info) : ?>
				<tr calss="active">
					<td class="plugin-title" style="text-align:left;">
						<?php 		
							$local_extension = $local_data['active_exts'][$extension];
						?>
						<div id="data-from-server" class="meta-box-sortables metabox-holder">
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php echo $local_extension['Name']; ?></span></h3>
							<div class="inside" id="data-from-server-inside" style="display:none;">			
								<?php  out($local_extension['data']); ?>	
							</div>
						</div>
					</div>
					</td>	
					<td class="plugin-title" style="text-align:center;">
						<br>
						<a href="<?php echo $this->self_url('merge-extensions'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&option_key=<?php echo $local_extension['option_key']; ?>&extension=<?php echo $extension; ?>&operation=import-options&what=<?php echo $what; ?>">
							Import options
						</a> | 
						<a href="<?php echo $this->self_url('merge-extensions'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&option_key=<?php echo $local_extension['option_key']; ?>&extension=<?php echo $extension; ?>&operation=export-options&what=<?php echo $what; ?>">
							Export option
						</a>
					</td>
					<td class="column-description desc">
						<div id="data-from-server" class="meta-box-sortables metabox-holder">
						<div class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h3 class="hndle"><span><?php echo $extension_info['Name']; ?></span></h3>
							<div class="inside" id="data-from-server-inside" style="display:none;">			
								<?php  out($extension_info['data']); ?>
							</div>
						</div>
					</td>	
				</tr>
			<?php endforeach; ?>				
		</tbody>
	</table>
</div>
</div>
<?php endif; ?>
<!-- ************************************************************************* -->
<?php if(!empty($diff_extensions['must_be_active'])): ?>
<div id="data-from-server" class="meta-box-sortables metabox-holder">
<div class="postbox">
	<div class="handlediv" title="Click to toggle"><br></div>
	<h3 class="hndle"><span>Must be active</span></h3>
	<div class="inside" id="data-from-server-inside">						
	<table class="wp-list-table widefat plugins" id="data-list">
		<thead>
			<tr>
				<th id="name" class="manage-column column-name">Name</th>
				<th id="name" class="manage-column column-name">Description</th>
				<th id="name" class="manage-column column-name">Active</th>
			</tr>
		</thead>
		<tbody id="the-list">
			<?php foreach ((array)$diff_extensions['must_be_active'] as $extension => $extension_info) : ?>
				<tr calss="active">
					<td class="plugin-title" style="text-align:left;">
						<?php 						
							$local_extension = $local_data['desible_exts'][$extension];
							echo $local_extension['Name']; 
						?>
					</td>	
					<td class="column-description desc">
						<?php echo $local_extension['Description']; ?>
					</td>	
					<td class="plugin-title" style="text-align:left;">
						<a href="<?php echo home_url().'/wp-admin/themes.php?page=extensions&navigation=extension-activate&ext='.$extension; ?>" title="Connect" class="connect">Activate</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
<?php endif; ?>
<!-- ************************************************************************* -->
<?php if(!empty($diff_extensions['must_be_installed'])): ?>
<div id="data-from-server" class="meta-box-sortables metabox-holder">
<div class="postbox">
	<div class="handlediv" title="Click to toggle"><br></div>
	<h3 class="hndle"><span>Must be installed</span></h3>
	<div class="inside" id="data-from-server-inside">						
	<table class="wp-list-table widefat plugins" id="data-list">
		<thead>
			<tr>
				<th id="name" class="manage-column column-name">Local Extensions</th>
				<th id="description" class="manage-column column-description">Description</th>
				<th id="name" class="manage-column column-name">Install</th>
			</tr>
		</thead>
		<tbody id="the-list">
			<?php foreach ((array)$diff_extensions['must_be_installed'] as $extension => $extension_info) : ?>
				<tr calss="active">
					<td class="plugin-title" style="text-align:left;">
						<?php 												
							echo $extension_info->Name; 
						?>
					</td>	
					<td class="column-description desc">						
						<?php echo $extension_info->Description; ?>
					</td>	
					<td class="plugin-title">
						<span>
							<a href="<?php echo $extension_info->AuthorURI; ?>" title="Connect" class="connect">Install</a>
						</span>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
<?php endif; ?>
<?php 
elseif(in_array('extensions', $permissions_on_server['import']) && !in_array('extensions', $permissions_on_server['export'])):
	include 'import/import-extensions.php';
elseif(!in_array('extensions', $permissions_on_server['import']) && in_array('extensions', $permissions_on_server['export'])):	
	include ('export/export-extensions.php');
endif; 
?>
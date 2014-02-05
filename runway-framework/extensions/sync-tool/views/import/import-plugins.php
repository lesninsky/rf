<br><div class="nav-tabs nav-tabs-second">
	<a href="<?php echo $this->self_url('connection'); ?>&connection_id=<?php echo $connection_id; ?>" class="nav-tab">Differencies Page</a>
	<a href="<?php echo $this->self_url('import-plugins'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&operation=import&what=plugins" class="nav-tab nav-tab-active">Import</a>
</div>

<?php 
if(in_array('plugins',$permissions_on_server['import'])):
if(isset($message) && $message != '') : ?>
	<div id="message" class="updated">
		<p>
			<?php echo $message; ?>
		</p>
	</div>
<?php endif; ?>

<div class="meta-box-sortables metabox-holder">
<div class="postbox">
	<div class="handlediv" title="Click to toggle"><br></div>
	<h3 class="hndle"><span>Server Plugins</span></h3>
	<div class="inside" >
		<table class="wp-list-table widefat plugins">
			<thead>
				<tr>
					<th id="name" class="manage-column column-name">Name</th>
					<th id="description" class="manage-column column-description">Description</th>
					<th id="action" class="manage-column column-name" width="70">Action</th>
				</tr>
			</thead>
			<tbody id="the-list">		
				<?php foreach ((array)$server_plugins as $key => $value) : ?>
					<tr calss="active">
						<td class="plugin-title" style="text-align:left;">
							<?php echo $value['Name']; ?>
						</td>	
						<td class="column-description desc">
							<?php echo $value['Description']; ?>
						</td>	
						<td class="column-description desc">
							<?php
								if(isset($local_plugins[$key])){
									echo "Installed";
								}
								else{
									$plugin = explode('/', $key);
									$plugin = str_replace('.php', '', $plugin[0]);
									?>
									<a href="http://runway.loc/wp-admin/plugin-install.php?tab=plugin-information&plugin=<?php echo $plugin; ?>&TB_iframe=true&width=640&height=359" class="thickbox" title="More information about Akismet 2.5.7">Details</a><br>
									<?php		
									if ( current_user_can('install_plugins') ){
										$install_now_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . $plugin), 'install-plugin_' . $plugin);
										?>
										<a href="<?php echo "$install_now_url"; ?>" target="_blank">Install now</a><br>
										<a href="<?php echo "http://wordpress.org/extend/plugins/$plugin"; ?>" target="_blank">Download</a>
										<?php
									}																
								}
							 ?>
						</td>	
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
</div>
<?php else: ?>
	Access denied	
<?php endif; ?>
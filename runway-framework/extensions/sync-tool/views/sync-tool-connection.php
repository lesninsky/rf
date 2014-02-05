<h3>
	<?php echo stripslashes( $connection['connection_name'] ) ?> 
	[<?php echo isset($ping_response['state']) && in_array('success', $ping_response['state']) ? 
		'<span class="connection-status-success">' . $ping_response['message'] : 
		'<span class="connection-status-failed">Failed' ?></span>]
</h3>
<div class='server-response-information'></div>
<?php if(isset($ping_response['state']) && in_array('success', $ping_response['state'])) : ?>
<div id="data-from-server" class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Contribution Extensions</span></h3>
		<div class="inside" id="data-from-server-inside">			
			<table>
				<tr>
					<td>Extensions count on server:</td>
					<td><b><?php echo $data_count_server['extensions']; ?></b></td>
				</tr>
				<tr>
					<td>Extensions count on local:</td>
					<td><b><?php echo $data_count_local['extensions']; ?></b></td>
				</tr>				
			</table>		
		<a href="<?php echo $this->self_url('merge-extensions'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&operation=import&what=extensions" class="button-primary" style="float:right;">Go to merging</a><br><br>
		<div id="error-from-server"></div>
		</div>
	</div>
</div>

<div id="data-from-server" class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Posts</span></h3>
		<div class="inside" id="data-from-server-inside">			
		<table>
			<tr>
				<td>Posts count on server:</td>
				<td><b><?php echo $data_count_server['posts']; ?></b></td>
			</tr>			
			<tr>
				<td>Posts count on local:</td>
				<td><b><?php echo $data_count_local['posts']; ?></b></td>
			</tr>
		</table>
		<a href="<?php echo $this->self_url('import-posts'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&operation=import&what=posts" class="button-primary" style="float:right;">Go to merging</a><br><br>						
		<div id="error-from-server"></div>
		</div>
	</div>
</div>

<div id="data-from-server" class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Categories</span></h3>
		<div class="inside" id="data-from-server-inside">			
		<table>
			<tr>
				<td>Categories count on server:</td>
				<td><b><?php echo $data_count_server['categories']; ?></b></td>
			</tr>			
			<tr>
				<td>Categories count on local:</td>
				<td><b><?php echo $data_count_local['categories']; ?></b></td>
			</tr>
		</table>
		<a href="<?php echo $this->self_url('import-categories'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&operation=import&what=categories" class="button-primary" style="float:right;">Go to merging</a><br><br>						
		<div id="error-from-server"></div>
		</div>
	</div>
</div>

<div id="data-from-server" class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Tags</span></h3>
		<div class="inside" id="data-from-server-inside">			
		<table>
			<tr>
				<td>Tags count on server:</td>
				<td><b><?php echo $data_count_server['tags']; ?></b></td>
			</tr>			
			<tr>
				<td>Tags count on local:</td>
				<td><b><?php echo $data_count_local['tags']; ?></b></td>
			</tr>
		</table>
		<a href="<?php echo $this->self_url('import-tags'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&operation=import&what=tags" class="button-primary" style="float:right;">Go to merging</a><br><br>						
		<div id="error-from-server"></div>
		</div>
	</div>
</div>

<div id="data-from-server" class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Plugins</span></h3>
		<div class="inside" id="data-from-server-inside">			
		<table>
			<tr>
				<td>Plugins count on server:</td>
				<td><b><?php echo $data_count_server['plugins']; ?></b></td>
			</tr>			
			<tr>
				<td>Plugins count on local:</td>
				<td><b><?php echo $data_count_local['plugins']; ?></b></td>
			</tr>
		</table>
		<a href="<?php echo $this->self_url('import-plugins'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&operation=import&what=plugins" class="button-primary" style="float:right;">Go to merging</a><br><br>						
		<div id="error-from-server"></div>
		</div>
	</div>
</div>

<div id="data-from-server" class="meta-box-sortables metabox-holder">
	<div class="postbox">
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class="hndle"><span>Users</span></h3>
		<div class="inside" id="data-from-server-inside">			
		<table>
			<tr>
				<td>Users count on server:</td>
				<td><b><?php echo $data_count_server['users']; ?></b></td>
			</tr>			
			<tr>
				<td>Users count on local:</td>
				<td><b><?php echo $data_count_local['users']; ?></b></td>
			</tr>
		</table>
		<a href="<?php echo $this->self_url('import-users'); ?>&action=connection&connection_id=<?php echo $connection_id; ?>&operation=import&what=users" class="button-primary" style="float:right;">Go to merging</a><br><br>						
		<div id="error-from-server"></div>
		</div>
	</div>
</div>
<?php endif; ?>
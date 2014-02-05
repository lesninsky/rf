<br>
	<a href="options-general.php?page=sync-tool&navigation=connections" id="add-new-connection" class="add-new-h2">Add New Item</a>
	<a href="options-general.php?page=sync-tool&navigation=ping&action=ping-all" id="ping-all" class="add-new-h2">Ping All</a>
<br><br>
<!-- Add connection dialog -->
<div id="new-connection-dialog" style="display:none;">		
	<table> 
		<tr>
			<td>Connect with:</td>
			<td>
				<label><input id="r-connect-with-key" type="radio" class="check-connection" name="check-connection" checked="true" value="connect-with-key">Access Key</label>
				<label><input id="r-connect-with-login" type="radio" class="check-connection" name="check-connection" value="connect-with-login">Login and password</label>
			</td>
		</tr>
	</table>	
	<table>
		<tr>
			<td>URL:</td>
			<td><input type="text" id="server" value=""><br></td>
		</tr>
		<tr>
			<td>Name:</td>
			<td><input type="text" id="connection-name" value=""><br></td>
		</tr>
	</table><hr>
	<div id="connect-with-key" class="connection-form">
		<table>					
			<tr>
				<td>Access key:</td>
				<td><input type="text" id="access-key" value=""><br></td>
			</tr>
			<tr>
				<td class="connect-to-serv"><a href="#" id="add-server-key" data-flag="add" class="button-primary">Save settings</a></td>
			</tr>
		</table>							
	</div>			
	<div id="connect-with-login" style="display:none;" class="connection-form">
		<table>
			<tr>
				<td>Login:</td>
				<td><input type="text" id="user-login"><br></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" id="user-password"><br></td>
			</tr>
			<tr>
				<td class="connect-to-serv"><a href="#" id="add-server-login" data-flag="add" class="button-primary">Save settings</a></td>
			</tr>
		</table>		
	</div>
</div>
<div id="responce"></div>

<!-- Connections list -->
<table class="wp-list-table widefat plugins" id="connections">
<thead>
	<tr>
		<th scope="col" style="width:0px;" id="cb" class="manage-column column-cb check-column" style="width: 0px;"><input type="checkbox" name="ext_chk[]" /></th>
		<th id="name" class="manage-column column-name">URL</th>
		<th id="description" class="manage-column column-description">Description</th>
		<th id="description" class="manage-column column-description">Action</th>
		<th id="description" class="manage-column column-description">Status</th>
	</tr>
</thead>
<tbody id="connections-list">
	<?php if ( isset ( $this->server_settings['connections'] ) ): ?>
		<?php foreach ((array)$this->server_settings['connections'] as $key => $value) :?>
			<tr class="active" id="<?php echo $key; ?>" 
				data-cn="<?php echo stripslashes( $value['connection_name'] ); ?>"
				data-url="<?php echo $value['server_url']; ?>"
				data-type="<?php echo $value['type']; ?>"
				data-ak="<?php if(isset($value['access_key'])) echo $value['access_key']; ?>"
				data-login="<?php if(isset($value['login'])) echo $value['login']; ?>"
				data-psw="<?php if(isset($value['password'])) echo $value['password']; ?>">
				<td class="plugin-title">
					<input type="checkbox">
				</td>
				<td class="plugin-title" style="text-align:left;">
					<?php echo stripslashes( $value['connection_name'] ) . ' ('.$value['server_url'].')'; ?>
				</td>	
				<td class="column-description desc">
					<?php echo $value['type']; ?>
				</td>	
				<td class="column-description actions">
					<span class="connect"><a href="options-general.php?page=sync-tool&navigation=connection&connection_id=<?php echo $key; ?>" title="Connect" class="connect">Connect</a> | </span>
					<span class="edit"><a href="#" title="Edit" id="connection-edit" class="edit">Edit</a> | </span>
					<span class="ping"><a href="options-general.php?page=sync-tool&navigation=ping&action=ping&connection_id=<?php echo $key; ?>" title="Ping" class="ping">Ping</a> | </span>
					<span class="delete"><a href="options-general.php?page=sync-tool&navigation=connection&action=delete-connection&connection_id=<?php echo $key; ?>" class="delete">Delete</a></span>
				</td>	
				<td class="column-description status">
					<?php
						$ping_response = request($value);
						
						if($ping_response['state'][0] == 'success'){
							$state = "AVAILABLE";
						}
						else {
							$state = "DISABLE";
						}
					?>
					<p style="color:<?php echo ($state == 'AVAILABLE') ? 'Green' : 'Red'	; ?>"><?php echo $state; ?></p>
				</td>	
			</tr>
		<?php endforeach; ?>
	<?php endif ?>
</tbody>
</table>		
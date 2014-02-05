<table class="wp-list-table widefat plugin-install" cellspacing="0">
	<thead>
	<tr>
		<th scope="col" id="name" class="manage-column column-name" style=""><?php _e( 'Name', 'framework' ) ?></th>
		<th scope="col" id="version" class="manage-column column-version" style=""><?php _e( 'Version', 'framework' ) ?></th>
		<th scope="col" id="description" class="manage-column column-description" style=""><?php _e( 'Description', 'framework' ) ?></th>
	</tr>
	</thead>

	<tbody id="the-list">
		<?php foreach ( $directory->search_request_extensions( $_POST['s'] ) as $token => $extension ) { ?>
			<tr>
				<td class="name column-name"><strong><?php echo $extension->name ?></strong>
					<div class="action-links">
						<a href="admin.php?page=directory&amp;tab=item-information&amp;item=the-item-name&amp;TB_iframe=true&amp;width=600&amp;height=550" class="thickbox" title="More information">Details</a> |
						<a class="install-now" href="admin.php?page=directory&amp;action=install&amp;item=the-item-name&amp;_wpnonce=<?php //wpnonce ?>" title="Install">
							<?php echo ($extm->is_install($token)) ? "Reinstall" : "Install Now"; ?>
						</a>
					</div>
				</td>
				<td class="vers column-version"><?php echo $extension->version ?></td>
				<td class="desc column-description"><?php echo $extension->description ?></td>
			</tr>
		<?php } ?>
	</tbody>

	<tfoot>
	<tr>
		<th scope="col" class="manage-column column-name" style=""><?php _e( 'Name', 'framework' ) ?></th>
		<th scope="col" class="manage-column column-version" style=""><?php _e( 'Version', 'framework' ) ?></th>
		<th scope="col" class="manage-column column-description" style=""><?php _e( 'Description', 'framework' ) ?></th>
	</tr>
	</tfoot>
</table>

<?php 
	global $content_types_admin;
?>

<br>
<table class="wp-list-table widefat plugins" style="width: auto; min-width: 50%;">
	<thead>
		<tr>
			<th id="field-name" class="manage-column column-name"><?php _e('Field', 'framework') ?></th>
			<th id="field-header" class="manage-column column-header"><?php _e('Alias', 'framework') ?></th>
			<th id="field-header" class="manage-column column-header"><?php _e('Actions', 'framework') ?></th>
		</tr>
	</thead>
	<tbody id="the-list">	
		<?php 
			if(!empty($content_types_admin->content_types_options['fields'])) :
			//if(!empty($content_types_settings->content_types_options['fields'])) :
			foreach ((array)$content_types_admin->content_types_options['fields'] as $content_type => $values) : 
				if(isset($values['inputs']) ) {
		?>
			<tr calss="active">
				<td class="column-name">
					<a href="<?php echo $this->self_url('edit-field'); ?>&alias=<?php echo $values['alias']; ?>"><strong><?php echo $values['name']; ?></strong></a>
				</td>
				<td class="column-alias">
					<?php echo $values['alias']; ?>
				</td>
				<td class="column-actions">
					<a href="<?php echo $this->self_url('add-inputs'); ?>&alias=<?php echo $values['alias']; ?>">Manage Inputs</a> | 
					<a href="<?php echo $this->self_url('edit-field'); ?>&alias=<?php echo $values['alias']; ?>">Edit</a> | 
					<a href="<?php echo $this->self_url('delete-field'); ?>&alias=<?php echo $values['alias']; ?>">Delete</a>
				</td>
			</tr>
			<?php }  ?>
		<?php endforeach; ?>
		<?php else : ?>	
			<tr calss="active">
				<td class="no-items" colspan="2">
					No custom fields to display it's here	
				</td>			
			</tr>			
		<?php endif;  ?>
	</tbody>
</table>
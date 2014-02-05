<br>
<table class="wp-list-table widefat plugins" style="width: auto; min-width: 50%;">
	<thead>
		<tr>
			<th id="field-name" class="manage-column column-name"><?php _e('Post Type', 'framework') ?></th>
			<th id="field-header" class="manage-column column-header"><?php _e('Alias', 'framework') ?></th>			
			<th id="field-header" class="manage-column column-header"><?php _e('Actions', 'framework') ?></th>			
		</tr>
	</thead>
	<tbody id="the-list">	
		<?php 
			if(!empty($this->content_types_options['content_types'])) :
			foreach ((array)$this->content_types_options['content_types'] as $content_type => $values) : 
		?>
			<tr calss="active">
				<td class="column-name">
					<a href="<?php echo $this->self_url('edit-post-type'); ?>&alias=<?php echo $values['alias']; ?>"><strong><?php echo $values['labels']['name']; ?></strong></a>
				</td>
				<td class="column-alias">
					<?php echo $values['alias']; ?>
				</td>				
				<td class="column-alias">
					<a href="<?php echo $this->self_url('edit-post-type'); ?>&alias=<?php echo $values['alias']; ?>">Edit</a> |
					<a href="<?php echo $this->self_url('delete-post-type'); ?>&alias=<?php echo $values['alias']; ?>">Delete</a>
				</td>
			</tr>			
		<?php endforeach; ?>
		<?php else : ?>	
			<tr calss="active">
				<td class="no-items" colspan="2">
					No custom post types have been created.
				</td>			
			</tr>			
		<?php endif;  ?>
	</tbody>
</table>
<p><?php _e('Create simple user polls and insert them into sidebars. Go to "Appearance > Widgets" and use the "Poll Widget" to display a poll.', 'framework'); ?></p>
<table class="wp-list-table widefat">
	<thead>
		<tr>
			<th id="poll-name" class="manage-column column-name"><?php _e('Name', 'framework') ?></th>
			<th id="variants-count" class="manage-column column-header"><?php _e('Options', 'framework') ?></th>			
			<th id="answers-count" class="manage-column column-header"><?php _e('Responses', 'framework') ?></th>			
			<th id="actions" class="manage-column column-header"><?php _e('Actions', 'framework') ?></th>			
		</tr>
	</thead>
	<tbody id="the-list">	
		<?php

		// Show each poll question
		if(!empty($this->poll_list)) :
			foreach ((array) $this->poll_list as $poll) : 
				?>
				<tr class="active">
					<td class="column-name">
						<?php echo $poll['name']; ?>
					</td>
					<td class="column-alias">
						<?php echo count($poll['variants']); ?>
					</td>
					<td class="column-alias">
						<?php echo array_sum($poll['answers']); ?>
					</td>
					<td class="column-alias">
						<a href="<?php echo $this->self_url('edit_poll'); ?>&alias=<?php echo $poll['alias']; ?>"><?php _e('Edit', 'framework'); ?></a> |
						<a href="<?php echo $this->self_url('delete_poll'); ?>&alias=<?php echo $poll['alias']; ?>"><?php _e('Delete', 'framework'); ?></a>|
						<a href="<?php echo $this->self_url('show_results'); ?>&alias=<?php echo $poll['alias']; ?>"><?php _e('Show Results', 'framework'); ?></a>
					</td>
				</tr>			
				<?php 
			endforeach;
		else : ?>	
			<tr class="active">
				<td class="no-items" colspan="2">
					<?php _e('No polles have been created.', 'framework'); ?>
				</td>			
			</tr>			
			<?php 
		endif;  
		?>
	</tbody>
</table>
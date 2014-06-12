<form action="<?php echo $this->self_url(''); ?>&action=update_poll<?php echo !empty($alias) ? '&alias='.$alias : ''; ?>" id="add-field" method="post">
	<table class="form-table">
		<tbody>
			<tr class="">
				<th scope="row" valign="top">
					<?php _e('Question', 'framework'); ?>				
					<p class="description required"><?php _e('Required', 'framework'); ?></p>
				</th>
				<td class="vars">
					<input class="input-text " id="name" type="text" name="name" value="<?php echo (!empty($alias)) ? $this->poll_list[$alias]['name'] : ''; ?>">
					<p class="description"><?php _e('The question to be asked.', 'framework'); ?></p>
				</td>
			</tr>
			<tr class="">
				<th scope="row" valign="top">
					<?php _e('Answers', 'framework'); ?>
					<p class="description required"><?php _e('Required', 'framework'); ?></p>
				</th>				
				<td>
					<?php 
					if(!empty($alias)):
						foreach ($this->poll_list[$alias]['variants'] as $value): ?>
							<p class="variant">
								<input class="input-text" id="name" type="text" name="variants[]" value="<?php echo "$value"; ?>">
							</p>
							<?php 
						endforeach;
					else: ?>
						<p class="variant">
							<input class="input-text" id="name" type="text" name="variants[]" value="">
						</p>
						<?php 
					endif; 
					?>
					<p>
						<input id="add_variant" type="button" class="button" value="<?php _e('Add Answer', 'framework'); ?>">
					</p>
				</td>
			</tr>
		</tbody>
	</table>
<input class="button-primary" type="submit" id="save-button" value="<?php _e('Save Settings', 'framework') ?>">
</form>
<script type="text/javascript">
(function($){
	$('#add_variant').click(function(e){

		variant = $('<input/>', {		    
			class:  'input-text',
			type: 	'text',
			name: 	'variants[]',
			css: {
				'display': 'block'
			}	    		    
		}).insertAfter('p.variant:last').wrap('<p class="variant"></p>');

		$(variant).focus();
	});
})(jQuery);
</script>
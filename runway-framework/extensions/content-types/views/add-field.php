<form action="<?php echo $this->self_url('fields'); ?>&action=update-field<?php echo isset($field) ? '&alias='.$field['alias'] : ''; ?>" id="add-field" method="post">
	<table class="form-table">
		<tbody>
			<tr class="">
				<th scope="row" valign="top">
					Name				
					<p class="description required">Required</p>
				</th>
				<td>
					<input class="input-text " id="name" type="text" name="name" value="<?php echo (isset($field)) ? $field['name'] : ''; ?>">
					<p class="description">General name for the taxonomy type, usually plural</p>
				</td>
			</tr>
			<tr class="">
				<th scope="row" valign="top">Used with post types</th>
				<td>
					<?php foreach (get_post_types(array(), 'objects') as $post_type => $values) : ?>
						<?php if(!in_array($values->name, array('attachment', 'revision', 'nav_menu_item'))) : ?> 
							<label>
								<input class="input-check" type="checkbox" value="<?php echo $values->name; ?>" <?php if(isset($field['post_types'])) echo (in_array($values->name, $field['post_types'])) ? 'checked' : ''; ?> name="post_types[]"> <?php echo $values->label; ?>
							</label><br>
						<?php endif ?>
					<?php endforeach; ?>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="meta-box-sortables metabox-holder">
		<div class="postbox">
			<div class="handlediv" title="Click to toggle"><br></div>
			<h3 class="hndle"><span> Advanced settings</span></h3>
			<div class="inside" style="display:none;">
				<table class="form-table">
					<tbody>
						<tr class="">
							<th scope="row" valign="top">Default position</th>
							<td>
								<label>
									<input class="input-radio" type="radio" name="position" value="right" <?php if(isset($field['position'])) echo ($field['position'] == 'right') ? 'checked="checked"' : ''; ?>> Right
								</label><br> 
								<label>
									<input class="input-radio" type="radio" name="position" value="left" <?php if(isset($field['position'])) echo ($field['position'] == 'left') ? 'checked="checked"' : ''; ?>> Left
								</label> 
								<p class="description">The default column the box will appear in. Note that a user can move boxes on the Write/Edit page as they see fit.</p>		 				
							</td>
		 				</tr>
						<tr class="">
							<th scope="row" valign="top">
								Roles to access
								<p class="description">The roles for which this field will be visible.</p>
							</th>
							<td>
								<?php 
									global $wp_roles;
									foreach ($wp_roles->roles as $key => $values) :
								?>
									<label>
										<input class="input-check" type="checkbox" value="<?php echo $key; ?>" name="more_access_cap[]" <?php  if(isset($field['more_access_cap'])) echo (in_array($key, $field['more_access_cap'])) ? 'checked' : ''; ?>> <?php echo $values['name']; ?>
									</label><br>
							<?php endforeach; ?>
							</td>
			 			</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<input class="button-primary" type="button" id="save-button" value="<?php _e('Save Settings', 'framework') ?>">
</form>

<script type="text/javascript">
	(function($){
		$('#save-button').click(function(e){			
			// var headerTitle = $('#header-title').val().trim();
			name = $('#name').val().trim()		
			
			if(name == ''){
				$('#name').css('border-color', 'Red');
			}
			else{
				$('#name').css('border-color', '');	
			}				
			
			if( name ){
				$('#add-field').submit();
			}
		});

	})(jQuery);
</script>
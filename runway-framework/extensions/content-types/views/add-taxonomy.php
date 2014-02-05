<form action="<?php echo $this->self_url('taxonomies'); ?>&action=update-taxonomy<?php echo isset($taxonomy) ? '&alias='.$taxonomy['alias'] : ''; ?>" id="add-taxonomy" method="post">
<h3>Labels</h3>
<table class="form-table">
	<tbody>
		<tr class="">
			<th scope="row" valign="top">
				Name				
				<p class="description required">Required</p>
			</th>
			<td>
				<input class="input-text " type="text" id="name" name="labels[name]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['name'] : ''; ?>">
				<p class="description">General name for the taxonomy type, usually plural</p>
			</td>
		</tr>
		<tr class="">
			<th scope="row" valign="top">
				Singular Name				
				<p class="description required">Required</p>
			</th>
			<td>
				<input class="input-text " type="text" id="singular_name" name="labels[singular_name]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['singular_name'] : ''; ?>">
				<p class="description">Name for one object of this taxonomy type. Defaults to value of name</p>
			</td>
		</tr>
		<tr class="">
			<th scope="row" valign="top">
				Menu Name				
				<p class="description required">Required</p>
			</th>
			<td>
				<input class="input-text " type="text" id="menu_name" name="labels[menu_name]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['menu_name'] : ''; ?>">
				<p class="description">The menu name text</p>
			</td>
		</tr>
		<tr class="">
			<th scope="row" valign="top">
				Parent Item Colon				
				<p class="description required">Required</p>
			</th>
			<td>
				<input class="input-text " type="text" id="parent_item_colon" name="labels[parent_item_colon]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['parent_item_colon'] : ''; ?>">
				<p class="description">The parent text</p>
			</td>
		</tr>		
		<tr class="">
			<th scope="row" valign="top">
				All Items	
				<p class="description required">Required</p>							
			</th>
			<td>
				<input class="input-text default-label" type="text" id="all_items" name="labels[all_items]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['all_items'] : 'All Taxonomies'; ?>">
				<p class="description">The all items text used in the menu</p>
			</td>
		</tr>
<tr class="">
			<th scope="row" valign="top">
				Add New Item		
				<p class="description required">Required</p>						
			</th>
			<td>
				<input class="input-text " type="text" id="add_new_item" name="labels[add_new_item]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['add_new_item'] : 'Add new taxonomy'; ?>">
				<p class="description">The add new item text</p>
			</td>
		</tr>
<tr class="">
			<th scope="row" valign="top">
				Edit Item		
				<p class="description required">Required</p>						
			</th>
			<td>
				<input class="input-text default-label" id="edit_item" type="text" name="labels[edit_item]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['edit_item'] : 'Edit taxonomy'; ?>">
				<p class="description">The edit item text</p>
			</td>
		</tr>
<tr class="">
			<th scope="row" valign="top">
				Update Item		
				<p class="description required">Required</p>						
			</th>
			<td>
				<input class="input-text default-label" id="update_item" type="text" name="labels[update_item]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['update_item'] : 'Update taxonomy'; ?>">
				<p class="description">The update item text</p>
			</td>
		</tr>
<tr class="">
			<th scope="row" valign="top">
				Search Items	
				<p class="description required">Required</p>							
			</th>
			<td>
				<input class="input-text default-label" id="search_items" type="text" name="labels[search_items]" value="<?php echo (isset($taxonomy)) ? $taxonomy['labels']['search_items'] : 'Search'; ?>">
				<p class="description">The search items text</p>
			</td>
		</tr>
	</tbody>
</table>
<input class="button-primary" type="button" id="save-button" value="<?php _e('Save Settings', 'framework') ?>">
</form>

<script type="text/javascript">
	(function($){
		$('#save-button').click(function(e){			
			// var headerTitle = $('#header-title').val().trim();
			name = $('#name').val().trim()
			singular_name = $('#singular_name').val().trim()
			menu_name = $('#menu_name').val().trim()
			parent_item_colon = $('#parent_item_colon').val().trim()
			all_items = $('#all_items').val().trim()
			add_new_item = $('#add_new_item').val().trim()
			edit_item = $('#edit_item').val().trim()
			update_item = $('#update_item').val().trim()
			search_items = $('#search_items').val().trim()			
			
			if(name == ''){
				$('#name').css('border-color', 'Red');
			}
			else{
				$('#name').css('border-color', '');	
			}

			if(singular_name == ''){
				$('#singular_name').css('border-color', 'Red');
			}
			else{
				$('#singular_name').css('border-color', '');	
			}

			if(menu_name == ''){
				$('#menu_name').css('border-color', 'Red');
			}
			else{
				$('#menu_name').css('border-color', '');	
			}

			if(parent_item_colon == ''){
				$('#parent_item_colon').css('border-color', 'Red');
			}
			else{
				$('#parent_item_colon').css('border-color', '');	
			}

			if(all_items == ''){
				$('#all_items').css('border-color', 'Red');
			}
			else{
				$('#all_items').css('border-color', '');	
			}

			if(add_new_item == ''){
				$('#add_new_item').css('border-color', 'Red');
			}
			else{
				$('#add_new_item').css('border-color', '');	
			}

			if(edit_item == ''){
				$('#edit_item').css('border-color', 'Red');
			}
			else{
				$('#edit_item').css('border-color', '');	
			}

			if(update_item == ''){
				$('#update_item').css('border-color', 'Red');
			}
			else{
				$('#update_item').css('border-color', '');	
			}

			if(search_items == ''){
				$('#search_items').css('border-color', 'Red');
			}
			else{
				$('#search_items').css('border-color', '');	
			}			
			
			if( name && singular_name && menu_name && parent_item_colon && all_items && add_new_item && edit_item && update_item && search_items){
				$('#add-taxonomy').submit();
			}
		});

	})(jQuery);
</script>
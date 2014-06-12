<br>
	<div>
		<a class="button" href="admin.php?page=help-tabs&navigation=new"><?php echo __('New tab', 'framework'); ?></a>
	</div>
<br>

<h3><?php echo __('Available tabs', 'framework'); ?>: </h3>
<div class="tab-settings">
	<input type="hidden" name="tab_controll[page_url]" value="<?php echo $page_url ?>" />
	<?php foreach ( $all_tabs as $tab ) : ?>
		<label>
			<input 
				type="checkbox" 
				name="tab_controll[attach_tabs][]" 
				value="<?php echo $tab['id'] ?>" <?php echo in_array( $page_url, (array)$tab['attach_to'] ) ? 'checked="true"' : '' ?> />
			<span><?php echo $tab['title'] ?></span>
		</label><br>
	<?php endforeach; ?>
</div>

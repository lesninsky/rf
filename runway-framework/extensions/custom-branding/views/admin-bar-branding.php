<div id="nav-menus-frame">
	<div id="menu-settings-column" class="metabox-holder">
		<div class="meta-box-sortables metabox-holder">
		<div class="postbox">
			<div class="handlediv" title="<?php echo __('Click to toggle', 'framework'); ?>"><br></div>
			<h3 class="hndle"><span><?php echo __('Settings', 'framework'); ?></span></h3>
			<div class="inside" >
				<input type="checkbox" <?php if ( $admin_custom_branding->custom_branding_options['use_default'] ) : ?> checked="true"<?php endif; ?> id='use-default'><?php echo __('Use default WP Admin Bar', 'framework'); ?><br>
				<ul>
					<li class="new-item menu-item menu-item-depth-0 menu-item-custom pending menu-item-edit-inactive" style="position: relative; top: 0px;" 
					data-title="New item" 
					data-id="" 
					data-parent="" 
					data-href="<?php echo home_url(); ?>" 
					data-icon="" 
					data-icon-w="" 
					data-icon-h="">          
						<dl class="menu-item-bar">           
							<dt class="menu-item-handle">            
								<span class="item-title"><?php echo __('New Item', 'framework'); ?></span>            
								<span class="item-controls" style="display:none;">
									<a class="item-edit" id="edit-item" title="<?php echo __('Edit Menu Item', 'framework'); ?>" data-id="" href="#"><?php echo __('Edit', 'framework'); ?></a>
								</span>
							</dt>         
						</dl> 
						<div class="edit-item-dialog menu-item-settings" id="" style="display: none; ">
							<p class="field-name name name-thin">
								<label for="edit-menu-item-title-21">
									<?php echo __('Title', 'framework'); ?>:<br>
									<input type="text" placeholder="<?php echo __('New item title', 'framework'); ?>" id="edit-title" value="<?php echo __('New item', 'framework'); ?>" class="input-text" /><br>
								</label>
							</p>
							<p class="field-name name name-thin">
								<label for="edit-menu-item-title-21">
									<?php echo __('Link To', 'framework'); ?>:<br>
									<input type="text" placeholder="<?php echo __('New item href', 'framework'); ?>" id="edit-href" value="<?php echo home_url(); ?>" class="input-text" /><br>
								</label>
							</p>
							<p class="field-name name name-thin">
								<label for="edit-menu-item-title-21">
									<?php echo __('Icon URL', 'framework'); ?>:<br>
									<input type="text" placeholder="<?php echo __('New item icon URL', 'framework'); ?>" id="edit-icon" value="" class="input-text" /><br>
								</label>
							</p>
							<p class="field-name name name-thin">
								<label for="edit-menu-item-title-21">
									<?php echo __('Icon width', 'framework'); ?>:<br>
									<input type="text" placeholder="<?php echo __('New item icon width', 'framework'); ?>" id="edit-icon-w" value="" class="input-text" /><br>
								</label>
							</p>
							<p class="field-name name name-thin">
								<label for="edit-menu-item-title-21">
									<?php echo __('Icon height', 'framework'); ?><br>
									<input type="text" placeholder="<?php echo __('New item icon height', 'framework'); ?>" id="edit-icon-h" value="" class="input-text" /><br>
								</label>
							</p>																														
																	
							<input type="button" value="Edit Item" id="edit-item-btn" data-id="" /><br>
							<div style="clear: both;"></div>
						</div>		           
						<ul class="menu-item-transport"></ul>
					</li>					
				</ul>
			</div>
		</div>
		</div>
	</div>

	<div id="menu-management-liquid" class="nav-menus-php">
		<div id="menu-management">
			<div class="menu-edit">

					<div id="nav-menu-header">
						<div id="submitpost" class="submitbox">
							<div class="major-publishing-actions"><br>
								<!-- <button class="button reset-menu"><?php echo __('Reset to default', 'framework'); ?></button> -->
								<a href="#" id="save-admin-bar-structure" class="button-primary ajax-save" style="float:right;"><?php echo __('Save Structure', 'framework'); ?></a><br/><br>								
							</div>
						</div>
					</div>

					<div id="post-body">
						<div id="post-body-content">
							<div class="ui-sortable dynamic_pages_sortable">
								<ul class="menu ui-sortable" id="menu-to-edit"></ul>
							</div>

							<script id="menu-item-tmpl" type="text/x-jquery-tmpl">
								<li id="${id}" class="menu-item menu-item-depth-0 menu-item-custom pending menu-item-edit-inactive" style="position: relative; top: 0px;"
									data-title = "${title}"
							    	data-id = "${id}"
							    	data-parent = "${parent}"
							    	data-href = "${href}"
									data-icon = "${icon_url}"
									data-icon-w = "${icon_w}"
									data-icon-h = "${icon_h}">
									<dl class="menu-item-bar">
										<dt class="menu-item-handle" style="width:250px;">
											<span class="item-title">${title}</span>
											<span class="item-controls">												
												<a class="item-edit" id="edit-item" title="Edit Menu Item" href="#" data-id="${id}"><?php echo __('Edit', 'framework'); ?></a>
											</span>
										</dt>
									</dl>		
									<div class="edit-item-dialog menu-item-settings" id="${id}" style="display: none; ">
										<p class="field-name name name-thin">
											<label for="edit-menu-item-title-21">
												<?php echo __('Title', 'framework'); ?>:<br>
												<input type="text" placeholder="<?php echo __('New item title', 'framework'); ?>" id="edit-title" value="${title}" class="input-text" /><br>
											</label>
										</p>
										<p class="field-name name name-thin">
											<label for="edit-menu-item-title-21">
												<?php echo __('Link To', 'framework'); ?>:<br>
												<input type="text" placeholder="<?php echo __('New item href', 'framework'); ?>" id="edit-href" value="${href}" class="input-text" /><br>
											</label>
										</p>
										<p class="field-name name name-thin">
											<label for="edit-menu-item-title-21">
												<?php echo __('Icon URL', 'framework'); ?>:<br>
												<input type="text" placeholder="<?php echo __('New item icon URL', 'framework'); ?>" id="edit-icon" value="${icon_url}" class="input-text" /><br>
											</label>
										</p>
										<p class="field-name name name-thin">
											<label for="edit-menu-item-title-21">
												<?php echo __('Icon width', 'framework'); ?>:<br>
												<input type="text" placeholder="<?php echo __('New item icon width', 'framework'); ?>" id="edit-icon-w" value="${icon_w}" class="input-text" /><br>
											</label>
										</p>
										<p class="field-name name name-thin">
											<label for="edit-menu-item-title-21">
												<?php echo __('Icon height', 'framework'); ?><br>
												<input type="text" placeholder="<?php echo __('New item icon height', 'framework'); ?>" id="edit-icon-h" value="${icon_h}" class="input-text" /><br>
											</label>
										</p>																														
																				
										<input type="button" value="<?php echo __('Edit Item', 'framework'); ?>" id="edit-item-btn" data-id="${id}" /><br>
										<div style="clear: both;"></div>

										<div class="menu-item-actions description-wide submitbox">
											<a class="item-delete submitdelete deletion" data-id="${id}" href="#"><?php echo __('Remove', 'framework'); ?></a>
										</div>
										<div style="clear: both;"></div>										
									</div>									
									<ul class="menu-item-transport"></ul>									
								</li>
							</script>			
						</div>
					</div>

					<div id="nav-menu-footer">
						<div class="major-publishing-actions">
							<div class="publishing-action">
								<!--<button class="button reset-menu"><?php echo __('Reset to default', 'framework'); ?></button>
								<a href="#" id="save-admin-bar-structure" class="button-primary ajax-save" style="float:right;"><?php echo __('Save Structure', 'framework'); ?></a><br/><br>-->
							</div>
						</div>
					</div>

			</div>
		</div>
	</div>

</div>
<div id="menu-management-liquid" class="nav-menus-php" style="padding-top:5px;">
	<div id="menu-management">
		<div class="menu-edit">

			<div id="nav-menu-header">
				<div id="submitpost" class="submitbox">
					<div class="major-publishing-actions"><br>
						<!--<button class="button reset-menu"><?php echo __('Reset to default', 'framework'); ?></button>-->
						<a href="#" id="save-login-branding-settings" class="button-primary ajax-save" style="float:right;"><?php echo __('Save Structure', 'framework'); ?></a><br/><br>								
					</div>
				</div>
			</div>

			<div id="post-body">
				<div id="post-body-content">
					<!-- LOGO SETTINGS -->
					<h3 class="container-title"><?php echo __('Logotype Settings', 'framework'); ?></h3>
					<table>
						<tr>
							<td><label for="logo"><?php echo __('Logo URL', 'framework'); ?>:</label></td>
							<td><input type="text" id="logo" class="input-text" value="<?php echo $background_url; ?>" /></td>
						</tr>
						<tr>
							<td><label for="backg-w"><?php echo __('Background width', 'framework'); ?>:</label></td>
							<td><input type="text" id="backg-w" class="input-text" value="<?php echo $background_size_w; ?>" /></td>
						</tr>
						<tr>
							<td><label for="backg-h"><?php echo __('Background height', 'framework'); ?>:</label></td>
							<td><input type="text" id="backg-h" class="input-text" value="<?php echo $background_size_h; ?>" /></td>
						</tr>
						<tr>
							<td><label for="backg-pos"><?php echo __('Background postition', 'framework'); ?>:</label></td>
							<td>
								<select id="backg-pos">
									<option value="left" <?php if ( $background_position == 'left' ) echo 'selected'; ?>><?php echo __('Left', 'framework'); ?></option>
									<option value="right" <?php if ( $background_position == 'right' ) echo 'selected'; ?>><?php echo __('Right', 'framework'); ?></option>
									<option value="center" <?php if ( $background_position == 'center' ) echo 'selected'; ?>><?php echo __('Center', 'framework'); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label for="logo-w"><?php echo __('Logo width', 'framework'); ?>:</label></td>
							<td><input type="text" id="logo-w" class="input-text" value="<?php echo $logo_w; ?>" /></td>
						</tr>
						<tr>
							<td><label for="logo-h"><?php echo __('Logo height', 'framework'); ?>:</label></td>
							<td><input type="text" id="logo-h" class="input-text" value="<?php echo $logo_h; ?>" /></td>
						</tr>
					</table>

					<!-- DEFAULT FIELDS SETTINGS -->
					<?php $is_settings = isset( $admin_custom_branding->custom_branding_options['default-profile-fields'] ); ?>
					<h3 class="container-title"><?php echo __('Default User Profile Fields', 'framework'); ?></h3>
					<input type="checkbox" id="field-first-name" class="checkbox default-profile-field" value="first_name" <?php if ( $is_settings && in_array( 'first_name', (array)$admin_custom_branding->custom_branding_options['default-profile-fields'] ) ) echo 'checked'; ?> />
					<label for="field-first-name"><?php echo __('First Name', 'framework'); ?></label><br>
					<input type="checkbox" id="field-last-name" class="checkbox default-profile-field" value="last_name" <?php if ( $is_settings && in_array( 'last_name', (array)$admin_custom_branding->custom_branding_options['default-profile-fields'] ) ) echo 'checked'; ?>/>
					<label for="field-last-name"><?php echo __('Last Name', 'framework'); ?></label><br>
					<input type="checkbox" id="field-website" class="checkbox default-profile-field" value="website" <?php if ( $is_settings && in_array( 'website', (array)$admin_custom_branding->custom_branding_options['default-profile-fields'] ) ) echo 'checked'; ?>/>
					<label for="field-website"><?php echo __('Website', 'framework'); ?></label><br>
					<input type="checkbox" id="field-AIM" class="checkbox default-profile-field" value="aim" <?php if ( $is_settings && in_array( 'aim', (array)$admin_custom_branding->custom_branding_options['default-profile-fields'] ) ) echo 'checked'; ?>/>
					<label for="field-AIM"><?php echo __('AIM', 'framework'); ?></label><br>
					<input type="checkbox" id="field-yahoo-im" class="checkbox default-profile-field" value="yahoo" <?php if ( $is_settings && in_array( 'yahoo', (array)$admin_custom_branding->custom_branding_options['default-profile-fields'] ) ) echo 'checked'; ?>/>
					<label for="field-yahoo-im"><?php echo __('Yahoo IM', 'framework'); ?></label><br>
					<input type="checkbox" id="field-jabber-google" class="checkbox default-profile-field" value="jabber" <?php if ( $is_settings && in_array( 'jabber', (array)$admin_custom_branding->custom_branding_options['default-profile-fields'] ) ) echo 'checked'; ?>/>
					<label for="field-jabber-google"><?php echo __('Jabber / Google Talk', 'framework'); ?></label><br>

					<!-- TODO: list of custom fields on registration page -->	
					<h3 class="container-title"><?php echo __('Custom User Profile Fields', 'framework'); ?></h3>
					<a href="#" id="add-custom-field" class="add-new-h2"><?php echo __('New Admin Page', 'framework'); ?></a><br><br>
					<table class="wp-list-table widefat">
						<thead>
							<tr>
								<!-- <th scope="col" id="cb" class="manage-column column-cb check-column" style="width: 0px;"></th> -->
								<th id="name" class="manage-column column-name"><?php echo __('Field Name', 'framework'); ?></th>
								<th id="description" class="manage-column column-description"><?php echo __('Field type', 'framework'); ?></th>
								<th id="field-alias" class="manage-column column-description"><?php echo __('Field alias', 'framework'); ?></th>
							</tr>
						</thead>
						<tbody id="the-list">
							<?php if ( isset( $fields )): ?>
								<?php foreach ($fields as $field_data) : ?>
									<tr class="active">
										<!-- <th class="check-column">
										</th> -->
										<td class="plugin-title">
											<b>
												<?php rf_e($field_data['title']); ?>
											</b> 
										</td>
										<td class="column-description">
											<?php echo $field_data['type']; ?>
										</td>
										<td class="column-alias">
											<?php echo $field_data['alias']; ?>
										</td>
									</tr>
								<?php endforeach; ?>
						<?php endif ?>
						</tbody>
					</table>
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

<div id="add-custom-field-dialog" style="display:none">
	<form method="post" action="<?php echo $this->self_url('login-register').'&action=add_new_custom_field'; ?>">
		<div class="settings-container">             
			<label class="settings-title"><?php echo __('Title', 'framework'); ?>:<br>
				<span class="settings-title-caption"></span>             
			</label>             
			<div class="settings-in">                  
				<input name="title" value="<?php echo __('Default field title', 'framework'); ?>" class="settings-input" type="text"><br>
				<span class="settings-field-caption"></span>              
			</div>          
		</div>
		<div class="settings-container">             
			<label class="settings-title"><?php echo __('Title caption', 'framework'); ?>:<br>
				<span class="settings-title-caption"></span>             
			</label>             
			<div class="settings-in">                  
				<input name="titleCaption" value="<?php echo __('Default field caption', 'framework'); ?>" class="settings-input" type="text"><br>
				<span class="settings-field-caption"></span>              
			</div>          
		</div>
		<div class="settings-container">             
			<label class="settings-title"><?php echo __('Alias', 'framework'); ?>:<br>
				<span class="settings-title-caption"></span>             
			</label>             
			<div class="settings-in">                  
				<input name="alias" value="<?php echo 'field-'.time(); ?>" class="settings-input" type="text"><br>
				<span class="settings-field-caption"></span>              
			</div>          
		</div>

		<select id="data-types-list" name="field-type-select"></select>
		<div id="add-custom-field-dialog-settings"></div>
		<input type="submit" class="button accept-changes button-primary" id="add-custom-field-button" value="<?php echo __('Add field', 'framework'); ?>">
	</form>
</div>
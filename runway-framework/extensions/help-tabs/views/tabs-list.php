<br><div>
	<a class="button" href="admin.php?page=help-tabs&navigation=new"><?php echo __('New tab', 'framework'); ?></a>
</div><br>

<table class="help-tabs wp-list-table widefat" cellspacing="0">
	<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column" style=""></th>
			<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Title', 'framework'); ?></th>
			<th scope="col" id="description" class="manage-column column-description" style=""><?php echo __('Content', 'framework'); ?></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column" style=""></th>
			<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Title', 'framework'); ?></th>
			<th scope="col" id="description" class="manage-column column-description" style=""><?php echo __('Content', 'framework'); ?></th>
		</tr>
	</tfoot>

	<tbody id="the-list">

		<?php if ( $help_tabs_admin->get_all_tabs() ) : ?>
			<?php foreach ( $help_tabs_admin->get_all_tabs() as $tab ) : ?>
			<tr>
				<th scope="row" class="check-column"></th>
				<td class="plugin-title">
					<strong><?php echo __(stripslashes( $tab['title'] ), 'framework'); ?></strong>
					<div class="row-actions-visible">
						<span class="edit"><a href="admin.php?page=help-tabs&navigation=edit&id=<?php echo $tab['id'] ?>" title="" class="edit"><?php echo __('Edit', 'framework'); ?></a> | </span>
						<span class="delete"><a href="admin.php?page=help-tabs&navigation=delete&id=<?php echo $tab['id'] ?>" title="" class="delete"><?php echo __('Delete', 'framework'); ?></a></span>
					</div>
				</td>
				<td class="column-description desc">
					<div class="plugin-description">
						<p><?php echo stripslashes( $tab['content'] ) ?></p>
					</div>

					<div class="second plugin-version-author-uri">
						<strong><?php echo __('Attached to', 'framework'); ?>: </strong>
						<?php if ( ! empty( $tab['attach_to'] ) && count( $tab['attach_to'] ) ) : ?>
							<?php foreach ( $tab['attach_to'] as $attach_link ) : ?>
								<a href="<?php echo $attach_link ?>"><?php echo preg_replace( '/[0-9$]/', '', $translate_Link_To_Name[$attach_link] ); ?></a>
							<?php endforeach ?>
						<?php else: ?>
							<?php echo __('None', 'framework'); ?>
						<?php endif ?>
					</div>
				</td>
			</tr>
			<?php endforeach; ?>

		<?php else : ?><tr><td colspan="3" style="width: 100%"><?php echo __('Have no tabs', 'framework'); ?></td></tr><?php endif ?>

	</tbody>
</table>

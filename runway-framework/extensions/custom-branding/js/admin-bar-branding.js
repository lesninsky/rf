jQuery.noConflict();
(function($) {
  $(function() {
   	// Open add item dialog
	$('#add-new').click(function(e){
		$('#add-new').val(translations_js.edit_item);

		$('#add-new-dialog').dialog({
			'title' : translations_js.add_new_item,
			'modal' : true
		});
	});

	// aad new item
	$('#add-item').click(function(e){
		$('#add-new-dialog').dialog('close');
		var data = {
			action: 'add_adminbar_item',
			title: $('input#title').val(),
			href: $('input#href').val(),
			icon_url: $('input#icon').val(),
			icon_w: $('input#icon-w').val(),
			icon_h: $('input#icon-h').val(),
			id: $('input#new-item-id').val(),
			parent: $('input#parent').val()
		};

		if(data.parent == ''){
			$('#menu-item-tmpl').tmpl(data).appendTo('#menu-to-edit');			
		}
		else{			
			// $('#menu-item-tmpl').tmpl(data).appendTo('#'+data.parent).removeClass('menu-item-depth-0').addClass('menu-item-depth-1');
		}

		$('input#title').val('');
		$('input#href').val('');
		$('input#icon').val('');
		$('input#new-item-id').val('');
		$('input#parent').val('');

		$.post(ajaxurl, data, function(response) {});
	});

	// use deafault menu flag
	$('#use-default').change(function(){
		var data = {
			action: 'adminbar_use_default'
		};

		if($('#use-default').prop('checked')){
			data.use_default = 1;
			$.post(ajaxurl, data, function(response) {
				console.log(response);
			});
		}
		else{
			data.use_default = 0;
			$.post(ajaxurl, data, function(response) {
				console.log(response);
			});
		}
	});

	// Delete item
	$('.item-delete').live('click', function(e){
		var item = $(this).parent().parent().find(this).data('id');
		var data = {
			action: 'adminbar_del_item',
			item_id: item
		};

		$.post(ajaxurl, data, function(response) {});
		$('#'+item).remove();
	});

	// Edit item
	$('#edit-item').live('click', function(e){
		parent = $(this).parent().parent().parent().parent();
		settings = parent.find('.edit-item-dialog#'+$(this).data('id')); 
		display = parent.find('.edit-item-dialog#'+$(this).data('id')).css('display');

		if(display == 'none'){
			parent.addClass('edit-now');
			settings.slideDown();
		}
		else{
			parent.addClass('edit-now');
			settings.slideUp();
		}
	});

	$('#edit-item-btn').live('click', function(){
		item = $(this).parent().parent();
		var data = {
			action: 'add_adminbar_item',
			title: item.find('input#edit-title').val(),
			href: item.find('input#edit-href').val(),
			icon_url: item.find('input#edit-icon').val(),
			icon_w: item.find('input#edit-icon-w').val(),
			icon_h: item.find('input#edit-icon-h').val(),
			id: item.find(this).data('id'),
			parent:	item.find(this).parent().parent().data('parent')
		};				

		$.post(ajaxurl, data, function(response) {
			// location.reload();
			console.log(response);
		});
		
		item.find('span.item-title').text(item.find('input#edit-title').val());
		item.data('title',item.find('input#edit-title').val());
		item.data('href',item.find('input#edit-href').val());
		item.data('icon',item.find('input#edit-icon').val());
		item.data('icon-w',item.find('input#edit-icon-w').val());
		item.data('icon-h',	item.find('input#edit-icon-h').val());
		
	});

	var data = {
		action: 'get_admin_bar_items'
	};
	if(getRequest('navigation') == null){
		$.post(ajaxurl, data, function(dataItems) {
			var items = [];
			dataItems = $.parseJSON(dataItems);
			for(obj in dataItems){
				if(dataItems[obj].parent == ''){
					$('#menu-item-tmpl').tmpl(dataItems[obj]).appendTo('#menu-to-edit');				
				}
				else{
					$('#menu-item-tmpl').tmpl(dataItems[obj]).appendTo('#'+dataItems[obj].parent).removeClass('menu-item-depth-0').addClass('menu-item-depth-1');
				}
			}
		});			
	}

	$( "#menu-to-edit" ).sortable();
	$( "#menu-to-edit" ).disableSelection();

	$(".new-item").draggable({
		connectToSortable: '#menu-to-edit',
		helper: 'clone'
	});



	$("#save-admin-bar-structure").click(function(){
		var adminBar = [];
		$('.menu-item').each(function(i){
			if( $(this).data('title') != '' &&
				$(this).data('hreff') != '' &&
				$(this).data('id') != ''){

				var itemData = {
					title: $(this).data('title'),
					href: $(this).data('href'),
					icon_url: $(this).data('icon'),
					icon_w: $(this).data('icon_w'),
					icon_h: $(this).data('icon_h'),
					id: $(this).data('id'),		
					parent:	$(this).data('parent'),	
				};			
				adminBar.push(itemData);
			}
		});		
		var data = {
			action: 'update_admin_bar_menu',
			admin_bar: adminBar
		};

		$.post(ajaxurl,data, function(response){
			location.reload();
		});		
	}); 

	function getRequest(name){
		if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
		  return decodeURIComponent(name[1]);
	}

  });
})(jQuery);
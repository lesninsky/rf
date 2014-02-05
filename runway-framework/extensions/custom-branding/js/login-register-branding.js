jQuery.noConflict();
(function($) {
  $(function() {  

  	function createSettingsDiv(tmpl){
  		tmplId = tmpl.attr('id');
  		settings = {
  			id: 'settings-container',
  			class: 'custom-fields-settings-container'
  		};
  		return $('<div>', settings)
  	}

  	function createCustomFieldDiv(settings){
  		return $('<div>', settings);
  	}

  	tmpls = $('script[type="text/x-jquery-tmpl"]');
  	data = {
  		required: '',
  		validation: '',
  		ReferenceError: '',
  		values: '',
  		image_size: ''
  	};
  	for(tmpl in tmpls){
  		if($(tmpls[tmpl]).attr('id') != undefined && $(tmpls[tmpl]).length == 1){
	  		name = $(tmpls[tmpl]).attr('id');
	  		re = new RegExp("-",'g')
	  		name = name.replace(re, ' ');
	  		name = name.charAt(0).toUpperCase() + name.slice(1);

	  		settings = {
	  			value: $(tmpls[tmpl]).attr('id'),
	  			text: name
	  		};
	  		$('select#data-types-list').append($('<option>', settings));
  		}
  	}

	selected = $('select#data-types-list').find(':selected').val();
	tmpl = $('script#'+selected);
	if(tmpl.attr('id') != undefined){
		settingsContainer = createSettingsDiv(tmpl);
		settingsContainer.appendTo('#add-custom-field-dialog-settings')
		$(tmpl).tmpl(data).appendTo('#'+settingsContainer.attr('id'));
	}

  	$('select#data-types-list').change(function(){
  		data = {
	  		required: '',
	  		validation: '',
	  		ReferenceError: '',
	  		values: '',
	  		image_size: ''
	  	};

	  	$('#settings-container').remove();
  		selected = $(this).find(':selected').val();
  		tmpl = $('script#'+selected);
  		settingsContainer = createSettingsDiv(tmpl);
  		settingsContainer.appendTo('#add-custom-field-dialog-settings')
  		$(tmpl).tmpl(data).appendTo('#'+settingsContainer.attr('id'));

  	});

  	$('#add-custom-field').click(function(){
  		$('#add-custom-field-dialog').dialog({
            open: function(event, ui) {
                $('#adminmenuwrap').css({'z-index':0});
            },
            close: function(event, ui) {
                $('#adminmenuwrap').css({'z-index':'auto'});
            },		  			
  			title: 'Add new custom field',
            resizable: false,
            draggable: false,  			
  			modal: true,
  			width: 500
  		});
  	});

  	$('#save-login-branding-settings').click(function(e){
  		var data = {
			action: 'set_login_page_logo_settings',
			logo_url: $('input#logo').val(),
			backg_w: $('input#backg-w').val(),
			backg_h: $('input#backg-h').val(),
			backg_pos: $("#backg-pos option:selected").val(),
			logo_w: $('input#logo-w').val(),
			logo_h: $('input#logo-h').val(),
		}

		$.post(ajaxurl, data, function(response) {
			console.log(response);
			location.reload();
		});

  	});	

	// Add/reset default fields (Work)
	$('.default-profile-field').change(function(){
		var data = {
			action: 'add_reset_register_fields',
		}
		console.log('!!!!!!!!!!!');

		if($(this).prop('checked')){
			data.add = true;
			data.field = $(this).val();
			$.post(ajaxurl, data, function(response) {
				console.log(response);
			});
		}
		else{
			data.field = $(this).val();
			data.reset = true;
			$.post(ajaxurl, data, function(response) {
				console.log(response);
			});
		}
	});

  });
})(jQuery);
jQuery.noConflict();
(function($) {
  $(function() {
    // more code using $ as alias to jQuery
	$('#set-new-footer').click(function(){
		var data = {
			action: 'set_new_footer',
			footer: $('#custom-foter').val()
		};
		console.log(data);	
		$.post(ajaxurl, data, function(response){
			console.log(response);	
			location.reload();				
		});
	});
  });
})(jQuery);
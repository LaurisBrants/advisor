jQuery('.advisor-fieldset').on('change',function(){
  var current =  jQuery(this).data('order');
  var next = current+1;
  jQuery(this).find('.default-select').hide();
  if(jQuery('.weight').val()!=0){
    ajax_run();
  }

  if(current != 6){
     jQuery('.set_'+next).prop("disabled", false);   
  }
  
});

function ajax_run(){
		event.preventDefault();
		var weight = jQuery('.weight').val();
		var height = jQuery('.height').val();
		var result = weight*height;
		var gender = jQuery('.gender').val();
		var skill = jQuery('.skill').val();
		var size = jQuery('.size').val();
		var category = jQuery('.category').val();
		jQuery('#call_changer').html('<img src="../img/Loader.gif">');
		jQuery.ajax({
		type: 'POST',
        url: '/wp-admin/admin-ajax.php', 
        data: {
            'action':'advAjaxRequestHandler',
            'result' : result,
            'gender' : gender,
            'skill' : skill,
            'size' : size,
            'category' : category,
        },
        success:function(data) {
            console.log(data);
            jQuery('#call_changer').html(data);
        },  
        error: function(errorThrown){
            console.log(errorThrown);
        }
    });   
	}

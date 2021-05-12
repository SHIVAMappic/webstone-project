jQuery(document).ready(function(){
	
	
	jQuery('#aj-btn').on('click',function(){alert('hi');
		var ajax_url = ajaxurl_object.ajaxurl;
		var data = {'action':'my_action','name':'shivam  chouhan','email':'shivam@gmail.com'};
		jQuery.post(ajax_url,data,function(response){
			/*var data = jQuery.parseJSON(response);*/
			console.log(response);
			var data = JSON.parse(response);
			console.log(data.name);
			/*alert(data.name);*/
		});
		
		
	});
});
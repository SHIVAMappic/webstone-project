jQuery(function(){
	
	/*alert('hi');*/
	
	jQuery('#editor-btn').on('click',function(){
		
		alert('hi');
	});
	
	jQuery('#uploadbtn').on('click',function(){
		
	
		var images = wp.media({
			'title':"Upload Images",
			'multiple':false
			
		}).open().on('select',function(e){
			
			var uploadImages = images.state().get("selection").first();
			
			console.log(uploadImages);
			var selectImages = uploadImages.toJSON();
			console.log(selectImages);
			
			jQuery('#getimage').attr('src',selectImages.url);
		});
	});
	
	// upload multiple  images
	
		/*jQuery('#uploadmultiplebtn').on('click',function(){
		
	
				var images = wp.media({
					'title':"Upload Multiple Images",
					'multiple':true
					
				}).open().on('select',function(e){
					
					var uploadImages = images.state().get("selection");
					
					
					var selectImages = uploadImages;
					
					selectImages.map(function(image){
						console.log(image.toJSON());
						var  itemDetails = image.toJSON();
						jQuery('#imagebox').append("<img  src='"+  itemDetails.url +"' style='height:50px;width:50px;'>");
					});
					/*console.log(selectImages);
					
					jQuery('#getimage').attr('src',selectImages.url);*/
				/*});
	});*/
	
	
	
	
	
	
	
	jQuery('#uploadmultiplebtn').on('click',function(){
		
	
				var images = wp.media({
					'title':"Upload Multiple Images",
					'multiple':true
					
				}).open().on('select',function(e){
					
					var uploadImages = images.state().get("selection");
					
					
					var selectImages = uploadImages.toJSON();
					
					jQuery.each(selectImages,function(index,image){
						
						console.log("image url :"+ image.url + "and Title:"+image.title );
					});
					
					/*selectImages.map(function(image){
						console.log(image.toJSON());
						var  itemDetails = image.toJSON();
						jQuery('#imagebox').append("<img  src='"+  itemDetails.url +"' style='height:50px;width:50px;'>");
					});
					/*console.log(selectImages);
					
					jQuery('#getimage').attr('src',selectImages.url);*/
				});
	});
});
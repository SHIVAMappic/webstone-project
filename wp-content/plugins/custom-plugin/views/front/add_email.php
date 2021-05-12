<div class="card">
   <div class="card-body"  style="padding:20px;">
   
   
   <form action="" method="post"  id="add-email-form">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control"  name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
 
   <input type="hidden"  name="add-email-form" value="add-email-form"/>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div id="message-box"></div>


    
   </div>
</div>
<script>
   jQuery(function(){
   	jQuery('#add-email-form').on('submit',function(e){
   		e.preventDefault();	
   			var formData= new FormData(this);
   			formData.append('action','checkEmail');
   			jQuery.ajax({
   				dataType:"json",
   				type:"post",
   				url:"<?php echo admin_url('admin-ajax.php');?>",
   				data:formData,				
   				contentType:false,
   				processData:false,
   				cache:false,
   				success:function(data){
   					if(data.success){
   						//alert(data.message);	
              jQuery('#message-box').html('<h3  style="color:green;">'+data.message+'</h3>');
   						jQuery('#add-email-form').trigger('reset');
   					}else{
              jQuery('#message-box').html('<h3  style="color:red;">'+data.message+'</h3>');
   					//	alert(data.message);							
   					}
   				}
   			});		
   	});
   });
</script>
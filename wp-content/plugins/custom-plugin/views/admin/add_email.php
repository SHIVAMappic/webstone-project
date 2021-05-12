

<?php
if(isset($_GET['action'])&&isset($_GET['userid'])){
  $userid = $_GET['userid'];
  $action = $_GET['action'];
} else{
  $userid = '';
  $_GET['action'] = 'add';
}
$user = get_user_by('id', $_GET['userid']);
if($user){
  $useremail = $user->user_email;
}else{
  $useremail = '';
}

?>
<div class="card">
   <div class="card-body"  style="padding:20px;">
   
   
   <form action="" method="post"  id="add-email-form">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control"  name="email"  id="exampleInputEmail1" aria-describedby="emailHelp"   value="<?php echo $useremail;?> "  placeholder="Enter email">
   
  </div>
   <input type="hidden"  name="userid" value="<?php echo $userid;?>"/>
   <input type="hidden"  name="useraction" value="<?php echo $action;?>"/>
  
 
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
   			formData.append('action','EmailRegister');
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
              jQuery('#message-box').html('<h5  style="color:green;">'+data.message+'</h5>');   											
   						jQuery('#add-email-form').trigger('reset');
   					}else{
               jQuery('#message-box').html('<h5  style="color:red;">'+data.message+'</h5>');     

   													
   					}
   				}
   			});		
   	});
   });
</script>
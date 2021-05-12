<div class="container">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Email Adress</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $users = get_users(array('role_in'=>array('subscriber')));

  if(count($users)>0){
	  foreach($users as $user){
       $user_role=get_userdata($user->id);
   
       if($user_role->roles[0] == 'subscriber'){
		  ?>
		  <tr  id="row<?php echo $user->id;?>">
		  <th scope="row"><?php echo  $user->id;?></th>
		  <td><?php echo $user->user_email;?></td>
		  <td>
			<a href="admin.php?page=add-membership-email&action=edit&userid=<?php echo $user->id;?>"  class="btn btn-success">Edit</a>
			<a href="javascript:void(0)"  data-id="<?php echo $user->id;?>" class="btn btn-danger  delete-email">Delete</a>			
		  </td>
	  
		</tr>
	<?php  }
   }
  }
  ?>
    
   
  </tbody>
</table>
</div>


<script>
   jQuery(function(){	  
   	jQuery('.delete-email').on('click',function(e){  
		var userid = jQuery(this).attr('data-id'); 	
		if(confirm("Are you sure want to delete this record")){	
   			jQuery.ajax({
   				dataType:"json",
   				type:"post",
   				url:"<?php echo admin_url('admin-ajax.php');?>",
   				data:{userid:userid,action:'deleteEmail'},				
   				
   				success:function(data){
   					if(data.success){
   						alert(data.message);
						jQuery('#row'+userid).hide();						
   						//jQuery('#add-email-form').trigger('reset');
   					}else{
   						alert(data.message);							
   					}
   				}
   			});		
		}
   	});
   });
</script>
<?php 
include 'db_connection.php';
$ID = isset($_GET['LINE_ID']) ? $_GET['LINE_ID'] : '';
$query = $conn->prepare("SELECT * FROM Aquila_SC3_users WHERE LINE_ID = ?");
$query->execute([$ID]);
$USER = $query->fetch(PDO::FETCH_ASSOC);
 ?>


 <div class="container-fluid">
 	<div class="card">
 		<div class="card card-header">
 			<div class="row">
 			 <button class="btn btn-sm btn-secondary col-1 back-button"><i class='bx bx-left-arrow-alt'></i></button>	
 			</div>
 		</div>
 		<div class="card card-body">
 		<div class="row">
<form id="form-data" method="POST" name="frm_upload">
	<input type="hidden"  name="LINE_ID" value="<?php echo isset($USER['LINE_ID']) ? $USER['LINE_ID']: '0'; ?>"  >
	<div class="row mb-3">
  <div class="form-group col-md-6 col-sm-12">
    <label for="exampleFormControlSelect2">Site</label>
    <select name="SITEID"  class="form-control" id="exampleFormControlSelect2">
    		<option value="0"> Select Site</option>
    	<?php 
$query = "select SITEID, SITE_CODE from [dbo].[Aquila_Sites] where company_id='12'";
foreach ($conn->query($query) as $row){
	// code...?>

	 <option value="<?php echo $row['SITEID'] ?>" <?php echo (isset($USER['SITE_ID']) && $USER['SITE_ID'] == $row['SITEID']) ? 'selected' : ''; ?>><?php echo $row['SITE_CODE'] ?></option>

	<?php
}
    	 ?>
     
    </select>
  </div>

    <div class="form-group col-md-6 col-sm-12 mb-3">
    <label for="exampleFormControlSelect2">Role</label>
    <select name="USER_ROLE"  class="form-control" id="exampleFormControlSelect2">
    	<option value="0"> Select Role</option>
      <option <?php echo (isset($USER['USER_LOGIN_ID']) && "Master Admin" == $USER['User_Role']) ? 'selected' : ''; ?>>Master Admin</option>
      <option <?php echo (isset($USER['USER_LOGIN_ID']) && "Admin" == $USER['User_Role']) ? 'selected' : ''; ?>>Admin</option>
      <option <?php echo (isset($USER['USER_LOGIN_ID']) && "User" == $USER['User_Role']) ? 'selected' : ''; ?>>User</option>
      <option <?php echo (isset($USER['USER_LOGIN_ID']) && "SFA USER" == $USER['User_Role']) ? 'selected' : ''; ?>>SFA USER</option>
    </select>
  </div>
   </div>
  <div class="form-group mb-3">
    <label for="exampleFormControlInput1">User Login</label>
    <input name="USER_LOGIN_ID" type="text" class="form-control form-control-lg" value="<?php echo isset($USER['USER_LOGIN_ID']) ? $USER['USER_LOGIN_ID']: ''; ?>" id="exampleFormControlInput1" required placeholder="User Login">
  </div>
  <div class="row">
  	    <div class="form-group col-md-6 col-sm-12 mb-3">
    <label for="exampleFormControlInput1">User Password</label>
    <input value="<?php echo isset($USER['USER_PASS']) ? $USER['USER_PASS']: ''; ?>"  name="USER_PASS" type="text" required class="form-control form-control-lg" id="exampleFormControlInput1" placeholder="User Login">
  </div>
  <div class="form-group col-md-6 col-sm-12 mb-3">
    <label for="exampleFormControlInput1">Re-type Password</label>
    <input type="text" required class="form-control form-control-lg" id="exampleFormControlInput1" placeholder="User Login">
  </div>
  </div>



  <div class="form-group"> 
<input type="submit" class="btn btn-primary " style="float:right;" id="btn_submit" name="btn_submit" value="Submit">
  </div>
</form>

 		</div>
 		</div>

 	</div>
 </div>

<script type="text/javascript">
	$(".back-button").click(function(event) {
    event.preventDefault(); // Prevent the default anchor link behavior
    window.history.back();
});
    $(document).ready(function(){
        $("#form-data").submit(function(e){
            e.preventDefault();
            $.ajax({
            	type:"POST",
            	url:"query/add_newuser.php",
            	data: $(this).serialize(),
            	success: function (response) {

               showNotification("Saved", "The user has been saved!"+ response)
            },
            error: function (xhr, status, error) {
                // Handle AJAX errors
                 showNotification("Something Wrong!", xhr.responseText)    
            }    
            })   

        });
    });
</script>

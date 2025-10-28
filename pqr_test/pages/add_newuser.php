<?php 
include 'db_connection.php';

$ID = isset($_GET['LINE_ID']) ? $_GET['LINE_ID'] : '';
$query = $conn->prepare("SELECT * FROM Aquila_PQR_User WHERE ID = ?");
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
	<input type="hidden"  name="ID" value="<?php echo isset($USER['ID']) ? $USER['ID']: '0'; ?>"  >
	<div class="row mb-3">
      <div class="form-group col-md-6 col-sm-12">
    <label for="exampleFormControlSelect2">Principal</label>
    <select name="COMPANY_ID" id="COMPANY_ID" required class="form-control SEL" >
        <option value="0"> Select Principal</option>
      <?php 
$query = "select ID, CODE from [dbo].[Aquila_COMPANY]  WHERE STATUS = 'ACTIVE' group by ID, CODE";
foreach ($conn->query($query) as $row){
 ?>
   <option value="<?php echo $row['ID'] ?>" ><?php echo $row['CODE'] ?></option>
  <?php
}
       ?>
     
    </select>
  </div>
  <div class="form-group col-md-6 col-sm-12">
    <label for="exampleFormControlSelect2">Site</label>
    <select name="SITE_ID[]"  id="SITE_ID" disabled multiple required class="form-control SEL" >


     <div id="option_list"></div>
    </select>
  </div>

    <div class="form-group col-md-6 col-sm-12 mb-3">
    <label for="exampleFormControlSelect2">Role</label>
   <select name="ROLE" class="form-control" id="exampleFormControlSelect2">
  <option value="0">Select Role</option>
  <option value="Admin" <?php echo (isset($USER['ID']) && $USER['ROLE'] == "Admin") ? 'selected' : ''; ?>>Admin</option>
  <option value="GSM" <?php echo (isset($USER['ID']) && $USER['ROLE'] == "GSM") ? 'selected' : ''; ?>>GSM</option>
  <option value="OM" <?php echo (isset($USER['ID']) && $USER['ROLE'] == "OM") ? 'selected' : ''; ?>>OM</option>
  <option value="DSS" <?php echo (isset($USER['ID']) && $USER['ROLE'] == "DSS") ? 'selected' : ''; ?>>DSS</option>
</select>
  </div>
    <div class="form-group col-md-6 col-sm-12 mb-3">
    <label for="exampleFormControlInput1">Fullname</label>
    <input type="text" name="FULLNAME"  value="<?php echo isset($USER['FULLNAME']) ? $USER['FULLNAME']: ''; ?>"  required class="form-control form-control-lg"  placeholder="Fullname">
  </div>

   </div>
 
  <div class="row">
       <div class="form-group mb-3 col-md-6 col-sm-12">
    <label for="exampleFormControlInput1">Username</label>
    <input name="USERNAME" type="text" class="form-control form-control-lg" value="<?php echo isset($USER['USERNAME']) ? $USER['USERNAME']: ''; ?>" id="exampleFormControlInput1" required placeholder="User Login">
  </div>
  	    <div class="form-group col-md-6 col-sm-12 mb-3">
    <label for="exampleFormControlInput1">User Password</label>
    <input value="<?php echo isset($USER['PASSWORD']) ? $USER['PASSWORD']: ''; ?>"  name="PASSWORD" type="text" required class="form-control form-control-lg" id="exampleFormControlInput1" placeholder="User Login">
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
            alert(response)
             //  showNotification("Saved", "The user has been saved!"+ response)
            },
            error: function (xhr, status, error) {
                // Handle AJAX errors
              alert(xhr.responseText)
                // showNotification("Something Wrong!", xhr.responseText)    
            }    
            })   

        });


$("#COMPANY_ID").change(function(){
  var company_id = $(this).val();
 
  $.ajax({
    url:'query/select_user_comp.php',
    method:'POST',
    data:{comp:company_id},
    success:function(data){      
      $("#SITE_ID").html(data)
      $("#SITE_ID").removeAttr('disabled')
    }
  })
})

    });
</script>

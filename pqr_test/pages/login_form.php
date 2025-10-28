<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 360px;
            width: 60vh;
            padding: 15px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center mb-1">Login</h2>
                  <div class="d-flex justify-content-center mb-1">
            <img src="../images/pqr_icon.png" style="width: 130px; height: 100px;">
        </div>
        <form id="form-data" method="POST">
            <div class="mb-3">
                <label for="USERID" class="form-label">User Id</label>
                <input type="text" class="form-control" id="USERID" name="userid" placeholder="Enter Userid">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary w-100" id="btn_submit" >  <span class="spinner-border spinner-border-sm visually-hidden" role="status" aria-hidden="true" ></span>Login</button>
              <a href="../../" class="btn btn-secondary w-100 mt-2" id="btn_back" >Back</a>
            <div class="alert text-center alert-danger mt-2 visually-hidden" role="alert">
            	Login Failed!
            </div>
        </form>
    </div>
</body>
</html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
$("#form-data").submit(function(e) {
    e.preventDefault(); // Prevent the default form submission behavior

    // Show the spinner and disable the submit button
    $(".spinner-border").removeClass("visually-hidden");
    $("#btn_submit").attr("disabled", true);

    // Perform the AJAX request
    $.ajax({
        url: '../query/login.php', // Replace with your actual URL
        type: 'POST',
        data: $(this).serialize(), // Serialize the form data
        success: function(formdata) {
        	if (formdata == "1") {
			location.href = "../index.php";
        	}
        	else{

			$(".alert").removeClass("visually-hidden");	
			setInterval(function() {   
			$(".alert").addClass("visually-hidden");	
			$(".spinner-border").addClass("visually-hidden");
            $("#btn_submit").attr("disabled", false);}, 3000);

        	}
            // Handle the success response
            
            // Hide the spinner and re-enable the submit button
        },
        error: function(err) {
            // Handle the error response
            alert(err);
            // Hide the spinner and re-enable the submit button
           
        }
    });
});

</script>

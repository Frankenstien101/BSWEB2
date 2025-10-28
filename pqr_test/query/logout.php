<?php 
session_start();
session_destroy();
//unset($_SESSION['user_id']);
echo header('Location:../pages/login_form.php'); 

?>
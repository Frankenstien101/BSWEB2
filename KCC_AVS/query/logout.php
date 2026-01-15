<?php
include '../db_connection.php';

session_start();
insert_logs($conn, $_SESSION['user_id'], "Logout Successful");
session_destroy();
//unset($_SESSION['user_id']);
echo header('Location:../pages/login_form.php');

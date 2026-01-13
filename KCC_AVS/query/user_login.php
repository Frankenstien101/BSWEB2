<?php
include 'db_connection.php';
if (isset($_SESSION['user_id'])) {
    $ID = $_SESSION['user_id'];
    $query = $conn->prepare("SELECT * FROM Aquila_SC3_users WHERE USER_LOGIN_ID = ?");
    $query->execute([$ID]);
    $USER = $query->fetch(PDO::FETCH_ASSOC);
} else if (!isset($_SESSION['user_id'])) {
    header('Location:../pqr_test/pages/login_form.php');
}

<?php
include '../db_connection.php';
session_start();
$LONGIN_USERNAME = $_POST['login_username'];
$LOGIN_PASSWORD = $_POST['password'];

$query = "SELECT * FROM KAVS_USERS WHERE LOGIN_USERNAME = :userid AND PASSWORD = :password and USER_SOURCE = 'PORTAL'";
$stmt = $conn->prepare($query);
$stmt->bindParam(':userid', $LONGIN_USERNAME);
$stmt->bindParam(':password', $LOGIN_PASSWORD);
$stmt->execute();
// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$is_inactive = $result['STATUS'] == 0;
if ($is_inactive) {
    echo "2"; // User is inactive
    exit;
}
if ($result) {
    $_SESSION['role'] = $result["ACCOUNT_TYPE"];
    $_SESSION['fullname'] = $result["FULLNAME"];
    $_SESSION['user_id'] = $result["USERNAME"];
    $_SESSION['id'] = $result["ID"];
    $_SESSION['login_username'] = $result["LOGIN_USERNAME"];
    insert_logs($conn, $result["USERNAME"], "Login Successful");
    echo "1";
} else {
    session_destroy();
    echo "0"; // Authentication failed
}

<?php
include '../db_connection.php';
extract($_POST);
session_start();
// Extracting POST data
$userid = $_POST['userid'];
$password = $_POST['password'];

try {
    // Prepare and execute the query using a prepared statement
    $query = "SELECT * FROM [dbo].[Aquila_SC3_users] WHERE COMPANY_ID='5' AND USER_LOGIN_ID = :userid AND USER_PASS = :password AND USER_ROLE != 'SFA USER'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userid', $userid);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
    	$_SESSION['user_id'] = $result["USER_LOGIN_ID"];
            $_SESSION['id'] = $result["LINE_ID"];
        echo "1"; // User authenticated successfully
    } else {
    	session_destroy();
        echo "0"; // Authentication failed
    }
} catch (PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}
?>

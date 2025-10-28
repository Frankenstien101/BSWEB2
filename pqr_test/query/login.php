<?php
include '../db_connection.php';
extract($_POST);
session_start();
// Extracting POST data
$userid = $_POST['userid'];
$password = $_POST['password'];

try {
    // Prepare and execute the query using a prepared statement
    $query = "SELECT * FROM Aquila_PQR_User WHERE USERNAME = :userid AND PASSWORD = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userid', $userid);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $_SESSION['role'] = $result["ROLE"];
        $_SESSION['fullname'] = $result["FULLNAME"];
    	$_SESSION['user_id'] = $result["USERNAME"];
        $_SESSION['id'] = $result["ID"];
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

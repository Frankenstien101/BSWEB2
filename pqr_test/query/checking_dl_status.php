<?php 
include '../db_connection.php';

$request_id = $_POST['request_id'];

$query = $conn->prepare("SELECT * FROM [dbo].[All_Report_Server] WHERE REQUEST_ID = ?");
$query->execute([$request_id]);

$data = $query->fetch(PDO::FETCH_ASSOC); // fetch ONE row only

echo json_encode($data);
?>

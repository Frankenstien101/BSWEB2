<?php
session_start();
include '../../DB/dbcon.php';

header('Content-Type: application/json');

if (isset($_GET['store_id']) && !empty($_GET['store_id'])) {
    $store_id = trim($_GET['store_id']);
    
    // Check if store ID exists in customer master
    $sql = "SELECT [CODE], [NAME], [COMPANY_ID], [BRANCH] FROM [dbo].[Dash_Customer_Master] WHERE [CODE] = :store_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':store_id' => $store_id]);
    $customerData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($customerData) {
        // Check if store ID is already registered in OK_Users
        $sql2 = "SELECT [USERNAME] FROM [dbo].[OK_Users] WHERE [USERNAME] = :store_id";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([':store_id' => $store_id]);
        $registeredData = $stmt2->fetch(PDO::FETCH_ASSOC);
        
        if ($registeredData) {
            echo json_encode(['exists' => false, 'message' => 'Store ID already registered', 'status' => 'registered']);
        } else {
            echo json_encode(['exists' => true, 'message' => 'Store ID found in master: ' . $customerData['NAME'], 'status' => 'available']);
        $_SESSION['company'] = $customerData['COMPANY_ID'];
        $_SESSION['branch'] = $customerData['BRANCH'];
        }
    } else {
        echo json_encode(['exists' => false, 'message' => 'Store ID not found in customer master', 'status' => 'not_found']);
    }
} else {
    echo json_encode(['exists' => false, 'message' => 'No store ID provided', 'status' => 'error']);

}
?>
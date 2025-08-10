<?php
session_start();
include __DIR__ . '/../../../DB/dbcon.php';


//PRODUCT MASTER REPORT
if (isset($_GET['action']) && $_GET['action'] === 'loaditems') {
    header('Content-Type: application/json');
    
    // Validate database connection
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit(); 
    }   

    try {
        // Validate dateFrom
        $companyId = $_GET['company'];

        // Prepare SQL - fix typo in :datefrom param and remove :status binding
      $sql = "SELECT * FROM Aquila_ProductMaster 
        WHERE  COMPANY_ID = :companyid
        ORDER BY ITEM_TIER ASC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':companyid', $companyId);
$stmt->execute();


        if (!$stmt->execute()) {
            throw new Exception("Query execution failed");
        }

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($items ?: []);
        
        } catch (PDOException $e) {
        echo json_encode([
            'error' => 'Database error',
            'message' => $e->getMessage()
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'error' => 'Application error',
            'message' => $e->getMessage()
        ]);
    }
    exit();
}
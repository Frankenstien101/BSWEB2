<?php

session_start();
include __DIR__ . '/../../../DB/dbcon.php';


// 1️⃣ Get PO number count
if (isset($_GET['action']) && $_GET['action'] === 'get_new_po_count') {
    $companyId = $_GET['company'];
    $siteId = $_GET['siteid'];

    $sql = "SELECT COUNT(*) + 1 AS total
            FROM Aquila_PO_Transaction
            WHERE SITE_ID = :Site_ID AND COMPANY_ID = :companyid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Site_ID', $siteId);
    $stmt->bindParam(':companyid', $companyId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // 3️⃣ Return JSON with both count & pricing
    echo json_encode([
        'count'   => $row['total'],
        'pricing' => $pricingRow['PRICING']
    ]);
    exit();
}



// LOAD SKUS 


if (isset($_GET['action']) && $_GET['action'] === 'loadskus') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
             $companyId = $_GET['company'];
                $siteid = $_GET['siteid'];
                  $warehousecode = $_GET['warehousecode'];


        $sql = "SELECT * FROM Aquila_Inventory_Master 
                WHERE COMPANY_ID = :companyid 
                AND SITE_ID = :siteid
                ORDER BY DESCRIPTION ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
        $stmt->bindParam(':siteid', $siteid);
        $stmt->bindParam(':warehousecode', $warehousecode);
        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($items ?: []);
        
    } catch (PDOException $e) {
   
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
  
    } catch (Exception $e) {
   
        echo json_encode(['error' => 'Application error', 'message' => $e->getMessage()]);
   
    }
    exit();
}

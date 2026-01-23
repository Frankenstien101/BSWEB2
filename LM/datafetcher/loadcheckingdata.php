<?php

session_start();
include __DIR__ . '/../../DB/dbcon.php';

// PRODUCT MASTER REPORT
if (isset($_GET['action']) && $_GET['action'] === 'loaddevice') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];

        $sql = "SELECT * FROM BS_Device
                WHERE COMPANY_ID = :companyid
                ORDER BY SITE_ID ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
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
<?php
session_start();
include __DIR__ . '/../../../DB/dbcon.php';

if (isset($_GET['action']) && $_GET['action'] === 'loadtransactions') {
    header('Content-Type: application/json');
    
    // Validate database connection
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit(); 
    }   


      if (!isset($conn) || !($conn instanceof PDO)) {
            throw new Exception("Database connection failed");
        }

    try {
        // Validate dateFrom
        if (!isset($_GET['dateFrom']) || empty($_GET['dateFrom'])) {
            throw new Exception("Select date");
        }

        $datefrom = $_GET['dateFrom'];  
        $dateto   = $_GET['dateTo'];
        $companyId = $_GET['company'];
        $siteId    = $_GET['siteid'];
        $status = 'DRAFT';

        // Validate companyId and siteId
        if (!isset($companyId) || empty($companyId)) {
            throw new Exception("Company ID is required");
        }       
        if (!isset($siteId) || empty($siteId)) {
            throw new Exception("Site ID is required");
        }
        // Validate date format
        $datefrom = date('Y-m-d', strtotime($datefrom));
        $dateto   = date('Y-m-d', strtotime($dateto));
        if (!$datefrom || !$dateto) {
            throw new Exception("Invalid date format");
        }

        // Debugging output
        // Uncomment for debugging
        // echo "Debug: Date From: $datefrom, Date To: $dateto
       // console.log("Date From: $datefrom, Date To: $dateto, Company ID: $companyId, Site ID: $siteId, Status: $status");

        // Prepare SQL - fix typo in :datefrom param and remove :status binding
      $sql = "SELECT * FROM Aquila_PO_Transaction 
        WHERE  COMPANY_ID = :companyid AND STATUS IN('ALLOCATED','PROCESSED','RECEIVED')
          AND SITE_ID = :siteid 
          AND PO_DATE BETWEEN :datefrom AND :dateto  
        ORDER BY LINE_ID DESC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':datefrom', $datefrom);
$stmt->bindParam(':dateto', $dateto);
$stmt->bindParam(':companyid', $companyId);
$stmt->bindParam(':siteid', $siteId);


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


if (isset($_GET['action']) && $_GET['action'] === 'loaddetails') {
    header('Content-Type: application/json');
    
    // Validate database connection
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit(); 
    }   

      if (!isset($conn) || !($conn instanceof PDO)) {
            throw new Exception("Database connection failed");
        }

    try {
        // Validate dateFrom


        $ponumber = $_GET['ponumber'];

        // Debugging output
        // Uncomment for debugging
        // echo "Debug: Date From: $datefrom, Date To: $dateto
       // console.log("Date From: $datefrom, Date To: $dateto, Company ID: $companyId, Site ID: $siteId, Status: $status");

        // Prepare SQL - fix typo in :datefrom param and remove :status binding
      $sql = "SELECT * FROM Aquila_PO_Details 
        WHERE  PO_NUMBER = :ponumber 
        ORDER BY LINEID ASC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':ponumber', $ponumber);


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

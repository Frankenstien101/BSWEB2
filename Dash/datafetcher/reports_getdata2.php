<?php
session_start();
include __DIR__ . "/../../DB/dbcon.php";
ini_set('max_execution_time', 1000);
ini_set('memory_limit', '1024M');
set_time_limit(1000);

// Error logging for debugging
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../logs/php_errors.log');

require __DIR__ . '/../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$action = $_GET['action'] ?? '';

// PRODUCT MASTER REPORT
if ($action === 'sendreport') {
    try {
        if (!$conn || !($conn instanceof PDO)) throw new Exception('Database connection failed');


        $requestId = $_GET['requestid'] ?? '';
        $TITLE = $_GET['title'] ?? '';
        $columnQuery = $_GET['columnQuery'] ?? '';
        $columnQuery2 = $_GET['columnQuery2'] ?? '';
        $columnQuery3 = $_GET['columnQuery3'] ?? '';
        $columnQuery4 = $_GET['columnQuery4'] ?? '';
        $columnQuery5 = $_GET['columnQuery5'] ?? '';
        $sheet1name = $_GET['sheet1name'] ?? 'sheet1';
        $sheet2name = $_GET['sheet2name'] ?? 'sheet2';
        $sheet3name = $_GET['sheet3name'] ?? 'sheet3';
        $sheet4name = $_GET['sheet4name'] ?? 'sheet4';
        $sheet5name = $_GET['sheet5name'] ?? 'sheet5';
        $allsites = $_GET['allsites'] ?? 0;
        $companyId = $_GET['companyid'] ?? '';  
        $userId = $_GET['UserID'] ?? '';
        $datetimeNow = date('Ymd_His');
        $filename = ($_GET['filename'] ?? '') . "_{$datetimeNow}";

        // Insert the query string into a tracking table
        $sql = "INSERT INTO All_Report_Server (REQUEST_ID, TITLE, FILENAME, DATE_CREATED, QUERY1, QUERY1_SHEETNAME, QUERY2, QUERY2_SHEETNAME, QUERY3, QUERY3_SHEETNAME, QUERY4, QUERY4_SHEETNAME, QUERY5, QUERY5_SHEETNAME, STATUS, PROCESS_BY)
                VALUES (:requestId, :title, :filename, GETDATE(), :columnQuery, :sheet1, :columnQuery2, :sheet2, :columnQuery3, :sheet3, :columnQuery4, :sheet4, :columnQuery5, :sheet5, 'PENDING', :userId)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':requestId', $requestId);
        $stmt->bindParam(':title', $TITLE);
        $stmt->bindParam(':filename', $filename);
        $stmt->bindParam(':columnQuery', $columnQuery);
        $stmt->bindParam(':columnQuery2', $columnQuery2);
        $stmt->bindParam(':columnQuery3', $columnQuery3);
        $stmt->bindParam(':columnQuery4', $columnQuery4);
        $stmt->bindParam(':columnQuery5', $columnQuery5);
        $stmt->bindParam(':sheet1', $sheet1name);
        $stmt->bindParam(':sheet2', $sheet2name);
        $stmt->bindParam(':sheet3', $sheet3name);
        $stmt->bindParam(':sheet4', $sheet4name);
        $stmt->bindParam(':sheet5', $sheet5name);

        $stmt->bindParam(':userId', $userId);

        $stmt->execute();

        echo json_encode(['success' => true, 'requestId' => $requestId]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Database error', 'message' => $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Application error', 'message' => $e->getMessage()]);
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'loadlist') {
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


        $userId = $_GET['userid'];
        $dateCreated = $_GET['datecreated'] ?? '';

        // Debugging output
        // Uncomment for debugging
        // echo "Debug: Date From: $datefrom, Date To: $dateto
       // console.log("Date From: $datefrom, Date To: $dateto, Company ID: $companyId, Site ID: $siteId, Status: $status");

        // Prepare SQL - fix typo in :datefrom param and remove :status binding
      $sql = "SELECT * FROM All_Report_Server 
        WHERE  PROCESS_BY = :userid and DATE_CREATED = :datecreated
        ORDER BY REQUEST_ID ASC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':userid', $userId);
$stmt->bindParam(':datecreated', $dateCreated);
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


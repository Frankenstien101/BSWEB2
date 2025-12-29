<?php
session_start();
include __DIR__ . "/../../DB/dbcon.php";
ini_set('max_execution_time', 1000);
ini_set('memory_limit', '1024M');
set_time_limit(1000);

// Error logging
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../logs/php_errors.log');

header('Content-Type: application/json');

try {
    // Determine if POST JSON exists
    $input = json_decode(file_get_contents('php://input'), true);
    $action = '';
    
    if ($input) {
        // POST request
        $action = $input['action'] ?? '';
        $requestId = $input['requestid'] ?? '';
        $TITLE = $input['title'] ?? '';
        $filename = $input['filename'] ?? 'report';
        $sheet1name = $input['sheet1name'] ?? 'sheet1';
        $sheet2name = $input['sheet2name'] ?? 'sheet2';
        $sheet3name = $input['sheet3name'] ?? 'sheet3';
        $sheet4name = $input['sheet4name'] ?? 'sheet4';
        $sheet5name = $input['sheet5name'] ?? 'sheet5';
        $columnQuery = $input['columnQuery'] ?? '';
        $columnQuery2 = $input['columnQuery2'] ?? '';
        $columnQuery3 = $input['columnQuery3'] ?? '';
        $columnQuery4 = $input['columnQuery4'] ?? '';
        $columnQuery5 = $input['columnQuery5'] ?? '';
        $userId = $input['UserID'] ?? '';
    } else {
        // GET request
        $action = $_GET['action'] ?? '';
        $requestId = $_GET['requestid'] ?? '';
        $TITLE = $_GET['title'] ?? '';
        $filename = $_GET['filename'] ?? 'report';
        $sheet1name = $_GET['sheet1name'] ?? 'sheet1';
        $sheet2name = $_GET['sheet2name'] ?? 'sheet2';
        $sheet3name = $_GET['sheet3name'] ?? 'sheet3';
        $sheet4name = $_GET['sheet4name'] ?? 'sheet4';
        $sheet5name = $_GET['sheet5name'] ?? 'sheet5';
        $columnQuery = $_GET['columnQuery'] ?? '';
        $columnQuery2 = $_GET['columnQuery2'] ?? '';
        $columnQuery3 = $_GET['columnQuery3'] ?? '';
        $columnQuery4 = $_GET['columnQuery4'] ?? '';
        $columnQuery5 = $_GET['columnQuery5'] ?? '';
        $userId = $_GET['UserID'] ?? '';
    }

    if ($action === 'sendreport' || $action === 'sendreportpost') {
        $sql = "INSERT INTO All_Report_Server 
                (REQUEST_ID, TITLE, FILENAME, DATE_CREATED, 
                 QUERY1, QUERY1_SHEETNAME, 
                 QUERY2, QUERY2_SHEETNAME, 
                 QUERY3, QUERY3_SHEETNAME, 
                 QUERY4, QUERY4_SHEETNAME, 
                 QUERY5, QUERY5_SHEETNAME, 
                 STATUS, PROCESS_BY)
                VALUES
                (:requestId, :title, :filename, GETDATE(),
                 :columnQuery, :sheet1,
                 :columnQuery2, :sheet2,
                 :columnQuery3, :sheet3,
                 :columnQuery4, :sheet4,
                 :columnQuery5, :sheet5,
                 'PENDING', :userId)";

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
        exit();
    }

    if ($action === 'loadlist') {
        $userId = $input['UserID'] ?? $_GET['userid'] ?? '';
        $dateCreated = $input['datecreated'] ?? $_GET['datecreated'] ?? '';

        $sql = "SELECT * FROM All_Report_Server 
                WHERE PROCESS_BY = :userid AND DATE_CREATED = :datecreated
                ORDER BY REQUEST_ID ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userId);
        $stmt->bindParam(':datecreated', $dateCreated);
        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items ?: []);
        exit();
    }

    echo json_encode(['success' => false, 'error' => 'Invalid action']);
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Database error', 'message' => $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Application error', 'message' => $e->getMessage()]);
}

<?php
// Start output buffering to catch any accidental output
ob_start();

// Turn off display of errors/warnings in output (still log them)
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

session_start();
include __DIR__ . '/../../DB/dbcon.php';

// Helper function: Convert datetime-local string to SQL Server safe format
function toSqlServerDate($inputDate) {
    if (empty($inputDate) || !is_string($inputDate)) {
        return null;
    }
    
    // Replace 'T' with space
    $clean = str_replace('T', ' ', trim($inputDate));
    
    // Add seconds if missing
    if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/', $clean)) {
        $clean .= ':00';
    }
    
    // Only return if it matches expected pattern
    if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $clean)) {
        return $clean;
    }
    
    return null; // let DB use GETDATE() or NULL
}

$action = $_GET['action'] ?? '';

if ($action === 'addtopurchased') {
    header('Content-Type: application/json; charset=utf-8');

    // Read raw POST body
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($input)) {
        ob_end_clean();
        http_response_code(400);
        echo json_encode([
            'status'  => 'error',
            'message' => 'Invalid JSON data: ' . json_last_error_msg()
        ]);
        exit;
    }

    // Extract & validate required fields
    $device_id   = $input['device_id']   ?? null;
    $site_id     = $input['site_id']     ?? null;
    $number      = $input['number']      ?? null;
    $user        = $input['user']        ?? 'Unknown';
    $amount      = floatval($input['amount'] ?? 0);
    $dataadded   = floatval($input['dataadded'] ?? 0);
    $reference   = trim($input['reference'] ?? '');
    $load_date   = $input['load_date']   ?? null;

    if ($amount <= 0) {
        ob_end_clean();
        echo json_encode(['status' => 'error', 'message' => 'Amount must be greater than zero']);
        exit;
    }
    if ($dataadded <= 0) {
        ob_end_clean();
        echo json_encode(['status' => 'error', 'message' => 'Data added (GB) must be greater than zero']);
        exit;
    }
    if (empty($reference)) {
        ob_end_clean();
        echo json_encode(['status' => 'error', 'message' => 'Reference / Transaction ID is required']);
        exit;
    }
    if (empty($number)) {
        ob_end_clean();
        echo json_encode(['status' => 'error', 'message' => 'Mobile number is required']);
        exit;
    }

    try {
    $conn->beginTransaction();

    // ────────────────────────────────────────────────
    // 1. INSERT
    // ────────────────────────────────────────────────
    $insertPurchase = "
        INSERT INTO BS_Load_Purchases (
            COMPANY_ID, SITE_ID, NUMBER, PERSON, AMOUNT, DATA_ADDED,
            LOAD_DATE, REFERENCE, DATE_RECORDED, RECORDED_BY
        ) VALUES (
            :COMPANY_ID, :SITE_ID, :NUMBER, :PERSON, :AMOUNT, :DATA_ADDED,
            :LOAD_DATE, :REFERENCE, GETDATE(), :RECORDED_BY
        )
    ";

    $stmtPurchase = $conn->prepare($insertPurchase);
    $insertOk = $stmtPurchase->execute([
        ':COMPANY_ID'   => $_SESSION['Company_ID'] ?? null,
        ':SITE_ID'      => $site_id,
        ':NUMBER'       => $number,
        ':PERSON'       => $user,
        ':AMOUNT'       => $amount,
        ':DATA_ADDED'   => $dataadded,
        ':LOAD_DATE'    => toSqlServerDate($load_date),
        ':REFERENCE'    => $reference,
        ':RECORDED_BY'  => $_SESSION['Name_of_user'] ?? 'SYSTEM'
    ]);

    if (!$insertOk) {
        throw new Exception("INSERT failed: " . implode(" | ", $stmtPurchase->errorInfo()));
    }

    // ────────────────────────────────────────────────
    // 2. UPDATE – using numbered placeholders to force count match
    // ────────────────────────────────────────────────
    $updateDevice = "
        UPDATE BS_Device
        SET 
            LOAD_STATUS       = 'OK',
            LAST_LOAD_HISTORY    = COALESCE(?, GETDATE()),
            BALANCE           = ISNULL(BALANCE, 0) + ?
        WHERE NUMBER      = ?
          AND COMPANY_ID  = ?
          AND (SITE_ID = ? OR ? IS NULL)
    ";

    $stmtUpdate = $conn->prepare($updateDevice);

    // 8 parameters – note SITE_ID is bound twice (for the OR condition)
    $updateOk = $stmtUpdate->execute([
        toSqlServerDate($load_date),
        $dataadded,
        $number,
        $_SESSION['Company_ID'] ?? 'NA',
        $site_id,
        $site_id                // ← repeated for the OR :SITE_ID IS NULL part
    ]);

    if (!$updateOk) {
        throw new Exception("UPDATE failed: " . implode(" | ", $stmtUpdate->errorInfo()));
    }

    $conn->commit();

    ob_end_clean();
    echo json_encode([
        'status'      => 'success',
        'message'     => 'Load purchase recorded successfully',
        'load_status' => 'OK'
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    $conn->rollBack();

    ob_end_clean();
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
exit;

    exit;
}

// Fallback for unknown action
ob_end_clean();
echo json_encode([
    'status'  => 'error',
    'message' => 'Invalid or missing action'
], JSON_UNESCAPED_UNICODE);
exit;
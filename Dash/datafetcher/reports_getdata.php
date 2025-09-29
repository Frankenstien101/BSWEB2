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

// Clean up stale temporary files (older than 1 hour)
function cleanup_temp_files($olderThanSeconds = 3600) {
    $pattern = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "report_file_*.xlsx";
    $progressPattern = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "report_progress_*.json";
    foreach (glob($pattern) as $file) {
        if (filemtime($file) < time() - $olderThanSeconds) {
            @unlink($file);
        }
    }
    foreach (glob($progressPattern) as $file) {
        if (filemtime($file) < time() - $olderThanSeconds) {
            @unlink($file);
        }
    }
}
cleanup_temp_files();

// Input parameters
$action = $_GET['action'] ?? '';
$progressKey = sanitize_progress_key($_GET['progress_key'] ?? '');
$companyId = sanitize_id($_GET['companyid'] ?? ($_SESSION['Company_ID'] ?? ''));
$siteId = sanitize_id($_GET['siteid'] ?? ($_SESSION['SITE_ID'] ?? ''));
$dateFrom = sanitize_date($_GET['datefrom'] ?? '');
$dateTo = sanitize_date($_GET['dateto'] ?? '');
$isAll = $_GET['isall'] ?? 'false';

// Helper functions
function get_protocol() {
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
}

function sanitize_progress_key($key) {
    return preg_match('/^[A-Za-z0-9_\-]{1,64}$/', $key) ? $key : '';
}

function sanitize_id($id) {
    return preg_match('/^[0-9]+$/', $id) ? $id : '';
}

function sanitize_date($date) {
    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) ? $date : '';
}

function generate_filename($action) {
    $actionMap = [
        'loadagents' => 'agentperformancesummary',
        // Other actions use their action name directly
    ];
    $filenameAction = $actionMap[$action] ?? $action;
    return strtolower($filenameAction) . date('mdY') . '.xlsx';
}

function progress_file_path($key) {
    return sys_get_temp_dir() . DIRECTORY_SEPARATOR . "report_progress_{$key}.json";
}

function report_file_path($key, $action) {
    return sys_get_temp_dir() . DIRECTORY_SEPARATOR . "report_file_{$key}_{$action}.xlsx";
}

function set_progress($key, $percent, $message = '', $extra = []) {
    if (!$key) return false;
    $data = array_merge([
        'percent' => max(0, min(100, (int)$percent)),
        'message' => (string)$message,
        'status' => $percent >= 100 ? 'done' : 'running',
        'ts' => time(),
    ], $extra);
    $result = @file_put_contents(progress_file_path($key), json_encode($data), LOCK_EX);
    if ($result === false) error_log("Failed to write progress file for key: $key");
    return $result !== false;
}

function get_progress($key) {
    if (!$key) {
        error_log("Invalid progress key: $key");
        return ['percent' => 0, 'status' => 'invalid', 'message' => 'Invalid key'];
    }
    $path = progress_file_path($key);
    if (!file_exists($path)) {
        error_log("Progress file not found for key: $key");
        return ['percent' => 0, 'status' => 'notfound', 'message' => 'No progress yet'];
    }
    $json = @file_get_contents($path);
    if ($json === false) {
        error_log("Unable to read progress file for key: $key");
        return ['percent' => 0, 'status' => 'error', 'message' => 'Unable to read progress file'];
    }
    $data = json_decode($json, true);
    return is_array($data) ? $data : ['percent' => 0, 'status' => 'error', 'message' => 'Invalid progress file'];
}

function remove_progress($key) {
    $path = progress_file_path($key);
    if (file_exists($path) && !@unlink($path)) {
        error_log("Failed to delete progress file: $path");
    }
}

function save_spreadsheet_to_temp($spreadsheet, $key, $action) {
    if (!$key) {
        error_log("Invalid key for saving spreadsheet: $key");
        return false;
    }
    $out = report_file_path($key, $action);
    try {
        (new Xlsx($spreadsheet))->save($out);
        return $out;
    } catch (Exception $e) {
        error_log("Failed to save spreadsheet for key: $key, action: $action, error: " . $e->getMessage());
        return false;
    }
}

function writeArrayToSheet($sheet, $data, $title = '') {
    if ($title) $sheet->setTitle(substr($title, 0, 31));
    if (empty($data)) {
        $sheet->setCellValue('A1', 'No data available for the selected date range and company.');
        return;
    }
    $sheet->fromArray(array_keys($data[0]), null, 'A1');
    $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->getFont()->setBold(true);
    $sheet->fromArray($data, null, 'A2');
    $highestColumn = $sheet->getHighestColumn();
    $highestIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    for ($col = 1; $col <= $highestIndex; $col++) {
        $sheet->getColumnDimension(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col))->setAutoSize(true);
    }
}

function sendSpreadsheet($spreadsheet, $action) {
    if (ob_get_length()) @ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . generate_filename($action) . '"');
    header('Cache-Control: max-age=0');
    (new Xlsx($spreadsheet))->save('php://output');
    exit;
}

function json_response($data, $status = 200) {
    if (ob_get_length()) @ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode($data);
    exit;
}

// Progress and download endpoints
if ($action === 'progress') {
    ob_start();
    $key = sanitize_progress_key($_GET['key'] ?? '');
    if (!$key) json_response(['success' => false, 'message' => 'Invalid key'], 400);
    $prog = get_progress($key);
    if ($prog['status'] === 'done') {
        $pattern = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "report_file_{$key}_*.xlsx";
        $matches = glob($pattern);
        if ($matches) {
            $filePath = $matches[0];
            $actionFromFile = preg_match('/report_file_[^_]+_([^.]+)\.xlsx$/', basename($filePath), $matches) ? $matches[1] : 'report';
            error_log("Progress: actionFromFile=$actionFromFile for key=$key");
            $filename = generate_filename($actionFromFile);
            $prog['download_url'] = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                . "?action=downloadfile&key=" . rawurlencode($key) . "&fn=" . rawurlencode($filename);
            $prog['file'] = $filename;
        }
    }
    ob_end_clean();
    json_response(['success' => true, 'progress' => $prog]);
}

if ($action === 'downloadfile') {
    ob_start();
    $key = sanitize_progress_key($_GET['key'] ?? '');
    if (!$key) json_response(['success' => false, 'message' => 'Invalid key'], 400);
    $pattern = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "report_file_{$key}_*.xlsx";
    $matches = glob($pattern);
    if (!$matches || !file_exists($matches[0])) {
        error_log("Downloadfile: File not found for key: $key");
        ob_end_clean();
        json_response(['success' => false, 'message' => 'File not found'], 404);
    }
    $filePath = $matches[0];
    $actionFromFile = preg_match('/report_file_[^_]+_([^.]+)\.xlsx$/', basename($filePath), $matches) ? $matches[1] : 'report';
    if (ob_get_length()) @ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . generate_filename($actionFromFile) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    @unlink($filePath);
    remove_progress($key);
    exit;
}

// Validate session for other actions
if ($action !== 'progress' && $action !== 'downloadfile' && $action !== 'saveonvanloaddetails') {
    if (!$companyId || !$siteId) {
        error_log("Session variables missing for action: $action");
        json_response(['success' => false, 'message' => 'Session expired or invalid'], 401);
    }
}

// Action handlers
$actions = [
    'saveonvanloaddetails' => function() use ($conn) {
        $params = [
            ':sellerid' => $_GET['sellerid'] ?? '',
            ':transactionid' => $_GET['transactionid'] ?? '',
            ':barcode' => $_GET['barcode'] ?? '',
            ':item_code' => $_GET['itemid'] ?? '',
            ':description' => $_GET['description'] ?? '',
            ':batch' => $_GET['batch'] ?? '',
            ':cs' => $_GET['cs'] ?? 0,
            ':sw' => $_GET['sw'] ?? 0,
            ':it' => $_GET['it'] ?? 0,
            ':item_cost' => $_GET['price'] ?? 0,
            ':item_per_case' => $_GET['itpercase'] ?? 0,
            ':item_per_sw' => $_GET['itpersw'] ?? 0,
            ':sih_it' => $_GET['sihit'] ?? 0,
            ':total_cs_amount' => $_GET['totalcs'] ?? 0,
            ':total_it_amount' => $_GET['totalit'] ?? 0,
        ];
        $sql = "INSERT INTO Aquila_Van_Loading_Details (
                    SELLER_ID, TRANSACTION_ID, BARCODE, ITEM_CODE, DESCRIPTION, BATCH,
                    CS, SW, IT, PRICE, ITEM_PER_CASE, ITEM_PER_SW, SIH_IT,
                    TOTAL_CS_AMOUNT, TOTAL_IT_AMOUNT, IS_SYNCED
                ) VALUES (
                    :sellerid, :transactionid, :barcode, :item_code, :description, :batch,
                    :cs, :sw, :it, :item_cost, :item_per_case, :item_per_sw, :sih_it,
                    :total_cs_amount, :total_it_amount, 0
                )";
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        json_response(['success' => true, 'line_id' => $conn->lastInsertId()]);
    },
    'deliveryperformance' => function() use ($conn, $companyId, $siteId, $dateFrom, $dateTo, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting query');
        $sql = "SELECT COMPANY_ID, SITE_ID, t.SELLER_ID, t.DATE_CREATED, d.TRANSACTION_ID,
                       d.BARCODE, d.ITEM_CODE, d.DESCRIPTION, d.BATCH, d.CS, d.SW, d.IT, d.PRICE,
                       d.ITEM_PER_CASE, d.ITEM_PER_SW, d.SIH_IT, d.TOTAL_CS_AMOUNT, d.TOTAL_IT_AMOUNT, t.STATUS
                FROM Aquila_Van_Loading_Details d
                INNER JOIN Aquila_Van_Loading_Transaction t ON t.LOADING_ID = d.TRANSACTION_ID
                WHERE t.COMPANY_ID = ? AND t.SITE_ID = ? AND t.DATE_CREATED BETWEEN ? AND ? AND t.STATUS != 'DRAFT'
                ORDER BY t.DATE_CREATED DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$companyId, $siteId, $dateFrom, $dateTo]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 50, 'Data fetched');
        foreach ($rows as &$r) {
            if (isset($r['ITEM_CODE'])) $r['ITEM_CODE'] = (string)$r['ITEM_CODE'];
        }
        unset($r);
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $rows, 'Van Allocation');
        if ($advanced) {
            set_progress($progressKey, 85, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'deliveryperformance');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('deliveryperformance'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('deliveryperformance')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'deliveryperformance');
    },
    'loadagents' => function() use ($conn, $companyId, $dateFrom, $dateTo, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting queries');
        $stmt = $conn->prepare("SELECT COMPANY_ID, SITE_ID, AGENT_ID, USERNAME, DELIVERY_DATE,
                                      ENTRY_BAT_PERCENTAGE, EXIT_BAT_PERCENTAGE, TIME_ENTRY, TIME_EXIT, STATUS, LOGIN_ID, TIME_SPENT
                               FROM Dash_Agent_Performance_Summary
                               WHERE COMPANY_ID = ? AND DELIVERY_DATE BETWEEN ? AND ? AND STATUS = 'COMPLETE'
                               GROUP BY COMPANY_ID, SITE_ID, AGENT_ID, USERNAME, DELIVERY_DATE, ENTRY_BAT_PERCENTAGE, EXIT_BAT_PERCENTAGE,
                                        TIME_ENTRY, TIME_EXIT, STATUS, LOGIN_ID, TIME_SPENT");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $sheet1Data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 40, 'Fetched Agent Performance');
        $stmt = $conn->prepare("SELECT DISTRIBUTOR_CODE, BRANCH_CODE, BRANCH, ORDER_DATE, [DATE] AS INVOICE_DATE,
                                      Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED, SALES_REP, SELLER_NAME, AGENT_ID, BATCH,
                                      Dash_Plan_Batch_Details.STATUS, CASE WHEN SUM(ISNULL(RETURN_AMOUNT,0))=0 THEN 'NO' ELSE 'YES' END AS HAS_RETURN,
                                      PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME, DOCUMENT_NUMBER, SUM(SALES_AMOUNT) AS TOTAL,
                                      PG_LOCAL_SUBSEGMENT, MAX(Dash_Agent_Performance_Detailed.STORE_ENTRY) AS STORE_ENTRY,
                                      MAX(Dash_Agent_Performance_Detailed.STORE_EXIT) AS STORE_EXIT, MAX(Dash_Agent_Performance_Detailed.STORE_TIME_SPENT) AS STORE_TIME_SPENT
                               FROM PRFR_Invoice_Detailed
                               LEFT JOIN Dash_Plan_Batch_Details ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER
                                   AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                               LEFT JOIN Dash_Returns ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER
                                   AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                               LEFT JOIN Dash_Agent_Performance_Detailed ON Dash_Agent_Performance_Detailed.DELIVERY_DATE = Dash_Plan_Batch_Details.DATE_TO_DELIVER
                                   AND Dash_Agent_Performance_Detailed.STORE_CODE = PRFR_Invoice_Detailed.CUSTOMER_ID
                                   AND Dash_Agent_Performance_Detailed.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE
                               WHERE Dash_Plan_Batch_Details.COMPANY_ID = ? AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN ? AND ?
                               GROUP BY DISTRIBUTOR_CODE, BRANCH_CODE, BRANCH, ORDER_DATE, [DATE], Dash_Plan_Batch_Details.DATE_TO_DELIVER,
                                        SALES_REP, SELLER_NAME, AGENT_ID, BATCH, Dash_Plan_Batch_Details.STATUS,
                                        PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME, DOCUMENT_NUMBER, PG_LOCAL_SUBSEGMENT");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $sheet2Data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 70, 'Fetched Delivery Result');
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $sheet1Data, 'Agent Performance Summary');
        writeArrayToSheet($spreadsheet->createSheet(), $sheet2Data, 'Delivery Result Summary');
        if ($advanced) {
            set_progress($progressKey, 90, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'AgentPerformanceSummary');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('loadagents'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('loadagents')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'loadagents');
    },
    'loadagentsdetailed' => function() use ($conn, $companyId, $dateFrom, $dateTo, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting queries');
        $stmt = $conn->prepare("SELECT COMPANY_ID, SITE_ID, SITE_NAME, DATE_TO_DELIVER, AGENT, STORE_ENTRY, STORE_EXIT, STORE_TIME_SPENT,
                                      CUSTOMER_ID, CUSTOMER_NAME, PHONE, ADDRESS, IMAGE1, LATITUDE, LONGITUDE, STATUS, SUB_BATCH, SUB_DA, IS_RECEIVED, VEHICLE_IDS, IS_DROP_STATUS
                               FROM (SELECT b.COMPANY_ID, a.SITE_ID, Dash_Sites.SITE_NAME, b.DATE_TO_DELIVER, a.AGENT, d.STORE_ENTRY, d.STORE_EXIT, d.STORE_TIME_SPENT,
                                           b.CUSTOMER_ID, b.CUSTOMER_NAME, c.PHONE, c.ADDRESS, c.IMAGE1, c.LATITUDE, c.LONGITUDE, b.STATUS, b.SUB_BATCH, b.SUB_DA,
                                           b.IS_RECEIVED, b.VEHICLE_IDS, b.IS_DROP_STATUS, ROW_NUMBER() OVER (PARTITION BY b.CUSTOMER_ID, b.COMPANY_ID ORDER BY d.STORE_EXIT DESC) AS rn
                                    FROM Dash_Plan_Batch_Transaction a
                                    JOIN Dash_Plan_Batch_Details b ON a.BATCH_ID = b.BATCH AND a.COMPANY_ID = b.COMPANY_ID
                                    LEFT JOIN Dash_Customer_Master c ON c.CODE = b.CUSTOMER_ID AND c.COMPANY_ID = b.COMPANY_ID
                                    LEFT JOIN Dash_Agent_Performance_Detailed d ON b.CUSTOMER_ID = d.STORE_CODE AND b.DATE_TO_DELIVER = d.DELIVERY_DATE AND b.COMPANY_ID = d.COMPANY_ID
                                    LEFT JOIN Dash_Sites ON Dash_Sites.SITE_ID = a.SITE_ID
                                    WHERE b.DATE_TO_DELIVER BETWEEN ? AND ? AND a.STATUS = 'PROCESSED' AND b.COMPANY_ID = ?) AS subquery
                               WHERE rn = 1");
        $stmt->execute([$dateFrom, $dateTo, $companyId]);
        $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 30, 'Fetched Agent Details');
        $stmt = $conn->prepare("SELECT COMPANY_ID, SITE_ID, AGENT_ID, USERNAME, DELIVERY_DATE, ENTRY_BAT_PERCENTAGE, EXIT_BAT_PERCENTAGE,
                                      TIME_ENTRY, TIME_EXIT, STATUS, LOGIN_ID, TIME_SPENT
                               FROM Dash_Agent_Performance_Summary
                               WHERE COMPANY_ID = ? AND DELIVERY_DATE BETWEEN ? AND ? AND STATUS = 'COMPLETE'
                               GROUP BY COMPANY_ID, SITE_ID, AGENT_ID, USERNAME, DELIVERY_DATE, ENTRY_BAT_PERCENTAGE, EXIT_BAT_PERCENTAGE,
                                        TIME_ENTRY, TIME_EXIT, STATUS, LOGIN_ID, TIME_SPENT");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $warehouses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 50, 'Fetched Agent Performance');
        $stmt = $conn->prepare("SELECT DISTRIBUTOR_CODE, BRANCH_CODE, BRANCH, ORDER_DATE, [DATE] AS INVOICE_DATE, DATE_TO_DELIVER AS DATE_DELIVERED,
                                      SALES_REP, SELLER_NAME, AGENT_ID, BATCH, Dash_Plan_Batch_Details.STATUS,
                                      CASE WHEN ISNULL(RETURN_AMOUNT,0)=0 THEN 'NO' ELSE 'YES' END AS HAS_RETURN,
                                      PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME, [NAME] AS ITEM_ID,
                                      [SCHEME_CODE], [SCHEME_SLAB_DESCRIPTION], [SCHEME_GROUP_NAME], PRFR_Invoice_Detailed.IT_BARCODE,
                                      [SW_BARCODE], [DESCRIPTION], [BRAND], [ITEM_CATEGORY], [BRANDFORM], [TRADE_CHANNEL], [DOCUMENT_NUMBER],
                                      [CS], [AMOUNT], [DISCOUNT_VALUE], [SCHEME_VALUE], [SALES_EX_VAT], [VAT_AMOUNT], [SALES_AMOUNT],
                                      ISNULL([QTY_RETURN],0) AS QTY_RETURN, ISNULL([RETURN_AMOUNT],0) AS RETURN_AMOUNT,
                                      [MONTHLY_TRANSACTION], [PG_LOCAL_SUBSEGMENT], [SALES_SUPERVISOR], [ITEM_QTY], [GIV], [NIV],
                                      [ITEM_QTY_CS], [ITEM_QTY_SW], [ITEM_QTY_IT]
                               FROM PRFR_Invoice_Detailed
                               LEFT JOIN Dash_Plan_Batch_Details ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER
                                   AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                               LEFT JOIN Dash_Returns ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER
                                   AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                               WHERE Dash_Plan_Batch_Details.COMPANY_ID = ? AND DATE_TO_DELIVER BETWEEN ? AND ?");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $stores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 70, 'Fetched Vehicle/Store Data');
        $stmt = $conn->prepare("SELECT DISTRIBUTOR_CODE, BRANCH_CODE, BRANCH, ORDER_DATE, [DATE] AS INVOICE_DATE,
                                      Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED, SALES_REP, SELLER_NAME, AGENT_ID, BATCH,
                                      Dash_Plan_Batch_Details.STATUS, CASE WHEN SUM(ISNULL(RETURN_AMOUNT,0))=0 THEN 'NO' ELSE 'YES' END AS HAS_RETURN,
                                      PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME, DOCUMENT_NUMBER, SUM(SALES_AMOUNT) AS TOTAL,
                                      PG_LOCAL_SUBSEGMENT, MAX(Dash_Agent_Performance_Detailed.STORE_ENTRY) AS STORE_ENTRY,
                                      MAX(Dash_Agent_Performance_Detailed.STORE_EXIT) AS STORE_EXIT, MAX(Dash_Agent_Performance_Detailed.STORE_TIME_SPENT) AS STORE_TIME_SPENT
                               FROM PRFR_Invoice_Detailed
                               LEFT JOIN Dash_Plan_Batch_Details ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER
                                   AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                               LEFT JOIN Dash_Returns ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER
                                   AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                               LEFT JOIN Dash_Agent_Performance_Detailed ON Dash_Agent_Performance_Detailed.DELIVERY_DATE = Dash_Plan_Batch_Details.DATE_TO_DELIVER
                                   AND Dash_Agent_Performance_Detailed.STORE_CODE = PRFR_Invoice_Detailed.CUSTOMER_ID
                                   AND Dash_Agent_Performance_Detailed.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE
                               WHERE Dash_Plan_Batch_Details.COMPANY_ID = ? AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN ? AND ?
                               GROUP BY DISTRIBUTOR_CODE, BRANCH_CODE, BRANCH, ORDER_DATE, [DATE], Dash_Plan_Batch_Details.DATE_TO_DELIVER,
                                        SALES_REP, SELLER_NAME, AGENT_ID, BATCH, Dash_Plan_Batch_Details.STATUS,
                                        PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME, DOCUMENT_NUMBER, PG_LOCAL_SUBSEGMENT");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $summary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 85, 'Writing sheets');
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $agents, 'Agent Details');
        writeArrayToSheet($spreadsheet->createSheet(), $warehouses, 'Agent Performance');
        writeArrayToSheet($spreadsheet->createSheet(), $stores, 'Vehicles / Stores');
        writeArrayToSheet($spreadsheet->createSheet(), $summary, 'Delivery Summary');
        if ($advanced) {
            set_progress($progressKey, 95, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'loadagentsdetailed');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('loadagentsdetailed'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('loadagentsdetailed')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'loadagentsdetailed');
    },
    'soreport' => function() use ($conn, $companyId, $dateFrom, $dateTo, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting query');
        $stmt = $conn->prepare("SELECT COMPANY_ID, SITE_ID, UPLOAD_BY_USER_ID, DIST_NAME, BRANCH_NAME, SELLER_TYPE, SELLER_NAME,
                                      CUSTOMER_NAME, STORE_CODE, CHANNEL_NAME, SUB_CHANNEL_NAME, ORDER_DATE, ORDER_ID,
                                      PRD_SKU_CODE, PRD_SKU_NAME, BARCODE, CS_QTY, QTY_PIECE, PRICE_PIECE, SCHEME_CODE,
                                      SCHEME_DESC, ORDER_VALUE_WITHOUTSCHEME, SCHEME_VALUE, ORDER_VALUE, ORDER_SOURCE, IS_PLAN
                               FROM PRFR_SO_UPLOAD
                               WHERE COMPANY_ID = ? AND ORDER_DATE BETWEEN ? AND ?");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 60, 'Data fetched');
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $rows, 'SO Report');
        if ($advanced) {
            set_progress($progressKey, 90, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'soreport');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('soreport'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('soreport')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'soreport');
    },
    'deliveryplan' => function() use ($conn, $companyId, $siteId, $dateFrom, $dateTo, $isAll, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting query');
        $sql = "SELECT Dash_Plan_Batch_Details.COMPANY_ID, Dash_Plan_Batch_Details.SITE_ID, BATCH, INVOICE_NUMBER,
                       TOTAL_AMOUNT, INVOICE_VOLUME, DISTANCE, DISTANCE_IN_DECIMAL, Dash_Plan_Batch_Details.STATUS,
                       Dash_Plan_Batch_Details.DATE_TO_DELIVER, STORE_LAT, STORE_LONG, CUSTOMER_ID, CUSTOMER_NAME, AGENT_ID, VEHICLE_ID
                FROM Dash_Plan_Batch_Details
                LEFT JOIN Dash_Plan_Batch_Transaction ON Dash_Plan_Batch_Transaction.BATCH_ID = Dash_Plan_Batch_Details.BATCH
                WHERE Dash_Plan_Batch_Details.COMPANY_ID = ? AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN ? AND ?";
        $params = [$companyId, $dateFrom, $dateTo];
        if ($isAll !== 'true') {
            $sql .= " AND Dash_Plan_Batch_Details.SITE_ID = ?";
            $params[] = $siteId;
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 60, 'Data fetched');
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $rows, 'Delivery Plan');
        if ($advanced) {
            set_progress($progressKey, 90, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'deliveryplan');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('deliveryplan'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('deliveryplan')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'deliveryplan');
    },
    'result' => function() use ($conn, $companyId, $dateFrom, $dateTo, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting query');
        $stmt = $conn->prepare("SELECT DISTRIBUTOR_CODE, BRANCH_CODE, BRANCH, ORDER_DATE, [DATE] AS INVOICE_DATE,
                                      Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED, SALES_REP, SELLER_NAME, AGENT_ID, BATCH,
                                      Dash_Plan_Batch_Details.STATUS, CASE WHEN SUM(ISNULL(RETURN_AMOUNT,0))=0 THEN 'NO' ELSE 'YES' END AS HAS_RETURN,
                                      PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME, DOCUMENT_NUMBER, SUM(SALES_AMOUNT) AS TOTAL,
                                      PG_LOCAL_SUBSEGMENT, MAX(Dash_Agent_Performance_Detailed.STORE_ENTRY) AS STORE_ENTRY,
                                      MAX(Dash_Agent_Performance_Detailed.STORE_EXIT) AS STORE_EXIT, MAX(Dash_Agent_Performance_Detailed.STORE_TIME_SPENT) AS STORE_TIME_SPENT
                               FROM PRFR_Invoice_Detailed
                               LEFT JOIN Dash_Plan_Batch_Details ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER
                                   AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                               LEFT JOIN Dash_Returns ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER
                                   AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                               LEFT JOIN Dash_Agent_Performance_Detailed ON Dash_Agent_Performance_Detailed.DELIVERY_DATE = Dash_Plan_Batch_Details.DATE_TO_DELIVER
                                   AND Dash_Agent_Performance_Detailed.STORE_CODE = PRFR_Invoice_Detailed.CUSTOMER_ID
                                   AND Dash_Agent_Performance_Detailed.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE
                               WHERE Dash_Plan_Batch_Details.COMPANY_ID = ? AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN ? AND ?
                               GROUP BY DISTRIBUTOR_CODE, BRANCH_CODE, BRANCH, ORDER_DATE, [DATE], Dash_Plan_Batch_Details.DATE_TO_DELIVER,
                                        SALES_REP, SELLER_NAME, AGENT_ID, BATCH, Dash_Plan_Batch_Details.STATUS,
                                        PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME, DOCUMENT_NUMBER, PG_LOCAL_SUBSEGMENT");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 80, 'Writing spreadsheet');
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $rows, 'Results');
        if ($advanced) {
            set_progress($progressKey, 90, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'result');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('result'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('result')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'result');
    },
    'orderprep' => function() use ($conn, $companyId, $siteId, $dateFrom, $dateTo, $isAll, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting query');
        $sql = "SELECT Dash_SO_Plan_Batch_Details.COMPANY_ID, Dash_SO_Plan_Batch_Details.SITE_ID,
                       Dash_SO_Plan_Batch_Details.SO_PLAN_NUMBER, SO_NUMBER, VEHICLE_ID, SO_PICK_BATCH,
                       CUSTOMER_ID, CUSTOMER_NAME, TOTAL_AMOUNT, STORE_LAT, STORE_LONG, ORDER_DATE,
                       Dash_SO_Plan_Batch_Details.STATUS, SUB_BATCH, SUB_DA, VEHICLE_IDS
                FROM Dash_SO_Plan_Batch_Details
                LEFT JOIN Dash_SO_Plan_Transaction ON Dash_SO_Plan_Transaction.SO_PLAN_NUMBER = Dash_SO_Plan_Batch_Details.SO_PLAN_NUMBER
                WHERE Dash_SO_Plan_Batch_Details.COMPANY_ID = ? AND ORDER_DATE BETWEEN ? AND ? AND Dash_SO_Plan_Batch_Details.STATUS != 'NEW'";
        $params = [$companyId, $dateFrom, $dateTo];
        if ($isAll !== 'true') {
            $sql .= " AND Dash_SO_Plan_Batch_Details.SITE_ID = ?";
            $params[] = $siteId;
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 60, 'Data fetched');
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $rows, 'Order Preparation');
        if ($advanced) {
            set_progress($progressKey, 90, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'orderprep');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('orderprep'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('orderprep')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'orderprep');
    },
    'freight' => function() use ($conn, $companyId, $siteId, $dateFrom, $dateTo, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting query');
        $stmt = $conn->prepare("SELECT COMPANY_ID, SITE_ID, FREIGHT_ID, FREIGHT_DATE, VEHICLE_ID, ROUTE, TOTAL_AMOUNT,
                                      TOTAL_VOLUME, TOTAL_WEIGHT, STATUS
                               FROM Dash_Freight_Details
                               WHERE COMPANY_ID = ? AND FREIGHT_DATE BETWEEN ? AND ?");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 60, 'Data fetched');
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $rows, 'Freight Report');
        if ($advanced) {
            set_progress($progressKey, 90, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'freight');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('freight'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('freight')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'freight');
    },
    'crossdock' => function() use ($conn, $companyId, $siteId, $dateFrom, $dateTo, $progressKey) {
        $advanced = !!$progressKey;
        if ($advanced) set_progress($progressKey, 5, 'Starting query');
        $stmt = $conn->prepare("SELECT COMPANY_ID, SITE_ID, CROSSDOCK_ID, CROSSDOCK_DATE, INVOICE_NUMBER, CUSTOMER_ID,
                                      CUSTOMER_NAME, TOTAL_AMOUNT, STATUS
                               FROM Dash_Crossdock_Details
                               WHERE COMPANY_ID = ? AND CROSSDOCK_DATE BETWEEN ? AND ?");
        $stmt->execute([$companyId, $dateFrom, $dateTo]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($advanced) set_progress($progressKey, 60, 'Data fetched');
        $spreadsheet = new Spreadsheet();
        writeArrayToSheet($spreadsheet->getActiveSheet(), $rows, 'Crossdock Report');
        if ($advanced) {
            set_progress($progressKey, 90, 'Saving file');
            $tmpFile = save_spreadsheet_to_temp($spreadsheet, $progressKey, 'crossdock');
            if ($tmpFile) {
                $downloadUrl = get_protocol() . '://' . $_SERVER['HTTP_HOST']
                    . str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])) . '/' . basename($_SERVER['SCRIPT_NAME'])
                    . "?action=downloadfile&key=" . rawurlencode($progressKey) . "&fn=" . rawurlencode(generate_filename('crossdock'));
                set_progress($progressKey, 100, 'Ready', ['download_url' => $downloadUrl, 'file' => generate_filename('crossdock')]);
                ob_end_clean();
                json_response(['success' => true, 'download_url' => $downloadUrl]);
            } else {
                set_progress($progressKey, 0, 'Failed to save file', ['error' => true]);
                ob_end_clean();
                json_response(['success' => false, 'message' => 'Failed to save file'], 500);
            }
        }
        sendSpreadsheet($spreadsheet, 'crossdock');
    },
];

if (isset($actions[$action])) {
    try {
        $actions[$action]();
    } catch (Exception $e) {
        error_log("Error in action $action: " . $e->getMessage());
        json_response(['success' => false, 'message' => 'Server error: ' . $e->getMessage()], 500);
    }
} else {
    error_log("Invalid action: $action");
    json_response(['success' => false, 'message' => 'Invalid action'], 400);
}
?>
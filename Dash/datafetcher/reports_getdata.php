
<?php
session_start();
include(__DIR__ . "/../../DB/dbcon.php");


$action = $_GET['action'] ?? '';

try {
    if ($action === 'saveonvanloaddetails') {
        header('Content-Type: application/json');

        // Retrieve parameters from GET
        $transactionId = $_GET['transactionid'] ?? '';
        $sellerid = $_GET['sellerid'] ?? '';
        $barcode = $_GET['barcode'] ?? '';
        $itemId = $_GET['itemid'] ?? '';
        $description = $_GET['description'] ?? '';
        $batch = $_GET['batch'] ?? '';
        $cs = $_GET['cs'] ?? 0;
        $sw = $_GET['sw'] ?? 0;
        $it = $_GET['it'] ?? 0;
        $price = $_GET['price'] ?? 0;
        $itPerCase = $_GET['itpercase'] ?? 0;
        $itPerSw = $_GET['itpersw'] ?? 0;
        $sihit = $_GET['sihit'] ?? 0;
        $totalcs = $_GET['totalcs'] ?? 0;
        $totalit = $_GET['totalit'] ?? 0;

        // Prepare SQL insert statement
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
        $stmt->execute([
            ':sellerid' => $sellerid,
            ':transactionid' => $transactionId,
            ':barcode' => $barcode,
            ':item_code' => $itemId,
            ':description' => $description,
            ':batch' => $batch,
            ':cs' => $cs,
            ':sw' => $sw,
            ':it' => $it,
            ':item_cost' => $price,
            ':item_per_case' => $itPerCase,
            ':item_per_sw' => $itPerSw,
            ':sih_it' => $sihit,
            ':total_cs_amount' => $totalcs,
            ':total_it_amount' => $totalit
        ]);

        echo json_encode([
            'success' => true,
            'line_id' => $conn->lastInsertId()
        ]);
        exit();

    } elseif ($action === 'deliveryperformance') {
        // Generate CSV for delivery performance
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="van_allocation.csv"');

        $companyId = $_GET['companyid'] ?? '';
        $siteid = $_GET['siteid'] ?? '';
        $datefrom = $_GET['datefrom'] ?? null;
        $dateto = $_GET['dateto'] ?? null;

        // SQL to fetch data
        $dataSql = "SELECT 
                        COMPANY_ID, SITE_ID, t.SELLER_ID, t.DATE_CREATED, d.TRANSACTION_ID,
                        d.BARCODE, d.ITEM_CODE, d.DESCRIPTION, d.BATCH, d.CS, d.SW, d.IT, d.PRICE,
                        d.ITEM_PER_CASE, d.ITEM_PER_SW, d.SIH_IT, d.TOTAL_CS_AMOUNT, d.TOTAL_IT_AMOUNT, t.STATUS
                    FROM 
                        Aquila_Van_Loading_Details d
                    INNER JOIN 
                        Aquila_Van_Loading_Transaction t ON t.LOADING_ID = d.TRANSACTION_ID
                    WHERE 
                        t.COMPANY_ID = ? AND t.SITE_ID = ? AND t.DATE_CREATED BETWEEN ? AND ? AND t.STATUS != 'DRAFT'
                    ORDER BY t.DATE_CREATED DESC";

        $dataStmt = $conn->prepare($dataSql);
        $dataStmt->execute([$companyId, $siteid, $datefrom, $dateto]);

        // Output CSV
        $output = fopen('php://output', 'w');

        // CSV header row
        fputcsv($output, [
            'COMPANY_ID', 'SITE_ID', 'SELLER_ID', 'DATE_CREATED', 'TRANSACTION_ID', 
            'BARCODE', 'ITEM_CODE', 'DESCRIPTION', 'BATCH', 'CS', 'SW', 'IT', 
            'PRICE', 'ITEM_PER_CASE', 'ITEM_PER_SW', 'SIH_IT', 'TOTAL_CS_AMOUNT', 
            'TOTAL_IT_AMOUNT', 'STATUS'
        ]);

        // Fetch rows and output
        while ($row = $dataStmt->fetch(PDO::FETCH_ASSOC)) {
            // Force ITEM_CODE as text for Excel
            $row['ITEM_CODE'] = '="' . $row['ITEM_CODE'] . '"';
            fputcsv($output, $row);
        }

        fclose($output);
        exit();

    } elseif ($action === 'loadagents') {
        // Load agent data and output JSON
        header('Content-Type: application/json; charset=utf-8');

        $companyid = $_GET['companyid'] ?? '';
        $siteid = $_GET['siteid'] ?? '';
        $datefrom = $_GET['datefrom'] ?? '';
        $dateto = $_GET['dateto'] ?? '';

        // Query 1: Agent Details
        $stmt = $conn->prepare("SELECT 
                                    COMPANY_ID, SITE_ID, -- Now from Dash_Customer_Master (c)
                                    SITE_NAME, DATE_TO_DELIVER, AGENT, STORE_ENTRY, STORE_EXIT, STORE_TIME_SPENT,
                                    CUSTOMER_ID, CUSTOMER_NAME, PHONE, ADDRESS, IMAGE1, LATITUDE, LONGITUDE, STATUS,
                                    SUB_BATCH, SUB_DA, IS_RECEIVED, VEHICLE_IDS, IS_DROP_STATUS
                                FROM (
                                    SELECT 
                                        b.COMPANY_ID,
                                        a.SITE_ID,
                                        Dash_Sites.SITE_NAME,
                                        b.DATE_TO_DELIVER,
                                        a.AGENT,
                                        d.STORE_ENTRY,
                                        d.STORE_EXIT,
                                        d.STORE_TIME_SPENT,
                                        b.CUSTOMER_ID,
                                        b.CUSTOMER_NAME,
                                        c.PHONE,
                                        c.ADDRESS,
                                        c.IMAGE1,
                                        c.LATITUDE,
                                        c.LONGITUDE,
                                        b.STATUS,
                                        b.SUB_BATCH,
                                        b.SUB_DA,
                                        b.IS_RECEIVED,
                                        b.VEHICLE_IDS,
                                        b.IS_DROP_STATUS,
                                        ROW_NUMBER() OVER (PARTITION BY b.CUSTOMER_ID, b.COMPANY_ID ORDER BY d.STORE_EXIT DESC) AS rn
                                    FROM Dash_Plan_Batch_Transaction a
                                    JOIN Dash_Plan_Batch_Details b ON a.BATCH_ID = b.BATCH AND a.COMPANY_ID = b.COMPANY_ID
                                    LEFT JOIN Dash_Customer_Master c ON c.CODE = b.CUSTOMER_ID AND c.COMPANY_ID = b.COMPANY_ID
                                    LEFT JOIN Dash_Agent_Performance_Detailed d ON b.CUSTOMER_ID = d.STORE_CODE AND b.DATE_TO_DELIVER = d.DELIVERY_DATE AND b.COMPANY_ID = d.COMPANY_ID
                                    LEFT JOIN Dash_Sites ON Dash_Sites.SITE_ID = a.SITE_ID
                                    WHERE b.DATE_TO_DELIVER BETWEEN :datefrom AND :dateto
                                      AND a.STATUS = 'PROCESSED'
                                      AND b.COMPANY_ID = :companyid
                                ) AS subquery
                                WHERE rn = 1;");
        $stmt->execute([':datefrom' => $datefrom, ':dateto' => $dateto, ':companyid' => $companyid]);
        $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Query 2: Agent Performance Summary
        $stmt = $conn->prepare("SELECT 
                                    COMPANY_ID, SITE_ID, AGENT_ID, USERNAME, DELIVERY_DATE, ENTRY_BAT_PERCENTAGE, EXIT_BAT_PERCENTAGE,
                                    TIME_ENTRY, TIME_EXIT, STATUS, LOGIN_ID, TIME_SPENT
                                FROM Dash_Agent_Performance_Summary
                                WHERE 
                                    COMPANY_ID = :companyid
                                    AND DELIVERY_DATE BETWEEN :datefrom AND :dateto
                                    AND STATUS = 'COMPLETE'
                                GROUP BY 
                                    COMPANY_ID, SITE_ID, AGENT_ID, USERNAME, DELIVERY_DATE, ENTRY_BAT_PERCENTAGE, EXIT_BAT_PERCENTAGE,
                                    TIME_ENTRY, TIME_EXIT, STATUS, LOGIN_ID, TIME_SPENT");
        $stmt->execute([':datefrom' => $datefrom, ':dateto' => $dateto, ':companyid' => $companyid]);
        $warehouses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Query 3: Vehicles Data
        $stmt = $conn->prepare("SELECT 
                                    [DISTRIBUTOR_CODE], [BRANCH_CODE], [BRANCH], ORDER_DATE, [DATE] AS INVOICE_DATE,
                                    DATE_TO_DELIVER AS DATE_DELIVERED, [SALES_REP], [SELLER_NAME], AGENT_ID, BATCH,
                                    Dash_Plan_Batch_Details.STATUS,
                                    CASE WHEN ISNULL([RETURN_AMOUNT], 0) = 0 THEN 'NO' ELSE 'YES' END AS HAS_RETURN,
                                    PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME,
                                    [NAME] AS ITEM_ID, [SCHEME_CODE], [SCHEME_SLAB_DESCRIPTION], [SCHEME_GROUP_NAME],
                                    PRFR_Invoice_Detailed.IT_BARCODE, [SW_BARCODE], [DESCRIPTION], [BRAND], [ITEM_CATEGORY],
                                    [BRANDFORM], [TRADE_CHANNEL], [DOCUMENT_NUMBER], [CS], [AMOUNT], [DISCOUNT_VALUE],
                                    [SCHEME_VALUE], [SALES_EX_VAT], [VAT_AMOUNT], [SALES_AMOUNT],
                                    ISNULL([QTY_RETURN], 0) AS QTY_RETURN,
                                    ISNULL([RETURN_AMOUNT], 0) AS RETURN_AMOUNT,
                                    [MONTHLY_TRANSACTION], [PG_LOCAL_SUBSEGMENT], [SALES_SUPERVISOR],
                                    [ITEM_QTY], [GIV], [NIV], [ITEM_QTY_CS], [ITEM_QTY_SW], [ITEM_QTY_IT]
                                FROM [dbo].[PRFR_Invoice_Detailed]
                                LEFT JOIN Dash_Plan_Batch_Details ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                                LEFT JOIN Dash_Returns ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                                WHERE Dash_Plan_Batch_Details.COMPANY_ID = :companyid AND DATE_TO_DELIVER BETWEEN :datefrom AND :dateto");
        $stmt->execute([':datefrom' => $datefrom, ':dateto' => $dateto, ':companyid' => $companyid]);
        $stores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Query 4: Delivery Summary
        $stmt = $conn->prepare("SELECT 
                                    [DISTRIBUTOR_CODE], [BRANCH_CODE], [BRANCH], ORDER_DATE, [DATE] AS INVOICE_DATE,
                                    Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED, [SALES_REP], [SELLER_NAME], AGENT_ID, BATCH,
                                    Dash_Plan_Batch_Details.STATUS,
                                    CASE WHEN SUM(ISNULL([RETURN_AMOUNT], 0)) = 0 THEN 'NO' ELSE 'YES' END AS HAS_RETURN,
                                    PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME,
                                    [DOCUMENT_NUMBER], SUM([SALES_AMOUNT]) AS TOTAL,
                                    PG_LOCAL_SUBSEGMENT,
                                    MAX(Dash_Agent_Performance_Detailed.STORE_ENTRY) AS STORE_ENTRY,
                                    MAX(Dash_Agent_Performance_Detailed.STORE_EXIT) AS STORE_EXIT,
                                    MAX(Dash_Agent_Performance_Detailed.STORE_TIME_SPENT) AS STORE_TIME_SPENT
                                FROM [dbo].[PRFR_Invoice_Detailed]
                                LEFT JOIN Dash_Plan_Batch_Details ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                                LEFT JOIN Dash_Returns ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                                LEFT JOIN Dash_Agent_Performance_Detailed ON Dash_Agent_Performance_Detailed.DELIVERY_DATE = Dash_Plan_Batch_Details.DATE_TO_DELIVER AND Dash_Agent_Performance_Detailed.STORE_CODE = PRFR_Invoice_Detailed.CUSTOMER_ID AND Dash_Agent_Performance_Detailed.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE
                                WHERE Dash_Plan_Batch_Details.COMPANY_ID = :companyid AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN :datefrom AND :dateto
                                GROUP BY [DISTRIBUTOR_CODE], [BRANCH_CODE], [BRANCH], ORDER_DATE, [DATE], Dash_Plan_Batch_Details.DATE_TO_DELIVER,
                                [SALES_REP], [SELLER_NAME], AGENT_ID, BATCH, Dash_Plan_Batch_Details.STATUS, 
                                PRFR_Invoice_Detailed.CUSTOMER_ID, PRFR_Invoice_Detailed.CUSTOMER_NAME, [DOCUMENT_NUMBER], PG_LOCAL_SUBSEGMENT");
        $stmt->execute([':datefrom' => $datefrom, ':dateto' => $dateto, ':companyid' => $companyid]);
        $summary = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Query 5: SO Report
        $stmt = $conn->prepare("SELECT 
                                    [COMPANY_ID], [SITE_ID], [UPLOAD_BY_USER_ID], [DIST_NAME], [BRANCH_NAME], [SELLER_TYPE], [SELLER_NAME], 
                                    [CUSTOMER_NAME], [STORE_CODE], [CHANNEL_NAME], [SUB_CHANNEL_NAME], [ORDER_DATE], [ORDER_ID],
                                    [PRD_SKU_CODE], [PRD_SKU_NAME], [BARCODE], [CS_QTY], [QTY_PIECE], [PRICE_PIECE], [SCHEME_CODE],
                                    [SCHEME_DESC], [ORDER_VALUE_WITHOUTSCHEME], [SCHEME_VALUE], [ORDER_VALUE], [ORDER_SOURCE], [IS_PLAN]
                                FROM [dbo].[PRFR_SO_UPLOAD]
                                WHERE COMPANY_ID = :companyid AND ORDER_DATE BETWEEN :datefrom AND :dateto");
        $stmt->execute([':datefrom' => $datefrom, ':dateto' => $dateto, ':companyid' => $companyid]);
        $soreport = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output all data as JSON
        echo json_encode([
            "Agent Performance Detailed" => $agents,
            "Agent Performance Summary" => $warehouses,
            "Delivery Result Detailed" => $stores,
            "Delivery Result Summary" => $summary,
            "SO Report" => $soreport
        ], JSON_UNESCAPED_UNICODE);
        exit();
        }

// so report

   elseif ($action === 'soreport') {
        // Load agent data and output JSON
        header('Content-Type: application/json; charset=utf-8');

        $companyid = $_GET['companyid'] ?? '';
        $siteid = $_GET['siteid'] ?? '';
        $datefrom = $_GET['datefrom'] ?? '';
        $dateto = $_GET['dateto'] ?? '';
    
        // Query 5: SO Report
        $stmt = $conn->prepare("SELECT 
                                    [COMPANY_ID], [SITE_ID], [UPLOAD_BY_USER_ID], [DIST_NAME], [BRANCH_NAME], [SELLER_TYPE], [SELLER_NAME], 
                                    [CUSTOMER_NAME], [STORE_CODE], [CHANNEL_NAME], [SUB_CHANNEL_NAME], [ORDER_DATE], [ORDER_ID],
                                    [PRD_SKU_CODE], [PRD_SKU_NAME], [BARCODE], [CS_QTY], [QTY_PIECE], [PRICE_PIECE], [SCHEME_CODE],
                                    [SCHEME_DESC], [ORDER_VALUE_WITHOUTSCHEME], [SCHEME_VALUE], [ORDER_VALUE], [ORDER_SOURCE], [IS_PLAN]
                                FROM [dbo].[PRFR_SO_UPLOAD]
                                WHERE COMPANY_ID = :companyid AND ORDER_DATE BETWEEN :datefrom AND :dateto");
        $stmt->execute([':datefrom' => $datefrom, ':dateto' => $dateto, ':companyid' => $companyid]);
        $soreport = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output all data as JSON
        echo json_encode([
            "SO Report" => $soreport
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }

     elseif ($action === 'result') {
        // Load agent data and output JSON
        header('Content-Type: application/json; charset=utf-8');

        $companyid = $_GET['companyid'] ?? '';
        $siteid = $_GET['siteid'] ?? '';
        $datefrom = $_GET['datefrom'] ?? '';
        $dateto = $_GET['dateto'] ?? '';

        // Query 1: Agent Details
        $stmt = $conn->prepare("SELECT 
                        [DISTRIBUTOR_CODE],
                        [BRANCH_CODE],
                        [BRANCH],
                        ORDER_DATE,
                        [DATE] AS INVOICE_DATE,
                        Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED,
                        [SALES_REP],
                        [SELLER_NAME],
                        AGENT_ID,
                        BATCH,
                        Dash_Plan_Batch_Details.STATUS,
                        CASE 
                            WHEN SUM(ISNULL([RETURN_AMOUNT], 0)) = 0 THEN 'NO' 
                            ELSE 'YES' 
                        END AS HAS_RETURN,
                        PRFR_Invoice_Detailed.CUSTOMER_ID,
                        PRFR_Invoice_Detailed.CUSTOMER_NAME,
                        [DOCUMENT_NUMBER],
                        SUM([SALES_AMOUNT]) AS TOTAL,
                        PG_LOCAL_SUBSEGMENT,
                        MAX(Dash_Agent_Performance_Detailed.STORE_ENTRY) AS STORE_ENTRY,
                        MAX(Dash_Agent_Performance_Detailed.STORE_EXIT) AS STORE_EXIT,
                        MAX(Dash_Agent_Performance_Detailed.STORE_TIME_SPENT) AS STORE_TIME_SPENT
                    FROM [dbo].[PRFR_Invoice_Detailed]
                    LEFT JOIN Dash_Plan_Batch_Details 
                        ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER 
                        AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                    LEFT JOIN Dash_Returns 
                        ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER 
                        AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID 
                        AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                    LEFT JOIN Dash_Agent_Performance_Detailed
                        ON Dash_Agent_Performance_Detailed.DELIVERY_DATE = Dash_Plan_Batch_Details.DATE_TO_DELIVER
                        AND Dash_Agent_Performance_Detailed.STORE_CODE = PRFR_Invoice_Detailed.CUSTOMER_ID
                        AND Dash_Agent_Performance_Detailed.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE
                    WHERE Dash_Plan_Batch_Details.COMPANY_ID = :companyid
                        AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN :datefrom AND :dateto
                    GROUP BY 
                        [DISTRIBUTOR_CODE],
                        [BRANCH_CODE],
                        [BRANCH],
                        ORDER_DATE,
                        [DATE],
                        Dash_Plan_Batch_Details.DATE_TO_DELIVER,
                        [SALES_REP],
                        [SELLER_NAME],
                        AGENT_ID,
                        BATCH,
                        Dash_Plan_Batch_Details.STATUS,
                        PRFR_Invoice_Detailed.CUSTOMER_ID,
                        PRFR_Invoice_Detailed.CUSTOMER_NAME,
                        [DOCUMENT_NUMBER],
                        PG_LOCAL_SUBSEGMENT");
        $stmt->execute([':datefrom' => $datefrom, ':dateto' => $dateto, ':companyid' => $companyid]);
        $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Query 2: Agent Performance Summary
    
        // Output all data as JSON
        echo json_encode([
            "Details" => $agents,

        ], JSON_UNESCAPED_UNICODE);
        exit();
    

    } else {
        // Invalid or missing action
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'No valid action']);
        exit();
    }
} catch (Exception $e) {
    // Handle exceptions
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    exit();
}
?>
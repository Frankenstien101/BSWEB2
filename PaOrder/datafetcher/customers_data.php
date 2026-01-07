<?php
session_start();
include __DIR__ . '/../../DB/dbcon.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

try {
    if ($action === 'viewmyorders') {
        $storeid = $_GET['storeid'] ?? '';

        $sql = "SELECT 
                    [ORDER_DATE] AS order_date,
                    [SO_NUMBER] AS order_no,
                    TOTAL_AMOUNT,
                    [IS_PLAN] AS STATUS
                FROM [dbo].[Dash_SO_Plan_Batch_Details] 
                WHERE [CUSTOMER_ID] = :storeid AND IS_PLAN IN ('1','0')
                ORDER BY ORDER_DATE DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':storeid' => $storeid]);
        $orders = $stmt->fetchAll();

        echo json_encode(['success' => true, 'data' => $orders]);
        exit;

    } else if ($action === 'getOrderDetails') {
        $order_no = $_GET['order_no'] ?? '';

        $sql = "SELECT PRD_SKU_CODE, PRD_SKU_NAME, QTY_PIECE, PRICE_PIECE, ORDER_VALUE 
                FROM PRFR_SO_UPLOAD 
                WHERE ORDER_ID = :order_no";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':order_no' => $order_no]);
        $items = $stmt->fetchAll();

        echo json_encode(['success' => true, 'data' => $items]);
        exit;

    } else if ($action === 'viewCompletedOrders') {
        $storeid = $_GET['storeid'] ?? '';

        $sql = "SELECT 
                    INVOICE_NUMBER AS order_no,
                    TOTAL_AMOUNT,
                    ORDER_DATE AS order_date,
                    DATE_TO_DELIVER,
                    AGENT_DELIVERED,
                    STATUS
                FROM Dash_Plan_Batch_Details 
                WHERE CUSTOMER_ID = :storeid 
                  AND STATUS IN ('DELIVERED','FAILED','REJECTED','VERIFIED')
                ORDER BY ORDER_DATE DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':storeid' => $storeid]);
        $orders = $stmt->fetchAll();

        echo json_encode(['success' => true, 'data' => $orders]);
        exit;

    } else if ($action === 'viewForDeliveryOrders') {
        $storeid = $_GET['storeid'] ?? '';

        $sql = "SELECT 
                    INVOICE_NUMBER AS order_no,
                    TOTAL_AMOUNT,
                    ORDER_DATE AS order_date,
                    DATE_TO_DELIVER,
                    AGENT_DELIVERED,
                    STATUS
                FROM Dash_Plan_Batch_Details 
                WHERE CUSTOMER_ID = :storeid AND STATUS = 'FOR DELIVERY'
                ORDER BY ORDER_DATE DESC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':storeid' => $storeid]);
        $orders = $stmt->fetchAll();

        echo json_encode(['success' => true, 'data' => $orders]);
        exit;

    } else if ($action === 'getCompletedOrderDetails') {
        $orderno = $_GET['order_no'] ?? '';

        $sql = "SELECT 
                    INVOICE_NUMBER,
                    TOTAL_AMOUNT,
                    DATE_TO_DELIVER,
                    AGENT_ID,
                    AGENT_DELIVERED,
                    CASE 
                        WHEN NULLIF(IMG1, '') IS NOT NULL THEN IMG1
                        ELSE IMG2
                    END AS POD_IMAGE
                FROM [dbo].[Dash_Plan_Batch_Details]
                LEFT JOIN Dash_PaymentPOD ON Dash_PaymentPOD.INV_ID = INVOICE_NUMBER
                WHERE INVOICE_NUMBER = :orderno";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':orderno' => $orderno]);
        $details = $stmt->fetchAll();

        echo json_encode(['success' => true, 'data' => $details]);
        exit;

    } else if ($action === 'getDeliveryDetails') {
        $orderno = $_GET['order_no'] ?? '';

        $sql = "SELECT TOP 1
    DPBD.SITE_ID,
    DPBD.INVOICE_NUMBER,
    DPBD.STATUS,
    DPBD.DATE_TO_DELIVER,
    DPBD.STORE_LAT,
    DPBD.STORE_LONG,
    DPBD.CUSTOMER_ID,
    DPBD.CUSTOMER_NAME,
    DPBD.AGENT_ID AS MAIN_AGENT,
    DA.SUB_DA AS SUB_AGENT,
    DA.AGENT_NAME AS RIDER_NAME,
    DPBD.VEHICLE_IDS AS VEHICLE,
    DPBD.ORDER_DATE,
    DPBD.AGENT_DELIVERED,
    DPBD.DATETIME_PROCESSED,
    DS.WAREHOUSE_LAT AS warehouse_lat,
    DS.WAREHOUSE_LONG AS warehouse_lng,
    LAL.LAT_CAPTURED AS rider_lat,
    LAL.LONG_CAPTURED AS rider_lng
FROM Dash_Plan_Batch_Details DPBD
LEFT JOIN Dash_Agents DA 
    ON DA.USERNAME = DPBD.AGENT_ID
LEFT JOIN Dash_Sites DS 
    ON DS.SITE_ID = DPBD.SITE_ID
-- Get only the latest location for the relevant sub-agent on the delivery date
OUTER APPLY (
    SELECT TOP 1 
        ATS.LAT_CAPTURED,
        ATS.LONG_CAPTURED
    FROM Dash_Agent_Time_Stamp ATS
    WHERE ATS.AGENT_ID = DA.SUB_DA
      AND CAST(ATS.DELIVERY_DATE AS DATE) = CAST(DPBD.DATE_TO_DELIVER AS DATE)
    ORDER BY ATS.TIME_STAMP DESC
) LAL
WHERE DPBD.INVOICE_NUMBER = :orderno;";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':orderno' => $orderno]);
        $details = $stmt->fetchAll();

        echo json_encode(['success' => true, 'data' => $details]);
        exit;

    } else if ($action === 'getOrderItems' || $action === 'getOrderItemsCompleted') {
        $orderno = $_GET['order_no'] ?? '';

        $sql = "SELECT DESCRIPTION, ITEM_QTY_IT, SALES_AMOUNT
                FROM PRFR_Invoice_Detailed 
                WHERE DOCUMENT_NUMBER = :orderno";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':orderno' => $orderno]);
        $items = $stmt->fetchAll();

        echo json_encode(['success' => true, 'data' => $items]);
        exit;

 } else if ($action === 'getProductList') {
    $search = $_GET['search'] ?? '';

    $sql = "SELECT TOP 500 
                PRODUCT_CODE AS SKU,
                IT_BARCODE AS PRD_BARCODE,
                DESCRIPTION,
                IT_COST AS SELLING_PRICE
            FROM PRFR_Product_Master 
            WHERE 1=1 AND DESCRIPTION IS NOT NULL AND PRODUCT_CODE IS NOT NULL";

    $params = [];
    if ($search) {
        $sql .= " AND (PRODUCT_CODE LIKE ? OR IT_BARCODE LIKE ? OR DESCRIPTION LIKE ?)";
        $like = "%$search%";
        $params = [$like, $like, $like];
    }

    $sql .= "GROUP BY PRODUCT_CODE,IT_BARCODE,DESCRIPTION,IT_COST ORDER BY DESCRIPTION ";

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll();

    echo json_encode(['success' => true, 'data' => $products]);
    exit;

} else if ($action === 'submitBooking') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || !isset($input['items']) || empty($input['items'])) {
        echo json_encode(['success' => false, 'error' => 'No items in order']);
        exit;
    }

    $companyid  = $_SESSION['Company_ID'] ?? '';
    $siteid     = $_SESSION['SITE_ID'] ?? '';
    $store_id   = $input['store_id'] ?? '';
    $principal  = $input['principal'] ?? '';
    $user_name  = $input['user_name'] ?? '';
    $items      = $input['items'];
    $total_amount = $input['total_amount'] ?? 0;

    $order_no = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));

    try {
        $conn->beginTransaction();

        // Insert main order
        $sql_order = "INSERT INTO OK_Store_Order_Transaction 
                      (COMPANY_ID, SITE_ID, PRINCIPAL, CUSTOMER_ID, CUSTOMER_NAME, 
                       ORDER_DATE, ORDER_ID, TOTAL_AMOUNT, STATUS)
                      VALUES 
                      (:companyid, :siteid, :principal, :store_id, :user_name, 
                       GETDATE(), :order_no, :total_amount, 'PENDING')";

        $stmt_order = $conn->prepare($sql_order);
        $stmt_order->execute([
            ':companyid'    => $companyid,
            ':siteid'       => $siteid,
            ':principal'    => $principal,
            ':store_id'     => $store_id,
            ':user_name'    => $user_name,
            ':order_no'     => $order_no,
            ':total_amount' => $total_amount
        ]);

        // Insert items - CORRECTED: Calculate AMOUNT in PHP
        $sql_item = "INSERT INTO OK_Store_Order_Details 
                     (COMPANY_ID, SITE_ID, PRINCIPAL, ORDER_ID, BARCODE, DESCRIPTION, QTY, PRICE, AMOUNT, STATUS)
                     VALUES 
                     (:companyid, :siteid, :principal, :order_no, :barcode, :description, :qty, :price, :amount, 'PENDING')";

        $stmt_item = $conn->prepare($sql_item);

        foreach ($items as $item) {
            $amount = ($item['price'] ?? 0) * ($item['qty'] ?? 1);  // Calculate here

            $stmt_item->execute([
                ':companyid'   => $companyid,
                ':siteid'      => $siteid,
                ':principal'   => $principal,
                ':order_no'    => $order_no,
                ':barcode'     => $item['barcode'] ?? '',
                ':description' => $item['description'] ?? '',
                ':qty'         => $item['qty'] ?? 1,
                ':price'       => $item['price'] ?? 0,
                ':amount'      => $amount  // ← bound correctly
            ]);
        }

        $conn->commit();

        echo json_encode([
            'success'  => true,
            'order_no' => $order_no,
            'message'  => 'Order saved successfully'
        ]);

    } catch (Exception $e) {
        $conn->rollBack();
        error_log('Order submit error: ' . $e->getMessage());
        echo json_encode([
            'success' => false,
            'error'   => 'Database error: ' . $e->getMessage()
        ]);
    }
    exit;
}

} catch (Exception $e) {
    // Log error internally, don't expose details in production
    error_log('API Error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Server error']);
    exit;
}
?>
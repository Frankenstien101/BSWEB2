<?php
session_start();
include __DIR__ . '/../../DB/dbcon.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

try {

if ($action === 'viewmyorders') {

    $companyId = $_GET['companyid'] ?? '';
    $storeid   = $_GET['storeid'] ?? '';

    $sql = "
    
 SELECT 

      [CUSTOMER_NAME]
      ,[STORE_CODE]
      ,[ORDER_DATE] AS order_date
      ,[ORDER_ID] as order_no
      ,SUM(ORDER_VALUE) AS TOTAL_AMOUNT
      ,[IS_PLAN] AS STATUS

  FROM [dbo].[PRFR_SO_UPLOAD] WHERE [STORE_CODE] = :storeid AND IS_PLAN IN ('1','0')

  GROUP BY  [CUSTOMER_NAME]
      ,[STORE_CODE]
      ,[ORDER_DATE]
      ,[ORDER_ID]
      ,[IS_PLAN]

    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':storeid'   => $storeid
    ]);

    $orders = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'data'    => $orders
    ]);
    exit;

    } else if ($action === 'getOrderDetails') {
    $ORDER_NO = $_GET['order_no'] ?? '';

    $sql = "
      
    SELECT PRD_SKU_CODE,PRD_SKU_NAME,QTY_PIECE,PRICE_PIECE,ORDER_VALUE  FROM PRFR_SO_UPLOAD WHERE ORDER_ID = :order_no

    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':order_no'   => $ORDER_NO
    ]);

    $orders = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'data'    => $orders
    ]);
    exit;


 /// for completerd orders
} else if ($action === 'viewCompletedOrders') {
    $storeid   = $_GET['storeid'] ?? '';

    $sql = "
      
  SELECT 
  
  INVOICE_NUMBER as order_no ,TOTAL_AMOUNT ,ORDER_DATE AS order_date,DATE_TO_DELIVER,AGENT_DELIVERED,STATUS

  FROM Dash_Plan_Batch_Details WHERE CUSTOMER_ID = :storeid AND STATUS IN('DELIVERED','FAILED','REJECTED','VERIFIED')

  ORDER BY ORDER_DATE DESC  ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':storeid'   => $storeid
    ]);

    $orders = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'data'    => $orders
    ]);
    exit;

/// for delivery card 

    } else if ($action === 'viewForDeliveryOrders') {
    $storeid   = $_GET['storeid'] ?? '';

    $sql = "
      
  SELECT 
  
  INVOICE_NUMBER as order_no ,TOTAL_AMOUNT ,ORDER_DATE AS order_date,DATE_TO_DELIVER,AGENT_DELIVERED,STATUS

  FROM Dash_Plan_Batch_Details WHERE CUSTOMER_ID = :storeid AND STATUS = 'FOR DELIVERY'

  ORDER BY ORDER_DATE DESC  ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':storeid'   => $storeid
    ]);

    $orders = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'data'    => $orders
    ]);
    exit;


// get completed orders modal
} else if ($action === 'getCompletedOrderDetails') {
    $orderno = $_GET['order_no'] ?? '';

    // SQL with proper NULL/empty string handling
    $sql = "
        SELECT 
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
        LEFT JOIN Dash_PaymentPOD
            ON Dash_PaymentPOD.INV_ID = INVOICE_NUMBER
        WHERE INVOICE_NUMBER = :orderno
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':orderno' => $orderno
    ]);

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Optional: ensure UTF-8 encoding to prevent JSON issues
 

    echo json_encode([
        'success' => true,
        'data' => $orders
    ]);
    exit;


// FOR DELIVERY MODAL 

} else if ($action === 'getDeliveryDetails') {
    $orderno = $_GET['order_no'] ?? '';

    // SQL with proper NULL/empty string handling
    $sql = "

    SELECT 

    NAME, DESCRIPTION  AS PRD_SKU_NAME, ITEM_QTY AS QTY_PIECE,SALES_AMOUNT AS ORDER_VALUE
        FROM PRFR_Invoice_Detailed
        
        WHERE DOCUMENT_NUMBER = :orderno
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':orderno' => $orderno
    ]);

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Optional: ensure UTF-8 encoding to prevent JSON issues
 

    echo json_encode([
        'success' => true,
        'data' => $orders
    ]);
    exit;


    } else {
        echo json_encode(['success'=>false, 'error'=>'No valid action']);
        exit();

    /// add to ledger 

    }

} catch (Exception $e) {
    echo json_encode(['success'=>false, 'error'=>$e->getMessage()]);
    exit();
}

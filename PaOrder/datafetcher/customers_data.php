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

      [ORDER_DATE] AS order_date
      ,[SO_NUMBER] as order_no
      ,TOTAL_AMOUNT
      ,[IS_PLAN] AS STATUS

  FROM [dbo].[Dash_SO_Plan_Batch_Details] WHERE [CUSTOMER_ID] = :storeid AND IS_PLAN IN ('1','0')

    ORDER BY ORDER_DATE DESC
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
            WITH LastAgentLocation AS (
            SELECT
                ATS.AGENT_ID,
                CAST(ATS.DELIVERY_DATE AS DATE) AS DELIVERY_DATE,
                ATS.LAT_CAPTURED,
                ATS.LONG_CAPTURED,
                ROW_NUMBER() OVER (
                    PARTITION BY ATS.AGENT_ID, CAST(ATS.DELIVERY_DATE AS DATE)
                    ORDER BY ATS.TIME_STAMP DESC
                ) AS RN
            FROM Dash_Agent_Time_Stamp ATS
        )
        
        SELECT TOP 1
              DPBD.SITE_ID,
              DPBD.INVOICE_NUMBER,
              DPBD.STATUS,
              DPBD.DATE_TO_DELIVER,
              DPBD.STORE_LAT,
              DPBD.STORE_LONG,
              DPBD.CUSTOMER_ID,
              DPBD.CUSTOMER_NAME,
                
              DPBD.AGENT_ID                AS MAIN_AGENT,
              DA.SUB_DA                    AS SUB_AGENT,
              DA.AGENT_NAME                AS RIDER_NAME,
        
              DPBD.VEHICLE_IDS             AS VEHICLE,
              DPBD.ORDER_DATE,
              DPBD.AGENT_DELIVERED,
              DPBD.DATETIME_PROCESSED,
        
              DS.WAREHOUSE_LAT             AS warehouse_lat,
              DS.WAREHOUSE_LONG            AS warehouse_lng,
        
              -- LAST GPS FROM SUB_DA
              LAL.LAT_CAPTURED             AS rider_lat,
              LAL.LONG_CAPTURED            AS rider_lng
        
        FROM Dash_Plan_Batch_Details DPBD
        
        -- MAIN AGENT → AGENTS TABLE
        LEFT JOIN Dash_Agents DA
            ON DA.USERNAME = DPBD.AGENT_ID
        
        -- SITE
        LEFT JOIN Dash_Sites DS
            ON DS.SITE_ID = DPBD.SITE_ID
        
        -- GPS USING SUB_DA
        LEFT JOIN LastAgentLocation LAL
            ON LAL.AGENT_ID = DA.SUB_DA
           AND LAL.DELIVERY_DATE = CAST(DPBD.DATE_TO_DELIVER AS DATE)
           AND LAL.RN = 1
        
        WHERE DPBD.INVOICE_NUMBER = :orderno;
        

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

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
    D.SO_NUMBER AS order_no,
    D.SO_PLAN_NUMBER,
    P.STATUS AS PLAN_STATUS,
    CASE
        WHEN P.STATUS IN ('VERIFIED', 'DELIVERED') THEN '4'
        WHEN P.STATUS = 'FAILED' THEN '5'
        ELSE D.IS_PLAN
    END AS STATUS,

    D.ORDER_DATE AS order_date,
    P.DATE_TO_DELIVER,
    D.TOTAL_AMOUNT

FROM dbo.Dash_SO_Plan_Batch_Details D
LEFT JOIN dbo.Dash_Plan_Batch_Details P
    ON D.SO_PLAN_NUMBER = REPLACE(P.BATCH,'DLV','')
   AND D.CUSTOMER_ID = P.CUSTOMER_ID

WHERE D.CUSTOMER_ID = :storeid

ORDER BY D.ORDER_DATE DESC

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
       SELECT * FROM PRFR_SO_UPLOAD WHERE ORDER_ID = :order_no

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




    } else {
        echo json_encode(['success'=>false, 'error'=>'No valid action']);
        exit();

    /// add to ledger 


    }

} catch (Exception $e) {
    echo json_encode(['success'=>false, 'error'=>$e->getMessage()]);
    exit();
}

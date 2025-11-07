<?php
include "../db_connection.php";

$BATCH_ID = $_GET['BATCH_ID'] ?? '';

$markers = [];

try {
    $sql = "
        SELECT DISTINCT
            a.AGENT, a.VEHICLE_ID,
            STORE_ENTRY,
            STORE_EXIT,
            STORE_TIME_SPENT,
            CASE
                WHEN STORE_TIME_SPENT > 0 THEN 'VISITED'
                WHEN STORE_TIME_SPENT = 0 THEN 'PASSED BY'
                ELSE 'NOT VISITED'
            END AS VISIT_STATUS,
            CASE
                WHEN STORE_TIME_SPENT > 0 THEN 'pin_visited.png'
                WHEN STORE_TIME_SPENT = 0 THEN 'pin_pass_by.png'
                ELSE 'pin_not_visited.png'
            END AS ICON,
            SEQ,
            b.CUSTOMER_ID,
            b.CUSTOMER_NAME,
            PHONE,
            c.ADDRESS,
            IMAGE1,
            c.LATITUDE,
            c.LONGITUDE,
            b.STATUS
        FROM Dash_Plan_Batch_Transaction a
        JOIN Dash_Plan_Batch_Details b ON a.BATCH_ID = b.BATCH
        LEFT JOIN Dash_Customer_Master c ON c.CODE = b.CUSTOMER_ID AND c.COMPANY_ID = b.COMPANY_ID
        LEFT JOIN Dash_Agent_Performance_Detailed d ON b.CUSTOMER_ID = d.STORE_CODE AND b.DATE_TO_DELIVER = d.DELIVERY_DATE
        WHERE BATCH = :batch
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':batch', $BATCH_ID);
    $stmt->execute();

    $markers = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $error) {
    echo json_encode([
        "error" => true,
        "message" => $error->getMessage()
    ]);
    exit;
}

// ✅ Output JSON safely
header('Content-Type: application/json');
echo json_encode($markers);
?>

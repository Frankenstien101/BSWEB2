<?php
include "../db_connection.php";

$DELIVERY_DATE = $_GET['DELIVERY_DATE'] ?? '';
$AGENT_ID      = $_GET['AGENT_ID'] ?? '';

$markers = [];

try {
    // ✅ Use parameterized SQL (SAFE)
    $sql = "
        SELECT *
        FROM Dash_Agent_Time_Stamp
        WHERE TIME_MINUTES BETWEEN '06:00' AND '24:00'
          AND DELIVERY_DATE = :delivery_date
          AND AGENT_ID = :agent_id
        ORDER BY TIME_MINUTES ASC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':delivery_date', $DELIVERY_DATE);
    $stmt->bindValue(':agent_id', $AGENT_ID);
    $stmt->execute();

    $markers = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // ✅ Return an error as JSON if needed
    echo json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
    exit;
}

// ✅ Always return JSON
header('Content-Type: application/json');
echo json_encode($markers);
?>

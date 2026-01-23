<?php
include "../db_connection.php";
$COMPANY_ID = $_SESSION['selected_comp'] ?? '0';
$SITE_ID = $_SESSION['selected_site'] ?? '0';
$markers = [];
try {
    $sql = "
 SELECT * from [dbo].[KAVS_ACCOUNTS] C JOIN [dbo].[KAVS_ACCOUNT_IMG] I ON C.ACCOUNT_ID=I.ACCOUNT_ID  where C.COMPANY_ID=2 AND C.SITE_ID=4 and LATITUDE != 0
 order by mapped_at desc
";
    $stmt = $conn->prepare($sql);
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

<?php
session_start();
include '../db_connection.php';

try {
    if (empty($_POST['sites']) || empty($_POST['dtfrom']) || empty($_POST['dtto'])) {
        throw new Exception("Missing required parameters.");
    }

    $comp_id = $_SESSION['comp_id'] ?? null;
    if (!$comp_id) throw new Exception("Session expired or missing company ID.");

    $sitesArray = is_array($_POST['sites']) ? $_POST['sites'] : explode(',', $_POST['sites']);
    $escapedSites = implode(",", array_map(fn($s) => "'" . addslashes(trim($s)) . "'", $sitesArray));

    // ✅ Fast SQL (no heavy GROUP BY, no ISNULL in SELECT)
    $query = "
        SELECT 
            d.CODE,
            s.SITE_CODE,
            ISNULL(a.BRAND,'DEFAULT') AS BRAND,
            a.SELLER_ID,
            a.CU_ID,
            a.CU_NAME,
            '' AS STATUS,
            ISNULL(a.PHOTO_STATUS,'PENDING') AS PHOTO_STATUS,
            '' AS After_comment,
            '' AS Before_comment,
            l.BEFORE_LINK AS img_before,
            l.AFTER_LINK AS img_after,
            l.COT_LINK,
            a.DISTANCE AS DISTANCE,
            a.DATE_PROCESS AS DATE_CAPTURED,
            a.VALIDATED_DATE AS DATE_VALIDATED,
            a.USER_ID AS USER_VALIDATED
        FROM dbo.Aquila_PQR a WITH (NOLOCK)
        LEFT JOIN dbo.Aquila_PQR_Link l WITH (NOLOCK)
            ON a.PQR_ID = l.PQR_ID
        JOIN dbo.Aquila_Sites s WITH (NOLOCK)
            ON a.SITE_ID = s.SITEID AND a.COMPANY_ID = s.COMPANY_ID
        JOIN dbo.Aquila_COMPANY d WITH (NOLOCK)
            ON a.COMPANY_ID = d.ID
        WHERE a.COMPANY_ID = :comp_id
          AND a.SITE_ID IN ($escapedSites)
          AND a.DATE_PROCESS BETWEEN :dtfrom AND :dtto
        ORDER BY a.DATE_PROCESS DESC
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':comp_id' => $comp_id,
        ':dtfrom' => $_POST['dtfrom'],
        ':dtto'   => $_POST['dtto']
    ]);

    // ✅ Stream CSV (no buffering)
    $filename = "PQR_Validated_Detail_" . date('Ymd_His') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    $out = fopen('php://output', 'w');
    fputcsv($out, [
        'CODE', 'SITE_CODE', 'BRAND', 'SELLER_ID', 'CU_ID', 'CU_NAME',
        'STATUS', 'PHOTO_STATUS', 'After_comment', 'Before_comment',
        'img_before|Shelf', 'img_after|Display', 'Counter-Top',
        'DISTANCE', 'DATE_CAPTURED', 'DATE_VALIDATED', 'USER_VALIDATED'
    ]);

    // ✅ Fetch row-by-row to stream
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        fputcsv($out, $row);
        flush(); // push to browser immediately
    }

    fclose($out);
    exit;

} catch (Throwable $e) {
    http_response_code(500);
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>

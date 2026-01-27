<?php
session_start();
include __DIR__ . '/../../DB/dbcon.php';

try {
    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    $action = $_GET['action'] ?? '';

    if ($action === 'forload') {

        $company_id = $_SESSION['Company_ID'] ?? '';

        // AUTO MARK FOR LOAD
        $updateSql = "
            UPDATE BS_Device
            SET LOAD_STATUS = 'FOR LOAD'
            WHERE COMPANY_ID = :company_id
              AND (
                    BALANCE < 5
                    OR LAST_LOAD_HISTORY IS NULL
                    OR LAST_LOAD_HISTORY < DATEADD(MONTH, -6, GETDATE())
                  )
        ";
        $upd = $conn->prepare($updateSql);
        $upd->execute([':company_id' => $company_id]);


        $sql = "
            SELECT 
                LINEID,
                SITE_ID,
                DEPARTMENT,
                PRINCIPAL,
                POSITION,
                BRAND,
                MODEL,
                SERIAL,
                DATE_DEPLOYED,
                PERSON_USING,
                NUMBER,
                BALANCE,
                LOAD_STATUS,
                LAST_LOAD_HISTORY
            FROM BS_Device
            WHERE COMPANY_ID = :company_id
              AND (
                    BALANCE < 5
                    OR LAST_LOAD_HISTORY < DATEADD(MONTH, -6, GETDATE())
              )
            ORDER BY DATE_ADDED DESC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':company_id' => $company_id
        ]);

        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
    }

    echo json_encode([]);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

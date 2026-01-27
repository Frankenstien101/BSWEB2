<?php
session_start();
include __DIR__ . '/../../DB/dbcon.php';

$action = $_GET['action'] ?? '';

if (isset($_GET['action']) && $_GET['action'] === 'loaddevice') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];

        $sql = "SELECT * FROM BS_Device
                WHERE COMPANY_ID = :companyid
                ORDER BY SITE_ID ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($items ?: []);
        
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Application error', 'message' => $e->getMessage()]);
    }
    exit();
}
if ($action === 'updateonly') {

    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
        exit;
    }

    $lineid = $input['id'] ?? null;

    if (!$lineid) {
        echo json_encode(['success' => false, 'message' => 'LINEID is required']);
        exit;
    }

    try {
        // Single update query only
        $updateSql = "
            UPDATE BS_Device
            SET
                SITE_ID       = :SITE_ID,
                DEPARTMENT    = :DEPARTMENT,
                PRINCIPAL     = :PRINCIPAL,
                POSITION      = :POSITION,
                BRAND         = :BRAND,
                MODEL         = :MODEL,
                IMEI          = :IMEI,
                SERIAL        = :SERIAL,
                DATE_DEPLOYED = :DATE_DEPLOYED,
                PERSON_USING  = :PERSON_USING,
                NUMBER        = :NUMBER,
                BALANCE       = :BALANCE,
                REMARKS       = :REMARKS
            WHERE LINEID = :LINEID
        ";

        $stmt = $conn->prepare($updateSql);
        $stmt->execute([
            ':SITE_ID'       => $input['SITE_ID'],
            ':DEPARTMENT'    => $input['DEPARTMENT'],
            ':PRINCIPAL'     => $input['PRINCIPAL'],
            ':POSITION'      => $input['POSITION'],
            ':BRAND'         => $input['BRAND'],
            ':MODEL'         => $input['MODEL'],
            ':IMEI'          => $input['IMEI'],
            ':SERIAL'        => $input['SERIAL'],
            ':DATE_DEPLOYED' => $input['DATE_DEPLOYED'],
            ':PERSON_USING'  => $input['PERSON_USING'],
            ':NUMBER'        => $input['NUMBER'],
            ':BALANCE'       => $input['BALANCE'],
            ':REMARKS'       => $input['REMARKS'],
            ':LINEID'        => $lineid
        ]);

        echo json_encode(['success' => true]);
        exit;

    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}



if ($action === 'update_device') {

    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
        exit;
    }

    $lineid = $input['id'] ?? null;

    if (!$lineid) {
        echo json_encode(['success' => false, 'message' => 'LINEID is required']);
        exit;
    }

    try {

        $conn->beginTransaction();

        $updateSql = "
            UPDATE BS_Device
            SET
                SITE_ID       = :SITE_ID,
                DEPARTMENT    = :DEPARTMENT,
                PRINCIPAL     = :PRINCIPAL,
                POSITION      = :POSITION,
                BRAND         = :BRAND,
                MODEL         = :MODEL,
                IMEI          = :IMEI,
                SERIAL        = :SERIAL,
                DATE_DEPLOYED = :DATE_DEPLOYED,
                PERSON_USING  = :PERSON_USING,
                NUMBER        = :NUMBER,
                BALANCE       = :BALANCE,
                REMARKS       = :REMARKS
            WHERE LINEID = :LINEID
        ";

        $stmt = $conn->prepare($updateSql);
        $stmt->execute([
            ':SITE_ID'       => $input['SITE_ID'],
            ':DEPARTMENT'    => $input['DEPARTMENT'],
            ':PRINCIPAL'     => $input['PRINCIPAL'],
            ':POSITION'      => $input['POSITION'],
            ':BRAND'         => $input['BRAND'],
            ':MODEL'         => $input['MODEL'],
            ':IMEI'          => $input['IMEI'],
            ':SERIAL'        => $input['SERIAL'],
            ':DATE_DEPLOYED' => $input['DATE_DEPLOYED'],
            ':PERSON_USING'  => $input['PERSON_USING'],
            ':NUMBER'        => $input['NUMBER'],
            ':BALANCE'       => $input['BALANCE'],
            ':REMARKS'       => $input['REMARKS'],
            ':LINEID'        => $lineid
        ]);


        $insertSql = "
            INSERT INTO BS_Checking_logs (
                COMPANY_ID,
                SITE_ID,
                DATE_CHECKED,
                [USER],
                NUMBER,
                LOAD_BALANCE,
                IS_SUBMIT,
                IS_PHYSICAL_OK,
                HAS_GAMES,
                IS_SYSTEM_UPDATED,
                OTHER_ISSUES,
                CHECKED_BY
            )
            VALUES (
                :COMPANY_ID,
                :SITE_ID,
                GETDATE(),
                :USER,
                :NUMBER,
                :LOAD_BALANCE,
                :IS_SUBMIT,
                :IS_PHYSICAL_OK,
                :HAS_GAMES,
                :IS_SYSTEM_UPDATED,
                :OTHER_ISSUES,
                :CHECKED_BY
            )
        ";

        $stmtLog = $conn->prepare($insertSql);
        $stmtLog->execute([
            ':COMPANY_ID'        => $_SESSION['Company_ID'] ?? null,
            ':SITE_ID'           => $input['SITE_ID'],
            ':USER'              => $input['PERSON_USING'],
            ':NUMBER'            => $input['NUMBER'],
            ':LOAD_BALANCE'      => $input['BALANCE'],
            ':IS_SUBMIT'         => $input['DATA_SUBMITTED'] ?? 'Yes',
            ':IS_PHYSICAL_OK'    => $input['PHYSICALLY_OK'] ?? 'Yes',
            ':HAS_GAMES'         => $input['GAMES'] ?? 'No',
            ':IS_SYSTEM_UPDATED' => $input['SYSTEM_UPDATED'] ?? 'Yes',
            ':OTHER_ISSUES'      => $input['OTHER_ISSUES'] ?? null,
            ':CHECKED_BY'        => $_SESSION['Name_of_user'] ?? 'SYSTEM'
        ]);

        $conn->commit();

        echo json_encode(['success' => true]);
        exit;

    } catch (PDOException $e) {

        $conn->rollBack();

        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'loadcheckresult') {
    header('Content-Type: application/json');

    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }

    try {
        $companyId = $_GET['company'] ?? '';
        $datefrom  = $_GET['datefrom'] ?? '';
        $dateto    = $_GET['dateto'] ?? '';

        if (empty($companyId) || empty($datefrom) || empty($dateto)) {
            echo json_encode(['error' => 'Missing required parameters']);
            exit;
        }

        $sql = "
            SELECT *
            FROM BS_Checking_logs
            WHERE COMPANY_ID = :companyid
              AND DATE_CHECKED BETWEEN :datefrom AND :dateto
            ORDER BY SITE_ID ASC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':datefrom', $datefrom, PDO::PARAM_STR);
        $stmt->bindParam(':dateto', $dateto, PDO::PARAM_STR);
        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($items);

    } catch (PDOException $e) {
        echo json_encode([
            'error' => 'Database error',
            'message' => $e->getMessage()
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'error' => 'Application error',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}


if ($action === 'update_balance') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data['id']) || !isset($data['BALANCE'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
        exit;
    }

    $sql = "
        UPDATE BS_Device
            SET
                BALANCE = :BALANCE,
                LOAD_STATUS = CASE
                    WHEN BALANCE < 5
                      OR LAST_LOAD_HISTORY IS NULL
                      OR LAST_LOAD_HISTORY < DATEADD(MONTH, -6, GETDATE())
                    THEN 'FOR LOAD'
                    ELSE 'OK'
                END
            WHERE LINEID = :id
    ";

    $stmt = $conn->prepare($sql);
   $stmt->execute([
    ':id'      => $data['id'],
    ':BALANCE' => $data['BALANCE']
]);


    echo json_encode(['success' => true]);
    exit;
}


$response = [];

try {
    if (!$conn) {
        throw new Exception("Database connection failed");
    }

    $action = $_GET['action'] ?? '';

    if ($action === 'forload') {
        $company_id = $_SESSION['Company_ID'] ?? '';

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
              OR 
              LAST_LOAD_HISTORY < DATEADD(MONTH, -6, GETDATE())
              -- Alternative (more precise ~180 days):
              -- OR LAST_LOAD_HISTORY < DATEADD(DAY, -180, GETDATE())
              -- OR LAST_LOAD_HISTORY < DATEADD(MONTH, -6, CAST(GETDATE() AS DATE))
          )
        ORDER BY DATE_ADDED DESC;
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':company_id' => $company_id]);

        $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Optionally filter FOR LOAD devices
        $devices = array_filter($devices, fn($d) => $d['LOAD_STATUS'] === 'FOR LOAD');

        echo json_encode(array_values($devices));
        exit;
    }

    echo json_encode([]);
    exit;

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}


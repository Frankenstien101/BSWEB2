<?php
session_start();
header('Content-Type: application/json');
include __DIR__ . '/../../DB/dbcon.php';

$response = ['success' => false, 'message' => 'Invalid request'];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') throw new Exception('Invalid request method');
    if (!$conn) throw new Exception('Database connection failed');

    // Parse JSON body
    $input = json_decode(file_get_contents('php://input'), true);

    $company_id    = $_SESSION['Company_ID'] ?? null;
    $site_id       = $input['SITE_ID'] ?? '';
    $department    = $input['DEPARTMENT'] ?? '';
    $principal     = $input['PRINCIPAL'] ?? '';
    $position      = $input['POSITION'] ?? '';
    $brand         = $input['BRAND'] ?? '';
    $model         = $input['MODEL'] ?? '';
    $serial        = $input['SERIAL'] ?? '';
    $date_deployed = $input['DATE_DEPLOYED'] ?? null;
    $person_using  = $input['PERSON_USING'] ?? '';
    $number        = $input['NUMBER'] ?? '';
    $balance       = $input['BALANCE'] ?? 0;
    $remarks       = $input['REMARKS'] ?? '';

    $load_status = ($balance < 5) ? 'FOR LOAD' : 'OK';

    

    $sql = "INSERT INTO BS_Device (
                COMPANY_ID, SITE_ID, DEPARTMENT, PRINCIPAL, POSITION, BRAND,
                MODEL, SERIAL, DATE_DEPLOYED, PERSON_USING, NUMBER, BALANCE, 
                LOAD_STATUS, REMARKS, DATE_ADDED
            ) VALUES (
                :company_id, :site_id, :department, :principal, :position, :brand,
                :model, :serial, :date_deployed, :person_using, :number, :balance, 
                :load_status, :remarks, GETDATE()
            )";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':company_id'    => $company_id,
        ':site_id'       => $site_id,
        ':department'    => $department,
        ':principal'     => $principal,
        ':position'      => $position,
        ':brand'         => $brand,
        ':model'         => $model,
        ':serial'        => $serial,
        ':date_deployed' => $date_deployed,
        ':person_using'  => $person_using,
        ':number'        => $number,
        ':balance'       => $balance,
        ':load_status'   => $load_status,
        ':remarks'       => $remarks
    ]);

    $response = ['success' => true, 'message' => 'Device added successfully'];

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
exit;
?>

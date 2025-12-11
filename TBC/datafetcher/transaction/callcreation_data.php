
<?php
session_start();
include __DIR__ . '/../../../DB/dbcon.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

try {

    // -------------------------------------------------
    //  LOAD CREDITORS (EMPLOYEES)
    // -------------------------------------------------
    if ($action === 'getprincipals') {
        // ---- FIX 1: Use the same parameter name as JS ----
        $site = $_GET['site'] ?? '';   // ← matches &company=BSPI
        if (empty($site)) {
            echo json_encode(['success'=>false, 'error'=>'Missing company']);
            exit;
        }

        $sql = "SELECT 
                    PRINCIPAL
                FROM TBC_Customers 
                WHERE BRANCH =  :site
                  GROUP BY PRINCIPAL
                ORDER BY PRINCIPAL ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':site' => $site]);

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($items);
        exit;

        } else if ($action === 'getsellers') {
        $principal = $_GET['principal'] ?? '';
        $site    = $_GET['site'] ?? '';

       $sql = "
                SELECT 
                  [CUSTOMER_ID]
                ,[CUSTOMER_NAME]
                ,[ADDRESS]
                ,[SELLER_ID]
                ,[SELLER_NAME]
                ,[PHONE_NUMBER]
                FROM TBC_Customers 
                WHERE 
                   PRINCIPAL = :principal
                    AND BRANCH = :site 

                ORDER BY SELLER_NAME ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([':principal' => $principal , ':site' => $site]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // ---- OPTIONAL: Format CURRENT_BALANCE as string ----
   

        echo json_encode($items);
        exit;


         } else if ($action === 'updatephonenumber') {
        $phonenumber = $_GET['phonenumber'] ?? '';
        $customerid    = $_GET['customerid'] ?? '';

        $sql = "Update TBC_Customers
                SET PHONE_NUMBER = :phonenumber
                WHERE CUSTOMER_ID = :customerid";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':phonenumber'=>$phonenumber, ':customerid'=>$customerid]);

        echo json_encode(['success'=>true ]);
        exit();
         }

        elseif ($action === 'getsellerswalkin') {
        $site = $_GET['site'] ?? '';
        $principal = $_GET['principal'] ?? '';
        $sql = "SELECT 
                    SELLER_ID,
                    SELLER_NAME
                FROM TBC_Customers 
                WHERE BRANCH =  :site
                  AND PRINCIPAL = :principal
                  GROUP BY SELLER_ID, SELLER_NAME
                ORDER BY SELLER_NAME ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':site' => $site, ':principal' => $principal]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items);
        exit();

    }


} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success'=>false, 'error'=>$e->getMessage()]);
}
?>

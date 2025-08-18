<?php
session_start();
include __DIR__ . '/../../../DB/dbcon.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

try {

    if ($action === 'saveonvanloaddetails') {
        $transactionId = $_GET['transactionid'] ?? '';
        $sellerid      = $_GET['sellerid'] ?? '';
        $barcode       = $_GET['barcode'] ?? '';
        $itemId        = $_GET['itemid'] ?? '';
        $description   = $_GET['description'] ?? '';
        $batch         = $_GET['batch'] ?? '';
        $cs            = $_GET['cs'] ?? 0;
        $sw            = $_GET['sw'] ?? 0;
        $it            = $_GET['it'] ?? 0;
        $price         = $_GET['price'] ?? 0;
        $itPerCase     = $_GET['itpercase'] ?? 0;
        $itPerSw       = $_GET['itpersw'] ?? 0;
        $sihit         = $_GET['sihit'] ?? 0;
        $totalcs       = $_GET['totalcs'] ?? 0;
        $totalit       = $_GET['totalit'] ?? 0;

        $sql = "INSERT INTO Aquila_Van_Loading_Details
                   (SELLER_ID, TRANSACTION_ID, BARCODE, ITEM_CODE, DESCRIPTION, 
                    BATCH, CS, SW, IT, PRICE, ITEM_PER_CASE, ITEM_PER_SW, 
                    SIH_IT, TOTAL_CS_AMOUNT, TOTAL_IT_AMOUNT ,IS_SYNCED )
                VALUES
                   (:sellerid, :transactionid, :barcode, :item_code, :description,
                    :batch, :cs, :sw, :it, :item_cost, :item_per_case, :item_per_sw,
                    :sih_it, :total_cs_amount, :total_it_amount , 0)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':sellerid'       => $sellerid,
            ':transactionid'  => $transactionId,
            ':barcode'        => $barcode,
            ':item_code'      => $itemId,
            ':description'    => $description,
            ':batch'          => $batch,
            ':cs'             => $cs,
            ':sw'             => $sw,
            ':it'             => $it,
            ':item_cost'      => $price,
            ':item_per_case'  => $itPerCase,
            ':item_per_sw'    => $itPerSw,
            ':sih_it'         => $sihit,
            ':total_cs_amount'=> $totalcs,
            ':total_it_amount'=> $totalit
        ]);

        echo json_encode(['success' => true, 'line_id' => $conn->lastInsertId()]);
        exit();

    } else if ($action === 'loadskus') {
        $companyId     = $_GET['company'] ?? '';
        $siteid        = $_GET['siteid'] ?? '';
        $warehousecode = $_GET['warehousecode'] ?? '';
        $category      = $_GET['category'] ?? '';

        $sql = "SELECT im.*, pm.* 
                FROM Aquila_Inventory_Master im
                LEFT JOIN Aquila_ProductMaster pm 
                  ON pm.ITEMID = im.ITEM_ID AND pm.COMPANY_ID = im.COMPANY_ID
                WHERE im.COMPANY_ID = :companyid
                  AND im.WAREHOUSE_CODE = :warehousecode
                  AND im.WAREHOUSE_SUB_WAREHOUSE = 'SALABLE'
                  AND STATUS = 'ACTIVE'
                  AND ITEM_TIER = :category
                ORDER BY im.DESCRIPTION ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':companyid'     => $companyId,
            ':warehousecode' => $warehousecode,
            ':category'      => $category
        ]);

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items ?: []);
        exit();
        } else if ($action === 'loadskus') {
        $companyId     = $_GET['company'] ?? '';
        $siteid        = $_GET['siteid'] ?? '';
        $warehousecode = $_GET['warehousecode'] ?? '';
        $category      = $_GET['category'] ?? '';

        $sql = "SELECT im.*, pm.* 
                FROM Aquila_Inventory_Master im
                LEFT JOIN Aquila_ProductMaster pm 
                  ON pm.ITEMID = im.ITEM_ID AND pm.COMPANY_ID = im.COMPANY_ID
                WHERE im.COMPANY_ID = :companyid
                  AND im.WAREHOUSE_CODE = :warehousecode
                  AND im.WAREHOUSE_SUB_WAREHOUSE = 'SALABLE'
                  AND STATUS = 'ACTIVE'
                  AND ITEM_TIER = :category
                ORDER BY im.DESCRIPTION ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':companyid'     => $companyId,
            ':warehousecode' => $warehousecode,
            ':category'      => $category
        ]);

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items ?: []);
        exit();
        /// load saved items
        } else if ($action === 'loadlist') {
        $transactionId     = $_GET['transactionid'] ?? '';

        $sql = "SELECT *
                FROM Aquila_Van_Loading_Details 
             
                WHERE TRANSACTION_ID = :transactionid
      
                ORDER BY LINE_ID ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':transactionid'     => $transactionId,

        ]);

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items ?: []);
        exit();

        // REMOVE FROM LIST 

         } else if ($action === 'removefromlist') {
        $transactionId     = $_GET['transactionid'] ?? '';
          $itemid     = $_GET['itemid'] ?? '';

        $sql = "DELETE
                 Aquila_Van_Loading_Details 
             
                WHERE TRANSACTION_ID = :transactionid
                AND ITEM_CODE = :itemid";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':transactionid'     => $transactionId,
            ':itemid'     => $itemid,
        ]);

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items ?: []);
        exit();

    } else if ($action === 'get_new_po_count') {
        $companyId = $_GET['company'] ?? '';
        $siteId    = $_GET['siteid'] ?? '';

        $sql = "SELECT COUNT(*) + 1 AS total
                FROM Aquila_Van_Loading_Transaction
                WHERE SITE_ID = :siteid AND COMPANY_ID = :companyid";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':siteid'=>$siteId, ':companyid'=>$companyId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(['success'=>true, 'count'=>$row['total'] ?? 1]);
        exit();

    } else if ($action === 'insertnewtrans') {
        $companyId     = $_GET['companyid'] ?? '';
        $siteId        = $_GET['siteid'] ?? '';
        $transactionId = $_GET['transactionid'] ?? '';

        $sql = "INSERT INTO Aquila_Van_Loading_Transaction 
                    (COMPANY_ID, SITE_ID, LOADING_ID, DATE_CREATED, STATUS)
                VALUES (:companyid, :siteid, :transactionid, GETDATE(), 'DRAFT')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':companyid' => $companyId,
            ':siteid'    => $siteId,
            ':transactionid'=> $transactionId
        ]);

        echo json_encode(['success'=>true, 'transactionid'=>$transactionId]);
        exit();

    } else {
        echo json_encode(['success'=>false, 'error'=>'No valid action']);
        exit();
    }

} catch (Exception $e) {
    echo json_encode(['success'=>false, 'error'=>$e->getMessage()]);
    exit();
}

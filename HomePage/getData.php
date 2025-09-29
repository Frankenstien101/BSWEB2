<?php
session_start();
include '../DB/dbcon.php'; // Your PDO connection

// 1️⃣ Get PO number count
if (isset($_GET['action']) && $_GET['action'] === 'get_new_po_count') {
    $companyId = $_GET['company'];
    $siteId = $_GET['siteid'];

    $sql = "SELECT COUNT(*) + 1 AS total
            FROM Aquila_PO_Transaction
            WHERE SITE_ID = :Site_ID AND COMPANY_ID = :companyid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Site_ID', $siteId);
    $stmt->bindParam(':companyid', $companyId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // 2️⃣ Get pricing from Aquila_Sites
    $sqlPricing = "SELECT PRICING 
                   FROM Aquila_Sites
                   WHERE SITEID = :Site_ID AND COMPANY_ID = :companyid";
    $stmtPricing = $conn->prepare($sqlPricing);
    $stmtPricing->bindParam(':Site_ID', $siteId);
    $stmtPricing->bindParam(':companyid', $companyId);
    $stmtPricing->execute();
    $pricingRow = $stmtPricing->fetch(PDO::FETCH_ASSOC);

    // 3️⃣ Return JSON with both count & pricing
    echo json_encode([
        'count'   => $row['total'],
        'pricing' => $pricingRow['PRICING']
    ]);
    exit();
}

// 1️⃣ Get Pricing
if (isset($_GET['action']) && $_GET['action'] === 'getpricing') {
    header('Content-Type: application/json');
    
    try {
        // Validate required parameters
        if (!isset($_GET['company']) || !isset($_GET['siteid'])) {
            throw new Exception('Missing required parameters');
        }

        $companyId = $_GET['company'];
        $siteId = $_GET['siteid'];

        // Get pricing from Aquila_Sites
        $sqlPricing = "SELECT PRICING 
                      FROM Aquila_Sites
                      WHERE SITEID = :Site_ID AND COMPANY_ID = :companyid";
        
        $stmtPricing = $conn->prepare($sqlPricing);
        $stmtPricing->bindParam(':Site_ID', $siteId, PDO::PARAM_INT);
        $stmtPricing->bindParam(':companyid', $companyId, PDO::PARAM_INT);
        $stmtPricing->execute();
        
        $pricingData = $stmtPricing->fetch(PDO::FETCH_ASSOC);

        if (!$pricingData) {
            echo json_encode([
                'status' => 'success',
                'pricing' => null,
                'message' => 'No pricing data found'
            ]);
            exit();
        }

        echo json_encode([
            'status' => 'success',
            'pricing' => $pricingData['PRICING'],
            'timestamp' => date('Y-m-d H:i:s')
        ]);

    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    exit();
}



// 2️⃣ Insert new PO number into DB
if (isset($_GET['action']) && $_GET['action'] === 'insert_po') {
    $companyId = $_GET['company'];
    $siteId = $_GET['siteid'];
    $poNumber = $_GET['ponumber'];
    $po_date = $_GET['po_date'];

    $sql = "INSERT INTO Aquila_PO_Transaction (COMPANY_ID, SITE_ID, PO_NUMBER, PO_DATE,DATE_CREATED, STATUS)
            VALUES (:companyid, :siteid, :ponumber, :po_date ,GETDATE(), 'DRAFT')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':companyid', $companyId);
    $stmt->bindParam(':siteid', $siteId);
    $stmt->bindParam(':ponumber', $poNumber);
     $stmt->bindParam(':po_date', $po_date);

    if ($stmt->execute()) {
        echo "PO inserted successfully";
    } else {
        echo "Error inserting PO";
    }
    exit();
}

// 3️⃣ Get product data for search
// In your getData.php
if (isset($_GET['action']) && $_GET['action'] === 'get_products') {
    header('Content-Type: application/json');
    
    try {
        // Check database connection
        if(!isset($conn) || !($conn instanceof PDO)) {
            throw new Exception("Database connection not established");
        }

        $stmt = $conn->prepare("SELECT 
                    CASE_BARCODE, 
                    IT_BARCODE, 
                    ITEMID, 
                    DESCRIPTION, 
                    BRAND, 
                    ITEM_COST, 
                    CASE_COST, 
                    ITEMS_PER_CASE,
                    ITEMS_PER_SW 
                FROM Aquila_ProductMaster 
                WHERE STATUS = 'ACTIVE' AND COMPANY_ID = '$_SESSION[COMPANY_ID]' AND ITEM_TIER = '$_GET[pricing]'");
       
        if(!$stmt->execute()) {
            throw new Exception("Query execution failed");
        }

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(!$products) {
            echo json_encode([]);
            exit();
        }

        // Validate data structure
        $validProducts = array_filter($products, function($item) {
            return isset($item['ITEMID']) && isset($item['DESCRIPTION']);
        });

        echo json_encode($validProducts);
        
    } catch(PDOException $e) {
        echo json_encode([
            'error' => 'Database error',
            'message' => $e->getMessage()
        ]);
    } catch(Exception $e) {
        echo json_encode([
            'error' => 'Application error',
            'message' => $e->getMessage()
        ]);
    }
    exit();
}

  // Save PO item
if (isset($_GET['action']) && $_GET['action'] === 'POsavelist') {
    header('Content-Type: text/plain');
    
    try {
        // Validate required parameters
        $required = [
            'ponumber' => 'PO Number',
            'itemid' => 'Item ID',
            'description' => 'Description',
            'csqty' => 'CS Quantity',
            'swqty' => 'SW Quantity',
            'itqty' => 'IT Quantity',
            'totalamount' => 'Total Amount'
        ];
        
        foreach ($required as $field => $name) {
            if (!isset($_GET[$field]) || $_GET[$field] === '') {
                throw new Exception("Missing required field: {$name}");
            }
        }

        // Include database connection
        require_once '../DB/dbcon.php';
        if (!isset($conn) || !($conn instanceof PDO)) {
            throw new Exception("Database connection failed");
        }

        // Prepare SQL
        $sql = "INSERT INTO Aquila_PO_Details (
            PO_NUMBER, ITEM_ID, DESCRIPTION, 
            PO_CS, PO_SW, PO_IT, AMOUNT,
            IT_BARCODE, CASE_BARCODE,
            SERVE_CS, SERVE_SW, SERVE_IT, AMOUNT_SERVED,
            ACTUAL_CS, ACTUAL_SW, ACTUAL_IT, BATCH, STATUS
        ) VALUES (
            :ponumber, :itemid, :description, 
            :csqty, :swqty, :itqty, :totalamount,
            :itbarcode, :csbarcode,
            :serve_cs, :serve_sw, :serve_it, :amount_served,
            :actual_cs, :actual_sw, :actual_it, :batch, :Statustxt
        )";

        $stmt = $conn->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':ponumber', $_GET['ponumber']);
        $stmt->bindParam(':itemid', $_GET['itemid']);
        $stmt->bindParam(':description', $_GET['description']);
        $stmt->bindParam(':csqty', $_GET['csqty'], PDO::PARAM_INT);
        $stmt->bindParam(':swqty', $_GET['swqty'], PDO::PARAM_INT);
        $stmt->bindParam(':itqty', $_GET['itqty'], PDO::PARAM_INT);
        $stmt->bindParam(':totalamount', $_GET['totalamount']);
        $stmt->bindParam(':itbarcode', $_GET['itbarcode']);
        $stmt->bindParam(':csbarcode', $_GET['csbarcode']);
        
        // Bind default values
        $serve_cs = (int)$_GET['csqty'];
        $serve_sw = (int)$_GET['swqty'];
        $serve_it = (int)$_GET['itqty'];
        $amount_served = (float)$_GET['totalamount'];
        $actual_cs = 0;
        $actual_sw = 0;
        $actual_it = 0;
        $batch = 'BATCH';
        $status = 'DRAFT';

        $stmt->bindParam(':serve_cs', $serve_cs, PDO::PARAM_INT);
        $stmt->bindParam(':serve_sw', $serve_sw, PDO::PARAM_INT);
        $stmt->bindParam(':serve_it', $serve_it, PDO::PARAM_INT);
        $stmt->bindParam(':amount_served', $amount_served);
        $stmt->bindParam(':actual_cs', $actual_cs, PDO::PARAM_INT);
        $stmt->bindParam(':actual_sw', $actual_sw, PDO::PARAM_INT);
        $stmt->bindParam(':actual_it', $actual_it, PDO::PARAM_INT);
        $stmt->bindParam(':batch', $batch);
        $stmt->bindParam(':Statustxt', $status);

        if (!$stmt->execute()) {
            throw new Exception("Database error: " . implode(", ", $stmt->errorInfo()));
        }

        echo "Item saved successfully";
        
    } catch (Exception $e) {
        http_response_code(400);
        echo "Error: " . $e->getMessage();
    }
    exit();
}


// load items by PO number

if (isset($_GET['action']) && $_GET['action'] === 'get_items_by_po') {
    header('Content-Type: application/json');
    
    try {
        // Validate PO number
        if (!isset($_GET['ponumber']) || empty($_GET['ponumber'])) {
            throw new Exception("PO Number is required");
        }

        $poNumber = $_GET['ponumber'];
        
        // Prepare SQL
        $sql = "SELECT * FROM Aquila_PO_Details WHERE PO_NUMBER = :ponumber ORDER BY LINEID ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ponumber', $poNumber);
        
        if (!$stmt->execute()) {
            throw new Exception("Query execution failed");
        }

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!$items) {
            echo json_encode([]);
            exit();
        }

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
    exit();

}

// get price for item
if (isset($_GET['action']) && $_GET['action'] === 'getnewprice') {
    $companyId = $_GET['company'];
    $pricing   = $_GET['pricing'];
    $itemid    = $_GET['itemid'];

    $sql = "SELECT CASE_COST, ITEM_COST, ITEMS_PER_SW
            FROM Aquila_ProductMaster
            WHERE ITEMID = :itemid AND COMPANY_ID = :companyid AND ITEM_TIER = :pricing";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':companyid', $companyId);
    $stmt->bindParam(':pricing', $pricing);
    $stmt->bindParam(':itemid', $itemid);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode([
            'CSCOST'  => $row['CASE_COST'],
            'ITCOST'  => $row['ITEM_COST'],
            'ITPERSW' => $row['ITEMS_PER_SW']
        ]);
    } else {
        echo json_encode([]);
    }
    exit();
}


//update item line

if (isset($_GET['action']) && $_GET['action'] === 'updatelineitem') {
    $ponumber   = $_GET['ponumber'];
    $cs         = $_GET['cs'];
    $sw         = $_GET['sw'];
    $it         = $_GET['it'];
    $itemid     = $_GET['itemid'];
    $newamount  = $_GET['totalamount'];

    $sql = "UPDATE Aquila_PO_Details
            SET 
                PO_CS = :cs, 
                PO_SW = :sw, 
                PO_IT = :it, 
                SERVE_CS = :Scs, 
                SERVE_SW = :Ssw, 
                SERVE_IT = :Sit,  
                AMOUNT = :newamount,
                AMOUNT_SERVED = :Snewamount
            WHERE PO_NUMBER = :ponumber 
              AND ITEM_ID = :itemid";
              
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cs', $cs, PDO::PARAM_INT);
    $stmt->bindParam(':sw', $sw, PDO::PARAM_INT);
    $stmt->bindParam(':it', $it, PDO::PARAM_INT);
    $stmt->bindParam(':Scs', $cs, PDO::PARAM_INT);
    $stmt->bindParam(':Ssw', $sw, PDO::PARAM_INT);
    $stmt->bindParam(':Sit', $it, PDO::PARAM_INT);
    $stmt->bindParam(':Snewamount', $newamount);
    $stmt->bindParam(':newamount', $newamount);
    $stmt->bindParam(':ponumber', $ponumber);
    $stmt->bindParam(':itemid', $itemid);

    if ($stmt->execute()) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
    } else {
        header('Content-Type: application/json', true, 500);
        echo json_encode(['status' => 'error', 'message' => 'Update failed']);
    }
    exit();
}

// REMOVE ITEM FROM PO
if (isset($_GET['action']) && $_GET['action'] === 'removelineitem') {
    $ponumber = $_GET['ponumber'];
    $itemid   = $_GET['itemid'];

    $sql = "DELETE FROM Aquila_PO_Details WHERE PO_NUMBER = :ponumber AND ITEM_ID = :itemid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ponumber', $ponumber);
    $stmt->bindParam(':itemid', $itemid);

    if ($stmt->execute()) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error']);
    }
    exit();
}


// process PO

if (isset($_GET['action']) && $_GET['action'] === 'processpo') {
    header('Content-Type: text/plain');
    
    try {
        // Validate required parameters
        $required = [
            'company' => 'company',
            'ponumber' => 'PO Number',
            'totallines' => 'Total Lines',
            'totalamount' => 'Total Amount', 
            'datecreated' => 'Date Created', 
            'expected_days' => 'Expected Days',
      
        ];
        
        foreach ($required as $field => $name) {
            if (!isset($_GET[$field]) || $_GET[$field] === '') {
                throw new Exception("Missing required field: {$name}");
            }
        }

        // Include database connection
        require_once '../DB/dbcon.php';
        if (!isset($conn) || !($conn instanceof PDO)) {
            throw new Exception("Database connection failed");
        }

        // Prepare SQL
        $sql = "UPDATE Aquila_PO_Transaction
        SET 
            TOTAL_QTY = :totallines, 
            TOTAL_AMOUNT = :totalamount, 
            DATE_CREATED = :datecreated, 
            EXPECTED_DAYS = :expected_days, 
            STATUS = 'PROCESS'
        WHERE PO_NUMBER = :ponumber AND COMPANY_ID = :companyid        ";

        $stmt = $conn->prepare($sql);
        
        // Bind parameters
       $totallines   = (int) $_GET['totallines'];
    $totalamount  = (float) $_GET['totalamount'];
    $expectedDays = (int) $_GET['expected_days'];   

    $stmt->bindParam(':ponumber', $_GET['ponumber']);
    $stmt->bindParam(':companyid', $_GET['company']);
    $stmt->bindParam(':totallines', $totallines, PDO::PARAM_INT);
    $stmt->bindParam(':totalamount', $totalamount); // keep decimal
    $stmt->bindParam(':datecreated', $_GET['datecreated']);
    $stmt->bindParam(':expected_days', $expectedDays, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception("Database error: " . implode(", ", $stmt->errorInfo()));
        }

        echo "PO PROCESSED successfully";
        
    } catch (Exception $e) {
        http_response_code(400);
        echo "Error: " . $e->getMessage();
    }
    exit();
}


//SAVE AS DRAFT

if (isset($_GET['action']) && $_GET['action'] === 'saveasdraft') {
    header('Content-Type: text/plain');
    
    try {
        // Validate required parameters
        $required = [
            'company' => 'company',
            'ponumber' => 'PO Number',
            'totallines' => 'Total Lines',
            'totalamount' => 'Total Amount', 
            'datecreated' => 'Date Created', 
            'expected_days' => 'Expected Days',
      
        ];
        
        foreach ($required as $field => $name) {
            if (!isset($_GET[$field]) || $_GET[$field] === '') {
                throw new Exception("Missing required field: {$name}");
            }
        }

        // Include database connection
        require_once '../DB/dbcon.php';
        if (!isset($conn) || !($conn instanceof PDO)) {
            throw new Exception("Database connection failed");
        }

        // Prepare SQL
        $sql = "UPDATE Aquila_PO_Transaction
        SET 
            TOTAL_QTY = :totallines, 
            TOTAL_AMOUNT = :totalamount, 
            DATE_CREATED = :datecreated, 
            EXPECTED_DAYS = :expected_days, 
            STATUS = 'DRAFT'
        WHERE PO_NUMBER = :ponumber AND COMPANY_ID = :companyid        ";

        $stmt = $conn->prepare($sql);
        
        // Bind parameters
       $totallines   = (int) $_GET['totallines'];
    $totalamount  = (float) $_GET['totalamount'];
    $expectedDays = (int) $_GET['expected_days'];   

    $stmt->bindParam(':ponumber', $_GET['ponumber']);
    $stmt->bindParam(':companyid', $_GET['company']);
    $stmt->bindParam(':totallines', $totallines, PDO::PARAM_INT);
    $stmt->bindParam(':totalamount', $totalamount); // keep decimal
    $stmt->bindParam(':datecreated', $_GET['datecreated']);
    $stmt->bindParam(':expected_days', $expectedDays, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception("Database error: " . implode(", ", $stmt->errorInfo()));
        }

        echo "PO PROCESSED successfully";
        
    } catch (Exception $e) {
        http_response_code(400);
        echo "Error: " . $e->getMessage();
    }
    exit();
}






// LOAD TRANSACTION FILTER

if (isset($_GET['action']) && $_GET['action'] === 'loadtrans') {
    header('Content-Type: application/json');
    
    try {
        // Validate dateFrom
        if (!isset($_GET['dateFrom']) || empty($_GET['dateFrom'])) {
            throw new Exception("Select date");
        }

        $datefrom = $_GET['dateFrom'];  
        $dateto   = $_GET['dateTo'];
        $companyId = $_GET['company'];
        $siteId    = $_GET['siteid'];
        $status = 'DRAFT';

        // Validate companyId and siteId
        if (!isset($companyId) || empty($companyId)) {
            throw new Exception("Company ID is required");
        }       
        if (!isset($siteId) || empty($siteId)) {
            throw new Exception("Site ID is required");
        }
        // Validate date format
        $datefrom = date('Y-m-d', strtotime($datefrom));
        $dateto   = date('Y-m-d', strtotime($dateto));
        if (!$datefrom || !$dateto) {
            throw new Exception("Invalid date format");
        }

        // Debugging output
        // Uncomment for debugging
        // echo "Debug: Date From: $datefrom, Date To: $dateto
       // console.log("Date From: $datefrom, Date To: $dateto, Company ID: $companyId, Site ID: $siteId, Status: $status");

        // Prepare SQL - fix typo in :datefrom param and remove :status binding
      $sql = "SELECT * FROM Aquila_PO_Transaction 
        WHERE  COMPANY_ID = :companyid AND STATUS = :status
          AND SITE_ID = :siteid 
          AND DATE_CREATED BETWEEN :datefrom AND :dateto  
        ORDER BY LINE_ID DESC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':datefrom', $datefrom);
$stmt->bindParam(':dateto', $dateto);
$stmt->bindParam(':companyid', $companyId);
$stmt->bindParam(':siteid', $siteId);
$stmt->bindParam(':status', $status); // Bind status parameter

$stmt->execute();


        if (!$stmt->execute()) {
            throw new Exception("Query execution failed");
        }

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($items ?: []);
        
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
    exit();
}





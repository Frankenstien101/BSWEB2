<?php
session_start();
include __DIR__ . '/../../../DB/dbcon.php';

// PRODUCT MASTER REPORT
if (isset($_GET['action']) && $_GET['action'] === 'loaditems') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];

        $sql = "SELECT * FROM Aquila_ProductMaster 
                WHERE COMPANY_ID = :companyid
                ORDER BY ITEM_TIER ASC";

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

// CUSTOMER MASTER REPORT - CSV EXPORT
if (isset($_GET['action'], $_GET['all'], $_GET['export']) &&
    $_GET['action'] === 'loadcustomers' &&
    $_GET['all'] === 'true' &&
    $_GET['export'] === 'csv') {

    set_time_limit(300); // 5 minutes max execution time

    if (!$conn || !($conn instanceof PDO)) {
        die("Database connection failed");
    }

    try {
        $sql = "SELECT 
                    AC.LINEID, AC.COMPANY_ID, AC.SITE_ID, CHANNEL, SUB_CHANNEL,
                    ASCM.SELLER_ID, ASL.SELLER_NAME, AC.STORE_CODE, AC.STORE_TYPE,
                    AC.CUSTOMER_NAME, AC.DESCRIPTION, AC.ADDRESS, ACC.BARANGAY,
                    ACC.CITY, ACC.PROVINCE, AC.RETAILER_TYPE, AC.FREQUENCY,
                    AC.LATITUDE, AC.LONGITUDE, AC.CREDIT_LIMIT, AC.TAX, AC.VAT,
                    AC.CATEGORY, AC.IS_COVERAGE, AC.DISCOUNT, AC.CREDIT_TERMS,
                    AC.DAYS, AC.STATUS AS CUSTOMER_STATUS,
                    ABC.LAT AS BGY_LAT, ABC.LONG AS BGY_LONG,
                    ABC.BGY_CODE, ABC.BGY_NAME, ABC.MUN_NAME, ABC.PRO_NAME, ABC.REG_NAME
                FROM Aquila_Customers AC
                LEFT JOIN Aquila_Seller_Customer_Map ASCM 
                    ON ASCM.CUSTOMER_ID = AC.STORE_CODE 
                    AND ASCM.COMPANY_ID = AC.COMPANY_ID 
                    AND ASCM.STATUS = 'ACTIVE'
                LEFT JOIN Aquila_Seller ASL
                    ON ASL.SELLER_SUB_ID = ASCM.SELLER_ID 
                    AND ASL.COMPANY_ID = ASCM.COMPANY_ID
                LEFT JOIN Aquila_Customer_Channel ACC 
                    ON ACC.CUSTOMER_ID = AC.STORE_CODE
                LEFT JOIN Aquila_BrgyCodes ABC 
                    ON ABC.COMPANY_ID = AC.COMPANY_ID 
                    AND ABC.ID = AC.STORE_CODE
                WHERE AC.COMPANY_ID = :companyid AND AC.STATUS != 'NEW'
                ORDER BY AC.CUSTOMER_NAME ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $_GET['company'], PDO::PARAM_STR);
        $stmt->execute();

        // Add UTF-8 BOM for Excel to recognize UTF-8 encoding properly
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=customers_report.csv');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Write BOM
        fwrite($output, "\xEF\xBB\xBF");

        $firstRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$firstRow) {
            fclose($output);
            exit;
        }

        // Output CSV header and first row
        fputcsv($output, array_keys($firstRow));
        fputcsv($output, $firstRow);

        // Output remaining rows
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}




// CUSTOMER MASTER REPORT - CSV EXPORT Golden points
if (isset($_GET['action'], $_GET['all'], $_GET['export']) &&
    $_GET['action'] === 'loadcustomersgp' &&
    $_GET['all'] === 'true' &&
    $_GET['export'] === 'csv') {

    set_time_limit(300); // 5 minutes max execution time

    if (!$conn || !($conn instanceof PDO)) {
        die("Database connection failed");
    }

    try {
        $sql = "SELECT DISTINCT
                        [STORE_CODE] AS ID,
                        SITE_GP AS SITE,
                        Aquila_Customers.FREQUENCY AS FREQ,
                        CASE 
                            WHEN Aquila_Coverage.WEEK1 = '1' THEN 'WK1&3' 
                            WHEN Aquila_Coverage.WEEK1 = '0' THEN 'WK2&4'
                            ELSE 'NA'
                        END AS WK,
                        CASE 
                            WHEN Aquila_Coverage.MONDAY = '1' THEN 'MONDAY' 
                            WHEN Aquila_Coverage.TUESDAY = '1' THEN 'TUESDAY'
                            WHEN Aquila_Coverage.WEDNESDAY = '1' THEN 'WEDNESDAY' 
                            WHEN Aquila_Coverage.THURSDAY = '1' THEN 'THURSDAY'
                            WHEN Aquila_Coverage.FRIDAY = '1' THEN 'FRIDAY' 
                            WHEN Aquila_Coverage.SATURDAY = '1' THEN 'SATURDAY'
                            WHEN Aquila_Coverage.SUNDAY = '1' THEN 'SUNDAY'
                            ELSE 'NA'
                        END AS DAY,

                        Aquila_Customers.ADDRESS,
                        CITY,
                        PROVINCE,
                        CHAIN,
                        CHANNEL,
                        [STORE_CODE] AS CU_ID,
                        CUSTOMER_NAME,  
                        STORE_TYPE,
                        CASE 
                            WHEN STORE_TYPE = 'HFS' THEN Aquila_Coverage.SELLER_ID 
                            WHEN STORE_TYPE = 'MAS' THEN Aquila_Seller_Customer_Map.SELLER_ID 
                            ELSE 'NA'
                        END AS DSP,
                        DSS,
                        SUB_CHANNEL,
                        CASE 
                            WHEN STORE_TYPE = 'HFS' THEN 'YES'
                            WHEN STORE_TYPE = 'MAS' THEN 'NO'
                            ELSE 'NA'
                        END AS IS_VAN,
                        CASE 
                            WHEN STORE_TYPE = 'HFS' THEN 'VANSELL'
                            WHEN STORE_TYPE = 'MAS' THEN 'PRESELL'
                            ELSE 'NA'
                        END AS DSP_TYPE,
                        PHONE_NUMBER,
                        LATITUDE AS LAT,
                        LONGITUDE AS LONG,
                        CASE 
                            WHEN LATITUDE = '' THEN '0'
                            WHEN LATITUDE = '0' THEN '0'
                            ELSE '1'
                        END AS IS_GEOTAGGED,
                        CASE 
                            WHEN STORE_TYPE = 'HFS' THEN '1'
                            WHEN STORE_TYPE = 'MAS' THEN '0'
                            ELSE 'NA'
                        END AS BEATS
                    FROM [dbo].[Aquila_Customers]
                    LEFT JOIN Aquila_Sites 
                        ON Aquila_Sites.SITEID = Aquila_Customers.SITE_ID 
                        AND Aquila_Sites.COMPANY_ID = Aquila_Customers.COMPANY_ID AND Aquila_Customers.STATUS = 'ACTIVE'
                    LEFT JOIN Aquila_Coverage 
                        ON Aquila_Coverage.CUSTOMER_ID = Aquila_Customers.STORE_CODE 
                        AND Aquila_Coverage.COMPANY_ID = Aquila_Customers.COMPANY_ID AND Aquila_Customers.STATUS = 'ACTIVE'
                        AND Aquila_Coverage.STATUS = 'ACTIVE'
                    LEFT JOIN Aquila_Customer_Channel 
                        ON Aquila_Customer_Channel.CUSTOMER_ID = Aquila_Customers.STORE_CODE 
                        AND Aquila_Customer_Channel.COMPANY_ID = Aquila_Customers.COMPANY_ID AND Aquila_Customers.STATUS = 'ACTIVE'
                    LEFT JOIN Aquila_Seller 
                        ON Aquila_Seller.SELLER_SUB_ID = Aquila_Coverage.SELLER_ID 
                        AND Aquila_Seller.COMPANY_ID = Aquila_Coverage.COMPANY_ID 
                        AND Aquila_Coverage.STATUS = 'ACTIVE'
                    LEFT JOIN Aquila_Seller_Customer_Map 
                        ON Aquila_Seller_Customer_Map.CUSTOMER_ID = Aquila_Customers.STORE_CODE  
                        AND Aquila_Seller_Customer_Map.COMPANY_ID = Aquila_Customers.COMPANY_ID 
                        AND Aquila_Seller_Customer_Map.STATUS = 'ACTIVE' AND Aquila_Customers.STATUS = 'ACTIVE'
                    WHERE Aquila_Customers.COMPANY_ID = :companyid";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $_GET['company'], PDO::PARAM_STR);
        $stmt->execute();

        // Add UTF-8 BOM for Excel to recognize UTF-8 encoding properly
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=customers_report.csv');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Write BOM
        fwrite($output, "\xEF\xBB\xBF");

        $firstRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$firstRow) {
            fclose($output);
            exit;
        }

        // Output CSV header and first row
        fputcsv($output, array_keys($firstRow));
        fputcsv($output, $firstRow);

        // Output remaining rows
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}



// CUSTOMER MASTER REPORT - JSON with pagination
if (isset($_GET['action']) && $_GET['action'] === 'loadcustomers') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'] ?? '';
        $all       = isset($_GET['all']) && $_GET['all'] === 'true'; // check if "all=true"
        $limit     = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page      = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset    = ($page - 1) * $limit;

        $total = null;
        if (!$all) {
            $countSql = "SELECT COUNT(*) AS total 
                         FROM Aquila_Customers 
                         WHERE COMPANY_ID = :companyid AND STATUS != 'NEW'";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId);
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        }

        $sql = "SELECT 
                    AC.LINEID, AC.COMPANY_ID, AC.SITE_ID, CHANNEL, SUB_CHANNEL,
                    ASCM.SELLER_ID, ASL.SELLER_NAME, AC.STORE_CODE, AC.STORE_TYPE,
                    AC.CUSTOMER_NAME, AC.DESCRIPTION, AC.ADDRESS, ACC.BARANGAY,
                    ACC.CITY, ACC.PROVINCE, AC.RETAILER_TYPE, AC.FREQUENCY,
                    AC.LATITUDE, AC.LONGITUDE, AC.CREDIT_LIMIT, AC.TAX, AC.VAT,
                    AC.CATEGORY, AC.IS_COVERAGE, AC.DISCOUNT, AC.CREDIT_TERMS,
                    AC.DAYS, AC.STATUS AS CUSTOMER_STATUS,
                    ABC.LAT AS BGY_LAT, ABC.LONG AS BGY_LONG,
                    ABC.BGY_CODE, ABC.BGY_NAME, ABC.MUN_NAME, ABC.PRO_NAME, ABC.REG_NAME
                FROM Aquila_Customers AC
                LEFT JOIN Aquila_Seller_Customer_Map ASCM 
                    ON ASCM.CUSTOMER_ID = AC.STORE_CODE 
                    AND ASCM.COMPANY_ID = AC.COMPANY_ID 
                    AND ASCM.STATUS = 'ACTIVE'
                LEFT JOIN Aquila_Seller ASL
                    ON ASL.SELLER_SUB_ID = ASCM.SELLER_ID 
                    AND ASL.COMPANY_ID = ASCM.COMPANY_ID
                LEFT JOIN Aquila_Customer_Channel ACC 
                    ON ACC.CUSTOMER_ID = AC.STORE_CODE
                LEFT JOIN Aquila_BrgyCodes ABC 
                    ON ABC.COMPANY_ID = AC.COMPANY_ID 
                    AND ABC.ID = AC.STORE_CODE
                WHERE AC.COMPANY_ID = :companyid AND AC.STATUS != 'NEW'
                ORDER BY AC.CUSTOMER_NAME ASC";

        if (!$all) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        if (!$all) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }
        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($all) {
            echo json_encode($items);
        } else {
            echo json_encode([
                'total' => $total,
                'data'  => $items
            ]);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}

//seller

if (isset($_GET['action']) && $_GET['action'] === 'sellers') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];

        $sql = "SELECT * FROM Aquila_Seller 
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

//coverage per page 



if (isset($_GET['action']) && $_GET['action'] === 'coverage') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'] ?? '';
        $all       = isset($_GET['all']) && $_GET['all'] === 'true'; // check if "all=true"
        $limit     = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page      = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset    = ($page - 1) * $limit;

        $total = null;
        if (!$all) {
            $countSql = "SELECT COUNT(*) AS total 
                         FROM Aquila_Coverage 
                         WHERE COMPANY_ID = :companyid ";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId);
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        }

        $sql = "SELECT 
                     Aquila_Coverage.COMPANY_ID,Aquila_Coverage.SITE_ID,Aquila_Coverage.PROCESS_ID,SELLER_ID,CUSTOMER_ID,CUSTOMER_NAME,ADDRESS,Aquila_Coverage.FREQUENCY,WEEK1,WEEK2,WEEK3,WEEK4,WEEK5,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY,SUNDAY,Aquila_Coverage.STATUS

                    FROM Aquila_Coverage
                    
                    LEFT JOIN Aquila_Customers
                    
                     ON Aquila_Customers.STORE_CODE = Aquila_Coverage.CUSTOMER_ID AND Aquila_Customers.COMPANY_ID = Aquila_Coverage.COMPANY_ID WHERE Aquila_Coverage.COMPANY_ID = :companyid
                     
                     
                     ORDER BY Aquila_Coverage.SITE_ID ASC";

        if (!$all) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        if (!$all) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }
        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($all) {
            echo json_encode($items);
        } else {
            echo json_encode([
                'total' => $total,
                'data'  => $items
            ]);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}



/// final invoice summary
if (isset($_GET['action']) && $_GET['action'] === 'invoicesummary') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    function interpolateQuery($query, $params) {
        foreach ($params as $key => $val) {
            if (is_string($val)) {
                $val = "'" . addslashes($val) . "'";
            } elseif ($val === null) {
                $val = 'NULL';
            }
            $query = str_replace($key, $val, $query);
        }
        return $query;
    }

    try {
        $companyId = $_GET['company'] ?? '';
        $siteid = $_GET['siteid'] ?? '';
        $all       = isset($_GET['all']) && $_GET['all'] === 'true';
        $limit     = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page      = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sellersRaw      = $_GET['sellers'] ?? '1';
        $datefrom      = $_GET['datefrom'] ?? null;
        $dateto      = $_GET['dateto'] ?? null; 
                
        $offset    = ($page - 1) * $limit;

        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        $sellerPlaceholders = [];
        $sellerParams = [];
        foreach ($sellers as $index => $sellerId) {
            $ph = ":seller$index";
            $sellerPlaceholders[] = $ph;
            $sellerParams[$ph] = $sellerId;
        }
        $sellerCondition = count($sellerPlaceholders) > 0 ? "AND A.SELLER_ID IN (" . implode(',', $sellerPlaceholders) . ")" : "";

        $total = null;
        if (!$all) {
            $countSql = "SELECT COUNT(*) AS total 
                         FROM Aquila_Sales_Order_Transactions A
                         WHERE COMPANY_ID = :companyid 
                           AND SITE_ID = :siteid
                           AND STATUS = 'INVOICED'
                           $sellerCondition
                           AND A.TRANSACTION_DATE BETWEEN :datefrom AND :dateto";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId);
            $countStmt->bindParam(':siteid', $siteid);
            $countStmt->bindParam(':datefrom', $datefrom);
            $countStmt->bindParam(':dateto', $dateto);
            foreach ($sellerParams as $ph => $val) {
                $countStmt->bindValue($ph, $val);
            }
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        }

        $sql = "SELECT 
                      A.LINE_ID
                    , A.COMPANY_ID
                    , A.SITE_ID
                    , A.TRANSACTION_ID
                    , A.INVOICE_TYPE
                    , A.INVOICE_NUMBER
                    , A.TRANSACTION_DATE
                    , A.SELLER_ID
                    , A.SELLER_NAME
                    , A.CUSTOMER_ID
                    , A.CUSTOMER_NAME
                    , A.WAREHOUSE_ID
                    , A.WAREHOUSE_CODE
                    , ISNULL(TRY_CAST(A.DISCOUNT AS DECIMAL(18, 2)), 0) AS DISCOUNT
                    , ISNULL(TRY_CAST(A.TOTAL_AMOUNT AS DECIMAL(18, 2)), 0) AS TOTAL_AMOUNT
                    , ISNULL(SUM(TRY_CAST(B.ITEM_DISCOUNT AS DECIMAL(18, 2))), 0) AS TOTAL_ITEM_DISCOUNT
                    , ISNULL(TRY_CAST(A.TOTAL_AMOUNT AS DECIMAL(18, 2)), 0) 
                      - ISNULL(SUM(TRY_CAST(B.ITEM_DISCOUNT AS DECIMAL(18, 2))), 0) 
                      - ISNULL(TRY_CAST(A.DISCOUNT AS DECIMAL(18, 2)), 0) AS INVOICE_AMOUNT
                    , A.STATUS
                    , A.BILLING_NAME
                    , A.INVOICE_DISTANCE
                    , A.PO_NUMBER
                FROM 
                    Aquila_Sales_Order_Transactions A
                LEFT JOIN 
                    Aquila_Invoice_lines B 
                    ON B.INVOICE_NUMBER = A.INVOICE_NUMBER
                    AND B.COMPANY_ID = A.COMPANY_ID
                WHERE
                    A.COMPANY_ID = :companyid
                    AND A.SITE_ID = :siteid
                    AND A.STATUS = 'INVOICED'
                    $sellerCondition
                    AND A.TRANSACTION_DATE BETWEEN :datefrom AND :dateto
                GROUP BY
                      A.LINE_ID
                    , A.COMPANY_ID
                    , A.SITE_ID
                    , A.TRANSACTION_ID
                    , A.INVOICE_TYPE
                    , A.INVOICE_NUMBER
                    , A.TRANSACTION_DATE
                    , A.SELLER_ID
                    , A.SELLER_NAME
                    , A.CUSTOMER_ID
                    , A.CUSTOMER_NAME
                    , A.WAREHOUSE_ID
                    , A.WAREHOUSE_CODE
                    , A.DISCOUNT
                    , A.TOTAL_AMOUNT
                    , A.STATUS
                    , A.BILLING_NAME
                    , A.INVOICE_DISTANCE
                    , A.PO_NUMBER
                ORDER BY A.LINE_ID ASC";

        if (!$all) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':siteid', $siteid);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        foreach ($sellerParams as $ph => $val) {
            $stmt->bindValue($ph, $val);
        }
        if (!$all) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        $debugSql = interpolateQuery($sql, array_merge([
            ':companyid' => $companyId,
            ':siteid' => $siteid,
            ':datefrom' => $datefrom,
            ':dateto' => $dateto,
            ':offset' => $offset,
            ':limit' => $limit,
        ], $sellerParams));

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($all) {
            echo json_encode([
                'data' => $items,
                'debug_sql' => $debugSql
            ]);
        } else {
            echo json_encode([
                'total' => $total,
                'data'  => $items,
                'debug_sql' => $debugSql
            ]);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}






//ALL COVERAGE DOWNLAOD

if (isset($_GET['action'], $_GET['all'], $_GET['export']) &&
    $_GET['action'] === 'coveragecsv' &&
    $_GET['all'] === 'true' &&
    $_GET['export'] === 'csv') {

    set_time_limit(300); // 5 minutes max execution time

    if (!$conn || !($conn instanceof PDO)) {
        die("Database connection failed");
    }

    try {
        $sql = "SELECT  Aquila_Coverage.COMPANY_ID,
                    Aquila_Coverage.SITE_ID,
                    Aquila_Coverage.PROCESS_ID,
                    SELLER_ID,
                    CUSTOMER_ID,
                    CUSTOMER_NAME,
                    ADDRESS,
                    Aquila_Coverage.FREQUENCY,
                    WEEK1,WEEK2,WEEK3,WEEK4,WEEK5,
                    MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY,SUNDAY,
                    Aquila_Coverage.STATUS
                FROM Aquila_Coverage
                LEFT JOIN Aquila_Customers
                    ON Aquila_Customers.STORE_CODE = Aquila_Coverage.CUSTOMER_ID 
                    AND Aquila_Customers.COMPANY_ID = Aquila_Coverage.COMPANY_ID
                WHERE Aquila_Coverage.COMPANY_ID = :companyid
                ORDER BY Aquila_Coverage.SITE_ID ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $_GET['company'], PDO::PARAM_STR);
        $stmt->execute();

        // Add UTF-8 BOM for Excel to recognize UTF-8 encoding properly
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=Coverage_report.csv');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Write BOM
        fwrite($output, "\xEF\xBB\xBF");

        $firstRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$firstRow) {
            fclose($output);
            exit;
        }

        // Output CSV header and first row
        fputcsv($output, array_keys($firstRow));
        fputcsv($output, $firstRow);

        // Output remaining rows
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}


//INVOICE SUMMARYheader('Content-Type: application/json');

if (!isset($_GET['action'])) {
    echo json_encode(['error' => 'No action specified']);
    exit();
}

if (!$conn || !($conn instanceof PDO)) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

try {
    if ($_GET['action'] === 'getsellers') {
        $companyId = $_GET['company'] ?? '';
        $siteId = $_GET['site'] ?? '';
        
        if (empty($companyId) || empty($siteId)) {
            echo json_encode(['error' => 'Missing company or site ID']);
            exit();
        }

        $sql = "SELECT COMPANY_ID, SITE_ID, SELLER_ID, SELLER_NAME 
                FROM [dbo].[Aquila_Seller] 
                WHERE COMPANY_ID = :companyId AND SITE_ID = :siteId 
                ORDER BY SELLER_NAME ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':companyId' => $companyId, ':siteId' => $siteId]);
        $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($sellers ?: []);
        exit();
    }

    //invoice summary
} catch (Exception $e) {
    echo json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);

}
   
exit();

//ALL INVOICE SUMMARY FINAL






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


//GET WAREHOSUE


if (isset($_GET['action']) && $_GET['action'] === 'selectwarehouse') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
             $companyId = $_GET['company'];
                $siteid = $_GET['siteid'];

        $sql = "SELECT WAREHOUSE_CODE FROM Aquila_Warehouse 
                WHERE COMPANY_ID = :companyid 
                AND SITE_ID = :siteid
                GROUP BY WAREHOUSE_CODE
                ORDER BY WAREHOUSE_CODE ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
                $stmt->bindParam(':siteid', $siteid);
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


// GET HFS CMB


if (isset($_GET['action']) && $_GET['action'] === 'selecthfs') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
             $companyId = $_GET['company'];
                $siteid = $_GET['siteid'];

        $sql = "SELECT SELLER_ID,CATEGORY FROM Aquila_Seller 
                WHERE COMPANY_ID = :companyid 
                AND SITE_ID = :siteid
                AND SELLER_TYPE = 'VAN SELLER' AND STATUS = 'ACTIVE'
                GROUP BY SELLER_ID,CATEGORY
                ORDER BY SELLER_ID ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
                $stmt->bindParam(':siteid', $siteid);
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
               // 'debug_sql' => $debugSql
            ]);
        } else {
            echo json_encode([
                'total' => $total,
                'data'  => $items,
               // 'debug_sql' => $debugSql
            ]);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}

// invoice Summary to csv



if (isset($_GET['action']) && $_GET['action'] === 'invoicesummarycsv') {
    $exportCsv = (isset($_GET['export']) && $_GET['export'] === 'csv');

    if ($exportCsv) {
        // CSV export headers will be sent below
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=Invoice_Summary_Export.csv');
        header('Pragma: no-cache');
        header('Expires: 0');

        // UTF-8 BOM for Excel
        echo "\xEF\xBB\xBF";
    } else {
        // JSON output
        header('Content-Type: application/json');
    }

    if (!$conn || !($conn instanceof PDO)) {
        if ($exportCsv) {
            die("Database connection failed");
        } else {
            echo json_encode(['error' => 'Database connection failed']);
            exit();
        }
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
        $all = isset($_GET['all']) && $_GET['all'] === 'true';
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sellersRaw = $_GET['sellers'] ?? '1';
        $datefrom = $_GET['datefrom'] ?? null;
        $dateto = $_GET['dateto'] ?? null;

        $offset = ($page - 1) * $limit;

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
        if (!$all && !$exportCsv) {
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

        if (!$all && !$exportCsv) {
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
        if (!$all && !$exportCsv) {
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

        if ($exportCsv) {
            // CSV export:
            $output = fopen('php://output', 'w');

            // Output CSV header row with keys from first item or predefined keys
            if (count($items) > 0) {
                fputcsv($output, array_keys($items[0]));
                foreach ($items as $row) {
                    fputcsv($output, $row);
                }
            }

            fclose($output);
            exit();
        } else {
            // JSON output
            if ($all) {
                echo json_encode([
                    'data' => $items,
                    //'debug_sql' => $debugSql
                ]);
            } else {
                echo json_encode([
                    'total' => $total,
                    'data' => $items,
                    //'debug_sql' => $debugSql
                ]);
            }
        }
    } catch (PDOException $e) {
        if ($exportCsv) {
            die("Database error: " . $e->getMessage());
        } else {
            echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
        }
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
       $companyId = $_GET['company'] ?? null;
    $siteId = $_GET['site'] ?? null;

if ($companyId === null || $siteId === null) {
    echo json_encode(['error' => 'Missing company or site ID']);
    exit();
}


        $sql = "SELECT COMPANY_ID, SITE_ID, SELLER_ID, SELLER_NAME , SELLER_SUB_ID 
                FROM [dbo].[Aquila_Seller] 
                WHERE COMPANY_ID = :companyId AND SITE_ID = :siteId 
                ORDER BY SELLER_NAME ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':companyId' => $companyId, ':siteId' => $siteId]);
        $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($sellers ?: []);
        exit();
    }


} catch (Exception $e) {
    echo json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);

}
   

// get HFS ONLY 


if (!isset($_GET['action'])) {
    echo json_encode(['error' => 'No action specified']);
    exit();
}

if (!$conn || !($conn instanceof PDO)) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

try {
    if ($_GET['action'] === 'GETHFS') {
       $companyId = $_GET['company'] ?? null;
    $siteId = $_GET['site'] ?? null;



        $sql = "SELECT COMPANY_ID, SITE_ID, SELLER_ID 
                FROM [dbo].[Aquila_Seller] 
                WHERE COMPANY_ID = :companyId AND SITE_ID = :siteId AND  SELLER_TYPE = 'VAN SELLER'
                GROUP BY COMPANY_ID, SITE_ID,SELLER_ID 
                ORDER BY SELLER_ID ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':companyId' => $companyId, ':siteId' => $siteId]);
        $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($sellers ?: []);
        exit();
    }


} catch (Exception $e) {
    echo json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);

}

//ALL INVOICE DETAILED exportcsv


if (!isset($_GET['action'])) {
    echo json_encode(['error' => 'No action specified']);
    exit();
}

if (!$conn || !($conn instanceof PDO)) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

/// get sites selection

try {
    if ($_GET['action'] === 'getsites') {
        $companyId = $_GET['company'] ?? '';
        
        if (empty($companyId)) {
            echo json_encode(['error' => 'Missing company or site ID']);
            exit();
        }

        $sql = "SELECT SITE_CODE ,SITEID
                FROM [dbo].[Aquila_Sites] 
                WHERE COMPANY_ID = :companyId  
                ORDER BY SITE_CODE ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':companyId' => $companyId]);
        $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($sellers ?: []);
        exit();
    }


} catch (Exception $e) {
    echo json_encode(['error' => 'Server error', 'message' => $e->getMessage()]);

}
   

//invoice detailes get pages

if (isset($_GET['action']) && $_GET['action'] === 'invoicedetailedf1') {
    header('Content-Type: application/json');

    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        // Parameters
        $companyId  = isset($_GET['company']) ? (int)$_GET['company'] : null;
        $siteid     = isset($_GET['siteid']) ? (int)$_GET['siteid'] : null;
        $all        = isset($_GET['all']) && $_GET['all'] === 'true';
        $limit      = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page       = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sellersRaw = $_GET['sellers'] ?? '';
        $datefrom   = $_GET['datefrom'] ?? null;
        $dateto     = $_GET['dateto'] ?? null;

        // Validate required parameters
        if ($companyId === null || $siteid === null || $datefrom === null || $dateto === null) {
            echo json_encode(['error' => 'Missing required parameters']);
            exit();
        }

        $offset = ($page - 1) * $limit;

        // Seller filter by NAME (strings)
        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        $sellerCondition = '';
        $sellerParams = [];
        if (count($sellers) > 0) {
            $placeholders = [];
            foreach ($sellers as $index => $sellerName) {
                $ph = ":seller$index";
                $placeholders[] = $ph;
                $sellerParams[$ph] = $sellerName; // use seller names
            }
            $sellerCondition = "AND Aquila_Sales_Order_Transactions.SELLER_NAME IN (" . implode(',', $placeholders) . ")";
        }

        // Total count for pagination
        $total = null;
        if (!$all) {
            $countSql = "SELECT COUNT(*) AS total
                         FROM Aquila_Sales_Order_Transactions
                         WHERE COMPANY_ID = :companyid
                           AND SITE_ID = :siteid
                           AND STATUS = 'INVOICED'
                           $sellerCondition
                           AND TRANSACTION_DATE BETWEEN :datefrom AND :dateto";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId, PDO::PARAM_INT);
            $countStmt->bindParam(':siteid', $siteid, PDO::PARAM_INT);
            $countStmt->bindParam(':datefrom', $datefrom);
            $countStmt->bindParam(':dateto', $dateto);
            foreach ($sellerParams as $ph => $val) {
                $countStmt->bindValue($ph, $val, PDO::PARAM_STR);
            }
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        }

        // Main query
        $sql = "SELECT 
                    Aquila_Invoice_lines.COMPANY_ID,
                    Aquila_Invoice_lines.SITE_ID,
                    SITE_CODE,
                    Aquila_Invoice_lines.TRANSACTION_ID,
                    Aquila_Invoice_lines.TRANSACTION_DATE,
                    INVOICE_TYPE,
                    Aquila_Invoice_lines.INVOICE_NUMBER,
                    Aquila_Sales_Order_Transactions.PO_NUMBER,
                    Aquila_Sales_Order_Transactions.SELLER_ID,
                    Aquila_Sales_Order_Transactions.SELLER_NAME,
                    Aquila_Sales_Order_Transactions.CUSTOMER_ID,
                    Aquila_Sales_Order_Transactions.CUSTOMER_NAME,
                    COALESCE(CHAIN, '-') AS CHAIN,
                    CHANNEL,
                    SUB_CHANNEL,
                    CASE_BARCODE,
                    IT_BARCODE,
                    IT_PER_CS AS ITEM_PER_CASE,
                    BRAND2,
                    CATEGORY_AFFIE,
                    Aquila_Invoice_lines.ITEM_ID,
                    DESCRIPTION,
                    QTY,
                    UOM,
                    AMOUNT AS COST,
                    TOTAL AS GROSS_SALES,
                    Aquila_Invoice_lines.DISCOUNT,
                    SCHEME_CODE,
                    COALESCE(SCHEME_DISCOUNT, 0) AS SCHEME_DISCOUNT,
                    (TOTAL - Aquila_Invoice_lines.DISCOUNT) - COALESCE(SCHEME_DISCOUNT, 0) AS [NET_SALES(W/VAT)],
                    (TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) / 1.12) AS VAT_AMOUNT,
                    (TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) / 1.12)) AS [NET_SALES(EX-VAT)]
                FROM Aquila_Invoice_lines
                INNER JOIN Aquila_Sales_Order_Transactions
                    ON Aquila_Sales_Order_Transactions.TRANSACTION_ID = Aquila_Invoice_lines.TRANSACTION_ID
                LEFT JOIN Aquila_Sites ON Aquila_Sites.SITEID = Aquila_Invoice_lines.SITE_ID 
                LEFT JOIN Aquila_Item_Barcodes ON Aquila_Item_Barcodes.ITEM_ID = Aquila_Invoice_lines.ITEM_ID
                LEFT JOIN Aquila_Customer_Channel ON Aquila_Customer_Channel.CUSTOMER_ID = Aquila_Sales_Order_Transactions.CUSTOMER_ID 
                    AND Aquila_Customer_Channel.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                LEFT JOIN Aquila_Seller ON Aquila_Seller.SELLER_SUB_ID = Aquila_Sales_Order_Transactions.SELLER_ID 
                    AND Aquila_Seller.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                WHERE Aquila_Invoice_lines.COMPANY_ID = :companyid
                    AND Aquila_Invoice_lines.SITE_ID = :siteid
                    $sellerCondition
                    AND Aquila_Invoice_lines.TRANSACTION_DATE BETWEEN :datefrom AND :dateto
                    AND Aquila_Sales_Order_Transactions.STATUS = 'INVOICED'
                ORDER BY Aquila_Invoice_lines.INVOICE_NUMBER ASC";

        if (!$all) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_INT);
        $stmt->bindParam(':siteid', $siteid, PDO::PARAM_INT);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        foreach ($sellerParams as $ph => $val) {
            $stmt->bindValue($ph, $val, PDO::PARAM_STR);
        }
        if (!$all) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($all ? [
            'data' => $items
        ] : [
            'total' => $total,
            'data'  => $items
        ]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}




// Export invoice details to CSV

if (isset($_GET['action']) && $_GET['action'] === 'invoicedetailedexportcsv') {
    if (!$conn || !($conn instanceof PDO)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        // Same parameters as your existing query
        $companyId = $_GET['company'] ?? '';
        $siteid    = $_GET['siteid'] ?? '';
        $sellersRaw = $_GET['sellers'] ?? '1';
        $datefrom  = $_GET['datefrom'] ?? null;
        $dateto    = $_GET['dateto'] ?? null;

        // Seller filter setup
        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        $sellerPlaceholders = [];
        $sellerParams = [];
        foreach ($sellers as $index => $sellerId) {
            $ph = ":seller$index";
            $sellerPlaceholders[] = $ph;
            $sellerParams[$ph] = $sellerId;
        }
        $sellerCondition = count($sellerPlaceholders) > 0
            ? "AND Aquila_Sales_Order_Transactions.SELLER_ID IN (" . implode(',', $sellerPlaceholders) . ")"
            : "";

        // Same SQL as your detailed query but without pagination (export all)
        $sql = "SELECT 
                   Aquila_Invoice_lines.COMPANY_ID,
                    Aquila_Invoice_lines.SITE_ID,
                    SITE_CODE,
                    Aquila_Invoice_lines.TRANSACTION_ID,
                    Aquila_Invoice_lines.TRANSACTION_DATE,
                    INVOICE_TYPE,
                    Aquila_Invoice_lines.INVOICE_NUMBER,
                    Aquila_Sales_Order_Transactions.PO_NUMBER,
                    Aquila_Sales_Order_Transactions.SELLER_ID,
                    COALESCE(SB_VAN_ID, '-') AS SB_VAN_ID,
                    Aquila_Sales_Order_Transactions.SELLER_NAME,
                    Aquila_Sales_Order_Transactions.CUSTOMER_ID,
                    Aquila_Sales_Order_Transactions.CUSTOMER_NAME,
                    COALESCE(CHAIN, '-') AS CHAIN,
                    CHANNEL,
                    SUB_CHANNEL,
                    CASE_BARCODE,
                    IT_BARCODE,
                    IT_PER_CS AS 'ITEM_PER_CASE',
                    BRAND2,
                    CATEGORY_AFFIE,
                    Aquila_Invoice_lines.ITEM_ID,
                    DESCRIPTION,
                    QTY,
                    UOM,
                    AMOUNT AS COST,
                    TOTAL AS GROSS_SALES,
                    Aquila_Invoice_lines.DISCOUNT,
                    SCHEME_CODE,
                    COALESCE(SCHEME_DISCOUNT, 0) AS SCHEME_DISCOUNT,  -- Use COALESCE to set default to 0
                    (TOTAL - Aquila_Invoice_lines.DISCOUNT) - COALESCE(SCHEME_DISCOUNT, 0) AS [NET_SALES(W/VAT)],
                    (TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) / 1.12) AS VAT_AMOUNT,
                    (TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) / 1.12)) AS 'NET_SALES(EX-VAT)'

                    

                FROM Aquila_Invoice_lines
                INNER JOIN Aquila_Sales_Order_Transactions
                    ON Aquila_Sales_Order_Transactions.TRANSACTION_ID = Aquila_Invoice_lines.TRANSACTION_ID
                LEFT JOIN Aquila_Sites ON Aquila_Sites.SITEID = Aquila_Invoice_lines.SITE_ID 
                LEFT JOIN Aquila_Item_Barcodes ON Aquila_Item_Barcodes.ITEM_ID = Aquila_Invoice_lines.ITEM_ID
                LEFT JOIN Aquila_Customer_Channel ON Aquila_Customer_Channel.CUSTOMER_ID = Aquila_Sales_Order_Transactions.CUSTOMER_ID 
                    AND Aquila_Customer_Channel.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                LEFT JOIN Aquila_Seller ON Aquila_Seller.SELLER_SUB_ID = Aquila_Sales_Order_Transactions.SELLER_ID 
                    AND Aquila_Seller.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                WHERE Aquila_Invoice_lines.COMPANY_ID = :companyid
                    AND Aquila_Invoice_lines.SITE_ID = :siteid
                    $sellerCondition
                    AND Aquila_Invoice_lines.TRANSACTION_DATE BETWEEN :datefrom AND :dateto
                    AND Aquila_Sales_Order_Transactions.STATUS = 'INVOICED'
                ORDER BY Aquila_Invoice_lines.INVOICE_NUMBER ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':siteid', $siteid);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        foreach ($sellerParams as $ph => $val) {
            $stmt->bindValue($ph, $val);
        }
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fix Excel auto date conversion ONLY on 'ITEM_ID' column before CSV output
        foreach ($items as &$row) {
            if (isset($row['ITEM_ID']) && is_string($row['ITEM_ID']) && preg_match('/^\d+-\d+$/', $row['ITEM_ID'])) {
                $row['ITEM_ID'] = '="' . $row['ITEM_ID'] . '"';
            }
        }
        unset($row); // break reference

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="invoice_details_export.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        if (!empty($items)) {
            // Output header row (column names)
            fputcsv($output, array_keys($items[0]));

            // Output data rows
            foreach ($items as $row) {
                fputcsv($output, $row);
            }
        } else {
            // No data found
            fputcsv($output, ['No data found']);
        }

        fclose($output);
        exit();

    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
        exit();
    }
}


// invoice detailed export csv purifier format

if (isset($_GET['action']) && $_GET['action'] === 'invoicedetailedexportcsvpurifier') {
    if (!$conn || !($conn instanceof PDO)) {
        header('Content-Type: application/json');
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
        // Parameters
        $companyId = $_GET['company'] ?? '';
        $siteid    = $_GET['siteid'] ?? '';
        $all       = isset($_GET['all']) && $_GET['all'] === 'true';
        $limit     = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page      = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sellersRaw = $_GET['sellers'] ?? '1';
        $datefrom  = $_GET['datefrom'] ?? null;
        $dateto    = $_GET['dateto'] ?? null;
        $offset = ($page - 1) * $limit;

        // Seller filter
        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        $sellerPlaceholders = [];
        $sellerParams = [];
        foreach ($sellers as $index => $sellerId) {
            $ph = ":seller$index";
            $sellerPlaceholders[] = $ph;
            $sellerParams[$ph] = $sellerId;
        }
        $sellerCondition = count($sellerPlaceholders) > 0
            ? "AND Aquila_Sales_Order_Transactions.SELLER_ID IN (" . implode(',', $sellerPlaceholders) . ")"
            : "";

        // Count total only if not exporting all
        $total = null;
        if (!$all && (!isset($_GET['export']) || $_GET['export'] !== 'csv')) {
            $countSql = "SELECT COUNT(*) AS total 
                         FROM Aquila_Sales_Order_Transactions
                         WHERE COMPANY_ID = :companyid 
                           AND SITE_ID = :siteid
                           AND STATUS = 'INVOICED'
                           $sellerCondition
                           AND TRANSACTION_DATE BETWEEN :datefrom AND :dateto";
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

        // Main query
        $sql = "SELECT 
                    Aquila_Invoice_lines.COMPANY_ID as distributor_code,
                    Aquila_Invoice_lines.SITE_ID as distributor_site,
                    Aquila_Invoice_lines.SITE_ID as branch_code,
                    SITE_CODE as branch,
                    Aquila_Invoice_lines.TRANSACTION_DATE AS date,
                    Aquila_Sales_Order_Transactions.SELLER_ID as sales_rep,
                    Aquila_Sales_Order_Transactions.SELLER_NAME as seller_name,
                    Aquila_Sales_Order_Transactions.CUSTOMER_ID as customer_id,
                    Aquila_Sales_Order_Transactions.CUSTOMER_NAME as customer_name,
                    COALESCE(CHAIN, '-') AS chain_code,
                    Aquila_Invoice_lines.ITEM_ID AS name,
                    SCHEME_CODE as scheme_code,
                    SCHEME_CODE as scheme_slab_description,
                    SCHEME_CODE as scheme_group_name,
                    IT_BARCODE as it_barcode,
                    CASE_BARCODE as sw_barcode,
                    DESCRIPTION as description,
                    BRAND2 as brand,
                    CATEGORY_AFFIE as item_category,
                    BRAND2 as brandform,
                    CHANNEL as trade_channel,
                    Aquila_Invoice_lines.INVOICE_NUMBER as document_number,
                    CAST(
                        CASE 
                            WHEN UOM = 'CS' THEN COALESCE(CAST(QTY AS DECIMAL(10, 2)), 0)
                            WHEN UOM IN ('SW', 'IT') THEN 
                                CASE 
                                    WHEN COALESCE(Aquila_Item_Barcodes.IT_PER_CS, 0) = 0 THEN 0 
                                    ELSE COALESCE(CAST(QTY AS DECIMAL(10, 2)), 0) / CAST(Aquila_Item_Barcodes.IT_PER_CS AS DECIMAL(10, 2)) 
                                END
                            ELSE 0 
                        END AS DECIMAL(10, 2)
                    ) AS cs,
                    '0' as msu,
                    TOTAL / 1.12 AS amount,
                    COALESCE(Aquila_Invoice_lines.DISCOUNT, 0) AS discount_value,
                    CASE 
                        WHEN SCHEME_DISCOUNT IS NULL THEN 0
                        ELSE SCHEME_DISCOUNT / 1.12
                    END AS scheme_value,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT) - ((TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12)) as sales_ex_vat,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12) as vat_amount,
                    (COALESCE(Aquila_Invoice_lines.TOTAL_AMOUNT, 0) - COALESCE(ITEM_DISCOUNT, 0)) - COALESCE(SCHEME_DISCOUNT, 0) AS sales_amount,
                    FORMAT(Aquila_Invoice_lines.TRANSACTION_DATE, 'MMMM') AS monthly_transaction,
                    SUB_CHANNEL as pg_local_subsegment,
                    DSS as sales_supervisor,
                    (CASE 
                        WHEN UOM = 'CS' THEN QTY * IT_PER_CS 
                        WHEN UOM = 'SW' THEN QTY * IT_PER_CS 
                        WHEN UOM = 'IT' THEN QTY 
                        ELSE 0 
                    END) AS item_qty,
                    Aquila_Sales_Order_Transactions.PO_NUMBER as aso#,
                    Aquila_Invoice_lines.TRANSACTION_DATE as actual_cm_date,
                    TOTAL / 1.12 as giv,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT) - ((TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12)) as niv,
                    '' as actual_delivery_date,
                    (CASE WHEN UOM = 'CS' THEN QTY ELSE 0 END) AS item_qty_cs,
                    (CASE WHEN UOM = 'SW' THEN QTY ELSE 0 END) AS item_qty_sw,
                    (CASE WHEN UOM = 'IT' THEN QTY ELSE 0 END) AS item_qty_it,
                    'COD' as payment_terms,
                    DISCOUNT_RATE as promo_percentage,
                    '' as trade_percentage
                FROM Aquila_Invoice_lines
                INNER JOIN Aquila_Sales_Order_Transactions
                    ON Aquila_Sales_Order_Transactions.TRANSACTION_ID = Aquila_Invoice_lines.TRANSACTION_ID
                LEFT JOIN Aquila_Sites ON Aquila_Sites.SITEID = Aquila_Invoice_lines.SITE_ID 
                LEFT JOIN Aquila_Item_Barcodes ON Aquila_Item_Barcodes.ITEM_ID = Aquila_Invoice_lines.ITEM_ID
                LEFT JOIN Aquila_Customer_Channel ON Aquila_Customer_Channel.CUSTOMER_ID = Aquila_Sales_Order_Transactions.CUSTOMER_ID 
                    AND Aquila_Customer_Channel.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                LEFT JOIN Aquila_Seller ON Aquila_Seller.SELLER_SUB_ID = Aquila_Sales_Order_Transactions.SELLER_ID 
                    AND Aquila_Seller.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                WHERE Aquila_Invoice_lines.COMPANY_ID = :companyid
                    AND Aquila_Invoice_lines.SITE_ID = :siteid
                    $sellerCondition
                    AND Aquila_Invoice_lines.TRANSACTION_DATE BETWEEN :datefrom AND :dateto
                    AND Aquila_Sales_Order_Transactions.STATUS = 'INVOICED'
                ORDER BY Aquila_Invoice_lines.INVOICE_NUMBER ASC";

        // If NOT CSV export, apply paging
        if ((!isset($_GET['export']) || $_GET['export'] !== 'csv') && !$all) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);

        // Bind params
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':siteid', $siteid);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        foreach ($sellerParams as $ph => $val) {
            $stmt->bindValue($ph, $val);
        }
        if ((!isset($_GET['export']) || $_GET['export'] !== 'csv') && !$all) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fix Excel auto date conversion ONLY on 'name' column before CSV export
        if (isset($_GET['export']) && $_GET['export'] === 'csv') {
            foreach ($items as &$row) {
                if (isset($row['name']) && is_string($row['name']) && preg_match('/^\d+-\d+$/', $row['name'])) {
                    $row['name'] = '="' . $row['name'] . '"';
                }
            }
            unset($row); // break reference
        }

        // If export=csv, output CSV headers and data
        if (isset($_GET['export']) && $_GET['export'] === 'csv') {
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=invoicedetail_export.csv');

            $output = fopen('php://output', 'w');

            if (count($items) > 0) {
                // Output header row using keys of first row
                fputcsv($output, array_keys($items[0]));

                // Output data rows
                foreach ($items as $row) {
                    fputcsv($output, $row);
                }
            }
            fclose($output);
            exit();
        } else {
            // Normal JSON output
            header('Content-Type: application/json');
            echo json_encode($all ? [
                'data' => $items,
            ] : [
                'total' => $total,
                'data'  => $items,
            ]);
            exit();
        }

    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
        exit();
    }
}

//SALES RETURN 

if (isset($_GET['action']) && $_GET['action'] === 'salesreturn') {
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
        // Parameters
        $companyId = $_GET['company'] ?? '';
        $siteid    = $_GET['siteid'] ?? '';
        $all       = isset($_GET['all']) && $_GET['all'] === 'true';
        $limit     = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page      = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $datefrom  = $_GET['datefrom'] ?? null;
        $dateto    = $_GET['dateto'] ?? null;

        $offset = ($page - 1) * $limit;

        // Validate dates or set defaults if necessary
        if (!$datefrom || !$dateto) {
            echo json_encode(['error' => 'Date range required']);
            exit();
        }

        // Count total rows for pagination if needed
        $total = null;
        if (!$all) {
            $countSql = "
                SELECT COUNT(*) AS total
                FROM Aquila_Sales_Return_Detailed
                LEFT JOIN Aquila_Sales_Return_Transaction 
                    ON Aquila_Sales_Return_Transaction.TRANSACTION_ID = Aquila_Sales_Return_Detailed.TRANSACTION_ID
                WHERE Aquila_Sales_Return_Detailed.COMPANY_ID = :companyid
                  AND Aquila_Sales_Return_Detailed.SITE_ID = :siteid
                  AND Aquila_Sales_Return_Transaction.DATE BETWEEN :datefrom AND :dateto
            ";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId);
            $countStmt->bindParam(':siteid', $siteid);
            $countStmt->bindParam(':datefrom', $datefrom);
            $countStmt->bindParam(':dateto', $dateto);
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        }

        // Main query with pagination
        $sql = "
            SELECT 
                Aquila_Sales_Return_Detailed.COMPANY_ID,
                Aquila_Sales_Return_Detailed.SITE_ID,
                Aquila_Sales_Return_Detailed.TRANSACTION_ID,
                Aquila_Sales_Return_Detailed.ITEM_ID,
                Aquila_Sales_Return_Detailed.DESCRIPTION,
                Aquila_Sales_Return_Detailed.CS,
                Aquila_Sales_Return_Detailed.SW,
                Aquila_Sales_Return_Detailed.IT,
                Aquila_Sales_Return_Detailed.TOTAL_AMOUNT,
                Aquila_Sales_Return_Detailed.REASON,
                Aquila_Sales_Return_Detailed.PRICE AS DESTINATION
            FROM Aquila_Sales_Return_Detailed
            LEFT JOIN Aquila_Sales_Return_Transaction 
                ON Aquila_Sales_Return_Transaction.TRANSACTION_ID = Aquila_Sales_Return_Detailed.TRANSACTION_ID
            WHERE Aquila_Sales_Return_Detailed.COMPANY_ID = :companyid
              AND Aquila_Sales_Return_Detailed.SITE_ID = :siteid
              AND Aquila_Sales_Return_Transaction.DATE BETWEEN :datefrom AND :dateto
            ORDER BY Aquila_Sales_Return_Detailed.TRANSACTION_ID ASC
        ";

        if (!$all) {
            // For SQL Server OFFSET/FETCH
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':siteid', $siteid, PDO::PARAM_STR);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);

        if (!$all) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        // Optional debug SQL
        /*
        $debugSql = interpolateQuery($sql, [
            ':companyid' => $companyId,
            ':siteid' => $siteid,
            ':datefrom' => $datefrom,
            ':dateto' => $dateto,
            ':offset' => $offset,
            ':limit' => $limit,
        ]);
        */

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($all ? [
            'data' => $items,
            // 'debug_sql' => $debugSql
        ] : [
            'total' => $total,
            'data' => $items,
            // 'debug_sql' => $debugSql
        ]);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}

// export sales return as csv 

if (isset($_GET['action']) && $_GET['action'] === 'salesreturncsv') {
    if (!$conn || !($conn instanceof PDO)) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'] ?? '';
        $siteid    = $_GET['siteid'] ?? '';
        $datefrom  = $_GET['datefrom'] ?? null;
        $dateto    = $_GET['dateto'] ?? null;

        if (!$datefrom || !$dateto) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing date range']);
            exit();
        }

        $sql = "
            SELECT 
                Aquila_Sales_Return_Detailed.COMPANY_ID,
                Aquila_Sales_Return_Detailed.SITE_ID,
                Aquila_Sales_Return_Detailed.TRANSACTION_ID,
                Aquila_Sales_Return_Detailed.ITEM_ID,
                Aquila_Sales_Return_Detailed.DESCRIPTION,
                Aquila_Sales_Return_Detailed.CS,
                Aquila_Sales_Return_Detailed.SW,
                Aquila_Sales_Return_Detailed.IT,
                Aquila_Sales_Return_Detailed.TOTAL_AMOUNT,
                Aquila_Sales_Return_Detailed.REASON,
                Aquila_Sales_Return_Detailed.PRICE AS DESTINATION
            FROM Aquila_Sales_Return_Detailed
            LEFT JOIN Aquila_Sales_Return_Transaction 
                ON Aquila_Sales_Return_Transaction.TRANSACTION_ID = Aquila_Sales_Return_Detailed.TRANSACTION_ID
            WHERE Aquila_Sales_Return_Detailed.COMPANY_ID = :companyid
              AND Aquila_Sales_Return_Detailed.SITE_ID = :siteid
              AND Aquila_Sales_Return_Transaction.DATE BETWEEN :datefrom AND :dateto
            ORDER BY Aquila_Sales_Return_Detailed.TRANSACTION_ID ASC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
        $stmt->bindParam(':siteid', $siteid);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    foreach ($rows as &$row) {
        if (isset($row['ITEM_ID']) && is_string($row['ITEM_ID']) && preg_match('/^\d+-\d+$/', $row['ITEM_ID'])) {
            $row['ITEM_ID'] = '="' . $row['ITEM_ID'] . '"';
        }
    }
    unset($row);
}

        // Send CSV headers
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=salesreturn_export_' . date('Ymd') . '.csv');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Output CSV header row
        if (count($rows) > 0) {
            fputcsv($output, array_keys($rows[0]));
        } else {
            fputcsv($output, [
                'COMPANY_ID','SITE_ID','TRANSACTION_ID','ITEM_ID','DESCRIPTION',
                'CS','SW','IT','TOTAL_AMOUNT','REASON','DESTINATION'
            ]);
        }

        // Output CSV data rows
        foreach ($rows as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit();

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
        exit();
    }
}

// GET STOCK VIEW

if (isset($_GET['action']) && $_GET['action'] === 'getwarehouseinventory') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];
        $siteid = $_GET['siteid'];
         $warehouse = $_GET['warehouse'];
          $subwarehouse = $_GET['subwarehouse'];


        $sql = "SELECT ITEM_ID,BATCH,DESCRIPTION,CS,SW,IT,CS_BARCODE,IT_BARCODE FROM Aquila_Inventory_Master
                WHERE COMPANY_ID = :companyid
                AND SITE_ID = :siteid
                AND WAREHOUSE_CODE = :warehouse
                 AND WAREHOUSE_SUB_WAREHOUSE = :subwarehouse
                ORDER BY DESCRIPTION ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
        $stmt->bindParam(':siteid', $siteid);
        $stmt->bindParam(':warehouse', $warehouse);
        $stmt->bindParam(':subwarehouse', $subwarehouse);
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


/// SO REPORT

if (isset($_GET['action']) && $_GET['action'] === 'invoicesummary111') {
    header('Content-Type: application/json');

    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => true, 'message' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'] ?? '';
        $siteid = $_GET['siteid'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $offset = ($page - 1) * $limit;
        $datefrom = $_GET['datefrom'] ?? null;
        $dateto = $_GET['dateto'] ?? null;
        $sellersRaw = $_GET['sellers'] ?? '';

        if (!$companyId || !$siteid || !$datefrom || !$dateto) {
            echo json_encode(['error' => true, 'message' => 'Missing required parameters']);
            exit();
        }

        // Prepare seller IDs for SQL IN clause safely
        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        if (empty($sellers)) {
            echo json_encode(['error' => true, 'message' => 'No sellers selected']);
            exit();
        }
        $placeholders = implode(',', array_fill(0, count($sellers), '?'));

        // Count total matching records (no pagination)
        $countSql = "
            SELECT COUNT(*) AS total
            FROM Aquila_Sales_Order_Details d
            LEFT JOIN Aquila_Sales_Order_Transactions t 
              ON t.TRANSACTION_ID = d.TRANSACTION_ID 
              AND d.COMPANY_ID = t.COMPANY_ID
            WHERE d.COMPANY_ID = ?
              AND d.SITE_ID = ?
              AND t.TRANSACTION_DATE BETWEEN ? AND ?
              AND t.SELLER_ID IN ($placeholders)
        ";
        $countStmt = $conn->prepare($countSql);
        $countParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
        $countStmt->execute($countParams);
        $total = (int) $countStmt->fetchColumn();

        // Make sure offset and limit are integers and safe to inject directly
        $offsetInt = (int)$offset;
        $limitInt = (int)$limit;

        // Fetch paginated data
        $dataSql = "
            SELECT 
                t.COMPANY_ID,
                t.SITE_ID,
                t.TRANSACTION_ID,
                t.INVOICE_TYPE,
                t.TRANSACTION_DATE,
                t.SELLER_ID,
                t.SELLER_NAME,
                t.CUSTOMER_ID,
                t.CUSTOMER_NAME,
                d.ITEM_ID,
                d.BATCH,
                d.DESCRIPTION,
                d.CS,
                d.SW,
                d.IT,
                d.ALLOCATED_CS,
                d.ALLOCATED_SW,
                d.ALLOCATED_IT,
                d.CS_AMOUNT,
                d.SW_AMOUNT,
                d.IT_AMOUNT,
                d.TOTAL_AMOUNT,
                d.TAX_AMOUNT,
                d.TOTAL,
                d.DISCOUNT,
                d.TAX,
                d.IT_PER_CS,
                d.IT_PER_SW,
                t.STATUS,
                d.DISCOUNT_AMOUNT
            FROM Aquila_Sales_Order_Details d
            LEFT JOIN Aquila_Sales_Order_Transactions t 
              ON t.TRANSACTION_ID = d.TRANSACTION_ID 
              AND d.COMPANY_ID = t.COMPANY_ID
            WHERE d.COMPANY_ID = ?
              AND d.SITE_ID = ?
              AND t.TRANSACTION_DATE BETWEEN ? AND ?
              AND t.SELLER_ID IN ($placeholders)
            ORDER BY t.CUSTOMER_NAME ASC
            OFFSET $offsetInt ROWS FETCH NEXT $limitInt ROWS ONLY
        ";
        $dataStmt = $conn->prepare($dataSql);
        $dataParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
        $dataStmt->execute($dataParams);
        $items = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'total' => $total,
            'data' => $items,
        ]);
    } catch (PDOException $e) {
        echo json_encode(['error' => true, 'message' => 'Database error: ' . $e->getMessage()]);
    }
    exit();
}


/// SO report 
if (isset($_GET['action'])) {
    if (!$conn || !($conn instanceof PDO)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'Database connection failed']);
        exit();
    }

    if ($_GET['action'] === 'SOreport') {
        header('Content-Type: application/json');

        try {
            $companyId = $_GET['company'] ?? '';
            $siteid = $_GET['siteid'] ?? '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $offset = ($page - 1) * $limit;
            $datefrom = $_GET['datefrom'] ?? null;
            $dateto = $_GET['dateto'] ?? null;
            $sellersRaw = $_GET['sellers'] ?? '';

            if (!$companyId || !$siteid || !$datefrom || !$dateto) {
                echo json_encode(['error' => true, 'message' => 'Missing required parameters']);
                exit();
            }

            $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
            if (empty($sellers)) {
                echo json_encode(['error' => true, 'message' => 'No sellers selected']);
                exit();
            }
            $placeholders = implode(',', array_fill(0, count($sellers), '?'));

            // Count total matching records
            $countSql = "
                SELECT COUNT(*) AS total
                FROM Aquila_Sales_Order_Details d
                LEFT JOIN Aquila_Sales_Order_Transactions t 
                  ON t.TRANSACTION_ID = d.TRANSACTION_ID 
                  AND d.COMPANY_ID = t.COMPANY_ID
                WHERE d.COMPANY_ID = ?
                  AND d.SITE_ID = ?
                  AND t.TRANSACTION_DATE BETWEEN ? AND ?
                  AND t.SELLER_ID IN ($placeholders)
            ";
            $countStmt = $conn->prepare($countSql);
            $countParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
            $countStmt->execute($countParams);
            $total = (int) $countStmt->fetchColumn();

            $offsetInt = (int)$offset;
            $limitInt = (int)$limit;

            // Fetch paginated data
            $dataSql = "
                SELECT 
                    t.COMPANY_ID,
                    t.SITE_ID,
                    t.TRANSACTION_ID,
                    t.INVOICE_TYPE,
                    t.TRANSACTION_DATE,
                    t.SELLER_ID,
                    t.SELLER_NAME,
                    t.CUSTOMER_ID,
                    t.CUSTOMER_NAME,
                    d.ITEM_ID,
                    d.BATCH,
                    d.DESCRIPTION,
                    d.CS,
                    d.SW,
                    d.IT,
                    d.ALLOCATED_CS,
                    d.ALLOCATED_SW,
                    d.ALLOCATED_IT,
                    d.CS_AMOUNT,
                    d.SW_AMOUNT,
                    d.IT_AMOUNT,
                    d.TOTAL_AMOUNT,
                    d.TAX_AMOUNT,
                    d.TOTAL,
                    d.DISCOUNT,
                    d.TAX,
                    d.IT_PER_CS,
                    d.IT_PER_SW,
                    t.STATUS,
                    d.DISCOUNT_AMOUNT
                FROM Aquila_Sales_Order_Details d
                LEFT JOIN Aquila_Sales_Order_Transactions t 
                  ON t.TRANSACTION_ID = d.TRANSACTION_ID 
                  AND d.COMPANY_ID = t.COMPANY_ID
                WHERE d.COMPANY_ID = ?
                  AND d.SITE_ID = ?
                  AND t.TRANSACTION_DATE BETWEEN ? AND ?
                  AND t.SELLER_ID IN ($placeholders)
                ORDER BY t.CUSTOMER_NAME ASC
                OFFSET $offsetInt ROWS FETCH NEXT $limitInt ROWS ONLY
            ";
            $dataStmt = $conn->prepare($dataSql);
            $dataParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
            $dataStmt->execute($dataParams);
            $items = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'total' => $total,
                'data' => $items,
            ]);
        } catch (PDOException $e) {
            echo json_encode(['error' => true, 'message' => 'Database error: ' . $e->getMessage()]);
        }
        exit();
    }

    /// SO report export csv
    if ($_GET['action'] === 'SOreportcsv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="SO_Report.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        try {
            $companyId = $_GET['company'] ?? '';
            $siteid = $_GET['siteid'] ?? '';
            $datefrom = $_GET['datefrom'] ?? null;
            $dateto = $_GET['dateto'] ?? null;
            $sellersRaw = $_GET['sellers'] ?? '';

            if (!$companyId || !$siteid || !$datefrom || !$dateto) {
                echo 'Missing required parameters';
                exit();
            }

            $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
            if (empty($sellers)) {
                echo 'No sellers selected';
                exit();
            }
            $placeholders = implode(',', array_fill(0, count($sellers), '?'));

            $dataSql = "
                SELECT 
                    t.COMPANY_ID,
                    t.SITE_ID,
                    t.TRANSACTION_ID,
                    t.INVOICE_TYPE,
                    t.TRANSACTION_DATE,
                    t.SELLER_ID,
                    t.SELLER_NAME,
                    t.CUSTOMER_ID,
                    t.CUSTOMER_NAME,
                    d.ITEM_ID,
                    d.BATCH,
                    d.DESCRIPTION,
                    d.CS,
                    d.SW,
                    d.IT,
                    d.ALLOCATED_CS,
                    d.ALLOCATED_SW,
                    d.ALLOCATED_IT,
                    d.CS_AMOUNT,
                    d.SW_AMOUNT,
                    d.IT_AMOUNT,
                    d.TOTAL_AMOUNT,
                    d.TAX_AMOUNT,
                    d.TOTAL,
                    d.DISCOUNT,
                    d.TAX,
                    d.IT_PER_CS,
                    d.IT_PER_SW,
                    t.STATUS,
                    d.DISCOUNT_AMOUNT
                FROM Aquila_Sales_Order_Details d
                LEFT JOIN Aquila_Sales_Order_Transactions t 
                  ON t.TRANSACTION_ID = d.TRANSACTION_ID 
                  AND d.COMPANY_ID = t.COMPANY_ID
                WHERE d.COMPANY_ID = ?
                  AND d.SITE_ID = ?
                  AND t.TRANSACTION_DATE BETWEEN ? AND ?
                  AND t.SELLER_ID IN ($placeholders)
                ORDER BY t.CUSTOMER_NAME ASC
            ";
            $dataStmt = $conn->prepare($dataSql);
            $dataParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
            $dataStmt->execute($dataParams);
            $items = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

            $output = fopen('php://output', 'w');
            if (!empty($items)) {
                // output header row
                fputcsv($output, array_keys($items[0]));
                // output data rows
                foreach ($items as $row) {
                    fputcsv($output, $row);
                }
            }
            fclose($output);
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        exit();
    }}

// Stock ledger
if (isset($_GET['action']) && $_GET['action'] === 'stockledger') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];
        $siteid = $_GET['siteid'];
        $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
                

        $sql = "SELECT * FROM Aquila_Stock_Ledger 
                WHERE COMPANY_ID = :companyid
                AND SITE_ID = :siteid
                AND DATE_PROCESS BETWEEN :datefrom AND :dateto
                ORDER BY LINEID DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
         $stmt->bindParam(':siteid', $siteid);
          $stmt->bindParam(':datefrom', $datefrom);
           $stmt->bindParam(':dateto', $dateto);
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




if (isset($_GET['action']) && $_GET['action'] === 'warehousemaster') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];

        $sql = "SELECT * FROM Aquila_Warehouse 
                WHERE COMPANY_ID = :companyid 
                ORDER BY WAREHOUSE_CODE ASC";

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


/// Scheme Master

if (isset($_GET['action']) && $_GET['action'] === 'schememaster') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];
        $siteid = $_GET['siteid'];
        $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
                

        $sql = "SELECT * FROM Aquila_Scheme_Transaction 
                WHERE COMPANY_ID = :companyid
                AND SITE_ID = :siteid
                AND DATE_ADDED BETWEEN :datefrom AND :dateto
                ORDER BY LINEID DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
         $stmt->bindParam(':siteid', $siteid);
          $stmt->bindParam(':datefrom', $datefrom);
           $stmt->bindParam(':dateto', $dateto);
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

/// scheme details
if (isset($_GET['action']) && $_GET['action'] === 'schememasterdetails') {
    header('Content-Type: application/json');

    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'] ?? '';
        $schemeCode = $_GET['schemecode'] ?? ''; // matches JS request parameter

        $sql = "
            SELECT  
                Aquila_Scheme_Details.LINEID,
                Aquila_Scheme_Details.COMPANY_ID,
                [SITE_ID],
                [SCHEME_CODE],
                [PARENT_SKU],
                DESCRIPTION,
                Aquila_Scheme_Details.STATUS,
                [SELLER_GROUP]
            FROM [dbo].[Aquila_Scheme_Details]
            LEFT JOIN Aquila_ProductMaster 
                ON Aquila_ProductMaster.ITEMID = Aquila_Scheme_Details.PARENT_SKU
                AND Aquila_ProductMaster.COMPANY_ID = Aquila_Scheme_Details.COMPANY_ID
            WHERE Aquila_ProductMaster.COMPANY_ID = :companyid
              AND SCHEME_CODE = :schemecode
            GROUP BY 
                Aquila_Scheme_Details.LINEID,
                Aquila_Scheme_Details.COMPANY_ID,
                [SITE_ID],
                [SCHEME_CODE],
                [PARENT_SKU],
                DESCRIPTION,
                Aquila_Scheme_Details.STATUS,
                [SELLER_GROUP]
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':schemecode', $schemeCode, PDO::PARAM_STR);
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



/// ALL SITE INVOICE SUMMARY 



/// final invoice summary
if (isset($_GET['action']) && $_GET['action'] === 'allsiteinvoicesummary') {
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
        $sellerCondition = count($sellerPlaceholders) > 0 ? "AND A.SITE_ID IN (" . implode(',', $sellerPlaceholders) . ")" : "";

        $total = null;
        if (!$all) {
            $countSql = "SELECT COUNT(*) AS total 
                         FROM Aquila_Sales_Order_Transactions A
                         WHERE COMPANY_ID = :companyid 
                           AND STATUS = 'INVOICED'
                           $sellerCondition
                           AND A.TRANSACTION_DATE BETWEEN :datefrom AND :dateto";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId);
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
                ORDER BY A.SITE_ID ASC";

        if (!$all) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
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
               // 'debug_sql' => $debugSql
            ]);
        } else {
            echo json_encode([
                'total' => $total,
                'data'  => $items,
               // 'debug_sql' => $debugSql
            ]);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}


/// export all site invoice summary 

if (isset($_GET['action']) && $_GET['action'] === 'allsiteinvoicesummarycsv') {
    $exportCsv = (isset($_GET['export']) && $_GET['export'] === 'csv');

    if ($exportCsv) {
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=All_Site_Invoice_Summary_Export.csv');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
    } else {
        header('Content-Type: application/json');
    }

    if (!$conn || !($conn instanceof PDO)) {
        if ($exportCsv) {
            die("Database connection failed");
        } else {
            echo json_encode(['error' => 'Database connection failed']);
            exit();
        }
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
        $all = isset($_GET['all']) && $_GET['all'] === 'true';
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sellersRaw = $_GET['sellers'] ?? '1';
        $datefrom = $_GET['datefrom'] ?? null;
        $dateto = $_GET['dateto'] ?? null;

        $offset = ($page - 1) * $limit;

        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        $sellerPlaceholders = [];
        $sellerParams = [];
        foreach ($sellers as $index => $sellerId) {
            $ph = ":seller$index";
            $sellerPlaceholders[] = $ph;
            $sellerParams[$ph] = $sellerId;
        }
        $sellerCondition = count($sellerPlaceholders) > 0 ? "AND A.SITE_ID IN (" . implode(',', $sellerPlaceholders) . ")" : "";

        $total = null;
        if (!$all && !$exportCsv) {
            $countSql = "SELECT COUNT(*) AS total 
                         FROM Aquila_Sales_Order_Transactions A
                         WHERE COMPANY_ID = :companyid 
                           AND STATUS = 'INVOICED'
                           $sellerCondition
                           AND A.TRANSACTION_DATE BETWEEN :datefrom AND :dateto";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId);
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
                ORDER BY A.SITE_ID ASC";

        if (!$all && !$exportCsv) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        foreach ($sellerParams as $ph => $val) {
            $stmt->bindValue($ph, $val);
        }
        if (!$all && !$exportCsv) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($exportCsv) {
            $output = fopen('php://output', 'w');
            if (count($items) > 0) {
                fputcsv($output, array_keys($items[0]));
                foreach ($items as $row) {
                    fputcsv($output, $row);
                }
            }
            fclose($output);
            exit();
        } else {
            if ($all) {
                echo json_encode(['data' => $items]);
            } else {
                echo json_encode(['total' => $total, 'data' => $items]);
            }
        }
    } catch (PDOException $e) {
        if ($exportCsv) {
            die("Database error: " . $e->getMessage());
        } else {
            echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
        }
    }
    exit();
}

//// ALL SITE INVOICE DETAILED

if (isset($_GET['action']) && $_GET['action'] === 'allsiteinvoicedetailed') {
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
        // Parameters
        $companyId = $_GET['company'] ?? '';
        $all       = isset($_GET['all']) && $_GET['all'] === 'true';
        $limit     = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page      = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sellersRaw = $_GET['sellers'] ?? '1';
        $datefrom  = $_GET['datefrom'] ?? null;
        $dateto    = $_GET['dateto'] ?? null;

        $offset = ($page - 1) * $limit;

        // Seller filter
        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        $sellerPlaceholders = [];
        $sellerParams = [];
        foreach ($sellers as $index => $sellerId) {
            $ph = ":seller$index";
            $sellerPlaceholders[] = $ph;
            $sellerParams[$ph] = $sellerId;
        }
        $sellerCondition = count($sellerPlaceholders) > 0
            ? "AND Aquila_Sales_Order_Transactions.SITE_ID IN (" . implode(',', $sellerPlaceholders) . ")"
            : "";

        // Paging total
        $total = null;
        if (!$all) {
            $countSql = "SELECT COUNT(*) AS total 
                         FROM Aquila_Sales_Order_Transactions
                         WHERE COMPANY_ID = :companyid 
                           AND STATUS = 'INVOICED'
                           $sellerCondition
                           AND TRANSACTION_DATE BETWEEN :datefrom AND :dateto";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId);
            $countStmt->bindParam(':datefrom', $datefrom);
            $countStmt->bindParam(':dateto', $dateto);
            foreach ($sellerParams as $ph => $val) {
                $countStmt->bindValue($ph, $val);
            }
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        }

        // Main query
        $sql = "SELECT 
                    Aquila_Sales_Order_Transactions.COMPANY_ID ,
                    Aquila_Sales_Order_Transactions.SITE_ID ,
                    SITE_CODE ,
                    Aquila_Invoice_lines.TRANSACTION_DATE ,
                    Aquila_Sales_Order_Transactions.SELLER_ID ,
                    Aquila_Sales_Order_Transactions.SELLER_NAME ,
                    Aquila_Sales_Order_Transactions.CUSTOMER_ID ,
                    Aquila_Sales_Order_Transactions.CUSTOMER_NAME ,
                    COALESCE(CHAIN, '-') ,
                    Aquila_Invoice_lines.ITEM_ID ,
                    SCHEME_CODE ,
                    Aquila_Sales_Order_Transactions.TRANSACTION_ID,
                    INVOICE_TYPE,
                    SCHEME_CODE ,
                    SCHEME_CODE ,
                    IT_BARCODE ,
                    CASE_BARCODE ,
                    DESCRIPTION ,
                    BRAND2 ,
                    CATEGORY_AFFIE ,
                    BRAND2 ,
                    PO_NUMBER,
                    CHANNEL ,
                    QTY,
                    UOM,
                    IT_PER_CS,
                    AMOUNT AS COST,
                    Aquila_Invoice_lines.TOTAL_AMOUNT AS GROSS_SALES,
                    Aquila_Invoice_lines.INVOICE_NUMBER ,
                    CAST(
                        CASE 
                            WHEN UOM = 'CS' THEN COALESCE(CAST(QTY AS DECIMAL(10, 2)), 0)
                            WHEN UOM IN ('SW', 'IT') THEN 
                                CASE 
                                    WHEN COALESCE(Aquila_Item_Barcodes.IT_PER_CS, 0) = 0 THEN 0 
                                    ELSE COALESCE(CAST(QTY AS DECIMAL(10, 2)), 0) / CAST(Aquila_Item_Barcodes.IT_PER_CS AS DECIMAL(10, 2)) 
                                END
                            ELSE 0 
                        END AS DECIMAL(10, 2)
                    ) AS cs,
                    '0' as msu,
                    TOTAL * 0.12 AS VAT,
                    COALESCE(Aquila_Invoice_lines.DISCOUNT, 0) AS DISCOUNT,
                    CASE 
                        WHEN SCHEME_DISCOUNT IS NULL THEN 0
                        ELSE SCHEME_DISCOUNT
                    END AS SCHEME_DISCOUNT,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT) - ((TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12)) as sales_ex_vat,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12) as vat_amount,
                    (COALESCE(Aquila_Invoice_lines.TOTAL_AMOUNT, 0) - COALESCE(ITEM_DISCOUNT, 0)) - COALESCE(SCHEME_DISCOUNT, 0) AS SALESAMOUNT,
                    FORMAT(Aquila_Invoice_lines.TRANSACTION_DATE, 'MMMM') AS monthly_transaction,
                    SUB_CHANNEL as pg_local_subsegment,
                    DSS as sales_supervisor,
                    (CASE 
                        WHEN UOM = 'CS' THEN QTY * IT_PER_CS 
                        WHEN UOM = 'SW' THEN QTY * IT_PER_CS 
                        WHEN UOM = 'IT' THEN QTY 
                        ELSE 0 
                    END) AS item_qty,
                    Aquila_Sales_Order_Transactions.PO_NUMBER as aso#,
                    Aquila_Invoice_lines.TRANSACTION_DATE as actual_cm_date,
                    TOTAL / 1.12 as SALESEXVAT,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT) - ((TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12)) as niv,
                    '' as actual_delivery_date,
                    (CASE WHEN UOM = 'CS' THEN QTY ELSE 0 END) AS item_qty_cs,
                    (CASE WHEN UOM = 'SW' THEN QTY ELSE 0 END) AS item_qty_sw,
                    (CASE WHEN UOM = 'IT' THEN QTY ELSE 0 END) AS item_qty_it,
                    'COD' as payment_terms,
                    DISCOUNT_RATE as promo_percentage,
                    '' as trade_percentage
                FROM Aquila_Invoice_lines
                INNER JOIN Aquila_Sales_Order_Transactions
                    ON Aquila_Sales_Order_Transactions.TRANSACTION_ID = Aquila_Invoice_lines.TRANSACTION_ID
                LEFT JOIN Aquila_Sites ON Aquila_Sites.SITEID = Aquila_Invoice_lines.SITE_ID 
                LEFT JOIN Aquila_Item_Barcodes ON Aquila_Item_Barcodes.ITEM_ID = Aquila_Invoice_lines.ITEM_ID
                LEFT JOIN Aquila_Customer_Channel ON Aquila_Customer_Channel.CUSTOMER_ID = Aquila_Sales_Order_Transactions.CUSTOMER_ID 
                    AND Aquila_Customer_Channel.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                LEFT JOIN Aquila_Seller ON Aquila_Seller.SELLER_SUB_ID = Aquila_Sales_Order_Transactions.SELLER_ID 
                    AND Aquila_Seller.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                WHERE Aquila_Invoice_lines.COMPANY_ID = :companyid
                    $sellerCondition
                    AND Aquila_Invoice_lines.TRANSACTION_DATE BETWEEN :datefrom AND :dateto
                    AND Aquila_Sales_Order_Transactions.STATUS = 'INVOICED'
                ORDER BY Aquila_Sales_Order_Transactions.SITE_ID  ASC";

        if (!$all) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);

        // Bind params
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        foreach ($sellerParams as $ph => $val) {
            $stmt->bindValue($ph, $val);
        }
        if (!$all) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        // Debug SQL output
        $debugSql = interpolateQuery($sql, array_merge([
            ':companyid' => $companyId,
            ':datefrom' => $datefrom,
            ':dateto' => $dateto,
            ':offset' => $offset,
            ':limit' => $limit,
        ], $sellerParams));

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($all ? [
            'data' => $items,
           // 'debug_sql' => $debugSql
        ] : [
            'total' => $total,
            'data'  => $items,
           // 'debug_sql' => $debugSql
        ]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}

/// export all site sales invoice detailed
if (isset($_GET['action']) && $_GET['action'] === 'allsiteinvoicedetailedcsv') {
    // Increase PHP limits
    set_time_limit(300);  // 5 minutes
    ini_set('memory_limit', '512M'); // adjust as needed

    if (!$conn || !($conn instanceof PDO)) {
        die("Database connection failed");
    }

    // Parameters
    $companyId  = $_GET['company'] ?? '';
    $sellersRaw = $_GET['sellers'] ?? '';
    $datefrom   = $_GET['datefrom'] ?? null;
    $dateto     = $_GET['dateto'] ?? null;

    // Prepare seller filter
    $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
    $sellerPlaceholders = [];
    $sellerParams = [];
    foreach ($sellers as $index => $sellerId) {
        $ph = ":seller$index";
        $sellerPlaceholders[] = $ph;
        $sellerParams[$ph] = $sellerId;
    }
    $sellerCondition = count($sellerPlaceholders) > 0
        ? "AND Aquila_Sales_Order_Transactions.SITE_ID IN (" . implode(',', $sellerPlaceholders) . ")"
        : "";

    try {
        // SQL query
        $sql = "SELECT 
                   Aquila_Invoice_lines.COMPANY_ID,
                   Aquila_Invoice_lines.SITE_ID,
                   SITE_CODE,
                   Aquila_Invoice_lines.TRANSACTION_ID,
                   Aquila_Invoice_lines.TRANSACTION_DATE,
                   INVOICE_TYPE,
                   Aquila_Invoice_lines.INVOICE_NUMBER,
                   Aquila_Sales_Order_Transactions.PO_NUMBER,
                   Aquila_Sales_Order_Transactions.SELLER_ID,
                   COALESCE(SB_VAN_ID, '-') AS SB_VAN_ID,
                   Aquila_Sales_Order_Transactions.SELLER_NAME,
                   Aquila_Sales_Order_Transactions.CUSTOMER_ID,
                   Aquila_Sales_Order_Transactions.CUSTOMER_NAME,
                   COALESCE(CHAIN, '-') AS CHAIN,
                   CHANNEL,
                   SUB_CHANNEL,
                   CASE_BARCODE,
                   IT_BARCODE,
                   IT_PER_CS AS 'ITEM_PER_CASE',
                   BRAND2,
                   CATEGORY_AFFIE,
                   Aquila_Invoice_lines.ITEM_ID,
                   DESCRIPTION,
                   QTY,
                   UOM,
                   AMOUNT AS COST,
                   TOTAL AS GROSS_SALES,
                   Aquila_Invoice_lines.DISCOUNT,
                   SCHEME_CODE,
                   COALESCE(SCHEME_DISCOUNT, 0) AS SCHEME_DISCOUNT,
                   (TOTAL - Aquila_Invoice_lines.DISCOUNT) - COALESCE(SCHEME_DISCOUNT, 0) AS [NET_SALES(W/VAT)],
                   (TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) / 1.12) AS VAT_AMOUNT,
                   (TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) - ((TOTAL - Aquila_Invoice_lines.DISCOUNT) / 1.12)) AS 'NET_SALES(EX-VAT)'
                FROM Aquila_Invoice_lines
                INNER JOIN Aquila_Sales_Order_Transactions
                    ON Aquila_Sales_Order_Transactions.TRANSACTION_ID = Aquila_Invoice_lines.TRANSACTION_ID
                LEFT JOIN Aquila_Sites 
                    ON Aquila_Sites.SITEID = Aquila_Invoice_lines.SITE_ID 
                LEFT JOIN Aquila_Item_Barcodes 
                    ON Aquila_Item_Barcodes.ITEM_ID = Aquila_Invoice_lines.ITEM_ID
                LEFT JOIN Aquila_Customer_Channel 
                    ON Aquila_Customer_Channel.CUSTOMER_ID = Aquila_Sales_Order_Transactions.CUSTOMER_ID 
                    AND Aquila_Customer_Channel.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                LEFT JOIN Aquila_Seller 
                    ON Aquila_Seller.SELLER_SUB_ID = Aquila_Sales_Order_Transactions.SELLER_ID 
                    AND Aquila_Seller.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                WHERE Aquila_Invoice_lines.COMPANY_ID = :companyid
                    $sellerCondition
                    AND Aquila_Invoice_lines.TRANSACTION_DATE BETWEEN :datefrom AND :dateto
                    AND Aquila_Sales_Order_Transactions.STATUS = 'INVOICED'
                ORDER BY Aquila_Sales_Order_Transactions.SITE_ID ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        foreach ($sellerParams as $ph => $val) {
            $stmt->bindValue($ph, $val);
        }
        $stmt->execute();

        // Stream CSV output
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=allsiteinvoicedetailed.csv');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM

        $firstRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($firstRow) {
            // Format ITEM_ID for Excel safety
            if (isset($firstRow['ITEM_ID']) && preg_match('/^\d+(-\d+)?$/', $firstRow['ITEM_ID'])) {
                $firstRow['ITEM_ID'] = '="' . $firstRow['ITEM_ID'] . '"';
            }
            // Write headers
            fputcsv($output, array_keys($firstRow));
            fputcsv($output, $firstRow);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (isset($row['ITEM_ID']) && preg_match('/^\d+(-\d+)?$/', $row['ITEM_ID'])) {
                    $row['ITEM_ID'] = '="' . $row['ITEM_ID'] . '"';
                }
                fputcsv($output, $row);
            }
        }

        fclose($output);
        exit;

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}

/// ALL SITE SO REPORT 


if (isset($_GET['action'])) {
    if (!$conn || !($conn instanceof PDO)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'Database connection failed']);
        exit();
    }

    if ($_GET['action'] === 'allsiteSOreport') {
        header('Content-Type: application/json');

        try {
            $companyId = $_GET['company'] ?? '';
            $siteid = $_GET['siteid'] ?? '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $offset = ($page - 1) * $limit;
            $datefrom = $_GET['datefrom'] ?? null;
            $dateto = $_GET['dateto'] ?? null;
            $sellersRaw = $_GET['sellers'] ?? '';

            if (!$companyId || !$siteid || !$datefrom || !$dateto) {
                echo json_encode(['error' => true, 'message' => 'Missing required parameters']);
                exit();
            }

            $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
            if (empty($sellers)) {
                echo json_encode(['error' => true, 'message' => 'No sellers selected']);
                exit();
            }
            $placeholders = implode(',', array_fill(0, count($sellers), '?'));

            // Count total matching records
            $countSql = "
                SELECT COUNT(*) AS total
                FROM Aquila_Sales_Order_Details d
                LEFT JOIN Aquila_Sales_Order_Transactions t 
                  ON t.TRANSACTION_ID = d.TRANSACTION_ID 
                  AND d.COMPANY_ID = t.COMPANY_ID
                WHERE d.COMPANY_ID = ?
                  AND t.TRANSACTION_DATE BETWEEN ? AND ?
                  AND t.SITE_ID IN ($placeholders)
            ";
            $countStmt = $conn->prepare($countSql);
            $countParams = array_merge([$companyId, $datefrom, $dateto], $sellers);
            $countStmt->execute($countParams);
            $total = (int) $countStmt->fetchColumn();

            $offsetInt = (int)$offset;
            $limitInt = (int)$limit;

            // Fetch paginated data
            $dataSql = "
                SELECT 
                    t.COMPANY_ID,
                    t.SITE_ID,
                    t.TRANSACTION_ID,
                    t.INVOICE_TYPE,
                    t.TRANSACTION_DATE,
                    t.SELLER_ID,
                    t.SELLER_NAME,
                    t.CUSTOMER_ID,
                    t.CUSTOMER_NAME,
                    d.ITEM_ID,
                    d.BATCH,
                    d.DESCRIPTION,
                    d.CS,
                    d.SW,
                    d.IT,
                    d.ALLOCATED_CS,
                    d.ALLOCATED_SW,
                    d.ALLOCATED_IT,
                    d.CS_AMOUNT,
                    d.SW_AMOUNT,
                    d.IT_AMOUNT,
                    d.TOTAL_AMOUNT,
                    d.TAX_AMOUNT,
                    d.TOTAL,
                    d.DISCOUNT,
                    d.TAX,
                    d.IT_PER_CS,
                    d.IT_PER_SW,
                    t.STATUS,
                    d.DISCOUNT_AMOUNT
                FROM Aquila_Sales_Order_Details d
                LEFT JOIN Aquila_Sales_Order_Transactions t 
                  ON t.TRANSACTION_ID = d.TRANSACTION_ID 
                  AND d.COMPANY_ID = t.COMPANY_ID
                WHERE d.COMPANY_ID = ?
                  AND t.TRANSACTION_DATE BETWEEN ? AND ?
                  AND t.SITE_ID IN ($placeholders)
                ORDER BY t.SITE_ID ASC
                OFFSET $offsetInt ROWS FETCH NEXT $limitInt ROWS ONLY
            ";
            $dataStmt = $conn->prepare($dataSql);
            $dataParams = array_merge([$companyId, $datefrom, $dateto], $sellers);
            $dataStmt->execute($dataParams);
            $items = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'total' => $total,
                'data' => $items,
            ]);
        } catch (PDOException $e) {
            echo json_encode(['error' => true, 'message' => 'Database error: ' . $e->getMessage()]);
        }
        exit();
    }
}

    /// All site SO report export csv

    if ($_GET['action'] === 'allsiteSOreportcsv') {
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="AllSite_SO_Report.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    try {
        $companyId = $_GET['company'] ?? '';
        $datefrom = $_GET['datefrom'] ?? null;
        $dateto = $_GET['dateto'] ?? null;
        $sellersRaw = $_GET['sellers'] ?? '';

        if (!$companyId || !$datefrom || !$dateto) {
            echo 'Missing required parameters';
            exit();
        }

        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        if (empty($sellers)) {
            echo 'No sellers selected';
            exit();
        }
        $placeholders = implode(',', array_fill(0, count($sellers), '?'));

        $dataSql = "
            SELECT 
                t.COMPANY_ID,
                t.SITE_ID,
                t.TRANSACTION_ID,
                t.INVOICE_TYPE,
                t.TRANSACTION_DATE,
                t.SELLER_ID,
                t.SELLER_NAME,
                t.CUSTOMER_ID,
                t.CUSTOMER_NAME,
                d.ITEM_ID,
                d.BATCH,
                d.DESCRIPTION,
                d.CS,
                d.SW,
                d.IT,
                d.ALLOCATED_CS,
                d.ALLOCATED_SW,
                d.ALLOCATED_IT,
                d.CS_AMOUNT,
                d.SW_AMOUNT,
                d.IT_AMOUNT,
                d.TOTAL_AMOUNT,
                d.TAX_AMOUNT,
                d.TOTAL,
                d.DISCOUNT,
                d.TAX,
                d.IT_PER_CS,
                d.IT_PER_SW,
                t.STATUS,
                d.DISCOUNT_AMOUNT
            FROM Aquila_Sales_Order_Details d
            LEFT JOIN Aquila_Sales_Order_Transactions t 
                ON t.TRANSACTION_ID = d.TRANSACTION_ID 
                AND d.COMPANY_ID = t.COMPANY_ID
            WHERE d.COMPANY_ID = ?
                AND t.TRANSACTION_DATE BETWEEN ? AND ?
                AND t.SITE_ID IN ($placeholders)
            ORDER BY t.SITE_ID ASC
        ";
        $dataStmt = $conn->prepare($dataSql);
        $dataParams = array_merge([$companyId, $datefrom, $dateto], $sellers);
        $dataStmt->execute($dataParams);
        $items = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

        // Format ITEM_ID for Excel safety
        foreach ($items as &$row) {
            if (isset($row['ITEM_ID']) && preg_match('/^\d+(-\d+)?$/', $row['ITEM_ID'])) {
                $row['ITEM_ID'] = '="' . $row['ITEM_ID'] . '"';
            }
        }
        unset($row); // break reference

        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel

        if (!empty($items)) {
            // output header row
            fputcsv($output, array_keys($items[0]));
            // output data rows
            foreach ($items as $row) {
                fputcsv($output, $row);
            }
        }
        fclose($output);
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
    exit();
}



/// new invoice detailed 

if (isset($_GET['action']) && $_GET['action'] === 'invoicedetailed1') {
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
        // Parameters
        $companyId = $_GET['company'] ?? '';
        $all       = isset($_GET['all']) && $_GET['all'] === 'true';
        $limit     = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page      = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sellersRaw = $_GET['sellers'] ?? '1';
        $datefrom  = $_GET['datefrom'] ?? null;
        $dateto    = $_GET['dateto'] ?? null;

        $offset = ($page - 1) * $limit;

        // Seller filter
        $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
        $sellerPlaceholders = [];
        $sellerParams = [];
        foreach ($sellers as $index => $sellerId) {
            $ph = ":seller$index";
            $sellerPlaceholders[] = $ph;
            $sellerParams[$ph] = $sellerId;
        }
        $sellerCondition = count($sellerPlaceholders) > 0
            ? "AND Aquila_Sales_Order_Transactions.SELLER_NAME IN (" . implode(',', $sellerPlaceholders) . ")"
            : "";

        // Paging total
        $total = null;
        if (!$all) {
            $countSql = "SELECT COUNT(*) AS total 
                         FROM Aquila_Sales_Order_Transactions
                         WHERE COMPANY_ID = :companyid 
                           AND STATUS = 'INVOICED'
                           $sellerCondition
                           AND TRANSACTION_DATE BETWEEN :datefrom AND :dateto";
            $countStmt = $conn->prepare($countSql);
            $countStmt->bindParam(':companyid', $companyId);
            $countStmt->bindParam(':datefrom', $datefrom);
            $countStmt->bindParam(':dateto', $dateto);
            foreach ($sellerParams as $ph => $val) {
                $countStmt->bindValue($ph, $val);
            }
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        }

        // Main query
        $sql = "SELECT 
                    Aquila_Sales_Order_Transactions.COMPANY_ID ,
                    Aquila_Sales_Order_Transactions.SITE_ID ,
                    SITE_CODE ,
                    Aquila_Invoice_lines.TRANSACTION_DATE ,
                    Aquila_Sales_Order_Transactions.SELLER_ID ,
                    Aquila_Sales_Order_Transactions.SELLER_NAME ,
                    Aquila_Sales_Order_Transactions.CUSTOMER_ID ,
                    Aquila_Sales_Order_Transactions.CUSTOMER_NAME ,
                    COALESCE(CHAIN, '-') ,
                    Aquila_Invoice_lines.ITEM_ID ,
                    SCHEME_CODE ,
                    Aquila_Sales_Order_Transactions.TRANSACTION_ID,
                    INVOICE_TYPE,
                    SCHEME_CODE ,
                    SCHEME_CODE ,
                    IT_BARCODE ,
                    CASE_BARCODE ,
                    DESCRIPTION ,
                    BRAND2 ,
                    CATEGORY_AFFIE ,
                    BRAND2 ,
                    PO_NUMBER,
                    CHANNEL ,
                    QTY,
                    UOM,
                    IT_PER_CS,
                    AMOUNT AS COST,
                    Aquila_Invoice_lines.TOTAL_AMOUNT AS GROSS_SALES,
                    Aquila_Invoice_lines.INVOICE_NUMBER ,
                    CAST(
                        CASE 
                            WHEN UOM = 'CS' THEN COALESCE(CAST(QTY AS DECIMAL(10, 2)), 0)
                            WHEN UOM IN ('SW', 'IT') THEN 
                                CASE 
                                    WHEN COALESCE(Aquila_Item_Barcodes.IT_PER_CS, 0) = 0 THEN 0 
                                    ELSE COALESCE(CAST(QTY AS DECIMAL(10, 2)), 0) / CAST(Aquila_Item_Barcodes.IT_PER_CS AS DECIMAL(10, 2)) 
                                END
                            ELSE 0 
                        END AS DECIMAL(10, 2)
                    ) AS cs,
                    '0' as msu,
                    TOTAL * 0.12 AS VAT,
                    COALESCE(Aquila_Invoice_lines.DISCOUNT, 0) AS DISCOUNT,
                    CASE 
                        WHEN SCHEME_DISCOUNT IS NULL THEN 0
                        ELSE SCHEME_DISCOUNT
                    END AS SCHEME_DISCOUNT,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT) - ((TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12)) as sales_ex_vat,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12) as vat_amount,
                    (COALESCE(Aquila_Invoice_lines.TOTAL_AMOUNT, 0) - COALESCE(ITEM_DISCOUNT, 0)) - COALESCE(SCHEME_DISCOUNT, 0) AS SALESAMOUNT,
                    FORMAT(Aquila_Invoice_lines.TRANSACTION_DATE, 'MMMM') AS monthly_transaction,
                    SUB_CHANNEL as pg_local_subsegment,
                    DSS as sales_supervisor,
                    (CASE 
                        WHEN UOM = 'CS' THEN QTY * IT_PER_CS 
                        WHEN UOM = 'SW' THEN QTY * IT_PER_CS 
                        WHEN UOM = 'IT' THEN QTY 
                        ELSE 0 
                    END) AS item_qty,
                    Aquila_Sales_Order_Transactions.PO_NUMBER as aso#,
                    Aquila_Invoice_lines.TRANSACTION_DATE as actual_cm_date,
                    TOTAL / 1.12 as SALESEXVAT,
                    (TOTAL-Aquila_Invoice_lines.DISCOUNT) - ((TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12)) as niv,
                    '' as actual_delivery_date,
                    (CASE WHEN UOM = 'CS' THEN QTY ELSE 0 END) AS item_qty_cs,
                    (CASE WHEN UOM = 'SW' THEN QTY ELSE 0 END) AS item_qty_sw,
                    (CASE WHEN UOM = 'IT' THEN QTY ELSE 0 END) AS item_qty_it,
                    'COD' as payment_terms,
                    DISCOUNT_RATE as promo_percentage,
                    '' as trade_percentage
                FROM Aquila_Invoice_lines
                INNER JOIN Aquila_Sales_Order_Transactions
                    ON Aquila_Sales_Order_Transactions.TRANSACTION_ID = Aquila_Invoice_lines.TRANSACTION_ID
                LEFT JOIN Aquila_Sites ON Aquila_Sites.SITEID = Aquila_Invoice_lines.SITE_ID 
                LEFT JOIN Aquila_Item_Barcodes ON Aquila_Item_Barcodes.ITEM_ID = Aquila_Invoice_lines.ITEM_ID
                LEFT JOIN Aquila_Customer_Channel ON Aquila_Customer_Channel.CUSTOMER_ID = Aquila_Sales_Order_Transactions.CUSTOMER_ID 
                    AND Aquila_Customer_Channel.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                LEFT JOIN Aquila_Seller ON Aquila_Seller.SELLER_SUB_ID = Aquila_Sales_Order_Transactions.SELLER_ID 
                    AND Aquila_Seller.COMPANY_ID = Aquila_Sales_Order_Transactions.COMPANY_ID 
                WHERE Aquila_Invoice_lines.COMPANY_ID = :companyid
                    $sellerCondition
                    AND Aquila_Invoice_lines.TRANSACTION_DATE BETWEEN :datefrom AND :dateto
                    AND Aquila_Sales_Order_Transactions.STATUS = 'INVOICED'
                ORDER BY Aquila_Sales_Order_Transactions.SITE_ID  ASC";

        if (!$all) {
            $sql .= " OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY";
        }

        $stmt = $conn->prepare($sql);

        // Bind params
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_STR);
        $stmt->bindParam(':datefrom', $datefrom);
        $stmt->bindParam(':dateto', $dateto);
        foreach ($sellerParams as $ph => $val) {
            $stmt->bindValue($ph, $val);
        }
        if (!$all) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        // Debug SQL output
        $debugSql = interpolateQuery($sql, array_merge([
            ':companyid' => $companyId,
            ':datefrom' => $datefrom,
            ':dateto' => $dateto,
            ':offset' => $offset,
            ':limit' => $limit,
        ], $sellerParams));

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($all ? [
            'data' => $items,
           // 'debug_sql' => $debugSql
        ] : [
            'total' => $total,
            'data'  => $items,
           // 'debug_sql' => $debugSql
        ]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error', 'message' => $e->getMessage()]);
    }
    exit();
}


/// IN TRANSIT SUMMARY 


if (isset($_GET['action']) && $_GET['action'] === 'intransitsummary') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];
        $siteid = $_GET['siteid'];
        $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
                

        $sql = "SELECT * FROM Aquila_PO_Transaction 
                WHERE COMPANY_ID = :companyid
                AND SITE_ID = :siteid
                AND PO_DATE BETWEEN :datefrom AND :dateto
                AND STATUS != 'DRAFT'
                ORDER BY LINE_ID DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
         $stmt->bindParam(':siteid', $siteid);
          $stmt->bindParam(':datefrom', $datefrom);
           $stmt->bindParam(':dateto', $dateto);
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


/// IN TRANSIT DETAILED 

if (isset($_GET['action']) && $_GET['action'] === 'intransitdetailed') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];
        $siteid = $_GET['siteid'];
        $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
                

        $sql = "SELECT [LINEID],PO_DATE,DATE_RECEIVED,[Aquila_PO_Details].[PO_NUMBER],[GRN_NUMBER],[CASE_BARCODE],[IT_BARCODE],[ITEM_ID],[BATCH],[DESCRIPTION],[AMOUNT],[PO_CS],[PO_SW],[PO_IT],[SERVE_CS],[SERVE_SW],[SERVE_IT],[AMOUNT_SERVED],[ACTUAL_CS],[ACTUAL_SW],[ACTUAL_IT],Aquila_PO_Transaction.STATUS
         FROM [dbo].[Aquila_PO_Details]
         INNER JOIN Aquila_PO_Transaction ON Aquila_PO_Transaction.PO_NUMBER = [Aquila_PO_Details].PO_NUMBER 
                WHERE COMPANY_ID = :companyid
                AND SITE_ID = :siteid
                AND PO_DATE BETWEEN :datefrom AND :dateto
                AND Aquila_PO_Transaction.STATUS != 'DRAFT'
                ORDER BY LINEID DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
         $stmt->bindParam(':siteid', $siteid);
          $stmt->bindParam(':datefrom', $datefrom);
           $stmt->bindParam(':dateto', $dateto);
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


/// PURCHASE RETURN REPORT

if (isset($_GET['action']) && $_GET['action'] === 'purchasereturnreport') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];
        $siteid = $_GET['siteid'];
        $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
                

        $sql = "SELECT [COMPANY_ID],[SITE_ID],[DATE_PROCESSED],[GRN_TRANSACTION_ID],[ITEM_ID],[DESCRIPTION],[DAMAGE_CS],[DAMAGE_SW],[DAMAGE_IT],[EXCESS_CS],[EXCESS_SW],[EXCESS_IT],[MISSING_CS],[MISSING_SW],[MISSING_IT],[STATUS]
         FROM [dbo].[Aquila_GRN_PR_Details] 
         INNER JOIN Aquila_GRN_Transaction ON Aquila_GRN_Transaction.GRN_NUMBER = [Aquila_GRN_PR_Details].[GRN_TRANSACTION_ID]
         WHERE [STATUS] = 'PROCESS'
                AND COMPANY_ID = :companyid
                AND SITE_ID = :siteid
                AND DATE_PROCESSED BETWEEN :datefrom AND :dateto
                ORDER BY DATE_PROCESSED DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId);
         $stmt->bindParam(':siteid', $siteid);
          $stmt->bindParam(':datefrom', $datefrom);
           $stmt->bindParam(':dateto', $dateto);
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

// VAN ALLOCATION REPORT

if (isset($_GET['action'])) {
    if (!$conn || !($conn instanceof PDO)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'Database connection failed']);
        exit();
    }

    if ($_GET['action'] === 'vanalloc') {
        header('Content-Type: application/json');

        try {
            $companyId = $_GET['company'] ?? '';
            $siteid = $_GET['siteid'] ?? '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $offset = ($page - 1) * $limit;
            $datefrom = $_GET['datefrom'] ?? null;
            $dateto = $_GET['dateto'] ?? null;
            $sellersRaw = $_GET['sellers'] ?? '';

            if (!$companyId || !$siteid || !$datefrom || !$dateto) {
                echo json_encode(['error' => true, 'message' => 'Missing required parameters']);
                exit();
            }

            $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
            if (empty($sellers)) {
                echo json_encode(['error' => true, 'message' => 'No sellers selected']);
                exit();
            }
            $placeholders = implode(',', array_fill(0, count($sellers), '?'));

            // Count total matching records
      
             $countSql = "
               SELECT COUNT(*) AS total
                         FROM [dbo].[Aquila_Van_Loading_Details]
                         INNER JOIN Aquila_Van_Loading_Transaction 
                            ON Aquila_Van_Loading_Transaction.LOADING_ID = Aquila_Van_Loading_Details.TRANSACTION_ID
                         WHERE COMPANY_ID = ?
                           AND SITE_ID = ?
                           AND Aquila_Van_Loading_Transaction.DATE_CREATED BETWEEN ? AND ?
                           AND Aquila_Van_Loading_Transaction.SELLER_ID IN ($placeholders)
            ";



            $countStmt = $conn->prepare($countSql);
            $countParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
            $countStmt->execute($countParams);
            $total = (int) $countStmt->fetchColumn();

            $offsetInt = (int)$offset;
            $limitInt = (int)$limit;

            // Fetch paginated data


 $dataSql = " SELECT
                COMPANY_ID,
                    SITE_ID,
                    Aquila_Van_Loading_Transaction.SELLER_ID,
                    Aquila_Van_Loading_Transaction.DATE_CREATED,
                    [TRANSACTION_ID],
                    [BARCODE],
                    [ITEM_CODE],
                    [DESCRIPTION],
                    [BATCH],
                    [CS],
                    [SW],
                    [IT],
                    [PRICE],
                    [ITEM_PER_CASE],
                    [ITEM_PER_SW],
                    [SIH_IT],
                    [TOTAL_CS_AMOUNT],
                    [TOTAL_IT_AMOUNT],
                    STATUS
                FROM [dbo].[Aquila_Van_Loading_Details]
                INNER JOIN Aquila_Van_Loading_Transaction 
                    ON Aquila_Van_Loading_Transaction.LOADING_ID = Aquila_Van_Loading_Details.TRANSACTION_ID
                WHERE COMPANY_ID = ?
                  AND SITE_ID = ?

                  AND Aquila_Van_Loading_Transaction.DATE_CREATED BETWEEN ? AND ?
       
              AND Aquila_Van_Loading_Transaction.SELLER_ID IN ($placeholders)

                     AND STATUS != 'DRAFT'

                ORDER BY Aquila_Van_Loading_Transaction.DATE_CREATED DESC

                OFFSET $offsetInt ROWS FETCH NEXT $limitInt ROWS ONLY";


            $dataStmt = $conn->prepare($dataSql);
            $dataParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
            $dataStmt->execute($dataParams);
            $items = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'total' => $total,
                'data' => $items,
            ]);
        } catch (PDOException $e) {
            echo json_encode(['error' => true, 'message' => 'Database error: ' . $e->getMessage()]);
        }
        exit();
    }

    /// SO report export csv
    if ($_GET['action'] === 'SOreportcsv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="SO_Report.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        try {
            $companyId = $_GET['company'] ?? '';
            $siteid = $_GET['siteid'] ?? '';
            $datefrom = $_GET['datefrom'] ?? null;
            $dateto = $_GET['dateto'] ?? null;
            $sellersRaw = $_GET['sellers'] ?? '';

            if (!$companyId || !$siteid || !$datefrom || !$dateto) {
                echo 'Missing required parameters';
                exit();
            }

            $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
            if (empty($sellers)) {
                echo 'No sellers selected';
                exit();
            }
            $placeholders = implode(',', array_fill(0, count($sellers), '?'));

            $dataSql = "
                SELECT 
                    t.COMPANY_ID,
                    t.SITE_ID,
                    t.TRANSACTION_ID,
                    t.INVOICE_TYPE,
                    t.TRANSACTION_DATE,
                    t.SELLER_ID,
                    t.SELLER_NAME,
                    t.CUSTOMER_ID,
                    t.CUSTOMER_NAME,
                    d.ITEM_ID,
                    d.BATCH,
                    d.DESCRIPTION,
                    d.CS,
                    d.SW,
                    d.IT,
                    d.ALLOCATED_CS,
                    d.ALLOCATED_SW,
                    d.ALLOCATED_IT,
                    d.CS_AMOUNT,
                    d.SW_AMOUNT,
                    d.IT_AMOUNT,
                    d.TOTAL_AMOUNT,
                    d.TAX_AMOUNT,
                    d.TOTAL,
                    d.DISCOUNT,
                    d.TAX,
                    d.IT_PER_CS,
                    d.IT_PER_SW,
                    t.STATUS,
                    d.DISCOUNT_AMOUNT
                FROM Aquila_Sales_Order_Details d
                LEFT JOIN Aquila_Sales_Order_Transactions t 
                  ON t.TRANSACTION_ID = d.TRANSACTION_ID 
                  AND d.COMPANY_ID = t.COMPANY_ID
                WHERE d.COMPANY_ID = ?
                  AND d.SITE_ID = ?
                  AND t.TRANSACTION_DATE BETWEEN ? AND ?
                  AND t.SELLER_ID IN ($placeholders)
                ORDER BY t.CUSTOMER_NAME ASC
            ";
            $dataStmt = $conn->prepare($dataSql);
            $dataParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
            $dataStmt->execute($dataParams);
            $items = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

            $output = fopen('php://output', 'w');
            if (!empty($items)) {
                // output header row
                fputcsv($output, array_keys($items[0]));
                // output data rows
                foreach ($items as $row) {
                    fputcsv($output, $row);
                }
            }
            fclose($output);
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        exit();
    }


    // New CSV export function
   if ($_GET['action'] === 'vanalloccsv') {
    // CSV headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="van_allocation.csv"');

    $companyId = $_GET['company'] ?? '';
    $siteid = $_GET['siteid'] ?? '';
    $datefrom = $_GET['datefrom'] ?? null;
    $dateto = $_GET['dateto'] ?? null;
    $sellersRaw = $_GET['sellers'] ?? '';

    if (!$companyId || !$siteid || !$datefrom || !$dateto) {
        echo "Missing required parameters";
        exit();
    }

    $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
    if (empty($sellers)) {
        echo "No sellers selected";
        exit();
    }

    $placeholders = implode(',', array_fill(0, count($sellers), '?'));

    // Fetch all data without pagination
    $dataSql = "SELECT
                    COMPANY_ID,
                    SITE_ID,
                    Aquila_Van_Loading_Transaction.SELLER_ID,
                    Aquila_Van_Loading_Transaction.DATE_CREATED,
                    [TRANSACTION_ID],
                    [BARCODE],
                    [ITEM_CODE],
                    [DESCRIPTION],
                    [BATCH],
                    [CS],
                    [SW],
                    [IT],
                    [PRICE],
                    [ITEM_PER_CASE],
                    [ITEM_PER_SW],
                    [SIH_IT],
                    [TOTAL_CS_AMOUNT],
                    [TOTAL_IT_AMOUNT],
                    STATUS
                FROM [dbo].[Aquila_Van_Loading_Details]
                INNER JOIN Aquila_Van_Loading_Transaction 
                    ON Aquila_Van_Loading_Transaction.LOADING_ID = Aquila_Van_Loading_Details.TRANSACTION_ID
                WHERE COMPANY_ID = ?
                  AND SITE_ID = ?
                  AND Aquila_Van_Loading_Transaction.DATE_CREATED BETWEEN ? AND ?
                  AND Aquila_Van_Loading_Transaction.SELLER_ID IN ($placeholders)
                         AND STATUS != 'DRAFT'
                ORDER BY Aquila_Van_Loading_Transaction.DATE_CREATED DESC";

    $dataStmt = $conn->prepare($dataSql);
    $dataParams = array_merge([$companyId, $siteid, $datefrom, $dateto], $sellers);
    $dataStmt->execute($dataParams);

    $output = fopen('php://output', 'w');

    // CSV header row
    fputcsv($output, [
        'COMPANY_ID', 'SITE_ID', 'SELLER_ID', 'DATE_CREATED', 'TRANSACTION_ID',
        'BARCODE', 'ITEM_CODE', 'DESCRIPTION', 'BATCH', 'CS', 'SW', 'IT', 'PRICE',
        'ITEM_PER_CASE', 'ITEM_PER_SW', 'SIH_IT', 'TOTAL_CS_AMOUNT', 'TOTAL_IT_AMOUNT', 'STATUS'
    ]);

    // CSV data rows
    while ($row = $dataStmt->fetch(PDO::FETCH_ASSOC)) {
        // Force ITEM_CODE to be treated as text in Excel
        $row['ITEM_CODE'] = '="' . $row['ITEM_CODE'] . '"';
        fputcsv($output, $row);
    }

    fclose($output);
    exit();
}
}

// VAN ALLOCATION REPORT ALL SITE
if (isset($_GET['action'])) {
    if (!$conn || !($conn instanceof PDO)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'Database connection failed']);
        exit();
    }

    // JSON Pagination Fetch
    if ($_GET['action'] === 'vanallocallsite') {
        header('Content-Type: application/json');

        try {
            $companyId = $_GET['company'] ?? '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $offset = ($page - 1) * $limit;
            $datefrom = $_GET['datefrom'] ?? null;
            $dateto = $_GET['dateto'] ?? null;
            $sellersRaw = $_GET['sellers'] ?? '';

            if (!$companyId || !$datefrom || !$dateto) {
                echo json_encode(['error' => true, 'message' => 'Missing required parameters']);
                exit();
            }

            $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
            if (empty($sellers)) {
                echo json_encode(['error' => true, 'message' => 'No sellers selected']);
                exit();
            }
            $placeholders = implode(',', array_fill(0, count($sellers), '?'));

            // Count total records
            $countSql = "
                SELECT COUNT(*) AS total
                FROM [dbo].[Aquila_Van_Loading_Details]
                INNER JOIN Aquila_Van_Loading_Transaction 
                    ON Aquila_Van_Loading_Transaction.LOADING_ID = Aquila_Van_Loading_Details.TRANSACTION_ID
                WHERE COMPANY_ID = ?
                  AND Aquila_Van_Loading_Transaction.DATE_CREATED BETWEEN ? AND ?
                  AND SITE_ID IN ($placeholders)
            ";
            $countStmt = $conn->prepare($countSql);
            $countParams = array_merge([$companyId, $datefrom, $dateto], $sellers);
            $countStmt->execute($countParams);
            $total = (int) $countStmt->fetchColumn();

            // Fetch paginated data
            $offsetInt = (int)$offset;
            $limitInt = (int)$limit;
            $dataSql = " 
                SELECT
                    COMPANY_ID,
                    SITE_ID,
                    Aquila_Van_Loading_Transaction.SELLER_ID,
                    Aquila_Van_Loading_Transaction.DATE_CREATED,
                    [TRANSACTION_ID],
                    [BARCODE],
                    [ITEM_CODE],
                    [DESCRIPTION],
                    [BATCH],
                    [CS],
                    [SW],
                    [IT],
                    [PRICE],
                    [ITEM_PER_CASE],
                    [ITEM_PER_SW],
                    [SIH_IT],
                    [TOTAL_CS_AMOUNT],
                    [TOTAL_IT_AMOUNT],
                    STATUS
                FROM [dbo].[Aquila_Van_Loading_Details]
                INNER JOIN Aquila_Van_Loading_Transaction 
                    ON Aquila_Van_Loading_Transaction.LOADING_ID = Aquila_Van_Loading_Details.TRANSACTION_ID
                WHERE COMPANY_ID = ?
                  AND Aquila_Van_Loading_Transaction.DATE_CREATED BETWEEN ? AND ?
                  AND SITE_ID IN ($placeholders)
                    AND STATUS != 'DRAFT'
                ORDER BY Aquila_Van_Loading_Transaction.DATE_CREATED DESC
              
                OFFSET $offsetInt ROWS FETCH NEXT $limitInt ROWS ONLY
            ";
            $dataStmt = $conn->prepare($dataSql);
            $dataParams = array_merge([$companyId, $datefrom, $dateto], $sellers);
            $dataStmt->execute($dataParams);
            $items = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode([
                'total' => $total,
                'data' => $items
            ]);
        } catch (PDOException $e) {
            echo json_encode(['error' => true, 'message' => 'Database error: ' . $e->getMessage()]);
        }
        exit();
    }

    // CSV Export
    if ($_GET['action'] === 'allsitvanalloccsv') {
        try {
            $companyId = $_GET['company'] ?? '';
            $datefrom = $_GET['datefrom'] ?? null;
            $dateto = $_GET['dateto'] ?? null;
            $sellersRaw = $_GET['sellers'] ?? '';

            if (!$companyId || !$datefrom || !$dateto) {
                die('Missing required parameters');
            }

            $sellers = array_filter(array_map('trim', explode(',', $sellersRaw)), 'strlen');
            if (empty($sellers)) {
                die('No sellers selected');
            }
            $placeholders = implode(',', array_fill(0, count($sellers), '?'));

            $sql = "
                SELECT
                    COMPANY_ID,
                    SITE_ID,
                    Aquila_Van_Loading_Transaction.SELLER_ID,
                    Aquila_Van_Loading_Transaction.DATE_CREATED,
                    [TRANSACTION_ID],
                    [BARCODE],
                    CAST([ITEM_CODE] AS NVARCHAR) AS ITEM_CODE, -- Prevents Excel date conversion
                    [DESCRIPTION],
                    [BATCH],
                    [CS],
                    [SW],
                    [IT],
                    [PRICE],
                    [ITEM_PER_CASE],
                    [ITEM_PER_SW],
                    [SIH_IT],
                    [TOTAL_CS_AMOUNT],
                    [TOTAL_IT_AMOUNT],
                    STATUS
                FROM [dbo].[Aquila_Van_Loading_Details]
                INNER JOIN Aquila_Van_Loading_Transaction 
                    ON Aquila_Van_Loading_Transaction.LOADING_ID = Aquila_Van_Loading_Details.TRANSACTION_ID
                WHERE COMPANY_ID = ?
                  AND Aquila_Van_Loading_Transaction.DATE_CREATED BETWEEN ? AND ?
                  AND SITE_ID IN ($placeholders)
                         AND STATUS != 'DRAFT'
                ORDER BY Aquila_Van_Loading_Transaction.DATE_CREATED DESC
            ";
            $stmt = $conn->prepare($sql);
            $params = array_merge([$companyId, $datefrom, $dateto], $sellers);
            $stmt->execute($params);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Output CSV headers
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="Allsite_van_allocation.csv"');

            $output = fopen('php://output', 'w');
            if (!empty($rows)) {
                fputcsv($output, array_keys($rows[0]));
                foreach ($rows as $row) {
                    // Add tab before ITEM_CODE to keep Excel from converting to date
                    if (isset($row['ITEM_CODE'])) {
                        $row['ITEM_CODE'] = "\t" . $row['ITEM_CODE'];
                    }
                    fputcsv($output, $row);
                }
            }
            fclose($output);
            exit();
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'loadsfamapping') {
    header('Content-Type: application/json');
    
    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'];

        $sql = "SELECT * FROM Aquila_SFA_Product_Mapping 
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


if (isset($_GET['action']) && $_GET['action'] === 'loadvaninventory') {
    header('Content-Type: application/json');

    if (!$conn || !($conn instanceof PDO)) {
        echo json_encode(['error' => 'Database connection failed']);
        exit();
    }

    try {
        $companyId = $_GET['company'] ?? null;
        $sellerId  = $_GET['sellerid'] ?? null;

        $sql = "SELECT * FROM Aquila_Van_Inventory 
                WHERE COMPANY_ID = :companyid
                AND SELLER_ID = :sellerid
                ORDER BY DESCRIPTION ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':companyid', $companyId, PDO::PARAM_INT);
        $stmt->bindParam(':sellerid', $sellerId, PDO::PARAM_INT);
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




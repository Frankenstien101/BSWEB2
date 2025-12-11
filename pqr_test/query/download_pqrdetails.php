<?php
session_start();
include '../db_connection.php';

try {

    if (empty($_POST['sites']) || empty($_POST['dtfrom']) || empty($_POST['dtto'])) {
        throw new Exception("Missing required parameters.");
    }


$comp_id = $_SESSION['comp_id'] ?? null;
 if (!$comp_id) throw new Exception("Session expired or missing company ID.");

$date = date("Y-m-d");

$sitesArray = is_array($_POST['sites']) ? $_POST['sites'] : explode(',', $_POST['sites']);
$escapedSites = implode(",", array_map(fn($s) => "''" . addslashes(trim($s)) . "''", $sitesArray));
$dt_from = $_POST['dtfrom'];
$dt_to = $_POST['dtto'];
$request_id =  "P".$_SESSION['id'].date("Ymshis");
$title = "PQR_DETAILS_REPORT";
$process_by = $_SESSION['fullname'];

$insert_query = "with cte as (select  (CS*IT_PER_CS)+IT AS QTY,od.TOTAL_AMOUNT,TRANSACTION_DATE, CUSTOMER_ID, ITEM_ID  from [dbo].[Aquila_Sales_Order_Transactions] ot join Aquila_Sales_Order_Details od 
on  ot.TRANSACTION_ID=od.TRANSACTION_ID WHERE ITEM_ID = ''5-170'' and   ot.COMPANY_ID=''{$_SESSION['comp_id']}''
GROUP BY od.TOTAL_AMOUNT,TRANSACTION_DATE, CUSTOMER_ID, ITEM_ID,CS,IT,IT_PER_CS)
SELECT d.CODE,s.SITE_CODE,
            ISNULL(a.BRAND,''DEFAULT'') AS BRAND,
            a.SELLER_ID,
            a.CU_ID,
            a.CU_NAME,
            '''' AS STATUS,
            ISNULL(a.PHOTO_STATUS,''PENDING'') AS PHOTO_STATUS,
            '''' AS After_comment,
            '''' AS Before_comment,
            l.BEFORE_LINK AS img_before,
            l.AFTER_LINK AS img_after,
            l.COT_LINK,
            a.DISTANCE AS DISTANCE,
            a.DATE_PROCESS AS DATE_CAPTURED,
            ISNULL(cte.TOTAL_AMOUNT,0) AS TOTAL_AMOUNT, ISNULL(cte.QTY,0) AS QTY,
            a.VALIDATED_DATE AS DATE_VALIDATED,
            a.USER_ID AS USER_VALIDATED
        FROM dbo.Aquila_PQR a WITH (NOLOCK)
        LEFT JOIN dbo.Aquila_PQR_Link l WITH (NOLOCK)
            ON a.PQR_ID = l.PQR_ID
        JOIN dbo.Aquila_Sites s WITH (NOLOCK)
            ON a.SITE_ID = s.SITEID AND a.COMPANY_ID = s.COMPANY_ID
        JOIN dbo.Aquila_COMPANY d WITH (NOLOCK)
            ON a.COMPANY_ID = d.ID LEFT JOIN cte ON a.CU_ID=cte.CUSTOMER_ID AND a.DATE_PROCESS = cte.TRANSACTION_DATE
        WHERE  a.COMPANY_ID = ''$comp_id''
          AND a.SITE_ID IN ($escapedSites)
          AND a.DATE_PROCESS BETWEEN ''$dt_from'' AND ''$dt_to''
        ORDER BY a.DATE_PROCESS DESC";


        $conn->query("INSERT INTO [dbo].[All_Report_Server] (REQUEST_ID, TITLE, FILENAME, DATE_CREATED,QUERY1, QUERY1_SHEETNAME, STATUS, PROCESS_BY) values('$request_id', '$title','$title',
           '$date','$insert_query','-','PENDING','$process_by')");



//     $query ="with cte as (select  (CS*IT_PER_CS)+IT AS QTY,od.TOTAL_AMOUNT,TRANSACTION_DATE, CUSTOMER_ID, ITEM_ID  from [dbo].[Aquila_Sales_Order_Transactions] ot join Aquila_Sales_Order_Details od 
// on  ot.TRANSACTION_ID=od.TRANSACTION_ID WHERE ITEM_ID = '5-170' and   ot.COMPANY_ID='{$_SESSION['comp_id']}'
// GROUP BY od.TOTAL_AMOUNT,TRANSACTION_DATE, CUSTOMER_ID, ITEM_ID,CS,IT,IT_PER_CS)
// SELECT d.CODE,s.SITE_CODE,
//             ISNULL(a.BRAND,'DEFAULT') AS BRAND,
//             a.SELLER_ID,
//             a.CU_ID,
//             a.CU_NAME,
//             '' AS STATUS,
//             ISNULL(a.PHOTO_STATUS,'PENDING') AS PHOTO_STATUS,
//             '' AS After_comment,
//             '' AS Before_comment,
//             l.BEFORE_LINK AS img_before,
//             l.AFTER_LINK AS img_after,
//             l.COT_LINK,
//             a.DISTANCE AS DISTANCE,
//             a.DATE_PROCESS AS DATE_CAPTURED,
//             ISNULL(cte.TOTAL_AMOUNT,0) AS TOTAL_AMOUNT, ISNULL(cte.QTY,0) AS QTY,
//             a.VALIDATED_DATE AS DATE_VALIDATED,
//             a.USER_ID AS USER_VALIDATED
//         FROM dbo.Aquila_PQR a WITH (NOLOCK)
//         LEFT JOIN dbo.Aquila_PQR_Link l WITH (NOLOCK)
//             ON a.PQR_ID = l.PQR_ID
//         JOIN dbo.Aquila_Sites s WITH (NOLOCK)
//             ON a.SITE_ID = s.SITEID AND a.COMPANY_ID = s.COMPANY_ID
//         JOIN dbo.Aquila_COMPANY d WITH (NOLOCK)
//             ON a.COMPANY_ID = d.ID LEFT JOIN cte ON a.CU_ID=cte.CUSTOMER_ID AND a.DATE_PROCESS = cte.TRANSACTION_DATE
//         WHERE  a.COMPANY_ID = :comp_id
//           AND a.SITE_ID IN ($escapedSites)
//           AND a.DATE_PROCESS BETWEEN ''{ }'' AND :dtto
//         ORDER BY a.DATE_PROCESS DESC";

echo $request_id;
        
} catch (Throwable $e) {
   
}
?>

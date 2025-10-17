<?php
include '../db_connection.php';
require '../vendor/autoload.php';
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


try {
    $sitesArray = $_POST["sites"];
    // Escape each site value and enclose it in single quotes
    $escapedSites = array_map(function($site) {
        return "'" . addslashes($site) . "'";
    }, $sitesArray);
    // Implode the array into a single string separated by commas
    $sites = implode(",", $escapedSites);

    // Establish the connection
    // Query to execute

   //  $query = "WITH CTE AS (SELECT 
   //      MAX(A.LINE_ID) AS ID,
   //      MIN(DISTANCE) AS CAP_DISTANCE,
   //      COMPANY_ID,
   //      MAX(ADDRESS) AS ADDRESS,
   //      SITE_ID,
   //      SELLER_SUB_ID,
   //      SELLER_ID,
   //      DATE_PROCESS,
   //      CU_ID,
   //      CU_NAME,
   //      CONCAT(CU_ID, '-', DATE_PROCESS) AS TRANS_ID,
   //   ISNULL(MAX(A.BEFORE_LINK),MAX(B.BEFORE_LINK))   AS BEFORE_LINK,
   //     ISNULL(MAX(A.AFTER_LINK),MAX(B.AFTER_LINK))   AS AFTER_LINK
   //  FROM [dbo].[Aquila_PQR] A left join Aquila_PQR_Link B ON A.PQR_ID=B.PQR_ID
   // WHERE COMPANY_ID = '{$_SESSION['comp_id']}' AND SITE_ID IN ({$sites})
   //            AND DATE_PROCESS BETWEEN '{$_POST['dtfrom']}' AND '{$_POST['dtto']}' 
   //  GROUP BY 
   //      CONCAT(CU_ID, '-', DATE_PROCESS),
   //      CU_ID,
   //      DATE_PROCESS,
   //      SELLER_ID,
   //      SELLER_SUB_ID,
   //      CU_NAME,
   //      COMPANY_ID,
   //      SITE_ID)
   //      SELECT d.CODE, c.SITE_CODE, a.SELLER_ID, a.CU_ID, a.CU_NAME,b.STATUS, b.A_COMMENT AS After_comment, b.B_COMMENT AS Before_comment,
   //                   a.BEFORE_LINK AS img_before, a.AFTER_LINK AS img_after, CAP_DISTANCE, 
   //                   a.DATE_PROCESS AS DATE_CAPTURED, b.DATE_VALIDATED AS DATE_VALIDATED FROM CTE a
   //            JOIN [dbo].[Aquila_PQR_Incentive] b ON a.ID = b.PQR_ID
   //            JOIN Aquila_Sites c ON a.SITE_ID = c.SITEID AND a.COMPANY_ID = c.COMPANY_ID
   //            JOIN Aquila_COMPANY d ON a.COMPANY_ID = d.ID";


$query="WITH CTE AS (SELECT 
        MAX(A.LINE_ID) AS ID,
        MIN(DISTANCE) AS CAP_DISTANCE,
        COMPANY_ID,
        MAX(ADDRESS) AS ADDRESS,
        SITE_ID,
        SELLER_SUB_ID,
        SELLER_ID,
        DATE_PROCESS,
        CU_ID,
        CU_NAME,
        CONCAT(CU_ID, '-', DATE_PROCESS) AS TRANS_ID,
     ISNULL(MAX(A.BEFORE_LINK),MAX(B.BEFORE_LINK))   AS BEFORE_LINK,
       ISNULL(MAX(A.AFTER_LINK),MAX(B.AFTER_LINK))   AS AFTER_LINK
    FROM [dbo].[Aquila_PQR] A left join Aquila_PQR_Link B ON A.PQR_ID=B.PQR_ID
   WHERE  COMPANY_ID = '{$_SESSION['comp_id']}' AND SITE_ID IN ({$sites})
              AND DATE_PROCESS BETWEEN '{$_POST['dtfrom']}' AND '{$_POST['dtto']}' 
    GROUP BY 
        CONCAT(CU_ID, '-', DATE_PROCESS),
        CU_ID,
        DATE_PROCESS,
        SELLER_ID,
        SELLER_SUB_ID,
        CU_NAME,
        COMPANY_ID,
        SITE_ID)
        SELECT d.CODE, c.SITE_CODE, a.SELLER_ID, a.CU_ID, a.CU_NAME,'' STATUS,'' AS After_comment, '' AS Before_comment,
                     a.BEFORE_LINK AS img_before, a.AFTER_LINK AS img_after, CAP_DISTANCE, 
                     a.DATE_PROCESS AS DATE_CAPTURED, '' AS DATE_VALIDATED FROM CTE a            
              JOIN Aquila_Sites c ON a.SITE_ID = c.SITEID AND a.COMPANY_ID = c.COMPANY_ID
              JOIN Aquila_COMPANY d ON a.COMPANY_ID = d.ID ";
    $stmt = $conn->query($query);

    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the header row
    $header = ['CODE', 'SITE_CODE', 'SELLER_ID', 'CU_ID', 'CU_NAME', 'STATUS', 
               'After_comment', 'Before_comment', 'img_before', 'img_after', 'DISTANCE', 
               'DATE_CAPTURED', 'DATE_VALIDATED'];
    $sheet->fromArray($header, NULL, 'A1');

    // Fetch rows and populate spreadsheet
    $rowNum = 2; // Starting from the second row
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $sheet->fromArray(array_values($row), NULL, 'A' . $rowNum);
        $rowNum++;
    }

    // Ensure the downloads directory exists
    $downloadsDir = __DIR__ . '/../files';
    if (!is_dir($downloadsDir)) {
        mkdir($downloadsDir, 0777, true);
    }
    $date = date('Y-m-d');
    $TIME=date('H:i:s');
    $TIME1=date('His');
    // Write spreadsheet to file
    $filename = 'PQR_Validated_Detail_' .$date.$TIME1. '.xlsx';
    $filepath = $downloadsDir . '/' . $filename;
    $writer = new Xlsx($spreadsheet);
    $writer->save($filepath);
    $INSERT_LOGS="INSERT INTO [dbo].[Aquila_PQR_DL_Logs]
    ([COMPANY_ID]
    ,[FILE_NAME]
    ,[DATE_DL]
    ,[TIME_DL]
    ,[STATUS]
    ,[FILE_TYPE],[FILE_FULL_PATH])
VALUES('{$_SESSION['comp_id']}', '{$filename}','{$date}','{$TIME}','1','PQR_DETAILED','{$filepath}')";

$conn->query($INSERT_LOGS);
 echo json_encode(['status' => 'success', 'file' => $filename]);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>
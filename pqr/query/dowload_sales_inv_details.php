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
    $query = "SELECT Aquila_Invoice_lines.COMPANY_ID,Aquila_Invoice_lines.SITE_ID,SITE_CODE,Aquila_Invoice_lines.TRANSACTION_ID,Aquila_Invoice_lines.TRANSACTION_DATE,
                        INVOICE_TYPE, Aquila_Invoice_lines.INVOICE_NUMBER,isnull(PO_NUMBER,'-') as PO_NUMBER,Aquila_Sales_Order_Transactions.SELLER_ID,COALESCE(SB_VAN_ID, '-') AS SB_VAN_ID,Aquila_Sales_Order_Transactions.SELLER_NAME,Aquila_Sales_Order_Transactions.CUSTOMER_ID,Aquila_Sales_Order_Transactions.CUSTOMER_NAME,
                        COALESCE(CHAIN, '-') AS CHAIN,CHANNEL,SUB_CHANNEL,CASE_BARCODE,IT_BARCODE,IT_PER_CS AS 'ITEM_PER_CASE',BRAND2,CATEGORY_AFFIE,Aquila_Invoice_lines.ITEM_ID,DESCRIPTION,QTY,UOM,AMOUNT AS COST,TOTAL AS GROSS_SALES,Aquila_Invoice_lines.DISCOUNT,TOTAL-Aquila_Invoice_lines.DISCOUNT AS [NET_SALES(W/VAT)],
                        (TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12) AS VAT_AMOUNT,(TOTAL-Aquila_Invoice_lines.DISCOUNT) - ((TOTAL-Aquila_Invoice_lines.DISCOUNT)-((TOTAL-Aquila_Invoice_lines.DISCOUNT) / 1.12)) AS 'NET_SALES(EX-VAT)' FROM Aquila_Invoice_lines INNER JOIN Aquila_Sales_Order_Transactions 
                        ON Aquila_Sales_Order_Transactions.TRANSACTION_ID = Aquila_Invoice_lines.TRANSACTION_ID LEFT JOIN Aquila_Sites ON Aquila_Sites.SITEID = Aquila_Invoice_lines.SITE_ID left join Aquila_Item_Barcodes ON Aquila_Item_Barcodes.ITEM_ID = Aquila_Invoice_lines.ITEM_ID LEFT JOIN Aquila_Customer_Channel ON
                        Aquila_Customer_Channel.CUSTOMER_ID = Aquila_Sales_Order_Transactions.CUSTOMER_ID LEFT JOIN Aquila_Seller ON Aquila_Seller.SELLER_SUB_ID = Aquila_Sales_Order_Transactions.SELLER_ID  WHERE Aquila_Invoice_lines.COMPANY_ID = '{$_SESSION['comp_id']}' and Aquila_Invoice_lines.SITE_ID in ({$sites}) AND Aquila_Invoice_lines.TRANSACTION_DATE BETWEEN '{$_POST['dtfrom']}' AND '{$_POST['dtto']}' ";

    $stmt = $conn->query($query);

    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the header row
    $header = ['COMPANY_ID',    'SITE_ID',  'SITE_CODE',    'TRANSACTION_ID',   'TRANSACTION_DATE', 'INVOICE_TYPE', 'INVOICE_NUMBER',   'PO_NUMBER',    'SELLER_ID',    'SB_VAN_ID',    'SELLER_NAME',  'CUSTOMER_ID',  'CUSTOMER_NAME',    'CHAIN',    'CHANNEL',  'SUB_CHANNEL',  'CASE_BARCODE', 'IT_BARCODE',   'ITEM_PER_CASE',    'BRAND2',   'CATEGORY_AFFIE',   'ITEM_ID',  'DESCRIPTION',  'QTY',  'UOM',  'COST', 'GROSS_SALES',  'DISCOUNT', 'NET_SALES(W/VAT)', 'VAT_AMOUNT',   'NET_SALES(EX-VAT)'];

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
    $filename = 'SalesInvoiceDetails_' .$date.$TIME1. '.xlsx';
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
VALUES('{$_SESSION['comp_id']}', '{$filename}','{$date}','{$TIME}','1','INV_DETAILED','{$filepath}')";

$conn->query($INSERT_LOGS);
 echo json_encode(['status' => 'success', 'file' => $filename]);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>
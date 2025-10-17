<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
include "../db_connection.php";
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {
    $fileName = $_FILES['import_file_coverage']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];    
    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file_coverage']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $rowCount = count($data) - 1; // Total number of rows (excluding header)
        $batchSize = 1000; // Number of rows to process in each batch
        $totalProcessed = 0; // Total rows processed
        // Array to store insert values
        $cu_id = [];

        $values = [];
        $processid = date('YmdHis');

        foreach ($data as $rowIndex => $row) {
            if ($rowIndex === 0) {
                continue; // Skip header row
            }
            $CUSTOMER_ID=$row[3];
            $cu_id[] = "'".$CUSTOMER_ID."'";        
            }
            updateBatch($cu_id);
        foreach ($data as $rowIndex => $row) {
            if ($rowIndex === 0) {
                continue; // Skip header row
            }
            $COMPANY_ID=$row[0];
            $SITE_ID=$row[1];
            $PROCESS_ID=$processid;
            $SELLER_ID=$row[2];
            $CUSTOMER_ID=$row[3];
            $FREQUENCY=$row[4];
            $WEEK1=$row[5];
            $WEEK2=$row[6];
            $WEEK3=$row[7];
            $WEEK4=$row[8];
            $WEEK5=$row[9];
            $MONDAY=$row[10];
            $TUESDAY=$row[11];
            $WEDNESDAY=$row[12];
            $THURSDAY=$row[13];
            $FRIDAY=$row[14];
            $SATURDAY=$row[15];
            $SUNDAY=$row[16];
            $STATUS=$row[17];         
            $cu_id[] = "'".$CUSTOMER_ID."'";
            // Prepare values for bulk insert
            $values[] = "('$COMPANY_ID','$SITE_ID','$PROCESS_ID',	'$SELLER_ID',	'$CUSTOMER_ID',	'$FREQUENCY',	
            '$WEEK1',	'$WEEK2',	'$WEEK3',	'$WEEK4',	'$WEEK5',	'$MONDAY',	'$TUESDAY',	'$WEDNESDAY',	
            '$THURSDAY',	'$FRIDAY',	'$SATURDAY',	'$SUNDAY',	'$STATUS')";

            // If number of values exceeds batch size or reached end of file, insert the batch
            if (count($values) >= $batchSize || $rowIndex === $rowCount) {
                insertBatch($values);
                $totalProcessed += count($values);
                // Calculate progress

                $progress = min(($totalProcessed / $rowCount) * 100, 100);
                echo "data: $progress\n\n"; // Output progress
    flush(); // Flush output to ensure it's sent immediately
    ob_flush(); // Flush output buffers
                // Reset values array for next batch
                $values = [];
            }
        }

  //echo "Upload completed. Total records processed: $totalProcessed";
    } else {
        echo "Invalid file type.";
    }
} catch (Exception $EX) {
    echo "Error: " . $EX->getMessage();
}

function updateBatch($values) {
    global $conn;
    $query = "UPDATE Aquila_Coverage set STATUS='INACTIVE' WHERE CUSTOMER_ID IN (". implode(',', $values).")";
    // Execute the query
    $conn->query($query);
}

function insertBatch($values) {
    global $conn;

    $query = "INSERT INTO [dbo].[Aquila_Coverage]
           ([COMPANY_ID]
           ,[SITE_ID]
           ,[PROCESS_ID]
           ,[SELLER_ID]
           ,[CUSTOMER_ID]
           ,[FREQUENCY]
           ,[WEEK1]
           ,[WEEK2]
           ,[WEEK3]
           ,[WEEK4]
           ,[WEEK5]
           ,[MONDAY]
           ,[TUESDAY]
           ,[WEDNESDAY]
           ,[THURSDAY]
           ,[FRIDAY]
           ,[SATURDAY]
           ,[SUNDAY]
           ,[STATUS])
     VALUES" . implode(',', $values);

    $conn->query($query);
}
?>

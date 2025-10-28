<?php
include "../db_connection.php";
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    
    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $rowCount = count($data) - 1; // Total number of rows (excluding header)
        $batchSize = 1000; // Number of rows to process in each batch
        $totalProcessed = 0; // Total rows processed

        // Array to store insert values
        $values = [];

        foreach ($data as $rowIndex => $row) {
            if ($rowIndex === 0) {
                continue; // Skip header row
            }

            $company_id = $row[0];
            $site_id = $row[1];
            $pqr_line = $row[2];
            $GENERALRANK = $row[3];
            $LOCAL_RANK = $row[4];
            $CUSTOMER_ID = $row[5];
            $STORE_NAME = $row[6];
            $DATE_PROCESS = date('Y-m-d', strtotime($row[7]));
            $TOTAL_SALES = $row[8];
            $SKU_LINES = $row[9];
            $TOTAL_SKU_PER_QTY_IT = $row[10];

            // Prepare values for bulk insert
            $values[] = "('$company_id','$site_id','$pqr_line','$GENERALRANK','$LOCAL_RANK','$CUSTOMER_ID',
            '$STORE_NAME','$DATE_PROCESS','$TOTAL_SALES','$SKU_LINES','$TOTAL_SKU_PER_QTY_IT')";

            // If number of values exceeds batch size or reached end of file, insert the batch
            if (count($values) >= $batchSize || $rowIndex === $rowCount) {
                insertBatch($values);
                $totalProcessed += count($values);

                // Calculate progress
                $progress = min(($totalProcessed / $rowCount) * 100, 100);

                // Send progress to frontend
                echo "<script>parent.progressHandler($progress);</script>";

                // Reset values array for next batch
                $values = [];
            }
        }

        echo "Upload completed. Total records processed: $totalProcessed";
    } else {
        echo "Invalid file type.";
    }
} catch (Exception $EX) {
    echo "Error: " . $EX->getMessage();
}

function insertBatch($values) {
   
    global $conn;

    $query = "INSERT INTO [dbo].[Aquila_PQR_Incentive_1]
    ([COMPANY_ID], [SITE_ID], [PQR_ID], [GLOBAL_RANK], [LOCAL_RANK], [CUSTOMER_ID], [CUSTOMER_NAME], [DATE_PROCESS], 
    [TOTAL_SALES], [SKU_LINE], [TOTAL_SKU_QTY_IT])
    SELECT * FROM (VALUES " .implode(',', $values). "
    )AS source ([COMPANY_ID], [SITE_ID], [PQR_ID], [GLOBAL_RANK], [LOCAL_RANK], [CUSTOMER_ID], [CUSTOMER_NAME], [DATE_PROCESS], 
    [TOTAL_SALES], [SKU_LINE], [TOTAL_SKU_QTY_IT])
    WHERE NOT EXISTS (
        SELECT 1 FROM [dbo].[Aquila_PQR_Incentive_1] AS target
        WHERE target.[PQR_ID] = source.[PQR_ID]
    );";
   
    // Execute the query
    $conn->query($query);
}
?>

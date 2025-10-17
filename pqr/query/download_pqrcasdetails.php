<?php
include '../db_connection.php';
session_start();

$filename = "PQRCAS_DETAILS_".date('YmdHis').".csv";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename='.$filename);

// Open PHP output stream for writing CSV
$output = fopen('php://output', 'w');

$site_id = !isset($_POST['site_id'])?$_SESSION['ses_site'] :'';
if(isset($_POST['site_id'])){
$s_id = [];
foreach($_POST['site_id'] as $row){
    $s_id[] = $row;
}
$site_id = implode(",", $s_id);
}
$principal_id = !isset($_POST['principal_id'])?$_SESSION['comp_id'] :'';
if(isset($_POST['principal_id'])){

$p_id = [];
foreach($_POST['principal_id'] as $row){
    $p_id[] = $row;
}
$principal_id = implode(",", $p_id);
}

// Define the CSV header
fputcsv($output, ['COMPANY_ID', 'SITE_ID',  'SITE_CODE',    'STORE_CODE',   'CUSTOMER_NAME',    'SELLER_ID',    'GUIDELINES_ID',    'GUIDELINES_DESCRIPTION',   'EFFECTIVE_FROM',   'EFFECTIVE_TO', 'LINEID',   'BRAND',    'DESCRIPTION',  'SHOULD_BE_FC', 'HAS_PHOTO',    'CAPTURED_IMG', 'COMMENT',  'FACING_COUNT_ACTUAL',  'STATUS']);

// Prepare SQL query to fetch data
$Q = "with CTE AS ( select  a.COMPANY_ID,a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID],  SD.GUIDELINES_ID,st.DESCRIPTION AS GUIDELINES_DESCRIPTION,st.EFFECTIVE_FROM,st.EFFECTIVE_TO,SD.LINEID,SD.BRAND, SD.DESCRIPTION,
SD.SHELVING_FACING_COUNT AS SHOULD_BE_FC
from Aquila_Customers a join Aquila_Coverage  b on a.STORE_CODE = b.CUSTOMER_ID 
AND a.COMPANY_ID=b.COMPANY_ID JOIN [dbo].[Aquila_Seller] AQS ON  b.SELLER_ID=AQS.SELLER_SUB_ID
JOIN [dbo].[Aquila_Sites] STS ON AQS.SITE_ID = STS.SITEID
CROSS JOIN [SNAP_GUIDELINE_SETUP_DETAILS] SD join [dbo].[SNAP_GUIDELINE_SETUP_TRANSACTION] st on SD.GUIDELINES_ID=st.GUIDELINES_ID WHERE b.SELLER_ID NOT LIKE '%PRE%' AND  SELLER_TYPE='PRE SELLER' AND b.COMPANY_ID ='5' AND SD.COMPANY_ID='5'
and a.STATUS='ACTIVE' AND b.STATUS='ACTIVE'
GROUP BY a.COMPANY_ID,a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID],SD.GUIDELINES_ID,st.DESCRIPTION  ,st.EFFECTIVE_FROM,st.EFFECTIVE_TO,SD.LINEID,SD.BRAND,SD.DESCRIPTION
,SD.SHELVING_FACING_COUNT)
SELECT distinct CTE.*,(case when sl.LINEID is null then 0 else 1 end) as HAS_PHOTO, sl.CAPTURED_IMG,sl.COMMENT,sl.FACING_COUNT_ACTUAL,sl.STATUS FROM CTE 
left join [dbo].[SNAP_EXECUTION_LINES] sl on CTE.GUIDELINES_ID = sl.GUIDELINE_ID  and CTE.STORE_CODE=sl.STORE_ID and CTE.LINEID = sl.GUIDELINE_QUESTION_LINEID";

// Execute the query and write each row as a CSV entry
foreach ($conn->query($Q) as $row) {
    // Ensure the data is properly formatted
    $data = [ $row['COMPANY_ID'],
$row['SITE_ID'],
$row['SITE_CODE'],
$row['STORE_CODE'],
$row['CUSTOMER_NAME'],
$row['SELLER_ID'],
$row['GUIDELINES_ID'],
$row['GUIDELINES_DESCRIPTION'],
$row['EFFECTIVE_FROM'],
$row['EFFECTIVE_TO'],
$row['LINEID'],
$row['BRAND'],
$row['DESCRIPTION'],
$row['SHOULD_BE_FC'],
$row['HAS_PHOTO'],
$row['CAPTURED_IMG'],
$row['COMMENT'],
$row['FACING_COUNT_ACTUAL'],
$row['STATUS']
    ];

    // Write the row to the CSV
    fputcsv($output, $data);
}

// Close the file pointer
fclose($output);
exit;
?>

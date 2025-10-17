<?php
// Check if the 'file' parameter is present in the query string
if (!isset($_GET['file'])) {
    die('File not specified.');
}
// Sanitize the input to prevent directory traversal attacks
$temp = basename($_GET['file']);
// Define the path to the files directory and the target file
$file = '../files/'.$temp;
// Check if the file exists
if (!file_exists($file)) {
    echo $file;
    die('File does not exist.');
}


// Set headers to prompt a file download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));

// Clear output buffer
ob_clean();
flush();

// Read the file and output its content
readfile($file);
exit;
?>

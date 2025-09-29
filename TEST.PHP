<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello PhpSpreadsheet!');
$sheet->setCellValue('B1', 'It works!');

// Set HTTP headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="test_output.xlsx"');
header('Cache-Control: max-age=0');

// Create the writer and output to browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;  // Ensure no extra output is sent

<?php
// ✅ Point this to where you extracted phpoffice/phpspreadsheet
require __DIR__ . '/vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create new Spreadsheet
$spreadsheet = new Spreadsheet();

/*
 * -------- SHEET 1 --------
 */
$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle("Dataset1");

// Example dataset 1
$data1 = [
    ['ID', 'Name', 'Age'],
    [1, 'Alice', 24],
    [2, 'Bob', 30],
    [3, 'Charlie', 28],
];
$row = 1;
foreach ($data1 as $d) {
    $col = 'A';
    foreach ($d as $value) {
        $sheet1->setCellValue($col . $row, $value);
        $col++;
    }
    $row++;
}

/*
 * -------- SHEET 2 --------
 */
$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle("Dataset2");

// Example dataset 2
$data2 = [
    ['Product', 'Price'],
    ['Laptop', 55000],
    ['Phone', 25000],
];
$row = 1;
foreach ($data2 as $d) {
    $col = 'A';
    foreach ($d as $value) {
        $sheet2->setCellValue($col . $row, $value);
        $col++;
    }
    $row++;
}

/*
 * -------- SHEET 3 --------
 */
$sheet3 = $spreadsheet->createSheet();
$sheet3->setTitle("Dataset3");

// Example dataset 3
$data3 = [
    ['Dept', 'Head'],
    ['Sales', 'John'],
    ['IT', 'Sarah'],
];
$row = 1;
foreach ($data3 as $d) {
    $col = 'A';
    foreach ($d as $value) {
        $sheet3->setCellValue($col . $row, $value);
        $col++;
    }
    $row++;
}

// Set back to first sheet
$spreadsheet->setActiveSheetIndex(0);

// Output as download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

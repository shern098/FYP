<?php



require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//load spreadsheet
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("formatexcel.xlsx");

//change it
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('B11', 'Umar');

header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan.xlsx");

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');


?>
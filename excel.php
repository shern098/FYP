<?php
// Create a connection to the database
$conn = mysqli_connect ("localhost", "root", "", "dbsn");
session_start();

$user = $_SESSION["CurrentUser"];
$tarikh   = $_SESSION['date'];
if (!$user) {
    echo "<script>window.location.href='index.php';</script>";
}

if(isset($_GET["wad"])){
    $wad = $_GET["wad"];
}
if(isset($_GET["tarikh"])){
    $tarikh = $_GET["tarikh"];
}

if(isset($_GET["shifts"])){
$shift = $_GET["shifts"];
}
$getdata = "SELECT * FROM `tblpatient` where wad = '$wad' and LOCATE('$shift',`id_patient`) and DATE(masa_keyin_nurse) = '$tarikh'  and `status` IN (1, 2, 3,4) ORDER BY `tblpatient`.`rn` ASC";
$display = mysqli_query($conn, $getdata);
//display data



require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//load spreadsheet
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("formatexcel.xlsx");

//change it
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('C7', $tarikh);

$sheet->setCellValue('N7', $wad);

if (mysqli_num_rows($display) > 0) {
    $row=11;
        while ($data = mysqli_fetch_assoc($display)) {
            $nurseh=$data["nurse_penghantar"];
            $nurset=$data["nurse_penerima"];
            $masateriman=$data["masa_terima_nurse"];
           
            $terima=$data["unit_penerima"];
            $serah=$data["unit_penyerah"];
            $masaterima=$data["masa_terima"];
            $masaserah=$data["masa_serah"];
            $sheet->setCellValue('B'.$row, $data["rn"]);
            $sheet->setCellValue('F'.$row, $data["bednum"]);
            $sheet->setCellValue('H'.$row, $data["name"]);
            $sheet->setCellValue('J'.$row, $data["iddiet"]);
            $sheet->setCellValue('N'.$row, $data["catatan"]);
            $row++;

        }
        $sheet->setCellValue('F42',  $nurseh);
        $sheet->setCellValue('F52',  $terima);
        $sheet->setCellValue('Q52',  $serah);
        $sheet->setCellValue('F54',  $masaterima);
        $sheet->setCellValue('Q54',  $masaserah);

        $getdata = "SELECT `jawatan` FROM `tblnurse` WHERE  `nama`='$nurseh'";
    $display = mysqli_query($conn, $getdata);
    //display data
    if (mysqli_num_rows($display) > 0) {
        while ($data = mysqli_fetch_assoc($display)) {
        $sheet->setCellValue('F44',  $data['jawatan']);
        }}
        $getdata = "SELECT `jawatan` FROM `tblunitdietik` WHERE  `Nama`='$terima'";
    $display = mysqli_query($conn, $getdata);
    //display data
    if (mysqli_num_rows($display) > 0) {
        while ($data = mysqli_fetch_assoc($display)) {
            $sheet->setCellValue('F53',  $data['jawatan']);
        }}
   
    $getdata = "SELECT `jawatan` FROM `tblunitdietik` WHERE  `Nama`='$serah'";
    $display = mysqli_query($conn, $getdata);
    //display data
    if (mysqli_num_rows($display) > 0) {
        while ($data = mysqli_fetch_assoc($display)) {
            $sheet->setCellValue('Q53',  $data['jawatan']);
        }}
 }
    $getdata = "SELECT * FROM `tblbilorder`where groupid='$wad' ORDER BY `tblbilorder`.`idnum` ASC ";
    $display = mysqli_query($conn, $getdata);
    //display data
    if (mysqli_num_rows($display) > 0) {
        $roww=10;
        while ($data = mysqli_fetch_assoc($display)) {
            if($roww == 25 || $roww == 27){
            $sheet->setCellValue('V'.$roww, $data["bil"]);
            $roww=$roww+2;}
            else{
            $sheet->setCellValue('V'.$roww, $data["bil"]);
            $roww++;
            }
        }
    }

    $getdata = "SELECT * FROM `tblnurse` WHERE  `nama`='$nurset'";
    $display = mysqli_query($conn, $getdata);
    //display data
    if (mysqli_num_rows($display) > 0) {
        if ($shift == 'M') {
        while ($data = mysqli_fetch_assoc($display)) {
        $sheet->setCellValue('N45',  $data['jawatan']);
        $sheet->setCellValue('N43',  $data['nama']);
        $sheet->setCellValue('N46', $masateriman);

        $sheet->setCellValue('P45',  $data['jawatan']);
        $sheet->setCellValue('P43',  $data['nama']);
        $sheet->setCellValue('P46',  $masateriman);

        }}else{
        while ($data = mysqli_fetch_assoc($display)) {
            $sheet->setCellValue('T45',  $data['jawatan']);
            $sheet->setCellValue('T43',  $data['nama']);
        $sheet->setCellValue('T46', $masateriman);

            $sheet->setCellValue('U45',  $data['jawatan']);
            $sheet->setCellValue('U43',  $data['nama']);
        $sheet->setCellValue('U46', $masateriman);

            }}
        }


        if ($shift == 'M') {
            $sheet->setCellValue('S7',  "WAKTU : PAGI");
            }else{
            $sheet->setCellValue('S7',  "WAKTU : PETANG");

            }
    mysqli_close($conn);

header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan".$tarikh.$wad.$shift.".xlsx");

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

?>
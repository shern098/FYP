
<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Subtotal;

include("db_connection.php");
session_start();

$tarikh = $_SESSION["date"];

if (isset($_GET["shift"])) {
    $shift =  $_GET["shift"];
    if ($shift == "pagi"){
    $id_shift = "M";
    }elseif ($shift == "petang") {
        $id_shift = "E";
    } 
}

if (isset($_GET['rn'])) {

    if (is_numeric($_GET['rn'])) {
        $rn = mysqli_real_escape_string($conn, $_GET['rn']);
    } else {
        echo "<script>alert('R/N pesakit tidak boleh huruf/bersama huruf');</script>";
        die("<script> window.history.back(); </script> ");
    }
}


if (isset($_GET['nokatil'])) {
    $nokatil = mysqli_real_escape_string($conn, $_GET['nokatil']);
}

if (isset($_GET['kelas'])) {
    $kelas = mysqli_real_escape_string($conn,  $_GET['kelas']);
}

if (isset($_GET['nama'])) {
    $nama = mysqli_real_escape_string($conn, $_GET['nama']);
}

if (isset($_GET['diet'])) {
    $diet = mysqli_real_escape_string($conn, $_GET['diet']);
}

if (isset($_GET['txtcatatan'])) {
    $catatan = mysqli_real_escape_string($conn, $_GET['txtcatatan']);
}

// Get the current user from the session
if (isset($_GET['currentuser'])) {
    $user = mysqli_real_escape_string($conn, $_GET['currentuser']);
}
// PROCEDURAL STYLE MYSQLI

$tahun = substr($tarikh, 2,2);
$bulan = substr($tarikh, 5,2);
$hari = substr($tarikh, 8,2);
$kelasnum = substr($kelas, 1,strlen($kelas));

// combination of
//  2 last digit of year
//  2 digit of month
//  2 digit of date
//  shift 
//  number of class
//  rn 
$idpatient = $tahun.$bulan.$hari.$id_shift.$kelasnum.$rn;
// Use a try-catch block to catch unique constraint violation error
try {

    $getdata = $conn->prepare("INSERT INTO `tblpatient`(`id_patient`,`rn`, `bednum`, `name`, `kelas`, `iddiet`, `catatan`, `wad`, `shift`) VALUES (?,?,?,?,?,?,?,?,?)");
    $getdata->bind_param("sssssssss",$idpatient, $rn, $nokatil, $nama, $kelas, $diet, $catatan, $user, $shift);


    if ($getdata->execute()) {
        $_SESSION['add_success'] = true;

        echo "<script> window.location.href = 'WadAddPatient.php'; </script> ";
    } else {
        echo "Error inserting record: " . $getdata->error . "<br>";
    }
} catch (Exception $e) {
    $_SESSION['duplicate_data'] = true;
    $_SESSION['rn'] = $rn;
    // Handle the unique constraint violation (duplicate rn) error here
    echo "console.log(Error: " . $e->getMessage() . ")";
    echo "<script> window.history.back(); </script> ";
} finally {
    $getdata->close(); // Close the prepared statement
    $conn->close(); // Close the database connection
}

?>

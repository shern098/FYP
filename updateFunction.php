<?php
// Include database connection
include("db_connection.php");
session_start();
if (isset($_GET['update'])) {

    $tarikh = $_SESSION["date"];

    if (isset($_GET["shift"])) {
        $shift =  $_GET["shift"];
        if ($shift == "PAGI") {
            $id_shift = "M";
        } elseif ($shift == "PETANG") {
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

    
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
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
        $catatan = trim($_POST['txtcatatan'] ?? '');
        if (!$catatan) {
            $catatan  = "Tiada Catatan";
        }
    }

    // Get the current user from the session
    if (isset($_GET['currentuser'])) {
        $user = mysqli_real_escape_string($conn, $_GET['currentuser']);
    }

    // PROCEDURAL STYLE MYSQLI

    $tahun = substr($tarikh, 2, 2);
    $bulan = substr($tarikh, 5, 2);
    $hari = substr($tarikh, 8, 2);
    $kelasnum = substr($kelas, 1, strlen($kelas));

    // combination of
    //  2 last digit of year
    //  2 digit of month
    //  2 digit of date
    //  shift 
    //  number of class
    //  rn 
    $idpatient = $tahun . $bulan . $hari . $id_shift . $kelasnum . $rn;
    $findpatient = "SELECT * FROM `tblpatient` where id_patient = '$idpatient' and  DATE(masa_keyin_nurse) = '$tarikh' ";

    $finding = mysqli_query($conn, $findpatient);
    if (mysqli_num_rows($finding) > 0) {
     

        echo "found similar data. Unable to update.<br>";
       
}else{
    echo "no data yet.Can Update";
       // Construct the SQL query to update the record
        $updateQuery = "UPDATE tblpatient SET id_patient='$idpatient', rn='$rn', name='$nama', bednum='$nokatil', kelas='$kelas', iddiet='$diet',catatan='$catatan' ,`masa_keyin_nurse`=CURRENT_TIMESTAMP WHERE id_patient='$id'";

        // Execute the update query
        if (mysqli_query($conn, $updateQuery)) {
            // Redirect back to the form page with a success message in the URL
            $_SESSION['update_success'] = true;
  
            header("Location: WadEditOrder.php");
            exit();
        } else {
            // Handle the case where the update query fails
            echo "Error updating record: " . mysqli_error($conn);
        }
}
}
else {
    // Handle the case where required data is missing in the URL
    echo "Data missing in the URL.";
}
mysqli_close($conn);
?>
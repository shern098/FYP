
<?php

include("db_connection.php");
session_start();


if (isset($_GET["shift"])) {
    $shift =  $_GET["shift"];
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

// Use a try-catch block to catch unique constraint violation error
try {

  
    $getdata = $conn->prepare("INSERT INTO `tblpatient`(`rn`, `bednum`, `name`, `kelas`, `iddiet`, `catatan`, `wad`, `shift`) VALUES (?,?,?,?,?,?,?,?)");
    $getdata->bind_param("ssssssss", $rn, $nokatil, $nama, $kelas, $diet, $catatan,$user, $shift);


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
    echo "console.log(Error: " . $e->getMessage() .")";
    echo "<script> window.history.back(); </script> ";
} finally {
    $getdata->close(); // Close the prepared statement
    $conn->close(); // Close the database connection
}

?>


<?php

include("db_connection.php");
session_start();
if (isset($_POST["shift"])) {
  $shift =  $_POST["shift"];
}

if (isset($_POST['rn'])) {

  if (is_numeric($_POST['rn'])) {
      $rn = mysqli_real_escape_string($conn, $_POST['rn']);
  } else {
      echo "<script>alert('R/N pesakit tidak boleh huruf/bersama huruf');</script>";
      die("<script> window.history.back(); </script> ");
  }
}


if (isset($_POST['nokatil'])) {
  if (is_numeric($_POST['nokatil'])) {
      $nokatil = mysqli_real_escape_string($conn, $_POST['nokatil']);
  } else {
      echo "<script>alert('Nombor katil pesakit tidak boleh huruf/bersama huruf');</script>";
      die("<script> window.history.back(); </script> ");
  }
}


if (isset($_POST['kelas'])) {
  $kelas = mysqli_real_escape_string($conn,  $_POST['kelas']);
}

if (isset($_POST['nama'])) {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
}

if (isset($_POST['diet'])) {
  $diet = mysqli_real_escape_string($conn, $_POST['diet']);
}

if (isset($_POST['txtcatatan'])) {
  $catatan = mysqli_real_escape_string($conn, $_POST['txtcatatan']);
}
// Get the current user from the session
$user = $_SESSION['CurrentUser'];

// PROCEDURAL STYLE MYSQLI

// Use a try-catch block to catch unique constraint violation error
try {

    $getdata = $conn->prepare("INSERT INTO `tblpatient`(`rn`, `bednum`, `name`, `kelas`, `iddiet`, `catatan`, `wad`, `shift`) VALUES (?,?,?,?,?,?,?,?)");
    $getdata->bind_param("ssssssss", $rn, $nokatil, $nama, $kelas, $diet, $catatan, $user, $shift);


    if ($getdata->execute()) {
        $_SESSION['add_success'] = true;

        // Display an alert with the values of the parameters
        echo "<script>alert('$rn $nokatil $kelas $nama $diet');</script>";
    } else {
        die("Error inserting record: " . $getdata->error . "<br>");
    }
} catch (Exception $e) {
    $_SESSION['duplicate_data'] = true;
    $_SESSION['rn'] = $rn;
    // Handle the unique constraint violation (duplicate rn) error here

} finally {
    $getdata->close(); // Close the prepared statement
    $conn->close(); // Close the database connection
}

?>

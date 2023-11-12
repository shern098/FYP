<?php

include "db_connection.php";
session_start();
if ( isset($_GET['id']) && isset($_GET['status']) ){
  $id = $_GET['id'];
  $status = $_GET['status'];



  $sqlkeyin = "UPDATE `tblpatient` SET `status`='$status',`masa_keyIn`=CURRENT_TIMESTAMP , `nama_nurse`=''  WHERE rn='$id'";

  if (mysqli_query($conn, $sqlkeyin)) {
    // Redirect back to the form page with a success message in the URL
    $_SESSION['cancel_success'] = true;
   header("Location: WadEditOrder.php");
    exit();
} else {
    // Handle the case where the update query fails
    echo "Error sending record: " . mysqli_error($conn);
}
} else {
// Handle the case where required data is missing in the URL
echo "Data missing in the URL.";
}
mysqli_close($conn);
?>
<?php
// Include database connection
include("db_connection.php");
session_start();
if (isset($_GET['rn'])) {
    // Retrieve data from the form
    $id = mysqli_real_escape_string($conn, $_GET['rn']);
    $rn = mysqli_real_escape_string($conn, $_GET['rn']);
    $nama = mysqli_real_escape_string($conn, $_GET['nama']);
    $nokatil = mysqli_real_escape_string($conn, $_GET['nokatil']);
    $kelas = mysqli_real_escape_string($conn, $_GET['kelas']);
    $diet = mysqli_real_escape_string($conn, $_GET['diet']);
    $catatan = mysqli_real_escape_string($conn, $_GET['catatan']); 

    // Construct the SQL query to update the record
    $updateQuery = "UPDATE tblpatient SET rn='$rn', name='$nama', bednum='$nokatil', kelas='$kelas', iddiet='$diet',catatan='$catatan' ,`masa_keyIn`=CURRENT_TIMESTAMP WHERE rn='$id'";

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
} else {
// Handle the case where required data is missing in the URL
echo "Data missing in the URL.";
}
mysqli_close($conn);
?>


<?php
session_start();
include("db_connection.php");

if (isset($_GET['nurseId']) && isset($_GET['nurseName']) && isset($_GET['rnList']) && isset($_GET['currentUser'])) {
    $nurseId = $_GET['nurseId'];
    $nurseName = $_GET['nurseName'];
    $rnList = $_GET['rnList'];
    $currentUser = $_GET['currentUser'];

    echo '"' . implode('","', $rnList) . '"';
    // Update the status of selected rows in the database and set the nurse name and currentUser.
    $updateQuery = 'UPDATE tblpatient SET status = 1, nurse_penghantar = ?, masa_keyin_nurse = CURRENT_TIMESTAMP, wad = ? WHERE id_patient IN ("' . implode('","', $rnList) . '")';

    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss" ,$nurseName,$currentUser); // Bind nurse name and currentUser as parameters.

    if (mysqli_stmt_execute($stmt)) {
      echo 'success'; // Database update was successful.
  } else {
      echo 'error: ' . mysqli_error($conn); // Include the MySQL error message.
  }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

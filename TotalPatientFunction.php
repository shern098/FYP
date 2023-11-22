<?php 

 //connect database
 include("db_connection.php");
 $tarikh   = $_SESSION['date'];

 // select data
 $getTotalPatient = "SELECT wad, COUNT(*) as total_patient, DATE(masa_keyIn) as submission_date
 FROM tblpatient
 WHERE status = 1 AND DATE(masa_keyIn) = '$tarikh'
 GROUP BY wad, submission_date;";

 $displayTotalPatient = mysqli_query($conn, $getTotalPatient);

?>
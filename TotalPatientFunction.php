<?php 

 //connect database
 include("db_connection.php");
 $tarikh   = $_SESSION['date'];

 // select data
 $getTotalPatient = "SELECT wad, COUNT(*) as total_patient, DATE(masa_keyin_nurse) as submission_date
 FROM tblpatient
 WHERE  DATE(masa_keyin_nurse) = '$tarikh'
 GROUP BY wad, submission_date;";

 $displayTotalPatient = mysqli_query($conn, $getTotalPatient);

?>
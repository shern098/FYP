<?php 

 //connect database
 include("db_connection.php");

 // select data
 $getTotalPatient = "SELECT wad, COUNT(*) as total_patient
 FROM tblpatient
 WHERE status = 1
 GROUP BY wad;";

 $displayTotalPatient = mysqli_query($conn, $getTotalPatient);

?>
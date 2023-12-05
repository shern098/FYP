<?php 

include("db_connection.php");

$user = $_SESSION["CurrentUser"];

$tarikh   = $_SESSION['date'];

$getTotalDiet = "SELECT masa_keyin_nurse, iddiet, COUNT(*) as total_diet FROM 
tblpatient   WHERE wad = '$user' AND status IN (1,2,3,4)
 AND DATE(masa_keyin_nurse) = '$tarikh' GROUP BY iddiet";

// Initialize an array to hold diet counts
$dietCounts = [
  'ND' => 0, 'VEG' => 0, 'CLD' => 0, 'NLD' => 0, 'SD' => 0,
  'DD' => 0, 'HPD' => 0, 'LPD' => 0, 'LFD' => 0, 'LSD' => 0,
  'HPTD' => 0, 'LPTD' => 0, 'LVKD' => 0, 'LFRD' => 0, 'LPND' => 0,
  'MAC' => 0, 'LSD/DD' => 0, 'PND' => 0, 'LL' => 0
];


 $displayTotalDiet = mysqli_query($conn, $getTotalDiet);


?>
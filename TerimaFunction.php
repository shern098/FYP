<?php 
date_default_timezone_set('Asia/Kuala_Lumpur');

include("db_connection.php");
session_start();
if (isset($_GET["wad"])) {
    $wad = $_GET["wad"];
    $tarikh   = $_SESSION['date'];

   
   

    if(isset($_GET["tarikh"])){
        $tarikh = $_GET["tarikh"];
    }
    $current_time = date("h:i:s a");
    if(isset($_GET["nurse"])){
      $idnurse=$_GET["nurse"];
      }
      $getdata = "SELECT * FROM `tblnurse` WHERE `idnurse`='$idnurse'";
      $display = mysqli_query($conn, $getdata);
      //display data
      if (mysqli_num_rows($display) > 0) {
        
        while ($data = mysqli_fetch_assoc($display)) {
            switch($idnurse){
                    case "$data[idnurse]":$nurse = $data["nama"];break;

                }
        }}

}

if(isset($_GET["Terima"])){
  // select data
  $getdata = "SELECT * FROM `tblpatient` WHERE  wad = '$wad' and  DATE(masa_keyin_nurse) = '$tarikh'  AND status = '3' ";
  $display = mysqli_query($conn, $getdata);
  //display data

  if (mysqli_num_rows($display) > 0) {
      
      while ($data = mysqli_fetch_assoc($display)) {
          
      
  // Update the status of selected rows in the database and set the nurse name and currentUser.
  $updateQuery = "UPDATE tblpatient SET status = '4' , `nurse_penerima`='$nurse' , `masa_terima_nurse`='$current_time' WHERE status = 3 ";

  mysqli_query($conn, $updateQuery);
} 
  mysqli_close($conn);
}
}
echo "<script>window.history.back();</script>";


?>

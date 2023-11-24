
<?php

session_start();

if(isset($_GET["wad"])){
$wad=$_GET["wad"];
$tarikh   = $_SESSION['date'];
if(isset($_GET["tarikh"])){
    $tarikh = $_GET["tarikh"];
}
$tarikhsub=substr($tarikh,-2);//get date

include("db_connection.php");



    $del = "DELETE FROM `tblbilorder` where groupid = '$wad'";
mysqli_query($conn, $del);
    $getdata = "SELECT * FROM `tbldocpro` WHERE left(ordderid,2) = '$tarikhsub'";
    $display = mysqli_query($conn, $getdata);
//display data
if (mysqli_num_rows($display) > 0) {    
    $normal =0;
    $other =0;
while ($data = mysqli_fetch_assoc($display)) {
    $normal = (int)$normal+(int)$data["normalnum"];
    $other = (int)$other+(int)$data["othernum"];
}
}
   
    $insert="INSERT INTO `tblbilorder`(`groupid`, `idnum`, `bil`) VALUES ('$wad','1','$normal')";
    mysqli_query($conn,$insert);
    $insert="INSERT INTO `tblbilorder`(`groupid`, `idnum`, `bil`) VALUES ('$wad','2','$other')";
    mysqli_query($conn,$insert);
}
?>
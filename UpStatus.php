<?php

include("db_connection.php");
session_start();
if(isset($_GET["Sahkan"])&&isset($_GET["wad"])){
    $admin=$_GET["admin"];
    $getdata = "SELECT * FROM `tblunitdietik` WHERE `idunit`='$admin'";
    $display = mysqli_query($conn, $getdata);
    //display data
  
    if (mysqli_num_rows($display) > 0) {
        
        while ($data = mysqli_fetch_assoc($display)) {
            switch($admin){
                    case "$data[idunit]":$admin = $data["Nama"];break;
                    case "$data[idunit]":$admin = $data["Nama"];break;
                    case "$data[idunit]":$admin = $data["Nama"];break;
                }
        }}
    $wad=$_GET["wad"];
    $tarikh   = $_SESSION['date'];
    // select data
    $getdata = "SELECT * FROM `tblpatient` where wad = '$wad' and  DATE(masa_keyIn) = '$tarikh'  and `status` = '1' ";
    $display = mysqli_query($conn, $getdata);
    //display data
  
    if (mysqli_num_rows($display) > 0) {
        
        while ($data = mysqli_fetch_assoc($display)) {
            
        
    // Update the status of selected rows in the database and set the nurse name and currentUser.
    $updateQuery = "UPDATE tblpatient SET status = '2',`pengesah`='$admin' WHERE rn = '$data[rn]' ";

    mysqli_query($conn, $updateQuery);
} 
    mysqli_close($conn);
}elseif(isset($_GET["Hantar"])){
    // select data
    $getdata = "SELECT * FROM `tblpatient` where wad = '$wad' and  DATE(masa_keyIn) = '$tarikh'  and `status` = '2' ";
    $display = mysqli_query($conn, $getdata);
    //display data
  
    if (mysqli_num_rows($display) > 0) {
        
        while ($data = mysqli_fetch_assoc($display)) {
            
        
    // Update the status of selected rows in the database and set the nurse name and currentUser.
    $updateQuery = "UPDATE tblpatient SET status = '3' , `pengesah`='$admin' WHERE rn = '$data[rn]' ";

    mysqli_query($conn, $updateQuery);
} 
    mysqli_close($conn);
}
}elseif(isset($_GET["Reset"])){
    // select data
    $getdata = "SELECT * FROM `tblpatient` where wad = '$wad' and  DATE(masa_keyIn) = '$tarikh'  and `status` IN (2, 3) ";
    $display = mysqli_query($conn, $getdata);
    //display data
  
    if (mysqli_num_rows($display) > 0) {
        
        while ($data = mysqli_fetch_assoc($display)) {
            
        
    // Update the status of selected rows in the database and set the nurse name and currentUser.
    $updateQuery = "UPDATE tblpatient SET status = '1', `pengesah`='' WHERE rn = '$data[rn]' ";

    mysqli_query($conn, $updateQuery);
} 
    mysqli_close($conn);
}
}
}
echo "<script>window.history.back();</script>";

?>
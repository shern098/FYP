<?php

include("db_connection.php");

if(isset($_GET["wad"]) &&isset($_GET["op"])){
    $op=$_GET["op"];
    $wad=$_GET["wad"];
    $tarikh =  date("Y-m-d");
    if($op== "stat2"){
    // select data
    $getdata = "SELECT * FROM `tblpatient` where wad = '$wad' and  DATE(masa_keyIn) = '$tarikh'  and `status` = '1' ";
    $display = mysqli_query($conn, $getdata);
    //display data
  
    if (mysqli_num_rows($display) > 0) {
        
        while ($data = mysqli_fetch_assoc($display)) {
            
        
    // Update the status of selected rows in the database and set the nurse name and currentUser.
    $updateQuery = "UPDATE tblpatient SET status = '2' WHERE rn = '$data[rn]' ";

    mysqli_query($conn, $updateQuery);
} 
    mysqli_close($conn);
}

}elseif($op== "stat3"){
    // select data
    $getdata = "SELECT * FROM `tblpatient` where wad = '$wad' and  DATE(masa_keyIn) = '$tarikh'  and `status` = '2' ";
    $display = mysqli_query($conn, $getdata);
    //display data
  
    if (mysqli_num_rows($display) > 0) {
        
        while ($data = mysqli_fetch_assoc($display)) {
            
        
    // Update the status of selected rows in the database and set the nurse name and currentUser.
    $updateQuery = "UPDATE tblpatient SET status = '3' WHERE rn = '$data[rn]' ";

    mysqli_query($conn, $updateQuery);
} 
    mysqli_close($conn);
}
}elseif($op== "remove"){
    // select data
    $getdata = "SELECT * FROM `tblpatient` where wad = '$wad' and  DATE(masa_keyIn) = '$tarikh'  and `status` IN (2, 3) ";
    $display = mysqli_query($conn, $getdata);
    //display data
  
    if (mysqli_num_rows($display) > 0) {
        
        while ($data = mysqli_fetch_assoc($display)) {
            
        
    // Update the status of selected rows in the database and set the nurse name and currentUser.
    $updateQuery = "UPDATE tblpatient SET status = '1' WHERE rn = '$data[rn]' ";

    mysqli_query($conn, $updateQuery);
} 
    mysqli_close($conn);
}
}
}
echo "<script>window.history.back();</script>";
?>
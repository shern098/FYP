
<?php

if(isset($_GET["wad"])){
$wad=$_GET["wad"];

include("db_connection.php");
$del = "DELETE FROM `tblbilorder` WHERE `groupid`='$wad'";
$display = mysqli_query($conn, $del);

$getdata = "SELECT * FROM `tblpatient` where `status` = '1' and wad = '$wad'";
$display = mysqli_query($conn, $getdata);
$orderstore=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19];
//display data
if (mysqli_num_rows($display) > 0) {

while ($data = mysqli_fetch_assoc($display)) {
switch($data["iddiet"]) {
case "ND": $orderstore[]=1;break;
case "VEG": $orderstore[]=2;break;
case "CLD": $orderstore[]=3;break;
case "NLD": $orderstore[]=4;break;
case "SD": $orderstore[]=5;break;
case "DD": $orderstore[]=6;break;
case "HPD": $orderstore[]=7;break;
case "LPD": $orderstore[]=8;break;
case "LFD": $orderstore[]=9;break;
case "LSD": $orderstore[]=10;break;
case "HPTD": $orderstore[]=11;break;
case "LTPD": $orderstore[]=12;break;
case "LVKD": $orderstore[]=13;break;
case "LFRD": $orderstore[]=14;break;
case "LPND": $orderstore[]=15;break;
case "MAC": $orderstore[]=16;break;
case "LSDD/DD": $orderstore[]=17;break;
case "PND": $orderstore[]=18;break;
case "LL": $orderstore[]=19;break;
}
}
sort($orderstore);
    $count = array_count_values($orderstore);
foreach ($count as $iddiet => $count) {
    $count=$count-1;
    $insert="INSERT INTO `tblbilorder`(`groupid`, `idnum`, `bil`) VALUES ('$wad','$iddiet','$count')";
    $update=mysqli_query($conn,$insert);
}
}
echo "<script>window.history.back();</script>";
}
?>
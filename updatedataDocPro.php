<?php
include ("db_connection.php");

if (isset($_GET["btnhantar"])) {
    
    
    $LL = "0";
    $cttn = "-";
$id = $_GET["id"];
$fas = $_GET['fasiliti'];
$Bildoc = $_GET['BilDoc'];
$DN = $_GET['BilDN'];
$LL = $_GET['BilLL'];
$cttn = $_GET['extra'];
if($DN==""){
    $DN = "0";
}
if($LL==""){
    $LL = "0";
}
if($cttn==""){
    $cttn = "-";
}

if((int)$Bildoc == (int)$DN+(int)$LL ){
$getdata = "UPDATE `tbldocpro` SET
 `facility`='$fas',`totalnum`='$Bildoc',
 `normalnum`='$DN',`othernum`='$LL',`notes`='$cttn' WHERE ordderid=$id";
mysqli_query($conn, $getdata);
echo' alert("Data Telah Disimpan .");
    return false;';
echo "<script>
window.location.href = 'AdminListOrderDoc.php';
</script>";
}else{
    echo' <script>alert("Salah Jumlah Order Doc/Pro. Data Tidak Akan Dimasukkan.");</script>';
    echo "<script>
window.location.href = 'AdminListOrderDoc.php';
</script>";
}

}

?>
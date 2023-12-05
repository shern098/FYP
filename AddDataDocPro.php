<?php
include("db_connection.php");

if (isset($_GET["btnhantar"])) {

    $LL = "0";
    $cttn = "-";

    $fas = $_GET['fasiliti'];
    $Bildoc = $_GET['BilDoc'];
    $DN = $_GET['BilDN'];
    $LL = $_GET['BilLL'];
    $cttn = $_GET['extra'];
    if ($DN == "") {
        $DN = "0";
    }
    if ($LL == "") {
        $LL = "0";
    }
    if ($cttn == "") {
        $cttn = "-";
    }

    $date = date("Y-m-d");
    $day = substr($date, 8, 2);
    $month = substr($date, 5, 2);
    $year = substr($date, 2, 2);
    $getnum = "select count(*) as bil from tbldocpro where left(ordderid ,2)='$day' ";
    $data = mysqli_query($conn, $getnum);
    $num = mysqli_fetch_assoc($data);
    $bil = (int)$num["bil"];

    $bil = sprintf("%02s", ++$bil);
    $orderid = $day . $month . $year . $bil;

    if ((int)$Bildoc == (int)$DN + (int)$LL) {
        $getdata = "INSERT INTO `tbldocpro`(`ordderid`, `facility`, `totalnum`, `normalnum`, `othernum`, `notes`) 
VALUES ('$orderid','$fas','$Bildoc','$DN','$LL','$cttn')";
        mysqli_query($conn, $getdata);
        echo '<script> alert("Data Telah Disimpan .");
    </script>';
        echo "<script>
window.location.href = 'AdminListOrderDoc.php';
</script>";
    } else {
        echo ' <script>alert("Salah Jumlah Order Doc/Pro. Data Tidak Akan Dimasukkan.");</script>';
        echo "<script>
window.location.href = 'AdminAddOrderDoc.php';
</script>";
    }
}

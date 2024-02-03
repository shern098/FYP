<?php

include("db_connection.php");
session_start();
if (isset($_GET["wad"])) {
    
    $wad=$_GET["wad"];
    $tarikh   = $_SESSION['date'];

    if(isset($_GET["shift2"])){
    $shift=$_GET["shift2"];
    $shift = substr($shift,0,strlen($shift)-1);
    }

    if(isset($_GET["tarikh"])){
        $tarikh = $_GET["tarikh"];
    }

if(isset($_GET["Laporan"])){
    echo "<script>
    window.location.href ='excel.php?wad=".$wad."&tarikh=".$tarikh."&shift=".$shift."';
    </script>";
}}
?>
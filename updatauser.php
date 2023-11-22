<?php
include ("db_connection.php");


if (isset($_GET["btnhantar"])) {
$username = $_GET["namewad"];
$pass = hash("sha512",$_GET["passwad"]);
$confpass = hash("sha512",$_GET["Kpasswad"]);
//just take num from username 
$usernum=substr($username,-1);
$usernum=sprintf("%02s",$usernum);

$id=$usernum;

if($pass == $confpass){
    $getdata = "INSERT INTO `tbluser`(`username`, `idward`, `password`) VALUES ('$username','$id','$pass')";
    mysqli_query($conn, $getdata);
    echo' alert("Data Telah Disimpan.");
        return false;';
    echo "<script>
    window.location.href ='AdminListUsers.php';
    </script>";
    }else{
        echo' <script>alert("Kalalauan tidak sama dengan yang dipastikan. Sila cuba lagi.");</script>';
        echo "<script>
    window.location.href = 'AdminAddUser.php';
    </script>";
    }
    
}
?>
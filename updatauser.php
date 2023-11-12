<?php
include ("db_connection.php");


if (isset($_GET["btnhantar"])) {
$username = $_GET["namewad"];
$pass = hash("sha512",$_GET["passwad"]);
$confpass = hash("sha512",$_GET["Kpasswad"]);

$getnum="SELECT `idward` FROM `tbluser`";
$data = mysqli_query($conn,$getnum);
if (mysqli_num_rows($data) > 0) {

while($num=mysqli_fetch_assoc($data)){
    $newnum=$num["idward"];
};
}
else{
    $newnum=0;
}
$newnum=sprintf("%02s",++$newnum);

$id=$newnum;

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
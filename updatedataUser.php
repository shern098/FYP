<?php
include ("db_connection.php");
if (isset($_GET["btnhantar"])) {
    $cmd=$_GET["cmd"];  
    $adminpass=hash("sha512",$_GET["passadmin"]);

    $veradmin="SELECT `password` FROM `tbladmin` where `password`='$adminpass'";
$data = mysqli_query($conn,$veradmin);
if (mysqli_num_rows($data) > 0) {
    if ($cmd == "edit" ){
        $idw=$_GET["idw"];
        $newname=$_GET["newnamewad"];
        $getdata = "UPDATE `tbluser` SET `username`='$newname'
            WHERE idward=$idw";
        mysqli_query($conn, $getdata);
}else{
    $idw=$_GET["idw"];
        $newpassword=hash("sha512",$_GET["newpass"]);
        $getdata = "UPDATE `tbluser` SET `password`='$newpassword'
            WHERE idward=$idw";
        mysqli_query($conn, $getdata);
}
}else{
    echo' <script>alert("Kalalauan Admin Salah. Sila cuba lagi.");</script>';
}
echo "<script>
    window.location.href = 'AdminListUsers.php';
    </script>";
    
}
?>
<?php 
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
$_SESSION['date'] =  date("Y-m-d");

//get login data
if(isset($_GET["login"])){
    $loginuser =$_GET["username"];
    $loginpass =hash("sha512",$_GET["password"]);

include ("db_connection.php");
//check in tbl wad
$sql = "SELECT * FROM `tbluser` WHERE `username` = '$loginuser' and `password`='$loginpass';";
$resWad = mysqli_query($conn,$sql);
//check in tbl admin
$sqla = "SELECT * FROM `tbladmin` WHERE  `username` = '$loginuser' and `password`='$loginpass';";
$resAdmin = mysqli_query($conn,$sqla);
//if found in wad
if (mysqli_num_rows($resWad)>0){
    //get data for wad login
    $userWad=mysqli_fetch_assoc($resWad);
    $wadName=$userWad["username"];//get wad username
    $idWad= $userWad["idward"]; // get wad id
    //make session
    $_SESSION["CurrentUser"]=$wadName;
   //redirect to home page with id 
    echo "<script>
    window.location.href = 'WadHome.php?id=' + encodeURIComponent('$idWad');
    </script>";
}
//if found in tbl admin
elseif (mysqli_num_rows($resAdmin)>0){
    //get admin data
    $userAdmin=mysqli_fetch_assoc($resAdmin);
    $adminName=$userAdmin["username"];//get admin username
    $idAdmin = $userAdmin["idadmin"]; //get admin id 
    //create session
    $_SESSION["CurrentUser"]=$adminName;
   //redirect to page homeadmin with id admin.
    echo "<script>
    window.location.href = 'AdminHome.php?id=' + encodeURIComponent('$idAdmin');
    </script>";
}
//both dont have
else{
    //login fail
  $error [] = "Sila masukkan ID atau kata laluan yang betul";
}
//close connection to database
mysqli_close($conn);
}
?>

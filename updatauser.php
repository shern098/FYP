<?php
include ("db_connection.php");


if (isset($_GET["btnhantar"])) {
$username = $_GET["namewad"];
$pass = hash("sha512",$_GET["passwad"]);
$confpass = hash("sha512",$_GET["Kpasswad"]);
//just take num from username 
$getdata = "SELECT * FROM `tbluser` ORDER BY `tbluser`.`idward` ASC";
$display=mysqli_query($conn, $getdata);
if (mysqli_num_rows($display) > 0) {
    $i=1;
    while($data = mysqli_fetch_assoc($display)){
        if($i!=(int)$data["idward"]){
            break;
        }
        $i++;
        $id=$i;
    };

    
}else{
    $id=1;
}

$id=sprintf("%02s",$id);


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
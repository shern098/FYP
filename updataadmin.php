<?php
include ("db_connection.php");


if (isset($_GET["btnhantar"])) {
$username = $_GET["namaadmin"];

$getdata = "SELECT * FROM `tblunitdietik`";
$display=mysqli_query($conn, $getdata);
if (mysqli_num_rows($display) > 0) {
    $i=1;
    while($data = mysqli_fetch_assoc($display)){
        if($i!=(int)$data["idunit"]){
            break;
        }
        $i++;
        $id=$data["idunit"];
    };

    
}else{
    $id=1;
}

$id=sprintf("%03s",++$id);
    $getdata = "INSERT INTO `tblunitdietik`(`idunit`, `Nama`) VALUES ('$id','$username')";
    mysqli_query($conn, $getdata);
    echo' alert("Data Telah Disimpan.");
        return false;';
    echo "<script>
    window.location.href ='AdminListAdmins.php';
    </script>";
    }

?>
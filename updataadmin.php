<?php
include ("db_connection.php");


if (isset($_GET["btnhantar"])) {
$username = $_GET["namaadmin"];

$jawatan = $_GET["jawadmin"];

$getdata = "SELECT * FROM `tblunitdietik` ORDER BY `tblunitdietik`.`idunit` ASC";
$display=mysqli_query($conn, $getdata);
if (mysqli_num_rows($display) > 0) {
    $i=1;
    while($data = mysqli_fetch_assoc($display)){
        if($i!=(int)$data["idunit"]){
            break;
        }
        $i++;
        $id=$i;
    };

    
}else{
    $id=1;
}

$id=sprintf("%02s",$id);
    $getdata = "INSERT INTO `tblunitdietik`(`idunit`, `Nama` , `jawatan`) VALUES ('$id','$username','$jawatan')";
    mysqli_query($conn, $getdata);
        echo "<script>
        alert('Data Telah Disimpan.')
        window.location.href ='AdminListAdmins.php';
        </script>";
    }

?>
<?php
include ("db_connection.php");


if (isset($_GET["btnhantar"])) {
$username = $_GET["namenurse"];
$jawatan = $_GET["jawnurse"];

$getdata = "SELECT * FROM `tblnurse`ORDER BY `tblnurse`.`idnurse` ASC";
$display=mysqli_query($conn, $getdata);
if (mysqli_num_rows($display) > 0) {
    $i=1;
    while($data = mysqli_fetch_assoc($display)){
        if($i!=(int)$data["idnurse"]){
            break;
        }
        $i++;
        $id=$i;
    };

    
}else{
    $id=1;
}

$id=sprintf("%02s",$id);
    $getdata = "INSERT INTO `tblnurse`(`idnurse`, `nama`,`jawatan`) VALUES ('$id','$username','$jawatan')";
    mysqli_query($conn, $getdata);
    echo' alert("Data Telah Disimpan.");
        return false;';
    echo "<script>
    window.location.href ='AdminListNurses.php';
    </script>";
    }

?>
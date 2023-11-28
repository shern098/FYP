<?php
include ("db_connection.php");
if (isset($_GET["btnhantar"])) {
        $idw=$_GET["idw"];
        $newname=$_GET["newnameadmin"];
        $newjaw=$_GET["newjawadmin"];
        $getdata = "UPDATE `tblunitdietik` SET `Nama`='$newname',`jawatan`='$newjaw'
            WHERE idunit=$idw";
        mysqli_query($conn, $getdata);
        echo "<script>
        window.location.href ='AdminListAdmins.php';
        </script>";
}

?>
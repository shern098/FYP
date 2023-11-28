<?php
include ("db_connection.php");
if (isset($_GET["btnhantar"])) {
        $idw=$_GET["idw"];
        $newname=$_GET["newnamenurse"];
        $newjaw=$_GET["newjawnurse"];

        $getdata = "UPDATE `tblnurse` SET `nama`='$newname' , `jawatan`='$newjaw'
            WHERE idnurse=$idw";
        mysqli_query($conn, $getdata);
        echo "<script>
        window.location.href ='AdminListNurses.php';
        </script>";
}

?>
<?php
include ("db_connection.php");
session_start();
$user = $_SESSION["CurrentUser"]; 
if (!$user) {
    echo "<script>window.location.href='index.php';</script>";
  }

if (isset($_GET["cmd"])) {
$cmd=$_GET["cmd"];
$idw=$_GET["id"];
if($cmd == "del"){
        $del = "DELETE FROM `tblnurse` WHERE idnurse='$idw'";
        mysqli_query($conn, $del);
        echo "<script>
window.location.href = 'AdminListNurses.php';
</script>";
    }
elseif($cmd == "edit"){
$getdata = "SELECT * FROM `tblnurse` where idnurse='$idw'";
$display = mysqli_query($conn, $getdata);
    //display data
if (mysqli_num_rows($display) > 0) {

        while ($data = mysqli_fetch_assoc($display)) {
            $nama = $data["nama"]; 
            $jaw = $data["jawatan"]; 

        }
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title> Edit Nurse </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include("AdminSidebar.php");
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php

                include("Topbar.php");

                ?>
                <!-- End of Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-white-600"> Edit Nurse </h1>

                    </div>

                     <!-- Content Row -->

                     <div class="row">

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">

    </div>
</div>
</div>



<!-- Content Row -->
<div class="row">
<!-- Content Column -->
<div class="col-lg-6 mb-4">
    <div>

    </div>
      <form action="updatedataNurse.php" method="get">
        <div class="col-md-9 col-sm-6 col-xs-12 form-group has-feedback">
        <input name="idw"  style="display:none;" value=<?php echo $idw; ?>>
        Nama Nurse
            <input type="text" class="form-control" name="newnamenurse" value="<?php echo $nama?>" required>
        </div>
        <div class="col-md-9 col-sm-6 col-xs-12 form-group has-feedback">
        Jawatan Nurse
            <input type="text" class="form-control" name="newjawnurse" value="<?php echo $jaw?>" required>
        </div>
        <!-- button submit dan cancel -->
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <a href="AdminListNurses.php">
                    <button type="button" class="btn btn-primary" name="btncancel">Batal</button>
                </a>
                <button type="submit" class="btn btn-success" name="btnhantar">Hantar</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>




</div>
</div>

        <!-- Color System -->

    </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php

    include("LogoutPopup.php")

    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/demo/clock.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
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
if( $cmd == "repass"){
$getdata = "SELECT * FROM `tbluser` where idward=$idw";
$display = mysqli_query($conn, $getdata);
    //display data
if (mysqli_num_rows($display) > 0) {

        while ($data = mysqli_fetch_assoc($display)) {
            $username = $data["username"]; 
            $password = $data["password"]; 
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


    <title> Edit Pengguna </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

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
                        <h1 class="h3 mb-0 text-white-600"> Edit Pengguna </h1>

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
      <form action="updatedataUser.php" method="get" onsubmit="return checkpass()">
        <div class="col-md-9 col-sm-6 col-xs-12 form-group has-feedback">
        <input name="idw"  style="display:none;" value=<?php echo $idw; ?>>
        <input name="cmd"  style="display:none;" value=<?php echo $cmd; ?>>
            <input type="text" class="form-control" name="newpass" id="newpass" placeholder="Masukkan Katalaluan Baharu" required>
           <h6>   Sekurang-kurangnya 12 aksara , 1 huruf besar , 1 huruf kecil , 1 nombor dan 1 simbol (!@#$%^&*(),.?":{}|<>)
      </h6>
        </div>
        <div class="col-md-9 col-sm-6 col-xs-12 form-group has-feedback">
            <input type="password" class="form-control" name="passadmin" placeholder="Katalaluan Admin Semasa" required>
        </div>
        <br>


        <script>
                                            function checkpass() {
                                                var password = document.getElementById("newpass").value;

                                                if (password.length < 12) {
                                                    alert("Katalaluan terlalu pendek.");
                                                    return false;
                                                }

                                                // Check if password contains at least one uppercase letter
                                                if (!/[A-Z]/.test(password)) {
                                                    alert("Katalaluan perlu mempunyai huruf besar.");
                                                    return false;
                                                }

                                                // Check if password contains at least one lowercase letter
                                                if (!/[a-z]/.test(password)) {
                                                    alert("Katalaluan perlu mempunyai huruf kecil.");
                                                    return false;
                                                }

                                                // Check if password contains at least one symbol
                                                if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                                                    alert("Katalaluan perlu mempunyai simbol.");
                                                    return false;
                                                }

                                                if (!/\d/.test(password)) {
                                                    alert("Katalaluan perlu mempunyai nombor.");
                                                    return false;
                                                    }

                                                    return true;
                                                }
                                                                                            
                                            </script>
        <!-- button submit dan cancel -->
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <a href="AdminListUsers.php">
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

</body>

</html>
<?php
session_start();
$user = $_SESSION["CurrentUser"]; 

if (!$user ) {
    echo "<script>window.location.href='index.php';</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title> Admin </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include("AdminSidebar.php");
        ?>

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
                        <h1 class="h3 mb-0 text-gray-800"><?php

                                                            echo  $user ;
                                                            ?> </h1>
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

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"> Pesanan </h6>
                                </div>
                                <div class="card-body">
                                    <a href="AdminListOrderDoc.php" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-600">
                                            <i class="fas fa-file"></i>
                                        </span>
                                        <span class="text">Senarai Order(DocPro)</span>
                                    </a>

                                    <div class="my-2"></div>

                                    <a href="AdminListUsers.php" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-600">
                                            <i class="fas fa-user-md "></i>
                                        </span>
                                        <span class="text">Urus Pengguna Sistem</span>
                                    </a>

                                    <div class="my-2"></div>


                                    <a href="AdminViewReport.php" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-600">
                                            <i class="fas fa-folder-open"></i>
                                        </span>
                                        <span class="text">Semakan Laporan</span>
                                    </a>

                                    <div class="my-2"></div>
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
    <script src="js/demo/clock.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>
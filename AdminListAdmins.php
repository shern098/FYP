<?php
session_start(); 
$user =  $_SESSION["CurrentUser"]; 
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

    <link rel="shortcut icon" href="images/hospitalicon.ico" type="image/x-icon">

    <title>Senarai Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/demo/clock.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!--Sidebar-->
        <?php
        include("AdminSidebar.php");
        ?>
        <!--End Sidebar-->
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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo  $user; ?></h1>
                    </div>


                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">

                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Senarai Pengurus</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Jawatan</th>
                                            <th>Tindakkan</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>

                                        <?php
                                        //connect database
                                        include("db_connection.php");
                                        // select data
                                        $getdata = "SELECT * FROM `tblunitdietik`";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {
                                            $i=0;

                                            while ($data = mysqli_fetch_assoc($display)) {
                                                
                                                echo "<tr>";
                                                echo "<td>" . $data["idunit"] . "</td>";
                                                echo "<td>" . $data["Nama"] . "</td>";
                                                echo "<td>" . $data["jawatan"] . "</td>";
                                                echo '<td>
                                                <a href="AdminEditAdmin.php?cmd=edit&id='.$data['idunit'].'" class="btn btn-light btn-icon-split right">
                                                        <span class="icon text-white-600">
                                                            <i class="fas fa-pen"></i>
                                                        </span> 
                                                        </a>
                                                        '?>

                                                <a onclick="return confirm('confirm delete?')"  <?php echo' href="AdminEditAdmin.php?cmd=del&id='.$data['idunit'].'"'?> class="btn btn-light btn-icon-split right">
                                                        <span class="icon text-white-600">
                                                            <i class="fas fa-trash"></i>
                                                        </span> 
                                                        </a>
                                                </td>
                                                <?php
                                                echo "</tr>";
                                                $i++;
                                            }
                                        }
                                        ?>
                                         
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Jawatan</th>
                                            <th>Tindakkan</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!--Will Bring to Add Patient Page-->
                                <a href="AdminAddAdmin.php" class="btn btn-light btn-icon-split right">
                                    <span class="icon text-white-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Tambah Pengurus</span>
                                   
                                </a>
                            </div>
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
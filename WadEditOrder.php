<?php
session_start();
if (!$_SESSION['CurrentUser']) {
    echo "<script>window.location.href='index.php';</script>";
}

if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
    // Output JavaScript code to show an alert
    echo "<script>alert('Data berjaya dikemaskini!');</script>";

    // Unset the session variable to prevent it from appearing on reload
    unset($_SESSION['update_success']);
}

if (isset($_SESSION['delete_success']) && $_SESSION['delete_success']) {
    // Output JavaScript code to show an alert
    echo "<script>alert('Data berjaya dibuang!');</script>";

    // Unset the session variable to prevent it from appearing on reload
    unset($_SESSION['delete_success']);
}

if (isset($_SESSION['save_success']) && $_SESSION['save_success']) {
    // Output JavaScript code to show an alert
    echo "<script>alert('Data berjaya dihantar!');</script>";

    // Unset the session variable to prevent it from appearing on reload
    unset($_SESSION['save_success']);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Home</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php

        include("WadSideBar.php");

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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo   $_SESSION["CurrentUser"]; ?></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>


                    <!-- Content Row -->

                    <div class="row">


                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">

                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Senarai Perubahan Pesanan Pesakit </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>R/N PESAKIT</th>
                                            <th>NO. KATIL</th>
                                            <th>NAMA PESAKIT</th>
                                            <th>KELAS</th>
                                            <th>JENIS DIET</th>

                                            <th>STATUS</th>
                                            <th>Operasi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        //connect database
                                        include("db_connection.php");
                                        // select data
                                        $getdata = "SELECT * FROM `tblpatient`";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {

                                            while ($data = mysqli_fetch_assoc($display)) {

                                                switch ($data['status']) {
                                                    case 0:
                                                        $status = "Belum Disahkan";
                                                        break;
                                                    case 1:
                                                        $status = "Telah Disahkan";
                                                        break;
                                                }

                                        ?>

                                                <tr>
                                                    <td> <?php echo $data["rn"];         ?> </td>
                                                    <td> <?php echo $data["bednum"];     ?> </td>
                                                    <td> <?php echo $data["name"];       ?> </td>
                                                    <td> <?php echo $data["kelas"];      ?> </td>
                                                    <td> <?php echo $data["iddiet"];     ?> </td>
                                                    <td> <?php echo $status              ?> </td>
                                                    <td>
                                                        <?php


                                                        switch ($status) {
                                                            case "Belum Disahkan":
                                                        ?>
                                                                <a href='WadEditPatient.php?id=<?php echo $data["rn"]; ?>'><i class='fas fa-edit'></i></a> <!-- Edit icon -->
                                                                <a onclick="return confirm('Buang Pesanan nama: <?php echo $data['name']; ?> ')" href='DeleteFunction.php?id=<?php echo $data["rn"]; ?>'><i class='fas fa-trash'></i></a> <!-- Delete icon -->
                                                                <a onclick="return confirm('Hantar Pesanan?')" href='SaveFunction.php?id=<?php echo $data["rn"]; ?>&status=1'><i class='fas fa-save'></i></a> <!-- Save icon -->
                                                        <?php
                                                                break;
                                                            case "Telah Disahkan":
                                                                echo "Data telah dihantar";
                                                                break;
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                        <?php
                                            } // end while loop
                                        } // end if 
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>R/N PESAKIT</th>
                                            <th>NO. KATIL</th>
                                            <th>NAMA PESAKIT</th>
                                            <th>KELAS</th>
                                            <th>JENIS DIET</th>

                                            <th>STATUS</th>
                                            <th>Operasi</th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <!--Will Bring to Add Patient Page-->
                                <a href="WadListPatient.php" class="btn btn-info btn-icon-split ">
                                    <span class="icon text-white-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Senarai Pesanan Pesakit </span>
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

    <script>
        $(document).ready(function() {


            var table = $('#dataTable').DataTable({
                dom: 'Plfrtip',

                // scrollY: 400,

                // "lengthMenu": [
                //     [5, 10, 25, -1],
                //     [5, 10, 25, "All"]
                // ]
            });


        });
    </script>

</body>

</html>
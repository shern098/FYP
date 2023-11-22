<?php
session_start();
$user = $_SESSION["CurrentUser"];

if (!$user) {
    echo "<script>window.location.href='index.php';</script>";
    exit();
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

    <!-- Custom dt for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- link checkbox datatable -->

    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.2.0/css/searchPanes.bootstrap4.min.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $user; ?> </h1>

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
                            <h6 class="m-0 font-weight-bold text-primary">Senarai Pesanan Pesakit</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>

                                            <th>R/N PESAKIT</th>
                                            <th>NO. KATIL</th>
                                            <th>NAMA PESAKIT</th>
                                            <th>KELAS</th>
                                            <th>JENIS DIET</th>
                                            <th>CATATAN</th>
                                            <th>TARIKH</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        //connect database
                                        include("db_connection.php");
                                        $tarikh =  date("Y-m-d");
                                        // select data
                                        $getdata = "SELECT * FROM `tblpatient` where wad = '$user' and  CURRENT_DATE() = $tarikh  ";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {

                                            while ($data = mysqli_fetch_assoc($display)) {
                                                $dateOnly = date("Y-m-d", strtotime($data["masa_keyIn"]));

                                                switch ($data['status']) {
                                                    case 0:
                                                        $status = "Belum Disemak";
                                                        break;
                                                    case 1:
                                                        $status = "Telah Disemak";
                                                        break;
                                                }

                                                echo "<tr>";
                                                echo "<td>" . $data["rn"] . "</td>";
                                                echo "<td>" . $data["bednum"] . "</td>";
                                                echo "<td>" . $data["name"] . "</td>";
                                                echo "<td>" . $data["kelas"] . "</td>";
                                                echo "<td>" . $data["iddiet"] . "</td>";
                                                echo "<td>" . $data["catatan"] . "</td>";
                                                echo "<td>" . $dateOnly . "</td>";
                                                echo "<td>" . $status . "</td>";
                                                echo "</tr>";
                                            }
                                        }

                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>R/N PESAKIT</th>
                                            <th>NO. KATIL</th>
                                            <th>NAMA PESAKIT</th>
                                            <th>KELAS</th>
                                            <th>JENIS DIET</th>
                                            <th>CATATAN</th>
                                            <th>TARIKH</th>
                                            <th>STATUS</th>

                                        </tr>
                                    </tfoot>
                                </table>

                                <a href="WadEditOrder.php" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit Pesanan Masuk</span>
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

    <!-- link checkboxes datatable -->

    <script src="https://cdn.datatables.net/searchpanes/2.2.0/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.2.0/js/searchPanes.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>


    <!-- untuk adjust tinggi filter active -->


    <style>
        div.dtsp-searchPane div.dataTables_scrollBody {
            height: 100px !important;
        }
    </style>
    <script>
        $(document).ready(function() {


            var table = $('#dataTable').DataTable({

                searchPanes: {
                    columns: [1, 2, 3, 4, 5, 6, 7], // Specify the column indices to include in the search panes

                },
                scrollY: 400,
                scroller: {
                    loadingIndicator: true
                },

                oLanguage: {
                    sLengthMenu: "Tunjuk _MENU_ rekod",
                    sSearch: "Carian:"
                },
                lengthMenu: [
                    [ 10, 25, -1],
                    [ 10, 25, "All"]
                ]
            });

            table.searchPanes.container().prependTo(table.table().container());
            table.searchPanes.resizePanes();

        });
    </script>

</body>

</html>
<?php
session_start();
$user = $_SESSION["CurrentUser"];
$tarikh   = $_SESSION['date'];
$wadsemasa = "0";
$shift="";
if (!$user) {
    echo "<script>window.location.href='index.php';</script>";
}

if (isset($_GET["Filter"])) {
    $tarikh = $_GET["historydate"];
    $shift = $_GET["shifts"];

}
if (!isset($_GET["Count"])) {
    echo "<script>window.location.href=
    'CountOrder.php?wad=" . $wadsemasa . "&tarikh=" . $tarikh . "&shifts=" . $shift . "'
    ;</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="images/hospitalicon.ico" type="image/x-icon">

    <title>Semak Report</title>

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

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>


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
                            <h6 class="m-0 font-weight-bold text-primary">Semak Report Pada <?php echo $tarikh; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <form action="" method="get" class="form-inline mb-2">

                            <label>Pilih Shift</label>
                            <div class="custom-control custom-radio custom-control-inline" >
                                <input type="radio" id="pagi" name="shifts" class="custom-control-input" value="M" required >
                                <label class="custom-control-label" for="pagi">pagi</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="petang" name="shifts" class="custom-control-input" value="E" >
                                <label class="custom-control-label" for="petang">petang</label>
                            </div>
                            <input type="date" name="historydate" id="date" class="form-control mr-2" required>
                            <button type="submit" class="btn btn-info btn-icon-split right " name="Filter">

                                        <span class="icon text-white-600">
                                            <i class="fas fa-search fa-sm "></i>
                                        </span>
                                        <span class="text">Tapisan</span>
                                    </button>
                            </form>
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Wad</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        //connect database
                                        include("db_connection.php");
                                        // select data
                                        $getdata = "SELECT * FROM `tbluser` ORDER BY `tbluser`.`username` ASC";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {

                                            while ($data = mysqli_fetch_assoc($display)) {
                                                $wad = $data["username"];
                                                echo "<tr>";
                                                echo "<td>" .  $wad . "</td>";
                                                echo "<td> <a href='AdminViewReportWad.php?wad=" . $wad . "&tarikh=" . $tarikh . "&count=1&shifts=" . $shift . "' class='btn btn-light btn-icon-split right'>
                                                <span class='icon text-gray-600'>
                                                <i class='fas fa-eye'></i>
                                            </span>
                                                <span class='text'>Lihat Laporan</span>
                                            </a></td>";

                                                echo "</tr>";
                                            }
                                        }

                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Wad</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Senarai Bilangan Pesanan Pesakit Pada <?php echo $tarikh; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <?php
                                            include("db_connection.php");
                                            $getdata = "SELECT * FROM `tbldiet` ORDER BY `tbldiet`.`idnum` ASC";
                                            $display = mysqli_query($conn, $getdata);
                                            //display data
                                            if (mysqli_num_rows($display) > 0) {

                                                while ($data = mysqli_fetch_assoc($display)) {
                                                    echo "<th>" . $data["iddiet"] . "</th>";
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        include("db_connection.php");
                                        $getdata = "SELECT * FROM `tblbilorder` where groupid = '0' ORDER BY `tblbilorder`.`idnum` ASC ";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {

                                            while ($data = mysqli_fetch_assoc($display)) {
                                                echo "<td>" . $data["bil"] . "</td>";
                                            }
                                        } else {
                                            echo "<td colspan=19> Tiada Data </td>";
                                        }
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <?php
                                            include("db_connection.php");
                                            $getdata = "SELECT * FROM `tbldiet` ORDER BY `tbldiet`.`idnum` ASC ";
                                            $display = mysqli_query($conn, $getdata);
                                            //display data
                                            if (mysqli_num_rows($display) > 0) {

                                                while ($data = mysqli_fetch_assoc($display)) {
                                                    echo "<th>" . $data["iddiet"] . "</th>";
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </tfoot>
                                </table>
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
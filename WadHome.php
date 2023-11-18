<?php
session_start();
$user = $_SESSION["CurrentUser"];
if (!$user) {
    echo "<script>window.location.href='index.php';</script>";
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
                        <h1 class="h3 mb-0 text-gray-800"> <?php echo $user; ?> </h1>

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
                    <div class="row ">

                        <!-- Content Column -->
                        <div class="col-6 col-md-4">

                            <div class="card shadow mb-4 ">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pilihan Kategori </h6>
                                </div>
                                <div class="card-body ">
                                    <a href="WadListPatient.php" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50 ">
                                            <i class="fas fa-file"></i>
                                        </span>
                                        <span class="text">Senarai Pesanan</span>
                                    </a>

                                    <div class="my-2"></div>

                                    <a href="WadAddPatient.php" class="btn btn-info btn-icon-split ">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Pesanan</span>
                                    </a>

                                    <div class="my-2"></div>

                                    <a href="WadEditOrder.php" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span>
                                        <span class="text">Edit Pesanan Masuk</span>
                                    </a>

                                </div>


                            </div>
                        </div>
                        <!--End Content Column -->

                        <!-- Content Column -->

                        <div class="col-xl-8 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><span class="update-date"></span></h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                        <!-- where piechart will be displayed -->
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php
                                    include 'TotalDietFunction.php';
                                    $totalPatitent = 0;
                                    while ($row = mysqli_fetch_assoc($displayTotalPatient)) {

                                        $totalPatitent += $row['total_patient'];
                                    }
                                    ?>
                                    <h6 class="m-0 font-weight-bold text-primary"> Jumlah Kesuluruhan Pesakit: <?php  echo $totalPatitent;  ?> </h6>
                                </div>
                            </div>
                        </div>



                    </div>
                    <!--End Content Column -->
                </div>
                <!-- end of content row -->
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

    <?php

    include 'TotalDietFunction.php';



    $colour = array('#157A6E', '#F3A712', '#7B5E7B', '	#a200ff', '#772D8B', '#2A2A72', '#ff6289', '#ffbf6b', '#854442', '	#0057e7');

    ?>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    <?php
                    include 'TotalDietFunction.php';

                    while ($chart = mysqli_fetch_assoc($displayTotalPatient)) {
                        echo   "\"" . $chart['wad'] . "\",";
                    }

                    mysqli_close($conn);
                    ?>
                ],

                datasets: [{
                    data: [
                        <?php
                        include 'TotalDietFunction.php';

                        while ($chart = mysqli_fetch_assoc($displayTotalPatient)) {
                            echo   "" . $chart['total_patient'] . ",";
                        }

                        ?>
                    ],
                    backgroundColor: [<?php


                                        foreach ($colour as $colours) {

                                            echo   "\"" . $colours . "\",";
                                        }

                                        ?>],

                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: true
                },
                cutoutPercentage: 80,
            },
        });
    </script>

</body>

</html>
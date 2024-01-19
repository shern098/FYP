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

    <link rel="shortcut icon" href="images/hospitalicon.ico" type="image/x-icon">

    <title> Admin </title>

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

                                                            echo  $user;
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

                                    <a href="AdminViewReport.php" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-600">
                                            <i class="fas fa-folder-open"></i>
                                        </span>
                                        <span class="text">Semakan Laporan</span>
                                    </a>
                                    <div class="my-2"></div>


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

                                    <a href="AdminListNurses.php" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-600">
                                            <i class="fas fa-user-md "></i>
                                        </span>
                                        <span class="text">Urus Senarai Nurse</span>
                                    </a>


                                    <div class="my-2"></div>

                                    <a href="AdminListUsers.php" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-600">
                                            <i class="fas fa-user-md "></i>
                                        </span>
                                        <span class="text">Urus Senarai Admin</span>
                                    </a>


                                    <div class="my-2"></div>
                                </div>
                            </div>

                            <!-- Color System -->

                        </div>

                        
                        <!-- Content Column -->

                        <div class="col-xl-8">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Kod Ringkasan Diet di keseluruhan wad pada: <span class="update-date"></span></h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body no-gutters">
                                    <div class="chart-bar ">
                                        <canvas id="totalDietChart"></canvas>
                                        <!-- where piechart will be displayed -->
                                    </div>
                                </div>
                                <div class="card-footer">

                                    <?php

                                    include 'TotalDietFunctionAdmin.php';

                                    while ($dietRow = mysqli_fetch_assoc($displayTotalDiet)) {
                                        $dietType = $dietRow['iddiet'];
                                        if (array_key_exists($dietType, $dietCounts)) {
                                            $dietCounts[$dietType] = $dietRow['total_diet'];
                                        }
                                    }
                                    $totalDiet = array_sum($dietCounts);

                                    // Output the counts


                                    ?>
                                    <h6 class="m-0 font-weight-bold text-primary"> Jumlah Keseluruhan Diet: <?php echo $totalDiet; ?>
                                    </h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 no-gutters ">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"> Keseluruhan Pesakit Disemua Wad: <br> <span class="update-date"></span></h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie ">
                                        <canvas id="totalPatientChart"></canvas>
                                        <!-- where piechart will be displayed -->
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php
                                    include 'TotalPatientFunction.php';
                                    $totalPatitent = 0;
                                    while ($row = mysqli_fetch_assoc($displayTotalPatient)) {

                                        $totalPatitent += $row['total_patient'];
                                    }
                                    ?>
                                    <h6 class="m-0 font-weight-bold text-primary"> Jumlah Kesuluruhan Pesakit: <?php echo $totalPatitent;  ?> </h6>
                                </div>
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

 
<?php

include 'TotalPatientFunction.php';



$colour = array('#157A6E', '#F3A712', '#7B5E7B', '	#a200ff', '#772D8B', '#2A2A72', '#ff6289', '#ffbf6b', '#854442', '	#0057e7');

?>


<!-- bar chart -->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';


    // Pie Chart Example
    var ctx = document.getElementById("totalPatientChart");
    var patientChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                <?php
                include 'TotalPatientFunction.php';

                while ($chart = mysqli_fetch_assoc($displayTotalPatient)) {
                    echo   "\"" . $chart['wad'] . "\",";
                }

                mysqli_close($conn);
                ?>
            ],

            datasets: [{
                data: [
                    <?php
                    include 'TotalPatientFunction.php';

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
                bodyFontColor: "#000000",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },

            legend: {
                labels: {
                    fontColor: 'black', // Dark font for legend labels
                    fontSize: 14,
                },
                display: true
            }
        },
    });

    // Bar Chart Example
    var ctx = document.getElementById("totalDietChart");
    var dietChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["ND", "VEG", "CLD", "NLD", "SD", "DD", "HPD", "LPD", "LFD", "LSD",
                "HPTD", "LTPD", "LVKD", "LFRD", "LPND", "MAC", "LSD/DD", "PND", "LL",
            ],
            datasets: [{

                borderColor: "#4e73df",
                data: [
                    <?php

                    // Output the counts
                    foreach ($dietCounts as $count) {
                        echo $count . ",";
                    }


                    ?>
                ],
                backgroundColor: [
                    'rgba(255, 51, 153, 0.2)', // Rose
                    'rgba(51, 204, 255, 0.2)', // Light Blue
                    'rgba(153, 255, 51, 0.2)', // Chartreuse
                    'rgba(255, 102, 0, 0.2)', // Tangerine
                    'rgba(102, 51, 255, 0.2)', // Lavender
                    'rgba(255, 153, 0, 0.2)', // Gold
                    'rgba(0, 255, 204, 0.2)', // Turquoise
                    'rgba(204, 0, 102, 0.2)', // Magenta (dark)
                    'rgba(255, 204, 204, 0.2)', // Pale Pink
                    'rgba(204, 204, 0, 0.2)', // Olive (dark)
                    'rgba(0, 102, 51, 0.2)', // Forest Green
                    'rgba(255, 102, 102, 0.2)', // Salmon
                    'rgba(51, 153, 102, 0.2)', // Jade
                    'rgba(255, 51, 0, 0.2)', // Crimson
                    'rgba(0, 204, 102, 0.2)', // Sea Green
                    'rgba(102, 0, 51, 0.2)', // Burgundy
                    'rgba(102, 255, 153, 0.2)', // Mint
                    'rgba(0, 0, 204, 0.2)' // Royal Blue
                ],
                borderColor: [
                    'rgba(255, 51, 153, 1)',
                    'rgba(51, 204, 255, 1)',
                    'rgba(153, 255, 51, 1)',
                    'rgba(255, 102, 0, 1)',
                    'rgba(102, 51, 255, 1)',
                    'rgba(255, 153, 0, 1)',
                    'rgba(0, 255, 204, 1)',
                    'rgba(204, 0, 102, 1)',
                    'rgba(255, 204, 204, 1)',
                    'rgba(204, 204, 0, 1)',
                    'rgba(0, 102, 51, 1)',
                    'rgba(255, 102, 102, 1)',
                    'rgba(51, 153, 102, 1)',
                    'rgba(255, 51, 0, 1)',
                    'rgba(0, 204, 102, 1)',
                    'rgba(102, 0, 51, 1)',
                    'rgba(102, 255, 153, 1)',
                    'rgba(0, 0, 204, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,

            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: 'black',
                        fontSize: 14
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false // This will disable the Y-axis grid lines
                    },
                    ticks: {
                        fontColor: 'black',
                        fontSize: 14
                    }
                }]
            },
            legend: {
                display: false
            },
        },

    });
</script>





</body>

</html>
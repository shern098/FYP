<?php
session_start();
$user  = $_SESSION["CurrentUser"];
$tarikh   = $_SESSION['date'];
$wad="doc";
if (!$user) {
    echo "<script>window.location.href='index.php';</script>";
}

if(isset($_GET["Filter"])){
    $tarikh = $_GET["historydate"];
}
if(!isset($_GET["Count"])){
    echo "<script>window.location.href='CountOrderDoc.php?wad=".$wad."&tarikh=".$tarikh."';</script>";

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Order Doc / Pro</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- link checkbox datatable -->

    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.2.0/css/searchPanes.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">

  <style>
        div.dtsp-searchPane div.dataTables_scrollBody {
            height: 100px !important;
        }
         #dataTable tbody tr:hover {
            background-color:  #C0C2CC; /* Change the background color as desired */
        }
    </style>
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
                            <h6 class="m-0 font-weight-bold text-primary">Senarai Pesanan Doc / Pro Pada <?php echo $tarikh;?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!--set date-->
                                <form action="" method="get">
                                    <input type="date" name="historydate" id="date" required>
                                    <button type="submit" class="btn btn-info btn-icon-split right" name="Filter">
                                        <span class="icon text-white-600">
                                            <i class="fas fa-search fa-sm "></i>
                                        </span>
                                        <span class="text">Tapisan</span>
                                    </button>
                                </form>


                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Faciliti</th>
                                            <th>Bil Doc</th>
                                            <th>Bil Order Normal</th>
                                            <th>Bil Order Lain-lain</th>
                                            <th>Catatan</th>
                                            <th>Tindakkan</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                   
                                        <?php
                                        $tarikhsub=substr($tarikh,-2);//get date
                                        //connect database
                                        include("db_connection.php");
                                        // select data
                                        $getdata = "SELECT * FROM `tbldocpro` where  left(ordderid,2) = '$tarikhsub'";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {

                                            while ($data = mysqli_fetch_assoc($display)) {
                                                echo "<tr>";
                                                echo "<td>" . $data["facility"] . "</td>";
                                                echo "<td>" . $data["totalnum"] . "</td>";
                                                echo "<td>" . $data["normalnum"] . "</td>";
                                                echo "<td>" . $data["othernum"] . "</td>";
                                                echo "<td>" . $data["notes"] . "</td>";
                                                echo '<td>
                                                <a href="AdminEditOrderDoc.php?cmd=edit&id=' . $data['ordderid'] . '" class="btn btn-primary btn-icon-split btn-lg ">
                                                        <span class="icon text-white-600">
                                                            <i class="fas fa-pen"></i>
                                                        </span> 
                                                        </a>
                                                        ' ?>

                                                <a onclick="return confirm('confirm delete?')" <?php echo ' href="AdminEditOrderDoc.php?cmd=del&id=' . $data['ordderid'] . '"' ?> class="btn btn-danger btn-icon-split btn-lg ">
                                                    <span class="icon text-white-600">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </a>
                                                </td>
                                        <?php
                                                echo "</tr>";
                                            }
                                        }

                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Faciliti</th>
                                            <th>Bil Doc</th>
                                            <th>Bil Order Normal</th>
                                            <th>Bil Order Lain-lain</th>
                                            <th>Catatan</th>
                                            <th>Tindakkan</th>

                                        </tr>
                                    </tfoot>
                                </table>
                                <!--Will Bring to Add Patient Page-->
                                <a href="AdminAddOrderDoc.php" class="btn btn-success btn-icon-split right">
                                    <span class="icon text-white-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Tambah Order</span>
                                </a>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Senarai Bilangan Pesanan Pesakit Pada <?php echo $tarikh;?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">  
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Order Normal</th>
                                        <th>Order Lain</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        include("db_connection.php");
                                        $getdata = "SELECT * FROM `tblbilorder`where groupid='$wad' ORDER BY `tblbilorder`.`idnum` ASC ";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {

                                            while ($data = mysqli_fetch_assoc($display)) {
                                                echo "<td>" . $data["bil"] . "</td>";
                                            }
                                        }
                                        ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>Order Normal</th>
                                        <th>Order Lain</th>
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

  
    <script>
        $(document).ready(function() {

            var table = $('#dataTable').DataTable({
                dom: 'Pfrtip', // Add 'P' for search panes
                searchPanes: {
                },
            });

        });
    </script>

</body>

</html>
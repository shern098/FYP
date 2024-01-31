<?php
session_start();
$user = $_SESSION["CurrentUser"];
$tarikh   = $_SESSION['date'];
if (!$user) {
    echo "<script>window.location.href='index.php';</script>";
}


if(isset($_GET["wad"])){
    $wad = $_GET["wad"];
}
if(isset($_GET["tarikh"])){
    $tarikh = $_GET["tarikh"];
}

  if(isset($_GET["count"])){
    echo "<script>window.location.href=
    'CountOrder.php?wad=".$wad."&tarikh=".$tarikh."'
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


    <title>Lihat Report</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom dt for this page -->
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
    <style>
        .funcbtn:disabled {
      background-color: grey;
      color: black;
    }
    </style>

        <script>
            function checkSelection() {
            var select = document.getElementById("adminSelect");
            var buttons = document.getElementsByClassName("funcbtn");
            if (select.value === "-1") {
                for (var i = 0; i < buttons.length; i++) {
                buttons[i].disabled = true;
                }
            } else {
                for (var i = 0; i < buttons.length; i++) {
                buttons[i].disabled = false;
                }
            }
            }
        </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php

        include("AdminSideBar.php");

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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $user;   ?></h1>

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
                            <h6 class="m-0 font-weight-bold text-primary">Senarai Pesanan Pesakit Pada <?php echo $tarikh;?></h6>
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
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        //connect database
                                        include("db_connection.php"); 
                            
                                        // select data
                                        $getdata = "SELECT * FROM `tblpatient` where wad = '$wad' and DATE(masa_keyin_nurse) = '$tarikh'  and `status` IN (1, 2, 3, 4) ";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {

                                            while ($data = mysqli_fetch_assoc($display)) {


                                                
                                                switch ($data['status']) {
                                                    case 0:
                                                        $status = "Belum Disemak";
                                                        break;
                                                    case 1:
                                                        $status = "Telah Disemak";
                                                        break;
                                                    case 2:
                                                        $status = "Sedang Disediakan";
                                                        break;
                                                     case 3:
                                                        $status = "Telah Sedia";
                                                        break;   
                                                    case 4:
                                                            $status = "Telah Diterima";
                                                            break; 
                                                }

                                                echo "<tr>";
                                                echo "<td>" . $data["rn"] . "</td>";
                                                echo "<td>" . $data["bednum"] . "</td>";
                                                echo "<td>" . $data["name"] . "</td>";
                                                echo "<td>" . $data["kelas"] . "</td>";
                                                echo "<td>" . $data["iddiet"] . "</td>";
                                                echo "<td>" . $data["catatan"] . "</td>";
                                                echo "<td>" . $status . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        mysqli_close($conn);

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
                                            <th>STATUS</th>
                                            
                                        </tr>
                                    </tfoot>
                                </table>
                                <form action="UpStatus.php" method="get">
                                     <input name="wad"  style="display:none;" value=<?php echo $wad; ?>>
                                     <input name="tarikh"  style="display:none;" value=<?php echo $tarikh; ?>>

                                <button type="submit" class="funcbtn btn btn-primary btn-icon-split right" name="Sahkan" disabled><span class="icon text-white-600">
                                        <i class="fas fa-arrow-right"></i>
                                   </span>
                                    <span class="text">Sahkan</span></button>

                                    <button type="submit" class="funcbtn btn btn-primary btn-icon-split right" name="Hantar" disabled><span class="icon text-white-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Hantar</span></button>
                                    
                                    <button type="submit" class="funcbtn btn btn-danger btn-icon-split right" name="Reset" disabled><span class="icon text-white-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Batal Status</span></button>
                                    

                                <select class="form-control col-3 offset-md-3" name="admin" id="adminSelect" style="display:inline-flex; " onchange="checkSelection()">
                                            <option class="dropdown-item col-md-4" value="-1">Pilih Pengesah</option>
                                            <?php
                                            // Include database connection
                                            include("db_connection.php");

                                            // Select data from the database
                                            $getdata = "SELECT * FROM `tblunitdietik`";
                                            $display = mysqli_query($conn, $getdata);


                                            // Loop through diet options and mark the selected option based on $diet variable

                                            while ($data = mysqli_fetch_assoc($display)) {

                                                echo "<option value='" . $data["idunit"] . "' $selected>" . $data["Nama"] . "</option>";
                                            }

                                            mysqli_close($conn);

                                            ?>
                                        </select>
                                </form>
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
                                        $getdata = "SELECT * FROM `tblbilorder`where groupid='$wad' ORDER BY `tblbilorder`.`idnum` ASC ";
                                        $display = mysqli_query($conn, $getdata);
                                        //display data
                                        if (mysqli_num_rows($display) > 0) {

                                            while ($data = mysqli_fetch_assoc($display)) {
                                                echo "<td>" . $data["bil"] . "</td>";
                                            }
                                        }else{
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
                                <form action="setdateexcel.php" method="get" id="formgetshift">
                                      <label >Pilih Shift Untuk Download Laporan</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="Pagi2" name="shift2" class="custom-control-input" value="pagi2" onclick="showaccept('R')"> 
                                            <label class="custom-control-label" for="Pagi2">PAGI</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="Petang2" name="shift2" class="custom-control-input" value="petang2" onclick="showaccept('R')">
                                            <label class="custom-control-label" for="Petang2">PETANG</label>
                                        </div>
                                        </div>
                                <a href='AdminViewReport.php?wad=0&historydate=<?php echo $tarikh?>&Filter=&Count=' class="btn btn-light btn-icon-split right">
                                    <span class="icon text-white-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">Kembali</span>
                                </a>
                                <input name="wad"  style="display:none;" value=<?php echo $wad; ?>>
                                     <input name="tarikh"  style="display:none;" value=<?php echo $tarikh; ?>>
                                <button type="submit" class="funcbtn btn btn-grey btn-icon-split right" name="Laporan"><span class="icon text-white-600">
                                        <i class="fas fa-download"></i>
                                    </span>
                                    <span class="text">Download Laporan</span></button>
                                            </td>

                                             <div class="container form-group has-feedback">
</form>
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
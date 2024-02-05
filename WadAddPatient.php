<?php
session_start();
if (!$_SESSION['CurrentUser']) {
    echo "<script>window.location.href='index.php';</script>";
}

if (isset($_SESSION['add_success']) && $_SESSION['add_success']) {
    // Output JavaScript code to show an alert
    echo "<script>alert('Data Berjaya dimasukkan!');</script>";

    // Unset the session variable to prevent it from appearing on reload
    unset($_SESSION['add_success']);
}

if (isset($_SESSION['duplicate_data']) && $_SESSION['duplicate_data']) {
    // Output JavaScript code to show an alert for duplicate 'rn' value
    echo "<script>alert('R\N Pesakit: " . $_SESSION['rn'] . " telah wujud. Sila masukkan RN lain.');</script>";
    // Unset the session variable to prevent it from appearing on reload
    unset($_SESSION['duplicate_data']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="images/hospitalicon.ico" type="image/x-icon">

    <title>Tambah Pesakit</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/demo/clock.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


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
                        <h1 class="h3 mb-0 text-gray-800">Isi Maklumat Pesakit di <?php echo $_SESSION['CurrentUser'] ?></h1>


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
                        <div class="col-6">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"> Masukkan Maklumat Pesakit </h6>
                                </div>
                                <div class="card-body">
                                <form action="AddDataPatient.php" method="get">

                                        <div class="container form-group has-feedback">

                                        <div class="form-group has-feedback col" style="display: none;">
                                            <input type="text" class="form-control " id="inputSuccess2" name="currentuser" value="<?php echo $_SESSION['CurrentUser'] ?>" required>
                                        </div>


                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="Pagi" name="shift" class="custom-control-input" value="PAGI" required>
                                                <label class="custom-control-label" for="Pagi">PAGI</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="Petang" name="shift" class="custom-control-input" value="PETANG">
                                                <label class="custom-control-label" for="Petang">PETANG</label>
                                            </div>

                                        </div>



                                        <div class="form-group has-feedback col">
                                            <input type="text" class="form-control " id="inputSuccess2" name="rn" placeholder="RN Pesakit" required>
                                        </div>

                                        
                                        <div class=" form-group has-feedback col">
                                            <input type="text" class="form-control" id="inputSuccess3" name="nokatil" placeholder="No Katil" required>
                                        </div>
                                        
                                        <div class="form-group has-feedback col">
                                            <input type="text" class="form-control " id="inputSuccess4" name="nama" placeholder="Nama Pesakit" required>
                                        </div>

                                        <div class="form-group has-feedback col">

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="Kelas2" name="kelas" class="custom-control-input" value="K2" required>
                                                <label class="custom-control-label" for="Kelas2">Kelas 2</label>
                                            </div>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="Kelas3" name="kelas" class="custom-control-input" value="K3">
                                                <label class="custom-control-label" for="Kelas3">Kelas 3</label>
                                            </div>

                                        </div>



                                        <div class="form-group has-feedback col">



                                        <select class="form-control" name="diet" onchange="DisplaytextArea(this.value)" id="dietSelect" required>
                                                <option class="dropdown-item col-md-4" value="">Pilih Diet</option>
                                                <?php
                                                // Include database connection
                                                include("db_connection.php");

                                                // Select data from the database
                                                $getdata = "SELECT `iddiet`,`name` FROM `tbldiet`";
                                                $display = mysqli_query($conn, $getdata);

                                                // Display data as options
                                                if (mysqli_num_rows($display) > 0) {
                                                    while ($data = mysqli_fetch_assoc($display)) {
                                                        echo "<option value='" . $data["iddiet"] . "'>" . $data["name"] . "</option>";
                                                    }
                                                }
                                                mysqli_close($conn);
                                                ?>
                                            </select>

                                            <br>

                                            <div id="lainlainTextarea">
                                                <input type="text" placeholder="Catatan" id="catatan" class="form-control has-feedback-left" name="txtcatatan" rows="2" cols="25" ></input>
                                            </div>



                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                <button type="button" class="btn btn-primary" id="backButton">Back</button>
                                                <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                                            </div>
                                        </div>
                                    </form>


                                    <script>
                                        const cancelButton = document.getElementById('backButton');
                                        const submitButton = document.getElementById('submitButton');

                                        cancelButton.addEventListener('click', function() {
                                            // Use the history object to go back to the previous page
                                            window.location.href = "WadEditOrder.php";
                                        });
                                    </script>
                                </div>
                            </div>
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
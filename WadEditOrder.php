<?php
session_start();
$user = $_SESSION["CurrentUser"];
$tarikh   = $_SESSION['date'];

if (!$user) {
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

if (isset($_SESSION['cancel_success']) && $_SESSION['cancel_success']) {
    // Output JavaScript code to show an alert
    echo "<script>alert('Data berjaya dibatalkan!');</script>";

    // Unset the session variable to prevent it from appearing on reload
    unset($_SESSION['cancel_success']);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="images/hospitalicon.ico" type="image/x-icon">

    <title>Edit Senarai </title>

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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo   $user;   ?></h1>
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
                            <?php $tarikh_reverse = date("d-m-Y", strtotime($tarikh)); ?>
                            <h6 class="m-0 font-weight-bold text-primary">Senarai Perubahan Pesanan Pesakit (<?php echo $tarikh_reverse ?>) </h6>
                        </div>
                        <div class="card-body">
                            <form id="SaveFunction.php" method="get">
                                <div class="table-responsive">
                                    <input type="hidden" name="currentUser" value="<?php echo $user; ?>">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>

                                                <th></th>
                                                <th>ID PESAKIT</th>
                                                <th>R/N PESAKIT</th>
                                                <th>NO. KATIL</th>
                                                <th>NAMA PESAKIT</th>
                                                <th>KELAS</th>
                                                <th>JENIS DIET</th>
                                                <th>CATATAN</th>
                                                <th>STATUS</th>
                                                <th>OPERASI</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                            //connect database
                                            include("db_connection.php");

                                            // select data
                                            $getdata = "SELECT * FROM `tblpatient` where wad = '$user' and DATE(masa_keyin_nurse) ='$tarikh'";

                                            $display = mysqli_query($conn, $getdata);
                                            //display data
                                            if (mysqli_num_rows($display) > 0) {

                                                while ($data = mysqli_fetch_assoc($display)) {
                                                    $id_patient = $data["id_patient"];

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

                                                    if ($status == "Belum Disemak") {
                                            ?>
                                                        <tr>

                                                            <td> <?php             ?> </td>
                                                            <td> <?php echo $id_patient;  ?> </td>
                                                            <td> <?php echo $data["rn"];         ?> </td>
                                                            <td> <?php echo $data["bednum"];     ?> </td>
                                                            <td> <?php echo $data["name"];       ?> </td>
                                                            <td> <?php echo $data["kelas"];      ?> </td>
                                                            <td> <?php echo $data["iddiet"];     ?> </td>
                                                            <td> <?php echo $data["catatan"];    ?> </td>
                                                            <td> <?php echo $status              ?> </td>
                                                            <td class="text-center">

                                                                <?php


                                                                switch ($status) {
                                                                    case "Belum Disemak":
                                                                ?>
                                                                        <a href='WadEditPatient.php?id=<?php echo $id_patient; ?>' class="btn btn-info  btn-lg" style="text-decoration: none; ">
                                                                            <span class="icon text-white-600">
                                                                                <i class="fas fa-pen"></i>
                                                                            </span>
                                                                        </a> <!-- Edit icon -->

                                                                        <a onclick="return confirm('Buang Pesanan nama: <?php echo $data['name'] ?> ')" href='DeleteFunction.php?id=<?php echo $id_patient; ?>' class="btn btn-danger btn-lg" style="text-decoration: none; ">
                                                                            <span class="icon text-white-600">
                                                                                <i class="fas fa-trash"></i>
                                                                            </span>
                                                                        </a> <!-- Delete icon -->

                                                                <?php
                                                                        break;




                                                                        mysqli_close($conn);
                                                                }
                                                                ?>
                                                            </td>

                                                        </tr>
                                            <?php
                                                    }
                                                } // end while loop
                                            } // end if 
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <hr>
                                    <div class="form-inline mt-3" style="justify-content: space-between;">


                                        <!--Will Bring to Add Patient Page-->
                                        <a href="WadListPatient.php" class="btn btn-success btn-md btn-icon-split ">
                                            <span class="icon text-white-600">
                                                <i class="fas fa-arrow-right"></i>
                                            </span>
                                            <span class="text">Senarai Pesanan Pesakit </span>
                                        </a>
                                        <a href="WadAddPatient.php" class="btn btn-info btn-md btn-icon-split ">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span class="text">Tambah Pesanan</span>
                                        </a>


                                        <!-- offset is padding right -->
                                        <select class="form-control col-3 offset-md-3" name="nurse" id="nurseSelect" style="display:inline-flex; ">
                                            <option class="dropdown-item col-md-4" value="">Pilih Jururawat</option>
                                            <?php
                                            // Include database connection
                                            include("db_connection.php");

                                            // Select data from the database
                                            $getdata = "SELECT * FROM `tblnurse`";
                                            $display = mysqli_query($conn, $getdata);


                                            // Loop through diet options and mark the selected option based on $diet variable

                                            while ($data = mysqli_fetch_assoc($display)) {

                                                echo "<option value='" . $data["idnurse"] . "' $selected>" . $data["nama"] . "</option>";
                                            }

                                            mysqli_close($conn);

                                            ?>
                                        </select>

                                        <button type="button" class=" btn btn-icon-split btn-sm btn-primary" id="submit">
                                            <span class="icon text-white-600">
                                                <i class="fas fa-download fa-sm text-white-50"></i>
                                            </span>
                                            <span class="text ">Hantar Pesanan</span>
                                        </button>

                            </form>



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
                    columns: [2, 3, 4, 5, 6, 7,8,], // Specify the column indices to include in the search panes

                },
                scrollY: 400,
                scroller: {
                    loadingIndicator: true
                },

                columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0,
                        width: "5%",

                    },
                    {
                        targets: 1, // Assuming the "Operasi" column is the 7th column (adjust if necessary).
                        visible: false,
                        searchable: false
                    },
                    {
                        targets: 2, // Assuming the "Operasi" column is the 7th column (adjust if necessary).
                        width: "5%",
               
                    },
                    {
                        targets: 3, // Assuming the "Operasi" column is the 7th column (adjust if necessary).
                        width: "5%",
                    },
                    {
                        targets: 5, // Assuming the "Operasi" column is the 7th column (adjust if necessary).
                        width: "5%",
                    },
                    {
                        targets: 7, // Assuming the "Operasi" column is the 7th column (adjust if necessary).
                        width: "20%",
                    },
                    {
                        targets: 8, // Assuming the "Operasi" column is the 7th column (adjust if necessary).
                        width: "5%",
                    },
                    {
                        targets: 9, // Assuming the "Operasi" column is the 7th column (adjust if necessary).
                        orderable: false,
                    }
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                oLanguage: {
                    sLengthMenu: "Tunjuk _MENU_ rekod",
                    sSearch: "Carian:"
                },
                lengthMenu: [
                    [10, 25, -1],
                    [10, 25, "All"]
                ]
            });

            table.searchPanes.container().prependTo(table.table().container());
            table.searchPanes.resizePanes();

            // Hide checkboxes for rows with "Telah Disahkan" status.
            table.rows().every(function() {
                var data = this.data();
                var status = data[8]; // Assuming the status is in the 7th column (index 6).
                var belumSemak = status === "Belum Disemak";

                if (!belumSemak) {
                    // Hide the checkboxes by setting their display style'.
                    $(this.node()).find("td.select-checkbox").css('visibility', 'hidden');
                }
            });

            //send data from FORM
            $('#submit').on('click', function() {
                var selectedRows = table.rows('.selected').data();
                var nurseId = $('#nurseSelect').val();
                var nurseName = $('#nurseSelect option:selected').text();
                var currentUser = $('input[name="currentUser"]').val(); // Get the value of the hidden input field

                if (!currentUser) {
                    alert('Current user is not defined. Please make sure you are logged in.');
                    return;
                }

                if (selectedRows.length === 0) {
                    alert('Sila pilih pesakit untuk dihantar.');
                } else if (nurseId === '') {
                    alert('Sila pilih jururawat pemesan.');
                } else {
                    var rnList = [];

                    for (var i = 0; i < selectedRows.length; i++) {
                        rnList.push(selectedRows[i][1]); // Assuming the R/N PESAKIT is in the second column (index 1).
                        console.log(rnList);
                    }

                    $.ajax({
                        type: 'GET',
                        url: 'SaveFunction.php',
                        data: {
                            currentUser: currentUser,
                            nurseId: nurseId,
                            nurseName: nurseName,
                            rnList: rnList
                        },
                        success: function(response) {
                            if (response === 'success') {
                                alert('');
                                window.location.reload();
                            } else {
                                alert('Data Berjaya Dihantar');
                                window.location.reload();
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred while sending the data to the server. Please try again or check the server logs for more information.');
                        }
                    });

                }
            });
        });
    </script>

</body>

</html>
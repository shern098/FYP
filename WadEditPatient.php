<?php
session_start();

$user = $_SESSION["CurrentUser"];
$tarikh   = $_SESSION['date'];

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


  <title>Sunting Pesanan</title>

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
            <h1 class="h3 mb-0 text-gray-800"> Maklumat Pesakit </h1>


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
                  <h6 class="m-0 font-weight-bold text-primary">Kemaskini Maklumat Pesakit </h6>
                </div>
                <div class="card-body">

                  <?php
                  // Include database connection
                  include("db_connection.php");

                  // Check if the 'id' parameter is set in the URL
                  if (isset($_GET['id'])) {
                    // Sanitize the input to prevent SQL injection
                    $id = mysqli_real_escape_string($conn, $_GET['id']);

                    // Query to retrieve data based on the 'id'
                    $query = "SELECT * FROM tblpatient WHERE rn = $id";

                    $result = mysqli_query($conn, $query);

                    // Check if the query was successful
                    if ($result) {
                      // Fetch the data as an associative array
                      $data = mysqli_fetch_assoc($result);

                      if ($data) {
                        // Assign retrieved data to variables
                        $rn = $data['rn'];
                        $nama = $data['name'];
                        $nokatil = $data['bednum'];
                        $kelas = $data['kelas'];
                        $diet = $data['iddiet'];
                        $catatan = $data['catatan'];
                        // $lainlainText = $data['lainlainText']; //data lain-lain takde lagi
                      } else {
                        // Handle case where no data was found for the given 'id'
                        echo "Data tidak dapat dijumpai.";
                      }
                    } else {
                      // Handle query execution error
                      echo "Error executing the query: " . mysqli_error($conn);
                    }
                  }


                  ?>

                  <form action="updateFunction.php" method="get">

                    <div class="container form-group has-feedback">

                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="Pagi" name="shift" class="custom-control-input" value="pagi">
                        <label class="custom-control-label" for="Pagi">PAGI</label>
                      </div>

                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="Petang" name="shift" class="custom-control-input" value="petang">
                        <label class="custom-control-label" for="Petang">PETANG</label>
                      </div>

                    </div>


                    <div class="form-group has-feedback col">
                      <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="rn" placeholder="RN Pesakit"  value="<?php echo isset($rn) ? $rn : ''; ?>">
                    </div>

                    <div class="form-group has-feedback col">
                      <input type="text" class="form-control" id="inputSuccess3" name="nokatil" placeholder="No Katil" value="<?php echo isset($nokatil) ? $nokatil : ''; ?>">
                    </div>
                    

                    <div class="form-group has-feedback col">
                      <input type="text" class="form-control has-feedback-left" id="inputSuccess4" name="nama" placeholder="Nama Pesakit" value="<?php echo isset($nama) ? $nama : ''; ?>">
                    </div>
                 
                    
                    <div class="form-group has-feedback col">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="Kelas2" name="kelas" class="custom-control-input" value="K2" <?php echo ($kelas=='K2')?'checked':'' ?> required>
                        <label class="custom-control-label" for="Kelas2" >Kelas 2</label>
                      </div>

                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="Kelas3" name="kelas" class="custom-control-input" <?php echo ($kelas=='K3')?'checked':'' ?> value="K3">
                        <label class="custom-control-label" for="Kelas3">Kelas 3</label>
                      </div>

                    </div>

                    <div class="form-group has-feedback col">
                      <select class="form-control" name="diet" onchange="DisplaytextArea(this.value)" id="dietSelect">
                        <option class="dropdown-item col-md-4" value="">Pilih Diet</option>
                        <?php

                        // Select data from the database
                        $getdata = "SELECT `iddiet`,`name` FROM `tbldiet`";
                        $display = mysqli_query($conn, $getdata);


                        // Loop through diet options and mark the selected option based on $diet variable
                        if (isset($diet)) {
                          while ($data = mysqli_fetch_assoc($display)) {
                            $selected = ($data["iddiet"] == $diet) ? 'selected' : '';
                            echo "<option value='" . $data["iddiet"] . "' $selected>" . $data["name"] . "</option>";
                          }
                        }
                        ?>
                      </select>
                      <br>
                      <div id="lainlainTextarea">
                        <textarea id="lainlainText" class="form-control has-feedback-left" name="catatan" rows="2" cols="25"><?php echo $catatan ?></textarea>
                      </div>


                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-primary" id="cancelButton">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </form>


                  <script>
                    const cancelButton = document.getElementById('cancelButton');


                    cancelButton.addEventListener('click', function() {
                      // Use the history object to go back to the previous page
                      window.history.back();
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
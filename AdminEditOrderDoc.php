<?php
include ("db_connection.php");
session_start();
if (!$_SESSION['CurrentUser']) {
    echo "<script>window.location.href='index.php';</script>";
  }

if (isset($_GET["cmd"])) {
$cmd=$_GET["cmd"];
$id=$_GET["id"];
    if($cmd == "del"){
        $del = "DELETE FROM `tbldocpro` WHERE ordderid=$id";
        mysqli_query($conn, $del);
        echo "<script>
window.location.href = 'AdminListOrderDoc.php';
</script>";
    }

    $getdata = "SELECT * FROM `tbldocpro` where ordderid=$id";
    $display = mysqli_query($conn, $getdata);
    //display data
    if (mysqli_num_rows($display) > 0) {

        while ($data = mysqli_fetch_assoc($display)) {
            $facility = $data["facility"];  
            $ttl = $data["totalnum"];  
            $dn = $data["normalnum"];  
            $ll = $data["othernum"];  
            $cttn = $data["notes"];  
        }
}



}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title> Edit Order Doc / Pro </title>

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
                        <h1 class="h3 mb-0 text-gray-800"> Edit Pesanan(DocPro) </h1>

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
                            <div>
                            </div>
                              <form action="updatedataDocPro.php" method="get">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback ">
                                    <input name="id" id="idorder" style="display:none;" value=<?php echo $id; ?>>
                                    <select class="form-control" name="fasiliti" id="fasiliti" required>
                                        <option class="dropdown-item col-md-4" value="">Pilih Fasiliti</option>
                                        <?php
                                        if ($facility == "KP"){
                                            echo "<option class='dropdown-item col-md-4' value='KP' selected>Klinik Pakar</option>";
                                        
                                            echo "<option class='dropdown-item col-md-4' value='DB'>Dewan Bedah</option>";
                                        }
                                        elseif ($facility == "DB") {
                                            echo "<option class='dropdown-item col-md-4' value='KP' >Klinik Pakar</option>";
                                            
                                            echo "<option class='dropdown-item col-md-4' value='DB'     selected>Dewan Bedah</option>";
                                        }
                                        ?>
                                        
                                        
                                       
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="number" class="form-control" name="BilDoc" placeholder="Bilangan Doc" value = "<?php echo $ttl?>"required>
                                </div>

                                <!-- Pilihan normal diet dan lain2 -->
                                <div class="container">
                                         
                                        <input type="checkbox" id="DN" name="DietNormalCB" onclick="showTextarea()">
                                        <label for="DN">Diet Normal</label>
                                    <br>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="number" class="form-control" id="DNTextarea" name="BilDN" style="display:none" value = "<?php echo $dn?>" placeholder="Bilangan Pesanan">
                                    </div>
                                   <br>


                                        <input type="checkbox" id="LL" name="LainLainCB" onclick="showTextarea()">
                                        <label for="LL">Lain-Lain</label>
                                    <br>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="number" class="form-control" id="LLBilTextarea" name="BilLL" style="display:none" value = "<?php echo $ll?>" placeholder="Bilangan Pesanan">
                                        <br>
                                        <textarea id="LLTextarea" class="form-control" name="extra" style="display:none"><?php echo $cttn ?></textarea>
                                    </div>
                                </div>
                                <br>
                                <script>
                                    function showTextarea() {
                                        var DNCB = document.getElementById("DN");
                                        var LLCB = document.getElementById("LL");
                                        var DNtxt = document.getElementById("DNTextarea");
                                        var LLtxt = document.getElementById("LLTextarea");
                                        var LLbil = document.getElementById("LLBilTextarea");

                                        if (DNCB.checked) {
                                            DNtxt.style.display = "block";
                                        } else {
                                            DNtxt.style.display = "none";
                                        }

                                        if (LLCB.checked) {
                                            LLtxt.style.display = "block";
                                            LLbil.style.display = "block";
                                        } else {
                                            LLtxt.style.display = "none";
                                            LLbil.style.display = "none";
                                        }
                                    }

                                    function validateForm() {
                                        
                                        var DNCB = document.getElementById("DN");
                                        var LLCB = document.getElementById("LL");
                                        var DNtxt = document.getElementById("DNTextarea");
                                        var LLtxt = document.getElementById("LLTextarea");
                                        var LLbil = document.getElementById("LLBilTextarea");
                                        var DNcheck = false;
                                        var LLcheck = false;

                                        var BilDN = parseInt(document.getElementById("DNTextarea"));
                                        var BilLL = parseInt(document.getElementById("LLBilTextarea"));
                                        var BilDoc = parseInt(document.getElementById("BilDoc"));

                                        if (!DNCB.checked && !LLCB.checked) {
                                            alert("Sila Chek Sekurang-kurangnya 1 Jenis Diet.");
                                            return false;
                                        }

                                         if(DNCB.checked){
                                            if(DNtxt.value == ''){
                                            alert("Sila Isi Bilangan Diet Normal.");
                                            return false;}
                                        }
                                        

                                         if(LLCB.checked){
                                            if(LLbil.value == ''){
                                            alert("Sila Isi Bilangan Lain-Lain.");
                                            return false;}
                                            else if(LLtxt.value == ''){
                                            alert("Sila Isi Catatan Lain-Lain.");
                                            return false;}
                                        }
                                        
                                        if(confirm('Confirm Simpan Data?')){
                                        }else{return false;}
                                    }
                                </script>
                                <!-- button submit dan cancel -->
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="AdminListOrderDoc.php">
                                            <button type="button" class="btn btn-primary" name="btncancel">Batal</button>
                                        </a>
                                        <button type="submit" class="btn btn-success" onclick="return validateForm()" name="btnhantar">Update</button>
                                    </div>
                                </div>
                            </form>
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

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
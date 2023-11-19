<?php

session_start();
include("MakeDataToJSON.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Table</title>


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/searchpanes/2.2.0/css/searchPanes.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" rel="stylesheet">


</head>

<body class="p-4">
  <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>R/N PESAKIT</th>
        <th>NO.KATIL</th>
        <th>NAMA PESAKIT</th>
        <th>KELAS</th>
        <th>TYPE DIET</th>
        <th>TARIKH</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
      <tr>
        <th>R/N PESAKIT</th>
        <th>NO.KATIL</th>
        <th>NAMA PESAKIT</th>
        <th>KELAS</th>
        <th>JENIS DIET</th>
        <th>TARIKH</th>
      </tr>
    </tfoot>
  </table>

  <!-- kat C:\xampp\htdocs\FYP\js\demo\datatables-demo.js takdop JQUERY sbb buat kat sini JQUERY kena ada 1 kode shj tokleh byk2 -->
  <script type="text/javascript">
    $(document).ready(function() {

      $.getJSON('data.json', function(data) {
        var table = $('#dataTable').DataTable({
          dom: 'Plfrtip',
      
          scrollY: 400,

          "lengthMenu": [
            [5, 10, 25, -1],
            [5, 10, 25, "All"]
          ],
          data: data,
          columns: [{
              data: 'rn'
            },
            {
              data: 'bednum'
            },
            {
              data: 'name'
            },
            {
              data: 'kelas'
            },
            {
              data: 'iddiet'
            },
            {
              data: 'keyin_Date'
            }
          ]
        });
      });

      $('#dataTable tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      });

  

      table.columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
          if (that.search() !== this.value) {
            that
              .search(this.value)
              .draw();
          }
        });
      });


    });
  </script>



  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/2.2.0/js/dataTables.searchPanes.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

</body>

</html>
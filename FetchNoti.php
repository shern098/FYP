<?php
// Include database connection
include("db_connection.php");
session_start();
$user = $_SESSION["CurrentUser"];
$tarikh   = $_SESSION['date'];
if (isset($_POST['option'])) {

  if (isset($_POST['option']) != '') {

    
  }

  $sql = "SELECT * FROM `tbluser` WHERE `username` = '$user' ";
  $resWad = mysqli_query($conn, $sql);
  //check in tbl admin
  $sqla = "SELECT * FROM `tbladmin` WHERE  `username` = '$user' ";
  $resAdmin = mysqli_query($conn, $sqla);
  //if found in wad
  if (mysqli_num_rows($resWad) > 0) {

    // Construct the SQL query to update the record
    $updateQuery = "SELECT * FROM tblpatient where  status IN ( 2, 3) AND wad = '$user'  AND DATE(masa_keyin_nurse) = '$tarikh'  ORDER BY rn DESC LIMIT 4";
    $result = mysqli_query($conn, $updateQuery);
    $output = '';

    if (mysqli_num_rows($result) > 0) {

      while ($row = mysqli_fetch_array($result)) {

                               
        switch ($row['status']) {
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


        $output .= "

      <a class='dropdown-item d-flex align-items-center'>
      <div>
      <div class='small font-weight-bold'>"  . $status   ." - " . $row["unit_penerima"]. "</div>
      <span class='font-weight-bold'>" . $row['name'] . "</span>
      </div>
      </a>

    ";
      }
    } else {
      $output = "  
    <a class='dropdown-item d-flex align-items-center'>
    <div class='text-center'>

      <span class='font-weight-bold'> Tiada Kemasukan</span>
      </div>
      </a>
      ";
    }

    $status_queery = "select * from tblpatient where   status IN ( 2, 3) AND wad = '$user'  AND DATE(masa_keyin_nurse) = '$tarikh'";
    $result_query = mysqli_query($conn, $status_queery);
    $count = mysqli_num_rows($result_query);
    $data = array(

      'notification' => $output,
      'unreadNotications' => $count

    );

    echo json_encode($data);
  }
  //if found in tbl admin
  elseif (mysqli_num_rows($resAdmin) > 0) {

    // Construct the SQL query to update the record
    $updateQuery = "SELECT * FROM tblpatient where  status IN  (1,4) AND DATE(masa_keyin_nurse) = '$tarikh' ORDER BY rn DESC LIMIT 4";
    $result = mysqli_query($conn, $updateQuery);
    $output = '';

    if (mysqli_num_rows($result) > 0) {

      while ($row = mysqli_fetch_array($result)) {
                          
        switch ($row['status']) {
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

        $output .= "
     
           <a class='dropdown-item d-flex align-items-center'>
           <div>
           <div class='small font-weight-bold'>" . $status   ." - " . $row["wad"]. " </div>
           <span class='font-weight-bold'>" . $row['name'] . "</span>
           </div>
           </a>
     
         ";
      }
    } else {
      $output = "  
         <a class='dropdown-item d-flex align-items-center'>
         <div class='text-center'>
     
           <span class='font-weight-bold'> Tiada Kemasukan</span>
           </div>
           </a>
           ";
    }

    $status_queery = "select * from tblpatient where status IN (1,4)  AND DATE(masa_keyin_nurse) = '$tarikh'";
    $result_query = mysqli_query($conn, $status_queery);
    $count = mysqli_num_rows($result_query);
    $data = array(

      'notification' => $output,
      'unreadNotications' => $count

    );

    echo json_encode($data);
  }
}



mysqli_close($conn);

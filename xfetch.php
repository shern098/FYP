<?php
// Include database connection
include("db_connection.php");
session_start();
$user = $_SESSION["CurrentUser"];
if (isset($_POST['option'])) {

  if (isset($_POST['option']) != '') {


    $update = " UPDATE tblpatient SET status=1 WHERE status=0 ";
    mysqli_query($conn, $update);
  }

  // Construct the SQL query to update the record
  $updateQuery = "SELECT * FROM tblpatient where rn = '$user' ORDER BY rn ASC LIMIT 4";
  $result = mysqli_query($conn, $updateQuery);
  $output = '';

  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
      $output .= "

      <a class='dropdown-item d-flex align-items-center'>
      <div>
      <div class='small text-gray-500'>" . $row['rn'] . "</div>
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

  $status_queery = "select * from tblpatient where status = 0";
  $result_query = mysqli_query($conn, $status_queery);
  $count = mysqli_num_rows($result_query);
  $data = array(

    'notification' => $output,
    'unreadNotications' => $count

  );

  echo json_encode($data);
}
mysqli_close($conn);

<?php 

include ("db_connection.php");

// extract this from db
  $getData = "SELECT * FROM tblpatient";
  $result = mysqli_query($conn,$getData);

  while ($row = mysqli_fetch_assoc($result)) {
      $patients[] = $row;
  }

  // turn it into JSON data in JSON file 
  $encode_data = json_encode($patients, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  file_put_contents('data.json', $encode_data);


?>

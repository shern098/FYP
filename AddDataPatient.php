
                <?php

                include("db_connection.php");
                session_start();

                $shift = $_GET["shift"];
                $rn = $_GET['rn'];
                $nokatil = $_GET['nokatil'];
                $kelas = $_GET['kelas'];
                $nama = $_GET['nama'];
                $diet = $_GET['diet'];
                $catatan = $_GET['txtcatatan'];
                

                
                // Get the current user from the session
                $user = $_SESSION['CurrentUser'];

                // PROCEDURAL STYLE MYSQLI

                // Use a try-catch block to catch unique constraint violation error
                try {

                    $getdata = $conn->prepare("INSERT INTO `tblpatient`(`rn`, `bednum`, `name`, `kelas`, `iddiet`, `catatan`, `wad`, `shift`) VALUES (?,?,?,?,?,?,?,?)");
                    $getdata->bind_param("ssssssss", $rn, $nokatil, $nama, $kelas, $diet, $catatan, $user, $shift);


                    if ($getdata->execute()) {
                        $_SESSION['add_success'] = true;

                        // Display an alert with the values of the parameters
                        echo "<script>alert('$rn $nokatil $kelas $nama $diet');</script>";

                        header("Location: WadAddPatient.php");
                    } else {
                        echo "Error inserting record: " . $getdata->error . "<br>";
                    }
                } catch (Exception $e) {
                    $_SESSION['duplicate_data'] = true;
                    $_SESSION['rn'] = $rn;
                    // Handle the unique constraint violation (duplicate rn) error here

                    echo "<script> window.history.back(); </script> ";
                } finally {
                    $getdata->close(); // Close the prepared statement
                    $conn->close(); // Close the database connection
                }

                ?>
          
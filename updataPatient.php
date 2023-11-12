
                <?php

                include("db_connection.php");
                session_start();

                $rn = $_GET['rn'];
                $nokatil = $_GET['nokatil'];
                $kelas = $_GET['kelas'];
                $nama = $_GET['nama'];
                $diet = $_GET['diet'];
                $catatan = $_GET['txtcatatan'];
                

                echo "<script>alert(" .
                    $rn . '<br>' .
                    $nokatil . '<br>' .
                    $kelas . '<br' .
                    $nama . '<br>' .
                    $diet . '<br>' .
                    ");</script>";

                $getdata = $conn->prepare("INSERT INTO `tblpatient`(`rn`, `bednum`, `name`, `kelas`,`iddiet`,`catatan`) VALUES (?,?,?,?,?,?)");
                $getdata->bind_param("ssssss", $rn, $nokatil, $nama, $kelas, $diet, $catatan);
                if ($getdata->execute()) {
                    $_SESSION['add_success'] = true;

                    header("Location: WadAddPatient.php");
                } else {
                    echo "Error inserting record: " .  $getdata->error . "<br>";
                }
                ?>
          
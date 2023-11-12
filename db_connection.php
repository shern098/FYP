<?php
// Database configuration
$servername = "localhost"; // Replace with your database server name or IP address
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "dbsn"; // Replace with your database name

// Create a connection to the database
$conn = mysqli_connect ($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


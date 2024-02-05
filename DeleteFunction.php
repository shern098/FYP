
<?php
session_start();

// Include the database connection file
include("db_connection.php");

// Get id parameter value from URL and validate it
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id === null) {
    // Handle invalid or missing 'id' parameter
    die("Invalid or missing 'id' parameter");
}

// Create a prepared statement
$stmt = $conn->prepare("DELETE FROM `tblpatient` WHERE id_patient = ?");

if ($stmt === false) {
    // Handle any error in preparing the statement
    die("Error in preparing the statement");
}

// Bind the parameter
$stmt->bind_param("s", $id);

// Execute the statement
if ($stmt->execute()) {

    // Redirect back to the form page with a success message in the URL
    $_SESSION['delete_success'] = true;
    // Redirect to the main display page (index.php in our case) after successful deletion
    header("Location: WadEditOrder.php");
} else {
    // Handle the case where deletion failed
    die("Error in executing the statement: " . $stmt->error);
}

// Close the statement and the database connection
$stmt->close();
$mysqli->close();
?>

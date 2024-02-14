<?php
session_start();
// Include the database connection file
include 'connection.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve employee ID from the URL parameter
    $id = $_GET['id'];

    // SQL delete statement
    $sql = "DELETE FROM employees WHERE id = $id";

    // Execute the delete query
    if ($conn->query($sql) === TRUE) {
        $_SESSION['delete_success'] = true;
        // Redirect to admin dashboard after successful update
        header('Location: admindashboard.php');
        exit;
    } else {
        echo "Error deleting employee: " . $conn->error;
    }
} else {
    echo "Employee ID is not provided.";
}
?>

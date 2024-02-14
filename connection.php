<?php
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "crm_pscs"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "crm_pscs"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

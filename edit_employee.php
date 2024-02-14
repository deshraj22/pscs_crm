<?php
session_start();
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    // SQL update statement
    $sql = "UPDATE employees SET 
            name = '$name', 
            email = '$email', 
            mobile = '$mobile', 
            state = '$state', 
            city = '$city', 
            address = '$address', 
            pincode = '$pincode' 
            WHERE id = $id";

    // Execute the update query
    if ($conn->query($sql) === TRUE) {
        $_SESSION['update_success'] = true;
        // Redirect to admin dashboard after successful update
        header('Location: admindashboard.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve employee ID from the URL parameter
    $id = $_GET['id'];

    // Fetch existing employee data based on the provided ID
    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = $conn->query($sql);

    // Check if a record is found
    if ($result->num_rows > 0) {
        // Fetch employee data
        $employee = $result->fetch_assoc();
    } else {
        echo "No employee found with the provided ID.";
        exit;
    }
} else {
    echo "Employee ID is not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="container mt-5">
        <h1>Edit Employee</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Hidden input field to pass employee ID -->
            <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">

            <!-- Include input fields for editing employee data with Bootstrap form control -->
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $employee['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $employee['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile:</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $employee['mobile']; ?>">
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State:</label>
                <input type="text" class="form-control" id="state" name="state" value="<?php echo $employee['state']; ?>">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $employee['city']; ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $employee['address']; ?>">
            </div>
            <div class="mb-3">
                <label for="pincode" class="form-label">Pincode:</label>
                <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo $employee['pincode']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z8FJ0pbTP7rUKJL5W0Etx/2Oln0u1SZwL5m+Jf" crossorigin="anonymous"></script>
</body>
</html>

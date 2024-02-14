<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .bn632-hover {
  width: 160px;
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  margin: 20px;
  height: 55px;
  text-align:center;
  border: none;
  background-size: 300% 100%;
  border-radius: 50px;
  moz-transition: all .4s ease-in-out;
  -o-transition: all .4s ease-in-out;
  -webkit-transition: all .4s ease-in-out;
  transition: all .4s ease-in-out;
}

.bn632-hover:hover {
  background-position: 100% 0;
  moz-transition: all .4s ease-in-out;
  -o-transition: all .4s ease-in-out;
  -webkit-transition: all .4s ease-in-out;
  transition: all .4s ease-in-out;
}

.bn632-hover:focus {
  outline: none;
}

.bn632-hover.bn23 {
  background-image: linear-gradient(
    to right,
    #009245,
    #fcee21,
    #00a8c5,
    #d9e021
  );
  box-shadow: 0 4px 15px 0 rgba(83, 176, 57, 0.75);
}
    </style>
</head>
<body>
    <div class="container pt-2 mt-2" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; border:2px solid #7efff5">
        <h2 class="mt-4 mb-4 pt-2 pb-2" style="background-color:#4b4b4b;text-align:center;color:white">Employee Information Form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode:</label>
                <input type="text" class="form-control" id="pincode" name="pincode" required>
            </div>
            <div class="form-group">
                <label for="picture">Picture Upload:</label>
                <input type="file" class="form-control-file" id="picture" name="picture" required>
            </div>
            <button type="submit" class="bn632-hover bn23 mb-2" name="submit" style="margin-left:46%">Submit</button>
        </form>
        <?php
        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Retrieve form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $pincode = $_POST['pincode'];
            
            // File upload handling
            $targetDirectory = "uploads/"; // Directory where uploaded files will be stored
            $targetFile = $targetDirectory . basename($_FILES["picture"]["name"]); // Path of the uploaded file
        
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
                
                // SQL insert statement with the file path
                $sql = "INSERT INTO employees (name, email, mobile, state, city, address, pincode, picture) 
                        VALUES ('$name', '$email', '$mobile', '$state', '$city', '$address', '$pincode', '$targetFile')";
        
                // Execute the insert query
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                    Swal.fire({
                        title: 'Record inserted successfully!',
                        icon: 'success'
                    });
                  </script>";
                  header('location:admindashboard.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

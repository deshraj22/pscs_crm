\<?php
session_start();


if (isset($_POST['submit'])) {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'adminpassword') {
        $_SESSION['admin_logged_in'] = true;
        // Redirect to admin dashboard
        header('Location: admindashboard.php');
        exit;
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div class="col-10 col-sm-8 col-lg-6" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
          <form method="post" action="">
                <div class="mb-3 mt-5">
                  <label for="exampleInputEmail1" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required>
                
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-success mt-5 mb-4 w-100" name="submit">Login</button>
              </form>
          </div>
          <div class="col-lg-6">
            <img src="images/login.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
           
          </div>
        </div>
      </div>
   
  
  
</body>
</html>
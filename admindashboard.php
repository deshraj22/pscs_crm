
<?php
session_start();
include 'connection.php';
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
   
    header('Location: admin_login.php');
    exit;
}
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $json_data = json_encode($data);
} else {
    $json_data = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tiny.cloud/1/0r7d7mdii125um0xx26ehvbw3au5en0iqsr44ac2byu4d8yz/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <title>Chart Dashboard</title>
</head>
<style>
    body {
  background-color: #fbfbfb;
}
@media (min-width: 991.98px) {
  main {
    padding-left: 240px;
  }
}
/* datatables style */
.dataTables_filter {
    display: none;
}

#employeesTable thead th {
            background-color:#182C61; /* Set background color */
            color: #ffffff; /* Set text color */
        }
        #employeesTable tbody td {
            background-color: #dff9fb; /* Set background color */
            color: black; /* Set text color */
        }
/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 58px 0 0; /* Height of navbar */
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 240px;
  z-index: 600;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 100%;
  }
}
.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}
</style>
<body>
    <h6>DESHRAJ</h6>
<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white mt-4">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a
            href="#"
            class="list-group-item list-group-item-action py-2 ripple"
            aria-current="true"
          >
          <a href="/" class="list-group-item list-group-item-action py-2 ripple active">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>Main Dashboard</span>
          </a>
          </a>
          <a href="/alldataview" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>All Data</span>
          </a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-lock fa-fw me-3"></i><span>Manage Admin</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-chart-line fa-fw me-3"></i><span>Sales</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
          </a>
          <a href="/orders" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-globe fa-fw me-3"></i><span>International</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-building fa-fw me-3"></i><span>Partners</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-headset fa-fw me-3"></i><span>Support</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-users fa-fw me-3"></i><span>Users</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-money-bill fa-fw me-3"></i><span>Sales</span></a
          >
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #706fd3;">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>
  
        <!-- Brand -->
        <a class="navbar-brand" href="/">
          <img
          src="https://cdn1.vectorstock.com/i/1000x1000/36/60/up-business-chart-logo-designs-vector-27463660.jpg"
            height="60"
            alt="MDB Logo"
            loading="lazy"
          />
        </a>
        <!-- Search form -->
      <div class="text-center" style="text-align: center; font-size: 24px; font-weight: 900;color: #f7f1e3; margin-left: 40%;">Admin Dashboard</div>
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->
      
          <!-- Avatar -->
          <li class="nav-item dropdown" id="userprofile" style="margin-right: 80px;">
            <a
              class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
              href="#"
              id="navbarDropdownMenuLink"
              role="button"
              data-mdb-toggle="dropdown"
              aria-expanded="false"
            >
              <img
                src="images/admin.png"
                class="rounded-circle"
                height="55"
                alt="Avatar"
                loading="lazy"
              />
            </a>
            <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDropdownMenuLink"
              id="userprofile_dropdown"
            >
              <li>
                <a class="dropdown-item" href="#">My profile</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Settings</a>
              </li>
              <li>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->
  
  <!--Main layout-->
  <main style="margin-top: 58px;">
    <div class="container pt-4">
    <div class="text-end mb-3">
            <a href="add_employee.php" class="btn" style="background-color:#079992"><i class="fas fa-plus"></i> Add Employee</a>
        </div>
<!-- Display data in DataTables -->
<div class="search_div w-25" style="float:right"><input type="text" id="search" class="form-control" placeholder="Type to Search" style="background-color:#d1d8e0"></div>  
<table id="employeesTable" class="display">
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>State</th>
        <th>City</th>
        <th>Address</th>
        <th>Pincode</th>
        <th>Picture</th>
        <th>Actions</th> <!-- Add a new column for actions -->
    </tr>
</thead>
    <tbody>
        <!-- DataTables content will be populated here -->
    </tbody>
</table>

<!-- Include necessary JavaScript files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#employeesTable').DataTable({
        data: <?php echo $json_data; ?>,
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'mobile' },
            { data: 'state' },
            { data: 'city' },
            { data: 'address' },
            { data: 'pincode' },
            {
                data: 'picture',
                render: function(data, type, row) {
                  return '<a href="' + data + '" target="_blank"><img src="' + data + '" alt="Employee Image" style="max-width: 150px; max-height: 100px;"></a>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<button class="btn btn-sm btn-primary" onclick="editEmployee(' + data.id + ')"><i class="fas fa-edit"></i> Edit</button>' +
                           '<button class="btn btn-sm btn-danger mt-2" onclick="deleteEmployee(' + data.id + ')"><i class="fas fa-trash"></i> Delete</button>';
                }
            }
        ],
       
    });
});
$('.dataTables_filter').detach();
$('#search').keyup(function() {
    var table = $('#employeesTable').DataTable();
    table.search($(this).val()).draw();
});
// Function to handle edit employee action
function editEmployee(id) {
   
    window.location.href = 'edit_employee.php?id=' + id;
}

// Function to handle delete employee action
function deleteEmployee(id) {
    if (confirm('Are you sure you want to delete this employee?')) {
        window.location.href = 'delete_employee.php?id=' + id;
    }
}
</script>

    </div>
    <?php 

if (isset($_SESSION['update_success']) && $_SESSION['update_success'] === true) {
    echo "<script>
                Swal.fire({
                    title: 'Employee details updated!',
                    icon: 'success'
                });
              </script>";
    unset($_SESSION['update_success']);
}
if (isset($_SESSION['delete_success']) && $_SESSION['delete_success'] === true) {
    echo "<script>
                Swal.fire({
                    title: 'Employee details deleted!',
                    icon: 'success'
                });
              </script>";
              unset($_SESSION['delete_success']);
}
 ?>
 </main>
  <!--Main layout-->
  <script>
    $(document).ready(function(){
      $("#manageproducts_sub").hide();
      $("#userprofile").click(function(){
        $("#userprofile_dropdown").toggle();
      });
      $("#manageproducts").click(function(){
   $("#manageproducts_sub").toggle();
      });
    });
    </script>
</body>
</html>



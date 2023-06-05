<?php
session_start();
include("..\..\config.php");

if (!isset($_SESSION["username"])) {
header("Location:..\samples\login.php", "_SELF");
}
else{
$username=$_SESSION["username"];

$get_user="SELECT * FROM adminreg WHERE username='$username'";
$run_user=mysqli_query($conn, $get_user);


$row_user=mysqli_fetch_array($run_user);

$username=$row_user["username"];
$firstname=$row_user["firstname"];
$lastname=$row_user["lastname"];
$userimage=$row_user["userimage"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>1711 Delivered Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/newimg/logo.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><h4>1711 Delivered.</h4></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><p>1711<p></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <p>Instagram: @fredthedev</p>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-lg-flex d-none">
                <a href="../../pages/samples/register.php"><button type="button" class="btn btn-info font-weight-bold">+ Create New Admin</button></a>
            </li>
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>
              <a class="dropdown-item preview-item" href="../../pages/samples/profile.php">               
                  <i class="icon-head"></i> Profile
              </a>
              <a class="dropdown-item preview-item" href="../../logout.php">
                  <i class="icon-inbox"></i> Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            <img src="../../images/imgAdmins/<?php echo "$userimage";?>">
          </div>
          <div class="user-name">
              <?php echo "$lastname";?> <?php echo "$firstname";?>
          </div>
          <div class="user-designation">
              Admin
          </div>

        </div>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../index.php">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-content-left menu-icon"></i>
              <span class="menu-title">Projects</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/rowdybproj.php">Rowdyb-Gwen</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/fatherscamp.php">4Fathers Ca...</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/beghofromthemat.php">Beghofromth...</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/lsdsht.php">Lsd Shoot...</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/evis.php">Evisu So...</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="../../pages/ui-features/viewusers.php">
              <i class="icon-eye menu-icon"></i>
              <span class="menu-title">View Users</span>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">          
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">1711 ADMINS</h4>
                  <p class="card-description">
                    Here is a list of 1711 delivered admins. To delete an admin account contact the developer 
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            User
                          </th>
                          <th>
                            First name
                          </th>
                          <th>
                            Last name
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Username
                          </th>
                        </tr>
                      </thead>
                      <?php

                        include ("..\..\config.php");
                        // Attempt select query execution
                        $sql = "SELECT * FROM adminreg";
                        $result = mysqli_query( $conn, $sql);

                        while($row = mysqli_fetch_array($result)){
                      ?>
                      <tbody>
                        <tr>
                          <td class="py-1">
                            <img src="../../images/imgAdmins/<?php echo $row['userimage']; ?>" alt="Admin image"/>
                          </td>
                          <td>
                            <?php echo $row['firstname']; ?>
                          </td>
                          <td>
                            <?php echo $row['lastname']; ?>
                          </td>
                          <td>
                            <?php echo $row['email']; ?>
                          </td>
                          <td>
                            <?php echo $row['username']; ?>
                          </td>
                        </tr>
                      </tbody>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © fredthedev 2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Check out Toon Tumblr</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <!-- endinject -->
    <!-- plugin js for this page -->
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
</body>

</html>
<?php } ?>
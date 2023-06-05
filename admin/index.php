<?php
session_start();
include("config.php");

if (!isset($_SESSION["username"])) {
header("Location: pages/samples/login.php", "_SELF");
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
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->

  <!-- End plugin css for this page -->
  <!-- inject:css -->  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/newimg/logo.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
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
                <a href="pages/samples/register.php"><button type="button" class="btn btn-info font-weight-bold">+ Create New Admin</button></a>
            </li>
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>
              <a href="pages/samples/profile.php" class="dropdown-item preview-item">               
                  <i class="icon-head"></i> Profile
              </a>
              <a href="logout.php"class="dropdown-item preview-item">
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
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            <img src="images/imgAdmins/<?php echo "$userimage";?>">
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
            <a class="nav-link" href="index.php">
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
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/rowdybproj.php">Rowdyb-Gwen</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/fatherscamp.php">4Fathers Ca...</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/beghofromthemat.php">Beghofromth...</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/lsdsht.php">Lsd Shoot...</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/evis.php">Evisu So...</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/ui-features/viewusers.php">
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
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">Hi, welcome back!</h4>
              <p class="font-weight-normal mb-2 text-muted"><?php echo "$firstname";?></p>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-xl-3 flex-column d-flex grid-margin stretch-card">
              <div class="row flex-grow">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <?php

                        include ("config.php");
                        // Attempt select query execution
                        $sql = "SELECT count(*) as total FROM adminreg";
                        $result = mysqli_query( $conn, $sql);
                        while($data = mysqli_fetch_assoc($result)){
                      ?>
                          <h4 class="card-title">No. of Admins</h4>
                          <p>1711 Delivered Administrators</p>
                          <h4 class="text-dark font-weight-bold mb-2"><?php echo $data['total']; ?></h4>
                          <?php } ?>
                      </div>
                    </div>
                </div>
                <div class="col-sm-12 stretch-card">
                    <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Contact the devil</h4>
                          <p>hehehe, contact the developer!</p>
                          <h4 class="card-title">Email:</h4>
                          <p>success_fred@yahoo.com</p>
                          <h4 class="card-title">Instagram:</h4>
                          <p>fredthedev</p>
                          <h4 class="card-title">Whatsapp</h4>
                          <p>+2347055277151</p>
                      </div>
                    </div>
               </div>
              </div>
            </div>
            <div class="col-xl-9 d-flex grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Top Projects</h4>
                    <div class="table-responsive mt-3">
                      <table class="table table-header-bg">
                        <thead>
                          <tr>
                            <th>
                                Projects
                            </th>
                            <th>
                                No. of Images
                            </th>     
                          </tr>
                        </thead>


                        <tbody>
                          <tr>
                            <td>
                              <i class="icon-head  flag-icon-us mr-2" title="us" id="us"></i> Rowdyb-Gwen 
                            </td>
                            <?php
                              include ("config.php");
                              // Attempt select query execution
                              $sql = "SELECT count(*) as total FROM rowdybimg";
                              $result = mysqli_query( $conn, $sql);
                              while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <td>
                              <?php echo $data['total']; ?>
                            </td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>
                              <i class="icon-head  flag-icon-us mr-2" title="us" id="us"></i> 4fathers Campaign 
                            </td>
                            <?php
                              include ("config.php");
                              // Attempt select query execution
                              $sql = "SELECT count(*) as total FROM fatherscampimg";
                              $result = mysqli_query( $conn, $sql);
                              while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <td>
                              <?php echo $data['total']; ?>
                            </td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>
                              <i class="icon-head  flag-icon-us mr-2" title="us" id="us"></i> Beghofromthematrix-twofaced 
                            </td>
                            <?php
                              include ("config.php");
                              // Attempt select query execution
                              $sql = "SELECT count(*) as total FROM beghoimg";
                              $result = mysqli_query( $conn, $sql);
                              while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <td>
                              <?php echo $data['total']; ?>
                            </td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>
                              <i class="icon-head  flag-icon-us mr-2" title="us" id="us"></i> Evisu song cover 
                            </td>
                            <?php
                              include ("config.php");
                              // Attempt select query execution
                              $sql = "SELECT count(*) as total FROM evisimg";
                              $result = mysqli_query( $conn, $sql);
                              while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <td>
                              <?php echo $data['total']; ?>
                            </td>
                            <?php } ?>
                          </tr>

                          <tr>
                            <td>
                              <i class="icon-head  flag-icon-us mr-2" title="us" id="us"></i> Lsd Shoot 
                            </td>
                            <?php
                              include ("config.php");
                              // Attempt select query execution
                              $sql = "SELECT count(*) as total FROM lsdshootimg";
                              $result = mysqli_query( $conn, $sql);
                              while($data = mysqli_fetch_assoc($result)){
                            ?>
                            <td>
                              <?php echo $data['total']; ?>
                            </td>
                            <?php } ?>
                          </tr>

                          
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
          </div>
          
        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © fredthedev 2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Check out Toon Tumblr</span>
          </div>
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block mt-2">Requested by: <a href="#" > Ibekwe Chigozirim</a></span> 
        </footer>
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js 1 2 3-->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
<?php } ?>

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

<?php

include("..\..\config.php");

$errMsg="";
if (isset($_POST["subdesc"])) {

  $title=$_POST["title"];
  $description=$_POST["description"];


  if (($title=="") || ($description=="") ){
    $errMsg="A field or more is empty";
  }


  else{

    $insert_rowdybtext="INSERT INTO rowdybtext (title, description) VALUES('$title','$description')";
    $run_rowdybtext=mysqli_query($conn,$insert_rowdybtext);

    if ($run_rowdybtext) {
      header("Location: rowdybproj.php");
      exit;
    }

  }
}
?>


<?php
include("..\..\config.php");

$errMsg="";
if (isset($_POST["submit"])) {

  $altimage=$_POST["altimage"];
  $rowdyimage=$_FILES["rowdyimage"]["name"];


  $imgRowdy="../../images/imgRowdy";


  if (!file_exists($imgRowdy)) {
    mkdir($imgRowdy);
  }

  $temp_file=$_FILES["rowdyimage"]["tmp_name"];
  $allowed_format = array("jpg" ,"png", "jpeg","PNG","JPG","JFIF","jfif","webp");
  $targetFilePath=($imgRowdy.basename($rowdyimage));
  $file_type=pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if (($altimage=="")){
    $errMsg="A field is empty";
  }

  if (empty($rowdyimage)) {
    $errMsg="The image field is empty";
  }

  elseif (!in_array ($file_type, $allowed_format)) {
    $errMsg="Invalid file format";
  }

  else{
    move_uploaded_file($temp_file, "$imgRowdy/$rowdyimage");

    $insert_rowdybimage="INSERT INTO rowdybimg (altimage, rowdyimage) VALUES('$altimage','$rowdyimage')";
    $run_rowdybimage=mysqli_query($conn,$insert_rowdybimage);

    if ($run_rowdybimage) {
      header("Location: rowdybproj.php");
      exit;
    }

  }

}


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
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Rowdyb-Gwen</h4>
                  <p class="card-description">
                    Add Descriptions and images to the "Rowdyb-Gwen" page
                  </p>
                  <form class="forms-sample" enctype="multipart/form-data" method="POST">
                    <?php
                      if ($errMsg=="") {
                        echo "";
                      }
                      else{
                        echo "<div class='alert alert-danger'>
                        $errMsg
                        </div>";
                      }
                    ?>
                    <div class="form-group">
                      <label for="exampleInputName1">Title</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="title" placeholder="e.g. Rowdyb-Gwen">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Description</label>
                      <textarea class="form-control" id="exampleTextarea1" maxlength="1200" rows="6" name="description" placeholder="e.g. Rowdyb-Gwen is art in it's finest form..."></textarea>
                    </div>
                    <p>NOTICE: After providing the title and description, click on submit below. A page can have only one description. To edit a description delete it from the table then create a new one. Yes i'm lazy and i will not create an edit button/function... You can upload multiple images below</p>
                    <button type="submit" class="btn btn-primary mr-2" onclick="return mess();" name="subdesc">Submit</button>
                    <div class="form-group"></div>
                    <h4>Upload Images</h4>
                    <div class="form-group">
                      <label for="rowdyupload">Upload images for rowdy-b gallery</label>
                      <input type="file" id="rowdyupload"  class="form-control" name="rowdyimage">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Alt text</label>
                      <input type="text" name="altimage" class="form-control" id="exampleInputCity1" placeholder="give a brief description about your image, it helps those who use screen readers(blind people) and improves SEO">
                    </div>
          
                    <button type="submit" name="submit" class="btn btn-primary mr-2" onclick="return mess();">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                  <script type="text/javascript">
                      function mess(){
                        alert("your record is sucessfully saved");
                        return true;
                      }
                  </script>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Description Table</h4>
                  <p class="card-description">
                    View or delete the description in "Rowdyb-Gwen" content below
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <?php

                        include ("..\..\config.php");
                        // Attempt select query execution
                        $sql = "SELECT * FROM rowdybtext";
                        $result = mysqli_query( $conn, $sql);

                        while($row = mysqli_fetch_array($result)){
                      ?>
                      <tbody>
                        <tr>
                          <td><?php echo $row['title']; ?></td>
                          <td><?php echo $row['description']; ?></td>
                          <td><a href="deleterowdy.php?id=<?php echo $row['id'];?>" style="color:black;">Delete</a></td>
                        </tr>
                      </tbody>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Gallery Table</h4>
                  <p class="card-description">
                    View or delete images in the "Rowdyb-Gwen" content below
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Alt Text</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <?php

                        include ("..\..\config.php");
                        // Attempt select query execution
                        $sql = "SELECT * FROM rowdybimg";
                        $result = mysqli_query( $conn, $sql);

                        while($row = mysqli_fetch_array($result)){
                      ?>
                      <tbody>
                        <tr>
                          <td><img src="../../images/imgRowdy/<?php echo $row['rowdyimage']; ?>"></td>
                          <td><?php echo $row['altimage']; ?></td>
                          <td><a href="deleterowdyimg.php?id=<?php echo $row['id'];?>" style="color:black;">Delete</a></td>
                        </tr>
                        <tr>            
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
<?php
session_start();
include("..\..\config.php");

if (!isset($_SESSION["username"])) {
header("Location:login.php", "_SELF");
}
else{
$username=$_SESSION["username"];


$get_user="SELECT * FROM adminreg WHERE username='$username'";
$run_user=mysqli_query($conn, $get_user);


$row_user=mysqli_fetch_array($run_user);

$username=$row_user["username"];

?>


<?php
error_reporting(E_ALL ^ E_NOTICE);
include("..\..\config.php");

$errMsg="";

if (isset($_POST["submit"])) {

  $firstname=$_POST["firstname"];
  $lastname=$_POST["lastname"];
  $email=$_POST["email"];
  $username=$_POST["username"];
  $userimage=$_FILES["userimage"]["name"];
  $password=$_POST["password"];

  //check if user already exists
  $select_reg="SELECT * FROM adminreg WHERE username='$username'";
  $run_check=mysqli_query($conn,$select_reg);
  $count_reg=mysqli_num_rows($run_check);

  $imgAdmins="../../images/imgAdmins";


  if (!file_exists($imgAdmins)) {
    mkdir($imgAdmins);
  }

  $temp_file=$_FILES["userimage"]["tmp_name"];
  $allowed_format = array("jpg" ,"png", "jpeg","PNG","JPG","JFIF","jfif","webp");
  $targetFilePath=($imgAdmins.basename($userimage));
  $file_type=pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if (($firstname=="") || ($lastname=="") || ($email=="") || ($username=="") || ($password=="") ){
    $errMsg="A field or more is empty";
  }

  if (empty($userimage)) {
    $errMsg="The image field is empty";
  }

  elseif (!in_array ($file_type, $allowed_format)) {
    $errMsg="Invalid file format";
  }

  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errMsg="This is an invalid email";
  }

  elseif($count_reg!=0){
    $errMsg="This admin already exists";
  }

  else{
    move_uploaded_file($temp_file, "$imgAdmins/$userimage");
    $insert_adminreg="INSERT INTO adminreg (firstname, lastname, email, username, userimage, password) VALUES('$firstname','$lastname','$email', '$username', '$userimage','$password')";
    $run_adminreg=mysqli_query($conn,$insert_adminreg);

    if ($run_adminreg){
    header("Location: login.php", "_SELF");
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
  <title>1711 DELIVERED Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/newimg/logo.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo" style="margin-bottom:0 !important;">
                <img src="../../images/newimg/logo.png" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Creating an account is easy. It only takes a few steps</h6>
              <form class="pt-3" method="POST" enctype="multipart/form-data">
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
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Firstname" name="firstname">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Lastname" name="lastname">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username" name="username">
                </div>

                <div class="form-group">
                    <label for="adereupload">Upload profile image</label>
                      <input type="file" id="adereupload"  class="form-control" name="userimage">
                </div>
                
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" style="background-color:black; border: none;" href="" >Register</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary" style="color:lightgray !important;">Login</a>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
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

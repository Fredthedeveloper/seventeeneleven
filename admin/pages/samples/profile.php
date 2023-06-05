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


$id=$row_user["id"];
$firstname=$row_user["firstname"];
$lastname=$row_user["lastname"];
$username=$row_user["username"];
$email=$row_user["email"];
$userimage=$row_user["userimage"];


?>

<?php


$errMsg="";

if (isset($_POST["update"])) {

  $firstname=$_POST["firstname"];
  $lastname=$_POST["lastname"];
  $email=$_POST["email"];
  $username=$_POST["username"];
  $profileimage=$_FILES["profileimage"]["name"];


  $imgAdmins="../../images/imgAdmins";


  if (!file_exists($imgAdmins)) {
    mkdir($imgAdmins);
  }

  $temp_file=$_FILES["profileimage"]["tmp_name"];
  $allowed_format = array("jpg" ,"png", "jpeg","PNG","JPG","JFIF","jfif","webp");
  $targetFilePath=($imgAdmins.basename($profileimage));
  $file_type=pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if (($firstname=="") || ($lastname=="") || ($email=="") || ($username=="") ){
    $errMsg="A field or more is empty";
  }

  if (empty($profileimage)) {
    $errMsg="The image field is empty";
  }

  elseif (!in_array ($file_type, $allowed_format)) {
    $errMsg="Invalid file format";
  }

  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errMsg="This is an invalid email";
  }

  else{
    move_uploaded_file($temp_file, "$imgAdmins/$profileimage");
    $update_adminreg="UPDATE adminreg SET firstname ='$firstname', lastname ='$lastname', username ='$username', email ='$email', userimage ='$profileimage' WHERE id='$id'";
    $run_adminreg=mysqli_query($conn,$update_adminreg);

    if ($run_adminreg){
      header("Location:../../logout.php", "_SELF");
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
  <title>1711 DELIVERED ADMIN</title>
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
      <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-transparent text-left p-5 text-center">
              <img src="../../images/imgAdmins/<?php echo "$userimage";?>" class="lock-profile-img" alt="img">
              <form class="pt-5" enctype="multipart/form-data" method="POST">
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
                  <label for="exampleInputName1">You can edit your profile by entering new info into the input field below</label>
                  <input type="text" value="<?php echo "$firstname";?>" class="form-control text-center" style="color:black !important;" id="exampleInputName1" name="firstname" placeholder="Firstname">
                </div>

                <div class="form-group">
                  <input type="text" value="<?php echo "$lastname";?>" class="form-control text-center" style="color:black !important;" id="exampleInputUsername1" name="lastname" placeholder="Lastname">
                </div>

                <div class="form-group">
                  <input type="email" value="<?php echo "$email";?>" class="form-control text-center" style="color:black !important;" id="exampleInputEmail1" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                  <input type="text" value="<?php echo "$username";?>" name="username" class="form-control text-center" style="color:black !important;" id="exampleInputName1" placeholder="Username">
                </div>

                <div class="form-group">
                      <label for="profileupload">Upload new image for profile</label>
                      <input type="file"  id="profileupload" value="<?php echo "$userimage";?>"  class="form-control" name="profileimage">
                </div>

                <label  for="exampleInputName1">Note: Contact the Admin to change your Password</label>
                <div class="mt-5">
                  <button class="btn btn-block btn-info  btn-lg font-weight-medium"  name="update" style="background-color:black; border:none; box-shadow: none;">Update</button>
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

<?php
  include("..\..\config.php");
  session_start();
  $errMsg="";

  if (isset($_POST["submit"])) {
    $username=$_POST["username"];
    $password=$_POST["password"];
  
    $select_user="SELECT * FROM adminreg WHERE username='$username' AND password='$password'";
    $run_user=mysqli_query($conn, $select_user);
    $count_user=mysqli_num_rows($run_user);

    if (($username=="") ||  ($password=="") ){
      $errMsg="A field or more is empty";
    }
    elseif ($count_user==0) {
      $errMsg="Admin account does not exist";
    }
    else{
      $_SESSION["username"]=$username;
      header("Location: ../../index.php", "_SELF");
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
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo" style="margin-bottom: 0; margin-top: 0;">
                <img src="../../../images/logo.png" alt="logo" style="width:50%; ">
              </div>
              <h4>Welcome back, 1711 Delivered Admin</h4>
              <h6 class="font-weight-light">Happy to see you again!</h6>
              <form class="pt-3" method="POST">
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
                  <label for="exampleInputEmail">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary" style="color: black !important;"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="exampleInputText" placeholder="Username" name="username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary" style="color: black !important;"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password" name="password">                        
                  </div>
                </div>
                
                <div class="my-3">
                  <button class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" style="background-color: black; border: none;" name="submit">LOGIN</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row" >
            <p class="text-black font-weight-medium text-center flex-grow align-self-end">Copyright &copy; Fredthedevil.</p>
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
</body>

</html>

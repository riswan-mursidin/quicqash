<?php 
include_once "helpper/function.php";

if($_SESSION['login_admin_fina'] == true){
  header('Location:index');
  exit();
}

$error_status = "";

if(isset($_POST['login_auth'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $table = "admin_fina";
  $fieldparam = "username";

  $chech_username = querySelectOne($table, $fieldparam, $username);
  if(mysqli_num_rows($chech_username) == 0){
    $error_status = "Login Failed";
  }else{
    $row_admin = mysqli_fetch_assoc($chech_username);
    $dbpassword = $row_admin['password'];
    if(!password_verify($password, $dbpassword)){
      $error_status = "Login Failed";
    }else{
      $_SESSION['login_admin_fina'] = true;
      $_SESSION['username_admin_fina'] = $row_admin['username'];
      header('Location:index');
      exit();
    }
  } 
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | LOGIN ADMIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      content="Premium Multipurpose Admin & Dashboard Template"
      name="description"
    />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- Bootstrap Css -->
    <link
      href="assets/css/bootstrap.min.css"
      id="bootstrap-style"
      rel="stylesheet"
      type="text/css"
    />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link
      href="assets/css/app.min.css"
      id="app-style"
      rel="stylesheet"
      type="text/css"
    />
  </head>

  <body class="bg-pattern">
    <div class="bg-overlay"></div>
    <div class="account-pages my-5 pt-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-4 col-lg-6 col-md-8">
            <div class="card">
              <div class="card-body p-4">
                <div class="">
                  <div class="text-center">
                    <a href="index.html" class="">
                      <img
                        src="assets/images/logo-dark.png"
                        alt=""
                        height="24"
                        class="auth-logo logo-dark mx-auto"
                      />
                      <img
                        src="assets/images/logo-light.png"
                        alt=""
                        height="24"
                        class="auth-logo logo-light mx-auto"
                      />
                    </a>
                  </div>
                  <!-- end row -->
                  <h4 class="font-size-18 text-muted mt-2 text-center">
                    ADMINISTRATOR LOGIN
                  </h4>
                  <p class="mb-5 text-center">
                    Sign in to continue to FINACOIN.
                  </p>
                  <form class="form-horizontal" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off">
                    <div class="row">

                    <div class="col-md-12">
                    <?php if($error_status != ""){ ?>
                      <div class="mb-4">
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          <?= $error_status ?>
                        </div>
                      </div>
                    <?php } ?>

                        <div class="mb-4">
                          <label class="form-label" for="username" >Username</label>
                          <input type="text" class="form-control" value="<?= $_POST['username'] ?>"  name="username" id="username" placeholder="Enter username"/>
                        </div>

                        <div class="mb-4">
                          <label class="form-label" for="userpassword" >Password</label>
                          <input type="password" class="form-control" value="<?= $_POST['password'] ?>" name="password" id="userpassword" placeholder="Enter password" />
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="form-check">
                              <input
                                type="checkbox"
                                class="form-check-input"
                                id="customControlInline"
                              />
                              <label
                                class="form-label"
                                class="form-check-label"
                                for="customControlInline"
                                >Remember me</label
                              >
                            </div>
                          </div>
                          <div class="col-7">
                            <div class="text-md-end mt-3 mt-md-0">
                              <a href="#" class="text-muted"
                                ><i class="mdi mdi-lock"></i> Forgot your
                                password?</a
                              >
                            </div>
                          </div>
                        </div>

                        <div class="d-grid mt-4">
                          <button class="btn btn-primary waves-effect waves-light" name="login_auth" type="submit">
                            Log In
                          </button>
                        </div>

                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="mt-5 text-center">
              
              <p class="text-white-50">
                ??
                <script>
                  document.write(new Date().getFullYear());
                </script>
                FINACOIN
              </p>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
    </div>
    <!-- end Account pages -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>
  </body>
</html>
<?php mysqli_close($conn) ?>
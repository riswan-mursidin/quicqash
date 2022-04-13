<?php  
require_once "helpper/function.php";

if($_SESSION['login_user_fina'] != true){
  header('Location:auth-login');
  exit();
}

$querylogin = "SELECT * FROM member_fina WHERE username_member='".$_SESSION['username_user']."'";
$resultlogin = mysqli_query($conn, $querylogin);
$rowlogin = mysqli_fetch_assoc($resultlogin);
$fullname = $rowlogin['nama_lengkap_member'];
$email = $rowlogin['email_member'];
$username = $rowlogin['username_member'];
$status = $rowlogin['status_member'];
$fina = $rowlogin['fnc_member'];
$no = $rowlogin['number_phone_member'];

$success_status = "";
$error_status = "";
if(isset($_POST['update_pass'])){
  $oldpass = $_POST['oldpass'];
  $newpass = password_hash($_POST['newpass'], PASSWORD_DEFAULT);
  if(password_verify($oldpass, $rowlogin['password_member'])){
    $query = "UPDATE member_fina SET password_member='$newpass' WHERE username_member='$username'";
    $result = mysqli_query($conn, $query);
    if($result){
      $success_status = "Change password is successfuly";
    }
  }else{
    $error_status = "Password is Wrong!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | Edit Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="finacoin" name="description" />
    <meta content="galeriide" name="author" />
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
    <script type="text/javascript">
            function showTime() {
                var a_p = "";
                var today = new Date();
                var curr_hour = today.getHours();
                var curr_minute = today.getMinutes();
                var curr_second = today.getSeconds();
                if (curr_hour < 12) {
                    a_p = "AM";
                } else {
                    a_p = "PM";
                }
                if (curr_hour == 0) {
                    curr_hour = 12;
                }
                if (curr_hour > 12) {
                    curr_hour = curr_hour - 12;
                }
                curr_hour = checkTime(curr_hour);
                curr_minute = checkTime(curr_minute);
                curr_second = checkTime(curr_second);
                document.getElementById('time').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
            }
            
            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
            setInterval(showTime, 500);         
    </script>
  </head>

  <style>
    body {
      background-image: url(./assets/bg-body.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
  </style>

  <body data-sidebar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
      <header id="page-topbar">
        <div class="navbar-header">
          <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box text-center">
              <a href="index" class="logo logo-dark">
                <span class="logo-sm">
                  <img
                    src="assets/images/logo-sm.png"
                    alt="logo-sm-dark"
                    height="22"
                  />
                </span>
                <span class="logo-lg">
                  <img
                    src="assets/images/logo-dark.png"
                    alt="logo-dark"
                    height="24"
                  />
                </span>
              </a>

              <a href="index" class="logo logo-light">
                <span class="logo-sm">
                  <img
                    src="assets/images/logo-sm.png"
                    alt="logo-sm-light"
                    height="22"
                  />
                </span>
                <span class="logo-lg">
                  <img
                    src="assets/images/logo-light.png"
                    alt="logo-light"
                    height="24"
                  />
                </span>
              </a>
            </div>

            <button
              type="button"
              class="btn btn-sm px-3 font-size-24 header-item waves-effect"
              id="vertical-menu-btn"
            >
              <i class="ri-menu-2-line align-middle"></i>
            </button>
          </div>

          <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
              <button
                type="button"
                class="btn header-item noti-icon waves-effect"
                id="page-header-search-dropdown"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="ri-search-line"></i>
              </button>
              <div
                class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-search-dropdown"
              >
                <form class="p-3">
                  <div class="mb-3 m-0">
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Search ..."
                      />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                          <i class="ri-search-line"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
              <button
                type="button"
                class="btn header-item noti-icon waves-effect"
                data-toggle="fullscreen"
              >
                <i class="ri-fullscreen-line"></i>
              </button>
            </div>

            <?php require_once "user-aksi.php" ?>

            <div class="dropdown d-inline-block">
              <button
                type="button"
                class="btn header-item noti-icon right-bar-toggle waves-effect"
              >
                <i class="mdi mdi-cog"></i>
              </button>
            </div>
          </div>
        </div>
      </header>

      <?php require_once "menu.php" ?>

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content">
        <div class="page-content">
          <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
              <div class="col-12">
                <div
                  class="
                    page-title-box
                    d-sm-flex
                    align-items-center
                    justify-content-between
                  "
                >
                  <h4 class="mb-sm-0">Edit Password</h4>
                  <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item">
                        <span><b><?= date('D').", ".dateFormatter(date("Y-m-d")) ?></b> | <b id="time"></b></span>  
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <!-- end page title -->

            <!-- start row -->
            <div class="row">
              <div class="col-12">
              <?php if($error_status != ""){ ?>
                <div class="mb-4">
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?= $error_status ?>
                    </div>
                </div>
              <?php } ?>
              <?php if($success_status != ""){ ?>
                <div class="mb-4">
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?= $success_status ?>
                    </div>
                </div>
              <?php } ?>
                <div class="card">
                  <form class="card-body" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row mb-3">
                      <label for="oldpassword" class="col-sm-2 col-form-label">Old Password</label>
                      <div class="col-sm-6">
                        <input type="password" name="oldpass" class="form-control" id="oldpassword">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="newpassword" class="col-sm-2 col-form-label">New Password</label>
                      <div class="col-sm-6">
                        <input type="password" name="newpass" class="form-control" id="newpassword">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="confirmnewpassword" class="col-sm-2 col-form-label">Confirm New Password</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" id="confirmNewpassword">
                      </div>
                    </div>
                    <button class="btn btn-primary" name="update_pass">Update</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- end row -->
            
          </div>
          <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <script>
                  document.write(new Date().getFullYear());
                </script>
                © FINACOIN
              </div>
            </div>
          </div>
        </footer>
      </div>
      <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
      <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">
          <h5 class="m-0 me-2">Settings</h5>

          <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
            <i class="mdi mdi-close noti-icon"></i>
          </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
          <div class="form-check form-switch mb-3">
            <input
              class="form-check-input theme-choice"
              type="checkbox"
              id="light-mode-switch"
              checked
            />
            <label class="form-check-label" for="light-mode-switch"
              >Light Mode</label
            >
          </div>

          <div class="form-check form-switch mb-3">
            <input
              class="form-check-input theme-choice"
              type="checkbox"
              id="dark-mode-switch"
              data-bsStyle="assets/css/bootstrap-dark.min.css"
              data-appStyle="assets/css/app-dark.min.css"
            />
            <label class="form-check-label" for="dark-mode-switch"
              >Dark Mode</label
            >
          </div>

          <div class="form-check form-switch mb-5">
            <input
              class="form-check-input theme-choice"
              type="checkbox"
              id="rtl-mode-switch"
              data-appStyle="assets/css/app-rtl.min.css"
            />
            <label class="form-check-label" for="rtl-mode-switch"
              >RTL Mode</label
            >
          </div>
        </div>
      </div>
      <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <script>
        var password = document.getElementById("newpassword")
        var confirm_password = document.getElementById("confirmNewpassword");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
    </script>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>
  </body>
</html>

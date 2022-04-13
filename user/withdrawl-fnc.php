<?php  
require_once "helpper/function.php";

if($_SESSION['login_user_fina'] != true){
  header('Location:auth-login');
  exit();
}

$kategori = $_GET['kategori'];

if($kategori == "saldofnc" || $kategori == ""){
  header('Location:index');
  exit();
}

$q = array("saldobonus","saldoprofit");

$cek = 0;
for($i=0;$i<count($q);$i++ ){
  if($kategori == $q[$i]){
    $cek = 1;
  }
}
if($cek == 0){
  header('Location:index');
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
$sponsor = $rowlogin['sponsor_staking_member'];
$staking = $rowlogin['bonus_staking_member'];
$ecosystem = $rowlogin['ecosystem_member'];
$no = $rowlogin['number_phone_member'];

$success_status = "";
$error_status = "";

if(isset($_POST['wd_fina'])){
  $fnc = $_POST['fnc'];
  $bank = $_POST['bank'];
  $pin = $_POST['pin'];
  $kategoripost = $_POST['kategori'];

  if(password_verify($pin, $rowlogin['pin_transaksi_member'])){
    // bank
    $querybank = "SELECT pemilik_bank,nama_bank,rek_bank FROM bank_member_fina WHERE id='$bank'";
    $resultbank = mysqli_query($conn, $querybank);
    $rowbank = mysqli_fetch_assoc($resultbank);
    $atasnama = $rowbank['pemilik_bank'];
    $bank = $rowbank['nama_bank'];
    $rek = $rowbank['rek_bank'];

    // pembagian 60:40
    $queryhargaFnc = "SELECT amount_setting FROM setting_staking_fina WHERE id_setting='2'";
    $resultharga = mysqli_query($conn, $queryhargaFnc);
    $rowharga = mysqli_fetch_assoc($resultharga);
    $admin = $fnc * 0.05;
    $harga = $rowharga['amount_setting'] * 10000;


    $idr = $harga * ($fnc-$admin);

    $wd_idr = $idr * 0.6;
    $ecosystem = $idr - $wd_idr;

    $querywd = "INSERT INTO story_wd_fina (kategori_wd,username_wd,fullname_wd,bank_wd,no_rek_wd,fnc_wd,idr_wd,admin_wd,ecosystem_wd) VALUES('$kategoripost','$username','$atasnama','$bank','$rek','$fnc','$wd_idr','$admin','$ecosystem')";
    $resultwd = mysqli_query($conn, $querywd);
    if($resultwd){
      $success_status = "Wd is successfully, waiting to confirmation from admin. ";
    }
  }else{
    $error_status = "Pin is Wrong";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | Withdraw FNC</title>
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
                  <h4 class="mb-sm-0">Withdraw FNC</h4>
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
                    <?= $success_status ?><a href="wd-fnc">Check your withdraw in here!</a>
                    </div>
                </div>
              <?php } ?>
                <div class="card">
                  <div class="card-body">
                    <form action="" method="post" autocomplete="off">
                      <input type="hidden" name="kategori" value="<?= $kategori ?>">
                      <?php
                      $nominal = 0;  
                      if($kategori == "saldoprofit"){
                        $nominal = $staking;
                      }elseif($kategori == "saldobonus"){
                        $nominal = $sponsor;
                      }
                      ?>
                      <div class="row mb-1">
                        <label for="fnc" class="col-sm-2 col-form-label">Amount FNC</label>
                        <div class="col-sm-6">
                          <input type="number" max="<?= $nominal ?>" min="5" name="fnc" value="<?= $nominal ?>" step="0.000001" id="fnc" class="form-control">
                          <p class="text-warning mt-1" style="font-size: smaller;"><b><i>*minimum wd = 5 FNC</i></b></p>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="bank" class="col-sm-2 col-form-label">Bank Tujuan</label>
                        <div class="col-sm-6">
                          <select name="bank" id="bank" class="form-select">
                            <option value="" selected='selected' disabled>Select</option>
                            <?php  
                            $querybank = "SELECT * FROM bank_member_fina WHERE username_member ='$username'";
                            $resultbank = mysqli_query($conn, $querybank);
                            while($rowbank = mysqli_fetch_assoc($resultbank)){
                            ?>
                            <option value="<?= $rowbank['id'] ?>"><?= $rowbank['rek_bank']." ".$rowbank['nama_bank'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="pin" class="col-sm-2 col-form-label">Pin Transaksi</label>
                        <div class="col-sm-6">
                          <input type="password" name="pin" id="pin" class="form-control">
                        </div>
                      </div>
                      <button type="submit" name="wd_fina" class="btn btn-primary">Withdraw</button>
                    </form>
                  </div>
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


    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>
  </body>
</html>

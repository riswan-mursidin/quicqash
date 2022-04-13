<?php  
require_once "helpper/function.php";

if($_SESSION['login_user_fina'] != true){
  header('Location:auth-login');
  exit();
}

$url = "http://indodax.com/api/usdt_idr/ticker";
$json = file_get_contents($url);
$json_data = json_decode($json, true);
$usdt = $json_data["ticker"]["last"];

$querylogin = "SELECT * FROM member_fina WHERE username_member='".$_SESSION['username_user']."'";
$resultlogin = mysqli_query($conn, $querylogin);
$rowlogin = mysqli_fetch_assoc($resultlogin);
$fullname = $rowlogin['nama_lengkap_member'];
$username = $rowlogin['username_member'];
$status = $rowlogin['status_member'];
$fina = $rowlogin['fnc_member'];
$sponsor = $rowlogin['sponsor_staking_member'];
$staking = $rowlogin['bonus_staking_member'];
$ecosystem = $rowlogin['ecosystem_member'];

if(isset($_POST['proses_pay'])){
  $fnc = $_POST['fnc_coin'];
  $usdt = $_POST['usdt'];
  $idr = $fnc * 15000;
  $kode = "#TR".rand(10000,99999);
  $quereq = "INSERT INTO pembelian_fnc_fina (kode_pembelian, username_pembelian, nama_lengkap_pembelian, fnc_pembelian, usdt_pembelian, idr_pembelian) VALUES('$kode','$username', '$fullname', '$fnc', '$usdt', '$idr')";
  $result = mysqli_query($conn, $quereq);
}



$error_status = "";
if(isset($_POST['submit_pin'])){
  $pin = $_POST['pin'];

  $querycheckpin = "SELECT code_pin FROM pin_activation_fina WHERE code_pin='$pin' AND pemilik_pin='$username'";
  $resultcheckpin = mysqli_query($conn, $querycheckpin);
  $already = mysqli_num_rows($resultcheckpin);

  if($already == 0){
    $error_status = "Pin is Wrong";
  }else{
    $queryupdatepin = "UPDATE pin_activation_fina SET status_pin='Non Active' WHERE code_pin='$pin' AND pemilik_pin='$username'";
    $resultupdatepin = mysqli_query($conn, $queryupdatepin);
    if($resultupdatepin){
      $querymember = "UPDATE member_fina SET status_member='PAID' WHERE username_member='$username'";
      $resultmember = mysqli_query($conn, $querymember);
    }
  }
  
}

// WALLET QR
include "phpqrcode/qrlib.php"; 
$queryToken = "SELECT wallet_admin FROM admin_fina WHERE id='1'";
$resultToken = mysqli_query($conn, $queryToken);
$rowToken = mysqli_fetch_assoc($resultToken);
$token = $rowToken['wallet_admin'];
//isi qrcode jika di scan
$codeContents = $token; 

 //output gambar langsung ke browser, sebagai PNG

$tempdir = 'qr_code_file';
if(file_exists($tempdir."/adminwalet.png")){
  unlink($tempdir."/adminwalet.png");
}
QRcode::png($codeContents,$tempdir."/adminwalet.png", QR_ECLEVEL_H, 10, 10); 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | Dahsboard</title>
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
                  <h4 class="mb-sm-0">Dashboard</h4>

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
            <div class="modal fade" tabindex="-1" id="buy_fnc_coin" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title">Buy FNC </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?php  
                    $querysetting = "SELECT amount_setting FROM setting_staking_fina WHERE id_setting='2'";
                    $resultsetting = mysqli_query($conn, $querysetting);
                    $rowsetting = mysqli_fetch_assoc($resultsetting);
                    $price = $rowsetting['amount_setting']
                    ?>
                    <span><b>1 USDT : Rp.<?= number_format($usdt,2,",",".") ?></b></span><br>
                    <span><b>1 FNC : <?= $usdt = (($price*15000)/$usdt) ?> USDT</b></span><br>
                    <hr>
                    <div class="row g-3 mb-3">
                      <div class="col-4 col-sm-4">
                        <label for="fnc_coin" class="form-label">Coin FNC</label>
                        <input type="number" required id="fnc_coin" name="fnc_coin" class="form-control">
                      </div>
                      <div class="col-8 col-sm-8">
                        <label for="usdt" class="form-label">USDT</label>
                        <input type="number" id="usdtview" readonly class="form-control">
                        <input type="hidden" name="usdt" id="usdt" class="form-control">
                        <span style="font-size: 10px;">*Copy Nominal USDT to pay</span>
                      </div>
                    </div>
                    <div class="mb-3">
                      <button class="btn btn-primary" onclick="convertToUsdt()" type="button">Covert</button>
                    </div>
                    <div class="mb-3">
                      <span>Pembayaran Melalui Wallet: </span>
                      <img src="qr_code_file/adminwalet.png" class="img-fluid mx-auto d-block rounded-3 shadow-sm" alt="">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" value="<?= $token ?>">
                      <span style="font-size: 10px;">*Copy USDT Wallet</span>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" name="proses_pay">Proses</button>
                    <button class="btn btn-danger btn-sm" aria-label="Close">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
            <hr>
            <?php if($status == "PAID"){ ?>
            <div class="row">
              <div class="col-xl-12 col-sm-12">
                <div class="card text-center">
                  <span class="card-header"><h5>WELCOME <?= strtoupper($fullname)." (".strtoupper($username).")" ?></h5></span>
                  <div class="card-body">
                    <button type="button"  data-bs-toggle="modal" data-bs-target="#buy_fnc_coin" class="btn btn-success">BUY FNC</button>  REQUEST BUY FNC TO YOUR ACCOUNT
                  </div>
                    <!-- end card-body -->
                </div>
              </div>
            </div>
            <?php }else{ ?>
            <div class="row">
              <div class="col-xl-12 col-sm-12">
                <div class="card">
                  <div class="card-header"><h5>Activation Your Account</h5></div>
                  <form class="card-body" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="row g-3">
                      <div class="col col-sm-4">
                        <div class="form-floating mb-3">
                          <input type="text" name="pin" class="form-control" id="pin" placeholder="pin">
                          <label for="pin">Pin Activation</label>
                        </div>
                      </div>
                    </div>
                    <div class="row g-3">
                      <div class="col col-sm-1">
                        <button type="submit" name="submit_pin" class="btn btn-primary">SUBMIT</button>
                      </div>
                    </div>
                  </form>
                    <!-- end card-body -->
                </div>
              </div>
            </div>
            <?php } ?>
            
            <div class="row">
              <div class="col-xl-6 col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex text-muted">
                      <div class="flex-shrink-0 me-3 align-self-center">
                        <div class="avatar-md">
                          <div class="avatar-title bg-light rounded-circle p-2">
                            <img
                              src="assets/coin.png"
                              class="img-fluid mx-auto d-block"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <p class="mb-1">Saldo FNC</p>
                        <h5 class="mb-3">
                          <span class="text-info"><b><?= $fina ?> FNC</b></span>
                        </h5>
                        <a href="withdrawl-fnc?kategori=saldofnc">
                          <p class="text-truncate mb-0">
                            <span class="text-success me-2">
                              Withdrawl FNC
                              <i
                                class="ri-arrow-right-up-line align-bottom ms-1"
                              ></i
                            ></span>
                          </p>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- end card-body -->
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
              <div class="col-xl-6 col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex text-muted">
                      <div class="flex-shrink-0 me-3 align-self-center">
                        <div class="avatar-md">
                          <div class="avatar-title bg-light rounded-circle p-2">
                            <img
                              src="assets/coin.png"
                              class="img-fluid mx-auto d-block"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                      <?php  
                            $count = 0;
                            $todayy = date("Y-m-d");
                            $querystaking = "SELECT * FROM staking_member_fina WHERE member_staking='$username' ORDER BY tgl_staking DESC";
                            $Resultstaking = mysqli_query($conn, $querystaking);
                            while($rowStaking = mysqli_fetch_assoc($Resultstaking)){
                              $queryStory = "SELECT * FROM story_staking_fina WHERE id_staking='".$rowStaking['id_staking']."' AND  tgl_story='".$todayy."'";
                              $resultStory = mysqli_query($conn, $queryStory);
                              while($rowStory=mysqli_fetch_assoc($resultStory)){
                                $count += (double)$rowStory['fnc_story'];
                              }
                            }
                        ?>
                        <p class="mb-1">Profit Staking</p>
                        <h5 class="mb-3">
                          <span class="text-info">
                            <b><?= $staking = $staking != "" ? $staking." FNC" : "0 FNC" ?><span class="text-success me-2" style="font-size: smaller;">
                            | <?= $count ?> FNC Today
                            </span></b>
                          </span>
                        </h5>
                        <a href="withdrawl-fnc?kategori=saldoprofit">
                          <p class="text-truncate mb-0">
                            <span class="text-success me-2">
                              Withdrawl Profit
                              <i
                                class="ri-arrow-right-up-line align-bottom ms-1"
                              ></i
                            ></span>
                          </p>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- end card-body -->
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->

              <div class="col-xl-6 col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex text-muted">
                      <div class="flex-shrink-0 me-3 align-self-center">
                        <div class="avatar-md">
                          <div class="avatar-title bg-light rounded-circle p-2">
                            <img
                              src="assets/coin.png"
                              class="img-fluid mx-auto d-block"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <p class="mb-1">Ecosystem</p>
                        <h5 class="mb-3">
                          <span class="text-info"><b><?= $ecosystem = $ecosystem != "" ? "Rp.".number_format($ecosystem,2,".",",") : "Rp.0.00" ?></b></span>
                        </h5>
                        <a href="#"
                          ><p class="text-truncate mb-0">
                            <span class="text-success me-2">
                              History
                              <i
                                class="ri-arrow-right-up-line align-bottom ms-1"
                              ></i
                            ></span></p
                        ></a>
                      </div>
                    </div>
                  </div>
                  <!-- end card-body -->
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->

              <div class="col-xl-6 col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex text-muted">
                      <div class="flex-shrink-0 me-3 align-self-center">
                        <div class="avatar-md">
                          <div class="avatar-title bg-light rounded-circle p-2">
                            <img
                              src="assets/coin.png"
                              class="img-fluid mx-auto d-block"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <p class="mb-1">Total Bonus</p>
                        <h5 class="mb-3">
                          <span class="text-info"><b><?= $sponsor = $sponsor != "" ? $sponsor." FNC" : "0 FNC" ?></b></span>
                        </h5>
                        <a href="withdrawl-fnc?kategori=saldobonus"
                          ><p class="text-truncate mb-0">
                            <span class="text-success me-2">
                              Withdrawl Profit
                              <i
                                class="ri-arrow-right-up-line align-bottom ms-1"
                              ></i
                              ></span
                            >
                          </p></a
                        >
                      </div>
                    </div>
                  </div>
                  <!-- end card-body -->
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->

              <!-- end row -->
            </div>
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
    function convertToUsdt() {
      var fina = document.getElementById("fnc_coin");
      var usdt = document.getElementById("usdt");
      var usdtview = document.getElementById("usdtview");

      var hasil = fina.value * parseFloat("<?= $usdt ?>");

      usdt.value=hasil;
      usdtview.value=hasil;
    }
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

<?php  
require_once "helpper/function.php";

if($_SESSION['login_user_fina'] != true){
  header('Location:auth-login');
  exit();
}
$error_status = "";

$url = "http://indodax.com/api/usdt_idr/ticker";
$json = file_get_contents($url);
$json_data = json_decode($json, true);
$usdt = $json_data["ticker"]["last"];

$querymaxx = "SELECT * FROM max_stacking WHERE id='1'";
$resultmaxx = mysqli_query($conn, $querymaxx);
$rowmaxx = mysqli_fetch_assoc($resultmaxx);
$max = $rowmaxx['persen'];

$querylogin = "SELECT * FROM member_fina WHERE username_member='".$_SESSION['username_user']."'";
$resultlogin = mysqli_query($conn, $querylogin);
$rowlogin = mysqli_fetch_assoc($resultlogin);
$fullname = $rowlogin['nama_lengkap_member'];
$username = $rowlogin['username_member'];
$status = $rowlogin['status_member'];
$fina = $rowlogin['fnc_member'];

if(isset($_POST['add_staking'])){
  $staking_target = $_POST['amount_fina'];

  if($fina >= $staking_target){
    $query = "INSERT INTO staking_member_fina (member_staking,jumlah_fnc_staking) VALUES('$username', '$staking_target')";
    $result = mysqli_query($conn, $query);
    if($result){
      $newfina = $fina - $staking_target;
      $queryfnc = "UPDATE member_fina SET fnc_member='$newfina' WHERE username_member='".$_SESSION['username_user']."'";
      $resultfnc = mysqli_query($conn, $queryfnc);
    }
  }else{
    $error_status = "COIN FNC IS NOT ENOUGH";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | STAKING</title>
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

    <!-- DataTables -->
    <link
      href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
      rel="stylesheet"
      type="text/css"
    />

    <!-- Responsive datatable examples -->
    <link
      href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
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
                  <h4 class="mb-sm-0">Staking</h4>

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
            <div class="row">
              <?php if($error_status != ""){ ?>
              <div class="col-12">
                <div class="mb-4">
                  <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?= $error_status ?>
                  </div>
                </div>
              </div>
              <?php } ?>
              <div class="col-12 col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <?php  

                    $display = "block";
                    $querychck = "SELECT * FROM staking_member_fina WHERE member_staking='$username'";
                    $resultcheck = mysqli_query($conn, $querychck);
                    if(mysqli_num_rows($resultcheck) > 0){
                      while($rowStaking=mysqli_fetch_assoc($resultcheck)){
                        $id = $rowStaking['id_staking']; // id staking
                        $fnc = $rowStaking['jumlah_fnc_staking']; // jumlah coin staking
                        $maxstacking = $fnc*($max/100); 
                        // check max stacking
                        $jumSt = 0; 
                        $queryStoryForMax = "SELECT fnc_story FROM story_staking_fina WHERE id_staking='$id'";
                        $resulStoryForMax = mysqli_query($conn, $queryStoryForMax);
                        while($rowSt=mysqli_fetch_assoc($resulStoryForMax)){
                          $jumSt += $rowSt['fnc_story'];
                        }
                        if($maxstacking == $jumSt){
                          continue;
                        }else{
                          $display = "none";
                          break;
                        }
                      }
                    }
                    ?>
                    
                    <form style="display: <?= $display ?>;" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-2">
                          <label for="balance" class="form-label">FNC BALANCE</label>
                        </div>
                        <div class="col-12 col-sm-4">
                          <input type="text" id="balance" class="form-control" value="<?= $fina ?> FNC" readonly>
                        </div>
                      </div>
                      <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-2">
                          <label for="username" class="form-label">Username</label>
                        </div>
                        <div class="col-12 col-sm-4">
                          <input type="text" id="username" class="form-control" value="<?= $username ?>" readonly>
                        </div>
                      </div>
                      <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-2">
                          <label for="amount" class="form-label">Amount</label>
                        </div>
                        <div class="col-12 col-sm-4">
                          <input type="number" name="amount_fina" max="<?= $fina ?>" id="amount" class="form-control" placeholder="Amount">
                        </div>
                      </div>
                      <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-4">
                          <button class="btn btn-primary" type="submit" name="add_staking">Submit</button>
                        </div>
                      </div>
                    </form>
                      
                    <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" >
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                        $querystaking = "SELECT * FROM staking_member_fina WHERE member_staking='$username' ORDER BY tgl_staking DESC";
                        $Resultstaking = mysqli_query($conn, $querystaking);
                        while($rowStaking = mysqli_fetch_assoc($Resultstaking)){
                        ?>
                        <tr>
                          <td><?= $rowStaking['member_staking'] ?></td>
                          <td><?= number_format($rowStaking['jumlah_fnc_staking']) ?> FNC</td>
                          <td><?= $rowStaking['tgl_staking'] ?></td>
                          <td>
                            <div class="btn-group btn-group-toggle mt-2 mt-lg-0" data-bs-toggle="buttons">
                              <div class="me-1">
                                <a href="#viewstory<?= $rowStaking['id_staking'] ?>" data-bs-toggle="modal" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Story Staking">
                                  <i class="ri-eye-line"></i>
                                  View
                                </a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
    <!-- start modul view -->
    <?php  
    $querystaking = "SELECT * FROM staking_member_fina WHERE member_staking='$username' ORDER BY tgl_staking DESC";
    $Resultstaking = mysqli_query($conn, $querystaking);
    while($rowStaking = mysqli_fetch_assoc($Resultstaking)){
    ?>
    <div class="modal fade bs-example-modal-center" id="viewstory<?= $rowStaking['id_staking'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Story Staking <?= nameFormater($rowStaking['member_staking']) ?> <?= $rowStaking['jumlah_fnc_staking'] ?> FNC</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <?php  
          $count = 0;
          $queryStory = "SELECT * FROM story_staking_fina WHERE id_staking='".$rowStaking['id_staking']."'";
          $resultStory = mysqli_query($conn, $queryStory);
          while($rowStory=mysqli_fetch_assoc($resultStory)){
            $count += $rowStory['fnc_story'];
          }
          ?>
            count Coin: <?= number_format($count) ?> FNC
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>FNC Coin</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $queryStory = "SELECT * FROM story_staking_fina WHERE id_staking='".$rowStaking['id_staking']."' ORDER BY tgl_story DESC";
                $resultStory = mysqli_query($conn, $queryStory);
                while($rowStory=mysqli_fetch_assoc($resultStory)){
                ?>
                <tr>
                  <td><?= $rowStory['tgl_story'] ?></td>
                  <td><?= number_format($rowStory['fnc_story']) ?> FNC</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
    <?php } ?>
    <!-- end modul view -->
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

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <script src="assets/js/app.js"></script>
  </body>
</html>

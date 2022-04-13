<?php  
include_once "helpper/function.php";

if($_SESSION['login_admin_fina'] != true){
  header('Location:auth-login');
  exit();
}
$querymaxx = "SELECT * FROM max_stacking WHERE id='1'";
$resultmaxx = mysqli_query($conn, $querymaxx);
$rowmaxx = mysqli_fetch_assoc($resultmaxx);
$max = $rowmaxx['persen'];

$warning_status = "";
if(isset($_POST['aksi_staking'])){
  $bonus_staking = $_POST['persen_staking']; // perasen bonus staking dari jumlah coin staking

  // data member yang staking
  $queryStaking = "SELECT id_staking,member_staking,jumlah_fnc_staking FROM staking_member_fina";
  $resulStaking = mysqli_query($conn, $queryStaking);

  // jika ada lakukan staking
  if(mysqli_num_rows($resulStaking) > 0){
    // loop data member yg staking
    $hasilstaking = 0;
    while($rowStaking=mysqli_fetch_assoc($resulStaking)){
      $username = $rowStaking['member_staking']; // username member staking
      $id = $rowStaking['id_staking']; // id staking
      $fnc = $rowStaking['jumlah_fnc_staking']; // jumlah coin staking
      $bonusStaking = $fnc*($bonus_staking/100); // bonus staking sesuai persen
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
        
        // time end tgl
        $today = date("Y-m-d");
        $tz = 'Asia/Jakarta';
        $dt = new DateTime("now", new DateTimeZone($tz));
        $time = $dt->format('G:i:s');
  
        // data story staking dan cek apakah sudah ada staking hari ini
        $queryCheckstaking = "SELECT tgl_story FROM story_staking_fina WHERE tgl_story='$today' AND id_staking='$id'";
        $resultCheckstaking = mysqli_query($conn, $queryCheckstaking);
        if(mysqli_num_rows($resultCheckstaking) > 0){
          $warning_status = "Staking is Already.";
          continue;
        }else{
          
          // mengambil bonus pada data member
          $querymember = "SELECT * FROM member_fina WHERE username_member='$username'";
          $resultmember = mysqli_query($conn, $querymember);
          $rowmember = mysqli_fetch_assoc($resultmember);
          $suspen = $rowmember['status_suspend_member'];
          $status = $rowmember['status_member'];
          $stakingbonus = $rowmember['bonus_staking_member'];
          // jika blm mencapai max stacking
          // jika member tidak di suspen dan status pain maka pada staking
          if($suspen == 'UNSUSPEND' && $status == 'PAID'){
            // menambah jumlah hasil staking bonus yg sudah ada
            $stakingbonus += $bonusStaking; 
  
            // menyimpan data bonus staking ke data member
            $updateMember = "UPDATE member_fina SET bonus_staking_member='$stakingbonus' WHERE username_member='$username'";
            $resultupdate = mysqli_query($conn, $updateMember);
            // jika berhasil simpan story
            if($resultupdate){
              // menyimpan data bonus staking
              $queryAddStaking = "INSERT INTO story_staking_fina (fnc_story,tgl_story,time_story,id_staking) VALUES('$bonusStaking','$today','$time','$id')";
              $resultAdd = mysqli_query($conn, $queryAddStaking);
              // jika berhasil lakukan pengambilan bonus sponsor untuk uplien
              if($resultAdd){
                // memberikan bonus sponsor pada upline
                Sponsor($username, $sponsor=$username, $bonusStaking, $lvl=1, $today, $time);
                $warning_status = "Staking is Successfuly. ".$today." ".$time;
              }
            }
    
          }
        }
      }

    } // end loop data member staking
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | STAKING MEMBER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      content="Premium Multipurpose Admin & Dashboard Template"
      name="description"
    />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- jvectormap -->
    <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

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
  </head>

  <body data-sidebar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
      <header id="page-topbar">
        <div class="navbar-header">
          <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box text-center">
              <a href="index.html" class="logo logo-dark">
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

              <a href="index.html" class="logo logo-light">
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

            <div class="dropdown d-inline-block user-dropdown">
              <button
                type="button"
                class="btn header-item waves-effect"
                id="page-header-user-dropdown"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <img
                  class="rounded-circle header-profile-user"
                  src="assets/images/logo-sm.png"
                  alt="Header Avatar"
                />
                <span class="d-none d-xl-inline-block ms-1">FINACOIN</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="#"
                  ><i class="ri-user-line align-middle me-1"></i> PREVIEW
                  WEBSITE</a
                >

                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="logout"
                  ><i
                    class="ri-shut-down-line align-middle me-1 text-danger"
                  ></i>
                  Logout</a
                >
              </div>
            </div>

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

      <!-- ========== Left Sidebar Start ========== -->
      <div class="vertical-menu">
        <div data-simplebar class="h-100">
          <!--- Sidemenu -->
          <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
              <li class="menu-title">Menu</li>

              <li>
                <a href="index" class="waves-effect">
                  <i class="mdi mdi-home-variant-outline"></i>
                  <span>Dashboard</span>
                </a>
              </li>

              <li class="menu-title">Info Member</li>

              <li>
                <a href="users" class="waves-effect">
                  <i class="mdi mdi-account-group-outline"></i>
                  <span>Member</span>
                </a>
                <!-- <ul class="sub-menu" aria-expanded="false">
                  <li><a href="users">Users</a></li>
                  <li><a href="edit-users">Edit Users</a></li>
                  <li><a href="komisi-member">Komisi Member</a></li>
                </ul> -->
              </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                  <i class="mdi mdi-file-key-outline"></i>
                  <span>PIN</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                  <li><a href="all-pin">All PIN</a></li>
                  <li><a href="generate-pin">Generate PIN</a></li>
                  <li><a href="transfer-pin">Transfer PIN</a></li>
                </ul>
              </li>

              <li class="menu-title">Info Finance</li> 
              <li>
                <a href="deposit-request" class="waves-effect">
                  <i class="mdi mdi-wallet-outline"></i>
                  <?php  
                    $queryusdt = "SELECT usdt_pembelian FROM pembelian_fnc_fina WHERE status_pembelian='No' ";
                    $resultusdt = mysqli_query($conn, $queryusdt);
                    $countusdt = mysqli_num_rows($resultusdt);
                    if($countusdt != 0){
                  ?>
                  <span class="badge rounded-pill bg-danger float-end"><?= $countusdt ?></span>
                  <?php } ?>
                  <span>Deposite USDT</span>
                </a>
              </li>
              <li>
                <a href="withdrawl" class="waves-effect">
                  <?php  
                  $querywd = "SELECT * FROM story_wd_fina WHERE status_wd='No'";
                  $resultwd = mysqli_query($conn, $querywd);
                  $countwd=mysqli_num_rows($resultwd);
                  if($countwd != 0){
                  ?>
                  <span class="badge rounded-pill bg-danger float-end"><?= $countwd ?></span>
                  <?php } ?>
                  <i class="mdi mdi-calendar-outline"></i>
                  <span>Withdrawl</span>
                </a>
              </li>
              <li>
                <a href="staking-member" class="waves-effect">
                  <i class=" ri-money-cny-box-line"></i>
                  <span>Staking Member</span>
                </a>
              </li>
              <li class="menu-title">Info Settings</li>
              <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                  <i class="mdi mdi-sitemap"></i>
                  <span>Configuration</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                  <li><a href="setting-admin">Admin Profile</a></li>
                  <li><a href="setting-staking">Product</a></li>
                </ul>
              </li>
        <!-- <li>
                <a href="transfer-deposit" class="waves-effect">
                  <i class="mdi mdi-bank-transfer"></i>
                  <span>Transfer</span>
                </a>
              </li>
              <li>
                <a href="profit" class="waves-effect">
                  <i class="mdi mdi-cash"></i>
                  <span>Profit</span>
                </a>
              </li>
              <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                  <i class="mdi mdi-wallet-membership"></i>
                  <span>History Wallet</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                  <li><a href="history-deposit">Deposite Wallet</a></li>
                  <li><a href="history-cash">Cash Wallet</a></li>
                </ul>
              </li>

              <li>
                <a href="withdrawl" class="waves-effect">
                  <i class="mdi mdi-calendar-outline"></i>
                  <span>Withdrawl</span>
                </a>
              </li>

              <li class="menu-title">Info Settings</li>
              <li>
                <a href="setting-web" class="waves-effect">
                  <i class="mdi mdi-web"></i>
                  <span>Website</span>
                </a>
              </li>
              <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                  <i class="mdi mdi-sitemap"></i>
                  <span>Setting Produk</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                  <li><a href="setting-paket">Paket Bisnis</a></li>
                  <li><a href="setting-staking">Staking</a></li>
                  <li><a href="setting-bonus">Bonus</a></li>
                </ul>
              </li>
              <li>
                <a href="ganti-password" class="waves-effect">
                  <i class="mdi mdi-form-textbox-password"></i>
                  <span>Edit Password</span>
                </a>
              </li> -->
            </ul>
          </div>
          <!-- Sidebar -->
        </div>
      </div>
      <!-- Left Sidebar End -->

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
                <h4 class="mb-sm-0">Info Staking</h4>

                  <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Staking Member</a>
                      </li>
                      <li class="breadcrumb-item active">Staking</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <!-- end page title -->
            <!-- isi page -->

            <?php  
            $queryMemberStaking = "SELECT * FROM staking_member_fina ORDER BY tgl_staking DESC";
            $result_memberStaking = mysqli_query($conn, $queryMemberStaking);
            while($row_member_staking=mysqli_fetch_assoc($result_memberStaking)){
            ?>
            <!-- modal detail -->
            <div class="modal fade bs-example-modal-center" id="viewstory<?= $row_member_staking['id_staking'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Story Staking <?= nameFormater($row_member_staking['member_staking']) ?> <?= $row_member_staking['jumlah_fnc_staking'] ?> FNC</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php  
                          $count = 0;
                          $queryStory = "SELECT * FROM story_staking_fina WHERE id_staking='".$row_member_staking['id_staking']."'";
                          $resultStory = mysqli_query($conn, $queryStory);
                          while($rowStory=mysqli_fetch_assoc($resultStory)){
                            $count += $rowStory['fnc_story'];
                          }
                          ?>
                      count Coin: <?= number_format($count,3,",",".") ?> FNC
                      <table class="table table-hover mb-0">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>FNC Coin</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php  
                          $queryStory = "SELECT * FROM story_staking_fina WHERE id_staking='".$row_member_staking['id_staking']."' ORDER BY tgl_story DESC";
                          $resultStory = mysqli_query($conn, $queryStory);
                          while($rowStory=mysqli_fetch_assoc($resultStory)){
                          ?>
                          <tr>
                            <td><?= dateFormatter($rowStory['tgl_story']) ?></td>
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
            <!-- end modal detail -->
            <?php } ?>

            <!-- end isi page -->
            <div class="row">
            <?php 
            if($warning_status != ""){ 
              if($warning_status == "Staking is Already."){ 
            ?>

              <div class="col-12">
                <div class="mb-4">
                  <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?= $warning_status ?>
                  </div>
                </div>
              </div>
              <?php }else{ ?>
              <div class="col-12">
                <div class="mb-4">
                  <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?= $warning_status ?>
                  </div>
                </div>
              </div>
              <?php }} ?>
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form class="mb-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <label for="staking">Generate Staking</label>
                      <div class="row">
                        <div class="col-12 col-sm-4">
                          <?php  
                          $querybonus = "SELECT amount_setting FROM setting_staking_fina WHERE id_setting='1'";
                          $resultbonus = mysqli_query($conn, $querybonus);
                          $rowbonus = mysqli_fetch_assoc($resultbonus);
                          ?>
                          <div class="input-group">
                            <input type="number" step="0.01" name="persen_staking" value="<?= $rowbonus['amount_setting'] ?>" class="form-control">
                            <span class="input-group-text">%</span>
                          </div>
                        </div>
                        <div class="col-12 col-sm-3">
                          <button type="submit" name="aksi_staking" class="btn btn-primary">Go</button>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" >
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Username</th>
                          <th>FNC Coin</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                            $queryMemberStaking = "SELECT * FROM staking_member_fina ORDER BY tgl_staking DESC";
                            $result_memberStaking = mysqli_query($conn, $queryMemberStaking);
                            while($row_member_staking=mysqli_fetch_assoc($result_memberStaking)){ 
                          ?>
                          <tr>
                            <td><?= dateFormatter($row_member_staking['tgl_staking']) ?></td>
                            <td><?= $row_member_staking['member_staking'] ?></td>
                            <td><?= number_format($row_member_staking['jumlah_fnc_staking']) ?> FNC</td>
                            <td>
                            <div class="btn-group btn-group-toggle mt-2 mt-lg-0" data-bs-toggle="buttons">
                              <div class="me-1">
                                <a href="#viewstory<?= $row_member_staking['id_staking'] ?>" data-bs-toggle="modal" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Story Staking">
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
                © FINACOIN.
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
          <hr />

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
          <hr />

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
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <script src="assets/js/app.js"></script>
  </body>
</html>
<?php mysqli_close($conn) ?>
<?php  
include_once "helpper/function.php";

if($_SESSION['login_admin_fina'] != true){
  header('Location:auth-login');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | DASHBOARD ADMIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="FINACOIN" name="description" />
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
                  <h4 class="mb-sm-0">Dashboard</h4>

                  <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Statistik</a>
                      </li>
                      <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <!-- end page title -->

            <div class="row">
              <div class="col-xl-6 col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex text-muted">
                      <div class="flex-shrink-0 me-3 align-self-center">
                        <div class="avatar-sm">
                          <div
                            class="
                              avatar-title
                              bg-light
                              rounded-circle
                              text-primary
                              font-size-20
                            "
                          >
                            <i class="ri-group-line"></i>
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <p class="mb-1">Active Member</p>
                        <h5 class="mb-3">
                          <?php 
                            $tableMember = 'member_fina';
                            $field = 'status_suspend_member';
                            $value = 'UNSUSPEND';
                            $query_member = querySelectOne($tableMember, $field, $value);
                            echo $result = mysqli_num_rows($query_member);
                            if($result > 0){
                          ?>
                        </h5>
                        <a href="#">
                          <p class="text-truncate mb-0">
                            <span class="text-success me-2">
                              <?php  
                              $query_update = SelectOneLimit($tableMember, $field, $value, $id='id_member', $limit='1');
                              $row_new_member = mysqli_fetch_assoc($query_update);
                              echo ucfirst($row_new_member['username_member'])
                              ?>
                              <i
                                class="ri-arrow-right-up-line align-bottom ms-1"
                              ></i
                            ></span>
                            New User
                          </p>
                        </a>
                        <?php } ?>
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
                        <div class="avatar-sm">
                          <div
                            class="
                              avatar-title
                              bg-light
                              rounded-circle
                              text-primary
                              font-size-20
                            "
                          >
                            <i class="ri-terminal-window-line"></i>
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <p class="mb-1">Visitors</p>
                        <h5 class="mb-3"><?= cekVisitor() ?></h5>
                        <p class="text-truncate mb-0">
                          <?php $date = date("Y-m-d") ?>
                          <span class="text-success me-2"> <?= cekVisitor($date) ?> </span>
                          Today Visited
                        </p>
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
                        <div class="avatar-sm">
                          <div
                            class="
                              avatar-title
                              bg-light
                              rounded-circle
                              text-primary
                              font-size-20
                            "
                          >
                            <i class="ri-wallet-2-line"></i>
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <p class="mb-1">FNC Sold</p>
                        <?php  
                            $count = 0;
                            $queryusdtView = "SELECT * FROM pembelian_fnc_fina WHERE status_pembelian='Approve'";
                            $resultusdtView = mysqli_query($conn, $queryusdtView);
                            while($rowusdtView=mysqli_fetch_assoc($resultusdtView)){
                              $count += $rowusdtView['fnc_pembelian'];
                            }
                        ?>
                        <h5 class="mb-3"><?= $count ?> FNC</h5>
                        <a href="#"
                        <?php  
                            $date = date("Y-m-d");
                            $count = 0;
                            $queryusdtView = "SELECT * FROM pembelian_fnc_fina WHERE status_pembelian='Approve' tgl_confirm_pembelian='$date'";
                            $resultusdtView = mysqli_query($conn, $queryusdtView);
                            while($rowusdtView=mysqli_fetch_assoc($resultusdtView)){
                              $count += $rowusdtView['fnc_pembelian'];
                            }
                        ?>
                          ><p class="text-truncate mb-0">
                            <span class="text-success me-2">
                              <?= $count ?> FNC
                              <i
                                class="ri-arrow-right-up-line align-bottom ms-1"
                              ></i
                            ></span>

                            Today Profit
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

              <div class="col-xl-6 col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex text-muted">
                      <div class="flex-shrink-0 me-3 align-self-center">
                        <div class="avatar-sm">
                          <div
                            class="
                              avatar-title
                              bg-light
                              rounded-circle
                              text-primary
                              font-size-20
                            "
                          >
                            <i class="ri-file-transfer-line"></i>
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                        <p class="mb-1">Total WD</p>
                        <?php
                        $totalwd = 0;  
                        $querywd = "SELECT fnc_wd FROM story_wd_fina";
                        $resultwd = mysqli_query($conn, $querywd);
                        while($rowwd=mysqli_fetch_assoc($resultwd)){
                          $totalwd += $rowwd['fnc_wd'];
                        }
                        ?>
                        <h5 class="mb-3"> <?= $totalwd ?> FNC</h5>
                        <a href="#"
                          ><p class="text-truncate mb-0">
                            <?php
                            $totalwd = 0;  
                            $querywd = "SELECT fnc_wd FROM story_wd_fina WHERE status_wd='Approve'";
                            $resultwd = mysqli_query($conn, $querywd);
                            while($rowwd=mysqli_fetch_assoc($resultwd)){
                              $totalwd += $rowwd['fnc_wd'];
                            }
                            ?>
                            <span class="text-success me-2">
                              <?= $totalwd ?> FNC
                              <i
                                class="ri-arrow-right-up-line align-bottom ms-1"
                              ></i
                            ></span>
                            Valid
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
            <!-- end row -->
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

    <!-- apexcharts js -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- jquery.vectormap map -->
    <script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="assets/js/pages/dashboard.init.js"></script>

    <script src="assets/js/app.js"></script>
  </body>
</html>
<?php mysqli_close($conn) ?>
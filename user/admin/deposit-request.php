<?php  
include_once "helpper/function.php";

if($_SESSION['login_admin_fina'] != true){
  header('Location:auth-login');
  exit();
}

if(isset($_POST['proses_order'])){
  $id = $_POST['id'];
  $dateConfirm = date("Y-m-d h:i:s");

  $queryOrderCoin = "SELECT fnc_pembelian,username_pembelian FROM pembelian_fnc_fina WHERE id='$id'";
  $resultCoin = mysqli_query($conn, $queryOrderCoin);
  $rowCoin = mysqli_fetch_assoc($resultCoin);
  $CoinOrder = $rowCoin['fnc_pembelian'];
  $UsernameOrder = $rowCoin['username_pembelian'];

  $queryMember = "SELECT fnc_member FROM member_fina WHERE username_member='$UsernameOrder'";
  $resultMember = mysqli_query($conn, $queryMember);
  $rowMmeber = mysqli_fetch_assoc($resultMember);
  $CoinMember = $rowMmeber['fnc_member'];

  $jumlahCoin = $CoinMember + $CoinOrder;

  $queryUpdateMember = "UPDATE member_fina SET fnc_member='$jumlahCoin' WHERE username_member='$UsernameOrder'";
  $rasultUpdateMemeber = mysqli_query($conn, $queryUpdateMember);

  if($rasultUpdateMemeber){
    $queryUpdate = "UPDATE pembelian_fnc_fina SET status_pembelian='Approve', tgl_confirm_pembelian='$dateConfirm' WHERE id='$id'";
    $resultUpdate = mysqli_query($conn, $queryUpdate);
  }
}

if(isset($_POST['batal_proses_order'])){
  $id = $_POST['id'];

  $queryOrderCoin = "SELECT fnc_pembelian,username_pembelian FROM pembelian_fnc_fina WHERE id='$id'";
  $resultCoin = mysqli_query($conn, $queryOrderCoin);
  $rowCoin = mysqli_fetch_assoc($resultCoin);
  $CoinOrder = $rowCoin['fnc_pembelian'];
  $UsernameOrder = $rowCoin['username_pembelian'];

  $queryMember = "SELECT fnc_member FROM member_fina WHERE username_member='$UsernameOrder'";
  $resultMember = mysqli_query($conn, $queryMember);
  $rowMmeber = mysqli_fetch_assoc($resultMember);
  $CoinMember = $rowMmeber['fnc_member'];

  $jumlahCoin = $CoinMember - $CoinOrder;

  $queryUpdateMember = "UPDATE member_fina SET fnc_member='$jumlahCoin' WHERE username_member='$UsernameOrder'";
  $rasultUpdateMemeber = mysqli_query($conn, $queryUpdateMember);

  if($rasultUpdateMemeber){
    $queryUpdate = "UPDATE pembelian_fnc_fina SET status_pembelian='No', tgl_confirm_pembelian='' WHERE id='$id'";
    $resultUpdate = mysqli_query($conn, $queryUpdate);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | DEPOSIT FNC</title>
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
                <a class="dropdown-item text-danger" href="#"
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
                  <h4 class="mb-sm-0">Deposit USDT</h4>

                  <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Deposit USDT</a>
                      </li>
                      <li class="breadcrumb-item active">USDT</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <!-- end page title -->
            <!-- isi page -->

            <!-- end isi page -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="text-center">
                      <h5>
                        <b>Valid :</b>
                        <?php  
                        $queryusdt = "SELECT usdt_pembelian FROM pembelian_fnc_fina WHERE status_pembelian='Approve' ";
                        $resultusdt = mysqli_query($conn, $queryusdt);
                        $countusdt = 0;
                        while($rowusdt=mysqli_fetch_assoc($resultusdt)){
                          $countusdt += (float)$rowusdt['usdt_pembelian'];
                        }
                        ?>
                        <span class="text-success"> <b>USDT <?= number_format($countusdt,5,",",".") ?></b></span>
                      </h5>
                      <p>
                        Total Order :
                        <?php  
                        $queryusdt = "SELECT usdt_pembelian FROM pembelian_fnc_fina WHERE status_pembelian='No' ";
                        $resultusdt = mysqli_query($conn, $queryusdt);
                        $countusdt = mysqli_num_rows($resultusdt);
                        ?>
                        <span class="text-success"> <b><?= $countusdt ?> Request</b></span>
                      </p>
                    </div>
                    
                    <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Code</th>
                          <th>Username</th>
                          <th>Fullname</th>
                          <th>FNC</th>
                          <th>USDT</th>
                          <th>IDR</th>
                          <th>Status</th>
                          <th>Order Date</th>
                          <th>Confirm Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php  
                        $queryusdtView = "SELECT * FROM pembelian_fnc_fina";
                        $resultusdtView = mysqli_query($conn, $queryusdtView);
                        $num = 0;
                        while($rowusdtView=mysqli_fetch_assoc($resultusdtView)){
                        ?>
                        <tr>
                          <td><?= ++$num ?></td>
                          <td><?= $rowusdtView['kode_pembelian'] ?></td>
                          <td><?= $rowusdtView['username_pembelian'] ?></td>
                          <td><?= nameFormater($rowusdtView['nama_lengkap_pembelian']) ?></td>
                          <td><?= number_format($rowusdtView['fnc_pembelian'],2,",",".") ?> FNC</td>
                          <td>USDT <?= number_format($rowusdtView['usdt_pembelian'],5,",",".") ?></td>
                          <td>Rp. <?= number_format($rowusdtView['idr_pembelian'],2,",",".") ?></td>
                          <td><?= $statustext = $rowusdtView['status_pembelian'] == "No" ? "<span class='text-danger'>".$rowusdtView['status_pembelian']."</span>" : "<span class='text-success'>".$rowusdtView['status_pembelian']."</span>"?></td>
                          <td><?= dateFormatter($rowusdtView['tgl_order_pembelian']) ?></td>
                          <td><?= dateFormatter($rowusdtView['tgl_confirm_pembelian']) ?></td>
                          <td>
                            <div class="btn-group btn-group-toggle mt-2 mt-lg-0" data-bs-toggle="buttons">
                            <?php  
                            if($rowusdtView['status_pembelian'] == "Approve"){ ?>
                              <div class="me-1">
                                <a href="#" data-bs-placement="top" title="Proses Order" class="btn btn-secondary btn-sm disabled">
                                  <i class="mdi mdi-sticker-check-outline"></i>
                                  Proses
                                </a>
                              </div>
                            <?php }else{ ?>
                              <div class="me-1">
                                <a href="#prosesorder<?= $rowusdtView['id'] ?>" data-bs-toggle="modal" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Proses Order">
                                  <i class="mdi mdi-sticker-check-outline"></i>
                                  Proses
                                </a>
                              </div>
                            <?php }
                            if($rowusdtView['status_pembelian'] == "No"){ ?>
                              <div class="me-1">
                                <a href="#" data-bs-placement="top" title="Batal Proses Order" class="btn btn-secondary btn-sm disabled">
                                  <i class="mdi mdi-delete-alert-outline"></i>
                                  Batal
                                </a>
                              </div>
                            <?php }else{ ?>
                              <div class="me-1">
                                <a href="#batalorder<?= $rowusdtView['id'] ?>" data-bs-toggle="modal" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Batal Proses Order">
                                  <i class="mdi mdi-delete-alert-outline"></i>
                                  Batal
                                </a>
                              </div>
                            <?php } ?>
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
                ?? FINACOIN.
              </div>
            </div>
          </div>
        </footer>
      </div>
      <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <?php  
    $queryusdtView = "SELECT * FROM pembelian_fnc_fina";
    $resultusdtView = mysqli_query($conn, $queryusdtView);
    while($rowusdtView=mysqli_fetch_assoc($resultusdtView)){
    ?>
    <!-- Modal Proses -->
    <div class="modal fade bs-example-modal-center" tabindex="-1" id="prosesorder<?= $rowusdtView['id'] ?>" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Order Confirm </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="<?= $rowusdtView['foto_bukti_pembelian'] ?>" class="img-fluid mx-auto d-block rounded-3 shadow-sm" alt="">
          </div>
          <form class="modal-footer" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <input type="hidden" value="<?= $rowusdtView['id'] ?>" name="id">
            <button type="submit" name="proses_order" class="btn btn-success btn-sm">Proses</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade bs-example-modal-center" tabindex="-1" id="batalorder<?= $rowusdtView['id'] ?>" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cancel Order Confirm </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4>Are you sure?</h4>
          </div>
          <form class="modal-footer" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <input type="hidden" value="<?= $rowusdtView['id'] ?>" name="id">
            <button type="submit" name="batal_proses_order" class="btn btn-success btn-sm">Ya</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- END Modal Proses -->
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
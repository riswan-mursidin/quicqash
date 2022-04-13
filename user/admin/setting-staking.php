<?php  
include_once "helpper/function.php";

if($_SESSION['login_admin_fina'] != true){
  header('Location:auth-login');
  exit();
}
$warning_status = "";
if(isset($_POST['edit_staking'])){
  $id = $_POST['id'];
  $price_staking = $_POST['price_staking'];
  $query = "UPDATE setting_staking_fina SET amount_setting='$price_staking' WHERE id_setting='$id'";
  $result = mysqli_query($conn, $query);
  if($result){
    $warning_status = "Edit data is successfuly";
  }else{
    $warning_status = "Edit data is Failed";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | SETTING STAKING</title>
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
                  <h4 class="mb-sm-0">Configuration</h4>

                  <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Configuration Product</a>
                      </li>
                      <li class="breadcrumb-item active">Product</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <!-- modal edit -->
            <?php  
            $querySetting = "SELECT * FROM setting_staking_fina";
            $resultSetting = mysqli_query($conn, $querySetting);
            while($rowSetting = mysqli_fetch_assoc($resultSetting)){
              $simbol = $rowSetting['id_setting'] == 1 ? "%" : "$" 
            ?>
            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" id="editpackage<?= $rowSetting['id_setting'] ?>" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <form class="modal-content" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Staking Bonus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-3 col-sm-3">
                          <label for="">Package </label>
                        </div>
                        <div class="col-9 col-sm-9 mb-3">
                          <input type="text" readonly class="form-control" value="<?= $rowSetting['name_setting'] ?>">
                        </div>
                        <div class="col-3 col-sm-3">
                          <label for="">Amount </label>
                        </div>
                        <div class="col-9 col-sm-9 mb-3">
                          <input type="text" readonly class="form-control" value="<?= $simbol ?>">
                        </div>
                        <div class="col-3 col-sm-3">
                          <label for="">Price </label>
                        </div>
                        <div class="col-9 col-sm-9 mb-3">
                          <input type="number" name="price_staking" step='0.01' class="form-control" value="<?= $rowSetting['amount_setting'] ?>">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" value="<?= $rowSetting['id_setting'] ?>" name="id">
                      <button type="submit" name="edit_staking" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                  </form><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            <?php } ?>
            <!-- end modal edit -->
            <!-- end page title -->
            <!-- Edit Staking ROI -->
            <div class="row">
              <div class="col-12">
                <?php if($warning_status != ""){ ?>
                <div class="col-12">
                  <div class="mb-4">
                    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <?= $warning_status ?>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="card">
                  <div class="card-body">
                    <p class="text-dark"><b>Staking Configuration</b></p>
                    <hr />
                    <div class="row">
                      <div class="col-12 col-sm-12 mb-3">
                        <label for="example-text-input" class="form-label"
                          >Staking Bonus
                        </label>
                        <table class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                          <thead>
                            <tr>
                              <th>Package</th>
                              <th>Profit</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php  
                            $querySetting = "SELECT * FROM setting_staking_fina";
                            $resultSetting = mysqli_query($conn, $querySetting);
                            while($rowSetting = mysqli_fetch_assoc($resultSetting)){
                              $simbol = $rowSetting['id_setting'] == 1 ? $rowSetting['amount_setting']."%" : "$".$rowSetting['amount_setting'] 
                            ?>
                            <tr>
                              <td><?= $rowSetting['name_setting'] ?></td>
                              <td><?= $simbol ?></td>
                              <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#editpackage<?= $rowSetting['id_setting'] ?>" class="btn btn-outline-success btn-sm">Edit</button>
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
            </div>
            <!-- Edit Stating ROI -->
            <!-- Edit Sponsor ROI -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <p class="text-dark"><b>Sponsor Configuration</b></p>
                    <hr />
                    <div class="row">
                      <?php  
                      $querySponsor = "SELECT level_sponsor,profit_sponsor FROM bonus_sponsor_fina ORDER BY level_sponsor ASC";
                      $resultSponsor = mysqli_query($conn, $querySponsor);
                      while($rowSponsor = mysqli_fetch_assoc($resultSponsor)){
                      ?>
                      <div class="col-12 col-sm-4 mb-3">
                        <label for="example-text-input" class="form-label"
                          >Generasi <?= $rowSponsor['level_sponsor'] ?>
                        </label>
                        <input type="text" readonly class="form-control-plaintext"  value="<?= $rowSponsor['profit_sponsor'] ?>%">
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Edit Sponsor ROI -->
            <!-- <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <table
                      id="datatable"
                      class="table table-bordered dt-responsive nowrap"
                      style="
                        border-collapse: collapse;
                        border-spacing: 0;
                        width: 100%;
                      "
                    >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Paket</th>
                          <th>Profit % /Day</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Free</td>
                          <td>0</td>
                          <td class="text-success">Active</td>
                          <td>
                            <div
                              class="btn-group btn-group-toggle mt-2 mt-lg-0"
                              data-bs-toggle="buttons"
                            >
                              <div>
                                <a
                                  href="setting-paket.html"
                                  class="btn btn-warning btn-sm me-1"
                                  data-bs-toggle="tooltip"
                                  data-bs-placement="top"
                                  title="Edit Staking"
                                >
                                  <i class="mdi mdi-clipboard-edit-outline"></i>
                                  Edit
                                </a>
                              </div>
                              <div>
                                <a
                                  href="setting-paket.html"
                                  class="btn btn-danger btn-sm"
                                  data-bs-toggle="tooltip"
                                  data-bs-placement="top"
                                  title="Delete Staking"
                                >
                                  <i class="mdi mdi-delete-alert"></i>
                                  Delete
                                </a>
                              </div>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td>2</td>
                          <td>Silver</td>
                          <td>0.5</td>
                          <td class="text-success">Active</td>
                          <td>
                            <div
                              class="btn-group btn-group-toggle mt-2 mt-lg-0"
                              data-bs-toggle="buttons"
                            >
                              <div>
                                <a
                                  href="setting-paket.html"
                                  class="btn btn-warning btn-sm me-1"
                                  data-bs-toggle="tooltip"
                                  data-bs-placement="top"
                                  title="Edit Staking"
                                >
                                  <i class="mdi mdi-clipboard-edit-outline"></i>
                                  Edit
                                </a>
                              </div>
                              <div>
                                <a
                                  href="setting-paket.html"
                                  class="btn btn-danger btn-sm"
                                  data-bs-toggle="tooltip"
                                  data-bs-placement="top"
                                  title="Delete Staking"
                                >
                                  <i class="mdi mdi-delete-alert"></i>
                                  Delete
                                </a>
                              </div>
                            </div>
                            <tr>
                              <td>3</td>
                              <td>Gold</td>
                              <td>1</td>
                              <td class="text-danger">Non Active</td>
                              <td>
                                <div
                                  class="
                                    btn-group btn-group-toggle
                                    mt-2 mt-lg-0
                                  "
                                  data-bs-toggle="buttons"
                                >
                                  <div>
                                    <a
                                      href="setting-paket.html"
                                      class="btn btn-warning btn-sm me-1"
                                      data-bs-toggle="tooltip"
                                      data-bs-placement="top"
                                      title="Edit Staking"
                                    >
                                      <i
                                        class="mdi mdi-clipboard-edit-outline"
                                      ></i>
                                      Edit
                                    </a>
                                  </div>
                                  <div>
                                    <a
                                      href="setting-paket.html"
                                      class="btn btn-danger btn-sm"
                                      data-bs-toggle="tooltip"
                                      data-bs-placement="top"
                                      title="Delete Staking"
                                    >
                                      <i class="mdi mdi-delete-alert"></i>
                                      Delete
                                    </a>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> -->
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
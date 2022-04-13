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
$email = $rowlogin['email_member'];
$username = $rowlogin['username_member'];
$status = $rowlogin['status_member'];
$fina = $rowlogin['fnc_member'];
$no = $rowlogin['number_phone_member'];

if(isset($_POST['update_profile'])){
  $number = formatNumber($_POST['number']);
  $query = "UPDATE member_fina SET number_phone_member='$number' WHERE username_member='$username'";
  $result = mysqli_query($conn, $query);
  if($result){
    $no = $number;
  }
}

if(isset($_POST['save_bank'])){
  $pemilik = $_POST['atas_nama'];
  $nama_bank = $_POST['nama_bank'];
  $rek_bank = $_POST['rek_bank'];

  $query = "INSERT INTO bank_member_fina(pemilik_bank,nama_bank,rek_bank,username_member) VALUES('$pemilik','$nama_bank','$rek_bank','$username')";
  $result = mysqli_query($conn, $query);

}

if(isset($_POST['delete_bank'])){
  $id = $_POST['id'];

  $querydel = "DELETE FROM bank_member_fina WHERE id='$id'";
  $resultdel = mysqli_query($conn, $querydel);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>FINACOIN | Profile</title>
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
                  <h4 class="mb-sm-0">Profile</h4>
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

            <!-- start modal -->
            <?php  
            $querybank = "SELECT * FROM bank_member_fina WHERE username_member='$username'";
            $resultbank = mysqli_query($conn, $querybank);
            while($rowbank = mysqli_fetch_assoc($resultbank)){
            ?>
            <div class="modal fade" id="deletebank<?= $rowbank['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h5>Are you Sure?</h5>
                  </div>
                  <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="modal-footer">
                    <input type="hidden" name="id" value="<?= $rowbank['id'] ?>">
                    <button type="submit" class="btn btn-danger" name="delete_bank">Ya</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </form>
                </div>
              </div>
            </div>
            <?php } ?>
            <!-- end modal -->

            <!-- start row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title mb-3">
                      Profile
                      <span class="text-success"> <?= nameFormater($fullname) ?></span>
                    </h4>

                    <div class="mb-3 row">
                      <label for="example-text-input" class="col-md-2 col-form-label" >URL REFF</label>
                      <div class="col-md-5">
                        <div class="input-group mb-3">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="copyReff()" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy"><i class="mdi mdi-content-copy"></i></button>
                          <span class="form-control text-danger" aria-describedby="button-addon1">
                            https://finacoin.finance/user/auth-register?referral=<?= $username ?>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label
                        for="example-text-input"
                        class="col-md-2 col-form-label"
                        >Username</label
                      >
                        <div class="col-md-5"><div class="input-group flex-nowrap">
                          <span class="input-group-text" id="addon-wrapping">@</span>
                          <span class="form-control text-success" aria-describedby="button-addon1">
                            <?= $username ?>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <label
                        for="example-text-input"
                        class="col-md-2 col-form-label"
                        >Fullname</label
                      >
                      <div class="col-md-5">
                        <p class="form-control">
                          <span><b><?= nameFormater($fullname) ?></b></span>
                        </p>
                      </div>
                    </div>

                    <div class="row">
                      <label
                        for="example-text-input"
                        class="col-md-2 col-form-label"
                        >Email</label
                      >
                      <div class="col-md-5">
                        <p class="form-control">
                          <span><b><?= $email ?></b></span>
                        </p>
                      </div>
                    </div>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <div class="row">
                        <label
                          for="inputno"
                          class="col-md-2 col-form-label"
                          >Contact Number</label
                        >
                        <div class="col-md-5">
                          <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">+62</span>
                            <input type="number" class="form-control" name="number" value="<?= $no ?>" aria-describedby="addon-wrapping">
                          </div>
                        </div>
                      </div>
                      <div class="button-items">
                        <button
                          type="submit"
                          name="update_profile"
                          class="btn btn-primary waves-effect waves-light"
                        >
                          <i class="ri-arrow-right-line align-middle ms-2"></i>
                          Update
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
            <h4 class="mb-sm-2">Info Bank</h4>
            <hr>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Atas Nama</label>
                        <div class="col-sm-6">
                          <input type="text" name="atas_nama" id="nama" class="form-control">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="bank_name" class="col-sm-2 col-form-label">Nama Bank</label>
                        <div class="col-sm-6">
                          <input type="text" name="nama_bank" id="bank_name" class="form-control">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="bank_rek" class="col-sm-2 col-form-label">No Rekening Bank</label>
                        <div class="col-sm-6">
                          <input type="text" name="rek_bank" id="bank_rek" class="form-control">
                        </div>
                      </div>
                      <button class="btn btn-primary" type="submit" name="save_bank">Save</button>
                    </form>
                    <div class="row mt-3">
                      <div class="col-sm-12">
                        <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" >
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Atas Nama</th>
                              <th>Nama Bank</th>
                              <th>No Rek</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php  
                            $num = 0;
                            $querybank = "SELECT * FROM bank_member_fina WHERE username_member='$username'";
                            $resultbank = mysqli_query($conn, $querybank);
                            while($rowbank = mysqli_fetch_assoc($resultbank)){
                            ?>
                            <tr>
                              <td><?= ++$num ?></td>
                              <td><?= $rowbank['pemilik_bank'] ?></td>
                              <td><?= $rowbank['nama_bank'] ?></td>
                              <td><?= $rowbank['rek_bank'] ?></td>
                              <td>
                                <div class="btn-group btn-group-toggle mt-2 mt-lg-0" data-bs-toggle="buttons">
                                  <a href="#deletebank<?= $rowbank['id'] ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-placement="top" title="Delete">
                                    <i class="mdi mdi-delete"></i>
                                  </a>
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
      function copyReff() {
        /* Get the text field */
        var copyText = "http://localhost:8080/finacoin/user/auth-register?referral=<?= $username ?>";

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText);

        /* Alert the copied text */
        alert("Copied the text: " + copyText);
      }
    </script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
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

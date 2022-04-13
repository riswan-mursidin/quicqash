<?php  
require_once "helpper/function.php";

if($_SESSION['login_user_fina'] == true){
    header('Location:index');
    exit();
}
$error_status = "";
if(isset($_POST['register_member'])){
    $referral = $_POST['referral'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $useremail = $_POST['useremail'];
    $userpassword = password_hash($_POST['userpassword'], PASSWORD_DEFAULT);

    $queryusername = "SELECT * FROM member_fina WHERE username_member='$username'";
    $resultusername = mysqli_query($conn, $queryusername);
    if(mysqli_num_rows($resultusername) > 0){
        $error_status = "Username is Already";
    }else{
        $queryAddmember = "INSERT INTO member_fina (username_member,nama_lengkap_member,sponsor_member,email_member,password_member) VALUES('$username','$fullname','$referral','$useremail','$userpassword')";
        $resultAddmember = mysqli_query($conn, $queryAddmember);
        if($resultAddmember){
            header('Location: auth-login');
            exit();
        }
    }
}

$referral = $_GET['referral'];
if($referral == ""){
    $referral = "register";
}elseif($referral != "register"){
    $querycheckreferral = "SELECT username_member FROM member_fina WHERE username_member='$referral'";
    $resultcheckreferrel = mysqli_query($conn, $querycheckreferral);
    if(mysqli_num_rows($resultcheckreferrel) == 0){
        header('Location: auth-register');
    }
}

?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>FINACOIN | REGISTER</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-pattern">
        <div class="bg-overlay"></div>
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6 col-md-8">
                            <?php if($error_status != ""){ ?>
                                <div class="mb-4">
                                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <?= $error_status ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <a href="index.html" class="">
                                            <img src="assets/images/logo-dark.png" alt="" height="24" class="auth-logo logo-dark mx-auto">
                                            <img src="assets/images/logo-light.png" alt="" height="24" class="auth-logo logo-light mx-auto">
                                        </a>
                                    </div>
                                    
                                    <h4 class="font-size-18 text-muted text-center mt-2">Free Register</h4>
                                    <form class="form-horizontal" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
                                        <input type="hidden" name="referral" value="<?= $referral ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label class="form-label" for="fullname">Fullname</label>
                                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Fullname">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="username">Username</label>
                                                    <input type="text" onkeyup="cekUsername(this.value)" class="form-control" id="username" name="username" placeholder="Enter Username">
                                                    <span class="text-danger" id="notif"></span>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="useremail">Email</label>
                                                    <input type="email" class="form-control" id="useremail" name="useremail" placeholder="Enter Email">        
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="userpassword">Password</label>
                                                    <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Enter Password">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="userpassword">Confirm Password</label>
                                                    <input type="password" class="form-control" id="userpasswordconfir" name="userpasswordconfirm" placeholder="Enter Confirm Password">
                                                </div>
                                                <div class="d-grid mt-4">
                                                    <button class="btn btn-primary waves-effect waves-light" name="register_member" type="submit">Register</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <p class="text-white-50">Already have account ?<a href="auth-login" class="fw-medium text-primary"> Login </a> </p>
                                <p class="text-white-50">
                                    ©
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
        </div>
        <!-- end Account pages -->

        <!-- js confir input -->
        <script>
            
            function cekUsername(target){
                var batas = 20;
                if(target.length > batas){
                    document.getElementById("notif").innerHTML="Maximum 20 character !";
                }else{
                    var jumlah_karakter=target.length;
                    var sisa=batas-jumlah_karakter;
                    document.getElementById("notif").innerHTML=sisa+" left character !";
                }
            }
        </script>
        <script>
            var password = document.getElementById("userpassword")
            var confirm_password = document.getElementById("userpasswordconfir");

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
<?php mysqli_close($conn) ?>
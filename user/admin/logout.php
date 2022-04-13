<?php  
session_start();
$_SESSION['login_admin_fina'] = "";
$_SESSION['username_admin_fina'] = "";
header('Location: auth-login');
?>
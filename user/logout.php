<?php  
session_start();
$_SESSION['username_user'] = "";
$_SESSION['login_user_fina'] = "";
header('Location: auth-login');
?>
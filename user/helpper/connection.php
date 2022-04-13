<?php 
session_start();
error_reporting(0);

// $servername = "localhost";
// $username = "u1438856_fina_coin";
// $password = "riswanboss9999";
// $dbname = "u1438856_fina_coin";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u1438856_fina_coin";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
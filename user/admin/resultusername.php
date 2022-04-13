<?php
// Array with names
include_once "helpper/connection.php";
$a = array();
$query = "SELECT username_member FROM member_fina";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)){
    $a[] = $row['username_member'];
}

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "" || $q == $name) {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>
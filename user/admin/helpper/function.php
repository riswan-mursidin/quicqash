<?php  
require_once "connection.php";

function cekVisitor($date=null, $ip_visitor=null){
    global $conn;

    if($ip_visitor === null && $date === null){
        $query = "SELECT * FROM visitor_fina";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result);
    }elseif($ip_visitor === null){
        $query = "SELECT * FROM visitor_fina WHERE date_visit_fina='$date'";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result);
    }else{
        $query = "SELECT * FROM visitor_fina WHERE date_visit_fina='$date' AND ip_visit_fina='$ip_visitor'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            return false;
        }else{
            return true;
        }
    }

}

// select one param view/count record
function querySelectOne($table, $fieldparam, $param){
    global $conn;
    $query = "SELECT * FROM ".$table." WHERE ".$fieldparam."='".$param."' ";
    $return = mysqli_query($conn, $query);
    return $return;
}

// select 
function querySelect($table){
    global $conn;
    $query = "SELECT * FROM ".$table ;
    $return = mysqli_query($conn, $query);
    return $return;
}

// select two param view/count record
function querySelectTwo($table, $fieldparamone, $paramone, $fieldparamtwo, $paramtwo){
    global $conn;
    $query = "SELECT * FROM ".$table." WHERE ".$fieldparamone."='".$paramone."' AND ".$fieldparamtwo."='".$paramtwo."' ";
    $return = mysqli_query($conn, $query);
    return $return;
}

// select one param limit last
function SelectOneLimit($table, $fieldparam, $param, $orderby, $limit){
    global $conn;
    $query = "SELECT * FROM ".$table." WHERE ".$fieldparam."='".$param."' ORDER BY ".$orderby." DESC LIMIT ".$limit;
    $return = mysqli_query($conn, $query);
    return $return;
}
// format fullname
function nameFormater($name){
    $array_name = explode(" ", $name);
    $wordcount = count($array_name);
    $word = "";
    for($i=0; $i<$wordcount; $i++){
        $word .= ucfirst($array_name[$i])." ";
    }
    return $word;
}

// format date
function dateFormatter($date){
    $array_date = explode("-", $date);
    $day = explode(" ",$array_date[2]);
    $month = $array_date[1];
    $year = $array_date[0];
    switch($month){
        case 1:
            return $day[0]." Jan ".$year;
            break;
        case 2:
            return $day[0]." Feb ".$year;
            break;
        case 3:
            return $day[0]." Mar ".$year;
            break;
        case 4:
            return $day[0]." Apr ".$year;
            break;
        case 5:
            return $day[0]." May ".$year;
            break;
        case 6:
            return $day[0]." Jun ".$year;
            break;
        case 7:
            return $day[0]." Jul ".$year;
            break;
        case 8:
            return $day[0]." Aug ".$year;
            break;
        case 9:
            return $day[0]." Sep ".$year;
            break;
        case 10:
            return $day[0]." Oct ".$year;
            break;
        case 11:
            return $day[0]." Nov ".$year;
            break;
        case 12:
            return $day[0]." Dec ".$year;
            break;
    }
}


function Sponsor($name, $usernamecheck, $bonus, $lvl, $today, $time){
    global $conn;

    // mengambil upline member
    $querymember = "SELECT * FROM member_fina WHERE username_member='$usernamecheck'";
    $resultmember = mysqli_query($conn, $querymember);
    $rowmemberup = mysqli_fetch_assoc($resultmember);
    $upline = $rowmemberup['sponsor_member']; // upline member
    $bonussponsor = 0;

    if($upline != 'register'){
        
        // lvl tidak boleh lebih dari 5
        if($lvl <= 5){
            // mengambil data bonus untuk upline
            $queryBonus = "SELECT level_sponsor,profit_sponsor FROM bonus_sponsor_fina WHERE level_sponsor='$lvl'";
            $resultBonus = mysqli_query($conn, $queryBonus);
            $rowBonus = mysqli_fetch_assoc($resultBonus);
            $persenBonus = $rowBonus['profit_sponsor'];
            $bonussponsor = $bonus*($persenBonus/100);

            // mengambil data upline
            $queryupline = "SELECT * FROM member_fina WHERE username_member='$upline'";
            $resultupline = mysqli_query($conn, $queryupline);
            $rowupline = mysqli_fetch_assoc($resultupline);
            $saldoSponsor = $rowupline['sponsor_staking_member'];
            $status = $rowupline['status_member']; // status upline
            $suspen = $rowupline['status_suspend_member']; // status suspend upline

            // jika upline suspen atau free maka tidak dapat bonus
            if($suspen == 'UNSUSPEND' && $status == 'PAID'){
                $saldoSponsor += $bonussponsor; // menambah saldo sponsor

                // menyimpan saldo upline
                $queryuplineupdate = "UPDATE member_fina SET sponsor_staking_member='$saldoSponsor' WHERE username_member='$upline'";
                $resultuplineupdate = mysqli_query($conn, $queryuplineupdate);

                // jika berhasil di tambah buat story
                if($resultuplineupdate){
                    // mengambil data member pemberi bonus
                    $querymember = "SELECT * FROM member_fina WHERE username_member='$name'";
                    $resultmember = mysqli_query($conn, $querymember);
                    $rowmember = mysqli_fetch_assoc($resultmember);
                    $sponsor = $rowmember['sponsor_member']; // upline memberi
                    $number = $rowmember['number_phone_member']; // number pemberi

                    $queryAddsponsor = "INSERT INTO story_sponsor_fina (
                        tgl_story_sponsor,
                        time_story_sponsor,
                        username_story_sponsor,
                        upline_story_sponsor,fnc_story_sponsor,
                        lvl_story_sponsor,number_story_sponsor
                    ) VALUES(
                        '$today',
                        '$time',
                        '$name',
                        '$sponsor',
                        '$bonussponsor',
                        '$lvl',
                        '$number'
                    )";

                    $resultAddsponsor = mysqli_query($conn, $queryAddsponsor);
                    if($resultAddsponsor){
                        return Sponsor($name, $upline, $bonus, $lvl+=1, $today, $time);
                    }
                } // end if cek
            // lanjut ke upline
            }else{
                return Sponsor($name, $upline, $bonus, $lvl+=1, $today, $time);
            }
        }
    }
}

function bonusSponsor($lvl, $sponsor){
    global $conn;
    if($lvl == 1){
        $query = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$sponsor' AND lvl_story_sponsor";
        return mysqli_query($conn, $query);
    }elseif($lvl == 2){
        $query1 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$sponsor' AND lvl_story_sponsor";
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_assoc($result1);

    }
}
?>
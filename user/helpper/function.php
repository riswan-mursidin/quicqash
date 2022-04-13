<?php  
require_once "connection.php";

function cekVisitor($date=null, $ip_visitor=null){
    global $conn;
    $query = "SELECT * FROM visitor_fina WHERE date_visit_fina='$date' AND ip_visit_fina='$ip_visitor'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        return false;
    }else{
        return true;
    }
}

function addVisit($ip_visitor){
    global $conn;
    $date = date("Y-m-d");

    if(cekVisitor($date, $ip_visitor) === true){
        $query = "INSERT INTO visitor_fina (date_visit_fina,ip_visit_fina) VALUES('$date','$ip_visitor')";
        $result = mysqli_query($conn, $query);
    }
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
    $querymember = "SELECT sponsor_member,number_phone_member,status_member FROM member_fina WHERE username_member='$usernamecheck'";
    $resultmember = mysqli_query($conn, $querymember);
    $rowmember = mysqli_fetch_assoc($resultmember);
    $sponsorup = $rowmember['sponsor_member'];
    $status = $rowmember['status_member'];
    $bonussponsor = 0;

    if($sponsorup != 'register'){
        $querymember = "SELECT sponsor_member,number_phone_member,status_member FROM member_fina WHERE username_member='$name'";
        $resultmember = mysqli_query($conn, $querymember);
        $rowmember = mysqli_fetch_assoc($resultmember);
        $sponsor = $rowmember['sponsor_member'];
        $number = $rowmember['number_phone_member'];

        if($lvl <= 5){
            // if($lvl == 1){
            //     $bonussponsor = $bonus*(10/100);
            // }elseif($lvl == 2){
            //     $bonussponsor = $bonus*(2/100);
            // }elseif($lvl == 3){
            //     $bonussponsor = $bonus*(1.5/100);
            // }elseif($lvl == 4){
            //     $bonussponsor = $bonus*(1/100);
            // }elseif($lvl == 5){
            //     $bonussponsor = $bonus*(0.5/100);
            // }

            $queryBonus = "SELECT level_sponsor,profit_sponsor FROM bonus_sponsor_fina WHERE level_sponsor='$lvl'";
            $resultBonus = mysqli_query($conn, $queryBonus);
            $rowBonus = mysqli_fetch_assoc($resultBonus);
            $persenBonus = $rowBonus['profit_sponsor'];
            $bonussponsor = $bonus*($persenBonus/100);

            $queryAddsponsor = "INSERT INTO story_sponsor_fina (tgl_story_sponsor,time_story_sponsor,username_story_sponsor,upline_story_sponsor,fnc_story_sponsor,lvl_story_sponsor,number_story_sponsor) VALUES('$today','$time','$name','$sponsor','$bonussponsor','$lvl','$number')";
            $resultAddsponsor = mysqli_query($conn, $queryAddsponsor);
            if($resultAddsponsor){
                return Sponsor($name, $sponsorup, $bonus, $lvl+=1, $today, $time);
            }
        }

    }

}

// number wa format
function formatNumber($number){
    if(substr(trim($number), 0,1) == 0){
        return substr_replace($number,'',0,1);
    }else{
        return $number;
    }
}

function bonusSponsor($lvl, $sponsor){
    global $conn;
    if($lvl == 1){
        $query = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$sponsor' AND lvl_story_sponsor='$lvl' ORDER BY tgl_story_sponsor DESC";
        $result = mysqli_query($conn, $query);
        $numm = 0;
        while($row=mysqli_fetch_assoc($result)){
            return "<tr>
                        <td scope='row'>".++$numm."</td>
                        <td><span style='font-size: 12px;'>".$row['tgl_story_sponsor']."</span></td>
                        <td><span style='font-size: 12px;'>".$row['username_story_sponsor']."</span></td>
                        <td><span style='font-size: 12px;'>".$row['upline_story_sponsor']."</span></td>
                        <td><span style='font-size: 12px;'>".$row['fnc_story_sponsor']." FNC</span></td>
                        <td><span style='font-size: 12px;'>0".$row['number_story_sponsor']."</span></td>
                    </tr>";
        }
    }elseif($lvl == 2){
        $query = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$sponsor' AND lvl_story_sponsor='1'";
        $result = mysqli_query($conn, $query);
        $numm = 0;
        while($row=mysqli_fetch_assoc($result)){
            $username = $row['username_story_sponsor'];
            $query2 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='$lvl' ORDER BY tgl_story_sponsor DESC";
            $result2 = mysqli_query($conn, $query2);
            while($row=mysqli_fetch_assoc($result2)){
                return "<tr>
                            <td>".++$numm."</td>
                            <td>".$row['tgl_story_sponsor']."</td>
                            <td>".$row['username_story_sponsor']."</td>
                            <td>".$row['upline_story_sponsor']."</td>
                            <td>".$row['fnc_story_sponsor']." FNC</td>
                            <td>0".$row['number_story_sponsor']."</td>
                        </tr>";
            }
        }
    }elseif($lvl == 3){
        $query = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$sponsor' AND lvl_story_sponsor='1'";
        $result = mysqli_query($conn, $query);
        $numm = 0;
        while($row=mysqli_fetch_assoc($result)){
            $username = $row['username_story_sponsor'];
            $query2 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='2'";
            $result2 = mysqli_query($conn, $query2);
            while($row=mysqli_fetch_assoc($result2)){
                $username = $row['username_story_sponsor'];
                $query3 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='$lvl' ORDER BY tgl_story_sponsor DESC";
                $result3 = mysqli_query($conn, $query3);
                while($row=mysqli_fetch_assoc($result3)){
                    return "<tr>
                                <td>".++$numm."</td>
                                <td>".$row['tgl_story_sponsor']."</td>
                                <td>".$row['username_story_sponsor']."</td>
                                <td>".$row['upline_story_sponsor']."</td>
                                <td>".$row['fnc_story_sponsor']." FNC</td>
                                <td>0".$row['number_story_sponsor']."</td>
                            </tr>";
                }
            }
        }
    }elseif($lvl == 4){
        $query = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$sponsor' AND lvl_story_sponsor='1'";
        $result = mysqli_query($conn, $query);
        $numm = 0;
        while($row=mysqli_fetch_assoc($result)){
            $username = $row['username_story_sponsor'];
            $query2 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='2'";
            $result2 = mysqli_query($conn, $query2);
            while($row=mysqli_fetch_assoc($result2)){
                $username = $row['username_story_sponsor'];
                $query3 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='3'";
                $result3 = mysqli_query($conn, $query3);
                while($row=mysqli_fetch_assoc($result3)){
                    $username = $row['username_story_sponsor'];
                    $query4 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='$lvl' ORDER BY tgl_story_sponsor DESC";
                    $result4 = mysqli_query($conn, $query4);
                    while($row=mysqli_fetch_assoc($result4)){
                        return "<tr>
                                    <td>".++$numm."</td>
                                    <td>".$row['tgl_story_sponsor']."</td>
                                    <td>".$row['username_story_sponsor']."</td>
                                    <td>".$row['upline_story_sponsor']."</td>
                                    <td>".$row['fnc_story_sponsor']." FNC</td>
                                    <td>0".$row['number_story_sponsor']."</td>
                                </tr>";
                    }
                }
            }
        }
    }elseif($lvl == 5){
        $query = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$sponsor' AND lvl_story_sponsor='1'";
        $result = mysqli_query($conn, $query);
        $numm = 0;
        while($row=mysqli_fetch_assoc($result)){
            $username = $row['username_story_sponsor'];
            $query2 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='2'";
            $result2 = mysqli_query($conn, $query2);
            while($row=mysqli_fetch_assoc($result2)){
                $username = $row['username_story_sponsor'];
                $query3 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='3'";
                $result3 = mysqli_query($conn, $query3);
                while($row=mysqli_fetch_assoc($result3)){
                    $username = $row['username_story_sponsor'];
                    $query4 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='4'";
                    $result4 = mysqli_query($conn, $query4);
                    while($row=mysqli_fetch_assoc($result4)){
                        $username = $row['username_story_sponsor'];
                        $query5 = "SELECT * FROM story_sponsor_fina WHERE upline_story_sponsor='$username' AND lvl_story_sponsor='$lvl' ORDER BY tgl_story_sponsor DESC";
                        $result5 = mysqli_query($conn, $query5);
                        while($row=mysqli_fetch_assoc($result5)){
                            return "<tr>
                                        <td>".++$numm."</td>
                                        <td>".$row['tgl_story_sponsor']."</td>
                                        <td>".$row['username_story_sponsor']."</td>
                                        <td>".$row['upline_story_sponsor']."</td>
                                        <td>".$row['fnc_story_sponsor']." FNC</td>
                                        <td>0".$row['number_story_sponsor']."</td>
                                    </tr>";
                        }
                    }
                }
            }
        }
    }
}
?>
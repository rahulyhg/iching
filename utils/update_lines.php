<?php

$n = 6;
$dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'root', '1q2w3e');

$strs = getStrs($dbh,$n);
//print_r($strs);
//exit;
//$id=1;
foreach ($strs as $str) {
    $sparts = explode("|", $str['line_'.$n]);
    //echo "-- $id\n";
    //echo "--   #".$str['id']."\n";
    $i = 1;
    echo ("-- " . $str['id'] . "\n");
    foreach ($sparts as $spart) {
        //echo $str['id']."\n";
        //echo "-- PART [$i]\n";
        $id = $str['id'];
        $org = "";
        $exp = "";
        if ($i == 1) {
            $sql = "update hexagrams set line_".$n." = " . clean($spart,$dbh) . " where id = $id;\n";
        } elseif ($i == 2) {
            $org .= $spart;
            $sql = "update hexagrams set line_".$n."_org = " . clean($org,$dbh) . " where id = $id;\n";
        } elseif ($i > 2) {
            if ($i == 3) {
                $exp = $spart;
            }
            if ($i == 4) {
                $exp .= " " . $spart;
            }
            if ($i == 5) {
                $exp .= " " . $spart;
            }
            if ($i == 6) {
                $exp .= " " . $spart;
            }
            $sql = "update hexagrams set line_".$n."_exp = " . clean($exp,$dbh) . " where id = $id;\n";
        }
        $i++;
        echo $sql;
    }
    //$id++;
}

function clean($str,$dbh) {
    $s = trim($str);
    $s = str_replace('\n', '', $s);
    $s = str_replace('\r', '', $s);
//    $s = stripslashes($s);
//    $s = htmlentities($s);
//    $s = strip_tags($s);
    $s = $dbh->quote($s);
//    $s = mysql_real_escape_string($s);
    return($s);
}

function getStrs($dbh,$n) {
//    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'root', '1q2w3e');
    $sql = "select id,line_".$n." from hexagrams";
    $sth = $dbh->prepare($sql);
    $sth->execute(array(null));
    $strs = $sth->fetchAll();
    return($strs);
}

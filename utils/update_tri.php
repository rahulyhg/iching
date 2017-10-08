<?php

$n = 6;
$dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'root', '1q2w3e');

$strs = getStrs($dbh, $n);
foreach ($strs as $str) {
    $x = explode("above", $str['trigrams']);
//    print_r($x);
    $sparts = explode("below", $x[1]);
    $i = 1;
    echo ("-- " . $str['id'] . "\n");
    foreach ($sparts as $spart) {
        $id = $str['id'];
        $upper = $sparts[0];
        $lower = $sparts[1];
        $sql = "update hexagrams set tri_upper = " . clean($upper, $dbh) . " where id = $id;\n";
        echo $sql;
        $sql = "update hexagrams set tri_lower = " . clean($lower, $dbh) . " where id = $id;\n";
        echo $sql;
        $i++;
    }
}

function clean($str, $dbh) {
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

function getStrs($dbh, $n) {
//    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'root', '1q2w3e');
    $sql = "select id,trigrams from hexagrams";
    $sth = $dbh->prepare($sql);
    $sth->execute(array(null));
    $strs = $sth->fetchAll();
    return($strs);
}

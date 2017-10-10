<?php

function getToss() {
    $tossed = tossit();
    
    $delta = array(0, 0, 0, 0, 0, 0);
    
    // if we are using static number we have to do it diffenely
    $newFinal = null;
    $newTossed = null;
    
    if (isset($_REQUEST['f_tossed'])) {
        $newTossed = str_split(sprintf("%06d",decbin(chex2bin($_REQUEST['f_tossed']))));
        $newFinal = str_split(sprintf("%06d",decbin(chex2bin($_REQUEST['f_final']))));
    
        
 
        for ($i = 0; $i < 6; $i++) {
            if (($newTossed[$i] != $newFinal[$i])) {
                if ($newFinal[$i] == 1) {
                    $newTossed[$i] = 6;
                    $delta[$i] = 1;
                    $newFinal[$i] = 9;
                }
                if ($newFinal[$i] == 0) {
                    $newTossed[$i] = 9;
                    $delta[$i] = 1;
                    $newFinal[$i] = 6;
                }
            } 
            if (($newTossed[$i] == $newFinal[$i])) {
                if ($newFinal[$i] == 1) {
                    $newTossed[$i] = 7;
                    $delta[$i] = 0;
                    $newFinal[$i] = 7;
                }
                if ($newFinal[$i] == 0) {
                    $newTossed[$i] = 8;
                    $delta[$i] = 0;
                    $newFinal[$i] = 8;
                }
            } 
        }
        $tossed = $newTossed;
        // it gets recalced later, so clear it
        $delta = array(0, 0, 0, 0, 0, 0);//reset it 
    }
    



// back to the normal  processing

    for ($i = 0; $i < 6; $i++) {
        if (($tossed[$i] == 6) || ($tossed[$i] == 9)) {
            $delta[$i] = 1;
        }
    }
    // confused as to why this has to be reversed 
    $delta = array_reverse($delta);

    $final = getFinal($tossed);
    //override it static
    if (isset($_REQUEST['f_final'])) {
        $final = $newFinal;
    }
    
//    var_dump($tossed);
//    var_dump($delta);
//    var_dump($final);
    
    $tossed_bin = tobin($tossed);
    $final_bin = tobin($final);
    
$sql=<<<EOX
    SELECT 
        fix
        `comment`
        ,filename
        ,pseq
        ,bseq
        ,`binary`
        ,title
        ,trans
        ,trigrams
               ,(SELECT distinct concat(
            ' TITLE: **',trigrams.title,'**',
            ' TRANS: **',trigrams.trans,'**',
            ' ELEMENT: **',trigrams.t_element,'**',
            ' POLARITY: **',trigrams.polarity,'**',
            ' PLANET: **',trigrams.planet,'**'
            )   FROM
            hexagrams
            Inner Join trigrams ON hexagrams.tri_upper_bin = trigrams.bseq 
            WHERE hexagrams.binary = '${tossed_bin}' limit 1
            ) as tri_upper
        ,(SELECT distinct concat(
            ' TITLE: **',trigrams.title,'**',
            ' TRANS: **',trigrams.trans,'**',
            ' ELEMENT: **',trigrams.t_element,'**',
            ' POLARITY: **',trigrams.polarity,'**',
            ' PLANET: **',trigrams.planet,'**'
            )   FROM
            hexagrams
            Inner Join trigrams ON hexagrams.tri_lower_bin = trigrams.bseq 
            WHERE hexagrams.binary = '${tossed_bin}' limit 1
         ) as tri_lower
        ,dir
        ,explanation
        ,judge_old
        ,judge_exp
        ,image_old
        ,image_exp
        ,line_1
        ,line_1_org
        ,line_1_exp
        ,line_2
        ,line_2_org
        ,line_2_exp
        ,line_3
        ,line_3_org
        ,line_3_exp
        ,line_4
        ,line_4_org
        ,line_4_exp
        ,line_5
        ,line_5_org
        ,line_5_exp
        ,line_6
        ,line_6_org
        ,line_6_exp

FROM hexagrams
    WHERE hexagrams.`binary` =         
EOX;

//    $sql = "SELECT * FROM hexagrams WHERE hexagrams.`binary` =  '$tossed_bin'";
    $sql = $sql . "'$tossed_bin'";
    $tossedData = getData($sql);

//    $sql = "SELECT * FROM hexagrams WHERE hexagrams.`binary` =  '$final_bin'";
    $sql = $sql . "'$final_bin'";
    $finalData = getData($sql);
    return(array('tossed' => $tossedData, 'delta' => $delta, 'final' => $finalData));
}
function getTri() {
    $sql = "SELECT * FROM trigrams";
    $d = getData($sql);

    return($d);
}

function getFinal($tossed) {
    $final = $tossed;
    $delta = array(0, 0, 0, 0, 0, 0);
    for ($i = 0; $i < 6; $i++) {
        if ($tossed[$i] == 6) {
            $final[$i] = 9;
        }
        if ($tossed[$i] == 9) {
            $final[$i] = 6;
        }
    }
    return($final);
}

function tobin($ary) {
    $bstr = "";
    $cvt = array('6' => 0, '7' => 1, '8' => 0, '9' => 1);
    for ($i = 0; $i < 6; $i++) {
        $bstr .= ($cvt[$ary[$i]]);
    }
    return($bstr);
}

function getData($sql) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    //$sql = "SELECT * from hexagrams where binary = '$bstr'";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll();
    return($res);
}

function tossit() {
    //return anything as it will get overwritten in getToss();
    if (isset($_REQUEST['f_tossed'])) {
        $r = array(6, 7, 8, 9, 6, 7);
        return($r);
    }    
    if (isset($_REQUEST['mode'])) {
        if ($_REQUEST['mode'] == "testmode") {
            $r = array(rand(6,9), rand(6,9), rand(6,9), rand(6,9), rand(6,9), rand(6,9));
            //var_dump($r);
            return($r);
        }    
    }    

    if (isset($_REQUEST['mode'])) {
        if ($_REQUEST['mode'] == "random.org") {    
            $throw = array(null, null, null, null, null, null);
            for ($i = 0; $i < 6; $i++) {
                $id = uniqid();
                $f = "./throw.sh ${id} ${i}";
                $run = trim(system($f));
                $flip = file_get_contents("id/${id}"); 


                switch ($flip) {
                    case 0:
                        $throw[$i] = 6;
                        break;
                    case 1:
                        $throw[$i] = 7;
                        break;
                    case 2:
                        $throw[$i] = 8;
                        break;
                    case 3:
                        $throw[$i] = 9;
                        break;
                }
                sleep(5);
            }
        }
        return($throw);
    }
}

    /*
      //   Find a quiet place, and take a few moments to relax and meditate on your query. Concentrate on your question or the situation for which you seek guidance.
      //Taking the 50 sticks in your hand, remove one stick and set it aside.

      $sticks = 50 -1;
      //With the 49 sticks remaining, divide them into two (right side and left side) and place them down side by side.
      $left_floor = rand (1,48);
      $right_floor = $sticks - $left;

      // 4 Take the bunch on the right side (with your right hand), and remove one stick, placing it on your left hand,
      //between your ring (fourth) and little finger (pinkie).
      $right_hand - $right_floor -1;
      // 5 From the left-side bunch, remove groups of four sticks at a time, until four or less sticks are left. Set this aside.
      $left_floor_remaining = ($left_floor % 4);
      $left_floor_remaining = ($left_floor_remaining == 0 ? 4 : $left_floor_remaining);
      // 6 Taking back the right-side bunch, remove four sticks at a time again, until four of less remain. Set this aside.
      $right_floor_remaining = ($rightfloor_ % 4);
      $right_floor_remaining = ($right_floor_remaining == 0 ? 4 : $right_floor_remaining);
      // 7 Place the remainder from the left-hand bunch between the ring finger and the middle finger and the remainder from the
      $left_hand = $left_floor_remaining;

      //right-hand bunch between the middle finger and index finger of the left hand.
      $left_hand += $right_floor_remaining;
      //Take all the sticks from your left hand and set them aside. Gather the remaining sticks and divide them into two bunches.
      $remaining = $sticks - $left_hand;
     */

function sql($vars) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "UPDATE hexagrams set " . $vars['name'] . " = :val WHERE ID = " . $vars['i'];
    $sth = $dbh->prepare($sql);
    $sth->execute(array(":val" => $vars['val']));
}
function getAllHexes() {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT * from hexagrams";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $ah = $sth->fetchAll();
    return($ah);
}
function oldlogout($t,$str=null) {
    $dumpStr =  str_replace( "\n", '<br />', var_export($t,TRUE));
    $dumpStr =  str_replace( "\"", '\'', $dumpStr);
    $dumpStr = "<b>".$str ."</b><hr>".$dumpStr; 
    $debugBlock = <<<EOX
    <script>
    $(document).ready(function () {
        $("#debug").prepend("${dumpStr}");
    });    
    </script>  
EOX;
    echo $debugBlock;
}
function c_sub($fr,$to) {
    $r = $to-$fr;
    echo "<span class='smallinfo'>$to-$fr (=".$r.")";
    if ($r < 0) {
        $r = $r +63;
        echo " +63 ";
    }
    echo " = $r</span><br>";
    return($r);
}

function outProc1($a,$j) {
    echo "<a href='?consult.php?hex=".$a[$j]['pseq']."'><img class='heximg' src='images/hex/hexagram".f($a[$j]['pseq']).".png'>".$a[$j]['pseq']." [b:".$a[$j]['bseq']."] / ".$a[$j]['title']." / ".$a[$j]['trans']."</a>";        
}
function getHex($h) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT * from hexagrams where pseq=${h}";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $ah = $sth->fetchAll();
    return($ah);
}

function getBin($h) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT * from hexagrams where bseq=${h}";
//    var_dump($sql);
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $ah = $sth->fetchAll();
    return($ah);
}

function cbin2hex($b) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT pseq from hexagrams where bseq=${b}";
    $sth = $dbh->prepare($sql);
//    var_dump($sql);
    $sth->execute();
    $hex = $sth->fetch();
    return($hex['pseq']);
}

function chex2bin($h) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT bseq from hexagrams where pseq=${h}";
//    var_dump($sql);
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $bin = $sth->fetch();
    return($bin['bseq']);
}
function logout($t) {
    $dumpStr =  str_replace( "\n", '<br />', var_export($t,TRUE));
    $dumpStr =  str_replace( "\"", '\'', $dumpStr);
    $debugBlock = <<<EOX
    <script>
    $(document).ready(function () {
        $("#debug").html("${dumpStr}");
    });    
    </script>  
EOX;
    echo $debugBlock;
}
function getTransByBin($bin) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT trans from hexagrams where bseq=${bin}";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $hex = $sth->fetch();
    return($hex['trans']);
}

function f($n) {
    return(sprintf("%02d",$n));
}

function fromtoprint($b,$h,$f) {
//    var_dump($b);
//    var_dump($h);
    $x = $b - $f['bseq'];
//    echo "${b} - ${f['bseq']} = ${x}";
    if ($x < 0) {
        $x = $x+63;
//        echo " + 63 ";
    } 
//    echo " = ". $x."\n";
    
    
    $s = "To get from ";
    $s .= "<a href=\"show.php?bin=".$f['bseq']." target=\"blank_\">";
    $s .= "<img class=\"smallerheximg\" src=\"images/hex/hexagram".f($f['pseq']).".png\">"; 
    $s .= $f['pseq']."/ [b:".$f['bseq']."]";
    $s .= $f['trans'];
    $s .= "</a> to"; 
    $s .= "<a href=\"show.php?bin=".$b." target=\"blank_\">";
    $s .= "<img class=\"smallerheximg\" src=\"images/hex/hexagram".f($h).".png\">"; 
    $s .= $h."/ [b:".$b."]".getTransByBin($b);
    $s .= "</a> you need...<p>";

    return($s);
}
<?php

//$dbh = new DataMapper();
//DataMapper$stuff = $mapper->fetchAllHexByPseq(11,TRUE);    
require get_cfg_var("iching_root") . "/lib/class/CssHex.class.php";

function makeHex($tossed, $delta, $uid, $whichToFade) {
    $cssHex = new CssHex();
    $script = "";


    $out = "<div id='${uid}'>\n";
//    $hex1 = code that builds '$tossed' hex
//    $script = gathered code to print into page
//    $newHex = the resutl of $tossed and $delta    

    list($hex1, $script, $newHex) = $cssHex->drawHex($tossed, $delta, $script, 1, $uid);
    $out .= "<div id='tossed_${uid}' class='" . (($whichToFade == "fade_tossed") ? "faded" : "live") . "'>\n" . $hex1 . "</div>\n";
    $out .= "<div class='spacerbox'></div>\n";

    $a = implode($tossed);
    $b = implode($newHex);
//var_dump($a);
//var_dump($b);
//var_dump($delta);
    $a1 = bindec($a);
    //var_dump($a1);
    $b1 = bindec($b);
    //  var_dump($b1);

    $c = ($b1 - $a1 < 0 ? ($b1 - $a1) + 63 : $b1 - $a1);
    //    var_dump("c");
    //      var_dump($c);
    $q = sprintf("%06d", decbin($c));
//       var_dump($q);
    $c1 = sprintf("%06d", $q);
//          var_dump($c1);

    $Thex = str_split($c1);
    list($Thex2, $script, $TnewHex) = $cssHex->drawHex($Thex, array(0, 0, 0, 0, 0, 0), $script, 3, $uid);
    $out .= "<div  id='tossed_${uid}' class='trx_faded'>\n" . $Thex2 . "</div>\n";
    $out .= "<div class='spacerbox'></div>\n";

//
//        
    list($hex2, $script, $newHex) = $cssHex->drawHex($newHex, array(0, 0, 0, 0, 0, 0), $script, 2, $uid);
    $out .= "<div  id='final_${uid}' class='" . (($whichToFade == "fade_final") ? "faded" : "live") . "'>\n" . $hex2 . "</div>\n";
    // var_dump($tossed);
    // var_dump($TnewHex);
    // var_dump($newHex);












    $tossed_pseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "pseq", implode($tossed));
    $trx_pseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "pseq", implode($Thex));
    $final_pseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "pseq", implode($newHex));

    $tossed_bseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "bseq", implode($tossed));
    $trx_bseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "bseq", implode($Thex));
    $final_bseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "bseq", implode($newHex));

    $tossed_trans = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "trans", implode($tossed));
    $trx_trans = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "trans", implode($Thex));
    $final_trans = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "trans", implode($newHex));

    $tossed_iq32_theme = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "iq32_theme", implode($tossed));
    $trx_iq32_theme = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "iq32_theme", implode($Thex));
    $final_iq32_theme = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "iq32_theme", implode($newHex));


//
//        $tossed_iq32_desc = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams","iq32_desc",implode($tossed));
//        $tossed_iq32_desc = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams","iq32_desc",implode($tossed));
//        $final_iq32_desc = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams","iq32_desc",implode($newHex));


    $t_sub = "<a target='_blank' href='/show.php?hex=${tossed_pseq}'><span class='st1'>$tossed_pseq</span></a><span> ($tossed_bseq)    </span><br><span class='st2'>$tossed_trans  </span><br><span class='st3'>$tossed_iq32_theme </span><br>\n";
    $x_sub = "<a target='_blank' href='/show.php?hex=${trx_pseq}'><span class='st1'>$trx_pseq   </span></a><span> ($trx_bseq)       </span><br><span class='st2'>$trx_trans     </span><br><span class='st3'>$trx_iq32_theme    </span><br>\n";
    $f_sub = "<a target='_blank' href='/show.php?hex=${final_pseq}'><span class='st1'>$final_pseq </span></a><span> ($final_bseq)     </span><br><span class='st2'>$final_trans   </span><br><span class='st3'>$final_iq32_theme  </span><br>\n";

    $out .= "</div>\n";
    $out .= "<div class='clear underHex' >"
            . "<table class='ttd'>"
            . "     <tr class='rtd'>"
            . "         <td class='htd'>"
            . "             $t_sub"
            . "         </td>"
            . "         <td class='htd'>"
            . "             $x_sub<br><a id='xsubtip' class='xsubtip qtip-content ui-widget-content' href='#'><img style='width:20px' src='/images/qmark-small-bw.png'/></a>"
            . "         </td>"
            . "         <td class='htd'>"
            . "             $f_sub"
            . "         </td>"
            . "     </tr>"
            . "</table>"
            . "</div>\n";



//      $out .= "</div><div class='clear underHex' ><table class='ttd'><tr class='rtd'><td class='htd'>$t_sub</td><td class='htd'>$x_sub</td><td class='htd'>$f_sub</td></tr></table></div>\n";
//      $out .= "</div><div class='clear underHex' ><table class='ttd'><tr class='rtd'><td class='htd'>$t_sub</td><td class='htd'>$x_sub</td><td class='htd'>$f_sub</td></tr></table></div>\n";
//      $out .= "</div><div class='clear underHex' ><table class='ttd'><tr class='rtd'><td class='htd'>$t_sub</td><td class='htd'>$x_sub</td><td class='htd'>$f_sub</td></tr></table></div>\n";
//        $out .= "<div  id='trx_${uid}' class='boxD1 trx_faded'>$t_sub</div>\n";
//        $out .= "<div  id='trx_${uid}' class='boxD3 trx_faded'>$t_sub</div>\n";
//        $out .= "<div  id='trx_${uid}' class='boxD2 trx_faded'>$t_sub</div>\n";
//        $out .= "   <div>" . $x_sub . "</div>\n";
//        $out .= "</div>\n";
    //$out .= "<div class='clear'></div>\n";
//        $out .= "<div  id='final_${uid}' class='boxD2 ".(($whichToFade == "fade_final") ? "faded" :"live")."'>$_sub</div>\n";
//        $out .= "   <div>" . $f_sub . "</div>\n";
//        $out .= "</div>\n";
//        $out .="</div>\n";
//        





    $out .= "<script>\n$(document).ready(function () {\n" . $script . "});\n</script>\n";
    $out .= "</div>\n";

    return($out);
}

function getToss() {
    $tossed = tossit();


    $delta = array(0, 0, 0, 0, 0, 0);

    // if we are using static number we have to do it diffenely
    $newFinal = null;
    $newTossed = null;

    if (isset($_REQUEST['f_tossed'])) {
        $newTossed = str_split(sprintf("%06d", decbin($GLOBALS['dbh']->chex2bin($_REQUEST['f_tossed']))));
        $newFinal = str_split(sprintf("%06d", decbin($GLOBALS['dbh']->chex2bin($_REQUEST['f_final']))));

//      var_dump($_REQUEST['f_final']);
//      var_dump($GLOBALS['dbh']->chex2bin($_REQUEST['f_final']));
//      var_dump(decbin($GLOBALS['dbh']->chex2bin($_REQUEST['f_final'])));
//  var_dump($newFinal);
//

        for ($i = 0; $i < 6; $i++) {
            if (($newTossed[$i] != $newFinal[$i])) {
                if ($newFinal[$i] == 1) {   // if newFinal == 1 then newTossed == 0
                    $newTossed[$i] = 6;     // so newTossed mucgt be a moving YIN == 6
                    $delta[$i] = 1;         // and that is a delta
                    $newFinal[$i] = 9;      // and we change the newFinal accordingly, preserrving movement
                }
                if ($newFinal[$i] == 0) {   // if newFinal == 0 then newTossed == 1
                    $newTossed[$i] = 9;     // so newTossed must be a moving YANG == 9
                    $delta[$i] = 1;         // mark the delta
                    $newFinal[$i] = 6;      // change the new final to a YIN preserving movement
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
        $delta = array(0, 0, 0, 0, 0, 0); //reset it 
    }
    //      var_dump($newTossed);
    //       var_dump($newFinal);
//        var_dump($delta);
// back to the normal  processing

    for ($i = 0; $i < 6; $i++) {
        if (($tossed[$i] == 6) || ($tossed[$i] == 9)) {
            $delta[$i] = 1;
        }
    }
    // confused as to why this has to be reversed 
    //$delta = array_reverse($delta);

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

    $sql = <<<EOX
    SELECT 
        fix
        ,`comment`
        ,filename
        ,pseq
        ,bseq
        ,`binary`
        ,title
        ,trans
        ,trigrams
               ,(SELECT distinct concat(
            ' TITLE: **',trigrams.title,' / ',trigrams.trans,'**',
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
        ,iq32_dir
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

    $query = $sql . "'$tossed_bin'";
    $tossedData = $GLOBALS['dbh']->getData($query);

    $query = $sql . "'$final_bin'";
    $finalData = $GLOBALS['dbh']->getData($query);

    $res = array('tossed' => $tossedData, 'delta' => $delta, 'final' => $finalData);
    return($res);
}

function getTri() {
    $sql = "SELECT * FROM trigrams";
    return($GLOBALS['dbh']->getData($sql));
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

function tossit() {
    //var_dump($_REQUEST);
    //return anything as it will get overwritten in getToss();
    if (isset($_REQUEST['f_tossed'])) {
        $r = array(6, 7, 8, 9, 6, 7);
        return($r);
    }
    if (isset($_REQUEST['mode'])) {
        if ($_REQUEST['mode'] == "plum") {
            $r = getPlumBlossomArray();

            //$r = array(rand(6,9), rand(6,9), rand(6,9), rand(6,9), rand(6,9), rand(6,9));
            //var_dump($r);
            return($r);
        }
        if ($_REQUEST['mode'] == "random.org") {
            $r = getHotBits();
            //$r = array(rand(6,9), rand(6,9), rand(6,9), rand(6,9), rand(6,9), rand(6,9));
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

//function sql($vars) {
//    global $dbh;
//    $sql = "UPDATE hexagrams set " . $vars['name'] . " = :val WHERE ID = " . $vars['i'];
//    $sth = $dbh->o->prepare($sql);
//    $sth->execute(array(":val" => $vars['val']));
//}
//function getAllHexes() {
//    global $dbh;
//    $sql = "SELECT * from hexagrams";
//    $sth = $dbh->o->prepare($sql);
//    $sth->execute();
//    $ah = $sth->fetchAll();
//    return($ah);
//}


function getHotBits() {

    $lines = array();
    for ($i = 0; $i < 6; $i++) {
        $hotbits = getCleanHotBits();
        $line = null;
        foreach ($hotbits as $tb) {
            $c = ($tb % 2) + 2;
            $line += ($tb % 2) + 2;
        }
        array_push($lines, $line);
    }
    //var_dump($lines);
    return($lines);
}

function getCleanHotBits() {
    $intAry = array();
    $hotbitsURL = "http://www.fourmilab.ch/cgi-bin/uncgi/Hotbits?nbytes=3&fmt=c&apikey=HB1P93mBRUA23F7HUF5MCpyZ2PS";
    $str = file_get_contents($hotbitsURL);
//    $str = "/* Random data from the HotBits radioactive random number generator */\nunsigned char hotBits[3] = {\n    10, 240, 151\n};";
    
    preg_match('/[\d].*[\d]/', $str, $matches, PREG_OFFSET_CAPTURE);
    $str = ($matches[0][0]);
    $hotbits = explode(",", $str);
    
    foreach ($hotbits as $h) {
        array_push($intAry, intval(trim($h)));
    }
    //var_dump($intAry);
    return($intAry);
}

function oldlogout($t, $str = null) {
    $dumpStr = str_replace("\n", '<br />', var_export($t, TRUE));
    $dumpStr = str_replace("\"", '\'', $dumpStr);
    $dumpStr = "<b>" . $str . "</b><hr>" . $dumpStr;
    $debugBlock = <<<EOX
    <script>
    $(document).ready(function () {
        $("#debug").prepend("${dumpStr}");
    });    
    </script>  
EOX;
    echo $debugBlock;
}

function c_sub($fr, $to) {
    $r = $to - $fr;
    echo "<span class='smallinfo'>$to-$fr (=" . $r . ")";
    if ($r < 0) {
        $r = $r + 63;
        echo " +63 ";
    }
    echo " = $r</span><br>";
    return($r);
}

function outProc1($a, $j) {
    echo "<a href='?consult.php?hex=" . $a[$j]['pseq'] . "'><img class='heximg' src='images/hex/hexagram" . f($a[$j]['pseq']) . ".png'>" . $a[$j]['pseq'] . " [b:" . $a[$j]['bseq'] . "] / " . $a[$j]['title'] . " / " . $a[$j]['trans'] . "</a>";
}

function logout($t) {
    $dumpStr = str_replace("\n", '<br />', var_export($t, TRUE));
    $dumpStr = str_replace("\"", '\'', $dumpStr);
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
    global $dbh;
    $sql = "SELECT trans from hexagrams where bseq=${bin}";
    $sth = $dbh->o->prepare($sql);
    $sth->execute();
    $hex = $sth->fetch();
    return($hex['trans']);
}

function f($n) {
    return(sprintf("%02d", $n));
}

function fromtoprint($b, $h, $f) {
//    var_dump($b);
//    var_dump($h);
    $x = $b - $f['bseq'];
//    echo "${b} - ${f['bseq']} = ${x}";
    if ($x < 0) {
        $x = $x + 63;
//        echo " + 63 ";
    }
//    echo " = ". $x."\n";


    $s = "To get from ";
    $s .= "<a href=\"show.php?bin=" . $f['bseq'] . " target=\"blank_\">";
    $s .= "<img class=\"smallerheximg\" src=\"images/hex/hexagram" . f($f['pseq']) . ".png\">";
    $s .= $f['pseq'] . "/ [b:" . $f['bseq'] . "]";
    $s .= $f['trans'];
    $s .= "</a> to";
    $s .= "<a href=\"show.php?bin=" . $b . " target=\"blank_\">";
    $s .= "<img class=\"smallerheximg\" src=\"images/hex/hexagram" . f($h) . ".png\">";
    $s .= $h . "/ [b:" . $b . "]" . getTransByBin($b);
    $s .= "</a> you need...<p>";

    return($s);
}

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}

function getPlumBlossomArray() {


    $hex = array();
    $m = 0;
    for ($k = 0; $k < 6; $k++) {
        $now = microtime_float() * 10000;
        $nowAry = str_split("" . $now);

        $combo = array();

        $ci1 = rand_seq(0, 5, 5);
        $ci2 = rand_seq(6, 11, 5);

        array_push($combo, ($nowAry[$ci1[0]] + $nowAry[$ci2[5]]));
        array_push($combo, ($nowAry[$ci1[1]] + $nowAry[$ci2[4]]));
        array_push($combo, ($nowAry[$ci1[2]] + $nowAry[$ci2[3]]));
        array_push($combo, ($nowAry[$ci1[3]] + $nowAry[$ci2[2]]));
        array_push($combo, ($nowAry[$ci1[4]] + $nowAry[$ci2[1]]));
        array_push($combo, ($nowAry[$ci1[5]] + $nowAry[$ci2[0]]));

        $recombo = array();

        $rci1 = rand_seq(0, 2, 2);
        $rci2 = rand_seq(3, 5, 2);

        array_push($recombo, ($combo[$rci1[0]] + $combo[$rci2[2]]) % 4);
        array_push($recombo, ($combo[$rci1[1]] + $combo[$rci2[1]]) % 4);
        array_push($recombo, ($combo[$rci1[2]] + $combo[$rci2[0]]) % 4);

        for ($l = 0; $l < 3; $l++) {
            //if ($recombo[$l] == 0) {
            $recombo[$l] = ($recombo[$l] % 2) + 2;
            //}
        }
        $ts = $recombo[0] . "," . $recombo[1] . "," . $recombo[2];
        $t = $recombo[0] + $recombo[1] + $recombo[2];
//        print "[$t]  ";


        usleep(rand(rand(1000, 10000), rand(10000, 100000)));
        array_push($hex, $t);
        $m++;
    }
    //var_dump($hex);
    return($hex);
}

function rand_seq($fromto, $to = null, $limit = null) {

    if (is_null($to)) {
        $to = $fromto;
        $fromto = 0;
    }

    if (is_null($limit)) {
        $limit = $to - $fromto + 1;
    }
    $randArr = array();

    for ($i = $fromto; $i <= $to; $i++) {
        $randArr[] = $i;
    }
    $result = array();

    for ($i = 0; $i < $limit || sizeof($randArr) > 0; $i++) {
        $index = mt_rand(0, sizeof($randArr) - 1); // select rand index / выбираем случайный индекс массива 
        $result[] = $randArr[$index]; // add random element / добавляем случайный элемент массива 
        array_splice($randArr, $index, 1); // remove it=) / удаляем его =)
    }

    return $result;
}

function secondsToTime($ss) {
    $s = $ss % 60;
    $m = floor(($ss % (60 * 60)) / (60));
    $h = floor(($ss % (60 * 60 * 24)) / (60 * 60));
    $d = floor(($ss % (60 * 60 * 24 * 30)) / (60 * 60 * 24));
    $M = floor(($ss % (60 * 60 * 24 * 30 * 12)) / (60 * 60 * 24 * 30));
    $Y = floor($ss / (60 * 60 * 24 * 30 * 12));

//    return "$Y years, $M months, $d days, $h hours, $m minutes, $s seconds";
    return sprintf("%010d", $ss) . " = $Y years, $M months, $d days, $h hours, $m minutes, $s seconds\n";
}

$x = <<<XXX
microseconds since Jan 1 1970 is a 10 int, 4 dec number

1000000000 = 32 years, 1 months, 24 days, 1 hours, 46 minutes, 40 seconds
0100000000 = 3 years, 2 months, 17 days, 9 hours, 46 minutes, 40 seconds
0010000000 = 0 years, 3 months, 25 days, 17 hours, 46 minutes, 40 seconds
0001000000 = 0 years, 0 months, 11 days, 13 hours, 46 minutes, 40 seconds
0000100000 = 0 years, 0 months, 1 days, 3 hours, 46 minutes, 40 seconds
0000010000 = 0 years, 0 months, 0 days, 2 hours, 46 minutes, 40 seconds
0000001000 = 0 years, 0 months, 0 days, 0 hours, 16 minutes, 40 seconds
0000000100 = 0 years, 0 months, 0 days, 0 hours, 1 minutes, 40 seconds
0000000010 = 0 years, 0 months, 0 days, 0 hours, 0 minutes, 10 seconds
0000000001 = 0 years, 0 months, 0 days, 0 hours, 0 minutes, 1 seconds
        
1000000000 = 32 years

0100000000 = 3 years
0010000000 = 4 months
0001000000 = 11 days 

0000100000 = 1 day   
0000010000 = 3 hours    
0000001000 = 16 minutes 

0000000100 = 2 minutes  
0000000010 = 10 seconds 
0000000001 = 1 second   
   
0000000000.1000        
0000000000.0100        
0000000000.0010       
0000000000.0001        


//1000000000 = 32 years

1                               0100000000 = 3 years
2                           0010000000 = 4 months  
3                       0001000000 = 11 days 
4                   0000100000 = 1 day  
5               0000010000 = 3 hours    
6           0000001000 = 16 minutes         
7           0000000100 = 2 minutes  
8               0000000010 = 10 seconds 
9                   0000000001 = 1 second    
10                      0000000000.1000        
11                          0000000000.0100        
12                              0000000000.0010       
        
//13  0000000000.0001        

Now we hve 6 numbers
    
                    1
                2
            3
            4
                5
                    6
        
        
Now we ave three
    
        
        
11110010000111110001101011010       
        
101100111011110101011001011000
    

XXX;

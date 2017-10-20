<?php

//$dbh = new DataMapper();
//DataMapper$stuff = $mapper->fetchAllHexByPseq(11,TRUE);    
require get_cfg_var("iching_root") . "/lib/class/CssHex.class.php";
require_once get_cfg_var("iching_root") . "/lib/class/Tosser.class.php";


function getNotes($pseq) {
    $hex = $GLOBALS['dbh']->getNotes($pseq);
    $out = "";
    $hex[0]['pseq'] = null;
    $hex[0]['bseq'] = null;
    $hex[0]['oseq'] = null;
    $hex[0]['binary'] = null;
    $hex[0]['balance'] = null;
    $hex[0]['tri_upper_bin'] = null;
    $hex[0]['tri_lower_bin'] = null;


    foreach ($hex[0] as $key => $val) {
        if ($val) {
            $out .= "<b>$key: </b> $val<br>\n";
        }
    }

    if (!$out) {
        $out = "There are no notes yet.";
    }
    return($out);
}

function getEdStatus($t) {
    if (!$t['proofed']) {
        //print "<div class='notice'>This content has yet to be proofed.  Please disregard the typos and other errors.</div>";
        return "<div class='notice'>status: UNPROOFED</div>";
    }
}

function showComment($t) {
    if (isset($t['comment'])) {
        $out = "<div class='label'>Comments</div>\n";
        $out .= "<div class='content comment' id='comment'>${t['comment']}</div>\n";
        return($out);
    }
}

function tryFopen($fileName, $mode) {
//      var_dump($fileName);
    try {
        $fp = fopen($fileName, $mode);
        if (!$fp) {
            throw new Exception('File open failed.');
        }
    } catch (Exception $e) {
        print "<div style='width:1000px'>";

        var_dump($fileName);
        print "<hr>";
        var_dump($e);
        print "</div>";
    }
    return($fp);
}

function pvar_dump($x) {
    print "<div style='width:1000px'>";
    var_dump($x);
    print "</div>";
}


/* DEPRICATED
 * 
 
function makeMDfile($alldata) {
    $t = $alldata['t'];
    $d = $alldata['d'];
    $f = $alldata['f'];
    $homeurl = $alldata['homeurl'];
    $hdate = $t['human'];
    $ddate = $t['data'];
    $question = $t['question'];
    
    $out = "";
    $out .= "*** Original Hexagram ***:  ![Alt text](${homeurl}/images/hex/small/hexagram" . sprintf("%02d", $t['pseq']) . ".png)\n\n";
    $out .= "*** Resulting Hexagram ***: ![Alt text](${homeurl}/images/hex/small/hexagram" . sprintf("%02d", $f['pseq']) . ".png)\n\n";
    foreach ($alldata as $key => $val) {
        if (is_array($val) or ( $val instanceof Traversable)) {
            foreach ($val as $key1 => $val1) {
                if (is_array($val1) or ( $val1 instanceof Traversable)) {
                    
                } else {
                    $out .= "\n";
                    $out .= "***$key1:*** $val1\n";
                    $out .= "\n";
                }
            }
        } else {
            $out .= "\n";
            $out .= "*** $key: *** $val\n";
            $out .= "\n";
        }
    }
    return($out);
}
*/

function mergeHex($t_image,$f_image) {

    //$numberOfImages = 2;
    /*
     * JWFIX hardcoded numbers ? :(
     */
    $x = 80;
    $y = 87;
    $png = imagecreatetruecolor($x * 3, $y);
    imagesavealpha($png, true);

    /*
     * JWFIX can't get th etansparency to work when I create the image... always black, so I set to white
     */
//    $trans_colour = imagecolorallocatealpha($png, 0, 0, 0, 127);
//    imagefill($png, 0, 0, $trans_colour);
    
    $white = imagecolorallocate($png, 255, 255, 255); 
    imagefill($png,0,0,$white); 


//    $firstUrl = "http://slider.com/id/${t_image}";
//    $secondUrl = "http://slider.com/id/${f_image}";

    $firstUrl = $t_image;
    $secondUrl = $f_image;


    $outputImage = $png;

    $first = imagecreatefrompng($firstUrl);
    $second = imagecreatefrompng($secondUrl);

    imagecopymerge($outputImage, $first, 0, 0, 0, 0, $x, $y, 100);
    imagecopymerge($outputImage, $second, $x * 2, 0, 0, 0, $x, $y, 100);

//    imagejpeg($outputImage, APPLICATION_PATH . 'test.png');
//    $uid = uniqid();
    $uid=session_id();
    $fn = "/id/merge_${uid}.png";
//    $fn = get_cfg_var("iching_root")."/id/merge_${uid}.png";
    imagepng($outputImage, get_cfg_var("iching_root").$fn);

    imagedestroy($outputImage);
 
    return($fn);
}

function getServerPrefix() {
    
    $test_server_name = get_cfg_var("iching_test_server_name");
    if (!isset($_SERVER['SERVER_NAME'])) { /* empty when running form (for testing) command line */
        $_SERVER['SERVER_NAME'] = $test_server_name;
    }
    
    return("http://" . $_SERVER['SERVER_NAME']);    
}

function makeAlphaBox($x,$y) {
    $hexBox = imagecreatetruecolor($x, $y);
    imagesavealpha($hexBox, true);
    $white = imagecolorallocate($hexBox, 255, 255, 255);
    imagefill($hexBox, 0, 0, $white);
    return($hexBox);
}

function makeHexPng($t, $d, $f) {
    //$homeurl = getServerPrefix();
    $ta = str_split($t);
    $fa = str_split($f);

    $x = 80; //width of a line
    $y = 11; // height of a line
    $y_border = 4;

    $newY = ($y * 6) + (5 * $y_border); // 6 lines plus borders
    /* same probl;am as above...
     * JWFIX can't get th etansparency to work when I create the image... always black, so I set to white
     */

    $hex1 = makeAlphaBox($x,$newY);


    /* ***************************************************************
     * make hexagram 1 
     * ************************************************************** */
    $i = array();
    for ($k = 0; $k < 6; $k++) {
        if ($ta[$k] == 1) {          // line = yang
            if ($d[$k] == 1) {          // line = moving
                $i[$k] = getServerPrefix().'/images/lines/9sm.png';
            } else {                    // line = static
                $i[$k] = getServerPrefix().'/images/lines/7sm.png';
            }
        } else {                    // line = yin
            if ($d[$k] == 0) {          // line = static
                $i[$k] = getServerPrefix().'/images/lines/8sm.png';
            } else {                    //  line = moving
                $i[$k] = getServerPrefix().'/images/lines/6sm.png';
            }
        }
    }

    /* load files into array */
    $m = array();
    for ($k = 0; $k < 6; $k++) {
        $m[$k] = imagecreatefrompng($i[$k]);
    }
    /* stack on top of one another */
    for ($k = 0; $k < 6; $k++) {
        $dst_y = ($y * $k) + ($y_border * $k);
        imagecopymerge($hex1, $m[$k], 0, $dst_y, 0, 0, $x, $y, 100);
    }
    /* I use a UID to save to file ... JWFIX shoudl I use a session id instead?*/
    $u = uniqid();
    
    /* make the filename for the temporary image */
    $hex1file =  get_cfg_var("iching_root")."/id/hex1_tmp_".session_id().".png";
    $hex1fileUrl =  getServerPrefix()."/id/hex1_tmp_".session_id().".png";
    
    /* save the image */
    imagepng($hex1,$hex1file);
 
    /* clean up */
    imagedestroy($hex1);
    
    /* ***************************************************************
     * make hexagram 2 
     * ************************************************************** */

    $hex2 = makeAlphaBox($x,$newY);

    $i = array();
    for ($k = 0; $k < 6; $k++) {
        if ($fa[$k] == 1) {
            $i[$k] = getServerPrefix().'/images/lines/7sm.png';
        } else {
            $i[$k] = getServerPrefix().'/images/lines/8sm.png';
        }
    }


    $m = array();
    for ($k = 0; $k < 6; $k++) {
        $m[$k] = imagecreatefrompng($i[$k]);
    }

    for ($k = 0; $k < 6; $k++) {
        $dst_y = ($y * $k) + ($y_border * $k);
        imagecopymerge($hex2, $m[$k], 0, $dst_y, 0, 0, $x, $y, 100);
    }
   
    /* make the filename for the temporary image */
    $hex2file =  get_cfg_var("iching_root")."/id/hex2_tmp_".session_id().".png";
    $hex2fileUrl =  getServerPrefix()."/id/hex2_tmp_".session_id().".png";
    //var_dump($_SESSION);
    /* save the image */
    imagepng($hex2,$hex2file);
 
    /* clean up */
    imagedestroy($hex2);

    $isMovingLines = ($t != $f); /* 1 = moving lines, 0 = none */
    /* we make both hexes and mergethem, but if there is only one we just send back one */

    $finalFile = $hex1fileUrl;
    if ($isMovingLines) {    
       $finalFile = getServerPrefix().mergeHex($hex1fileUrl,$hex2fileUrl); /* mergeHex() does not rewturn URL, so do that here */
    }
    
//    enlargeImage($finalFile,1.3);
    
    return(enlargeImage($finalFile,2));
}

function enlargeImage($originalFile, $pct) {
    list($width, $height) = getimagesize($originalFile);
//    var_dump($width);
//    var_dump(getimagesize($originalFile));
    $newWidth = $width * $pct;
    $uid = uniqid("tmp_")."_".session_id();
    /* assume png for now */
    $targetFile = get_cfg_var("iching_root") . "/id/${uid}";


    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image_create_func = 'imagecreatefromjpeg';
            $image_save_func = 'imagejpeg';
            $new_image_ext = 'jpg';
            break;

        case 'image/png':
            $image_create_func = 'imagecreatefrompng';
            $image_save_func = 'imagepng';
            $new_image_ext = 'png';
            break;

        case 'image/gif':
            $image_create_func = 'imagecreatefromgif';
            $image_save_func = 'imagegif';
            $new_image_ext = 'gif';
            break;

        default:
            throw new Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
        unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile.$new_image_ext");
    //var_dump("$targetFile.$new_image_ext");
    return("$targetFile.$new_image_ext");
}

/* * ******************************************************************* */
/* This is mainly an import of 'makemds.php' */
/* * ******************************************************************* */

function makeMDfromTemplate($alldata) {
    /*
     * Set all teh vars we need
     */
    $t = $alldata['t'];
    $d = $alldata['d'];
    $f = $alldata['f'];
    
    //var_dump($t['trans']);
    //getServerPrefix()$homeurl = $alldata['homeurl'];
    $hdate = $t['hdate'];
    $ddate = $t['ddate'];
    $question = $t['question'];
    
    $trx_pseq = $_SESSION['trx_pseq'];
    $txhex = $GLOBALS['dbh']->getHex($trx_pseq);
    
    $fpage=null;

              
    /* 
     * make image of tossed and final hex, with colored moving lines, for pdf heading
     */
    $t_image = getServerPrefix()."/id/hex1_tmp_".session_id().".png";
//    $t_image = getServerPrefix()."/images/hex/small/hexagram" . f($t['pseq']) . ".png";
    $f_image = getServerPrefix()."/images/hex/small/hexagram" . f($f['pseq']) . ".png";
    /* makeHexPng() return the URL alrady */
    $m_image =  makeHexPng($t['binary'], $d, $f['binary']);//makeHexPng();//mergeHex($t_image,$f_image);
    //var_dump($m_image);
    /*
     * load the template processing class
     */
    include(get_cfg_var("iching_root") . "/book/templates/template.class.php");
    $type = 'pseq'; /* select the 'pseq' vale to search by */
    $cols = getcols(); /* get the column names from the database */

    /*
     * make sure they are 0 leading
     */
    $ftpseq = f($t['pseq']);
    $ffpseq = f($f['pseq']);
//    $ftpseq = sprintf("%02s", $t['pseq']);
//    $ffpseq = sprintf("%02s", $f['pseq']);

    $thex = mdgethex($ftpseq); /* this gets the first hex data from the database*/
    $fhex = mdgethex($ffpseq); /* this, the second */


    /*
     * create new template instances for each part of the final PDF
     */
    $page_title = new Template(get_cfg_var("iching_root") . "/templates/pdf_title.tpl");
    $page_hex1 = new Template(get_cfg_var("iching_root") . "/templates/pdf_hex1.tpl");
    $page_lines = new Template(get_cfg_var("iching_root") . "/templates/pdf_lines.tpl");
    $page_hex2 = new Template(get_cfg_var("iching_root") . "/templates/pdf_hex2.tpl");
    $page_trx = new Template(get_cfg_var("iching_root") . "/templates/pdf_trx.tpl");

    /*
     * set the vars for the title template
     */
    $page_title->set("hdate", $hdate);
    $page_title->set("question", "'${question}'");
    $page_title->set("merged", $m_image);

    /*
     * set the vars for the transitional hexgram template
     */    
    $page_trx->set("trx_judge_old",$txhex[0]['judge_old']);
    $page_trx->set("trx_judge_exp",$txhex[0]['judge_exp']);
    $trx_image = getServerPrefix()."/images/hex/small/hexagram" . f($txhex[0]['pseq']) . ".png";
    $page_trx->set("trx_image",$trx_image);
    $page_trx->set("trx_transtitle", $txhex[0]['pseq']." (".$txhex[0]['binary']." = ".$txhex[0]['bseq'].") ". $txhex[0]['trans']." / ".$txhex[0]['title']);
    
    /*
     * JWFIX all the labels and  shoud probably be in a config file, with language support
     */
    $page_trx->set("trx_intro","The moving lines are the lines that, due to their extreme condition, 'flip' to 
their opposite, and as a result, a new hexagram is created. Likewise, if we then subtract the binary value of the first hexagram from the 
final hexagram, we end up with a binary number that represents the difference 
between the two, and this binary number maps to yet another hexagram.  We call 
this hexagram 'transitional' as it a full hexagram that represent the moving lines. For the first and second hexagrams shown here, the transitional hexagram is ");
    $page_trx->set("trx_title","The Transitioning Hexagram");
    $page_trx->set("label_judge_old", "The Judgment:");
    $page_trx->set("label_judge_exp", "An Explanation of the Judgment");

    /*
     * set the vars for the first hexagram template.
     * First we set all the label string values
     */

    $page_hex1->set("label_resulting_hex", "The Resulting Hexagram:");
    $page_hex1->set("label_hexagram", "Hexagram:");
    $page_hex1->set("label_binary", "Binary Sequence:");
    $page_hex1->set("label_dir", "Direction:");
    $page_hex1->set("label_upper_tri", "Upper trigram:");
    $page_hex1->set("label_lower_tri", "Lower trigram:");
    $page_hex1->set("label_judge_old", "The Judgment:");
    $page_hex1->set("label_judge_exp", "An Explanation of the Judgment");
    $page_hex1->set("label_image_old", "The 'IMAGE' of the hexagram");
    $page_hex1->set("label_image_exp", "An Explanation of the 'IMAGE'");
    /*
     * then we set the data values 
     */    
    $page_hex1->set("t_image", $t_image);
    $page_hex1->set("t_id", f($thex[0]['pseq']));
    $page_hex1->set("t_trans", $thex[0]['trans']);
    $page_hex1->set("t_title", $thex[0]['title']);
    $page_hex1->set("t_transtitle", $thex[0]['trans']." / ".$thex[0]['title']);
    $page_hex1->set("t_pseq", f($thex[0]['pseq']));
    $page_hex1->set("t_bseq", f($thex[0]['bseq']));
    $page_hex1->set("t_binary", $thex[0]['binary']);
    $page_hex1->set("t_dir", $thex[0]['iq32_dir']);
    $page_hex1->set("t_tri_upper", $thex[0]['tri_upper']);
    $page_hex1->set("t_tri_lower", $thex[0]['tri_lower']);
    $page_hex1->set("t_judge_old", $thex[0]['judge_old']);
    $page_hex1->set("t_judge_exp", $thex[0]['judge_exp']);
    $page_hex1->set("t_image_old", $thex[0]['image_old']);
    $page_hex1->set("t_image_exp", $thex[0]['image_exp']);

    /*
     * set isMovingLines flag
     */
    $isMovingLines = ($thex[0]['pseq'] != $fhex[0]['pseq']); /* 1 = moving lines, 0 = none */
    
    /* 
     * set the label fro the moving lines
     */
    $movinglines = "There are no moving lines";
    $page_lines->set("movinglines", $movinglines);
    
    if ($isMovingLines) { 
        $movinglines = "The Moving Lines";
    
        $page_lines->set("movinglines", $movinglines); /* override */
        /*
         * loop through the lines setting the vars using CSS to highlight the moving lines
         */
        for ($j = 0; $j < 6; $j++) {
            $i = 6 - $j ;
            if ($d[$j]) {
                $page_lines->set("t_line_${i}", $thex[0]['line_' . $i]);
                $page_lines->set("t_line_${i}_org", $thex[0]['line_' . $i . '_org']);
                $page_lines->set("t_line_${i}_exp", $thex[0]['line_' . $i . '_exp']);
            } else {
                $page_lines->set("t_line_${i}", "<span style='color:darkgray'>".$thex[0]['line_' . $i]."</span>");
                $page_lines->set("t_line_${i}_org", "<span style='color:darkgray'>".$thex[0]['line_' . $i . '_org']."</span>");
                $page_lines->set("t_line_${i}_exp", "<span style='color:darkgray'>".$thex[0]['line_' . $i . '_exp']."</span>");
            }
        }
        
        /*
         * set vars for final hexagram
         */

        $page_hex2->set("label_resulting_hex", "The Resulting Hexagram:");
        $page_hex2->set("label_hexagram", "Hexagram:");
        $page_hex2->set("label_binary", "Binary Sequence:");
        $page_hex2->set("label_dir", "Direction:");
        $page_hex2->set("label_upper_tri", "Upper trigram:");
        $page_hex2->set("label_lower_tri", "Lower trigram:");
        $page_hex2->set("label_judge_old", "The Judgment:");
        $page_hex2->set("label_judge_exp", "An Explanation of the Judgment");
        $page_hex2->set("label_image_old", "The 'IMAGE' of the hexagram");
        $page_hex2->set("label_image_exp", "An Explanation of the 'IMAGE'");

        $page_hex2->set("f_image", $f_image);
        $page_hex2->set("f_id", f($fhex[0]['pseq']));
        $page_hex2->set("f_transtitle", $fhex[0]['trans']." / ".$fhex[0]['title']);
        $page_hex2->set("f_trans", $fhex[0]['trans']);
        $page_hex2->set("f_title", $fhex[0]['title']);
        $page_hex2->set("f_pseq", f($fhex[0]['pseq']));
        $page_hex2->set("f_bseq", f($fhex[0]['bseq']));
        $page_hex2->set("f_binary", "(".$fhex[0]['binary'].")");
        $page_hex2->set("f_dir", $fhex[0]['iq32_dir']);
        $page_hex2->set("f_tri_upper", $fhex[0]['tri_upper']);
        $page_hex2->set("f_tri_lower", $fhex[0]['tri_lower']);
        $page_hex2->set("f_judge_old", $fhex[0]['judge_old']);
        $page_hex2->set("f_judge_exp", $fhex[0]['judge_exp']);
        $page_hex2->set("f_image_old", $fhex[0]['image_old']);
        $page_hex2->set("f_image_exp", $fhex[0]['image_exp']);
        
        /**
         * Loads our layout template, settings its title and content.
         * There is one layout template for one hex only, and one for 2 hexes
         */
        
        $layout = new Template(get_cfg_var("iching_root") . "/templates/layout_moving.tpl");    
        $layout->set("title", $page_title->output());
        $layout->set("hex1", $page_hex1->output());
        $layout->set("lines", $page_lines->output());
        $layout->set("hex2", $page_hex2->output());
        $layout->set("trx", $page_trx->output());
        $fpage = $layout->output();
    } else { /* there are no nomoving lines */
        $layout = new Template(get_cfg_var("iching_root") . "/templates/layout_static.tpl");    
        $layout->set("title", $page_title->output());
        $layout->set("hex1", $page_hex1->output());
        $fpage = $layout->output();
    }
    /**
     * Outputs the page.
     */
    $fpage = $layout->output();

    return($fpage);
}

/* 
 * this is functions for makeMDfromTemplate()
 * JWFIX move this to the DataMapper class
 */

function getids($ary) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT " . $ary['bseq'] . "," . $ary['pseq'] . " from hexagrams order by " . $ary['pseq'] . " asc";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $ids = $sth->fetchAll();
// $c = array();
    foreach ($ids as $id) {
//        var_dump($id);exit;
//        array_push($c, $id[$type]);
    }
    return($ids);
}

/* 
 * this is functions for makeMDfromTemplate()
 * JWFIX move this to the DataMapper class
 */
function getcols() {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'iching' AND TABLE_NAME = 'hexagrams'";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $cols = $sth->fetchAll();
    $c = array();
    foreach ($cols as $col) {
        array_push($c, $col['COLUMN_NAME']);
    }
    return($c);
}

/* 
 * this is functions for makeMDfromTemplate()
 * JWFIX move this to the DataMapper class
 */
function mdgethex($pseq) {
    //  var_dump($bseq);
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    //$binary = sprintf("%06d", hex2bin($bseq));
    $sql = <<<EOX
    SELECT 
        `fix`
        ,`comment`
        ,`filename`
        ,pseq
        ,bseq
        ,`binary`
        ,title
        ,trans
        ,trigrams
               ,(SELECT distinct concat(
            ' TITLE: **',trigrams.title,' / ', trigrams.trans,'**',
            ' ELEMENT: **',trigrams.t_element,'**',
            ' POLARITY: **',trigrams.polarity,'**',
            ' PLANET: **',trigrams.planet,'**'
            )   FROM
            hexagrams
            Inner Join trigrams ON hexagrams.tri_upper_bin = trigrams.bseq 
            WHERE hexagrams.pseq = '${pseq}' limit 1
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
            WHERE hexagrams.pseq = '${pseq}' limit 1
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
    WHERE hexagrams.pseq =       
EOX;
//    $sql = "SELECT * from hexagrams where ${bseq}=${id}";
    $sql = $sql . "'${pseq}'";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $hex = $sth->fetchAll(PDO::FETCH_ASSOC);
    return($hex);
}


/* * ******************************************************************** */

function saveToFile($t, $d, $f) {
    /* remove whitespces and extention from question to use as filename */
    $fname = "questions/" . mb_ereg_replace(" ", "_", $_REQUEST['question']);
    $fname = mb_ereg_replace("\?", "", $fname);
    $fname = mb_ereg_replace("\"", "", $fname);
    $fname = mb_ereg_replace("\'", "", $fname);
    $fname = mb_ereg_replace("\!", "", $fname);
    $fname = mb_ereg_replace("\,", "_", $fname);
    $fname .= "-".$t['ddate'];
    

    $alldata = array(
        'question' => $_REQUEST['question'],
        't' => $t,
        'd' => $d,
        'f' => $f
    );
    
/* no need to save any of this right now */
//    /*
//     * first just save teh raw json data in /questions/<question>_<timestamp>.json
//     */
//    $fn = $fname . ".json";
//    $json = json_encode($alldata, JSON_PRETTY_PRINT);
//    file_put_contents($fn, $json);

    /*
     * Now make the MarkDown file 
     */
    $out = makeMDfromTemplate($alldata);


    /* *************************************************** */
    /* make out filenames, and write the markdown to a file */
    /* *************************************************** */
    $outMd = get_cfg_var("iching_root") . "/" . $fname . ".md";
    $outPdf = get_cfg_var("iching_root") . "/" . $fname . ".pdf";
    $outHtml = get_cfg_var("iching_root") . "/" . $fname . ".html";


    $f = tryFopen($outMd, "w");
    fwrite($f, $out);
    fclose($f);

    /* *************************************************** */
    /* convert MARKDOWN to HTML */
    /* *************************************************** */
    $markdown = file_get_contents($outMd);
    $markdownParser = new \Michelf\MarkdownExtra();
    $html = $markdownParser->transform($markdown);

    /* *************************************************** */
    /* add CSS to the HTML and save to file */
    /* *************************************************** */
    $cssfile = getServerPrefix()."/css/pdf.css";
//    var_dump($cssfile);
    $html = "<html>\n<head>\n<link rel='stylesheet' type='text/css' href='$cssfile'>\n</head>\n<body>" . $html . "</body></html>";
//    $html = "<html>\n<head>\n</head>\n<body>" . $html . "</body></html>";

    $f = tryFopen($outHtml, "w");
    fwrite($f, $html);
    fclose($f);


    /* *************************************************** */
    /* load the HTML into a DOM parser and process any links */
    /* *************************************************** */
    $dom = \HTML5::loadHTML($html);
    $links = htmlqp($dom, 'a');
    foreach ($links as $link) {
        $href = $link->attr('href');
        if (substr($href, 0, 1) == '/' && substr($href, 1, 1) != '/') {
            $link->attr('href', $domain_name . $href);
        }
    }
    $html = \HTML5::saveHTML($dom);

    $f = tryFopen($outHtml, "w");
    fwrite($f, $html);
    fclose($f);

    /* *************************************************** 
     * load the HTML into dompdf, render it and write it 
     * DOES NOT WORK!
     *************************************************** */

////   // use Dompdf\Options;
////$options = new Options();
////$options->set('enable_html5_parser', true);
////$dompdf = new Dompdf($options);
//
//    $dompdf = new \Dompdf\Dompdf();//  DOMPDF();
//    $dompdf->load_html($html);
////    var_dump($dompdf);
//    $dompdf->render();
//    $output = $dompdf->output();
//    
//    $f = fopen($outPdf, "w");
//    fwrite($f, $output);
//    fclose($f);

    
    /* *************************************************** 
    /* have to mAke system call because dompdf is not Working 
     * See docs on the more complicated aspects of doign this 
     * on a headless server :/  Needs virtual X11 frame buffers
    *************************************************** */
    $call = get_cfg_var("iching_root")."/utils/makePdf.sh $outHtml $outPdf";
   
    $call =  "nohup sudo -u ".get_cfg_var("iching_user")." ".$call. "  >> ".get_cfg_var("iching_root")."/log/wkhtmltopdf.log 2>&1";

    system($call);
    
    /*
     * Save the final URL fro the download link on the homepage
     */
    $_SESSION['dlfile'] = getServerPrefix() . "/" . $fname . ".pdf";
    
    unlink($outMd);
    unlink($outHtml); 

    return(TRUE);
}

function showFixes($t) {
    /* FIX is special column for editing notes.  Show any FIX commenst if they exist */
    if (isset($t['fix'])) {
        return("<div class='content btn btn-danger'>FIX :${t['fix']}</div>");
    }
}

function getDates() {
    /* calc dates for rpesenation and data */
    $dataDate = date("y.m.d.H.i.s", time()) . ".U"; /* 17.10.14.14.59.32.U */
    $humanDate = date("F d, l g:i:s A (T)", time()); /* October 14, Saturday 2:59:32 PM (UTC) */
    $dates = array('human' => $humanDate, 'data' => $dataDate,);
    return $dates;
}

function makeHuKua($t) {
    $h = array(0, 0, 0, 0, 0, 0);

    $h[5] = $t[4];
    $h[4] = $t[3];
    $h[3] = $t[2];
    $h[2] = $t[3];
    $h[1] = $t[2];
    $h[0] = $t[1];

    $bin = implode($h);

    $hex = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "pseq", $bin);
//    var_dump($hex);
    return($hex);
}

function makeHex($tossed, $delta, $uid, $whichToFade) {
    $cssHex = new CssHex();
    $script = "";


    $out = "<div id='${uid}'>\n";
    /*
     * $hex1 = code that builds '$tossed' hex
     * $script = gathered code to print into page
     * $newHex = the resutl of $tossed and $delta
     */

    list($hex1, $script, $newHex) = $cssHex->drawHex($tossed, $delta, $script, 1, $uid);
    $out .= "<div id='tossed_${uid}' class='" . (($whichToFade == "fade_tossed") ? "faded" : "live") . "'>\n" . $hex1 . "</div>\n";
    $out .= "<div class='spacerbox'></div>\n";

    $a = implode($tossed);
    $b = implode($newHex);
    $a1 = bindec($a);
    $b1 = bindec($b);
    $c = ($b1 - $a1 < 0 ? ($b1 - $a1) + 63 : $b1 - $a1);
    $q = sprintf("%06d", decbin($c));
    $c1 = sprintf("%06d", $q);

    $Thex = str_split($c1);
    list($Thex2, $script, $TnewHex) = $cssHex->drawHex($Thex, array(0, 0, 0, 0, 0, 0), $script, 3, $uid);
    $out .= "<div  id='tossed_${uid}' class='trx_faded'>\n" . $Thex2 . "</div>\n";
    $out .= "<div class='spacerbox'></div>\n";

    list($hex2, $script, $newHex) = $cssHex->drawHex($newHex, array(0, 0, 0, 0, 0, 0), $script, 2, $uid);
    $out .= "<div  id='final_${uid}' class='" . (($whichToFade == "fade_final") ? "faded" : "live") . "'>\n" . $hex2 . "</div>\n";

    $tossed_pseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "pseq", implode($tossed));
    $trx_pseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "pseq", implode($Thex));
    $final_pseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "pseq", implode($newHex));

    $_SESSION['trx_pseq'] = $trx_pseq;
    $tossed_bseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "bseq", implode($tossed));
    $trx_bseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "bseq", implode($Thex));
    $final_bseq = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "bseq", implode($newHex));

    $tossed_trans = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "trans", implode($tossed));
    $trx_trans = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "trans", implode($Thex));
    $final_trans = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "trans", implode($newHex));

    $tossed_iq32_theme = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "iq32_theme", implode($tossed));
    $trx_iq32_theme = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "iq32_theme", implode($Thex));
    $final_iq32_theme = $GLOBALS['dbh']->getHexFieldByBinary("hexagrams", "iq32_theme", implode($newHex));


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
            . "             $x_sub";
    if ($whichToFade == "fade_final") {
        $out .= "<br><a id='xsubtip' class='xsubtip' href='#'><img style='width:20px' src='/images/qmark-small-bw.png'/></a>";
    }
    $out .= "         </td>"
            . "         <td class='htd'>"
            . "             $f_sub"
            . "         </td>"
            . "     </tr>"
            . "</table>"
            . "</div>\n";


    $out .= "<script>\n$(document).ready(function () {\n" . $script . "});\n</script>\n";
    $out .= "</div>\n";

    return(array('hexes' => $out, 'tpseq' => $trx_pseq));
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
//        var_dump($delta);
        /* it gets recalced later, so clear it */
        $delta = array(0, 0, 0, 0, 0, 0); //reset it 
    }

    /* back to the normal  processing */
    //var_dump($delta);
    for ($i = 0; $i < 6; $i++) {
        if (($tossed[$i] == 6) || ($tossed[$i] == 9)) {
            $delta[$i] = 1;
        }
    }
    //  var_dump($delta);
    // confused as to why this has to be reversed 
//    $delta = array_reverse($delta);
//        var_dump($delta);

    $final = getFinal($tossed);
    /*override if static */
    if (isset($_REQUEST['f_final'])) {
        $final = $newFinal;
    }

    $tossed_bin = tobin($tossed); /* convert (6,7,8,9) arrays to (1,0) arrays */
    $final_bin = tobin($final);

    /* JWFIX move to db class */
    
    $sql = <<<EOX
    SELECT 
        fix
        ,proofed
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
/* JWFIX move to DB class */
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
    $tosser = new Tosser();
    
    if (isset($_REQUEST['f_tossed'])) {
        /* return anything as it will get overwritten by the manually entered vals in getToss(); */
        $r = array(6, 7, 8, 9, 6, 7);
        return($r);
    }
    if (isset($_REQUEST['mode'])) {
        if ($_REQUEST['mode'] == "plum") {
            $r = $tosser->getPlum();
            return($r);
        }
        if ($_REQUEST['mode'] == "r-decay") {
            $r = $tosser->getHotBits();
//            $r = getHotBits();
            return($r);
        }
    }
    if (isset($_REQUEST['mode'])) {
        if ($_REQUEST['mode'] == "random.org") {
            $r = $tosser->getRandomOrg();
        }
        return($r);
    }
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
/* JWFIX move to DB class */
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

//$x = <<<XXX
//microseconds since Jan 1 1970 is a 10 int, 4 dec number
//
//1000000000 = 32 years, 1 months, 24 days, 1 hours, 46 minutes, 40 seconds
//0100000000 = 3 years, 2 months, 17 days, 9 hours, 46 minutes, 40 seconds
//0010000000 = 0 years, 3 months, 25 days, 17 hours, 46 minutes, 40 seconds
//0001000000 = 0 years, 0 months, 11 days, 13 hours, 46 minutes, 40 seconds
//0000100000 = 0 years, 0 months, 1 days, 3 hours, 46 minutes, 40 seconds
//0000010000 = 0 years, 0 months, 0 days, 2 hours, 46 minutes, 40 seconds
//0000001000 = 0 years, 0 months, 0 days, 0 hours, 16 minutes, 40 seconds
//0000000100 = 0 years, 0 months, 0 days, 0 hours, 1 minutes, 40 seconds
//0000000010 = 0 years, 0 months, 0 days, 0 hours, 0 minutes, 10 seconds
//0000000001 = 0 years, 0 months, 0 days, 0 hours, 0 minutes, 1 seconds
//        
//1000000000 = 32 years
//
//0100000000 = 3 years
//0010000000 = 4 months
//0001000000 = 11 days 
//
//0000100000 = 1 day   
//0000010000 = 3 hours    
//0000001000 = 16 minutes 
//
//0000000100 = 2 minutes  
//0000000010 = 10 seconds 
//0000000001 = 1 second   
//   
//0000000000.1000        
//0000000000.0100        
//0000000000.0010       
//0000000000.0001        
//
//
////1000000000 = 32 years
//
//1                               0100000000 = 3 years
//2                           0010000000 = 4 months  
//3                       0001000000 = 11 days 
//4                   0000100000 = 1 day  
//5               0000010000 = 3 hours    
//6           0000001000 = 16 minutes         
//7           0000000100 = 2 minutes  
//8               0000000010 = 10 seconds 
//9                   0000000001 = 1 second    
//10                      0000000000.1000        
//11                          0000000000.0100        
//12                              0000000000.0010       
//        
////13  0000000000.0001        
//
//Now we hve 6 numbers
//    
//                    1
//                2
//            3
//            4
//                5
//                    6
//        
//        
//Now we ave three
//    
//        
//        
//11110010000111110001101011010       
//        
//101100111011110101011001011000
//    
//
//XXX;


            function putBtnExpand() {
            echo ""
                . "<span>"
                    . "<a id ='btnEC' style='text-decoration: none' class='accordion-expand-all' href='#'>[+]</a>"
                . "</span>\n";
            }
            
            function putBtnEdit($pseq) {
            echo ""
                . "<span>"
                    . "<a href='/cignite/index.php/main/hexagrams/edit/${pseq}' target='_blank'>"
                        . "<img class='uibtn'  src='/images/btn_edit.png'>"
                    . "</a>"
                . "</span>\n";
            }
            
            function putBtnUpdate($pseq) {
                echo ""
                . "<span>"
                    . "<a href='/cignite/index.php/main/notes/edit/${pseq}' target='_blank'>"
                        . "<img class='uibtn' src='/images/btn_update.png'>"
                    . "</a>"
                . "</span>\n";
            }
            
            function putBtnSmTxt() {
                echo ""
                . "<span>"
                        . "<img class='uibtn' id='larger1'  src='/images/btn_smalltxt.png'>"
                . "</span>\n";
            }
            
            function putBtnMedTxt() {
                echo ""
                . "<span>"
                        . "<img class='uibtn' id='larger2'  src='/images/btn_medtxt.png'>"
                . "</span>\n";
            }
            
            function putBtnLgTxt() {
                echo ""
                . "<span>"
                        . "<img class='uibtn' id='larger3'  src='/images/btn_lgtxt.png'>"
                . "</span>\n";
            }

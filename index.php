
<?php
require get_cfg_var("iching_root") . "/elements/header.php";
require get_cfg_var("iching_root") . "/vendor/autoload.php";
require get_cfg_var("iching_root") . "/conf/config.php";
require get_cfg_var("iching_root") . "/lib/init.php";
require get_cfg_var("iching_root") . "/lib/functions.php";

//var_dump($_dbh);
$a = null;
?>

<section>
    <!-- div class="content"><strong> The Dharma Clock Project's I Ching page</strong></div-->
</section>

<section id="pageContent">

    <div class="container">

        <div class="row1">
            <span class="btn btn-warning"><a href="index.php">RESET</a></span>
            <span class="btn btn-danger"><a style="color:white;font-weight: bold;" href="/book/ichingbook/_book/">DOCS</a></span>
            <span class="btn btn-danger"><a style="color:white;" href="show.php<?= (isset($_REQUEST['hex']) ? "?hex=" . $_REQUEST["hex"] : '') ?>" >Browse</a></span>    <p>
        </div>

        <!-- ------------------------------------------------------------>

        <?php
        //var_dump($_REQUEST);
        if (!isset($_REQUEST['flipped'])) {
            ?>
            <div class="qbox">

                <form id = "tosstype" method="POST" action="">
                    <input type="hidden" name="flipped" value="1">
                    <div class="row2">
                        <input id="qfield" type="text" name="question" placeholder="question" value=""></p>
                        <!-- a id="testtip" href="#"><img src="images/qmark.png"></a> <input type="radio" name="mode"  id="testmode"  value="testmode" > <span class="text_mdcaps" id="test-modemsg">test-mode</span></p -->
                        <a id="plumtip"     href="#"><img src="images/qmark.png"></a> <input type="radio" name="mode" id="plum"         value="plum"       checked > <span class="text_mdcaps" id="plummsg">Modern Plum</span>    </p>
                        <a id="randomtip"   href="#"><img src="images/qmark.png"></a> <input type="radio" name="mode" id="random.org"   value="random.org"          > <span class="text_mdcaps" id="random.orgmsg">random.org</span></p>
                        <a id="entropytip"  href="#"><img src="images/qmark.png"></a> <input type="radio" name="mode" id="entropy"      value="entropy"             > <span class="text_mdcaps" id="entropymsg">entropy</span>      </p>
                        <a id="r-decaytip"  href="#"><img src="images/qmark.png"></a> <input type="radio" name="mode" id="r-decay"      value="r-decay"             > <span class="text_mdcaps" id="r-decaymsg">r-decay</span>      </p>

                        <span class="text_mdcaps" id="baynesmsg">Wilhelm/Baynes</span> <input type="radio" name="trans" id="baynes" value="baynes" checked > <a id="baynestip" href="#"><img src="images/g-qmark.png"></a></p> 
                        <span class="text_mdcaps" id="aculturalmsg">Acultural</span> <input type="radio" name="trans" id="acultural" value="acultural"  > <a id="aculturaltip" href="#"><img src="images/g-qmark.png"></a></p>


                        <input class = "btn btn-info" style="width:100%" type="submit" value="Cast Coins">
                    </div>
                </form>
                <form method="POST" action="">
                    <input type="hidden" name="flipped" value="1">
                    <div class="row3">
                        <div class="text_smcaps">Or enter 2 hex nums    </div>
                        <input class = "doublenum" id="f_tossed" type="text" name="f_tossed" placeholder="<?php echo rand(1, 64) ?>" value="">
                        <input class = "doublenum" id="f_final" type="text" name="f_final" placeholder="<?php echo rand(1, 64) ?>" value="">
                        <input class = "btn btn-primary" type="submit" value="Show">
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        $_REQUEST['question'] = "no question asked"
        ?>
        <div class="question"><?= $_REQUEST['question'] ?></div>

        <?php
        $ary = null;
        $t = array();
        $f = array();
        $d = array();
        
        
            $ary = getToss();
//            print "<pre>";
//            print_r($ary);
        
//        while (!$ary) {
//            $ary = getToss();
//        }
//        while (
//                (!$ary['tossed']) ||
//                (!$ary['delta']) ||
//                (!$ary['final']) ) {
//            
//                $ary = getToss();
//            
//        }
        
        //    $ary['question']=$_REQUEST['question'];
        // get all data for local access
//        GLOBAL $a;
        $a = $GLOBALS['dbh']->getAllHexes();
//        $_SESSION['allhexes'] = $a;
        //    var_dump($json);
 $t = $ary['tossed'][0];
 $f = $ary['final'][0];
 $d = $ary['delta'];

 
 
 
//        if (isset($ary['tossed'][0])) {
//            $t = $ary['tossed'][0];
//        } else {
//            PRINT "<PRE>";
//            var_export("ERROR: the 'tossed' array is empty");
//           print_r($ary);
//            die;
//        }
//
//        if (isset($ary['final'][0])) {
//            $f = $ary['final'][0];
//        } else {
//            PRINT "<PRE>";
//            var_export("ERROR: the 'final' array is empty");
//            var_export($ary);
//            die;
//        }
//        if (isset($ary['delta'][0])) {
//            $d = $ary['delta'];
//        } else {
//            PRINT "<PRE>";
//            var_export("ERROR: the 'delta' array is empty");
//            var_export($ary);
//            die;
//        }

        // remove whitespces and extention from question to use as filename
        $fn = "questions/" . mb_ereg_replace(" ", "_", $_REQUEST['question'] . ".txt");
        $json = json_encode(array(array('question' => $_REQUEST['question']), $t, $d, $f), JSON_PRETTY_PRINT);
        file_put_contents($fn, $json);
        ?>
        <?php
        // FIX is special column for editing notes
        if (isset($t['fix'])) {
            ?>
            <div class="content btn btn-danger">FIX :<?= $t['fix'] ?></div>
        <?php } ?>

        <?php
        //var_dump($t['binary']);
        //var_dump($d);
        
        $hexes = makeHex(
                
                str_split($t['binary']), $d, uniqid(), "fade_final");
                print $hexes;
        ?>


        <!-- div>
            <img class="heximg select" alt="<?= $t['pseq'] ?> / <?= $t['title'] ?>/<?= $t['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $t['pseq']) ?>.png">    
            <img class="heximg" alt="<?= $f['pseq'] ?> / <?= $f['title'] ?>/<?= $f['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $f['pseq']) ?>.png">
        </div -->    
        <div class="tossed">

            <div class="label">Hex # [bin] / Title / Translation</div>
            <div class="content" id="pseq"><?= $t['pseq'] ?> [b:<?= $t['bseq'] ?>]/ <?= $t['title'] ?>/<a target="blank_" href="show.php?hex=<?= (isset($t['pseq']) ? $t['pseq'] : 0) ?>"><?= $t['trans'] ?></a></div>

            <div class="label">The Upper Trigram</div>
            <div class="content" id="tri_upper"><?= $t['tri_upper'] ?></div>

            <div class="label">The Lower Trigram</div>
            <div class="content" id="tri_lower"><?= $t['tri_lower'] ?></div>

            <div class="label">Explanation of the Trigrams</div>
            <div class="content" id="explanation"><?= $t['explanation'] ?></div>

            <div class="label">The Judgment</div>
            <div class="content" id="judge_old"><?= $t['judge_old'] ?></div>

            <?php if (isset($t['comment'])) { ?>
                <div class="label">Comments</div>
                <div class="content comment" id="comment"><?= $t['comment'] ?></div>
            <?php } ?>

            <div class="label">Commentary an Explanation of the Judgement</div>
            <div class="content" id="judge_exp"><?= $t['judge_exp'] ?></div>

            <div class="label">The Ancient Assocated Image</div>
            <div class="content" id="image_old"><?= $t['image_exp'] ?></div>

            <div class="label">Commentary and Explanation of the Image</div>
            <div class="content" id="image_exp"><?= $t['image_exp'] ?></div>
        </div>
        The Lines

    <?php
    for ($i = 0; $i < 6; $i++) {
        if ($d[$i] == 1) {
            $j = $i + 1;
            //var_dump($j);
            ?>
                <div class="lines">
                    <div class="label">Line <?= $j ?></div>
                    <div class="content line_title" id="line_<?= $j ?>"><?= $t['line_' . $j] ?></div>

                    <div class="label">Original Text</div>
                    <div class="content line_org" id="line_<?= $j ?>_org"><?= $t['line_' . $j . '_org'] ?></div>

                    <div class="label">Expanded Text</div>
                    <div class="content line_exp" id="line_<?= $j ?>_exp"><?= $t['line_' . $j . '_exp'] ?></div>
                </div>
            <?php
        }
    }
    ?>
        <?php if (isset($f['fix'])) { ?>
            <div class="content btn btn-danger">FIX :<?= $f['fix'] ?></div>
        <?php } ?>


        <?php
        $hexes = makeHex(str_split($t['binary']), $d, uniqid(), "fade_tossed"
        );
        print $hexes;
        ?>

        <!-- div>
            < img class="heximg" alt="<?= $t['pseq'] ?> / <?= $t['title'] ?>/<?= $t['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $t['pseq']) ?>.png">    
            <img class="heximg select" alt="<?= $f['pseq'] ?> / <?= $f['title'] ?>/<?= $f['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $f['pseq']) ?>.png">
        </div -->    
        <div class="final">
            <div class="label">Hex # [bin]/ Title / Translation</div>
            <div class="content" id="pseq"><?= $f['pseq'] ?> [b:<?= $f['bseq'] ?>]/ <?= $f['title'] ?>/<a target="blank_" href="show.php?hex=<?= (isset($f['pseq']) ? $f['pseq'] : 0) ?>"><?= $f['trans'] ?></a></div>
            <div class="label">The Upper Trigram</div>
            <div class="content" id="tri_upper"><?= $f['tri_upper'] ?></div>
            <div class="label">The Lower Trigram</div>
            <div class="content" id="tri_lower">Below: <?= $f['tri_lower'] ?></div>
            <div class="label">Explanation of the Trigrams</div>
            <div class="content" id="explanation"><?= $f['explanation'] ?></div>
            <div class="label">The Judgment</div>
            <div class="content" id="judge_old"><?= $f['judge_old'] ?></div>
            
            <?php if (isset($f['comment'])) { ?>
                <div class="label">Comments</div>
                <div class="content comment" id="comment"><?= $f['comment'] ?></div>
            <?php } ?>

            <div class="label">Comments</div>
            <div class="content comment" id="comment"><?= $f['comment'] ?></div>

            <div class="label">Commentary an Explanation of the Judgement</div>
            <div class="content" id="judge_exp"><?= $f['judge_exp'] ?></div>
            <div class="label">The Ancient Assocated Image</div>
            <div class="content" id="image_old"><?= $f['image_exp'] ?></div>
            <div class="label">Commentary and Explanation of the Image</div>
            <div class="content" id="image_exp"><?= $f['image_exp'] ?></div>
        </div>

        <div class="extra">
    <?php
    $ti = intval($t['bseq']);
    $fi = intval($f['bseq']);
    ?>
            Two points form a line, three points form a direction, a flow. <br>
            The the binary values of the two hexagrams are added, you get...<p>
            <?php
            $added = $ti + $fi;
            $added = ($added > 63 ? $added - 63 : $added);
            outProc1($a, $added);
            ?>
            <hr>
            Our present is different from our past based on what motivated us in the past to make the decisions that lead us to where we are today.  The rose is red because it absorbs the green. <br>
            The 2nd hex subtracted from the 1st hex...<p>
                <?php
                $subFfrT = c_sub($ti, $fi);
                outProc1($a, $subFfrT);
                ?>
            <hr>
            By removing what was before from the now, we can see what it is that has developed in us.<br> 
            The 1st hex subtracted from the 2nd hex...<p>
                <?php
                $subTfrF = c_sub($fi, $ti);
                outProc1($a, $subTfrF);
                ?>
            <hr>
            <DIV style="background-color:yellow"> The following shows how you can get from the final hexagram to the next hexagram of your choice. </div>
            <hr>

                <?php
                $h_receptive = 2;
                $b_receptive = $GLOBALS['dbh']->chex2bin($h_receptive);
                $toReceptive = c_sub($fi, $b_receptive);
                echo fromtoprint($b_receptive, $h_receptive, $f);
                //                    var_dump($toReceptive);
                outProc1($a, $toReceptive);
                ?>
            <hr>

            <?php
            $h_peace = 11;
            $b_peace = $GLOBALS['dbh']->chex2bin($h_peace);
            $toPeace = c_sub($fi, $b_peace);
            echo fromtoprint($b_peace, $h_peace, $f);
            //                    var_dump($toPeace);
            outProc1($a, $toPeace);
            ?>
            <hr>
            <?php
            $h_completion = 63;
            $b_completion = $GLOBALS['dbh']->chex2bin($h_completion);
            $toCompletion = c_sub($fi, $b_completion);
            echo fromtoprint($b_completion, $h_completion, $f);
            outProc1($a, $toCompletion);
            ?>
            <hr>
            <?php
            $h_creative = 1;
            $b_creative = $GLOBALS['dbh']->chex2bin($h_creative);
            $toCreative = c_sub($fi, $b_creative);
            echo fromtoprint($b_creative, $h_creative, $f);
            outProc1($a, $toCreative);
            ?>
            <hr>
        </div>
    </div>
        <?php } ?>
</section>

        <?php
        require "elements/footer.php";
        ?>

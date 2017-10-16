
<?php
/* 'iching_root' is defined in the php.ini file, this way is it always correct for whatever maching is being used */
require get_cfg_var("iching_root") . "/elements/header.php";
require get_cfg_var("iching_root") . "/vendor/autoload.php";
require get_cfg_var("iching_root") . "/conf/config.php";
require get_cfg_var("iching_root") . "/lib/init.php";
require get_cfg_var("iching_root") . "/lib/functions.php";

//var_dump($_dbh);
$a = null; /* this is used later for a global var, but prob shoud try and remove it FIXME*/
?>

<section>
    <!-- div class="content"><strong> The Dharma Clock Project's I Ching page</strong></div-->
</section>

<section id="pageContent">

    <div if = 'here2' class="container container-top">
    
        <div class="row1">
            <span class="btn btn-warning"><a href="index.php">RESET</a></span>
            <span class="btn btn-danger"><a style="color:white;font-weight: bold;" href="/book/ichingbook/_book/">DOCS</a></span>
            <span class="btn btn-danger"><a style="color:white;" href="show.php<?= (isset($_REQUEST['hex']) ? "?hex=" . $_REQUEST["hex"] : '') ?>" >Browse</a></span>    <p>
        </div>

        <!-- ------------------------------------------------------------>

        <?php
        //var_dump($_REQUEST);
        if (!isset($_REQUEST['flipped'])) { /* we have yet to flip the coins.  Regardless of what techniqu used, 'flipped' must be 1 to show there has been a flip */
            ?>
            <div class="qbox">

                <form id = "tosstype" method="POST" action="">
                    <input type="hidden" name="flipped" value="1">
                    <div class="row2">
                        <input id="qfield" type="text" name="question" placeholder="question" value=""></p>
 
                        <a id="plumtip" class="plumtip" href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="plum" value="plum" checked > 
                            <span class="text_mdcaps" id="plummsg">Modern Plum</span>    
                        </p>

                        <a id="randomtip" class="randomtip" href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="random.org" value="random.org"> 
                            <span class="text_mdcaps" id="random.orgmsg">random.org</span>
                        </p>

                        <a id="r-decaytip" class="r-decaytip"  href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="r-decay" value="r-decay"> 
                            <span class="text_mdcaps" id="r-decaymsg">r-decay</span>
                        </p>

                        <!--a id="entropytip" class="entropytip qtip-content ui-widget-content"  href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="entropy" value="entropy"> 
                            <span class="text_mdcaps" id="entropymsg">entropy</span>
                        </p -->

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
    } else { /* there has been a coin toss */
        
        /* get date formats for rpesenation and data */
        $dates = getDates();
        
        /* set question to 'Query for <date>' if it is blank */
        if (!isset($_REQUEST['question'])) {
//            $_REQUEST['question'] = "Query for ".$dates['human'];
            $_REQUEST['question'] = "no question, but an answer";
        }
        
        /* determine which qua we are in, default is Pen-Kua */
        if (!isset($_REQUEST['kua'])) {
            $_REQUEST['kua']="Pen-Kua";
        }
        /* show question, kuas and time */ 
        print "<div class='question'>".$_REQUEST['question']."</div>\n";
        print "<div class='kua'>(".$_REQUEST['kua'].")</div>\n";
        print "<div class='date'>".$dates['human']."</div>\n";

        $t = array(); /* array for original tossed hexagram */
        $f = array(); /* array for the final hexagram */
        $d = array(); /* array for deltas, six 0's and 1 */
        
        
        
        
        $ary = getToss(); /* throw the coins */

        $a = $GLOBALS['dbh']->getAllHexes(); /* set global for ALL hexes, used for reference, rather than  teh dataabase */

        /* fill in the arrays with tossed data */
        $t = $ary['tossed'][0];
        $f = $ary['final'][0];
        $d = $ary['delta'];
        $t['date'] = $dates['data']; /* throw in a date fro file retreival later */

        /* save all data as a json file... later this will be retreivable */
        saveToFile($t, $d, $f);
        
        /* 'fix' is special column for editing notes.  Show any 'fix' comments if they exist */
        print showFixes($t);
        
        /* presents the hexagrams 
         * -----------------------
         * we send the binary '0100101' of the hex and the delta, a uid so the 
         * js can identify unique elements         
         * 'fade_final' tell teh function both which hex to fade, but of set to 'fade_final'
         * we also know this is the first call to function, which we want to know
         */
        $ret = makeHex(str_split($t['binary']), $d, uniqid(), "fade_final");

        print $ret['hexes'];
        /* make the Hu Kua's for the T an F hexes */
        $t_hukua = makeHuKua($t['binary']);
        $f_hukua = makeHuKua($f['binary']);
        ?>
    <script>
    $(".container-top").css("background-color","rgb(242, 240, 255");
    </script>
             <?php 
             /* the 't' query param is only set when you are viewing the Hu Kua.  't' and 'f' are set
              * as params to the 'view Hu Kua' link so the user can navigate back to the original vua the 'view Pen Kua'
              */
             if (!isset($_REQUEST['t'])) { /* Show Hu Kua links */
             ?>
            <div id='here3' class='textWrapper'>
                <div class='subtextWrapper'>
                <a style="font-size:16pt" href='/index.php?t=<?=$t['pseq']?>&f=<?=$f['pseq']?>&flipped=1&kua=Hu-Kua&f_tossed=<?= $t_hukua ?>&f_final=<?= $f_hukua ?>'>View the Hu Kua</a>
                <?php /* this is the jquery-ui popup link for the HuKua */ ?>
                <a id="hukuatip" class="hukuatip"  href="#">
                    <img style="width:20px" src="/images/qmark-small-bw.png">
                    <span id="hukuatipmsg"></span>
                </a> 
               </div>
            </div>
            <?php
            } else { /* Show Pen Kua links */
            ?>
            <div id='here3' class='textWrapper'>
                <div class='subtextWrapper'>
                <a style="font-size:16pt" href='/index.php?flipped=1&f_tossed=<?= $_REQUEST['t'] ?>&f_final=<?= $_REQUEST['f'] ?>'>View the Pen Kua</a>
                <?php /* this is the jquery-ui popup link for the HuKua */ ?>
                <a id="penkuatip" class="penkuatip"  href="#">
                    <img style="width:20px" src="/images/qmark-small-bw.png">
                    <span id="penkuatipmsg"></span>
                </a> 
                </div>
            </div>
            <?php
             }

             
             
            /*
             * This showed the images of the hex, before the css version replaced
             * Keeping it in case the CSS versions goes wonky
             * 
                <div>
                    <img class="heximg select" alt="<?= $t['pseq'] ?> / <?= $t['title'] ?>/<?= $t['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $t['pseq']) ?>.png">    
                    <img class="heximg" alt="<?= $f['pseq'] ?> / <?= $f['title'] ?>/<?= $f['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $f['pseq']) ?>.png">
                </div>
             * 
             */    

             ?>

<?php
/* *************************************************************************** */
?>
<div class="awrapper">
    <div id="accordion1">
<?php 
/*
 *  First Title
 */
?>
        <!-- h3 style="font-size:1.2em !important" class="eTitle tColors"><?= $t['pseq'] ?> (<?= $t['title'] ?>) <a target="blank_" href="show.php?hex=<?= (isset($t['pseq']) ? $t['pseq'] : 0) ?>"><?= $t['trans'] ?></a -->
        <h3 style="font-size:1.2em !important" class="eTitle tColors"><?= $t['pseq'] ?> (<?= $t['title'] ?>) <?= $t['trans'] ?>
            <div style="float:right">
            <a href="/cignite/index.php/main/hexagrams/edit/<?= $t['pseq']?>" target="_blank">
                <img style="width:20px" src="/images/edit.png">
            </a>
            <a href="/cignite/index.php/main/notes/edit/<?= $t['pseq']?>" target="_blank">
                <img style="width:20px" src="/images/addnotes.png">
            </a>
            </div>
        </h3>
        <div>
            <p>
                <?= $t['judge_old'] ?></p>
            <p><?= $t['judge_exp'] ?></p>
        </div>

<?php 
/*
 *  First Trigrams
 */
?>
            <h3 class="eTrigrams tColors">The Trigrams</h3>
            <div>
                <p>
                    The Upper Trigram<br>
                    <?= $t['tri_upper'] ?><br>
                    The Lower Trigram<br>
                    <?= $t['tri_lower'] ?><br>
                </p>
                Explanation of the Trigrams
                <p>
                <?= $t['explanation'] ?>

            </div>
<?php 
/*
 *  First image
 */
?>
            <h3 class="eImage  tColors">Image</h3>
            <div>
                <p>
                    <b>The Ancient Assocated Image</b>
                </p>
                <p>
                    <i><?= $t['image_old'] ?></i>
                </p>
                <p>
                    <?php
                    if ( file_exists(get_cfg_var("iching_root")."/images/symbol/image".$t['pseq'].".jpg")) {
                        $fn = "/images/symbol/image".$t['pseq'].".jpg";
                        print "<img style='width:70%' src='${fn}'>";

                    } else {
                        print "[no image yet]";
                    }
                    ?>
                <p>
                    <b>Commentary and Explanation of the Image</b>
                </p>
                <p>
                    <?= $t['image_exp'] ?>
                </p>
            </div>
<?php 
/*
 *  First Notes
 */  
?>
            
            <h3 class="eImage  tColors">Notes</h3>
            <div>
                <?php echo getNotes($t['pseq']) ?>
            </div>

<?php
    if ($t['bseq'] != $f['bseq'] ) {  /* if T == F then there are no moving lines, so skip */
        for ($i = 0; $i < 6; $i++) {
            if ($d[$i] == 1) {
                $j = $i + 1;
                //var_dump($j);
                ?>
                <h3 class="eLines lColors"><?= $t['line_' . $j] ?></h3>
                <div>
                    <div class="content line_org" id="line_<?= $j ?>_org"><?= $t['line_' . $j . '_org'] ?></div>
                    <div class="content line_exp" id="line_<?= $j ?>_exp"><?= $t['line_' . $j . '_exp'] ?></div>
                </div>
            <?php
            }
        }
        ?>
            <h3 class="eImage  xColors">Transitional Hexagram</h3>
            <div>
                <p>
                <h2><a href="/show.php?hex=<?= $ret['tpseq'] ?>"><?= $ret['tpseq'] ?>
                    <?= $GLOBALS['dbh']->getHexFieldByPseq("hexagrams","trans",$ret['tpseq']);?>
                    </a></h2>
                    <?= $GLOBALS['dbh']->getHexFieldByPseq("hexagrams","judge_exp",$ret['tpseq']);?>
                </p>
                <p>
            </div>
        <?php        
    }
?>

    </div>
</div>
<?php
/* *************************************************************************** */
?>

     <div if = 'here2' class="container container-top">
    <?php
    if ($t['bseq'] != $f['bseq'] ) {  /* if T == F then there are no moving lines, so skip */
        /* make and shwo hexs - same as above */
        $ret = makeHex(str_split($t['binary']), $d, uniqid(), "fade_tossed");
        print "<div id='here1' class='container'>\n${ret['hexes']}</div>\n";

         /* same as abive - save old image links
          * 
          *             
          * <div>
            <img class="heximg" alt="<?= $t['pseq'] ?> / <?= $t['title'] ?>/<?= $t['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $t['pseq']) ?>.png">    
            <img class="heximg select" alt="<?= $f['pseq'] ?> / <?= $f['title'] ?>/<?= $f['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $f['pseq']) ?>.png">
            </div>    

          */
        
          //require get_cfg_var("iching_root")."/lib/accordian2.php";

        ?>
    </div>
        <script>
    $(".container-top").css("background-color","rgb(242, 240, 255");
    </script>

    <?php
/* *************************************************************************** */
    if ($t['bseq'] != $f['bseq'] ) {  /* if T == F then there are no moving lines, so skip */
?>
<div class="awrapper">
    <div id="accordion2">

<?php 
/*
 *  Second Hex Title
 */  
?>
        <h3 style="font-size:1.2em !important" class="eTitle fColors"><?= $f['pseq'] ?> (<?= $f['title'] ?>) <a target="blank_" href="show.php?hex=<?= (isset($f['pseq']) ? $f['pseq'] : 0) ?>"><?= $f['trans'] ?></a>
            <div style="float:right">
            <a href="/cignite/index.php/main/hexagrams/edit/<?= $f['pseq']?>" target="_blank">
                <img style="width:20px" src="/images/edit.png">
            </a>
            <a href="/cignite/index.php/main/notes/edit/<?= $f['pseq']?>" target="_blank">
                <img style="width:20px" src="/images/addnotes.png">
            </a>
            </div>
        </h3>
        <div>
            <p>
                <?= $f['judge_old'] ?></p>
            <p><?= $f['judge_exp'] ?></p>
        </div>

<?php 
/*
 *  Second Trigrams
 */  
?>
            <h3 class="eTrigrams fColors">The Trigrams</h3>
            <div>
                <p>
                    The Upper Trigram<br>
                    <?= $f['tri_upper'] ?><br>
                    The Lower Trigram<br>
                    <?= $f['tri_lower'] ?><br>
                </p>
                Explanation of the Trigrams
                <p>
                <?= $f['explanation'] ?>

            </div>
<?php 
/*
 *  Second Image
 */  
?>
            <h3 class="eImage  fColors">Image</h3>
            <div>
                <p>
                    <b>The Ancient Assocated Image</b>
                </p>
                <p>
                    <i><?= $f['image_old'] ?></i>
                </p>
                <p>
                    <?php
                    if ( file_exists(get_cfg_var("iching_root")."/images/symbol/image".$f['pseq'].".jpg")) {
                        $fn = "/images/symbol/image".$f['pseq'].".jpg";
                        print "<img style='width:70%' src='${fn}'>";

                    } else {
                        print "[no image yet]";
                    }
                    ?>
                <p>
                    <b>Commentary and Explanation of the Image</b>
                </p>
                <p>
                    <?= $f['image_exp'] ?>
                </p>
            </div>
<?php 
/*
 *  Second Notes
 */  
?>
            <h3 class="eImage  fColors">Notes</h3>
            <div>
                <?php echo getNotes($f['pseq']) ?>
            </div>
    </div>
</div>
<?php
    }/* *************************************************************************** */
?>
    

        <?php
        /* this is teh end of the cast */
        } else { /* T == F, so nothign to show */
            ?>
    <div class='textWrapper'>
        <div class='subtextWrapper'>
            <span style='padding:25px;font-size: 12pt'>There are no moving lines</span>
        </div>    
    </div>  
            <?php
        } 
        
        /* convert to int ?  hmmm aren;t they ints alrady in database  FIXME */
        $ti = intval($t['bseq']); 
        $fi = intval($f['bseq']);
        
        /* everythign in 'extra' is the experimental 'math' examples */
        ?>
        <?php /*
            <div class="extra">
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
            <?php */ } 
    
    
    ?>
</section>

<?php
require get_cfg_var("iching_root") . "/lib/popup_predefs.php"; /* has all the dovs for the jquery-ui popups */
require get_cfg_var("iching_root") . "/elements/footer.php";
?>

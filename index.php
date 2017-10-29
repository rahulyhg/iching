<?php
if (isset($_REQUEST['f_final'])) {
    $_REQUEST['mode']="manual";
}

require "lib/functions.php";

/* 'iching_root' is defined in the php.ini file, this way is it always correct 
 * for whatever maching is being used 
 */

require getRootDir(). "/elements/header.php";

if (isset($_REQUEST['suggestions'])) {
    $GLOBALS['dbh']->putSuggestion($_REQUEST['suggestions']);
}

$a = null; 
/* this is used later for a global var, but prob shoud try and remove it FIXME*/
?>

<section>
    <!-- div class="content"><strong> BabelBrowser's I Ching page</strong></div-->
</section>

<!-- section id="pageContent" -->
    <?php 
    /* *****************************************
     * the "here2" div is the dim for a device
     * *****************************************/
    ?>   
    <div id = 'here2' class="container container-top">
        <!-- ------------------------------------------------------------>
        <?php 
        /*
         *   <div id="msg" >
         *       This site is <a href="https://github.com/baardev/iching">super beta</a>.  It currently needs writers, editors, programmers, philosophers, designers and more.  If you would like to contribute to <a href="/book/ichingbook/_book/">this project</a>, <a href="mailto:duncan.stroud@gmail.com">let me know</a>.
         *   </div>
         */
        ?>        
        <?php
        dbug($_REQUEST,false);
        if (!isset($_REQUEST['flipped'])) { 
            /* we have yet to flip the coins.  Regardless of what techniqu used, 'flipped' must be 1 to show there has been a flip */
            ?>
            <?php 
            /* *****************************************
             * The Buttons
             * *****************************************/
            ?>   
            <form id="tosstype">
                <span style="flex-direction: row;" class="qbox qboxClear">
                    <span><a alt="RESET"                  style="font-weight: bold;"             id='reset' href='/index.php<?=(isset($_REQUEST['debugon']) ? "?debugon=1&qfield=debugging" : null) ?>'><img class="rdbbtns" src="/images/_reset.png"/></a></span>
                    <span><a alt="DOCS" target="_blank"   style="color:white;font-weight: bold;"            href="/book/ichingbook/_book/">                                                             <img class="rdbbtns" src="/images/_docs.png"/></a></span>
                    <span><a alt="BROWSE" target="_blank" style="color:white;font-weight: bold;"            href="/show.php<?= (isset($_REQUEST['hex']) ? "?hex=" . $_REQUEST["hex"] : '') ?>" >         <img class="rdbbtns" src="/images/_browse.png"/></a></span> 
                </span>
                <?php 
                /* *****************************************
                 * The Button Help  - it is rendered, but not displayed, for the initial page, to maintain alignment
                 * on the following pages it is not rendered, also to maintain alignment
                 * *****************************************/
    //            if (!isset($_REQUEST['flipped'])) {
    //                ? >
    //                <img class="qtrtip" id="qtr0tip" style="visibility:hidden" src="/images/qmark.png"/>
    //                < ?php
    //            }
                ?>
            </form>
            <?php
            /* *****************************************
             * The Tao of Now
             * *****************************************/
            ?>    
            <form id = "tosstype" method="POST" action="?c=<?= microtime_float() ?><?= (isset($_REQUEST['debugon']) ? "&debugon=1" : "") ?>">
                <input type="hidden" name="flipped" value="1">
                <input type="hidden" name="mode" value="astro">
                <input type="hidden" name="trans" value="baynes">

                <span class="qbox"  id="nowbutton"  style="min-height:80px; background-image: url(/images/newnow_up.png) !important;background-size: cover !important; border:2px solid darkslategray">
                    <!-- input id="nowbutton" type="image" name="submit" src="/images/taoofnow_clear.png" alt="Click for the Tao of Now" value="" -->
                    <!-- input id="nowbutton" class = "btn btn-info" style="color:black;font-weight:bold" type="submit" value="Click for 'Tao of Now'"-->
                </span>
                <?php 
                /* *****************************************
                 * The help for Tao of Now
                 * *****************************************/
                ?>
                <img class="qtrtip" id="qtr1tip" src="/images/_info.png"/>
            </form>

            <?php 
            /* *****************************************
             * The main question box
             * *****************************************/
            ?>
            <!-- form id = "tosstype" method="POST" action="?c=< ?= microtime_float() ?>"-->
            <form id = "tosstype" method="POST" action="?c=1<?php echo (isset($_REQUEST['debugon']) ? "&debugon=1" : "") ?>">
                <span class="qbox">  
                    <input id="castbutton" class = "btn btn-info" style="width:100%" type="submit" value="Cast Coins">
                    <input type="hidden" name="flipped" value="1">
                    <div class="row2">
                        <p>
                        <input id="qfield" type="text" name="question" placeholder="Enter a Question or Thought" value="<?php echo (isset($_REQUEST['debugon']) ? "debugging..." : "" )?>">
                        <input type="checkbox" name="debug" id="debugon" value="1"  <?php echo (isset($_REQUEST['debugon']) ? "checked" : "" )?> >

                        </p> 

                        <?php /*
                         *  The 'tip' functions are in /js/consult.js 
                         * The actual text is in /lib/popup_predefs.php
                         */?>
                        <a id="plumtip" class="plumtip" href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="plum" value="plum"  > 
                            <span class="text_mdcaps" id="plummsg">Modern Plum</span>    
                        </p>
                        <a id="astrotip" class="astrotip" href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="astro" value="astro" checked > 
                            <span class="text_mdcaps" id="astromsg">Planetary</span>    
                        </p>

                        <p>
                        <a id="randomtip" class="randomtip" href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="random.org" value="random.org"> 
                            <span class="text_mdcaps" id="random.orgmsg">random.org</span>
                        </p>

                            <?php
                            /*get statuys of decay server */
                            $status = file_get_contents(getRootDir(). "/data/store/hotbitsdown");
                            if ($status != 1) {
                            ?>
                        <p>
                        <a id="r-decaytip" class="r-decaytip"  href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="r-decay" value="r-decay"> 
                            <span class="text_mdcaps" id="r-decaymsg">r-decay</span>
                        </p>
                            <?php } else {?>
                        <p>
                        <a id="r-decaytip" class="r-decaytip"  href="#"><img src="images/qmark.png"></a> 
                            <!-- input type="radio" name="mode" id="r-decay" value="r-decay"--> 
                            <span  style="color:darkslategray;font-size: 10pt" id="r-decaymsg" >(decay server down)</span>
                        </p>


                            <?php } ?>
                        <!--a id="entropytip" class="entropytip qtip-content ui-widget-content"  href="#"><img src="images/qmark.png"></a> 
                            <input type="radio" name="mode" id="entropy" value="entropy"> 
                            <span class="text_mdcaps" id="entropymsg">entropy</span>
                        </p -->

                        <span class="text_mdcaps" id="baynesmsg">Wilhelm/Baynes</span> <input type="radio" name="trans" id="baynes" value="baynes" checked > <a id="baynestip" href="#"><img src="images/g-qmark.png"></a></p> 
                        <span class="text_mdcaps" id="aculturalmsg">Acultural</span> <input type="radio" name="trans" id="acultural" value="acultural"  > <a id="aculturaltip" href="#"><img src="images/g-qmark.png"></a></p>
                    </div>
                </span>        
                <?php 
                /* *****************************************
                 * The help for main question box
                 * *****************************************/
                ?>
                <img class="qtrtip" id="qtr2tip" src="/images/_info.png"/>
            </form>

            <?php 
            /* *****************************************
             * The Compare 2 hex box
             * *****************************************/
            ?>

            <form id="tosstype" method="POST" action="">
                <span class="qbox">
                    <input type="hidden" name="flipped" value="1">
                    <div class="row3">
                        <!-- div class="text_smcaps">Or enter 2 hex nums    </div -->
                        <?php
                        $fromNum = rand(1,64);
                        $toNum = $GLOBALS['dbh']->getHexnumOppositeByPseq($fromNum);
                        ?>
                        <input class = "doublenum"       id="f_tossed"     type="text"   name="f_tossed" placeholder="<?= $fromNum ?>" value="">
                        <input class = "doublenum"       id="f_final"      type="text"   name="f_final" placeholder="<?= $toNum ?>" value="">
                        <input class = "btn btn-primary" id="manualTossed" type="submit" value="Show">
                    </div>
                </span>
                <?php 
                /* *****************************************
                 * The help for The Compare 2 hex box
                 * *****************************************/
                ?>
                <img class="qtrtip" id="qtr3tip" src="/images/_info.png"/>
            </form>
            <div class="qboxSug">
                <form method="POST" action="">
                    <textarea id="sugField"  maxlength="2000" minlength="32" rows="2" wrap="soft" type="textarea" name="suggestions" placeholder="Send me suggestions, comments, bugs, wishlists, opinions, etc.  If you want to be contacted, include your email. (max:2K, min:32)" value=""></textarea>
                    <input id="sugSend" class = "btn btn-primary text_smcaps" type="submit" value="LET ME KNOW">
                </form>
            </div>
            
            

            <?php 
            /* *****************************************
             * The suggestin box
             * *****************************************/
            ?>
            <?php 
        } else { 
            /* there has been a coin toss */
            /* get date formats for rpesenation and data */
            $dates = getDates();

            /* *****************************************
             * The Buttons
             * *****************************************/
            ?>   
                <span style="flex-direction: row;" class="qbox qboxClear">
                    <span><a alt="RESET"                  style="font-weight: bold;"             id='reset' href='/index.php<?=(isset($_REQUEST['debugon']) ? "?debugon=1&qfield=debugging" : null) ?>'><img class="rdbbtns" src="/images/_reset.png"/></a></span>
                    <span><a alt="DOCS" target="_blank"   style="color:white;font-weight: bold;"            href="/book/ichingbook/_book/">                                                             <img class="rdbbtns" src="/images/_docs.png"/></a></span>
                    <span><a alt="BROWSE" target="_blank" style="color:white;font-weight: bold;"            href="/show.php<?= (isset($_REQUEST['hex']) ? "?hex=" . $_REQUEST["hex"] : '') ?>" >         <img class="rdbbtns" src="/images/_browse.png"/></a></span> 
                </span>
            <?php
            
            
            /* set question to 'Query for <date>' if it is blank */
            if (  (!isset($_REQUEST['question']) || (strlen($_REQUEST['question'])<1) )) {
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
            $t['ddate'] = $dates['data']; /* throw in a date fro file retreival later */
            $t['hdate'] = $dates['human']; /* throw in a date fro file retreival later */
            $t['question'] = $_REQUEST['question']; /* throw in a date fro file retreival later */

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
                $(".container-top").css("background-image","url(/images/qboxbg2.png");
                $(".container-top").css("background-size","cover");
            </script>
            
            <?php 
            /* the 't' query param is only set when you are viewing the Hu Kua.  't' and 'f' are set
             * as params to the 'view Hu Kua' link so the user can navigate back to the original vua the 'view Pen Kua'
             */
            if (!isset($_REQUEST['t'])) { 
                /* Show Hu Kua links */
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
            } else { 
                /* Show Pen Kua links */
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

            /* save all data as a json file... later this will be retreivable 
             * this had to go here so it coudl read a $_SERVER had that needs to get set first 
             * 
             * This also maked the *.md files, which are turned into *.html files, 
             * which are turned into *.pdf files
             */

            saveToFile($t, $d, $f);             
             
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

            /* *************************************************************************** */
            ?>
            <div class="awrapper">
                <?php /* this is the tool bar */ ?>
                <div style="border:0px solid red;background-color: transparent;padding:4px;">
                    <span>        
                        <?php print putBtnExpand(); ?>
                        <?php print putBtnEdit($t['bseq']); ?>
                        <?php print putBtnUpdate($t['bseq']); ?>
                        <?php print putBtnSmTxt(); ?>
                        <?php print putBtnMedTxt(); ?>
                        <?php print putBtnLgTxt(); ?>
                    </span>
                </div>
            
                <div style = "min-width:80%;max-width:80%" id="accordion1">
                <?php 
                /*
                 *  First Title
                 */
                ?>
                <h3 id="firstheader" style="font-size:1.2em !important" class="eTitle t_titleColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                    <?= c($t['pseq']) ?> (<?= c($t['title']) ?>) <?= c($t['trans']) ?>

                    <a id="donatetip" class="donatetip"  href="#">
                        <div id="donate" class="btn btn-warning" title="Plea">
                            <b>Donate to this project</b>
                        </div>
                        <span id="donatetipmsg"></span>
                    </a> 

                    <?php /* this invisible one pixel line control the collapse with of the accordian */?>
                    <br><img style="min-width:300px" src="images/thinline350.png">
                </h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                    <p>
                        <b>The Original Text</b>
                    </p>

                    <p>
                        <i><?= $t['judge_old'] ?></i>
                    </p>
                        <p>
                            <b>The Expanded Text</b>
                        </p>
                    <p>
                            <?= htmlize($t['judge_exp']) ?>
                    </p>
                </div>
                <?php 
                /*
                 *  First Trigrams
                 */
                ?>
                <h3 style="font-size:1.2em !important" class="eTrigrams tColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                    The Trigrams
                </h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                    <p>
                        <b>The Upper Trigram</b>
                    </p>
                    <p>
                        <?= $t['tri_upper'] ?>
                    </p>
                    <p>
                        <b>The Lower Trigram</b>
                    </p>
                    <p>
                        <?= $t['tri_lower'] ?><br>
                    </p>
                    <p>
                        <b>Explanation of the Trigrams</b>
                    </p>
                    <p>
                        <?= htmlize($t['explanation']) ?>
                    </p>
                </div>
                <?php 
                /*
                 *  First image
                 */
                ?>
                <h3 style="font-size:1.2em !important" class="eImage  tColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                    Image
                </h3>
                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                    <p>
                        <b>The Ancient Assocated Image</b>
                    </p>
                    <p>
                        <i><?= $t['image_old'] ?></i>
                    </p>
                    <p>
                        <?php
                        if (file_exists(getRootDir(). "/images/symbol/image" . $t['pseq'] . ".jpg")) {
                            $fn = "/images/symbol/image" . $t['pseq'] . ".jpg";
                            print "<img style='width:70%' src='${fn}'>";
                        } else {
                            print "[no image yet]";
                        }
                        ?>
                    <p>
                        <b>Commentary and Explanation of the Image</b>
                    </p>
                    <p>
                        <?= htmlize($t['image_exp']) ?>
                    </p>
                </div>
                <?php 
                /*
                 *  First Notes
                 */  
                ?>
                <h3 style="font-size:1.2em !important" class="eImage  tColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                    Notes
                </h3>

                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                    <p>
                    <?php
                        echo getNotes($t['pseq']) ;
                    ?>
                    </p>
                </div>

                <?php
                /*
                 *  The Lines
                 */  
                
                /* if T == F then there are no moving lines, so skip */
                if ($t['bseq'] != $f['bseq'] ) {  
                    for ($i = 5; $i >= 0; $i-- ) {
                        if ($d[$i] == 1) {
                            $j = 6-$i ;
                            ?>
                            <h3 style="font-size:1.2em !important" class="eLines lColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                            <?= $t['line_' . $j] ?>
                            </h3>
                            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                                <div class="content line_org" id="line_<?= $j ?>_org">
                                    <p>
                                        <?= $t['line_' . $j . '_org'] ?>
                                    </p>
                                </div>
                                <div class="content line_exp" id="line_<?= $j ?>_exp">
                                    <p>
                                        <?= htmlize($t['line_' . $j . '_exp']) ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <h3 style="font-size:1.2em !important" class="eImage  xColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                        Transitional Hexagram
                    </h3>
                    <div>
                        <p>
                            <b>
                            <a href="/show.php?hex=<?= $ret['tpseq'] ?>"><?= $ret['tpseq'] ?>
                                <?= $GLOBALS['dbh']->getHexFieldByPseq("hexagrams", "trans", $ret['tpseq']); ?>
                            </a>
                            </b>
                        </p>
                        <p>
                            <?= htmlize($GLOBALS['dbh']->getHexFieldByPseq("hexagrams", "judge_exp", $ret['tpseq'])); ?>
                        </p>
                    </div>
                    <?php        
                }
                ?>
            </div>
            </div>
    
            <?php
            /* *************************************************************************** */
            ?>

            <div id = 'here2' class="container container-top">
                <?php
                if ($t['bseq'] != $f['bseq'] ) {  
                    /* if T == F then there are no moving lines, so skip */
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

                    //require getRootDir()."/lib/accordian2.php";
                    ?>
                    <script>
                        $(".container-top").css("background-image","url(/images/qboxbg2.png");
                        $(".container-top").css("background-size","cover");
                    </script>

                    <?php
                    /* *************************************************************************** */
                    if ($t['bseq'] != $f['bseq'] ) {  
                            /* if T == F then there are no moving lines, so skip */
                            ?>
                            <div class="awrapper">
                                <div style="border:0px solid red;background-color: transparent;padding:4px;">
                                    <span>        
                                        <?php print putBtnEdit($f['bseq']); ?>
                                        <?php print putBtnUpdate($f['bseq']); ?>
                                    </span>
                                </div>
                                <div style = "min-width:80%;max-width:80%" id="accordion2">
                                <?php 
                                /*  Second Hex Title
                                 */  
                                ?>
                                <h3 style="font-size:1.2em !important" class="eTitle f_titleColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                    <?= c($f['pseq']) ?> (<?= c($f['title']) ?>) <?= c($f['trans']) ?>
                                    <?php /* this invisible one pixel line control the collapse with of the accordian */?>
                                    <br><img style="min-width:300px" src="images/thinline350.png">
                                </h3>
                                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                                    <p>
                                        <i><?= $f['judge_old'] ?></i>
                                    </p>
                                        <p>
                                            <b>The Expanded Text</b>
                                        </p>
                                    <p>
                                            <?= htmlize($f['judge_exp']) ?>
                                    </p>
                                </div>
                                <?php 
                                /*
                                 *  Second Trigrams
                                 */  
                                ?>
                                <h3 style="font-size:1.2em !important" class="eTrigrams fColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                    The Trigrams
                                </h3>
                                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                                    <p>
                                        <b>The Upper Trigram</b>
                                    </p>
                                    <p>
                                        <?= $f['tri_upper'] ?>
                                    </p>
                                    <p>
                                        <b>The Lower Trigram</b>
                                    </p>
                                    <p>
                                        <?= $f['tri_lower'] ?><br>
                                    </p>
                                    <p>
                                    <b>Explanation of the Trigrams</b>
                                    </p>
                                    <p>
                                    <?= htmlize($f['explanation']) ?>
                                    </p>
                                </div>
                                <?php 
                                /*
                                 *  Second Image
                                 */  
                                ?>
                                <h3 style="font-size:1.2em !important" class="eImage  fColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                    Image
                                </h3>
                                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                                    <p>
                                        <b>The Ancient Assocated Image</b>
                                    </p>
                                    <p>
                                        <i><?= $f['image_old'] ?></i>
                                    </p>
                                    <p>
                                    <?php
                                    if ( file_exists(getRootDir()."/images/symbol/image".$f['pseq'].".jpg")) {
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
                                        <?= htmlize($f['image_exp']) ?>
                                    </p>
                                </div>
                                <?php 
                                /*
                                 *  Second Notes
                                 */  
                                ?>
                                <h3 style="font-size:1.2em !important" class="eImage  tColors accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                    Notes
                                </h3>
                                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                                    <p>
                                    <?php 
                                        echo getNotes($f['pseq']);
                                        ?>
                                    </p>
                                </div>
                            </div>
                            </div>    
                        <?php
                    }
                    /* *************************************************************************** */

                    /* this is teh end of the cast */
                } else { 
                /* T == F, so nothign to show */
                ?>
                <div  class='textWrapper'>
                    <div class='subtextWrapper'>
                        <span style='padding:25px;font-size: 18pt'>No Moving Lines</span>
                    </div>    
                </div>  
                <?php
            }
                ?>
                <div  style="padding-bottom:20px;left: 50%;right: 50%; position:absolute; z-index:100;top:10;" class='textWrapper'>
                    <div class='subtextWrapper'>
                        <div id="download" style="font-variant-caps: all-small-caps ; font-weight: bold;color:black">
                            <a id="download_file" target="_blank" href="<?= $_SESSION['dlfile'] ?>">Download<br>
                        </div>
                    </div>
                </div>
                <?php
                /* convert to int ?  hmmm aren;t they ints alrady in database  FIXME */
                $ti = intval($t['bseq']); 
                $fi = intval($f['bseq']);
                ?>
            </div>  
            <?php
            /* everythign in 'extra' is the experimental 'math' examples */
            /*
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
            <?php */    
        } 
        ?>
    </div>
<!-- /section -->

<?php
require getRootDir(). "/lib/popup_predefs.php"; /* has all the dovs for the jquery-ui popups */
require getRootDir(). "/elements/footer.php";
/* clean up anythign laying around */
$del = "rm ".getRootDir()."/id/*".session_id()."*";
system($del);
?>

<html>
    <head>


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="consult.css">
        <link type="text/css" rel="stylesheet" href="vendor/qtip/jquery.qtip.css" />

        <script src="vendor/components/jquery/jquery.min.js"></script>
        <script src="vendor/twitter/bootstrap/dist/js/bootstrap.min.js"></script>    
        <script type="text/javascript" src="vendor/qtip/jquery.qtip.js"></script>
        <script type="text/javascript" src="consult.js"></script>

    </head>

    <body>
        <?php
        require "vendor/autoload.php";
        require "functions.php";
        mb_internal_encoding("UTF-8");
        mb_regex_encoding("UTF-8");
        $a = null;
        ?>


        <div class="container leftCol">
            <span class="btn btn-warning"><a href="consult.php">RESET</a></span>
            <span class="btn btn-danger"><a href="/book/ichingbook/_book/">DOCUMENTATION</a></span>
            <p>


                <?php
//slogout($_REQUEST);

                if (!isset($_REQUEST['flipped'])) {
                    ?>
                    <span>Flip three Bronze Sestertius coins from the Roman Empire of Antoninus Pius</span> <a class = "btn" id="flipdesc" href="#">[?]</a>
                <div ><a  href="show.php<?= (isset($_REQUEST['hex']) ? "?hex=" . $_REQUEST["hex"] : '') ?>" ><span class = "btn btn-danger">Browse Hexagrams</span></a></div>

                <form method="POST" action="">
                    <input type="hidden" name="flipped" value="1">
                    <input id="qfield" type="text" name="question" placeholder="question" value="">
                    <input type="checkbox" name="testmode" value="1" checked > test mode <a id="testtip" href="#">[?]</a>
                    <input class = "btn btn-info" type="submit" value="Flip Coin(s)">
                </form>
                <div>Or enter two hexagram numbers</div>

                <form method="POST" action="">
                    <input type="hidden" name="flipped" value="1">
                    <input id="f_tossed" type="text" name="f_tossed" placeholder="Beginning Hexagram" value="">
                    <input id="f_final" type="text" name="f_final" placeholder="Resulting Hexagram" value="">
                    <input class = "btn btn-primary" type="submit" value="Show">
                </form>
            <?php } else {
                ?>
                <div class="question"><?= $_REQUEST['question'] ?></div>

                <?php
                $ary = getToss();
//    $ary['question']=$_REQUEST['question'];
                // get all data for local access

                GLOBAL $a;
                $a = getAllHexes();
                $_SESSION['allhexes'] = $a;

//    var_dump($json);

                $t = $ary['tossed'][0];
                $f = $ary['final'][0];
                $d = $ary['delta'];


                //logout($a,"all hexes");



                $fn = "questions/" . mb_ereg_replace(" ", "_", $_REQUEST['question'] . ".txt");
                $json = json_encode(array(array('question' => $_REQUEST['question']), $t, $d, $f), JSON_PRETTY_PRINT);
                file_put_contents($fn, $json);
                ?>
                <?php if (isset($t['fix'])) {?>
                   <div class="content btn btn-danger">FIX :<?= $t['fix'] ?></div>
                <?php } ?>
                <div><img class="heximg" alt="<?= $t['pseq'] ?> / <?= $t['title'] ?>/<?= $t['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $t['pseq']) ?>.png"></div>    
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

                    <div class="label">Comments</div>
                    <div class="content comment" id="comment"><?= $t['comment'] ?></div>

                    <div class="label">Commentary an Explanation of the Judgement</div>
                    <div class="content" id="judge_exp"><?= $t['judge_exp'] ?></div>

                    <div class="label">The Ancient Assocated Image</div>
                    <div class="content" id="image_old"><?= $t['image_exp'] ?></div>

                    <div class="label">Commentary and Explanation of the Image</div>
                    <div class="content" id="image_exp"><?= $t['image_exp'] ?></div>

                </div>
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
                <?php if (isset($f['fix'])) {?>
                   <div class="content btn btn-danger">FIX :<?= $f['fix'] ?></div>
                <?php } ?>
                <div><img class="heximg" alt="<?= $f['pseq'] ?> / <?= $f['title'] ?>/<?= $f['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $f['pseq']) ?>.png"></div>    
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
<!--                    The two hexes multiplied...<p>
                        < ?php
                        $multiplied = $ti * $fi;
                        $multiplied = $multiplied % 63;
                        outProc1($a, $multiplied);
                        ?>
                    <hr>-->
                    <DIV style="background-color:yellow"> The following shows how you can get from the final hexagram to the next hexagram of your choice. </div>
                    <hr>


    <?php
    $h_receptive = 2;
    $b_receptive = chex2bin($h_receptive);
    $toReceptive = c_sub($fi, $b_receptive);
    echo fromtoprint($b_receptive, $h_receptive, $f);
//                    var_dump($toReceptive);
    outProc1($a, $toReceptive);
    ?>
                    <hr>

                    <?php
                    $h_peace = 11;
                    $b_peace = chex2bin($h_peace);
                    $toPeace = c_sub($fi, $b_peace);
                    echo fromtoprint($b_peace, $h_peace, $f);
//                    var_dump($toPeace);
                    outProc1($a, $toPeace);
                    ?>
                    <hr>
                    <?php
                    $h_completion = 63;
                    $b_completion = chex2bin($h_completion);
                    $toCompletion = c_sub($fi, $b_completion);
                    echo fromtoprint($b_completion, $h_completion, $f);
                    outProc1($a, $toCompletion);
                    ?>
                    <hr>
                    <?php
                    $h_creative = 1;
                    $b_creative = chex2bin($h_creative);
                    $toCreative = c_sub($fi, $b_creative);
                    echo fromtoprint($b_creative, $h_creative, $f);
                    outProc1($a, $toCreative);
                    ?>

                    <hr>


                </div>


            </div>    
            <div class="container rightCol" id="debug">
            </div>    



        </body>
    </html>
    <?php
}
?>

<?php
//var_dump($ary);


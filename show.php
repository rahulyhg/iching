<html>
    <head>


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="consult.css">

        <!-- jQuery library -->
        <script src="vendor/components/jquery/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="vendor/twitter/bootstrap/dist/js/bootstrap.min.js"></script>    

    </head>
    <body>
        <div class="container leftCol">
        <?php
        require "vendor/autoload.php";
        require "functions.php";
        mb_internal_encoding("UTF-8");
        mb_regex_encoding("UTF-8");
        ?>


        <?php
        $usebin = 0;

        $hexNum = ($_REQUEST['hex'] ? $_REQUEST['hex'] : 1);
        $binNum = ($_REQUEST['bin'] ? $_REQUEST['bin'] : 0);

        if ($_REQUEST['submit'] == "Next Hex") {
            $hexNum++;
            $hexNum = ($hexNum > 64 ? 1 : $hexNum);
            $binNum = chex2bin($hexNum);
            $usebin = 0;
        }
        if ($_REQUEST['submit'] == "Prev Hex") {
            $hexNum--;
            $hexNum = ($hexNum < 1 ? 64 : $hexNum);
            $binNum = chex2bin($hexNum);
            $usebin = 0;
        }
        if ($_REQUEST['submit'] == "Next Bin") {
            $binNum++;
            $binNum = ($hexNum > 63 ? 0 : $binNum);
            $hexNum = cbin2Hex($binNum);
            $usebin = 1;
        }
        if ($_REQUEST['submit'] == "Prev Bin") {
            $binNum--;
            $binNum = ($binNum < 0 ? 63 : $binNum);
            $hexNum = cbin2Hex($binNum);
            $usebin = 1;
        }

        if (isset($_REQUEST['gotohex'])) {
            if ($_REQUEST['submit'] == "Go To Hex") {
                if ($_REQUEST['gotohex'] != $hexNum) {
                    $hexNum = ($_REQUEST['gotohex']);
                    $usebin = 0;
                }
            }
        }

        if (isset($_REQUEST['gotobin'])) {
            if ($_REQUEST['submit'] == "Go To Bin") {
                if ($_REQUEST['gotobin'] != $binNum) {
                    $binNum = ($_REQUEST['gotobin']);
                    $usebin = 1;
                }
            }
        }
        ?>
        <div class="question">Scan the hexagrams</div>
        <div ><a href="consult.php">CONSULT</a></div>

        <form method="POST" action="">
            <input type="submit" name="submit" value="Prev Hex">
            <input type="submit" name="submit" value="Next Hex">
            <input type="submit" name="submit" value="Prev Bin">
            <input type="submit" name="submit" value="Next Bin"><br>

            <input type="hidden" name="hex" value="<?= $hexNum ?>">
            <input type="text" name="gotohex" value="<?= $hexNum ?>">
            <input type="submit" name="submit" value="Go To Hex"><br>

            <input type="hidden" name="bin" value="<?= $binNum ?>">
            <input type="text" name="gotobin" value="<?= $binNum ?>">
            <input type="submit" name="submit" value="Go To Bin">

        </form>
        <?php
        $ary = null;
        if ($usebin == 1) {
            $ary = getBin($binNum);
        }
        if ($usebin == 0) {
            $ary = getHex($hexNum);
        }

        $t = $ary[0];
            logout($t);
//    var_dump($json);
        ?>
                <?php if (isset($t['fix'])) {?>
                   <div class="content btn btn-danger">FIX :<?= $t['fix'] ?></div>
                <?php } ?>
        <div><img class="heximg" alt="<?= $t['pseq'] ?> / <?= $t['title'] ?>/<?= $t['trans'] ?>" src="images/hex/hexagram<?= sprintf("%02d", $t['pseq']) ?>.png"></div>    
        <div class="tossed">

            <div class="label">Hex #</div>
            <div class="content" id="pseq"><?= $t['pseq'] ?></div>

            <div class="label">Bin #</div>
            <div class="content" id="bseq"><?= $t['bseq'] ?></div>

            <div class="label">Title</div>
            <div class="content" id="title"><?= $t['title'] ?></div>

            <div class="label">Translation</div>
            <div class="content" id="trans"><?= $t['trans'] ?></div>

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
            $j = $i + 1;
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
        ?>
        </div>
        </div>    
    <div class="container rightCol" id="debug">
</div>  
    </body>
</html>
<?php


<?php

require "elements/header.php";
require "vendor/autoload.php";
require "lib/functions.php";

?>

<section>
    <!-- div class="content"><strong> The Dharma Clock Project's I Ching page</strong></div-->
</section>
<section id="pageContent">

    <span class="floatingcontainer">
        <?php
        $usebin = 0;

        $hexNum = ($_REQUEST['hex'] ? $_REQUEST['hex'] : 1);
        $binNum = ($_REQUEST['bin'] ? $_REQUEST['bin'] : 0);

        if ($_REQUEST['submit'] == "Hex >") {
            $hexNum++;
            $hexNum = ($hexNum > 64 ? 1 : $hexNum);
            $binNum = chex2bin($hexNum);
            $usebin = 0;
        }
        if ($_REQUEST['submit'] == "< Hex") {
            $hexNum--;
            $hexNum = ($hexNum < 1 ? 64 : $hexNum);
            $binNum = chex2bin($hexNum);
            $usebin = 0;
        }
        if ($_REQUEST['submit'] == "Bin >") {
            $binNum++;
            $binNum = ($binNum > 63 ? 0 : $binNum);
            $hexNum = cbin2Hex($binNum);
            $usebin = 1;
        }
        if ($_REQUEST['submit'] == "< Bin") {
            $binNum--;
            $binNum = ($binNum < 0 ? 63 : $binNum);
            $hexNum = cbin2Hex($binNum);
            $usebin = 1;
        }

        if (isset($_REQUEST['gotohex'])) {
            if ($_REQUEST['submit'] == "Go To Hex") {
//                if ($_REQUEST['gotohex'] != $hexNum) {
                    $hexNum = ($_REQUEST['gotohex']);
                    $binNum = chex2bin($hexNum);
                    $usebin = 0;
//                }
            }
        }

        if (isset($_REQUEST['gotobin'])) {
            if ($_REQUEST['submit'] == "Go To Bin") {
//                if ($_REQUEST['gotobin'] != $binNum) {
                    $binNum = ($_REQUEST['gotobin']);
                    $hexNum = cbin2hex($binNum);
                    $usebin = 1;
//                }
            }
        }
        ?>
        <form method="POST" action="">
        <span class="question text_mdcaps">Scan the hexagrams</span>
        <span class="text_md-caps btn btn-danger" ><a style="color:white" target="blank_" href="/index.php">CONSULT</a></span>
            <input class="text_md-caps btn btn-primary" type="submit" name="submit" value="< Hex">
            <input class="text_md-caps btn btn-success" type="submit" name="submit" value="Hex >">
            <input class="text_md-caps btn btn-primary" type="submit" name="submit" value="< Bin">
            <input class="text_md-caps btn btn-success" type="submit" name="submit" value="Bin >">

            <input type="hidden" name="hex" value="<?= $hexNum ?>">
            <input type="text" class = "doublenum"  name="gotohex" value="<?= $hexNum ?>">
            <input class="text_mdcaps btn btn-info" style="color:black" type="submit" name="submit" value="Go To Hex">

            <input type="hidden" name="bin" value="<?= $binNum ?>">
            <input type="text" class = "doublenum" name="gotobin" value="<?= $binNum ?>">
            <input class="text_mdcaps btn btn-info" style="color:black" type="submit" name="submit" value="Go To Bin">

        </form>
        </span>
        <div class="container">

        <?php
        $ary = null;
        if ($usebin == 1) {
            $ary = getBin($binNum);
        }
        if ($usebin == 0) {
            $ary = getHex($hexNum);
        }

        $t = $ary[0];
        
        if (isset($t['fix'])) {?>
            <div class="content btn btn-danger">FIX :<?= $t['fix'] ?></div>
        <?php } ?>
 
                   
<?php
#book-search-results > div.search-noresults > section

use PHPHtmlParser\Dom;
$dom = new Dom;

$filename = "book/ichingbook/_book/hexagrams/".f($hexNum)."-".$t['filename'].".html";
//var_dump($filename);

$dom->load(file_get_contents($filename));
$c = $dom->find("#book-search-results > div.search-noresults > section");

echo $c->innerHtml();

?>                   

        </div>  
<?php
require "elements/footer.php";
?>


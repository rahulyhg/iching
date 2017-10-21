<?php

require get_cfg_var("iching_root") . "/lib/init.php";
require get_cfg_var("iching_root") . "/lib/functions.php";
require_once get_cfg_var("iching_root") . "/lib/class/Tosser.class.php";
?>


<?php

//$tosser = new Tosser();
//$r = $tosser->getAstro();
$r = getAstro();

function getAstro() {
    $throw = array(null, null, null, null, null, null);

    $astroUrl = getServerPrefix() . "/astro/js/astrodataJson.html";
    $astroPage = file_get_contents($astroUrl);

    system("./getJson.sh");
    $search_pattern="/.*>(\{.*\})<.*/s";
    $clean = "<div>".preg_replace ( $search_pattern,"$1",$astroPage)."</div>";
    $dom = new DOMDocument();
    $dom->loadHTML($clean);

    $myDivs = $dom->getElementsByTagName('div');
    foreach ($myDivs as $key => $value) {
        $result[] = $value->nodeValue;
    }
    $astroJson = $result[0];
    $astroObj = json_decode($astroJson, true);

    $anums = array();

    foreach ($astroObj as $planet => $pary) {
        if ($planet != "Sun") {
            if (isset($pary['RA'])) {
                $nodec = str_replace(".", "", $pary['RA']['S']);
                $nary = str_split($nodec);
                $nt = 0;
                foreach ($nary as $n) {
                    $nt += $n;
                }
                $anums[$planet] = ($nt % 4) + 6;
            }
        }
    }

    $throw = array(
        $anums['Moon'],
        $anums['Mercury'],
        $anums['Venus'],
        $anums['Mars'],
        $anums['Jupiter'],
        $anums['Saturn'],
    );

    print_r($throw);

    return($throw);
}
?>

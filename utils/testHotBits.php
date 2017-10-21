<?php
require get_cfg_var("iching_root") . "/conf/config.php";
require get_cfg_var("iching_root") . "/lib/init.php";
require get_cfg_var("iching_root") . "/lib/functions.php";

$h = "http://www.fourmilab.ch/cgi-bin/uncgi/Hotbits?nbytes=3&fmt=c&pseudo=pseudo";

$ctx = stream_context_create(array('http'=>
    array(
        'timeout' => 15,  //1200 Seconds is 20 Minutes
    )
));

$r = file_get_contents($h, false, $ctx);
$f = fopen(get_cfg_var("iching_root") . "/data/store/hotbitsdown", "w");

if (!$r) {
        fwrite($f,1);
} else {
        fwrite($f,0);
}
fclose($f);

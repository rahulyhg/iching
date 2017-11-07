<?php

require_once getRootDir()."/charting/mysqli_connect_online_calcs_db_MYSQLI.php";
include(getRootDir()."/charting/home/online_calcs/scripts/constants_eng.php");
include(getRootDir()."/charting/home/online_calcs/constants.php");


function getRootDir() {
    $runtime = "dev";
    if (isset($_SERVER['runtime'])) {
        $runtime = $_SERVER['runtime'];
    }
    $dir = get_cfg_var("iching.${runtime}.root");
    return($dir);
}

function getCopyright() {
  //$copyright1 = "This chart wheel is copyrighted";
  //$copyright2 = "and generated at " . YOUR_URL;
  return(YOUR_URL);
  
}


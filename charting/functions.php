<?php

require_once getRootDir()."/charting/mysqli_connect_online_calcs_db_MYSQLI.php";
//include(getRootDir()."/charting/home/online_calcs/scripts/constants_eng.php");
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


Function safeEscapeString($string)
{
// replace HTML tags '<>' with '[]'
  $temp1 = str_replace("<", "[", $string);
  $temp2 = str_replace(">", "]", $temp1);

// but keep <br> or <br />
// turn <br> into <br /> so later it will be turned into ""
// using just <br> will add extra blank lines
  $temp1 = str_replace("[br]", "<br />", $temp2);
  $temp2 = str_replace("[br /]", "<br />", $temp1);

  if (get_magic_quotes_gpc())
  {
    return $temp2;
  }
  else
  {
    return mysql_escape_string($temp2);
  }
}


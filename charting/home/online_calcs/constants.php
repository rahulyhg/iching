<?php

function getRootDir() {
    $runtime = "dev";
    if (isset($_SERVER['runtime'])) {
        $runtime = $_SERVER['runtime'];
    }
    $dir = get_cfg_var("iching.${runtime}.root");
    return($dir);
}

define('ROOT_PATH', getRootDir()."/charting/home");   //define the path to the "root" where the sub-directories may be found

define('MAIN_SUBDIR', "/charting/home/online_calcs/scripts");                  //set sub-directory where main files are located

define('MAIN_PAGE', MAIN_SUBDIR . "/data_entry_1.php");   //set main page where user is pointed to after payment cancel or okay or from logged in menu

define('VIEW_RECORDS_PAGE', MAIN_SUBDIR . "/view_records.php");   //set view_records.php page

define('BACKGROUND_COLOR', "#c0d0ff");             //set background color - change this value in styles.css as well as here

define('YOUR_URL', "astro.slider.com");             //set website domain

define('EMAIL_ADDRESS', "duncan.stroud@gmail.com");    //set e-mail address

define('COPYRIGHT_DATE', "2009-2014");                  //set copyright date
?>

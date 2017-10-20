<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$_SERVER['iching_root'] = get_cfg_var("iching_root");
require get_cfg_var("iching_root")."/lib/class/DataMapper.class.php";

$dbh = new DataMapper();
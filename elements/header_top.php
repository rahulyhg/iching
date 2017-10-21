<?php
session_start();
//var_dump(session_id());
#mb_internal_encoding("UTF-8");
#mb_regex_encoding("UTF-8");

?>
<html lang="en" class="">
    <head>
        <!-- meta property='og:image' content='https://www.concrete5.org/themes/version_4/images/logo.png' /-->
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>Dharma Clock Project</title>
        <meta name="description" content="I Ching is a book of wisdom, an oracle a math system, and a philosophy - access all of them here" />
        
    <?php 
    
    if ( $_SERVER['PHP_SELF'] == "/index.php") {
    }
    
    ?>
    
        <!-- vendor includes -->
        <script src="/vendor/components/jquery/jquery.min.js"></script>
        <script src="/vendor/twitter/bootstrap/dist/js/bootstrap.min.js"></script>    
        <script type="text/javascript" src="/vendor/qtip/jquery.qtip.js"></script>
        <!-- jquery -->
        <script type="text/javascript" src="/js/script.js"></script>    
	<script src="/vendor/jquery-ui/jquery-ui.min.js"></script>        
`        <!-- local js -->
        <script type="text/javascript" src="/js/consult.js"></script>    
	<link href="/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <!-- accordian -->
	<script src="/js/accordian.js"></script>        
        <!--script type="text/javascript" src="/dom-to-image/src/dom-to-image.js"></script-->
        <script src="/astro/js/as.js"></script>
        
        
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">//-->
        <link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="/css/drawhex.css" />
        <!-- overload this if other page -->
        <link rel="stylesheet" media="screen" type="text/css" href="/css<?= ($_SERVER['PHP_SELF'] == "/show.php" ? "/show" : "/consult") ?>.css" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/vendor/twitter/bootstrap/dist/css/bootstrap.min.css">
        <!-- accordian -->
        <link rel="stylesheet" href="/css/accordian.css">
    </head>
<body>
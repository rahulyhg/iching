<?php
mb_internal_encoding("UTF-8");
mb_regex_encoding("UTF-8");
?>
<html lang="en" class="">
    <head>
        <meta property='og:image' content='https://www.concrete5.org/themes/version_4/images/logo.png' />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>Dharma Clock Project</title>
        <meta name="description" content="I Ching is a book of wisdom, an oracle a math system, and a philosophy - access all of them here" />
        
    <?php 
    
    if ( $_SERVER['PHP_SELF'] == "/index.php") {
    }
    
    ?>
    
        <script src="/vendor/components/jquery/jquery.min.js"></script>
        <script src="/vendor/twitter/bootstrap/dist/js/bootstrap.min.js"></script>    
        <script type="text/javascript" src="/vendor/qtip/jquery.qtip.js"></script>
        <script type="text/javascript" src="/js/script.js"></script>    
        <script type="text/javascript" src="/js/consult.js"></script>    
        
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">//-->
        <link rel="stylesheet" media="screen" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="/css/drawhex.css" />
        <!-- overload this if other page -->
        <link rel="stylesheet" media="screen" type="text/css" href="/css<?= ($_SERVER['PHP_SELF'] == "/show.php" ? "/show" : "/consult") ?>.css" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/vendor/twitter/bootstrap/dist/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="/vendor/qtip/jquery.qtip.css" />
    </head>
<body>
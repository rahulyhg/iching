
<?php

require "../functions.php";
include("templates/template.class.php");
$type = 'pseq';
$ids = getids($type);
$cols = getcols();


foreach ($ids as $id) {
    
    $hex = mdgethex($type, $id);


    /**
     * Creates a new template for the user's page.
     * Fills it with mockup data just for testing.
     */
    $page = new Template("templates/page.tpl");


    $page->set("id", f($hex[0]['pseq']));
    $page->set("trans", $hex[0]['trans']);
    $page->set("title", $hex[0]['title']);
    $page->set("pseq", f($hex[0]['pseq']));    
    $page->set("bseq", f($hex[0]['bseq']));
    $page->set("binary", $hex[0]['binary']);
    $page->set("dir", $hex[0]['dir']);
    $page->set("tri_upper", $hex[0]['tri_upper']);
    $page->set("tri_lower", $hex[0]['tri_lower']);
    $page->set("judge_old", $hex[0]['judge_old']);
    $page->set("judge_exp", $hex[0]['judge_exp']);
    
    
    
    $page->set("image_old",  $hex[0]['image_old']);
    $page->set("image_exp",  $hex[0]['image_exp']);
    $page->set("line_1",    $hex[0]['line_1']);
    $page->set("line_1_org", $hex[0]['line_1_org']);
    $page->set("line_1_exp", $hex[0]['line_1_exp']);
    $page->set("line_2",     $hex[0]['line_2']);
    $page->set("line_2_org", $hex[0]['line_2_org']);
    $page->set("line_2_exp", $hex[0]['line_2_exp']);
    $page->set("line_3",     $hex[0]['line_3']);
    $page->set("line_3_org", $hex[0]['line_3_org']);
    $page->set("line_3_exp", $hex[0]['line_3_exp']);
    $page->set("line_4",     $hex[0]['line_4']);
    $page->set("line_4_org", $hex[0]['line_4_org']);
    $page->set("line_4_exp", $hex[0]['line_4_exp']);
    $page->set("line_5",     $hex[0]['line_5']);
    $page->set("line_5_org", $hex[0]['line_5_org']);
    $page->set("line_5_exp", $hex[0]['line_5_exp']);
    $page->set("line_6",     $hex[0]['line_6']);
    $page->set("line_6_org", $hex[0]['line_6_org']);
    $page->set("line_6_exp", $hex[0]['line_6_exp']);
    
    $page->set("fix", $hex[0]['fix']);
    $page->set("comment", $hex[0]['comment']);
    
    // was loading this
//    {% include "git+https://github.com/baardev/iching_book.git/[@id].md" %}
    

    /**
     * Loads our layout template, settings its title and content.
     */
    $layout = new Template("templates/layout.tpl");
//    $layout->set("title", "User page");
    $layout->set("content", $page->output());

    /**
     * Outputs the page with the user's page.
     */
    $fpage =  $layout->output();
    $f = "iching_book/The Hexagrams/" . f($id) . "-".$hex[0]['filename'].".md";
//    $f = "iching_book/" . f($id) .".md";
    echo "writing [${f}]\n";
    file_put_contents($f,$fpage);
}

function getids($type) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT ${type} from hexagrams order by ${type} asc";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $ids = $sth->fetchAll();
    $c = array();
    foreach ($ids as $id) {
        array_push($c, $id[$type]);
    }
    return($c);
}

function getcols() {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'iching' AND TABLE_NAME = 'hexagrams'";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $cols = $sth->fetchAll();
    $c = array();
    foreach ($cols as $col) {
        array_push($c, $col['COLUMN_NAME']);
    }
    return($c);
}


function mdgethex($type, $id) {
    $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
    $sql = "SELECT * from hexagrams where ${type}=${id}";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $hex = $sth->fetchAll();
    return($hex);
}

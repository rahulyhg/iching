<?php

class DataMapper {

    private $pdo;
    public $o;

    public function __construct($ini) {
        $name = $ini['db.name'];
        $server = $ini['db.server'];
        $user = $ini['db.user'];
        $pass = $ini['db.pass'];

        $dsn = "mysql:host=${server};dbname=${name};charset=utf8mb4";

        try {
            $dbh = new PDO($dsn, $user, $pass);
            $this->pdo = $dbh;
            $this->o = $dbh;
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $e) {
            echo 'Exception -> ';
            dbug($e->xdebug_message);
            die();
        }
    }

    public function ex($q, $qargs = null, $fargs = array()) {
        $res = null;
        $stmt = null;
//        var_dump($q);
        try {
            $stmt = $this->pdo->prepare($q);
        } catch (Exception $e) {
            echo 'Exception -> ';
            dbug($e->xdebug_message);
        }

        if (!($res = $stmt->execute($qargs))) {
            print_r($stmt->errorInfo());
            die;
        }
        return($res);
    }

    public function getData($param) {
        $query = <<<EOX
        SELECT 
            fix
            ,proofed
            ,`comment`
                        ,filename
            ,pseq
            ,bseq
            ,`binary`
            ,title
            ,trans
            ,trigrams
                   ,(SELECT distinct concat(
                trigrams.pseq,' (',trigrams.bseq,') ',trigrams.title,' / ',trigrams.trans
                )   FROM
                hexagrams
                Inner Join trigrams ON hexagrams.tri_upper_bin = trigrams.bseq 
                WHERE hexagrams.binary = ? limit 1
                ) as tri_upper
            ,(SELECT distinct concat(
                trigrams.pseq,' (',trigrams.bseq,') ',trigrams.title,' / ',trigrams.trans
                )   FROM
                hexagrams
                Inner Join trigrams ON hexagrams.tri_lower_bin = trigrams.bseq 
                WHERE hexagrams.binary = ? limit 1
             ) as tri_lower
            ,explanation
            ,judge_old
            ,judge_exp
            ,image_old
            ,image_exp
            ,line_1
            ,line_1_org
            ,line_1_exp
            ,line_2
            ,line_2_org
            ,line_2_exp
            ,line_3
            ,line_3_org
            ,line_3_exp
            ,line_4
            ,line_4_org
            ,line_4_exp
            ,line_5
            ,line_5_org
            ,line_5_exp
            ,line_6
            ,line_6_org
            ,line_6_exp

    FROM hexagrams
        WHERE hexagrams.`binary` = ?
EOX;

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $param, PDO::PARAM_STR);
            $stmt->bindParam(2, $param, PDO::PARAM_STR);
            $stmt->bindParam(3, $param, PDO::PARAM_STR);

            $stmt->execute();
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return($r);
        } catch (Exception $e) {
            echo 'Exception -> ';
            dbug($e->xdebug_message);
            die();
        }
    }



    public function getNotesData($param) {
        //dbug($param);

        $query = <<<EOX
        SELECT 
            fix
            ,proofed
            ,`comment`
            ,filename
            ,pseq
            ,bseq
            ,`binary`
            ,title
            ,trans
            ,trigrams
            ,tri_upper
            ,tri_lower
            ,explanation
            ,judge_old
            ,judge_exp
            ,image_old
            ,image_exp
            ,line_1
            ,line_1_org
            ,line_1_exp
            ,line_2
            ,line_2_org
            ,line_2_exp
            ,line_3
            ,line_3_org
            ,line_3_exp
            ,line_4
            ,line_4_org
            ,line_4_exp
            ,line_5
            ,line_5_org
            ,line_5_exp
            ,line_6
            ,line_6_org
            ,line_6_exp

    FROM notes
        WHERE notes.`binary` = ?
EOX;

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $param, PDO::PARAM_STR);
            $stmt->bindParam(2, $param, PDO::PARAM_STR);
            $stmt->bindParam(3, $param, PDO::PARAM_STR);

            $stmt->execute();
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return($r);
        } catch (Exception $e) {
            echo 'Exception -> ';
            //dbug($e->xdebug_message);
            die();
        }
    }
    public function getQabalahData($param) {
        //dbug($param);
        /* convert binary paran to nuymner */
        
        $dec = bindec($param);
        $query = "";
        if ($dec>32) {
            $query = <<<EOX

            SELECT
                32pairs.pathnum
                ,32pairs.num
                ,32pairs.title
                ,32pairs.path
                ,32pairs.assiah
                ,32pairs.type
                ,32pairs.tarot_num
                ,32pairs.tarot
                ,32pairs.des_name
                ,32pairs.des_pseq
                ,32pairs.des_bseq
                ,32pairs.des_binary
                ,32pairs.des_balance
                ,32pairs.des_balance_desc
                ,32pairs.des_meaning
                ,32pairs.asc_name
                ,32pairs.asc_pseq
                ,32pairs.asc_bseq
                ,32pairs.asc_binary
                ,32pairs.asc_balance
                ,32pairs.asc_balance_desc
                ,32pairs.asc_meaning
                ,32pairs.theme
                ,32pairs.desc
                ,hexagrams.title AS `HEX`
            FROM
                hexagrams
            Inner Join 32pairs ON hexagrams.bseq = 32pairs.des_bseq
            WHERE hexagrams.`bseq` = ?
EOX;
        } else {
            $query = <<<EOX

            SELECT
                32pairs.pathnum
                ,32pairs.num
                ,32pairs.title
                ,32pairs.path
                ,32pairs.assiah
                ,32pairs.type
                ,32pairs.tarot_num
                ,32pairs.tarot
                ,32pairs.des_name
                ,32pairs.des_pseq
                ,32pairs.des_bseq
                ,32pairs.des_binary
                ,32pairs.des_balance
                ,32pairs.des_balance_desc
                ,32pairs.des_meaning
                ,32pairs.asc_name
                ,32pairs.asc_pseq
                ,32pairs.asc_bseq
                ,32pairs.asc_binary
                ,32pairs.asc_balance
                ,32pairs.asc_balance_desc
                ,32pairs.asc_meaning
                ,32pairs.theme
                ,32pairs.desc
                ,hexagrams.title AS `HEX`
            FROM
                hexagrams
            Inner Join 32pairs ON hexagrams.bseq = 32pairs.asc_bseq
            WHERE hexagrams.`bseq` = ?
EOX;
        }

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $dec, PDO::PARAM_STR);
//            $stmt->bindParam(2, $param, PDO::PARAM_STR);
//            $stmt->bindParam(3, $param, PDO::PARAM_STR);

            $stmt->execute();
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return($r);
        } catch (Exception $e) {
            //echo 'Exception -> ';
            dbug($e);
            
        }
    }

    public function getShortData($param) {
        //dbug($param);

        $query = <<<EOX
        SELECT 
            fix
            ,proofed
            ,`comment`
            ,filename
            ,pseq
            ,bseq
            ,`binary`
            ,title
            ,trans
            ,trigrams
            ,(SELECT distinct concat(
                trigrams.pseq,' (',trigrams.bseq,') ',trigrams.title,' / ',trigrams.trans
                )   FROM
                short
                Inner Join trigrams ON short.tri_upper_bin = trigrams.bseq 
                WHERE short.binary = ? limit 1
                ) as tri_upper
            ,(SELECT distinct concat(
                trigrams.pseq,' (',trigrams.bseq,') ',trigrams.title,' / ',trigrams.trans
                )   FROM
                short
                Inner Join trigrams ON short.tri_lower_bin = trigrams.bseq 
                WHERE short.binary = ? limit 1
             ) as tri_lower
            ,explanation
            ,judge_old
            ,judge_exp
            ,image_old
            ,image_exp
            ,line_1
            ,line_1_org
            ,line_1_exp
            ,line_2
            ,line_2_org
            ,line_2_exp
            ,line_3
            ,line_3_org
            ,line_3_exp
            ,line_4
            ,line_4_org
            ,line_4_exp
            ,line_5
            ,line_5_org
            ,line_5_exp
            ,line_6
            ,line_6_org
            ,line_6_exp

    FROM short
        WHERE short.`binary` = ?
EOX;

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $param, PDO::PARAM_STR);
            $stmt->bindParam(2, $param, PDO::PARAM_STR);
            $stmt->bindParam(3, $param, PDO::PARAM_STR);

            $stmt->execute();
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return($r);
        } catch (Exception $e) {
            echo 'Exception -> ';
            dbug($e->xdebug_message);
            die();
        }
    }


    public function getDataAlt($param) {
        $query = <<<EOX
        SELECT 
        `fix`
        ,`comment`
        ,`filename`
        ,pseq
        ,bseq
        ,`binary`
        ,title
        ,trans
        ,trigrams
        ,(SELECT distinct concat(
                trigrams.pseq,' (',trigrams.bseq,') ',trigrams.title,' / ',trigrams.trans
            )   FROM
            hexagrams
            Inner Join trigrams ON hexagrams.tri_upper_bin = trigrams.bseq 
            WHERE hexagrams.pseq = ? limit 1
            ) as tri_upper
        ,(SELECT distinct concat(
                trigrams.pseq,' (',trigrams.bseq,') ',trigrams.title,' / ',trigrams.trans
            )   FROM
            hexagrams
            Inner Join trigrams ON hexagrams.tri_lower_bin = trigrams.bseq 
            WHERE hexagrams.pseq = ? limit 1
         ) as tri_lower
        ,explanation
        ,judge_old
        ,judge_exp
        ,image_old
        ,image_exp
        ,line_1
        ,line_1_org
        ,line_1_exp
        ,line_2
        ,line_2_org
        ,line_2_exp
        ,line_3
        ,line_3_org
        ,line_3_exp
        ,line_4
        ,line_4_org
        ,line_4_exp
        ,line_5
        ,line_5_org
        ,line_5_exp
        ,line_6
        ,line_6_org
        ,line_6_exp
FROM hexagrams
    WHERE hexagrams.pseq = ?      
EOX;
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $param, PDO::PARAM_STR);
            $stmt->bindParam(2, $param, PDO::PARAM_STR);
            $stmt->bindParam(3, $param, PDO::PARAM_STR);
            $stmt->execute();
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return($r);
        } catch (Exception $e) {
            echo 'Exception -> ';
            dbug($e->xdebug_message);
            die();
        }
    }

    public function BROKEgetData($query) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    
    public function fetchAllHexByPseq($pseq) {
        $query = "SELECT * FROM hexagrams WHERE pseq = :pseq";
        return($this->ex($query, array(':pseq' => $pseq), array())->fetchAll(PDO::FETCH_ASSOC));
    }

    public function fetchAllHex() {
        $query = "SELECT * FROM `hexagrams`";
        return($this->ex($query, array(), array())->fetchAll(PDO::FETCH_ASSOC));
    }

    public function sql($vars) {
        $query = "UPDATE hexagrams set " . $vars['name'] . " = :val WHERE ID = " . $vars['i'];
        return($this->ex($query, array(":val" => $vars['val']), array())->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getAllHexes() {
        $query = "SELECT * from hexagrams";
        $sth = $this->o->prepare($query);
        $sth->execute();
        return($sth->fetchAll(PDO::FETCH_ASSOC));
//        return($this->ex($query, array(), array('debug' => $d))->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getNotes($h) {
        $query = "SELECT * from notes where pseq=${h}";
        $sth = $this->o->prepare($query);
        $sth->execute();
        return($sth->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getHex($h) {
        $query = "SELECT * from hexagrams where pseq=${h}";
        $sth = $this->o->prepare($query);
        $sth->execute();
        return($sth->fetchAll(PDO::FETCH_ASSOC));

        //return($this->ex($query, array(), array())->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getBin($h) {
        $query = "SELECT * from hexagrams where bseq=${h}";
        $sth = $this->o->prepare($query);
        $sth->execute();
        return($sth->fetchAll(PDO::FETCH_ASSOC));
    }

    public function cbin2hex($b) {
        $query = "SELECT pseq from hexagrams where bseq=${b}";

        $sth = $this->o->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return($res[0]['pseq']);
    }

    public function chex2bin($h) {
        $query = "SELECT bseq from hexagrams where pseq=${h}";
        //var_dump($query);
        $sth = $this->o->prepare($query);
        $sth->execute();
        $bin = $sth->fetch();
        return($bin['bseq']);
    }

    public function getHexnumOppositeByPseq($pseq) {
        $bin = $this->getHexFieldByPseq("hexagrams", "bseq", $pseq);
        $obin = 63 - $bin;
        $ohexnum = $this->cbin2hex($obin);
        return($ohexnum);
    }

    public function getHexnumOppositeByBseq($bseq) {
        $bin = $bseq;//$bin = $this->getHexFieldByPseq("hexagrams", "bseq", $bseq);
        $obin = 63 - $bin;
        $ohexnum = $obin;//$this->cbin2hex($obin);
        return($ohexnum);
    }

    public function getHexFieldByBinary($table, $field, $bin) {
        $query = "SELECT $table.$field from $table where `binary` = '${bin}'";
        $sth = $this->o->prepare($query);
        $sth->execute();
        $bin = $sth->fetch();
        return($bin[$field]);
    }

    public function getHexFieldByPseq($table, $field, $pseq) {
        $query = "SELECT $table.$field from $table where pseq = ${pseq}";
        //var_dump($query);
        $sth = $this->o->prepare($query);
        $sth->execute();
        $bin = $sth->fetch();
        return($bin[$field]);
    }    
    public function getHexFieldByBseq($table, $field, $bseq) {
        $query = "SELECT $table.$field from $table where bseq = ${bseq}";
        //var_dump($query);
        $sth = $this->o->prepare($query);
        $sth->execute();
        $bin = $sth->fetch();
        return($bin[$field]);
    }

    public function getAllPositions() {
        $query = "SELECT * from positions";
        $sth = $this->o->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return($res);
    }

    public function getAllDescPositions() {
        $query = "SELECT * from desc_positions";
        $sth = $this->o->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return($res);
    }

    public function getAllAscPositions() {
        $query = "SELECT * from asc_positions";
        $sth = $this->o->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return($res);
    }

    public function site_authuser($u, $p) {
        $query = "SELECT * FROM `site_user` WHERE username='$u' and password='$p'";
        $_SESSION['username'] = $u;
        $sth = $this->o->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($res);
        $count = count($res);
        //var_dump($count);
        return($res);
    }

    public function putSuggestion($sug) {
        try {
            $query = "insert into site_suggestions (suggestion,dtstamp) values (:sug,NOW())";
            $sth = $this->o->prepare($query);
            $sth->bindParam(":sug", $sug,PDO::PARAM_STR);
            $sth->execute();
            return(1);
        } catch (PDOException $e) {
            dbug($e->xdebug_message,TRUE);
            die("FATAL ERROR");                   
        }
    }
    public function subSearch($searchStr) {
        $sr = array();


        $sr["comment"] = $this->subResults($searchStr, "comment");
        $sr["title"] = $this->subResults($searchStr, "title");
        $sr["trans"] = $this->subResults($searchStr, "trans");
        $sr["trigrams"] = $this->subResults($searchStr, "trigrams");
        $sr["tri_upper"] = $this->subResults($searchStr, "tri_upper");
        $sr["tri_lower"] = $this->subResults($searchStr, "tri_lower");
        $sr["explanation"] = $this->subResults($searchStr, "explanation");
        $sr["judge_old"] = $this->subResults($searchStr, "judge_old");
        $sr["judge_exp"] = $this->subResults($searchStr, "judge_exp");
        $sr["image_old"] = $this->subResults($searchStr, "image_old");
        $sr["image_exp"] = $this->subResults($searchStr, "image_exp");
        $sr["line_1_org"] = $this->subResults($searchStr, "line_1_org");
        $sr["line_1_exp"] = $this->subResults($searchStr, "line_1_exp");
        $sr["line_2_org"] = $this->subResults($searchStr, "line_2_org");
        $sr["line_2_exp"] = $this->subResults($searchStr, "line_2_exp");
        $sr["line_3_org"] = $this->subResults($searchStr, "line_3_org");
        $sr["line_3_exp"] = $this->subResults($searchStr, "line_3_exp");
        $sr["line_4_org"] = $this->subResults($searchStr, "line_4_org");
        $sr["line_4_exp"] = $this->subResults($searchStr, "line_4_exp");
        $sr["line_5_org"] = $this->subResults($searchStr, "line_5_org");
        $sr["line_5_exp"] = $this->subResults($searchStr, "line_5_exp");
        $sr["line_6_org"] = $this->subResults($searchStr, "line_6_org");
        $sr["line_6_exp"] = $this->subResults($searchStr, "line_6_exp");




        $final = formatSearch($sr, $searchStr);
        return($final);
    }

    private function subResults($searchStr, $field) {

        //https://dev.mysql.com/doc/refman/5.7/en/fulltext-natural-language.html

        $query = <<<EOX
            SELECT pseq ,${field}
            FROM 
              hexagrams 
            WHERE MATCH 
              (${field})
                 AGAINST
              ('${searchStr}'  IN NATURAL LANGUAGE MODE);
EOX;

        $sth = $this->o->prepare($query);
        $sth->execute();
        $r = $sth->fetchAll(PDO::FETCH_ASSOC);
        return($r);
    }

    public function searchResults($str, $field) {

        //https://dev.mysql.com/doc/refman/5.7/en/fulltext-natural-language.html
        $query = <<<EOX
                
            SELECT pseq ,${field},
            MATCH 
              (${field}) 
                AGAINST
              ('${str}'  IN NATURAL LANGUAGE MODE) AS score
            FROM 
              hexagrams 
            WHERE MATCH 
              (${field})
                 AGAINST
              ('${str}'  IN NATURAL LANGUAGE MODE);
EOX;

        $sth = $this->o->prepare($query);
        $sth->execute();
        $r = $sth->fetchAll(PDO::FETCH_ASSOC);
        $res = var_export($r, TRUE);
        $out = "";
        foreach ($r as $p) {
            $out .= "<div><b><a href='/show.php?pseq=" . $p['pseq'] . "'>hexagram " . $p['pseq'] . " (" . $this->getHexFieldByPseq("hexagrams", "trans", $p['pseq']) . " )</a></b>:</div>";
            $out .= "${field} Commentary<div style='font-size:8pt; border:1px solid grey; margin-left:20px'>" . highlight($str, $p[$field]) . "</div>";
            //$out .= "Image Commentary<div style='font-size:8pt; border:1px solid grey; margin-left:20px'>".highlight($str,$p['image_exp'])."</div>";  
            foreach ($p as $key => $val) {
                
            }
        }

        $final = "<div style='max-width:80%;overflow:scroll; word-break:break-all;height:400px;'>" . count($r) . " hexagrams with " . highlight($str, $str) . " by score $out</div>";

        return($final);
    }
    
    public function getStopWords() {
        $query = "SELECT * FROM INFORMATION_SCHEMA.INNODB_FT_DEFAULT_STOPWORD";
        $sth = $this->o->prepare($query);
        $sth->execute();
        $r = $sth->fetchAll(PDO::FETCH_ASSOC);
        $simpleArray = array();
        foreach ($r as $s) {
            array_push($simpleArray,$s['value']);
        }
        return($simpleArray);
    }
}

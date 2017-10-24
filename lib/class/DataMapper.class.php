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
//dbug($dsn);
        $dbh = null;
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
            dbug ($e->xdebug_message);
        }

        if (!($res = $stmt->execute($qargs))) {
            print_r($stmt->errorInfo());
            die;
        }
        return($res);
    }

    public function getData($query) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return($stmt->fetchAll(PDO::FETCH_ASSOC));

//        $q = $this->ex($query, array());
//        var_dump($q);
//        $r = $q->fetchAll(PDO::FETCH_ASSOC);
//        return($r);
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

    public function getHexFieldByBinary($table, $field, $bin) {
        $query = "SELECT $field from $table where `binary` = '${bin}'";
        $sth = $this->o->prepare($query);
        $sth->execute();
        $bin = $sth->fetch();
        return($bin[$field]);
    }

    public function getHexFieldByPseq($table, $field, $pseq) {
        $query = "SELECT $field from $table where pseq = ${pseq}";
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
        var_dump($res);
        $count = count($res);
        var_dump($count);
        return($res);
    }

}

<?php

class DataMapper {

    private $pdo;
    public $o;

    public function __construct() {
        $dbh = new PDO('mysql:host=localhost;dbname=iching;charset=utf8mb4', 'ichingDBuser', '1q2w3e');
        $this->pdo = $dbh;
        $this->o = $dbh;
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function ex($q, $qargs = null, $fargs = array()) {
        $res = null;
        $stmt = null;
//        var_dump($q);
        try {
            $stmt = $this->pdo->prepare($q);
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
        
        if (! ($res = $stmt->execute($qargs))) {
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

    public function getHex($h) {
        $query = "SELECT * from hexagrams where pseq=${h}";
        return($this->ex($query, array(), array())->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getBin($h) {
        $query = "SELECT * from hexagrams where bseq=${h}";
        return($this->ex($query, array(), array())->fetchAll(PDO::FETCH_ASSOC));
    }

    public function cbin2hex($b) {
        $query = "SELECT pseq from hexagrams where bseq=${b}";
        $res = $this->ex($query, array(), array())->fetchAll(PDO::FETCH_ASSOC);
        return($res['pseq']);
    }

    public function chex2bin($h) {
        $query = "SELECT bseq from hexagrams where pseq=${h}";
        $sth = $this->o->prepare($query);
        $sth->execute();
        $bin = $sth->fetch();
        return($bin['bseq']);
      //  $res = $this->ex($query, array(), array('debug' => $d))->fetchAll(PDO::FETCH_ASSOC);
      //  return($res['bseq']);
    }

}

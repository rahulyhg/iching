<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* JWFIX need to find a way to make the global vars constant and default 8*/
require get_cfg_var("iching.dev.root") . "/lib/functions.php";

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */

        $this->load->library('grocery_CRUD');
        
    }

    public function index() {
        echo "<h1>The BabelBrowser annotator</h1>"; //Just an example to ensure that we get into the function
        die();
    }

    public function hexagrams() {
        $crud = new grocery_CRUD();
        $crud->set_table('hexagrams');
        $output = $crud->render();

        $this->_hexedit_output($output);
    }

    function _hexedit_output($output = null) {
        $this->load->view('hexedit_template.php', $output);
    }
    public function notes() {
        $crud = new grocery_CRUD();
        $crud->set_table('notes');
        
        $pseq = $this->uri->segments[4];
        $name = $GLOBALS['dbh']->getHexFieldByPseq("hexagrams", "trans",$pseq) ;
        $opseq = $GLOBALS['dbh']->getHexnumOppositeByPseq($pseq) ;
        $oname = $GLOBALS['dbh']->getHexFieldByPseq("hexagrams", "trans",$opseq) ;

        $this->vars = array(
             'name'=>$name
            ,'oname'=>$oname
            ,'pseq'=>sprintf("%02d",$pseq)
            ,'opseq'=>sprintf("%02d",$opseq)
        );
        
//        $this->load->view('notesedit_template', $this->vars);
        
//        var_dump($this->vars);
        
        $output = $crud->render();        
        $this->_notesedit_output($output);
        

    }

    function _notesedit_output($output = null) {
        $this->load->view('notesedit_template.php', $output);
    }

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
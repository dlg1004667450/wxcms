<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_permit();
    }

    public function main() {
        //print_r($_SESSION);
        $this->load->view('index_main');
    }

}

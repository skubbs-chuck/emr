<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends Base_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function page_not_found() {
        $this->load->view('default/errors/404');
    }


}

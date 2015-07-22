<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller {

	public function __construct() {
		parent::__construct();
	}

    public function index() {
        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');
    	
        $this->_homeAssets();
        $this->display();
    }


}

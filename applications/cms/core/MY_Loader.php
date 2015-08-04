<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
    public function __construct() {
        $this->_ci_library_paths = array(PATH_APP, PATH_APPS, PATH_SYSTEM);
        $this->_ci_helper_paths  = array(PATH_APP, PATH_APPS, PATH_SYSTEM);
        $this->_ci_view_paths = array(VIEWPATH    => TRUE, MODULES_DIR => TRUE);
        parent::__construct();
    }
}
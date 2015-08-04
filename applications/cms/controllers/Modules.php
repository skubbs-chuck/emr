<?php

class Modules extends Base_Controller {
    public function __construct() {
        parent::__construct();
        
    }

    public function index() {
        $this->display('test');
    }

    public function install($module_name) {
        if (isset($this->_modules[$module_name])) {
            if ($this->_modules[$module_name]->install()) {
                $this->session->set_flashdata('success_message', "'$module_name' has been installed.");
            } else {
                $this->session->set_flashdata('error_message', "Error installing '$module_name'. Please check your module.");
            }
        }
        redirect('modules');
    }

    public function uninstall($module_name) {
        if (isset($this->_modules[$module_name])) {
            if ($this->_modules[$module_name]->uninstall()) {
                $this->session->set_flashdata('success_message', "'$module_name' has been uninstalled.");
            } else {
                $this->session->set_flashdata('error_message', "Error uninstalling '$module_name'. Please check your module.");
            }
        }

        redirect('modules');
    }
}
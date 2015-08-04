<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_mc3 extends Base_Model {
    public $data = array('view_file' => 'form/mc3');

    public function index($d) {
        return $this->data;
    }

    public function create($d) {
        $this->data['view_file'] = 'form/mc3_create';
        return $this->data;
    }
}


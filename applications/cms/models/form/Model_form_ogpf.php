<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_ogpf extends Base_Model {
    public $data = array('view_file' => 'form/ogpf');

    public function index($d) {
        return $this->data;
    }

    public function create($d) {
        $this->data['view_file'] = 'form/ogpf_create';
        return $this->data;
    }
}


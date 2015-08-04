<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_pediac extends Base_Model {
    public $data = array('view_file' => 'form/pediac');

    public function index($d) {
        return $this->data;
    }

    public function create($d) {
        $this->data['view_file'] = 'form/pediac_create';
        return $this->data;
    }
}


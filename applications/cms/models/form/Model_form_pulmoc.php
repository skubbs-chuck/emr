<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_pulmoc extends Base_Model {
	public $data = array('view_file' => 'form/pulmoc');

	public function index($d) {
		return $this->data;
	}

	public function create($d) {
		$this->data['view_file'] = 'form/pulmoc_create';
		return $this->data;
	}
}


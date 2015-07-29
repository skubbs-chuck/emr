<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_oggc extends Base_Model {
	public $data = array('view_file' => 'form/oggc');

	public function index($d) {
		return $this->data;
	}

	public function create($d) {
		$this->data['view_file'] = 'form/oggc_create';
		return $this->data;
	}
}


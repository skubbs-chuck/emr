<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_wa extends Base_Model {
	public $data = array('view_file' => 'form/wa');

	public function index($d) {
		return $this->data;
	}

	public function create($d) {
		$this->data['view_file'] = 'form/wa_create';
		return $this->data;
	}
}


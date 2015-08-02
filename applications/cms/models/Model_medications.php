<?php

class Model_Medications extends Base_Model {
	public $data = array('view_file' => 'form_medications');
	public function index($d) {
		return $this->data;
	}
}
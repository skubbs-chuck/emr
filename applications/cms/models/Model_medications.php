<?php

class Model_Medications extends Base_Model {
	$this->data = array('view_file' => 'form_medications')
	public function index($d) {
		return $this->data;
	}
}
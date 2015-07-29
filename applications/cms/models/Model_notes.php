<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notes extends Base_Model {
	public $data = array('view_file' => 'form_notes');

	public function index($d) {
		return $this->data;
	}
}
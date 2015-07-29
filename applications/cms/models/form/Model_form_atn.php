<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_atn extends Base_Model {
	public $data = array('view_file' => 'form/atn');

	public function index($d) {
		return $this->data;
	}

	public function create($d) {
		
		$query = $this->db->get('clinics');
		$this->data['clinics'] = $query->result();
		$this->data['view_file'] = 'form/atn_create';
		return $this->data;
	}
}


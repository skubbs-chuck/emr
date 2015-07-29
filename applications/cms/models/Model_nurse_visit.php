<?php

class Model_Nurse_Visit extends Base_Model {
	public $data = array('view_file' => 'form_nurse_visit');

	public function index() {
		$this->db->select('name, table_name');
		$this->db->where('id_form_type', 7); // nurse visit
		$query = $this->db->get('forms');
		$forms = $query->result();
		$this->data['form_list'] = $forms;
		return $this->data;
	}
}
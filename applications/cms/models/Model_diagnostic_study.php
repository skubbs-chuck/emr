<?php

class Model_Diagnostic_Study extends Base_Model {
	public $data = array('view_file' => 'form_diagnostic_study');

	public function index() {
		$this->db->select('name, table_name');
		$this->db->where('id_form_type', 4); // diagnostic study
		$query = $this->db->get('forms');
		$forms = $query->result();
		$this->data['form_list'] = $forms;
		return $this->data;
	}
}
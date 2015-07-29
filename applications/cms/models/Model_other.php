<?php

class Model_Other extends Base_Model {
	public $data = array('view_file' => 'form_other');

	public function index() {
		$this->db->select('name, table_name');
		$this->db->where('id_form_type', 2); // letters
		$query = $this->db->get('forms');
		$forms = $query->result();
		$this->data['form_list'] = $forms;
		return $this->data;
	}
}
<?php

class Model_consultation extends Base_Model {
	public $data = array('view_file' => 'form_consultation');

	public function sortByCreationDate($a, $b) {
		return strtotime($b->creation_date) - strtotime($a->creation_date) ;
	}

	public function index($d) {
		$this->db->select('name, table_name');
		$this->db->where('id_form_type', 1); // consultation
		$query = $this->db->get('forms');
		$forms = $query->result();
		$this->data['form_list'] = $forms;

		$counter = 0;
		foreach ($forms as $row) {

			$name = preg_replace('/^form_/', '', $row->table_name);
			$this->db->select('id_patient,creation_date,id_' . $row->table_name);
			$this->db->where('id_patient', $d['id_patient']);
			$this->db->order_by('creation_date', 'desc');
			$query = $this->db->get($row->table_name);
			if ($query->num_rows()) {
				foreach ($query->result() as $r) {
					$counter++;
					$r->name = $name;
					$r->tbl = $row->table_name;
					$r->tbl_name = $row->name;
					$this->data['forms'][] = $r;
				}
			}
		}

		$this->data['count'] = $counter;

		usort($this->data['forms'], array($this, 'sortByCreationDate'));
		return $this->data;
	}
}
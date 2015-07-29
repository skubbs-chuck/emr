<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_medical_history extends Base_Model {
	public $data = array('view_file' => 'form_medical_history');

	public function index($d) {
		if ($this->input->post(NULL)) {
			$post_data = $this->_post('blood_type', 'immunization', 'phas_date_year', 
				'phas_detail', 'personal_social', 'family_relative', 'family_desease', 'other');
			$data = array(
				'blood_type' => html_escape($this->input->post('blood_type')), 
				'immunization' => html_escape($this->input->post('immunization')), 
				'personal_social' => html_escape($this->input->post('personal_social')), 
				'other' => html_escape($this->input->post('other')));

			$phas_count = (count($post_data['phas_date_year']) >= count($post_data['phas_detail'])) ? count($post_data['phas_date_year']) : count($post_data['phas_detail']);
			for ($i=0; $i < $phas_count; $i++) { 
				if (!empty($post_data['phas_date_year'][$i]) || !empty($post_data['phas_detail'][$i])) {
					$data['phas'][$i] = array(html_escape($post_data['phas_date_year'][$i]), html_escape($post_data['phas_detail'][$i]));
				}
				
			}

			$family_count = (count($post_data['family_relative']) >= count($post_data['family_desease'])) ? count($post_data['family_relative']) : count($post_data['family_desease']);
			for ($i=0; $i < $family_count; $i++) { 
				if (!empty($post_data['family_relative'][$i]) || !empty($post_data['family_desease'][$i])) {
					$data['family'][$i] = array(html_escape($post_data['family_relative'][$i]), html_escape($post_data['family_desease'][$i]));
				}
			}

			$data['phas'] = json_encode($data['phas']);
			$data['family'] = json_encode($data['family']);
			$data['id_user'] = $this->session->userdata('user')->id_user;
			$data = $this->security->xss_clean($data);

			$this->db->where('id_patient', $d['patient']->id_patient);
			$query = $this->db->get('medical_history');
			if ($query->num_rows() > 0) {
				$this->db->where('id_patient', $d['patient']->id_patient);
				$this->db->update('medical_history', $data);
				$this->data['var']['message'] = 'Successfully updated Medical History';
				$this->data['var']['message_type'] = 'success';
			} else {
				$data['id_patient'] = $d['patient']->id_patient;
				$this->db->where('id_patient', $d['patient']->id_patient);
				$this->db->insert('medical_history', $data);
				$this->data['var']['message'] = 'Successfully created Medical History';
				$this->data['var']['message_type'] = 'success';
			}
		}

		$this->db->where('id_patient', $d['patient']->id_patient);
		$query = $this->db->get('medical_history');
		$this->data['var']['blood_type']  = array(
			'' => '-- Select --', 
			'A+' => 'A+', 'A-' => 'A-', 
			'B+' => 'B+', 'B-' => 'B-', 
			'AB+' => 'AB+', 'AB-' => 'AB-', 
			'O+' => 'O+', 'O-' => 'O-'
		);

		if ($query->num_rows() > 0) {
			$data = $query->row();
			$data->phas = json_decode($data->phas, true);
			$data->family = json_decode($data->family, true);
			$this->data['data'] = $data;
		}

		return $this->data;
	}
}
<?php

class Model_Form extends Base_Model {

	public function medical_history($id_patient) {
		$json = array();
		
		if ($this->input->post(NULL)) {
			$post_data = $this->_post('blood_type', 'immunization', 'phas_date_year', 
				'phas_detail', 'personal_social', 'family_relative', 'family_desease', 'other');
			$data = array(
				'blood_type' => $this->input->post('blood_type'), 
				'immunization' => $this->input->post('immunization'), 
				'personal_social' => $this->input->post('personal_social'), 
				'other' => $this->input->post('other'));

			$phas_count = (count($post_data['phas_date_year']) >= count($post_data['phas_detail'])) ? count($post_data['phas_date_year']) : count($post_data['phas_detail']);
			for ($i=0; $i < $phas_count; $i++) { 
				if (!empty($post_data['phas_date_year'][$i]) || !empty($post_data['phas_detail'][$i])) {
					$data['phas'][$i] = array($post_data['phas_date_year'][$i], $post_data['phas_detail'][$i]);
				}
				
			}

			$family_count = (count($post_data['family_relative']) >= count($post_data['family_desease'])) ? count($post_data['family_relative']) : count($post_data['family_desease']);
			for ($i=0; $i < $family_count; $i++) { 
				if (!empty($post_data['family_relative'][$i]) || !empty($post_data['family_desease'][$i])) {
					$data['family'][$i] = array($post_data['family_relative'][$i], $post_data['family_desease'][$i]);
				}
			}

			$data['phas'] = json_encode($data['phas']);
			$data['family'] = json_encode($data['family']);
			$data['id_user'] = $this->session->userdata('user')->id_user;

			$this->db->where('id_patient', $id_patient);
			$query = $this->db->get('medical_history');
			if ($query->num_rows() > 0) {
				$this->db->where('id_patient', $id_patient);
				$this->db->update('medical_history', $data);
				$json['var']['message'] = 'Successfully updated Medical History';
				$json['var']['message_type'] = 'success';
			} else {
				$data['id_patient'] = $id_patient;
				$this->db->where('id_patient', $id_patient);
				$this->db->insert('medical_history', $data);
				$json['var']['message'] = 'Successfully created Medical History';
				$json['var']['message_type'] = 'success';
			}
		}

		$this->db->where('id_patient', $id_patient);
		$query = $this->db->get('medical_history');
		$json['var']['blood_type']  = array(
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
			$json['data'] = $data;
		}



		return $json;
	}

	public function cbc($id_patient) {
		$this->display();
	}

	public function cbcf($id_patient) {
		$this->display();
	}

	public function cmof($id_patient) {
		$this->display();
	}

	public function cx($id_patient) {
		$this->display();
	}

	public function gsf1($id_patient) {
		$this->display();
	}

	public function mc1($id_patient) {
		$this->display();
	}

	public function mc2($id_patient) {
		$this->display();
	}

	public function mc3($id_patient) {
		$this->display();
	}

	public function oftu($id_patient) {
		$this->display();
	}

	public function ph($id_patient) {
		$this->display();
	}

	public function tyl($id_patient) {
		$this->display();
	}

	public function wa($id_patient) {
		$this->display();
	}

	public function dc($id_patient) {
		$this->display();
	}

	public function df($id_patient) {
		$this->display();
	}

	public function ec1($id_patient) {
		$this->display();
	}

	public function ec2($id_patient) {
		$this->display();
	}

	public function gsf2($id_patient) {
		$this->display();
	}

	public function gsn($id_patient) {
		$this->display();
	}

	public function gswnt($id_patient) {
		$this->display();
	}

	public function lu($id_patient) {
		$this->display();
	}

	public function oggc($id_patient) {
		$this->display();
	}

	public function ogpc($id_patient) {
		$this->display();
	}

	public function ogpf($id_patient) {
		$this->display();
	}

	public function oc1($id_patient) {
		$this->display();
	}

	public function oc2($id_patient) {
		$this->display();
	}

	public function oc3($id_patient) {
		$this->display();
	}

	public function pediac($id_patient) {
		$this->display();
	}

	public function pulmoc($id_patient) {
		$this->display();
	}

	public function sc($id_patient) {
		$this->display();
	}

	public function atn($id_patient) {
		$this->display();
	}

	public function gnv($id_patient) {
		$this->display();
	}

	public function pwnn($id_patient) {
		$this->display();
	}


}

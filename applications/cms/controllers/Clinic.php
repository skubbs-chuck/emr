<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clinic extends Base_Controller { 

	public function __construct() {
		parent::__construct();
		$this->_homeAssets();
		$this->load->model('model_clinic');
		$this->data['title'] = 'Clinic';
		$this->data['current_page'] = 'clinic/management';
		if (!$this->model_session->is_logged_in()) 
            redirect('user/login');
	}

	public function management() {
		$pagination = $this->_pagination(array('total_rows' => $this->model_clinic->clinicsCount()));
        $this->pagination->initialize($pagination);
        $this->data['clinic_list'] = $this->model_clinic->fetchClinics($pagination['per_page'], $pagination['page']);
        $this->data["clinic_list_links"] = $this->pagination->create_links();
		$this->display();
	}

	public function add() {
		
		$this->data['hours'] = $this->model_clinic->hours();
		$this->data['countries'] = $this->model_clinic->countries();

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Clinic Name', 'trim|required|min_length[5]|max_length[255]|is_unique[clinics.name]|xss_clean');
		$this->form_validation->set_rules('hour_start', 'Hour Start', 'trim|required');
		$this->form_validation->set_rules('hour_end', 'Hour End', 'trim|required|callback_check_hour', array('check_hour' => 'Hour Start must be less than Hour End'));
		if ($this->form_validation->run()) {
			$post_data = $this->_post(array('name', 'hour_start', 'hour_end', 'street', 'city', 'province', 'country', 'zip_code', 'contact_number', 'website'));
			$post_data['name'] = ucwords($post_data['name']);
			$post_data['hour_start'] = $this->model_clinic->getHourByKey($post_data['hour_start']);
			$post_data['hour_end'] = $this->model_clinic->getHourByKey($post_data['hour_end']);
			$post_data['country'] = $this->model_clinic->getCountryByKey($post_data['country']);
			$id_clinic = $this->model_clinic->addClinic($post_data);
			if ($id_clinic) {
				$this->setFlashAlert('Clinic \'' . $post_data['name'] . '\' has been sucessfully added.', 'success');
				redirect('clinic/management');
			} else {
				$this->data['insert_error'] = 'Error inserting user. please contact your site administrator';
			}
		}

		$this->display();
	}

	public function check_hour() {
		$start = $this->input->post('hour_start');
		$end = $this->input->post('hour_end');
		if ($start >= $end) 
			return false;
		return true;
	}

	public function edit() {
		$id_clinic = $this->uri->segment(3) ? (int) $this->uri->segment(3) : 0;
		if (!$id_clinic) 
			redirect('clinic/management');

		$clinic = $this->model_clinic->getClinicById($id_clinic);
		if (!$clinic)
			redirect('clinic/management');

		$clinic->hour_start = $this->model_clinic->getKeyByHour($clinic->hour_start);
		$clinic->hour_end = $this->model_clinic->getKeyByHour($clinic->hour_end);
		$clinic->country = $this->model_clinic->getKeyByCountry($clinic->country);
		$this->data['clinic'] = $clinic;
		$this->data['hours'] = $this->model_clinic->hours();
		$this->data['countries'] = $this->model_clinic->countries();

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Clinic Name', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('hour_start', 'Hour Start', 'trim|required');
		$this->form_validation->set_rules('hour_end', 'Hour End', 'trim|required|callback_check_hour', array('check_hour' => 'Hour Start must be less than Hour End'));
		if ($this->form_validation->run()) {
			$post_data = $this->_post(array('name', 'hour_start', 'hour_end', 'street', 'city', 'province', 'country', 'zip_code', 'contact_number', 'website'));
			$post_data['name'] = ucwords($post_data['name']);
			$post_data['hour_start'] = $this->model_clinic->getHourByKey($post_data['hour_start']);
			$post_data['hour_end'] = $this->model_clinic->getHourByKey($post_data['hour_end']);
			$post_data['country'] = $this->model_clinic->getCountryByKey($post_data['country']);

			$id_clinic = $this->model_clinic->updateClinicById($id_clinic, $post_data);
			if ($id_clinic) {
				$this->setFlashAlert('Clinic \'' . $post_data['name'] . '\' has been sucessfully updated.', 'success');
				redirect('clinic/management');
			} else {
				$this->data['insert_error'] = 'Error updating clinic informations. please contact your site administrator';
			}
		}

		$this->display();
	}
}

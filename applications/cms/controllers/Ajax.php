<?php

class Ajax extends Base_Controller {
	// protected $_r = array('data' => array(), 'html' => '');

	public function patient($form = false, $id_patient = 0, $id_form = 0) {
		if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

		$id_patient = (int) $id_patient;
		$id_form = (int) $id_form;
		$data = $this->config->item('data');
		$form_file = VIEWPATH . $data['theme'] . DS . 'form' . DS . $form . '.php';
		$query = $this->db->get_where('patients', array('id_patient' => $id_patient));
		$this->data['patient'] = ($query->num_rows()) ? $query->row() : redirect('patient/management');

		$this->load->model('model_form');
		
		ob_start();
		if (method_exists($this->model_form, $form)) 
			$this->data[$form] = $this->model_form->$form($id_patient, $id_form);

		$this->data[$form]['create_new_form'] = (isset($_GET['create'])) ? true : false;

		$form_path = VIEWPATH . $data['theme'] . DS . 'form_' . $form . '.php';
		if (file_exists($form_path)) 
			$this->display('form_' . $form . '.php');
		else 
			$this->display('form/' . $form);

		$this->data['html'] = ob_get_contents();
		ob_clean();

		$this->output->set_header("Content-type: application/json");
		echo json_encode($this->data, JSON_PRETTY_PRINT);
	}
}
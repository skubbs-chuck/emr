<?php

class Ajax extends Base_Controller {

	public function patient() {
		$error = 0;
		$args = func_get_args();
		$form = isset($args[0]) ? $args[0] : 'noform';
		$id_patient = isset($args[1]) ? (int) $args[1] : 0;
		$id_form = isset($args[2]) ? (int) $args[2] : 0;
		$action = isset($args[3]) ? $args[3] : 'index';
		if (!$this->model_session->is_logged_in()) 
			redirect('user/login');

		
		$this->data['id_patient'] = $id_patient;
		$this->data['id_form'] = $id_form;
		$this->data['data'] = array();
		
		$query = $this->db->get_where('patients', array('id_patient' => (int) $id_patient));
		$this->data['patient'] = ($query->num_rows()) ? $query->row() : redirect('patient/management');


		$model_form = 'model_' . $form;
		if (file_exists(PATH_MODELS . ucfirst($model_form) . '.php')) {
			$this->load->model($model_form, 'f'); // $this->f
		} elseif (file_exists(PATH_MODELS . 'form' . DS . ucfirst($model_form) . '.php')) {
			$this->load->model('form/' . $model_form, 'f'); // $this->f
		} else {
			$this->data['html'] = '<div class="alert alert-error"> Form \'' . $form . '\' does not exist.</div>';
			$error++;
		}

		if (!$error) {
			ob_start();
			if (method_exists($this->f, $action)) {
				$form = preg_replace('/^form_/', '', $form);
				$this->data[$form] = $this->f->$action($this->data);
				$this->data[$form]['id_patient'] = $id_patient;
				$this->data[$form]['id_form'] = $id_form;
				$this->display($this->data[$form]['view_file']);
				$this->data['html'] = ob_get_contents();
			} else 
				$this->data['html'] = '<div class="alert alert-error"> Unknown \'' . $action . '\' request for form \'' . $form . '\'.</div>';

			ob_clean();
		}

		$this->printJson();
	}

	public function printJson() {
		$this->output->set_header("Content-type: application/json");
		echo json_encode($this->data, JSON_PRETTY_PRINT);
	}
}
<?php

class Ajax extends Base_Controller {
	protected $_r = array('data' => array(), 'html' => '');

	public function patient($form = false, $id_patient = 0) {
		if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

		$id_patient = (int) $id_patient;
		$data = $this->config->item('data');
		$form_file = VIEWPATH . $data['theme'] . DS . 'form' . DS . $form . '.php';
		$query = $this->db->get_where('patients', array('id_patient' => $id_patient));
		$this->data['patient'] = ($query->num_rows()) ? $query->row() : false;

		$this->load->model('model_form');

		ob_start();
		if (method_exists($this->model_form, $form)) 
			$this->data[$form] = $this->model_form->$form($id_patient);

		$this->display('form/' . $form);
		$this->_r['html'] = ob_get_contents();
		ob_clean();
		echo json_encode($this->_r);
	}
}
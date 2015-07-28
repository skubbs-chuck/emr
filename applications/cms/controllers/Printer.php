<?php

class Printer extends Base_Controller {
	public function form() {
		$form_name = preg_replace('/.pdf$/', '', $this->uri->segment(3));
		$id = (int) $this->input->get('id');
		// echo $form_name . '_' . $id;
		$form_path = VIEWPATH . $data['theme'] . DS . 'form_' . $form_name . '.php';
		$this->display('print/gsf1');
	}
}
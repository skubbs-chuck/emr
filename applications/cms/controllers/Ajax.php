<?php

class Ajax extends Base_Controller {

    public function patient() {
        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');
        
        $this->data['view'] = '';
        $this->data['html'] = '';
        $this->data['ar'] = ($this->input->get('ajax_request')) ? json_decode(base64_decode(str_replace(' ', '+', $this->input->get('ajax_request'))), TRUE) : redirect('patient/management');
        $this->data['ar']['method']     = ($this->data['ar']['action'] == 'post') ? $this->data['ar']['action'] : 'get';
        $this->data['ar']['id_patient'] = (int) $this->data['ar']['id_patient'];
        $this->data['ar']['id_form']    = (int) $this->data['ar']['id_form'];

        $query = $this->db->get_where('patients', array('id_patient' => $this->data['ar']['id_patient']));
        $this->data['patient'] = ($query->num_rows()) ? $query->row() : redirect('patient/management');
        $this->data['current_id_clinic'] = (int) $this->session->userdata('current_id_clinic');
        foreach ($this->session->userdata('current_clinics') as $clinic) {
            $this->data['current_clinics'][$clinic->id_clinic] = $clinic->name;
            $this->data['current_id_clinic'] = ($this->data['current_id_clinic'] > 0) ? $this->data['current_id_clinic'] : (int) $clinic->id_clinic;
        }

        $this->data['ar']['request_type'] = (strrpos($this->data['ar']['request'], 'form_', -strlen($this->data['ar']['request'])) !== FALSE) ? 'form' : 'tab';
        

        $this->load->model('model_form', 'mform');
        $this->data = array_merge($this->data, $this->mform->init($this->data));
        $view_file = PATH_VIEWS . $this->config->item('data')['theme'] . DS . $this->data['view'] . '.php';
        $this->data['view'] = (file_exists($view_file)) ? $this->data['view'] : 'form/not_found';

        
        ob_start();
        $this->display($this->data['view']);
        $this->data['html'] = ob_get_contents();
        ob_clean();
        $this->printJson();
    }

    public function printJson() {
        $this->output->set_header("Content-type: application/json");
        echo json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function switch_clinic($id_clinic) {
        $exists = 0;
        $id_clinic = (int) $id_clinic;
        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

        $clinics = json_decode($this->session->userdata('user')->clinics);
        foreach ($clinics as $key => $user_id_clinic) {
            // $clinics[$key] = (int) $user_id_clinic;
            
            if ($id_clinic == $user_id_clinic)
                $exists++;
        }

        $this->session->set_userdata('current_id_clinic', ($exists) ? $id_clinic : $clinics[0]);
    }

    public function clinics() {
        
    }
}
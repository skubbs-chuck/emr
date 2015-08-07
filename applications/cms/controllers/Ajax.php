<?php

class Ajax extends Base_Controller {

    public function patient() {
        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

        $error = 0;
        $args  = func_get_args();
        
        $form       = isset($args[0]) ? $args[0] : 'noform';
        $action     = isset($args[1]) ? $args[1] : 'index';
        $method     = (isset($args[2]) && $args[2] == 'post') ? $args[2] : 'get';
        $id_patient = isset($args[3]) ? (int) $args[3] : 0;
        $id_form    = isset($args[4]) ? (int) $args[4] : 0;

        
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
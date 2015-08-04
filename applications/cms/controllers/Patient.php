<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->_homeAssets();
        $this->load->model('model_patient');
        $this->data['title'] = 'Patient';
        $this->data['current_page'] = 'patient/management';
        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

        $this->addCss($this->tplUrl . 'plugins/datepicker/datepicker3.css')
             ->addJs($this->tplUrl . 'plugins/datepicker/bootstrap-datepicker.js')
             ->addCss($this->tplUrl . 'plugins/timepicker/bootstrap-timepicker.min.css')
             ->addJs($this->tplUrl . 'plugins/timepicker/bootstrap-timepicker.min.js')
             ->addCss($this->tplUrl . 'css/patient.css')
             ->addJs($this->tplUrl . 'js/skubbs.js');
    }

    public function management() {
        $pagination = $this->_pagination(array('total_rows' => $this->model_patient->patientsCount()));
        $this->pagination->initialize($pagination);
        $this->data['patient_list'] = $this->model_patient->fetchPatients($pagination['per_page'], $pagination['page']);
        $this->data['patient_list_links'] = $this->pagination->create_links();
        $this->display();
    }

    public function profile($id_patient = NULL) {
        $id_patient = (int) $id_patient;
        $this->data['patient'] = array();

        $this->load->model('model_user');
        $this->data['patient'] = $this->model_patient->getPatientById($id_patient);
        if (!$this->data['patient']) {
            $this->setFlashAlert('Patient does not exist', 'error');
            redirect('patient/management');
        }

        $this->data['patient']->birth_date = $this->formatDate($this->data['patient']->birth_date);
        $this->data['member_since'] = $this->formatDate($this->data['patient']->creation_date);
        $this->display();
    }

    public function add() {
        

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim|required|min_length[3]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('birth_date', 'Birth Date', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('account_type', 'Account Type', 'required');
        if ($this->form_validation->run()) {
            $post_data = $this->input->post(NULL, TRUE);
            // $post_data = $_POST;
            $post_data['first_name'] = html_escape(ucwords($post_data['first_name']));
            $post_data['middle_name'] = html_escape(ucwords($post_data['middle_name']));
            $post_data['last_name'] = html_escape(ucwords($post_data['last_name']));
            $contacts = array();
            $identifications = array();
            if (isset($post_data['contacts_type']) && isset($post_data['contacts_number'])) {
                $contacts = array();
                $post_data['contacts_type'] = array_values($post_data['contacts_type']);
                $post_data['contacts_number'] = array_values($post_data['contacts_number']);
                for ($i=0; $i < count($post_data['contacts_type']); $i++) 
                    $contacts[] = array(html_escape($post_data['contacts_type'][$i]), html_escape($post_data['contacts_number'][$i]));
                unset($post_data['contacts_type'], $post_data['contacts_number']);
            }

            if (isset($post_data['identifications_type']) && isset($post_data['identifications_number'])) {
                $identifications = array();
                $post_data['identifications_type'] = array_values($post_data['identifications_type']);
                $post_data['identifications_number'] = array_values($post_data['identifications_number']);
                for ($i=0; $i < count($post_data['identifications_type']); $i++) 
                    $identifications[] = array(html_escape($post_data['identifications_type'][$i]), html_escape($post_data['identifications_number'][$i]));
                unset($post_data['identifications_type'], $post_data['identifications_number']);
            }

            $post_data['contacts'] = json_encode($contacts);
            $post_data['identifications'] = json_encode($identifications);
            // $post_data['birth_date'] = $this->mysqlDate($post_data['birth_date']);
            $post_data['creation_date'] = $this->mysqlDateTimeNow();
            $id_patient = $this->model_patient->addPatient($post_data);
            if ($id_patient) {
                $this->setFlashAlert('Patient \'' . $post_data['first_name'] . ' ' . $post_data['last_name'] . '\' has been sucessfully added.', 'success');
                redirect('patient/management');
            } else {
                $this->data['insert_error'] = 'Error inserting user. please contact your site administrator';
            }
        }

        $this->display();
    }
}

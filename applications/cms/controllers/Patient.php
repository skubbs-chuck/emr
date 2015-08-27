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
             ->addCss($this->tplUrl . 'plugins/timepicker/bootstrap-timepicker.min.css')
             ->addCss($this->tplUrl . 'css/patient.css')
             ->addCss($this->tplUrl . 'plugins/wpaint/css/wColorPicker.min.css')
             ->addCss($this->tplUrl . 'plugins/wpaint/css/wPaint.css')

             ->addJs($this->tplUrl . 'plugins/wpaint/js/jquery.ui.core.1.10.3.min.js')
             ->addJs($this->tplUrl . 'plugins/wpaint/js/jquery.ui.widget.1.10.3.min.js')
             ->addJs($this->tplUrl . 'plugins/wpaint/js/jquery.ui.mouse.1.10.3.min.js')
             ->addJs($this->tplUrl . 'plugins/wpaint/js/jquery.ui.draggable.1.10.3.min.js')
             ->addJs($this->tplUrl . 'plugins/datepicker/bootstrap-datepicker.js')
             ->addJs($this->tplUrl . 'plugins/timepicker/bootstrap-timepicker.js')
             ->addJs($this->tplUrl . 'plugins/wpaint/js/wColorPicker.min.js')
             ->addJs($this->tplUrl . 'plugins/wpaint/js/wPaint.conf.js')
             ->addJs($this->tplUrl . 'js/skubbs.js')
             ;
    }

    public function management() {
        $this->db->select('id_clinic,name');
        $this->db->order_by('id_clinic', 'asc');
        $query = $this->db->get('clinics');
        $this->data['db_clinics'] = $query->result();
        // $query = $this->db->query("SELECT common_schema.extract_json_value(@json, '//clinics') AS test FROM users");
        // $this->data['test'] = $query->result();
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

    public function edit($id_patient = 0) {
        if (!$id_patient || (int) $id_patient <= 0) 
            redirect('patient/management');

        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

        // echo $id_patient; exit();

        $this->data['post'] = $this->input->post(NULL);
        

        if ($this->data['post']) {
            $identifications = array();
            if (isset($this->data['post']['contacts_type']) && isset($this->data['post']['contacts_number'])) {
                $contacts = array();
                $this->data['post']['contacts_type'] = array_values($this->data['post']['contacts_type']);
                $this->data['post']['contacts_number'] = array_values($this->data['post']['contacts_number']);
                for ($i=0; $i < count($this->data['post']['contacts_type']); $i++) 
                    $contacts[] = array(html_escape($this->data['post']['contacts_type'][$i]), html_escape($this->data['post']['contacts_number'][$i]));
                unset($this->data['post']['contacts_type'], $this->data['post']['contacts_number']);
            }

            if (isset($this->data['post']['identifications_type']) && isset($this->data['post']['identifications_number'])) {
                $identifications = array();
                $this->data['post']['identifications_type'] = array_values($this->data['post']['identifications_type']);
                $this->data['post']['identifications_number'] = array_values($this->data['post']['identifications_number']);
                for ($i=0; $i < count($this->data['post']['identifications_type']); $i++) 
                    $identifications[] = array(html_escape($this->data['post']['identifications_type'][$i]), html_escape($this->data['post']['identifications_number'][$i]));
                unset($this->data['post']['identifications_type'], $this->data['post']['identifications_number']);
            }

            $data = array(
                'first_name' => $this->data['post']['first_name'], 
                'middle_name' => $this->data['post']['middle_name'], 
                'last_name' => $this->data['post']['last_name'], 
                'alias' => $this->data['post']['alias'], 
                'birth_date' => $this->data['post']['birth_date'], 
                'birth_place' => $this->data['post']['birth_place'], 
                'gender' => $this->data['post']['gender'], 
                'civil_status' => $this->data['post']['civil_status'], 
                'nationality' => $this->data['post']['nationality'], 
                'occupation' => $this->data['post']['occupation'], 
                'religion' => $this->data['post']['religion'], 
                'address' => $this->data['post']['address'], 
                'city' => $this->data['post']['city'], 
                'zip_code' => $this->data['post']['zip_code'], 
                'province' => $this->data['post']['province'], 
                'country' => $this->data['post']['country'], 
                'address2' => $this->data['post']['address2'], 
                'city2' => $this->data['post']['city2'], 
                'zip_code2' => $this->data['post']['zip_code2'], 
                'province2' => $this->data['post']['province2'], 
                'country2' => $this->data['post']['country2'], 
                'email' => $this->data['post']['email'], 
                'account_type' => $this->data['post']['account_type'], 
                'reffered_by' => $this->data['post']['reffered_by'], 
                'client_source' => $this->data['post']['client_source'], 
                'father_name' => $this->data['post']['father_name'], 
                'mother_name' => $this->data['post']['mother_name'], 
                'contacts' => json_encode($contacts), 
                'identifications' => json_encode($identifications), 
            );

            $this->db->update('patients', $data, array('id_patient' => $id_patient));
        }

        $query = $this->db->get_where('patients', array('id_patient' => $id_patient));
        if (!$query->num_rows()) 
            redirect('patient/management');

        $this->data['patient'] = $query->row();
        $this->data['patient']->contacts = json_decode($this->data['patient']->contacts, true);
        $this->data['patient']->identifications = json_decode($this->data['patient']->identifications, true);

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

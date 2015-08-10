<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_cbc extends Base_Model {
    public $data;

    public function __construct() {
        parent::__construct();
        $this->data = array('view_file' => 'form/cbc');
        $this->data['alert'] = array('type' => 0, 'message' => '');
        $this->data['form_name'] = 'form_cbc';
        $this->data['post'] = $this->input->post(NULL, TRUE);
    }

    public function init($d) {
        if ($this->data['post']) {
            $this->data['post']['id_clinic'] = 
                array_key_exists((int) $this->data['post']['id_clinic'], $d['current_clinics']) 
                ? (int) $this->data['post']['id_clinic'] : $d['current_id_clinic'];

            $sql = array(
                'id_patient'     => $d['id_patient'], 
                'id_clinic'      => $this->data['post']['id_clinic'], 
                'id_user'        => $this->session->userdata('user')->id_user, 
                'visit_date'     => $this->data['post']['visit_date'], 
                'start_time'     => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])), 
                'hemoglobin'     => html_escape($this->data['post']['hemoglobin']), 
                'hematocrit'     => html_escape($this->data['post']['hematocrit']), 
                'rbc'            => html_escape($this->data['post']['rbc']), 
                'wbc'            => html_escape($this->data['post']['wbc']), 
                'platelet'       => html_escape($this->data['post']['platelet']), 
                'mcv'            => html_escape($this->data['post']['mcv']), 
                'mch'            => html_escape($this->data['post']['mch']), 
                'mchc'           => html_escape($this->data['post']['mchc']), 
                'rdw'            => html_escape($this->data['post']['rdw']), 
                'eosinophils'    => html_escape($this->data['post']['eosinophils']), 
                'basophils'      => html_escape($this->data['post']['basophils']), 
                'neutrophils'    => html_escape($this->data['post']['neutrophils']), 
                'lymphocytes'    => html_escape($this->data['post']['lymphocytes']), 
                'monocytes'      => html_escape($this->data['post']['monocytes']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($d['m'] == 'index') {
                $this->db->where('id_form_cbc', $d['id_form']);
                $this->db->update('form_cbc', $sql);
            } else if ($d['m'] == 'create') {
                $this->db->insert('form_cbc', $sql);
                $this->data['created'] = true;
                $this->data['alert'] = array('type' => 'success', 'message' => 'successfully created CBC');
            }
        }

        if ($d['m'] == 'index') {
            $this->db->select('form_cbc.*, clinics.name as clinic_name');
            $this->db->where('id_patient', $d['id_patient']);
            $this->db->where('id_form_cbc', $d['id_form']);
            $this->db->join('clinics', "clinics.id_clinic = form_cbc.id_clinic");
            $query = $this->db->get('form_cbc');
            $this->data['data'] = $query->row();
        }

        $this->data['form'] = array(
            'id_clinic'   => $this->form_dropdown('id_clinic', $d['current_clinics'], $d['current_id_clinic'], 'class="form-control"'),
            'visit_date'  => $this->form_input('visit_date', date($this->format['date']), array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'")), 
            'start_time'  => $this->form_input('start_time', date($this->format['time']), array('class' => 'form-control skubbs_timepicker')), 
            'hemoglobin'  => $this->form_input('hemoglobin', $this->data['data']->hemoglobin, array('class' => 'form-control')), 
            'hematocrit'  => $this->form_input('hematocrit', $this->data['data']->hematocrit, array('class' => 'form-control')), 
            'rbc'         => $this->form_input('rbc', $this->data['data']->rbc, array('class' => 'form-control')), 
            'wbc'         => $this->form_input('wbc', $this->data['data']->wbc, array('class' => 'form-control')), 
            'platelet'    => $this->form_input('platelet', $this->data['data']->platelet, array('class' => 'form-control')), 
            'mcv'         => $this->form_input('mcv', $this->data['data']->mcv, array('class' => 'form-control')), 
            'mch'         => $this->form_input('mch', $this->data['data']->mch, array('class' => 'form-control')), 
            'mchc'        => $this->form_input('mchc', $this->data['data']->mchc, array('class' => 'form-control')), 
            'rdw'         => $this->form_input('rdw', $this->data['data']->rdw, array('class' => 'form-control')), 
            'eosinophils' => $this->form_input('eosinophils', $this->data['data']->eosinophils, array('class' => 'form-control')), 
            'basophils'   => $this->form_input('basophils', $this->data['data']->basophils, array('class' => 'form-control')), 
            'neutrophils' => $this->form_input('neutrophils', $this->data['data']->neutrophils, array('class' => 'form-control')), 
            'lymphocytes' => $this->form_input('lymphocytes', $this->data['data']->lymphocytes, array('class' => 'form-control')), 
            'monocytes'   => $this->form_input('monocytes', $this->data['data']->monocytes, array('class' => 'form-control')), 
        );

    }

    public function index($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);
        return $this->data;
    }

    public function create($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);

        $this->data['view_file'] = 'form/cbc_create';
        return $this->data;
    }
}


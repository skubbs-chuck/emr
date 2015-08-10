<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_atn extends Base_Model {
    public $data;

    public function __construct() {
        parent::__construct();
        $this->data = array('view_file' => 'form/atn');
        $this->data['alert'] = array('type' => 0, 'message' => '');
        $this->data['form_name'] = 'form_atn';
        $this->data['post'] = $this->input->post(NULL, TRUE);
    }

    public function init($d) {
        if ($this->data['post']) {
            $this->data['post']['id_clinic'] = 
                array_key_exists((int) $this->data['post']['id_clinic'], $d['current_clinics']) 
                ? (int) $this->data['post']['id_clinic'] : $d['current_id_clinic'];

            $sql = array(
                'id_patient'    => $d['id_patient'], 
                'id_clinic'     => $this->data['post']['id_clinic'], 
                'visit_date'    => $this->data['post']['visit_date'], 
                'start_time'    => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])), 
                'order_note'    => html_escape($this->data['post']['order_note']), 
                'creation_date' => date($this->format['sql_datetime']));

            if ($d['m'] == 'index') {
                $this->db->where('id_form_atn', $d['id_form']);
                $this->db->update('form_atn', $sql);
            } else if ($d['m'] == 'create') {
                $this->db->insert('form_atn', $sql);
                $this->data['created'] = true;
                $this->data['alert'] = array('type' => 'success', 'message' => 'successfully created [Aesthetics] Therapist\'s Notes');
            }
        }

        if ($d['m'] == 'index') {
            $this->db->select('form_atn.*, clinics.name as clinic_name');
            $this->db->where('id_patient', $d['id_patient']);
            $this->db->where('id_form_atn', $d['id_form']);
            $this->db->join('clinics', "clinics.id_clinic = form_atn.id_clinic");
            $query = $this->db->get('form_atn');
            $this->data['data'] = $query->row();
        }

        $this->data['form'] = array(
            'id_clinic'  => $this->form_dropdown('id_clinic', $d['current_clinics'], $d['current_id_clinic'], 'class="form-control"'),
            'visit_date' => $this->form_input('visit_date', date($this->format['date']), array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'")), 
            'start_time' => $this->form_input('start_time', date($this->format['time']), array('class' => 'form-control skubbs_timepicker')), 
            'order_note' => $this->form_textarea('order_note', html_escape($this->data['data']->order_note), array('class' => 'form-control')));

    }

    public function index($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);
        return $this->data;
    }

    public function create($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);

        $this->data['view_file'] = 'form/atn_create';
        return $this->data;
    }
}


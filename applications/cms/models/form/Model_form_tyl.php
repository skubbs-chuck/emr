<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_tyl extends Base_Model {
    public $data;

    public function __construct() {
        parent::__construct();
        $this->data = array('view_file' => 'form/tyl');
        $this->data['alert'] = array('type' => 0, 'message' => '');
        $this->data['form_name'] = 'form_tyl';
        $this->data['post'] = $this->input->post(NULL, TRUE);
    }

    public function init($d) {
        if ($this->data['post']) {
            $this->data['post']['id_clinic'] = 
                array_key_exists((int) $this->data['post']['id_clinic'], $d['current_clinics']) 
                ? (int) $this->data['post']['id_clinic'] : $d['current_id_clinic'];

            $sql = array(
                'id_patient'     => $d['id_patient'], 
                // 'id_clinic'      => $this->data['post']['id_clinic'], 
                'id_user'        => $this->session->userdata('user')->id_user, 
                'visit_date'     => $this->data['post']['visit_date'], 
                'start_time'     => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])), 
                'to'             => html_escape($this->data['post']['to']), 
                'specialty'      => html_escape($this->data['post']['specialty']), 
                'clinic_name'    => html_escape($this->data['post']['clinic_name']), 
                'clinic_address' => html_escape($this->data['post']['clinic_address']), 
                'clinic_contact' => html_escape($this->data['post']['clinic_contact']), 
                'diagnosis'      => html_escape($this->data['post']['diagnosis']), 
                'recommendation' => html_escape($this->data['post']['recommendation']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($d['m'] == 'index') {
                $this->db->where('id_form_tyl', $d['id_form']);
                $this->db->update('form_tyl', $sql);
            } else if ($d['m'] == 'create') {
                $this->db->insert('form_tyl', $sql);
                $this->data['created'] = true;
                $this->data['alert'] = array('type' => 'success', 'message' => 'successfully created Thank You Letter');
            }
        }

        if ($d['m'] == 'index') {
            $this->db->select('form_tyl.*');
            $this->db->where('id_patient', $d['id_patient']);
            $this->db->where('id_form_tyl', $d['id_form']);
            $query = $this->db->get('form_tyl');
            $this->data['data'] = $query->row();
        }

        $this->data['form'] = array(
            'id_clinic'      => $this->form_dropdown('id_clinic', $d['current_clinics'], $d['current_id_clinic'], 'class="form-control"'),
            'visit_date'     => $this->form_input('visit_date', date($this->format['date']), array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'")), 
            'start_time'     => $this->form_input('start_time', date($this->format['time']), array('class' => 'form-control skubbs_timepicker')), 
            'to'             => $this->form_input('to', $this->data['data']->to, array('class' => 'form-control')), 
            'specialty'      => $this->form_input('specialty', $this->data['data']->specialty, array('class' => 'form-control')), 
            'clinic_name'    => $this->form_input('clinic_name', $this->data['data']->clinic_name, array('class' => 'form-control')), 
            'clinic_address' => $this->form_textarea('clinic_address', html_escape($this->data['data']->clinic_address), array('class' => 'form-control')),
            'clinic_contact' => $this->form_input('clinic_contact', $this->data['data']->clinic_contact, array('class' => 'form-control')),  
            'diagnosis'      => $this->form_textarea('diagnosis', html_escape($this->data['data']->diagnosis), array('class' => 'form-control')), 
            'recommendation' => $this->form_textarea('recommendation', html_escape($this->data['data']->recommendation), array('class' => 'form-control')));

    }

    public function index($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);
        return $this->data;
    }

    public function create($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);

        $this->data['view_file'] = 'form/tyl_create';
        return $this->data;
    }
}


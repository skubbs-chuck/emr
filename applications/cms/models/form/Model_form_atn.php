<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_atn extends Base_Model {
    public $data;
    // id_patient
    // id_clinic
    // id_user
    // visit_date
    // start_time
    // order_note
    // creation_date

    public function __construct() {
        parent::__construct();
        $this->data = array('view_file' => 'form/atn');
        $this->data['alert'] = array('type' => 0, 'message' => '');
    }

    public function index($d) {
        return $this->data;
    }

    public function create($d) {
        $post = $this->data['post'] = $this->input->post(NULL, TRUE);
        $attr = array(
            'visit_date' => array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"),
            'start_time' => array('class' => 'form-control skubbs_timepicker'), 
            'order_note' => array('class' => 'form-control'));

        $this->data['form'] = array(
            'id_clinic'  => $this->form_dropdown('id_clinic', $d['current_clinics'], $d['current_id_clinic'], 'class="form-control"'),
            'visit_date' => $this->form_input('visit_date', date($this->format['date']), $attr['visit_date']), 
            'start_time' => $this->form_input('start_time', date($this->format['time']), $attr['start_time']), 
            'order_note' => $this->form_textarea('order_note', '', $attr['order_note']));

        if ($post) {
            $post['id_clinic'] = 
                array_key_exists((int) $post['id_clinic'], $d['current_clinics']) 
                ? (int) $post['id_clinic'] : $d['current_id_clinic'];

            $sql = array(
                'id_patient'    => $d['id_patient'], 
                'id_clinic'     => $post['id_clinic'], 
                'visit_date'    => $post['visit_date'], 
                'start_time'    => date($this->format['sql_time'], strtotime($post['start_time'])), 
                'order_note'    => html_escape($post['order_note']), 
                'creation_date' => date($this->format['sql_datetime']));
            
            $this->data['sql'] = $sql;
        }

        $this->data['view_file'] = 'form/atn_create';
        return $this->data;
    }
}


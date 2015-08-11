<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_gsf1 extends Base_Model {
    public $data;

    public function __construct() {
        parent::__construct();
        $this->data = array('view_file' => 'form/gsf1');
        $this->data['alert'] = array('type' => 0, 'message' => '');
        $this->data['form_name'] = 'form_gsf1';
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
                'soap_img'       => html_escape($this->data['post']['soap_img']), 
                'subjective'     => html_escape($this->data['post']['subjective']), 
                'plan'           => html_escape($this->data['post']['plan']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($d['m'] == 'index') {
                $this->db->where('id_form_gsf1', $d['id_form']);
                $this->db->update('form_gsf1', $sql);
            } else if ($d['m'] == 'create') {
                $this->db->insert('form_gsf1', $sql);
                $this->data['created'] = true;
                $this->data['alert'] = array('type' => 'success', 'message' => 'successfully created Gen SOAP Follow Up');
            }
        }

        if ($d['m'] == 'index') {
            $this->db->select('form_gsf1.*');
            $this->db->where('id_patient', $d['id_patient']);
            $this->db->where('id_form_gsf1', $d['id_form']);
            $query = $this->db->get('form_gsf1');
            $this->data['data'] = $query->row();
        }

        $this->data['form'] = array(
            'soap_img'   => $this->form_input('soap_img', $this->data['data']->soap_img, array('class' => 'form-control')), 
            'subjective' => $this->form_textarea('subjective', html_escape($this->data['data']->subjective), array('class' => 'form-control')), 
            'plan'       => $this->form_textarea('plan', html_escape($this->data['data']->plan), array('class' => 'form-control')));

    }

    public function index($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);
        return $this->data;
    }

    public function create($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);

        $this->data['view_file'] = 'form/gsf1_create';
        return $this->data;
    }
}


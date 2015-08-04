<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_gsf1 extends Base_Model {
    public $data = array('view_file' => 'form/gsf1');

    public function index($d) {
        $this->db->where('id_patient', $d['id_patient']);
        $this->db->where('id_form_gsf1', $d['id_form']);
        $query = $this->db->get('form_gsf1');
        if ($query->num_rows()) 
            $this->data['data'] = $query->row();

        return $this->data;
    }

    public function create($d) {
        $this->data['view_file'] = 'form/gsf2_create';
        return $this->data;
    }
}


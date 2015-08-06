<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_pwnn extends Base_Model {
    public $data = array('view_file' => 'form/pwnn');

    public function index($d) {
        return $this->data;
    }

    public function create($d) {
        $this->db->select('id_clinic,name');
        $this->db->order_by('id_clinic');
        $query = $this->db->get('clinics');
        foreach ($query->result() as $clinics => $clinic) 
            $this->data['clinics'][$clinic->id_clinic] = $clinic->name;

        $this->data['view_file'] = 'form/pwnn_create';
        return $this->data;
    }
}


<?php

class Model_Patient extends Base_Model {
    public function addPatient($data) {
        $this->db->insert('patients', $data);
        return $this->db->insert_id();
    }

    public function patientsCount() {
        return $this->db->count_all_results("patients");
    }

    public function fetchPatients($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('patients');

        if ($query->num_rows() > 0) 
            return $query->result();
        
        return false;
    }

    public function getPatientById($id_patient) {
        $this->db->where('id_patient', $id_patient);
        $query = $this->db->get('patients');
        if ($query->num_rows() > 0) 
            return $query->row();
        
        return false;
    }

    public function updatePatientById($id_patient, $data) {
        $this->db->where('id_patient', $id_patient);
        $this->db->update('patients', $data);
        return $this->db->affected_rows();
    }
}
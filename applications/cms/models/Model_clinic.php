<?php

class Model_Clinic extends Base_Model {
    public function addClinic($data) {
        // $data['enabled'] = 1;
        // $this->load->model('model_password');
        // $data['salt'] = $this->model_password->generateSalt();
        // $data['password'] = $this->model_password->hash($data['password'], $data['salt']);
        $this->db->insert('clinics', $data);
        return $this->db->insert_id();
    }

    public function hours() {
        $hours = array(
            'a12' => '12:00 AM', 'a1' => '01:00 AM', 'a2' => '02:00 AM', 'a3' => '03:00 AM', 'a4' => '04:00 AM', 'a5' => '05:00 AM',
            'a6' => '06:00 AM', 'a7' => '07:00 AM', 'a8' => '08:00 AM', 'a9' => '09:00 AM', 'a10' => '10:00 AM', 'a11' => '11:00 AM',
            'p12' => '12:00 PM', 'p1' => '01:00 PM', 'p2' => '02:00 PM', 'p3' => '03:00 PM', 'p4' => '04:00 PM', 'p5' => '05:00 PM',
            'p6' => '06:00 PM', 'p7' => '07:00 PM', 'p8' => '08:00 PM', 'p9' => '09:00 PM', 'p10' => '10:00 PM', 'p11' => '11:00 PM',
        );


        return $hours;
    }

    public function getHourByKey($key) {
        $key = $key;
        $hours = $this->hours();
        return isset($hours[$key]) ? $hours[$key] : false;
    }

    public function getKeyByHour($hour) {
        $hours = $this->hours();
        foreach ($hours as $hour_key => $hour_val) {
            if ($hour == $hour_val) 
                return $hour_key;
        }
        return false;
    }

    public function countries() {
        $countries = $this->config->item('countries');
        return $countries;
    }

    public function getCountryByKey($key) {
        $countries = $this->countries();
        return isset($countries[$key]) ? $countries[$key] : false;
    }

    public function getKeyByCountry($country) {
        $countries = $this->countries();
        foreach ($countries as $country_key => $country_val) {
            if ($country == $country_val) 
                return $country_key;
        }

        return false;
    }

    public function clinicsCount() {
        return $this->db->count_all_results("clinics");
    }

    public function fetchClinics($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('clinics');

        if ($query->num_rows() > 0) 
            return $query->result();
        
        return false;
    }

    public function getClinicById($id_clinic) {
        $this->db->where('id_clinic', $id_clinic);
        $query = $this->db->get('clinics');
        if ($query->num_rows() > 0) 
            return $query->row();
        
        return false;
    }

    public function updateClinicById($id_clinic, $data) {
        $this->db->where('id_clinic', $id_clinic);
        $this->db->update('clinics', $data);
        return $this->db->affected_rows();
    }
}
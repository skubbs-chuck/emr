<?php

class Model_Form extends Base_Model {

    public function medical_history($id_patient, $id_form = 0) {
        $json = array();
        
        if ($this->input->post(NULL)) {
            $post_data = $this->_post('blood_type', 'immunization', 'phas_date_year', 
                'phas_detail', 'personal_social', 'family_relative', 'family_desease', 'other');
            $data = array(
                'blood_type' => html_escape($this->input->post('blood_type')), 
                'immunization' => html_escape($this->input->post('immunization')), 
                'personal_social' => html_escape($this->input->post('personal_social')), 
                'other' => html_escape($this->input->post('other')));

            $phas_count = (count($post_data['phas_date_year']) >= count($post_data['phas_detail'])) ? count($post_data['phas_date_year']) : count($post_data['phas_detail']);
            for ($i=0; $i < $phas_count; $i++) { 
                if (!empty($post_data['phas_date_year'][$i]) || !empty($post_data['phas_detail'][$i])) {
                    $data['phas'][$i] = array(html_escape($post_data['phas_date_year'][$i]), html_escape($post_data['phas_detail'][$i]));
                }
                
            }

            $family_count = (count($post_data['family_relative']) >= count($post_data['family_desease'])) ? count($post_data['family_relative']) : count($post_data['family_desease']);
            for ($i=0; $i < $family_count; $i++) { 
                if (!empty($post_data['family_relative'][$i]) || !empty($post_data['family_desease'][$i])) {
                    $data['family'][$i] = array(html_escape($post_data['family_relative'][$i]), html_escape($post_data['family_desease'][$i]));
                }
            }

            $data['phas'] = json_encode($data['phas']);
            $data['family'] = json_encode($data['family']);
            $data['id_user'] = $this->session->userdata('user')->id_user;
            $data = $this->security->xss_clean($data);

            $this->db->where('id_patient', $id_patient);
            $query = $this->db->get('medical_history');
            if ($query->num_rows() > 0) {
                $this->db->where('id_patient', $id_patient);
                $this->db->update('medical_history', $data);
                $json['var']['message'] = 'Successfully updated Medical History';
                $json['var']['message_type'] = 'success';
            } else {
                $data['id_patient'] = $id_patient;
                $this->db->where('id_patient', $id_patient);
                $this->db->insert('medical_history', $data);
                $json['var']['message'] = 'Successfully created Medical History';
                $json['var']['message_type'] = 'success';
            }
        }

        $this->db->where('id_patient', $id_patient);
        $query = $this->db->get('medical_history');
        $json['var']['blood_type']  = array(
            '' => '-- Select --', 
            'A+' => 'A+', 'A-' => 'A-', 
            'B+' => 'B+', 'B-' => 'B-', 
            'AB+' => 'AB+', 'AB-' => 'AB-', 
            'O+' => 'O+', 'O-' => 'O-'
        );

        if ($query->num_rows() > 0) {
            $data = $query->row();
            $data->phas = json_decode($data->phas, true);
            $data->family = json_decode($data->family, true);
            $json['data'] = $data;
        }



        return $json;
    }

    public function notes() {
        $args = func_get_args();
        $json = array();
        // $this->db->select(
        //     'forms.id_form,forms.id_form_category,forms.id_form_type,forms.table_name,' . 
        //     'forms.name as name,form_categories.name as category_name,form_types.name as type_name'
        // );
        // $this->db->join('form_types', 'form_types.id_form_type = forms.id_form_type');
        // $this->db->join('form_categories', 'form_categories.id_form_category = forms.id_form_category', 'left');
        // $query = $this->db->get('forms');
        // $json['form_list'] = $query->result();
        return $json;
    }

    public function sortByCreationDate($a, $b) {
        return strtotime($b->creation_date) - strtotime($a->creation_date) ;
    }

    public function consultation($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $json = array();
        
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 1); // consultation
        $query = $this->db->get('forms');
        $forms = $query->result();
        $json['form_list'] = $forms;

        $counter = 0;
        foreach ($forms as $row) {

            $name = preg_replace('/^form_/', '', $row->table_name);
            $this->db->select('id_patient,creation_date,id_' . $row->table_name);
            $this->db->where('id_patient', $id_patient);
            $this->db->order_by('creation_date', 'desc');
            $query = $this->db->get($row->table_name);
            if ($query->num_rows()) {
                foreach ($query->result() as $r) {
                    $counter++;
                    $r->name = $name;
                    $r->tbl = $row->table_name;
                    $r->tbl_name = $row->name;
                    $json['forms'][] = $r;
                }
            }
        }

        $json['id_patient'] = $id_patient;
        $json['count'] = $counter;

        usort($json['forms'], array('Model_Form', 'sortByCreationDate'));
        return $json;
    }

    public function nurse_visit($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $json = array();
        
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 7); // nurse_visit
        $query = $this->db->get('forms');
        $forms = $query->result();
        $json['form_list'] = $forms;

        return $json;
    }

    public function diagnostic_study($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $json = array();
        
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 4); // diagnostic_study
        $query = $this->db->get('forms');
        $forms = $query->result();
        $json['form_list'] = $forms;

        return $json;
    }

    public function procedure($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $json = array();
        
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 5); // procedure
        $query = $this->db->get('forms');
        $forms = $query->result();
        $json['form_list'] = $forms;

        return $json;
    }

    public function operation($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $json = array();
        
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 6); // operation
        $query = $this->db->get('forms');
        $forms = $query->result();
        $json['form_list'] = $forms;

        return $json;
    }

    public function other($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $json = array();
        
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 2); // other / letters
        $query = $this->db->get('forms');
        $forms = $query->result();
        $json['form_list'] = $forms;

        return $json;
    }

    public function cbc($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function cbcf($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function cmof($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function cx($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function gsf1($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        $this->db->where('id_patient', $id_patient);
        $this->db->where('id_form_gsf1', $id_form);
        $query = $this->db->get('form_gsf1');
        if ($query->num_rows()) 
            $json['data'] = $query->row();
        
        if (isset($_GET['create'])) {
            $json['aa'] = 'chuck';
        }

        return $json;
    }

    public function mc1($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function mc2($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function mc3($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function oftu($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function ph($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function tyl($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function wa($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function dc($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function df($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function ec1($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function ec2($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function gsf2($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function gsn($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function gswnt($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function lu($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function oggc($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function ogpc($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function ogpf($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function oc1($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function oc2($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function oc3($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function pediac($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function pulmoc($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function sc($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function atn($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function gnv($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }

    public function pwnn($id_patient, $id_form = 0) {
        $id_patient = (int) $id_patient;
        $id_form = (int) $id_form; // database table id
        $json = array();
        $json['id_patient'] = $id_patient;
        $json['id_form'] = $id_form;

        return $json;
    }


}

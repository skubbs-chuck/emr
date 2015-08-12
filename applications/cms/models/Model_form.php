<?php

class Model_Form extends Base_Model {
    public $sql = array();

    public function init($data) {
        $this->data = $data;
        if (method_exists($this, $this->data['ar']['request_type'])) 
            $this->{$this->data['ar']['request_type']}();
        
        return $this->data;
    }

    public function form() {
        $this->data['view'] = 'form/' . $this->data['ar']['action'];
        $this->data['post'] = $this->input->post(NULL, TRUE);
        $this->data['this_form'] = array(
            'name' => $this->data['ar']['request'],
            'created' => false,
            'alert' => array('type' => 0, 'message' => ''), 
            'items' => array(),
        );

        $method = $this->data['ar']['request'];
        if (method_exists($this, $method)) {
            if ($this->data['post']) {
                $this->data['post']['id_clinic'] = 
                    array_key_exists((int) $this->data['post']['id_clinic'], $this->data['current_clinics']) 
                    ? (int) $this->data['post']['id_clinic'] : $this->data['current_id_clinic'];
            }

            $this->$method();
        }
    }

    public function form_gsf1() {
        if ($this->data['post']) {
            $sql = array(
                'id_patient'     => $this->data['ar']['id_patient'], 
                'id_clinic'      => $this->data['post']['id_clinic'], 
                'id_user'        => $this->session->userdata('user')->id_user, 
                'soap_img'       => html_escape($this->data['post']['soap_img']), 
                'subjective'     => html_escape($this->data['post']['subjective']), 
                'plan'           => html_escape($this->data['post']['plan']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['alert'] = array('type' => 'success', 'message' => 'successfully updated Gen SOAP Follow Up');
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['created'] = true;
                $this->data['alert'] = array('type' => 'success', 'message' => 'successfully created Gen SOAP Follow Up');
            }
        }

        if ($this->data['ar']['action'] == 'index') {
            $this->db->select($this->data['ar']['request'] . '.*');
            $this->db->where('id_patient', $this->data['ar']['id_patient']);
            $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
            $query = $this->db->get($this->data['ar']['request']);
            $this->data['result'] = $query->row();
        }

        $this->data['this_form']['items'] = array(
            array(
                'label' => 'soap_img', 
                'output' => $this->data['result']->soap_img, 
                'input' => $this->form_input('soap_img', $this->data['result']->soap_img, array('class' => 'form-control'))), 
            array(
                'label' => 'Subjective', 
                'output' => $this->data['result']->subjective, 
                'input' => $this->form_textarea('subjective', html_escape($this->data['result']->subjective), array('class' => 'form-control'))), 
            array(
                'label' => 'Plan', 
                'output' => $this->data['result']->plan, 
                'input' => $this->form_textarea('plan', html_escape($this->data['result']->plan), array('class' => 'form-control'))), 
        );
    }

    public function tab() {
        $this->data['view'] = 'form/tab_' . $this->data['ar']['request'];
        $method = 'tab_' . $this->data['ar']['request'];
        if (method_exists($this, $method)) 
            $this->$method();
    }

    public function tab_notes_consultation() {
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 1); // consultation
        $query = $this->db->get('forms');
        $this->data['consultation']['form_list'] = $query->result();
        $this->data['consultation']['count'] = 0;
        
        foreach ($this->data['consultation']['form_list'] as $row) {
            $name = preg_replace('/^form_/', '', $row->table_name);
            $this->db->select('id_patient,creation_date,id_' . $row->table_name);
            $this->db->where('id_patient', $this->data['patient']->id_patient);
            $this->db->order_by('creation_date', 'desc');
            $query = $this->db->get($row->table_name);
            if ($query->num_rows()) {
                foreach ($query->result() as $r) {
                    $this->data['consultation']['count']++;
                    $r->name = $name;
                    $r->tbl = $row->table_name;
                    $r->tbl_name = $row->name;
                    $this->data['consultation']['forms'][] = $r;
                }
            }
        }

        if ($this->data['consultation']['forms']) 
            usort($this->data['consultation']['forms'], array($this, 'sortByCreationDate'));
    }

    public function sortByCreationDate($a, $b) {
        return strtotime($b->creation_date) - strtotime($a->creation_date) ;
    }
}

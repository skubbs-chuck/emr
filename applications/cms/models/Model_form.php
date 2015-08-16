<?php

class Model_Form extends Base_Model {
    public $sql = array();

    public function init($data) {
        $this->data = $data;
        $this->data['post'] = $this->input->post(NULL, TRUE);
        if (method_exists($this, $this->data['ar']['request_type'])) 
            $this->{$this->data['ar']['request_type']}();
        
        return $this->data;
    }

    protected function form_items($label, $name, $opts = array(), $i_opts = array()) {
        $item['label'] = $label;
        $item['db_name'] = $name;
        $item['output'] = $this->data['result']->$name;
        $js  = ($i_opts['js']  && !empty($i_opts['js']))  ? $i_opts['js']  : '';
        $val = ($i_opts['val'] && !empty($i_opts['val'])) ? $i_opts['val'] : $item['output'];
        unset($i_opts['js'], $i_opts['val']);
        $value = $this->input->post($name) ? $this->input->post($name, TRUE) : $val;
        $selected = array_key_exists($this->input->post($name), $opts) ? $this->input->post($name, TRUE) : $value;
        $selected = (empty($selected)) ? $item['output'] : $selected;

        switch ($name) {
            case 'id_clinic': $item['output'] = $this->data['current_clinics'][$this->data['result']->$name]; break;
            case 'visit_date': case 'assessed_date': $item['output'] = date('F j, Y', strtotime($this->data['result']->$name)); break;
            case 'start_time': $item['output'] = date('h:i A', strtotime($this->data['result']->$name)); break;
        }

        $item = array_merge($item, $i_opts);
        switch ($item['input']) {
            case 'textarea': $item['input'] = form_textarea(array_merge(array('name' => $name, 'value' => $value, 'rows' => 3), $opts)); break;
            case 'dropdown': $item['input'] = form_dropdown($name, $opts, $selected, $js); break;
            default: $item['input'] = form_input(array_merge(array('name' => $name, 'value' => $value), $opts)); break;
        }

        return $item;
    }

    // Notes > Consultation
    public function form_gsf1() {
        $this->data['ar']['wrapper'] = 'notes_consultation';
        $this->data['this_form']['title'] = 'Gen SOAP Follow Up';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
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
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
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
            $this->form_items('soap_img', 'soap_img', array('class' => 'form-control')), 
            $this->form_items('Subjective', 'subjective', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Plan', 'plan', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
    }

    // Notes > Nurse Visit
    public function form_atn() {
        $this->data['ar']['wrapper'] = 'notes_nurse_visit';
        $this->data['this_form']['title'] = '[Aesthetics] Therapist\'s Notes';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'     => $this->data['ar']['id_patient'], 
                'id_clinic'      => $this->data['post']['id_clinic'], 
                'id_user'        => $this->session->userdata('user')->id_user, 
                'visit_date'     => date($this->format['sql_date'], strtotime($this->data['post']['visit_date'])), 
                'start_time'     => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])), 
                'order_note'     => html_escape($this->data['post']['order_note']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
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
            $this->form_items('Clinic', 'id_clinic', $this->data['current_clinics'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['current_id_clinic'])), 
            $this->form_items('Visit Date', 'visit_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Start Time', 'start_time', array('class' => 'form-control skubbs_timepicker'), array('class' => 'bootstrap-timepicker', 'fa' => 'fa-clock-o', 'group' => true, 'val' => date($this->format['time']))), 
            $this->form_items('Order/Note', 'order_note', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
    }

    public function form_gnv() {
        $this->data['ar']['wrapper'] = 'notes_nurse_visit';
        $this->data['this_form']['title'] = '[Gen] Nurse Visit';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $diagnosis = $this->input->post('ndp_diagnosis');
            $plan = $this->input->post('ndp_plan');
            $ndp = array();
            if ($diagnosis && $plan) {
                $ndp_diagnosis = array_values($diagnosis);
                $ndp_plan      = array_values($plan);
                
                for ($i=0; $i < count($ndp_diagnosis); $i++) 
                    if (!empty($ndp_diagnosis[$i]) || !empty($ndp_plan[$i])) 
                        $ndp[] = array(html_escape($ndp_diagnosis[$i]), html_escape($ndp_plan[$i]));
            }

            $sql = array(
                'id_patient'     => $this->data['ar']['id_patient'], 
                'id_clinic'      => $this->data['post']['id_clinic'], 
                'id_user'        => $this->session->userdata('user')->id_user, 
                'nursing_assessment' => html_escape($this->data['post']['nursing_assessment']), 
                'ndp'                => json_encode($ndp), 
                'implementation'     => html_escape($this->data['post']['implementation']), 
                'evaluation'         => html_escape($this->data['post']['evaluation']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
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
            $this->form_items('Nursing Assessment', 'nursing_assessment', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Implementation', 'implementation', array('class' => 'form-control'), array('input' => 'textarea')), 
            array('incl' => 'gnv_ndp', 'data' => json_decode($this->data['result']->ndp, true), 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            $this->form_items('Evaluation', 'evaluation', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
    }

    public function form_pwnn() {
        $this->data['ar']['wrapper'] = 'notes_nurse_visit';
        $this->data['this_form']['title'] = '[Preventive Wellness] Nurse\'s Notes';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'     => $this->data['ar']['id_patient'], 
                'id_clinic'      => $this->data['post']['id_clinic'], 
                'id_user'        => $this->session->userdata('user')->id_user, 
                'visit_date'     => date($this->format['sql_date'], strtotime($this->data['post']['visit_date'])), 
                'start_time'     => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])), 
                'focus'          => html_escape($this->data['post']['focus']), 
                'data'           => html_escape($this->data['post']['data']), 
                'action'         => html_escape($this->data['post']['action']), 
                'recommendation' => html_escape($this->data['post']['recommendation']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
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
            $this->form_items('Clinic', 'id_clinic', $this->data['current_clinics'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['current_id_clinic'])), 
            $this->form_items('Visit Date', 'visit_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Start Time', 'start_time', array('class' => 'form-control skubbs_timepicker'), array('class' => 'bootstrap-timepicker', 'fa' => 'fa-clock-o', 'group' => true, 'val' => date($this->format['time']))), 
            $this->form_items('Focus', 'focus', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Data', 'data', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Action', 'action', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Recommendation', 'recommendation', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
    }

    // Notes > Diagnostic Study
    public function form_lu() {
        $this->data['ar']['wrapper'] = 'notes_diagnostic_study';
        $this->data['this_form']['title'] = '[LABMERGE] Urinalysis';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'        => $this->data['ar']['id_patient'],
                'id_clinic'         => $this->data['post']['id_clinic'],
                'id_user'           => $this->session->userdata('user')->id_user,
                'specimen_no'       => html_escape($this->data['post']['specimen_no']),
                'color'             => html_escape($this->data['post']['color']),
                'transparency'      => html_escape($this->data['post']['transparency']),
                'glucose'           => html_escape($this->data['post']['glucose']),
                'bile'              => html_escape($this->data['post']['bile']),
                'ketone'            => html_escape($this->data['post']['ketone']),
                'gravity'           => html_escape($this->data['post']['gravity']),
                'phr'               => html_escape($this->data['post']['phr']),
                'protein'           => html_escape($this->data['post']['protein']),
                'urobilinogen'      => html_escape($this->data['post']['urobilinogen']),
                'nitrites'          => html_escape($this->data['post']['nitrites']),
                'blood'             => html_escape($this->data['post']['blood']),
                'leukocytes'        => html_escape($this->data['post']['leukocytes']),
                'rbc'               => html_escape($this->data['post']['rbc']),
                'wbc'               => html_escape($this->data['post']['wbc']),
                'ec'                => html_escape($this->data['post']['ec']),
                'casts'             => html_escape($this->data['post']['casts']),
                'bacteria'          => html_escape($this->data['post']['bacteria']),
                'pathologist'       => html_escape($this->data['post']['pathologist']),
                'pathologist_other' => html_escape($this->data['post']['pathologist_other']),
                'technologist'      => html_escape($this->data['post']['technologist']),
                'creation_date'     => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
            }
        }

        if ($this->data['ar']['action'] == 'index') {
            $this->db->select($this->data['ar']['request'] . '.*');
            $this->db->where('id_patient', $this->data['ar']['id_patient']);
            $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
            $query = $this->db->get($this->data['ar']['request']);
            $this->data['result'] = $query->row();
        }

        $this->db->select('id_user, first_name, middle_name, last_name');
        $this->db->where('super_user', 0);
        $query = $this->db->get('users');
        $this->data['v']['pathologist'] = $query->result();
        $this->data['v']['ps'] = array('' => '-- Select --', '+' => 'Positive', '-' => 'Negative');

        $this->data['this_form']['items'] = array(
            $this->form_items('Specimen No.', 'specimen_no', array('class' => 'form-control')), 
            array('incl' => 'lu_mce', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            array('incl' => 'lu_fc', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            array('incl' => 'cbcf_pathologist', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            $this->form_items('Medical Technologist', 'technologist', array('class' => 'form-control')), 
        );
    }

    public function form_oftu() {
        $this->data['ar']['wrapper'] = 'notes_diagnostic_study';
        $this->data['this_form']['title'] = 'Ob First Trimester Ultrasound';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'    => $this->data['ar']['id_patient'],
                'id_clinic'     => $this->data['post']['id_clinic'],
                'id_user'       => $this->session->userdata('user')->id_user,
                'visit_date'    => date($this->format['sql_date'], strtotime($this->data['post']['visit_date'])), 
                'start_time'    => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])), 
                'doctor'        => html_escape($this->data['post']['doctor']),
                'doctor_other'  => html_escape($this->data['post']['doctor_other']),
                'on_score'      => html_escape($this->data['post']['on_score']),
                'lmp'           => html_escape($this->data['post']['lmp']),
                'aog'           => html_escape($this->data['post']['aog']),
                'edc'           => html_escape($this->data['post']['edc']),
                'gs_cm'         => html_escape($this->data['post']['gs_cm']),
                'gs_wks'        => html_escape($this->data['post']['gs_wks']),
                'crl_cm'        => html_escape($this->data['post']['crl_cm']),
                'crl_wks'       => html_escape($this->data['post']['crl_wks']),
                'ys_cm'         => html_escape($this->data['post']['ys_cm']),
                'ys_wks'        => html_escape($this->data['post']['ys_wks']),
                'comments'      => html_escape($this->data['post']['comments']),
                'fhr'           => html_escape($this->data['post']['fhr']),
                'aua'           => html_escape($this->data['post']['aua']),
                'cerix'         => html_escape($this->data['post']['cerix']),
                'adnexae'       => html_escape($this->data['post']['adnexae']),
                'others'        => html_escape($this->data['post']['others']),
                'impression'    => html_escape($this->data['post']['impression']),
                'remarks'       => html_escape($this->data['post']['remarks']),
                'creation_date' => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
            }
        }

        if ($this->data['ar']['action'] == 'index') {
            $this->db->select($this->data['ar']['request'] . '.*');
            $this->db->where('id_patient', $this->data['ar']['id_patient']);
            $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
            $query = $this->db->get($this->data['ar']['request']);
            $this->data['result'] = $query->row();
        }

        $this->db->select('id_user, first_name, middle_name, last_name');
        $this->db->where('super_user', 0);
        $query = $this->db->get('users');
        $this->data['v']['doctor'] = $query->result();

        $this->data['this_form']['items'] = array(
            $this->form_items('Clinic', 'id_clinic', $this->data['current_clinics'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['current_id_clinic'])), 
            $this->form_items('Visit Date', 'visit_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Start Time', 'start_time', array('class' => 'form-control skubbs_timepicker'), array('class' => 'bootstrap-timepicker', 'fa' => 'fa-clock-o', 'group' => true, 'val' => date($this->format['time']))), 
            array('incl' => 'oftu_doctor', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            $this->form_items('OB Score', 'on_score', array('class' => 'form-control')), 
            $this->form_items('LMP', 'lmp', array('class' => 'form-control')), 
            $this->form_items('AOG', 'aog', array('class' => 'form-control')), 
            $this->form_items('EDC', 'edc', array('class' => 'form-control')), 
            array('incl' => 'oftu_blk', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            $this->form_items('Comments', 'comments', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Fetal Heart Rate (FHR)', 'fhr', array('class' => 'form-control'), array('group' => true, 'ph' => 'bps')), 
            $this->form_items('Average Ultrasonic Age', 'aua', array('class' => 'form-control'), array('group' => true, 'ph' => 'wks')), 
            $this->form_items('Cerix', 'cerix', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Adnexae', 'adnexae', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Others', 'others', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Impression', 'impression', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Remarks', 'remarks', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
    }

    public function form_cx() {
        $this->data['ar']['wrapper'] = 'notes_diagnostic_study';
        $this->data['this_form']['title'] = 'Chest X-ray';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'        => $this->data['ar']['id_patient'],
                'id_clinic'         => $this->data['post']['id_clinic'],
                'id_user'           => $this->session->userdata('user')->id_user,
                'specimen_no'       => html_escape($this->data['post']['specimen_no']),
                'examination'       => html_escape($this->data['post']['examination']),
                'history'           => html_escape($this->data['post']['history']),
                'comparison'        => html_escape($this->data['post']['comparison']),
                'technique'         => html_escape($this->data['post']['technique']),
                'findings'          => html_escape($this->data['post']['findings']),
                'impression'        => html_escape($this->data['post']['lymphocytes']),
                'radiologist'       => html_escape($this->data['post']['radiologist']),
                'radiologist_other' => html_escape($this->data['post']['radiologist_other']),
                'creation_date'     => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
            }
        }

        if ($this->data['ar']['action'] == 'index') {
            $this->db->select($this->data['ar']['request'] . '.*');
            $this->db->where('id_patient', $this->data['ar']['id_patient']);
            $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
            $query = $this->db->get($this->data['ar']['request']);
            $this->data['result'] = $query->row();
        }

        $this->db->select('id_user, first_name, middle_name, last_name');
        $this->db->where('super_user', 0);
        $query = $this->db->get('users');
        $this->data['v']['radiologist'] = $query->result();

        $this->data['this_form']['items'] = array(
            $this->form_items('Specimen No.', 'specimen_no', array('class' => 'form-control')), 
            $this->form_items('Examination', 'examination', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('History', 'history', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Comparison', 'comparison', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Technique', 'technique', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Findings', 'findings', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Impression', 'impression', array('class' => 'form-control'), array('input' => 'textarea')), 
            array('incl' => 'cx_radiologist', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
        );
    }

    public function form_cbcf() {
        $this->data['ar']['wrapper'] = 'notes_diagnostic_study';
        $this->data['this_form']['title'] = 'CBC Form';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'        => $this->data['ar']['id_patient'],
                'id_clinic'         => $this->data['post']['id_clinic'],
                'id_user'           => $this->session->userdata('user')->id_user,
                'specimen_no'       => html_escape($this->data['post']['specimen_no']),
                'hemoglobin'        => html_escape($this->data['post']['hemoglobin']),
                'hematocrit'        => html_escape($this->data['post']['hematocrit']),
                'rbc'               => html_escape($this->data['post']['rbc']),
                'wbc'               => html_escape($this->data['post']['wbc']),
                'neutrophils'       => html_escape($this->data['post']['neutrophils']),
                'lymphocytes'       => html_escape($this->data['post']['lymphocytes']),
                'eosinophils'       => html_escape($this->data['post']['eosinophils']),
                'monocytes'         => html_escape($this->data['post']['monocytes']),
                'platelet'          => html_escape($this->data['post']['platelet']),
                'mcv'               => html_escape($this->data['post']['mcv']),
                'mch'               => html_escape($this->data['post']['mch']),
                'mchc'              => html_escape($this->data['post']['mchc']),
                'pathologist'       => html_escape($this->data['post']['pathologist']),
                'pathologist_other' => html_escape($this->data['post']['pathologist_other']),
                'technologist'      => html_escape($this->data['post']['technologist']),
                'creation_date'     => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
            }
        }

        if ($this->data['ar']['action'] == 'index') {
            $this->db->select($this->data['ar']['request'] . '.*');
            $this->db->where('id_patient', $this->data['ar']['id_patient']);
            $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
            $query = $this->db->get($this->data['ar']['request']);
            $this->data['result'] = $query->row();
        }

        $this->db->select('id_user, first_name, middle_name, last_name');
        $this->db->where('super_user', 0);
        $query = $this->db->get('users');
        $this->data['v']['pathologist'] = $query->result();

        $this->data['this_form']['items'] = array(
            $this->form_items('Specimen No.', 'specimen_no', array('class' => 'form-control')), 
            array('incl' => 'cbcf_tc', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            array('incl' => 'cbcf_dc', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            array('incl' => 'cbcf_pathologist', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
            $this->form_items('Medical Technologist', 'technologist', array('class' => 'form-control')), 
        );
    }

    public function form_cbc() {
        $this->data['ar']['wrapper'] = 'notes_diagnostic_study';
        $this->data['this_form']['title'] = 'CBC';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'     => $this->data['ar']['id_patient'], 
                'id_clinic'      => $this->data['post']['id_clinic'], 
                'id_user'        => $this->session->userdata('user')->id_user, 
                'visit_date'     => date($this->format['sql_date'], strtotime($this->data['post']['visit_date'])), 
                'start_time'     => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])), 
                'hemoglobin'     => html_escape($this->data['post']['hemoglobin']), 
                'hematocrit'     => html_escape($this->data['post']['hematocrit']), 
                'rbc'            => html_escape($this->data['post']['rbc']), 
                'wbc'            => html_escape($this->data['post']['wbc']), 
                'platelet'       => html_escape($this->data['post']['platelet']), 
                'mcv'            => html_escape($this->data['post']['mcv']), 
                'mch'            => html_escape($this->data['post']['mch']), 
                'mchc'           => html_escape($this->data['post']['mchc']), 
                'rdw'            => html_escape($this->data['post']['rdw']), 
                'eosinophils'    => html_escape($this->data['post']['eosinophils']), 
                'basophils'      => html_escape($this->data['post']['basophils']), 
                'neutrophils'    => html_escape($this->data['post']['neutrophils']), 
                'lymphocytes'    => html_escape($this->data['post']['lymphocytes']), 
                'monocytes'      => html_escape($this->data['post']['monocytes']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
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
            $this->form_items('Clinic', 'id_clinic', $this->data['current_clinics'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['current_id_clinic'])), 
            $this->form_items('Visit Date', 'visit_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Start Time', 'start_time', array('class' => 'form-control skubbs_timepicker'), array('class' => 'bootstrap-timepicker', 'fa' => 'fa-clock-o', 'group' => true, 'val' => date($this->format['time']))), 
            array('incl' => 'cbc', 'create' => ($this->data['ar']['action'] == 'create') ? true : false),
        );
    }

    // Notes > Other
    public function form_comf() {
        $this->data['ar']['wrapper'] = 'notes_other';
        $this->data['this_form']['title'] = 'Certificate of Medical Fitness';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'      => $this->data['ar']['id_patient'],
                'id_clinic'       => $this->data['post']['id_clinic'],
                'id_user'         => $this->session->userdata('user')->id_user,
                'to'              => html_escape($this->data['post']['to']),
                'examined_date'   => date($this->format['sql_date'], strtotime($this->data['post']['examined_date'])),
                'diagnosis'       => html_escape($this->data['post']['diagnosis']),
                'rest_day_no'     => (int) $this->data['post']['rest_day_no'],
                'pn'              => $this->data['post']['pn'],
                'pn_on_date1'     => $this->data['post']['pn_on_date1'],
                'pn_on_date2'     => $this->data['post']['pn_on_date2'],
                'pn_no_lifting'   => (int) $this->data['post']['pn_no_lifting'],
                'pn_no_bending'   => (int) $this->data['post']['pn_no_bending'],
                'pn_no_prolonged' => (int) $this->data['post']['pn_no_prolonged'],
                'pn_equip_limit'  => (int) $this->data['post']['pn_equip_limit'],
                'pn_other'        => (int) $this->data['post']['pn_other'],
                'pn_other_val'    => $this->data['post']['pn_other_val'],
                'pn_unable2work'  => $this->data['post']['pn_unable2work'],
                'creation_date'   => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
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
            $this->form_items('To', 'to', array('class' => 'form-control')), 
            $this->form_items('This is to certify that I have seen and examined ' . $this->data['patient']->first_name . ', ' . $this->data['patient']->middle_name . ' ' . $this->data['patient']->last_name . ' on', 'examined_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Diagnosis', 'diagnosis', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('# of Rest Day', 'rest_day_no', array('type' => 'number', 'class' => 'form-control')),
            array('incl' => 'comf_efpn', 'create' => ($this->data['ar']['action'] == 'create') ? true : false), 
        );
    }

    public function form_mc1() {
        $this->data['ar']['wrapper'] = 'notes_other';
        $this->data['this_form']['title'] = 'Medical Certificate 1';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $doc = array();
            $mc1_doc = $this->input->post('mc1_doc');
            if ($mc1_doc) {
                $mc1_doc = array_values($mc1_doc);
                foreach ($mc1_doc as $_doc) 
                    $doc[] = html_escape($_doc);
            }

            $sql = array(
                'id_patient'    => $this->data['ar']['id_patient'],
                'id_clinic'     => $this->data['post']['id_clinic'],
                'id_user'       => $this->session->userdata('user')->id_user,
                'assessed_date' => date($this->format['sql_date'], strtotime($this->data['post']['assessed_date'])),
                'start_time'    => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])),
                'title'         => html_escape($this->data['post']['title']),
                'purpose'       => (int) $this->data['post']['purpose'], 
                'health'        => (int) $this->data['post']['health'], 
                'pm_defects'    => (int) $this->data['post']['pm_defects'], 
                'doc'           => json_encode($doc), 
                'fitness'       => (int) $this->data['post']['fitness'], 
                'restrictions'  => (int) $this->data['post']['restrictions'], 
                'creation_date' => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
            }
        }

        if ($this->data['ar']['action'] == 'index') {
            $this->db->select($this->data['ar']['request'] . '.*');
            $this->db->where('id_patient', $this->data['ar']['id_patient']);
            $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
            $query = $this->db->get($this->data['ar']['request']);
            $this->data['result'] = $query->row();
        }

        $this->data['v']['purpose']  = array('-- Select --', 'Work', 'School', 'Travel');
        $this->data['v']['health']  = array('-- Select --', 'Good', 'Fair', 'Poor');
        $this->data['v']['pm_defects']  = array('-- Select --', 'No Defects', 'With Monir Defects', 'With Major Defects');
        $this->data['v']['fitness']  = array('-- Select --', 'Fit', 'Unfit');
        $this->data['v']['restrictions']  = array('-- Select --', 'with no physical activity restrictions', 'restricted to light activity only', 'restricted to moderate activity only');

        $this->data['this_form']['items'] = array(
            $this->form_items('Date Assessed', 'assessed_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Start Time', 'start_time', array('class' => 'form-control skubbs_timepicker'), array('class' => 'bootstrap-timepicker', 'fa' => 'fa-clock-o', 'group' => true, 'val' => date($this->format['time']))), 
            $this->form_items('Patient\'s Title', 'title', array('class' => 'form-control')), 
            $this->form_items('Purpose', 'purpose', $this->data['v']['purpose'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['result']->purpose)), 
            $this->form_items('Health Status', 'health', $this->data['v']['health'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['result']->health)), 
            $this->form_items('Physical or Mental Defects', 'pm_defects', $this->data['v']['pm_defects'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['result']->pm_defects)), 
            array('incl' => 'mc1_doc', 'data' => json_decode($this->data['result']->doc, true), 'create' => ($this->data['ar']['action'] == 'create') ? true : false), 
            $this->form_items('Fitness Status', 'fitness', $this->data['v']['fitness'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['result']->fitness)), 
            $this->form_items('Restrictions', 'restrictions', $this->data['v']['restrictions'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['result']->restrictions)), 
        );
    }

    public function form_mc2() {
        $this->data['ar']['wrapper'] = 'notes_other';
        $this->data['this_form']['title'] = 'Medical Certificate 2';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'           => $this->data['ar']['id_patient'],
                'id_clinic'            => $this->data['post']['id_clinic'],
                'id_user'              => $this->session->userdata('user')->id_user,
                'assessed_date'        => date($this->format['sql_date'], strtotime($this->data['post']['assessed_date'])), 
                'start_time'           => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])),
                'to'                   => html_escape($this->data['post']['to']),
                'purpose'              => html_escape($this->data['post']['purpose']),
                'inclusive'            => (int) $this->data['post']['inclusive'],  // 1 = on, 2 = range
                'inclusive_on'         => date($this->format['sql_date'], strtotime($this->data['post']['inclusive_on'])), 
                'inclusive_range_from' => date($this->format['sql_date'], strtotime($this->data['post']['inclusive_range_from'])), 
                'inclusive_range_to'   => date($this->format['sql_date'], strtotime($this->data['post']['inclusive_range_to'])), 
                'diagnosis'            => html_escape($this->data['post']['diagnosis']),
                'comments'             => html_escape($this->data['post']['comments']),
                'creation_date'        => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
            }
        }

        if ($this->data['ar']['action'] == 'index') {
            $this->db->select($this->data['ar']['request'] . '.*');
            $this->db->where('id_patient', $this->data['ar']['id_patient']);
            $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
            $query = $this->db->get($this->data['ar']['request']);
            $this->data['result'] = $query->row();
        }

        $this->data['v']['purpose']  = array('' => '-- Select --', 'Work' => 'Work', 'School' => 'School', 'Travel' => 'Travel', );

        $this->data['this_form']['items'] = array(
            $this->form_items('Date Assessed', 'assessed_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Start Time', 'start_time', array('class' => 'form-control skubbs_timepicker'), array('class' => 'bootstrap-timepicker', 'fa' => 'fa-clock-o', 'group' => true, 'val' => date($this->format['time']))), 
            $this->form_items('To Title', 'to', array('class' => 'form-control')), 
            $this->form_items('Purpose', 'purpose', $this->data['v']['purpose'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['result']->purpose)), 
            array('incl' => 'mc2_di', 'create' => ($this->data['ar']['action'] == 'create') ? true : false), 
            $this->form_items('Diagnosis', 'diagnosis', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Comments', 'comments', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
    }

    public function form_mc3() {
        $this->data['ar']['wrapper'] = 'notes_other';
        $this->data['this_form']['title'] = 'Medical Certificate 3';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'       => $this->data['ar']['id_patient'],
                'id_clinic'        => $this->data['post']['id_clinic'],
                'id_user'          => $this->session->userdata('user')->id_user,
                'assessed_date'    => date($this->format['sql_date'], strtotime($this->data['post']['assessed_date'])),
                'start_time'       => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])),
                'to'               => html_escape($this->data['post']['to']),
                'institution'      => html_escape($this->data['post']['institution']),
                'diagnosis'        => html_escape($this->data['post']['diagnosis']),
                'recommended_rest' => html_escape($this->data['post']['recommended_rest']),
                'recommendation'   => html_escape($this->data['post']['recommendation']),
                'creation_date'    => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
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
            $this->form_items('Date', 'assessed_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Start Time', 'start_time', array('class' => 'form-control skubbs_timepicker'), array('class' => 'bootstrap-timepicker', 'fa' => 'fa-clock-o', 'group' => true, 'val' => date($this->format['time']))), 
            $this->form_items('To', 'to', array('class' => 'form-control')), 
            $this->form_items('Institution', 'institution', array('class' => 'form-control')),
            $this->form_items('Diagnosis', 'diagnosis', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Recommended Rest', 'recommended_rest', array('class' => 'form-control')), 
            $this->form_items('Recommendation', 'recommendation', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
    }

    public function form_tyl() {
        $this->data['ar']['wrapper'] = 'notes_other';
        $this->data['this_form']['title'] = 'Thank You Letter';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $sql = array(
                'id_patient'     => $this->data['ar']['id_patient'], 
                'id_clinic'      => $this->data['post']['id_clinic'], 
                'id_user'        => $this->session->userdata('user')->id_user, 
                'visit_date'     => date($this->format['sql_date'], strtotime($this->data['post']['visit_date'])), 
                'start_time'     => date($this->format['sql_time'], strtotime($this->data['post']['start_time'])), 
                'to'             => html_escape($this->data['post']['to']), 
                'specialty'      => html_escape($this->data['post']['specialty']), 
                'clinic_name'    => html_escape($this->data['post']['clinic_name']), 
                'clinic_address' => html_escape($this->data['post']['clinic_address']), 
                'clinic_contact' => html_escape($this->data['post']['clinic_contact']), 
                'diagnosis'      => html_escape($this->data['post']['diagnosis']), 
                'recommendation' => html_escape($this->data['post']['recommendation']), 
                'creation_date'  => date($this->format['sql_datetime']));

            if ($this->data['ar']['action'] == 'index') {
                $this->db->where('id_' . $this->data['ar']['request'], $this->data['ar']['id_form']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else if ($this->data['ar']['action'] == 'create') {
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
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
            $this->form_items('Visit Date', 'visit_date', array('class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"), array('group' => true, 'fa' => 'fa-calendar', 'val' => date($this->format['date']))), 
            $this->form_items('Start Time', 'start_time', array('class' => 'form-control skubbs_timepicker'), array('class' => 'bootstrap-timepicker', 'fa' => 'fa-clock-o', 'group' => true, 'val' => date($this->format['time']))), 
            $this->form_items('To', 'to', array('class' => 'form-control')), 
            $this->form_items('Specialty', 'specialty', array('class' => 'form-control')), 
            $this->form_items('Clinic Name', 'clinic_name', array('class' => 'form-control')), 
            $this->form_items('Clinic Address', 'clinic_address', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Clinic Contact No.', 'clinic_contact', array('class' => 'form-control')), 
            $this->form_items('Diagnosis', 'diagnosis', array('class' => 'form-control'), array('input' => 'textarea')), 
            $this->form_items('Recommendation', 'recommendation', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
    }

    public function form() {
        $this->data['view'] = 'form/' . $this->data['ar']['action'];
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

    public function tab() {
        $this->data['view'] = 'form/tab_' . $this->data['ar']['request'];
        $method = 'tab_' . $this->data['ar']['request'];
        if (method_exists($this, $method)) 
            $this->$method();
    }

    public function tab_medical_history() {
        $this->data['this_form']['title'] = 'Past Medical History';
        $alert_created = array('type' => 'success', 'message' => 'successfully created ' . $this->data['this_form']['title']);
        $alert_updated = array('type' => 'success', 'message' => 'successfully updated ' . $this->data['this_form']['title']);
        if ($this->data['post']) {
            $phas = array();
            $phas_count = (count($this->data['post']['phas_date_year']) >= count($this->data['post']['phas_detail'])) ? count($this->data['post']['phas_date_year']) : count($this->data['post']['phas_detail']);
            for ($i=0; $i < $phas_count; $i++) 
                if (!empty($this->data['post']['phas_date_year'][$i]) || !empty($this->data['post']['phas_detail'][$i])) 
                    $phas[$i] = array(html_escape($this->data['post']['phas_date_year'][$i]), html_escape($this->data['post']['phas_detail'][$i]));

            $family = array();
            $family_count = (count($this->data['post']['family_relative']) >= count($this->data['post']['family_desease'])) ? count($this->data['post']['family_relative']) : count($this->data['post']['family_desease']);
            for ($i=0; $i < $family_count; $i++) 
                if (!empty($this->data['post']['family_relative'][$i]) || !empty($this->data['post']['family_desease'][$i])) 
                    $family[$i] = array(html_escape($this->data['post']['family_relative'][$i]), html_escape($this->data['post']['family_desease'][$i]));

            $sql = array(
                'id_user'         => $this->session->userdata('user')->id_user, 
                'blood_type'      => html_escape($this->data['post']['blood_type']), 
                'immunization'    => html_escape($this->data['post']['immunization']), 
                'phas'            => json_encode($phas), 
                'personal_social' => html_escape($this->data['post']['personal_social']), 
                'family'          => json_encode($family), 
                'other'           => html_escape($this->data['post']['other']), 
            );
            $sql = $this->security->xss_clean($sql);

            $this->db->where('id_patient', $this->data['ar']['id_patient']);
            $query = $this->db->get($this->data['ar']['request']);
            if ($query->num_rows() > 0) {
                $this->db->where('id_patient', $this->data['ar']['id_patient']);
                $this->db->update($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_updated;
            } else {
                $this->db->where('id_patient', $this->data['ar']['id_patient']);
                $this->db->insert($this->data['ar']['request'], $sql);
                $this->data['this_form']['alert'] = $alert_created;
            }
        }

        $this->db->where('id_patient', $this->data['ar']['id_patient']);
        $query = $this->db->get($this->data['ar']['request']);
        $this->data['v']['blood_type']  = array(
            '' => '-- Select --', 
            'A+' => 'A+', 'A-' => 'A-', 
            'B+' => 'B+', 'B-' => 'B-', 
            'AB+' => 'AB+', 'AB-' => 'AB-', 
            'O+' => 'O+', 'O-' => 'O-'
        );

        if ($query->num_rows() > 0) {
            $this->data['result'] = $query->row();
            $this->data['result']->phas = json_decode($this->data['result']->phas, true);
            $this->data['result']->family = json_decode($this->data['result']->family, true);
        }

        $this->data['this_form']['items'] = array(
            $this->form_items('Blood Type', 'blood_type', $this->data['v']['blood_type'], array('input' => 'dropdown', 'js' => 'class="form-control"', 'val' => $this->data['result']->blood_type)), 
            $this->form_items('Immunizations', 'immunization', array('class' => 'form-control'), array('input' => 'textarea')), 
            array('mh_phas' => true),
            $this->form_items('Personal / Social History', 'personal_social', array('class' => 'form-control'), array('input' => 'textarea')), 
            array('mh_family' => true),
            $this->form_items('Others', 'other', array('class' => 'form-control'), array('input' => 'textarea')), 
        );
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

    public function tab_notes_nurse_visit() {
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 7); // nurse_visit
        $query = $this->db->get('forms');
        $this->data['nurse_visit']['form_list'] = $query->result();
        $this->data['nurse_visit']['count'] = 0;
        
        foreach ($this->data['nurse_visit']['form_list'] as $row) {
            $name = preg_replace('/^form_/', '', $row->table_name);
            $this->db->select('id_patient,creation_date,id_' . $row->table_name);
            $this->db->where('id_patient', $this->data['patient']->id_patient);
            $this->db->order_by('creation_date', 'desc');
            $query = $this->db->get($row->table_name);
            if ($query->num_rows()) {
                foreach ($query->result() as $r) {
                    $this->data['nurse_visit']['count']++;
                    $r->name = $name;
                    $r->tbl = $row->table_name;
                    $r->tbl_name = $row->name;
                    $this->data['nurse_visit']['forms'][] = $r;
                }
            }
        }

        if ($this->data['nurse_visit']['forms']) 
            usort($this->data['nurse_visit']['forms'], array($this, 'sortByCreationDate'));
    }

    public function tab_notes_diagnostic_study() {
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 4); // diagnostic_study
        $query = $this->db->get('forms');
        $this->data['diagnostic_study']['form_list'] = $query->result();
        $this->data['diagnostic_study']['count'] = 0;
        
        foreach ($this->data['diagnostic_study']['form_list'] as $row) {
            $name = preg_replace('/^form_/', '', $row->table_name);
            $this->db->select('id_patient,creation_date,id_' . $row->table_name);
            $this->db->where('id_patient', $this->data['patient']->id_patient);
            $this->db->order_by('creation_date', 'desc');
            $query = $this->db->get($row->table_name);
            if ($query->num_rows()) {
                foreach ($query->result() as $r) {
                    $this->data['diagnostic_study']['count']++;
                    $r->name = $name;
                    $r->tbl = $row->table_name;
                    $r->tbl_name = $row->name;
                    $this->data['diagnostic_study']['forms'][] = $r;
                }
            }
        }

        if ($this->data['diagnostic_study']['forms']) 
            usort($this->data['diagnostic_study']['forms'], array($this, 'sortByCreationDate'));
    }

    public function tab_notes_other() {
        $this->db->select('name, table_name');
        $this->db->where('id_form_type', 2); // other
        $query = $this->db->get('forms');
        $this->data['other']['form_list'] = $query->result();
        $this->data['other']['count'] = 0;
        
        foreach ($this->data['other']['form_list'] as $row) {
            $name = preg_replace('/^form_/', '', $row->table_name);
            $this->db->select('id_patient,creation_date,id_' . $row->table_name);
            $this->db->where('id_patient', $this->data['patient']->id_patient);
            $this->db->order_by('creation_date', 'desc');
            $query = $this->db->get($row->table_name);
            if ($query->num_rows()) {
                foreach ($query->result() as $r) {
                    $this->data['other']['count']++;
                    $r->name = $name;
                    $r->tbl = $row->table_name;
                    $r->tbl_name = $row->name;
                    $this->data['other']['forms'][] = $r;
                }
            }
        }

        if ($this->data['other']['forms']) 
            usort($this->data['other']['forms'], array($this, 'sortByCreationDate'));
    }

    public function sortByCreationDate($a, $b) {
        return strtotime($b->creation_date) - strtotime($a->creation_date) ;
    }
}

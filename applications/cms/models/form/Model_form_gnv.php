<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_gnv extends Base_Model {
    public $data;

    public function __construct() {
        parent::__construct();
        $this->data = array('view_file' => 'form/gnv');
        $this->data['alert'] = array('type' => 0, 'message' => '');
        $this->data['form_name'] = 'form_gnv';
        $this->data['post'] = $this->input->post(NULL, TRUE);
    }

    public function init($d) {
        if ($this->data['post']) {
            $ndp = array();
            if (isset($ndp_diagnosis) && isset($ndp_plan)) {
                $ndp_diagnosis = array_values($this->data['post']['ndp_diagnosis']);
                $ndp_plan      = array_values($this->data['post']['plan']);

                for ($i=0; $i < count($ndp_diagnosis); $i++) 
                    if (!empty($ndp_diagnosis[$i]) || !empty($ndp_plan[$i])) 
                        $ndp[] = array(html_escape($ndp_diagnosis[$i]), html_escape($ndp_plan[$i]));
            }

            $sql = array(
                'id_patient'         => $d['id_patient'], 
                'id_clinic'          => $d['current_id_clinic'], 
                'nursing_assessment' => html_escape($this->data['post']['nursing_assessment']), 
                'ndp'                => ($ndp) ? json_encode($ndp) : '[]', 
                'implementation'     => html_escape($this->data['post']['implementation']), 
                'evaluation'         => html_escape($this->data['post']['evaluation']), 
                'creation_date'      => date($this->format['sql_datetime']));

            if ($d['m'] == 'index') {
                $this->db->where('id_form_gnv', $d['id_form']);
                $this->db->update('form_gnv', $sql);
            } else if ($d['m'] == 'create') {
                $this->db->insert('form_gnv', $sql);
                $this->data['created'] = true;
                $this->data['alert'] = array('type' => 'success', 'message' => 'successfully created General Nurse Visit');
            }
        }

        if ($d['m'] == 'index') {
            $this->db->select('form_gnv.*, clinics.name as clinic_name');
            $this->db->where('id_patient', $d['id_patient']);
            $this->db->where('id_form_gnv', $d['id_form']);
            $this->db->join('clinics', "clinics.id_clinic = form_gnv.id_clinic");
            $query = $this->db->get('form_gnv');
            $this->data['data'] = $query->row();
        }

        $this->data['form'] = array(
            'nursing_assessment' => $this->form_textarea('nursing_assessment', html_escape($this->data['data']->nursing_assessment), array('class' => 'form-control')), 
            'implementation' => $this->form_textarea('implementation', html_escape($this->data['data']->implementation), array('class' => 'form-control')), 
            'evaluation' => $this->form_textarea('evaluation', html_escape($this->data['data']->evaluation), array('class' => 'form-control')));

    }

    public function index($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);
        return $this->data;
    }

    public function create($d) {
        $d['m'] = __FUNCTION__;
        $this->init($d);

        $this->data['view_file'] = 'form/gnv_create';
        return $this->data;
    }
}

// if ($this->input->post(NULL)) {
//             $ndp_diagnosis = $this->input->post('ndp_diagnosis', TRUE);
//             $ndp_plan      = $this->input->post('ndp_plan', TRUE);
//             if (isset($ndp_diagnosis) && isset($ndp_plan)) {
//                 $ndp = array();
//                 $ndp['diagnosis'] = array_values($ndp_diagnosis);
//                 $ndp['plan']      = array_values($ndp_plan);

//                 for ($i=0; $i < count($ndp['diagnosis']); $i++) 
//                     if (!empty($ndp['diagnosis'][$i]) || !empty($ndp['plan'][$i])) 
//                         $sql['ndp'][] = array(html_escape($ndp['diagnosis'][$i]), html_escape($ndp['plan'][$i]));
//             }

//             $sql['id_patient']         = (int) $d['id_patient'];
//             $sql['nursing_assessment'] = html_escape($this->input->post('nursing_assessment', TRUE));
//             $sql['implementation']     = html_escape($this->input->post('implementation', TRUE));
//             $sql['evaluation']         = html_escape($this->input->post('evaluation', TRUE));
//             $sql['ndp']                = ($sql['ndp']) ? json_encode($sql['ndp']) : '[]';

//             $this->data['sql'] = $sql;

            
//             $this->data['var']['message_type'] = 'success';
//             $this->data['var']['message'] = 'Successfully created General Nurse Visit';
//         }
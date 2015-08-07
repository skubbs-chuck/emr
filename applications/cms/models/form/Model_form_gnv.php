<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_form_gnv extends Base_Model {
    public $data = array('view_file' => 'form/gnv');

    public function index($d) {
        return $this->data;
    }

    public function create($d) {
        $this->data['view_file'] = 'form/gnv_create';

        if ($this->input->post(NULL)) {
            $ndp_diagnosis = $this->input->post('ndp_diagnosis', TRUE);
            $ndp_plan      = $this->input->post('ndp_plan', TRUE);
            if (isset($ndp_diagnosis) && isset($ndp_plan)) {
                $ndp = array();
                $ndp['diagnosis'] = array_values($ndp_diagnosis);
                $ndp['plan']      = array_values($ndp_plan);

                for ($i=0; $i < count($ndp['diagnosis']); $i++) 
                    if (!empty($ndp['diagnosis'][$i]) || !empty($ndp['plan'][$i])) 
                        $sql['ndp'][] = array(html_escape($ndp['diagnosis'][$i]), html_escape($ndp['plan'][$i]));
            }

            $sql['id_patient']         = (int) $d['id_patient'];
            $sql['nursing_assessment'] = html_escape($this->input->post('nursing_assessment', TRUE));
            $sql['implementation']     = html_escape($this->input->post('implementation', TRUE));
            $sql['evaluation']         = html_escape($this->input->post('evaluation', TRUE));
            $sql['ndp']                = ($sql['ndp']) ? json_encode($sql['ndp']) : '[]';

            $this->data['sql'] = $sql;

            
            $this->data['var']['message_type'] = 'success';
            $this->data['var']['message'] = 'Successfully created General Nurse Visit';
        }

        return $this->data;
    }
}


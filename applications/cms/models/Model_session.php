<?php

class Model_Session extends Base_Model {

    public function __construct() {
        parent::__construct();
    }

    public function is_logged_in() {
        $is_logged_in = $this->user() ? TRUE : FALSE;
        $cookie_remember_me = $this->read_remember_me();
        if (!$is_logged_in && $cookie_remember_me) {
            // check if remember me exist.
            $this->db->select('users.*, sessions.id_session AS id_session');
            $this->db->from('sessions');
            $this->db->join('users', 'users.id_user = sessions.id_user');
            $this->db->where('sessions.id_session', $cookie_remember_me);
            $q = $this->db->get();
            if ($q->num_rows()) {
                $this->delete_remember_me();
                $this->model_session->add_user($q->row(), TRUE);
                redirect('/');
            } else {
                $this->delete_remember_me();
            }
        }

        return $is_logged_in;
    }

    public function logout() {
        $this->delete_remember_me();
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    public function user() {
        return $this->session->userdata('user');
    }

    public function read_remember_me() {
        return $this->input->cookie('skubbs_kmli');
    }

    public function create_remember_me() {
        $skubbs_kmli = array(
            'name'   => 'skubbs_kmli',
            'value'  => session_id(), 
            'expire' => EXPIRE_ONE_YEAR,
        );

        $this->input->set_cookie($skubbs_kmli);
    }

    public function delete_remember_me() {
        $this->db->where('id_session', $this->read_remember_me());
        $this->db->delete('sessions');

        $this->db->where('id_session', session_id());
        $this->db->delete('sessions');
        
        delete_cookie('skubbs_kmli');
    }

    public function add_user($userdata, $remember_me = FALSE) {
        $data = array('id_session' => session_id(), 'id_user' => $userdata->id_user);
        $userdata->id_session = session_id();

        $this->db->insert('sessions', $data);
        if ($remember_me) 
            $this->create_remember_me();
        
        $clinics = json_decode($userdata->clinics);
        $this->db->where_in('id_clinic', $clinics);
        $sql = $this->db->get('clinics');
        $this->session->set_userdata('current_clinics', $sql->result());
        $this->session->set_userdata('current_id_clinic', $clinics[0]);
        return $this->session->set_userdata('user', $userdata);
    }
}
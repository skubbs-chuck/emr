<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model_user');
    }

    public function groups() {
        $this->_homeAssets();
        $this->display('comming_soon');
    }

    public function profile($username_or_id = NULL) {
        $this->data['uinfo'] = array();
        $this->data['username_or_id'] = $username_or_id;
        $this->data['current_page'] = 'user/management';

        if (is_numeric($username_or_id)) {
            $this->load->model('model_user');
            $this->data['uinfo'] = $this->model_user->getUserById($username_or_id);
            if (!$this->data['uinfo']) 
                redirect('user/profile');
        } else if (!is_numeric($username_or_id) && $username_or_id != false) {
            $this->load->model('model_user');
            $this->data['uinfo'] = $this->model_user->getUserByUsername($username_or_id);
            if (!$this->data['uinfo']) 
                redirect('user/profile');
        } else {
            # must be logged in at this point
            if (!$this->model_session->is_logged_in()) 
                redirect('user/login');

            $this->data['uinfo'] = $this->session->userdata('user');
        }

        $this->_homeAssets();
        $this->display();
    }

    public function add() {
        $this->data['current_page'] = 'user/management';
        # must be logged in at this point
        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[20]|is_unique[users.username]', array('is_unique' => 'Username already taken.'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique' => 'Email already taken.'));
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('specialty', 'Specialization', 'trim|required');
        $this->form_validation->set_rules('clinics[]', 'Clinics', 'required');
        if ($this->form_validation->run()) {
            $post_data = $this->_post('username', 'password', 'email', 'first_name', 'last_name', 'specialty');
            $post_data['clinics'] = $this->input->post('clinics');
            
            $id_user = $this->model_user->addUser($post_data);
            if ($id_user) {
                $this->setFlashAlert($post_data['username'] . ' has been sucessfully added.', 'success');
                redirect('user/management');
            } else {
                $this->data['insert_error'] = 'Error inserting user. please contact your site administrator';
            }
        }


        $this->db->select('id_clinic,name');
        $this->db->order_by('id_clinic');
        $query = $this->db->get('clinics');
        foreach ($query->result() as $clinics => $clinic) 
            $this->data['clinics'][$clinic->id_clinic] = $clinic->name;

        $this->_homeAssets();
        $this->display();
    }

    public function disable($username = NULL) {
        if (!$this->model_user->isSuperUser()) 
            $this->setFlashAlert('You dont have permission to disable this user.', 3);
        
        $this->db->where('username', $username);
        $this->db->where('super_user', 0);
        $this->db->update('users', array('enabled' => 0));

        if ($this->db->affected_rows())
            $this->setFlashAlert('User \'' . $username . '\' has been disabled.', 'success');
        else
            $this->setFlashAlert('Error disabling user \'' . $username . '\'.', 3);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function enable($username = NULL) {
        if (!$this->model_user->isSuperUser()) 
            $this->setFlashAlert('You dont have permission to disable this user.', 3);
        
        $this->db->where('username', $username);
        $this->db->where('super_user', 0);
        $this->db->update('users', array('enabled' => 1));

        if ($this->db->affected_rows())
            $this->setFlashAlert('User \'' . $username . '\' has been enable.', 'success');
        else
            $this->setFlashAlert('Error enabling user \'' . $username . '\'.', 3);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit($username_or_id = NULL) {
        $session_user = $this->session->userdata('user');
        $this->data['uinfo'] = $this->model_user->getUserById($session_user->id_user);
        $this->data['username_or_id'] = $username_or_id;
        $this->data['current_page'] = 'user/management';

        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

        $udata = $this->input->post(NULL);

        if (is_numeric($username_or_id)) {
            
            $this->data['uinfo'] = $this->model_user->getUserById($username_or_id);
            if (!$this->data['uinfo']) 
                redirect('user/profile');

            if ($this->input->post(NULL)) {
                $updated = $this->model_user->updateUserById($username_or_id, $udata);
                $updated ? $this->setFlashAlert('Account has been updated', 'success') : $this->setFlashAlert('Error updating account with id \'' . ((int) $username_or_id) . '\'', 'error');
            }
            
            $this->data['uinfo'] = $this->model_user->getUserById($username_or_id);
        } else if (!is_numeric($username_or_id) && $username_or_id) {
            
            $this->data['uinfo'] = $this->model_user->getUserByUsername($username_or_id);
            if (!$this->data['uinfo']) 
                redirect('user/profile');

            if ($this->input->post(NULL)) {
                $updated = $this->model_user->updateUserByUsername($username_or_id, $udata);
                $updated ? $this->setFlashAlert('Account has been updated', 'success') : $this->setFlashAlert('Error updating ' . html_escape($username_or_id) . '\'s account', 'error');
            }

            $this->data['uinfo'] = $this->model_user->getUserByUsername($username_or_id);
        } else {

            if ($this->input->post(NULL) && isset($session_user->id_user)) {
                $updated = $this->model_user->updateUserById($session_user->id_user, $udata);
                $updated ? $this->setFlashAlert('Account has been updated', 'success') : $this->setFlashAlert('Error updating your account', 'error');
            }

            $this->data['uinfo'] = $this->model_user->getUserById($session_user->id_user);
        }

        // print_r($this->session->userdata('user')); exit();
        $this->db->select('id_clinic,name');
        $this->db->order_by('id_clinic');
        $query = $this->db->get('clinics');
        foreach ($query->result() as $clinics => $clinic) 
            $this->data['clinics'][$clinic->id_clinic] = $clinic->name;

        $this->_homeAssets();
        $this->display();
    }

    public function management() {
        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

        $this->data['title'] = 'User Management';

        $this->load->model('model_user');
        $pagination = $this->_pagination(array('total_rows' => $this->model_user->usersCount()));
        $this->pagination->initialize($pagination);
        $this->data['user_list'] = $this->model_user->fetchUsers($pagination["per_page"], $pagination['page']);
        $this->data["user_list_links"] = $this->pagination->create_links();

        $this->_homeAssets();
        $this->display();
    }

    public function login() {
        if ($this->model_session->is_logged_in()) 
            redirect('/');

        $this->addCss($this->tplUrl . 'plugins/iCheck/square/blue.css');
        $this->addJs($this->tplUrl . 'plugins/iCheck/icheck.min.js');
        $this->display();
    }

    public function logout() {
        if (!$this->model_session->is_logged_in()) 
            redirect('user/login');

        $this->model_session->logout();
    }

    public function auth() {
        if ($this->model_session->is_logged_in()) 
            redirect('/');

        // print_r($_POST); exit();
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember_me = $this->input->post('remember_me');

        $this->load->model('model_user');
        $authenticated = $this->model_user->auth($username, $password, $remember_me);
        $authenticated ? redirect('/') : redirect('user/login');
    }
}

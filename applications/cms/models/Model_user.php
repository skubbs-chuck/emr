<?php

class Model_User extends Base_Model {

	public function addUser($data) {
		$data['enabled'] = 1;
		$this->load->model('model_password');
		$data['salt'] = $this->model_password->generateSalt();
		$data['password'] = $this->model_password->hash($data['password'], $data['salt']);
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function userExist($username) {
		$user = $this->db->get_where('users', array('username' => $username));
		return $user->num_rows() ? $user->row() : FALSE;
	}

	public function getUserById($id_user) {
		$query = $this->db->get_where('users', array('id_user' => (int) $id_user));
		if ($query->num_rows()) 
			return $query->row();
		return false;
	}

	public function getUserByUsername($username) {
		$query = $this->db->get_where('users', array('username' => $username));
		if ($query->num_rows()) 
			return $query->row();
		return false;
	}

	public function updateUserById($id_user, $data) {
		$this->db->where('id_user', $id_user);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}

	public function updateUserByUsername($username, $data) {
		$this->db->where('username', $username);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}

	public function verify($input_pass, $db_pass, $db_salt = FALSE) {
		if ($db_salt) {
			$this->load->model('model_password');
			return $this->model_password->verify($input_pass, $db_pass, $db_salt);
		} else {
			return ($input_pass == $db_pass) ? TRUE : FALSE;
		}
	}

	public function auth($username, $password, $remember_me = FALSE) {
    	if (!empty($username) && !empty($password)) {
    		// $this->session->set_flashdata('alert_message', 'Your request is under process');
    		
    		$user = $this->userExist($username);
    		if ($user) {
    			if (!$user->enabled) {
    				$this->session->set_flashdata('alert_message', 'Account is currently disabled.');
    				return FALSE;
    			}
    			
    			if ($this->verify($password, $user->password, $user->salt)) {
                    $this->model_session->add_user($user, $remember_me);
    				return TRUE;
    			} else {
    				$this->session->set_flashdata('alert_message', 'Incorrect password!');
    			}
    		} else {
    			$this->session->set_flashdata('alert_message', 'User does not exist!');
    		}
    	}

    	return FALSE;
	}

	public function isSuperUser($id_user = false) {
		$user = $this->session->userdata('user');
		return $user->super_user;
	}

	public function usersCount() {
		if (!$this->isSuperUser()) 
			$this->db->where('super_user', 0);
		
        return $this->db->count_all_results("users");
    }

	public function fetchUsers($limit, $start) {
		$this->db->limit($limit, $start);
		if (!$this->isSuperUser()) 
			$this->db->where('super_user', 0);
		$query = $this->db->get('users');

		if ($query->num_rows() > 0) 
			return $query->result();
        
        return false;
	}
}
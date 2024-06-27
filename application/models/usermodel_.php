<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function login($username, $password) {
        $query = $this->db->get_where('users', array('username' => $username));
        $user = $query->row_array();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function register($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->db->insert('users', $data);
    }

    public function get_user($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }
}

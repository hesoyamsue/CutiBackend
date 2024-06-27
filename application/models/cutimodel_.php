<?php
class Cuti_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_all_cuti() {
        $query = $this->db->get('cuti');
        return $query->result_array();
    }

    public function get_cuti($id) {
        $query = $this->db->get_where('cuti', array('id' => $id));
        return $query->row_array();
    }

    public function get_cuti_by_user($user_id) {
        $query = $this->db->get_where('cuti', array('user_id' => $user_id));
        return $query->result_array();
    }

    public function create_cuti($data) {
        return $this->db->insert('cuti', $data);
    }
}

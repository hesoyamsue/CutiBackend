<?php
class Approval_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function approve_cuti($data) {
        return $this->db->insert('approval', $data);
    }

    public function get_approval_by_cuti($cuti_id) {
        $query = $this->db->get_where('approval', array('cuti_id' => $cuti_id));
        return $query->result_array();
    }
}

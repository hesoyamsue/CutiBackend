<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Approval_model');
        $this->load->helper('url');
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->Approval_model->approve_cuti($data);
        
        if ($result) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'Approval processed successfully')));
        } else {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'Approval processing failed')));
        }
    }

    public function cuti($cuti_id) {
        $approval = $this->Approval_model->get_approval_by_cuti($cuti_id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($approval));
    }
}

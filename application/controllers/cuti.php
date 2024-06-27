<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Cuti_model');
        $this->load->helper('url');
    }

    public function index() {
        $cuti = $this->Cuti_model->get_all_cuti();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($cuti));
    }

    public function get($id) {
        $cuti = $this->Cuti_model->get_cuti($id);
        
        if ($cuti) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($cuti));
        } else {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'Cuti not found')));
        }
    }

    public function user($user_id) {
        $cuti = $this->Cuti_model->get_cuti_by_user($user_id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($cuti));
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->Cuti_model->create_cuti($data);
        
        if ($result) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'Cuti submitted successfully')));
        } else {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'Cuti submission failed')));
        }
    }
}

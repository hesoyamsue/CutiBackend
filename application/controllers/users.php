<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function login() {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $password = $data['password'];
        
        $user = $this->User_model->login($username, $password);
        
        if ($user) {
            $response = array('token' => 'some_generated_token', 'user_id' => $user['id']);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'Invalid username or password')));
        }
    }

    public function register() {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->User_model->register($data);
        
        if ($result) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'User registered successfully')));
        } else {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'User registration failed')));
        }
    }

    public function get($id) {
        $user = $this->User_model->get_user($id);
        
        if ($user) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($user));
        } else {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('message' => 'User not found')));
        }
    }
}

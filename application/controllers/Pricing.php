<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pricing extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            $this->load->view('templates/user_header');
            $this->load->view('pricing/index');
            $this->load->view('templates/user_footer');
        } else {
            if ($this->session->userdata('user_role') == 1101) {
                redirect('admin_dashboard');
            }

            $this->load->model('User_model', 'User');
            $this->load->model('Active_test_model', 'Active_test');

            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);
            $data['active_test'] = $this->Active_test->getActiveTest($data['user_data']['user_id']);

            $this->load->view('templates/user_header_two', $data);
            $this->load->view('pricing/index');
            $this->load->view('templates/user_footer');
        }
    }
}

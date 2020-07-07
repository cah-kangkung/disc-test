<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            $this->load->view('templates/user_header');
            $this->load->view('home/index');
            $this->load->view('templates/user_footer');
        } else {
            if ($this->session->userdata('user_role') == 1101) {
                redirect('admin_dashboard');
            }

            $this->load->model('User_model', 'User');

            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);

            $this->load->view('templates/user_header_two', $data);
            $this->load->view('home/index');
            $this->load->view('templates/user_footer');
        }
    }
}

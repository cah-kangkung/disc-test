<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Active_test_model', 'Active_test');
        $this->load->model('Test_model', 'Test');
        $this->load->model('Payment_model', 'Payment');
        $this->load->model('Report_model', 'Report');
    }

    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 1101) {
                redirect('admin_dashboard');
            }

            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);

            $data['reports'] = $this->Report->getReportByUser($data['user_data']['user_id']);

            $this->load->view('templates/user_header_two', $data);
            $this->load->view('report/index');
            $this->load->view('templates/user_footer');
        }
    }
}

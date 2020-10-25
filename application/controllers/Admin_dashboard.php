<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 1102) {
                redirect('home');
            }

            $this->load->model('User_model', 'User');
            $this->load->model('Test_model', 'Test');
            $this->load->model('Payment_model', 'Payment');

            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);
            $data['total_user'] = $this->User->countUser();
            $questions = $this->Test->getAllQuestion();
            $data['total_questions'] = count($questions);
            $data['title'] = 'Halaman Dashboard';

            // count total earning
            $payment_list = $this->Payment->getTotalEarning();
            $data['total_earning'] = 0;
            foreach ($payment_list as $payment) {
                $data['total_earning'] += (int) $payment['total_amount'];
            }

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin_dashboard/index');
            $this->load->view('templates/admin_footer');
        }
    }
}

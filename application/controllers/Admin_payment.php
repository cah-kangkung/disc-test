<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Payment_model', 'Payment');
    }

    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 1102) {
                redirect('home');
            }

            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);

            $payment_status = $this->input->get('filter');
            $data['payment_list'] = $this->Payment->getAllPayment($payment_status);
            $data['title'] = "Halaman Pembayaran";

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin_payment/index');
            $this->load->view('templates/admin_footer');
        }
    }

    public function cancel_payment()
    {
        $payment_id = $_GET['payment_id'];
        $user_id = $_GET['user_id'];

        $this->Payment->updateStatus('cancel', $payment_id, $user_id);
        redirect('admin_payment');
    }

    public function revert_to_waiting()
    {
        $payment_id = $_GET['payment_id'];
        $user_id = $_GET['user_id'];

        $this->Payment->updateStatus('waiting', $payment_id, $user_id);
        redirect('admin_payment');
    }

    public function confirm_payment()
    {
        $payment_id = $_GET['payment_id'];
        $user_id = $_GET['user_id'];

        $this->Payment->updateStatus('confirm', $payment_id, $user_id);

        redirect('admin_payment');
    }
}

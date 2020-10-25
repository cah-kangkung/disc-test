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
        $this->load->model('Payment_method_model', 'Payment_method');
    }

    public function order_list()
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

            // get filter from url
            $user_id = $data['user_data']['user_id'];
            $payment_status = $this->input->get('filter');
            // $search_filter = $this->input->get('search'); # NOT YET IMPLEMENT

            // Preparing pagination config
            $this->load->library('pagination');

            $config['total_rows'] = $this->Payment->countUserPayment($user_id, $payment_status);
            $config['per_page'] = 4;

            $this->pagination->initialize($config);

            $data['offset'] = $this->uri->segment(3);
            $data['payment_list'] = $this->Payment->getPaymentByUser($user_id, $payment_status, $config['per_page'], $data['offset']);
            $data['count'] = $config['total_rows'];

            $this->load->view('templates/user_header_two', $data);
            $this->load->view('payment/list_payment');
            $this->load->view('templates/user_footer');
        }
    }

    public function checkout()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);

            if ($this->session->userdata('user_role') == 1101) {
                redirect('admin_dashboard');
            } elseif ($data['user_data']['is_completed'] != 1) {
                redirect('profile');
            }

            // get active test status the user currently has
            // kick them if they are in active status
            $active_test = $this->Active_test->getActiveTest($data['user_data']['user_id']);
            $active_status = $active_test['status'];
            if ($active_status != 0) {
                redirect('payment/order_list');
            }

            // all the necessary data about make payment
            $data['payment_destinations'] = $this->Payment_method->getAllPD();
            $data['test'] = $this->Test->getTestByID(1);
            $price = $data['test']['price'] / 1000;
            $data['test']['price'] = $price . ',000';

            $this->form_validation->set_rules('bank', 'Nama Bank', 'required|trim', ['required' => 'Nama Bank harus diisi!']);
            $this->form_validation->set_rules('bank_account_number', 'Nomor Rekening', 'required|trim', ['required' => 'Nomor Rekening harus diisi!']);
            $this->form_validation->set_rules('bank_account_name', 'Nama Pengirim', 'required|trim', ['required' => 'Nama Pengirim harus diisi!']);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/user_header_two', $data);
                $this->load->view('payment/checkout');
                $this->load->view('templates/user_footer');
            } else {

                $test_id = $this->input->post('test_id');
                $test = $this->Test->getTestByID($test_id);

                date_default_timezone_set("Asia/Jakarta");
                $date_end = time() + (24 * 60 * 60);

                // get admin bank accout
                $destination_id = $this->input->post('payment_destination');
                $payment_destination = $this->Payment_method->getPaymentDestination($destination_id);

                $data['payment'] = [
                    'user_id' => $data['user_data']['user_id'],
                    'email' => $data['user_data']['email'],
                    'name' => $data['user_data']['full_name'],
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_expired' => date('Y-m-d H:i:s', $date_end),
                    'test_name' => $test['name'],
                    'total_amount' => $test['price'],
                    'destination_bank' => $payment_destination['bank'],
                    'destination_acc_number' => $payment_destination['bank_account_number'],
                    'destination_acc_name' => $payment_destination['bank_account_name'],
                    'bank' => $this->input->post('bank'),
                    'bank_account_number' => $this->input->post('bank_account_number'),
                    'bank_account_name' => $this->input->post('bank_account_name'),
                    'receipt' => null,
                    'status' => 1,
                ];

                // var_dump($data['payment']);
                // die;

                $this->Payment->makePayment($data['payment']);

                $user_id = $data['user_data']['user_id'];
                $this->Active_test->updateStatus($user_id, 1);

                // PUSHER TRIGGER
                $pusher = new Pusher\Pusher("97e23ed5d522856f8f11", "bf7dfd9b59003270d753", "1037064", array('cluster' => 'ap1'));

                $data['message'] = 'Notifikasi user checkout';
                $pusher->trigger('my-channel', 'my-event', $data);

                redirect('payment/order_list');
            }
        }
    }

    public function update_sender_account()
    {
        $data['new_data'] = [
            'payment_id' => $this->input->post('payment_id'),
            'bank' => $this->input->post('bank'),
            'bank_account_number' => $this->input->post('bank_account_number'),
            'bank_account_name' => $this->input->post('bank_account_name'),
        ];

        $this->Payment->editSenderBank($data['new_data']);
        redirect('payment/order_list');
    }

    public function cancel_payment()
    {
        $payment_id = $_GET['payment_id'];
        $user_id = $_GET['user_id'];

        $this->Payment->updateStatus('cancel', $payment_id, $user_id);
        redirect('payment/order_list');
    }
}

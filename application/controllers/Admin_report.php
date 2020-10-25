<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Admin_report extends CI_Controller
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
            if ($this->session->userdata('user_role') == 1102) {
                redirect('home');
            }

            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);
            $data['title'] = 'Halaman Cetak Laporan';

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin_report/index');
            $this->load->view('templates/admin_footer');
        }
    }

    public function generate_report()
    {

        // get payment list based on filter
        $is_filtered = $this->input->post('date_filter');
        $date_from = new DateTime($this->input->post('date_from'));
        $date_to = new DateTime($this->input->post('date_to'));

        $new_date_from = $date_from->format('Y-m-d 00:00:00');
        $new_date_to = $date_to->format('Y-m-d 23:59:59');

        if ($is_filtered == 'option1') {
            $data['payment_list'] = $this->Payment->generatePaymentReport();
        } else {
            $data['payment_list'] = $this->Payment->generatePaymentReport($new_date_from, $new_date_to);
        }

        $data['count'] = count($data['payment_list']);

        $data['date'] = [
            'date_from' => $date_from->format('d-m-Y'),
            'date_to' => $date_to->format('d-m-Y'),
        ];

        // count total earning
        $payment_list = $this->Payment->getTotalEarning();
        $data['total_earning'] = 0;
        foreach ($payment_list as $payment) {
            $data['total_earning'] += (int) $payment['total_amount'];
        }

        // get all user data
        $data['user_list'] = $this->User->getAllUser();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $html = $this->load->view('admin_report/admin_report_pdf', $data, TRUE);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('output', array("Attachment" => false));
    }
}

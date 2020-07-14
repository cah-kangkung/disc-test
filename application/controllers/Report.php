<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Report extends CI_Controller
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
            $data['count'] = count($data['reports']);

            $this->load->view('templates/user_header_two', $data);
            $this->load->view('report/index');
            $this->load->view('templates/user_footer');
        }
    }

    public function generate_pdf()
    {
        $report_id = $_GET['id'];
        $data['report'] = $this->Report->getReportByID($report_id);
        $data['user_data'] = $this->User->getUserByID($data['report']['user_id']);

        // date created convertion
        $date = new DateTime($data['report']['date_created']);
        $new_date = $date->format('d F Y');
        $data['report']['date_created'] = $new_date;

        // birth date convertion
        $date = new DateTime($data['user_data']['birth']);
        $new_date = $date->format('d F Y');
        $data['user_data']['birth'] = $new_date;

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $html = $this->load->view('report/report_pdf', $data, TRUE);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('output', array("Attachment" => false));
    }
}

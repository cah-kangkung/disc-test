<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Active_test_model', 'Active_test');
        $this->load->model('Test_model', 'Test');
    }

    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);
            $data['active_test'] = $this->Active_test->getActiveTest($data['user_data']['user_id']);

            if ($this->session->userdata('user_role') == 1101) {
                redirect('home');
            } elseif ($data['active_test']['status'] == 1 || $data['active_test']['status'] == 0) {
                redirect('pricing');
            } elseif ($data['user_data']['is_completed'] != 1) {
                redirect('profile');
            }

            $time_end = strtotime($data['active_test']['time_end']);
            if ($time_end - time() < 0) {
                // if expired
                $this->session->set_flashdata('danger_alert', 'Waktu anda telah habis, silahkan order kembali untuk mengikuti tes');
                redirect('pricing');
            } else {
                // if not expired
                // get test questions
                $data['questions'] = $this->Test->getAllQuestion();

                $this->load->view('templates/user_header_two', $data);
                $this->load->view('test/index');
                $this->load->view('templates/user_footer');
            }
        }
    }

    public function start_test()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);
            $data['active_test'] = $this->Active_test->getActiveTest($data['user_data']['user_id']);

            if ($this->session->userdata('user_role') == 1101) {
                redirect('home');
            }
            if ($data['active_test']['status'] != 2) {
                redirect('pricing');
            }

            $data['test'] = $this->Test->getTestByID(1);
            $duration = (int) $data['test']['duration'];
            date_default_timezone_set("Asia/Jakarta");
            $date_end = time() + ($duration * 60);

            $data['new_data'] = [
                'user_id' => $data['user_data']['user_id'],
                'payment_id' => $data['active_test']['payment_id'],
                'time_start' => date("Y-m-d H:i:s"),
                'time_end' => date('Y-m-d H:i:s', $date_end),
                'status' => 3,
            ];

            $this->Active_test->updateActiveTest($data['new_data']);
            redirect('test');
        }
    }

    public function get_time_end()
    {
        $user_id = $this->input->get('user_id');
        $result = [
            'status' => 200,
            'data' => $this->Active_test->getTimeEnd($user_id)
        ];
        echo json_encode($result);
    }

    public function submit_test()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 1101) {
                redirect('home');
            }

            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);
            $data['active_test'] = $this->Active_test->getActiveTest($data['user_data']['user_id']);
            $time_end = strtotime($data['active_test']['time_end']);

            if ($time_end - time() < 0) {
                // if expired
                $data['new_at'] = [
                    'time_start' => null,
                    'time_end' => null,
                    'user_id' => $data['user_data']['user_id'],
                    'payment_id' => null,
                    'status' => 0,
                ];

                $this->Active_test->updateActiveTest($data['new_at']);

                $this->session->set_flashdata('danger_alert', 'Waktu anda telah habis, silahkan order kembali untuk mengikuti tes');
                redirect('report');
            } else {
                // if not expired
                $questions = $this->Test->getAllQuestion();
                $count = count($questions);

                $data['questions'] = array();
                for ($i = 1; $i <= $count; $i++) {
                    $index = 'question' . $i;
                    $question = $this->input->post($index);
                    $data['questions'][$index] = $question;
                }

                var_dump($data['questions']);
                die;

                // count scores
                $score['influence'] = 0;
                $score['dominance'] = 0;
                $score['compliance'] = 0;
                $score['steadiness'] = 0;

                foreach ($data['questions'] as $question) {
                    if ($question == 'i') {
                        $score['influence']++;
                    } elseif ($question == 'd') {
                        $score['dominance']++;
                    } else if ($question == 'c') {
                        $score['compliance']++;
                    } elseif ($question == 's') {
                        $score['steadiness']++;
                    }
                }

                $final_score = array_keys($score, max($score));
                $final_score = $final_score[0];

                // make report
                date_default_timezone_set("Asia/Jakarta");
                $data['report'] = [
                    'user_id' => $data['user_data']['user_id'],
                    'result' => $final_score,
                    'date_created' => date("Y-m-d H:i:s")
                ];
                $this->load->model('Report_model', 'Report');
                $this->Report->makeReport($data['report']);

                // update payment status
                $this->load->model('Payment_model', 'Payment');
                $this->Payment->updateStatus('finish', $data['active_test']['payment_id'], $data['user_data']['user_id']);

                // update active test
                $data['new_at'] = [
                    'payment_id' => null,
                    'time_start' => null,
                    'time_end' => null,
                    'user_id' => $data['user_data']['user_id'],
                    'status' => 0,
                ];
                $this->Active_test->updateActiveTest($data['new_at']);

                $this->session->set_flashdata('success_alert', 'Selamat anda telah menyelesaikan test!');
                redirect('report');
            }
        }
    }
}

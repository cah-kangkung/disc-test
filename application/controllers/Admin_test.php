<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
        $this->load->model('Test_model', 'Test');
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
            $data['questions'] = $this->Test->getAllQuestion();
            $data['count_questions'] = count($data['questions']);
            $data['title'] = "Halaman Soal";

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin_test/index');
            $this->load->view('templates/admin_footer');
        }
    }

    public function add_question()
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

            $this->form_validation->set_rules('influence', 'Influence', 'required|trim', ['required' => 'Influence harus diisi']);
            $this->form_validation->set_rules('dominance', 'Dominance', 'required|trim', ['required' => 'Dominance harus diisi']);
            $this->form_validation->set_rules('compliance', 'Compliance', 'required|trim', ['required' => 'Compliance harus diisi']);
            $this->form_validation->set_rules('steadiness', 'Steadiness', 'required|trim', ['required' => 'Steadiness harus diisi']);

            if ($this->form_validation->run() == false) {
                $data['title'] = "Halaman Tambah Soal";
                $this->load->view('templates/admin_headbar', $data);
                $this->load->view('templates/admin_sidebar');
                $this->load->view('templates/admin_topbar');
                $this->load->view('admin_test/add_question');
                $this->load->view('templates/admin_footer');
            } else {
                $data['question'] = [
                    'influence' => $this->input->post('influence'),
                    'dominance' => $this->input->post('dominance'),
                    'compliance' => $this->input->post('compliance'),
                    'steadiness' => $this->input->post('steadiness'),
                ];

                $this->Test->insertQuestion($data['question']);

                $this->session->set_flashdata('success_alert', 'Soal berhasil ditambahkan!');
                redirect('admin_test');
            }
        }
    }

    public function edit_question($id)
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
            $data['question'] = $this->Test->getQuestionByID($id);

            $this->form_validation->set_rules('influence', 'Influence', 'required|trim', ['required' => 'Influence harus diisi']);
            $this->form_validation->set_rules('dominance', 'Dominance', 'required|trim', ['required' => 'Dominance harus diisi']);
            $this->form_validation->set_rules('compliance', 'Compliance', 'required|trim', ['required' => 'Compliance harus diisi']);
            $this->form_validation->set_rules('steadiness', 'Steadiness', 'required|trim', ['required' => 'Steadiness harus diisi']);

            if ($this->form_validation->run() == false) {
                $data['title'] = "Halaman Tambah Soal";
                $this->load->view('templates/admin_headbar', $data);
                $this->load->view('templates/admin_sidebar');
                $this->load->view('templates/admin_topbar');
                $this->load->view('admin_test/edit_question');
                $this->load->view('templates/admin_footer');
            } else {
                $data['new_question'] = [
                    'influence' => $this->input->post('influence'),
                    'dominance' => $this->input->post('dominance'),
                    'compliance' => $this->input->post('compliance'),
                    'steadiness' => $this->input->post('steadiness'),
                    'id' => (int) $id
                ];

                $this->Test->editQuestion($data['new_question']);

                $this->session->set_flashdata('success_alert', 'Soal berhasil diubah!');
                redirect('admin_test');
            }
        }
    }

    public function delete_question($id)
    {
        $this->Test->deleteQuestion($id);
        redirect('admin_test');
    }

    public function edit_test()
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
            $data['test'] = $this->Test->getTestByID(1);

            $this->form_validation->set_rules('price', 'Price', 'required|trim', ['required' => 'Harga harus diisi']);
            $this->form_validation->set_rules('duration', 'Duration', 'required|trim', ['required' => 'Durasi harus diisi']);

            if ($this->form_validation->run() == false) {
                $data['title'] = "Halamn Edit Test";
                $this->load->view('templates/admin_headbar', $data);
                $this->load->view('templates/admin_sidebar');
                $this->load->view('templates/admin_topbar');
                $this->load->view('admin_test/edit_test');
                $this->load->view('templates/admin_footer');
            } else {
                $data['new_test'] = [
                    'price' => $this->input->post('price'),
                    'duration' => $this->input->post('duration'),
                ];

                $this->Test->udpateTest($data['new_test']);

                $this->session->set_flashdata('success_alert', 'Test berhasil di edit');
                redirect('admin_test/edit_test');
            }
        }
    }
}

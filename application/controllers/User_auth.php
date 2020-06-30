<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_authentication extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User');
    }

    public function index()
    {
        if ($this->session->userdata('loggedIn')) {
            redirect('user_authentication/accessBlocked');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false && isset($_GET['code']) == false) {
            $data['title'] = "Login Page";
            $this->load->view('user_authentication/index_login', $data);
        } else {
            // validation success
            $this->_login();
        }
    }

    private function _login()
    {
        // get login form input ($_POST) 
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // get all user information from the database
        $user = $this->User->getUserData($email);

        // check wether user is existed or not
        if ($user) {
            // check wether user is activated or not
            if ($user['status'] == 1) {
                // password check
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'user_email' => $user['E-mail'],
                        'user_role' => $user['role']
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_userdata('loggedIn', true);

                    if ($user['role'] == 1101 or $user['role'] == 1102) {
                        redirect('home');
                    }
                    if ($user['role'] == 1103) {
                        redirect('admin');
                    }
                    if ($user['role'] == 1111) {
                        redirect('super_admin');
                    }
                } else {
                    $this->session->set_flashdata('danger_alert', 'Wrong password!');
                    redirect('user_authentication');
                }
            } else {
                $this->session->set_flashdata('danger_alert', 'Email has not been activated');
                redirect('user_authentication');
            }
        } else {
            $this->session->set_flashdata('danger_alert', 'Email has not been registered');
            redirect('user_authentication');
        }
    }

    public function register()
    {
        if ($this->session->userdata('loggedIn')) {
            redirect('user_authentication/accessBlocked');
        }
        $this->form_validation->set_rules('firstName', 'First Name', 'required|trim');
        $this->form_validation->set_rules('lastName', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[accounts.account_email]', [
            'is_unique' => 'This email has already been registered'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration Page';
            $this->load->view('user_authentication/index_register', $data);
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'user_firstName' => htmlspecialchars($this->input->post('firstName', true)),
                'user_lastName' => htmlspecialchars($this->input->post('lastName', true)),
                'user_email' => htmlspecialchars($email),
                'user_password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'user_image' => 'default.jpg',
                'user_roles' => 1101,
                'user_status' => 0,
                'user_createdTime' => time()
            ];

            // preparing token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time(),
            ];


            $this->User->insert($data);
            $this->db->insert('user_token', $user_token);

            // send email verification
            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('success_alert', 'Your Account has been created. Please check your email for activation');
            redirect('user_authentication');
        }
    }


    private function _sendEmail($token, $type)
    {
        $this->load->library('email');

        $this->email->set_newline("\r\n");

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'cah.kangkung120199@gmail.com',
            'smtp_pass' => 'Anakayam123',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'newline' => "\r\n",
            'charset' => 'utf-8'
        ];

        $this->email->initialize($config);

        $this->email->from('cah.kangkung120199@gmail.com', 'Collase');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'user_authentication/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->User->getUserData($email);

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->db->set('account_status', 1);
                $this->db->where('account_email', $email);
                $this->db->update('accounts');

                $this->db->delete('user_token', ['email' => $email]);

                $this->session->set_flashdata('success_alert', $email . ' has been activated. Now Login!');
                redirect('user_authentication');
            } else {
                $this->session->set_flashdata('danger_alert', 'Account activation is failed! Error 100001');
                redirect('user_authentication');
            }
        } else {
            $this->session->set_flashdata('danger_alert', 'Account activation is failed!');
            redirect('user_authentication');
        }
    }

    public function logout()
    {
        // Remove token and user data from the session
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_role');
        $this->session->unset_userdata('loggedIn');

        $this->session->set_flashdata('success_alert', 'You have been logged out!');
        redirect('home');
    }

    public function accessBlocked()
    {
        $this->load->view('user_authentication/blocked');
    }
}

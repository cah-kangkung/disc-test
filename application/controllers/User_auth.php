<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
    }

    public function index()
    {
        if ($this->session->userdata('loggedIn')) {
            redirect('user_auth/accessBlocked');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email harus menggunakan alamat yang valid'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus diisi']);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Halaman Login";
            $this->load->view('auth/index_login', $data);
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
            if ($user['is_active'] == 1) {
                // password check
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'user_email' => $user['email'],
                        'user_role' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_userdata('loggedIn', true);

                    if ($user['role_id'] == 1101) {
                        redirect('admin_dashboard');
                    } elseif ($user['role_id'] == 1102) {
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('danger_alert', 'Password salah!');
                    redirect('user_auth');
                }
            } else {
                $this->session->set_flashdata('danger_alert', 'Email belum di aktivasi');
                redirect('user_auth');
            }
        } else {
            $this->session->set_flashdata('danger_alert', 'Email belum di registrasi');
            redirect('user_auth');
        }
    }

    public function register()
    {
        if ($this->session->userdata('loggedIn')) {
            redirect('user_authentication/accessBlocked');
        }
        $this->form_validation->set_rules('first_name', 'Nama Depan', 'required|trim', ['required' => 'Nama Depan harus diisi']);
        $this->form_validation->set_rules('last_name', 'Nama Belakang', 'required|trim', ['required' => 'Nama Belakang harus diisi']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email harus diisi',
            'is_unique' => 'Email ini sudah terdaftar, gunakan email lain',
            'valid_email' => 'Email harus menggunakan alamat yang valid'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter',
            'matches' => 'Password harus sama'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', ['required' => 'Password harus diisi']);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Registrasi';
            $this->load->view('auth/index_register', $data);
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'first_name' => htmlspecialchars($this->input->post('first_name', true)),
                'last_name' => htmlspecialchars($this->input->post('last_name', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'role_id' => 1102,
                'is_active' => 1,
                'date_created' => date('Y-m-d')
            ];

            /* preparing token (CURRENTLY DISABLED)
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time(),
            ];

            $this->db->insert('user_token', $user_token);

            send email verification
            $this->_sendEmail($token, 'verify'); */

            $this->User->insert($data);

            $this->session->set_flashdata('success_alert', 'Akun anda telah berhasil dibuat, silahkan masuk');
            redirect('user_auth');
        }
    }

    /* CURRENTLY DISABLED
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
    } */

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

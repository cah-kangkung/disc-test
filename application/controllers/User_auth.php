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
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim', ['required' => 'Nama lengkap harus diisi']);
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
            date_default_timezone_set("Asia/Jakarta");
            $data = [
                'full_name' => htmlspecialchars($this->input->post('full_name', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'no_hp' => null,
                'birth' => null,
                'sex' => null,
                'image' => 'default.jpg',
                'role_id' => 1102,
                'is_active' => 0,
                'is_completed' => 0,
                'date_created' => date('Y-m-d')
            ];

            // preparing token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time(),
            ];

            // send email verification
            $this->_sendEmail($token, 'verify');

            $this->User->insertToken($user_token);
            $this->User->insert($data);

            $this->session->set_flashdata('success_alert', 'Akun anda telah berhasil dibuat, cek email untuk aktivasi');
            redirect('user_auth');
        }
    }

    public function logout()
    {
        // Remove token and user data from the session
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_role');
        $this->session->unset_userdata('loggedIn');

        $this->session->set_flashdata('success_alert', 'Anda telah keluar!');
        redirect('home');
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'psikologistar@gmail.com',
            'smtp_pass' => 'tesdisc1',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('psikologistar@gmail.com', 'Psikologi Star');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link berikut untuk verifikasi akun anda : <a href="' . site_url() . 'user_auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktivasi</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik link berikut untuk mereset password anda : <a href="' . site_url() . 'user_auth/reset_password?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
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
            $user_token = $this->User->getUserToken($token);

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60)) {
                    $this->User->activateUser($email);
                    $this->User->deleteUserToken($email);

                    $this->load->model('Active_test_model', 'Active_test');
                    $data['active_user'] = [
                        'user_id' => $user['user_id'],
                        'time_start' => null,
                        'time_end' => null,
                        'status' => 0,
                    ];
                    $this->Active_test->insertActiveTest($data['active_user']);

                    $this->session->set_flashdata('success_alert', $email . ' berhasil diaktivasi, silahkan masuk');
                    redirect('user_auth');
                } else {
                    $this->User->deleteUser($email);
                    $this->User->deleteUserToken($email);

                    $this->session->set_flashdata('danger_alert', 'Aktivasi akun gagal! token expired');
                    redirect('user_auth');
                }
            } else {
                $this->session->set_flashdata('danger_alert', 'Aktivasi akun gagal! token tidak valid');
                redirect('user_auth');
            }
        } else {
            $this->session->set_flashdata('danger_alert', 'Aktivasi akun gagal! email tidak valid');
            redirect('user_auth');
        }
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email harus menggunakan alamat yang valid'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('auth/forgot_password', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->User->getUserData($email);

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->User->insertToken($user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('success_alert', 'Cek email anda untuk mereset password');
                redirect('user_auth/forgot_password');
            } else {
                $this->session->set_flashdata('danger_alert', 'Email tidak valid!');
                redirect('user_auth/forgot_password');
            }
        }
    }

    public function reset_password()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->User->getUserData($email);

        if ($user) {
            $user_token = $this->User->getUserToken($token);

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->change_password();
                } else {
                    $this->User->deleteUserToken($email);

                    $this->session->set_flashdata('danger_alert', 'Reset password gagal! token expired');
                    redirect('user_auth');
                }
            } else {
                $this->session->set_flashdata('danger_alert', 'Reset password gagal! token tidak valid');
                redirect('user_auth');
            }
        } else {
            $this->session->set_flashdata('danger_alert', 'Reset password gagal! email tidak valid');
            redirect('user_auth');
        }
    }

    public function change_password()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('user_auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter',
            'matches' => 'Password harus sama'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Password harus diisi',
            'matches' => 'Password harus sama'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset password';
            $this->load->view('auth/change_password', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->User->updatePassword($email, $password);

            $this->session->unset_userdata('reset_email');

            $this->User->deleteUserToken($email);

            $this->session->set_flashdata('success_alert', 'Password telah berhasil di reset, silahkan masuk');
            redirect('user_auth');
        }
    }

    public function accessBlocked()
    {
        $this->load->view('user_auth/blocked');
    }
}

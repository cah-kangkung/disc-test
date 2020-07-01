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

    public function logout()
    {
        // Remove token and user data from the session
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_role');
        $this->session->unset_userdata('loggedIn');

        $this->session->set_flashdata('success_alert', 'You have been logged out!');
        redirect('home');
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => '#DONT FORGOT TO FILL THIS#',
            'smtp_pass' => '#DONT FORGOT TO FILL THIS#',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('#EMAIL#', '#NAMA PERUSAHAAN#');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link berikut untuk verifikasi akun anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktivasi</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik link berikut untuk mereset password anda : <a href="' . base_url() . 'auth/reset_password?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
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
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('auth');
        }
    }

    public function accessBlocked()
    {
        $this->load->view('user_authentication/blocked');
    }
}

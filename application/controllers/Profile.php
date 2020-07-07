<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
    }

    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_authentication');
        } else {
            if ($this->session->userdata('user_role') == 1101) {
                redirect('admin_dashboard');
            }
            // get all user information from the database
            $email = $this->session->userdata('user_email');
            $data['user_data'] = $this->User->getUserData($email);

            $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim', ['required' => 'Nama Lengkap harus diisi']);
            $this->form_validation->set_rules('no_hp', 'Nomor Seluler', 'required|trim|numeric', ['required' => 'Nomor Seluler harus diisi']);
            $this->form_validation->set_rules('birth', 'Tanggal Lahir', 'required|trim', ['required' => 'Tanggal lahir harus diisi']);
            $this->form_validation->set_rules('sex', 'Jenis Kelamin', 'required|trim', ['required' => 'Jenis kelamin harus diisi']);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/user_header_two', $data);
                $this->load->view('profile/index');
                $this->load->view('templates/user_footer');
            } else {
                $data['new_data'] = [
                    'full_name' => htmlspecialchars($this->input->post('full_name', true)),
                    'email' => $this->input->post('email'),
                    'no_hp' => $this->input->post('no_hp'),
                    'birth' => $this->input->post('birth'),
                    'sex' => $this->input->post('sex')
                ];

                // checking if there is a picture to be uploaded
                $upload_profile_picture = $_FILES['image']['name'];
                $old_image = $data['user_data']['image'];
                if ($upload_profile_picture) {
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/img/profile-pictures/';
                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'assets/images/profile-picture/' . $old_image);
                        }
                        $new_image = $this->upload->data('file_name');
                        $data['new_data']['image'] = $new_image;
                    } else {
                        echo $this->upload->diplay_errors();
                    }
                } else {
                    $data['new_data']['image'] = $old_image;
                }

                $this->User->updateUserData($data['new_data']);

                $this->session->set_flashdata('success_alert', 'Your profile have been update!');
                redirect('profile');
            }
        }
    }

    public function change_password()
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

            $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim', ['required' => 'Masukan password lama']);
            $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]', [
                'required' => 'Masukan password baru',
                'min_length' => 'Password minimal 6 karakter',
                'matches' => 'Password tidak sama',
            ]);
            $this->form_validation->set_rules('new_password2', 'Repeat New Password', 'required|trim|matches[new_password1]', [
                'required' => 'Ulangi password baru',
                'matches' => 'Password tidak sama',
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/user_header_two', $data);
                $this->load->view('profile/change_password');
                $this->load->view('templates/user_footer');
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');

                if (!password_verify($current_password, $data['user_data']['password'])) {
                    $this->session->set_flashdata('danger_alert', 'Password lama salah!');
                    redirect('profile/change_password');
                } else {
                    if ($current_password == $new_password) {
                        $this->session->set_flashdata('danger_alert', "Password baru tidak boleh sama dengan passorw lama");
                        redirect('profile/change_password');
                    } else {
                        // password sudah mantab
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                        $email = $data['user_data']['email'];
                        $this->User->updatePassword($email, $password_hash);

                        $this->session->set_flashdata('success_alert', "Password telah berhasil diubah");
                        redirect('profile');
                    }
                }
            }
        }
    }
}

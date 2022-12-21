<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Authm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['BukuModel', 'UserModel', 'BookingModel']);
    }

    public function index()
    {
        $this->_login();
    }

    public function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->UserModel->cekUser(['email' => $email])->row_array();

        // Cek jika ada user
        if ($user) {
            if ($user['is_active'] == 1) {
                // Jika ada cek passwordnya
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'id_user' => $user['id'],
                        'name' => $user['name']
                    ];
                    // Masukan $data kedalam session
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">Yeay, Berhasil Login!. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('member/home');
                } else {
                    //Pesan jika password salah
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">Oops! Email atau Password salah. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('member/home');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Oops! User Belum Diaktifasi Oleh Admin. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('member/home');
            }
        } else {
            // Jika email belum ada
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">Oops! Email atau Password salah. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('member/home');
        }
    }

    // Fungsi Daftar Member
    public function daftar()
    {
        $this->form_validation->set_rules('name', 'Name', 'required', [
            'required' => 'Nama Belum diis!!'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'valid_email' => 'Email Tidak Benar!!',
            'required' => 'Email Belum diisi!!',
            'is_unique' => 'Email Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Tidak Sama!!',
            'min_length' => 'Password Terlalu Pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

        $email = $this->input->post('email', true);
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($email),
            'image' => 'default.png',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role' => 'member',
            'is_active' => 1,
            'date_created' => time()
        ];
        $this->UserModel->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun anggota anda sudah dibuat.</div>');
        redirect('member/home');
    }

    // Fungsi Logout
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');

        //Pesan logout berhasil dan akan dikembalikan kehalaman auth/login
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
           Berhasil logout.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );

        redirect('member/home');
    }
}

// End of Authm

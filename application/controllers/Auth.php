<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email' && 'role' == 'admin')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Email tidak valid!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->UserModel->cekUser(['email' => $email])->row_array();

        // Cek jika ada user
        if ($user) {
            // Jika ada cek passwordnya
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'id' => $user['id']
                ];
                // Masukan $data kedalam session
                $this->session->set_userdata($data);

                if ($user['role'] == 'admin') {
                    // Jika berhasil
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Login!. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('dashboard');
                } else if ($user['role'] == 'member') {
                    //Pesan jika member masuk ke admin
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">Selamat Datang Member. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('member/home');
                }
            } else {
                //Pesan jika password salah
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">Oops! Email atau Password salah. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                $this->load->view('auth/login');
            }
        } else {
            // Jika email belum ada
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">Oops! Email tidak ada. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );

            $this->load->view('auth/login');
        }
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

        redirect('auth');
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MyProfile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProfileModel', 'profile');
    }

    public function index()
    {
        $where = $this->session->userdata('id_user');
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id_buku and bo.id_user='$where'")->num_rows();

        $data['title'] = 'My Profile';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();

        // foreach ($user as $a) {
        //     $data = [
        //         'image' => $user['image'],
        //         'user' => $user['name'],
        //         'email' => $user['email'],
        //         'date_created' => $user['date_created'],
        //     ];
        // }
        $this->load->view('templates/member/header', $data);
        $this->load->view('member/profile/index', $data);
        $this->load->view('templates/member/modal');
        $this->load->view('templates/member/footer', $data);
    }

    public function editProfile()
    {
        $data['title'] = 'My Profile';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'trim|required', [
            'required' => 'Nama harus diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/member/header', $data);
            $this->load->view('member/profile/index', $data);
            // $this->load->view('templates/member/modal');
            $this->load->view('templates/member/footer', $data);
        } else {
            // jika ada gambar yang di upload
            $uploadImage = $_FILES['image']['name'];

            if ($uploadImage) {
                $config['upload_path']   = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '1024';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) { // ngambil dari name img
                    $oldImage = $data['user']['image']; // ngambil dari data diatas, tabel user field image
                    if ($oldImage != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $oldImage);
                    }
                    $newImage = $this->upload->data('file_name');
                    $this->db->set('image', $newImage);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // hanya ubah nama
            $this->profile->ubahProfile();
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Yeay, Berhasil Ubah Profile. 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('member/myProfile');
        }
    }

    // Ubah Password Member
    public function ubahPassword()
    {
        $data['title'] = 'My Profile';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('currentpassword', 'Password Lama', 'trim|required', [
            'required' => 'Password Lama harus diisi!'
        ]);
        $this->form_validation->set_rules('newpassword1', 'New Password', 'trim|required|min_length[8]|matches[newpassword2]', [
            'required'   => 'Password Baru harus diisi!',
            'min_length' => 'Minimal 8 karakter!',
            'matches'    => 'Password Baru tidak sama!'
        ]);
        $this->form_validation->set_rules('newpassword2', 'New Password', 'trim|required|min_length[8]|matches[newpassword1]', [
            'required'   => 'Password Baru harus diisi!',
            'min_length' => 'Minimal 8 karakter!',
            'matches'    => 'Password Baru tidak sama!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('profile/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->profile->ubahPassword();
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Yeay, Berhasil Ubah Password. 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('member/myProfile');
        }
    }
}

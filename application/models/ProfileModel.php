<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProfileModel extends CI_Model
{
    public function ubahProfile()
    {
        $email = $this->input->post('email');
        $nama = $this->input->post('name', true);

        $this->db->set('name', $nama);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function ubahPassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $currentPassword = $this->input->post('currentpassword');
        $newPassword     = $this->input->post('newpassword1');

        if (!password_verify($currentPassword, $data['user']['password'])) {
            // Kalau password salah
            $this->session->set_flashdata(
                'message',
                'gagal.'
            );
            redirect('Profile');
        } else {
            if ($currentPassword == $newPassword) {
                // Kalau password lama dan baru sama
                $this->session->set_flashdata(
                    'message',
                    'gagal.'
                );
                redirect('Profile');
            } else {
                // Kalau berhasil
                $passwordHash   = password_hash($newPassword, PASSWORD_DEFAULT);

                $this->db->set('password', $passwordHash);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('user');
            }
        }
    }
}

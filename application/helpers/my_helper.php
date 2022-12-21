<?php
function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!! </div>');
        if ($ci->session->userdata('role') == 'admin') {
            redirect('dashboard');
        } else {
            redirect('member/home');
        }
    } else {
        $role = $ci->session->userdata('role');
        $id_user = $ci->session->userdata('id_user');
    }
}

function cek_user()
{
    $ci = get_instance();
    $role = $ci->session->userdata('role');
    if ($role != 'admin') {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Oops! Bukan Admin, Akses Tidak Diizinkan. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('member/home');
    }
}

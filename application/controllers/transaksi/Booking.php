<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');
date_default_timezone_set('Asia/Jakarta');

class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['UserModel', 'BukuModel', 'PinjamModel']);
        cek_login();
        cek_user();
    }

    public function index()
    {
        $data['title'] = "Daftar Booking";
        $data['user'] = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['booking'] = $this->db->query("select*from booking")->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/booking/daftar-booking', $data);
        $this->load->view('templates/footer');
    }

    public function bookingDetail()
    {
        $id_booking = $this->uri->segment(4);
        $data['title'] = "Booking Detail";
        $data['user'] = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();

        $data['agt_booking'] = $this->db->query("select*from booking b, user u where b.id_user=u.id and b.id_booking='$id_booking'")->result_array();

        $data['detail'] = $this->db->query("select*from booking_detail d, buku b where d.id_buku=b.id_buku and d.id_booking='$id_booking'")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/booking/detail-booking', $data);
        $this->load->view('templates/footer');
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['UserModel', 'BukuModel', 'PinjamModel', 'BookingModel']);
        cek_login();
        cek_user();
    }

    public function index()
    {
        $data['title']  = "Data Peminjaman";
        $data['user']   = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['pinjam'] = $this->PinjamModel->joinData();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/pinjam/data-pinjam', $data);
        $this->load->view('templates/footer');
    }

    public function pinjamAct()
    {
        $id_booking     = $this->uri->segment(4);
        $lama           = $this->input->post('lama', TRUE);
        $bo             = $this->db->query("SELECT*FROM booking WHERE id_booking='$id_booking'")->row();
        $tglsekarang    = date('Y-m-d');
        $no_pinjam      = $this->BookingModel->kodeOtomatis('pinjam', 'no_pinjam');
        $databooking    = [
            'no_pinjam'         => $no_pinjam,
            'id_booking'        => $id_booking,
            'tgl_pinjam'        => $tglsekarang,
            'id_user'           => $bo->id_user,
            'tgl_kembali'       => date('Y-m-d', strtotime('+' . $lama . ' days', strtotime($tglsekarang))),
            'tgl_pengembalian'  => '0000-00-00',
            'status'            => 'Pinjam',
            'total_denda'       => 0
        ];

        $this->PinjamModel->simpanPinjam($databooking);
        $this->PinjamModel->simpanDetail($id_booking, $no_pinjam);
        $denda = $this->input->post('denda', TRUE);
        $this->db->query("update pinjam_detail set denda='$denda'");

        //hapus Data booking yang bukunya sudah diambil untuk dipinjam
        $this->PinjamModel->deleteData('booking', ['id_booking' => $id_booking]);
        $this->PinjamModel->deleteData('booking_detail', ['id_booking' => $id_booking]);

        //update dibooking dan dipinjam pada tabel buku saat buku yang dibooking diambil untuk dipinjam
        $this->db->query("UPDATE buku, pinjam_detail SET buku.dipinjam=buku.dipinjam+1, buku.dibooking=buku.dibooking-1 WHERE buku.id_buku=pinjam_detail.id_buku AND pinjam_detail.no_pinjam='$no_pinjam'");

        $this->session->set_flashdata('message', 'Disimpan');
        redirect(base_url('transaksi/pinjam'));
    }

    public function ubahStatus()
    {
        $id_buku    = $this->uri->segment(4);
        $no_pinjam  = $this->uri->segment(5);
        $where      = ['id_buku' => $this->uri->segment(4),];
        $tgl        = date('Y-m-d');
        $status     = 'Kembali';

        //update status menjadi kembali pada saat buku dikembalikan
        $this->db->query("UPDATE pinjam, pinjam_detail SET pinjam.status='$status', pinjam.tgl_pengembalian='$tgl' WHERE pinjam_detail.id_buku='$id_buku' AND pinjam.no_pinjam='$no_pinjam'");

        //update stok dan dipinjam pada tabel buku
        $this->db->query("UPDATE buku, pinjam_detail SET buku.dipinjam=buku.dipinjam-1, buku.stok=buku.stok+1 WHERE buku.id_buku=pinjam_detail.id_buku AND pinjam_detail.no_pinjam='$no_pinjam'");

        $this->session->set_flashdata('message', 'Buku Kembali.');
        redirect(base_url('transaksi/pinjam'));
    }
}

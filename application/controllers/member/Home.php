<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        $this->load->model(['BukuModel', 'UserModel', 'BookingModel']);
    }

    public function index()
    {
        $data = [
            'title' => "Katalog Buku",
            'buku' => $this->BukuModel->getBuku()->result(),
        ];

        $keyword = $this->input->post('keyword');
        if ($keyword) {
            $data = [
                'title' => "Daftar Buku",
                'buku' => $this->BukuModel->search()
            ];
        }

        /**Untuk Tombol Info Booking**/
        $where = $this->session->userdata('id_user');
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id_buku and bo.id_user='$where'")->num_rows();

        //jika sudah login dan jika belum login
        if ($this->session->userdata('email')) {
            // Cek email dari session
            $data['user'] = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/member/header', $data);
            $this->load->view('member/buku/daftarbuku', $data);
            $this->load->view('templates/member/modal');
            $this->load->view('templates/member/footer', $data);
        } else {
            $data['pengunjung'] = 'Pengunjung';
            $this->load->view('templates/member/header', $data);
            $this->load->view('member/buku/daftarbuku', $data);
            $this->load->view('templates/member/modal');
            $this->load->view('templates/member/footer', $data);
        }
    }

    public function detailBuku()
    {
        $id = $this->uri->segment(4);
        $buku = $this->BukuModel->joinKategoriBuku(['buku.id_buku' => $id])->result();

        $data['pengunjung'] = "Pengunjung";
        $data['title'] = "Detail Buku";
        $data['user'] = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        foreach ($buku as $fields) {
            $data['judul_buku'] = $fields->judul_buku;
            $data['pengarang'] = $fields->pengarang;
            $data['penerbit'] = $fields->penerbit;
            $data['nama_kategori'] = $fields->nama_kategori;
            $data['tahun_terbit'] = $fields->tahun_terbit;
            $data['isbn'] = $fields->isbn;
            $data['image'] = $fields->image;
            $data['dipinjam'] = $fields->dipinjam;
            $data['dibooking'] = $fields->dibooking;
            $data['stok'] = $fields->stok;
            $data['deskripsi'] = $fields->deskripsi;
            $data['id'] = $id;
        }

        /**Untuk Tombol Info Booking**/
        $where = $this->session->userdata('id_user');
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id_buku and bo.id_user='$where'")->num_rows();

        $this->load->view('templates/member/header', $data);
        $this->load->view('member/buku/detailbuku', $data);
        $this->load->view('templates/member/modal');
        $this->load->view('templates/member/footer', $data);
    }
}

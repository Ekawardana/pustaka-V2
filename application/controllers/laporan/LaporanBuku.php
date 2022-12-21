<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class LaporanBuku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('KategoriModel', 'kategori');
        $this->load->library('datatables');
        cek_login();
        cek_user();
    }

    public function index()
    {
        $data['title'] = 'Laporan Data Buku';
        $data['user'] = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['button'] = "Index";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/buku/laporan-buku', $data);
        $this->load->view('templates/footer');
        $this->load->view('laporan/buku/laporan-buku_js', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->BukuModel->json();
    }

    // Laporan Print
    public function laporan_print()
    {
        $data['buku']       = $this->BukuModel->get_all();
        $data['kategori']   = $this->KategoriModel->get_all();

        $this->load->view('laporan/buku/laporan_print', $data);
    }

    // Laporan Pdf
    public function laporan_pdf()
    {
        $data['buku']       = $this->BukuModel->get_all();

        $data['title'] = "Laporan Buku";
        $this->load->view('laporan/buku/laporan_pdf', $data);

        $this->load->library('dompdf_gen');

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan_buku.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }

    // Laporan Excel
    public function laporan_excel()
    {
        $data = array(
            'title' => 'Laporan Buku E-Perpus',
            'buku'  => $this->BukuModel->get_all()
        );

        $this->load->view('laporan/buku/laporan_excel', $data);
    }
}

/** End Of Controller Laporan Buku */

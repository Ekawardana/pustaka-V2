<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class LaporanAnggota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        cek_login();
        cek_user();
    }

    public function index()
    {
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Anggota';
        $data['button'] = "Index";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('laporan/anggota/laporan-anggota', $data);
        $this->load->view('templates/footer');
        $this->load->view('laporan/anggota/laporan-anggota_js', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->UserModel->json();
    }

    // Laporan Print
    public function laporan_print()
    {
        $this->db->where('role', 'member');
        $data['user'] = $this->UserModel->get_all();

        $this->load->view('laporan/anggota/laporan_print', $data);
    }

    // Laporan Pdf
    public function laporan_pdf()
    {
        $this->db->where('role', 'member');
        $data['user']       = $this->UserModel->get_all();

        $data['title'] = "Laporan Anggota";
        $this->load->view('laporan/anggota/laporan_pdf', $data);

        $this->load->library('dompdf_gen');

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan_Anggota.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }

    // Laporan Pdf
    public function laporan_excel()
    {
        $this->db->where('role', 'member');
        $data['user'] = $this->UserModel->get_all();
        $data['title'] = "Laporan Anggota";

        $this->load->view('laporan/anggota/laporan_excel', $data);
    }
}

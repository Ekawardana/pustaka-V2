<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class LaporanPinjam extends CI_Controller
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
        $data['title'] = 'Laporan Pinjam';
        $data['user'] = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['button'] = "Index";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/peminjaman/laporan-pinjam', $data);
        $this->load->view('templates/footer');
        $this->load->view('laporan/peminjaman/laporan-pinjam_js', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->PinjamModel->json();
    }

    // Print Laporan
    public function laporan_print()
    {
        $data['pinjam'] = $this->db->query("select * from pinjam p,pinjam_detail d,
         buku b,user u where d.id_buku=b.id_buku and p.id_user=u.id
         and p.no_pinjam=d.no_pinjam")->result_array();


        $this->load->view('laporan/peminjaman/laporan_print', $data);
    }

    // Laporan PDF
    public function laporan_pdf()
    {
        $data['pinjam'] = $this->db->query("select * from pinjam p,pinjam_detail d,
         buku b,user u where d.id_buku=b.id_buku and p.id_user=u.id
         and p.no_pinjam=d.no_pinjam")->result_array();

        $data['title'] = "Laporan Peminjaman";
        $this->load->view('laporan/peminjaman/laporan_pdf', $data);

        $this->load->library('dompdf_gen');

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan_peminjaman.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }

    public function laporan_excel()
    {
        $data['pinjam'] = $this->db->query("select * from pinjam p,pinjam_detail d,
         buku b,user u where d.id_buku=b.id_buku and p.id_user=u.id
         and p.no_pinjam=d.no_pinjam")->result_array();
        $data['title'] = 'Laporan Peminjaman';


        $this->load->view('laporan/peminjaman/laporan_excel', $data);
    }
}

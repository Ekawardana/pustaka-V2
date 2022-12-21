<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');
date_default_timezone_set('Asia/Jakarta');

class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('BookingModel', 'booking');
        $this->load->model('UserModel', 'user');
    }

    public function index()
    {
        // Ambil id dari url
        $id = ['bo.id_user' => $this->uri->segment(4)];

        $id_user = $this->session->userdata('id_user');
        $data['booking'] = $this->booking->joinOrder($id)->result();
        $user = $this->user->cekUser(['email' => $this->session->userdata('email')])->row_array();

        foreach ($user as $a) {
            $data = [
                'image' => $user['image'],
                'user' => $user['name'],
                'email' => $user['email'],
                'date_created' => $user['date_created']
            ];
        }

        // Variabel $dataBooking isinya diambil dari jumlah data booking berdasarkan id user
        $dataBooking = $this->booking->showtemp(['id_user' => $id_user])->num_rows();

        // Cek jika data booking kurang dari 1
        if ($dataBooking < 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
            redirect(base_url('member/home'));
        } else {
            // Jika ada datanya
            $data['temp'] = $this->db->query("select image, judul_buku, penulis, penerbit, tahun_terbit,id_buku from temp where id_user='$id_user'")->result_array();
        }

        /**Untuk Tombol Info Booking**/
        $where = $this->session->userdata('id_user');
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id_buku and bo.id_user='$where'")->num_rows();

        $data['user'] = $this->user->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Keranjang';
        $this->load->view('templates/member/header', $data);
        $this->load->view('member/booking/data-booking', $data);
        $this->load->view('templates/member/modal');
        $this->load->view('templates/member/footer', $data);
    }

    // Tambah Booking
    public function tambahBooking()
    {
        $id_buku = $this->uri->segment(4);
        //memilih data buku yang untuk dimasukkan ke tabel temp/keranjang melalui variabel $isi
        $data = $this->db->query("SELECT*FROM buku WHERE id_buku='$id_buku'")->row();
        //berupa data2 yang akan disimpan ke dalam tabel temp/keranjang
        $isi = [
            'id_buku' => $id_buku,
            'judul_buku' => $data->judul_buku,
            'id_user' => $this->session->userdata('id_user'),
            'email_user' => $this->session->userdata('email'),
            'tgl_booking' => date('Y-m-d H:i:s'),
            'image' => $data->image,
            'penulis' => $data->pengarang,
            'penerbit' => $data->penerbit,
            'tahun_terbit' => $data->tahun_terbit
        ];

        //cek apakah buku yang di klik booking sudah ada di keranjang
        $userid = $this->session->userdata('id_user');
        $temp = $this->booking->getDataWhere('temp', ['id_buku' => $id_buku, 'id_user' => $userid])->num_rows();

        //cek jika sudah memasukan 3 buku untuk dibooking dalam keranjang
        $tempuser = $this->db->query("SELECT*FROM temp WHERE id_user ='$userid'")->num_rows();

        //cek jika masih ada booking buku yang belum diambil
        $databooking = $this->db->query("SELECT*FROM booking WHERE id_user='$userid'")->num_rows();
        if ($databooking > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert">Masih Ada booking buku sebelumnya yang belum diambil.<br> Ambil Buku yang dibooking atau tunggu 1x24 Jam untuk bisa booking kembali </div>');
            redirect(base_url('member/home'));
        }

        //jika buku yang diklik booking sudah ada di keranjang
        if ($temp > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert">Buku ini Sudah anda booking </div>');
            redirect(base_url('member/home'));
        }

        //jika buku yang akan dibooking sudah mencapai 3 item
        if ($tempuser == 2) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert">Booking Buku Tidak Boleh Lebih dari 2</div>');
            redirect(base_url('member/home'));
        }

        //membuat tabel temp jika belum ada
        $this->booking->createTemp();
        $this->booking->insertData('temp', $isi);

        //message ketika berhasil memasukkan buku ke keranjang
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-message" role="alert">Buku berhasil ditambahkan ke keranjang </div>');
        redirect(base_url('member/home'));
    }

    // Hapus Booking pada member
    public function hapusbooking()
    {
        $id_buku = $this->uri->segment(4);
        $id_user = $this->session->userdata('id_user');

        $this->booking->deleteData(['id_buku' => $id_buku], 'temp');
        $kosong = $this->db->query("select*from temp where id_user='$id_user'")->num_rows();

        if ($kosong < 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-massege alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
            redirect(base_url('member/home'));
        } else {
            redirect(base_url('member/booking'));
        }
    }

    // Fungsi Ketika button "selesaikan booking" di klik
    public function bookingSelesai($where)
    {

        //mengupdate stok dan dibooking di tabel buku saat proses booking diselesaikan
        $this->db->query("UPDATE buku, temp SET buku.dibooking=buku.dibooking+1, buku.stok=buku.stok-1 WHERE buku.id_buku=temp.id_buku AND temp.id_user='$where'");

        $tglsekarang = date('Y-m-d');
        $isibooking = [
            'id_booking' => $this->booking->kodeOtomatis('booking', 'id_booking'),
            'tgl_booking' => date('Y-m-d H:m:s'),
            'batas_ambil' => date('Y-m-d', strtotime('+2 days', strtotime($tglsekarang))),
            'id_user' => $where
        ];

        //menyimpan ke tabel booking dan detail booking, dan mengosongkan tabel temporari
        $this->booking->insertData('booking', $isibooking);
        $this->booking->simpanDetail($where);
        $this->booking->kosongkanData('temp');
        redirect(base_url() . 'member/booking/info');
    }

    // Fungsi info ketika booking selesai
    public function info()
    {
        $where = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('name');
        $data['title'] = "Selesai Booking";
        $data['useraktif'] = $this->user->cekUser(['id' => $this->session->userdata('id_user')])->result();

        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id_buku and bo.id_user='$where'")->result_array();

        $data['user'] = $this->user->cekUser(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/member/header', $data);
        $this->load->view('member/booking/info-booking', $data);
        $this->load->view('templates/member/modal');
        $this->load->view('templates/member/footer', $data);
    }

    public function pdf()
    {
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('name');
        $data['useraktif'] = $this->UserModel->cekUser(['id' => $this->session->userdata('id_user')])->result();

        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id_buku and bo.id_user='$id_user'")->result_array();


        $data['title'] = "Bukti Booking";
        $this->load->view('member/booking/bukti-booking', $data);

        $this->load->library('dompdf_gen');

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("bukti-booking-$id_user.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }
}

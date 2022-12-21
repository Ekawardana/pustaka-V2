<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buku extends CI_Controller
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
        cek_user();
        $data['title'] = 'Buku';
        $data['button'] = "Index";
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/buku/buku_list', $data);
        $this->load->view('templates/footer');
        $this->load->view('master/buku/buku_js', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->BukuModel->json();
    }

    public function detail($id)
    {
        cek_user();
        $byid = $this->BukuModel->get_by_id($id);
        if ($byid) {
            $data = array(
                'button' => 'Detail',
                'id_buku'       => $byid->id_buku,
                'id_kategori'   => $byid->id_kategori,
                'nama_kategori' => $byid->nama_kategori,
                'judul_buku'    => $byid->judul_buku,
                'pengarang'     => $byid->pengarang,
                'penerbit'      => $byid->penerbit,
                'tahun_terbit' => $byid->tahun_terbit,
                'isbn'         => $byid->isbn,
                'stok'         => $byid->stok,
                'dibooking'    => $byid->dibooking,
                'dipinjam'     => $byid->dipinjam,
                'image'        => $byid->image,
                'deskripsi'    => $byid->deskripsi,
            );

            $data['title'] = 'Detail Buku';
            $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/buku/buku_detail', $data);
            $this->load->view('templates/footer');
            $this->load->view('master/buku/buku_js', $data);
        } else {
            $this->session->set_flashdata('message', 'tidak ditemukan.');
            redirect(site_url('master/Buku'));
        }
    }

    // Tambah Buku
    public function add()
    {
        cek_user();
        $data = array(
            'button'        => 'Tambah',
            'action'        => site_url('master/Buku/add_action'),
            'id_buku'       => set_value('id_buku'),
            'id_kategori'   => set_value('id_kategori'),
            'judul_buku'     => set_value('judul_buku'),
            'pengarang'      => set_value('pengarang'),
            'penerbit'       => set_value('penerbit'),
            'tahun_terbit'   => set_value('tahun_terbit'),
            'isbn'           => set_value('isbn'),
            'stok'           => set_value('stok'),
            'image'          => set_value('image'),
            'image'          => set_value('image'),
        );
        $data['title'] = 'Tambah Buku';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('master/buku/buku_form', $data);
        $this->load->view('templates/footer');
        $this->load->view('master/buku/buku_js', $data);
    }
    public function add_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->add();
        } else {
            $idKategori               = $this->input->post('id_kategori', TRUE);
            $last_insert_id_kategori  = $idKategori;

            // validasi Kategori, jika tidak ada, maka insert baru
            $this->load->model('KategoriModel', 'km');
            if (empty($this->km->get_by_id($idKategori))) {
                $this->km->insert(['nama_kategori' => $idKategori]);
                $last_insert_id_kategori = $this->db->insert_id();
            }
            $data = array(
                'judul_buku' => ucwords($this->input->post('judul_buku', TRUE)),
                'id_kategori' => $last_insert_id_kategori,
                'pengarang' => ucwords($this->input->post('pengarang', TRUE)),
                'penerbit' => ucwords($this->input->post('penerbit', TRUE)),
                'tahun_terbit' => ucwords($this->input->post('tahun_terbit', TRUE)),
                'isbn' => ucwords($this->input->post('isbn', TRUE)),
                'stok' => ucwords($this->input->post('stok', TRUE)),
                'dipinjam' => 0,
                'dibooking' => 0,
                'image' => "default.png",
            );
            // var_dump($data);
            // die;
            $this->BukuModel->insert($data);
            $this->session->set_flashdata('message', 'dibuat.');
            redirect(site_url('master/Buku'));
        }
    }

    // Fungsi Update
    public function update($id)
    {
        cek_user();
        $byid = $this->BukuModel->get_by_id($id);

        if ($byid) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('master/Buku/update_action'),
                'id_buku'     => set_value('id_buku', $byid->id_buku),
                'id_kategori'   => set_value('id_kategori', $byid->id_kategori),
                'nama_kategori' => set_value('nama_kategori', $byid->nama_kategori),
                'judul_buku'    => set_value('judul_buku', $byid->judul_buku),
                'pengarang'     => set_value('pengarang', $byid->pengarang),
                'penerbit'      => set_value('penerbit', $byid->penerbit),
                'tahun_terbit'  => set_value('tahun_terbit', $byid->tahun_terbit),
                'isbn'          => set_value('isbn', $byid->isbn),
                'stok'          => set_value('stok', $byid->stok),
                'image'         => set_value('image', $byid->image),
                'deskripsi'     => set_value('deskripsi', $byid->deskripsi),
            );
            $data['title'] = 'Ubah Buku';
            $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('master/buku/buku_form', $data);
            $this->load->view('templates/footer');
            $this->load->view('master/buku/buku_js');
        } else {
            $this->session->set_flashdata('message', 'tidak ditemukan.');
            redirect(site_url('master/Buku'));
        }
    }
    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id_buku', TRUE));
        } else {
            $data = array(
                'judul_buku' => ucwords($this->input->post('judul_buku', TRUE)),
                'id_kategori' => ucwords($this->input->post('id_kategori', TRUE)),
                'pengarang' => ucwords($this->input->post('pengarang', TRUE)),
                'penerbit' => ucwords($this->input->post('penerbit', TRUE)),
                'tahun_terbit' => ucwords($this->input->post('tahun_terbit', TRUE)),
                'isbn' => ucwords($this->input->post('isbn', TRUE)),
                'stok' => ucwords($this->input->post('stok', TRUE)),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', TRUE)),
            );

            $this->BukuModel->update($this->input->post('id_buku', TRUE), $data);
            // cek apakah ada image
            if (file_exists($_FILES['image']['tmp_name'])) {
                // lakukan update image
                $this->_ubahImage();
            }

            $this->session->set_flashdata('message', 'di Edit.');
            redirect(site_url('master/Buku'));
        }
    }

    // Fungsi hapus
    public function delete($id)
    {
        cek_user();
        if ($this->BukuModel->delete($id)) {
            $this->session->set_flashdata('message', 'Dihapus.');
            redirect(site_url('master/Buku'));
        } else {
            $this->session->set_flashdata('message', 'tidak ditemukan.');
            redirect(site_url('master/Buku'));
        }
    }

    // Fungsi ubah gambar
    public function _ubahImage()
    {
        //name dari form edit
        $inputfile      = 'image';
        $id_buku        = $this->input->post('id_buku');
        $prevImage      = $this->db->get_where('buku', ['id_buku' => $id_buku])->result_array()[0]['image'];


        // PATH IMAGE DISIMPAN
        $config['upload_path']      = './assets/img/buku/';
        $config['file_ext_tolower'] = TRUE;
        $config['overwrite']        = TRUE;
        $config['encrypt_name']     = TRUE;
        $config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG|JPEG';
        $config['max_size']         = '2048';
        $config['max_width']        = '2048';
        $config['max_height']       = '2048';

        $this->load->library('upload', $config);

        $this->upload->initialize($config);


        // jika upload gagal
        if (!$this->upload->do_upload($inputfile)) {
            return $this->upload->display_errors();
        } else {
            // delete previous image
            if ($prevImage != 'default.png') {
                unlink(FCPATH . 'assets/img/buku/' . $prevImage);
            }
            $namaBaru = $this->upload->data('file_name');
            // lakukan update nama file ke table buku
            $this->db->update('buku', ["image" => $namaBaru], ['id_buku' => $id_buku]);
            return $this->db->affected_rows();
        }
    }

    // Rules validation
    public function _rules()
    {
        // set messages
        $this->form_validation->set_message('required', '%s tidak boleh kosong.');
        $this->form_validation->set_message('min_length', '%s terlalu pendek.');
        $this->form_validation->set_message('max_length', '%s terlalu panjang.');

        // set rules
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[4]');
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|min_length[4]');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|min_length[4]');

        $this->form_validation->set_rules('id_buku', 'id_buku', 'trim|numeric');
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'trim|numeric|min_length[3]|max_length[4]');
        $this->form_validation->set_rules('isbn', 'ISBN', 'trim|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'trim|numeric');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

// End Buku Controller

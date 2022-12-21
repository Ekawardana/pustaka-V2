<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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

        $data['title'] = 'Kategori';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/kategori/kategori_list', $data);
        $this->load->view('master/kategori/kategori_js');
        $this->load->view('templates/footer');
    }

    // Menampilkan datatables
    public function json()
    {
        header('Content-type: application/json');
        echo $this->kategori->json();
    }

    // Create data
    public function add()
    {

        $data = array(
            'button' => 'Tambah',
            'action' => site_url('master/Kategori/add_action'),
            'id_kategori'     => set_value('id_kategori'),
            'nama_kategori' => set_value('nama_kategori'),
        );

        $data['title'] = 'Kategori';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/kategori/kategori_form', $data);
        $this->load->view('master/kategori/kategori_js');
        $this->load->view('templates/footer');
    }
    public function add_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $data = array(
                'nama_kategori' => ucwords($this->input->post('nama_kategori', TRUE))
            );
            $this->kategori->insert($data);
            $this->session->set_flashdata('message', 'dibuat.');
            redirect(site_url('master/Kategori'));
        }
    }

    // Update data
    public function update($id)
    {

        $byid = $this->kategori->get_by_id($id);

        if ($byid) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('master/Kategori/update_action'),
                'id_kategori'   => set_value('id_kategori',  $byid->id_kategori),
                'nama_kategori' => set_value('nama_kategori', $byid->nama_kategori),
            );
            $data['title'] = 'Kategori';
            $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/kategori/kategori_form', $data);
            $this->load->view('master/kategori/kategori_js');
            $this->load->view('templates/footer');
        }
    }
    public function update_action()
    {
        $id_kategori = $this->input->post('id_kategori', TRUE);

        // get previous kategori
        $kategori_awal = $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row_array()['nama_kategori'];

        if (trim($this->input->post('nama_kategori')) != $kategori_awal) {
            $is_unique =  '|is_unique[kategori.nama_kategori]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules('nama_kategori', 'Kategori', 'trim|required' . $is_unique);
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id_kategori', true));
        } else {
            $data = array(
                'nama_kategori' => ucwords($this->input->post('nama_kategori', TRUE)),
            );

            $this->kategori->update($this->input->post('id_kategori', TRUE), $data);
            $this->session->set_flashdata('message', 'di Edit.');
            redirect(site_url('master/Kategori'));
        }
    }

    // Delete
    public function delete($id)
    {

        if ($this->kategori->delete($id)) {
            $this->session->set_flashdata('message', 'dihapus.');
            redirect(site_url('master/Kategori'));
        } else {
            $this->session->set_flashdata('message', 'Data Sedang Digunakan.');
            redirect(site_url('master/Kategori'));
        }
    }

    // Rules validation
    private function _rules()
    {
        // set messages
        $this->form_validation->set_message('required', '%s tidak boleh kosong.');
        $this->form_validation->set_message('is_unique', '%s sudah ada.');

        // set rules
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|is_unique[kategori.nama_kategori]');
        $this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    // kategori untuk select2 di form edit buku
    public function getKategori()
    {
        $search         = trim($this->input->post('search'));
        $page           = $this->input->post('page');
        $resultCount    = 5; //perPage
        $offset         = ($page - 1) * $resultCount;

        // total data yg sudah terfilter
        $count = $this->db
            ->like('nama_kategori', $search)
            ->from('kategori')
            ->count_all_results();

        // tampilkan data per page
        $get = $this->db
            ->select('id_kategori, nama_kategori')
            ->like('nama_kategori', $search)
            ->get('kategori', $resultCount, $offset)
            ->result_array();

        $endCount = $offset + $resultCount;

        $morePages = $endCount < $count ? true : false;

        $data = [];
        $key    = 0;
        foreach ($get as $kategori) {
            $data[$key]['id']   = $kategori['id_kategori'];
            $data[$key]['text'] = ucwords($kategori['nama_kategori']);
            $key++;
        }
        $result = [
            "results"        => $data,
            "count_filtered" => $count,
            "pagination"     => [
                "more" => $morePages
            ]
        ];
        echo json_encode($result);
    }
}

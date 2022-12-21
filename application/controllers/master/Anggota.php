<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anggota extends CI_Controller
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
        $this->load->view('master/anggota/anggota_list', $data);
        $this->load->view('templates/footer');
        $this->load->view('master/anggota/anggota_js', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->UserModel->json();
    }

    public function detail($id)
    {
        $byid = $this->UserModel->get_by_id($id);

        if ($byid) {
            $data = array(
                'id' => $byid->id,
                'name' => $byid->name,
                'email' => $byid->email,
                'password' => $byid->password,
                'image' => $byid->image,
                'role' => $byid->role,
                'is_active' => $byid->is_active,
                'date_created' => $byid->date_created
            );
            $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = 'Anggota';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/anggota/anggota_detail', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan.');
            redirect(site_url('master/Anggota'));
        }
    }

    // Add data anggota
    public function add()
    {
        $data = array(
            'button'        => 'Tambah',
            'action'        => site_url('master/Anggota/add_action'),
            'id'            => set_value('id'),
            'name'          => set_value('name'),
            'email'         => set_value('email'),
            'image'         => set_value('image'),
            'password'      => set_value('password'),
            'role'          => set_value('role'),
            'is_active'     => set_value('is_active'),
            'date_created'  => set_value('date_created'),
        );
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Anggota';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('master/anggota/anggota_form', $data);
        $this->load->view('templates/footer');
        $this->load->view('master/anggota/anggota_js', $data);
    }
    public function add_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $data = array(
                'name'          => htmlspecialchars($this->input->post('name', TRUE)),
                'email'         => htmlspecialchars($this->input->post('email', TRUE)),
                'image'         => "default.png",
                'password'      => password_hash(htmlspecialchars($this->input->post('password', TRUE)), PASSWORD_DEFAULT),
                'role'          => htmlspecialchars($this->input->post('role', TRUE)),
                'is_active'     => 1,
                'date_created'  => time(),
            );
            $this->UserModel->insert($data);
            $this->session->set_flashdata('message', 'dibuat.');
            redirect(site_url('master/Anggota'));
        }
    }

    public function update($id)
    {
        cek_user();
        $byid = $this->UserModel->get_by_id($id);

        $data = array(
            'button' => 'Edit',
            'action' => site_url('master/Anggota/update_action'),
            'id' => $byid->id,
            'name' => $byid->name,
            'email' => $byid->email,
            'password' => $byid->password,
            'image' => $byid->image,
            'role' => $byid->role,
            'is_active' => $byid->is_active,
            'date_created' => $byid->date_created
        );
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Anggota';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('master/anggota/anggota_form', $data);
        $this->load->view('templates/footer');
        $this->load->view('master/anggota/anggota_js', $data);
    }
    public function update_action()
    {
        $password = $this->input->post('password', TRUE);
        $id = $this->input->post('id', TRUE);

        // Email Awal
        $original_email = $this->db->get_where('user', ['id' => $id])->row_array()['email'];

        // Cek apakah input email baru
        if (trim($this->input->post('email')) != $original_email) {
            $is_unique =  '|is_unique[user.email]';
        } else {
            $is_unique =  '';
        }

        // set rules jika ganti password diisi
        if (!empty($pw)) {
            $this->form_validation->set_rules('konfirmasi_ganti_password', 'Konfirmasi Ganti Password', 'required');
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[konfirmasi_ganti_password]');
        }

        // set rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required' . $is_unique);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        // set messages
        $this->form_validation->set_message('required', '%s tidak boleh kosong.');
        $this->form_validation->set_message('is_unique', '%s sudah digunakan!');
        $this->form_validation->set_message('min_length', '%s minimal 8 karakter!');
        $this->form_validation->set_message('matches', '%s harus sama!');
        $this->form_validation->set_message('email', '%s email sudah ada!');

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', TRUE));
        } else {
            // jika password tidak diganti
            if (empty($password)) {
                $data = array(
                    'email' => htmlspecialchars($this->input->post('email', TRUE)),
                    'name' => htmlspecialchars($this->input->post('name', TRUE)),
                    'role' => htmlspecialchars($this->input->post('role', TRUE)),
                    'is_active' => htmlspecialchars($this->input->post('is_active', TRUE))
                );
            } else {
                $data = array(
                    'email'      => htmlspecialchars($this->input->post('email', TRUE)),
                    'password'   => password_hash(htmlspecialchars($this->input->post('password', TRUE)), PASSWORD_DEFAULT),
                    'name'       => htmlspecialchars($this->input->post('name', TRUE)),
                    'role'       => htmlspecialchars($this->input->post('role', TRUE)),
                    'is_active' => htmlspecialchars($this->input->post('is_active', TRUE))
                );
            }
            // cek apakah ada image
            if (file_exists($_FILES['image']['tmp_name'])) {
                // lakukan update image
                $this->ubahImage();
            }

            $this->UserModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'di Edit.');
            redirect(site_url('master/Anggota'));
        }
    }

    // delete
    public function delete($id)
    {
        $byid = $this->UserModel->get_by_id($id);

        if ($byid) {
            $this->UserModel->delete($id);
            $this->session->set_flashdata('message', 'dihapus.');
            redirect(site_url('master/Anggota'));
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan.');
            redirect(site_url('master/Anggota'));
        }
    }


    public function ubahImage()
    {

        //name dari form edit
        $inputfile      = 'image';
        $id    = $this->input->post('id');
        $prevImage      = $this->db->get_where('user', ['id' => $id])->result_array()[0]['image'];


        // PATH IMAGE DISIMPAN
        $config['upload_path']      = './assets/img/anggota/';
        $config['file_ext_tolower'] = TRUE;
        $config['overwrite']        = TRUE;
        $config['encrypt_name']     = TRUE;
        $config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG|JPEG';
        $config['max_size']         = '1024';
        $config['max_width']        = '1024';
        $config['max_height']       = '1024';

        $this->load->library('upload', $config);

        $this->upload->initialize($config);


        // jika upload gagal
        if (!$this->upload->do_upload($inputfile)) {
            return $this->upload->display_errors();
        } else {
            // delete previous image
            if ($prevImage != 'default.png') {
                unlink(FCPATH . 'assets/img/profile/' . $prevImage);
            }
            $namaBaru = $this->upload->data('file_name');
            // lakukan update nama file ke table anggota
            $this->db->update('user', ["image" => $namaBaru], ['id' => $id]);
            return $this->db->affected_rows();
        }
    }


    // Rules validation
    public function _rules()
    {
        // set messages
        $this->form_validation->set_message('required', '%s tidak boleh kosong.');
        $this->form_validation->set_message('email', '%s email sudah ada.');

        // set rules
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        cek_login();
        cek_user();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user']  = $this->UserModel->cekUser(['email' => $this->session->userdata('email')])->row_array();

        $this->db->where('role', 'admin');
        $data['admin'] = $this->UserModel->getUser()->result_array();
        $data['role'] = $this->db->get('role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}

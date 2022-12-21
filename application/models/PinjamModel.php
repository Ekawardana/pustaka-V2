<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PinjamModel extends CI_Model
{

    public $table = 'pinjam';
    public $id = 'id_pinjam';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function json()
    {
        $this->datatables->select(
            '
            id_pinjam,
            name,
            judul_buku,
            tgl_pinjam,
            tgl_kembali,
            tgl_pengembalian,
            total_denda,
            status
            '
        );
        $this->datatables->from($this->table . ' p')
            ->join('user u', 'p.id_user=u.id')
            ->join('pinjam_detail pd', "pd.no_pinjam=p.no_pinjam")
            ->join('buku b', 'pd.id_buku=b.id_buku');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id_pinjam', $q);
        $this->db->or_like('no_pinjam', $q);
        $this->db->or_like('name', $q);
        $this->db->or_like('judul_buku', $q);
        $this->db->or_like('tgl_pinjam', $q);
        $this->db->or_like('tgl_kembali', $q);
        $this->db->or_like('tgl_pengembalian', $q);
        $this->db->or_like('total_denda', $q);
        $this->db->or_like('status', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pinjam', $q);
        $this->db->or_like('no_pinjam', $q);
        $this->db->or_like('name', $q);
        $this->db->or_like('judul_buku', $q);
        $this->db->or_like('tgl_pinjam', $q);
        $this->db->or_like('tgl_kembali', $q);
        $this->db->or_like('tgl_pengembalian', $q);
        $this->db->or_like('total_denda', $q);
        $this->db->or_like('status', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    //manipulasi table pinjam
    public function simpanPinjam($data)
    {
        $this->db->insert('pinjam', $data);
    }

    public function selectData($table, $where)
    {
        return $this->db->get($table, $where);
    }

    public function updateData($data, $where)
    {
        $this->db->update('pinjam', $data, $where);
    }

    public function deleteData($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }

    public function joinData()
    {
        $this->db->select('*');
        $this->db->from('pinjam');
        $this->db->join('pinjam_detail', 'pinjam_detail.no_pinjam=pinjam.no_pinjam', 'Right');
        return $this->db->get()->result_array();
    }

    //manip tabel detai pinjam
    public function simpanDetail($idbooking, $nopinjam)
    {
        $sql = "INSERT INTO pinjam_detail (no_pinjam,id_buku) 
                     SELECT pinjam.no_pinjam,booking_detail.id_buku 
                       FROM pinjam, booking_detail 
                      WHERE booking_detail.id_booking=$idbooking AND pinjam.no_pinjam='$nopinjam'";
        $this->db->query($sql);
    }
}
/* End of file PinjamModel.php */

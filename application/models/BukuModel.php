<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BukuModel extends CI_Model
{
    public $table = 'buku';
    public $id = 'id_buku';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select(
            '
            buku.id_buku,
            buku.judul_buku,
            buku.image,
            k.nama_kategori,
            buku.pengarang,
            buku.penerbit,
            buku.stok,
            dipinjam
            '
        );
        $this->datatables->from('buku');
        //this line for join
        $this->datatables->join('kategori k', 'k.id_kategori = buku.id_kategori');
        $this->datatables->join('pinjam_detail pd', 'pd.id_buku = buku.id_buku', 'left');
        $this->datatables->join('pinjam p', 'p.no_pinjam = pd.no_pinjam', 'left');
        $this->datatables->group_by('buku.id_buku');

        // row action
        $this->datatables->add_column(
            'action',
            '<div class="btn-group">' .
                form_open('master/Buku/detail/$1') .
                form_button(['type' => 'submit', 'title' => 'Detail', 'class' => 'btn btn-primary', 'content' => '<i class="fas fa-info-circle"> </i>']) .
                form_close() . "&nbsp;" .
                form_open('master/Buku/update/$1') .
                form_button(['type' => 'submit', 'title' => 'Edit', 'class' => 'btn btn-warning', 'content' => '<i class="fas fa-pencil-alt"> </i>']) .
                form_close() . "&nbsp;" .
                form_open('master/Buku/delete/$1') .
                form_button(['type' => 'submit', 'title' => 'Hapus', 'class' => 'btn btn-danger'], '<i class="fas fa-trash-alt"> </i>', 'onclick="javascript: return confirm(\'Yakin ingin hapus ?\')"') .
                form_close() . '</div>',

            'id_buku'
        );
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
        $this->db->like('id_buku', $q);
        $this->db->or_like('id_kategori', $q);
        $this->db->or_like('judul_buku', $q);
        $this->db->or_like('pengarang', $q);
        $this->db->or_like('penerbit', $q);
        $this->db->or_like('image', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_buku', $q);
        $this->db->or_like('id_kategori', $q);
        $this->db->or_like('judul_buku', $q);
        $this->db->or_like('pengarang', $q);
        $this->db->or_like('penerbit', $q);
        $this->db->or_like('image', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->datatables->join('kategori k', 'k.id_kategori = buku.id_kategori');
        return $this->db->get($this->table)->row();
    }

    // Insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // Update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // Delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return TRUE;
    }
    // End Buku Model Admin 


    // Buku Model Member
    public function getBuku()
    {
        // Panggil Semua Buku
        return $this->db->get('buku');
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('buku');
        return $this->db->get()->row($field);
    }

    //join
    public function joinKategoriBuku($where)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('kategori k', 'k.id_kategori = buku.id_kategori', 'right');
        $this->db->where($where);
        return $this->db->get();
    }

    public function search($keyword = null)
    {
        if ($keyword = $this->input->post('keyword')) {
            $this->db->like('judul_buku', $keyword);
            $this->db->or_like('pengarang', $keyword);
            $this->db->or_like('penerbit', $keyword);
            return $this->db->get('buku')->result();
        }
    }
}

// End Of Buku Model

<?php defined('BASEPATH') or exit('No direct script access allowed');

class ModelKriteria extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // tabel
        $this->table = 'kriteria';
    }

    public function semua()
    {
        return $this->db->get_where($this->table)->result_array();
    }

    public function satuData($id)
    {
        $this->db->where('id_kriteria', $id);
        return $this->db->get_where($this->table)->row_object();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function ubah($id, $data)
    {
        $this->db->where('id_kriteria', $id);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id)
    {
        $this->db->where('id_kriteria', $id);
        return $this->db->delete($this->table);
    }
}

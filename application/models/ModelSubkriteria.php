<?php defined('BASEPATH') or exit('No direct script access allowed');

class ModelSubkriteria extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // tabel
        $this->table = 'subkriteria';
    }

    public function semua($kriteria = null, $nama_subkriteria = null, $distinct = false)
    {
        $this->db->join('kriteria', 'kriteria.id_kriteria=subkriteria.id_kriteria');
        if ($kriteria != null) {
            $this->db->where('subkriteria.id_kriteria', $kriteria);
        }
        if ($nama_subkriteria != null) {
            $this->db->where('subkriteria.nama_subkriteria', $nama_subkriteria);
        }
        if ($distinct == true) {
            $this->db->order_by('subkriteria.id_subkriteria', 'ASC');
            $this->db->group_by('subkriteria.nama_subkriteria');
        }
        return $this->db->get_where($this->table)->result_array();
    }

    public function satuData($id)
    {
        $this->db->join('kriteria', 'kriteria.id_kriteria=subkriteria.id_kriteria');
        $this->db->where('id_subkriteria', $id);
        return $this->db->get_where($this->table)->row_object();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function ubah($id, $data)
    {
        $this->db->where('id_subkriteria', $id);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id)
    {
        $this->db->where('id_subkriteria', $id);
        return $this->db->delete($this->table);
    }
}

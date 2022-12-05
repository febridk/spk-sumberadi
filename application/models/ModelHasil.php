<?php defined('BASEPATH') or exit('No direct script access allowed');

class ModelHasil extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // tabel
        $this->table = 'hasil';
    }

    public function semua()
    {
        $this->db->join('alternatif', 'alternatif.id_alternatif=hasil.id_alternatif');
        return $this->db->get_where($this->table)->result_array();
    }

    public function satuData($id = null, $alternatif = null)
    {
        $this->db->join('alternatif', 'alternatif.id_alternatif=hasil.id_alternatif');
        if ($id != null) {
            $this->db->where('hasil.id_hasil', $id);
        }
        if ($alternatif != null) {
            $this->db->where('hasil.id_alternatif', $alternatif);
        }
        return $this->db->get_where($this->table)->row_object();
    }

    public function dataTertinggi()
    {
        $this->db->join('alternatif', 'alternatif.id_alternatif=hasil.id_alternatif');
        $this->db->order_by('hasil.nilai', 'DESC');
        return $this->db->get_where($this->table)->row_object();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function ubah($id, $data)
    {
        $this->db->where('id_hasil', $id);
        return $this->db->update($this->table, $data);
    }

    public function kosongkan()
    {
        $this->db->truncate($this->table);
    }
}

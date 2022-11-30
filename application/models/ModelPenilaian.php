<?php defined('BASEPATH') or exit('No direct script access allowed');

class ModelPenilaian extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // tabel
        $this->table = 'penilaian';
    }

    public function semua($kriteria = null, $alternatif = null, $subkriteria = null)
    {
        $this->db->join('alternatif', 'alternatif.id_alternatif=penilaian.id_alternatif');
        $this->db->join('kriteria', 'kriteria.id_kriteria=penilaian.id_kriteria');
        $this->db->join('subkriteria', 'subkriteria.id_subkriteria=penilaian.id_subkriteria');
        $this->db->join('bobot', 'bobot.id_bobot=penilaian.id_bobot', 'LEFT');
        if ($kriteria != null) {
            $this->db->where('penilaian.id_kriteria', $kriteria);
        }
        if ($alternatif != null) {
            $this->db->where('penilaian.id_alternatif', $alternatif);
        }
        if ($subkriteria != null) {
            $this->db->where('penilaian.id_subkriteria', $subkriteria);
        }
        $this->db->order_by('penilaian.id_penilaian', 'ASC');
        return $this->db->get_where($this->table)->result_array();
    }

    public function satuData($id = null, $alternatif = null, $kriteria = null, $subkriteria = null)
    {
        $this->db->join('alternatif', 'alternatif.id_alternatif=penilaian.id_alternatif');
        $this->db->join('kriteria', 'kriteria.id_kriteria=penilaian.id_kriteria');
        $this->db->join('subkriteria', 'subkriteria.id_subkriteria=penilaian.id_subkriteria');
        if ($id != null) {
            $this->db->where('penilaian.id_penilaian', $id);
        }
        if ($kriteria != null) {
            $this->db->where('penilaian.id_kriteria', $kriteria);
        }
        if ($alternatif != null) {
            $this->db->where('penilaian.id_alternatif', $alternatif);
        }
        if ($subkriteria != null) {
            $this->db->where('penilaian.id_subkriteria', $subkriteria);
        }
        return $this->db->get_where($this->table)->row_object();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function ubah($id, $data)
    {
        $this->db->where('id_penilaian', $id);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id)
    {
        $this->db->where('id_penilaian', $id);
        return $this->db->delete($this->table);
    }
}

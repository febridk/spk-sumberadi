<?php defined('BASEPATH') or exit('No direct script access allowed');

class ModelBobot extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // tabel
        $this->table = 'bobot';
    }

    public function semua()
    {
        return $this->db->get_where($this->table)->result_array();
    }

    public function satuData($selisih)
    {
        $this->db->where('selisih', $selisih);
        return $this->db->get_where($this->table)->row_object();
    }
}

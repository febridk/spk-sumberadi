<?php defined('BASEPATH') or exit('No direct script access allowed');

class ModelLogin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'pengguna';
    }

    public function periksaPengguna($username)
    {
        $this->db->where('username', $username);
        return $this->db->get($this->table)->row_object();
    }
}

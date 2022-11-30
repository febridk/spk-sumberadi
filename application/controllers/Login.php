<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model('ModelLogin', 'Login');
    }

    public function index()
    {
        // periksa sesi aktif
        if (getSession()) {
            redirect('dashboard');
        }

        $data = [
            'namaHalaman' => 'Login'
        ];

        // validasi login
        $this->validasi();

        if ($this->form_validation->run() == false) {
            $this->load->view('login', $data);
        } else {
            // memproses login pengguna
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);

            // mencocokan data yg diinputkan pada form dan data pada database
            $periksaPengguna = $this->Login->periksaPengguna($username);

            // jika data yg diinputkan ditemukan pada database
            if ($periksaPengguna) {
                // jika data password yg diinputkan sesuai pada database
                if (password_verify($password, $periksaPengguna->password)) {

                    // membuat session login
                    $data = [
                        'username'  => $periksaPengguna->username,
                        'nama'      => $periksaPengguna->nama_pengguna
                    ];

                    $this->session->set_userdata($data);

                    $this->session->set_flashdata(
                        'success',
                        'Halo, Selamat datang di SPK Sumberadi'
                    );

                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata(
                        'warning',
                        'Password tidak sesuai!'
                    );

                    redirect('login');
                }
            } else {
                $this->session->set_flashdata(
                    'warning',
                    'Username tidak ditemukan!'
                );

                redirect('login');
            }
        }
    }

    public function keluar()
    {
        // untuk menghapus sesi
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');

        $this->session->set_flashdata(
            'success',
            'Anda berhasil keluar'
        );

        redirect('login');
    }

    private function validasi()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|regex_match[/^([a-z ])+$/i]|trim',
            [
                'required' => 'Username tidak boleh kosong',
                'regex_match' => 'Username hanya dalam alfabet'
            ]
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]|max_length[16]|trim',
            [
                'required' => 'Password tidak boleh kosong',
                'min_length' => 'Password minimal 6 huruf',
                'max_length' => 'Password maksimal 16 huruf'
            ]
        );
    }
}

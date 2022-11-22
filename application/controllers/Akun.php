<?php defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// periksa sesi aktif
		if (!getSession()) {
			$this->session->set_flashdata(
				'error',
				'Sesi anda telah berakhir, silahkan login kembali!'
			);
			redirect('login');
		}
	}

	public function index()
	{
		redirect(base_url());
	}

	public function ubahpassword()
	{
		$data = [
			'namaHalaman' => 'Ubah Password'
		];

		$this->load->view('ubahpassword', $data);
	}
}

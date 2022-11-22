<?php defined('BASEPATH') or exit('No direct script access allowed');

class Hasilakhir extends CI_Controller
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
		$data = [
			'namaHalaman' => 'Hasil Akhir'
		];

		$this->load->view('hasilakhir/list', $data);
	}
}

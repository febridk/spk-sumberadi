<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
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
			'namaHalaman' => 'Penilaian'
		];

		$this->load->view('penilaian/list', $data);
	}
}

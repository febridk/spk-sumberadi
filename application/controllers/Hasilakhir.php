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

		$this->namaHalaman = 'Hasil Akhir';
		$this->urlHalaman = base_url() . 'hasilakhir';

		// model
		$this->load->model('ModelHasil', 'Hasil');
	}

	public function index()
	{
		$data = [
			'namaHalaman'	=> $this->namaHalaman,
			'dataHasil'		=> $this->Hasil->semua(),
			'dataTertinggi' => $this->Hasil->dataTertinggi()
		];

		$this->load->view('hasilakhir/list', $data);
	}
}

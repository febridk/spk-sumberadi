<?php defined('BASEPATH') or exit('No direct script access allowed');

class Resetdata extends CI_Controller
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

		if (getSession()->level != 'Karyawan') {
			$this->session->set_flashdata(
				'error',
				'Anda tidak memiliki akses!'
			);

			redirect('dashboard');
		}

		// model
		$this->load->model('ModelHasil', 'Hasil');
		$this->load->model('ModelPenilaian', 'Penilaian');
	}

	public function index()
	{
		// kosongkan data
		$this->Hasil->kosongkan();
		$this->Penilaian->kosongkan();

		$this->session->set_flashdata(
			'success',
			'Data berhasil direset.'
		);

		redirect(base_url() . 'dashboard');
	}
}

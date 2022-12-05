<?php defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
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

		$this->namaHalaman = 'Alternatif';
		$this->urlHalaman = base_url() . 'alternatif';

		// model
		$this->load->model('ModelAlternatif', 'Alternatif');
	}

	public function index()
	{
		$data = [
			'namaHalaman'		=> $this->namaHalaman,
			'dataAlternatif'	=> $this->Alternatif->semua()
		];

		$this->load->view('alternatif/list', $data);
	}

	public function tambah()
	{
		$data = [
			'namaHalaman' => $this->namaHalaman
		];

		$this->validasi();

		if ($this->form_validation->run() == false) {
			$this->load->view('alternatif/tambah', $data);
		} else {
			$dataTambah = [
				'nama_alternatif' => $this->input->post('nama_alternatif', TRUE)
			];

			$this->Alternatif->tambah($dataTambah);

			$this->session->set_flashdata(
				'success',
				'Data berhasil ditambahkan!'
			);

			redirect($this->urlHalaman);
		}
	}

	public function ubah($id = null)
	{
		$periksaId = $this->Alternatif->satuData($id);

		if ($periksaId) {
			$data = [
				'namaHalaman'	=> $this->namaHalaman,
				'alternatif'	=> $periksaId
			];

			$this->validasi();

			if ($this->form_validation->run() == false) {
				$this->load->view('alternatif/ubah', $data);
			} else {
				$dataUbah = [
					'nama_alternatif' => $this->input->post('nama_alternatif', TRUE)
				];

				$this->Alternatif->ubah($id, $dataUbah);

				$this->session->set_flashdata(
					'success',
					'Data berhasil diubah!'
				);

				redirect($this->urlHalaman);
			}
		} else {
			$this->session->set_flashdata(
				'warning',
				'Data tidak ditemukan!'
			);

			redirect($this->urlHalaman);
		}
	}

	public function hapus($id = null)
	{
		$periksaId = $this->Alternatif->satuData($id);

		if ($periksaId) {
			$hapus = $this->Alternatif->hapus($id);

			if ($hapus) {
				$this->session->set_flashdata(
					'success',
					'Data berhasil dihapus!'
				);
			} else {
				$this->session->set_flashdata(
					'warning',
					'Data tidak berhasil dihapus!'
				);
			}

			redirect($this->urlHalaman);
		} else {
			$this->session->set_flashdata(
				'warning',
				'Data tidak ditemukan!'
			);

			redirect($this->urlHalaman);
		}
	}

	private function validasi()
	{
		$this->form_validation->set_rules(
			'nama_alternatif',
			'Nama alternatif',
			'required|trim',
			[
				'required' => 'Nama alternatif tidak boleh kosong'
			]
		);
	}
}

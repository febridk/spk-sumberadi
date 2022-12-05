<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
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

		$this->namaHalaman = 'Kriteria';
		$this->urlHalaman = base_url() . 'kriteria';

		// model
		$this->load->model('ModelKriteria', 'Kriteria');
	}

	public function index()
	{
		$data = [
			'namaHalaman'	=> $this->namaHalaman,
			'dataKriteria'	=> $this->Kriteria->semua()
		];

		$this->load->view('kriteria/list', $data);
	}

	public function tambah()
	{
		$data = [
			'namaHalaman' => $this->namaHalaman
		];

		$this->validasi();

		if ($this->form_validation->run() == false) {
			$this->load->view('kriteria/tambah', $data);
		} else {
			$dataTambah = [
				'nama_kriteria'			=> $this->input->post('nama_kriteria', TRUE),
				'prosentase_kriteria'	=> $this->input->post('prosentase_kriteria', TRUE),
				'bobot_core'			=> $this->input->post('bobot_core', TRUE),
				'bobot_secondary'		=> $this->input->post('bobot_secondary', TRUE)
			];

			$this->Kriteria->tambah($dataTambah);

			$this->session->set_flashdata(
				'success',
				'Data berhasil ditambahkan!'
			);

			redirect($this->urlHalaman);
		}
	}

	public function ubah($id = null)
	{
		$periksaId = $this->Kriteria->satuData($id);

		if ($periksaId) {
			$data = [
				'namaHalaman'	=> $this->namaHalaman,
				'kriteria'		=> $periksaId
			];

			$this->validasi();

			if ($this->form_validation->run() == false) {
				$this->load->view('kriteria/ubah', $data);
			} else {
				$dataUbah = [
					'nama_kriteria'			=> $this->input->post('nama_kriteria', TRUE),
					'prosentase_kriteria'	=> $this->input->post('prosentase_kriteria', TRUE),
					'bobot_core'			=> $this->input->post('bobot_core', TRUE),
					'bobot_secondary'		=> $this->input->post('bobot_secondary', TRUE)
				];

				$this->Kriteria->ubah($id, $dataUbah);

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
		$periksaId = $this->Kriteria->satuData($id);

		if ($periksaId) {
			$hapus = $this->Kriteria->hapus($id);

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
			'nama_kriteria',
			'Nama kriteria',
			'required|trim',
			[
				'required' => 'Nama kriteria tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'prosentase_kriteria',
			'Prosentase',
			'required|is_natural_no_zero|trim',
			[
				'is_natural_no_zero' => 'Prosentase hanya dalam angka',
				'required' => 'Prosentase tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'bobot_core',
			'Bobot core',
			'required|is_natural_no_zero|trim',
			[
				'is_natural_no_zero' => 'Bobot core hanya dalam angka',
				'required' => 'Bobot core tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'bobot_secondary',
			'Bobot secondary',
			'required|is_natural_no_zero|trim',
			[
				'is_natural_no_zero' => 'Bobot secondary hanya dalam angka',
				'required' => 'Bobot secondary tidak boleh kosong'
			]
		);
	}
}

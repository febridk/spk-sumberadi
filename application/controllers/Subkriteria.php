<?php defined('BASEPATH') or exit('No direct script access allowed');

class Subkriteria extends CI_Controller
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

		$this->namaHalaman = 'Sub Kriteria';
		$this->urlHalaman = base_url() . 'subkriteria';

		// model
		$this->load->model('ModelKriteria', 'Kriteria');
		$this->load->model('ModelSubkriteria', 'Subkriteria');
	}

	public function index()
	{
		$data = [
			'namaHalaman'		=> $this->namaHalaman,
			'dataSubkriteria'	=> $this->Subkriteria->semua()
		];

		$this->load->view('subkriteria/list', $data);
	}

	public function tambah()
	{
		$data = [
			'namaHalaman'	=> $this->namaHalaman,
			'dataKriteria'	=> $this->Kriteria->semua()
		];

		$this->validasi();

		if ($this->form_validation->run() == false) {
			$this->load->view('subkriteria/tambah', $data);
		} else {
			$dataTambah = [
				'id_kriteria'		=> $this->input->post('id_kriteria', TRUE),
				'nama_subkriteria'	=> $this->input->post('nama_subkriteria', TRUE),
				'taget'				=> $this->input->post('taget', TRUE),
				'tipe'				=> $this->input->post('tipe', TRUE),
				'keterangan'		=> $this->input->post('keterangan', TRUE)
			];

			$this->Subkriteria->tambah($dataTambah);

			$this->session->set_flashdata(
				'success',
				'Data berhasil ditambahkan!'
			);

			redirect($this->urlHalaman);
		}
	}

	public function ubah($id = null)
	{
		$periksaId = $this->Subkriteria->satuData($id);

		if ($periksaId) {
			$data = [
				'namaHalaman'	=> $this->namaHalaman,
				'dataKriteria'	=> $this->Kriteria->semua(),
				'subkriteria'	=> $periksaId
			];

			$this->validasi();

			if ($this->form_validation->run() == false) {
				$this->load->view('subkriteria/ubah', $data);
			} else {
				$dataUbah = [
					'id_kriteria'		=> $this->input->post('id_kriteria', TRUE),
					'nama_subkriteria'	=> $this->input->post('nama_subkriteria', TRUE),
					'taget'				=> $this->input->post('taget', TRUE),
					'tipe'				=> $this->input->post('tipe', TRUE),
					'keterangan'		=> $this->input->post('keterangan', TRUE)
				];

				$this->Subkriteria->ubah($id, $dataUbah);

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
		$periksaId = $this->Subkriteria->satuData($id);

		if ($periksaId) {
			$this->Subkriteria->hapus($id);

			$this->session->set_flashdata(
				'success',
				'Data berhasil dihapus!'
			);

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
			'id_kriteria',
			'Nama kriteria',
			'required|is_natural_no_zero|trim',
			[
				'required' => 'Nama kriteria tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'nama_subkriteria',
			'Nama sub kriteria',
			'required|trim',
			[
				'required' => 'Nama sub kriteria tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'taget',
			'Target',
			'required|is_natural_no_zero|trim',
			[
				'is_natural_no_zero' => 'Target hanya dalam angka',
				'required' => 'Target tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'tipe',
			'Tipe',
			'required|trim',
			[
				'required' => 'Tipe tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'keterangan',
			'Keterangan',
			'required|trim',
			[
				'required' => 'Keterangan tidak boleh kosong'
			]
		);
	}
}

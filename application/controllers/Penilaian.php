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

		if (getSession()->level != 'Karyawan') {
			$this->session->set_flashdata(
				'error',
				'Anda tidak memiliki akses!'
			);

			redirect('dashboard');
		}

		$this->namaHalaman = 'Penilaian';
		$this->urlHalaman = base_url() . 'penilaian';

		// model
		$this->load->model('ModelAlternatif', 'Alternatif');
		$this->load->model('ModelKriteria', 'Kriteria');
		$this->load->model('ModelSubkriteria', 'Subkriteria');
		$this->load->model('ModelPenilaian', 'Penilaian');
	}

	public function index()
	{
		$data = [
			'namaHalaman'	=> 'Penilaian',
			'dataPenilaian'	=> $this->Penilaian->semua(),
		];

		$this->load->view('penilaian/list', $data);
	}

	public function subkriteria()
	{
		$id_kriteria = $this->input->post('id_kriteria', TRUE);

		$subkriteria = $this->Subkriteria->semua($id_kriteria, null, true);
		echo json_encode($subkriteria);
	}

	public function nilai()
	{
		$nama_subkriteria = $this->input->post('nama_subkriteria', TRUE);

		$nilai = $this->Subkriteria->semua(null, $nama_subkriteria, false);
		echo json_encode($nilai);
	}

	public function tambah()
	{
		$data = [
			'namaHalaman'		=> $this->namaHalaman,
			'dataAlternatif'	=> $this->Alternatif->semua(),
			'dataKriteria'		=> $this->Kriteria->semua()
		];

		$this->validasi();

		if ($this->form_validation->run() == false) {
			$this->load->view('penilaian/tambah', $data);
		} else {
			$idAlternatif = $this->input->post('id_alternatif', TRUE);
			$idKriteria = $this->input->post('id_kriteria', TRUE);
			$idSubkriteria = $this->input->post('id_subkriteria', TRUE);

			$periksaData = $this->Penilaian->satuData(null, $idAlternatif, $idKriteria, $idSubkriteria);

			if ($periksaData) {
				$dataTambah = [
					'id_alternatif'		=> $idAlternatif,
					'id_kriteria'		=> $idKriteria,
					'id_subkriteria'	=> $idSubkriteria
				];

				$this->Penilaian->tambah($dataTambah);

				$this->session->set_flashdata(
					'success',
					'Data berhasil ditambahkan!'
				);

				redirect($this->urlHalaman);
			} else {
				$this->session->set_flashdata(
					'warning',
					'Data tidak berhasil ditambahkan!'
				);

				redirect($this->urlHalaman . '/tambah');
			}
		}
	}

	public function ubah($id = null)
	{
		$periksaId = $this->Penilaian->satuData($id);

		if ($periksaId) {
			$data = [
				'namaHalaman'		=> $this->namaHalaman,
				'dataAlternatif'	=> $this->Alternatif->semua(),
				'dataKriteria'		=> $this->Kriteria->semua(),
				'penilaian'			=> $periksaId
			];

			$this->validasi();

			if ($this->form_validation->run() == false) {
				$this->load->view('penilaian/ubah', $data);
			} else {
				$dataUbah = [
					'id_alternatif'		=> $this->input->post('id_alternatif', TRUE),
					'id_kriteria'		=> $this->input->post('id_kriteria', TRUE),
					'id_subkriteria'	=> $this->input->post('id_subkriteria', TRUE)
				];

				$this->Penilaian->ubah($id, $dataUbah);

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
		$periksaId = $this->Penilaian->satuData($id);

		if ($periksaId) {
			$this->Penilaian->hapus($id);

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
			'id_alternatif',
			'Nama alternatif',
			'required|trim',
			[
				'required' => 'Nama alternatif tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'id_kriteria',
			'Kriteria',
			'required|is_natural_no_zero|trim',
			[
				'is_natural_no_zero' => 'Kriteria tidak sesuai',
				'required' => 'Kriteria tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'nama_subkriteria',
			'Sub kriteria',
			'required|trim',
			[
				'required' => 'Sub kriteria tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'id_subkriteria',
			'Nilai',
			'required|is_natural_no_zero|trim',
			[
				'is_natural_no_zero' => 'Nilai tidak sesuai',
				'required' => 'Nilai tidak boleh kosong'
			]
		);
	}
}

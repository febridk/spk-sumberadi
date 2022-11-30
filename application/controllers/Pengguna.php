<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
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

		if (getSession()->level != 'Kepala Dukuh') {
			$this->session->set_flashdata(
				'error',
				'Anda tidak memiliki akses!'
			);

			redirect('dashboard');
		}

		$this->namaHalaman = 'Pengguna';
		$this->urlHalaman = base_url() . 'pengguna';

		// model
		$this->load->model('ModelPengguna', 'Pengguna');
	}

	public function index()
	{
		$data = [
			'namaHalaman'	=> $this->namaHalaman,
			'dataPengguna'	=> $this->Pengguna->semua()
		];

		$this->load->view('pengguna/list', $data);
	}

	public function tambah()
	{
		$data = [
			'namaHalaman' => $this->namaHalaman
		];

		$this->validasi();

		if ($this->form_validation->run() == false) {
			$this->load->view('pengguna/tambah', $data);
		} else {
			$dataTambah = [
				'nama_pengguna'	=> $this->input->post('nama_pengguna', TRUE),
				'username'		=> $this->input->post('username', TRUE),
				'password'		=> password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
				'level'			=> $this->input->post('level', TRUE)
			];

			$this->Pengguna->tambah($dataTambah);

			$this->session->set_flashdata(
				'success',
				'Data berhasil ditambahkan!'
			);

			redirect($this->urlHalaman);
		}
	}

	public function ubah($id = null)
	{
		$periksaId = $this->Pengguna->satuData($id);

		if ($periksaId) {
			$data = [
				'namaHalaman'	=> $this->namaHalaman,
				'pengguna'		=> $periksaId
			];

			$this->validasi();

			if ($this->form_validation->run() == false) {
				$this->load->view('pengguna/ubah', $data);
			} else {
				$dataUbah = [
					'nama_pengguna'	=> $this->input->post('nama_pengguna', TRUE),
					'username'		=> $this->input->post('username', TRUE),
					'password'		=> password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
					'level'			=> $this->input->post('level', TRUE)
				];

				$this->Pengguna->ubah($id, $dataUbah);

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
		$periksaId = $this->Pengguna->satuData($id);

		if ($periksaId) {
			$this->Pengguna->hapus($id);

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
			'nama_pengguna',
			'Nama pengguna',
			'required|trim',
			[
				'required' => 'Nama pengguna tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|trim',
			[
				'required' => 'Username tidak boleh kosong'
			]
		);

		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|trim|min_length[6]|max_length[16]',
			[
				'required' => 'Password tidak boleh kosong',
				'min_length' => 'Password minimal 6 karakter',
				'max_length' => 'Password maksimal 16 karakter'
			]
		);

		$this->form_validation->set_rules(
			'level',
			'Level',
			'required|trim',
			[
				'required' => 'Level tidak boleh kosong'
			]
		);
	}
}

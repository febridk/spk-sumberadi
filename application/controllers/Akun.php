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

		$this->namaHalaman = 'Ubah Password';
		$this->urlHalaman = base_url() . 'ubahpassword';

		// model
		$this->load->model('ModelPengguna', 'Pengguna');
	}

	public function index()
	{
		redirect(base_url());
	}

	public function ubahpassword()
	{
		$data = [
			'namaHalaman' => $this->namaHalaman
		];

		$this->validasi();

		if ($this->form_validation->run() == false) {
			$this->load->view('ubahpassword', $data);
		} else {
			$passwordLama = $this->input->post('password_lama', TRUE);
			$passwordBaru = $this->input->post('password_baru', TRUE);

			$periksaPassword = password_verify($passwordLama, getSession()->password);

			if ($periksaPassword) {
				$data = [
					'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
				];

				$this->Pengguna->ubah(getSession()->id_pengguna, $data);

				// untuk menghapus sesi
				$this->session->unset_userdata('username');
				$this->session->unset_userdata('nama');

				$this->session->set_flashdata(
					'success',
					'Password berhasil diperbaharui!'
				);

				redirect('login');
			} else {
				$this->session->set_flashdata(
					'warning',
					'Password tidak sesuai!'
				);

				redirect($this->urlHalaman);
			}
		}
	}

	private function validasi()
	{
		$this->form_validation->set_rules(
			'password_lama',
			'Password lama',
			'required|trim|min_length[6]|max_length[16]',
			[
				'required' => 'Password lama tidak boleh kosong',
				'min_length' => 'Password lama minimal 6 karakter',
				'max_length' => 'Password lama maksimal 16 karakter'
			]
		);

		$this->form_validation->set_rules(
			'password_baru',
			'Password baru',
			'required|trim|min_length[6]|max_length[16]',
			[
				'required' => 'Password baru tidak boleh kosong',
				'min_length' => 'Password baru minimal 6 karakter',
				'max_length' => 'Password baru maksimal 16 karakter'
			]
		);

		$this->form_validation->set_rules(
			'konfirmasi_password',
			'Konfirmasi password baru',
			'required|trim|min_length[6]|max_length[16]|matches[password_baru]',
			[
				'required' => 'Konfirmasi password baru tidak boleh kosong',
				'min_length' => 'Konfirmasi password baru minimal 6 karakter',
				'max_length' => 'Konfirmasi password baru maksimal 16 karakter',
				'matches' => 'Konfirmasi password baru tidak sesuai'
			]
		);
	}
}

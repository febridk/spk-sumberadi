<?php defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
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

		$this->namaHalaman = 'Penilaian';
		$this->urlHalaman = base_url() . 'penilaian';

		// model
		$this->load->model('ModelBobot', 'Bobot');
		$this->load->model('ModelAlternatif', 'Alternatif');
		$this->load->model('ModelKriteria', 'Kriteria');
		$this->load->model('ModelSubkriteria', 'Subkriteria');
		$this->load->model('ModelPenilaian', 'Penilaian');
	}

	public function index()
	{
		$data = [
			'namaHalaman'			=> 'Perhitungan',
			'dataBobot'				=> $this->Bobot->semua(),
			'dataPerhitunganGAP'	=> $this->perhitungan_gap(),
			'dataPembobotan'		=> $this->pembobotan(),
			'dataPengelompokkan'	=> $this->pengelompokkan()
		];

		$this->load->view('perhitungan/list', $data);
	}

	private function perhitungan_gap()
	{
		$hasilPerhitungan = [];
		$dataKriteria = $this->Kriteria->semua();
		$dataAlternatif = $this->Alternatif->semua();

		foreach ($dataKriteria as $kriteria) {
			$no = 1;
			$idKriteria = $kriteria['id_kriteria'];
			$namaKriteria = $kriteria['nama_kriteria'];

			foreach ($dataAlternatif as $alternatif) {
				$dataSebelumGAP = [];
				$dataSetelahGAP = [];
				$idAlternatif = $alternatif['id_alternatif'];
				$namaAlternatif = $alternatif['nama_alternatif'];

				$dataPenilaian = $this->Penilaian->semua($idKriteria, $idAlternatif);

				foreach ($dataPenilaian as $penilaian) {
					$idPenilaian = $penilaian['id_penilaian'];
					$namaSubkriteria = $penilaian['nama_subkriteria'];
					$targetTertinggi = $this->Subkriteria->dataTertinggi($idKriteria, $namaSubkriteria);
					$nilaiGAP = (int) $penilaian['target'] - $targetTertinggi->target;

					// data nilai sebelum perhitungan gap
					$dataSebelumGAP[] = [
						$penilaian['nama_subkriteria'] => (int) $penilaian['target']
					];

					// data nilai setelah perhitungan gap
					$dataSetelahGAP[] = [
						$penilaian['nama_subkriteria'] => $nilaiGAP
					];

					// menyimpan data gap ke penilaian
					$this->Penilaian->ubah($idPenilaian, ['nilai_gap' => $nilaiGAP]);
				}

				$hasilPerhitungan[$namaKriteria][] = [
					'no' => $no++,
					'nama_alternatif' => $namaAlternatif,
					'penilaian' => $dataSebelumGAP,
					'gap' => $dataSetelahGAP,
				];
			}
		}

		return $hasilPerhitungan;
	}

	private function pembobotan()
	{
		$pembobotan = [];

		$dataKriteria = $this->Kriteria->semua();
		$dataAlternatif = $this->Alternatif->semua();

		foreach ($dataKriteria as $kriteria) {
			$no = 1;
			$idKriteria = $kriteria['id_kriteria'];
			$namaKriteria = $kriteria['nama_kriteria'];

			foreach ($dataAlternatif as $alternatif) {
				$nilaiGAP = [];
				$nilaiBobot = [];
				$idAlternatif = $alternatif['id_alternatif'];
				$namaAlternatif = $alternatif['nama_alternatif'];

				$dataPenilaian = $this->Penilaian->semua($idKriteria, $idAlternatif);

				foreach ($dataPenilaian as $penilaian) {
					$idPenilaian = $penilaian['id_penilaian'];
					$gap = $penilaian['nilai_gap'];
					$dataBobot = $this->Bobot->satuData($gap);
					$idBobot = $dataBobot->id_bobot;
					$bobot = $dataBobot->nilai;

					// data nilai sebelum pembobotan
					$nilaiGAP[] = [$gap];

					// data nilai sebelum pembobotan
					$nilaiBobot[] = [$bobot];

					// menyimpan data pembobotan ke penilaian
					$this->Penilaian->ubah($idPenilaian, ['id_bobot' => $idBobot]);
				}

				$pembobotan[$namaKriteria][] = [
					'no' => $no++,
					'nama_alternatif' => $namaAlternatif,
					'nilai_gap' => $nilaiGAP,
					'nilai_bobot' => $nilaiBobot,
				];
			}
		}

		return $pembobotan;
	}

	private function pengelompokkan()
	{
		$pembobotan = [];

		$dataKriteria = $this->Kriteria->semua();
		$dataAlternatif = $this->Alternatif->semua();

		foreach ($dataKriteria as $kriteria) {
			$no = 1;
			$idKriteria = $kriteria['id_kriteria'];
			$namaKriteria = $kriteria['nama_kriteria'];

			foreach ($dataAlternatif as $alternatif) {
				$nilai = [];
				$idAlternatif = $alternatif['id_alternatif'];
				$namaAlternatif = $alternatif['nama_alternatif'];

				$dataPenilaian = $this->Penilaian->semua($idKriteria, $idAlternatif);

				foreach ($dataPenilaian as $penilaian) {
					// data nilai sebelum perhitungan gap
					$nilai[] = [$penilaian['nilai']];
				}

				$pembobotan[$namaKriteria][] = [
					'no' => $no++,
					'nama_alternatif' => $namaAlternatif,
					'nilai' => $nilai
				];
			}
		}

		return $pembobotan;
	}
}

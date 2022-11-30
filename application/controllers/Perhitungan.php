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
		$this->load->model('ModelBobot', 'Bobot');
		$this->load->model('ModelAlternatif', 'Alternatif');
		$this->load->model('ModelKriteria', 'Kriteria');
		$this->load->model('ModelSubkriteria', 'Subkriteria');
		$this->load->model('ModelPenilaian', 'Penilaian');
		$this->load->model('ModelHasil', 'Hasil');
	}

	public function index()
	{
		$data = [
			'namaHalaman'			=> 'Perhitungan',
			'dataBobot'				=> $this->Bobot->semua(),
			'dataPerhitunganGAP'	=> $this->perhitungan_gap(),
			'dataPembobotan'		=> $this->pembobotan(),
			'dataPengelompokkan'	=> $this->pengelompokkan(),
			'dataNilaiAkhir'		=> $this->perhitungan_nilai_akhir(),
			'dataRanking'			=> $this->perhitungan_ranking()
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
					'no'				=> $no++,
					'nama_alternatif'	=> $namaAlternatif,
					'penilaian'			=> $dataSebelumGAP,
					'gap'				=> $dataSetelahGAP
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
					'no'				=> $no++,
					'nama_alternatif'	=> $namaAlternatif,
					'nilai_gap'			=> $nilaiGAP,
					'nilai_bobot'		=> $nilaiBobot
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
					'no'				=> $no++,
					'nama_alternatif'	=> $namaAlternatif,
					'nilai'				=> $nilai
				];
			}
		}

		return $pembobotan;
	}

	private function perhitungan_nilai_akhir()
	{
		$hasilPerhitungan = [];

		$dataKriteria = $this->Kriteria->semua();
		$dataAlternatif = $this->Alternatif->semua();

		foreach ($dataKriteria as $kriteria) {
			$no = 1;
			$idKriteria = $kriteria['id_kriteria'];
			$namaKriteria = $kriteria['nama_kriteria'];
			$bobotCore = $kriteria['bobot_core'];
			$bobotSecondary = $kriteria['bobot_secondary'];

			foreach ($dataAlternatif as $alternatif) {
				$nilai = [];
				$idAlternatif = $alternatif['id_alternatif'];
				$namaAlternatif = $alternatif['nama_alternatif'];

				$dataPenilaian = $this->Penilaian->semua($idKriteria, $idAlternatif);

				foreach ($dataPenilaian as $penilaian) {
					$idPenilaian = $penilaian['id_penilaian'];
					$tipeSubkriteria = $penilaian['tipe'];

					if ($tipeSubkriteria == 'core') {
						$nilaiCore = round($penilaian['nilai'] * ($bobotCore / 100), 2);

						$nilai[] = [
							'bobot'				=> $penilaian['nilai'],
							'nilai_core'		=> $nilaiCore,
							'nilai_secondary'	=> NULL
						];

						// menyimpan data nilai core ke penilaian
						$this->Penilaian->ubah($idPenilaian, ['nilai_core' => $nilaiCore]);
					} else {
						$nilaiSecondary = round($penilaian['nilai'] * ($bobotSecondary / 100), 2);

						$nilai[] = [
							'bobot'				=> $penilaian['nilai'],
							'nilai_core'		=> NULL,
							'nilai_secondary'	=> $nilaiSecondary
						];

						// menyimpan data nilai secondary ke penilaian
						$this->Penilaian->ubah($idPenilaian, ['nilai_secondary' => $nilaiSecondary]);
					}
				}

				$hasilPerhitungan[$namaKriteria][] = [
					'no'				=> $no++,
					'nama_alternatif'	=> $namaAlternatif,
					'nilai'				=> $nilai
				];
			}
		}

		return $hasilPerhitungan;
	}

	private function perhitungan_ranking()
	{
		$hasilPerhitungan = [];

		$dataKriteria = $this->Kriteria->semua();
		$dataAlternatif = $this->Alternatif->semua();

		$no = 1;
		foreach ($dataAlternatif as $alternatif) {
			$nilaiAkhir = 0;
			$nilaiKriteria = [];
			$idAlternatif = $alternatif['id_alternatif'];
			$namaAlternatif = $alternatif['nama_alternatif'];

			foreach ($dataKriteria as $kriteria) {
				$nilaiTotal = 0;
				$idKriteria = $kriteria['id_kriteria'];
				$prosentase = $kriteria['prosentase_kriteria'];

				$dataPenilaian = $this->Penilaian->semua($idKriteria, $idAlternatif);

				foreach ($dataPenilaian as $penilaian) {
					if ($penilaian['nilai_core'] != null) {
						$nilaiTotal += $penilaian['nilai_core'];
					} else if ($penilaian['nilai_secondary'] != null) {
						$nilaiTotal += $penilaian['nilai_secondary'];
					}
				}

				$nilaiTotal = round($nilaiTotal, 2);
				$nilaiAkhir += round($nilaiTotal * ($prosentase / 100), 2);

				$nilaiKriteria[] = [
					'nilai_total' => $nilaiTotal
				];
			}

			// menyimpan data rangking ke database
			$dataHasil = [
				'id_alternatif'	=> $idAlternatif,
				'nilai'			=> round($nilaiAkhir, 2)
			];

			$periksaHasil = $this->Hasil->satuData(null, $idAlternatif);

			if ($periksaHasil) {
				$idHasil = $periksaHasil->id_hasil;
				$this->Hasil->ubah($idHasil, $dataHasil);
			} else {
				$this->Hasil->tambah($dataHasil);
			}

			$hasilPerhitungan[] = [
				'no'				=> $no++,
				'nama_alternatif'	=> $namaAlternatif,
				'kriteria'			=> $nilaiKriteria,
				'nilai_akhir'		=> round($nilaiAkhir, 2)
			];
		}

		$dataTertinggi = $this->Hasil->dataTertinggi();

		$ranking = [
			'nilai'		=> $hasilPerhitungan,
			'tertinggi' => $dataTertinggi
		];

		return $ranking;
	}
}

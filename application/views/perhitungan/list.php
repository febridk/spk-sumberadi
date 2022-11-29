<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('komponen/header'); ?>
</head>

<body>
    <div class="wrapper">
        <?php $this->load->view('komponen/sidebarmenu'); ?>

        <?php $this->load->view('komponen/navbar'); ?>

        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                SPK Sumberadi
                            </div>
                            <h2 class="page-title">
                                <?= $namaHalaman ?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="card-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation"><a href="#perhitungan-gap" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Perhitungan GAP</a></li>
                            <li class="nav-item" role="presentation"><a href="#pembobotan" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Pembobotan</a></li>
                            <li class="nav-item" role="presentation"><a href="#pengelompokkan-core-secondary" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Pengelompokkan Core dan Secondary Factor</a></li>
                            <li class="nav-item" role="presentation"><a href="#perhitungan-nilai-total" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Perhitungan Nilai Total</a></li>
                            <li class="nav-item" role="presentation"><a href="#penentuan-ranking" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Penentuan Ranking</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="perhitungan-gap" class="card tab-pane active show" role="tabpanel">
                                <div class="card-body">
                                    <p>Rumus perhitungan GAP = Value Attribut - Value Target</p>

                                    <?php $no = 1; ?>
                                    <?php foreach ($dataPerhitunganGAP as $namaKriteria => $dataAlternatif) { ?>
                                        <h4><?= $no++ ?>. Aspek <?= $namaKriteria ?></h4>

                                        <div class="table-responsive mb-4">
                                            <table class="table table-vcenter table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 75px;" rowspan="2">No</th>
                                                        <th style="width: 300px;" rowspan="2">Alternatif</th>
                                                        <th class="text-center" colspan="2">Sebelum GAP</th>
                                                        <th class="text-center" colspan="2">Setelah GAP</th>
                                                    </tr>
                                                    <tr>
                                                        <?php foreach (semuaSubKriteria($namaKriteria) as $subkriteria) { ?>
                                                            <th style="width: 300px;" class="text-center"><?= $subkriteria['nama_subkriteria'] ?></th>
                                                        <?php } ?>
                                                        <?php foreach (semuaSubKriteria($namaKriteria) as $subkriteria) { ?>
                                                            <th style="width: 300px;" class="text-center"><?= $subkriteria['nama_subkriteria'] ?></th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dataAlternatif as $perhitunganGAP) { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $perhitunganGAP['no'] ?></td>
                                                            <td><?= $perhitunganGAP['nama_alternatif'] ?></td>
                                                            <?php foreach ($perhitunganGAP['penilaian'] as $index => $nilai) { ?>
                                                                <td class="text-center"><?= $nilai[semuaSubKriteria($namaKriteria)[$index]['nama_subkriteria']] ?></td>
                                                            <?php } ?>
                                                            <?php foreach ($perhitunganGAP['gap'] as $index => $nilai) { ?>
                                                                <td class="text-center text-indigo"><?= $nilai[semuaSubKriteria($namaKriteria)[$index]['nama_subkriteria']] ?></td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div id="pembobotan" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <p>Tabel Bobot</p>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="table-responsive mb-4">
                                                <table class="table table-vcenter table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 100px" class="text-center">Selisih</th>
                                                            <th style="width: 100px" class="text-center">Nilai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($dataBobot as $bobot) { ?>
                                                            <tr>
                                                                <td class="text-center"><?= $bobot['selisih'] ?></td>
                                                                <td class="text-center"><?= $bobot['nilai'] ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $no = 1; ?>
                                    <?php foreach ($dataPembobotan as $namaKriteria => $dataAlternatif) { ?>
                                        <h4><?= $no++ ?>. Aspek <?= $namaKriteria ?></h4>

                                        <div class="table-responsive mb-4">
                                            <table class="table table-vcenter table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 75px;" class="text-center" rowspan="2">No</th>
                                                        <th style="width: 300px;" rowspan="2">Alternatif</th>
                                                        <th class="text-center" colspan="2">Sebelum Pembobotan</th>
                                                        <th class="text-center" colspan="2">Setelah Pembobotan</th>
                                                    </tr>
                                                    <tr>
                                                        <?php foreach (semuaSubKriteria($namaKriteria) as $subkriteria) { ?>
                                                            <th style="width: 300px;" class="text-center"><?= $subkriteria['nama_subkriteria'] ?></th>
                                                        <?php } ?>
                                                        <?php foreach (semuaSubKriteria($namaKriteria) as $subkriteria) { ?>
                                                            <th style="width: 300px;" class="text-center"><?= $subkriteria['nama_subkriteria'] ?></th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dataAlternatif as $perhitunganGAP) { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $perhitunganGAP['no'] ?></td>
                                                            <td><?= $perhitunganGAP['nama_alternatif'] ?></td>
                                                            <?php foreach ($perhitunganGAP['nilai_gap'] as $nilai) { ?>
                                                                <td class="text-center"><?= $nilai[0] ?></td>
                                                            <?php } ?>
                                                            <?php foreach ($perhitunganGAP['nilai_bobot'] as $nilai) { ?>
                                                                <td class="text-center text-indigo"><?= $nilai[0] ?></td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div id="pengelompokkan-core-secondary" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <p>Pengelompokkan Core dan Secondary Factor</p>

                                    <?php $no = 1; ?>
                                    <?php foreach ($dataPengelompokkan as $namaKriteria => $dataAlternatif) { ?>
                                        <h4><?= $no++ ?>. Aspek <?= $namaKriteria ?></h4>

                                        <div class="table-responsive mb-4">
                                            <table class="table table-vcenter table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 75px;">No</th>
                                                        <th style="width: 300px;">Alternatif</th>
                                                        <?php foreach (semuaSubKriteria($namaKriteria) as $subkriteria) { ?>
                                                            <?php if ($subkriteria['tipe'] == 'core') { ?>
                                                                <th style="width: 300px;" class="text-center"><?= $subkriteria['nama_subkriteria'] ?> <br> <span class="text-indigo"><?= ucwords($subkriteria['tipe']) ?> Factor</span></th>
                                                            <?php } else { ?>
                                                                <th style="width: 300px;" class="text-center"><?= $subkriteria['nama_subkriteria'] ?> <br> <span class="text-yellow"><?= ucwords($subkriteria['tipe']) ?> Factor</span></th>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dataAlternatif as $perhitunganGAP) { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $perhitunganGAP['no'] ?></td>
                                                            <td><?= $perhitunganGAP['nama_alternatif'] ?></td>
                                                            <?php foreach ($perhitunganGAP['nilai'] as $nilai) { ?>
                                                                <td class="text-center"><?= $nilai[0] ?></td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div id="perhitungan-nilai-total" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <p>Rumus Perhitungan Total = (x)%.NCF(i,s,p) + (x)%.NSF(i,s,p)</p>

                                    <?php $no = 1; ?>
                                    <?php foreach ($dataNilaiAkhir as $namaKriteria => $dataAlternatif) { ?>
                                        <h4><?= $no++ ?>. Aspek <?= $namaKriteria ?></h4>

                                        <div class="table-responsive mb-4">
                                            <table class="table table-vcenter table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 75px;">No</th>
                                                        <th style="width: 300px;">Alternatif</th>
                                                        <?php foreach (semuaSubKriteria($namaKriteria) as $subkriteria) { ?>
                                                            <?php if ($subkriteria['tipe'] == 'core') { ?>
                                                                <th style="width: 200px;" class="text-center"><span class="text-indigo"><?= ucwords($subkriteria['tipe']) ?> Factor</span></th>
                                                            <?php } else { ?>
                                                                <th style="width: 200px;" class="text-center"><span class="text-yellow"><?= ucwords($subkriteria['tipe']) ?> Factor</span></th>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <th class="text-center">Nilai Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dataAlternatif as $perhitunganGAP) { ?>
                                                        <tr>
                                                            <td class="text-center"><?= $perhitunganGAP['no'] ?></td>
                                                            <td><?= $perhitunganGAP['nama_alternatif'] ?></td>
                                                            <?php foreach ($perhitunganGAP['nilai'] as $nilai) { ?>
                                                                <td class="text-center"><?= $nilai['bobot'] ?></td>
                                                            <?php } ?>
                                                            <td class="text-center"><?= $perhitunganGAP['nilai'][0]['nilai_core'] + $perhitunganGAP['nilai'][1]['nilai_secondary'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div id="penentuan-ranking" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <p>Rumus Perhitungan Penentuan Ranking = (x)%.Ni + (x)%.Ns + (x)%.Np </p>

                                    <div class="table-responsive mb-4">
                                        <table class="table table-vcenter table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 75px;">No</th>
                                                    <th style="width: 300px;">Alternatif</th>
                                                    <?php foreach (semuaKriteria() as $kriteria) { ?>
                                                        <th style="width: 150px;" class="text-center"><?= ucwords($kriteria['nama_kriteria']) ?></th>
                                                    <?php } ?>
                                                    <th class="text-center">Nilai Akhir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dataRanking['nilai'] as $ranking) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $ranking['no'] ?></td>
                                                        <td><?= $ranking['nama_alternatif'] ?></td>
                                                        <?php foreach ($ranking['kriteria'] as $nilai) { ?>
                                                            <td class="text-center"><?= $nilai['nilai_total'] ?></td>
                                                        <?php } ?>
                                                        <td class="text-center"><?= $ranking['nilai_akhir'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <ul>
                                        <li>Nama Alternatif : <?= $dataRanking['tertinggi']->nama_alternatif ?></li>
                                        <li>Nilai Terbesar : <?= $dataRanking['tertinggi']->nilai ?></li>
                                    </ul>

                                    <p>Maka kandikat berdasarkan besarnya nilai berkesempatan untuk mendapatkan rekomendasi kelayakan peminjaman dana adalah <b><?= $dataRanking['tertinggi']->nama_alternatif ?></b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; 2022 SPK Sumberadi.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?php $this->load->view('komponen/footer'); ?>
</body>

</html>
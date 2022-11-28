<?php
defined('BASEPATH') or exit('No direct script access allowed');
$no = 1;
?>

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
                            <li class="nav-item" role="presentation"><a href="#perhitungan-core-secondary" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Perhitungan Core dan Secondary Factor</a></li>
                            <li class="nav-item" role="presentation"><a href="#perhitungan-nilai-total" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Perhitungan Nilai Total</a></li>
                            <li class="nav-item" role="presentation"><a href="#penentuan-ranking" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">Penentuan Ranking</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="perhitungan-gap" class="card tab-pane active show" role="tabpanel">
                                <div class="card-body">
                                    <p>Rumus perhitungan GAP = Value Attribut - Value Target</p>

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
                                                            <th class="text-center"><?= $subkriteria['nama_subkriteria'] ?></th>
                                                        <?php } ?>
                                                        <?php foreach (semuaSubKriteria($namaKriteria) as $subkriteria) { ?>
                                                            <th class="text-center"><?= $subkriteria['nama_subkriteria'] ?></th>
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
                                    <div class="card-title">Pembobotan</div>

                                </div>
                            </div>

                            <div id="perhitungan-core-secondary" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-title">Perhitungan Core dan Secondary Factor</div>

                                </div>
                            </div>

                            <div id="perhitungan-nilai-total" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-title">Perhitungan Nilai Total</div>

                                </div>
                            </div>

                            <div id="penentuan-ranking" class="card tab-pane" role="tabpanel">
                                <div class="card-body">
                                    <div class="card-title">Penentuan Ranking</div>

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
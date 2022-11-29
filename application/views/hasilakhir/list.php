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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $namaHalaman ?></h3>
                            <?php if (getSession()->level == 'Karyawan') { ?>
                                <div class="card-actions">
                                    <a type="button" id="cetak" class="btn d-print-none">
                                        <i class="ti ti-printer me-2"></i>
                                        Cetak
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Alternatif</th>
                                            <th class="text-center">Nilai Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($dataHasil) > 0) { ?>
                                            <?php foreach ($dataHasil as $data) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?></td>
                                                    <td><?= $data['nama_alternatif'] ?></td>
                                                    <td class="text-center"><?= $data['nilai'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="3" class="py-3">Data tidak tersedia.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if (count($dataHasil) > 0) { ?>
                                <ul>
                                    <li>Nama Alternatif : <?= $dataTertinggi->nama_alternatif ?></li>
                                    <li>Nilai Terbesar : <?= $dataTertinggi->nilai ?></li>
                                </ul>

                                <p>Maka kandikat berdasarkan besarnya nilai berkesempatan untuk mendapatkan rekomendasi kelayakan peminjaman dana adalah <b><?= $dataTertinggi->nama_alternatif ?></b></p>
                            <?php } ?>
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

    <script>
        $('#cetak').on('click', function() {
            window.print();
            return false;
        })
    </script>
</body>

</html>
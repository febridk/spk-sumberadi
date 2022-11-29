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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="page-pretitle">
                                        Aplikasi
                                    </div>
                                    <h2 class="page-title">
                                        Sistem Penunjang Keputusan <br> Penyaluran Dana Desa Pada Desa Bedingin Sumberadi Yogyakarta
                                    </h2>
                                </li>
                                <li class="mb-3">
                                    <div class="page-pretitle">
                                        Nama Pengguna
                                    </div>
                                    <h2 class="page-title">
                                        <?= getSession()->nama_pengguna ?>
                                    </h2>
                                </li>
                                <li>
                                    <div class="page-pretitle">
                                        Level Pengguna
                                    </div>
                                    <h2 class="page-title">
                                        <?= getSession()->level ?>
                                    </h2>
                                </li>
                            </ul>
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
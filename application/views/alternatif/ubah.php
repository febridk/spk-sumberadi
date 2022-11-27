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
                    <div class="row row-deck row-cards">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header justify-content-end flex-row-reverse gap-3">
                                    <h3 class="card-title">Ubah <?= $namaHalaman ?></h3>
                                    <div class="card-actions ms-0">
                                        <a href="<?= base_url() ?>alternatif" class="btn">
                                            <i class="ti ti-chevron-left me-2"></i>
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                                <form action="<?= current_url() ?>" method="post">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama_alternatif">Nama Alternatif</label>
                                            <input type="text" class="form-control" name="nama_alternatif" id="nama_alternatif" value="<?= set_value('nama_alternatif') ? set_value('nama_alternatif') : $alternatif->nama_alternatif ?>" placeholder="Nama Alternatif">
                                            <?= form_error('nama_alternatif', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary ms-auto">Simpan</button>
                                        </div>
                                    </div>
                                </form>
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
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
                        <div class="card-header justify-content-end flex-row-reverse gap-3">
                            <h3 class="card-title">Tambah <?= $namaHalaman ?></h3>
                            <div class="card-actions ms-0">
                                <a href="<?= base_url() ?>kriteria" class="btn">
                                    <i class="ti ti-chevron-left me-2"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <form action="<?= current_url() ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama_kriteria">Nama Kriteria</label>
                                            <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" value="<?= set_value('nama_kriteria') ?>" placeholder="Nama Kriteria">
                                            <?= form_error('nama_kriteria', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="prosentase_kriteria">Prosentase</label>
                                            <input type="number" class="form-control" name="prosentase_kriteria" id="prosentase_kriteria" min="1" value="<?= set_value('prosentase_kriteria') ?>" placeholder="Prosentase">
                                            <?= form_error('prosentase_kriteria', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="bobot_core">Bobot Core</label>
                                            <input type="number" class="form-control" name="bobot_core" id="bobot_core" min="1" value="<?= set_value('bobot_core') ?>" placeholder="Bobot Core">
                                            <?= form_error('bobot_core', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="bobot_secondary">Bobot Secondary</label>
                                            <input type="number" class="form-control" name="bobot_secondary" id="bobot_secondary" min="1" value="<?= set_value('bobot_secondary') ?>" placeholder="Bobot Secondary">
                                            <?= form_error('bobot_secondary', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
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
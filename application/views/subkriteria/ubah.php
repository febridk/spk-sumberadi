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
                            <h3 class="card-title">Ubah <?= $namaHalaman ?></h3>
                            <div class="card-actions ms-0">
                                <a href="<?= base_url() ?>subkriteria" class="btn">
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
                                            <label class="form-label" for="nama_subkriteria">Nama Sub Kriteria</label>
                                            <input type="text" class="form-control" name="nama_subkriteria" id="nama_subkriteria" value="<?= set_value('nama_subkriteria') ? set_value('nama_subkriteria') : $subkriteria->nama_subkriteria ?>" placeholder="Nama Sub Kriteria">
                                            <?= form_error('nama_subkriteria', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="id_kriteria">Nama Kriteria</label>
                                            <select class="form-control" name="id_kriteria" id="id_kriteria">
                                                <option value="">Pilih Kriteria</option>
                                                <?php foreach ($dataKriteria as $data) { ?>
                                                    <option value="<?= $data['id_kriteria'] ?>" <?= (set_value('id_kriteria') ? set_value('id_kriteria') : $subkriteria->id_kriteria) == $data['id_kriteria'] ? 'selected' : '' ?>><?= $data['nama_kriteria'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?= form_error('id_kriteria', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="taget">Target</label>
                                            <input type="number" class="form-control" name="taget" id="taget" min="1" value="<?= set_value('taget') ? set_value('taget') : $subkriteria->taget ?>" placeholder="Target">
                                            <?= form_error('taget', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="tipe">Tipe</label>
                                            <select class="form-control" name="tipe" id="tipe">
                                                <option value="">Pilih Kriteria</option>
                                                <option value="core" <?= (set_value('tipe') ? set_value('tipe') : $subkriteria->tipe) == 'core' ? 'selected' : '' ?>>Core</option>
                                                <option value="secondary" <?= (set_value('tipe') ? set_value('tipe') : $subkriteria->tipe) == 'secondary' ? 'selected' : '' ?>>Secondary</option>
                                            </select>
                                            <?= form_error('tipe', '<small class="text-danger">', '</small>') ?>
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
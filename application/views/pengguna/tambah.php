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
                                <a href="<?= base_url() ?>pengguna" class="btn">
                                    <i class="ti ti-chevron-left me-2"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <form action="<?= current_url() ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama_pengguna">Nama Pengguna</label>
                                            <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" value="<?= set_value('nama_pengguna') ?>" placeholder="Nama Pengguna">
                                            <?= form_error('nama_pengguna', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" min="1" value="<?= set_value('username') ?>" placeholder="Username">
                                            <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="text" class="form-control" name="password" id="password" value="<?= set_value('password') ?>" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="level">Level</label>
                                            <select class="form-control" name="level" id="level">
                                                <option value="">Pilih Level</option>
                                                <option value="Karyawan" <?= set_value('level') == 'Karyawan' ? 'selected' : '' ?>>Karyawan</option>
                                                <option value="Kepala Dukuh" <?= set_value('level') == 'Kepala Dukuh' ? 'selected' : '' ?>>Kepala Dukuh</option>
                                            </select>
                                            <?= form_error('level', '<small class="text-danger">', '</small>') ?>
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
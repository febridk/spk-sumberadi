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
                            <div class="card-actions">
                                <a href="<?= current_url() ?>/tambah" class="btn">
                                    <i class="ti ti-plus me-2"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($dataPengguna) > 0) { ?>
                                        <?php foreach ($dataPengguna as $data) { ?>
                                            <?php $id = $data['id_pengguna']; ?>

                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['nama_pengguna'] ?></td>
                                                <td><?= $data['username'] ?></td>
                                                <td><?= $data['level'] ?></td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a class="btn btn-outline-info" href="<?= current_url() ?>/ubah/<?= $id ?>">
                                                            <i class="ti ti-pencil me-2"></i>Ubah
                                                        </a>
                                                        <a class="btn btn-outline-danger" href="#" data-bs-toggle="modal" data-bs-target="#hapus-<?= $id ?>">
                                                            <i class="ti ti-trash me-2"></i>Hapus
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php include(VIEWPATH . 'komponen/modalhapus.php') ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="5" class="py-3">Data tidak tersedia.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
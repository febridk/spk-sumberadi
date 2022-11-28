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
                                <a href="<?= base_url() ?>penilaian" class="btn">
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
                                            <label class="form-label" for="id_alternatif">Nama Alternatif</label>
                                            <select class="form-control" name="id_alternatif" id="id_alternatif">
                                                <option value="">Pilih Alternatif</option>
                                                <?php foreach ($dataAlternatif as $data) { ?>
                                                    <option value="<?= $data['id_alternatif'] ?>" <?= set_value('id_alternatif') == $data['id_alternatif'] ? 'selected' : '' ?>><?= $data['nama_alternatif'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?= form_error('id_alternatif', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="id_kriteria">Kriteria</label>
                                            <select class="form-control" name="id_kriteria" id="id_kriteria">
                                                <option value="">Pilih Kriteria</option>
                                                <?php foreach ($dataKriteria as $data) { ?>
                                                    <option value="<?= $data['id_kriteria'] ?>" <?= set_value('id_kriteria') == $data['id_kriteria'] ? 'selected' : '' ?>><?= $data['nama_kriteria'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?= form_error('id_kriteria', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama_subkriteria">Sub Kriteria</label>
                                            <select class="form-control" name="nama_subkriteria" id="nama_subkriteria">
                                                <option value="">Pilih Sub Kriteria</option>
                                            </select>
                                            <?= form_error('nama_subkriteria', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="id_subkriteria">Nilai</label>
                                            <select class="form-control" name="id_subkriteria" id="id_subkriteria">
                                                <option value="">Pilih Nilai</option>
                                            </select>
                                            <?= form_error('id_subkriteria', '<small class="text-danger">', '</small>') ?>
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

    <script>
        var url = '<?= base_url() ?>'
        var kriteria = $('#id_kriteria')
        var subkriteria = $('#nama_subkriteria')
        var nilai = $('#id_subkriteria')

        kriteria.on('change', function() {
            var id_kriteria = $(this).val()
            var pilihanSubkriteria

            $.ajax({
                url: url + 'penilaian/subkriteria',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    id_kriteria: id_kriteria
                },
                success: function(data) {
                    subkriteria.empty()
                    pilihanSubkriteria += '<option value="">Pilih Sub Kriteria</option>'

                    for (var loop = 0; loop < data.length; loop++) {
                        pilihanSubkriteria += '<option value="' + data[loop].nama_subkriteria + '">' + data[loop].nama_subkriteria + '</option>';
                    }

                    subkriteria.append(pilihanSubkriteria)
                }
            })
        })

        subkriteria.on('change', function() {
            var nama_subkriteria = $(this).val()
            var pilihanNilai

            $.ajax({
                url: url + 'penilaian/nilai',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    nama_subkriteria: nama_subkriteria
                },
                success: function(data) {
                    nilai.empty()
                    pilihanNilai += '<option value="">Pilih Nilai</option>'

                    for (var loop = 0; loop < data.length; loop++) {
                        pilihanNilai += '<option value="' + data[loop].id_subkriteria + '">' + data[loop].keterangan + '</option>';
                    }

                    nilai.append(pilihanNilai)
                }
            })
        })
    </script>
</body>

</html>
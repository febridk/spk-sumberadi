<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="<?= base_url() ?>" class="navbar-brand-image">
                SPK Sumberadi
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                </svg>
            </a>
            <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="12" cy="12" r="4" />
                    <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                </svg>
            </a>
            <div class="nav-item dropdown ms-3">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(<?= base_url() ?>assets/static/avatars/025m.jpg)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?= getSession()->nama_pengguna ?></div>
                        <div class="mt-1 small text-muted"><?= getSession()->level ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="<?= base_url() ?>akun/ubahpassword" class="dropdown-item">Ubah Password</a>
                    <a href="<?= base_url() ?>login/keluar" class="dropdown-item">Keluar</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <div class="ti ti-home fs-2"></div>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>

                <hr class="my-3">

                <?php if (getSession()->level == 'Karyawan') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>alternatif">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <div class="ti ti-list fs-2"></div>
                            </span>
                            <span class="nav-link-title">
                                Alternatif
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>kriteria">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <div class="ti ti-file fs-2"></div>
                            </span>
                            <span class="nav-link-title">
                                Kriteria
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>subkriteria">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <div class="ti ti-file-description fs-2"></div>
                            </span>
                            <span class="nav-link-title">
                                Sub Kriteria
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>penilaian">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <div class="ti ti-circle-check fs-2"></div>
                            </span>
                            <span class="nav-link-title">
                                Penilaian
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>perhitungan">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <div class="ti ti-percentage fs-2"></div>
                            </span>
                            <span class="nav-link-title">
                                Perhitungan
                            </span>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>hasilakhir">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <div class="ti ti-chart-line fs-2"></div>
                        </span>
                        <span class="nav-link-title">
                            Hasil Akhir
                        </span>
                    </a>
                </li>

                <hr class="my-3">

                <?php if (getSession()->level == 'Kepala Dukuh') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>pengguna">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <div class="ti ti-user fs-2"></div>
                            </span>
                            <span class="nav-link-title">
                                Pengguna
                            </span>
                        </a>
                    </li>
                <?php } else if (getSession()->level == 'Karyawan') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#resetdata">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <div class="ti ti-eraser fs-2"></div>
                            </span>
                            <span class="nav-link-title">
                                Reset Data
                            </span>
                        </a>
                    </li>

                    <hr class="my-3">
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>akun/ubahpassword">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <div class="ti ti-lock fs-2"></div>
                        </span>
                        <span class="nav-link-title">
                            Ubah Password
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>login/keluar">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <div class="ti ti-logout fs-2"></div>
                        </span>
                        <span class="nav-link-title">
                            Keluar
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

<?php include(VIEWPATH . 'komponen/modalreset.php') ?>
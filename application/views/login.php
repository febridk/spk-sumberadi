<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('komponen/header'); ?>
</head>

<body class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="<?= base_url() ?>" class="navbar-brand navbar-brand-autodark">
                    <img src="<?= base_url() ?>assets/static/logo.svg" height="36" alt="logo">
                </a>
            </div>
            <form class="card card-md" action="<?= base_url() ?>login" method="POST" autocomplete="off">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login menggunakan akun anda</h2>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= set_value('username') ?>" placeholder="Username">
                        <?= form_error('username', '<small class="text-small text-danger">', '</small>') ?>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" value="<?= set_value('password') ?>" placeholder="Password" autocomplete="off">
                        <?= form_error('password', '<small class="text-small text-danger">', '</small>') ?>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php $this->load->view('komponen/footer'); ?>
</body>

</html>
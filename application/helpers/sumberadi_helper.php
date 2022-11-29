<?php defined('BASEPATH') or exit('No direct script access allowed');

function getSession()
{
    $app = get_instance();
    $app->load->model('ModelLogin', 'Login');
    $username = $app->session->userdata('username');

    if ($username) {
        return $app->Login->periksaPengguna($username);
    }
}

function semuaKriteria()
{
    $app = get_instance();
    $app->load->model('ModelKriteria', 'Kriteria');

    return $app->Kriteria->semua();
}

function semuaSubKriteria($namakriteria)
{
    $app = get_instance();
    $app->load->model('ModelKriteria', 'Kriteria');
    $app->load->model('ModelSubkriteria', 'Subkriteria');

    $kriteria = $app->Kriteria->satuData(null, $namakriteria);
    $idKriteria = $kriteria->id_kriteria;

    return $app->Subkriteria->semua($idKriteria, null, true);
}

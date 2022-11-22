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

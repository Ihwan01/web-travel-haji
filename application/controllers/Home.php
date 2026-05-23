<?php
defined('BASEPATH') or exit('No direct script access allowed');

// UBAH: dari CI_Controller menjadi Public_Controller
class Home extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Area ini siap digunakan jika Home butuh model khusus pengunjung di masa depan
    }

    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('home');
        $this->load->view('layout/footer');
    }
}
